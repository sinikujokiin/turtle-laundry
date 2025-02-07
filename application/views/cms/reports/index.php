<div class="content-header">
	<div class="d-flex align-items-center">
		<div class="me-auto">
			<h3 class="page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h3>
			<div class="d-inline-block align-items-center">
				<nav>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
						<li class="breadcrumb-item" aria-current="page"><?= $title ?></li>
						<li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<?php 
	$process = ['diterima', 'diproses', 'dicuci', 'siap diambil','sudah diambil', 'sudah dibayar', 'belum dibayar'];
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
		'sudah dibayar' => [
			'icon' => 'fa fa-money', 'color' => 'success'
		],
		'belum dibayar' => [
			'icon' => 'fa fa-times', 'color' => 'danger'
		],
	];
	$awal = $this->input->get('from') ? $this->input->get('from') : date("Y-m").'-01';
	$akhir = $this->input->get('to') ? $this->input->get('to') : date("Y-m-d");
 ?>

<section class="content">
	<div class="row">
		<div class="col-lg-8 col-sm-12">
			<div class="box">
				<div class="box-header">
					<b>Filter Tanggal Transaksi</b>
				</div>
				<div class="box-body">
					<h5>Dari tanggal <?= date_format_indo($awal) ?> sampai tanggal <?= date_format_indo($akhir) ?> </h5>
					<form method="get">
						<div class="row">
							<div class="col-lg-5 col-6">
								<div class="mb-3">
									<label for="from">Dari</label>
									<input type="date" name="from" value="<?= $awal ?>" class="form-control" id="from">
								</div>
							</div>
							<div class="col-lg-5 col-6">
								<div class="mb-3">
									<label for="to">Sampai</label>
									<input type="date" name="to" value="<?= $akhir ?>" class="form-control" id="to">
								</div>
							</div>
							<div class="col-lg-1 col-6">
								<div class="mb-3"></div>
								<button type="submit" class="btn btn-sm btn-primary"><span class="fa fa-filter"></span> Filter</button>
							</div>
							<div class="col-lg-1 col-6">
								<div class="mb-3"></div>
								<?php if ($this->input->get()): ?>
									<a class="btn btn-secondary btn-sm" href="<?= base_url('report-transactions/pdf?date='.encrypt_decrypt('encrypt', $awal.'|'.$akhir)) ?>">
										<span class="fa fa-print"></span>
										Cetak
									</a>
									<!-- <button type="reset" class="btn btn-sm btn-secondary"><span class="fa fa-refresh"></span> Reset</button> -->
								<?php endif ?>
							</div>
						</div>
					</form>
				</div>
			</div>

			<?php if (isset($reports)): ?>
				<div class="box">
					<div class="box-header">
						<b>Pendapatan Dari tanggal <?= date_format_indo($awal) ?> sampai tanggal <?= date_format_indo($akhir) ?></b>
					</div>
					<div class="box-body">
						<div class="row">
							
							<div class="col-4">
								<h4>Pendapatan Total</h4>
								<h1>Rp. <?= number_format($reports['allIncome'],2,',','.') ?></h1>
							</div>
							<div class="col-4 text-success">
								<h4>Pendapatan Lunas</h4>
								<h1>Rp. <?= number_format($reports['income'],2,',','.') ?></h1>
							</div>
							<div class="col-4 text-danger">
								<h4>Pendapatan Belum Lunas</h4>
								<h1>Rp. <?= number_format($reports['incomedelay'],2,',','.') ?></h1>
							</div>
						</div>
					</div>
				</div>
			<?php endif ?>
		</div>
		<?php if (isset($reports)): ?>
			<div class="col-lg-4 col-sm-12">
				<div class="box">
					<div class="box-header">
						<b>Jumlah</b>
					</div>
					<div class="box-body">
						<table width="100%" class="table" border="1">
							<tr>
								<td width="59%"><span class="fa fa-users text-bold"></span> Member</td>
								<td width="1%">:</td>
								<td class="text-bold"><?= $reports['count_members'] ?></td>
							</tr>
							<tr>
								<td width="59%"><span class="fa fa-exchange text-bold"></span> Transaksi</td>
								<td width="1%">:</td>
								<td class="text-bold"><?= $reports['count_transactions'] ?></td>
							</tr>
							<?php foreach ($process as $value):
								$values = str_replace(' ','',  $value);

							 ?>
								<tr>
									<td width="59%" class="text-<?= $statusTransaksi[$value]['color'] ?>"><span class="<?= $statusTransaksi[$value]['icon'] ?> text-bold"></span> <?= ucfirst($value) ?></td>
									<td width="1%">:</td>
									<td class="text-bold"><?= $reports['status'][$values] ?></td>
								</tr>
							<?php endforeach ?>
						
						</table>
					</div>
				</div>
			</div>

			<div class="col-12">
				<div class="box">
					<div class="box-header">
						<b>Daftar Teransaksi Dari tanggal <?= date_format_indo($awal) ?> sampai tanggal <?= date_format_indo($akhir) ?></b>
					</div>
					<div class="box-body table-responsive">
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
								
								$no = 1; foreach ($reports['transactions'] as $value): 
								$Arrnext = array_search($value->status, $process);
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
		<?php endif ?>
	</div>
</section>

<script>
	$(document).ready(function () {
		$('.example').DataTable();
	});
</script>