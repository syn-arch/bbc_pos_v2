<div class="row">
	<div class="col-lg-12">

		<div class="au-card chart-percent-card">
			<div class="au-card-inner">
				<h4 class="title2">Data Petugas</h4>
				<hr>

				<?php if($this->session->flashdata('message')) : ?>
					<div class="alert alert-success" role="alert">
						<strong>Berhasil!</strong> Data berhasil <?= $this->session->flashdata('message'); ?>
					</div>
				<?php elseif ($this->session->flashdata('error')) : ?>
					<div class="alert alert-danger" role="alert">
						<strong>Berhasil!</strong> <?= $this->session->flashdata('error'); ?>
					</div>
				<?php endif; ?>


				<a href="<?= base_url('master/tambah_petugas') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>

				<a href="<?= base_url('excel/ekspor_petugas') ?>" class="btn btn-success"><i class="fa fa-sign-out-alt"></i> Ekspor</a>
				<a href="<?= base_url('excel/import_petugas') ?>" class="btn btn-warning"><i class="fa fa-sign-in-alt"></i> Import</a>

				<div class="table-responsive mt-3">
					<table class="table tables">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama</th>
								<th>Alamat</th>
								<th>Telepon</th>
								<th>E-mail</th>
								<th>JK</th>
								<th>Role</th>
								<th><i class="fa fa-gears"></i></th>
							</tr>
						</thead>
						<tbody>

							<?php $no = 1; foreach($petugas as $row) : ?>

							<tr>
								<td><?= $no++ ?></td>
								<td><?= $row['nm_user'] ?></td>
								<td><?= $row['alamat'] ?></td>
								<td><?= $row['telepon'] ?></td>
								<td><?= $row['email'] ?></td>
								<td><?= $row['jk'] ?></td>
								<td><?= $row['nm_role'] ?></td>
								<td>
									<a href="<?= base_url('master/edit_petugas/') . $row['kd_user'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
									<a onclick="return confirm('Apakah anda yakin?')" href="<?= base_url('master/hapus_petugas/') . $row['kd_user'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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