<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Dashboard</h2>
        </div>
    </div>
</div>
<div class="row m-t-25">
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c1">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-account-o"></i>
                    </div>
                    <div class="text">
                        <h2><?= $this->db->get('user')->num_rows(); ?></h2>
                        <span>Total User</span>
                    </div>
                </div>
                <div class="overview-chart">
                    <canvas id="widgetChart1"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c2">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                    <div class="text">
                        <?php 
                        $this->db->select_sum('qty');
                        $this->db->from('detil_transaksi');
                        $terjual = $this->db->get()->row_array();
                         ?>

                        <h2><?= $terjual['qty'] ?></h2>
                        <span>Barang Terjual</span>
                    </div>
                </div>
                <div class="overview-chart">
                    <canvas id="widgetChart2"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c3">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-calendar-note"></i>
                    </div>
                    <div class="text">
                         <?php 
                            $this->db->select_sum('jumlah');
                            $this->db->from('pengembalian');
                            $result1 = $this->db->get()->row_array()['jumlah'];
                         ?>

                        <h2><?= $result1 == '' ? '0' : $result1 ?></h2>

                        <span>Pengembalian</span>
                    </div>
                </div>
                <div class="overview-chart">
                    <canvas id="widgetChart3"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c4">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-money"></i>
                    </div>
                    <div class="text">
                        <?php 
                        $this->db->select_sum('total_bayar');
                        $this->db->from('transaksi');
                        $result = $this->db->get()->row_array()['total_bayar'];
                         ?>
                        <h2><?= "Rp. " . number_format($result) ?></h2>
                        <span>Total Pendapatan</span>
                    </div>
                </div>
                <div class="overview-chart">
                    <canvas id="widgetChart4"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>