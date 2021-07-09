<?php
/**
 * Text fields ACF Block
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

<?php if (($title = get_field('title')) && ($text = get_field('text'))) : ?>
    <div <?php esc_attr_e($id); ?> class='text-fields box-padding<?php esc_attr_e($class); ?>'>
        <div class='text-fields__container container container--small t-center'>
            <h2 class='text-fields__title h1 mx-auto'><?php echo $title; ?></h2>
            <?php if ($subtext = get_field('subtext')) : ?>
                <span class='text-fields__subtext'><?php echo $subtext; ?></span>
            <?php endif; ?>
            <div class='text-fields__text'><?php echo $text; ?></div>
        </div>
    </div>
<?php endif; ?>
