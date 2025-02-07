<div class="content-header">
	<div class="d-flex align-items-center">
		<div class="me-auto">
			<h3 class="page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h3>
			<div class="d-inline-block align-items-center">
				<nav>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
						<li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<?php 
	$staff = $access['Staff'];
	$owner = $access['Owner'];
 ?>
<section class="content">
	<?php if ($this->session->flashdata('alert')): ?>
	<?= $this->session->flashdata('alert'); ?>
	<?php endif ?>
	<form method="post" action="<?= base_url('setting/save-access') ?>">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-12">
				<div class="box">
					<div class="box-header">
						Pengatuan Akses Staff
						<div class="pull-right">
							<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
							<!-- <input type="checkbox" id="check-all-staff" name="check-all-staff" class="chk-col-primary" /> -->
							<!-- <label for="check-all-staff">Semua</label> -->
						</div>
					</div>
					<div class="box-body">
						<div class="row">
								
						<?php foreach ($access['all'] as $key => $all):
							$seacrh = array_search($all, $staff);
							if ($seacrh || strval($seacrh) == '0') {
								$selected = 'checked';
							}else{
								$selected = '';
							} 
						 ?>
							<div class="col-6">
								<input type="checkbox" name="access-staff[<?= $all ?>]" value="<?= $all ?>" id="staff-<?= encrypt_decrypt('encrypt', $key) ?>" <?= $selected ?> class="chk-col-primary" />
								<label for="staff-<?= encrypt_decrypt('encrypt', $key) ?>"><?= $all ?></label>
							</div>
						<?php endforeach ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-12">
				<div class="box">
					<div class="box-header">
						Pengatuan Akses Owner
						<div class="pull-right">
							<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
							<!-- <input type="checkbox" id="check-all-owner" name="check-all-owner" class="chk-col-primary" /> -->
							<!-- <label for="check-all-owner">Semua</label> -->
						</div>
					</div>
					<div class="box-body">
						<div class="row">
								
						<?php foreach ($access['all'] as $key => $all):
							$seacrh = array_search($all, $owner);
							if ($seacrh || strval($seacrh) == '0') {
								$selected = 'checked';
							}else{
								$selected = '';
							} 
						 ?>
							<div class="col-6">
								<input type="hidden" name="access-all[<?= $all ?>]" value="<?= $all ?>">	
								<input type="checkbox" name="access-owner[<?= $all ?>]" value="<?= $all ?>" id="owner-<?= encrypt_decrypt('encrypt', $key) ?>" <?= $selected ?> class="chk-col-primary" />
								<label for="owner-<?= encrypt_decrypt('encrypt', $key) ?>"><?= $all ?></label>
							</div>
						<?php endforeach ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</form>
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
