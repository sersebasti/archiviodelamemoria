<?php
/**
 * WooCommerce Compatibility File.
 *
 * @package    ThemeGrill
 * @subpackage Colormag
 * @since      Colormag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function colormag_woocommerce_setup() {

	// Adding the WooCommerce plugin support.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

}

add_action( 'after_setup_theme', 'colormag_woocommerce_setup' );


/**
 * Filter body class for WooCommerce pages.
 *
 * @param array $classes CSS classes applied to the body tag.
 *
 * @return array Classes for WooCommerce pages.
 *
 * @since 2.2.8
 */
function colormag_woocommerce_body_class( $classes ) {

	$classes[] = 'woocommerce-active';

	$woocommerce_widgets_enabled            = get_theme_mod( 'colormag_woocommerce_sidebar_register_setting', 0 );
	$woocommerce_shop_page_layout           = get_theme_mod( 'colormag_woocmmerce_shop_page_layout', 'right_sidebar' );
	$woocommerce_archive_page_layout        = get_theme_mod( 'colormag_woocmmerce_archive_page_layout', 'right_sidebar' );
	$woocommerce_single_product_page_layout = get_theme_mod( 'colormag_woocmmerce_single_product_page_layout', 'right_sidebar' );

	if ( 1 == $woocommerce_widgets_enabled ) :
		if ( is_shop() ) {
			$classes[] = colormag_get_sidebar_layout_class( $woocommerce_shop_page_layout );
		} elseif ( is_product_category() || is_product_tag() ) {
			$classes[] = colormag_get_sidebar_layout_class( $woocommerce_archive_page_layout );
		} elseif ( is_product() ) {
			$classes[] = colormag_get_sidebar_layout_class( $woocommerce_single_product_page_layout );
		}
	endif;

	return $classes;

}

add_filter( 'body_class', 'colormag_woocommerce_body_class' );


if ( ! function_exists( 'colormag_woocommerce_sidebar_select' ) ) :

	/**
	 * Select different sidebars for WooCommerce pages as set by the user
	 * when extra WooCommerce widgets is enabled.
	 *
	 * @since 2.2.8
	 */
	function colormag_woocommerce_sidebar_select() {

		// Bail out if extra sidebar area for WooCommerce page is not activated.
		if ( 0 == get_theme_mod( 'colormag_woocommerce_sidebar_register_setting', 0 ) ) {
			return;
		}

		$woocommerce_shop_page_layout           = get_theme_mod( 'colormag_woocmmerce_shop_page_layout', 'right_sidebar' );
		$woocommerce_archive_page_layout        = get_theme_mod( 'colormag_woocmmerce_archive_page_layout', 'right_sidebar' );
		$woocommerce_single_product_page_layout = get_theme_mod( 'colormag_woocmmerce_single_product_page_layout', 'right_sidebar' );

		if ( is_shop() ) {
			colormag_get_sidebar( $woocommerce_shop_page_layout, false, 'woocommerce' );
		} elseif ( is_product_category() || is_product_tag() ) {
			colormag_get_sidebar( $woocommerce_archive_page_layout, false, 'woocommerce' );
		} elseif ( is_product() ) {
			colormag_get_sidebar( $woocommerce_single_product_page_layout, false, 'woocommerce' );
		}

	}

endif;


/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// Remove default WooCommerce breadcrumb.
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

// Remove WooCommerce default sidebar.
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Disable the page title display for WooCommerce pages.
add_filter( 'woocommerce_show_page_title', '__return_false' );

/**
 * Before Content.
 *
 * Wraps all WooCommerce content in wrappers which match the theme markup.
 *
 * @return void
 */
function colormag_wrapper_start() {
	echo '<div id="primary">';
}

add_action( 'woocommerce_before_main_content', 'colormag_wrapper_start', 10 );

/**
 * After Content.
 *
 * Closes the wrapping divs.
 *
 * @return void
 */
function colormag_wrapper_end() {
	echo '</div>';

	if ( 1 == get_theme_mod( 'colormag_woocommerce_sidebar_register_setting', 0 ) ) {
		colormag_woocommerce_sidebar_select();
	} else {
		colormag_sidebar_select();
	}
}

add_action( 'woocommerce_after_main_content', 'colormag_wrapper_end', 10 );
