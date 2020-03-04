<?php $data = $this->uri->segment(3) ?>
<div class="row">
	<div class="col-lg-12">

		<div class="au-card chart-percent-card">
			<div class="au-card-inner">
				<h4 class="title2">Hapus Detil</h4>
				<a href="<?= base_url('transaksi') ?>" class="btn btn-primary mt-3"><i class="fa fa-arrow-left"></i> Kembali</a>
				<hr>

				<?php if ($this->session->flashdata('error')): ?>
					<div class="alert alert-danger alert-dismissible fade show">
						<button class="close" data-dismiss="alert">
							&times;
						</button>
						<strong>Gagal!</strong>
						<p>Password yang anda masukan salah! Silahkan hubungi admin</p>
					</div>
				<?php endif ?>

				<form method="POST" action="<?= base_url('transaksi/hapus_detil') ?>">
					<input type="hidden" name="kd_barang" value="<?= $data ?>">
					<div class="form-group">
						<label>Masukan Password Admin</label>
						<input type="Password" name="pw" id="file" class="form-control" placeholder="*******">
						<?= form_error('file','<small style="color:red">','</small>') ?>
					</div>
					<div class="form-group">
						<input type="submit" value="Kirim" class="btn btn-primary btn-block">
					</div>
				</form>

			</div>
		</div>
		
	</div>
</div>