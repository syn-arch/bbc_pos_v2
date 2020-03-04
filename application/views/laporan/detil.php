<div class="row">
	<div class="col-lg-12">

		<div class="au-card chart-percent-card">
			<div class="au-card-inner">
				<h4 class="text-center">Detail Transaksi <?= $transaksi[0]['kd_transaksi'] ?></h4>
				<hr>

				<div class="row">
					<div class="col-lg-2">
						<h4>Tanggal</h4>
					</div>
					<div class="col-lg-3">
						<p><?= $transaksi[0]['tgl'] ?></p>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-lg-2">
						<h4>Karyawan</h4>
					</div>
					<div class="col-lg-3">
						<p><?= $transaksi[0]['nm_user'] ?></p>
					</div>
				</div>

				<div class="table-responsive mt-3">

					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Deskripsi Barang</th>
								<th>Harga Jual</th>
								<th>Diskon (%)</th>
								<th>Total Harga</th>
								<th>Qty</th>
								<th>Total Bayar</th>
							</tr>
						</thead>
						<tbody>

					<?php $no=1; foreach ($transaksi as $row): ?>

						<?php 

						$diskon = $row['diskon'] / 100 * $row['harga_jual'];
						$t_harga = $row['harga_jual'] - $diskon;


						 ?>

							<tr>
								<td><?= $no++ ?></td>
								<td><?= $row['nm_barang'] ?></td>
								<td><?= "Rp. " . number_format($row['harga_jual']) ?></td>
								<td><?= $row['diskon'] ?></td>
								<td><?= "Rp. " . number_format($t_harga) ?></td>
								<td><?= $row['qty'] ?></td>
								<td><?= "Rp. " . number_format($row['total']) ?></td>
							</tr>
					<?php endforeach ?>

						</tbody>
					</table>
				</div>

				<div class="container pr-4">

					<div class="row mt-3">
						<div class="col-lg-12">
							<h4 class="float-right">
								Sub Total : <?= "Rp. " . number_format($transaksi[0]['total_bayar']) ?>
							</h4>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-lg-12">
							<h4 class="float-right">
								Tunai : <?= "Rp. " . number_format($transaksi[0]['tunai']) ?>
							</h4>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-lg-12">
							<h4 class="float-right">
								Kembalian : <?= "Rp. " . number_format($transaksi[0]['tunai'] - ($transaksi[0]['total_bayar'])) ?>
							</h4>
						</div>
					</div>

				</div>

				<div class="row">
					<div class="col-lg-12">
						<a href="<?= base_url('laporan/riwayat') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
						<a href="<?= base_url('transaksi/invoice/') . $transaksi[0]['kd_transaksi'] ?>" target="_blank" class="btn btn-warning"><i class="fa fa-print"></i> Cetak Struk</a>
					</div>
				</div>

						
					
			</div>
		</div>
		
	</div>
</div>