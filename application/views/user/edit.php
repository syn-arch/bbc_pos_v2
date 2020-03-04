<div class="row">
	<div class="col-lg-12">
		<div class="au-card chart-percent-card">
			<div class="au-card-inner">
				<h4 class="card-title">Edit Profile</h4>
				<hr>

				<form method="post" enctype="multipart/form-data">
					<input type="hidden" name="kd_user" value="<?= $profile['kd_user'] ?>">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nm_user" class="form-control" value="<?= $profile['nm_user'] ?>">
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<input type="text" name="alamat" class="form-control" value="<?= $profile['alamat'] ?>">
					</div>
					<div class="form-group">
						<label>Telepon</label>
						<input type="text" name="telepon" class="form-control" value="<?= $profile['telepon'] ?>">
					</div>
					<div class="form-group">
						<label>Jenis Kelamin</label>
						<select name="jk" class="form-control">
							<option value="Laki-Laki" <?= $profile['jk'] == "Laki-Laki" ? 'selected' : '' ?>>Laki-Laki</option>
							<option value="Perempuan" <?= $profile['jk'] == "Perempuan" ? 'selected' : '' ?>>Perempuan</option>
						</select>
					</div>
					<div class="form-group">
						<label>E-mail</label>
						<input type="text" name="email" class="form-control" value="<?= $profile['email'] ?>">
						<?= form_error('email','<small style="color:red">','</small>') ?>
					</div>
					<div class="form-group">
						<label>Gambar</label>
						<input type="file" name="gambar" class="form-control">
					</div>
					<div class="form-group">
						<img src="<?= base_url('assets/img/user/') . $profile['gambar'] ?>" class="img-fluid" width="300">
					</div>


					<input type="submit" value="submit" class="btn btn-primary btn-block">
					
				</form>


			</div>
		</div>
	</div>
</div>