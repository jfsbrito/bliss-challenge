<?php
function bc_customizer_theme($wp_customize) {
    // add a setting for the site logo
    $wp_customize -> add_setting('theme-logo');
    // Add a control to upload the logo
    $wp_customize -> add_control(new WP_Customize_Image_Control($wp_customize, 'theme-logo', array('label' => 'Upload Logo', 'section' => 'title_tagline', 'settings' => 'theme-logo', )));
}

add_action('customize_register', 'bc_customizer_theme');
