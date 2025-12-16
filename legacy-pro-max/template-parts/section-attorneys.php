<?php
$section_slug = 'attorneys';
$section_id = 'legacy_pro_max_' . $section_slug;

// Content Settings
$title = get_theme_mod($section_id . '_headline', 'Our Attorneys');
$columns = get_theme_mod($section_id . '_columns', 3);
$query = new WP_Query(array('post_type' => 'attorney', 'posts_per_page' => $columns));

// Background Settings
$background_type = get_theme_mod($section_id . '_background_type', 'color');
$background_video = get_theme_mod($section_id . '_background_video', '');
?>
<section id="<?php echo esc_attr($section_slug); ?>" class="homepage-section homepage-section--<?php echo esc_attr($section_slug); ?>">
    <?php if ($background_type === 'video' && !empty($background_video)) : ?>
        <div class="background-video-wrapper">
            <video playsinline autoplay muted loop poster="">
                <source src="<?php echo esc_url($background_video); ?>" type="video/mp4">
            </video>
        </div>
    <?php endif; ?>
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
