<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="site-wrapper">

<header class="site-header" id="masthead">
    <div class="header-container">

        <div class="site-logo">
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php bloginfo( 'name' ); ?>
                </a>
            <?php endif; ?>
        </div>

        <nav class="main-navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'perspective-reflectives' ); ?>">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_class'     => '',
                'container'      => false,
                'fallback_cb'    => function() {
                    echo '<ul>';
                    echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'perspective-reflectives' ) . '</a></li>';
                    echo '<li><a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '">' . esc_html__( 'Shop', 'perspective-reflectives' ) . '</a></li>';
                    echo '<li><a href="' . esc_url( home_url( '/about' ) ) . '">' . esc_html__( 'About', 'perspective-reflectives' ) . '</a></li>';
                    echo '<li><a href="' . esc_url( home_url( '/contact' ) ) . '">' . esc_html__( 'Contact', 'perspective-reflectives' ) . '</a></li>';
                    echo '</ul>';
                },
            ) );
            ?>
        </nav>

        <?php if ( class_exists( 'WooCommerce' ) ) : ?>
        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="header-cart" aria-label="<?php esc_attr_e( 'View cart', 'perspective-reflectives' ); ?>">
            <?php if ( WC()->cart->get_cart_contents_count() > 0 ) : ?>
                <span class="cart-count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
            <?php endif; ?>
        </a>
        <?php endif; ?>

        <button class="mobile-menu-toggle" aria-label="<?php esc_attr_e( 'Toggle menu', 'perspective-reflectives' ); ?>" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

    </div>
</header>

<nav class="mobile-nav" id="mobile-nav" aria-label="<?php esc_attr_e( 'Mobile navigation', 'perspective-reflectives' ); ?>">
    <?php
    wp_nav_menu( array(
        'theme_location' => 'primary',
        'container'      => false,
        'fallback_cb'    => function() {
            echo '<ul>';
            echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'perspective-reflectives' ) . '</a></li>';
            echo '<li><a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '">' . esc_html__( 'Shop', 'perspective-reflectives' ) . '</a></li>';
            echo '<li><a href="' . esc_url( home_url( '/about' ) ) . '">' . esc_html__( 'About', 'perspective-reflectives' ) . '</a></li>';
            echo '<li><a href="' . esc_url( home_url( '/contact' ) ) . '">' . esc_html__( 'Contact', 'perspective-reflectives' ) . '</a></li>';
            echo '</ul>';
        },
    ) );
    ?>
</nav>
