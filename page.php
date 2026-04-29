<?php get_header(); ?>

<main class="woocommerce-page" style="padding-top:8rem;">
    <div style="max-width:900px;margin:0 auto;padding:0 20px;">
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>">
                <h1 class="page-title"><?php the_title(); ?></h1>
                <div class="product-description" style="font-size:1.1rem;line-height:1.8;margin-top:2rem;">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>
