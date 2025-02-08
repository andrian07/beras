<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;

	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	</style>

	<?php
    $filename = $get_reportpiutang[0]->purchase_faktur_id;
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=".$filename .".xls");
	?>


	<table border="1">
        <tr>
            <th colspan="7">Laporan Piutang </th>
        </tr>
			 	  <tr>
                          <th>No Faktur</th>
                          <th>Pelanggan</th>
                          <th>Tanggal Penjualan</th>
                          <th>Jatuh Tempo</th>
                          <th>Diskon</th>
                           <th>Total</th>
                          <th>Status</th>
                      </tr>
        <?php foreach($get_reportpiutang as $row){?>
		 <tr>
                          <td><?php echo $row->purchase_faktur_id; ?></td>
                          <td><?php echo $row->suplier_name; ?></td>
                          <td><?php $date = date_create($row->purchase_date); echo date_format($date,"d-M-Y"); ?></td>
                          <td><?php $date = date_create($row->purchase_due_date); echo date_format($date,"d-M-Y"); ?></td>
                          <td><?php echo 'Rp. '.number_format($row->purchase_discount); ?></td>
                          <td><?php echo 'Rp. '.number_format($row->purchase_total); ?></td>
                          <td><?php echo $row->purchase_status;?></td>
                      </tr>
		<?php }  ?>
	</table>
</body>
</html>