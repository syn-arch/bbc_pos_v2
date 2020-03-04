
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title><?= $judul ?></title>

    <!-- Fontfaces CSS-->
    <link href="<?= base_url('vendor/') ?>css/font-face.css" rel="stylesheet" media="all">
    <link href="<?= base_url('vendor/') ?>vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('vendor/') ?>vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('vendor/') ?>vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="<?= base_url('vendor/') ?>vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="<?= base_url('vendor/') ?>vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('vendor/') ?>vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('vendor/') ?>vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="<?= base_url('vendor/') ?>vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('vendor/') ?>vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="<?= base_url('vendor/') ?>vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('vendor/') ?>vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="<?= base_url('vendor/') ?>vendor/datatables/dataTables.min.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="<?= base_url('vendor/') ?>css/theme.css" rel="stylesheet" media="all">

</head>

<body>
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="<?= base_url('vendor/') ?>images/icon/bbc pos v2.png" alt="CoolAdmin" />
                        </a>
                        <button class="resv hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">

                        <?php 
                        $role = $this->session->userdata('role');
                      $menuQuery = "SELECT 
                                `menu`.`id`,
                                `menu`.`nm_menu`
                                FROM `menu` JOIN `akses_menu`
                                ON `menu`.`id` =`akses_menu`.`id_menu`
                                WHERE `akses_menu`.`id_role` = $role
                                ORDER BY `akses_menu`.`id_menu` ASC
                      ";

                      $menu = $this->db->query($menuQuery)->result_array();

                     ?>
                      
                      <?php foreach($menu as $m) : ?>

                      <li>
                        <p><?= $m['nm_menu'] ?></p>
                      </li>

                      <?php 

                      $idMenu = $m['id'];

                      $sub = "SELECT 
                                `sub_menu`.`id`,
                                `sub_menu`.`nm_submenu`,
                                `sub_menu`.`url`,
                                `sub_menu`.`icon`
                                FROM `sub_menu` JOIN `akses_submenu`
                                ON `sub_menu`.`id` =`akses_submenu`.`id_submenu`
                                WHERE `akses_submenu`.`id_role` = $role AND `sub_menu`.`id_menu` = '$idMenu'
                                ORDER BY `akses_submenu`.`id_submenu` ASC";

                      $sub_menu = $this->db->query($sub)->result_array();

                      foreach ($sub_menu as $s) : ?>

                        <li class="<?= $judul == $s['nm_submenu'] ? 'active' : '' ?>"> 

                          <a href="<?= base_url() . $s['url'] ?>">
                            <i class="<?= $s['icon'] ?>"></i><?= $s['nm_submenu'] ?>
                          </a>
                        </li>

                      <?php endforeach; ?>
                      
                    <?php endforeach ?>

                        <li>
                          <a href="<?= base_url('auth/logout') ?>">
                            <i class="fa fa-sign-out-alt"></i>Logout
                          </a>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <div class="rivaldi">
           <aside class="menu-sidebar d-none d-lg-block ">
                <div class="logo">
                    <a href="#">
                        <img src="<?= base_url('vendor/') ?>images/icon/bbc pos v2.png"/>
                    </a>
                </div>
                <div class="menu-sidebar__content js-scrollbar1">
                    <nav class="navbar-sidebar">
                        <ul class="list-unstyled navbar__list">

                        <?php 
                        $role = $this->session->userdata('role');
                          $menuQuery = "SELECT 
                                    `menu`.`id`,
                                    `menu`.`nm_menu`
                                    FROM `menu` JOIN `akses_menu`
                                    ON `menu`.`id` =`akses_menu`.`id_menu`
                                    WHERE `akses_menu`.`id_role` = $role
                                    ORDER BY `akses_menu`.`id_menu` ASC
                          ";

                          $menu = $this->db->query($menuQuery)->result_array();

                         ?>
                          
                          <?php foreach($menu as $m) : ?>

                          <li>
                            <p><?= $m['nm_menu'] ?></p>
                          </li>

                          <?php 

                          $idMenu = $m['id'];

                          $sub = "SELECT 
                                    `sub_menu`.`id`,
                                    `sub_menu`.`nm_submenu`,
                                    `sub_menu`.`url`,
                                    `sub_menu`.`icon`
                                    FROM `sub_menu` JOIN `akses_submenu`
                                    ON `sub_menu`.`id` =`akses_submenu`.`id_submenu`
                                    WHERE `akses_submenu`.`id_role` = $role AND `sub_menu`.`id_menu` = '$idMenu'
                                    ORDER BY `akses_submenu`.`id_submenu` ASC";

                          $sub_menu = $this->db->query($sub)->result_array();

                          foreach ($sub_menu as $s) : ?>

                            <li class="<?= $judul == $s['nm_submenu'] ? 'active' : '' ?>" style="margin-top: -10px"> 

                              <a href="<?= base_url() . $s['url'] ?>">
                                <i class="<?= $s['icon'] ?>"></i><?= $s['nm_submenu'] ?>
                              </a>
                            </li>

                          <?php endforeach; ?>

                          <hr>

                        <?php endforeach ?>

                            <li>
                              <a href="<?= base_url('auth/logout') ?>">
                                <i class="fa fa-sign-out-alt"></i>Logout
                              </a>
                            </li>

                        </ul>
                    </nav>
                </div>
            </aside>
        </div>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

                        <div class="header-wrap">
                            <button id="colls" class="d-none d-md-block hamburger hamburger--collapse" type="button">
                              <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                              </span>
                            </button>
                            <div id="colls-first">
                                <button id="" class="is-active d-none d-md-block hamburger hamburger--collapse" type="button">
                                <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                                </span>
                            </div>
                            
                            </button>
                            <div class="form-header"></div>
                            

                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="<?= base_url('assets/img/user/') . $this->session->userdata('gambar') ?>"/>
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?= $this->session->userdata('nama') ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="<?= base_url('assets/img/user/') . $this->session->userdata('gambar') ?>" alt="<?= $this->session->userdata('nama') ?>" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?= $this->session->userdata('nama') ?></a>
                                                    </h5>
                                                    <span class="email"><?= $this->session->userdata('email') ?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="<?= base_url('user') ?>">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="<?= base_url('auth/logout') ?>">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                      