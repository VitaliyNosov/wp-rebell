<?php

if ( ! function_exists ('getbowtied_theme_option') ) {
	function getbowtied_theme_option( $name, $default = "" ) {
		return get_theme_mod( $name, $default );
	}
}

// Default fonts
global $default_fonts;

$default_fonts = array( 
    "Radnika"                                               => "Radnika",
    "NeueEinstellung"                                       => "NeueEinstellung",
    "Arial, Helvetica, sans-serif"                          => "Arial, Helvetica, sans-serif",
    "Arial Black, Gadget, sans-serif"                     	=> "Arial Black, Gadget, sans-serif",
    "Bookman Old Style, serif"                            	=> "Bookman Old Style, serif",
    "Comic Sans MS, cursive"                              	=> "Comic Sans MS, cursive",
    "Courier, monospace"                                    => "Courier, monospace",
    "Garamond, serif"                                       => "Garamond, serif",
    "Georgia, serif"                                        => "Georgia, serif",
    "Impact, Charcoal, sans-serif"                          => "Impact, Charcoal, sans-serif",
    "Lucida Console, Monaco, monospace"                   	=> "Lucida Console, Monaco, monospace",
    "Lucida Sans Unicode, 'Lucida Grande, sans-serif"    	=> "Lucida Sans Unicode, 'Lucida Grande, sans-serif",
    "MS Sans Serif, Geneva, sans-serif"                   	=> "MS Sans Serif, Geneva, sans-serif",
    "MS Serif, 'New York, sans-serif"                    	=> "MS Serif, 'New York, sans-serif",
    "Palatino Linotype, 'Book Antiqua, Palatino, serif"  	=> "Palatino Linotype, 'Book Antiqua, Palatino, serif",
    "Tahoma,Geneva, sans-serif"                             => "Tahoma,Geneva, sans-serif",
    "Times New Roman, Times,serif"                        	=> "Times New Roman, Times,serif",
    "Trebuchet MS, Helvetica, sans-serif"                 	=> "Trebuchet MS, Helvetica, sans-serif",
    "Verdana, Geneva, sans-serif"                           => "Verdana, Geneva, sans-serif"
);

add_action( 'wp_loaded', 'getbowtied_customizer_styles', 99 );
function getbowtied_customizer_styles(){

	global $rebell_theme_options;
	
	/* Header Styles */
	$rebell_theme_options['main_header_layout'] 						= getbowtied_theme_option('main_header_layout', 1);
	$rebell_theme_options['main_header_font_size'] 						= getbowtied_theme_option('main_header_font_size', 13);
	$rebell_theme_options['main_header_font_color'] 					= getbowtied_theme_option('main_header_font_color', '#000');
	$rebell_theme_options['main_header_transparency'] 					= getbowtied_theme_option('main_header_transparency', false);
	$rebell_theme_options['main_header_transparency_scheme'] 			= getbowtied_theme_option('main_header_transparency_scheme','transparency_light');
	$rebell_theme_options['shop_category_header_transparency_scheme'] 	= getbowtied_theme_option('shop_category_header_transparency_scheme', 'no_transparency');
	$rebell_theme_options['main_header_transparent_light_color'] 		= getbowtied_theme_option('main_header_transparent_light_color', '#fff');
	$rebell_theme_options['light_transparent_header_logo'] 				= getbowtied_theme_option('light_transparent_header_logo');
	$rebell_theme_options['main_header_transparent_dark_color'] 		= getbowtied_theme_option('main_header_transparent_dark_color', '#000');
	$rebell_theme_options['dark_transparent_header_logo'] 				= getbowtied_theme_option('dark_transparent_header_logo');
	$rebell_theme_options['main_header_background'] 					= getbowtied_theme_option('main_header_background', '#FFFFFF');
	$rebell_theme_options['spacing_above_logo'] 						= getbowtied_theme_option('spacing_above_logo', 20);  
	$rebell_theme_options['spacing_below_logo'] 						= getbowtied_theme_option('spacing_below_logo', 20);
	$rebell_theme_options['header_width'] 								= getbowtied_theme_option('header_width', 'custom');
	$rebell_theme_options['header_max_width'] 							= getbowtied_theme_option('header_max_width', 1680);

	/* Header Elements */
	$rebell_theme_options['main_header_wishlist'] 						= getbowtied_theme_option('main_header_wishlist', true);
	$rebell_theme_options['main_header_wishlist_icon'] 					= getbowtied_theme_option('main_header_wishlist_icon');
	$rebell_theme_options['main_header_shopping_bag'] 					= getbowtied_theme_option('main_header_shopping_bag', true);
	$rebell_theme_options['main_header_shopping_bag_icon'] 				= getbowtied_theme_option('main_header_shopping_bag_icon');
	$rebell_theme_options['option_minicart'] 							= getbowtied_theme_option('option_minicart', 1);
	$rebell_theme_options['option_minicart_open'] 						= getbowtied_theme_option('option_minicart_open', 1);
	$rebell_theme_options['main_header_minicart_message']				= getbowtied_theme_option('main_header_minicart_message');
	$rebell_theme_options['my_account_icon_state'] 						= getbowtied_theme_option('my_account_icon_state',true);
	$rebell_theme_options['custom_my_account_icon'] 					= getbowtied_theme_option('custom_my_account_icon');
	$rebell_theme_options['main_header_search_bar']						= getbowtied_theme_option('main_header_search_bar', true);
	$rebell_theme_options['main_header_search_bar_icon'] 				= getbowtied_theme_option('main_header_search_bar_icon');
	$rebell_theme_options['main_header_off_canvas'] 					= getbowtied_theme_option('main_header_off_canvas', false);
	$rebell_theme_options['main_header_off_canvas_icon'] 				= getbowtied_theme_option('main_header_off_canvas_icon');

	/* Header Logo */
	$rebell_theme_options['site_logo'] 									= getbowtied_theme_option('site_logo', get_template_directory_uri() . '/images/rebell-logo.png');
	$rebell_theme_options['sticky_header_logo'] 						= getbowtied_theme_option('sticky_header_logo', get_template_directory_uri() . '/images/rebell-logo.png');
	$rebell_theme_options['logo_min_height'] 							= getbowtied_theme_option('logo_min_height', 50);
	$rebell_theme_options['logo_height'] 								= getbowtied_theme_option('logo_height', 50);

	/* Top Bar */
	$rebell_theme_options['top_bar_switch'] 							= getbowtied_theme_option('top_bar_switch', false);
	$rebell_theme_options['top_bar_background_color'] 					= getbowtied_theme_option('top_bar_background_color', '#333');
	$rebell_theme_options['top_bar_typography'] 						= getbowtied_theme_option('top_bar_typography', '#fff');
	$rebell_theme_options['top_bar_text'] 								= getbowtied_theme_option('top_bar_text', 'Free Shipping on All Orders Over $75!');
	$rebell_theme_options['top_bar_navigation_position'] 				= getbowtied_theme_option('top_bar_navigation_position', 'right');
	$rebell_theme_options['sticky_header'] 								= getbowtied_theme_option('sticky_header', true);
	$rebell_theme_options['sticky_header_background_color'] 			= getbowtied_theme_option('sticky_header_background_color', '#fff');
	$rebell_theme_options['sticky_header_color'] 						= getbowtied_theme_option('sticky_header_color', '#000');

	/* Footer */
	$rebell_theme_options['footer_background_color'] 					= getbowtied_theme_option('footer_background_color', '#f4f4f4');
	$rebell_theme_options['footer_texts_color'] 						= getbowtied_theme_option('footer_texts_color', '#868686');
	$rebell_theme_options['footer_links_color'] 						= getbowtied_theme_option('footer_links_color', '#000');
	$rebell_theme_options['footer_copyright_text'] 						= getbowtied_theme_option('footer_copyright_text', 'rebell - eCommerce WP Theme');
	$rebell_theme_options['expandable_footer'] 							= getbowtied_theme_option('expandable_footer', true);
	$rebell_theme_options['back_to_top_button']							= getbowtied_theme_option('back_to_top_button', false);

	/* Blog */
	$rebell_theme_options['layout_blog'] 								= getbowtied_theme_option('layout_blog', 'layout-3');
	$rebell_theme_options['pagination_blog'] 							= getbowtied_theme_option('pagination_blog', 'infinite_scroll');
	$rebell_theme_options['sidebar_blog_listing'] 						= getbowtied_theme_option('sidebar_blog_listing', false);

	/* Single Post */
	$rebell_theme_options['post_meta_author'] 							= getbowtied_theme_option('post_meta_author', true);
	$rebell_theme_options['post_meta_date'] 							= getbowtied_theme_option('post_meta_date', true);
	$rebell_theme_options['post_meta_categories'] 						= getbowtied_theme_option('post_meta_categories', true);
	$rebell_theme_options['single_post_width'] 							= getbowtied_theme_option('single_post_width', 708);

	/* Shop */
	$rebell_theme_options['catalog_mode'] 								= getbowtied_theme_option('catalog_mode', false);
	$rebell_theme_options['pagination_shop'] 							= getbowtied_theme_option('pagination_shop', 'infinite_scroll');
	$rebell_theme_options['breadcrumbs'] 								= getbowtied_theme_option('breadcrumbs', true);
	$rebell_theme_options['quick_view'] 								= getbowtied_theme_option('quick_view', false);
	$rebell_theme_options['second_image_product_listing'] 				= getbowtied_theme_option('second_image_product_listing', true);
	$rebell_theme_options['ratings_catalog_page'] 						= getbowtied_theme_option('ratings_catalog_page', true);
	$rebell_theme_options['predictive_search'] 							= getbowtied_theme_option('predictive_search', true);
	$rebell_theme_options['search_in_titles'] 							= getbowtied_theme_option('search_in_titles', false);
	$rebell_theme_options['sidebar_style'] 								= getbowtied_theme_option('sidebar_style', 1);
	$rebell_theme_options['add_to_cart_display'] 						= getbowtied_theme_option('add_to_cart_display', 1);
	$rebell_theme_options['notification_mode'] 							= getbowtied_theme_option('notification_mode', 1);
	$rebell_theme_options['notification_style'] 						= getbowtied_theme_option('notification_style', 1);
	$rebell_theme_options['category_style'] 							= getbowtied_theme_option('category_style', 'styled_grid');
	$rebell_theme_options['out_of_stock_label'] 						= getbowtied_theme_option('out_of_stock_label', 'Out of stock');
	$rebell_theme_options['sale_label'] 								= getbowtied_theme_option('sale_label', 'Sale!');
	$rebell_theme_options['mobile_columns'] 							= getbowtied_theme_option('mobile_columns', 2);
	$rebell_theme_options['categories_grid_count'] 						= getbowtied_theme_option('categories_grid_count', true);

	/* Product Page */
	$rebell_theme_options['product_layout'] 							= getbowtied_theme_option('product_layout', 'default');
	$rebell_theme_options['product_quantity_style'] 					= getbowtied_theme_option('product_quantity_style', 'custom');
	$rebell_theme_options['product_gallery_zoom'] 						= getbowtied_theme_option('product_gallery_zoom', true);
	$rebell_theme_options['product_gallery_lightbox']					= getbowtied_theme_option('product_gallery_lightbox', true);
	$rebell_theme_options['related_products'] 							= getbowtied_theme_option('related_products', true);
	$rebell_theme_options['related_products_number'] 					= getbowtied_theme_option('related_products_number', 4);
	$rebell_theme_options['review_tab'] 								= getbowtied_theme_option('review_tab', true);
	$rebell_theme_options['ajax_add_to_cart'] 							= getbowtied_theme_option('ajax_add_to_cart', true);
	$rebell_theme_options['disabled_outofstock_variations'] 			= getbowtied_theme_option('disabled_outofstock_variations', true);

	/* Styling */
	$rebell_theme_options['body_color'] 								= getbowtied_theme_option('body_color', '#545454');
	$rebell_theme_options['headings_color'] 							= getbowtied_theme_option('headings_color', '#000000');
	$rebell_theme_options['main_color'] 								= getbowtied_theme_option('main_color', '#EC7A5C');
	$rebell_theme_options['main_background'] 							= getbowtied_theme_option('main_background', array('background-color' => '#FFFFFF'));
	$rebell_theme_options['smooth_transition_between_pages'] 			= getbowtied_theme_option('smooth_transition_between_pages', 0);
	$rebell_theme_options['offcanvas_bg_color'] 						= getbowtied_theme_option('offcanvas_bg_color', '#ffffff');
	$rebell_theme_options['offcanvas_headings_color'] 					= getbowtied_theme_option('offcanvas_headings_color', '#000000');
	$rebell_theme_options['offcanvas_text_color'] 						= getbowtied_theme_option('offcanvas_text_color', '#545454');

	/* Fonts */
	$rebell_theme_options['new_main_font'] 									= getbowtied_theme_option('new_main_font', array(
																													'font-family'    => 'NeueEinstellung',
																													'variant'        => '500',
																													'subsets'        => array( 'latin' )
																												));		      
	$rebell_theme_options['new_secondary_font'] 						= getbowtied_theme_option('new_secondary_font', array('font-family'=> 'Radnika'));
	$rebell_theme_options['headings_font_size'] 						= getbowtied_theme_option('headings_font_size', 23);	 
	$rebell_theme_options['body_font_size']								= getbowtied_theme_option('body_font_size', 16);

	/* Fonts - deprecated */
	$rebell_theme_options['main_font_variants'] 						= getbowtied_theme_option('main_font_variants', 'regular');	      
	$rebell_theme_options['secondary_font_variants'] 					= getbowtied_theme_option('secondary_font_variants', 'regular');	      

	$rebell_theme_options['product_title_font_size']					= getbowtied_theme_option('product_title_font_size', 12);
}

add_action( 'wp_enqueue_scripts', 'rebell_custom_styles', 100 );
if ( !function_exists ('rebell_custom_styles') ) {
	function rebell_custom_styles() {	
		global 	$post, 
				$rebell_theme_options,
				$default_fonts;

	    if ( ! function_exists('getbowtied_google_fonts') ) :
			function getbowtied_google_fonts() {

				global $rebell_theme_options;

				$old_mfont= getbowtied_theme_option('main_font');
				$old_sfont= getbowtied_theme_option('secondary_font');

				$mfont = $rebell_theme_options['new_main_font'];
				$sfont = $rebell_theme_options['new_secondary_font']; 

				if (!empty($old_mfont) && is_string($old_mfont)) {
					$temp_mfont = array();
					$temp_mfont['font-family']= $old_mfont;
					if (isset($rebell_theme_options['main_font_variants'])) {
						$temp_mfont['variant'] = $rebell_theme_options['main_font_variants'];
					}

					set_theme_mod('new_main_font', $temp_mfont);
					set_theme_mod('main_font', false);
					$mfont= $temp_mfont;
					$rebell_theme_options['new_main_font']= $mfont;
				}

				if (!empty($old_sfont) && is_string($old_sfont)) {
					$temp_sfont['font-family']= $old_sfont;
					if (isset($rebell_theme_options['secondary_font_variants'])) {
						$temp_sfont['variant'] = $rebell_theme_options['secondary_font_variants'];
					}

					set_theme_mod('new_secondary_font', $temp_sfont);
					set_theme_mod('secondary_font', false);
					$sfont= $temp_sfont;
					$rebell_theme_options['new_secondary_font']= $sfont;
				}
			}            
			getbowtied_google_fonts();
		endif;
		
		$custom_styles = '';

		$path = get_template_directory() . '/inc/custom-styles/';

		include( $path . 'frontend/body.php' );
		include( $path . 'frontend/fonts.php' );
		include( $path . 'frontend/colors.php' );
		include( $path . 'frontend/topbar.php' );
		include( $path . 'frontend/header.php' );
		include( $path . 'frontend/footer.php' );
		include( $path . 'frontend/woocommerce.php' );
		include( $path . 'frontend/gutenberg.php' );

		wp_add_inline_style( 'rebell-styles', $custom_styles );
	}
}