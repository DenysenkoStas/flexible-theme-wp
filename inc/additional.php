<?php
/**
 * Additional Functions
 */

// Specify image sizes that need to be optimized
function specify_sizes_to_optimize($sizes) {
    if (empty($sizes) || $sizes == 'thumbnail,medium') {
        $sizes = 'thumbnail, medium, medium_large, large, large_high, full_hd, 1536x1536, 2048x2048';
    }

    return $sizes;
}

add_filter('wbcr/factory/populate_option_allowed_sizes_thumbnail', 'specify_sizes_to_optimize');

// Enable revisions for all custom post types
add_filter('cptui_user_supports_params', function () {
    return array('revisions');
});

// Limit number of revisions for all post types
function limit_revisions_number() {
    return 10;
}

add_filter('wp_revisions_to_keep', 'limit_revisions_number');

// Add ability ro reply to comments
add_filter('wpseo_remove_reply_to_com', '__return_false');

// Remove author archive pages
function remove_author_archive_page() {
    global $wp_query;

    if (is_author()) {
        $wp_query->set_404();
        status_header(404);
        // Redirect to homepage
        // wp_redirect(get_option('home'));
    }
}

add_action('template_redirect', 'remove_author_archive_page');

// Remove comments feed links
add_filter('post_comments_feed_link', '__return_null');

// Stick Admin Bar To The Top
if (!is_admin()) {
    add_action('get_header', 'remove_topbar_bump');

    function remove_topbar_bump() {
        remove_action('wp_head', '_admin_bar_bump_cb');
    }

    function stick_admin_bar() {
        echo "
			<style>
				body.admin-bar {margin-top:32px !important}
				@media screen and (max-width: 782px) {
					body.admin-bar { margin-top:46px !important }
				}
			</style>
			";
    }

    add_action('admin_head', 'stick_admin_bar');
    add_action('wp_head', 'stick_admin_bar');
}

// Customize Login Screen
function wordpress_login_styling() {
    if ($custom_logo_id = get_theme_mod('custom_logo')) {
        $custom_logo_img = wp_get_attachment_image_src($custom_logo_id, 'medium');
        $custom_logo_src = $custom_logo_img[0];
    } else {
        $custom_logo_src = 'wp-admin/images/wordpress-logo.svg?ver=20131107';
    }
    ?>
    <style type="text/css">
      .login #login h1 a {
        background-image: url('<?php echo $custom_logo_src; ?>');
        background-size: contain;
        background-position: 50% 50%;
        width: auto;
        height: 120px;
      }

      body.login {
        background-color: #f1f1f1;
      <?php if ($bg_image = get_background_image()) {?> background-image: url('<?php echo $bg_image; ?>') !important;
      <?php } ?> background-repeat: repeat;
        background-position: center center;
      }
    </style>
<?php }

add_action('login_enqueue_scripts', 'wordpress_login_styling');

function admin_logo_custom_url() {
    $site_url = get_bloginfo('url');

    return ($site_url);
}

add_filter('login_headerurl', 'admin_logo_custom_url');

// Wrap any iframe and embed tag into div for responsive view
function iframe_wrapper($content) {
    // match any iframes
    $pattern = '~<iframe.*?<\/iframe>|<embed.*?<\/embed>~';
    preg_match_all($pattern, $content, $matches);

    foreach ($matches[0] as $match) {
        // Check if it is a video player iframe
        if (strpos($match, 'youtu') || strpos($match, 'vimeo')) {
            // wrap matched iframe with div
            $wrappedframe = '<div class="responsive-embed widescreen">' . $match . '</div>';
            //replace original iframe with new in content
            $content = str_replace($match, $wrappedframe, $content);
        }
    }

    return $content;
}

add_filter('the_content', 'iframe_wrapper');
add_filter('acf_the_content', 'iframe_wrapper');

// Custom outline color
add_action('wp_head', 'custom_outline_color');

function custom_outline_color() {
    $outline_color = get_theme_mod('outline_color');
    if ($outline_color) {
        echo "<style>a,input,button,textarea,select{outline-color: {$outline_color}}</style>";
    }
}

/******************* PUT YOU FUNCTIONS BELOW *********************/
add_image_size('full_hd', 1920, 0, array('center', 'center'));
add_image_size('large_high', 1024, 0, false);
// add_image_size( 'name', width, height, array('center','center'));

/**
 * Replace Wordpress email Sender name
 * @return string
 */
function replace_email_sender_name() {
    return get_bloginfo();
}

add_filter('wp_mail_from_name', 'replace_email_sender_name');

// Add WooCommerce support
function theme_add_woocommerce_support() {
    add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'theme_add_woocommerce_support');

// Register new post type
add_action('init', 'register_post_types');
function register_post_types() {
    register_post_type('career', [
        'labels' => [
            'name' => 'Careers',
            'singular_name' => 'Career',
            'view_item' => 'View Career',
            'search_items' => 'Search Careers',
            'not_found' => 'No careers found.',
            'not_found_in_trash' => 'No careers found in Trash.',
        ],
        'public' => true,
        'menu_icon' => 'dashicons-id-alt',
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'rewrite' => ['slug' => 'careers']
    ]);
}
