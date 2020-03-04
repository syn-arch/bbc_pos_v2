<div class="row">
	<div class="col-12">
		<div class="au-card chart-percent-card">
			<div class="au-card-innter">
				<h4 class="card-title">Data departemen</h4>
				<hr>

				<?php if($this->session->flashdata('message')) : ?>
					<div class="alert alert-success" role="alert">
						<strong>Berhasil!</strong> Data berhasil <?= $this->session->flashdata('message'); ?>
					</div>
				<?php endif; ?>

				<a href="<?= base_url('master/tambah_departemen') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>

				<a href="<?= base_url('excel/ekspor_departemen') ?>" class="btn btn-success"><i class="fa fa-sign-out-alt"></i> Ekspor</a>
				<a href="<?= base_url('excel/import_departemen') ?>" class="btn btn-warning"><i class="fa fa-sign-in-alt"></i> Import</a>
				<a href="<?= base_url('excel/ekspor_kelas') ?>" class="btn btn-danger"><i class="fa fa-sign-out-alt"></i> Ekspor kelas</a>
				<a href="<?= base_url('excel/import_kelas') ?>" class="btn btn-dark"><i class="fa fa-sign-in-alt"></i> Import kelas</a>

				<div class="table-responsive mt-3">
					<table class="table tables">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama departemen</th>
								<th><i class="fa fa-gears"></i></th>
							</tr>
						</thead>

						<tbody>

							<?php $i = 1; foreach($departemen as $row) : ?>

							<tr>
								<td><?= $i++ ?></td>
								<td><?= $row['nm_departemen'] ?></td>
								<td>
									<a href="<?= base_url('master/edit_departemen/') . $row['kd_departemen'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
									<a onclick="return confirm('Apakah anda yakin?')" href="<?= base_url('master/hapus_departemen/') . $row['kd_departemen'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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