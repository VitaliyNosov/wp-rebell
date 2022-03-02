<?php global $yith_wcwl, $woocommerce; ?>

<?php 
    $header_alignment = $rebell_theme_options['main_header_layout'] == 1 ? 'align_left' : 'align_right'; 
?>

<header id="masthead" class="site-header default" role="banner">

    <?php if ( (isset($rebell_theme_options['header_width'])) && ($rebell_theme_options['header_width'] == "custom") ) : ?>
    <div class="row">		
<div class="large-12 columns">
    <?php endif; ?>    
        
       <div class="site-header-wrapper" style="max-width:<?php echo esc_html($header_max_width_style); ?>">
			
		<div class="row">		
			<div class="large-3 columns">
                
                <div class="site-branding">
                        
                    <?php
					
                    if ( (isset($rebell_theme_options['site_logo'])) && (trim($rebell_theme_options['site_logo']) != "" ) ) {
						if (is_ssl()) {
                            $site_logo = str_replace("//", "//", $rebell_theme_options['site_logo']);	
							if ($header_transparency_class == "transparent_header")	{
								if ( ($transparency_scheme == "transparency_light") && (isset($rebell_theme_options['light_transparent_header_logo'])) && (trim($rebell_theme_options['light_transparent_header_logo']) != "") ) {
									$site_logo = str_replace("//", "//", $rebell_theme_options['light_transparent_header_logo']);	
								}
								if ( ($transparency_scheme == "transparency_dark") && (isset($rebell_theme_options['dark_transparent_header_logo'])) && (trim($rebell_theme_options['dark_transparent_header_logo']) != "") ) {
									$site_logo = str_replace("//", "//", $rebell_theme_options['dark_transparent_header_logo']);	
								}
							}
                        } else {
                            $site_logo = $rebell_theme_options['site_logo'];
							if ($header_transparency_class == "transparent_header")	{
								if ( ($transparency_scheme == "transparency_light") && (isset($rebell_theme_options['light_transparent_header_logo'])) && (trim($rebell_theme_options['light_transparent_header_logo']) != "") ) {
									$site_logo = $rebell_theme_options['light_transparent_header_logo'];
								}
								if ( ($transparency_scheme == "transparency_dark") && (isset($rebell_theme_options['dark_transparent_header_logo'])) && (trim($rebell_theme_options['dark_transparent_header_logo']) != "") ) {
									$site_logo = $rebell_theme_options['dark_transparent_header_logo'];
								}
							}
                        }
						
						if ( (isset($rebell_theme_options['sticky_header_logo'])) && (trim($rebell_theme_options['sticky_header_logo']) != "" ) ) {
							if (is_ssl()) {
								$sticky_header_logo = str_replace("//", "//", $rebell_theme_options['sticky_header_logo']);		
							} else {
								$sticky_header_logo = $rebell_theme_options['sticky_header_logo'];
							}
						}
						
						
                    ?>
    
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        	<img class="site-logo" src="//rebel.in.ua/wp-content/uploads/2019/11/rebel_style.png" title="<?php bloginfo( 'description' ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
                            <?php if ( (isset($rebell_theme_options['sticky_header_logo'])) && (trim($rebell_theme_options['sticky_header_logo']) != "" ) ) { ?>
                            	<img class="sticky-logo" src="//rebel.in.ua/wp-content/uploads/2019/11/rebel_style.png" title="<?php bloginfo( 'description' ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
                            <?php } ?>
                        </a>
                    
                    <?php } else { ?>
                    
                        <div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
                    
                    <?php } ?>
                    
                </div><!-- .site-branding --> 
			</div>
				
			<div class="large-6 columns">
				<div class="top_header_wrapper">
					<div class="top_header_phones">
						<i class="fa fa-mobile fa-2x colored_top_button" aria-hidden="true"></i><span class="mobile_disabled"></span>
						<a class="left_indent_link mobile_enabled" href="tel:+380637027978">+380637027978 (viber, whatsapp, telegram)</a> <br> 
					</div>
					<div class="top_header_adress mobile_disabled">
						<div>
							<i class="fa fa-map-marker fa-2x colored_top_button indent_mobile_header" aria-hidden="true"></i><a class="adress_indent_link" href="<?php _e('/kontakty/', 'header')?>"><?php _e('г. Киев ул. Архитектора Вербицкого 18', 'header')?></a> 
						</div>
						<div>
							<i class="fa fa-map-marker fa-2x colored_top_button indent_mobile_header" aria-hidden="true"></i><a class="adress_indent_link" href="<?php _e('/kontakty/', 'header')?>"><?php _e('г. Днепр, ул. В.Вернадского, 23Б', 'header')?></a> 
						</div>
					</div>
				</div>
			
			</div>	
            <div class="large-3 columns">
            	<?php do_action('wpml_add_language_selector'); ?>
            	<div id="mobile_addresses">
            		<div id="mobile_addresses_wrap">
            			<div class="mobile_address">
		            		<i class="fa fa-map-marker fa-2x colored_top_button indent_mobile_header" aria-hidden="true"></i><a class="adress_indent_link" href="<?php _e('/kontakty/', 'header')?>"><?php _e('г. Днепр', 'header')?></a>
            			</div>
            			<div class="mobile_address">
		            		<i class="fa fa-map-marker fa-2x colored_top_button indent_mobile_header" aria-hidden="true"></i><a class="adress_indent_link" href="<?php _e('/kontakty/', 'header')?>"><?php _e('г. Киев', 'header')?></a>
		            	</div>
            		</div>
            	</div>
                <?php 
				$site_tools_padding_class = "";
				if ( (isset($rebell_theme_options['main_header_off_canvas'])) && ($rebell_theme_options['main_header_off_canvas'] == "1") ) {
					if ( (!isset($rebell_theme_options['main_header_off_canvas_icon'])) || ($rebell_theme_options['main_header_off_canvas_icon']) == "" ) {
                		$site_tools_padding_class = "offset";
					}
				}
				elseif ( (isset($rebell_theme_options['main_header_search_bar'])) && ($rebell_theme_options['main_header_search_bar'] == "1") ) {
                	if ( (!isset($rebell_theme_options['main_header_search_bar_icon'])) || ($rebell_theme_options['main_header_search_bar_icon']) == "" ) {
						$site_tools_padding_class = "offset";
					}
				}
                ?>
                    
                <div class="site-tools <?php echo esc_html($site_tools_padding_class); ?> <?php if ( (isset($header_alignment)) ) echo esc_html($header_alignment); ?>">
                    <ul>
                       
												
                        <?php if (class_exists('YITH_WCWL')) : ?>
                        <?php if ( (isset($rebell_theme_options['main_header_wishlist'])) && ($rebell_theme_options['main_header_wishlist'] == "1") ) : ?>
                        <li class="wishlist-button" title="Избранное">
                            <a href="/izbrannoe/" class="tools_button">
                                <span class="tools_button_icon">
                                    <?php if ( (isset($rebell_theme_options['main_header_wishlist_icon'])) && ($rebell_theme_options['main_header_wishlist_icon'] != "") ) : ?>
                                    <img src="<?php echo esc_url($rebell_theme_options['main_header_wishlist_icon']); ?>">
                                    <?php else : ?>
                                    <i class="spk-icon spk-icon-heart"></i>
									<?php endif; ?>
                                </span>
                                <span class="wishlist_items_number"><?php echo yith_wcwl_count_products(); ?></span>
                            </a>
                        </li>							
                        <?php endif; ?>
                        <?php endif; ?>
                        
                        <?php if (class_exists('WooCommerce')) : ?>

                            <?php if ( (isset($rebell_theme_options['main_header_shopping_bag'])) && ($rebell_theme_options['main_header_shopping_bag'] == "1") ) : ?>
                            <?php if ( (isset($rebell_theme_options['catalog_mode'])) && ($rebell_theme_options['catalog_mode'] == 1) ) : ?>
                            <?php else : ?>
                            <li class="shopping-bag-button" title="Корзина">
                                <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="tools_button">
                                    <span class="tools_button_icon">
                                    	<?php if ( (isset($rebell_theme_options['main_header_shopping_bag_icon'])) && ($rebell_theme_options['main_header_shopping_bag_icon'] != "") ) : ?>
                                        <img src="<?php echo esc_url($rebell_theme_options['main_header_shopping_bag_icon']); ?>">
                                        <?php else : ?>
                                        <i class="spk-icon spk-icon-cart-rebell"></i>
    									<?php endif; ?>
                                    </span>
                                    <span class="shopping_bag_items_number"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php endif; ?>

                            <?php if ( (isset($rebell_theme_options['my_account_icon_state'])) && ($rebell_theme_options['my_account_icon_state'] == "1") ) : ?>
                            <li class="my_account_icon" title="Мой аккаунт">
                                <a class="tools_button" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
                                    <span class="tools_button_icon">
                                        <?php if ( (isset($rebell_theme_options['custom_my_account_icon'])) && ($rebell_theme_options['custom_my_account_icon'] != "") ) : ?>
                                        <img src="<?php echo esc_url($rebell_theme_options['custom_my_account_icon']); ?>">
                                        <?php else : ?>
                                        <i class="spk-icon spk-icon-user-account"></i>
                                        <?php endif; ?>
                                    </span>
                                </a>
                            </li>
                            <?php endif; ?>
                            
                        <?php endif; ?>
						
						<li class="" title="Мы на карте">
							<a class="tools_button" href="//goo.gl/maps/HtxuxZpqntRurkRn9">
								<span class="tools_button_icon">
									<!-- <span class="icon-map-pin-stroke header_map_button"></span>-->
									<span class="icon-map-marker header_map_button"></span>								
								</span>
							</a>
						</li>
						<li>
							<div class="sk_social_icon icon_instagram">
										<a class="sk_social_icon_link" target="_blank" href="//www.instagram.com/rebel_in.ua/">
											<svg class="" xmlns="//www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 50 50">    
												<path d="M 16 3 C 8.83 3 3 8.83 3 16 L 3 34 C 3 41.17 8.83 47 16 47 L 34 47 C 41.17 47 47 41.17 47 34 L 47 16 C 47 8.83 41.17 3 34 3 L 16 3 z M 37 11 C 38.1 11 39 11.9 39 13 C 39 14.1 38.1 15 37 15 C 35.9 15 35 14.1 35 13 C 35 11.9 35.9 11 37 11 z M 25 14 C 31.07 14 36 18.93 36 25 C 36 31.07 31.07 36 25 36 C 18.93 36 14 31.07 14 25 C 14 18.93 18.93 14 25 14 z M 25 16 C 20.04 16 16 20.04 16 25 C 16 29.96 20.04 34 25 34 C 29.96 34 34 29.96 34 25 C 34 20.04 29.96 16 25 16 z"></path>
											</svg>
										</a>
									</div>
								
						</li>
						<li>
							<div class="sk_social_icon icon_facebook">
	                        <a class="sk_social_icon_link" target="_blank" href="//www.facebook.com/rebelstyledn">
	                        	<svg class="" xmlns="//www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 50 50">    
									<path d="M32,11h5c0.552,0,1-0.448,1-1V3.263c0-0.524-0.403-0.96-0.925-0.997C35.484,2.153,32.376,2,30.141,2C24,2,20,5.68,20,12.368 V19h-7c-0.552,0-1,0.448-1,1v7c0,0.552,0.448,1,1,1h7v19c0,0.552,0.448,1,1,1h7c0.552,0,1-0.448,1-1V28h7.222 c0.51,0,0.938-0.383,0.994-0.89l0.778-7C38.06,19.518,37.596,19,37,19h-8v-5C29,12.343,30.343,11,32,11z"></path>
								</svg>
	                        </a>
	                    </div>
						</li>
                       <!--  <li  title="Соц. сети" class="my_account_icon share_icon_header dropdown">
							<div class="tools_button">
								<span class="tools_button_icon">
									  <span class="icon-share header_map_button"></span>
								</span>
							</div>
							
							<div id="top_header_drop" class="top_header_info-drop">
								<div class="dropdown__list">
									<div class="sk_social_icon icon_instagram">
										<a class="sk_social_icon_link" target="_blank" href="//www.instagram.com/rebel_styleshop/">
											<svg class="" xmlns="//www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 50 50">    
												<path d="M 16 3 C 8.83 3 3 8.83 3 16 L 3 34 C 3 41.17 8.83 47 16 47 L 34 47 C 41.17 47 47 41.17 47 34 L 47 16 C 47 8.83 41.17 3 34 3 L 16 3 z M 37 11 C 38.1 11 39 11.9 39 13 C 39 14.1 38.1 15 37 15 C 35.9 15 35 14.1 35 13 C 35 11.9 35.9 11 37 11 z M 25 14 C 31.07 14 36 18.93 36 25 C 36 31.07 31.07 36 25 36 C 18.93 36 14 31.07 14 25 C 14 18.93 18.93 14 25 14 z M 25 16 C 20.04 16 16 20.04 16 25 C 16 29.96 20.04 34 25 34 C 29.96 34 34 29.96 34 25 C 34 20.04 29.96 16 25 16 z"></path>
											</svg>
										</a>
									</div>
								
								

									<div class="sk_social_icon icon_facebook">
	                        <a class="sk_social_icon_link" target="_blank" href="//www.facebook.com/rebelstyledn">
	                        	<svg class="" xmlns="//www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 50 50">    
									<path d="M32,11h5c0.552,0,1-0.448,1-1V3.263c0-0.524-0.403-0.96-0.925-0.997C35.484,2.153,32.376,2,30.141,2C24,2,20,5.68,20,12.368 V19h-7c-0.552,0-1,0.448-1,1v7c0,0.552,0.448,1,1,1h7v19c0,0.552,0.448,1,1,1h7c0.552,0,1-0.448,1-1V28h7.222 c0.51,0,0.938-0.383,0.994-0.89l0.778-7C38.06,19.518,37.596,19,37,19h-8v-5C29,12.343,30.343,11,32,11z"></path>
								</svg>
	                        </a>
	                    </div>
									
									
									
									
									
								
								
									
								</div>
								
							</div>

							
							
						</li> -->
						

                        <li class="offcanvas-menu-button <?php if ( (isset($rebell_theme_options['main_header_off_canvas'])) && ($rebell_theme_options['main_header_off_canvas'] == "0") ) : ?>hide-for-large<?php endif; ?>">
                            <a class="tools_button" data-toggle="offCanvasRight1">
                                <span class="tools_button_icon">
                                	<?php if ( (isset($rebell_theme_options['main_header_off_canvas_icon'])) && ($rebell_theme_options['main_header_off_canvas_icon'] != "") ) : ?>
                                    <img src="<?php echo esc_url($rebell_theme_options['main_header_off_canvas_icon']); ?>">
                                    <?php else : ?>
                                    <i class="spk-icon spk-icon-menu"></i>
									<?php endif; ?>
                                </span>
                            </a>
                        </li>
                       
                    </ul>
                </div>
                

                
            
			<div style="clear:both"></div>
			</div> 
            </div>                
          </div><!--.site-header-wrapper-->
        
    <?php if ( (isset($rebell_theme_options['header_width'])) && ($rebell_theme_options['header_width'] == "custom") ) : ?>
        </div><!-- .columns -->
    </div><!-- .row -->
    <?php endif; ?>

<div class="row">		
      <div class="large-9 columns">	
			    <nav class="show-for-large main-navigation default-navigation <?php if ( (isset($header_alignment)) ) echo esc_html($header_alignment); ?>" role="navigation">                    
                    <?php 
                        $args = array(
                            'theme_location'  => 'main-navigation',
                            'fallback_cb'     => false,
                            'container'       => false,
                            'items_wrap'      => '<ul class="%1$s">%3$s</ul>'
                        );

                        if( class_exists('rc_scm_walker') ) {
                            $args['walker'] = new rc_scm_walker;
                        }

						wp_nav_menu( $args );
                    ?>           
                </nav><!-- .main-navigation -->
			</div><!-- .columns -->
		<div class="large-3 columns">	
				<div class="top_search_wrapper"><?php if ( function_exists( 'aws_get_search_form' ) ) { aws_get_search_form(); } ?></div>
      </div><!-- .columns -->
</div><!-- .row -->	
	
</header><!-- #masthead -->