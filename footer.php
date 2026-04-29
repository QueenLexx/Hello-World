<footer class="site-footer" id="colophon">
    <div class="footer-content">
        <div class="footer-grid">

            <div class="footer-brand">
                <span class="footer-logo"><?php bloginfo( 'name' ); ?></span>
                <p><?php esc_html_e( 'Luxury mindful calendars designed to inspire reflection, intention, and growth throughout every season of your life.', 'perspective-reflectives' ); ?></p>
                <div class="footer-social">
                    <a href="#" aria-label="Instagram">&#9654;</a>
                    <a href="#" aria-label="Pinterest">&#9670;</a>
                    <a href="#" aria-label="Facebook">&#9632;</a>
                    <a href="#" aria-label="TikTok">&#9675;</a>
                </div>
            </div>

            <div class="footer-col">
                <h4><?php esc_html_e( 'Shop', 'perspective-reflectives' ); ?></h4>
                <ul>
                    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                    <li><a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><?php esc_html_e( 'All Calendars', 'perspective-reflectives' ); ?></a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo esc_url( home_url( '/product-category/wall-calendars' ) ); ?>"><?php esc_html_e( 'Wall Calendars', 'perspective-reflectives' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/product-category/desk-calendars' ) ); ?>"><?php esc_html_e( 'Desk Calendars', 'perspective-reflectives' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/product-category/planners' ) ); ?>"><?php esc_html_e( 'Planners', 'perspective-reflectives' ); ?></a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4><?php esc_html_e( 'Company', 'perspective-reflectives' ); ?></h4>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>"><?php esc_html_e( 'About Us', 'perspective-reflectives' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Contact', 'perspective-reflectives' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/blog' ) ); ?>"><?php esc_html_e( 'Blog', 'perspective-reflectives' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/press' ) ); ?>"><?php esc_html_e( 'Press', 'perspective-reflectives' ); ?></a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4><?php esc_html_e( 'Support', 'perspective-reflectives' ); ?></h4>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/faq' ) ); ?>"><?php esc_html_e( 'FAQ', 'perspective-reflectives' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/shipping' ) ); ?>"><?php esc_html_e( 'Shipping Info', 'perspective-reflectives' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/returns' ) ); ?>"><?php esc_html_e( 'Returns', 'perspective-reflectives' ); ?></a></li>
                    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                    <li><a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>"><?php esc_html_e( 'My Account', 'perspective-reflectives' ); ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            <p>
                &copy; <?php echo esc_html( date( 'Y' ) ); ?>
                <?php bloginfo( 'name' ); ?>.
                <?php esc_html_e( 'All rights reserved.', 'perspective-reflectives' ); ?>
            </p>
            <div class="footer-bottom-links">
                <a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'perspective-reflectives' ); ?></a>
                <a href="<?php echo esc_url( home_url( '/terms' ) ); ?>"><?php esc_html_e( 'Terms of Service', 'perspective-reflectives' ); ?></a>
            </div>
        </div>

    </div>
</footer>

</div><!-- .site-wrapper -->

<?php wp_footer(); ?>
</body>
</html>
