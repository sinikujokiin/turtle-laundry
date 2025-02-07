<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title ?></title>

	<style type="text/css">
		.text-center{
			text-align: center;
		}

		.text-end{
			text-align: right;
		}
		.text-start{
			text-align: left;
		}

		.bold{
			font-weight: bold;
		}

		.mb-1{
			margin-bottom: 0.25rem;
		}
		.mb-2{
			margin-bottom: 0.5rem;
		}
		.mb-3{
			margin-bottom: 0.75rem;
		}

		.mt-1{
			margin-bottom: 0.25rem;
		}
		.mt-2{
			margin-bottom: 0.5rem;
		}
		.mt-3{
			margin-bottom: 0.75rem;
		}
		hr{
    		border: 0.7px solid black;
    	}
    	.p{

    	}

    	table{
			font-size: 12px;
			width: 100%;
		}

		th, td{
			padding: 0.25rem;
		}

		.text-danger{
			color: #ff562f;
		}

	</style>
</head>
<body>
	<div class="text-center">
		<h3><?= $title ?></h3>
		<hr>
	</div>

	<table cellspacing="0" border="1" class="table">
		<thead>
			<tr>
				<th width="1%">No</th>
				<th>Kode Transaksi</th>
				<th>Nama Member</th>
				<th>Tanggal Transaksi</th>
				<th>Status Transaksi</th>
				<th>Status Bayar</th>
				<th>Created By</th>
				<th>SubTotal</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			
			$no = 1; $total = 0; $piutang = 0; foreach ($reports['transactions'] as $value): 
			$total += $value->total;
			if ($value->payment_status == 'belum dibayar') {
				$piutang += $value->total;
			}
			?>
			<tr>
				<td><?= $no++ ?>.</td>
				<td><?= $value->code ?></td>
				<td><?= $value->member->name ?></td>
				<td><?= date("D, d m Y H:i", strtotime($value->created_at)) ?></td>
				<td>
					<?= $value->status ?>
				</td>
				<td>
					<?= $value->payment_status ?>
				</td>
				<td><?= $value->creator->fullname ?></td>
				<td class="text-end">
					<span class="<?= $value->payment_status == 'belum dibayar' ? 'text-danger' : ''  ?>">
						
					<?= number_format($value->total,2,',','.') ?>
					</span>
				</td>
			</tr>
			<?php endforeach ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="7" class="text-end">Jumlah</th>
				<th class="text-end"><?= number_format($total,2,',','.') ?></th>
			</tr>
			<tr>
				<th colspan="7" class="text-end">Piutang</th>
				<th class="text-end text-danger"><?= number_format($piutang,2,',','.') ?></th>
			</tr>
			<tr>
				<th colspan="7" class="text-end">Total</th>
				<th class="text-end"><?= number_format($total-$piutang,2,',','.') ?></th>
			</tr>
		</tfoot>
	</table>


</body>
</html>