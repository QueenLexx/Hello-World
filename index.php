<?php get_header(); ?>

<main class="woocommerce-page" style="padding-top:8rem;">
    <div style="max-width:1400px;margin:0 auto;padding:0 20px;">

        <?php if ( have_posts() ) : ?>
            <h1 class="page-title">
                <?php
                if ( is_home() && ! is_front_page() ) {
                    single_post_title();
                } elseif ( is_archive() ) {
                    the_archive_title();
                } else {
                    esc_html_e( 'Latest Posts', 'perspective-reflectives' );
                }
                ?>
            </h1>

            <div class="posts-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:2rem;">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article class="product" style="text-decoration:none;">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="product-image">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'product-thumb' ); ?></a>
                            </div>
                        <?php endif; ?>
                        <div class="product-content">
                            <h2 class="product-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="product-description"><?php the_excerpt(); ?></div>
                            <a href="<?php the_permalink(); ?>" class="add_to_cart_button">
                                <?php esc_html_e( 'Read More', 'perspective-reflectives' ); ?>
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div style="text-align:center;margin-top:3rem;">
                <?php the_posts_navigation(); ?>
            </div>

        <?php else : ?>
            <p style="text-align:center;color:var(--gray);font-size:1.1rem;">
                <?php esc_html_e( 'No content found.', 'perspective-reflectives' ); ?>
            </p>
        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>
