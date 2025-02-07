<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServiceDetails extends CI_Controller {

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
		access('harga-read', 'redirect');

		$details = ServiceDetail::with(['service'])->get();
		// var_dump($details);die;
		$data = [
			'title' => 'Harga Pelayanan',
			'breadcrumb' => 'List Harga Pelayanan',
			'details'  => $details,
		];
		$this->template->load('templates/cms','cms/service-details/index', $data,FALSE);
	}


	public function create()
	{
		access('harga-create', 'redirect');

		$services = Service::all();

		$data = [
			'title' => 'Harga Pelayanan',
			'breadcrumb' => 'Tambah Data Harga Pelayanan',
			'services' => $services
		];

		$this->template->load('templates/cms','cms/service-details/create', $data,FALSE);
	}

	public function store()
	{

		access('harga-create', 'redirect');
		$request = $this->input->post();
		if (!$request) {
			danger('Data harga pelayanan tidak ditemukan');
			redirect('service-details/create','refresh');
		}

		$this->form_validation->set_rules('service_id', 'jenis pelayanan', 'trim|required', messageError());
		$this->form_validation->set_rules('name', 'nama sub pelayanan', 'trim|required', messageError());
		$this->form_validation->set_rules('price', 'harga pelayanan', 'trim|required', messageError());
		$this->form_validation->set_rules('unit', 'unit', 'trim|required', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');

		if ($this->form_validation->run()) {
			$details = new ServiceDetail;
			$details->service_id = $request['service_id'];
			$details->name = $request['name'];
			$details->price = $request['price'];
			$details->unit = $request['unit'];
			$details->save();

			Log::create(
				[
					'user_id' 	=> user()->id,
					'url'		=> fullUrl(),
					'description' => "Membuat harga pelayanan $details->name"
				]
			);
			success('Berhasil menambahkan data harga pelayanan');
			redirect(base_url('service-details'));
		} else {
			$error = getErrorValidation();
			$this->session->set_flashdata('error', $error);
			redirect(base_url('service-details/create'));
		}

	}

	function edit($id)
	{
		access('harga-update', 'redirect');
		$id = encrypt_decrypt('decrypt', $id);
		$details = ServiceDetail::find($id);
		if (!$details) {
			danger('Data harga pelayanan tidak ditemukan');
			redirect(base_url('service-details'),'refresh');
		}

		$services = Service::all();
		$data = [
			'title' => 'Harga Pelayanan',
			'breadcrumb' => 'Ubah Data Harga Pelayanan',
			'details' => $details,
			'services' => $services
		];

		$this->template->load('templates/cms','cms/service-details/edit', $data,FALSE);

	}

	public function update($id)
	{

		access('harga-update', 'redirect');
		$request = $this->input->post();
		$id =  encrypt_decrypt('decrypt', $id);
		$details = ServiceDetail::find($id);

		if (!$details) {
			danger('Data harga pelayanan tidak ditemukan');
			redirect(base_url('service-details'), 'refresh');
		}

		if (!$request) {
			redirect('service-details/edit/'.$id,'refresh');
		}

		$this->form_validation->set_rules('service_id', 'jenis pelayanan', 'trim|required', messageError());
		$this->form_validation->set_rules('name', 'nama sub pelayanan', 'trim|required', messageError());
		$this->form_validation->set_rules('price', 'harga pelayanan', 'trim|required', messageError());
		$this->form_validation->set_rules('unit', 'unit', 'trim|required', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');

		if ($this->form_validation->run()) {
			// $details = new ServiceDetail;
			$details->service_id = $request['service_id'];
			$details->name = $request['name'];
			$details->price = $request['price'];
			$details->unit = $request['unit'];
			$details->save();

			Log::create(
				[
					'user_id' 	=> user()->id,
					'url'		=> fullUrl(),
					'description' => "Mengubah harga pelayanan $details->name"
				]
			);
			success('Berhasil memperbarui data harga pelayanan');
			redirect(base_url('service-details'));
		} else {
			$error = getErrorValidation();
			$this->session->set_flashdata('error', $error);
			redirect(base_url('service-details/edit/'.encrypt_decrypt('encrypt',$id)));
		}

	}

	function destroy($id){
		access('harga-delete', 'redirect');
		$id = encrypt_decrypt('decrypt', $id);
		$details = ServiceDetail::find($id);
		if (!$details) {

			danger('Data harga pelayanan tidak ditemukan');
			redirect(base_url('service-details'),'refresh');
		}

		$details->delete();

		Log::create(
			[
				'user_id' 	=> user()->id,
				'url'		=> fullUrl(),
				'description' => "Menghapus harga pelayanan $details->name"
			]
		);

		success('Berhasil menghapus data harga pelayanan');
		redirect(base_url('service-details'),'refresh');
	}

}
