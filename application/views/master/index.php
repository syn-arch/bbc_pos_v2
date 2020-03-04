<div class="row">
	<div class="col-lg-12">
		<div class="au-card chart-percent-card">
			<div class="au-card-inner">
				<h4 class="card-title">Data Barang</h4>
				<hr>

				<?php if($this->session->flashdata('message')) : ?>
						<div class="alert alert-success"> <strong>Berhasil! </strong>Data berhasil <?= $this->session->flashdata('message'); ?></div>
					<?php elseif ($this->session->flashdata('error')) : ?>
						<div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
				<?php endif; ?>

				<a href="<?= base_url('master/tambah_barang') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah data</a>
				<a href="<?= base_url('excel/index') ?>" class="btn btn-success"><i class="fa fa-sign-out-alt"></i> Ekspor</a>
				<a href="<?= base_url('excel/import_barang') ?>" class="btn btn-warning"><i class="fa fa-sign-in-alt"></i> Import</a>

				<div class="table-responsive mt-3">
					<table class="table tables">
						<thead>
							<tr>
								<th>#</th>
								<th>Kode</th>
								<th>Nama</th>
								<th>Departemen</th>
								<th>Kelas</th>
								<th>Harga Beli</th>
								<th>Harga Jual</th>
								<th>Profit</th>
								<th>Stok</th>
								<th>Diskon (%)</th>
								<th><i class="fa fa-gears"></i></th>
							</tr>
						</thead>
						<tbody>

							<?php $i = 1; foreach($barang as $row) : ?>
							<tr>
								<td><?= $i++ ?></td>
								<td><?= $row['kd_barang'] ?></td>
								<td><?= $row['nm_barang'] ?></td>
								<td><?= $row['nm_departemen'] ?></td>
								<td><?= $row['nm_kelas'] ?></td>
								<td><?= "Rp." . number_format($row['harga_beli']) ?></td>
								<td><?= "Rp." . number_format($row['harga_jual']) ?></td>
								<td><?= "Rp." . number_format($row['profit']) ?></td>
								<td><?= $row['stok'] ?></td>
								<td><?= $row['diskon'] ?></td>
								<td>
									<a href="<?= base_url('master/edit_barang/') . $row['kd_barang'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
									<a onclick="return confirm('Apakah anda yakin?')" href="<?= base_url('master/hapus_barang/') . $row['kd_barang'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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