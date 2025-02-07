<div class="content-header">
	<div class="d-flex align-items-center">
		<div class="me-auto">
			<h3 class="page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h3>
			<div class="d-inline-block align-items-center">
				<nav>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
						<li class="breadcrumb-item" aria-current="page"><?= $title ?></li>
						<li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<?php if ($this->session->flashdata('alert')): ?>
	<?= $this->session->flashdata('alert'); ?>
	<?php endif ?>
	<div class="row">
		
		<div class="col-12">
			<div class="box">
				<div class="box-header">
					<h4 class="box-title">Form <?= $title ?></h4>
					<?php if (access('access')): ?>
						<a href="<?= base_url('setting/access') ?>" class="btn btn-sm btn-primary pull-right">Akses Website</a>
					<?php endif ?>
				</div>
				<div class="box-body">
					<div class="row">
						<?php $error = $this->session->flashdata('error') ?>
						    <form class="settings-form" method="post" action="<?= base_url('setting/store') ?>" enctype="multipart/form-data">
						    	<div class="row">
						    		<div class="col-lg-6 col-6">
						    			<div class="mb-3">
						    			    <label for="logo" class="form-label">Logo</label><br>
						    			    <?php if ($setting->logo): ?>
						    			    	<img src="<?= base_url($setting->logo) ?>" width="50%">
						    			    <?php endif ?>
						    			    <input type="file" class="form-control" id="logo" value="<?= set_value('logo', $setting->logo) ?>" name="logo" placeholder="">
						    			    <?= isset($error['logo']) ? $error['logo'] : ''  ?>
						    			</div>
						    		</div>
						    		<div class="col-lg-6 col-6">
						    			<div class="mb-3">
						    			    <label for="icon" class="form-label">Icon</label><br>
						    			    <?php if ($setting->icon): ?>
						    			    	<img src="<?= base_url($setting->icon) ?>" width="25%">
						    			    <?php endif ?>
						    			    <input type="file" class="form-control" id="icon" value="<?= set_value('icon', $setting->icon) ?>" name="icon" placeholder="">
						    			    <?= isset($error['icon']) ? $error['icon'] : ''  ?>
						    			</div>
						    		</div>
						    	</div>

							    <div class="mb-3">
								    <label for="name" class="form-label">Nama Website</label>
								    <input type="text" class="form-control" id="name" value="<?= set_value('name', $setting->name) ?>" name="name" required placeholder="">
								    <?= isset($error['name']) ? $error['name'] : ''  ?>
								</div>
								<div class="mb-3">
								    <label for="motto" class="form-label">Motto</label>
								    <input type="text" class="form-control" id="motto" value="<?= set_value('motto', $setting->motto) ?>" name="motto" required placeholder="">
								    <?= isset($error['motto']) ? $error['motto'] : ''  ?>
								</div>
								<div class="row">
									<div class="col-lg-6 col-6">
										<div class="mb-3">
										    <label for="phone" class="form-label">No Telepon</label>
										    <input type="text" class="form-control" minlength="10" maxlength="15" id="phone" value="<?= set_value('phone', $setting->phone) ?>" name="phone" required placeholder="">
										    <?= isset($error['phone']) ? $error['phone'] : ''  ?>
										</div>
									</div>
									<div class="col-lg-6 col-6">
								    <label for="expired" class="form-label">Expired</label>
										<div class="input-group mb-3">
											<input type="number" name="expired" id="expired" min="0" value="<?= set_value('email', @$setting->expired) ?>" class="form-control" placeholder="Expired">
											<span class="input-group-text bg-transparent">Menit</span>
										</div>
									    <?= isset($error['expired']) ? $error['expired'] : ''  ?>
									</div>
									<div class="col-lg-6 col-6">
										<div class="mb-3">
										    <label for="email" class="form-label">Email</label>
										    <input type="email" class="form-control" id="email" value="<?= set_value('email', $setting->email) ?>" name="email" required placeholder="">
										    <?= isset($error['email']) ? $error['email'] : ''  ?>
										</div>
									</div>
									<div class="col-lg-6 col-6">
										<div class="mb-3">
										    <label for="password" class="form-label">Password</label>
										    <input type="password" class="form-control" id="password" value="<?= set_value('password', @$setting->password) ?>" name="password" required placeholder="">
										    <?= isset($error['password']) ? $error['password'] : ''  ?>
										</div>
									</div>
								</div>
								<div class="mb-3">
								    <label for="address" class="form-label">Alamat</label>
								    <textarea class="form-control" id="address" name="address" required placeholder="" rows="10"><?= set_value('address', $setting->address) ?></textarea>
								    <?= isset($error['address']) ? $error['address'] : ''  ?>
								</div>
								<button type="submit" class="btn btn-primary" >Simpan</button>
						    </form>
					</div><!--//row-->
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function () {
		$('#example').DataTable();
	});
    window.setTimeout(function(){
        $('.alert').fadeTo(500, 0).slideUp(500,function(){
          $(this).remove();
        });
      }, 3000);
</script>
