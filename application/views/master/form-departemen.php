<?php $data = $this->uri->segment(3) ?>
<div class="row">
	<div class="col-lg-12">
		<div class="au-card chart-percent-card">
			<div class="au-card-innter">
				<h4 class="card-title"><?= empty($data) ? "Tambah departemen" : "Edit departemen" ?></h4>
				<hr>
				<a href="<?= base_url('master/departemen') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>

				<form method="post" class="mt-3">
					<?php if ($data): ?>
						<input type="hidden" name="kd_departemen" value="<?= $data ?>">
					<?php endif ?>
					<div class="form-group">
						<label>Nama departemen</label>
						<input type="text" name="nm_departemen" class="form-control" <?= empty($data) ? "placeholder='Nama departemen'" : "value='" . $departemen['nm_departemen'] ."'" ?>>
						<?= form_error('nm_departemen', '<small style="color: red">','</small>') ?>
					</div>
					<div class="form-group">
						<input type="submit" value="submit" class="btn btn-primary btn-block">
					</div>
					
				</form>


			</div>
		</div>
	</div>
</div>

<?php if ($data): ?>
<div class="row">
	<div class="col-12">
		<div class="au-card chart-percent-card">
			<div class="au-card-innter">
				<h4 class="card-title">Data kelas</h4>
				<hr>

				<?php if($this->session->flashdata('message')) : ?>
					<div class="alert alert-success" role="alert">
						<strong>Berhasil!</strong> Data berhasil <?= $this->session->flashdata('message'); ?>
					</div>
				<?php endif; ?>

				<a href="<?= base_url('master/tambah_kelas/') . $data ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>

				<div class="table-responsive mt-3">
					<table class="table tables">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama kelas</th>
								<th><i class="fa fa-gears"></i></th>
							</tr>
						</thead>

						<tbody>

							<?php $i = 1; foreach($kelas as $row) : ?>

							<tr>
								<td><?= $i++ ?></td>
								<td><?= $row['nm_kelas'] ?></td>
								<td>
									<a href="<?= base_url('master/edit_kelas/') . $data . '/' . $row['kd_kelas'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
									<a onclick="return confirm('Apakah anda yakin?')" href="<?= base_url('master/hapus_kelas/') . $row['kd_kelas'] . '/' . $data ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
								</td>
							</tr>

						<?php endforeach; ?>

						</tbody>
						
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif ?>