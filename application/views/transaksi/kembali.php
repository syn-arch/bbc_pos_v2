<div class="row">
	<div class="col-lg-12">
		<div class="au-card chart-percent-card">
			<div class="au-card-inner">
				<h4 class="card-title">Pengembalian Barang</h4>
				<hr>
			
			<?php if($this->session->flashdata('message')): ?>
				<div class="alert alert-success"><strong>Berhasil</strong> Data Berhasil <?= $this->session->flashdata('message'); ?></div>
			<?php endif; ?>

				<a href="<?= base_url('transaksi/tambah_pengembalian') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah data</a>

				<div class="table-responsive mt-3">
					<table class="table tables">
						<thead>
							<tr>
								<th>#</th>
								<th>Tanggal</th>
								<th>Nama Barang</th>
								<th>Jumlah</th>
								<th>User</th>
								<th>Keterangan</th>
								<th><i class="fa fa-gears"></i></th>
							</tr>
						</thead>
						<tbody>

							<?php $i=1;foreach ($kembali as $row) :  ?>
							<tr>
								<td><?= $i++ ?></td>
								<td><?= $row['tgl'] ?></td>
								<td><?= $row['nm_barang'] ?></td>
								<td><?= $row['jumlah'] ?></td>
								<td><?= $row['nm_user'] ?></td>
								<td><?= $row['keterangan'] ?></td>
								<td>
									<a href="<?= base_url('transaksi/edit_pengembalian/') . $row['kd_kembali'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
									<a onclick="return confirm('Apakah anda yakin?')" href="<?= base_url('transaksi/hapus_kembali/') . $row['kd_kembali'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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