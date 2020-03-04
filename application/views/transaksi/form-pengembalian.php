<?php $data = $this->uri->segment(3) ?>
<div class="row">
	<div class="col-lg-12">
		<div class="au-card chart-percent-card">
			<div class="au-card-inner">
				<h4 class="card-title"><?= $judul ?></h4>
				<hr>

				<a href="<?= base_url('transaksi/pengembalian') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>

				<form method="post" class="mt-3">


					<?php if ($data): ?>
						<input type="hidden" name="kd_kembali" value="<?= $kembali['kd_kembali'] ?>">
					<?php endif ?>

						<div class="form-group">
							<label>Tanggal</label>
							<input type="date" name="tgl" class="form-control" value="<?= empty($data) ? '' : $kembali['tgl'] ?>" >
						</div>
						<div class="form-group">
							<label>Nama Barang</label>
							<select name="kd_barang" class="form-control select2">

								<?php foreach($barang as $row) : ?>
									<option value="<?= $row['kd_barang'] ?>" <?= empty($data) ? '' : $row['kd_barang'] == $kembali['kd_barang'] ? "selected" : "" ?>><?= $row['nm_barang'] ?></option>
								<?php endforeach; ?>
								
							</select>
						</div>						
						<div class="form-group">
							<label for="jumlah">Jumlah</label>
							<input type="text" name="jumlah" id="jumlah" class="form-control" <?= empty($data) ? "placeholder='Jumlah'" : "value='" . $kembali['jumlah'] . "'" ?>>
							<?= form_error('jumlah','<small style="color:red">','</small>') ?>
						</div>
						<div class="form-group">
							<label for="keterangan">Keterangan</label>
							<textarea name="keterangan" cols="30" rows="10" class="form-control" <?= empty($data) ? "placeholder='Keterangan'" : "" ?>><?= empty($data) ? '' : $kembali['keterangan'] ?></textarea>
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