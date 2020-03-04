<div class="row">
	<div class="col-lg-12">
		<div class="au-card chart-percent-card">
			<div class="au-card-inner">
				<h4 class="card-title"><?= $judul ?></h4>
				<hr>

				<a href="<?= base_url('transaksi/stok') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>

				<form method="post" class="mt-3">

						<div class="form-group">
							<label>Tanggal</label>
							<input type="date" name="tgl" class="form-control">
							<?= form_error('tgl','<small style="color:red">','</small>') ?>
						</div>
						<div class="form-group">
							<label>Nama Barang</label>
							<select name="kd_barang" class="form-control select2">

								<?php foreach($barang as $row) : ?>
									<option value="<?= $row['kd_barang'] ?>"><?= $row['nm_barang'] ?></option>
								<?php endforeach; ?>
								
							</select>
						</div>
						<div class="form-group">
							<label for="status">Status</label>
							<select name="status" class="form-control">
								<option value="Stok Masuk">Stok Masuk</option>
								<option value="Stok Keluar">Stok Keluar</option>
							</select>
						</div>
						<div class="form-group">
							<label for="jumlah">Jumlah</label>
							<input type="text" name="jumlah" id="jumlah" class="form-control" placeholder="Jumlah">
							<?= form_error('jumlah','<small style="color:red">','</small>') ?>
						</div>
						<div class="form-group">
							<label for="keterangan">Keterangan</label>
							<textarea name="keterangan" cols="30" rows="10" class="form-control" placeholder="Keterangan"></textarea>
							<?= form_error('keterangan','<small style="color:red">','</small>') ?>
						</div>
						<div class="form-group">
							<input type="submit" value="submit" class="btn btn-primary btn-block">
						</div>
					
				</form>

			</div>
		</div>
	</div>
</div>