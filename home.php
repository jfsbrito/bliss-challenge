<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bliss_Challenge
 */
get_header();
?>
    <h1><?php the_archive_title(); ?></h1>
    <section class="archive__posts">
<?php if (have_posts()) : ?>
    <div  class="posts__grid">
    <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part( 'template-parts/posts/content', 'loop' ); ?>
    <?php endwhile; ?>
    </div> 
<?php else : ?>
    <p>No posts found.</p>
<?php endif; ?>
    </section>
<?php
get_footer();