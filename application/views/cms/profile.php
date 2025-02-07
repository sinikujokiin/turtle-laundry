<div class="content-header">
	<div class="d-flex align-items-center">
		<div class="me-auto">
			<h3 class="page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h3>
			<div class="d-inline-block align-items-center">
				<nav>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
						<li class="breadcrumb-item" aria-current="page"><?= $title ?></li>
						<li class="breadcrumb-item active" aria-current="page">Ubah <?= $title ?></li>
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
		
		<div class="col-6">
			<div class="box">
				<div class="box-header">
					<h4 class="box-title">Form <?= $title ?></h4>
				</div>
				<div class="box-body">
					<div class="row">
						<?php $error = $this->session->flashdata('error') ?>
						    <form class="settings-form" method="post" action="<?= base_url('update-profile') ?>">
							    <div class="mb-3">
								    <label for="fullname" class="form-label">Nama Lengkap</label>
										<input type="text" name="fullname" id="fullname" value="<?= set_value('fullname', $user->fullname) ?>" class="form-control" placeholder="Nama Lengkap">

								    <?= isset($error['fullname']) ? $error['fullname'] : ''  ?>
								</div>
								<div class="mb-3">
								    <label for="username" class="form-label">Deskripsi</label>
									<input type="text" name="username" id="username" value="<?= set_value('username', $user->username) ?>" class="form-control" placeholder="Nama Lengkap">

								    <?= isset($error['username']) ? $error['username'] : ''  ?>
								</div>
								<div class="mb-3">
								    <label for="phone" class="form-label">No. Telepon</label>
									<input type="text" name="phone" id="phone" value="<?= set_value('phone', $user->phone) ?>" class="form-control" placeholder="No. Telepon">

								    <?= isset($error['username']) ? $error['username'] : ''  ?>
								</div>
								<div class="mb-3">
								    <label for="email" class="form-label">Email</label>
									<input type="email" name="email" id="email" value="<?= set_value('email', $user->email) ?>" class="form-control" placeholder="Email">

								    <?= isset($error['email']) ? $error['email'] : ''  ?>
								</div>
								<div class="mb-3">
								    <label for="image" class="form-label">Image</label>
								    <br>
								    <?php if ($user->image): ?>
								    	<img src="<?= base_url($user->image) ?>" width="25%">
								    <?php else: ?>
								    	No Image
								    <?php endif ?>
									<input type="file" name="image" id="image" value="" class="form-control" placeholder="Email">

								    <?= isset($error['image']) ? $error['image'] : ''  ?>
								</div>
								<button type="submit" class="btn btn-primary" >Simpan</button>
						    </form>
					</div><!--//row-->
				</div>
			</div>
		</div>

		<div class="col-6">
			<div class="box">
				<div class="box-header">
					<h4 class="box-title">Form Password</h4>
				</div>
				<div class="box-body">
					<div class="row">
						<?php $error = $this->session->flashdata('error') ?>
						    <form class="settings-form" method="post" action="<?= base_url('update-profile') ?>">
							    <div class="mb-3">
								    <label for="old" class="form-label">Password Lama</label>
										<input type="password" name="old" id="old" value="" class="form-control" placeholder="Pasword Lama">

								    <?= isset($error['old']) ? $error['old'] : ''  ?>
								</div>
								<div class="mb-3">
								    <label for="conf" class="form-label">Password Baru</label>
									<input type="password" name="conf" id="conf" value="<?= set_value('conf', $user->conf) ?>" class="form-control" placeholder="Password Baru">

								    <?= isset($error['conf']) ? $error['conf'] : ''  ?>
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
