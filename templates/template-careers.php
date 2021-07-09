<?php
/**
 * CPT: Careers. Single page
 */

get_header(); ?>

<main class="flexible-page">
    <div class="container">
        <?php if (have_rows('flexible')): ?>
            <?php while (have_rows('flexible')): the_row(); ?>
                <?php get_template_part('parts/flexible', get_row_layout()); // Flexible content row ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
