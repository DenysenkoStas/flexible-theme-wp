<?php
/**
 * Template Name: Flexible
 */

get_header(); ?>

<main class="flexible-page">
    <?php if (have_rows('flexible')): ?>
        <?php while (have_rows('flexible')): the_row(); ?>
            <?php get_template_part('parts/flexible', get_row_layout()); // Flexible content row ?>
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
