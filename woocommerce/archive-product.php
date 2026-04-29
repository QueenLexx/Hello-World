<?php
defined( 'ABSPATH' ) || exit;
get_header();
?>

<main class="woocommerce-page">
    <h1 class="page-title"><?php esc_html_e( 'Our Collection', 'perspective-reflectives' ); ?></h1>

    <?php woocommerce_output_all_notices(); ?>

    <?php if ( woocommerce_product_loop() ) : ?>
        <div class="products">
            <?php
            woocommerce_product_loop_start();

            if ( wc_get_loop_prop( 'total' ) ) {
                while ( have_posts() ) {
                    the_post();
                    global $product;
                    ?>
                    <div class="product">
                        <a href="<?php the_permalink(); ?>">
                            <div class="product-image">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'product-thumb' ); ?>
                                <?php else : ?>
                                    <span>&#128197;</span>
                                <?php endif; ?>
                                <?php if ( $product->is_on_sale() ) : ?>
                                    <span class="onsale"><?php esc_html_e( 'Sale', 'perspective-reflectives' ); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="product-content">
                                <h2 class="product-title"><?php the_title(); ?></h2>
                                <div class="product-description">
                                    <?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 18 ) ); ?>
                                </div>
                                <div class="price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
                            </div>
                        </a>
                        <?php
                        woocommerce_template_loop_add_to_cart();
                        ?>
                    </div>
                    <?php
                }
            }

            woocommerce_product_loop_end();
            ?>
        </div>

        <div style="text-align:center;margin-top:3rem;">
            <?php woocommerce_pagination(); ?>
        </div>

    <?php else : ?>
        <p style="text-align:center;color:var(--gray);padding:4rem 20px;font-size:1.1rem;">
            <?php esc_html_e( 'No products found. Check back soon!', 'perspective-reflectives' ); ?>
        </p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
