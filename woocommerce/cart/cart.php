<?php
defined( 'ABSPATH' ) || exit;
get_header();
?>

<main class="woocommerce-page">
    <div class="woocommerce-cart">
        <h1 class="page-title"><?php esc_html_e( 'Your Cart', 'perspective-reflectives' ); ?></h1>

        <?php woocommerce_output_all_notices(); ?>

        <?php if ( WC()->cart->is_empty() ) : ?>
            <div style="text-align:center;padding:4rem 0;">
                <p style="font-size:1.2rem;color:var(--gray);margin-bottom:2rem;">
                    <?php esc_html_e( 'Your cart is currently empty.', 'perspective-reflectives' ); ?>
                </p>
                <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="cta-button">
                    <?php esc_html_e( 'Return to Shop', 'perspective-reflectives' ); ?>
                </a>
            </div>
        <?php else : ?>

            <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                <div class="cart-table">
                    <table style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th></th>
                                <th><?php esc_html_e( 'Product', 'perspective-reflectives' ); ?></th>
                                <th><?php esc_html_e( 'Price', 'perspective-reflectives' ); ?></th>
                                <th><?php esc_html_e( 'Quantity', 'perspective-reflectives' ); ?></th>
                                <th><?php esc_html_e( 'Subtotal', 'perspective-reflectives' ); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
                                $product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                if ( ! $product || ! $product->exists() || $cart_item['quantity'] === 0 ) continue;
                                ?>
                                <tr class="woocommerce-cart-form__cart-item">
                                    <td style="width:40px;">
                                        <a href="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ); ?>"
                                           style="color:rgba(255,215,0,0.5);font-size:1.2rem;"
                                           aria-label="<?php esc_attr_e( 'Remove item', 'perspective-reflectives' ); ?>">
                                            &times;
                                        </a>
                                    </td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:1rem;">
                                            <?php if ( has_post_thumbnail( $product->get_id() ) ) : ?>
                                                <img src="<?php echo esc_url( get_the_post_thumbnail_url( $product->get_id(), 'thumbnail' ) ); ?>"
                                                     alt="<?php echo esc_attr( $product->get_name() ); ?>"
                                                     style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                                            <?php endif; ?>
                                            <a href="<?php echo esc_url( $product->get_permalink() ); ?>" style="color:var(--white);">
                                                <?php echo esc_html( $product->get_name() ); ?>
                                            </a>
                                        </div>
                                    </td>
                                    <td><?php echo wp_kses_post( $product->get_price_html() ); ?></td>
                                    <td>
                                        <?php
                                        $product_quantity = woocommerce_quantity_input( array(
                                            'input_name'   => "cart[{$cart_item_key}][qty]",
                                            'input_value'  => $cart_item['quantity'],
                                            'max_value'    => $product->get_max_purchase_quantity(),
                                            'min_value'    => '0',
                                            'product_name' => $product->get_name(),
                                        ), $product, false );
                                        echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                                        ?>
                                    </td>
                                    <td><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2rem;flex-wrap:wrap;gap:1rem;">
                        <div>
                            <input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'perspective-reflectives' ); ?>"
                                   style="background:rgba(10,10,10,0.8);border:1px solid rgba(255,215,0,0.3);color:var(--white);padding:0.8rem 1rem;border-radius:8px;margin-right:0.5rem;">
                            <button type="submit" name="apply_coupon" class="add_to_cart_button" style="width:auto;padding:0.8rem 1.5rem;">
                                <?php esc_html_e( 'Apply Coupon', 'perspective-reflectives' ); ?>
                            </button>
                        </div>
                        <button type="submit" name="update_cart" class="add_to_cart_button" style="width:auto;padding:0.8rem 1.5rem;background:transparent;border:1px solid rgba(255,215,0,0.3);color:var(--white);">
                            <?php esc_html_e( 'Update Cart', 'perspective-reflectives' ); ?>
                        </button>
                    </div>

                    <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                </div>
            </form>

            <div class="cart-totals">
                <h2><?php esc_html_e( 'Cart Totals', 'perspective-reflectives' ); ?></h2>

                <table style="width:100%;border-collapse:collapse;">
                    <tr>
                        <th style="text-align:left;padding:0.8rem 0;border-bottom:1px solid rgba(255,215,0,0.1);color:var(--gray);">
                            <?php esc_html_e( 'Subtotal', 'perspective-reflectives' ); ?>
                        </th>
                        <td style="padding:0.8rem 0;border-bottom:1px solid rgba(255,215,0,0.1);">
                            <?php wc_cart_totals_subtotal_html(); ?>
                        </td>
                    </tr>
                    <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                        <tr>
                            <th style="text-align:left;padding:0.8rem 0;border-bottom:1px solid rgba(255,215,0,0.1);color:var(--gray);">
                                <?php echo esc_html( wc_cart_totals_coupon_label( $coupon, false ) ); ?>
                            </th>
                            <td style="padding:0.8rem 0;border-bottom:1px solid rgba(255,215,0,0.1);">
                                <?php wc_cart_totals_coupon_html( $coupon ); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th style="text-align:left;padding:1rem 0;color:var(--gold);font-size:1.2rem;">
                            <?php esc_html_e( 'Total', 'perspective-reflectives' ); ?>
                        </th>
                        <td style="padding:1rem 0;color:var(--gold);font-size:1.4rem;font-family:'Playfair Display',serif;font-weight:700;">
                            <?php wc_cart_totals_order_total_html(); ?>
                        </td>
                    </tr>
                </table>

                <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-button" style="display:block;text-align:center;">
                    <?php esc_html_e( 'Proceed to Checkout', 'perspective-reflectives' ); ?>
                </a>
            </div>

        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
