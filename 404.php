<?php
/**
 * The template for displaying 404 pages (Not Found)
 */

get_header(); ?>

<div class="not-found main-content container">
    <h1><?php _e('404: Page Not Found', 'flexible'); ?></h1>
    <h3><?php _e('Keep on looking...', 'flexible'); ?></h3>
    <p><?php printf(__('Double check the URL or head back to the <a class="label" href="%1s">HOMEPAGE</a>', 'flexible'), get_bloginfo('url')); ?></p>
</div>

<?php get_footer(); ?>
