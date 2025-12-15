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
				<?php
				$copyright_text = get_theme_mod( 'legacy_pro_max_copyright_text', __( '&copy; ' . date( 'Y' ) . ' Legacy Pro Max. All Rights Reserved.', 'legacy-pro-max' ) );
				echo wp_kses_post( $copyright_text );
				?>
			</div><!-- .site-info -->

			<?php legacy_pro_max_attorney_advertising_notice(); ?>
		</div><!-- .site-footer-inner -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
