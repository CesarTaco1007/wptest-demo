<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<div id="primary" <?php jumadi_content_class();?>>
		<main id="main" <?php jumadi_main_class(); ?>>
			<?php
			/**
			 * jumadi_before_main_content hook.
			 *
			 */
			do_action( 'jumadi_before_main_content' );

			while ( have_posts() ) : the_post();

				get_template_part( 'content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || '0' != get_comments_number() ) : ?>

					<div class="comments-area">
						<?php comments_template(); ?>
					</div>

				<?php endif;

			endwhile;

			/**
			 * jumadi_after_main_content hook.
			 *
			 */
			do_action( 'jumadi_after_main_content' );
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	/**
	 * jumadi_after_primary_content_area hook.
	 *
	 */
	 do_action( 'jumadi_after_primary_content_area' );

	 jumadi_construct_sidebars();

get_footer();
