<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/dist/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/dist/css/responsive.bootstrap4.min.css" />
        <!-- jQuery -->
  <script type="text/javascript" src="<?php echo base_url(); ?>asset/dist/js/3.3.1jquery.js"></script>
  <script src="<?php echo base_url(); ?>asset/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <script src="<?php echo base_url(); ?>asset/dist/js/sweetalert2@11.js"></script>

  </style>
</head>
<body style="padding: 50px;">
<!-- Site wrapper -->
<div class="row" style="border-bottom: 1px #000000 double;">
	<div class="col-md-2">
    	<img src="<?php echo base_url(); ?>asset/images/beraslogo1.png" width="100%" style="margin-left: 30%; margin-top: 20px;">
    </div>
    <div class="col-md-10" style="text-align: center; margin-left: -8%;">
    	<h2 style="font-weight: 600;">CV. Sukses Mandiri</h2>
    	<h3 style="font-size: 19px; font-weight: 600;">Distributor Sembako</h3>
    	<p>Kantor & Gudang : Jln. Adisucipto, Pergudangan Sakura Biz No. J7 & I7</p>
    	<p>No Hp. 082150307228</p>
    	<p>PONTIANAK</p>
    </div>
  
</div>

<div class="row">
	<div class="col-md-12"> 
		<br />
		<br />
		<?php foreach($dataprintprojectheader as $row){?>
		<table>
			<tr>
				<td>Nomor</td>
				<td>:</td>
				<td><?php echo $row->project_header_number ?></td>
			</tr>
		</table>
		<?php echo $row->project_text ?>
		<?php /*
			<tr>
				<td>Lampiran</td>
				<td>:</td>
				<td> - </td>
			</tr>

			<tr>
				<td>Perihal</td>
				<td>:</td>
				<td style="text-decoration: underline; font-weight: 800;"> Surat Penawaran</td>
			</tr>

		</table>
		<br />
		<p>Kepada Yth,</p>
		<p style="font-weight: 800;"><?php echo $row->project_customer ?></p>
		<p>Di-</p>
		<p><?php echo $row->project_address ?></p>
		<p>Dengan Hormat,</p>
		<p>Bersama surat ini, Kami dari CV. Sukses Mandiri memberikan harga beras untuk tender <?php echo $row->project_term; ?> bulan ke depan di mulai <?php $date = date_create($row->project_start); echo date_format($date,"m-Y"); ?> sampai dengan <?php $date = date_create($row->project_end); echo date_format($date,"m-Y"); ?> dengan rincian sebagai berikut:</p>
		<br />
	<?php } ?>
		<table border="1">
			
			<tr>
				<th width="250px;">Nama Perusahaan</th>
				<th width="250px;">Harga Beras + Biaya Pengiriman</th>
			</tr>
			<?php foreach($datas['dataprintprojectdetail'] as $row){?>
			<tr>
				<td><?php echo $row->project_detail_pt; ?></td>
				<td style="padding-left: 10px;">Rp <?php echo number_format($row->project_detail_price); ?>,-</td>
			</tr>

			<?php } ?>

		</table>

		<br />

		<p>Note:</p>
		<p>- Pembayaran Tunai/ Cash Dan dapat di transfer ke Rekening BCA 5125019118 atas nama CV SUKSES MANDIRI</p>
		<p>Demikian penawaran ini kami sampaikan , Atas perhatian dan kerjasamanya kami ucapkan terima kasih</p>
		*/ ?>
	<?php } ?>
		<br />
		<p>Hormat kami,</p>
		<img src="<?php echo base_url(); ?>asset/images/logocap.png">

		<p style="font-size: 18px; font-weight: 800;">CV.SUKSES MANDIRI</p>
	</div>
</div>
    <!-- end popup Edit -->
</body>
</html>