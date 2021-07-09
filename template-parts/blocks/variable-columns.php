<?php
/**
 * Variable columns ACF Block
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param int|string $post_id The post ID this block is saved to.
 */

// Build the block id and class
$id = !empty($block['anchor']) ? 'id=' . $block['anchor'] : '';
$class = !empty($block['className']) ? ' ' . $block['className'] : '';
?>

<?php if ($title = get_field('title')) : ?>
    <section <?php esc_attr_e($id); ?> class='variable-columns box-padding<?php esc_attr_e($class); ?>'>
        <div class='variable-columns__container container'>
            <div class='variable-columns__col'>
                <h2 class='variable-columns__title h1'><?php echo $title; ?></h2>
                <?php if ($desc = get_field('desc')) : ?>
                    <p class='variable-columns__desc'><?php echo $desc; ?></p>
                <?php endif; ?>
            </div>

            <div class='variable-columns__col'>
                <?php if ($text = get_field('text')) : ?>
                    <div class='variable-columns__text'>
                        <?php echo $text; ?>
                    </div>
                <?php endif; ?>
                <?php if ($posts = get_field('posts')) :
                    foreach ($posts as $post) : ?>
                        <a class='variable-columns__post' href='<?php echo get_the_permalink($post->ID); ?>'>
                            <span class='variable-columns__post-title'><?php echo get_the_title($post->ID); ?></span>
                            <?php display_svg(get_template_directory_uri() . '/assets/images/arrow.svg'); ?>
                        </a>
                    <?php endforeach;
                endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
