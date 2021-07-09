<?php
/**
 * Header
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Set up Meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta charset="<?php bloginfo('charset'); ?>">

    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <!-- Remove Microsoft Edge's & Safari phone-email styling -->
    <meta name="format-detection" content="telephone=no,email=no,url=no">

    <?php wp_head(); ?>
</head>

<body <?php body_class(''); ?>>
<?php wp_body_open(); ?>

<div class="preloader">
    <div class="preloader__icon"></div>
</div>

<header class="header bg-cover">
    <div class="container header__container">
        <?php show_custom_logo('header__logo'); ?>

        <button class='burger-btn' aria-label='Mobile menu button' data-type='mob-btn'>
            <span class='burger-btn__line'></span>
        </button>

        <?php if (has_nav_menu('header-menu')) : ?>
            <?php wp_nav_menu(array(
                'theme_location' => 'header-menu',
                'container' => 'nav',
                'container_class' => 'header__nav',
                'menu_class' => 'header-menu',
                'add_li_class' => 'header-menu__item',
                'add_a_class' => 'header-menu__link',
            )); ?>
        <?php endif; ?>
    </div>
</header>

<div class="header__substrate"></div>
