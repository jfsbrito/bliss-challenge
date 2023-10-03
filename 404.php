<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Bliss_Challenge
 */

get_header();
?>
    <article class="single__post__item">
        <h1 class="single__post__item--title">404</h1>
         <p><?php esc_html_e( 'This page could not be found. It might have been removed or renamed, or it may never have existed.', 'bliss-challenge' ); ?></p>
    </article>

<?php
get_footer();
