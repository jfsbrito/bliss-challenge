<?php
// Register Custom Post Type
function bc_cpt_events() {

    $labels = array(
        'name'                  => _x( 'Events', 'Post Type General Name', 'bliss-challenge' ),
        'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'bliss-challenge' ),
        'menu_name'             => __( 'Events', 'bliss-challenge' ),
        'name_admin_bar'        => __( 'Event', 'bliss-challenge' ),
        'archives'              => __( 'Event Archives', 'bliss-challenge' ),
        'attributes'            => __( 'Event Attributes', 'bliss-challenge' ),
        'parent_Event_colon'     => __( 'Parent Event:', 'bliss-challenge' ),
        'all_Events'             => __( 'All Events', 'bliss-challenge' ),
        'add_new_Event'          => __( 'Add New Event', 'bliss-challenge' ),
        'add_new'               => __( 'Add New', 'bliss-challenge' ),
        'new_Event'              => __( 'New Event', 'bliss-challenge' ),
        'edit_Event'             => __( 'Edit Event', 'bliss-challenge' ),
        'update_Event'           => __( 'Update Event', 'bliss-challenge' ),
        'view_Event'             => __( 'View Event', 'bliss-challenge' ),
        'view_Events'            => __( 'View Events', 'bliss-challenge' ),
        'search_Events'          => __( 'Search Event', 'bliss-challenge' ),
        'not_found'             => __( 'Not found', 'bliss-challenge' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'bliss-challenge' ),
        'featured_image'        => __( 'Featured Image', 'bliss-challenge' ),
        'set_featured_image'    => __( 'Set featured image', 'bliss-challenge' ),
        'remove_featured_image' => __( 'Remove featured image', 'bliss-challenge' ),
        'use_featured_image'    => __( 'Use as featured image', 'bliss-challenge' ),
        'insert_into_Event'      => __( 'Insert into Event', 'bliss-challenge' ),
        'uploaded_to_this_Event' => __( 'Uploaded to this Event', 'bliss-challenge' ),
        'Events_list'            => __( 'Events list', 'bliss-challenge' ),
        'Events_list_navigation' => __( 'Events list navigation', 'bliss-challenge' ),
        'filter_Events_list'     => __( 'Filter Events list', 'bliss-challenge' ),
    );
    $args = array(
        'label'                 => __( 'event', 'bliss-challenge' ),
        'description'           => __( 'All events here!', 'bliss-challenge' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-megaphone',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => false,
        'has_archive'           => 'events',
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rest_base'             => 'events',
    );
    register_post_type( 'event', $args );

// Add a single metabox for "Event Information"
function bc_add_event_information_metabox() {
    add_meta_box(
        'event_information',
        'Event Information',
        'bc_event_information_callback',
        'event',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'bc_add_event_information_metabox');

// Callback function for displaying the "Event Information" metabox
function bc_event_information_callback($post) {
    // Retrieve values from post meta
    $start_date = get_post_meta($post->ID, 'event_start_date', true);
    $end_date = get_post_meta($post->ID, 'event_end_date', true);
    $local = get_post_meta($post->ID, 'event_local', true);
    $time = get_post_meta($post->ID, 'event_time', true);
    ?>
    <label for="event_start_date">Start Date:</label>
    <input type="date" name="event_start_date" id="event_start_date" value="<?php echo esc_attr($start_date); ?>" /><br />

    <label for="event_end_date">End Date:</label>
    <input type="date" name="event_end_date" id="event_end_date" value="<?php echo esc_attr($end_date); ?>" /><br />

    <label for="event_local">Local:</label>
    <input type="text" name="event_local" id="event_local" value="<?php echo esc_attr($local); ?>" /><br />

    <label for="event_time">Time:</label>
    <input type="time" name="event_time" id="event_time" value="<?php echo esc_attr($time); ?>" /><br />
    <?php
}

// Save the metabox data
function bc_save_event_information_metabox($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = array('event_start_date', 'event_end_date', 'event_local', 'event_time');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}

// Hook into WordPress
add_action('save_post_event', 'bc_save_event_information_metabox');

}
add_action( 'init', 'bc_cpt_events', 0 );