<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Legacy_Pro_Max
 */

?>
	</div><!-- #content -->
	<footer id="colophon" class="site-footer">
		<div class="site-footer-inner">
			<div class="site-info">
				&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>
				<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'legacy-pro-max' ), 'Legacy Pro Max', '<a href="https://example.com/legacy-pro-max">Legacy Pro Max</a>' );
				?>
			</div><!-- .site-info -->

			<?php legacy_pro_max_attorney_advertising_notice(); ?>
		</div><!-- .site-footer-inner -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
