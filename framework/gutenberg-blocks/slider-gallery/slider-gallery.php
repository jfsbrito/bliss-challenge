<?php
function bc_register_slider_block() {
    // Register block styles.
    register_block_type('bliss-challenge/slider-block', array(
        'editor_script' => 'bliss-challenge-image-slider-gutenberg-editor-script',
        'editor_style' => 'bliss-challenge-image-slider-gutenberg-editor-style',
    ));
}
add_action('init', 'bc_register_slider_block');

function bc_register_slider_block_admin_assets(){
    wp_register_script(
        'bliss-challenge-image-slider-gutenberg-editor-script',
        get_template_directory_uri() . '/framework/gutenberg-blocks/slider-gallery/slider-gallery-editor.js',
        array(
            'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-api'
        )
    );
    wp_enqueue_style(
        'bliss-challenge-image-slider-gutenberg-editor-style', 
        get_template_directory_uri() . '/framework/gutenberg-blocks/slider-gallery/slider-gallery-editor.css', 
        false, 
        '1.0',
        'all'
    );
 
}

add_action('admin_enqueue_scripts', 'bc_register_slider_block_admin_assets');

function bc_register_slider_block_front_assets() {
    //Check if is admin panel
    if(is_admin()) return;
    
        // Enqueue the block's JavaScript file
        wp_enqueue_script(
            'bliss-challenge-image-slider-gutenberg-front-script',
            get_template_directory_uri() . '/framework/gutenberg-blocks/slider-gallery/slider-gallery-front.js',
            array(
                'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-api'
            )
        );

        // Enqueue the block's CSS file
        wp_enqueue_style(
            'bliss-challenge-image-slider-gutenberg-front-style',
            get_template_directory_uri() . '/framework/gutenberg-blocks/slider-gallery/slider-gallery-front.css',
            false,
            '1.0',
            'all'
        );
}

add_action('wp_enqueue_scripts', 'bc_register_slider_block_front_assets');

