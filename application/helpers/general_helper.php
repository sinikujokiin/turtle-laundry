<?php 
if (!function_exists('getErrorValidation')) {
	function getErrorValidation()
	{
		$CI = &get_instance();

		$forms = $CI->input->post();
		// var_dump($forms);die;
		$response = [];
		foreach ($forms as $key => $value) {
			if ($key != 'id') {
				$response[$key] = form_error($key);
			}
		}
		return $response;
	}
}

if (!function_exists('buatkode')) {
	function buatKode($nomor_terakhir, $kunci, $jumlah_karakter = 0)
    {
        /*mencari nomor baru dengan nomor terakhir dan menambahkan
        1 string nomor baru dibawah uni harus dengan format XXX000000
        untuk penggunaan dalam format lain harus disesuaikan sendiri */
        $nomor_baru = intval(substr($nomor_terakhir, strlen($kunci))) + 1;
        //menambahkan nol didepan nomor baru sesuai panjang jumlah karakter
        $nomor_baru_plus_nol = str_pad($nomor_baru, $jumlah_karakter, "0", STR_PAD_LEFT);
        //menyusun kunci dan nomor baru
        $kode = $kunci . $nomor_baru_plus_nol;
        return $kode;
    }

}

if (!function_exists('encrypt_decrypt')) {
	function encrypt_decrypt($action, $msg) {

		$output = false;
	    $encrypt_method = "AES-256-CBC";
	    $secret_key = '8e533017eece636e51fbd71caf768c6eebd3e018';
	    $secret_iv = 'https://ourporto.com';
	    // hash
	    $key = hash('sha256', $secret_key);

	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);
	    if ($action == 'encrypt'){
	        $output = openssl_encrypt($msg, $encrypt_method, $key, 0, $iv);
	        $output = base64_encode($output);
	    } else if($action == 'decrypt') {
	        $output = openssl_decrypt(base64_decode($msg), $encrypt_method, $key, 0, $iv);
	    }
	    return $output;
	}

}

if (!function_exists('date_format_indo')) {
	function date_format_indo($date){
        if($date != '0000-00-00'){
            $date = explode('-', $date);
  
            $data = $date[2] . ' ' . month($date[1]) . ' '. $date[0];
        }else{
            $data = 'Format tanggal salah';
        }
  
        return $data;
    }
  
}


if (!function_exists('day')) {
	function day($day){
 
		switch($day){
			case 'Sun':
				$day = "Minggu";
			break;
	 
			case 'Mon':			
				$day = "Senin";
			break;
	 
			case 'Tue':
				$day = "Selasa";
			break;
	 
			case 'Wed':
				$day = "Rabu";
			break;
	 
			case 'Thu':
				$day = "Kamis";
			break;
	 
			case 'Fri':
				$day = "Jumat";
			break;
	 
			case 'Sat':
				$day = "Sabtu";
			break;
			
			default:
				$day = "Tidak di ketahui";		
			break;
		}
	 
		return $day;
	 
	}
}

if (!function_exists('month')) {
	function month($month) {
  
        switch ($month) {
            case 1:
                $month = "Januari";
                break;
            case 2:
                $month = "Februari";
                break;
            case 3:
                $month = "Maret";
                break;
            case 4:
                $month = "April";
                break;
            case 5:
                $month = "Mei";
                break;
            case 6:
                $month = "Juni";
                break;
            case 7:
                $month = "Juli";
                break;
            case 8:
                $month = "Agustus";
                break;
            case 9:
                $month = "September";
                break;
            case 10:
                $month = "Oktober";
                break;
            case 11:
                $month = "November";
                break;
            case 12:
                $month = "Desember";
                break;
        }
        return $month;
    }

}

if (!function_exists('covertToWebp')) {
    function covertToWebp($url = null, $file = null)
    {
    	$slug = explode(".", $file);
		$ext = $slug[1];
		if ($ext === 'jpg' || $ext === 'jpeg') {
		    $im = imagecreatefromjpeg($url.$file);
		    $output = $url.$slug[0].'.webp';
		    $webp = imagewebp($im, $output, 70);
		} elseif ($ext === 'png') {
		    $im = imagecreatefrompng($url.$file);
		    imagepalettetotruecolor($im);

		    imageAlphaBlending($im, true); // alpha channel
		    imageSaveAlpha($im, true); // save alpha setting

			$output = $url.$slug[0].'.webp';
		    $webp = imagewebp($im, $output);
		}
		unlink($url.$file);
		imagedestroy($im);

		return $slug[0].'.webp';
    }

}


if (!function_exists('messageError')) {
	function messageError()
	{
		$error =[
			'required' 			=> '%s tidak boleh kosong',
			// 'trim' => '%s tidak sesuai format',
			'numeric' 			=> '%s harus berisi angka',
			'valid_email' 		=> 'format %s tidak valid',
			'is_unique' 		=> '%s sudah terdaftar',
			'min_length' 		=> '%s minimal %s karakter',
			'max_length' 		=> '%s maksimal %s karakter',
			'exact_length' 		=> 'panjang %s harus %s karakter',
			'valid_ip' 			=> '%s tidak valid',
			'in_list'			=> '%s tidak termasuk dalam list',
			// 'alpha_special' 	=> '%s tidak sesuai format',
			'alpha_numeric' 	=> '%s hanya karakter dan angka',
			'alpha_numeric' 	=> '%s hanya karakter dan angka',
			'numeric_spaces' 	=> '%s hanya karakter, angka dan spasi',
			'alpha_dash' 		=> '%s hanya karakter, angka, spasi, underscores(_) dan strip(-)',
			'matches'			=> '%s tidak sesuai dengan %s'
		];

		return $error;
	}
}


if (!function_exists('user')) {
	function user()
	{
		$CI = &get_instance();
		$session = $CI->session->userdata('user_session');
		if ($session) {
			$sess_id = encrypt_decrypt("encrypt", 'id');
			$id = encrypt_decrypt('decrypt',$session[$sess_id]);

			$user = User::find($id);

			return $user;
			exit();	
		}
	}
}

if (!function_exists('isLogin')) {
	function isLogin()
	{
		$CI = &get_instance();
		$session = $CI->session->userdata('user_session');
		if ($session) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if (!function_exists('success')) {
	function success($msg)
	{
		$CI = &get_instance();
		$CI->session->set_flashdata('alert', '
			<div class="alert alert-success d-flex align-items-center" role="alert">
			<i class="fa fa-check-circle"></i>
			  <div >
			   '.$msg.'
			  </div>
			</div>
			');
	}
}
if (!function_exists('danger')) {
	function danger($msg)
	{
		$CI = &get_instance();
		$CI->session->set_flashdata('alert', '
			<div class="alert alert-danger d-flex align-items-center" role="alert">
			<i class="bi bi-exclamation-octagon-fill"></i>	
			  <div >
			   '.$msg.'
			  </div>
			</div>
			');
		return $CI->session->userdata('alert');
	}
}
if (!function_exists('info')) {
	function info($msg)
	{
		$CI = &get_instance();
		$CI->session->set_flashdata('alert', '
			<div class="alert alert-info d-flex align-items-center" role="alert">
			<i class="fa fa-check-circle"></i>
			  <div >
			   '.$msg.'
			  </div>
			</div>
			');
	}
}

if (!function_exists('fullUrl')) {
	function fullUrl()
	{
		$ci = get_instance();
		$segs = $ci->uri->segment_array();
		$totalSegs = count($segs);
		$link = '';
		if ($segs) {
			for ($i = 1; $i <= $totalSegs; $i++) {
			    if ($segs[$i] === $segs[$totalSegs]) {
			        $link .= $segs[$i];
			    } else {
			        $link .= $segs[$i] . "/";
			    }
			}
		}

		return $link;
	}
}


if (!function_exists("access")) {
	function access($access, $isredirect = null){
		$role = user()->role;
		$list =  json_decode(file_get_contents('access.json'));
		$list = get_object_vars($list);

		$seacrh = array_search($access, $list[$role]);
		if ($seacrh || strval($seacrh) == '0') {
			return true;
		}else{
			if ($isredirect) {
				redirect('403','refresh');
			}else{
				return false;
			}
		} 
	}	

}

function __sendEmail($to, $subject, $msg)
{
	$web =  json_decode(file_get_contents('setting.json'));
	$ci = get_instance(); //buat manggil ci

	$config = array(
	  'protocol' => 'smtp',
	  'smtp_host' => 'ssl://smtp.googlemail.com',
	  'smtp_port' => 465,
	  'smtp_user' => $web->email,
	  'smtp_pass' => $web->password,
	  'mailtype' => 'html',
	  'charset' => 'utf-8',
	  'newline' => "\r\n"
	);
	$ci->load->library('email', $config);
	$ci->email->initialize($config);

	$ci->email->from('luthfi.ihdalhusnayain98@gmail.com', $web->name);
	$ci->email->to($to);
	$ci->email->subject($subject);
	$ci->email->message($msg);

	if ($ci->email->send()) {
		return ['status' => true];
    } else {
		return ['status' => false, 'msg' => $ci->email->print_debugger()];
    }
}


 ?>