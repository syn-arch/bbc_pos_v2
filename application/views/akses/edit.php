<?php $idrole = $this->uri->segment(3) ?>
<div class="row">
	<div class="col-lg-12">

        <div class="au-card chart-percent-card">
            <div class="au-card-inner">
                <h3 class="title-2 tm-b-5"><?= $judul ?></h3>
                <hr>
                <a href="<?= base_url('akses')  ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                <br><br>

                <div class="col-xl-12">
                	<div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Menu</th>
                                    <th><i class="fa fa-gears"></i></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $no = 1; foreach($menu as $row) : ?>                                  

                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <?= $row['nm_menu'] ?>

                                            <table class="table-borderless"> 

                                                <?php
                                                $i = 1;
                                                $idmenu = $row['id'];
                                                $submenu = $this->db->query("SELECT * FROM sub_menu WHERE id_menu = '$idmenu'")->result_array();
                                                foreach($submenu as $sub) :
                                                ?>

                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $sub['nm_submenu'] ?></td>
                                                    <td><input type="checkbox" <?= cek_submenu($idrole, $sub['id']) ?> data-id="<?= $sub['id'] ?>" data-role="<?= $idrole ?>" class="form-sub"></td>
                                                </tr>

                                            <?php endforeach; ?>

                                            </table>

                                        </td>
                                        <td>
                                        	<input type="checkbox" <?= check_access($idrole, $row['id']) ?> data-id="<?= $row['id'] ?>" data-role="<?= $idrole ?>" class="form-menu">
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