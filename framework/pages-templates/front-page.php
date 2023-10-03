<?php
// Add a metabox to the 'page' post type when the page template is 'default'
add_action('add_meta_boxes', 'bc_add_frontpage_metaboxs');
function bc_add_frontpage_metaboxs() {
    global $post;
    
    // Check if the post is not empty and the page template is 'default'
    if (!empty($post) && (get_post_meta($post->ID,'_wp_page_template',TRUE) == "default")) {
        // Add a metabox with the title 'Hero Section'
        add_meta_box('bc_hero_frontpage', 'Hero Section', 'bc_hero_frontpage_callback', array('page'), 'normal', 'low');
    }
}

// Callback function to display the metabox content
function bc_hero_frontpage_callback($post) {
    // Create a nonce field for security
    wp_nonce_field('_home_nonce', 'home_nonce');
    wp_enqueue_script('jquery');
    wp_enqueue_media();
    
    // Editor settings for the wp_editor fields
    $editor_settings = array(
        'wpautop'             => ! has_blocks(),
        'media_buttons'       => false,
        'default_editor'      => '',
        'drag_drop_upload'    => false,
        'textarea_rows'       => 5,
        'tabindex'            => '',
        'tabfocus_elements'   => ':prev,:next',
        'editor_css'          => '',
        'editor_class'        => '',
        'teeny'               => false,
        '_content_editor_dfw' => false,
        'tinymce'             => false,
        'quicktags'           => true,
    );
    
    // Retrieve existing values for the fields
    $title_hero = get_post_meta($post->ID, 'title_hero', true);
    $description_hero = get_post_meta($post->ID, 'description_hero', true);
    $hyperlink_hero = get_post_meta($post->ID, 'hyperlink_hero', true);
    $image_hero = get_post_meta($post->ID, 'image_hero', true);
    
    // Display the 'Title Hero (Text)' field
    echo "<h3>".__('Title','bliss-chanllenge')."</h3>";
    echo '<input type="text" size="100" name="title_hero" value="' . esc_attr($title_hero) . '" class="admin-input-class">';
    
    // Display the 'Description Hero (Wp_editor)' field
    echo "<h3>".__('Description','bliss-chanllenge')."</h3>";
    wp_editor($description_hero, 'description_hero', $editor_settings);
    
    // Display the 'Hyperlink Hero (Text)' field
    echo "<h3>".__('Hyperlink','bliss-chanllenge')."</h3>";
    echo '<input type="text" size="100" name="hyperlink_hero" value="' . esc_attr($hyperlink_hero) . '" class="admin-input-class">';
    
    // Display the 'Image Hero (Upload Image)' field
    echo "<h3>".__('Image','bliss-chanllenge')."</h3>";
    if ($image_hero) {
        $image_url = wp_get_attachment_url($image_hero);
        echo '<img src="' . esc_url($image_url) . '" style="max-width: 300px;"><br>';
        echo '<button id="remove_image_button" class="button">Remove Image</button><br>';
    }
    echo "<input type='hidden' name='image_hero' id='image_hero' value='" . esc_attr($image_hero) . "'>";
    echo "<button id='upload_image_button' class='button'>".__('Upload/Change Image','bliss-chanllenge')."</button>";
    
    // JavaScript to handle image upload, removal, and update
    ?>
    <script>
    jQuery(document).ready(function($) {
        $('#upload_image_button').click(function() {
            var custom_uploader;
            if (custom_uploader) {
                custom_uploader.open();
                return;
            }
            custom_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: false
            });
            custom_uploader.on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                $('#image_hero').val(attachment.id);
                $('#image_hero').trigger('change'); // Trigger a change event for saving
                $('#remove_image_button').show();
                var image_url = attachment.url;
                $('#image_hero').closest('p').prev('img').attr('src', image_url);
            });
            custom_uploader.open();
        });

        $('#remove_image_button').click(function() {
            $('#image_hero').val('');
            $('#image_hero').trigger('change'); // Trigger a change event for saving
            $('#remove_image_button').hide();
            $('#image_hero').closest('p').prev('img').attr('src', '');
        });
    });
    </script>
    <?php
}

// Save post meta when the post is saved
add_action('save_post', 'save_metabox_home');
function save_metabox_home($post_id) {
    // Check for autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    
    // Verify the nonce field for security
    if (!isset($_POST['home_nonce']) || !wp_verify_nonce($_POST['home_nonce'], '_home_nonce'))
        return;
    
    // Check user capabilities
    if (!current_user_can('edit_post', $post_id))
        return;

    // Update the post meta for the fields
    update_post_meta($post_id, 'title_hero', sanitize_text_field($_POST['title_hero']));
    update_post_meta($post_id, 'description_hero', wp_kses_post($_POST['description_hero']));
    update_post_meta($post_id, 'hyperlink_hero', sanitize_text_field($_POST['hyperlink_hero']));
    update_post_meta($post_id, 'image_hero', intval($_POST['image_hero']));
}
