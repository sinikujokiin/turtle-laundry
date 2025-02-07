<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

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
		access('setting', 'redirect');
		$setting =  json_decode(file_get_contents('setting.json'));
		$data = [
			'title' => 'Pengaturan',
			'breadcrumb' => 'Pengaturan Website',
			'setting'  => $setting,
		];
		$this->template->load('templates/cms','cms/setting', $data,FALSE);
	}

	function store()
	{
		access('setting', 'redirect');
		$request = $this->input->post();
		if ($_FILES['icon']['name'] != '') {
			$this->form_validation->set_rules('icon', 'Icon', 'trim|callback_upload_icon', messageError());
		}

		if ($_FILES['logo']['name'] != '') {
			$this->form_validation->set_rules('logo', 'Logo', 'trim|callback_upload_logo', messageError());
		}
		$this->form_validation->set_rules('name', 'Nama Website', 'trim|xss_clean|required', messageError());
		$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|required|valid_email', messageError());
		$this->form_validation->set_rules('phone', 'No Telepon', 'trim|required|xss_clean|numeric', messageError());
		$this->form_validation->set_rules('address', 'Alamat', 'trim|required|xss_clean', messageError());
		if ($this->form_validation->run()) {
			$setting =  json_decode(file_get_contents('setting.json'));
			$request['icon'] = $setting->icon;
			$request['logo'] = $setting->logo;

			if ($_FILES['icon']['name'] != '') {
				$request['icon'] = $this->session->userdata('icon');
				$this->session->unset_userdata('icon');
			}

			if ($_FILES['logo']['name'] != '') {
				$request['logo'] = $this->session->userdata('logo');
				$this->session->unset_userdata('logo');
			}

			$data = json_encode($request);
			file_put_contents('setting.json', $data);

			Log::create(
				[
					'user_id' 	=> user()->id,
					'url'		=> fullUrl(),
					'description' => "Memperbarui pengaturan website"
				]
			);

			success('Berhasil memperbarui data Website');
		} else {
			$error = getErrorValidation();
			$error['icon'] = strip_tags(form_error('icon'));
			$error['logo'] = strip_tags(form_error('logo'));

			if (form_error('icon') && $_FILES['icon']['name']) {
				unlink($this->session->userdata('icon'));
			}

			if (form_error('logo') && $_FILES['logo']['name']) {
				unlink($this->session->userdata('logo'));
			}
			$this->session->set_flashdata('error', $error);
		}
		redirect(base_url('setting'));


	}

	function upload_icon()
	{
		$path = '/uploads/';
		if (!is_dir($path)) {
			mkdir($path, 0777, TRUE);
		}
		$config['upload_path'] = '.'.$path;
		$config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
		$config['file_name'] = uniqid().'-'.date('y-m-d').'-'.$_FILES['icon']['name'];
		$config['overwrite'] = true;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('icon')){
			$this->form_validation->set_message('upload_icon', $this->upload->display_errors());
			return FALSE;
		}else{
			$ext = explode('.', $this->upload->data('file_name'));
			$ext = end($ext);
			$webp = $this->upload->data('file_name');
			if ($ext != 'webp') {
				$webp = covertToWebp('.'.$path, $this->upload->data('file_name'));
			}
			$file = $this->session->set_userdata('icon', $path.$webp);
			return TRUE;
		}
	}
	function upload_logo()
	{
		$path = '/uploads/';
		if (!is_dir($path)) {
			mkdir($path, 0777, TRUE);
		}
		$config['upload_path'] = '.'.$path;
		$config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
		$config['file_name'] = uniqid().'-'.date('y-m-d').'-'.$_FILES['logo']['name'];
		$config['overwrite'] = true;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('logo')){
			$this->form_validation->set_message('upload_logo', $this->upload->display_errors());
			return FALSE;
		}else{
			$ext = explode('.', $this->upload->data('file_name'));
			$ext = end($ext);
			$webp = $this->upload->data('file_name');
			if ($ext != 'webp') {
				$webp = covertToWebp('.'.$path, $this->upload->data('file_name'));
			}
			$file = $this->session->set_userdata('logo', $path.$webp);
			return TRUE;
		}
	}

	function access()
	{
		access('access', 'redirect');
		$access =  json_decode(file_get_contents('access.json'));
		$access = get_object_vars($access);

		$data = [
			'title' => 'Pengaturan Akses',
			'breadcrumb' => 'Pengaturan Akses Website',
			'access'  => $access,
		];
		$this->template->load('templates/cms','cms/access', $data,FALSE);

	}

	function saveAccess()
	{
		access('access', 'redirect');
		
		$owner = $this->input->post('access-owner');
		$staff = $this->input->post('access-staff');
		$all = $this->input->post('access-all');

		$access = [];
		foreach ($all as $key => $value) {
			if (isset($owner[$key])) {
				$access['Owner'][] = $value;
			}
			if (isset($staff[$key])) {
				$access['Staff'][] = $staff[$key];
			}
			$access['all'][] = $value;
		}
		$data = json_encode($access);
		file_put_contents('access.json', $data);

		Log::create(
			[
				'user_id' 	=> user()->id,
				'url'		=> fullUrl(),
				'description' => "Memperbarui pengaturan hak akses"
			]
		);

		success('Berhasil memperbarui hak akses Website');
		redirect(base_url('setting/access'));

	}

}

/* End of file Setting.php */
/* Location: ./application/controllers/Setting.php */ ?>