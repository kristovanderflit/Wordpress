<?php
/**
 * Contact Section Partial
 */

//global variables
global $form_id, $title_contact, $contact_map, $section_background;

$style_string = 'padding: 0;';

$style_string .= 'background-color: ' . $section_background;

?>
<div class="container-fluid smartlib-contact-section" style="<?php echo $style_string ?>">


    <div class="row-fluid smartlib-widgets-panel-row smartlib-homepage-contact-row">

        <div class="col-md-6 panel-grid-cell smartlib-homepage-form-column">
            <div class="half-content-container">

                    <h3><?php echo $title_contact  ?></h3>

                <div class="smartlib-form-box">
                <?php


                if(defined( 'WPCF7_AUTOP' )){


                if ($form_id) {


                    echo do_shortcode('[contact-form-7 id="' . $form_id . '"]');


                }
                }else{


                    _e('Contact Form 7 Plugin is required', 'bootframe-core');


                }
                ?>
                </div>
            </div>
        </div>
        <div class="col-md-6 smartlib-iframe-column">
            <div class="smartlib-contact-iframe-map" style="min-width: 30px; width: 100%">
            <?php echo $contact_map ?>
            </div>
        </div>
    </div>

</div>