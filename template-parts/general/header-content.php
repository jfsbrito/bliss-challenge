<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bliss_Challenge
 */
?>
<header class="header__normal">
    <a class="header__normal__logo" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
        <?php
        $logo_src = get_theme_mod('theme-logo');
        if (empty($logo_src)):
            $logo_src = get_stylesheet_directory_uri() . "/assets/images/logo.svg";
        endif;
        echo '<img loading="lazy" src="' . esc_url($logo_src) . '" alt="Logo" />';
        ?>
    </a>
    <nav id="header__normal__navigation" aria-label="<?php esc_attr_e('Main Navigation', 'bliss-challenge'); ?>">
        <button class="header__normal__navigation--btn" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <?php
        wp_nav_menu(array(
            'theme_location' => 'menu-1',
            'container'=> '',
            'menu_class' => 'header__normal__navigation__menu',
            'menu_id' => 'header__normal__navigation__menu',
            'items_wrap' => '<ul id="%1$s" class="%2$s" aria-label="submenu">%3$s</ul>',
        ));
        ?>
    </nav>
</header>
