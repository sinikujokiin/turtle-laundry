<div class="content-header">
	<div class="d-flex align-items-center">
		<div class="me-auto">
			<h3 class="page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h3>
			<div class="d-inline-block align-items-center">
				<nav>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
						<li class="breadcrumb-item" aria-current="page"><?= $title ?></li>
						<li class="breadcrumb-item active" aria-current="page">Tambah <?= $title ?></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<section class="content">
	
	<div class="row">
		
		<div class="col-12">
			<div class="box">
				<div class="box-header">
					<h4 class="box-title">Form <?= $title ?></h4>
				</div>
				<div class="box-body">
					<div class="row">
						<?php $error = $this->session->flashdata('error'); ?>
						    <form class="settings-form" method="post" action="<?= base_url('users/update/'.encrypt_decrypt("encrypt",$users->id)) ?>" enctype="multipart/form-data">
							    <div class="mb-3">
								    <label for="fullname" class="form-label">Nama Lengkap</label>
								    <input type="text" class="form-control" id="fullname" value="<?= set_value('fullname', $users->fullname) ?>" name="fullname" required placeholder="Fulan">
								    <?= isset($error['fullname']) ? $error['fullname'] : ''  ?>
								</div>
								<div class="mb-3">
								    <label for="phone" class="form-label">No Telepon</label>
								    <input type="text" class="form-control" minlength="10" maxlength="15" id="phone" value="<?= set_value('phone', $users->phone) ?>" name="phone" required placeholder="0000000000">
								    <?= isset($error['phone']) ? $error['phone'] : ''  ?>
								</div>

								<div class="mb-3">
								    <label for="email" class="form-label">Email (Optional)</label>
								    <input type="email" class="form-control" id="email" value="<?= set_value('email', $users->email) ?>" name="email" placeholder="Email@gmail.com">
								    <?= isset($error['email']) ? $error['email'] : ''  ?>
								</div>

								<div class="mb-3">
								    <label for="username" class="form-label">Username</label>
								    <input type="text" class="form-control" id="username" value="<?= set_value('username', $users->username) ?>" name="username" placeholder="username">
								    <?= isset($error['username']) ? $error['username'] : ''  ?>
								</div>
								<div class="row">
									<div class="col-6">
										<div class="mb-3">
										    <label for="password" class="form-label">Password</label>
										    <input type="password" class="form-control" id="password" value="<?= set_value('password') ?>" name="password" placeholder="password">
										    <?= isset($error['password']) ? $error['password'] : ''  ?>
										</div>
									</div>
									<div class="col-6">
										<div class="mb-3">
										    <label for="conf_password" class="form-label">Konfirmasi Password</label>
										    <input type="password" class="form-control" id="conf_password" value="<?= set_value('conf_password') ?>" name="conf_password" placeholder="konfirmasi password">
										    <?= isset($error['conf_password']) ? $error['conf_password'] : ''  ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 col-12">
										<div class="mb-3">
										    <label for="role" class="form-label">Role</label>

											<div class="form-check">
												<input class="form-check-input" type="radio" <?= set_value('role', $users->role) == 'Staff' ? 'checked' : '' ?> value="Staff" id="role-staff" name="role" checked>
											 	<label class="form-check-label" for="role-staff">
											    	Staff
												</label>
												<input class="form-check-input" type="radio" <?= set_value('role', $users->role) == 'Owner' ? 'checked' : '' ?> value="Owner" id="role-owner" name="role" >
											 	<label class="form-check-label" for="role-owner">
											    	Owner
												</label>
											</div>
										    <?= isset($error['role']) ? $error['role'] : ''  ?>
										</div>
									</div>
									<div class="col-lg-6 col-12">
										<div class="mb-3">
										    <label for="status" class="form-label">Status</label>

											<div class="form-check">
												<input class="form-check-input" type="radio" <?= set_value('status', $users->status) == '1' ? 'checked' : '' ?> value="1" id="status-1" name="status" checked>
											 	<label class="form-check-label" for="status-1">
											    	Aktif
												</label>
												<input class="form-check-input" type="radio" <?= set_value('status', $users->status) == '0' ? 'checked' : '' ?> value="0" id="status-0" name="status" >
											 	<label class="form-check-label" for="status-0">
											    	Tidak Aktif
												</label>
											</div>
										    <?= isset($error['status']) ? $error['status'] : ''  ?>
										</div>
									</div>
								</div>
								<div class="mb-3">
								    <label for="image" class="form-label">Foto Profil (Optional)</label>
								    <input type="file" accept="image/*" class="form-control" id="image" value="<?= set_value('image', $users->image) ?>" name="image" placeholder="image">
								    <?= isset($error['image']) ? $error['image'] : ''  ?>
								</div>
								<a href="<?= base_url('users') ?>" class="btn btn-secondary" >Kembali</a>
								<button type="submit" class="btn btn-primary" >Simpan</button>
						    </form>
					</div><!--//row-->
				</div>
			</div>
		</div>
	</div>
</section>

