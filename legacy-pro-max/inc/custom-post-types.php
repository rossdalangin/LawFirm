<?php
/**
 * Custom Post Types for Legacy Pro Max
 *
 * @package Legacy_Pro_Max
 */

/**
 * Register the Custom Post Types.
 */
function legacy_pro_max_register_post_types() {

	/**
	 * Post Type: Attorneys.
	 */
	$labels_attorneys = array(
		'name'          => __( 'Attorneys', 'legacy-pro-max' ),
		'singular_name' => __( 'Attorney', 'legacy-pro-max' ),
	);

	$args_attorneys = array(
		'label'               => __( 'Attorneys', 'legacy-pro-max' ),
		'labels'              => $labels_attorneys,
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => true,
		'rest_base'           => '',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'has_archive'         => false,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'delete_with_user'    => false,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array(
			'slug'       => 'attorney',
			'with_front' => true,
		),
		'query_var'           => true,
		'menu_icon'           => 'dashicons-groups',
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'attorney', $args_attorneys );


	/**
	 * Post Type: Practice Areas.
	 */
	$labels_practice_areas = array(
		'name'          => __( 'Practice Areas', 'legacy-pro-max' ),
		'singular_name' => __( 'Practice Area', 'legacy-pro-max' ),
	);

	$args_practice_areas = array(
		'label'               => __( 'Practice Areas', 'legacy-pro-max' ),
		'labels'              => $labels_practice_areas,
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => true,
		'rest_base'           => '',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'has_archive'         => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'delete_with_user'    => false,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => true,
		'rewrite'             => array(
			'slug'       => 'practice-area',
			'with_front' => true,
		),
		'query_var'           => true,
		'menu_icon'           => 'dashicons-book-alt',
		'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
	);

	register_post_type( 'practice-area', $args_practice_areas );


	/**
	 * Post Type: Case Results.
	 */
	$labels_case_results = array(
		'name'          => __( 'Case Results', 'legacy-pro-max' ),
		'singular_name' => __( 'Case Result', 'legacy-pro-max' ),
	);

	$args_case_results = array(
		'label'               => __( 'Case Results', 'legacy-pro-max' ),
		'labels'              => $labels_case_results,
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => true,
		'rest_base'           => '',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'has_archive'         => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'delete_with_user'    => false,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array(
			'slug'       => 'case-result',
			'with_front' => true,
		),
		'query_var'           => true,
		'menu_icon'           => 'dashicons-analytics',
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'case-result', $args_case_results );


	/**
	 * Post Type: Testimonials.
	 */
	$labels_testimonials = array(
		'name'          => __( 'Testimonials', 'legacy-pro-max' ),
		'singular_name' => __( 'Testimonial', 'legacy-pro-max' ),
	);

	$args_testimonials = array(
		'label'               => __( 'Testimonials', 'legacy-pro-max' ),
		'labels'              => $labels_testimonials,
		'description'         => '',
		'public'              => false,
		'publicly_queryable'  => false,
		'show_ui'             => true,
		'show_in_rest'        => true,
		'rest_base'           => '',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'has_archive'         => false,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'delete_with_user'    => false,
		'exclude_from_search' => true,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array(
			'slug'       => 'testimonial',
			'with_front' => true,
		),
		'query_var'           => true,
		'menu_icon'           => 'dashicons-format-quote',
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'testimonial', $args_testimonials );

}

add_action( 'init', 'legacy_pro_max_register_post_types' );
