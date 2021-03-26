<?php
/**
 * Builds our admin page.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'jumadi_create_menu' ) ) {
	add_action( 'admin_menu', 'jumadi_create_menu' );
	/**
	 * Adds our "Jumadi" dashboard menu item
	 *
	 */
	function jumadi_create_menu() {
		$jumadi_page = add_theme_page( 'Jumadi', 'Jumadi', apply_filters( 'jumadi_dashboard_page_capability', 'edit_theme_options' ), 'jumadi-options', 'jumadi_settings_page' );
		add_action( "admin_print_styles-$jumadi_page", 'jumadi_options_styles' );
	}
}

if ( ! function_exists( 'jumadi_options_styles' ) ) {
	/**
	 * Adds any necessary scripts to the Jumadi dashboard page
	 *
	 */
	function jumadi_options_styles() {
		wp_enqueue_style( 'jumadi-options', get_template_directory_uri() . '/css/admin/admin-style.css', array(), JUMADI_VERSION );
	}
}

if ( ! function_exists( 'jumadi_settings_page' ) ) {
	/**
	 * Builds the content of our Jumadi dashboard page
	 *
	 */
	function jumadi_settings_page() {
		?>
		<div class="wrap">
			<div class="metabox-holder">
				<div class="jumadi-masthead clearfix">
					<div class="jumadi-container">
						<div class="jumadi-title">
							<a href="<?php echo esc_url(JUMADI_THEME_URL); ?>" target="_blank"><?php esc_html_e( 'Jumadi', 'jumadi' ); ?></a> <span class="jumadi-version"><?php echo esc_html( JUMADI_VERSION ); ?></span>
						</div>
						<div class="jumadi-masthead-links">
							<?php if ( ! defined( 'JUMADI_PREMIUM_VERSION' ) ) : ?>
								<a class="jumadi-masthead-links-bold" href="<?php echo esc_url(JUMADI_THEME_URL); ?>" target="_blank"><?php esc_html_e( 'Premium', 'jumadi' );?></a>
							<?php endif; ?>
							<a href="<?php echo esc_url(JUMADI_WPKOI_AUTHOR_URL); ?>" target="_blank"><?php esc_html_e( 'WPKoi', 'jumadi' ); ?></a>
                            <a href="<?php echo esc_url(JUMADI_DOCUMENTATION); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'jumadi' ); ?></a>
						</div>
					</div>
				</div>

				<?php
				/**
				 * jumadi_dashboard_after_header hook.
				 *
				 */
				 do_action( 'jumadi_dashboard_after_header' );
				 ?>

				<div class="jumadi-container">
					<div class="postbox-container clearfix" style="float: none;">
						<div class="grid-container grid-parent">

							<?php
							/**
							 * jumadi_dashboard_inside_container hook.
							 *
							 */
							 do_action( 'jumadi_dashboard_inside_container' );
							 ?>

							<div class="form-metabox grid-70" style="padding-left: 0;">
								<h2 style="height:0;margin:0;"><!-- admin notices below this element --></h2>
								<form method="post" action="options.php">
									<?php settings_fields( 'jumadi-settings-group' ); ?>
									<?php do_settings_sections( 'jumadi-settings-group' ); ?>
									<div class="customize-button hide-on-desktop">
										<?php
										printf( '<a id="jumadi_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
											esc_url( admin_url( 'customize.php' ) ),
											esc_html__( 'Customize', 'jumadi' )
										);
										?>
									</div>

									<?php
									/**
									 * jumadi_inside_options_form hook.
									 *
									 */
									 do_action( 'jumadi_inside_options_form' );
									 ?>
								</form>

								<?php
								$modules = array(
									'Backgrounds' => array(
											'url' => JUMADI_THEME_URL,
									),
									'Blog' => array(
											'url' => JUMADI_THEME_URL,
									),
									'Colors' => array(
											'url' => JUMADI_THEME_URL,
									),
									'Copyright' => array(
											'url' => JUMADI_THEME_URL,
									),
									'Disable Elements' => array(
											'url' => JUMADI_THEME_URL,
									),
									'Demo Import' => array(
											'url' => JUMADI_THEME_URL,
									),
									'Hooks' => array(
											'url' => JUMADI_THEME_URL,
									),
									'Import / Export' => array(
											'url' => JUMADI_THEME_URL,
									),
									'Menu Plus' => array(
											'url' => JUMADI_THEME_URL,
									),
									'Page Header' => array(
											'url' => JUMADI_THEME_URL,
									),
									'Secondary Nav' => array(
											'url' => JUMADI_THEME_URL,
									),
									'Spacing' => array(
											'url' => JUMADI_THEME_URL,
									),
									'Typography' => array(
											'url' => JUMADI_THEME_URL,
									),
									'Elementor Addon' => array(
											'url' => JUMADI_THEME_URL,
									)
								);

								if ( ! defined( 'JUMADI_PREMIUM_VERSION' ) ) : ?>
									<div class="postbox jumadi-metabox">
										<h3 class="hndle"><?php esc_html_e( 'Premium Modules', 'jumadi' ); ?></h3>
										<div class="inside" style="margin:0;padding:0;">
											<div class="premium-addons">
												<?php foreach( $modules as $module => $info ) { ?>
												<div class="add-on activated jumadi-clear addon-container grid-parent">
													<div class="addon-name column-addon-name" style="">
														<a href="<?php echo esc_url( $info[ 'url' ] ); ?>" target="_blank"><?php echo esc_html( $module ); ?></a>
													</div>
													<div class="addon-action addon-addon-action" style="text-align:right;">
														<a href="<?php echo esc_url( $info[ 'url' ] ); ?>" target="_blank"><?php esc_html_e( 'More info', 'jumadi' ); ?></a>
													</div>
												</div>
												<div class="jumadi-clear"></div>
												<?php } ?>
											</div>
										</div>
									</div>
								<?php
								endif;

								/**
								 * jumadi_options_items hook.
								 *
								 */
								do_action( 'jumadi_options_items' );
								?>
							</div>

							<div class="jumadi-right-sidebar grid-30" style="padding-right: 0;">
								<div class="customize-button hide-on-mobile">
									<?php
									printf( '<a id="jumadi_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
										esc_url( admin_url( 'customize.php' ) ),
										esc_html__( 'Customize', 'jumadi' )
									);
									?>
								</div>

								<?php
								/**
								 * jumadi_admin_right_panel hook.
								 *
								 */
								 do_action( 'jumadi_admin_right_panel' );

								  ?>
                                
                                <div class="wpkoi-doc">
                                	<h3><?php esc_html_e( 'Jumadi documentation', 'jumadi' ); ?></h3>
                                	<p><?php esc_html_e( 'If You`ve stuck, the documentation may help on WPKoi.com', 'jumadi' ); ?></p>
                                    <a href="<?php echo esc_url(JUMADI_DOCUMENTATION); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Jumadi documentation', 'jumadi' ); ?></a>
                                </div>
                                
                                <div class="wpkoi-social">
                                	<h3><?php esc_html_e( 'WPKoi on Facebook', 'jumadi' ); ?></h3>
                                	<p><?php esc_html_e( 'If You want to get useful info about WordPress and the theme, follow WPKoi on Facebook.', 'jumadi' ); ?></p>
                                    <a href="<?php echo esc_url(JUMADI_WPKOI_SOCIAL_URL); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Go to Facebook', 'jumadi' ); ?></a>
                                </div>
                                
                                <div class="wpkoi-review">
                                	<h3><?php esc_html_e( 'Help with You review', 'jumadi' ); ?></h3>
                                	<p><?php esc_html_e( 'If You like Jumadi theme, show it to the world with Your review. Your feedback helps a lot.', 'jumadi' ); ?></p>
                                    <a href="<?php echo esc_url(JUMADI_WORDPRESS_REVIEW); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Add my review', 'jumadi' ); ?></a>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'jumadi_admin_errors' ) ) {
	add_action( 'admin_notices', 'jumadi_admin_errors' );
	/**
	 * Add our admin notices
	 *
	 */
	function jumadi_admin_errors() {
		$screen = get_current_screen();

		if ( 'appearance_page_jumadi-options' !== $screen->base ) {
			return;
		}

		if ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) {
			 add_settings_error( 'jumadi-notices', 'true', esc_html__( 'Settings saved.', 'jumadi' ), 'updated' );
		}

		if ( isset( $_GET['status'] ) && 'imported' == $_GET['status'] ) {
			 add_settings_error( 'jumadi-notices', 'imported', esc_html__( 'Import successful.', 'jumadi' ), 'updated' );
		}

		if ( isset( $_GET['status'] ) && 'reset' == $_GET['status'] ) {
			 add_settings_error( 'jumadi-notices', 'reset', esc_html__( 'Settings removed.', 'jumadi' ), 'updated' );
		}

		settings_errors( 'jumadi-notices' );
	}
}
