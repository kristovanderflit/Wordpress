<?php
/**
 * Counter Section Partial
 */

//global variables
global $boxes, $title_counter, $section_background, $section_background_image, $section_background, $box_attributes;


$style_string = 'padding: 10px 0 40px 0;';

$style_string .= 'background-color: ' . $section_background . ';';

if (strlen($section_background_image) > 0) {

    $style_string .= 'background-image: url(' . $section_background_image . ');';
    $style_string .= 'background-repeat: repeat;';


}



?>
<div
    class="container-fluid smartlib-counter-section smartlib-dark-section smartlib-paralax-container smartlib-overlay-over-background"
    style="<?php echo $style_string ?>" <?php echo $box_attributes ?>>
    <div class="container">
        <?php

        smartlib_get_frontpage_section_header($title_counter);

        ?>


        <div class="row">
            <?php
            $i = 1;
            $j = 1;


            if (count($boxes) > 0) {

                $columns_number_selection = 4;

                if ($columns_number_selection > 0) {

                    $column_size = 12 / $columns_number_selection;

                } else {
                    $column_size = 6;
                }


                foreach ($boxes as $row) {


                    ?>
                    <div class="col-md-<?php echo $column_size ?>">
                        <div class="panel smartlib-center-align smartlib-counter-box">
                            <div class="smartlib-inside-box">
                        <span class="smartlib-counter" data-from="1"
                              data-to="<?php echo $row['number'] ?>">0</span>

                                <p><?php echo $row['number_label'] ?></p>
                            </div>
                        </div>
                    </div>

                <?php

                }// end while
            }

            ?>

        </div>
    </div>
</div>