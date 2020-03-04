<?php $data = $this->uri->segment(3) ?>
<div class="row">
	<div class="col-lg-12">
		<div class="au-card chart-percent-card">
			<div class="au-card-inner">
				<h4 class="card-title"><?= empty($data) ? "Tambah Data" : "Edit Data" ?></h4>
				<hr>

				<a href="<?= base_url('master') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>

				<form method="post" class="mt-3" enctype="multipart/form-data">
					<?php if ($data): ?>
						<input type="hidden" name="kd_barang" value="<?= $barang['kd_barang'] ?>">
						
					<?php endif ?>
					<div class="form-group">
						<?php if ($data): ?>
							<input type="checkbox" name="ada_barcode" id="ada_barcode" value="1" <?= $barang['ada_barcode'] == 1 ? 'checked' : '' ?>>
						<?php else: ?>
							<input type="checkbox" name="ada_barcode" id="ada_barcode" value="1">
						<?php endif; ?>
						<label for="ada_barcode">Ada Barcode</label>
					</div>
					<div class="form-group">
						<label>Barcode</label>
						<input type="text" name="barcode" class="form-control" <?= empty($data) ? "placeholder='Barcode'" : "value='" . $barang['barcode'] . "'" ?> value="<?= set_value('barcode') ?>">
						<?= form_error('barcode','<small style="color: red">','</small>') ?>
					</div>
					<div class="form-group">
						<label>Nama Barang</label>
						<input type="text" name="nm_barang" class="form-control" <?= empty($data) ? "placeholder='Nama barang'" : "value='" . $barang['nm_barang'] . "'" ?> value="<?= set_value('nm_barang') ?>">
						<?= form_error('nm_barang','<small style="color: red">','</small>') ?>
					</div>
					<div class="form-group">
						<label>Departemen</label>
						<select name="kd_departemen" class="form-control select2" id="kd_departemen">
							<option> -- Pilih Departemen --</option>

							<?php foreach($departemen as $row) : ?>
								<option value="<?= $row['kd_departemen'] ?>" <?= !empty($data) ? $row['kd_departemen'] == $barang['kd_departemen'] ? 'selected' : '' : '' ?>> <?= $row['nm_departemen'] ?></option>
							<?php endforeach; ?>
						</select>
						<?= form_error('kd_departemen','<small style="color: red">','</small>') ?>							
					</div>
					<div class="form-group">
						<label>Kelas</label>
						<select name="kd_kelas" class="form-control select2" id="kd_kelas">
							<option> -- Pilih Kelas --</option>

						</select>
						<?= form_error('kd_kelas','<small style="color: red">','</small>') ?>
					</div>
					<div class="form-group">
						<label>Supplier</label>
						<select name="kd_supplier" class="form-control select2">
							<option> -- Pilih Supplier --</option>

							<?php foreach($supplier as $row) : ?>
								<option value="<?= $row['kd_supplier'] ?>" <?= !empty($data) ? $row['kd_supplier'] == $barang['kd_supplier'] ? 'selected' : '' : '' ?>><?= $row['nm_supplier'] ?></option>
							<?php endforeach; ?>
							
						</select>
						<?= form_error('kd_supplier','<small style="color: red">','</small>') ?>
					</div>
					<div class="form-group">
						<label>Harga beli</label>
						<input type="text" name="harga_beli" class="form-control" <?= empty($data) ? "placeholder='Harga Beli'" : "value='" . $barang['harga_beli'] . "'" ?> value="<?= set_value('harga_beli') ?>">
						<?= form_error('harga_beli','<small style="color: red">','</small>') ?>
					</div>
					<div class="form-group">
						<label>Harga jual</label>
						<input type="text" name="harga_jual" class="form-control" <?= empty($data) ? "placeholder='Harga jual'" : "value='" . $barang['harga_jual'] . "'" ?> value="<?= set_value('harga_jual') ?>">
						<?= form_error('harga_jual','<small style="color: red">','</small>') ?>
					</div>
					<div class="form-group">
						<label>Diskon (%)</label>
						<input type="text" name="diskon" class="form-control" <?= empty($data) ? "placeholder='Diskon'" : "value='" . $barang['diskon'] . "'" ?> value="<?= set_value('diskon') ?>">
						<?= form_error('diskon','<small style="color: red">','</small>') ?>
					</div>
					<div class="form-group">
						<label>Stok</label>
						<input type="text" name="stok" class="form-control" <?= empty($data) ? "placeholder='stok'" : "value='" . $barang['stok'] . "'" ?> value="<?= set_value('stok') ?>">
						<?= form_error('stok','<small style="color: red">','</small>') ?>
					</div>
					<div class="form-group">
						<label>Gambar</label>
						<input type="file" name="gambar" class="form-control" <?= empty($data) ? "required" : "" ?> value="<?= set_value('diskon') ?>">
					</div>
					<?php if($data) : ?>
					<div class="form-group">
						<label>Gambar Sebelumnya</label>
						<br>
						<img src="<?= base_url('assets/img/barang/') . $barang['gambar'] ?>" width="300">
					</div>
				<?php endif; ?>
					<div class="form-group">
						<input type="submit" value="submit" class="btn btn-primary btn-block">
					</div>
					
				</form>


			</div>
		</div>
	</div>
</div>