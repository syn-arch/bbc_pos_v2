<div class="row">
	<div class="col-lg-12">
		<div class="au-card chart-percent-card">
			<div class="au-card-inner">
				<h4 class="card-title">Cetak Barcode</h4>
				<hr>
				
				<div id="validation-info"></div>

				<form action="<?= base_url('utilities/tambah_barcode') ?>" method="post" name="frmBarcodeGenerator" id="frmBarcodeGenerator" onSubmit="return validate()">
				    <div class="form-group">
				        <label>MFG Date</label>
				        <div>
				            <input type="date" name="mfg_date" id="mfg_date" class="form-control" />
				        </div>
				    </div>
				    <div class="form-group">
				        <label>EXP Date</label>
				        <div>
				            <input type="date" name="exp_date" id="exp_date" class="form-control" />
				        </div>
				    </div>
				 
				    <div>
				        <input type="submit" name="generate" class="btn btn-primary btn-block" value="Generate Barcode" />
				    </div>
				</form>

			</div>
		</div>
	</div>
</div>