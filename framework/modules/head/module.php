<?php
function bc_add_seo_metabox() {
    add_meta_box(
        'seo_metabox',
        'SEO',
        'bc_display_seo_metabox_callback',
        array('post', 'event', 'page'),
        'normal',
        'low'
    );
}
add_action('add_meta_boxes', 'bc_add_seo_metabox');

// Display the SEO meta box content
function bc_display_seo_metabox_callback($post) { 
    wp_nonce_field('_seo_nonce', 'seo_nonce');
    wp_enqueue_script('jquery');
    
    $seoTitle = get_post_meta($post->ID, 'seo_title', true);
    $seoDescription = get_post_meta($post->ID, 'seo_description', true);
    $seoImage = get_post_meta($post->ID, 'seo_image', true);
?>
<h3><?php _e('SEO Title', 'bliss-chanllenge'); ?></h3>
<input type="text" name="seo_title" class="cem" value="<?php echo $seoTitle; ?>" />

<h3><?php _e('SEO Image', 'bliss-chanllenge'); ?></h3>
<input type="text" name="seo_image" id="seo_image" class="cem" value="<?php echo $seoImage; ?>" />
<button class="button" id="upload_image_button"><?php _e('Upload Image', 'bliss-chanllenge'); ?></button>
<div id="image_preview">
    <?php if (!empty($seoImage)) : ?>
        <img src="<?php echo esc_url($seoImage); ?>" alt="SEO Image" style="max-width: 300px;" />
    <?php endif; ?>
</div>

<h3><?php _e('SEO Description', 'bliss-chanllenge'); ?></h3>
<textarea name="seo_description" id="seo_description" class="cem"><?php echo $seoDescription; ?></textarea>
<p>
    <?php _e('Character Count', 'bliss-chanllenge'); ?> <b><span id="charCount"></span></b> (< 165)
</p>
<span class="warning"></span>

<?php
}

// Save SEO meta data when a post is saved
add_action('save_post', 'save_seo_metabox');
function save_seo_metabox($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    if (!isset($_POST['seo_nonce']) || !wp_verify_nonce($_POST['seo_nonce'], '_seo_nonce'))
        return;
    if (!current_user_can('edit_post', $post_id))
        return;

    update_post_meta($post_id, 'seo_title', sanitize_text_field($_POST['seo_title']));
    update_post_meta($post_id, 'seo_image', sanitize_text_field($_POST['seo_image']));
    update_post_meta($post_id, 'seo_description', sanitize_text_field($_POST['seo_description']));
}

// Add SEO fields to category and tag terms
function add_term_seo_fields() { ?>
    <?php wp_nonce_field( basename( __FILE__ ), 'term_seo_meta_nonce' ); ?>
    <div class="form-field term-meta-text-wrap">
        <label for="term-seo-title"><?php _e('SEO Title', 'bliss-chanllenge'); ?></label>
        <input type="text" name="term_seo_title" id="term-seo-title" value="" class="term-meta-text-field" />
    </div>
    <div class="form-field term-meta-text-wrap">
        <label for="term-seo-image"><?php _e('SEO Image', 'bliss-chanllenge'); ?></label>
        <input type="text" name="term_seo_image" id="term-seo-image" value="" class="term-meta-text-field" />
        <button class="button" id="upload_term_image_button"><?php _e('Upload Image', 'bliss-chanllenge'); ?></button>
        <div id="term_image_preview"></div>
    </div>
    <div class="form-field term-meta-text-wrap">
        <label for="term-seo-description"><?php _e('SEO Description', 'bliss-chanllenge'); ?></label>
        <textarea rows="5" name="term_seo_description" id="term-seo-description" class="large-text"></textarea>
        <p>
            <?php _e('Character Count', 'bliss-chanllenge'); ?> <b><span id="charCount"></span></b> (< 165)
        </p>
        <span class="warning"></span>
    </div>

<?php }

// Edit SEO fields for category and tag terms
function edit_term_seo_fields($term) {
    $seoTitle = get_term_meta($term->term_id, 'term_seo_title', true);
    $seoImage = get_term_meta($term->term_id, 'term_seo_image', true);
    $seoDescription = get_term_meta($term->term_id, 'term_seo_description', true);

    wp_nonce_field(basename(__FILE__), 'term_seo_meta_nonce');
?>
    <tr class="form-field term-meta-text-wrap">
        <th scope="row"><label for="term-seo-title"><?php _e('SEO Title', 'bliss-chanllenge'); ?></label></th>
        <td>
            <input type="text" name="term_seo_title" id="term-seo-title" value="<?php echo esc_attr($seoTitle); ?>" class="term-meta-text-field" />
        </td>
    </tr>
    <tr class="form-field term-meta-text-wrap">
        <th scope="row"><label for="term-seo-image"><?php _e('SEO Image', 'bliss-chanllenge'); ?></label></th>
        <td>
            <input type="text" name="term_seo_image" id="term-seo-image" value="<?php echo esc_attr($seoImage); ?>" class="term-meta-text-field" />
            <button class="button" id="upload_term_image_button"><?php _e('Upload Image', 'bliss-chanllenge'); ?></button>
            <div id="term_image_preview">
                <?php if (!empty($seoImage)) : ?>
                    <img src="<?php echo esc_url($seoImage); ?>" alt="SEO Image" style="max-width: 300px;" />
                <?php endif; ?>
            </div>
        </td>
    </tr>
    <tr class="form-field term-meta-text-wrap">
        <th scope="row"><label for="term-seo-description"><?php _e('SEO Description', 'bliss-chanllenge'); ?></label></th>
        <td>
            <textarea rows="5" name="term_seo_description" id="term-seo-description" class="large-text"><?php echo esc_html($seoDescription); ?></textarea>
            <p>
                <?php _e('Character Count', 'bliss-chanllenge'); ?> <b><span id="charCount"></span></b> (<165)
            </p>
            <span class="warning"></span>
        </td>
    </tr>
<?php }

// Save SEO meta data for category and tag terms
function save_term_seo_meta($term_id) {
    if (!isset($_POST['term_seo_meta_nonce']) || !wp_verify_nonce($_POST['term_seo_meta_nonce'], basename(__FILE__)))
        return;

    if (isset($_POST['term_seo_title'])) {
        update_term_meta($term_id, 'term_seo_title', sanitize_text_field($_POST['term_seo_title']));
    }
    if (isset($_POST['term_seo_description'])) {
        update_term_meta($term_id, 'term_seo_description', sanitize_text_field($_POST['term_seo_description']));
    }
    if (isset($_POST['term_seo_image'])) {
        update_term_meta($term_id, 'term_seo_image', sanitize_text_field($_POST['term_seo_image']));
    }
}

// Add custom columns for SEO data in term lists
function edit_term_seo_columns($columns) {
    $columns['term_seo_title'] = __('SEO Title', 'bliss-chanllenge');
    $columns['term_seo_description'] = __('SEO Description', 'bliss-chanllenge');
    $columns['term_seo_image'] = __('SEO Image', 'bliss-chanllenge');

    return $columns;
}

// Display SEO data in custom columns for terms
function manage_term_seo_custom_column($out, $column, $term_id) {
    if ('term_seo_title' === $column) {
        $out = sprintf('<span class="term-meta-text-block" style="">%s</span>', esc_attr(get_term_meta($term_id, 'term_seo_title', true)));
    }
    if ('term_seo_description' === $column) {
        $out .= sprintf('<span class="term-meta-text-block" style="">%s</span>', esc_attr(get_term_meta($term_id, 'term_seo_description', true)));
    }
    if ('term_seo_image' === $column) {
        $out .= sprintf('<span class="term-meta-text-block" style=""><img src="%s" alt="SEO Image" style="max-width: 100px;" /></span>', esc_attr(get_term_meta($term_id, 'term_seo_image', true)));
    }
    return $out;
}

// Inserir Tax's que pretendas que tenham o módulo SEO
$taxonomies = array('category');

foreach ($taxonomies as $tax) {
    add_action($tax.'_add_form_fields', 'add_term_seo_fields');
    add_action($tax.'_edit_form_fields', 'edit_term_seo_fields');
    add_action('edit_'.$tax, 'save_term_seo_meta');
    add_action('create_'.$tax, 'save_term_seo_meta');
    add_filter('manage_edit-'.$tax.'_columns', 'edit_term_seo_columns', 10, 3);
    add_filter('manage_'.$tax.'_custom_column', 'manage_term_seo_custom_column', 10, 3);
}
