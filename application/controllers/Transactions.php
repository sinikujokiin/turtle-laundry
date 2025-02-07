<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!isLogin()) {
			danger("Anda belum login, silahkan login terlebih dahulu");
			redirect('login');
		}
	}

	public function index()
	{
		access('transaksi-read', 'redirect');
		$where = [];
		if (user()->role == 'Staff') {
			$where = ['created_by' => user()->id];
		}
		$transactions = Transaction::with(['member', 'creator'])->where($where)->orderBy('id','desc')->get();
		$diterima = [];
		$diproses = [];
		$dicuci = [];
		$siapdiambil = [];
		$sudahdiambil = [];

		foreach ($transactions as $value) {
			switch ($value->status) {
				case 'diterima':
					$diterima[] = $value;
					break;
				case 'diproses':
					$diproses[] = $value;
					break;
				case 'dicuci':
					$dicuci[] = $value;
					break;
				case 'siap diambil':
					$siapdiambil[] = $value;
					break;
				case 'sudah diambil':
					$sudahdiambil[] = $value;
					break;
			}
		}

		$data = [
			'title' 		=> 'Transaksi',
			'breadcrumb' 	=> 'List Transaksi',
			'transactions'  => $transactions,
			'diterima' 		=> $diterima,
			'diproses' 		=> $diproses,
			'dicuci' 		=> $dicuci,
			'siapdiambil' 	=> $siapdiambil,
			'sudahdiambil' 	=> $sudahdiambil,
		];
		$this->template->load('templates/cms','cms/transactions/index', $data,FALSE);
	}

	function show($id)
	{
		access('transaksi-detail', 'redirect');
		$id = encrypt_decrypt('decrypt', $id);
		$transactions = Transaction::with(['member', 'transactiondetail.servicedetail', 'transactionlog.user'])->find($id);
		if (!$transactions) {
			danger('Data transaksi tidak ditemukan');
			redirect(base_url('transactions'),'refresh');
		}


		$data = [
			'title' 		=> 'Transaksi',
			'breadcrumb' 	=> 'Detail Data Transaksi',
			'transactions' 		=> $transactions,
		];


		$this->template->load('templates/cms','cms/transactions/show', $data,FALSE);
	}

	public function create()
	{
		access('transaksi-create', 'redirect');
		$data = [
			'title' 		=> 'Transaksi',
			'breadcrumb' 	=> 'Tambah Data Transaksi',
			'services' 		=> Service::with(['detail'])->get(),
			'members' 		=> Member::all(),
		];
		$this->template->load('templates/cms','cms/transactions/create', $data,FALSE);
	}

	public function store()
	{

		access('transaksi-create', 'redirect');
		$request = $this->input->post();
		if (!$request) {
			danger('Data transaksi tidak ditemukan');
			redirect('transactions/create','refresh');
		}

		$this->form_validation->set_rules('member_id', 'customer', 'trim|required', messageError());
		// $this->form_validation->set_rules('service_detail_id', 'deskripsi', 'trim|required', messageError());
		// $this->form_validation->set_rules('weight', 'jumhal berat/satuan', 'trim|required|numeric', messageError());
		// $this->form_validation->set_rules('price', 'harga', 'trim|required|numeric', messageError());
		$this->form_validation->set_rules('discount', 'diskon', 'trim|required|numeric', messageError());
		$this->form_validation->set_rules('tax', 'pajak', 'trim|required|numeric', messageError());
		$this->form_validation->set_rules('payment_status', 'status pembayaran', 'trim|required', messageError());
		$this->form_validation->set_rules('due_date', 'batas waktu', 'trim|required', messageError());
		$this->form_validation->set_rules('due_time', 'batas waktu', 'trim|required', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');

		if ($this->form_validation->run()) {


			// Before discount & tax
			$subtotal = array_sum($request['subtotal']);

			// After discount & tax
			$total = $subtotal + (($request['tax']/100)*$subtotal)-(($request['discount']/100) * $subtotal);

			$lastCode = Transaction::latest('code')->first();
			$code = buatkode(isset($lastCode->code) ? $lastCode->code : null, date("ymd").$request['member_id'].user()->id.'-', 3);
			$transactions = new Transaction;
			$transactions->code = $code;
			$transactions->member_id = $request['member_id'];
			// $transactions->service_detail_id = $request['service_detail_id'];
			// $transactions->weight = $request['weight'];
			// $transactions->price = $request['price'];
			$transactions->discount = $request['discount'];
			$transactions->tax = $request['tax'];
			$transactions->due_date = $request['due_date'];
			$transactions->due_time = $request['due_time'];
			$transactions->payment_status = $request['payment_status'];
			$transactions->payment_status == 'sudah dibayar' ? $transactions->payment_date = date("Y-m-d H:i:s") : '' ; 
			$transactions->subtotal = $subtotal;
			$transactions->created_by = user()->id;
			$transactions->total = $total;
			$transactions->save();

			$transaction_id = $transactions->id;

			$detailTransaction = [];
			for ($i = 0; $i < count($request['service_detail_id']) ; ++$i) {
				$detailTransaction[] = [
					'transaction_id' => $transaction_id,
					'weight'  => $request['weight'][$i],
					'price'  => $request['price'][$i],
					'service_detail_id'  => $request['service_detail_id'][$i],
				];
			}

			TransactionDetail::insert($detailTransaction);

			TransactionLog::create(
				[
					'transaction_id' => $transaction_id,
					'status'		=> 'dibuat',
					'description' => "Pesanan laundry dibuat",
					'user_id' => user()->id,
				]
			);

			Log::create(
				[
					'user_id' 	=> user()->id,
					'url'		=> fullUrl(),
					'description' => "Membuat transaksi $transactions->code"
				]
			);

			success('Berhasil menambahkan data transaksi');
			redirect(base_url('transactions'));
		} else {
			$error = getErrorValidation();
			$this->session->set_flashdata('error', $error);
			redirect(base_url('transactions/create'));
		}

	}

	function edit($id)
	{
		access('transaksi-update', 'redirect');
		$id = encrypt_decrypt('decrypt', $id);
		$transactions = Transaction::with(['transactiondetail.servicedetail'])->find($id);
		if (!$transactions) {
			danger('Data transaksi tidak ditemukan');
			redirect(base_url('transactions'),'refresh');
		}

		$data = [
			'title' => 'Transaksi',
			'breadcrumb' => 'Ubah Data Transaksi',
			'transactions' => $transactions,
			'services' 		=> Service::with(['detail'])->get(),
			'members' 		=> Member::all(),
		];

		$this->template->load('templates/cms','cms/transactions/edit', $data,FALSE);

	}

	public function update($id)
	{

		access('transaksi-update', 'redirect');
		$request = $this->input->post();
		$id =  encrypt_decrypt('decrypt', $id);
		$transactions = Transaction::find($id);

		if (!$transactions) {
			danger('Data transaksi tidak ditemukan');
			redirect(base_url('transactions'), 'refresh');
		}

		if (!$request) {
			redirect('transactions/edit/'.encrypt_decrypt('encrypt',$id),'refresh');
		}


		$this->form_validation->set_rules('member_id', 'customer', 'trim|required', messageError());
		// $this->form_validation->set_rules('service_detail_id', 'deskripsi', 'trim|required', messageError());
		// $this->form_validation->set_rules('weight', 'jumhal berat/satuan', 'trim|required|numeric', messageError());
		// $this->form_validation->set_rules('price', 'harga', 'trim|required|numeric', messageError());
		$this->form_validation->set_rules('discount', 'diskon', 'trim|required|numeric', messageError());
		$this->form_validation->set_rules('tax', 'pajak', 'trim|required|numeric', messageError());
		$this->form_validation->set_rules('payment_status', 'status pembayaran', 'trim|required', messageError());
		$this->form_validation->set_rules('due_date', 'batas waktu', 'trim|required', messageError());
		$this->form_validation->set_rules('due_time', 'batas waktu', 'trim|required', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');

		if ($this->form_validation->run()) {
			// Before discount & tax
			$subtotal = array_sum($request['subtotal']);

			// After discount & tax
			$total = $subtotal + (($request['tax']/100)*$subtotal)-(($request['discount']/100) * $subtotal);
			$transactions->member_id = $request['member_id'];
			// $transactions->service_detail_id = $request['service_detail_id'];
			// $transactions->weight = $request['weight'];
			// $transactions->price = $request['price'];
			$transactions->discount = $request['discount'];
			$transactions->tax = $request['tax'];
			$transactions->due_date = $request['due_date'];
			$transactions->due_time = $request['due_time'];
			$transactions->payment_status = $request['payment_status'];
			$transactions->payment_status == 'sudah dibayar' && !$transactions->payment_date ? $transactions->payment_date = date("Y-m-d H:i:s") : $transactions->payment_date = null ; 
			$transactions->subtotal = $subtotal;
			$transactions->total = $total;
			
			$transactions->save();

			for ($i = 0; $i < count($request['service_detail_id']) ; ++$i) {

				// foreach ($detailTransactions as $value) {
				// 	echo $value->service_detail_id .' == '.$request['service_detail_id'][$i].'<br>';
				// 	// var_dump($value->service_detail_id);
				// 	// echo 
				// 	// var_dump($request['service_detail_id'][$i]);
				// 	if ($value->service_detail_id != $request['service_detail_id'][$i]) {
				// 		TransactionDetail::where('id', $value->id)->delete();
				// 	}
				// }
				$detailTransaction = TransactionDetail::firstOrCreate(
					[
						'transaction_id' => $id,
						'service_detail_id'  => $request['service_detail_id'][$i],
					],
					[
						'weight'  => $request['weight'][$i],
						'price'  => $request['price'][$i],
					]
				);
				// [] = [
				// 	'transaction_id' => $transaction_id,
				// 	'weight'  => $request['weight'][$i],
				// 	'price'  => $request['price'][$i],
				// 	'service_detail_id'  => $request['service_detail_id'][$i],
				// ];
			}
			$detailTransactions = TransactionDetail::where(['transaction_id' => $id])->whereNotIn('service_detail_id', $request['service_detail_id'])->delete();

			TransactionLog::create(
				[
					'transaction_id' => $id,
					'status'		=> 'diubah',
					'description' => "Pesanan laundry diperbarui",
					'user_id' => user()->id,
				]
			);

			Log::create(
				[
					'user_id' 	=> user()->id,
					'url'		=> fullUrl(),
					'description' => "Mengubah transaksi $transactions->code"
				]
			);
			// var_dump($detailTransactions);die;

			// die;
			// TransactionDetail::insert($detailTransaction);


			success('Berhasil memperbarui data transaksi');
			redirect(base_url('transactions'));
		} else {
			$error = getErrorValidation();
			$this->session->set_flashdata('error', $error);
			redirect(base_url('transactions/edit/'.encrypt_decrypt('encrypt',$id)));
		}

	}

	function destroy($id){
		access('transaksi-delete', 'redirect');
		$id = encrypt_decrypt('decrypt', $id);
		$transactions = Transaction::find($id);
		if (!$transactions) {

			danger('Data transaksi tidak ditemukan');
			redirect(base_url('transactions'),'refresh');
		}

		$transactions->delete();

		Log::create(
			[
				'user_id' 	=> user()->id,
				'url'		=> fullUrl(),
				'description' => "Menghapus transaksi $transactions->code"
			]
		);

		success('Berhasil menghapus data transaksi');
		redirect(base_url('transactions'),'refresh');
	}

	function next($ids, $status, $from = null)
	{
		$id = encrypt_decrypt('decrypt', $ids);
		$transactions = Transaction::find($id);
		if (!$transactions) {

			danger('Data transaksi tidak ditemukan');
			redirect(base_url('transactions'),'refresh');
		}

		$beforeStatus = $transactions->status;

		$transactions->status = urldecode($status);
		$transactions->save();

		TransactionLog::create(
				[
					'transaction_id' => $id,
					'status' => $transactions->status,
					'description' => "Status pesanan diubah dari $beforeStatus menjadi $transactions->status",
					'user_id' => user()->id,
				]
			);

		Log::create(
			[
				'user_id' 	=> user()->id,
				'url'		=> fullUrl(),
				'description' => "Mengubah status transaksi $transactions->code"
			]
		);
		if ($from) {
			success('Berhasil mengubah status transaksi '.$transactions->code);
			redirect(base_url('transactions'),'refresh');
		}else{
			success('Berhasil mengubah status transaksi');
			redirect(base_url('transactions/show/'.$ids),'refresh');
		}
	}


	function print($id)
	{
		access('transaksi-print', 'redirect');
		$id = encrypt_decrypt('decrypt', $id);
		$transactions = Transaction::with(['member', 'transactiondetail.servicedetail', 'transactionlog.user'])->find($id);
		if (!$transactions) {
			danger('Data transaksi tidak ditemukan');
			redirect(base_url('transactions'),'refresh');
		}


		$data = [
			'title' 		=> 'Invoice',
			'breadcrumb' 	=> 'Invoice Transaksi '.$transactions->code,
			'transactions' 		=> $transactions,
		];


		$this->template->load('templates/cms','cms/transactions/print', $data,FALSE);
	}



}
