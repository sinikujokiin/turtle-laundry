<?php $web =  json_decode(file_get_contents('setting.json')); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="<?= base_url($web->icon) ?>">
		<title><?= $web->name ?> - Log in </title>
		
		<!-- Vendors Style-->
		<link rel="stylesheet" href="<?= base_url('assets') ?>/css/vendors_css.css">
		
		<!-- Style-->
		<link rel="stylesheet" href="<?= base_url('assets') ?>/css/style.css">
		<link rel="stylesheet" href="<?= base_url('assets') ?>/css/skin_color.css">
	</head>
	
	<body class="hold-transition theme-primary bg-img" style="background-color: #56cc99;">
		
		<div class="container h-p100">
			<div class="row align-items-center justify-content-md-center h-p100">
				
				<div class="col-12">
					<div class="row justify-content-center g-0">
						<div class="col-lg-5 col-md-5 col-12">
							<div class="bg-white rounded10 shadow-lg">
								<div class="content-top-agile p-20 pb-0">
									<h2 class="text-primary"><?= $web->name ?></h2>
									
								</div>
								<div class="p-20">
									<div class="alert alert-danger d-flex align-items-center" role="alert">
									<i class="bi bi-exclamation-octagon-fill"></i>	
									  <div >
									  	Permintaan Reset Password Telah Expired
									  </div>
									</div>
									<a href="<?= base_url('forgot-password') ?>" class="btn btn-primary">Kembali Kehalaman Lupa Password</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Vendor JS -->
		<script src="<?= base_url('assets') ?>/js/vendors.min.js"></script>
		<script src="<?= base_url('assets') ?>/js/pages/chat-popup.js"></script>
		<script src="../assets/icons/feather-icons/feather.min.js"></script>
	</body>
</html>