<?php
class bc_custom_seo_meta_tags {
    public function __construct() {
        // Add the action hook to include the SEO meta tags in the wp_head()
        add_action('wp_head', array($this, 'bc_render_seo_meta_tags'), 1);
    }

    public function bc_render_seo_meta_tags() {
        $options = get_option('theme-options');
       
        if (!$options) {
            return;
        }

        $index = get_option('blog_public') == 0 ? 'no' : '';

        echo '<meta name="googlebot" content="' . esc_attr($index) . 'index, ' . esc_attr($index) . 'follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />';
        echo '<meta name="bingbot" content="' . esc_attr($index) . 'index, ' . esc_attr($index) . 'follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />';

        if (is_front_page() || is_404()) {
            $this->bc_render_homepage_meta_tags($options);
        } elseif (is_category()) {
            $this->bc_render_category_meta_tags();
        }  elseif (is_search()) {
            $this->bc_render_search_meta_tags();
        } elseif (is_404()) {
            $this->bc_render_404_meta_tags($options);
        } elseif (is_archive()) {
            $this->bc_render_archive_meta_tags();
        } elseif (is_page() || is_single()) {
            $this->bc_render_page_meta_tags($options);
        }
    }

    public function bc_render_category_meta_tags() {
        if(!empty(get_term_meta( get_queried_object()->term_id, 'term_seo_title', true ))){
            $title = get_term_meta( get_queried_object()->term_id, 'term_seo_title', true );
        }else{
            $title = get_queried_object()->name;
        }
        if(!empty(get_term_meta( get_queried_object()->term_id, 'term_seo_description', true ))){
            $description = get_term_meta( get_queried_object()->term_id, 'term_seo_description', true );
        }else{
            $description = get_queried_object()->description;
        }   
        if(!empty(get_term_meta( get_queried_object()->term_id, 'term_seo_image', true ))){
            $image = get_term_meta( get_queried_object()->term_id, 'term_seo_image', true );
        }else{
            $image = get_stylesheet_directory_uri().'/assets/images/website-cover.jpg';
        }
        echo '<!-- Primary Meta Tags -->';
        ?>
        <title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
        <?php
        echo '<meta name="title" content="' . get_bloginfo('name') . '">';
        echo '<meta name="description" content="' . get_bloginfo('description') . '">';
    
        // Render Open Graph / Facebook and Twitter meta tags
        echo '<meta property="og:locale" content="' . esc_attr(get_locale()) . '" />';
        echo '<meta property="og:type" content="website">';
        echo '<meta property="og:url" content="' . esc_url(get_the_permalink()) . '">';
        echo '<meta property="og:title" content="' . esc_html($title) . '">';
        echo '<meta property="og:description" content="' . esc_html($description) . '">';
        echo '<meta property="og:image" content="' . esc_html($image) .'">';
        echo '<meta property="og:image:height" content="630" />';
        echo '<meta property="og:image:width" content="1200" />';
    
        // Render Twitter meta tags
        echo '<meta property="twitter:card" content="summary_large_image">';
        echo '<meta property="twitter:url" content="' . esc_url(get_the_permalink()) . '">';
        echo '<meta property="twitter:title" content="' . esc_html($title) . '">';
        echo '<meta property="twitter:description" content="' . esc_html($description) . '">';
        echo '<meta property="twitter:image" content="' . esc_url($image) . '">';
    
        // Render JSON-LD script
        echo '<script type="application/ld+json">';
        echo '{';
        echo '"@context": "https://schema.org/",';
        echo '"@type": "Corporation",';
        echo '"@id": "#Corporation",';
        echo '"url": "' . esc_url(home_url()) . '",';
        echo '"legalName": "' . wp_title() . '",';
        echo '"name": "' . get_bloginfo('name') . '",';
        echo '"description": "' . get_bloginfo('description') . '",';
        echo '"image": "' . get_stylesheet_directory_uri() . '/assets/images/website-cover.jpg",';
        echo '"logo": "' . get_stylesheet_directory_uri() . '/assets/images/logotipo.svg",';
        echo '"telephone": "' . esc_attr($options['telephone']) . '",';
        echo '"email": "' . esc_attr($options['email']) . '"';
    
        if ($options['street']) {
            echo ',';
            echo '"address": {';
            echo '"@type": "PostalAddress",';
            echo '"streetAddress": "' . esc_attr($options['street']) . '",';
            echo '"addressLocality": "' . esc_attr($options['locality']) . '",';
            echo '"addressRegion": "' . esc_attr($options['locality']) . '",';
            echo '"addressCountry": "' . esc_attr($options['country']) . '",';
            echo '"postalCode": "' . esc_attr($options['postal_code']) . '"';
            echo '}';
        }
    
        if (isset($social)) {
            echo ',';
            echo '"sameAs": ' . json_encode($social, JSON_UNESCAPED_SLASHES);
        }
    
        echo '}';
        echo '</script>';        
    }

    public function bc_render_search_meta_tags() {
        // Implement rendering for search pages
    }

    public function bc_render_archive_meta_tags() {
        // Implement rendering for archive pages
    }

    public function bc_render_page_meta_tags($options) {
        global $post;
        if(!empty(get_post_meta( $post -> ID, 'seo_title', true ))){
            $title = get_post_meta( $post -> ID, 'seo_title', true );
        }else{ 
            $title = get_the_title();
        }
        if(!empty(get_post_meta( $post -> ID, 'seo_description', true ))){
            $description = get_post_meta( $post -> ID, 'seo_description', true );
        }else{
            $description = get_the_excerpt();
        }
        if(!empty(get_post_meta( $post -> ID, 'seo_image', true ))){
            $image = get_post_meta( $post -> ID, 'seo_image', true );
        }else{
            if(wp_get_attachment_image_src(get_post_thumbnail_id($post -> ID))){
                $imageInfo = wp_get_attachment_image_src(get_post_thumbnail_id($post -> ID),'large');
                if($imageInfo){
                    $image = $imageInfo[0]; 
                }
            }else{
                $image = get_stylesheet_directory_uri()."/assets/images/website-cover.jpg";
            }
        }        
        echo '<!-- Primary Meta Tags -->';
        ?>
        <title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
        <?php
        echo '<meta name="title" content="' . get_bloginfo('name') . '">';
        echo '<meta name="description" content="' . get_bloginfo('description') . '">';
    
        // Render Open Graph / Facebook and Twitter meta tags
        echo '<meta property="og:locale" content="' . esc_attr(get_locale()) . '" />';
        echo '<meta property="og:type" content="website">';
        echo '<meta property="og:url" content="' . esc_url(get_the_permalink()) . '">';
        echo '<meta property="og:title" content="' . esc_html($title) . '">';
        echo '<meta property="og:description" content="' . esc_html($description) . '">';
        echo '<meta property="og:image" content="' . esc_html($image) .'">';
        echo '<meta property="og:image:height" content="630" />';
        echo '<meta property="og:image:width" content="1200" />';
    
        // Render Twitter meta tags
        echo '<meta property="twitter:card" content="summary_large_image">';
        echo '<meta property="twitter:url" content="' . esc_url(get_the_permalink()) . '">';
        echo '<meta property="twitter:title" content="' . esc_html($title) . '">';
        echo '<meta property="twitter:description" content="' . esc_html($description) . '">';
        echo '<meta property="twitter:image" content="' . esc_url($image) . '">';
    
        // Render JSON-LD script
        echo '<script type="application/ld+json">';
        echo '{';
        echo '"@context": "https://schema.org/",';
        echo '"@type": "Corporation",';
        echo '"@id": "#Corporation",';
        echo '"url": "' . esc_url(home_url()) . '",';
        echo '"legalName": "' . wp_title() . '",';
        echo '"name": "' . get_bloginfo('name') . '",';
        echo '"description": "' . get_bloginfo('description') . '",';
        echo '"image": "' . get_stylesheet_directory_uri() . '/assets/images/website-cover.jpg",';
        echo '"logo": "' . get_stylesheet_directory_uri() . '/assets/images/logotipo.svg",';
        echo '"telephone": "' . esc_attr($options['telephone']) . '",';
        echo '"email": "' . esc_attr($options['email']) . '"';
    
        if ($options['street']) {
            echo ',';
            echo '"address": {';
            echo '"@type": "PostalAddress",';
            echo '"streetAddress": "' . esc_attr($options['street']) . '",';
            echo '"addressLocality": "' . esc_attr($options['locality']) . '",';
            echo '"addressRegion": "' . esc_attr($options['locality']) . '",';
            echo '"addressCountry": "' . esc_attr($options['country']) . '",';
            echo '"postalCode": "' . esc_attr($options['postal_code']) . '"';
            echo '}';
        }
    
        if (isset($social)) {
            echo ',';
            echo '"sameAs": ' . json_encode($social, JSON_UNESCAPED_SLASHES);
        }
    
        echo '}';
        echo '</script>';  
    }

    public function bc_render_homepage_meta_tags($options) {
        echo '<!-- Primary Meta Tags -->';
        ?>
        <title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
        <?php
        echo '<meta name="title" content="' . get_bloginfo('name') . '">';
        echo '<meta name="description" content="' . get_bloginfo('description') . '">';
    
        // Render Open Graph / Facebook and Twitter meta tags
        echo '<meta property="og:locale" content="' . esc_attr(get_locale()) . '" />';
        echo '<meta property="og:type" content="website">';
        echo '<meta property="og:url" content="' . esc_url(site_url()) . '">';
        echo '<meta property="og:title" content="' . get_bloginfo('name') . '">';
        echo '<meta property="og:description" content="' . get_bloginfo('description') . '">';
        echo '<meta property="og:image" content="' . get_stylesheet_directory_uri() . '/assets/images/website-cover.jpg">';
        echo '<meta property="og:image:height" content="630" />';
        echo '<meta property="og:image:width" content="1200" />';
    
        // Render Twitter meta tags
        echo '<meta property="twitter:card" content="summary_large_image">';
        echo '<meta property="twitter:url" content="' . esc_url(site_url()) . '">';
        echo '<meta property="twitter:title" content="' . get_bloginfo('name') . '">';
        echo '<meta property="twitter:description" content="' . get_bloginfo('description') . '">';
        echo '<meta property="twitter:image" content="' . get_stylesheet_directory_uri() . '/assets/images/website-cover.jpg">';
    
        // Render JSON-LD script
        echo '<script type="application/ld+json">';
        echo '{';
        echo '"@context": "https://schema.org/",';
        echo '"@type": "Corporation",';
        echo '"@id": "#Corporation",';
        echo '"url": "' . esc_url(home_url()) . '",';
        echo '"legalName": "' . wp_title() . '",';
        echo '"name": "' . get_bloginfo('name') . '",';
        echo '"description": "' . get_bloginfo('description') . '",';
        echo '"image": "' . get_stylesheet_directory_uri() . '/assets/images/website-cover.jpg",';
        echo '"logo": "' . get_stylesheet_directory_uri() . '/assets/images/logotipo.svg",';
        echo '"telephone": "' . esc_attr($options['telephone']) . '",';
        echo '"email": "' . esc_attr($options['email']) . '"';
    
        if ($options['street']) {
            echo ',';
            echo '"address": {';
            echo '"@type": "PostalAddress",';
            echo '"streetAddress": "' . esc_attr($options['street']) . '",';
            echo '"addressLocality": "' . esc_attr($options['locality']) . '",';
            echo '"addressRegion": "' . esc_attr($options['locality']) . '",';
            echo '"addressCountry": "' . esc_attr($options['country']) . '",';
            echo '"postalCode": "' . esc_attr($options['postal_code']) . '"';
            echo '}';
        }
    
        if (isset($social)) {
            echo ',';
            echo '"sameAs": ' . json_encode($social, JSON_UNESCAPED_SLASHES);
        }
    
        echo '}';
        echo '</script>';
    }
}

// Instantiate the class
if(!is_admin()) new bc_custom_seo_meta_tags();
