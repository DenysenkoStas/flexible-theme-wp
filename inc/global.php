<?php
/**
 * Global Functions
 */

// WP 5.2 wp_body_open backward compatibility
if (!function_exists('wp_body_open')) {
    function wp_body_open() {
        do_action('wp_body_open');
    }
}

// Make theme available for translation. Translations can be filed in the /languages/ directory.
load_theme_textdomain( 'flexible' );

// Add support for full and wide align images.
add_theme_support( 'align-wide' );

// Add support for responsive embeds.
add_theme_support( 'responsive-embeds' );

/* By adding theme support, we declare that this theme does not use a hard-coded <title> tag in the document head,
and expect WordPress to provide it for us. */
add_theme_support('title-tag');

// Add widget support shortcodes
add_filter('widget_text', 'do_shortcode');

// Support for Featured Images
add_theme_support('post-thumbnails');

// Custom Background
add_theme_support('custom-background', array('default-color' => 'fff'));

// Custom Header
add_theme_support('custom-header', array(
    'default-image' => get_template_directory_uri() . '/assets/images/custom-logo.png',
    'height' => '200',
    'flex-height' => true,
    'uploads' => true,
    'header-text' => false
));

// Custom Logo
add_theme_support('custom-logo', array(
    'height' => '150',
    'flex-height' => true,
    'flex-width' => true,
));

function show_custom_logo($link_class = 'custom-logo', $class = 'custom-logo__img', $size = 'medium') {
    if ($custom_logo_id = get_theme_mod('custom_logo')) {
        $attachment_array = wp_get_attachment_image_src($custom_logo_id, $size);
        $logo_url = $attachment_array[0];
    } else {
        $logo_url = get_stylesheet_directory_uri() . '/assets/images/custom-logo.png';
    }
    $logo_image = '<img src="' . $logo_url . '" class="' . $class . '" itemprop="siteLogo" alt="' . get_bloginfo('name') . '">';
    $html = sprintf('<a href="%1$s" class="' . $link_class . '" rel="home" title="%2$s" itemscope>%3$s</a>', esc_url(home_url('/')), get_bloginfo('name'), $logo_image);
    echo apply_filters('get_custom_logo', $html);
}

// Add HTML5 elements
add_theme_support('html5', array(
    'comment-list',
    'search-form',
    'comment-form',
    'gallery',
    'caption',
    'script',
    'style'
));

// Add RSS Links generation
add_theme_support('automatic-feed-links');

// Hide comments feed link
add_filter('feed_links_show_comments_feed', '__return_false');

// Add excerpt to pages
add_post_type_support('page', 'excerpt');

// Register Navigation Menu
register_nav_menus(array(
    'header-menu' => 'Header Menu',
    'footer-menu' => 'Footer Menu'
));

// Add class for li to Navigation Menu
function add_nav_li_class($classes, $item, $args) {
    if (isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}

add_filter('nav_menu_css_class', 'add_nav_li_class', 1, 3);

// Add class for link to Navigation Menu
function add_nav_a_class($classes, $item, $args) {
    if (isset($args->add_a_class)) {
        $classes['class'] = $args->add_a_class;
    }
    return $classes;
}

add_filter('nav_menu_link_attributes', 'add_nav_a_class', 1, 3);

// Create pagination
function custom_pagination($query = '') {
    if (empty($query)) {
        global $wp_query;
        $query = $wp_query;
    }

    $big = 999999999;

    $links = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'prev_next' => true,
        'prev_text' => '&laquo;',
        'next_text' => '&raquo;',
        'current' => max(1, get_query_var('paged')),
        'total' => $query->max_num_pages,
        'type' => 'list'
    ));

    $pagination = str_replace('page-numbers', 'pagination', $links);

    echo $pagination;
}

// Register Sidebars
function custom_widgets_init() {
    /* Sidebar Right */
    register_sidebar(array(
        'id' => 'sidebar-right',
        'name' => __('Sidebar Right'),
        'description' => __('This sidebar is located on the right-hand side of each page.'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h5 class="widget__title">',
        'after_title' => '</h5>',
    ));

}

add_action('widgets_init', 'custom_widgets_init');

// Remove #more anchor from posts
function remove_more_jump_link($link) {
    $offset = strpos($link, '#more-');
    if ($offset) {
        $end = strpos($link, '"', $offset);
    }
    if ($end) {
        $link = substr_replace($link, '', $offset, $end - $offset);
    }

    return $link;
}

add_filter('the_content_more_link', 'remove_more_jump_link');

// Remove more tag <span> anchor
function remove_more_anchor($content) {
    return str_replace('<p><span id="more-' . get_the_ID() . '"></span></p>', '', $content);
}

add_filter('the_content', 'remove_more_anchor');
