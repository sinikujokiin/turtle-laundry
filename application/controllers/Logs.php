<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {

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
		access('log', 'redirect');
		$data = [
			'title' => 'Log',
			'breadcrumb' => 'Catatan Aktifitas',
			'logs' => Log::with('user')->latest()->get()
		];

		$this->template->load('templates/cms','cms/logs', $data,FALSE);
	}

}

/* End of file Logs.php */
/* Location: ./application/controllers/Logs.php */ ?>