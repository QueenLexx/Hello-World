<?php
defined( 'ABSPATH' ) || exit;
get_header();
?>

<main class="woocommerce-page" style="padding-bottom:6rem;">
    <?php woocommerce_output_all_notices(); ?>

    <?php while ( have_posts() ) : the_post(); ?>
        <?php global $product; ?>

        <div class="single-product">
            <div class="product">

                <div class="product-images">
                    <?php
                    $attachment_ids = $product->get_gallery_image_ids();
                    array_unshift( $attachment_ids, get_post_thumbnail_id() );
                    $attachment_ids = array_filter( array_unique( $attachment_ids ) );

                    if ( ! empty( $attachment_ids ) ) {
                        $main_id = array_shift( $attachment_ids );
                        echo wp_get_attachment_image( $main_id, 'large', false, array(
                            'style' => 'width:100%;border-radius:12px;margin-bottom:1rem;',
                            'id'    => 'main-product-image',
                        ) );

                        if ( ! empty( $attachment_ids ) ) {
                            echo '<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:0.5rem;">';
                            foreach ( $attachment_ids as $gid ) {
                                $thumb = wp_get_attachment_image_url( $gid, 'thumbnail' );
                                $full  = wp_get_attachment_image_url( $gid, 'large' );
                                echo '<img src="' . esc_url( $thumb ) . '" data-full="' . esc_url( $full ) . '" '
                                   . 'style="border-radius:8px;cursor:pointer;border:2px solid transparent;transition:border-color 0.3s;" '
                                   . 'class="gallery-thumb" alt="">';
                            }
                            echo '</div>';
                        }
                    } else {
                        echo '<div class="product-image" style="border-radius:12px;"><span>&#128197;</span></div>';
                    }
                    ?>
                </div>

                <div class="summary">
                    <?php woocommerce_breadcrumb(); ?>

                    <h1 class="product-title"><?php the_title(); ?></h1>

                    <?php if ( $product->is_on_sale() ) : ?>
                        <span class="onsale" style="position:static;display:inline-block;margin-bottom:1rem;">
                            <?php esc_html_e( 'Sale', 'perspective-reflectives' ); ?>
                        </span>
                    <?php endif; ?>

                    <div class="price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>

                    <div class="product-description">
                        <?php echo wp_kses_post( $product->get_short_description() ); ?>
                    </div>

                    <?php if ( $product->is_in_stock() ) : ?>
                        <form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
                            <div class="quantity">
                                <label for="quantity" style="display:block;margin-bottom:0.5rem;color:var(--gray);">
                                    <?php esc_html_e( 'Quantity', 'perspective-reflectives' ); ?>
                                </label>
                                <input type="number" id="quantity" name="quantity" value="1" min="1"
                                       max="<?php echo esc_attr( $product->get_max_purchase_quantity() ); ?>"
                                       step="1">
                            </div>
                            <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="add_to_cart_button">
                                <?php esc_html_e( 'Add to Cart', 'perspective-reflectives' ); ?>
                            </button>
                        </form>
                    <?php else : ?>
                        <p style="color:var(--gold);font-size:1.1rem;">
                            <?php esc_html_e( 'Out of Stock', 'perspective-reflectives' ); ?>
                        </p>
                    <?php endif; ?>

                    <div style="margin-top:2rem;padding-top:2rem;border-top:1px solid rgba(255,215,0,0.1);">
                        <?php echo wp_kses_post( $product->get_description() ); ?>
                    </div>
                </div>

            </div>
        </div>

    <?php endwhile; ?>
</main>

<script>
document.querySelectorAll('.gallery-thumb').forEach(function(thumb) {
    thumb.addEventListener('click', function() {
        var main = document.getElementById('main-product-image');
        if (main) main.src = this.dataset.full;
        document.querySelectorAll('.gallery-thumb').forEach(function(t) {
            t.style.borderColor = 'transparent';
        });
        this.style.borderColor = 'var(--gold)';
    });
});
</script>

<?php get_footer(); ?>
