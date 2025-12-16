<?php
$section_slug = 'cta';
$section_id = 'legacy_pro_max_' . $section_slug;

// Content Settings
$headline = get_theme_mod($section_id . '_headline', 'Request a Free Consultation');
$button_text = get_theme_mod($section_id . '_button_text', 'Contact Us Today');
$button_url = get_theme_mod($section_id . '_button_url', '#');

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
        <h2><?php echo esc_html($headline); ?></h2>
        <a href="<?php echo esc_url($button_url); ?>" class="button"><?php echo esc_html($button_text); ?></a>
    </div>
</section>
