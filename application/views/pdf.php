<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= web()->name.' | '.$title ?></title>
	<meta name="description" content="<?= web()->seo_description ?>">
    <meta name="author" content="<?= web()->name ?>">    
    <link rel="shortcut icon" href="<?= base_url(web()->icon) ?>"> 
    <style>
    	hr{
    		border: 0.7px solid black;
    	}

    	h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
		    margin-top: 0;
		    margin-bottom: 0;
		}

		.text-top {
			vertical-align: top;
		}
    </style>
</head>
<body>
	<table width="100%" cellspacing="0">
		<tr>
			<td class="" width="30%" style="text-align: center;">
				<img src="<?= base_url(web()->logo) ?>" alt="Logo" width="75%">
			</td>
			<td class="" style="padding-left: 10px;">
				<p>
					<span style="font-size: 16px; font-weight: bold;"><?= web()->name ?></span> <br>
					<span style="font-size: 14px;"><?= web()->address ?></span> <br>
					<span style="font-size: 12px;"><?= web()->phone ?> | <?= web()->email ?></span>
				</p>
			</td>
		</tr>
	</table>
	<hr>
	<table width="100%">
		<caption style="margin: 30px 0px;"><h3><u>Hasil Diagnosis Penyakit</u></h3></caption>
		<tr>
			<td class="text-top" colspan="3">
				<h4><u>Data Pasien</u></h4>
			</td>
		</tr>
		<tr>
			<td class="text-top">Nama Pemilik</td>
			<td class="text-top" width="1%" style="text-align: right;">:</td>
			<td class="text-top"><?= $history->owner ?></td>
		</tr>
		<tr>
			<td class="text-top">Nama Hewan</td>
			<td class="text-top" width="1%" style="text-align: right;">:</td>
			<td class="text-top"><?= $history->pet_name ?></td>
		</tr>
		<tr>
			<td class="text-top">Jenis Kelamin Hewan</td>
			<td class="text-top" width="1%" style="text-align: right;">:</td>
			<td class="text-top"><?= $history->pet_gender ?></td>
		</tr>
		<tr>
			<td class="text-top">No. Telepon</td>
			<td class="text-top" width="1%" style="text-align: right;">:</td>
			<td class="text-top"><?= $history->phone ?></td>
		</tr>
		<tr>
			<td class="text-top">Alamat</td>
			<td class="text-top" width="1%" style="text-align: right;">:</td>
			<td class="text-top"><?= $history->address ?></td>
		</tr>
		<tr>
			<td class="text-top" colspan="3" style="padding: 10px;"></td>
		</tr>
		<tr>
			<td class="text-top" colspan="3">
				<h4><u>Hasil Diagnosis</u></h4>
			</td>
		</tr>
        <?php if ($history->disease_id): ?>
		<tr>
			<td class="text-top">Penyakit</td>
			<td class="text-top" width="1%" style="text-align: right;">:</td>
			<td class="text-top"><?= $history->disease->name ?></td>
		</tr>
		<tr>
			<td class="text-top">Gejala</td>
			<td class="text-top" width="1%" style="text-align: right;">:</td>
			<td class="text-top">
				<ol style="margin: 0;">
				<?php foreach ($symptoms as $value): ?>
					<li><?= $value->code.' - '.$value->name ?></li>
				<?php endforeach ?>
				</ol>
			</td>
		</tr>
		<tr>
			<td class="text-top">Penyebab</td>
			<td class="text-top" width="1%" style="text-align: right;">:</td>
			<td class="text-top"><?= $history->disease->reason ?></td>
		</tr>
		<tr>
			<td class="text-top">Solusi</td>
			<td class="text-top" width="1%" style="text-align: right;">:</td>
			<td class="text-top"><?= $history->disease->solution ?></td>
		</tr>
        <?php else: ?>
        <tr>
			<td class="text-top" colspan="3">
                Mohon Maaf, sistem tidak dapat mendiagnosis penyakit hewan peliharaan Anda. Silahkan kirim pesan melalui kritik dan saran.
			</td>
		</tr>
        <?php endif ?>
	</table>
	<hr>
	<p style="margin-top: 10px;">
		Hasil laporan dibuat dengan aplikasi <b><?= ucwords(strtolower(web()->name)) ?></b> berbasis web, menggunakan metode Forward Chaining.
	</p>
</body>
</html>