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
						    <form class="settings-form" method="post" action="<?= base_url('service-details/store') ?>">
						    	<div class="mb-3">
								    <label for="service_id" class="form-label">Jenis Pelayanan</label>
								    <select class="form-control" name="service_id" id="service_id" required>
								    	<option disabled selected value="">Pilih Jenis Pelayanan</option>
								    	<?php foreach ($services as $value): ?>
								    		<option value="<?= $value->id ?>" <?= set_value('service_id') == $value->id ? 'selected' : '' ?>><?= $value->name ?></option>
								    	<?php endforeach ?>
								    </select>
								    <?= isset($error['service_id']) ? $error['service_id'] : ''  ?>
								</div>
							    <div class="mb-3">
								    <label for="name" class="form-label">Nama Sub Pelayanan</label>
								    <input type="text" class="form-control" id="name" value="<?= set_value('name') ?>" name="name" required placeholder="Cuci, Setrika">
								    <?= isset($error['name']) ? $error['name'] : ''  ?>
								</div>

							    <label for="price" class="form-label">Harga / Unit</label>
								<div class="input-group mb-3">
								    <input type="number" class="form-control" id="price" value="<?= set_value('price') ?>" name="price" required placeholder="10000">
									<span class="input-group-text">/</span>
									<select class="form-control" name="unit" id="unit">
										<option value="Kg" <?= set_value('unit') == 'Kg' ? 'selected' : '' ?>>Kg</option>
										<option value="Pcs" <?= set_value('unit') == 'Pcs' ? 'selected' : '' ?>>Pcs</option>
									</select>
								    <?= isset($error['price']) ? $error['price'] : ''  ?>
								    <?= isset($error['unit']) ? $error['unit'] : ''  ?>
								</div>
								<a href="<?= base_url('service-details') ?>" class="btn btn-secondary" >Kembali</a>
								<button type="submit" class="btn btn-primary" >Simpan</button>
						    </form>
					</div><!--//row-->
				</div>
			</div>
		</div>
	</div>
</section>

