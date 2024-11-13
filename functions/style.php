<?php

	define("HUB_THEME_ROOT", get_template_directory_uri());
	define("HUB_CSS_DIR", HUB_THEME_ROOT . "/css");
	define("HUB_JS_DIR", HUB_THEME_ROOT . "/js");
	define("HUB_IMG_DIR", HUB_THEME_ROOT . "/img");

	function moviehub_enqueue_scripts(){
		wp_enqueue_style( 'moviehub-style', HUB_CSS_DIR . '/style.css', null, time(), false );

        wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap', false );
        wp_enqueue_style( 'google-fonts-poppins', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', false );
		
		wp_enqueue_script( 'moviehub-script', HUB_JS_DIR . '/app.js', array(), time(), true );
	}
    add_action( 'wp_enqueue_scripts', 'moviehub_enqueue_scripts');