<div class="row" style="margin-top: -30px">
	<div class="col-lg-12">
		<div class="card">
			<form action="<?= base_url('transaksi/tambah_pesanan') ?>" method="post">
				<div class="card-body">
					<div class="pull-left">
						<div class="row">
							<div class="col-lg-6">
								<input type="hidden" name="kd_transaksi" value="<?= $kd ?>">
								<input type="hidden" name="harga" id="harga">
								<input type="hidden" name="total" id="total_harga">
								<input type="text" name="barcode" id="nm_barang" class="form-control" placeholder="Barcode" autofocus="">
							</div>
							<div class="col-lg-6">
								<input type="text" name="qty" id="qty" class="form-control" placeholder="qty">
							</div>
						</div>
						<div class="row mt-3">
							<div class="col-lg-12">
								<button type="submit" class="btn btn-primary btn-block d-none">Submit</button>
							</div>
						</div>
					</div>
					<div class="pull-right">
						<h1 class="harga"></h1>
					</div>
				</div>
			</form>
			<div class="card-footer">
				<div class="pull-right">
					<p>Total Harga : </p>
					<h3 class="d-inline-block">
						<input type="hidden" class="t_harga" value="<?= $t_harga ?>">
						<?= "Rp. " . number_format($t_harga) ?>
					</h3>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row" style="margin-top: -20px">
	<div class="col-lg-6">
		<div class="card">
			<div class="au-card">
				<div class="au-card-inner">
					<div class="table-responsive">
						<table class="table tables">
							<thead>
								<tr>
									<th class="mins">Kode</th>
									<th class="mins">Nama</th>
									<th class="mins">Harga</th>
									<th class="mins">Stok</th>
									<th class="mins">Diskon</th>
									<th class="mins"><i class="fa fa-gears"></i></th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; foreach($barang as $row) : ?>
								<tr>
									<td ><?= $row['kd_barang'] ?></td>
									<td ><?= $row['nm_barang'] ?></td>
									<td ><?= "Rp." . number_format($row['harga_jual']) ?></td>
									<td ><?= $row['stok'] ?></td>
									<td ><?= $row['diskon'] ?></td>
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
	<div class="col-lg-6">
		<div class="card">
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
							<?php $i=1; foreach($detil as $row) : ?>
							<tr data-row-id="1">
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
			</div>
		</div>
	</div>
</div>

<div class="row" style="margin-top: -20px">
	<div class="col-lg-6 offset-6">
		<div class="card">
			<form method="post" action="<?= base_url('transaksi/tambah_transaksi') ?>">
				<div class="card-body">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="tunai">Cash</label>
								<input type="text" name="tunai" id="tunai" class="form-control" placeholder="Cash">
								<?= form_error('tunai','<small style="color:red">','</small>') ?>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for="kembalian">Kembalian</label>
								<input autocomplete="off" readonly type="text" name="kembalian" id="kembalian" class="form-control">
								<?= form_error('kembalian','<small style="color:red">','</small>') ?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Simpan Transaksi</button>
						<button type="submit" class="btn btn-danger btn-block"><i class="fa fa-refresh"></i> Batalkan</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>