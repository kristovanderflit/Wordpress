<?php
/**
 * Feature Icons Section Partial
 */

//global variables
global $boxes, $title_feature_icons, $section_background, $limit;


$style_string = 'padding: 10px 0 40px 0;';

if(strlen($section_background)>0){

    $style_string .= 'background-color: '.$section_background;

}





?>
<div class="container-fluid smartlib-features-icons-section" style="<?php echo $style_string ?>">
<div class="container">
    <?php

    smartlib_get_frontpage_section_header($title_feature_icons);

    ?>



            <?php
            $i = 1;
            $j = 1;





            if (count($boxes)>0) {

                $columns_number_selection = 4;

                if ($columns_number_selection > 0) {

                    $columns_per_slide = 12 / $columns_number_selection;

                } else {
                    $columns_per_slide = 6;
                }


                foreach ($boxes as $row) {


                    if ($i == 1) {
                        ?>

                        <div class="row">
                    <?php
                    }
                    ?>
                    <div class="col-sm-<?php echo $columns_per_slide ?>">

                        <?php

                        if (isset($row['box_icon']) && strlen($row['box_icon']) > 0) {

                            ?>
                            <div class="media feature smartlib-animate-object" data-os-animation="fadeInLeft" data-os-animation-delay="<?php echo 1 *0.1 * $i.'s'; ?>">


                                    <a class="smartlib-icon smartlib-icon-large pull-right">
                                        <span style="font-size:40px"><i class="fa <?php echo $row['box_icon']; ?>"></i></span>
                                    </a>


                                <?php




                                ?>


                                <div class="media-body text-right">

                                    <h4 class="media-heading"><?php echo $row['box_title'] ?></h4>

                                    <p>
                                        <?php echo $row['box_description'] ?>
                                    </p>

                                </div>


                            </div>

                            <?php

                        }

                        ?>


                    </div>

                    <?php
                    if ($i % $columns_number_selection == 0 || $j == $limit) {
                        ?>
                        </div>

                        <?php
                        $i = 1;
                    } else {
                        $i++;
                    }

                    $j++;

                }// end while
            }

            ?>


</div>
</div>