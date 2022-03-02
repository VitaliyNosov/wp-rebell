<?php
	global $rebell_theme_options, $woocommerce, $wp_version;
?>

<!DOCTYPE html>

<!--[if IE 9]>
<html class="ie ie9" <?php language_attributes(); ?>>
<![endif]-->

<html <?php language_attributes(); ?>>

<head>
	<!-- Google Tag Manager -->
<!-- End Google Tag Manager -->
	<meta name="facebook-domain-verification" content="cbvl4df8wai3x0jidgfe7aboued1do" />
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    
    <link rel="profile" href="//gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"> 
	<meta name="google-site-verification" content="9Vvfg9TcqKkYUq8eCH33Ai2b-luYPziz3pK2xbjQXJ8" />
	<?php  if ((is_page('2'))){
			?>		
			
<style>.entry-header {display:none!important;}</style>
			<?php
}?>
	
	
	<?php if(is_front_page()) : ?>
		<link rel="preload" href="/wp-content/uploads/2021/04/banner-1.jpg" as="image" />
	<?php endif; ?>
	
    
    <?php wp_head(); ?>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P9D4L9B');</script>
</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-P9D4L9B"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

	<?php if( (isset($rebell_theme_options['smooth_transition_between_pages'])) && ($rebell_theme_options['smooth_transition_between_pages'] == "1" ) ) { ?>
		<div id="header-loader">
		    <div id="header-loader-under-bar"></div>
		</div>
	<?php }	?>

	<div id="st-container" class="st-container">

        <div class="st-content">
            
            <?php

			$header_sticky_class = "";
			$header_transparency_class = "";
			$transparency_scheme = "";
			
			if ( (isset($rebell_theme_options['sticky_header'])) && ($rebell_theme_options['sticky_header'] == "1" ) ) {
				$header_sticky_class = "sticky_header";
			}
			
			if ( (isset($rebell_theme_options['main_header_transparency'])) && ($rebell_theme_options['main_header_transparency'] == "1" ) ) {
				$header_transparency_class = "transparent_header";
			}
			
			if ( (isset($rebell_theme_options['main_header_transparency_scheme'])) ) {
				$transparency_scheme = $rebell_theme_options['main_header_transparency_scheme'];
			}
			
			$page_id = "";
			if ( is_single() || is_page() ) {
				$page_id = get_the_ID();
			} else if ( is_home() ) {
				$page_id = get_option('page_for_posts');		
			} else if (class_exists('WooCommerce') && is_shop()) {
				$page_id = get_option( 'woocommerce_shop_page_id' );
			}
			
			if ( (get_post_meta($page_id, 'page_header_transparency', true)) && (get_post_meta($page_id, 'page_header_transparency', true) != "inherit") ) {
				$header_transparency_class = "transparent_header";
				$transparency_scheme = get_post_meta( $page_id, 'page_header_transparency', true );
			}
			
			if ( (get_post_meta($page_id, 'page_header_transparency', true)) && (get_post_meta($page_id, 'page_header_transparency', true) == "no_transparency") ) {
				$header_transparency_class = "";
				$transparency_scheme = "";
			}

			if (class_exists('WooCommerce')) 
            {
                if ( is_product_category() && is_woocommerce() )
                {
                	if ( $rebell_theme_options['shop_category_header_transparency_scheme'] == 'inherit' )
                	{
                		// do nothing, inherit
                	}
                	else if ( $rebell_theme_options['shop_category_header_transparency_scheme'] == 'no_transparency' )
                	{
                		$header_transparency_class = "";
						$transparency_scheme = "";
                	}
                	else 
                	{
                        $header_transparency_class = "transparent_header";
                        $transparency_scheme = $rebell_theme_options['shop_category_header_transparency_scheme'];
                	}
                }
            }
			
			?>
            
            <div id="page_wrapper" class="<?php echo esc_attr( $header_sticky_class ); ?> <?php echo esc_attr( $header_transparency_class ); ?> <?php echo esc_attr( $transparency_scheme ); ?>">
            
                <?php do_action( 'before' ); ?>                     
                
                <?php

				$header_max_width_style = "100%";
				if ( (isset($rebell_theme_options['header_width'])) && ($rebell_theme_options['header_width'] == "custom") ) {
					$header_max_width_style = $rebell_theme_options['header_max_width']."px";
				} else {
					$header_max_width_style = "100%";
				}
				
				?>
                
                <div class="top-headers-wrapper">
				
                    <?php if ( (isset($rebell_theme_options['top_bar_switch'])) && ($rebell_theme_options['top_bar_switch'] == "1" ) ) : ?>                        
                        <?php include( get_parent_theme_file_path('header-topbar.php') ); ?>						
                    <?php endif; ?>
                    
                    <?php if ( isset($rebell_theme_options['main_header_layout']) ) : ?>
						
						<?php if ( $rebell_theme_options['main_header_layout'] == "1" || $rebell_theme_options['main_header_layout'] == "11" ) : ?>
							<?php include( get_parent_theme_file_path('header-default.php') ); ?>
                        <?php elseif ( $rebell_theme_options['main_header_layout'] == "2" || $rebell_theme_options['main_header_layout'] == "22" ) : ?>
                        	<?php include( get_parent_theme_file_path('header-centered-2menus.php') ); ?>
                        <?php elseif ( $rebell_theme_options['main_header_layout'] == "3" ) : ?>
                        	<?php include( get_parent_theme_file_path('header-centered-menu-under.php') ); ?>
						<?php endif; ?>
                        
                    <?php else : ?>
                    
                    	<?php include( get_parent_theme_file_path('header-default.php') ); ?>
                    
                    <?php endif; ?>
                
                </div>
				
				