<!-- Footer Section Start -->
<div class="section footer-section">
    <!-- Footer Copyright End -->
    <div class="footer-copyright-section">
        <div class="container">

            <!-- Copyright Wrapper Start -->
            <div class="copyright-wrapper">

                <div class="copyright-text">
                    <p>&copy; <?= getyear();?> — <?= $this->company_info->get_company_name(); ?></p>
                </div>

                <div class="copyright-social">
                    <a href="<?= $this->company_info->get_company_facebook(); ?>" target="_blank"><i class="fa fa-facebook-f"></i></a>
                    <a href="<?= $this->company_info->get_company_instagram(); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
                    <a href="<?= $this->company_info->get_company_youtube(); ?>" target="_blank"><i class="fa fa-youtube"></i></a>
                </div>

            </div>
            <!-- Copyright Wrapper End -->

        </div>
    </div>
    <!-- Footer Copyright End -->

</div>
<!-- Footer Section End -->