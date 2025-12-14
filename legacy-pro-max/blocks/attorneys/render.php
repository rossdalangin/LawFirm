<?php
/**
 * Attorneys Block Render Template.
 *
 * @param array $attributes The block attributes.
 * @param string $content The block content.
 * @param WP_Block $block The block object.
 *
 * @package Legacy_Pro_Max
 */

$args = array(
	'post_type'      => 'attorney',
	'posts_per_page' => -1,
	'orderby'        => 'title',
	'order'          => 'ASC',
);

$attorneys = new WP_Query( $args );
?>
<div <?php echo get_block_wrapper_attributes(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php if ( $attorneys->have_posts() ) : ?>
		<div class="attorneys-grid">
			<?php
			while ( $attorneys->have_posts() ) :
				$attorneys->the_post();
				?>
				<div class="attorney-card">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="attorney-thumbnail">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium' ); ?></a>
						</div>
					<?php endif; ?>
					<h3 class="attorney-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
					<div class="attorney-excerpt">
						<?php the_excerpt(); ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
		<?php wp_reset_postdata(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'No attorneys found.', 'legacy-pro-max' ); ?></p>
	<?php endif; ?>
</div>
