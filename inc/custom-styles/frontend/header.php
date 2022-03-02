<?php

if( (isset($rebell_theme_options['sticky_header_background_color'])) && (trim($rebell_theme_options['sticky_header_background_color']) != "" ) ) {
	$custom_styles .= '
		.site-header
		{
			background: ' . esc_html($rebell_theme_options['sticky_header_background_color']) . ';
		}
	';
}	

if( (isset($rebell_theme_options['main_header_background']['background-color'])) ) {
	$custom_styles .= '
		@media only screen and (min-width: 63.9375em)
		{
			.site-header
			{
				background-color: ' . esc_html($rebell_theme_options['main_header_background']['background-color']) . ';
			}
		}
	';
}

if( (isset($rebell_theme_options['main_header_background']['background-image'])) && ($rebell_theme_options['main_header_background']['background-image']) != "" ) {
	$custom_styles .= '
		@media only screen and (min-width: 63.9375em)
		{
			.site-header
			{
				background-image:url(' . esc_url($rebell_theme_options['main_header_background']['background-image']) . ');
			}
		}
	';
}

if( (isset($rebell_theme_options['main_header_background']['background-repeat'])) ) {
	$custom_styles .= '
		@media only screen and (min-width: 63.9375em)
		{
			.site-header
			{
			background-repeat: ' . esc_html($rebell_theme_options['main_header_background']['background-repeat']) . ';
			}
		}
	';
}

if( (isset($rebell_theme_options['main_header_background']['background-position'])) ) {
	$custom_styles .= '
		@media only screen and (min-width: 63.9375em)
		{
			.site-header
			{
				background-position: ' . esc_html($rebell_theme_options['main_header_background']['background-position']) . ';
			}
		}
	';
}

if( (isset($rebell_theme_options['main_header_background']['background-size'])) ) {
	$custom_styles .= '
		@media only screen and (min-width: 63.9375em)
		{
			.site-header
			{
				background-size: ' . esc_html($rebell_theme_options['main_header_background']['background-size']) . ';
			}
		}
	';
}

if( (isset($rebell_theme_options['main_header_background']['background-attachment'])) ) {
	$custom_styles .= '
		@media only screen and (min-width: 63.9375em)
		{
			.site-header
			{
				background-attachment: ' . esc_html($rebell_theme_options['main_header_background']['background-attachment']) . ';
			}
		}
	';
}

$site_logo_height = 33;
if ( (isset($rebell_theme_options['site_logo'])) && (trim($rebell_theme_options['site_logo']) != "" ) ) {
	$site_logo_height = $rebell_theme_options['logo_height']; 
}

$content_margin = 0;
			
$page_id = "";
if ( is_single() || is_page() ) {
	$page_id = get_the_ID();
} else if ( is_home() ) {
	$page_id = get_option('page_for_posts');						
}
			
if ( 
((isset($rebell_theme_options['sticky_header'])) && (trim($rebell_theme_options['sticky_header']) == "1" )) || 
((isset($rebell_theme_options['main_header_transparency'])) && (trim($rebell_theme_options['main_header_transparency']) == "1" )) ||
((get_post_meta($page_id, 'page_header_transparency', true)) && (get_post_meta($page_id, 'page_header_transparency', true) != "inherit"))
) { 
	
	if ( isset($rebell_theme_options['main_header_layout']) ) {		
		if ( $rebell_theme_options['main_header_layout'] == "1" || $rebell_theme_options['main_header_layout'] == "11" ) {
			$content_margin = $content_margin + $site_top_bar_height + $site_logo_height + $rebell_theme_options['spacing_above_logo'] + $rebell_theme_options['spacing_below_logo'];
		} 		
		elseif ( $rebell_theme_options['main_header_layout'] == "2" || $rebell_theme_options['main_header_layout'] == "22" ) {
			$content_margin = $content_margin + $site_top_bar_height + $site_logo_height + $rebell_theme_options['spacing_above_logo'] + $rebell_theme_options['spacing_below_logo'];
		}
		elseif ( $rebell_theme_options['main_header_layout'] == "3" ) {
			$content_margin = $content_margin + $site_top_bar_height + $site_logo_height + $rebell_theme_options['spacing_above_logo'] + $rebell_theme_options['spacing_below_logo'] + 50;
		} 		
	}						
}

if( (isset($rebell_theme_options['header_width'])) && ($rebell_theme_options['header_width'] == "full") ) {
	$custom_styles .= '
		.site-header,
		#site-top-bar
		{
			padding-left: 20px;
			padding-right: 20px;
		}
	';
}

if( (isset($rebell_theme_options['site_logo'])) && (trim($rebell_theme_options['site_logo']) != "" ) ) {

	if( is_ssl() ) {
		$site_logo = str_replace("http://", "https://", $rebell_theme_options['site_logo']);
	} else {
		$site_logo = $rebell_theme_options['site_logo'];
	}

	if( (isset($rebell_theme_options['logo_height'])) && (trim($rebell_theme_options['logo_height']) != "" ) ) {
		$custom_styles .= '
			@media only screen and (min-width: 1024px)
			{
				.site-branding img
				{
					height: ' . esc_html($site_logo_height) . 'px;
					width: auto;
				    transition: all 0.3s;
				}
				
				.site-header .main-navigation,
				.site-header .site-tools
				{
					height: ' . esc_html($site_logo_height) . 'px;
					line-height: ' . esc_html($site_logo_height) . 'px;
				}
			}
		';
	}
}

if( (isset($rebell_theme_options['spacing_above_logo'])) && (trim($rebell_theme_options['spacing_above_logo']) != "" ) ) {
	$custom_styles .= '
		@media only screen and (min-width: 1024px)
		{
			.site-header
			{
				padding-top: ' . esc_html($rebell_theme_options['spacing_above_logo']) . 'px;
			}
		}
	';
}

if( (isset($rebell_theme_options['spacing_below_logo'])) && (trim($rebell_theme_options['spacing_below_logo']) != "" ) ) {
	$custom_styles .= '
		@media only screen and (min-width: 1024px)
		{
			.site-header
			{
				padding-bottom: ' . esc_html($rebell_theme_options['spacing_below_logo']) . 'px;
			}
		}
	';
}

$notification_top = $site_top_bar_height + $site_logo_height + $rebell_theme_options['spacing_above_logo'] + $rebell_theme_options['spacing_below_logo'];
if( is_admin_bar_showing() ) {
	$notification_top = $notification_top + 32;
} 

$custom_styles .= '
	@media only screen and (min-width: 63.9375em)
	{
		#page_wrapper.transparent_header .page-title-hidden .content-area,
		#page_wrapper.transparent_header .page-title-hidden > .row
		{
			padding-top: ' . esc_html($site_top_bar_height) . 'px;
		}

		#page_wrapper.transparent_header .content-area,
		#page_wrapper.sticky_header .content-area
		{
			padding-top: calc(' . $content_margin . 'px + 85px);
		}

		body.gbt_custom_notif .page-notifications
		{
			top: ' . $notification_top . 'px;
		}
		
		.transparent_header .single-post-header .title,
		#page_wrapper.transparent_header .shop_header .page-title,
		#page_wrapper.sticky_header:not(.transparent_header) .page-title-hidden .content-area
		{
			padding-top: ' . $content_margin . 'px;
		}
		
		.transparent_header .single-post-header.with-thumb .title
		{
			padding-top: ' . (200 + $content_margin) . 'px;
		}

		.transparent_header.sticky_header .page-title-shown .entry-header.with_featured_img,
		{
			margin-top: -' . ($content_margin + 85) . 'px;
		}

		.sticky_header .page-title-shown .entry-header.with_featured_img
		{
			margin-top: -' . $content_margin . 'px;
		}

		.page-template-default .transparent_header .entry-header.with_featured_img,
		.page-template-page-full-width .transparent_header .entry-header.with_featured_img
		{
			margin-top: -' . ($content_margin + 85) . 'px;
		}
	}
';

if( (isset($rebell_theme_options['main_header_font_size'])) && (trim($rebell_theme_options['main_header_font_size']) != "" ) ) {
	$custom_styles .= '
		.site-header,
		.default-navigation,
		.main-navigation .mega-menu > ul > li > a
		{
			font-size: ' . esc_html($rebell_theme_options['main_header_font_size']) . 'px;
		}
	';
}

if( (isset($rebell_theme_options['sticky_header_color'])) && (trim($rebell_theme_options['sticky_header_color']) != "" ) ) {
	$custom_styles .= '
		.site-header,
		.main-navigation a,
		.site-tools ul li a,
		.shopping_bag_items_number,
		.wishlist_items_number,
		.site-title a,
		.widget_product_search .search-but-added,
		.widget_search .search-but-added
		{
			color: ' . esc_html($rebell_theme_options['sticky_header_color']) . ';
		}

		.site-branding
		{
			border-color: ' . esc_html($rebell_theme_options['main_header_font_color']) . ';
		}
	';
}

if( (isset($rebell_theme_options['main_header_font_color'])) && (trim($rebell_theme_options['main_header_font_color']) != "" ) ) {
	$custom_styles .= '
		@media only screen and (min-width: 63.9375em)
		{
			.site-header,
			.main-navigation a,
			.site-tools ul li a,
			.shopping_bag_items_number,
			.wishlist_items_number,
			.site-title a,
			.widget_product_search .search-but-added,
			.widget_search .search-but-added
			{
				color: ' . esc_html($rebell_theme_options['main_header_font_color']) . ';
			}

			.site-branding
			{
				border-color: ' . esc_html($rebell_theme_options['main_header_font_color']) . ';
			}
		}
	';
}

if( (isset($rebell_theme_options['main_header_transparent_light_color'])) && (trim($rebell_theme_options['main_header_transparent_light_color']) != "" ) ) {
	$custom_styles .= '
		@media only screen and (min-width: 1024px)
		{
			#page_wrapper.transparent_header.transparency_light .site-header,
			#page_wrapper.transparent_header.transparency_light .site-header .main-navigation a,
			#page_wrapper.transparent_header.transparency_light .site-header .site-tools ul li a,
			#page_wrapper.transparent_header.transparency_light .site-header .shopping_bag_items_number,
			#page_wrapper.transparent_header.transparency_light .site-header .wishlist_items_number,
			#page_wrapper.transparent_header.transparency_light .site-header .site-title a,
			#page_wrapper.transparent_header.transparency_light .site-header .widget_product_search .search-but-added,
			#page_wrapper.transparent_header.transparency_light .site-header .widget_search .search-but-added
			{
				color: ' . esc_html($rebell_theme_options['main_header_transparent_light_color']) . ';
			}
		}
	';
}

if( (isset($rebell_theme_options['main_header_transparent_dark_color'])) && (trim($rebell_theme_options['main_header_transparent_dark_color']) != "" ) ) {
	$custom_styles .= '
		@media only screen and (min-width: 1024px)
		{
			#page_wrapper.transparent_header.transparency_dark .site-header,
			#page_wrapper.transparent_header.transparency_dark .site-header .main-navigation a,
			#page_wrapper.transparent_header.transparency_dark .site-header .site-tools ul li a,
			#page_wrapper.transparent_header.transparency_dark .site-header .shopping_bag_items_number,
			#page_wrapper.transparent_header.transparency_dark .site-header .wishlist_items_number,
			#page_wrapper.transparent_header.transparency_dark .site-header .site-title a,
			#page_wrapper.transparent_header.transparency_dark .site-header .widget_product_search .search-but-added,
			#page_wrapper.transparent_header.transparency_dark .site-header .widget_search .search-but-added
			{
				color: ' . esc_html($rebell_theme_options['main_header_transparent_dark_color']) . ';
			}
		}
	';
}

if( (isset($rebell_theme_options['sticky_header_background_color'])) && (trim($rebell_theme_options['sticky_header_background_color']) != "" ) ) {
	$custom_styles .= '
		@media only screen and (min-width: 63.9375em)
		{
			.site-header.sticky,
			#page_wrapper.transparent_header .site-header.sticky
			{
				background: ' . esc_html($rebell_theme_options['sticky_header_background_color']) . ';
			}
		}
	';
}

if( (isset($rebell_theme_options['sticky_header_color'])) && (trim($rebell_theme_options['sticky_header_color']) != "" ) ) {
	$custom_styles .= '
		@media only screen and (min-width: 63.9375em)
		{
			.site-header.sticky,
			.site-header.sticky .main-navigation a,
			.site-header.sticky .site-tools ul li a,
			.site-header.sticky .shopping_bag_items_number,
			.site-header.sticky .wishlist_items_number,
			.site-header.sticky .site-title a,
			.site-header.sticky .widget_product_search .search-but-added,
			.site-header.sticky .widget_search .search-but-added,
			#page_wrapper.transparent_header .site-header.sticky,
			#page_wrapper.transparent_header .site-header.sticky .main-navigation a,
			#page_wrapper.transparent_header .site-header.sticky .site-tools ul li a,
			#page_wrapper.transparent_header .site-header.sticky .shopping_bag_items_number,
			#page_wrapper.transparent_header .site-header.sticky .wishlist_items_number,
			#page_wrapper.transparent_header .site-header.sticky .site-title a,
			#page_wrapper.transparent_header .site-header.sticky .widget_product_search .search-but-added,
			#page_wrapper.transparent_header .site-header.sticky .widget_search .search-but-added
			{
				color: ' . esc_html($rebell_theme_options['sticky_header_color']) . ';
			}
			
			.site-header.sticky .site-branding
			{
				border-color: ' . esc_html($rebell_theme_options['sticky_header_color']) . ';
			}
		}
	';
}

if ( (isset($rebell_theme_options['main_header_wishlist'])) && 	(isset($rebell_theme_options['main_header_shopping_bag'])) && 
	(isset($rebell_theme_options['main_header_search_bar'])) && (isset($rebell_theme_options['main_header_off_canvas'])) && 
	($rebell_theme_options['main_header_wishlist'] == "0") && ($rebell_theme_options['main_header_shopping_bag'] == "0") && 
	($rebell_theme_options['main_header_search_bar'] == "0") && ($rebell_theme_options['main_header_off_canvas'] == "0") ) { 
		
		$custom_styles .= '.site-tools { margin:0; }';
}

if( (isset($rebell_theme_options['sticky_header_logo'])) && (trim($rebell_theme_options['sticky_header_logo']) != "" ) ) {
	$custom_styles .= '
		@media only screen and (max-width: 63.95em)
		{
			.site-logo
			{
				display: none;
			}

			.sticky-logo
			{
				display: block;
			}
		}
	';
}

/* header-centered-2-menus */

if( (isset($rebell_theme_options['main_header_layout'])) && ($rebell_theme_options['main_header_layout'] == "2" || $rebell_theme_options['main_header_layout'] == "22") ) {

	$header_col_right_menu_right_padding = 0;
	
	if ( (isset($rebell_theme_options['main_header_wishlist'])) && ($rebell_theme_options['main_header_wishlist'] == "1") ) $header_col_right_menu_right_padding += 60;
	if ( (isset($rebell_theme_options['main_header_shopping_bag'])) && ($rebell_theme_options['main_header_shopping_bag'] == "1") ) $header_col_right_menu_right_padding += 60;
	if ( (isset($rebell_theme_options['main_header_search_bar'])) && ($rebell_theme_options['main_header_search_bar'] == "1") ) $header_col_right_menu_right_padding += 40;
	if ( (isset($rebell_theme_options['main_header_off_canvas'])) && ($rebell_theme_options['main_header_off_canvas'] == "1") ) $header_col_right_menu_right_padding += 40;
	
	$custom_styles .= '
		.header_col.right_menu
		{
			padding-right: ' . esc_html($header_col_right_menu_right_padding) . 'px;
		}
		
		.rtl .header_col.right_menu
		{
			padding-right: 0;
		}

		.rtl .header_col.left_menu
		{
			padding-left: ' . esc_html($header_col_right_menu_right_padding) . 'px;
		}

		.site-header .site-tools
		{
			height: 30px !important;
			position: absolute;
			top: 2px;
			right: 0;
		}
	';
	
	if( (isset($rebell_theme_options['main_header_layout'])) && ($rebell_theme_options['main_header_layout'] == "2") ) {
		$custom_styles .= '
			.header_col.left_menu .main-navigation
			{
				text-align: right !important;
				margin: 0 -15px !important;
			}

			.header_col.right_menu .main-navigation
			{
				text-align: left !important;
				margin: 0 -15px !important;
			}
		';
	}
	
	if ( (isset($rebell_theme_options['main_header_layout'])) && ($rebell_theme_options['main_header_layout'] == "22") ) {
		$custom_styles .= '
			.header_col.left_menu .main-navigation
			{
				text-align: left !important;
				margin: 0 -15px !important;
			}

			.header_col.right_menu .main-navigation
			{
				text-align: right !important;
				margin: 0 -15px !important;
			}
		';
	}
	
	if( (isset($rebell_theme_options['logo_min_height'])) && (trim($rebell_theme_options['logo_min_height']) != "" ) ) {
		$custom_styles .= '
			.header_col.branding
			{
				min-width: ' . esc_html($rebell_theme_options['logo_min_height']) . 'px;
			}
		';
	}

}

/* header-centered-menu-under */

if( (isset($rebell_theme_options['main_header_layout'])) && ($rebell_theme_options['main_header_layout'] == "3") ) {

	$custom_styles .= '
		.main-navigation
		{
			text-align: center !important;
		}
		
		.site-header .main-navigation
		{
			height: 50px !important;
			line-height: 50px !important;
			margin: 10px auto -10px auto;
		}
		
		.site-header .site-tools
		{
			height: 30px !important;
			line-height: 30px !important;
			position: absolute;
			top: 2px;
			right: 0;
		}
	';
}

$mt = 85 + 46 + $rebell_theme_options['spacing_above_logo'] + $rebell_theme_options['spacing_below_logo'];

$custom_styles .= '
	.transparent_header .with-featured-img
	{
		margin-top: -' . esc_html( $mt ) . 'px;
	}
';

?>