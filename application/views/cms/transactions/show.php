<div class="content-header">
	<div class="d-flex align-items-center">
		<div class="me-auto">
			<h3 class="page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h3>
			<div class="d-inline-block align-items-center">
				<nav>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
						<li class="breadcrumb-item" aria-current="page"><?= $title ?></li>
						<li class="breadcrumb-item active" aria-current="page"><?= $title ?> </li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<?php 
		$process = ['diterima', 'diproses', 'dicuci', 'siap diambil','sudah diambil'];
		$statusTransaksi = [
			'dibuat' => [
				'icon' => 'fa fa-inbox', 'color' => 'secondary'
			],
			'diubah' => [
				'icon' => 'fa fa-pencil', 'color' => 'warning'
			],
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
		$Arrnext = array_search($transactions->status, $process);
		$next = isset($process[$Arrnext+1]) ? $process[$Arrnext+1] : '';
	 ?>
	<div class="row">
		
		<div class="col-lg-8 col-12">
			<div class="box">
				<div class="box-header">
					<h4 class="box-title">Detail <?= $title.' <b>'.$transactions->code.'</b>' ?></h4>
				</div>
				<div class="box-body">
					<table width="100%" class="table" border="1">
						<tr>
							<td width="20%">Nama Member</td>
							<td width="1%">:</td>
							<td><?= $transactions->member->name ?></td>
						</tr>
						<tr>
							<td width="20%">Kontak Member</td>
							<td width="1%">:</td>
							<td><?= $transactions->member->phone.' / '.$transactions->member->email ?></td>
						</tr>
						
						<tr>
							<td width="20%">Tanggal Transaksi</td>
							<td width="1%">:</td>
							<td><?= date("D, d m Y H:i", strtotime($transactions->created_at)) ?></td>
						</tr>
						<tr>
							<td width="20%">Status Transaksi</td>
							<td width="1%">:</td>
							<td>
								<span class="badge badge-<?= $statusTransaksi[$transactions->status]['color'] ?>">
									<span class="<?= $statusTransaksi[$transactions->status]['icon'] ?>"></span> <?= $transactions->status ?>
								</span>
								<?php if ($next): ?>
									<i class="fa fa-arrow-right"></i>
									<span class="badge badge-<?= $statusTransaksi[$next]['color'] ?>" style="cursor: pointer;" title="Masuk ke tahap selanjutnya" onclick="next(this)" data-status="<?= $next ?>" data-id="<?= encrypt_decrypt('encrypt', $transactions->id) ?>">
										<span class="<?= $statusTransaksi[$next]['icon'] ?>"></span> <?= $next ?>
									</span>
									
								<?php endif ?>
							</td>
						</tr>
						<tr>
							<td width="20%">Status Pembayaran</td>
							<td width="1%">:</td>
							<td>
								<?php if ($transactions->payment_status == 'sudah dibayar'): ?>
									<span class="badge badge-success">
								<?php else: ?>
									<span class="badge badge-danger">
								<?php endif ?>
								<?= $transactions->payment_status ?></span>
							</td>
						</tr>
						<?php if ($transactions->payment_date): ?>
						<tr>
							<td width="20%">Tanggal Pembayaran</td>
							<td width="1%">:</td>
							<td><?= date("D, d m Y H:i", strtotime($transactions->payment_date)) ?></td>
						</tr>
						<?php endif ?>
						<tr>
							<td width="20%">Batas Pengerjaan</td>
							<td width="1%">:</td>
							<td><?= date("D, d m Y", strtotime($transactions->due_date)).' '.$transactions->due_time ?></td>
						</tr>
						<tr>
							<td width="20%">Data Barang</td>
							<td width="1%">:</td>
							<td>
								<table width="100%">
									<tr>
										<th>Layanan</th>
										<th>Jenis Laundry</th>
										<th>Qty</th>
										<th class="text-end">Jumlah</th>
									</tr>
									<?php foreach ($transactions->transactiondetail as $value): ?>
										<tr>
											<td><?= $value->servicedetail->service->name ?></td>
											<td><?= $value->servicedetail->name.' ['.number_format($value->servicedetail->price,0,',','.').'/'.$value->servicedetail->unit.']' ?></td>
											<td><?= $value->weight.' '.$value->servicedetail->unit ?></td>
											<td class="text-end"><?= number_format($value->weight*$value->price,0,',','.') ?></td>
										</tr>
									<?php endforeach ?>
								</table>
							</td>
						</tr>
						<tr>
							<td width="20%">SubTotal</td>
							<td width="1%">:</td>
							<td class="text-end"><?= number_format($transactions->subtotal,0,',','.') ?></td>
						<tr>
						<tr>
							<td width="20%">Diskon</td>
							<td width="1%">:</td>
							<td class="text-end"><span class="badge badge-sm badge-danger"><?= $transactions->discount ?>%</span>Rp. <s><?= number_format(($transactions->discount/100)*$transactions->subtotal,0,',','.') ?></s></td>
						<tr>
						<tr>
							<td width="20%">Pajak</td>
							<td width="1%">:</td>
							<td class="text-end"><span class="badge badge-sm badge-danger"><?= $transactions->tax ?>%</span> Rp. <?= number_format(($transactions->tax/100)*$transactions->subtotal,0,',','.') ?></td>
						<tr>
						<tr>
							<td width="20%" class="text-bold">Total</td>
							<td width="1%">:</td>
							<td class="text-end text-bold">Rp. <?= number_format($transactions->total,0,',','.') ?></td>
						<tr>
					</table>
				</div>
				<div class="box-footer">
					<a href="<?= base_url('transactions') ?>" class="btn btn-secondary" >Kembali</a>
					<a href="<?= base_url('transactions/edit/'.encrypt_decrypt('encrypt', $transactions->id)) ?>" class="btn btn-warning" >Ubah</a>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-12">
			<div class="box">
				<div class="box-header">
					<h4 class="box-title">Timeline</h4>
				</div>
				<div class="box-body" style="max-height: 100vh; overflow-y: auto;">
					<div class="timeline timeline-line-dotted">
						<?php foreach ($transactions->transactionlog as $value): ?>
							<span class="timeline-label">
								<span class="badge badge-pill badge-<?= $statusTransaksi[$value->status]['color'] ?> badge-lg"><?= date_format_indo(date("Y-m-d", strtotime($value->created_at))).' '.date("H:i:s", strtotime($value->created_at)) ?></span>
							</span>
							<div class="timeline-item">
								<div class="timeline-point timeline-point-<?= $statusTransaksi[$value->status]['color'] ?>">
									<i class="<?= $statusTransaksi[$value->status]['icon'] ?>"></i>
								</div>
								<div class="timeline-event">
									<div class="timeline-body">
										<p><?= $value->description ?></p>
									</div>
									<div class="timeline-footer">
										<p class="text-end text-bold"><i><?= $value->user->fullname ?></i></p>
									</div>
								</div>
							</div>
							
						<?php endforeach ?>
						<span class="timeline-label">
							<span class="badge badge-pill badge-dark badge-lg">>---End---<</span>
						</span>
					</div>
				</div>                
			</div>
		</div>
	</div>
</section>

<script>
	function next(__data)
	{
		var id = $(__data).data('id');
		var status = $(__data).data('status');
		var url = `${base_url}transactions/next/${id}/${status}`;

		if (confirm(`Lanjutkan ke tahap ${status}`)) {
			window.location.href=url
		}
	}
</script>