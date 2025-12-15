<?php
$title = get_theme_mod('legacy_pro_max_testimonials_title', 'What Our Clients Say');
$query = new WP_Query(array('post_type' => 'testimonial', 'posts_per_page' => 5));
?>
<section id="testimonials" class="homepage-section homepage-section--testimonials">
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
