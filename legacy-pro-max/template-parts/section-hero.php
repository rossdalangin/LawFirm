<?php
$section_slug = 'hero';
$section_id = 'legacy_pro_max_' . $section_slug;

// Content Settings
$headline = get_theme_mod($section_id . '_headline', 'Default Headline');
$subheading = get_theme_mod($section_id . '_subheading', 'Default subheading text.');
$button_text = get_theme_mod($section_id . '_button_text', 'Learn More');
$button_url = get_theme_mod($section_id . '_button_url', '#');
$parallax = get_theme_mod($section_id . '_parallax');

// Background Settings
$background_type = get_theme_mod($section_id . '_background_type', 'color');
$background_video = get_theme_mod($section_id . '_background_video', '');

?>
<section id="<?php echo esc_attr($section_slug); ?>" class="homepage-section homepage-section--<?php echo esc_attr($section_slug); ?>" <?php if ($parallax) echo 'data-parallax="true"'; ?>>
    <?php if ($background_type === 'video' && !empty($background_video)) : ?>
        <div class="background-video-wrapper">
            <video playsinline autoplay muted loop poster="">
                <source src="<?php echo esc_url($background_video); ?>" type="video/mp4">
            </video>
        </div>
    <?php endif; ?>
    <div class="container">
        <h1><?php echo esc_html($headline); ?></h1>
        <p><?php echo esc_html($subheading); ?></p>
        <a href="<?php echo esc_url($button_url); ?>" class="button"><?php echo esc_html($button_text); ?></a>
    </div>
</section>
