<div class="row">
	<div class="col-lg-12">

        <div class="au-card chart-percent-card">
            <div class="au-card-inner">

                <h4 class="card-title">Tambah Data</h4>
                <hr>
                <a href="<?= base_url('akses')  ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                <br><br>

                <form method="post">
                    <label>Nama Role</label>
                    <input type="text" name="role" class="form-control" placeholder="Nama Role">
                    <?= form_error('role','<small style="color: red;">','</small>') ?>
                    <br>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>

            </div>
        </div>
    </div>
</div>