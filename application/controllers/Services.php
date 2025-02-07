<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

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
		access('pelayanan-read', 'redirect');
		$services = Service::all();
		$data = [
			'title' => 'Pelayanan',
			'breadcrumb' => 'List Pelayanan',
			'services'  => $services,
		];
		$this->template->load('templates/cms','cms/services/index', $data,FALSE);
	}


	public function create()
	{
		access('pelayanan-create', 'redirect');

		$data = [
			'title' => 'Pelayanan',
			'breadcrumb' => 'Tambah Data Pelayanan',
		];

		$this->template->load('templates/cms','cms/services/create', $data,FALSE);
	}

	public function store()
	{
		access('pelayanan-create', 'redirect');

		$request = $this->input->post();
		if (!$request) {
			danger('Data pelayanan tidak ditemukan');
			redirect('services/create','refresh');
		}

		$this->form_validation->set_rules('name', 'nama pelayanan', 'trim|required', messageError());
		$this->form_validation->set_rules('description', 'deskripsi', 'trim|required', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');

		if ($this->form_validation->run()) {
			$services = new Service;
			$services->name = $request['name'];
			$services->description = $request['description'];
			$services->save();

			Log::create(
				[
					'user_id' 	=> user()->id,
					'url'		=> fullUrl(),
					'description' => "Menambahkan pelayanan $services->name"
				]
			);
			success('Berhasil menambahkan data pelayanan');
			redirect(base_url('services'));
		} else {
			$error = getErrorValidation();
			$this->session->set_flashdata('error', $error);
			redirect(base_url('services/create'));
		}

	}

	function edit($id)
	{
		access('pelayanan-update', 'redirect');

		$id = encrypt_decrypt('decrypt', $id);
		$services = Service::find($id);
		if (!$services) {
			danger('Data pelayanan tidak ditemukan');
			redirect(base_url('services'),'refresh');
		}

		$data = [
			'title' => 'Pelayanan',
			'breadcrumb' => 'Ubah Data Pelayanan',
			'services' => $services
		];

		$this->template->load('templates/cms','cms/services/edit', $data,FALSE);

	}

	public function update($id)
	{
		access('pelayanan-update', 'redirect');

		$request = $this->input->post();
		$id =  encrypt_decrypt('decrypt', $id);
		$services = Service::find($id);

		if (!$services) {
			danger('Data pelayanan tidak ditemukan');
			redirect(base_url('services'), 'refresh');
		}

		if (!$request) {
			redirect('services/edit/'.$id,'refresh');
		}


		$this->form_validation->set_rules('name', 'nama pelayanan', 'trim|required', messageError());
		$this->form_validation->set_rules('description', 'deskripsi', 'trim|required', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');

		if ($this->form_validation->run()) {
			// $services = new Service;
			$services->name = $request['name'];
			$services->description = $request['description'];
			$services->save();

			Log::create(
				[
					'user_id' 	=> user()->id,
					'url'		=> fullUrl(),
					'description' => "Mengubah pelayanan $services->name"
				]
			);
			success('Berhasil memperbarui data pelayanan');
			redirect(base_url('services'));
		} else {
			$error = getErrorValidation();
			$this->session->set_flashdata('error', $error);
			redirect(base_url('services/edit/'.encrypt_decrypt('encrypt',$id)));
		}

	}

	function destroy($id){
		access('pelayanan-delete', 'redirect');
		$id = encrypt_decrypt('decrypt', $id);
		$services = Service::find($id);
		if (!$services) {

			danger('Data pelayanan tidak ditemukan');
			redirect(base_url('services'),'refresh');
		}

		$services->delete();

		Log::create(
				[
					'user_id' 	=> user()->id,
					'url'		=> fullUrl(),
					'description' => "Menghapus pelayanan $services->name"
				]
			);

		success('Berhasil menghapus data pelayanan');
		redirect(base_url('services'),'refresh');
	}



}
