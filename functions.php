<?php
/*  add_action( 'woocommerce_single_product_summary', 'single_in_st', 0 );
function single_in_st() { 
  echo '<div style="margin-bottom:10px" class="single_pr_in_stock">
<span style="
    color: #fff;
    background: green;
    padding: 3px;
    border-radius: 2px;
">В наличии</span>
</div>';

} */
// удаляем описание категории на странице категорий
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
// выводим описание категории под товарами
add_action( 'woocommerce_after_shop_loop', 'woocommerce_taxonomy_archive_description', 100 );

add_filter('woof_title_tag', function($tag){
    return 'section';
});

add_filter( 'widget_title','modify_text_widget_title_tags', 10, 3 );
function modify_text_widget_title_tags( $title, $instance, $id_base ) {
if ( 'text' == $id_base )
return 'div class=widgettitle' . $title . '/div';
}

// Enqueue Your Font

function my_queue_items() {
wp_enqueue_style( 'rating-stars', '/wp-content/plugins/woocommerce/assets/fonts/star.woff', array(), null );
}
add_action( 'wp_enqueue_scripts', 'my_queue_items', 99 );

// Add Crossorigin Attribute To Your Font

function style_attributes( $html, $handle ) {
if ( 'rating-stars' === $handle ) {
return str_replace( "media='all'", "media='all' crossorigin='anonymous'", $html );
}
return $html;
}
add_filter( 'style_loader_tag', 'style_attributes', 10, 2 );

add_filter( 'wpseo_breadcrumb_links', 'sheens_wpseo_breadcrumb_output' );

function sheens_wpseo_breadcrumb_output( $output ){

	if ( isset($output[1]) && 'product' == $output[1]['ptarchive'] ) {

		unset( $output[1] );

		$output = array_values( $output );
	}

    return $output;
}

add_filter('wp_get_attachment_image_attributes', 'change_attachement_image_attributes', 20, 2);

function change_attachement_image_attributes($attr, $attachment) {
    global $post;
    if ($post->post_type == 'product') {
		$title = $post->post_title;
		static $num = 0;//чтобы фото в галерее начиналось с 1
		$num++;
        $attr['alt'] = sprintf("Купить %s - Фото %d.",$title,$num);
       $attr['title'] = sprintf(" %s ",$title);
    }
    return $attr;
}

// Удалить каноническую ссылку - SEO by Yoast
function at_remove_dup_canonical_link() {
return false;
}
add_filter( 'wpseo_canonical', 'at_remove_dup_canonical_link' );
	
	
	
 /* function my_template_loop_product_title(){
    global $product;
			$taxonomy = 'pa_razmer';

    if( $product->is_type('variable') ){
		echo '<span class="vrbs">';
        foreach ( $product->get_available_variations() as $variation ){
            if( isset($variation['attributes']['attribute_'.$taxonomy]) ){
                // Get the "pa_razmer"
                $term_name = get_term_by('slug', $variation['attributes']['attribute_'.$taxonomy], $taxonomy)->name;


                // Display "razmer" product attribute term name value
                echo '<span class="vrb">' . $term_name . '</span>';
				
                
            }
        }
		echo '</span>';
    }
}
add_action( 'woocommerce_after_shop_loop_item_title', 'my_template_loop_product_title', 10 );	 */
	
	
	
	
	
	
//Для отладки
 //global $wpdb;
//$data = $wpdb->get_results("SELECT meta_key, count(*) as count FROM $wpdb->postmeta WHERE meta_key NOT LIKE '\_oembed%' GROUP BY meta_key");
//print_r( $data );
 
 add_filter('woof_get_more_less_button_label', 'woof_get_more_less_button');
 
    function woof_get_more_less_button($args)
    {
        $args['type'] = 'text';
        $args['closed'] = 'Открыть еще..';
        $args['opened'] = 'Свернуть';
 
        return $args;
    }
 
 
 
 	/*
 * Добавляем поля
 */
add_action( 'woocommerce_product_options_general_product_data', 'newsku_woo_add_custom_fields' );
function newsku_woo_add_custom_fields() {
	echo '<div class="options_group">';// Группировка полей
	
	// текстовое поле
	woocommerce_wp_text_input( array(
		'id'          => '_newsku',
		'label'       => __( 'Новый артикул товара', 'woocommerce' ),
		'placeholder' => 'Новый артикул',
		'desc_tip'    => 'true',
		'description' => __( 'Укажите Новый артикул', 'woocommerce' ),
	) );
	

	
	echo '</div>';
	
}

/*
 * Сохраняем значение полей
 */
add_action( 'woocommerce_process_product_meta', 'newsku_save', 10 );
function newsku_save( $post_id ) {
	$newsku_text_field = $_POST['_newsku'];
	if ( !empty($newsku_text_field) ) {
	update_post_meta( $post_id, '_newsku', esc_attr( $newsku_text_field ) );
	}
}



add_action( 'woocommerce_product_meta_end', 'newsku_text' );
function newsku_text() {
	global $post, $product;
	
	$newsku = get_post_meta( $post->ID, '_newsku', true );
 if($newsku !== '') {
		$newskublock = '<div class="newsku">код товара: ';
		$newskublock .= '<span>' . $newsku . '</span>';
		$newskublock .= '</div>';
		echo $newskublock;
} else {
echo '';
}
		
	
}




	


add_filter('woocommerce_product_add_to_cart_text','my_woocommerce_variable_text_button',10,2);
function my_woocommerce_variable_text_button($text,$product){
if($product->product_type == 'variable'){
$text = 'Купить';
}
return $text;
}

//Вывод рейтинга в звездах в каталог
add_filter('woocommerce_product_get_rating_html', 'your_get_rating_html', 10, 2);

  function your_get_rating_html($rating_html, $rating) {
  	if ( $rating > 0 ) {
    	$title = sprintf( __( 'Rated %s out of 5', 'woocommerce' ), $rating );
  	} else {
    	$title = 'Not yet rated';
    	$rating = 0;
  	}
  	$rating_html  = '<div class="star-rating" title="' . $title . '">';
  	$rating_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . __( 'out of 5', 'woocommerce' ) . '</span>';
  	$rating_html .= '</div>';
  	return $rating_html;
  }





add_action( 'wp_footer', 'cart_update_qty_script' );
 
function cart_update_qty_script() {
    if (is_cart()) :
    ?>
    <script>
        jQuery('div.woocommerce').on('change', '.qty', function(){
            jQuery("[name='update_cart']").removeAttr("disabled").trigger("click");
        });
    </script>
    <?php
    endif;
}



add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
  
function custom_override_checkout_fields( $fields ) {
  //unset($fields['billing']['billing_first_name']);// имя
  //unset($fields['billing']['billing_last_name']);// фамилия
  unset($fields['billing']['billing_address_1']);//
  unset($fields['billing']['billing_address_2']);//
  unset($fields['billing']['billing_city']);
  //unset($fields['billing']['billing_country']);
  unset($fields['billing']['billing_state']);
  //unset($fields['billing']['billing_phone']);
  //unset($fields['order']['order_comments']);
  //unset($fields['billing']['billing_email']);
  //unset($fields['account']['account_username']);
  //unset($fields['account']['account_password']);
  //unset($fields['account']['account_password-2']);

 
  unset($fields['billing']['billing_company']);// компания
  unset($fields['billing']['billing_postcode']);// индекс 
    return $fields;
}



add_action('wp_enqueue_scripts', 'wpmidia_enqueue_masked_input');
function wpmidia_enqueue_masked_input(){
wp_enqueue_script('masked-input', get_template_directory_uri().'/js/jquery.maskedinput.min.js', array('jquery'));
}

add_action('wp_footer', 'wpmidia_activate_masked_input');
function wpmidia_activate_masked_input(){
?>
<script type="text/javascript">
jQuery( function($){
//$(".data").mask("99/99/9999");
$("#billing_phone").mask("+38(999) 99-99-999"); //маска для checkout
$(".tel").mask("+38 (999) 999-99-99"); //маска для ContactForm7
//$(".cnpj").mask("99.999.999/9999-99");

});
</script>
<?php
} 



 // function mynew_product_subcategories( $args = array() ) {
	//$parentid = get_queried_object_id();
	//$args = array(
	   // 'parent' => $parentid
	//);
	//$terms = get_terms( 'product_cat', $args );
	//if ( $terms ) { 
	//echo '<div class="large-12 columns">';
	  //  echo '<ul class="row products products-grid small-up-1 medium-up-3 large-up-3 xlarge-up-3 xxlarge-up-3">';
	      //  foreach ( $terms as $term ) { 
			
	          //  echo '<li class="column animate">';    
				//	echo '<a href="' .  esc_url( get_term_link( $term ) ) . '" class="' . $term->slug . '">';
				//	echo '<div class="image-container_for_sub">';
	             //   woocommerce_subcategory_thumbnail( $term ); 
				//	echo '</div>';
						//echo '<div class="category-content">';
						//	echo '<div class="h3_category">';
								
								//	echo $term->name;
								
						//	echo '</div>'; 
						//echo '</div>';	
					//echo '</a>';	
	            //echo '</li>';  
				
	  //  }
	  //  echo '</ul>';
	//echo '</div>';
	//}
//}
 
//add_action( 'woocommerce_before_shop_loop', 'mynew_product_subcategories', 50 );

//Добавляем колонку с примечанием на страницу заказов в админке
add_filter( 'manage_edit-shop_order_columns', 'add_order_notes_column' );
function add_order_notes_column( $columns ) {
	$new_columns = array();
	foreach($columns as $key => $column) {
		$new_columns[$key] = $column;
		if($key == 'order_status') $new_columns['order_notes'] = 'Примечание';
	}
	return $new_columns;
} 
add_action( 'manage_shop_order_posts_custom_column', 'add_order_notes_content' );
function add_order_notes_content( $column ) {
if( $column != 'order_notes' ) return;      
	global $post, $the_order;
	if( empty( $the_order ) || $the_order->get_id() != $post->ID ) {
	  $the_order = wc_get_order( $post->ID );
	}    
	$args = array();
	$args['order_id'] = $the_order->get_id();
	$args['order_by'] = 'date_created';
	$args['order'] = 'ASC';
	$notes = wc_get_order_notes( $args );
	if( $notes ) {
		// if(count($notes) > 1) {
		// 	echo '<p>'. $notes[count($notes)-1]->content . '</p>';
		// }
	  print '<ul class="order_notes_list">';
	  $notes = array_reverse($notes);
	  foreach( $notes as $note ) {
	  	if($note->added_by == 'system' ||  strpos($note->content, 'Статус') !== false) continue;
	    if( $note->customer_note ) {
	      print '<li class="order_customer_note">';
	    } else {
	      print '<li class="order_private_note">';
	    }
	    $date = date( 'd/m/y H:i', strtotime( $note->date_created ) );
	     // print $date.' by '.$note->added_by.'<br>'.$note->content.'</li>';
	    print $note->content.'</li>';
	  }
	  print '</ul>';
	}
}


//Меняем текст кнопки купить
add_filter('woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_add_to_cart_text');
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_add_to_cart_text' );  
function woocommerce_custom_add_to_cart_text() {
	return __('В корзину', 'woocommerce');
}


//Переименовываем сортировку
function custom_woocommerce_catalog_orderby( $orderby ) {
    $orderby['date'] = 'По дате публикации';

    return $orderby;
}
add_filter( "woocommerce_catalog_orderby", "custom_woocommerce_catalog_orderby", 20 );









add_filter('gettext', 'translate_text');
add_filter('ngettext', 'translate_text');
 
function translate_text($translated) {
$translated = str_ireplace('Подытог', 'Всего', $translated);
return $translated;
}


// Del file version
function remove_cssjs_ver( $src ) {
    if( strpos( $src, '?ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );


// Change currency symbol
function add_my_currency( $currencies ) {
$currencies['UAH'] = __( 'Українська гривня', 'woocommerce' );
$currencies['RUB'] = __( 'Русский рубль', 'woocommerce' );
return $currencies;
}
add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);
 
function add_my_currency_symbol( $currency_symbol, $currency ) {
switch( $currency ) {
case 'UAH': $currency_symbol = ' грн.'; break;
case 'RUB': $currency_symbol = ' руб.'; break;
}
return $currency_symbol;
}


// theme textdomain - must be loaded before redux
load_theme_textdomain( 'rebell', get_template_directory() . '/languages' );
define( 'GETBOWTIED_VISUAL_COMPOSER_IS_ACTIVE', defined( 		'WPB_VC_VERSION' ) );

/******************************************************************************/
/***************************** Theme Options **********************************/
/******************************************************************************/

global $rebell_theme_options;

if (!class_exists( 'Kirki')):
	require_once( get_template_directory() . '/settings/kirki/kirki.php' );
	add_filter( 'kirki/config', 'getbowtied_kirki_update_url' );
	function getbowtied_kirki_update_url( $config ) {
	    $config['url_path'] = get_template_directory_uri() . '/settings/kirki/';
	    return $config;
	}
endif;
require_once( get_template_directory() . '/settings/kirki.config.php' );


/******************************************************************************/
/******************************** Includes ************************************/
/******************************************************************************/

require_once( get_template_directory() . '/inc/helpers/helpers.php');
require_once( get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php' );
require_once( get_template_directory() . '/inc/tgm/plugins.php' );
require_once( get_template_directory() . '/inc/admin/wizard/class-gbt-helpers.php' );
require_once( get_template_directory() . '/inc/admin/wizard/class-gbt-install-wizard.php' );
require_once( get_template_directory() . '/inc/demo/ocdi-setup.php');

/**
 * On theme activation redirect to splash page
 */
global $pagenow;

if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {

	wp_redirect(admin_url("themes.php")); // Your admin page URL
	
}

include( get_template_directory() . '/inc/custom-styles/custom-styles.php' ); // Load Custom Styles
include( get_template_directory() . '/inc/custom-styles/gutenberg-styles.php' ); // Load Gutenberg Custom Styles
include( get_template_directory() . '/inc/templates/post-meta.php' ); // Load Post meta template
include( get_template_directory() . '/inc/templates/template-tags.php' ); // Load Template Tags

//Include Metaboxes
include_once( get_template_directory() . '/inc/metaboxes/page.php' );
include_once( get_template_directory() . '/inc/metaboxes/post.php' );
include_once( get_template_directory() . '/inc/metaboxes/product.php' );

//Quick View
include_once( get_template_directory() . '/inc/woocommerce/quick_view.php' );

//Product Layout
include_once( get_template_directory() . '/inc/woocommerce/product-layout.php' );

/******************************************************************************/
/*************************** Visual Composer **********************************/
/******************************************************************************/

if (class_exists('WPBakeryVisualComposerAbstract')) {
	
	add_action( 'init', 'visual_composer_stuff' );
	function visual_composer_stuff() {
				
		// Remove vc_teaser
		if (is_admin()) :
			function remove_vc_teaser() {
				remove_meta_box('vc_teaser', '' , 'side');
			}
			add_action( 'admin_head', 'remove_vc_teaser' );
		endif;
	
	}
}

add_action( 'vc_before_init', 'rebell_vcSetAsTheme' );
function rebell_vcSetAsTheme() {
    vc_manager()->disableUpdater(true);
	vc_set_as_theme();
}

/******************************************************************************/
/*********************** rebell setup *************************************/
/******************************************************************************/


if ( ! function_exists( 'rebell_setup' ) ) :
function rebell_setup() {
	
	global $rebell_theme_options;

	// frontend presets

	
	/** Theme support **/
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce');

	// woocommerce gallery
	add_theme_support( 'wc-product-gallery-slider' );

	$rebell_theme_options['product_gallery_zoom'] = getbowtied_theme_option('product_gallery_zoom', 1);
	if( isset($rebell_theme_options['product_gallery_zoom']) && $rebell_theme_options['product_gallery_zoom'] == 1 ) {
		add_theme_support( 'wc-product-gallery-zoom' );
	} else {
		remove_theme_support( 'wc-product-gallery-zoom' );
	}

	add_theme_support( 'woocommerce', array(

	    // Product grid theme settings
	    'product_grid'        => array(
	        'default_rows'    => get_option('woocommerce_catalog_rows', 5),
	        'min_rows'        => 2,
	        'max_rows'        => '',
	        
	        'default_columns' => get_option('woocommerce_catalog_columns', 5),
	        'min_columns'     => 1,
	        'max_columns'     => 6,
	    ),
	) );
	
	
	//==============================================================================
	//	WooCommerce thumb size for product gallery (single) 
	//==============================================================================
	add_filter( 'woocommerce_gallery_thumbnail_size', function( $size ) {
		return 'thumbnail';
	} );	
	
	
	// gutenberg
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
   	
	add_editor_style( 'css/admin/editor-styles.css' );

	add_post_type_support('page', 'excerpt');
	
	
	/** Add Image Sizes **/
	$shop_catalog_image_size = get_option( 'shop_catalog_image_size' );
	$shop_single_image_size = get_option( 'shop_single_image_size' );
	add_image_size('product_small_thumbnail', (int)$shop_catalog_image_size['width']/3, (int)$shop_catalog_image_size['height']/3, isset($shop_catalog_image_size['crop']) ? true : false); // made from shop_catalog_image_size
	add_image_size('shop_single_small_thumbnail', (int)$shop_single_image_size['width']/3, (int)$shop_single_image_size['height']/3, isset($shop_catalog_image_size['crop']) ? true : false); // made from shop_single_image_size
	add_image_size( 'blog-isotope', 620, 500, true ); 
	
	/** Register menus **/	
	register_nav_menus( array(
		'top-bar-navigation' => esc_html__( 'Top Bar Navigation', 'rebell' ),
		'main-navigation' => esc_html__( 'Main Navigation', 'rebell' ),
		'footer-navigation' => esc_html__( 'Footer Navigation', 'rebell' ),
	) );

}
endif; // rebell_setup
add_action( 'after_setup_theme', 'rebell_setup' );

/**
 * Register nav menus based on theme option
 */
if (!function_exists( 'getbowtied_custom_nav_menus' )) {
	function getbowtied_custom_nav_menus() {

		global $rebell_theme_options;

		$rebell_theme_options['main_header_off_canvas'] = getbowtied_theme_option('main_header_off_canvas', false);
		$rebell_theme_options['main_header_layout'] 	= getbowtied_theme_option('main_header_layout', 1);

		if ( (isset($rebell_theme_options['main_header_off_canvas'])) && (trim($rebell_theme_options['main_header_off_canvas']) == "1" ) ) {
			register_nav_menus( array(
				'secondary_navigation' => esc_html__( 'Secondary Navigation (Off-Canvas)', 'rebell' ),
			) );
		}
		
		if ( (isset($rebell_theme_options['main_header_layout'])) && ( $rebell_theme_options['main_header_layout'] == "2" || $rebell_theme_options['main_header_layout'] == "22" ) ) {
			register_nav_menus( array(
				'centered_header_left_navigation' => esc_html__( 'Centered Header - Left Navigation', 'rebell' ),
				'centered_header_right_navigation' => esc_html__( 'Centered Header - Right Navigation', 'rebell' ),
			) );
		}
	}
	add_action('init', 'getbowtied_custom_nav_menus');
}

/******************************************************************************/
/**************************** Enqueue styles **********************************/
/******************************************************************************/

// frontend
function rebell_styles() {
	
	global $rebell_theme_options;


	/******************************************************************************/
	/* WooCommerce remove review tab **********************************************/
	/******************************************************************************/
	if ( (isset($rebell_theme_options['review_tab'])) && ($rebell_theme_options['review_tab'] == "0" ) ) {
	add_filter( 'woocommerce_product_tabs', 'rebell_remove_reviews_tab', 98);
		function rebell_remove_reviews_tab($tabs) {
			unset($tabs['reviews']);
			return $tabs;
		}
	}

	if ( (isset($rebell_theme_options['smooth_transition_between_pages'])) && ($rebell_theme_options['smooth_transition_between_pages'] == "1" ) ) {
		wp_enqueue_style('rebell-page-in-out', get_template_directory_uri() . '/css/page-in-out.css', NULL, getbowtied_theme_version(), 'all' );
	}
	wp_enqueue_style('rebell-styles', get_template_directory_uri() . '/css/styles.css', NULL, getbowtied_theme_version(), 'all' );

	wp_enqueue_style('rebell-icon-font', get_template_directory_uri() . '/inc/fonts/rebell-icon-font/style.css', NULL, getbowtied_theme_version(), 'all' );		
	
	wp_enqueue_style('rebell-fresco', get_template_directory_uri() . '/css/fresco/fresco.css', NULL, '1.3.0', 'all' );	

	//plugin styles

	if( GETBOWTIED_GERMAN_MARKET_IS_ACTIVE || GETBOWTIED_WOOCOMMERCE_GERMANIZED_IS_ACTIVE ) {
		wp_enqueue_style('rebell-german-market-styles', get_template_directory_uri() . '/css/plugins/german-market.css', NULL, getbowtied_theme_version(), 'all' );
	}

	if ( GETBOWTIED_DOKAN_MULTIVENDOR_IS_ACTIVE ) {
		wp_enqueue_style('rebell-dokan-styles', get_template_directory_uri() . '/css/plugins/dokan.css', NULL, getbowtied_theme_version(), 'all' );
	}

	if ( GETBOWTIED_WOOCOMMERCE_PRODUCT_ADDONS_IS_ACTIVE ) {
		wp_enqueue_style('rebell-addons-styles', get_template_directory_uri() . '/css/plugins/woo-addons.css', NULL, getbowtied_theme_version(), 'all' );
	}

	if( GETBOWTIED_WOOCOMMERCE_WISHLIST_IS_ACTIVE ) {
		wp_enqueue_style('rebell-wishlist-styles', get_template_directory_uri() . '/css/plugins/wishlist.css', NULL, getbowtied_theme_version(), 'all' );
	}
	
	wp_enqueue_style('rebell-default-style', get_stylesheet_uri());
}
add_action( 'wp_enqueue_scripts', 'rebell_styles', 99 );



// admin area
function rebell_admin_styles() {
    if ( is_admin() ) {
        
		wp_enqueue_style("wp-color-picker");
		wp_enqueue_style("rebell_admin_styles", get_template_directory_uri() . "/css/admin/admin.css", false, getbowtied_theme_version(), "all");
		
		if (class_exists('WPBakeryVisualComposerAbstract')) { 
			wp_enqueue_style('rebell_visual_composer', get_template_directory_uri() .'/css/plugins/visual-composer.css', false, getbowtied_theme_version(), 'all');
		}
    }
}
add_action( 'admin_enqueue_scripts', 'rebell_admin_styles' );


/******************************************************************************/
/*************************** Enqueue scripts **********************************/
/******************************************************************************/

// frontend

function rebell_scripts_header_priority_0() {

	global $rebell_theme_options;

	if ( (isset($rebell_theme_options['smooth_transition_between_pages'])) && ($rebell_theme_options['smooth_transition_between_pages'] == "1" ) ) {
		wp_enqueue_script('rebell-nprogress', get_template_directory_uri() . '/js/components/nprogress.js', NULL, getbowtied_theme_version(), FALSE);
		wp_enqueue_script('rebell-page-in-out', get_template_directory_uri() . '/js/components/page-in-out.js', array('rebell-nprogress', 'jquery'), getbowtied_theme_version(), FALSE);
	}

}
add_action( 'wp_enqueue_scripts', 'rebell_scripts_header_priority_0', 0 );

function rebell_scripts() {
	
	global $rebell_theme_options;
	
	/** In Footer **/
	if( is_rtl() )
	{
		wp_enqueue_script('rebell-rtl-js', get_template_directory_uri() . '/js/components/rtl.js', array('jquery'), getbowtied_theme_version(), TRUE);
	}

	if( class_exists('WooCommerce') && !is_woocommerce() )
	{
		wp_enqueue_script('rebell-salvattore-js', get_template_directory_uri() . '/js/vendor/salvattore.js', array('jquery'), getbowtied_theme_version(), TRUE);
	}
	
	if ( GETBOWTIED_VISUAL_COMPOSER_IS_ACTIVE) // If VC exists/active load scripts after VC
	{
		$dependencies = array('jquery', 'wpb_composer_front_js');
	}
	else // Do not depend on VC
	{
		$dependencies = array('jquery');
	}

	wp_enqueue_script('rebell-scripts-dist', get_template_directory_uri() . '/js/scripts-dist.js', $dependencies, getbowtied_theme_version(), TRUE);
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$ajax_url = admin_url('admin-ajax.php', 'relative');
	if ( class_exists('SitePress') ) {
		$my_current_lang = apply_filters( 'wpml_current_language', NULL );
		if ( $my_current_lang ) {
		    $ajax_url = add_query_arg( 'wpml_lang', $my_current_lang, $ajax_url );
	}}

	$getbowtied_scripts_vars_array = array(
		
		'ajax_load_more_locale' 	=> esc_html__( 'Load More Items', 'rebell' ),
		'ajax_loading_locale' 		=> esc_html__( 'Loading', 'rebell' ),
		'ajax_no_more_items_locale' => esc_html__( 'No more items available.', 'rebell' ),

		'pagination_blog' 			=> isset($rebell_theme_options['pagination_blog'])? $rebell_theme_options['pagination_blog'] : 'infinite_scroll',
		'layout_blog' 				=> isset($rebell_theme_options['layout_blog'])? 	$rebell_theme_options['layout_blog'] 	 : 'layout-1',
		'shop_pagination_type' 		=> isset($rebell_theme_options['pagination_shop'])? $rebell_theme_options['pagination_shop'] : 'infinite_scroll',

		'option_minicart' 			=> isset($rebell_theme_options['option_minicart'])? $rebell_theme_options['option_minicart'] : '1',
		'option_minicart_open' 		=> isset($rebell_theme_options['option_minicart_open'])? $rebell_theme_options['option_minicart_open'] : '1',
		'catalog_mode'				=> (isset($rebell_theme_options['catalog_mode']) && $rebell_theme_options['catalog_mode'] == 1) ? '1' : '0',
		'product_lightbox'			=> (isset($rebell_theme_options['product_gallery_lightbox']) && $rebell_theme_options['product_gallery_lightbox'] == 1) ? '1' : '0',
		'product_gallery_zoom'			=> (isset($rebell_theme_options['product_gallery_zoom']) && $rebell_theme_options['product_gallery_zoom'] == 1) ? '1' : '0',

		'ajax_url'					=> esc_url($ajax_url),
	);
	
	wp_localize_script( 'rebell-scripts-dist', 'getbowtied_scripts_vars', $getbowtied_scripts_vars_array );

}
add_action( 'wp_enqueue_scripts', 'rebell_scripts', 99 );



// admin area
function rebell_admin_scripts() {
    if ( is_admin() ) {
		wp_enqueue_script('rebell-customizer', 	get_template_directory_uri() . '/js/components/wp-customizer.js', array('jquery'), getbowtied_theme_version(), TRUE);
		wp_enqueue_script('rebell-notices', 	get_template_directory_uri() . '/js/components/admin-notices.js', array('jquery'), getbowtied_theme_version(), TRUE);
    }
}
add_action( 'admin_enqueue_scripts', 'rebell_admin_scripts' );



function getbowtied_favicon(){
	if (has_site_icon() == false)
	    echo '<link rel="icon" href="' . get_stylesheet_directory_uri() . '/favicon.png" />';
}
add_action('wp_head', 'getbowtied_favicon');

/******************************************************************************/
/****** Register widgetized area and update sidebar with default widgets ******/
/******************************************************************************/

function rebell_widgets_init() {
	
	$sidebars_widgets = wp_get_sidebars_widgets();	
	$footer_area_widgets_counter = "0";	
	if (isset($sidebars_widgets['footer-widget-area'])) $footer_area_widgets_counter  = count($sidebars_widgets['footer-widget-area']);
	
	switch ($footer_area_widgets_counter) {
		case 0:
			$footer_area_widgets_columns ='large-12';
			break;
		case 1:
			$footer_area_widgets_columns ='large-12';
			break;
		case 2:
			$footer_area_widgets_columns ='large-6';
			break;
		case 3:
			$footer_area_widgets_columns ='large-4';
			break;
		case 4:
			$footer_area_widgets_columns ='large-3';
			break;
		default:
			$footer_area_widgets_columns ='large-3';
	}
	
	//default sidebar
	register_sidebar(array(
		'name'          => esc_html__( 'Sidebar', 'rebell' ),
		'id'            => 'default-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	
	//footer widget area
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area', 'rebell' ),
		'id'            => 'footer-widget-area',
		'before_widget' => '<div class="' . $footer_area_widgets_columns . ' columns"><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	//catalog widget area
	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'rebell' ),
		'id'            => 'catalog-widget-area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	//offcanvas widget area
	register_sidebar( array(
		'name'          => esc_html__( 'Right Offcanvas Sidebar', 'rebell' ),
		'id'            => 'offcanvas-widget-area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'rebell_widgets_init' );


/******************************************************************************/
/****** Notifications *********************************************************/
/******************************************************************************/

if( GETBOWTIED_WOOCOMMERCE_IS_ACTIVE ) :
	function getbowtied_notification_class( $classes ) {
		global $rebell_theme_options;

		if ($rebell_theme_options['notification_mode'] == 1) {
			if( !(is_user_logged_in() && is_account_page()) ) {
		    	$classes[] = 'gbt_custom_notif';
		    } else {
				$classes[] = 'gbt_classic_notif';
			}
		} else {
			$classes[] = 'gbt_classic_notif';
		}
	    return $classes;    
	}
	add_filter( 'body_class','getbowtied_notification_class' );

	function getbowtied_notifications() {
		global $rebell_theme_options;

		if( isset($rebell_theme_options['notification_mode']) && $rebell_theme_options['notification_mode'] == 1 ) {
			include( get_template_directory() . '/inc/notifications/custom/class-custom-notifications.php' );
		} else {
			include( get_template_directory() . '/inc/notifications/classic/class-classic-notifications.php' );
		}
	}
	add_action( 'wp_loaded', 'getbowtied_notifications', 100 );
endif;

/******************************************************************************/
/****** Predictive Search *****************************************************/
/******************************************************************************/

if( GETBOWTIED_WOOCOMMERCE_IS_ACTIVE ) :
	function getbowtied_ajax_search() {
		global $rebell_theme_options;

		if( isset($rebell_theme_options['predictive_search']) && $rebell_theme_options['predictive_search'] ) {
			include_once( get_template_directory() . '/inc/search/class-search.php' );
		}
	}
	add_action( 'wp_loaded', 'getbowtied_ajax_search', 100 );
endif;

/******************************************************************************/
/****** Remove Woocommerce prettyPhoto ****************************************/
/******************************************************************************/

add_action( 'wp_enqueue_scripts', 'rebell_remove_woo_lightbox', 99 );
function rebell_remove_woo_lightbox() {
    wp_dequeue_script('prettyPhoto-init');
}

/******************************************************************************/
/****** Add Fresco to Galleries ***********************************************/
/******************************************************************************/

add_filter( 'wp_get_attachment_link', 'sant_prettyadd', 10, 6);
function sant_prettyadd ($content, $id, $size, $permalink, $icon, $text) {
    if ($permalink) {
    	return $content;    
    }
    $content = preg_replace("/<a/","<span class=\"fresco\" data-fresco-group=\"\"", $content, 1);
    return $content;
}



/******************************************************************************/
/* Change breadcrumb separator on woocommerce page ****************************/
/******************************************************************************/

add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_delimiter' );
function jk_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'  
	$defaults['delimiter'] = ' <span class="breadcrump_sep">/</span> ';
	return $defaults;
}


/******************************************************************************/
/* WooCommerce Update Number of Items in the cart *****************************/
/******************************************************************************/

add_action('woocommerce_ajax_added_to_cart', 'rebell_ajax_added_to_cart');
function rebell_ajax_added_to_cart() {

}


//================================================================================
// Update local storage with cart counter each time
//================================================================================

add_filter('woocommerce_add_to_cart_fragments', 'rebell_shopping_bag_items_number');
function rebell_shopping_bag_items_number( $fragments ) 
{
	global $woocommerce;
	ob_start(); ?>

    <span class="shopping_bag_items_number"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>
	<?php
	$fragments['.shopping_bag_items_number'] = ob_get_clean();
	return $fragments;
}





/******************************************************************************/
/* WooCommerce Number of Related Products *************************************/
/******************************************************************************/

function woocommerce_output_related_products() {
	$atts = array(
		'posts_per_page' => '4',
		'orderby'        => 'rand'
	);
	woocommerce_related_products($atts);
}






/******************************************************************************/
/* WooCommerce Add data-src & lazyOwl to Thumbnails ***************************/
/******************************************************************************/
function woocommerce_get_product_thumbnail( $size = 'product_small_thumbnail', $placeholder_width = 0, $placeholder_height = 0  ) {
	global $post;

	if ( has_post_thumbnail() ) {
		$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'shop_catalog' );
		return get_the_post_thumbnail( $post->ID, $size, array('data-src' => $image_src[0], 'class' => 'lazyOwl') );
		//return '<div><img data-src="' . $image_src[0] . '" class="lazyOwl"></div>';
	} elseif ( wc_placeholder_img_src() ) {
		return wc_placeholder_img( $size );
	}
}






/******************************************************************************/
/* WooCommerce Wrap Oembed Stuff **********************************************/
/******************************************************************************/
add_filter('embed_oembed_html', 'rebell_embed_oembed_html', 99, 4);
function rebell_embed_oembed_html($html, $url, $attr, $post_id) {
	if ( strstr( $html,'youtube.com/embed/' ) || strstr( $html,'player.vimeo.com' ) ) {
		return '<div class="video-container responsive-embed widescreen">' . $html . '</div>';
	}

	return '<div class="video-container">' . $html . '</div>';
}

/******************************************************************************/
/****** Set woocommerce images sizes ******************************************/
/******************************************************************************/

/**
 * Hook in on activation
 */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'rebell_woocommerce_image_dimensions', 1 );

/**
 * Define image sizes
 */
function rebell_woocommerce_image_dimensions() {
  	$catalog = array(
		'width' 	=> '350',	// px
		'height'	=> '435',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '570',	// px
		'height'	=> '708',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '70',	// px
		'height'	=> '87',	// px
		'crop'		=> 1 		// false
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

if ( ! function_exists('rebell_woocommerce_image_dimensions') ) :
	function rebell_woocommerce_image_dimensions() {
		global $pagenow;
	 
		if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
			return;
		}

	  	$catalog = array(
			'width' 	=> '350',	// px
			'height'	=> '435',	// px
			'crop'		=> 1 		// true
		);

		$single = array(
			'width' 	=> '570',	// px
			'height'	=> '708',	// px
			'crop'		=> 1 		// true
		);

		$thumbnail = array(
			'width' 	=> '70',	// px
			'height'	=> '87',	// px
			'crop'		=> 0 		// false
		);

		// Image sizes
		update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
		update_option( 'shop_single_image_size', $single ); 		// Single product image
		update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
	}
	add_action( 'after_switch_theme', 'rebell_woocommerce_image_dimensions', 1 );
endif;

if ( ! isset( $content_width ) ) $content_width = 900;

/******************************************************************************/
/****** Limit number of cross-sells *******************************************/
/******************************************************************************/
add_filter('woocommerce_cross_sells_total', 'cartCrossSellTotal');
function cartCrossSellTotal($total) {
	$total = '2';
	return $total;
}

/******************************************************************************/
/****** Custom Sale label *****************************************************/
/******************************************************************************/

if( !GETBOWTIED_WOOCOMMERCE_SALE_FLASH_PRO_IS_ACTIVE ) {
	add_filter('woocommerce_sale_flash', 'woocommerce_custom_sale_tag_sale_flash', 10, 3);
}
function woocommerce_custom_sale_tag_sale_flash($original, $post, $product) {
	global $rebell_theme_options;

	if (!empty($rebell_theme_options['sale_label'])):
		echo '<span class="onsale">'. esc_html__( $rebell_theme_options['sale_label'], 'woocommerce' ) .'</span>';
	else: 
		echo '';
	endif;
}

/******************************************************************************/
/****** whitelist style for wp_kses_post() *******************************/
/******************************************************************************/

add_action('init', 'my_html_tags_code', 10);
function my_html_tags_code() {
  global $allowedposttags;
    $allowedposttags["style"] = array();
}

add_action('woocommerce_archive_description', 'custom_add_notice_search', 10, 1);
function custom_add_notice_search($message) {
	
	if ( is_search() ) {
		return false;
	}
}


//==============================================================================
// Show Woocommerce Cart Widget Everywhere
//==============================================================================
if ( ! function_exists('getbowtied_woocommerce_widget_cart_everywhere') ) :
function getbowtied_woocommerce_widget_cart_everywhere() { 
    return false; 
};
add_filter( 'woocommerce_widget_cart_is_hidden', 'getbowtied_woocommerce_widget_cart_everywhere', 10, 1 );
endif;


//==============================================================================
// Wishlist message notification remove
//==============================================================================

function yith_wcwl_added_to_cart_message( $message ){
   return false;
}
add_action( 'yith_wcwl_added_to_cart_message', 'yith_wcwl_added_to_cart_message' );


//==============================================================================
// Woocommerce Product Page Get Caption Text
//==============================================================================
function wp_get_attachment( $attachment_id ) {
    $attachment = get_post( $attachment_id );
    return array(
        'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink( $attachment->ID ),
        'src' => $attachment->guid,
        'title' => $attachment->post_title
    );
}

//==============================================================================
//	Continue shopping button on cart page
//==============================================================================
add_action( 'woocommerce_after_cart', 'rebell_add_continue_shopping_button_to_cart' );
if  ( ! function_exists('rebell_add_continue_shopping_button_to_cart') ) :
	function rebell_add_continue_shopping_button_to_cart() {
	$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
	if (!empty($shop_page_url)):
		echo '<div class="rebell-continue-shopping">';
		echo ' <a href="'.$shop_page_url.'" class="button">'. esc_html__('Continue shopping', 'woocommerce') .'</a>';
		echo '</div>';
	endif;
}
endif;

//==============================================================================
//	Custom WooCommerce related products
//==============================================================================
if ( ! function_exists( 'getbowtied_output_related' ) ) {
	function getbowtied_output_related() {
		global $rebell_theme_options;
		if ( isset($rebell_theme_options['related_products']) && ($rebell_theme_options['related_products'] == 1) ) {

			$related_products_number = isset($rebell_theme_options['related_products_number']) ? $rebell_theme_options['related_products_number'] : '4';

			echo '<div class="row">';
				echo '<div class="large-12 large-centered columns">';
			    $atts = array(
					'columns'		 => $related_products_number,
					'posts_per_page' => $related_products_number,
					'orderby'        => 'rand'
				);
				woocommerce_related_products($atts); // Display 3 products in rows of 3
		    	echo '</div>';
		    echo '</div>';
		}
	}
}

//==============================================================================
//	Custom WooCommerce upsells 
//==============================================================================
if ( ! function_exists( 'getbowtied_output_upsells' ) ) {
	function getbowtied_output_upsells() {
		global $rebell_theme_options;
		
		echo '<div class="row">';
			echo '<div class="large-12 large-centered columns">';

			$related_products_number = isset($rebell_theme_options['related_products_number']) ? $rebell_theme_options['related_products_number'] : '4';
			woocommerce_upsell_display( $related_products_number, $related_products_number ); // Display 3 products in rows of 3 
	    	echo '</div>';
	    echo '</div>';
	}
}

if ( ! function_exists( 'get_customize_section_url' ) ) {
	function get_customize_section_url() {
		switch($_POST['page']) {
			case 'shop': 
				echo get_permalink( wc_get_page_id( 'shop' ) ); 
				break;
			case 'blog': 
				echo get_permalink( get_option( 'page_for_posts' ) ); 
				break;
			case 'product': 
				$args = array('orderby' => 'rand', 'limit' => 1); 
				$product = wc_get_products($args); 
				echo get_permalink( $product[0]->get_id() ); 
				break;
			case 'post': 
				$args = array('orderby' => 'rand', 'posts_per_page' => 1); 
				$post = get_posts($args); 
				echo get_permalink( $post[0]->ID ); 
				break;
			default:
				echo get_home_url();
				break;
		}
		exit();
	}
	add_action( 'wp_ajax_get_url', 'get_customize_section_url' );
}


//==============================================================================
//	Top Bar Languages DropDown
//==============================================================================
function languages_top_bar(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');

    if(!empty($languages)) : ?>

       <div id="top_bar_language_list" class="topbar-language-switcher">

       <ul>
			<li class="menu-item-first"><a href="#"><?php echo ICL_LANGUAGE_NAME; ?></a>

			<ul class="sub-menu">

	       <?php
	        foreach($languages as $l) {
	            echo '<li class="sub-menu-item">';
	            if($l['country_flag_url']){
	                if(!$l['active']) echo '<a class="flag" href="'.$l['url'].'">';
	                echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
	                if(!$l['active']) echo '</a>';
	            }
	            if(!$l['active']) echo '<a href="'.$l['url'].'">';
	            echo apply_filters( 'wpml_display_language_names', NULL, $l['native_name'], $l['translated_name'] );
	            if(!$l['active']) echo '</a>';
	            echo '</li>';
	        }

	        echo '</ul></li>';
	        ?>

    <?php endif; ?>
	<?php echo '</ul></div>'; 
}


if( GETBOWTIED_GERMAN_MARKET_IS_ACTIVE ) {

	function german_market_compatibility() {
		remove_action( 'woocommerce_single_product_summary',		array( 'WGM_Template', 'woocommerce_de_price_with_tax_hint_single' ), 7 );
		remove_action( 'woocommerce_after_shop_loop_item_title',	array( 'WGM_Template', 'woocommerce_de_price_with_tax_hint_loop' ), 5 );

		add_action( 'woocommerce_single_product_german_market_info',	array( 'WGM_Template', 'woocommerce_de_price_with_tax_hint_single' ), 7 );
		add_filter( 'woocommerce_single_product_german_market_info', 	'__return_true' );
	}

	german_market_compatibility();
}

if( GETBOWTIED_WOOCOMMERCE_GERMANIZED_IS_ACTIVE ) {

	function germanized_compatibility() {

		if ( get_option( 'woocommerce_gzd_display_product_detail_unit_price' ) == 'yes' ) {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_gzd_template_single_price_unit', wc_gzd_get_hook_priority( 'single_price_unit' ) );
			add_action( 'woocommerce_single_product_germanized_info', 'woocommerce_gzd_template_single_price_unit', wc_gzd_get_hook_priority( 'single_price_unit' ) );
		}

		if ( get_option( 'woocommerce_gzd_display_product_detail_tax_info' ) == 'yes' || get_option( 'woocommerce_gzd_display_product_detail_shipping_costs' ) == 'yes' ) {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_gzd_template_single_legal_info', wc_gzd_get_hook_priority( 'single_legal_info' ) );
			add_action( 'woocommerce_single_product_germanized_info', 'woocommerce_gzd_template_single_legal_info', wc_gzd_get_hook_priority( 'single_legal_info' ) );
		}

		if ( get_option( 'woocommerce_gzd_display_product_detail_delivery_time' ) == 'yes' ) {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_gzd_template_single_delivery_time_info', wc_gzd_get_hook_priority( 'single_delivery_time_info' ) );
			add_action( 'woocommerce_single_product_germanized_info', 'woocommerce_gzd_template_single_delivery_time_info', wc_gzd_get_hook_priority( 'single_delivery_time_info' ) );
		}

		if ( get_option( 'woocommerce_gzd_display_product_detail_product_units' ) == 'yes' ) {
			remove_action( 'woocommerce_product_meta_start', 'woocommerce_gzd_template_single_product_units', wc_gzd_get_hook_priority( 'single_product_units' ) );
			add_action( 'woocommerce_single_product_germanized_info', 'woocommerce_gzd_template_single_product_units', wc_gzd_get_hook_priority( 'single_product_units' ) );
		}

		if ( get_option( 'woocommerce_gzd_display_listings_unit_price' ) == 'yes' ) {
	        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_gzd_template_single_price_unit', wc_gzd_get_hook_priority( 'loop_price_unit' ) );
	        add_action( 'woocommerce_germanized_unit_price', 'woocommerce_gzd_template_single_price_unit', 1 );
	    }
	}

	germanized_compatibility();
}

//==============================================================================
//	External Product in new tab
//==============================================================================

remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
add_action( 'woocommerce_external_add_to_cart', 'getbowtied_rei_external_add_to_cart', 30 );
function getbowtied_rei_external_add_to_cart(){

    global $product;

    if ( ! $product->add_to_cart_url() ) {
        return;
    }

    $product_url = $product->add_to_cart_url();
    $button_text = $product->single_add_to_cart_text();

    do_action( 'woocommerce_before_add_to_cart_button' ); ?>
    <p class="cart">
        <a href="<?php echo esc_url( $product_url ); ?>" target="_blank" rel="nofollow" class="single_add_to_cart_button button alt"><?php echo esc_html( $button_text ); ?></a>
    </p>
    <?php do_action( 'woocommerce_after_add_to_cart_button' );
}

//==============================================================================
//	Shop loop columns
//==============================================================================
//
if ( !function_exists('rebell_loop_columns_class')):
	function rebell_loop_columns_class() {
		global $rebell_theme_options, $woocommerce_loop;
		if ( ( isset($woocommerce_loop['columns']) && $woocommerce_loop['columns'] != "" ) ) {
			$products_per_column = $woocommerce_loop['columns'];
		} else {
			$products_per_column = get_option('woocommerce_catalog_columns', 5);

			if (isset($_GET["products_per_row"])) {
				$products_per_column = $_GET["products_per_row"];
			}
		}

		if ($products_per_column == 6) {
			$products_per_column_xlarge = 6;
			$products_per_column_large = 4;
			$products_per_column_medium = 3;
		}

		if ($products_per_column == 5) {
			$products_per_column_xlarge = 5;
			$products_per_column_large = 4;
			$products_per_column_medium = 3;
		}

		if ($products_per_column == 4) {
			$products_per_column_xlarge = 4;
			$products_per_column_large = 4;
			$products_per_column_medium = 3;
		}

		if ($products_per_column == 3) {
			$products_per_column_xlarge = 3;
			$products_per_column_large = 3;
			$products_per_column_medium = 2;
		}

		if ($products_per_column == 2) {
			$products_per_column_xlarge = 2;
			$products_per_column_large = 2;
			$products_per_column_medium = 2;
		}

		if ($products_per_column == 1) {
			$products_per_column_xlarge = 1;
			$products_per_column_large = 1;
			$products_per_column_medium = 1;
		}
		echo esc_attr($rebell_theme_options['mobile_columns']) == 1 ? 'small-up-1' : 'small-up-2'; ?> medium-up-<?php echo esc_attr($products_per_column_medium); ?> large-up-<?php echo esc_attr($products_per_column_large); ?> xlarge-up-<?php echo esc_attr($products_per_column_xlarge); ?> xxlarge-up-<?php echo esc_attr($products_per_column);
	}
endif;

// Deactivate out of stock variations in select
add_filter( 'woocommerce_variation_is_active', 'gbt_variation_is_active', 10, 2 );
if( !function_exists('gbt_variation_is_active') ) {
	function gbt_variation_is_active( $active, $variation ) {
		global $rebell_theme_options;

		if( $rebell_theme_options['disabled_outofstock_variations'] ) {
			if( ! $variation->is_in_stock() ) {
				return false;
			}
		}

		return $active;
	}
}

// Deactivate AJAX Add to Cart when incompatible plugin is active
function gbt_deactivate_ajax_add_to_cart() {

	global $rebell_theme_options;

	if( class_exists('WC_Product_Addons') || class_exists('Wcff') ) {

		set_theme_mod( 'ajax_add_to_cart', false);
	}
}
add_action( 'init', 'gbt_deactivate_ajax_add_to_cart' );

function gbt_customizer_deactivate_ajax_add_to_cart() {

	$active_option['active_option'] = '1';
	$active_option['plugin'] = '';

	if( class_exists('WC_Product_Addons') ) {
		$active_option['active_option'] = '0';
		$active_option['plugin'] .= 'incompatible-woo-addons ';
	}

	if( class_exists('Wcff') ) {
		$active_option['active_option'] = '0';
		$active_option['plugin'] .= 'incompatible-fields-factory ';
	}

	wp_localize_script( 'rebell-customizer', 'getbowtied_customizer_vars', $active_option );
}
add_action( 'admin_enqueue_scripts', 'gbt_customizer_deactivate_ajax_add_to_cart' );

function nightowl_add_to_cart_redirect( $url ) {
	$url = wc_get_cart_url();
	return $url;
}
add_filter( 'woocommerce_add_to_cart_redirect', 'nightowl_add_to_cart_redirect' );


//чистка кеша aws
add_action( 'wp', 'activation_aws_clear_hook' );
function activation_aws_clear_hook() {
	if( ! wp_next_scheduled( 'clear_aws_cache_hook' ) ) {
		wp_schedule_event( strtotime('23:00:00'), 'daily', 'clear_aws_cache_hook');
	}
}

add_action( 'clear_aws_cache_hook', 'clear_aws_cache' );
function clear_aws_cache() {
	global $wpdb;
    
    $terms = "aws_search_term_%";
    $where = $wpdb->prepare( " name LIKE %s", $terms );

    $sql = "DELETE FROM wp_aws_cache
        WHERE {$where}
            ";

    $wpdb->query( $sql );
    
}

add_filter('woocommerce_checkout_fields', 'no_email_validation', 20);

function no_email_validation($fields){

  $fields['billing']['billing_email']['required'] = false;

  return $fields;

}


//обнуляем теги для похожих товаров, что бы искало только по категории
add_filter( 'woocommerce_get_related_product_tag_terms', 'filter_woocommerce_get_related_product_tag_terms', 10, 2 ); 
function filter_woocommerce_get_related_product_tag_terms( $term_ids, $product_id ) {
	return array();
}


add_filter( 'woocommerce_loop_add_to_cart_link', 'replace_loop_add_to_cart_button', 10, 2 );
function replace_loop_add_to_cart_button( $button, $product  ) {
    // if( $product->is_type( 'variable' ) ) return $button;
    $button_text = __( "Купить", "woocommerce" );

    return '<a class="button add_to_cart_button" href="' . $product->get_permalink() . '">' . $button_text . '</a>';
}