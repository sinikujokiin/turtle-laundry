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
	
	<div class="row">
		
		<div class="col-12">
			<div class="box">
				<div class="box-header">
					<h4 class="box-title">Form <?= $title ?></h4>
				</div>
				<div class="box-body">
					<div class="row">
						<?php $error = $this->session->flashdata('error') ?>
						    <form class="settings-form" method="post" action="<?= base_url('services/update/'.encrypt_decrypt("encrypt",$services->id)) ?>">
						    	
							    <div class="mb-3">
								    <label for="name" class="form-label">Nama pelayanan</label>
								    <input type="text" class="form-control" id="name" value="<?= set_value('name', $services->name) ?>" name="name" required placeholder="Cuci, Setrika">
								    <?= isset($error['name']) ? $error['name'] : ''  ?>
								</div>
								<div class="mb-3">
								    <label for="description" class="form-label">Deskripsi</label>
								    <textarea class="form-control" id="description" name="description" required placeholder="" rows="20"><?= set_value('description', $services->description) ?></textarea>
								    <?= isset($error['description']) ? $error['description'] : ''  ?>
								</div>
								<a href="<?= base_url('services') ?>" class="btn btn-secondary" >Kembali</a>
								<button type="submit" class="btn btn-primary" >Simpan</button>
						    </form>
					</div><!--//row-->
				</div>
			</div>
		</div>
	</div>
</section>

