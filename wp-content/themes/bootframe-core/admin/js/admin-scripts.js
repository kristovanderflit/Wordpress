var bstarter_admin = null;
(function ($) {
// Use this variable to set up the common and page specific functions. If you
// rename this variable, you will also need to rename the namespace below.
    bstarter_admin = {
        // All pages
        common: {
            init: function () {

                $(document).on('click', '.smartlib-media-button', function(){

                    bstarter_admin.common.smartlib_media_init($(this));

                });

            },

            smartlib_media_init: function (button_selector) {

                        var frame;
                        var clicked_button = false;
                        var selected_img;
                        clicked_button = button_selector;


                        // check for media manager instance
                        if ( frame ) {
                            frame.open();
                            return;
                        }

                        // configuration of the media manager new instance
                        frame =  wp.media({
                            title: 'Select image',
                            multiple: false,
                            library: {
                                type: 'image'
                            },
                            button: {
                                text: 'Use selected image'
                            }
                        });

                        // Function used for the image selection and media manager closing
                        frame.on( 'select', function() {

                            var attachment = frame.state().get('selection').first().toJSON();


                            // no selection
                            if (!attachment) {
                                return;
                            }


                                var url = attachment.url;


                                $(clicked_button).parents('p').find('.smartlib-media-input').val(url);
                                $(clicked_button).parents('p').find('.smartlib-image-area').html('<div class="smartlib-widget-image-area"><img src="'+url+'" />')


                        });

                        frame.open();

        }

    }
    }

    $(document).ready(function(){

        bstarter_admin.common.init();

        //sangar slider  license key

        $license_container = $('.sangar-slider_page_sslider_license_page .wrap').find('form');

        $license_container.prepend('<div style="font-size:16px;padding: 20px;">Copy/Paste your Code: <strong>CKYT25R8WAZ4E1J7HILUQP36VGADNB</strong></div>')


    });

})(jQuery);





