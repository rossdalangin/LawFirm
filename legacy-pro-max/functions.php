<?php
/**
 * Legacy Pro Max functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Legacy_Pro_Max
 */

// ... (existing code)

/**
 * Filter front page content to add section wrappers.
 */
function legacy_pro_max_filter_front_page_content( $content ) {
	if ( is_front_page() ) {
		$blocks = parse_blocks( $content );
		$output = '';

		foreach ( $blocks as $index => $block ) {
			$show_setting_name = '';
			$parallax_setting_name = '';
			$section_class = '';

			if ( isset( $block['blockName'] ) ) {
				$block_slug = str_replace( 'legacy-pro-max/', '', $block['blockName'] );
				$section_class = 'homepage-section--' . $block_slug;

				switch ( $block['blockName'] ) {
					case 'legacy-pro-max/hero':
						$show_setting_name = 'legacy_pro_max_hero_show';
						$parallax_setting_name = 'legacy_pro_max_hero_parallax';
						break;
					case 'legacy-pro-max/practice-areas':
						$show_setting_name = 'legacy_pro_max_practice_areas_show';
						break;
					case 'legacy-pro-max/attorneys':
						$show_setting_name = 'legacy_pro_max_attorneys_show';
						break;
					case 'legacy-pro-max/case-results':
						$show_setting_name = 'legacy_pro_max_case_results_show';
						break;
					case 'legacy-pro-max/testimonials':
						$show_setting_name = 'legacy_pro_max_testimonials_show';
						break;
				}
			}

			if ( ! empty( $show_setting_name ) && ! get_theme_mod( $show_setting_name, true ) ) {
				continue;
			}

			$wrapper_attributes = '';
			if ( ! empty( $parallax_setting_name ) && get_theme_mod( $parallax_setting_name, false ) ) {
				$wrapper_attributes = ' data-parallax="true"';
			}

			$output .= '<div class="' . esc_attr( $section_class ) . '"' . $wrapper_attributes . '>';
			$output .= render_block( $block );
			$output .= '</div>';
		}
		return $output;
	}
	return $content;
}
add_filter( 'the_content', 'legacy_pro_max_filter_front_page_content' );
