<?php

    function moviehub_register_menus() {
        register_nav_menus(array(
            'header_menu' => 'Header Menu'
        ));
    }
    add_action('init', 'moviehub_register_menus');