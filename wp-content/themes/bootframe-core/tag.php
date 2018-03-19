<?php
/**
 * The template for displaying Archive pages.
 */

get_header();

define('SMARTLIB_CONTENT_TYPE', 'blog_loop');

?>
	<section class="smartlib-content-section container">

		<?php do_action('smartlib_breadcrumb'); ?>

		<header class="archive-header smartlib-above-content-header">

			<h1 class="archive-title">
				<?php printf(__('Tag Archives: %s', 'bootframe-core'), '<span>' . single_tag_title('', false) . '</span>'); ?>
			</h1>

			<?php if (category_description()) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
			<?php endif; ?>

		</header><!-- .archive-header -->
	</section>

<?php if (have_posts()) : ?>

	<section class="smartlib-content-section container">
	<div id="page" role="main" class="<?php smartlib_layout_class('col-sm-16 col-md-12', SMARTLIB_CONTENT_TYPE) ?>">
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