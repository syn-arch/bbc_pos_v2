<div class="row" style="margin-top: -30px">
	<div class="col-lg-6">
		<div class="card">
			<div class="my-2 mx-3">
				<h5 class="card-title float-left">Transaksi Baru</h5>
				<h5 class="float-right"><?= date("Y-m-d") ?></h5>
				<br>
			<hr>
			</div>
			<div class="card-body">
				<form method="post" action="<?= base_url('transaksi/tambah_pesanan') ?>" style="margin-top: -30px">
					<input autocomplete="off" type="hidden" name="kd_transaksi" value="<?= $kd ?>">
					<div class="row mt-3">
						<div class="col-lg-6">
							<div class="form-group">
								<label class="mins" for="nm_barang">Barang</label>
								<input type="text" name="barcode" id="nm_barang" class="form-control"autocomplete="off">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label class="mins" for="harga">Harga</label>
								<input autocomplete="off" readonly type="text" name="harga" id="harga" class="form-control pp-mins">
								<?= form_error('harga','<small style="color:red">','</small>') ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label class="mins" for="qty">Qty</label>
								<input autocomplete="off" type="text" name="qty" id="qty" class="form-control pp-mins">
								<?= form_error('qty','<small style="color:red">','</small>') ?>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label class="mins" for="total_harga">Total Harga</label>
								<input autocomplete="off" readonly type="text" name="total" id="total_harga" class="form-control pp-mins">
								<?= form_error('total_harga','<small style="color:red">','</small>') ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<input autocomplete="off" type="submit" class="btn btn-primary btn-block" value="Tambahkan">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="card">
			<div class="my-2 mx-3" style="">
				<h5 class="card-title">Konfirmasi Pembayaran</h5>
				<hr>
			</div>
			<div class="card-body">
				<form method="post" action="<?= base_url('transaksi/tambah_transaksi') ?>">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label class="mins" for="tunai">Tunai</label>
								<input autocomplete="off" type="text" name="tunai" id="tunai" class="form-control pp-mins" placeholder="tunai">
								<?= form_error('tunai','<small style="color:red">','</small>') ?>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label class="mins" for="kembalian">Kembalian</label>
								<input autocomplete="off" readonly type="text" name="kembalian" id="kembalian" class="form-control pp-mins">
								<?= form_error('kembalian','<small style="color:red">','</small>') ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<input autocomplete="off" type="submit" value="Konfirmasi" class="btn btn-primary btn-block">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="my-2 mx-auto mt-4" style="">
				<h5 class="card-title">Detail Transaksi</h5>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-borderless">
						<thead>
							<tr>
								<th class="mins">#</th>
								<th class="mins">Nama Barang</th>
								<th class="mins">Qty</th>
								<th class="mins">Total Harga</th>
								<th><i class="fa fa-gears"></i></th>
							</tr>
						</thead>
						<tbody>

						<?php $i=1; foreach($detil as $row): ?>
							<tr>
								<td><?= $i++ ?></td>
								<td><?= $row['nm_barang'] ?></td>
								<td><?= $row['qty'] ?></td>
								<td><?= "Rp. " . number_format($row['total']) ?></td>
								<td>
									<a href="<?= base_url('transaksi/auth_delete/') . $row['id'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						<?php endforeach; ?>

						</tbody>
					</table>
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-12">
						<h5>Total :</h5>
						<p class="mt-1"><?= "Rp. " . number_format($t_harga) ?></p>
						<input autocomplete="off" type="hidden" class="t_bayar" value="<?= $t_harga ?>">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="card">
			<h4 class="text-center mt-3">Daftar Barang tanpa barcode</h4>
			<div class="au-card chart-percent-card">
			<div class="au-card-inner">
				<div class="table-responsive">
					<table class="table tables">
						<thead>
							<tr>
								<th>Kode Barang</th>
								<th>Nama</th>
								<th>Harga Jual</th>
								<th>Stok</th>
								<th>Diskon (%)</th>
								<th><i class="fa fa-gears"></i></th>
							</tr>
						</thead>
						<tbody>

							<?php $i = 1; foreach($barang as $row) : ?>
							<tr>
								<td><?= $row['kd_barang'] ?></td>
								<td><?= $row['nm_barang'] ?></td>
								<td><?= "Rp." . number_format($row['harga_jual']) ?></td>
								<td><?= $row['stok'] ?></td>
								<td><?= $row['diskon'] ?></td>
								<td>
									<a data-kd="<?= $row['kd_barang'] ?>" class="btn btn-warning brgNoBcd"><i class="fa fa-plus"></i></a>
								</td>
							</tr>

						<?php endforeach; ?>
							
						</tbody>
					</table>
				</div>

			</div>
			</div>
		</div>
	</div>
</div>