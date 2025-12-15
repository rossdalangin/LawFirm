<?php
/**
 * The front page template file for Legacy Pro Max.
 *
 * This template is the cornerstone of the theme's Customizer-driven architecture.
 * It builds the homepage by looping through a defined set of sections and loading
 * the corresponding template part for each one, if that section is enabled in
 * the Customizer.
 *
 * @package Legacy_Pro_Max
 */

get_header(); ?>

<main id="primary" class="site-main">

    <?php
    $homepage_sections = array(
        'hero',
        'practice-areas',
        'attorneys',
        'case-results',
        'testimonials',
        'cta',
        'contact',
    );

    foreach ( $homepage_sections as $section ) {
        // Construct the theme mod setting name for visibility
        $show_section_mod = 'legacy_pro_max_' . str_replace( '-', '_', $section ) . '_show';

        // Check if the section is enabled in the Customizer (default is true)
        if ( get_theme_mod( $show_section_mod, true ) ) {
            get_template_part( 'template-parts/section', $section );
        }
    }
    ?>

</main><!-- #main -->

<?php get_footer();
