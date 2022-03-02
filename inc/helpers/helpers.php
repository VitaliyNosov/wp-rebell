<?php

// -----------------------------------------------------------------------------
// String to Slug
// -----------------------------------------------------------------------------

if ( ! function_exists( 'getbowtied_string_to_slug' ) ) :
function getbowtied_string_to_slug($str) {
	$str = strtolower(trim($str));
	$str = preg_replace('/[^a-z0-9-]/', '_', $str);
	$str = preg_replace('/-+/', "_", $str);
	return $str;
}
endif;

// -----------------------------------------------------------------------------
// Theme Name
// -----------------------------------------------------------------------------

if ( ! function_exists( 'getbowtied_theme_name' ) ) :
function getbowtied_theme_name() {
	$getbowtied_theme = wp_get_theme();
	return $getbowtied_theme->get('Name');
}
endif;

// -----------------------------------------------------------------------------
// Theme Name
// -----------------------------------------------------------------------------

if ( ! function_exists( 'getbowtied_parent_theme_name' ) ) :
function getbowtied_parent_theme_name()
{
	$theme = wp_get_theme();
	if ($theme->parent()):
		$theme_name = $theme->parent()->get('Name');
	else:
		$theme_name = $theme->get('Name');
	endif;

	return $theme_name;
}
endif;

// -----------------------------------------------------------------------------
// Theme Slug
// -----------------------------------------------------------------------------

if ( ! function_exists( 'getbowtied_theme_slug' ) ) :
function getbowtied_theme_slug() {
	$getbowtied_theme = wp_get_theme();
	return getbowtied_string_to_slug( $getbowtied_theme->get('Name') );
}
endif;


// -----------------------------------------------------------------------------
// Theme Author
// -----------------------------------------------------------------------------

if ( ! function_exists( 'getbowtied_theme_author' ) ) :
function getbowtied_theme_author() {
	$getbowtied_theme = wp_get_theme();
	return $getbowtied_theme->get('Author');
}
endif;

// -----------------------------------------------------------------------------
// Theme Description
// -----------------------------------------------------------------------------

if ( ! function_exists( 'getbowtied_theme_description' ) ) :
function getbowtied_theme_description() {
	$getbowtied_theme = wp_get_theme();
	return $getbowtied_theme->get('Description');
}
endif;


// -----------------------------------------------------------------------------
// Theme Version
// -----------------------------------------------------------------------------

if ( ! function_exists( 'getbowtied_theme_version' ) ) :
function getbowtied_theme_version() {
	$getbowtied_theme = wp_get_theme(get_template());
	return $getbowtied_theme->get('Version');
}
endif;


// -----------------------------------------------------------------------------
// Converts HEX to RGB
// -----------------------------------------------------------------------------

function getbowtied_hex2rgb($hex) {

	$hex = str_replace("#", "", $hex);
	
	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);

	return implode(",", $rgb); // returns the rgb values separated by commas
}

// -----------------------------------------------------------------------------
// Woocommerce Active
// -----------------------------------------------------------------------------

define( 'GETBOWTIED_WOOCOMMERCE_IS_ACTIVE', class_exists( 'WooCommerce' ) );

// -----------------------------------------------------------------------------
// German Market Active
// -----------------------------------------------------------------------------

define( 'GETBOWTIED_GERMAN_MARKET_IS_ACTIVE', class_exists( 'Woocommerce_German_Market' ) );

// -----------------------------------------------------------------------------
// Woocommerce Germanized Active
// -----------------------------------------------------------------------------

define( 'GETBOWTIED_WOOCOMMERCE_GERMANIZED_IS_ACTIVE', class_exists( 'WooCommerce_Germanized' ) );

// -----------------------------------------------------------------------------
// Dokan Multivendor
// ----------------------------------------------------------------------------

define( 'GETBOWTIED_DOKAN_MULTIVENDOR_IS_ACTIVE', class_exists( 'WeDevs_Dokan' ) );

// -----------------------------------------------------------------------------
// Woocommerce Product Addons
// -----------------------------------------------------------------------------

define( 'GETBOWTIED_WOOCOMMERCE_PRODUCT_ADDONS_IS_ACTIVE', class_exists( 'WC_Product_Addons' ) );

// -----------------------------------------------------------------------------
// Woocommerce Yith Wishlist
// -----------------------------------------------------------------------------

define( 'GETBOWTIED_WOOCOMMERCE_WISHLIST_IS_ACTIVE', class_exists( 'YITH_WCWL_Init' ) );

// -----------------------------------------------------------------------------
// Woocommerce Sale Flash Pro
// -----------------------------------------------------------------------------

define( 'GETBOWTIED_WOOCOMMERCE_SALE_FLASH_PRO_IS_ACTIVE', class_exists( 'WC_Sale_Flash_Pro' ) );