<?php
/**
 * Template Name: With sidebar right
 */

get_header(); ?>

<main class="s-right-page main-content">
    <div class="container">
        <div class="s-right-page__content">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article <?php post_class('entry'); ?>>
                        <h1 class="page-title entry__title"><?php the_title(); ?></h1>
                        <?php if (has_post_thumbnail()) : ?>
                            <div title="<?php the_title_attribute(); ?>" class="entry__thumb">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="entry__content">
                            <?php the_content('', true); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>

        <aside class="sidebar">
            <?php get_sidebar('right'); ?>
        </aside>
    </div>
</main>

<?php get_footer(); ?>
