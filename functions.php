<?php
/**
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License as published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package    marsh
 * @subpackage Functions
 * @version    1.0.0
 * @author     Spigot Design <http://spigotdesign.com/>
 * @copyright  Copyright (c) 2015
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Get the template directory and make sure it has a trailing slash. */
$marsh_dir = trailingslashit( get_template_directory() );

/* Load the Hybrid Core framework and launch it. */
require_once( $marsh_dir . 'hybrid-core/hybrid.php' );
new Hybrid();

add_action( 'after_setup_theme', 'marsh_theme_setup', 5 );

/**
 * The theme setup function.  This function sets up support for various WordPress and framework functionality.
 *
 * @since  1.0
 * @access public
 * @return void
 */
function marsh_theme_setup() {

	// Load stylesheets
	add_action( 'wp_enqueue_scripts', 'marsh_styles' );

	// Layout Support
	add_theme_support( 'theme-layouts', array( 'default' => '1c' ) );
	add_action( 'hybrid_register_layouts', 'marsh_register_layouts' );

	// Hybrid Core functions and extensions
	add_theme_support( 'hybrid-core-template-hierarchy' );
	add_theme_support( 'get-the-image' );

	// WordPress theme support
	add_theme_support( 'automatic-feed-links' );
	//add_theme_support( 'post-formats', array( 'aside', 'audio', 'image', 'gallery', 'link', 'quote', 'status', 'video' ) );


	// Custom Header
	$args = array(
		'flex-width'    => true,
		'width'         => 1500,
		'height'        => 400,
		'uploads'       => true,
		// 'default-image' => get_template_directory_uri() . '/images/header.jpg',
	);
	add_theme_support( 'custom-header' );

	// Register custom image sizes.
	// add_action( 'init', 'marsh_register_image_sizes', 5 );

	// Editor styles.
	add_editor_style( marsh_get_editor_styles() );

	// Register custom menus.
	add_action( 'init', 'marsh_register_menus', 5 );

	// Register sidebars.
	add_action( 'widgets_init', 'marsh_register_sidebars', 5 );

	// Add custom styles and scripts.
	add_action( 'wp_enqueue_scripts', 'marsh_enqueue_scripts' );

	// Register admin styles and scripts.
	add_action( 'admin_enqueue_scripts', 'marsh_admin_register_styles', 0 );

	// Adds custom settings for the visual editor.
	add_filter( 'tiny_mce_before_init', 'marsh_tiny_mce_before_init' );

	// Modifies the theme layout.
	// add_filter( 'theme_mod_theme_layout', 'marsh_mod_theme_layout', 15 );


}

/**
 * Registers stylesheets for the frontend
 *
 */

function marsh_styles() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
}

// Jetpack galleries

if ( ! isset( $content_width ) )
    $content_width = 1200;


/**
 * Registers custom theme layouts
 *
 */

function marsh_register_layouts() {

    hybrid_register_layout(
        '1c',
        array(
            'label'            => _x( '1 Column', 'theme layout', 'marsh' ),
            'is_global_layout' => true,
            'is_post_layout'   => true,
            'image'            => '%s/img/layouts/1c.svg',
        )
    );

    hybrid_register_layout(
        '2c-l',
        array(
            'label'            => _x( '2 Columns: Sidebar / Content', 'theme layout', 'marsh' ),
            'is_global_layout' => true,
            'is_post_layout'   => true,
            'image'            => '%s/img/layouts/2c-l.svg',
        )
    );


}

/**
 * Registers nav menu locations.
 *
 */

function marsh_register_menus() {
	register_nav_menu( 'primary',   _x( 'Primary',   'nav menu location', 'marsh' ) );
	register_nav_menu( 'secondary', _x( 'Secondary', 'nav menu location', 'marsh' ) );
	register_nav_menu( 'social',    _x( 'Social',    'nav menu location', 'marsh' ) );
}

/**
 * Registers sidebars.
 *
 */

function marsh_register_sidebars() {

	hybrid_register_sidebar(
		array(
			'id'          => 'primary',
			'name'        => _x( 'Primary', 'sidebar', 'marsh' ),
			'description' => __( 'The main sidebar. It is displayed on either the left or right side of the page based on the chosen layout.', 'marsh' )
		)
	);

	hybrid_register_sidebar(
		array(
			'id'          => 'subsidiary',
			'name'        => _x( 'Subsidiary', 'sidebar', 'marsh' ),
			'description' => __( 'A sidebar located in the footer of the site. Optimized for one, two, or three widgets (and multiples thereof).', 'marsh' )
		)
	);
}

/**
 * ACF Add Options Page
 *
 * @since 1.0
 */

if(function_exists('acf_add_options_page')) { 

    acf_add_options_page(array(
        'page_title'    => 'Site Options',
        'menu_slug' 	=> 'site-options',
    ));

    acf_add_options_sub_page(array(
		'page_title' 	=> 'Header Images',
		'parent_slug'	=> 'site-options',
	));

}



/**
 * Enqueues scripts.
 *
 */

function marsh_enqueue_scripts() {

	// Header
	wp_enqueue_script( 'modernizr', trailingslashit( get_template_directory_uri() ) . 'js/build/modernizr-custom.min.js', array( 'jquery' ), null, false );
	// Footer
	// wp_enqueue_script( 'plugins', trailingslashit( get_template_directory_uri() ) . 'js/build/plugins.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'scripts', trailingslashit( get_template_directory_uri() ) . 'js/build/scripts.min.js', array( 'jquery' ), null, true );

	// Stylesheets
	wp_register_style( 'marsh-fonts', 'https://fonts.googleapis.com/css?family=Merriweather:400,700italic,300|Open+Sans:400,400italic' );

	


}

/**
 * Registers custom image sizes for the theme.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function marsh_register_image_sizes() {

	/* Sets the 'post-thumbnail' size. */
	// set_post_thumbnail_size( 175, 131, true );

	/* Adds the 'marsh-full' image size. */
	// add_image_size( 'marsh-full', 1025, 500, false );
}

/**
 * Registers stylesheets for use in the admin.
 *
 */
function marsh_admin_register_styles() {

	wp_register_style( 'custom_wp_admin_css', trailingslashit( get_template_directory_uri() ) . '/css/admin-style.css', false, '1.0.0' );

}

/**
 * Callback function for adding editor styles.  Use along with the add_editor_style() function.
 *
 */
function marsh_get_editor_styles() {

	/* Set up an array for the styles. */
	$editor_styles = array();

	/* Add the theme's editor styles. */
	$editor_styles[] = trailingslashit( get_template_directory_uri() ) . 'css/editor-style.css';

	/* If a child theme, add its editor styles. Note: WP checks whether the file exists before using it. */
	if ( is_child_theme() && file_exists( trailingslashit( get_stylesheet_directory() ) . 'css/editor-style.css' ) )
		$editor_styles[] = trailingslashit( get_stylesheet_directory_uri() ) . 'css/editor-style.css';

	/* Add the locale stylesheet. */
	$editor_styles[] = get_locale_stylesheet_uri();

	/* Uses Ajax to display custom theme styles added via the Theme Mods API. */
	$editor_styles[] = add_query_arg( 'action', 'marsh_editor_styles', admin_url( 'admin-ajax.php' ) );

	/* Return the styles. */
	return $editor_styles;
}

/**
 * Adds the <body> class to the visual editor.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $settings
 * @return array
 */
function marsh_tiny_mce_before_init( $settings ) {

	$settings['body_class'] = join( ' ', array_merge( get_body_class(), get_post_class() ) );

	return $settings;
}


/**
 * Removes post_type support from post types.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $layout
 * @return string
 */

function marsh_remove_post_type_support() {

	// remove_post_type_support( 'my-cpt-name', 'theme-layouts' );

}


/**
 * Modifies the theme layout
 *
 * @since  1.0
 * @access public
 * @param  string  $layout
 * @return string
 */
function marsh_mod_theme_layout( $layout ) {

	if ( is_home() || is_singular('post') || is_404() ) {

        $layout = '2c-l';

    } elseif ( is_archive() && !is_archive('portfolio') ) {

        $layout = '2c-l';

    }

	return $layout;
}
