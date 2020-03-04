<div class="row">
	<div class="col-lg-12">

		<div class="au-card chart-percent-card">
			<div class="au-card-inner">
				<h4 class="title2">Import Data Kelas</h4>
				<hr>

				<form enctype="multipart/form-data" method="POST" action="<?= base_url('excel/import_kelas_excel') ?>">
					<div class="form-group">
						<label>Pilih File</label>
						<input type="file" name="file_excel" id="file" class="file form-control">
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