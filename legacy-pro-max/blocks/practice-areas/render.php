<?php
/**
 * Practice Areas Block Render Template.
 *
 * @param array $attributes The block attributes.
 * @param string $content The block content.
 * @param WP_Block $block The block object.
 *
 * @package Legacy_Pro_Max
 */

$args = array(
	'post_type'      => 'practice-area',
	'posts_per_page' => -1,
	'orderby'        => 'title',
	'order'          => 'ASC',
);

$practice_areas = new WP_Query( $args );
?>
<div <?php echo get_block_wrapper_attributes(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php if ( $practice_areas->have_posts() ) : ?>
		<div class="practice-areas-grid">
			<?php
			while ( $practice_areas->have_posts() ) :
				$practice_areas->the_post();
				?>
				<div class="practice-area-card">
					<h3 class="practice-area-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
					<div class="practice-area-excerpt">
						<?php the_excerpt(); ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
		<?php wp_reset_postdata(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'No practice areas found.', 'legacy-pro-max' ); ?></p>
	<?php endif; ?>
</div>
