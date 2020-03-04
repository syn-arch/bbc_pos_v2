<div class="row">
	<div class="col-lg-12">
		<div class="au-card chart-percent-card">
			<div class="au-card-inner">
				<h4 class="card-title">Data Supplier</h4>
				<hr>

				<?php if($this->session->flashdata('message')) : ?>
					<div class="alert alert-success" role="alert">
						<strong>Berhasil!</strong> Data berhasil <?= $this->session->flashdata('message'); ?>
					</div>
				<?php endif; ?>

				<a href="<?= base_url('master/tambah_supplier') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah data</a>

				<a href="<?= base_url('excel/ekspor_supplier') ?>" class="btn btn-success"><i class="fa fa-sign-out-alt"></i> Ekspor</a>
				<a href="<?= base_url('excel/import_supplier') ?>" class="btn btn-warning"><i class="fa fa-sign-in-alt"></i> Import</a>

				<div class="table-responsive mt-3">
					<table class="table tables">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama</th>
								<th>Alamat</th>
								<th>Telepon</th>
								<th><i class="fa fa-gears"></i></th>
							</tr>
						</thead>
						<tbody>

							<?php $i = 1; foreach($supplier as $row) : ?>
							<tr>
								<td><?= $i++ ?></td>
								<td><?= $row['nm_supplier'] ?></td>
								<td><?= $row['alamat'] ?></td>
								<td><?= $row['telepon'] ?></td>
								<td>
									<a href="<?= base_url('master/edit_supplier/') . $row['kd_supplier'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
									<a onclick="return confirm('Apakah anda yakin?')" href="<?= base_url('master/hapus_supplier/') . $row['kd_supplier'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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