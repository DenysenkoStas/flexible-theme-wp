<?php
/**
 * Video with text ACF Block
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

<?php if ($video = get_field('video')) : ?>
    <section <?php esc_attr_e($id); ?> class='video-with-text<?php esc_attr_e($class); ?>'>
        <div class='video-with-text__container container container--small t-center'>
            <?php if ($icon = get_field('icon')) {
                echo wp_get_attachment_image($icon, 'medium', false, ['class' => 'video-with-text__icon mx-auto']);
            } ?>
            <?php if ($text = get_field('text')) : ?>
                <div class='video-with-text__text h2'><?php echo $text; ?></div>
            <?php endif; ?>
            <video class='video-with-text__video' controls src='<?php echo $video; ?>'></video>
        </div>
    </section>
<?php endif; ?>
