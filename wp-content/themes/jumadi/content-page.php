<?php
/**
 * The template used for displaying page content in page.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php jumadi_article_schema( 'CreativeWork' ); ?>>
	<div class="inside-article">
		<?php
		/**
		 * jumadi_before_content hook.
		 *
		 *
		 * @hooked jumadi_featured_page_header_inside_single - 10
		 */
		do_action( 'jumadi_before_content' );

		if ( jumadi_show_title() ) : ?>

			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
			</header><!-- .entry-header -->

		<?php endif;

		/**
		 * jumadi_after_entry_header hook.
		 *
		 *
		 * @hooked jumadi_post_image - 10
		 */
		do_action( 'jumadi_after_entry_header' );
		?>

		<div class="entry-content" itemprop="text">
			<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'jumadi' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->

		<?php
		/**
		 * jumadi_after_content hook.
		 *
		 */
		do_action( 'jumadi_after_content' );
		?>
	</div><!-- .inside-article -->
</article><!-- #post-## -->
