<?php
/**
 * Functions
 */

/******************* Included Functions *********************/
// Helper functions
require_once get_stylesheet_directory() . '/inc/helpers.php';
// Extend WP Search with Custom fields
include_once get_stylesheet_directory() . '/inc/custom-fields-search.php';
// Global functions
include_once get_stylesheet_directory() . '/inc/global.php';
// Additional Functions
include_once get_stylesheet_directory() . '/inc/additional.php';
// GravityForms Functions
include_once get_stylesheet_directory() . '/inc/gravity-forms.php';
// ACF Functions
include_once get_stylesheet_directory() . '/inc/acf.php';
// TinyMCE Functions
include_once get_stylesheet_directory() . '/inc/tiny-mce.php';
// SVG Support
include_once get_stylesheet_directory() . '/inc/svg-support.php';

// Constants
define('IMAGE_PLACEHOLDER', get_stylesheet_directory_uri() . '/images/placeholder.jpg');

/******************* Enqueue Scripts and Styles for Front-End *********************/
function theme_scripts_and_styles() {
    if (!is_admin()) {
        // Disable gutenberg built-in styles
//                wp_dequeue_style('wp-block-library');

        // Styles
        wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/main.css', null, null); // 2rd priority
        wp_enqueue_style('style', get_template_directory_uri() . '/style.css', null, null); // 1st priority

        // JavaScripts
        wp_enqueue_script('jquery');
        wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', null, null, true); // This should go first
    }
}

add_action('wp_enqueue_scripts', 'theme_scripts_and_styles');

// Disable gutenberg
//add_filter('use_block_editor_for_post_type', '__return_false');
