<?php
/**
 * Case Results Block Render Template.
 *
 * @param array $attributes The block attributes.
 * @param string $content The block content.
 * @param WP_Block $block The block object.
 *
 * @package Legacy_Pro_Max
 */

$args = array(
	'post_type'      => 'case-result',
	'posts_per_page' => -1,
	'orderby'        => 'date',
	'order'          => 'DESC',
);

$case_results = new WP_Query( $args );
?>
<div <?php echo get_block_wrapper_attributes(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php if ( $case_results->have_posts() ) : ?>
		<div class="case-results-list">
			<?php
			while ( $case_results->have_posts() ) :
				$case_results->the_post();
				?>
				<div class="case-result-item">
					<h3 class="case-result-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
					<div class="case-result-excerpt">
						<?php the_excerpt(); ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
		<?php wp_reset_postdata(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'No case results found.', 'legacy-pro-max' ); ?></p>
	<?php endif; ?>
</div>
