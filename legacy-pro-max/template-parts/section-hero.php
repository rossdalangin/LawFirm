<?php
$headline = get_theme_mod('legacy_pro_max_hero_headline', 'Default Headline');
$subheading = get_theme_mod('legacy_pro_max_hero_subheading', 'Default subheading text.');
$button_text = get_theme_mod('legacy_pro_max_hero_button_text', 'Learn More');
$button_url = get_theme_mod('legacy_pro_max_hero_button_url', '#');
?>
<section id="hero" class="homepage-section homepage-section--hero" <?php if (get_theme_mod('legacy_pro_max_hero_parallax')) echo 'data-parallax="true"'; ?>>
    <div class="container">
        <h1><?php echo esc_html($headline); ?></h1>
        <p><?php echo esc_html($subheading); ?></p>
        <a href="<?php echo esc_url($button_url); ?>" class="button"><?php echo esc_html($button_text); ?></a>
    </div>
</section>
