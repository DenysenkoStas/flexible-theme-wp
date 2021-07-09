<?php
/**
 * Category. Standard loop for the category page
 */

get_header(); ?>

<main class="category-page main-content">
    <div class="container">
        <div class='category-page__content'>
            <h2 class="page-title"><?php echo get_the_archive_title(); ?></h2>

            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('parts/loop', 'post'); // Post item ?>
                <?php endwhile; ?>
            <?php endif; ?>

            <?php custom_pagination(); ?>
        </div>

        <aside class="sidebar">
            <?php get_sidebar('right'); ?>
        </aside>
    </div>
</main>

<?php get_footer(); ?>
