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
    $filename = $datas['get_pencuciangajiexcell'][0]->pencucian_detail_purchase_code;
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=".$filename .".xls");
	?>

    <table border="1">
        <tr>
            <th colspan="4">Total Pembayaran  <?php echo $filename  ?></th>
        </tr>
        <tr>
                <th>No Nota</th>
                <th>Nama Karyawan</th>
                <th>Total Gram</th>
                <th>Total Bayar</th>
        </tr>
        <?php foreach($datas['get_pencuciangajiexcell_perorang'] as $row){?>
        <tr>    
                <td><?php echo $row->pencucian_detail_purchase_code; ?></td>
                <td><?php echo $row->employee_name; ?></td>
                <td><?php echo $row->total_gram; ?></td>
                <td><?php echo 'Rp. '.number_format($row->total_bayar); ?></td>
        </tr>   
        <?php }  ?>
    </table>
    <br /><br />
	<table border="1">
        <tr>
            <th colspan="7">Detail Pembayaran  <?php echo $filename  ?></th>
        </tr>
		<tr>
				<th>No Nota</th>
                <th>Nama Karyawan</th>
                <th>Kode Bahan Bersih</th>
                <th>Nama Bahan Bersih</th>
                <th>Gram</th>
                <th>Biaya Cuci</th>
                <th>Total Bayar</th>
		</tr>
        <?php foreach($datas['get_pencuciangajiexcell'] as $row){?>
		<tr>	
				<td><?php echo $row->pencucian_detail_purchase_code; ?></td>
                <td><?php echo $row->employee_name; ?></td>
                <td><?php echo $row->bahan_bersih_code; ?></td>
                <td><?php echo $row->bahan_bersih_name; ?></td>
                <td><?php echo $row->pencucian_detail_gram; ?></td>
                <td><?php echo 'Rp. '.number_format($row->bahan_bersih_biaya_cuci); ?></td>
                <td><?php echo 'Rp. '.number_format($row->total_bayar); ?></td>
		</tr>	
		<?php }  ?>
	</table>
</body>
</html>