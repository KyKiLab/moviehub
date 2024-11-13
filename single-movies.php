<?php get_header(); ?>

    <main class="movie-details">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <?php if (has_post_thumbnail()) : ?>
                <div class="movie-poster"><?php the_post_thumbnail('full'); ?></div>
            <?php endif; ?>

            <div class="movie-meta">
                <p><strong>Release Date:</strong> <?php echo esc_html(get_field('release_date')); ?></p>
                <p><strong>Rating:</strong> <?php echo esc_html(get_field('rating')); ?>/10</p>
                <p><strong>Year:</strong> <?php echo esc_html(get_field('year')); ?></p>
            </div>

            <div class="movie-content">
                <?php the_content(); ?>
            </div>

        <?php endwhile; endif; ?>
    </main>

<?php get_footer(); ?>