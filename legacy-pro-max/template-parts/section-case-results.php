<?php
$title = get_theme_mod('legacy_pro_max_case_results_title', 'Case Results');
$query = new WP_Query(array('post_type' => 'case-result', 'posts_per_page' => 3));
?>
<section id="case-results" class="homepage-section homepage-section--case-results">
    <div class="container">
        <h2><?php echo esc_html($title); ?></h2>
        <div class="case-results-list">
            <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                <div class="case-result-item">
                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <div class="case-result-amount"><?php echo get_post_meta(get_the_ID(), 'amount', true); ?></div>
                </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
    </div>
</section>
