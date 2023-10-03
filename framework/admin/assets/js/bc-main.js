/*SEO Module*/
jQuery(document).ready(function($) {
    // Handle the media uploader
    $('#upload_image_button').click(function(e) {
        e.preventDefault();
        var image = wp.media({
            title : 'Upload Image',
            multiple : false
        }).open().on('select', function() {
            var uploadedImage = image.state().get('selection').first();
            var imageUrl = uploadedImage.toJSON().url;
            $('#seo_image').val(imageUrl);
            $('#image_preview').html('<img src="' + imageUrl + '" alt="SEO Image" style="max-width: 300px;" />');
        });
    });

    // Character count for SEO description
    $('#seo_description').keyup(function() {
        var max = 300;
        var len = $(this).val().length;
        $("#charCount").text(len);

        if (len >= max) {
            $('.warning').text('Should not exceed 165 characters!');
        } else {
            $('.warning').text('');
        }
    });

    // Handle the media uploader for term image
    $('#upload_term_image_button').click(function(e) {
        e.preventDefault();
        var image = wp.media({
            title : 'Upload Image',
            multiple : false
        }).open().on('select', function() {
            var uploadedImage = image.state().get('selection').first();
            var imageUrl = uploadedImage.toJSON().url;
            $('#term-seo-image').val(imageUrl);
            $('#term_image_preview').html('<img src="' + imageUrl + '" alt="SEO Image" style="max-width: 300px;" />');
        });
    });

    // Character count for SEO description
    $('#term-seo-description').keyup(function() {
        var max = 300;
        var len = $(this).val().length;
        $("#charCount").text(len);

        if (len >= max) {
            $('.warning').text('Should not exceed 165 characters!');
        } else {
            $('.warning').text('');
        }
    });
}); 