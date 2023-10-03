<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bliss_Challenge
 */
?>
    <article class="posts__grid__item">
    <?php if (has_post_thumbnail()) : ?>
        <div class="posts__grid__item--thumbnail">
            <a href="<?php echo get_permalink(); ?>">
            <?php the_post_thumbnail('large'); ?>
            </a>
        </div>
    <?php endif; ?>                
        <h3 class="posts__grid__item--title"><?php the_title(); ?></h3>
        <div class="posts__grid__item--excerpt"><?php the_excerpt(); ?></div>
        <span class="posts__grid__item--date">Date: <?php echo get_the_date(); ?></span>
    </article>
