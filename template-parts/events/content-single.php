<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bliss_Challenge
 */
?>
    <article class="single__post__item">
        <h1 class="single__post__item--title"><?php the_title(); ?></h1>
    <?php if (has_post_thumbnail()) : ?>
        <div class="single__post__item--thumbnail">
            <a href="<?php echo get_permalink(); ?>">
            <?php the_post_thumbnail('full'); ?>
            </a>
        </div>
    <?php endif; ?>                
        <span class="single__post__item--date">Date: <?php echo get_the_date(); ?></span>
        <div class="single__post__item--excerpt"><?php  echo apply_filters('the_content', get_the_content());; ?></div>
    </article>
