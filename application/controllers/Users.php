<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!isLogin()) {
			danger("Anda belum login, silahkan login terlebih dahulu");
			redirect('login');
		}
		$this->load->model('User');
	}

	public function index()
	{
		access('user-create', 'redirect');

		$users = User::all();
		$data = [
			'title' => 'Pengguna',
			'breadcrumb' => 'List Pengguna',
			'users'  => $users,
		];

		$this->template->load('templates/cms','cms/users/index', $data,FALSE);
	}

	function show($id)
	{
		access('user-detail', 'redirect');

		$id = encrypt_decrypt('decrypt', $id);
		$request = $this->input->get();
		// $from = $this->input->get('from');
		// $to = $this->input->get('to');
		$users = User::with(['transaction' => function($query) use ($request){
			if ($request) {
				$query->whereRaw('DATE(created_at) BETWEEN ? AND ?', [$request['from'], $request['to']]);
			}
		}])->find($id);
		if (!$users) {
		   danger("Data pengguna tidak ditemukan");
			redirect('users','refresh');
		}

		$data = [
			'title' => 'Pengguna',
			'breadcrumb' => 'Detail Data Pengguna',
			'users' => $users
		];

		$this->template->load('templates/cms','cms/users/show', $data,FALSE);
	}

	public function create()
	{
		access('user-create', 'redirect');
		$data = [
			'title' => 'Pengguna',
			'breadcrumb' => 'Tambah Data Pengguna',
		];

		$this->template->load('templates/cms','cms/users/create', $data,FALSE);
	}

	public function store()
	{

		access('user-create', 'redirect');
		$request = $this->input->post();
		if (!$request) {
		   danger("Data pengguna tidak ditemukan");
			redirect('users/create','refresh');
		}

		$this->form_validation->set_rules('username', 'username', 'trim|required|is_unique[users.username]', messageError());
		$this->form_validation->set_rules('fullname', 'nama lengkap', 'trim|required', messageError());
		$this->form_validation->set_rules('phone', 'phone', 'trim|required', messageError());
		$this->form_validation->set_rules('role', 'role', 'trim|required', messageError());
		$this->form_validation->set_rules('status', 'status', 'trim|required', messageError());
		$this->form_validation->set_rules('email', 'email', 'trim|valid_email', messageError());
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]', messageError());
		$this->form_validation->set_rules('conf_password', 'konfirmasi password', 'trim|required|matches[password]', messageError());

		if ($_FILES['image']['name'] != '') {
			$this->form_validation->set_rules('image', 'gambar', 'trim|callback_upload_image', messageError());
		}
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');

		if ($this->form_validation->run()) {
			$users = new User;
			$users->fullname = $request['fullname'];
			$users->username = $request['username'];
			$users->phone = $request['phone'];
			$users->email = $request['email'];
			$users->role = $request['role'];
			$users->status = $request['status'];
			$users->password = password_hash($request['password'], PASSWORD_DEFAULT);
			if ($_FILES['image']['name'] != '') {
				$users->image = $this->session->userdata('image');
				$this->session->unset_userdata('image');
			}
			$users->save();


			Log::create(
				[
					'user_id' 	=> user()->id,
					'url'		=> fullUrl(),
					'description' => "Menambahkan pengguna $users->name"
				]
			);
		  success("Berhasil menambahkan data pengguna");
			redirect('users');
		} else {
			$error = getErrorValidation();
			$this->session->set_flashdata('error', $error);
			$this->create();
		}

	}

	function edit($id)
	{
		access('user-update', 'redirect');
		$id = encrypt_decrypt('decrypt', $id);
		$users = User::find($id);
		if (!$users) {
			danger('Data pengguna tidak ditemukan');
			redirect('users','refresh');
		}

		$data = [
			'title' => 'Pengguna',
			'breadcrumb' => 'Ubah Data Pengguna',
			'users' => $users
		];

		$this->template->load('templates/cms','cms/users/edit', $data,FALSE);

	}

	public function update($id)
	{

		access('user-update', 'redirect');
		$request = $this->input->post();
		$id =  encrypt_decrypt('decrypt', $id);
		$users = User::find($id);

		if (!$users) {
			danger('Data pengguna tidak ditemukan');
			redirect('users', 'refresh');
		}

		if (!$request) {
			danger('Data yang dimasukkan tidak valid');

			redirect('users/edit/'.$id,'refresh');
		}


		$is_unique = '';

		if($users->username != $request['username']){
			$is_unique = '|is_unique[users.username]';
		}

		$this->form_validation->set_rules('username', 'Username', 'trim|required'.$is_unique, messageError());
		$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'trim|required', messageError());
		$this->form_validation->set_rules('password', 'Password', 'trim|', messageError());
		$this->form_validation->set_rules('conf_password', 'Konfirmasi Password', 'trim|matches[password]', messageError());
		if ($_FILES['image']['name'] != '') {
			$this->form_validation->set_rules('image', 'gambar', 'trim|callback_upload_image', messageError());
		}
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');

		if ($this->form_validation->run()) {
			// $users = new User;
			$users->fullname = $request['fullname'];
			$users->username = $request['username'];
			$users->status = $request['status'];
			$users->phone = $request['phone'];
			$users->email = $request['email'];
			$users->role = $request['role'];
			if ($request['password']) {
				$users->password = password_hash($request['password'], PASSWORD_DEFAULT);
			}
			if ($_FILES['image']['name'] != '') {
				$users->image = $this->session->userdata('image');
				$this->session->unset_userdata('image');
			}
			$users->save();

			Log::create(
				[
					'user_id' 	=> user()->id,
					'url'		=> fullUrl(),
					'description' => "Mengubah pengguna $user->name"
				]
			);
			success('Berhasil memperbarui data pengguna');
			redirect('users');
		} else {
			$error = getErrorValidation();
			$this->session->set_flashdata('error', $error);
			$this->edit(encrypt_decrypt('encrypt',$id));
		}

	}

	function destroy($id){
		access('user-delete', 'redirect');
		$id = encrypt_decrypt('decrypt', $id);
		$users = User::find($id);
		if (!$users) {
		   danger("Data pengguna tidak ditemukan");
			redirect('users','refresh');
		}

		$users->delete();
	   success("Berhasil menghapus data pengguna");

		Log::create(
			[
				'user_id' 	=> user()->id,
				'url'		=> fullUrl(),
				'description' => "Menghapus pengguna $members->name"
			]
		);

		redirect('users','refresh');
	}

	function upload_image()
	{
		$path = 'uploads/users/';
		if (!is_dir($path)) {
			mkdir($path, 0777, TRUE);
		}
		$path = '/uploads/users/';
		$config['upload_path'] = '.'.$path;
		$config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
		$config['file_name'] = uniqid().'-'.date('y-m-d').'-'.$_FILES['image']['name'];
		$config['overwrite'] = true;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('image')){
			$this->form_validation->set_message('upload_image', $this->upload->display_errors());
			return FALSE;
		}else{
			$ext = explode('.', $this->upload->data('file_name'));
			$ext = end($ext);
			$webp = $this->upload->data('file_name');
			if ($ext != 'webp') {
				$webp = covertToWebp('.'.$path, $this->upload->data('file_name'));
			}
			$file = $this->session->set_userdata('image', $path.$webp);
			return TRUE;
		}
	}


}
