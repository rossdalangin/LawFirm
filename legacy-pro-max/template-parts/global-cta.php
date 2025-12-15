<?php
/**
 * Template part for displaying the global CTA section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Legacy_Pro_Max
 */

$headline    = get_theme_mod( 'legacy_pro_max_global_cta_headline', __( 'Request a Free Consultation', 'legacy-pro-max' ) );
$text        = get_theme_mod( 'legacy_pro_max_global_cta_text', __( 'Get expert legal advice today. Contact us for a no-obligation consultation.', 'legacy-pro-max' ) );
$button_text = get_theme_mod( 'legacy_pro_max_global_cta_button_text', __( 'Contact Us', 'legacy-pro-max' ) );
$button_url  = get_theme_mod( 'legacy_pro_max_global_cta_button_url', '#' );
?>

<section class="global-cta homepage-section">
	<div class="global-cta-inner">
		<h2><?php echo esc_html( $headline ); ?></h2>
		<p><?php echo wp_kses_post( $text ); ?></p>
		<a href="<?php echo esc_url( $button_url ); ?>" class="btn"><?php echo esc_html( $button_text ); ?></a>
	</div>
</section>
