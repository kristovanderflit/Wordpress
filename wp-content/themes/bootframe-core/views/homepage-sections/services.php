<?php
/**
 * Services Section Partial
 */

//global variables
global $boxes, $title_features;



?>
<div class="container smartlib-services-section">

    <?php

    smartlib_get_frontpage_section_header($title_features);

    $i = 1;
    foreach ($boxes as $row) {

        ?>
        <div class="col-lg-3 col-sm-6 smartlib-service-box-<?php echo $i ?>">

            <div class="panel smartlib-center-align smartlib-widget smartlib-icon-feture-box">
            <span class="widget-image-outer">
                 <?php

                if(is_numeric($row['smartlib_service_box_image'])) {

                    echo wp_get_attachment_image($row['smartlib_service_box_image'], 'thumbnail');

                }else if (strlen($row['smartlib_service_box_image'])) {

                    ?>
                    <img src="<?php echo $row['smartlib_service_box_image'] ?>"
                         alt="<?php echo esc_html($row['smartlib_service_box_title']); ?>" width="150" height="150" />

                <?php

                }

                ?>
            </span>

                <div class="panel-body">
                    <h4><?php echo $row['smartlib_service_box_title'] ?></h4>

                    <p class="description-widget">
                        <?php echo $row['smartlib_service_box_text'] ?>
                    </p>

                    <a href="<?php echo $row['smartlib_service_box_button_url'] ?>" class="btn btn-default">
                        <?php echo $row['smartlib_service_box_button_label'] ?>
                    </a>
                </div>
            </div>

        </div>
        <?php



        $i++;
    }

    ?>
</div>