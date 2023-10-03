<?php
class themeSettings {
    private $theme_options;

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    public function add_plugin_page() {
        add_menu_page(
            'Theme Options', // page_title
            'Theme Options', // menu_title
            'manage_options', // capability
            'theme-options', // menu_slug
            array( $this, 'create_admin_page' ), // function
            'dashicons-admin-generic', // icon_url
            3 // position
        );
    }

    public function create_admin_page() {
        $this->theme_options = get_option( 'theme-options' ); ?>

        <div class="wrap">
            <h1>Theme Options</h1>
            <p></p>
            <?php settings_errors(); ?>

            <form method="post" action="options.php">
                <?php
                    settings_fields( 'theme_option_group' );
                    do_settings_sections( 'theme-admin' );
                    submit_button();
                ?>
            </form>
        </div>
    <?php }

    public function page_init() {
        register_setting(
            'theme_option_group', // option_group
            'theme-options', // option_name
            array( $this, 'sanitize_input' ) // sanitize_callback
        );

        add_settings_section(
            'theme_setting_section', // id
            'Settings', // title
            array( $this, 'section_info' ), // callback
            'theme-admin' // page
        );

        $fields = array(
            'street' => 'Street',
            'locality' => 'Locality',
            'country' => 'Country',
            'postal_code' => 'Postal Code',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'telephone' => 'Telephone',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'youtube' => 'Youtube',
            'linkedin' => 'LinkedIn',
            'instagram' => 'Instagram',
            'body_scripts' => 'Body Scripts',
            'header_scripts' => 'Header Scripts',

        );

        foreach ($fields as $field_id => $field_title) {
            add_settings_field(
                $field_id, // id
                $field_title, // title
                array( $this, $field_id . '_callback' ), // callback
                'theme-admin', // page
                'theme_setting_section' // section
            );
        }
    }

    public function sanitize_input($input) {
        $sanitary_values = array();

        $fields = array(
            'street', 'locality', 'country', 'postal_code', 'latitude', 'longitude',
            'telephone', 'mobile', 'email', 'facebook', 'twitter', 'youtube',
            'soundcloud', 'linkedin', 'instagram', 'body_scripts', 'header_scripts',
            'google_api_map_key', 'smtp_host', 'smtp_username',
            'smtp_password', 'smtp_port', 'smtp_secure', 'smtp_authentication', 'smtp_auto_tls', 'smtp_sender_name',
        );

        foreach ($fields as $field) {
            if (isset($input[$field])) {
                $sanitary_values[$field] = is_array($input[$field]) ? $input[$field] : sanitize_text_field($input[$field]);
            }
        }

        return $sanitary_values;
    }

    public function section_info() {
        
    }

    public function street_callback() {
        printf(
            '<input class="regular-text" type="text" name="theme-options[street]" id="street" value="%s">',
            isset($this->theme_options['street']) ? esc_attr($this->theme_options['street']) : ''
        );
    }
    
    public function locality_callback() {
        printf(
            '<input class="regular-text" type="text" name="theme-options[locality]" id="locality" value="%s">',
            isset($this->theme_options['locality']) ? esc_attr($this->theme_options['locality']) : ''
        );
    }
    
    public function country_callback() {
        printf(
            '<input class="regular-text" type="text" name="theme-options[country]" id="country" value="%s">',
            isset($this->theme_options['country']) ? esc_attr($this->theme_options['country']) : ''
        );
    }
    
    public function postal_code_callback() {
        printf(
            '<input class="regular-text" type="text" name="theme-options[postal_code]" id="postal_code" value="%s">',
            isset($this->theme_options['postal_code']) ? esc_attr($this->theme_options['postal_code']) : ''
        );
    }
    
    public function latitude_callback() {
        printf(
            '<input class="regular-text" type="text" name="theme-options[latitude]" id="latitude" value="%s">',
            isset($this->theme_options['latitude']) ? esc_attr($this->theme_options['latitude']) : ''
        );
    }
    
    public function longitude_callback() {
        printf(
            '<input class="regular-text" type="text" name="theme-options[longitude]" id="longitude" value="%s">',
            isset($this->theme_options['longitude']) ? esc_attr($this->theme_options['longitude']) : ''
        );
    }
    
    public function telephone_callback() {
        printf(
            '<input class="regular-text" type="text" name="theme-options[telephone]" id="telephone" value="%s">',
            isset($this->theme_options['telephone']) ? esc_attr($this->theme_options['telephone']) : ''
        );
    }
    
    public function mobile_callback() {
        printf(
            '<input class="regular-text" type="text" name="theme-options[mobile]" id="mobile" value="%s">',
            isset($this->theme_options['mobile']) ? esc_attr($this->theme_options['mobile']) : ''
        );
    }
    
    public function fax_callback() {
        printf(
            '<input class="regular-text" type="text" name="theme-options[fax]" id="fax" value="%s">',
            isset($this->theme_options['fax']) ? esc_attr($this->theme_options['fax']) : ''
        );
    }
    
    public function email_callback() {
        printf(
            '<input class="regular-text" type="text" name="theme-options[email]" id="email" value="%s">',
            isset($this->theme_options['email']) ? esc_attr($this->theme_options['email']) : ''
        );
    }
    
    public function facebook_callback() {
        printf(
            '<input class="regular-text" type="text" name="theme-options[facebook]" id="facebook" value="%s">',
            isset($this->theme_options['facebook']) ? esc_attr($this->theme_options['facebook']) : ''
        );
    }
    
    public function twitter_callback() {
        printf(
            '<input class="regular-text" type="text" name="theme-options[twitter]" id="twitter" value="%s">',
            isset($this->theme_options['twitter']) ? esc_attr($this->theme_options['twitter']) : ''
        );
    }
    
    public function youtube_callback() {
        printf(
            '<input class="regular-text" type="text" name="theme-options[youtube]" id="youtube" value="%s">',
            isset($this->theme_options['youtube']) ? esc_attr($this->theme_options['youtube']) : ''
        );
    }
    
    public function soundcloud_callback() {
        printf(
            '<input class="regular-text" type="text" name="theme-options[soundcloud]" id="soundcloud" value="%s">',
            isset($this->theme_options['soundcloud']) ? esc_attr($this->theme_options['soundcloud']) : ''
        );
    }
    
    public function linkedin_callback() {
        printf(
            '<input class="regular-text" type="text" name="theme-options[linkedin]" id="linkedin" value="%s">',
            isset($this->theme_options['linkedin']) ? esc_attr($this->theme_options['linkedin']) : ''
        );
    }
    
    public function instagram_callback() {
        printf(
            '<input class="regular-text" type="text" name="theme-options[instagram]" id="instagram" value="%s">',
            isset($this->theme_options['instagram']) ? esc_attr($this->theme_options['instagram']) : ''
        );
    }
    public function header_scripts_callback() {
        $editor_settings = array(
            'wpautop'             => ! has_blocks(),
            'media_buttons'       => false,
            'default_editor'      => '',
            'drag_drop_upload'    => false,
            'textarea_rows'       => 15,
            'tabindex'            => '',
            'tabfocus_elements'   => ':prev,:next',
            'editor_css'          => '',
            'editor_class'        => '',
            'teeny'               => false,
            '_content_editor_dfw' => false,
            'tinymce'             => false,
            'quicktags'           => false,
        );
    
        wp_editor(
            isset($this->theme_options['header_scripts']) ? $this->theme_options['header_scripts'] : '',
            'website-options[header_scripts]',
            $editor_settings
        );
    }    
    public function body_scripts_callback() {
        $editor_settings = array(
            'wpautop'             => ! has_blocks(),
            'media_buttons'       => false,
            'default_editor'      => '',
            'drag_drop_upload'    => false,
            'textarea_rows'       => 15,
            'tabindex'            => '',
            'tabfocus_elements'   => ':prev,:next',
            'editor_css'          => '',
            'editor_class'        => '',
            'teeny'               => false,
            '_content_editor_dfw' => false,
            'tinymce'             => false,
            'quicktags'           => false,
        );
    
        wp_editor(
            isset($this->theme_options['body_scripts']) ? $this->theme_options['body_scripts'] : '',
            'website-options[body_scripts]',
            $editor_settings
        );
    }
   

}

if (is_admin()) {
    $theme_settings = new themeSettings();
}
