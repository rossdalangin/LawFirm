<?php
$title = get_theme_mod('legacy_pro_max_attorneys_title', 'Our Attorneys');
$columns = get_theme_mod('legacy_pro_max_attorneys_columns', 3);
$query = new WP_Query(array('post_type' => 'attorney', 'posts_per_page' => $columns));
?>
<section id="attorneys" class="homepage-section homepage-section--attorneys">
    <div class="container">
        <h2><?php echo esc_html($title); ?></h2>
        <div class="attorneys-grid columns-<?php echo esc_attr($columns); ?>">
            <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                <div class="attorney-item">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="attorney-image">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                        </div>
                    <?php endif; ?>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p class="attorney-title"><?php echo get_post_meta(get_the_ID(), 'title', true); ?></p>
                </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
    </div>
</section>
