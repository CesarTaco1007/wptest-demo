<?php
/**
 * Helper functions for the Customizer.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'jumadi_is_posts_page' ) ) {
	/**
	 * Check to see if we're on a posts page
	 *
	 */
	function jumadi_is_posts_page() {
		return ( is_home() || is_archive() || is_tax() ) ? true : false;
	}
}

if ( ! function_exists( 'jumadi_is_side_padding_active' ) ) {
	/**
	 * Check to see if we're using our footer bar widget
	 *
	 */
	function jumadi_is_side_padding_active() {
		$jumadi_settings = wp_parse_args(
			get_option( 'jumadi_spacing_settings', array() ),
			jumadi_spacing_get_defaults()
		);
		
		if ( ( $jumadi_settings[ 'side_top' ] == 0 ) && ( $jumadi_settings[ 'side_right' ] == 0 ) && ( $jumadi_settings[ 'side_bottom' ] == 0 ) && ( $jumadi_settings[ 'side_left' ] == 0 ) ) {
			return false;
		}
	}
}


if ( ! function_exists( 'jumadi_is_footer_bar_active' ) ) {
	/**
	 * Check to see if we're using our footer bar widget
	 *
	 */
	function jumadi_is_footer_bar_active() {
		return ( is_active_sidebar( 'footer-bar' ) ) ? true : false;
	}
}

if ( ! function_exists( 'jumadi_is_top_bar_active' ) ) {
	/**
	 * Check to see if the top bar is active
	 *
	 */
	function jumadi_is_top_bar_active() {
		$top_bar_sidebar = is_active_sidebar( 'top-bar' ) ? true : false;
		$top_bar_socials = jumadi_get_setting( 'socials_display_top' );
		$top_bar = false;
		if ( ( $top_bar_sidebar == true ) || ( $top_bar_socials == true ) ) {
			$top_bar = true;
		}
		return apply_filters( 'jumadi_is_top_bar_active', $top_bar );
	}
}

if ( ! function_exists( 'jumadi_hidden_navigation' ) && function_exists( 'is_customize_preview' ) ) {
	add_action( 'wp_footer', 'jumadi_hidden_navigation' );
	/**
	 * Adds a hidden navigation if no navigation is set
	 * This allows us to use postMessage to position the navigation when it doesn't exist
	 *
	 */
	function jumadi_hidden_navigation() {
		if ( is_customize_preview() && function_exists( 'jumadi_navigation_position' ) ) {
			?>
			<div style="display:none;">
				<?php jumadi_navigation_position(); ?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'jumadi_customize_partial_blogname' ) ) {
	/**
	 * Render the site title for the selective refresh partial.
	 *
	 */
	function jumadi_customize_partial_blogname() {
		bloginfo( 'name' );
	}
}

if ( ! function_exists( 'jumadi_customize_partial_blogdescription' ) ) {
	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 */
	function jumadi_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}
}

if ( ! function_exists( 'jumadi_enqueue_color_palettes' ) ) {
	add_action( 'customize_controls_enqueue_scripts', 'jumadi_enqueue_color_palettes' );
	/**
	 * Add our custom color palettes to the color pickers in the Customizer.
	 *
	 */
	function jumadi_enqueue_color_palettes() {
		// Old versions of WP don't get nice things
		if ( ! function_exists( 'wp_add_inline_script' ) )
			return;

		// Grab our palette array and turn it into JS
		$palettes = json_encode( jumadi_get_default_color_palettes() );

		// Add our custom palettes
		// json_encode takes care of escaping
		wp_add_inline_script( 'wp-color-picker', 'jQuery.wp.wpColorPicker.prototype.options.palettes = ' . $palettes . ';' );
	}
}

if ( ! function_exists( 'jumadi_sanitize_integer' ) ) {
	/**
	 * Sanitize integers.
	 *
	 */
	function jumadi_sanitize_integer( $input ) {
		return absint( $input );
	}
}

if ( ! function_exists( 'jumadi_sanitize_decimal_integer' ) ) {
	/**
	 * Sanitize integers that can use decimals.
	 *
	 */
	function jumadi_sanitize_decimal_integer( $input ) {
		return abs( floatval( $input ) );
	}
}

if ( ! function_exists( 'jumadi_sanitize_checkbox' ) ) {
	/**
	 * Sanitize checkbox values.
	 *
	 */
	function jumadi_sanitize_checkbox( $checked ) {
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
}

if ( ! function_exists( 'jumadi_sanitize_blog_excerpt' ) ) {
	/**
	 * Sanitize blog excerpt.
	 * Needed because Jumadi Premium calls the control ID which is different from the settings ID.
	 *
	 */
	function jumadi_sanitize_blog_excerpt( $input ) {
	    $valid = array(
	        'full',
			'excerpt'
	    );

	    if ( in_array( $input, $valid ) ) {
	        return $input;
	    } else {
	        return 'full';
	    }
	}
}

if ( ! function_exists( 'jumadi_sanitize_hex_color' ) ) {
	/**
	 * Sanitize colors.
	 * Allow blank value.
	 *
	 */
	function jumadi_sanitize_hex_color( $color ) {
	    if ( '' === $color ) {
	        return '';
		}

	    // 3 or 6 hex digits, or the empty string.
	    if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
	        return $color;
		}

	    return '';
	}
}

if ( ! function_exists( 'jumadi_sanitize_choices' ) ) {
	/**
	 * Sanitize choices.
	 *
	 */
	function jumadi_sanitize_choices( $input, $setting ) {
		// Ensure input is a slug
		$input = sanitize_key( $input );

		// Get list of choices from the control
		// associated with the setting
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it;
		// otherwise, return the default
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
}

/**
 * Sanitize our Google Font variants
 *
 */
function jumadi_sanitize_variants( $input ) {
	if ( is_array( $input ) ) {
		$input = implode( ',', $input );
	}
	return sanitize_text_field( $input );
}

add_action( 'customize_controls_enqueue_scripts', 'jumadi_do_control_inline_scripts', 100 );
/**
 * Add misc inline scripts to our controls.
 *
 * We don't want to add these to the controls themselves, as they will be repeated
 * each time the control is initialized.
 *
 */
function jumadi_do_control_inline_scripts() {
	wp_localize_script( 'jumadi-typography-customizer', 'jumadi_customize', array( 'nonce' => wp_create_nonce( 'jumadi_customize_nonce' ) ) );
	wp_localize_script( 'jumadi-typography-customizer', 'typography_defaults', jumadi_typography_default_fonts() );
}

/**
 * Check to see if we have a logo or not.
 *
 * Used as an active callback. Calling has_custom_logo creates a PHP notice for
 * multisite users.
 *.1
 */
function jumadi_has_custom_logo_callback() {
	if ( get_theme_mod( 'custom_logo' ) ) {
		return true;
	}

	return false;
}
