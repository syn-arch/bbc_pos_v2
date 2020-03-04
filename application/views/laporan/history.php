<div class="row" style="margin-top: -20px">
	<div class="col-lg-12">

		<div class="au-card chart-percent-card">
			<div class="au-card-inner">
				<h4 class="title2"><?= $judul ?></h4>
				<hr>
				<form method="post">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label for="dari">Dari Tanggal</label>
							<input type="date" name="dari" id="dari" class="form-control">
							<?= form_error('dari','<small style="color:red">','</small>') ?>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="sampai">Sampai Tanggal</label>
							<input type="date" name="sampai" id="sampai" class="form-control">
							<?= form_error('sampai','<small style="color:red">','</small>') ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<input type="submit" value="Submit" class="btn btn-primary btn-block">
					</div>
				</div>
				</form>
			</div>
		</div>
		
	</div>
</div>


<?php if (!isset($data)): ?>
	
<div class="row" style="margin-top: -40px">
	<div class="col-lg-12">

		<div class="au-card chart-percent-card">
			<div class="au-card-inner">
				<h4 class="title2"><?= $judul ?> Hari Ini</h4>
				<a href="<?= base_url('excel/ekspor_laporan') ?>" class="btn btn-success mt-3"><i class="fa fa-sign-in-alt"></i> Ekspor</a>
				<hr>

				<div class="table-responsive">

					<table class="table tables">
						<thead>
							<tr>
								<th>#</th>
								<th>Kode</th>
								<th>Barcode</th>
								<th>Nama Barang</th>
								<th>Barang Terjual</th>
								<th>Harga Beli</th>
								<th>Harga Jual</th>
								<th>Profit</th>
								<th>Laba</th>
							</tr>
						</thead>
						<tbody>

					<?php $no=1; foreach ($transaksi as $row): ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $row['kd_barang'] ?></td>
								<td><?= $row['barcode'] ?></td>
								<td><?= $row['nm_barang'] ?></td>
								<td><?= $row['brg_terjual'] ?></td>
								<td><?= "Rp. " . number_format($row['harga_beli']) ?></td>
								<td><?= "Rp. " . number_format($row['harga_jual']) ?></td>
								<td><?= "Rp. " . number_format($row['profit']) ?></td>
								<td><?= "Rp. " . number_format($row['laba']) ?></td>
							</tr>
					<?php endforeach ?>

						</tbody>
					</table>
				</div>
				<h5>Jumlah Pendapatan :</h5>
				<p><?= "Rp. " . number_format($p_hari_ini) ?></p>
			</div>
		</div>
		
	</div>
</div>
<?php endif ?>

<?php if (isset($data)): ?>
<div class="row" style="margin-top: -40px">
	<div class="col-lg-12">

		<div class="au-card chart-percent-card">
			<div class="au-card-inner">
				<h4 class="title2"><?= $judul ?> Dari tahun <?= $dari ?> sampai tahun <?= $sampai ?></h4>
				<a href="<?= base_url('excel/eksporByDate/') . $dari . '/' . $sampai ?>" class="btn btn-success mt-3"><i class="fa fa-sign-in-alt"></i> Ekspor</a>

				<hr>

				<div class="table-responsive">

					<table class="table tables">
						<thead>
							<tr>
								<th>#</th>
								<th>Kode</th>
								<th>Barcode</th>
								<th>Nama Barang</th>
								<th>Barang Terjual</th>
								<th>Harga Beli</th>
								<th>Harga Jual</th>
								<th>Profit</th>
								<th>Laba</th>
							</tr>
						</thead>
						<tbody>

					<?php $no=1; foreach ($data as $row): ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $row['kd_barang'] ?></td>
								<td><?= $row['barcode'] ?></td>
								<td><?= $row['nm_barang'] ?></td>
								<td><?= $row['brg_terjual'] ?></td>
								<td><?= "Rp. " . number_format($row['harga_beli']) ?></td>
								<td><?= "Rp. " . number_format($row['harga_jual']) ?></td>
								<td><?= "Rp. " . number_format($row['profit']) ?></td>
								<td><?= "Rp. " . number_format($row['laba']) ?></td>
							</tr>
					<?php endforeach ?>

						</tbody>
					</table>
				</div>
				<h5>Jumlah Pendapatan :</h5>
				<p><?= "Rp. " . number_format($p_pendapatan) ?></p>
			</div>
		</div>
		
	</div>
</div>
<?php endif ?>