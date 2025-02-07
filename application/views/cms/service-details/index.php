<div class="content-header">
	<div class="d-flex align-items-center">
		<div class="me-auto">
			<h3 class="page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h3>
			<div class="d-inline-block align-items-center">
				<nav>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
						<li class="breadcrumb-item active" aria-current="page">Master Data / <?= $title ?></li>
					</ol>
				</nav>
			</div>
		</div>
		<?php if (access('harga-create')): ?>
			
		<a class="btn btn-sm btn-primary" href="<?= base_url('service-details/create') ?>">
			<i class="fa fa-plus"></i>
			Tambah <?= $title ?>
		</a>
		<?php endif ?>
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
					<h4 class="box-title">Data <?= $title ?></h4>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table id="example" cellspacing="0" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th class="cell" width="1%">No</th>
									<th class="cell">Jenis pelayanan</th>
									<th class="cell">Nama</th>
									<th class="cell">Harga</th>
									<th class="cell">Unit</th>
									<th class="cell text-center" width="5%">#</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; foreach ($details as $value): ?>
								<tr>
									<td class="cell"><?= $no++ ?>.</td>
									<td class="cell"><?= $value->service->name ?></td>
									<td class="cell"><?= $value->name ?></td>
									<td class="cell"><?= $value->price ?></td>
									<td class="cell"><span class="truncate"><?= $value->unit ?></span></td>
									<td class="text-nowrap text-center">
										<div class="dropdown">
											<a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
												Aksi
											</a>
											<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="z-index: 99999;">
												<?php if (access('harga-update')): ?>
												<li>
													<a class="dropdown-item" href="<?= base_url('service-details/edit/'.encrypt_decrypt('encrypt', $value->id)) ?>"><i class="fa fa-pencil"></i> Ubah
													</a>
												</li>
												<?php endif ?>
												<?php if (access('harga-delete')): ?>
												<li>
													<a class="dropdown-item" href="javascript:;" onclick="showModalDelete(this)" data-href="<?= base_url('service-details/destroy/'.encrypt_decrypt('encrypt', $value->id)) ?>" data-type="Harga Pelayanan"><i class="fa fa-trash"></i> Hapus
													</a>
												</li>
												<?php endif ?>
											</ul>
										</div>
									</td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
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
