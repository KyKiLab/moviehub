<?php get_header(); ?>

<section class="hero">
    <div class="container block-2-col">
        <div class="block-2-col__item">
            <div class="hero__info">
                <h1>Explore a <span>World</span> of Cinematic Wonders </h1>
                <p>Our database not only includes blockbusters but also independent films, documentary features, and works from talented directors worldwide. </p>
                <div class="btns-block">
                    <a href="" class="btn">register now</a>
                    <a href="" class="btn btn-link">about us</a>
                </div>
            </div>
        </div>
        <div class="block-2-col__item">
            <div class="img-decor">
                <div class="img-decor__bgd"></div>
                <div class="img-decor__img">
                    <img src="<?php echo HUB_IMG_DIR; ?>/main-page-decor.png" alt="">
                    <div class="badges">
                        <div class="img-decor__badge img-decor__badge_1">
                            <div class="badge">
                                <div class="badge__content">MovieHub</div>
                            </div>
                        </div>
                        <div class="img-decor__badge img-decor__badge_2">
                            <div class="badge">
                                <div class="badge__content">4.8 <img src="<?php echo HUB_IMG_DIR; ?>/star.svg" alt=""></div>
                            </div>
                        </div>
                        <div class="img-decor__badge img-decor__badge_3">
                            <div class="badge">
                                <div class="badge__content">18K</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="filter">
    <h2>Discover a <span>Universe</span> of Cinematic Marvels</h2>
    <div class="filter__content container">

        <aside class="filter-section">
            <form id="filter-form">
                <label for="query"></label>
                <input type="text" id="query" name="query" placeholder="Search by name" class="search-field">

                <p class="filter-text">FILTER:</p>

                <div class="filter-options">
                    <div class="filter-options__elem">
                        <div class="date-section">
                            <label for="genre"><p>Genre:</p></label>
                            <select id="genre" name="genre">
                                <option value="">all genres</option>
                                <?php
                                $genres = get_terms(array(
                                    'taxonomy' => 'genre',
                                    'hide_empty' => true,
                                ));

                                if (!empty($genres) && !is_wp_error($genres)) {
                                    foreach ($genres as $genre) {
                                        echo '<option value="' . esc_attr($genre->slug) . '">' . esc_html($genre->name) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="filter-options__elem date-section">
                        <p>Date:</p>
                        <div class="date-section__item">
                            <label for="date-from">from</label>
                            <input type="number" id="date-from" class="data-input" name="date_from" min="1900" max="2100" placeholder="YYYY">

                            <label for="date-to">to</label>
                            <input type="number" id="date-to" class="data-input" name="date_to" min="1900" max="2100" placeholder="YYYY">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn">Apply</button>
            </form>
        </aside>

        <div class="results-section">
            <div class="filter-options__elem">
                <label for="sort">Sort by:</label>
                <select id="sort" name="sort">
                    <option value="rating">Rating</option>
                    <option value="date">Date</option>
                </select>
            </div>

            <div class="movie-cards">
                <?php
                $args = array(
                    'post_type' => 'movies',
                    'posts_per_page' => 2,
                );

                $movies_query = new WP_Query($args);

                if ($movies_query->have_posts()) :
                    while ($movies_query->have_posts()) : $movies_query->the_post();
                        ?>
                        <div class="movie-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                            <div class="badge">
                                <div class="badge__content"><?php echo esc_html(get_field('rating')); ?> <img src="<?php echo HUB_IMG_DIR; ?>/star.svg" alt="star"></div>
                            </div>
                            <h3><?php the_title(); ?></h3>
                            <a href="<?php the_permalink(); ?>" class="btn btn-link">read more</a>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No movies found.</p>';
                endif;
                ?>
            </div>
            <button id="load-more" class="btn btn_download">Load More</button>
        </div>
    </div>
</section>

<?php get_footer(); ?>