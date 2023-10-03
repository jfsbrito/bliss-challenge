<?php
/**
 * Bliss Challenge functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bliss_Challenge
 */

if (!defined('BC_VERSION')) {
    define('BC_VERSION', '1.0.1');
}

if (!function_exists('bc_setup')) :

    function bc_setup() {

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array('menu-1' => __('Primary', 'bliss-challenge'), 'menu-2' => __('Footer Menu', 'bliss-challenge'), ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array('search-form', 'gallery', 'caption', 'style', 'script', ));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add support for editor styles.
        add_theme_support('editor-styles');
        
        //
        add_theme_support( 'wp-block-styles' );
        
        //
        add_theme_support( 'align-wide' );
        

        // Enqueue editor styles.
        add_editor_style('style-editor.css');

        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');

    }

    /**
     * Enqueue back-office scripts and styles.
     */
    function bc_bo_scripts() {
        wp_enqueue_style('bliss-challenge-style-admin', get_template_directory_uri() . '/framework/admin/assets/css/bc-main.css', BC_VERSION);
        wp_enqueue_script('bliss-challenge-script-admin', get_template_directory_uri() . '/framework/admin/assets/js/bc-main.js', array(), BC_VERSION, true);

    }

    add_action('admin_enqueue_scripts', 'bc_bo_scripts');

    /**
     * Enqueue front-office scripts and styles.
     */
    function bc_fo_scripts() {
        wp_enqueue_style('bliss-challenge-style', get_stylesheet_uri(), array(), BC_VERSION);
        wp_enqueue_script('bliss-challenge-script', get_template_directory_uri() . '/assets/js/main.js', array(), BC_VERSION, true);

    }

    add_action('wp_enqueue_scripts', 'bc_fo_scripts');

    /*
     * Require Template Framework
     */
    require_once 'framework/main.php';
    
    



endif;
add_action('after_setup_theme', 'bc_setup');
