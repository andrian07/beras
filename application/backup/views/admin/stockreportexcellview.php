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
$filename = 'Report Stok';
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=".$filename .".xls");
?>


<table border="1">
	<tr>
		<th colspan="3">Report Stock </th>
	</tr>
	<tr>
		<th>Nama Gudang</th>
		<th>Nama Perusahaan</th>
		<th>Nama Produk</th>
		<th>Stok</th>
	</tr>
	<?php foreach($datas['get_reportstock'] as $row){?>
		<tr>	
			<td><?php echo $row->master_gudang_name; ?></td>
			<td><?php echo $row->mastercompany_name; ?></td>
			<td><?php echo $row->master_barang_name; ?></td>
			<td><?php echo number_format($row->master_gudang_stock).' '.$row->unit_name; ?></td>
		</tr>	
	<?php }  ?>
</table>
<br /><br /><br /><br /><br />
<table border="1" style="width:100%; background-color: yellow;" >
	<tr>
		<th colspan="2" style="text-align: center; padding-bottom: 20px;">Data Barang Belum Masuk Gudang</td>
		</tr>
		<tr>
			<th>Nama Produk</th>
			<th>Stok</th>
		</tr>
		<?php foreach ($datas['get_stocknotinputed'] as $row) { ?>
			<tr>
				<td><?php echo $row->master_barang_name; ?></td>
				<td>0</td>
			</tr>

		<?php } ?>
	</table>

</body>
</html>