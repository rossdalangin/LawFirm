<?php
$title = get_theme_mod('legacy_pro_max_practice_areas_title', 'Our Practice Areas');
$columns = get_theme_mod('legacy_pro_max_practice_areas_columns', 3);
$query = new WP_Query(array('post_type' => 'practice-area', 'posts_per_page' => $columns));
?>
<section id="practice-areas" class="homepage-section homepage-section--practice-areas">
    <div class="container">
        <h2><?php echo esc_html($title); ?></h2>
        <div class="practice-areas-grid columns-<?php echo esc_attr($columns); ?>">
            <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                <div class="practice-area-item">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <?php the_excerpt(); ?>
                </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
    </div>
</section>
