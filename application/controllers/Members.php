<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!isLogin()) {
			danger("Anda belum login, silahkan login terlebih dahulu");
			redirect('login');
		}
		$this->load->model('Member');
	}

	public function index()
	{
		access('member-read', 'redirect');
		$members = Member::all();
		$data = [
			'title' => 'Member',
			'breadcrumb' => 'List Member',
			'members'  => $members,
		];
		$this->template->load('templates/cms','cms/members/index', $data,FALSE);
	}

	function show($id)
	{
		access('member-detail', 'redirect');
		$id = encrypt_decrypt('decrypt', $id);
		$request = $this->input->get();
		// $from = $this->input->get('from');
		// $to = $this->input->get('to');
		$members = Member::with(['transaction' => function($query) use ($request){
			if ($request) {
				$query->whereRaw('DATE(created_at) BETWEEN ? AND ?', [$request['from'], $request['to']]);
			}
		}])->find($id);
		if (!$members) {
			danger('Data member tidak ditemukan');
			redirect(base_url('members'),'refresh');
		}

		// var_dump($members->toArray());die;


		$data = [
			'title' 		=> 'Riwayat Member',
			'breadcrumb' 	=> 'Detail Data Member',
			'members' 		=> $members,
		];


		$this->template->load('templates/cms','cms/members/show', $data,FALSE);
	}

	public function create()
	{
		access('member-create', 'redirect');
		$data = [
			'title' => 'Member',
			'breadcrumb' => 'Tambah Data Member',
		];

		$this->template->load('templates/cms','cms/members/create', $data,FALSE);
	}

	public function store()
	{

		access('member-create', 'redirect');
		$request = $this->input->post();
		if (!$request) {
			danger('Data member tidak ditemukan');
			redirect('members/create','refresh');
		}

		$this->form_validation->set_rules('name', 'nama member', 'trim|required', messageError());
		$this->form_validation->set_rules('address', 'alamat', 'trim|required', messageError());
		$this->form_validation->set_rules('phone', 'no telepon', 'trim|required|numeric|min_length[10]|max_length[15]', messageError());
		$this->form_validation->set_rules('email', 'email', 'trim|valid_email', messageError());
		$this->form_validation->set_rules('gender', 'jenis kelamin', 'trim|required', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');

		if ($this->form_validation->run()) {
			$members = new Member;
			$members->name = $request['name'];
			$members->email = $request['email'];
			$members->phone = $request['phone'];
			$members->address = $request['address'];
			$members->gender = $request['gender'];
			$members->save();

			Log::create(
				[
					'user_id' 	=> user()->id,
					'url'		=> fullUrl(),
					'description' => "Menambahkan member $members->name"
				]
			);

			success('Berhasil menambahkan data member');
			redirect(base_url('members'));
		} else {
			$error = getErrorValidation();
			$this->session->set_flashdata('error', $error);
			redirect(base_url('members/create'));
		}

	}

	function edit($id)
	{
		access('member-update', 'redirect');
		$id = encrypt_decrypt('decrypt', $id);
		$members = Member::find($id);
		if (!$members) {
			danger('Data member tidak ditemukan');
			redirect(base_url('members'),'refresh');
		}

		$data = [
			'title' => 'Member',
			'breadcrumb' => 'Ubah Data Member',
			'members' => $members
		];

		$this->template->load('templates/cms','cms/members/edit', $data,FALSE);

	}

	public function update($id)
	{

		access('member-update', 'redirect');
		$request = $this->input->post();
		$id =  encrypt_decrypt('decrypt', $id);
		$members = Member::find($id);

		if (!$members) {
			danger('Data member tidak ditemukan');
			redirect(base_url('members'), 'refresh');
		}

		if (!$request) {
			redirect('members/edit/'.$id,'refresh');
		}


		$this->form_validation->set_rules('name', 'nama member', 'trim|required', messageError());
		$this->form_validation->set_rules('address', 'alamat', 'trim|required', messageError());
		$this->form_validation->set_rules('phone', 'no telepon', 'trim|required|numeric|min_length[10]|max_length[15]', messageError());
		$this->form_validation->set_rules('email', 'email', 'trim|valid_email', messageError());
		$this->form_validation->set_rules('gender', 'jenis kelamin', 'trim|required', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');

		if ($this->form_validation->run()) {
			// $members = new Service;
			$members->name = $request['name'];
			$members->email = $request['email'];
			$members->phone = $request['phone'];
			$members->address = $request['address'];
			$members->gender = $request['gender'];
			$members->save();

			Log::create(
				[
					'user_id' 	=> user()->id,
					'url'		=> fullUrl(),
					'description' => "Mengubah member $members->name"
				]
			);
			success('Berhasil memperbarui data member');
			redirect(base_url('members'));
		} else {
			$error = getErrorValidation();
			$this->session->set_flashdata('error', $error);
			redirect(base_url('members/edit/'.encrypt_decrypt('encrypt',$id)));
		}

	}

	function destroy($id){
		access('member-delete', 'redirect');
		$id = encrypt_decrypt('decrypt', $id);
		$members = Member::find($id);
		if (!$members) {

			danger('Data member tidak ditemukan');
			redirect(base_url('members'),'refresh');
		}

		$members->delete();
		Log::create(
			[
				'user_id' 	=> user()->id,
				'url'		=> fullUrl(),
				'description' => "menghapus member $members->name"
			]
		);
		success('Berhasil menghapus data member');
		redirect(base_url('members'),'refresh');
	}



}
