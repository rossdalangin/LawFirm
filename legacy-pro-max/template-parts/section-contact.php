<?php
$section_slug = 'contact';
$section_id = 'legacy_pro_max_' . $section_slug;

// Content Settings
$title = get_theme_mod($section_id . '_headline', 'Contact Us');
$shortcode = get_theme_mod($section_id . '_shortcode', '');

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
        <div class="contact-form">
            <?php echo do_shortcode(wp_kses_post($shortcode)); ?>
        </div>
    </div>
</section>
