<?php
/**
 * Template name: Page Landing
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brightech
 */
?>

<?php get_header(); ?>

	<div id="primary" class="site__main">
		
		<div class="site__width">
			<h1><?php echo get_the_title( get_the_ID() ); ?></h1>
		</div>
		<?php if ( have_posts() ) : ?>

			<?php get_template_part( 'template-parts/blocks/block-contact-info', '' ); ?>
			<?php get_template_part( 'template-parts/blocks/block-contact-map', '' ); ?>
			<?php get_template_part( 'template-parts/blocks/block-contact-form', '' ); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

	</div><!-- #primary -->

<?php get_footer(); ?>
