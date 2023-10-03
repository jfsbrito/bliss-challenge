<?php
/**
 * The template for Frontpage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bliss_Challenge
 */

get_header();
?>
  <!--Hero Section -->
    <section class="home__hero" style="background-image: url(<?php echo esc_url(wp_get_attachment_url(get_post_meta($post->ID, 'image_hero', true))); ?>)">
        <div class="home__hero__content">
            <?php if (!empty(get_post_meta($post->ID, 'title_hero', true))) : ?>
                <h1 class="home__hero__content--title"><?php echo esc_html(get_post_meta($post->ID, 'title_hero', true)); ?></h1>
            <?php endif; ?>
    
            <?php if (!empty(get_post_meta($post->ID, 'description_hero', true))) : ?>
                <div class="home__hero__content--introduction"><?php echo wp_kses_post(get_post_meta($post->ID, 'description_hero', true)); ?></div>
            <?php endif; ?>
    
            <?php if (!empty(get_post_meta($post->ID, 'hyperlink_hero', true))) : ?>
                <a href="<?php echo esc_url(get_post_meta($post->ID, 'hyperlink_hero', true)); ?>" class="home__hero__content--btn"><?php _e('See more', 'bliss-chanllenge'); ?></a>
            <?php endif; ?>
        </div>
    </section>
     <!--End of Hero Section -->
     <!--Search Section -->
    <section class="home__search">
        <h2><?php _e('Search all articles', 'bliss-chanllenge'); ?></h2>
        <form method="post" action="" class="home__search__form" >
            <input type="search" name="s" placeholder="<?php _e('Write some term...', 'bliss-chanllenge'); ?>" />
            <button><?php _e('Search', 'bliss-chanllenge'); ?></button>
        </form>
    </section>
    <!--End of Search Section -->
    <!--Posts Section -->
    <section class="home__posts">
        <h2><?php _e('Posts', 'bliss-chanllenge'); ?></h2>
        <div  class="posts__grid">
        <?php
        $args = array(
            'post_type' => 'post', 
            'post_status' => 'publish',
            'posts_per_page' => 6, 
        );
        $query = new WP_Query($args);
        
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                get_template_part( 'template-parts/posts/content', 'loop' );
            endwhile;
        endif;
            wp_reset_postdata(); 
        ?>
        </div>
    </section>
    <!--End of Posts Section -->
    <!--Events Section -->    
    <section class="home__events">
        <h2><?php _e('Events', 'bliss-chanllenge'); ?></h2>
        <div  class="events__grid">
        <?php
        $args = array(
            'post_type' => 'event', 
            'post_status' => 'publish',
            'posts_per_page' => -1, 
        );
        $query = new WP_Query($args);
        
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                get_template_part( 'template-parts/posts/content', 'loop' );
            endwhile;
        endif;
            wp_reset_postdata(); 
        ?>
        </div>
    </section>
    <!--End of Posts Section -->
    <!--Gutenberg Section -->            
    <section class="home__gutenberg__container">
        <?php
            echo apply_filters('the_content', get_the_content());
        ?>    
    </section>
    <!--End of Gutenberg Section -->

<?php
get_footer();
