<?php
/**
 * Container ACF Block
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param int|string $post_id The post ID this block is saved to.
 */

// Add HTML anchor
$id = !empty($block['anchor']) ? 'id=' . $block['anchor'] : '';

// Load custom field values
$small_container = get_field('small_container');

// Change class and define notification message shown when editing
if ($small_container) {
    $class = ' container--small';
    $notification = __('Container width: small', 'flexible');
} else {
    $class = '';
    $notification = __('Container width: wide', 'flexible');
}

// Add additional CSS classes
$class .= !empty($block['className']) ? ' ' . $block['className'] : '';
?>

<div <?php esc_attr_e($id); ?> class='container-block container<?php esc_attr_e($class); ?>'>
    <?php if ($is_preview) : // for back-end only) ?>
        <style>
          .container {
            padding: 16px 20px;
            border: 1px solid #adb2ad;
          }

          .container--small {
            margin: auto;
            width: 80%;
          }

          .container-block-notification {
            color: #0d99d5;
          }
        </style>
        <b class='container-block-notification'><?php echo $notification; ?></b>
    <?php endif; ?>
    <InnerBlocks/>
</div>
