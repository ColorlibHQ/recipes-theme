<?php
/**
 * @Packge       : Colorlib
 * @Version      : 1.0
 * @Author       : Colorlib
 * @Author       URI : http://colorlib.com/wp/
 *
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}


/**
 *
 * Define constant
 *
 */

// Base URI
if ( ! defined( 'RECIPES_DIR_URI' ) ) {
	define( 'RECIPES_DIR_URI', get_template_directory_uri() . '/' );
}

// assets URI
if ( ! defined( 'RECIPES_DIR_ASSETS_URI' ) ) {
	define( 'RECIPES_DIR_ASSETS_URI', RECIPES_DIR_URI . 'assets/' );
}

// Css File URI
if ( ! defined( 'RECIPES_DIR_CSS_URI' ) ) {
	define( 'RECIPES_DIR_CSS_URI', RECIPES_DIR_ASSETS_URI . 'css/' );
}

// Js File URI
if ( ! defined( 'RECIPES_DIR_JS_URI' ) ) {
	define( 'RECIPES_DIR_JS_URI', RECIPES_DIR_ASSETS_URI . 'js/' );
}

// Images URI
if ( ! defined( 'RECIPES_DIR_IMGS_URI' ) ) {
	define( 'RECIPES_DIR_IMGS_URI', RECIPES_DIR_ASSETS_URI . 'img/' );
}

// Icon Images
if ( ! defined( 'RECIPES_DIR_ICON_IMG_URI' ) ) {
	define( 'RECIPES_DIR_ICON_IMG_URI', RECIPES_DIR_ASSETS_URI . 'img/icon/' );
}

// Base Directory
if ( ! defined( 'RECIPES_DIR_PATH' ) ) {
	define( 'RECIPES_DIR_PATH', get_parent_theme_file_path() . '/' );
}

//Inc Folder Directory
if ( ! defined( 'RECIPES_DIR_PATH_INC' ) ) {
	define( 'RECIPES_DIR_PATH_INC', RECIPES_DIR_PATH . 'inc/' );
}

//Recipes Libraries Folder Directory
if ( ! defined( 'RECIPES_DIR_PATH_LIBS' ) ) {
	define( 'RECIPES_DIR_PATH_LIBS', RECIPES_DIR_PATH_INC . 'libraries/' );
}

//Classes Folder Directory
if ( ! defined( 'RECIPES_DIR_PATH_CLASSES' ) ) {
	define( 'RECIPES_DIR_PATH_CLASSES', RECIPES_DIR_PATH_INC . 'classes/' );
}

//Hooks Folder Directory
if ( ! defined( 'RECIPES_DIR_PATH_HOOKS' ) ) {
	define( 'RECIPES_DIR_PATH_HOOKS', RECIPES_DIR_PATH_INC . 'hooks/' );
}

// Admin Enqueue script
function recipes_admin_script(){
    wp_enqueue_style( 'recipes-admin', get_template_directory_uri().'/assets/css/recipes-admin.css', false, '1.0.0' );
    wp_enqueue_script( 'recipes_admin', get_template_directory_uri().'/assets/js/recipes-admin.js', false, '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'recipes_admin_script' );



/**
 * Include File
 *
 */
require_once( RECIPES_DIR_PATH_INC . 'recipes-breadcrumbs.php' );
require_once( RECIPES_DIR_PATH_INC . 'recipes-widgets-reg.php' );
require_once( RECIPES_DIR_PATH_INC . 'wp_bootstrap_navwalker.php' );
require_once( RECIPES_DIR_PATH_INC . 'post-like.php' );
require_once( RECIPES_DIR_PATH_INC . 'recipes-functions.php' );
require_once( RECIPES_DIR_PATH_INC . 'recipes-commoncss.php' );
require_once( RECIPES_DIR_PATH_INC . 'support-functions.php' );
require_once( RECIPES_DIR_PATH_INC . 'wp-html-helper.php' );
require_once( RECIPES_DIR_PATH_INC . 'wp_bootstrap_pagination.php' );
require_once( RECIPES_DIR_PATH_INC . 'customizer/customizer.php' );
require_once( RECIPES_DIR_PATH_CLASSES . 'Class-Enqueue.php' );
require_once( RECIPES_DIR_PATH_CLASSES . 'Class-Config.php' );
require_once( RECIPES_DIR_PATH_HOOKS . 'hooks.php' );
require_once( RECIPES_DIR_PATH_HOOKS . 'hooks-functions.php' );
require_once( RECIPES_DIR_PATH_INC . 'class-epsilon-dashboard-autoloader.php' );
require_once( RECIPES_DIR_PATH_INC . 'class-epsilon-init-dashboard.php' );



/**
 * Instantiate Recipes object
 *
 * Inside this object:
 * Enqueue scripts, Google font, Theme support features, Epsilon Dashboard .
 *
 */

$Recipes = new Recipes();