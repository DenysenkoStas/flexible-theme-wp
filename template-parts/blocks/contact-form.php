<?php
/**
 * Contact form ACF Block
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

<?php if ($form = get_field('form')) : ?>
    <section <?php esc_attr_e($id); ?> class='contact-form box-padding<?php esc_attr_e($class); ?>'>
        <div class='contact-form__container container'>
            <div class='contact-form__col'>
                <?php if ($title = get_field('title')) : ?>
                    <h2 class='contact-form__title h1'><?php echo $title; ?></h2>
                <?php endif; ?>
                <?php if ($text = get_field('text')) : ?>
                    <div class='contact-form__text'>
                        <?php echo $text; ?>
                    </div>
                <?php endif; ?>
                <?php if ($email = get_field('email')) : ?>
                    <a class='contact-form__link' href='mailto:<?php echo $email; ?>'><?php echo $email; ?></a>
                <?php endif; ?>
                <?php if ($tel = get_field('tel')) : ?>
                    <a class='contact-form__link' href='tel:<?php echo sanitize_number($tel); ?>'>
                        <?php echo $tel; ?>
                    </a>
                <?php endif; ?>
                <?php if ($address = get_field('address')) : ?>
                    <address class='contact-form__address'><?php echo $address; ?></address>
                <?php endif; ?>

                <?php if (have_rows('socials')): ?>
                    <ul class='socials'>
                        <?php while (have_rows('socials')): the_row();
                            $icon = get_sub_field('icon');
                            $link = get_sub_field('link');
                            ?>
                            <li class='socials__item'>
                                <a class='socials__link' href='<?php echo $link; ?>' target='_blank'>
                                    <?php display_svg($icon, 'socials__icon'); ?>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class='contact-form__col'>
                <?php echo do_shortcode('[gravityform id="' . $form[id] . '" title="false" description="false" ajax="true"]'); ?>
            </div>
        </div>
    </section>
<?php endif; ?>
