<?php
/**
 * Our Clients Section Partial
 */

//global variables
global $boxes, $title_our_clients, $section_background, $limit;


$style_string = 'padding: 10px 0 40px 0;';

$style_string .= 'background-color: '.$section_background;



?>
<div class="container-fluid smartlib-our-clients-section" style="<?php echo $style_string ?>">
<div class="container">
    <?php

    smartlib_get_frontpage_section_header($title_our_clients);

    ?>


    <div class="panel-body smartlib-inside-box">
        <div class="row">
            <?php
            $i = 1;
            $j = 1;



            if (count($boxes)>0) {

                $columns_number_selection = 6;

                if ($columns_number_selection > 0) {

                    $columns_per_slide = 12 / $columns_number_selection;

                } else {
                    $columns_per_slide = 6;
                }


                foreach ($boxes as $row) {


                ?>
                    <div class="col-sm-<?php echo $columns_per_slide ?> text-center">

                        <?php

                        if (isset($row['box_image']) && strlen($row['box_image']) > 0) {

                            if (strlen($row['box_link']) > 0) {

                                ?>

                                <a href="<?php echo $row['box_link'] ?>">

                            <?php
                            }

                            if(is_numeric($row['box_image'])){
                                echo wp_get_attachment_image($row['box_image'], 'thumbnail');
                            }else{
                                ?>
                                <img src="<?php echo $row['box_image'] ?>" />
                                <?php
                            }



                            ?>

                            <?php

                            if (strlen($row['box_link']) > 0) {

                                ?>

                                </a>

                            <?php
                            }
                        }
                        ?>


                    </div>

                    <?php

                    $j++;

                }// end while
            }

            ?>

        </div>
    </div>
</div>
</div>