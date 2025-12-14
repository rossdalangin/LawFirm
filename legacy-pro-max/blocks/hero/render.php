<?php
/**
 * Hero Block Rende Template.
 *
 * @param array $attributes The block attributes.
 * @param string $content The block content.
 * @param WP_Block $block The block object.
 *
 * @package Legacy_Pro_Max
 */

$headline           = isset( $attributes['headline'] ) ? $attributes['headline'] : '';
$subheading         = isset( $attributes['subheading'] ) ? $attributes['subheading'] : '';
$button_text        = isset( $attributes['buttonText'] ) ? $attributes['buttonText'] : '';
$button_url         = isset( $attributes['buttonUrl'] ) ? $attributes['buttonUrl'] : '';
$background_type    = isset( $attributes['backgroundType'] ) ? $attributes['backgroundType'] : 'color';
$background_color   = isset( $attributes['backgroundColor'] ) ? $attributes['backgroundColor'] : 'var(--color-primary)';
$background_image   = isset( $attributes['backgroundImage'] ) ? $attributes['backgroundImage'] : '';

$background_style = 'color' === $background_type ?
	'background-color: ' . esc_attr( $background_color ) . ';' :
	'background-image: url(' . esc_url( $background_image ) . '); background-size: cover; background-position: center;';

?>
<section
	<?php echo get_block_wrapper_attributes(); // phpcs:ignore ?>
	style="<?php echo esc_attr( $background_style ); ?>"
>
	<div class="hero__content">
		<?php if ( ! empty( $headline ) ) : ?>
			<h1 class="hero__headline">
				<?php echo wp_kses_post( $headline ); ?>
			</h1>
		<?php endif; ?>

		<?php if ( ! empty( $subheading ) ) : ?>
			<p class="hero__subheading">
				<?php echo wp_kses_post( $subheading ); ?>
			</p>
		<?php endif; ?>

		<?php if ( ! empty( $button_text ) && ! empty( $button_url ) ) : ?>
			<a href="<?php echo esc_url( $button_url ); ?>" class="btn hero__button">
				<?php echo esc_html( $button_text ); ?>
			</a>
		<?php endif; ?>
	</div>
</section>
