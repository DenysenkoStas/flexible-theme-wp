<?php
/**
 * Image with text ACF Block
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

<?php if (($img = get_field('img')) && ($text = get_field('text'))) : ?>
    <article <?php esc_attr_e($id); ?>
        class='img-with-text container container--small box-margin<?php esc_attr_e($class); ?>'>
        <div
            class='img-with-text__col<?php echo get_field('img_pos') ? ' img-with-text__col--right' : ' img-with-text__col--left'; ?>'>
            <?php echo wp_get_attachment_image($img, 'large', false, ['class' => 'img-with-text__img']); ?>
        </div>

        <div class='img-with-text__col'>
            <?php if ($title = get_field('title')) : ?>
                <h3 class='img-with-text__title h2'><?php echo $title; ?></h3>
            <?php endif; ?>
            <div class='img-with-text__text'><?php echo $text; ?></div>
        </div>
    </article>
<?php endif; ?>
