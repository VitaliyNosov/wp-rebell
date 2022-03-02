<?php

if( (isset($rebell_theme_options['footer_background_color'])) && (trim($rebell_theme_options['footer_background_color']) != "" ) ) {
	$custom_styles .= '
		#site-footer
		{
			background: ' . esc_html($rebell_theme_options['footer_background_color']) . ';
		}
	';
}

if( (isset($rebell_theme_options['footer_background_color'])) && (trim($rebell_theme_options['footer_background_color']) == "transparent" ) ) {
	$custom_styles .= '
		@media only screen and (max-width: 641px)
		{
			#site-footer
			{
				padding-top: 0;
			}
		}
	';
}

if( (isset($rebell_theme_options['footer_texts_color'])) && (trim($rebell_theme_options['footer_texts_color']) != "" ) ) {
	$custom_styles .= '
		#site-footer,
		#site-footer .copyright_text a
		{
			color: ' . esc_html($rebell_theme_options['footer_texts_color']) . ';
		}
	';
}

if( (isset($rebell_theme_options['footer_links_color'])) && (trim($rebell_theme_options['footer_links_color']) != "" ) ) {
	$custom_styles .= '
		#site-footer a,
		#site-footer .widget-title,
		.footer-navigation-wrapper ul li:after
		{
			color: ' . esc_html($rebell_theme_options['footer_links_color']) . ';
		}	

		.footer_socials_wrapper ul.sk_social_icons_list li svg,
		.site-footer-widget-area ul.sk_social_icons_list li svg
		{
			fill: ' . esc_html($rebell_theme_options['footer_links_color']) . ';
		}
	';
}

if( (isset($rebell_theme_options['expandable_footer'])) && ($rebell_theme_options['expandable_footer'] == "0" ) ) {
	$custom_styles .= '
		.trigger-footer-widget-area
		{
			display: none;
		}
		.site-footer-widget-area
		{
			display: block;
		}
	';
}

?>