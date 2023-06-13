<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $pageTitle; ?> - <?= $this->company_info->get_company_name(); ?> </title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS
	============================================ -->

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/css/plugins/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/css/plugins/icofont.min.css">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/css/plugins/animate.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/css/plugins/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/css/plugins/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/css/plugins/aos.css">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/css/style-update.css">

</head>

<body>

    <div class="main-wrapper">

        <?php include "header.php"; ?>

        <div id="content">
            <?php echo $contents; ?>
        </div>

        <?php include "footer.php"; ?>

        <!--Back To Start-->
        <a role="button" class="back-to-top">
            <i class="icofont-simple-up"></i>
        </a>
        <!--Back To End-->

    </div>

    <!-- JS
    ============================================ -->

    <!-- Modernizer & jQuery JS -->
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/js/vendor/particles.js"></script>

    <!-- Bootstrap JS -->
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/js/plugins/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/js/plugins/bootstrap.min.js"></script>

    <!-- Plugins JS -->
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/js/plugins/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/js/plugins/select2.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/js/plugins/aos.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/js/plugins/validate.js"></script>

    <!--====== Use the minified version files listed below for better performance and remove the files listed above ======-->
    <!-- <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/js/plugins.min.js"></script> -->


    <!-- Main JS -->
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/js/main.js"></script>

</body>

</html>