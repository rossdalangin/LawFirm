<?php
/**
 * Functions for setting up the theme's demo content.
 * This is the final and correct implementation.
 * @package Legacy_Pro_Max
 */

function legacy_pro_max_ocdi_import_files() {
    $archetypes = [
        'boutique-litigation' => 'Boutique Litigation',
        'corporate-counsel' => 'Corporate Counsel',
        'personal-injury' => 'Personal Injury',
        'ip-tech-law' => 'IP / Tech Law',
        'family-law' => 'Family Law',
        'criminal-defense' => 'Criminal Defense',
    ];
    $imports = [];
    foreach ($archetypes as $slug => $name) {
        $imports[] = [
            'import_file_name'           => $name,
            'local_import_file'            => get_template_directory() . "/demo-content/{$slug}/content.xml",
            'local_import_widget_file'     => get_template_directory() . "/demo-content/{$slug}/widgets.wie",
            'local_import_customizer_file' => get_template_directory() . "/demo-content/{$slug}/customizer.dat",
        ];
    }
    return $imports;
}
add_filter( 'ocdi/import_files', 'legacy_pro_max_ocdi_import_files' );

function legacy_pro_max_ocdi_after_import_setup( $selected_import ) {
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
    set_theme_mod( 'nav_menu_locations', [ 'primary' => $main_menu->term_id ] );
    $front_page_id = get_page_by_title( 'Home' );
    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
}
add_action( 'ocdi/after_import', 'legacy_pro_max_ocdi_after_import_setup', 10, 1 );
