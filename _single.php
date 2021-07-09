<?php
/**
 * Single. Loop container for single post content
 */

get_header(); ?>

<main class="single-page main-content">
    <div class="container">
        <div class="single-page__content">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
                        <h1 class="page-title entry__title"><?php the_title(); ?></h1>
                        <?php if (has_post_thumbnail()) : ?>
                            <div title="<?php the_title_attribute(); ?>" class="entry__thumb">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>
                        <p class="entry__meta"><?php echo sprintf(__('Written by %s on %s', 'flexible'), get_the_author_posts_link(), get_the_time(get_option('date_format'))); ?></p>
                        <div class="entry__content">
                            <?php the_content('', true); ?>
                        </div>
                        <h6 class="entry__cat"><?php _e('Posted Under: ', 'flexible'); ?><?php the_category(', '); ?></h6>
                        <?php comments_template(); ?>
                    </article>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>

        <div class="sidebar">
            <?php get_sidebar('right'); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
