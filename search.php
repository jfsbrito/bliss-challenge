<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Bliss_Challenge
 */

get_header();
?>
    <h1><?php printf(__('Search Results for: %s', 'bliss-chanllenge'), get_search_query()); ?></h1>
    <section class="archive__posts">
<?php if (have_posts()) : ?>

    <div class="posts__grid">
        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('template-parts/posts/content', 'loop'); ?>
        <?php endwhile; ?>
    </div>
<?php else : ?>
    <p><?php _e('No posts found.', 'bliss-chanllenge'); ?></p>
<?php endif; ?>
    </section>

<?php
get_footer();
