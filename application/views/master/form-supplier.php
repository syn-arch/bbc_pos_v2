<?php $data = $this->uri->segment(3) ?>
<div class="row">
	<div class="col-lg-12">
		<div class="au-card chart-percent-card">
			<div class="au-card-inner">
				<h4 class="card-title"><?= empty($data) ? "Tambah Data" : "Edit Data" ?></h4>
				<hr>
				<a href="<?= base_url('master/supplier') ?>" class="btn btn-primary mb-3"><i class="fa fa-arrow-left"></i> Kembali</a>

				<form method="post">
					<?php if ($data): ?>
						<input type="hidden" name="kd_supplier" value="<?= $data ?>">
					<?php endif ?>

					<div class="form-group">
						<label>Nama Supplier</label>
						<input type="text" name="nm_supplier" class="form-control" <?= empty($data) ? "placeholder='Nama Supplier'" : "value='" . $supplier['nm_supplier'] . "'"  ?>>
						<?= form_error('nm_supplier','<small style="color: red;">','</small>') ?>
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<input type="text" name="alamat" class="form-control" <?= empty($data) ? "placeholder='Alamat'" : "value='" . $supplier['alamat'] . "'"  ?>>
						<?= form_error('alamat','<small style="color: red;">','</small>') ?>
					</div>
					<div class="form-group">
						<label>Telepon</label>
						<input type="number" name="telepon" class="form-control" <?= empty($data) ? "placeholder='08xxx'" : "value='" . $supplier['telepon'] . "'"  ?>>
						<?= form_error('telepon','<small style="color: red;">','</small>') ?>
					</div>
					<div class="form-group">
						<input type="submit" value="submit" class="btn btn-primary btn-block">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>