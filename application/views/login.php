<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="<?= base_url('vendor/') ?>css/font-face.css" rel="stylesheet" media="all">
    <link href="<?= base_url('vendor/') ?>vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('vendor/') ?>vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('vendor/') ?>vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="<?= base_url('vendor/') ?>vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!--Vendor CSS-->
    <link href="<?= base_url('vendor/') ?>vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('vendor/') ?>vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('vendor/') ?>vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="<?= base_url('vendor/') ?>vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('vendor/') ?>vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="<?= base_url('vendor/') ?>vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('vendor/') ?>vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="<?= base_url('vendor/') ?>css/theme.css" rel="stylesheet" media="all">

</head>

<body class="a">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="<?= base_url('vendor/') ?>images/icon/bbc pos v2.png" style="width: 300px;">
                            </a>
                        </div>
                        <div class="login-form">

                            <?php if($this->session->flashdata('message')) : ?>
                                <div class="alert alert-danger"><?= $this->session->flashdata('message'); ?></div>
                            <?php endif; ?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                    <?= form_error('email','<small style="color: red">','</small>') ?>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                    <?= form_error('password','<small style="color: red">','</small>') ?>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="<?= base_url('vendor/') ?>vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="<?= base_url('vendor/') ?>vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="<?= base_url('vendor/') ?>vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- <?= base_url('vendor/') ?>Vendor JS       -->
    <script src="<?= base_url('vendor/') ?>vendor/slick/slick.min.js">
    </script>
    <script src="<?= base_url('vendor/') ?>vendor/wow/wow.min.js"></script>
    <script src="<?= base_url('vendor/') ?>vendor/animsition/animsition.min.js"></script>
    <script src="<?= base_url('vendor/') ?>vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="<?= base_url('vendor/') ?>vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="<?= base_url('vendor/') ?>vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="<?= base_url('vendor/') ?>vendor/circle-progress/circle-progress.min.js"></script>
    <script src="<?= base_url('vendor/') ?>vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?= base_url('vendor/') ?>vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="<?= base_url('vendor/') ?>vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="<?= base_url('vendor/') ?>js/main.js"></script>

</body>

</html>
<!-- end document-->