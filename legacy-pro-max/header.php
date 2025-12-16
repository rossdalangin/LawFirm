<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Legacy_Pro_Max
 */
$header_background_type = get_theme_mod('legacy_pro_max_header_background_type', 'color');
$header_background_video = get_theme_mod('legacy_pro_max_header_background_video', '');
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'legacy-pro-max' ); ?></a>

<header id="masthead" class="site-header<?php if (get_theme_mod('legacy_pro_max_header_sticky')) echo ' is-sticky'; ?>">
        <?php if ($header_background_type === 'video' && !empty($header_background_video)) : ?>
        <div class="background-video-wrapper">
            <video playsinline autoplay muted loop poster="">
                <source src="<?php echo esc_url($header_background_video); ?>" type="video/mp4">
            </video>
        </div>
    <?php endif; ?>
		<div class="site-header-inner">
			<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$legacy_pro_max_description = get_bloginfo( 'description', 'display' );
				if ( $legacy_pro_max_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $legacy_pro_max_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'legacy-pro-max' ); ?></span>
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor" class="icon-menu">
						<path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"></path>
					</svg>
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor" class="icon-close">
						<path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path>
					</svg>
				</button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
			</nav><!-- #site-navigation -->
		</div><!-- .site-header-inner -->
	</header><!-- #masthead -->
	<div id="content" class="site-content">

	<div class="mobile-nav-overlay">
		<a href="#" class="close-mobile-nav">&times;</a>
		<nav class="mobile-navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu-mobile',
				)
			);
			?>
		</nav>
	</div>
