<?php get_header(); ?>

<!-- HERO -->
<section class="hero-section">
    <div class="hero-content">
        <p class="hero-subtitle"><?php esc_html_e( 'Mindful Living, Beautifully Crafted', 'perspective-reflectives' ); ?></p>
        <h1 class="hero-title"><?php esc_html_e( 'Perspective Reflectives', 'perspective-reflectives' ); ?></h1>
        <p class="hero-description">
            <?php esc_html_e( 'Luxury calendars designed to slow you down, open your eyes, and invite daily reflection. Each page is a moment to pause, breathe, and realign with what matters most.', 'perspective-reflectives' ); ?>
        </p>
        <?php if ( class_exists( 'WooCommerce' ) ) : ?>
        <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="cta-button">
            <?php esc_html_e( 'Shop the Collection', 'perspective-reflectives' ); ?>
        </a>
        <?php endif; ?>
    </div>
</section>

<!-- FEATURED PRODUCTS -->
<?php if ( class_exists( 'WooCommerce' ) ) : ?>
<section class="woocommerce-page">
    <div class="page-title-wrap" style="max-width:1400px;margin:0 auto;padding:0 20px;">
        <h2 class="page-title"><?php esc_html_e( 'Our Calendars', 'perspective-reflectives' ); ?></h2>
    </div>
    <?php
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 6,
        'post_status'    => 'publish',
        'meta_query'     => array( WC()->query->get_meta_query() ),
        'tax_query'      => array( WC()->query->get_tax_query() ),
    );
    $products = new WP_Query( $args );

    if ( $products->have_posts() ) :
        echo '<div class="products">';
        while ( $products->have_posts() ) :
            $products->the_post();
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
                        <h3 class="product-title"><?php the_title(); ?></h3>
                        <div class="product-description"><?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 18 ) ); ?></div>
                        <div class="price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
                    </div>
                </a>
                <?php
                woocommerce_template_loop_add_to_cart( array(
                    'class' => implode( ' ', array_filter( array(
                        'add_to_cart_button',
                        $product->get_type(),
                        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                    ) ) ),
                ) );
                ?>
            </div>
            <?php
        endwhile;
        echo '</div>';
        wp_reset_postdata();
    endif;
    ?>
    <div style="text-align:center;margin-top:3rem;">
        <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="cta-button">
            <?php esc_html_e( 'View All', 'perspective-reflectives' ); ?>
        </a>
    </div>
</section>
<?php endif; ?>

<!-- ABOUT -->
<section class="about-section">
    <div class="about-grid">
        <div class="about-text">
            <h2><?php esc_html_e( 'More Than a Calendar', 'perspective-reflectives' ); ?></h2>
            <p><?php esc_html_e( 'Each Perspective Reflectives calendar is a curated journey through the year — paired with mindfulness prompts, affirmations, and stunning visuals that invite you to see your world differently.', 'perspective-reflectives' ); ?></p>
            <p><?php esc_html_e( 'Printed on premium 130gsm paper with archival inks, our calendars are built to last and beautiful enough to frame.', 'perspective-reflectives' ); ?></p>
            <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="cta-button" style="font-size:1rem;padding:0.9rem 2rem;">
                <?php esc_html_e( 'Our Story', 'perspective-reflectives' ); ?>
            </a>
        </div>
        <div class="about-visual">
            <div class="stat">
                <span class="stat-number">10K+</span>
                <span class="stat-label"><?php esc_html_e( 'Happy Customers', 'perspective-reflectives' ); ?></span>
            </div>
            <div class="stat">
                <span class="stat-number">12</span>
                <span class="stat-label"><?php esc_html_e( 'Calendar Designs', 'perspective-reflectives' ); ?></span>
            </div>
            <div class="stat">
                <span class="stat-number">5&#9733;</span>
                <span class="stat-label"><?php esc_html_e( 'Average Rating', 'perspective-reflectives' ); ?></span>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="features-section">
    <h2><?php esc_html_e( 'Why Perspective Reflectives', 'perspective-reflectives' ); ?></h2>
    <p class="section-subtitle"><?php esc_html_e( 'Every detail is intentional.', 'perspective-reflectives' ); ?></p>
    <div class="features-grid">
        <div class="feature-card">
            <span class="feature-icon">&#10024;</span>
            <h3><?php esc_html_e( 'Mindful Design', 'perspective-reflectives' ); ?></h3>
            <p><?php esc_html_e( 'Monthly reflective prompts and affirmations crafted to ground and inspire you through every season.', 'perspective-reflectives' ); ?></p>
        </div>
        <div class="feature-card">
            <span class="feature-icon">&#127775;</span>
            <h3><?php esc_html_e( 'Premium Quality', 'perspective-reflectives' ); ?></h3>
            <p><?php esc_html_e( 'Thick 130gsm paper, archival-quality inks, and sturdy binding mean your calendar holds up all year long.', 'perspective-reflectives' ); ?></p>
        </div>
        <div class="feature-card">
            <span class="feature-icon">&#127926;</span>
            <h3><?php esc_html_e( 'Original Art', 'perspective-reflectives' ); ?></h3>
            <p><?php esc_html_e( 'Every image is original artwork — no stock photos. Each piece tells a story worth hanging on your wall.', 'perspective-reflectives' ); ?></p>
        </div>
        <div class="feature-card">
            <span class="feature-icon">&#128230;</span>
            <h3><?php esc_html_e( 'Fast Shipping', 'perspective-reflectives' ); ?></h3>
            <p><?php esc_html_e( 'Free shipping on orders over $50. Orders ship within 1-2 business days in protective packaging.', 'perspective-reflectives' ); ?></p>
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
<section class="testimonials-section">
    <h2><?php esc_html_e( 'What People Are Saying', 'perspective-reflectives' ); ?></h2>
    <div class="testimonials-grid">
        <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-text"><?php esc_html_e( '"I look forward to flipping to each new month. The prompts help me set intentions and the art is genuinely beautiful. Best calendar I\'ve ever owned."', 'perspective-reflectives' ); ?></p>
            <span class="testimonial-author">— Maya T.</span>
        </div>
        <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-text"><?php esc_html_e( '"Bought three — one for my office, one for home, one as a gift. Everyone asks where I got it. The quality is unreal for the price."', 'perspective-reflectives' ); ?></p>
            <span class="testimonial-author">— Jordan L.</span>
        </div>
        <div class="testimonial-card">
            <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="testimonial-text"><?php esc_html_e( '"It\'s the first thing I see in the morning and it genuinely shifts my mindset. The reflective questions have become part of my daily ritual."', 'perspective-reflectives' ); ?></p>
            <span class="testimonial-author">— Simone R.</span>
        </div>
    </div>
</section>

<!-- NEWSLETTER -->
<section class="newsletter-section">
    <h2><?php esc_html_e( 'Stay Inspired', 'perspective-reflectives' ); ?></h2>
    <p><?php esc_html_e( 'Get early access to new designs, mindfulness tips, and exclusive subscriber discounts.', 'perspective-reflectives' ); ?></p>
    <form class="newsletter-form" id="newsletter-form" novalidate>
        <input type="email" name="email" placeholder="<?php esc_attr_e( 'Your email address', 'perspective-reflectives' ); ?>" required>
        <button type="submit"><?php esc_html_e( 'Subscribe', 'perspective-reflectives' ); ?></button>
    </form>
    <p class="newsletter-message" id="newsletter-message" style="margin-top:1rem;display:none;"></p>
</section>

<?php get_footer(); ?>
