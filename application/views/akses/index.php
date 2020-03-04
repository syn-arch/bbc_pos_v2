<div class="row">
	<div class="col-lg-12">

        <div class="au-card chart-percent-card">
            <div class="au-card-inner">
                <h3 class="title-2 tm-b-5"><?= $judul ?></h3>
                <hr>
                    
                <?php if($this->session->flashdata('message')) : ?>
                    <div class="alert alert-danger"> Data berhasil <?= $this->session->flashdata('message'); ?></div>
                <?php endif; ?>
                
                <a href="<?= base_url('akses/tambah') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                <br><br>

                <div class="col-xl-12">
                	<div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Hak Akses</th>
                                    <th><i class="fa fa-gears"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($akses as $row) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nm_role'] ?></td>
                                    <td>
                                    	<a href="<?= base_url('akses/edit/') . $row['id'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                        <a href="<?= base_url('akses/hapus/') . $row['id'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
</div>