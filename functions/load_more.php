<?php

    function movies_load_more_endpoint() {
        register_rest_route('movies/v1', '/list', array(
            'methods' => 'GET',
            'callback' => 'movies_load_more_callback',
        ));
    }
    add_action('rest_api_init', 'movies_load_more_endpoint');

    function movies_load_more_callback($data) {
        $page = isset($data['page']) ? (int) $data['page'] : 1;
        $genre = isset($data['genre']) ? sanitize_text_field($data['genre']) : '';
        $date_from = isset($data['date_from']) ? sanitize_text_field($data['date_from']) : '';
        $date_to = isset($data['date_to']) ? sanitize_text_field($data['date_to']) : '';
        $sort = isset($data['sort']) ? sanitize_text_field($data['sort']) : '';
        $query = isset($data['query']) ? sanitize_text_field($data['query']) : '';

        $args = array(
            'post_type' => 'movies',
            'posts_per_page' => 2,
            'paged' => $page,
        );

        if ($genre) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'genre',
                    'field' => 'slug',
                    'terms' => $genre,
                ),
            );
        }

        $meta_query = array();

        if ($date_from || $date_to) {
            if ($date_from && $date_to) {
                $meta_query[] = array(
                    'key' => 'release_date',
                    'value' => array($date_from . '-01-01', $date_to . '-12-31'),
                    'compare' => 'BETWEEN',
                    'type' => 'DATE',
                );
            } elseif ($date_from) {
                $meta_query[] = array(
                    'key' => 'release_date',
                    'value' => $date_from . '-01-01',
                    'compare' => '>=',
                    'type' => 'DATE',
                );
            } elseif ($date_to) {
                $meta_query[] = array(
                    'key' => 'release_date',
                    'value' => $date_to . '-12-31',
                    'compare' => '<=',
                    'type' => 'DATE',
                );
            }
        }

        if ($query) {
            $args['s'] = $query;
        }

        if ($sort === 'rating') {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'rating';
            $args['order'] = 'DESC';
        } elseif ($sort === 'date') {
            $args['orderby'] = 'meta_value';
            $args['meta_key'] = 'release_date';
            $args['order'] = 'DESC';
        }

        if (!empty($meta_query)) {
            $args['meta_query'] = $meta_query;
        }

        $movies_query = new WP_Query($args);

        $movies = array();
        if ($movies_query->have_posts()) {
            while ($movies_query->have_posts()) {
                $movies_query->the_post();
                $movies[] = array(
                    'title' => get_the_title(),
                    'link' => get_permalink(),
                    'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'full'),
                    'rating' => get_field('rating'),
                    'release_date' => get_field('release_date'),
                    'rating_img' => get_template_directory_uri() . '/img/star.svg'
                );
            }
            wp_reset_postdata();
        }
        return rest_ensure_response($movies);
    }
