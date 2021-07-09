<?php
/**
 * Header section ACF Block
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
    <header <?php esc_attr_e($id); ?> class='header-section bg-cover<?php esc_attr_e($class); ?>'>
        <div class='header-section__container container'>
            <?php if ($back_link = get_field('back_link')) : ?>
                <a class='header-section__link' href='<?php echo $back_link; ?>'>
                    <?php display_svg(get_template_directory_uri() . '/assets/images/dropdown-arrow.svg'); ?>
                    <?php _e('Back', 'flexible'); ?>
                </a>
            <?php endif; ?>
            <h2 class='header-section__title h1'><?php echo $title; ?></h2>
            <?php if ($text = get_field('text')) : ?>
                <div class='header-section__text'><?php echo $text; ?></div>
            <?php endif; ?>
        </div>
    </header>
<?php endif; ?>
