<?php
/**
 * Testimonials Block Render Template.
 *
 * @param array $attributes The block attributes.
 * @param string $content The block content.
 * @param WP_Block $block The block object.
 *
 * @package Legacy_Pro_Max
 */

$args = array(
	'post_type'      => 'testimonial',
	'posts_per_page' => -1,
	'orderby'        => 'date',
	'order'          => 'DESC',
);

$testimonials = new WP_Query( $args );
$slider_id    = 'slides-' . uniqid();
?>
<div <?php echo get_block_wrapper_attributes(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php if ( $testimonials->have_posts() ) : ?>
		<div class="testimonials-slider" role="region" aria-label="Testimonials">
			<div class="slides" id="<?php echo esc_attr( $slider_id ); ?>">
				<?php
				while ( $testimonials->have_posts() ) :
					$testimonials->the_post();
					?>
					<div class="testimonial-slide" role="group" aria-label="Slide <?php echo esc_attr( $testimonials->current_post + 1 ); ?> of <?php echo esc_attr( $testimonials->post_count ); ?>">
						<blockquote class="testimonial-content"><?php the_content(); ?></blockquote>
						<cite class="testimonial-author"><?php the_title(); ?></cite>
					</div>
				<?php endwhile; ?>
			</div>
			<button class="prev" aria-label="Previous Slide" aria-controls="<?php echo esc_attr( $slider_id ); ?>">&lt;</button>
			<button class="next" aria-label="Next Slide" aria-controls="<?php echo esc_attr( $slider_id ); ?>">&gt;</button>
		</div>
		<?php wp_reset_postdata(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'No testimonials found.', 'legacy-pro-max' ); ?></p>
	<?php endif; ?>
</div>
