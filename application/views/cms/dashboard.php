<?php 
$process = ['diterima', 'diproses', 'dicuci', 'siap diambil','sudah diambil'];
$color = ['danger','info','primary','warning','success'];
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
]; ?>

<div class="container-full">
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-12">
				<div class="box bg-primary-light">
					<div class="box-body d-flex px-0">
						<div class="flex-grow-1 p-30 flex-grow-1 bg-img dask-bg bg-none-md" style="background-position: right bottom; background-size: auto 100%; background-image: url(https://eduadmin-template.multipurposethemes.com/bs5/images/svg-icon/color-svg/custom-1.svg)">
							<div class="row">
								<div class="col-12 col-xl-7">
									<h2>Selamat datang kembali, <strong><?= user()->fullname ?>!</strong></h2>
									<p class="text-dark my-10 fs-16">
										Transaksi sudah selesai <strong class="text-warning"><?= $allTransaction ? number_format(($doneTransaction/$allTransaction),2)*100 : 0?>%</strong> dari seluruh transaksi.
									</p>
								</div>
								<div class="col-12 col-xl-5"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php if (access('dashboard-progres')): ?>
				
			<div class="col-lg-6 col-xl-6 col-md-6 col-12">
				<div class="box">
					<div class="box-header with-border">
						<h4 class="box-title">Progres Transaksi </h4>
						<ul class="box-controls pull-right d-md-flex d-none">
							<li class="dropdown">
								<a class="btn btn-primary px-10 "href="<?=  base_url('transactions') ?>">View List</a>
							</li>
						</ul>
					</div>
					<div class="box-body">
						<?php if (count($lastTransaction)): ?>
							<?php foreach ($lastTransaction as $value): 
								$percentage = (array_search($value->status, $process)+1)/5*100;
								?>
								<div class="d-flex align-items-center mb-30 gap-items-3 justify-content-between">
									<div class="d-flex align-items-center fw-500">
										<div class="me-15 w-50 d-table">
											<div class="avatar avatar-lg rounded10 bg-primary-light">
												<span class="<?= $statusTransaksi[$value->status]['icon'] ?> text-<?= $statusTransaksi[$value->status]['color'] ?>"></span>
											</div>
											<!-- <img src="<?= base_url('assets') ?>/images/avatar/avatar-1.png" class="avatar avatar-lg rounded10 bg-primary-light" alt=""> -->
										</div>
										<div>
											<a href="<?= base_url('transactions/show/'.encrypt_decrypt('encrypt', $value->id)) ?>" class="text-dark hover-primary mb-5 d-block fs-16"><?= $value->code ?></a>
											<div class="w-200">
												<div class="progress progress-sm mb-0">
													<div class="progress-bar progress-bar-<?= $statusTransaksi[$value->status]['color'] ?> progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?= $percentage ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percentage ?>%">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="text-end">
										<h5 class="fw-600 mb-0 badge badge-pill badge-<?= $statusTransaksi[$value->status]['color'] ?>"><?= $percentage ?>%</h5>
									</div>
								</div>
							<?php endforeach ?>
						<?php else: ?>
							<h5 class="text-center">Belum ada transaksi</h5>
						<?php endif ?>
					</div>
				</div>
			</div>
			<?php endif ?>
			<?php if (access('dashboard-pendapatan')): ?>

			<div class="col-lg-6 col-xl-6 col-md-6 col-12">
				<div class="box">
					<div class="box-header with-border">
						<h4 class="box-title">Pendapatan</h4>
						<ul class="box-controls pull-right d-md-flex d-none">
							<li class="dropdown">
								<button class="dropdown-toggle btn btn-warning-light px-10" id="title-income" data-bs-toggle="dropdown" href="#">Hari Ini</button>
								<div class="dropdown-menu dropdown-menu-end">
									<a class="dropdown-item active" href="#" onclick="changeChart('today','Hari Ini')">Hari Ini</a>
									<a class="dropdown-item" href="#" onclick="changeChart('yesterday', 'Kemarin')">Kemarin</a>
									<a class="dropdown-item" href="#" onclick="changeChart('week', 'Minggu Ini')">Minggu Ini</a>
									<a class="dropdown-item" href="#" onclick="changeChart('month', 'Bulan Ini')">Bulan Ini</a>
									<a class="dropdown-item" href="#" onclick="changeChart('lastmonth', 'Bulan Kemarin')">Bulan Kemarin</a>
								</div>
							</li>
						</ul>
					</div>
					<div class="box-body">
						<div id="donut-chart"></div>
					</div>
				</div>
			</div>
			<?php endif ?>
			<?php if (access('dashboard-kinerja')): ?>
			<div class="col-12">
				<div class="box">
					<div class="box-header with-border">
						<h4 class="box-title">Kinerja Staff </h4>
						<ul class="box-controls pull-right d-md-flex d-none">
							<li class="dropdown">
								<button class="btn btn-primary px-10 " data-bs-toggle="dropdown" href="<?=  base_url('users') ?>">View List</button>
							</li>
						</ul>
					</div>
					<div class="box-body py-0">
						<div class="table-responsive">
							<table class="table no-border mb-0">
								<tbody>
									<?php foreach ($users as $key => $value): ?>
									<tr>
										<td width="10%">
											<div class="bg-<?= $color[$key] ?> h-50 w-50 l-h-50 rounded text-center">
												<?php if ($value->image): ?>
													<img src="<?= base_url($value->image) ?>" width="50%">
												<?php else: ?>
													-
												<?php endif ?>
											</div>
										</td>
										<td class="fw-600" width="30%"><?= $value->fullname ?></td>
										<td class="text-fade" width="20%"><?= $value->count ?> Transaksi</td>
										<td class="text-fade" width="20%"><?= $value->member_count ?> Member</td>
										<td class="fw-600"><?= number_format($value->total,2,',','.') ?></td>
									</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<?php endif ?>
			<?php if (access('dashboard-transaksi')): ?>
				
			<div class="col-12">
				<div class="box">
					<div class="box-header">
						<b>Daftar Teransaksi Dengan Batas Akhir Hari Ini (<?= date_format_indo(date("Y-m-d")) ?>)</b>
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
								
								$no = 1; foreach ($dueDate as $value): 
								$Arrnext = array_search($value->status, $process);
								?>
								<tr>
									<td class="cell"><?= $no++ ?>.</td>
									<td class="cell"><?= $value->code ?></td>
									<td class="cell"><?= $value->member->name ?></td>
									<td class="cell"><?= date("D, d m Y H:i", strtotime($value->created_at)) ?></td>
									<td class="cell text-center">
										<?php if ($value->due_time <= date('H:i:s')): ?>
											<?= date("D, d m Y", strtotime($value->due_date)).' <br>'.$value->due_time ?>
											<span class="badge badge-warning">
												<small class="text-bold"><span class="fa fa-exclamation-triangle"></span> Melewati batas pengerjaan</small>
											</span>
										<?php endif ?>

									</td>
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
	<!-- /.content -->
</div>
<script src="<?= base_url('assets') ?>/vendor_components/raphael/raphael.min.js"></script>
<script src="<?= base_url('assets') ?>/vendor_components/morris.js/morris.min.js"></script>

<script>
	$(document).ready(function () {
		$('.example').DataTable();
		changeChart('today')
	});
</script>
<script type="text/javascript">

	function changeChart(element, text = 'Hari Ini')
	{
		$('#title-income').text(text)
		$("#donut-chart").empty();
		$.ajax({
			url:`${base_url}get-data-penghasilan/${element}`,
			dataType:"json",
			success:function(response)
			{
				console.log(response)

				if (!response.sudah && !response.belum) {
					$("#donut-chart").html(`<h4 class="text-bold text-center">Tidak Ada Transaksi ${text}</h4>`);
				}else {
					Morris.Donut({
				        element: 'donut-chart',
				        data: [{
				            label: "Sudah Dibayar",
				            value: response.sudah,

				        }, {
				            label: "Belum Dibayar",
				            value: response.belum
				        }],
				        resize: true,
				        colors:['#17b3a3', '#ff4c52']
				    });
					
				}

			}
		})
		
	}
</script>

