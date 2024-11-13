<?php

    function register_movie_post_type() {
        $labels = array(
            'name'               => 'Movies',
            'singular_name'      => 'Movie',
            'menu_name'          => 'Movies',
            'name_admin_bar'     => 'Movie',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Movie',
            'new_item'           => 'New Movie',
            'edit_item'          => 'Edit Movie',
            'view_item'          => 'View Movie',
            'all_items'          => 'All Movies',
            'search_items'       => 'Search Movies',
            'parent_item_colon'  => 'Parent Movies:',
            'not_found'          => 'No movies found.',
            'not_found_in_trash' => 'No movies found in Trash.',
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'movies'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array('title', 'editor', 'thumbnail'),
            'menu_icon'          => 'dashicons-playlist-video',
        );

        register_post_type('movies', $args);
    }
    add_action('init', 'register_movie_post_type');

    function register_movie_genre_taxonomy() {
        $labels = array(
            'name'              => 'Genres',
            'singular_name'     => 'Genre',
            'search_items'      => 'Search Genres',
            'all_items'         => 'All Genres',
            'parent_item'       => 'Parent Genre',
            'parent_item_colon' => 'Parent Genre:',
            'edit_item'         => 'Edit Genre',
            'update_item'       => 'Update Genre',
            'add_new_item'      => 'Add New Genre',
            'new_item_name'     => 'New Genre Name',
            'menu_name'         => 'Genre',
        );
    
        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'genre'),
        );
    
        register_taxonomy('genre', array('movies'), $args);
    }
    add_action('init', 'register_movie_genre_taxonomy');    