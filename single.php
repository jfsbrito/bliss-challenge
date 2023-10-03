<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Bliss_Challenge
 */

get_header();
?>
<?php
while ( have_posts() ) :
	the_post();
	
	if ( is_singular( 'post' ) ):
        
		get_template_part( 'template-parts/posts/content', 'single' );
        
    elseif(is_singular('event')):
        
        get_template_part( 'template-parts/events/content', 'single' );
        
    endif;

    the_post_navigation(
        array(
            'next_text' => '<span aria-hidden="true">' . __( 'Next Post', 'bliss-challenge' ) . '</span> ' .
                '<span class="sr-only">' . __( 'Next post:', 'bliss-challenge' ) . '</span> <br/>' .
                '<span>%title</span>',
            'prev_text' => '<span aria-hidden="true">' . __( 'Previous Post', 'bliss-challenge' ) . '</span> ' .
                '<span class="sr-only">' . __( 'Previous post:', 'bliss-challenge' ) . '</span> <br/>' .
                '<span>%title</span>',
        )
    );
endwhile;
?>
<?php
get_footer();
