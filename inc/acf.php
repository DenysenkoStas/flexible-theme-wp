<?php
/**
 * ACF Functions
 */

// Prevent Fatal error on site if ACF not installed/activated
add_action('wp', 'include_acf_placeholder', PHP_INT_MAX);
function include_acf_placeholder() {
    include_once get_stylesheet_directory() . '/inc/acf-placeholder.php';
}

// ACF Pro Options Page
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => __('Theme General Settings', 'flexible'),
        'menu_title' => __('Theme Settings', 'flexible'),
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
}

add_action('acf/load_field/name=copyright', 'populate_copyright_instructions');
/**
 * Copyright field functionality
 * @param array $field ACF Field settings
 * @return array
 */
function populate_copyright_instructions($field) {
    $field['instructions'] = 'Input <code>@year</code> to replace static year with dynamic, so it will always shows current year.';

    return $field;
}

if (!is_admin()) {
    // Replace @year with current year
    add_filter('acf/load_value/name=copyright', function ($value) {
        return str_replace('@year', date('Y'), $value);
    });
}

// Create custom block category
add_filter('block_categories', 'custom_block_category', 10, 2);
function custom_block_category($default_categories, $post) {
    if ($post->post_type === '') {
        return $default_categories;
    }

    return array_merge(
        [
            [
                'slug' => 'acf',
                'title' => __('ACF', 'flexible'),
                'icon' => 'superhero'
            ],
        ],
        $default_categories
    );
}

// Register ACF blocks
add_action('acf/init', 'acf_init_block_types');
function acf_init_block_types() {

    // Check function exists
    if (function_exists('acf_register_block_type')) {
        // Register a block
        acf_register_block_type(array(
            'name' => 'hero-section',
            'title' => __('Hero section', 'flexible'),
            'description' => __('Custom hero section.', 'flexible'),
            'category' => 'acf',
            'icon' => 'money',
            'keywords' => array('main', 'section', 'acf'),
            'mode' => 'edit',
            'render_template' => 'template-parts/blocks/hero-section.php',
            'supports' => array('align' => false, 'anchor' => true),
        ));
        acf_register_block_type(array(
            'name' => 'video-with-text',
            'title' => __('Video with text', 'flexible'),
            'description' => __('Custom video section with text & icon.', 'flexible'),
            'category' => 'acf',
            'icon' => 'video-alt3',
            'keywords' => array('video', 'text', 'acf'),
            'mode' => 'edit',
            'render_template' => 'template-parts/blocks/video-with-text.php',
            'supports' => array('align' => false, 'anchor' => true),
        ));
        acf_register_block_type(array(
            'name' => 'variable-columns',
            'title' => __('Variable columns', 'flexible'),
            'description' => __('Two custom columns with title, text & posts.', 'flexible'),
            'category' => 'acf',
            'icon' => 'editor-table',
            'keywords' => array('columns', 'variable', 'acf', 'posts'),
            'mode' => 'edit',
            'render_template' => 'template-parts/blocks/variable-columns.php',
            'supports' => array('align' => false, 'anchor' => true),
        ));
        acf_register_block_type(array(
            'name' => 'text-fields',
            'title' => __('Text fields', 'flexible'),
            'description' => __('Title, small subtext & textarea.', 'flexible'),
            'category' => 'acf',
            'icon' => 'text-page',
            'keywords' => array('text', 'fields', 'acf', 'title'),
            'mode' => 'edit',
            'render_template' => 'template-parts/blocks/text-fields.php',
            'supports' => array('align' => false, 'anchor' => true),
        ));
        acf_register_block_type(array(
            'name' => 'img-with-text',
            'title' => __('Image with text', 'flexible'),
            'description' => __('Variable align image with text.', 'flexible'),
            'category' => 'acf',
            'icon' => 'cover-image',
            'keywords' => array('image', 'text', 'acf', 'variable', 'align'),
            'mode' => 'edit',
            'render_template' => 'template-parts/blocks/img-with-text.php',
            'supports' => array('align' => false, 'anchor' => true),
        ));
        acf_register_block_type(array(
            'name' => 'contact-form',
            'title' => __('Contact form', 'flexible'),
            'description' => __('Gravity form & info column (title, textarea, email, address & socials).', 'flexible'),
            'category' => 'acf',
            'icon' => 'email-alt',
            'keywords' => array('form', 'contact', 'acf', 'column'),
            'mode' => 'edit',
            'render_template' => 'template-parts/blocks/contact-form.php',
            'supports' => array('align' => false, 'anchor' => true),
        ));
        acf_register_block_type(array(
            'name' => 'header-section',
            'title' => __('Header section', 'flexible'),
            'description' => __('Header section with back link.', 'flexible'),
            'category' => 'acf',
            'icon' => 'editor-kitchensink',
            'keywords' => array('header', 'title', 'acf', 'section'),
            'mode' => 'edit',
            'render_template' => 'template-parts/blocks/header-section.php',
            'supports' => array('align' => false, 'anchor' => true),
        ));
        acf_register_block_type(array(
            'name' => 'container',
            'title' => __('Container', 'flexible'),
            'description' => __('Container with wide & small width.', 'flexible'),
            'category' => 'acf',
            'icon' => 'align-wide',
            'keywords' => array('container', 'acf'),
            'mode' => 'preview',
            'render_template' => 'template-parts/blocks/container.php',
            'supports' => array(
                'align' => false,
                'anchor' => true,
                'mode' => false,
                'jsx' => true
            ),
        ));
    }
}
