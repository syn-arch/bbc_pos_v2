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
				<hr>

				<div class="table-responsive">

					<table class="table tables">
						<thead>
							<tr>
								<th>#</th>
								<th>Kode Transaksi</th>
								<th>Tanggal</th>
								<th>Total</th>
								<th>Tunai</th>
								<th><i class="fa fa-gear"></i></th>
							</tr>
						</thead>
						<tbody>

					<?php $no=1; foreach ($transaksi as $row): ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $row['kd_transaksi'] ?></td>
								<td><?= $row['tgl'] ?></td>
								<td><?= "Rp. " . number_format($row['total']) ?></td>
								<td><?= "Rp. " . number_format($row['tunai']) ?></td>
								<td>
									<a href="<?= base_url('laporan/detil/') . $row['kd_transaksi'] ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
									<a href="<?= base_url('laporan/hapus/') . $row['kd_transaksi'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
								</td>
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
				<hr>

				<div class="table-responsive">

					<table class="table tables">
						<thead>
							<tr>
								<th>#</th>
								<th>Kode Transaksi</th>
								<th>Tanggal</th>
								<th>Total</th>
								<th>Tunai</th>
								<th><i class="fa fa-gear"></i></th>
							</tr>
						</thead>
						<tbody>

					<?php $no=1; foreach ($data as $row): ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $row['kd_transaksi'] ?></td>
								<td><?= $row['tgl'] ?></td>
								<td><?= "Rp. " . number_format($row['total']) ?></td>
								<td><?= "Rp. " . number_format($row['tunai']) ?></td>
								<td>
									<a href="<?= base_url('laporan/detil/') . $row['kd_transaksi'] ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
									<a href="<?= base_url('laporan/hapus/') . $row['kd_transaksi'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
								</td>
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