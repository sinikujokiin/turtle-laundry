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
						<?php $error = $this->session->flashdata('error') ?>
						    <form class="settings-form" method="post" action="<?= base_url('members/store') ?>">
							    <div class="mb-3">
								    <label for="name" class="form-label">Nama Member</label>
								    <input type="text" class="form-control" id="name" value="<?= set_value('name') ?>" name="name" required placeholder="Cuci, Setrika">
								    <?= isset($error['name']) ? $error['name'] : ''  ?>
								</div>

								<div class="mb-3">
								    <label for="gender" class="form-label">Jenis Kelamin</label>

									<div class="form-check">
										<input class="form-check-input" type="radio" <?= set_value('gender') == 'Pria' ? 'checked' : '' ?> value="Pria" id="gender-pria" name="gender" checked>
									 	<label class="form-check-label" for="gender-pria">
									    	Pria
										</label>
										<input class="form-check-input" type="radio" <?= set_value('gender') == 'Wanita' ? 'checked' : '' ?> value="Wanita" id="gender-wanita" name="gender" >
									 	<label class="form-check-label" for="gender-wanita">
									    	Wanita
										</label>
									</div>
								    <?= isset($error['gender']) ? $error['gender'] : ''  ?>
								</div>

								<div class="mb-3">
								    <label for="phone" class="form-label">No Telepon</label>
								    <input type="text" class="form-control" minlength="10" maxlength="15" id="phone" value="<?= set_value('phone') ?>" name="phone" required placeholder="0000000000">
								    <?= isset($error['phone']) ? $error['phone'] : ''  ?>
								</div>

								<div class="mb-3">
								    <label for="email" class="form-label">Email (Optional)</label>
								    <input type="email" class="form-control" id="email" value="<?= set_value('email') ?>" name="email" placeholder="Email@gmail.com">
								    <?= isset($error['email']) ? $error['email'] : ''  ?>
								</div>


								<div class="mb-3">
								    <label for="address" class="form-label">Alamat</label>
								    <textarea class="form-control" id="address" name="address" required placeholder="" rows="20"><?= set_value('address') ?></textarea>
								    <?= isset($error['address']) ? $error['address'] : ''  ?>
								</div>
								<a href="<?= base_url('members') ?>" class="btn btn-secondary" >Kembali</a>
								<button type="submit" class="btn btn-primary" >Simpan</button>
						    </form>
					</div><!--//row-->
				</div>
			</div>
		</div>
	</div>
</section>

