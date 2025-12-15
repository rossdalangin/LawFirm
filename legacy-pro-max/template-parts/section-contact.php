<?php
$title = get_theme_mod('legacy_pro_max_contact_title', 'Contact Us');
$shortcode = get_theme_mod('legacy_pro_max_contact_shortcode', '');
?>
<section id="contact" class="homepage-section homepage-section--contact">
    <div class="container">
        <h2><?php echo esc_html($title); ?></h2>
        <div class="contact-form">
            <?php echo do_shortcode(wp_kses_post($shortcode)); ?>
        </div>
    </div>
</section>
