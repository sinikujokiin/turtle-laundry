<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

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
		access('transaksi-report', 'redirect');
		$request = $this->input->get();
		$data = [
			'title' => 'Laporan Transaksi',
			'breadcrumb' => 'Data Laporan Transaksi',
		];
		if ($request) {
			$data['reports'] = $this->getDataReport($request);	
			// var_dump($data['reports']);die();
		}
		$this->template->load('templates/cms','cms/reports/index', $data,FALSE);
	}

	private function getDataReport($request)
	{
		$diterima = 0;
		$diproses = 0;
		$dicuci = 0;
		$siapdiambil = 0;
		$sudahdiambil = 0;
		$belumdibayar = 0;
		$sudahdibayar = 0;
		$allIncome = 0;
		$incomedelay = 0;
		$income = 0;
		$report = new Transaction;

		if ($request['from'] && $request['to']) {
			$report = Transaction::whereRaw('DATE(created_at) BETWEEN ? AND ?', [$request['from'], $request['to']])->orderBy('created_at', 'desc')->get();
		}
		if ($request['from'] && !$request['to']) {
			$report = Transaction::whereDate('created_at','>=', $request['from'])->orderBy('created_at', 'desc')->get();
		}
		if (!$request['from']) {
			$report = Transaction::whereDate('created_at','<=', $request['to'])->orderBy('created_at', 'desc')->get();
		}
		// var_dump($report);die;
		foreach ($report as $value) {
			switch ($value->status) {
				case 'diterima':
					$diterima += 1;
					break;
				case 'diproses':
					$diproses += 1;
					break;
				case 'dicuci':
					$dicuci += 1;
					break;
				case 'siap diambil':
					$siapdiambil += 1;
					break;
				case 'sudah diambil':
					$sudahdiambil += 1;
					break;
			}

			switch ($value->payment_status) {
				case 'belum dibayar':
					$belumdibayar += 1;
					$incomedelay += $value->total;
					break;
				case 'sudah dibayar':
					$sudahdibayar += 1;
					$income += $value->total;
					break;
			}
			$allIncome += $value->total;
		}
		$reports = [
			'count_transactions' => count($report),
			'status'	=> [
				'diterima' 		=> $diterima,
				'diproses' 		=> $diproses,
				'dicuci' 		=> $dicuci,
				'siapdiambil' 	=> $siapdiambil,
				'sudahdiambil' 	=> $sudahdiambil,
				'sudahdibayar' 	=> $sudahdibayar,
				'belumdibayar' 	=> $belumdibayar,
			],
			'allIncome' => $allIncome,
			'incomedelay' => $incomedelay,
			'income' => $income,
			'count_members'	=> Member::count(),
			'transactions' => $report
		];
		return $reports;
	}

	function pdf()
	{
		$this->load->library('Pdf');
		
		$date = $this->input->get('date');
		$date = encrypt_decrypt('decrypt', $date);
		$from = explode("|", $date)[0];
		$to = explode("|", $date)[1];

		$request = ['from' => $from, 'to' => $to];
		$data = [
			'title' => 'Laporan Transaksi',
			'breadcrumb' => 'Data Laporan Transaksi',
		];
		$data['reports'] = $this->getDataReport($request);

		$html = $this->load->view('cms/reports/pdf', $data, true);
		$this->pdf->createPDF($html, $data['title'], false, 'A4', 'landscape');

	}



}

/* End of file Reports.php */
/* Location: ./application/controllers/Reports.php */ ?>