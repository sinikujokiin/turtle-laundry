<?php $web =  json_decode(file_get_contents('setting.json')); $uri1 = $this->uri->segment(1); $uri2 = $this->uri->segment(2) ?>
<!DOCTYPE html>
<html lang="en">
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="<?= base_url($web->icon) ?>">
		<title><?= $web->name ?> - <?= $title ?></title>
		
		<!-- Vendors Style-->
		<link rel="stylesheet" href="<?= base_url('assets') ?>/css/vendors_css.css">
		
		<!-- Style-->
		<link rel="stylesheet" href="<?= base_url('assets') ?>/css/style.css">
		<link rel="stylesheet" href="<?= base_url('assets') ?>/css/skin_color.css">
		
		<!-- Vendor JS -->
		<script src="<?= base_url('assets') ?>/js/vendors.min.js"></script>
		<script src="<?= base_url('assets') ?>/js/pages/chat-popup.js"></script>
		<script src="<?= base_url('assets') ?>/icons/feather-icons/feather.min.js"></script>
		<script src="<?= base_url('assets') ?>/vendor_components/datatable/datatables.min.js"></script>
		<script>
			var base_url = `<?= base_url()?>`
		</script>
	</head>
	<body class="hold-transition light-skin sidebar-mini theme-primary fixed">
		
		<div class="wrapper">
			<div id="loader"></div>
			
			<header class="main-header">
				<div class="d-flex align-items-center logo-box justify-content-start">
					<a href="#" class="waves-effect waves-light nav-link d-none d-md-inline-block mx-10 push-btn bg-transparent" data-toggle="push-menu" role="button">
						<span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
					</a>
					<!-- Logo -->
					<a href="<?= base_url('') ?>" class="logo">
						<!-- logo-->
						<div class="logo-lg">
							<h3><?= $web->name ?></h3>
							<!-- <span class="light-logo"><img src="<?= base_url('assets') ?>/images/logo-dark-text.png" alt="logo"></span> -->
							<!-- <span class="dark-logo"><img src="<?= base_url('assets') ?>/images/logo-light-text.png" alt="logo"></span> -->
						</div>
					</a>
				</div>
				<!-- Header Navbar -->
				<nav class="navbar navbar-static-top">
					<!-- Sidebar toggle button-->
					<div class="app-menu">
						<ul class="header-megamenu nav">
							<li class="btn-group nav-item d-md-none">
								<a href="#" class="waves-effect waves-light nav-link push-btn" data-toggle="push-menu" role="button">
									<span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
							    </a>
							</li>
							<li class="btn-group nav-item d-lg-inline-flex d-none">
								<a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link full-screen" title="Full Screen">
									<i class="icon-Expand-arrows"><span class="path1"></span><span class="path2"></span></i>
								</a>
							</li>
						</ul>
					</div>
					
					<div class="navbar-custom-menu r-side">
						<ul class="nav navbar-nav">
							
							<li class="btn-group d-lg-inline-flex d-none">
								<div class="app-menu">
								</div>
							</li>
							<!-- Notifications -->
							
							<!-- User Account-->
							<li class="dropdown user user-menu">
								<a href="#" class="waves-effect waves-light dropdown-toggle" data-bs-toggle="dropdown" title="User">
									<i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
								</a>
								<ul class="dropdown-menu animated flipInX">
									<li class="user-body">
										<a class="dropdown-item" href="<?= base_url('account') ?>"><i class="ti-user text-muted me-2"></i> Profile</a>
										<?php if (access('setting')): ?>
											
										<a class="dropdown-item" href="<?= base_url('setting') ?>"><i class="ti-settings text-muted me-2"></i> Settings</a>
										<?php endif ?>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="ti-lock text-muted me-2"></i> Logout</a>
									</li>
								</ul>
							</li>
							
						</ul>
					</div>
				</nav>
			</header>
			
			<aside class="main-sidebar">
				<!-- sidebar-->
				<section class="sidebar position-relative">
					<div class="multinav">
						<div class="multinav-scroll" style="height: 100%;">
							<!-- sidebar menu-->
							<ul class="sidebar-menu" data-widget="tree">
								<li class="header">Dashboard & Apps</li>
								<?php if (access('dashboard-read')): ?>
									<li class="<?= $uri1 == 'dashboard' ? 'active' : ''  ?>"><a href="<?= base_url('dashboard') ?>"><i class="icon-Home"><span class="path1"></span><span class="path2"></span></i>Dashboard</a></li>
								<?php endif ?>
								<?php if (access('main-masterdata')): ?>
								<li class="treeview">
									<a href="#">
										<i class="icon-Library"><span class="path1"></span><span class="path2"></span></i>
										<span>Master Data</span>
										<span class="pull-right-container">
											<i class="fa fa-angle-right pull-right"></i>
										</span>
									</a>
									<ul class="treeview-menu <?= $uri1 == 'services' || $uri1 == 'service-details' || $uri1 == 'members' || $uri1 == 'users' ? 'active menu-open' : ''  ?>">
										<?php if (access('pelayanan-read')): ?>
											<li class="<?= $uri1 == "services" ? 'active' : '' ?>"><a href="<?= base_url('services') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pelayanan</a></li>
										<?php endif ?>
										<?php if (access('harga-read')): ?>
											<li class="<?= $uri1 == "service-details" ? 'active' : '' ?>"><a href="<?= base_url('service-details') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Harga Pelayanan</a></li>
										<?php endif ?>
										<?php if (access('member-read')): ?>
											<li class="<?= $uri1 == "members" ? 'active' : '' ?>"><a href="<?= base_url('members') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Member</a></li>
										<?php endif ?>
										<?php if (access('user-read')): ?>
											<li class="<?= $uri1 == "users" ? 'active' : '' ?>"><a href="<?= base_url('users') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pengguna</a></li>
										<?php endif ?>
									</ul>
								</li>
								<?php endif ?>

								<?php if (access('main-transaksi')): ?>
								<li class="treeview">
									<a href="#">
										<i class="icon-File"><span class="path1"></span><span class="path2"></span></i>
										<span>Transaksi</span>
										<span class="pull-right-container">
											<i class="fa fa-angle-right pull-right"></i>
										</span>
									</a>
									<ul class="treeview-menu <?= $uri1 == 'transactions' || $uri1 == 'report-transactions' ? 'active menu-open' : ''  ?>">
										<?php if (access('transaksi-create')): ?>
											<li class="<?= $uri1.'/'.$uri2 == 'transactions/create' ? 'active' : ''   ?>"><a href="<?= base_url('transactions/create') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Buat Transaksi</a></li>
										<?php endif ?>
										<?php if (access('transaksi-read')): ?>
											<li class="<?= $uri1 == 'transactions' ? 'active' : ''  ?>"><a href="<?= base_url('transactions') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Daftar Transaksi</a></li>
										<?php endif ?>
										<?php if (access('transaksi-report')): ?>
											<li class="<?= $uri1 == 'report-transactions' ? 'active' : ''  ?>"><a href="<?= base_url('report-transactions') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Laporan Transaksi</a></li>
										<?php endif ?>
									</ul>
								</li>
								<?php endif ?>
								<?php if (access('log')): ?>
									<li class="<?= $uri1 == 'logs' ? 'active' : ''  ?>"><a href="<?= base_url('logs') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Logs</a></li>
								<?php endif ?>
							</ul>
						</div>
					</div>
				</section>
				<?php if (access('setting')): ?>
				<div class="sidebar-footer">
						<a href="<?= base_url('setting') ?>" class="link" data-bs-toggle="tooltip" title="Settings"><span class="icon-Settings-2"></span></a>
					<a href="<?= base_url('account')  ?>" class="link" data-bs-toggle="tooltip" title="Profil"><span class="fa fa-user"></span></a>
					<a href="<?= base_url('logout') ?>" class="link" data-bs-toggle="tooltip" title="Logout"><span class="icon-Lock-overturning"><span class="path1"></span><span class="path2"></span></span></a>
				</div>
				<?php endif ?>
			</aside>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<?= $contents ?>
			</div>
			<!-- /.content-wrapper -->
			<footer class="main-footer">
				&copy; 2023 <a href="<?= base_url() ?>"><?= $web->name ?></a>. All Rights Reserved.
			</footer>
			
		</div>
		<!-- ./wrapper -->
		
	
			
			<!-- Page Content overlay -->
			
			<!-- E-Absensi App -->
			<script src="<?= base_url('assets') ?>/js/template.js"></script>
			<script type="text/javascript">
				function showModalDelete (_data) {
					var type = $(_data).data('type')
					var href = $(_data).data('href')
					if (confirm(`Apakah Anda yakin ingin mneghapus data ${type}`)) {
						window.location.href=href
					}
				}
			</script>
		</body>
	</html>