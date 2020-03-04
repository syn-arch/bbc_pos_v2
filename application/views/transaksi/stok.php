<div class="row">
	<div class="col-lg-12">
		<div class="au-card chart-percent-card">
			<div class="au-card-inner">
				<h4 class="card-title">Manajemen stok</h4>
				<hr>
			
			<?php if($this->session->flashdata('message')): ?>
				<div class="alert alert-success"><strong>Berhasil</strong> Data Berhasil <?= $this->session->flashdata('message'); ?></div>
			<?php endif; ?>

				<a href="<?= base_url('transaksi/tambah_data_stok') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah data</a>

				<div class="table-responsive mt-3">
					<table class="table tables">
						<thead>
							<tr>
								<th>#</th>
								<th>Tanggal</th>
								<th>Barang</th>
								<th>Status</th>
								<th>Jumlah</th>
								<th>Keterangan</th>
								<th><i class="fa fa-gears"></i></th>
							</tr>
						</thead>
						<tbody>

							<?php $i=1;foreach ($stok as $row) :  ?>
							<tr>
								<td><?= $i++ ?></td>
								<td><?= $row['tgl'] ?></td>
								<td><?= $row['nm_barang'] ?></td>
								<td><?= $row['status'] == "Stok Masuk" ? '<div class="badge badge-success">Stok Masuk</div>' : '<div class="badge badge-danger">Stok Keluar</div>' ?></td>
								<td><?= $row['jumlah'] ?></td>
								<td><?= $row['keterangan'] ?></td>
								<td><a onclick="return confirm('Apakah anda yakin?')" href="<?= base_url('transaksi/hapus_stok/') . $row['id'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
							</tr>

						<?php endforeach; ?>
							
						</tbody>
					</table>
					
				</div>
			</div>
		</div>
	</div>
</div>