<?php
class bc_disable_theme_features {
    public function __construct() {
        // Hook into WordPress actions and filters
        add_filter('wp_sitemaps_add_provider', array($this, 'removeUsersFromSitemap'), 10, 2);
        add_action('template_redirect', array($this, 'disableArchives'));
        add_action('admin_menu', array($this, 'removeMenus'));
        add_filter('show_admin_bar', array($this, 'hideAdminBar'));
        add_action('init', array($this, 'removeUnnecessaryResources'));
    }

    public function removeUsersFromSitemap($provider, $name) {
        return ($name == 'users') ? false : $provider;
    }


    public function disableArchives() {
        if (is_tag() || is_date() || is_author()) {
            global $wp_query;
            $wp_query->set_404();
        }
    }

    public function removeMenus() {
        remove_menu_page('edit-comments.php'); // Comments
    }

    public function hideAdminBar() {
        return false;
    }

    public function removeUnnecessaryResources() {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'wp_shortlink_wp_head');
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
        remove_action('template_redirect', 'rest_output_link_header', 11, 0);
        remove_action('wp_head', 'rest_output_link_wp_head', 10);
    }
}

// Instantiate the class
new bc_disable_theme_features();
