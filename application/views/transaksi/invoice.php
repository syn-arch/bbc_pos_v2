<?php

$query_trs = "SELECT * FROM transaksi JOIN user USING(kd_user) WHERE kd_transaksi = '$kode' ";
$trs = $this->db->query($query_trs)->row_array();

$query_detil = "SELECT * FROM detil_transaksi JOIN barang USING(kd_barang) WHERE kd_transaksi ='$kode' ";
$psn = $this->db->query($query_detil)->result_array();

$kembali = $trs['tunai'] - $trs['total_bayar'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Invoice</title>
	<style>

		td{
			width: 100px;
			padding: 5px;
		}

		@font-face {
			font-family: "dotmatrix";
			src: url('<?= base_url('assets/font/') . "DOTMATRI.ttf" ?>');
		}

		*{
			font-family: "dotmatrix";
		}

	</style>
</head>
<body onload="pastr()">
	<center>
	<table>
		<tr>
			<td colspan="4"><center> Invoice Transaksi <b><?= $kode ?></b></center></td>
		</tr>
			<td colspan="4"><center>Business Center</center></td>
		</tr>
		</tr>
			<td colspan="4"><center>Jl. Babakan Tiga No.32 Kec.Ciwidey Kab.Bandung</center></td>
		</tr>
		<tr>
			<td colspan="5">=================================================================<td>
		</tr>
		<tr>
			<td>Karyawan</td>
			<td colspan="3"><?= $trs['nm_user'] ?></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td colspan="3"><?= $trs['tgl'] ?></td>
		</tr>
		<tr>
			<td colspan="5">=================================================================<td>
		</tr>
		<tr>
			<td>Deskripsi Barang</td>
			<td>qty</td>
			<td>Total Harga</td>
			<td>Total Bayar</td>
		</tr>
		
	<?php foreach($psn as $p) : ?>

		<?php 
			$diskon = $p['diskon'] / 100 * $p['harga_jual'];
			$t_harga = $p['harga_jual'] - $diskon;
		 ?>

		<tr>
			<td><?= $p['nm_barang'] ?></td>
			<td><?= $p['qty'] ?></td>
			<td><?= "Rp." . number_format($t_harga) ?></td>
			<td><?= "Rp." . number_format($p['total']) ?></td>
		</tr>
	<?php endforeach; ?>

		<tr>
			<td colspan="5">=================================================================<td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>Sub Total</td>
			<td><?= "Rp." . number_format($trs['total_bayar']) ?></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>Tunai</td>
			<td><?= "Rp." . number_format($trs['tunai']) ?></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td colspan="2">---------------------</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>Kembalian</td>
			<td><?=  "Rp." . number_format($kembali) ?></td>
		</tr>
		<tr>
			<td colspan="5">=================================================================<td>
		</tr>
		<tr>
			<td colspan="4"><center><b>Terima kasih!</b> Atas kepercayaan anda. <br>Terus belanja dan dapatkan promo dari kami :)</center></td>
		</tr>
	</table>
</center>
<script>
	function pastr() {
		window.print();
		setTimeout("window.close();", 1000);
	}
</script>
</body>
</html>
