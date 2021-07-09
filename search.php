<?php
/**
 * Index. Standard loop for the search result page
 */

get_header(); ?>

<main class="search-page main-content">
    <h1 class="page-title"><?php printf(__('Search Results for: %s', 'flexible'), '<span>' . esc_html(get_search_query()) . '</span>'); ?></h1>
    <?php get_search_form(); ?>
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('parts/loop', 'post'); // Post item ?>
        <?php endwhile; ?>
    <?php else: ?>
        <p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'flexible'); ?></p>
    <?php endif; ?>

    <?php custom_pagination(); ?>
</main>

<?php get_footer(); ?>
