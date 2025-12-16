<?php
$section_slug = 'testimonials';
$section_id = 'legacy_pro_max_' . $section_slug;

// Content Settings
$title = get_theme_mod($section_id . '_headline', 'What Our Clients Say');
$query = new WP_Query(array('post_type' => 'testimonial', 'posts_per_page' => 5));

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
        <div class="testimonials-slider">
            <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                <div class="testimonial-item">
                    <blockquote><?php the_content(); ?></blockquote>
                    <cite><?php the_title(); ?></cite>
                </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
    </div>
</section>
