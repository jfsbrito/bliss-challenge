(function () {
    var el = wp.element.createElement;
    var registerBlockType = wp.blocks.registerBlockType;
    var MediaUpload = wp.blockEditor.MediaUpload;
    var Button = wp.components.Button;
    registerBlockType('bliss-challenge/image-slider', {
        title: 'Image Slider',
        icon: 'format-image',
        category: 'common',
        attributes: {
            images: {
                type: 'array',
                default: [],
            },
        },
        edit: function (props) {
            var attributes = props.attributes;

            function onImageSelect(newImages) {
                props.setAttributes({ images: newImages });
            }

            return el(
                'div',
                null,
                el(
                    MediaUpload,
                    {
                        onSelect: onImageSelect,
                        type: 'image',
                        multiple: true,
                        value: attributes.images.map(function (image) {
                            return image.id;
                        }),
                        render: function (_ref) {
                            var open = _ref.open;
                            return el(
                                Button,
                                {
                                    onClick: open,
                                    icon: 'format-image',
                                    label: 'Select Images',
                                },
                            );
                        },
                    },
                ),
                attributes.images.length > 0 &&
                    el(
                        'div',
                        { className: 'bc-slider' },
                        attributes.images.map(function (image) {
                            return el('img', {
                                key: image.id,
                                src: image.url,
                                alt: image.alt,
                            });
                        }),
                    ),
            );
        },
        save: function (props) {
            var attributes = props.attributes;
        
            if (attributes.images.length === 0) {
                // Return a message or placeholder content if no images are selected.
                return el('div', { className: 'bc-slider__placeholder' }, 'Select Images');
            }
        
            return el(
                'div',
                { className: 'bc-slider' }, 
                el(
                    'div',
                    { className: 'bc-slider__content' },
                    attributes.images.map(function (image) {
                        return el('img', {
                            key: image.id,
                            src: image.url,
                            alt: image.alt,
                        });
                    })
                ),
                el('div', { className: 'bc-slider__pager' })
            );
        },
    });
})();
