<?php
/**
 * Hero section ACF Block
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

<?php if (($title = get_field('title')) && ($desc = get_field('desc'))) : ?>
    <section <?php esc_attr_e($id); ?> class='hero-section box-padding bg-cover<?php esc_attr_e($class); ?>'>
        <div class='hero-section__bg-img' <?php bg(get_field('bg_img')); ?>></div>

        <div class='hero-section__inner my-auto'>
            <div class='hero-section__container container'>
                <div class='hero-section__col'>
                    <h1 class='hero-section__title'><?php echo $title; ?></h1>
                    <div class='hero-section__desc'><?php echo $desc; ?></div>
                    <?php if ($first_link = get_field('first_link') || $second_link = get_field('second_link')): ?>
                        <div class='hero-section__link-group'>
                            <?php if ($first_link = get_field('first_link')) : ?>
                                <a class='btn' href='<?php echo $first_link['url']; ?>'
                                   target='<?php echo $first_link['target']; ?>'>
                                    <?php echo $first_link['title']; ?>
                                </a>
                            <?php endif; ?>
                            <?php if ($second_link = get_field('second_link')) : ?>
                                <a class='btn btn--outline' href='<?php echo $second_link['url']; ?>'
                                   target='<?php echo $second_link['target']; ?>'>
                                    <?php echo $second_link['title']; ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($subtext = get_field('subtext')) : ?>
                        <div class='hero-section__subtext'><?php echo $subtext; ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
