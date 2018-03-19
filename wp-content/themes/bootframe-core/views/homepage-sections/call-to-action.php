<?php
/**
 * Call To Action Section Partial
 */

//global variables
global $title_call_to_action, $box_content, $section_background_image, $section_background, $call_to_action_label, $call_to_action_link, $box_attributes;

$style_string = 'padding: 10px 0 40px 0;';

$style_string .= 'background-color: '.$section_background .';';

if(strlen($section_background_image)>0){

    $style_string .= 'background-image: url('.$section_background_image.');';
    $style_string .= 'background-repeat: repeat;';


}


?>
<div class="smartlib-full-strech-section smartlib-call-to-action-box smartlib-dark-section smartlib-paralax-container smartlib-overlay-over-background" style="<?php echo $style_string ?>" <?php echo $box_attributes ?>>

    <div class="container">
    <div class="row">
        <div class="col-md-12 text-left"><h2 class="smartlib-call-to-action-title"><?php echo $title_call_to_action ?></h2></div>
        <div class="col-md-8 smartlib-call-to-action-content"><?php echo  $box_content ?></div>
        <div class="col-md-4"><a href="<?php echo  $call_to_action_link ?>" class="btn btn-lg btn-default  pull-right"><?php echo  $call_to_action_label ?></a></div>
    </div>
    </div>
</div>