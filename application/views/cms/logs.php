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
									<th class="cell">Nama</th>
									<th class="cell">Url</th>
									<th class="cell">Catatan</th>
									<th class="cell">Tanggal</th>
									<!-- <th class="cell text-center" width="5%">#</th> -->
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; foreach ($logs as $value): ?>
								<tr>
									<td class="cell"><?= $no++ ?>.</td>
									<td class="cell"><?= $value->user ? $value->user->fullname : '<span class="badge badge-danger">unknown</span>' ?></td>
									<td class="cell"><?= base_url($value->url) ?></td>
									<td class="cell"><?= $value->description ?></td>
									<td class="cell"><?= $value->created_at ?></td>
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
