<!DOCTYPE html>
<html lang="<?php echo esc_attr(get_bloginfo('language')); ?>">

<head>
    <meta charset="<?php echo esc_attr(get_bloginfo('charset')); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="<?php the_field('favicon', 'option'); ?>" type="image/x-icon" />
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>

<body>

    <header class="header">
        <div class="header__content container">
            <div class="header__logo">
                <img src="<?php echo HUB_IMG_DIR; ?>/logo-img.svg" alt="logo">
                MovieHub
            </div>
            
            <nav class="header__nav nav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'header_menu',
                    'container' => false,
                    'menu_class' => 'nav__items',
                    'link_before' => '<span class="nav__item">',
                    'link_after' => '</span>',
                    'fallback_cb' => false
                ));
                ?>
            </nav>
        </div>
    </header>