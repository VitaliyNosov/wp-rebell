<?php 
			
$site_top_bar_height = 0;
if( (isset($rebell_theme_options['top_bar_switch'])) && ($rebell_theme_options['top_bar_switch'] == "1" ) ) { 
	$site_top_bar_height = 43;
}

$custom_styles .= '
	#site-top-bar
	{
		height: ' . esc_html($site_top_bar_height) . 'px;
	}
';

if( (isset($rebell_theme_options['top_bar_navigation_position'])) && (trim($rebell_theme_options['top_bar_navigation_position']) == "left" ) ) {
	$custom_styles .= '
		#site-navigation-top-bar
		{
			float: left;
		}
	';
}

if( (isset($rebell_theme_options['top_bar_background_color'])) && (trim($rebell_theme_options['top_bar_background_color']) != "" ) ) {
	$custom_styles .= '
		#site-top-bar,
		#site-navigation-top-bar .sf-menu ul
		{
			background: ' . esc_html($rebell_theme_options['top_bar_background_color']) . ';
		}
	';
}

if( (isset($rebell_theme_options['top_bar_typography'])) && (trim($rebell_theme_options['top_bar_typography']) != "" ) ) {
	$custom_styles .= '
		#site-top-bar,
		#site-top-bar a,
		.language-and-currency .wcml_currency_switcher > ul > li.wcml-cs-active-currency > a
		{
			color: ' . esc_html($rebell_theme_options['top_bar_typography']) . ';
		}

		#site-top-bar ul.sk_social_icons_list li svg
		{
			fill: ' . esc_html($rebell_theme_options['top_bar_typography']) . ';
		}
	';
}

?>