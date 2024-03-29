jQuery( function($){

	//==============================================================================
	//	Minicart events
	//==============================================================================

	/* open minicart on click */
	if (getbowtied_scripts_vars.option_minicart == 1 && getbowtied_scripts_vars.option_minicart_open == 1) {

		$('body').on('click', '.shopping-bag-button .tools_button', function(e) {

			if( $('body').hasClass('gbt_custom_notif') ) {
				$('.gbt-custom-notification-notice').removeClass('open-notice').removeAttr( 'style' ).addClass('fade-out-notice');
			}

			if ( $(window).width() >= 1024 ) {

				calculate_minicart_margin();

				e.preventDefault();
				$('.rebell-mini-cart').toggleClass('open');
				e.stopPropagation();	
				
			} else {
				e.stopPropagation();	
			}
		});

		/* close minicart */
		$('body').on('click', function(event){
			if( $('.rebell-mini-cart').hasClass('open') ) 
			{
				if (!$(event.target).is('.rebell-mini-cart') && !$(event.target).is('.shopping-bags-button .tools-button') && !$(event.target).is('.woocommerce-message')
					&& ( $('.rebell-mini-cart').has(event.target).length === 0) )
				{
					$('.rebell-mini-cart').removeClass('open');
				}
			}
		});
	}

	/* open minicart on hover */
	if ( $(window).width() >= 1024 ) {
		if (getbowtied_scripts_vars.option_minicart == 1 && getbowtied_scripts_vars.option_minicart_open == 2) {

			$('.shopping-bag-button').on({
				mouseenter: function(e) {
					if( !($('.rebell-mini-cart').hasClass('open')) ) {
						window.setTimeout(function() {

			                if( $('body').hasClass('gbt_custom_notif') ) {
								$('.gbt-custom-notification-notice').removeClass('open-notice').removeAttr( 'style' ).addClass('fade-out-notice');
							}
							
							calculate_minicart_margin();

							e.preventDefault();
							$('.rebell-mini-cart').addClass('open');
							e.stopPropagation();	
								
						}, 350);
					}
				},
				mouseleave: function() {
					window.setTimeout(function() {
		                if ( $('.rebell-mini-cart').hasClass('open') && !$('.rebell-mini-cart').is(':hover') ) {
							$('.rebell-mini-cart').removeClass('open');
						}
	              	}, 500);
				}
			});

			$('.rebell-mini-cart').on({
			 	mouseleave: function (e) {
			        window.setTimeout(function() {
		                if ( ($('.rebell-mini-cart').hasClass('open')) ) {
							$('.rebell-mini-cart').removeClass('open');
						}
		            }, 500);
			    }
			});
		}
	}

	function calculate_minicart_margin() {

		var top = 0;

		if( $('body').hasClass('admin-bar') ) {
			top += 32;
		}

		if( $('.top-headers-wrapper').length ) {
			top += $('.top-headers-wrapper').height();
		}

		if( $('header').length && $('header').hasClass('menu-under') && $('.menu-under .main-navigation').length ) {
			top -= $('.main-navigation').height();
		}

		if( top > 0 ) {
			$('.rebell-mini-cart').css('top', top);
		}
	}

	calculate_minicart_margin();

});