<?php 
$process = ['diterima', 'diproses', 'dicuci', 'siap diambil','sudah diambil'];
$statusTransaksi = [
	'diterima' => [
		'icon' => 'fa fa-inbox', 'color' => 'danger'
	],
	'diproses' => [
		'icon' => 'fa fa-refresh', 'color' => 'info'
	],
	'dicuci' => [
		'icon' => 'mdi mdi-washing-machine', 'color' => 'primary'
	],
	'siap diambil' => [
		'icon' => 'mdi mdi-calendar-clock', 'color' => 'warning'
	],
	'sudah diambil' => [
		'icon' => 'fa fa-check', 'color' => 'success'
	],
];
 ?>
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
		<?php if (access('transaksi-create')): ?>
		<a class="btn btn-sm btn-primary" href="<?= base_url('transactions/create') ?>">
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
	<!-- Nav tabs -->
	<ul class="nav nav-tabs nav-fill" role="tablist">
			<li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#tab-all" role="tab"><span><i class="fa fa-list"></i></span> <span class="hidden-xs-down ms-15">Semua <span class="badge badge-pill badge-dark"><?= count($transactions) ?></span></span></a> </li>
		<?php foreach ($process as $key => $value):
				$val = str_replace(' ','',  $value);
		 ?>
			<li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#tab-<?= $key  ?>" role="tab"><span><i class="<?= $statusTransaksi[$value]['icon'] ?>"></i></span> <span class="hidden-xs-down ms-15"><?= ucfirst($value) ?> <span class="badge badge-pill badge-<?= $statusTransaksi[$value]['color'] ?>"><?= count($$val) ?></span></span></a> </li>
		<?php endforeach ?>
	</ul>
	<!-- Tab panes -->
	<div class="tab-content tabcontent-border">
		<div class="tab-pane active" id="tab-all" role="tabpanel">
			<div class="p-15">
				<div class="table-responsive">
					<table cellspacing="0" class="table example table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th class="cell" width="1%">No</th>
								<th class="cell">Kode Transaksi</th>
								<th class="cell">Nama Member</th>
								<th class="cell">Tanggal Transaksi</th>
								<th class="cell">Batas Waktu</th>
								<th class="cell">Tanggal Bayar</th>
								<th class="cell">Status Transaksi</th>
								<th class="cell">Status Bayar</th>
								<th class="cell">Created By</th>
								<th class="cell text-center" width="5%">#</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							
							$no = 1; foreach ($transactions as $value): 
							$Arrnext = array_search($value->status, $process);
							$next = isset($process[$Arrnext+1]) ? $process[$Arrnext+1] : '';
							?>
							<tr>
								<td class="cell"><?= $no++ ?>.</td>
								<td class="cell"><?= $value->code ?></td>
								<td class="cell"><?= $value->member->name ?></td>
								<td class="cell"><?= date("D, d m Y H:i", strtotime($value->created_at)) ?></td>
								<td class="cell"><?= date("D, d m Y", strtotime($value->due_date)).' '.$value->due_time ?></td>
								<td class="cell"><?= $value->payment_date ? date("D, d m Y H:i", strtotime($value->payment_date)) : '-' ?></td>
								<td class="cell text-nowrap text-center">
									<span class="badge badge-<?= $statusTransaksi[$value->status]['color'] ?>"><span class="<?= $statusTransaksi[$value->status]['icon'] ?>"></span> <?= $value->status ?></span>
									<?php if ($next): ?>
										<br>
										<i class="fa fa-arrow-down"></i>
										<br>
										<span class="badge badge-<?= $statusTransaksi[$next]['color'] ?>" style="cursor: pointer;" title="Masuk ke tahap selanjutnya" onclick="next(this)" data-status="<?= $next ?>" data-id="<?= encrypt_decrypt('encrypt', $value->id) ?>">
											<span class="<?= $statusTransaksi[$next]['icon'] ?>"></span> <?= $next ?>
										</span>
										
									<?php endif ?>
								</td>
								<td class="cell">
									<?php if ($value->payment_status == 'sudah dibayar'): ?>
										<span class="badge badge-success">
									<?php else: ?>
										<span class="badge badge-danger">
									<?php endif ?>
									<?= $value->payment_status ?></span></td>
								<td class="cell"><?= $value->creator->fullname ?></td>
								<td class="text-nowrap text-center">
									<div class="dropdown">
										<a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
											Aksi
										</a>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="z-index: 99999;">
											<?php if (access('transaksi-print')): ?>
											<li>
												<a class="dropdown-item" href="<?= base_url('transactions/print/'.encrypt_decrypt('encrypt', $value->id)) ?>"><i class="fa fa-print"></i> Cetak
												</a>
											</li>
											<?php endif ?>
											<?php if (access('transaksi-detail')): ?>
											<li>
												<a class="dropdown-item" href="<?= base_url('transactions/show/'.encrypt_decrypt('encrypt', $value->id)) ?>"><i class="fa fa-eye"></i> Detail
												</a>
											</li>
											<?php endif ?>
											<?php if (access('transaksi-update')): ?>
											<li>
												<a class="dropdown-item" href="<?= base_url('transactions/edit/'.encrypt_decrypt('encrypt', $value->id)) ?>"><i class="fa fa-pencil"></i> Ubah
												</a>
											</li>
											<?php endif ?>
											<?php if (access('transaksi-delete')): ?>
											<li>
												<a class="dropdown-item" href="javascript:;" onclick="showModalDelete(this)" data-href="<?= base_url('transactions/destroy/'.encrypt_decrypt('encrypt', $value->id)) ?>" data-type="Pelayanan"><i class="fa fa-trash"></i> Hapus
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
		<?php foreach ($process as $key => $value): ?>
			<div class="tab-pane" id="tab-<?= $key  ?>" role="tabpanel">
				<div class="p-15">
					<div class="table-responsive">
					<table cellspacing="0" class="table example table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th class="cell" width="1%">No</th>
								<th class="cell">Kode Transaksi</th>
								<th class="cell">Nama Member</th>
								<th class="cell">Tanggal Transaksi</th>
								<th class="cell">Batas Waktu</th>
								<th class="cell">Tanggal Bayar</th>
								<th class="cell">Status Transaksi</th>
								<th class="cell">Status Bayar</th>
								<th class="cell">Created By</th>
								<th class="cell text-center" width="5%">#</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$value = str_replace(' ','',  $value);
							$no = 1; foreach ($$value as $value): 
							$Arrnext = array_search($value->status, $process);
							$next = isset($process[$Arrnext+1]) ? $process[$Arrnext+1] : '';
							?>
							<tr>
								<td class="cell"><?= $no++ ?>.</td>
								<td class="cell"><?= $value->code ?></td>
								<td class="cell"><?= $value->member->name ?></td>
								<td class="cell"><?= date("D, d m Y H:i", strtotime($value->created_at)) ?></td>
								<td class="cell"><?= date("D, d m Y", strtotime($value->due_date)).' '.$value->due_time ?></td>
								<td class="cell"><?= $value->payment_date ? date("D, d m Y H:i", strtotime($value->payment_date)) : '-' ?></td>
								<td class="cell text-nowrap text-center">
									<span class="badge badge-<?= $statusTransaksi[$value->status]['color'] ?>"><span class="<?= $statusTransaksi[$value->status]['icon'] ?>"></span> <?= $value->status ?></span>
									<?php if ($next): ?>
										<br>
										<i class="fa fa-arrow-down"></i>
										<br>
										<span class="badge badge-<?= $statusTransaksi[$next]['color'] ?>" style="cursor: pointer;" title="Masuk ke tahap selanjutnya" onclick="next(this)" data-status="<?= $next ?>" data-id="<?= encrypt_decrypt('encrypt', $value->id) ?>">
											<span class="<?= $statusTransaksi[$next]['icon'] ?>"></span> <?= $next ?>
										</span>
										
									<?php endif ?>
								</td>
								<td class="cell">
									<?php if ($value->payment_status == 'sudah dibayar'): ?>
										<span class="badge badge-success">
									<?php else: ?>
										<span class="badge badge-danger">
									<?php endif ?>
									<?= $value->payment_status ?></span></td>
								<td class="cell"><?= $value->creator->fullname ?></td>
								<td class="text-nowrap text-center">
									<div class="dropdown">
										<a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
											Aksi
										</a>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="z-index: 99999;">
											<li>
												<a class="dropdown-item" href="<?= base_url('transactions/print/'.encrypt_decrypt('encrypt', $value->id)) ?>"><i class="fa fa-print"></i> Cetak
												</a>
											</li>
											<li>
												<a class="dropdown-item" href="<?= base_url('transactions/show/'.encrypt_decrypt('encrypt', $value->id)) ?>"><i class="fa fa-eye"></i> Detail
												</a>
											</li>
											<li>
												<a class="dropdown-item" href="<?= base_url('transactions/edit/'.encrypt_decrypt('encrypt', $value->id)) ?>"><i class="fa fa-pencil"></i> Ubah
												</a>
											</li>
											<li>
												<a class="dropdown-item" href="javascript:;" onclick="showModalDelete(this)" data-href="<?= base_url('transactions/destroy/'.encrypt_decrypt('encrypt', $value->id)) ?>" data-type="Pelayanan"><i class="fa fa-trash"></i> Hapus
												</a>
											</li>
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
		<?php endforeach ?>
	</div>
</section>
<script>
	$(document).ready(function () {
		$('.example').DataTable();
	});
    window.setTimeout(function(){
        $('.alert').fadeTo(500, 0).slideUp(500,function(){
          $(this).remove();
        });
      }, 3000);
</script>
<script>
	function next(__data)
	{
		var id = $(__data).data('id');
		var status = $(__data).data('status');
		var url = `${base_url}transactions/next/${id}/${status}/index`;

		if (confirm(`Lanjutkan ke tahap ${status}`)) {
			window.location.href=url
		}
	}
</script>