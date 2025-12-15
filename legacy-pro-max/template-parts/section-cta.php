<?php
$headline = get_theme_mod('legacy_pro_max_cta_headline', 'Request a Free Consultation');
$button_text = get_theme_mod('legacy_pro_max_cta_button_text', 'Contact Us Today');
$button_url = get_theme_mod('legacy_pro_max_cta_button_url', '#');
?>
<section id="cta" class="homepage-section homepage-section--cta">
    <div class="container">
        <h2><?php echo esc_html($headline); ?></h2>
        <a href="<?php echo esc_url($button_url); ?>" class="button"><?php echo esc_html($button_text); ?></a>
    </div>
</section>
