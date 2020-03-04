<div class="row">
	<div class="col-lg-12">
		<div class="au-card chart-percent-card">
			<div class="au-card-inner">
				<h4 class="card-title">Konfigurasi</h4>
				<hr>
			
			<?php if($this->session->flashdata('message')): ?>
				<div class="alert alert-success"><strong>Berhasil!. </strong>Data Berhasil <?= $this->session->flashdata('message'); ?></div>
			<?php elseif($this->session->flashdata('error')) : ?>
				<div class="alert alert-danger"><strong>Gagal!. </strong><?= $this->session->flashdata('error'); ?></div>
			<?php endif; ?>

				<form method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="nm_toko">Nama Toko</label>
						<input type="text" name="nm_toko" id="nm_toko" class="form-control" value="<?= $config['nm_toko'] ?>">
						<?= form_error('nm_toko','<small style="color:red">','</small>') ?>
					</div>
					<div class="form-group">
						<label for="telepon">Telepon</label>
						<input type="text" name="telepon" id="telepon" class="form-control" value="<?= $config['telepon'] ?>">
						<?= form_error('telepon','<small style="color:red">','</small>') ?>
					</div>
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<input type="text" name="alamat" id="alamat" class="form-control" value="<?= $config['alamat'] ?>">
						<?= form_error('alamat','<small style="color:red">','</small>') ?>
					</div>
					<div class="form-group">
						<label for="keterangan">Deskripsi</label>
						<textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control"><?= $config['keterangan'] ?></textarea>
						<?= form_error('keterangan','<small style="color:red">','</small>') ?>
					</div>
					<div class="form-group">
						<label for="gambar">Logo</label>
						<input type="file" name="gambar" id="gambar" class="form-control">
						<?= form_error('gambar','<small style="color:red">','</small>') ?>
					</div>
					<div class="form-group">
						<img src="<?= base_url('assets/img/admin/') . $config['gambar'] ?>" width="300">
					</div>
					<div class="form-group">
						<input type="submit" value="submit" class="btn btn-primary btn-block">
					</div>
				</form>

			</div>
		</div>
	</div>
</div>