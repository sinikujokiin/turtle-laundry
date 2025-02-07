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
									<h4>Lupa Kata Sandi</h4>
									
								</div>
								<?php if ($this->session->flashdata('alert')): ?>
					        		<?= $this->session->flashdata('alert'); ?>
					        	<?php endif ?>
								<div class="p-20">
									<form  method="post">
										<p class="mb-0">Masukkan email yang terdaftar</p>
										<div class="form-group">
											<div class="input-group mb-3">
												<span class="input-group-text bg-transparent"><i class="ti-email"></i></span>
												<input type="email" name="email" id="email" class="form-control ps-15 bg-transparent" placeholder="Email">
											</div>
										</div>
										<div class="row">
											<!-- /.col -->
											<div class="col-12 text-center">
												<button type="submit" class="btn btn-success mt-10">Send Reset Password</button>
											</div>
											<!-- /.col -->
										</div>
									</form>
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