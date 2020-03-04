
<div class="row">

	<div class="col-lg-12">

		<div class="au-card chart-percent-card">
			<div class="au-card-inner">
				<h4 class="title2 text-center">Ubah Password</h4>
				<hr>

				<?php if($this->session->flashdata('message')) : ?>
					<div class="alert alert-success"><strong>Berhasil!</strong> Password berhasil <?= $this->session->flashdata('message'); ?></div>
					<?php elseif($this->session->flashdata('error')) : ?>
						<div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
				<?php endif; ?>

				<form method="post">
					<div class="form-group">
						<label>Password Lama</label>
						<input type="password" name="pw_lama" class="form-control" placeholder="Password Lama">
						<?= form_error('pw_lama','<small style="color: red">','</small>') ?>
					</div>
					<div class="form-group">
						<label>Password Baru</label>
						<input type="password" name="pw1" class="form-control" placeholder="Password Baru">
						<?= form_error('pw1','<small style="color: red">','</small>') ?>
					</div>
					<div class="form-group">
						<label>Konfirmasi Password Baru</label>
						<input type="password" name="pw2" class="form-control" placeholder="Konfirmasi Password Baru">
						<?= form_error('pw2','<small style="color: red">','</small>') ?>
					</div>
					<div class="form-group">
						<input type="submit" value="submit" class="btn btn-primary btn-block">
					</div>
				</form>


			</div>
		</div>
		
	</div>
</div>