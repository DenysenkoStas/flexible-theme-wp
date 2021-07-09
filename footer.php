<?php
/**
 * Footer
 */
?>

<footer class="footer">
    <div class="footer__container container">
        <?php if ($copyright = get_field('copyright', 'options')): ?>
            <span class="footer__copyright"><?php echo $copyright; ?></span>
        <?php endif; ?>

        <?php if (has_nav_menu('footer-menu')) : ?>
            <?php wp_nav_menu(array(
                'theme_location' => 'footer-menu',
                'container' => 'nav',
                'container_class' => 'footer__nav',
                'menu_class' => 'footer-menu',
                'depth' => 1,
                'add_li_class' => 'footer-menu__item',
                'add_a_class' => 'footer-menu__link',
            )); ?>
        <?php endif; ?>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
