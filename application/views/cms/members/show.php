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
$from = $this->input->get('from');
$to = $this->input->get('to');
 ?>
<div class="content-header">
	<div class="d-flex align-items-center">
		<div class="me-auto">
			<h3 class="page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h3>
			<div class="d-inline-block align-items-center">
				<nav>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
						<li class="breadcrumb-item" aria-current="page">Detail <?= $title ?></li>
						<li class="breadcrumb-item active" aria-current="page"><?= $title ?> </li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="row justify-content-center">
		<div class="col-lg-8 col-12">
			<div class="box">
				<div class="box-header text-center">
					<b>Filter Tanggal Transaksi</b>
				</div>
				<div class="box-body">
					<form method="GET">
						
					<div class="row">
						<div class="col-lg-5 col-6">
							<div class="mb-3">
								<label for="from">Dari</label>
								<input type="date" name="from" max="<?= date('Y-m-d') ?>" required value="<?= $from ?>" class="form-control" id="from">
							</div>
						</div>
						<div class="col-lg-5 col-6">
							<div class="mb-3">
								<label for="to">Sampai</label>
								<input type="date" name="to" required max="<?= date('Y-m-d') ?>" min="<?= $from ? $from : ''  ?>" value="<?= $to ?>" class="form-control" id="to">
							</div>
						</div>
						<div class="col-lg-2 col-6">
							<div class="mb-3"></div>
							<button type="submit" class="btn btn-primary"><span class="fa fa-filter"></span> Filter</button>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="box">
				<div class="box-header">
					<b>Riwayat Transaksi <?= $members->name ?></b>
				</div>
				<div class="box-body">
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
							</tr>
						</thead>
						<tbody>
							<?php 
							
							$no = 1; foreach ($members->transaction as $value): 
							$Arrnext = array_search($value->status, $process);
							?>
							<tr>
								<td class="cell"><?= $no++ ?>.</td>
								<td class="cell"><a title="Lihat Detail Transaksi" href="<?= base_url('transactions/show/'.encrypt_decrypt('encrypt', $value->code)) ?>"><?= $value->code ?></a></td>
								<td class="cell"><?= $value->member->name ?></td>
								<td class="cell"><?= date("D, d m Y H:i", strtotime($value->created_at)) ?></td>
								<td class="cell"><?= date("D, d m Y", strtotime($value->due_date)).' '.$value->due_time ?></td>
								<td class="cell"><?= $value->payment_date ? date("D, d m Y H:i", strtotime($value->payment_date)) : '-' ?></td>
								<td class="cell text-nowrap text-center">
									<span class="badge badge-<?= $statusTransaksi[$value->status]['color'] ?>"><span class="<?= $statusTransaksi[$value->status]['icon'] ?>"></span> <?= $value->status ?></span>
								</td>
								<td class="cell">
									<?php if ($value->payment_status == 'sudah dibayar'): ?>
										<span class="badge badge-success">
									<?php else: ?>
										<span class="badge badge-danger">
									<?php endif ?>
									<?= $value->payment_status ?></span></td>
								<td class="cell"><?= $value->creator->fullname ?></td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function () {
		$('.example').DataTable();
	});

	$("#from").change(function(){
		var from = $(this).val()
		$('#to').attr('min', from)
	})
</script>