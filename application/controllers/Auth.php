<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$request = $this->input->post();
		if ($request) {
			$this->cekLogin($request);
		}else{
			$data['title'] ="Login";
			$this->load->view('login', $data);
		}
	}

	private function cekLogin($request)
	{
		$username = $request['username'];
		$password = $request['password'];

		$user = User::where('username', $username)->first();
		// var_dump($user);die;
		// dd(password_hash('admin', PASSWORD_DEFAULT));
		if ($user) {
			if (password_verify($password, $user->password)) {
				if ($user->status == 1) {
					$id = encrypt_decrypt('encrypt', $user->id);
					$session = [
						encrypt_decrypt('encrypt', 'id') => $id,
						'session' => uniqid().date("ymdhis").$id
					];

					$this->session->set_userdata('user_session',$session);

					Log::create(
						[
							'user_id' 	=> $user->id,
							'url'		=> fullUrl(),
							'description' => "$user->fullname Telah login"
						]
					);


					redirect('dashboard','refresh');
				}else{
					Log::create(
						[
							// 'user_id' 	=> $user-->id,
							'url'		=> fullUrl(),
							'description' => "Gagal login $user->fullname karena akun tidak aktif"
						]
					);

					danger('Akun anda tidak aktif, silahkan hubungi admin');
					redirect('login','refresh');	
				}
				
			}else{
				Log::create(
					[
						// 'user_id' 	=> $user-->id,
						'url'		=> fullUrl(),
						'description' => "Gagal login dengan username $username & password ".encrypt_decrypt('encrypt', $password)
					]
				);

				danger('Username dan Password tidak sesuai');
				redirect('login','refresh');	
			}
		}else{
			Log::create(
				[
					// 'user_id' 	=> $user-->id,
					'url'		=> fullUrl(),
					'description' => "Gagal login dengan username $username & password ".encrypt_decrypt('encrypt', $password)
				]
			);
			danger('Username dan Password tidak sesuai');
			redirect('login','refresh');
		}

	}

	function forgot()
	{
		$request = $this->input->post();
		if ($request) {
			$this->cekForgot($request);
		}else{
			$data['title'] = "Lupa Password";
			$this->load->view('forgot', $data);
		}
	}

	private function cekForgot($request)
	{
		$web =  json_decode(file_get_contents('setting.json'));
		$user = User::where('email', $request['email'])->first();
		$this->session->unset_userdata('send'); 
		// $send ? unset($send) : '' ;
		$now 				= time();
		if ($user) {
			
			if ($user->expired > date("Y-m-d H:i:s")) {
				info("Reset password telah dikirim ke email $user->email pada ".date('d-m-Y H:i:s', $user->expired - ($web->expired*60)));
				
			}else{
				$token 			= encrypt_decrypt('encrypt', $now.'-'.$user->id);
				$url_forgot = base_url("reset-password/$token");
				$msg = "
					<p>Halo,</p>
				    <p>Kami menerima permintaan Anda untuk reset password Akun. Jika Anda benar-benar ingin melanjutkan, silakan klik tautan di bawah ini:</p>
				    <br>
				    <p><a href='$url_forgot'>Reset Password</a></p>
				    <br>
				    <p>Jika Anda tidak mengajukan permintaan ini atau merasa ini adalah kesalahan, abaikan saja email ini. Kami selalu peduli tentang keamanan akun Anda.</p>
				    <p>Setelah mengklik tautan, Anda akan diminta untuk memasukkan password baru. Pastikan untuk memilih password yang kuat.</p>
				    <p>Terima kasih</p>
				";
				$subject = "Permintaan Reset Password Akun";
				$sendEmail = __sendEmail($user->email, $subject, $msg);
				if ($sendEmail['status']) {
					$expired 			= $now + ($web->expired * 60);
					$expired_formatted 	= date('Y-m-d H:i:s', $expired);
					$user->token 		= $token;
					$user->expired 		= $expired_formatted;
					$user->save();
					success("Reset password telah dikirim ke email $user->email");
					Log::create(
						[
							'url'		=> fullUrl(),
							'description' => "Reset password berhasil dikirim ke $user->email "
						]
					);
				}else{
					danger("Reset password gagal dikirim ke email $user->email");
					Log::create(
						[
							'url'		=> fullUrl(),
							'description' => "Reset password gagal dikirim, ".$sendEmail['msg']
						]
					);
				}
			}
			$this->session->set_userdata('send', true);
			redirect('forgot-password','refresh');
		}else{
			Log::create(
				[
					'url'		=> fullUrl(),
					'description' => "Lupa Password untuk email ".$request['email']." gagal, karena email tidak terdaftar."
				]
			);

			danger($request['email'].' tidak terdaftar disistem');
			redirect('forgot-password','refresh');	
		}
	}

	function reset($token)
	{
		$user 		= User::where('token', $token)->first();
		if (!$user) {
			danger('Token Tidak Valid');
			redirect('forgot-password','refresh');	
			exit();
		}
		$decrypt 	= explode("-", encrypt_decrypt('decrypt', $token));
		$date 		= $decrypt[0]; 
		$id 		= $decrypt[1];
		$now 		= time(); 
		$now 		= date('Y-m-d H:i:s', $now);
		$user 		= User::find($id);
		// var_dump($user->expired, $now);
		if ($user->expired > $now) {
			$request = $this->input->post();
			if ($request) {
				$this->savePassword($request, $token);
			}else{
				$data['title'] = "Reset Password";
				$this->load->view('reset-password', $data);
			}
		}else{
			$data['title'] = "Reset Password Expired";
			$this->load->view('expired-token', $data);
		}
	}

	private function savePassword($request, $token)
	{
		$decrypt 	= explode("-", encrypt_decrypt('decrypt', $token));
		$date 		= $decrypt[0]; 
		$id 		= $decrypt[1];
		$now 		= time(); 
		$now 		= date('Y-m-d H:i:s', $now);
		$user 		= User::find($id);
		if ($request['password'] != $request['password_conf']) {
			danger('Konfirmasi password tidak sesuai');
			redirect('reset-password/'. $token);
			exit();
		}

		if ($request['password'] == '' ||  $request['password_conf'] == '') {
			danger('Password gagal diubah');
			redirect('reset-password/'. $token);
			exit();
		}

		$user->password = password_hash($request['password'], PASSWORD_DEFAULT);
		$user->save();
		success('Password berhasil diubah, silahkan login');
		redirect('login');	
	}

	function logout()
	{
		$this->session->sess_destroy();
		success('Anda telah keluar');
		redirect('login','refresh');
	}

	function account()
	{
		if (!isLogin()) {
			danger("Anda belum login, silahkan login terlebih dahulu");
			redirect('login');
		}
		$user = user();
		$data = [
			'title' => 'Profile',
			'breadcrumb' => 'Profile',
			'user'  => $user,
		];

		$this->template->load('templates/cms','cms/profile', $data,FALSE);
	}

	function updateProfile()
	{
		if (!isLogin()) {
			danger("Anda belum login, silahkan login terlebih dahulu");
			redirect('login');
		}
		
		$request = $this->input->post();
		// dd($request);
		$user = user();

		if ($request['password'] || $request['old'] || $request['conf']) {
			if (!password_verify($request['old'], $user->password)) {
				danger('Password lama tidak sesuai');
				redirect('profile');
				exit();
			}
			if ($request['password'] != $request['conf']) {
				danger('Konfirmasi password tidak sesuai');
				redirect('profile');
				exit();
			}

			if ($request['password'] == '' || $request['old'] == '' || $request['conf'] == '') {
				danger('Password gagal diubah');
				redirect('profile');
				exit();
			}

			$user->password = password_hash($request['password'], PASSWORD_DEFAULT);
		}else{
			if ($request['fullname'] == '' || $request['username'] == '') {
				danger('Data profile gagal diubah');
				redirect('profile');
				exit();
			}

			$cekUsername = User::where('id', '!=', $user->id)->where('username', $request['username'])->first()->username;
			if ($cekUsername) {
				danger('Username sudah tidak tersedia');
				redirect('profile');
				exit();	
			}

			$user->fullname = $request['fullname'];
			$user->username = $request['username'];
		}

		$user->save();
		success('Data profile berhasil diperbarui');
		redirect('profile');	
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */ ?>