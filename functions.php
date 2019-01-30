<?php
/**
 * Child theme functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Text Domain: oceanwp
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
function oceanwp_child_enqueue_parent_style() {
	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update your theme)
	$theme   = wp_get_theme( 'OceanWP' );
	$version = $theme->get( 'Version' );
	// Load the stylesheet
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'oceanwp-style' ), $version );
	
}
add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style' );




function register_tutorial() {

	/**
	 * Post Type: Tutorials.
	 */

	$labels = array(
		"name" => __( "Tutorials" ),
		"singular_name" => __( "Tutorial" ),
	);

	$args = array(
		"label" => __( "Tutorials" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "tutorial", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
		"taxonomies" => array( "tutorial_category" ),
	);

	register_post_type( "tutorial", $args );
}

add_action( 'init', 'register_tutorial' );



function register_tutorial_category() {

	/**
	 * Taxonomy: Tutorial categories.
	 */

	$labels = array(
		"name" => __( "Tutorial categories" ),
		"singular_name" => __( "Tutorial category" ),
	);

	$args = array(
		"label" => __( "Tutorial categories" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'tutorials', 'with_front' => false, ),
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "tutorial_category",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "tutorial_category", array( "tutorial" ), $args );
}
add_action( 'init', 'register_tutorial_category' );



function oceanwp_metabox( $types ) {

	// Your custom post type
	$types[] = 'tutorial';

	// Return
	return $types;

}
add_filter( 'ocean_main_metaboxes_post_types', 'oceanwp_metabox', 20 );






/**
 * Alter your post layouts
 *
 * Replace is_singular( 'post' ) by the function where you want to alter the layout
 * @return full-width, full-screen, left-sidebar or right-sidebar
 *
 */
function my_post_layout_class( $class ) {

	// Alter your layout
	if ( is_singular( 'tutorial' ) ) {
		$class = 'left-sidebar';
	}

	// Return correct class
	return $class;

}
add_filter( 'ocean_post_layout_class', 'my_post_layout_class', 20 );


// Disable page title on single posts
function disable_title( $return ) {
 
    if ( is_singular( 'tutorial') ) {
        $return = false;
    }
 
    // Return
    return $return;
    
}
add_filter( 'ocean_display_page_header', 'disable_title' );




add_action( 'widgets_init', 'theme_slug_widgets_init' );
function theme_slug_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Tutorial Sidebar', 'theme-slug' ),
        'id' => 'tutorial-sidebar',
        'description' => __( 'Widgets in this area will be shown on all tutorials.', 'theme-slug' ),
        'before_widget' => '<br>',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
}





function custum_sidebar_tutorial( $sidebar ) {
	// Return a different sidebar for custom post type 'gallery'
	if ( is_singular( 'tutorial' ) ) {
		return 'tutorial-sidebar';
	}
	// Return theme defined sidebar area
	else {
		return $sidebar;
	}
}
add_filter( 'ocean_get_sidebar', 'custum_sidebar_tutorial' );


// redirect author archive page to "About" page

add_filter( 'author_link', 'my_author_link' );
 
function my_author_link() {
	return home_url( 'about' );
}





?>