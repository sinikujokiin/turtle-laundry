<?php $web =  json_decode(file_get_contents('setting.json')); ?>
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


<!-- Main content -->
<section class="invoice printableArea">
  <div class="row no-print">
	<div class="col-12">
	  <div class="bb-1 clearFix">
		<div class="text-end pb-15">
				<a href="<?= base_url('transactions') ?>" class="btn btn-secondary" >Kembali</a>
			<!-- <button class="btn btn-success" type="button"> <span><i class="fa fa-print"></i> Save</span> </button> -->
			<button id="print2" class="btn btn-warning" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
		</div>	
	  </div>
	</div>
	<!-- /.col -->
  </div>
  <div class="row invoice-info">
	<div class="col-md-6 invoice-col">
	  <strong>From</strong>	
	  <address>
		<strong class="text-blue fs-24"><?= $web->name ?></strong><br>
		<strong class="d-inline"><?= $web->address ?></strong><br>
		<strong>Phone: <?= $web->phone ?> &nbsp;&nbsp;&nbsp;&nbsp; Email: <?= $web->email ?></strong>  
	  </address>
	</div>
	<!-- /.col -->
	<div class="col-md-6 invoice-col text-end">
	  <strong>To</strong>
	  <address>
		<strong class="text-blue fs-24"><?= $transactions->member->name ?></strong><br>
		<?= $transactions->member->address ?><br>
		<strong>Phone: <?= $transactions->member->phone ?> &nbsp;&nbsp;&nbsp;&nbsp; Email: <?= $transactions->member->email ?></strong>
	  </address>
	</div>
	<!-- /.col -->
	<div class="col-sm-12 invoice-col mb-15">
		<div class="invoice-details row no-margin">
		  <div class="col-md-6 col-lg-3"><b>Invoice:</b> <?= $transactions->code ?></div>
		  <div class="col-md-6 col-lg-3"><b>Tanggal Order:</b> <?= date_format_indo(date("Y-m-d", strtotime($transactions->created_at))).' '.date("H:i", strtotime($transactions->created_at)) ?> </div>
		  <div class="col-md-6 col-lg-3"><b>Batas Pengerjaan:</b> <?= date_format_indo($transactions->due_date).' '.date("H:i", strtotime($transactions->due_time)) ?></div>
		  <div class="col-md-6 col-lg-3"><b>Status Pembayaran:</b> <?= ucfirst($transactions->payment_status) ?></div>
		</div>
	</div>
  <!-- /.col -->
  </div>
  <div class="row">
	<div class="col-12 table-responsive">
	  <table class="table table-bordered">
		<tbody>
		<tr>
		  <th width="1%">#</th>
		  <th>Deskripsi</th>
		  <th width="7%">Qty</th>
		  <th class="text-end">Harga</th>
		  <th class="text-end">Subtotal</th>
		</tr>
		<?php $no =1; foreach ($transactions->transactiondetail as $value): ?>
			
		<tr>
		  <td><?= $no++ ?></td>
		  <td><?= $value->servicedetail->name ?></td>
		  <td class="text-end"><?= $value->weight.' '.$value->servicedetail->unit ?></td>
		  <td class="text-end"><?= number_format($value->price,2,',','.') ?></td>
		  <td class="text-end"><?= number_format($value->weight*$value->price,2,',','.') ?></td>
		</tr>
		<?php endforeach ?>
		</tbody>
	  </table>
	</div>
	<!-- /.col -->
  </div>
  <div class="row">
	<div class="col-12 text-end">
		<div>
			<p>Sub - Total amount  : RP.  <?= number_format($transactions->subtotal,2,',','.') ?></p>
			<p>Diskon (<?= $transactions->discount ?>%)  :  <?=  number_format(($transactions->discount/100)*$transactions->subtotal,2,',','.') ?></p>
			<p>Tax (<?= $transactions->tax ?>%)  :  <?=  number_format(($transactions->tax/100)*$transactions->subtotal,2,',','.') ?></p>
		</div>
		<div class="total-payment">
			<h3><b>Total :</b> RP.  <?= number_format($transactions->total,2,',','.') ?></h3>
		</div>

	</div>
	<!-- /.col -->
  </div>
</section>
<!-- /.content -->
<script src="<?= base_url('assets') ?>/vendor_plugins/JqueryPrintArea/demo/jquery.PrintArea.js"></script>
<script >
	$("#print2").click(function() {
	            var mode = 'iframe'; //popup
	            var close = mode == "popup";
	            var options = {
	                mode: mode,
	                popClose: close
	            };
	            $("section.printableArea").printArea(options);
	        });
</script>