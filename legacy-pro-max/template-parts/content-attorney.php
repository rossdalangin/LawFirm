<?php
/**
 * Template part for displaying single attorney posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Legacy_Pro_Max
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php the_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		// Display Attorney-specific fields
		$bar_admissions = get_post_meta( get_the_ID(), '_attorney_bar_admissions', true );
		if ( ! empty( $bar_admissions ) ) {
			echo '<h2>' . esc_html__( 'Bar Admissions', 'legacy-pro-max' ) . '</h2>';
			echo wp_kses_post( wpautop( $bar_admissions ) );
		}

		$certifications = get_post_meta( get_the_ID(), '_attorney_certifications', true );
		if ( ! empty( $certifications ) ) {
			echo '<h2>' . esc_html__( 'Certifications', 'legacy-pro-max' ) . '</h2>';
			echo wp_kses_post( wpautop( $certifications ) );
		}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php legacy_pro_max_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
