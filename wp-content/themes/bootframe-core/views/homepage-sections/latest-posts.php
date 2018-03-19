<?php
/**
 * Latest Posts Section Partial
 */

//global variables
global $posts_array, $title_last_post;



?>
<div class="container smartlib-latest-posts-section">

    <?php

        smartlib_get_frontpage_section_header($title_last_post);

    /**
     * Latest News Loop
     */

    if ($posts_array->have_posts()) {
        ?>
        <ul class="smartlib-layout-list smartlib-column-list smartlib-4-columns-list">
            <?php

            while ($posts_array->have_posts()):$posts_array->the_post();

                ?>

                <li>
                    <div class="panel smartlib-inside-box smartlib-widget">
                        <?php smartlib_post_thumbnail_block('smartlib-large-thumb', 'default') ?>

                        <div class="panel-body">
                            <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>

                            <p><?php the_excerpt() ?></p>
                            <a href="<?php the_permalink() ?>"
                               class="btn btn-primary"><?php _e('Read more', 'bootframe-core'); ?></a>
                        	<span class="pull-right">
											<?php do_action('smartlib_comments_count', 'default'); ?>
										</span>
                        </div>
                    </div>

                </li>
            <?php


            endwhile;
            ?>
        </ul>
    <?php

    }

    wp_reset_postdata();

    ?>
</div>