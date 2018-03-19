<?php
/**
 * BootFrame home template file.
 *
 *
 *
 * @since      BootFrame 1.0
 */

define('SMARTLIB_CONTENT_TYPE', 'blog_loop');

get_header();

do_action('smartlib_archive_header');

?>

<?php if (have_posts()) : ?>

	<section class="smartlib-content-section container">
	<div id="page" role="main" class="<?php smartlib_layout_class('smartlib-page-area', 'blog_loop') ?>">
	<?php
	/* Start the Loop */
	while (have_posts()) : the_post();
		get_template_part('views/content-loop', smartlib_get_loop_variant());
	endwhile;
	?>

	<?php
	smartlib_list_pagination('nav-below');
	?>

<?php else : ?>
	<?php get_template_part('views/content', 'none'); ?>
<?php endif; ?>


	</div><!-- #page -->

<?php

get_sidebar(smartlib_get_sidebar_template('default', SMARTLIB_CONTENT_TYPE));

?>
</section>

<?php get_footer(); ?>