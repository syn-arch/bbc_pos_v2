
<?php $data = $this->uri->segment(3) ?>

<div class="row">
	<div class="col-lg-12">
		<div class="au-card chart-percent-card">
			<div class="card-inner">
				<h3><?= empty($data) ? 'Tambah Data' : 'Edit Data' ?></h3>
				<hr>
				<a href="<?= base_url('master/petugas') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
				<br><br>

				<form method="post" enctype="multipart/form-data">
					<?php if ($data): ?>
						<input type="hidden" name="kd_user" value="<?= $petugas['kd_user'] ?>">
					<?php endif ?>
					<div class="form-group">
						<label>Nama Petugas</label>
						<input type="text" class="form-control" name="nm_user" <?= empty($data) ? 'placeholder="Nama Petugas"' : "value='" . $petugas['nm_user'] . "'" ?>>
						<?= form_error('nm_user','<small style="color: red;">','</small>') ?>
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<input type="text" class="form-control" name="alamat" <?= empty($data) ? 'placeholder="Alamat"' : "value='" . $petugas['alamat'] . "'" ?>>
						<?= form_error('alamat','<small style="color: red;">','</small>') ?>
					</div>
					<div class="form-group">
						<label>Telepon</label>
						<input type="text" class="form-control" name="telepon" <?= empty($data) ? 'placeholder="08xxx"' : 'value=' . $petugas['telepon'] ?>>
						<?= form_error('telepon','<small style="color: red;">','</small>') ?>
					</div>
					<div class="form-group">
						<label>Jenis Kelamin</label>
						<select name="jk" class="form-control">
							<option value="Laki-Laki" <?= !empty($data) ? $petugas['jk'] == "Laki-Laki" ? 'selected' : '' : '' ?>>Laki-Laki</option>
							<option value="Perempuan" <?= !empty($data) ? $petugas['jk'] == "Perempuan" ? 'selected' : '' : '' ?>>Perempuan</option>
						</select>
					</div>
					<div class="form-group">
						<label>E-mail</label>
						<input type="text" class="form-control" name="email" <?= empty($data) ? 'placeholder="contoh@mail.com"' : 'value=' . $petugas['email'] ?>>
						<?= form_error('email','<small style="color: red;">','</small>') ?>
					</div>
					<div class="form-group">
						<label>Role</label>
						<select name="id_role" class="form-control">

							<?php foreach($role as $row) : ?>

								<option value="<?= $row['id'] ?>" <?= !empty($data) ? $row['id'] == $petugas['id_role'] ? 'selected' : '' : '' ?> ><?= $row['nm_role'] ?></option>

							<?php endforeach; ?>
							
						</select>
					</div>

					<div class="form-group">
						<label>Gambar</label>
						<input type="file" name="gambar" class="form-control" <?= empty($data) ? 'required' : '' ?>>
					</div>

					<?php if(!empty($data)) : ?>

					<div class="form-group">
						<label>Gambar Sebelumnya</label><br>
						<img src="<?= base_url('assets/img/user/') . $petugas['gambar'] ?>" width="300">
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