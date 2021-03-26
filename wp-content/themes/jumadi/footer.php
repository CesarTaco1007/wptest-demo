<?php
/**
 * The template for displaying the footer.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

	</div><!-- #content -->
</div><!-- #page -->

<?php
/**
 * jumadi_before_footer hook.
 *
 */
do_action( 'jumadi_before_footer' );
?>

<div <?php jumadi_footer_class(); ?>>
	<?php
	/**
	 * jumadi_before_footer_content hook.
	 *
	 */
	do_action( 'jumadi_before_footer_content' );

	/**
	 * jumadi_footer hook.
	 *
	 *
	 * @hooked jumadi_construct_footer_widgets - 5
	 * @hooked jumadi_construct_footer - 10
	 */
	do_action( 'jumadi_footer' );

	/**
	 * jumadi_after_footer_content hook.
	 *
	 */
	do_action( 'jumadi_after_footer_content' );
	?>
</div><!-- .site-footer -->

<?php
/**
 * jumadi_after_footer hook.
 *
 */
do_action( 'jumadi_after_footer' );

wp_footer();
?>

</body>
</html>
