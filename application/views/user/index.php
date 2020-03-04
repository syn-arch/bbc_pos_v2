<div class="row">
	<div class="col-lg-12">
		<?php if($this->session->flashdata('message')) : ?>
				<div class="alert alert-success">Data berhasil <?= $this->session->flashdata('message'); ?></div>
			<?php elseif ($this->session->flashdata('error')) : ?>
				<div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
		<?php endif; ?>
	</div>
</div>

<div class="row">

	<div class="col-lg-6">

		<div class="au-card chart-percent-card">
			<div class="au-card-inner">
				<h4 class="title2 text-center">Gambar</h4>
				<hr>
				<img src="<?= base_url('assets/img/user/') . $profile['gambar'] ?>" alt="" class="img-responsive">
			</div>
		</div>
		
	</div>

	<div class="col-lg-6">
		<div class="au-card	 chart-percent-card">
			<div class="au-card-inner">
				<h4 class="title2 text-center">My Profile</h4>
				<hr>
				<h4>Nama</h4>
				<p class="mb-3 mt-1"><?= $profile['nm_user'] ?></p>
				<h4>Alamat</h4>
				<p class="mb-3 mt-1"><?= $profile['alamat'] ?></p>
				<h4>Telepon</h4>
				<p class="mb-3 mt-1"><?= $profile['telepon'] ?></p>
				<h4>Jenis Kelamin</h4>
				<p class="mb-3 mt-1"><?= $profile['jk'] ?></p>
				<h4>email</h4>
				<p class="mb-3 mt-1"><?= $profile['email'] ?></p>
				<a href="<?= base_url('user/edit_profile') ?>" class="btn btn-primary btn-block"><i class="fa fa-edit"></i> Edit Profile</a>
			</div>
		</div>
	</div>
</div>