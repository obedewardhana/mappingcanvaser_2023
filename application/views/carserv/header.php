<!-- Header Section Start -->
<div class="section header-section">

    <!-- Header top Start -->
    <div class="header-top d-none d-lg-block">
        <div class="container">

            <!-- Header top Wrapper Start -->
            <div class="header-top-wrapper">

                <!-- Header top Wrapper Start -->
                <div class="header-top-btn">
                </div>
                <!-- Header top Wrapper End -->

            </div>
            <!-- Header top Wrapper End -->

        </div>
    </div>
    <!-- Header top End -->

    <!-- Header Main Start -->
    <div class="header-main">
        <div class="container">

            <!-- Header Main Start -->
            <div class="header-main-wrapper">

                <!-- Header Logo Start -->
                <div class="header-logo">
                    <a href="<?php echo base_url('main'); ?>"><img src="<?php echo base_url(); ?>/img/<?= $this->company_info->get_company_logo(); ?>" alt="Logo"></a>
                </div>
                <!-- Header Logo End -->

                <!-- Header Menu Start -->
                <div class="primary-menu d-lg-block">
                    <ul class="nav-menu">
                        <li><a href="<?php echo base_url('main'); ?>">Home</a></li>
                        <?php if ($dataAdmin->id == '') {
                        ?>

                            <li><a href="<?php echo base_url('survey'); ?>">Survey</a></li>
                            <li><a href="<?php echo base_url('auth/login'); ?>">Login</a></li>
                        <?php } else { ?>
                            <li><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
                            <li><a href="<?php echo base_url('auth/logout'); ?>">Logout</a></li>
                        <?php } ?>
                    </ul>

                </div>
                <!-- Header Menu End -->

            </div>
            <!-- Header Main End -->

        </div>
    </div>
    <!-- Header Main End -->

</div>
<!-- Header Section End -->

<!-- Mobile Menu Start -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample">

    <div class="offcanvas-header">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">

        <!-- Header top Info Start -->
        <div class="header-top-info">
            <p><?= $this->company_info->get_company_address(); ?></p>
            <p>Tanya - tanya langsung : <a href="https://api.whatsapp.com/send?phone=<?= $this->company_info->get_company_whatsapp(); ?>" target="_blank"><i class="fa fa-whatsapp mx-1"></i>Whatsapp Disini!</a></p>
        </div>
        <!-- Header top Info End -->

        <!-- Header top Button Start -->
        <div class="header-top-btn">
            <a href="<?php echo base_url('main'); ?>">Home</a>
            <a href="<?php echo base_url('survey'); ?>">Survey</a>
            <?php if ($dataAdmin->id == '') {
            ?>
                <a href="<?php echo base_url('auth/login'); ?>">Login</a>
            <?php } else { ?>
                <a href="<?php echo base_url('auth/logout'); ?>">Logout</a>
            <?php } ?>
        </div>
        <!-- Header top Button End -->

        <!-- Mobile Menu Start -->
        <div class="mobile-menu-items">
            <ul class="nav-menu">
                <li><a href="<?php echo base_url('main'); ?>">Home</a></li>
                <?php if ($dataAdmin->id == '') {
                ?>

                    <li><a href="<?php echo base_url('survey'); ?>">Survey</a></li>
                    <li><a href="<?php echo base_url('auth/login'); ?>">Login</a></li>
                <?php } else { ?>
                    <li><a href="<?php echo base_url('survey'); ?>">Survey</a></li>
                    <li><a href="<?php echo base_url('auth/logout'); ?>">Logout</a></li>
                <?php } ?>
            </ul>

        </div>
        <!-- Mobile Menu End -->

    </div>
</div>
<!-- Mobile Menu End -->