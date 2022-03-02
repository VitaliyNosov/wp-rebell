<?php 

if( (isset($rebell_theme_options['main_background']['background-color'])) ) {
	$custom_styles .= '
		.st-content
		{
			background-color: ' . esc_html($rebell_theme_options['main_background']['background-color']) . ';
		}';
}

if( (isset($rebell_theme_options['main_background']['background-image'])) && ($rebell_theme_options['main_background']['background-image'] != "") ) {
	$custom_styles .= '
		.st-content
		{
			background-image: url(' . esc_url($rebell_theme_options['main_background']['background-image']) . ');
		}';
}

if( (isset($rebell_theme_options['main_background']['background-repeat'])) && ($rebell_theme_options['main_background']['background-repeat'] != "") ) {
	$custom_styles .= '
		.st-content
		{
			background-repeat: ' . esc_html($rebell_theme_options['main_background']['background-repeat']) . ';
		}';
}

if( (isset($rebell_theme_options['main_background']['background-position'])) && ($rebell_theme_options['main_background']['background-position'] != "") ) {
	$custom_styles .= '
		.st-content
		{
			background-position: ' . esc_html($rebell_theme_options['main_background']['background-position']) . ';
		}';
}

if( (isset($rebell_theme_options['main_background']['background-size'])) && ($rebell_theme_options['main_background']['background-size'] != "") ) {
	$custom_styles .= '
		.st-content
		{
			background-size: ' . esc_html($rebell_theme_options['main_background']['background-size']) . ';
		}';
}

if( (isset($rebell_theme_options['main_background']['background-attachment'])) && ($rebell_theme_options['main_background']['background-attachment'] != "") ) {
	$custom_styles .= '
		.st-content
		{
			background-attachment: ' . esc_html($rebell_theme_options['main_background']['background-attachment']) . ';
		}';
}
	
if( is_user_logged_in() ) {
	$custom_styles .= '
		@media all and (min-width: 1024px) and (max-width: 1280px)
		{
			.position-left,
			.position-right
			{
				padding-top: 38px;
			}
		}
	';
}

if( (isset($rebell_theme_options['predictive_search'])) && ($rebell_theme_options['predictive_search'] == 0) ) {
	$custom_styles .= '
		@media all and (max-width: 767px) {
			.site-search {
			    min-height: 170px;
			    height: 170px;
			    -webkit-transform: translateY(-170px);
			    -ms-transform: translateY(-170px);
			    transform: translateY(-170px);
			}
		}
	';
}

?>