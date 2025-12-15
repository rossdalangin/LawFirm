<?php
/**
 * Admin notice to clarify editing workflow
 *
 * @package Legacy_Pro_Max
 */

function legacy_pro_max_editing_notice() {
	$screen = get_current_screen();
	if ( 'post' === $screen->base && 'page' === $screen->id && get_option( 'page_on_front' ) == get_the_ID() ) {
		?>
		<div class="notice notice-info is-dismissible">
			<p>
				<strong><?php esc_html_e( 'Editing the Homepage', 'legacy-pro-max' ); ?></strong><br>
				<?php esc_html_e( 'You are currently editing the content of the homepage. To manage the styling of the homepage sections (e.g., background colors, fonts), please go to the Customizer.', 'legacy-pro-max' ); ?>
				<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Go to Customizer', 'legacy-pro-max' ); ?></a>
			</p>
		</div>
		<?php
	}
}
add_action( 'admin_notices', 'legacy_pro_max_editing_notice' );
