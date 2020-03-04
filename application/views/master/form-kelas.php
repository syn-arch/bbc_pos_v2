<?php $dep = $this->uri->segment(3) ?>
<?php $kd_kelas = $this->uri->segment(4) ?>

<div class="row">
	<div class="col-lg-12">
		<div class="au-card chart-percent-card">
			<div class="au-card-innter">
				<h4 class="card-title"><?= empty($kd_kelas) ? "Tambah kelas" : "Edit kelas" ?></h4>
				<hr>
				<a href="<?= base_url('master/edit_departemen/') . $dep ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>

				<form method="post" class="mt-3">
					<input type="hidden" name="kd_departemen" value="<?= $dep ?>">
					<?php if ($kd_kelas): ?>
						<input type="hidden" name="kd_kelas" value="<?= $kd_kelas ?>">
					<?php endif ?>
					<div class="form-group">
						<label>Nama kelas</label>
						<input type="text" name="nm_kelas" class="form-control" <?= empty($kd_kelas) ? "placeholder='Nama kelas'" : "value='" . $kelas['nm_kelas'] ."'" ?>>
						<?= form_error('nm_kelas', '<small style="color: red">','</small>') ?>
					</div>
					<div class="form-group">
						<input type="submit" value="submit" class="btn btn-primary btn-block">
					</div>
					
				</form>


			</div>
		</div>
	</div>
</div>