<div class="smartlib-article-box smartlib-article-column-box">
    <div class="row">
        <div class="col-md-7">
            <?php the_post_thumbnail('smartlib-medium-image-portfolio', array('class' => 'img-responsive img-hover', 'alt' => get_the_title()));
            $src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
            ?>
        </div>

        <div class="col-md-5">

            <h3>
                <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
            </h3>
            <?php

            $terms = wp_get_post_terms($post->ID, 'portfolio_skills');

            ?>
            <ul class="smartlib-portfolio-details smartlib-layout-list">
                <?php
                if (count($terms) > 0) {
                    ?>
                    <li>
                        <h4><?php _e('Skills:', 'bootframe-core') ?></h4>

                        <ul class="list-unstyled list-inline">
                            <?php
                            foreach ($terms as $term) {
                                ?>
                                <li><i class="fa fa-check-circle"></i> <?php echo $term->name ?>
                                </li>
                            <?php
                            }
                            ?>


                        </ul>
                    </li>
                <?php
                }

                $client = get_post_meta($post->ID, 'smartlib_client_name', true);

                if (strlen($client) > 0) {
                    ?>
                    <li>
                        <h4><?php _e('Client: ', 'bootframe-core') ?></h4>

                        <p><strong><?php echo $client ?></strong></p>
                    </li>
                <?php
                }
                ?>

                <p><?php the_excerpt() ?></p>

        </div>

    </div>
</div>