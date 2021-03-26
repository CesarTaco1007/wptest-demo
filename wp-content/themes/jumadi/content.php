<?php
/**
 * The template for displaying posts within the loop.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php jumadi_article_schema( 'CreativeWork' ); ?>>
	<div class="inside-article">
    	<div class="article-holder">
		<?php
		/**
		 * jumadi_before_content hook.
		 *
		 *
		 * @hooked jumadi_featured_page_header_inside_single - 10
		 */
		do_action( 'jumadi_before_content' );
		?>

		<header class="entry-header">
			<?php
			/**
			 * jumadi_before_entry_title hook.
			 *
			 */
			do_action( 'jumadi_before_entry_title' );

			the_title( sprintf( '<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

			/**
			 * jumadi_after_entry_title hook.
			 *
			 *
			 * @hooked jumadi_post_meta - 10
			 */
			do_action( 'jumadi_after_entry_title' );
			?>
		</header><!-- .entry-header -->

		<?php
		/**
		 * jumadi_after_entry_header hook.
		 *
		 *
		 * @hooked jumadi_post_image - 10
		 */
		do_action( 'jumadi_after_entry_header' );

		if ( jumadi_show_excerpt() ) : ?>

			<div class="entry-summary" itemprop="text">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->

		<?php else : ?>

			<div class="entry-content" itemprop="text">
				<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'jumadi' ),
					'after'  => '</div>',
				) );
				?>
			</div><!-- .entry-content -->

		<?php endif;

		/**
		 * jumadi_after_entry_content hook.
		 *
		 *
		 * @hooked jumadi_footer_meta - 10
		 */
		do_action( 'jumadi_after_entry_content' );

		/**
		 * jumadi_after_content hook.
		 *
		 */
		do_action( 'jumadi_after_content' );
		?>
        </div>
	</div><!-- .inside-article -->
</article><!-- #post-## -->
