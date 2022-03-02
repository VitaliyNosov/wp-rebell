<?php

$custom_styles .= '

	.gbt_18_sk_latest_posts_title,
	.wp-block-quote p,
	.wp-block-pullquote p,
	.wp-block-quote cite,
	.wp-block-pullquote cite,
	.wp-block-media-text p
	{
		color: ' . esc_html($rebell_theme_options['headings_color']) . ';
	}

	.gbt_18_sk_latest_posts_title:hover,
	.gbt_18_sk_posts_grid_title
	{
		color: ' . esc_html($rebell_theme_options['main_color']) . ';
	}

	.wp-block-latest-posts__post-date,
	.wp-block-gallery .blocks-gallery-item figcaption,
	.wp-block-audio figcaption,
	.wp-block-image figcaption,
	.wp-block-video figcaption
	{
		color: ' . esc_html($rebell_theme_options['body_color']) . ';
	}

	.wp-block-quote:not(.is-large):not(.is-style-large),
	.wp-block-quote
	{
		border-left-color: ' . esc_html($rebell_theme_options['headings_color']) . ';
	}

	.wp-block-pullquote
	{
		border-top-color: ' . esc_html($rebell_theme_options['headings_color']) . ';
		border-bottom-color: ' . esc_html($rebell_theme_options['headings_color']) . ';
	}

	.gbt_18_sk_latest_posts_item_link:hover .gbt_18_sk_latest_posts_img_overlay
	{
		background: ' . esc_html($rebell_theme_options['main_color']) . ';
	}
';

if( !empty($rebell_theme_options['headings_font_size']) ) {

	$mobile_base_size = 13;
	$headings_base_size = $rebell_theme_options['headings_font_size'];
	$h0_size = $headings_base_size * 3.157;
	$h0_size_mobile = $mobile_base_size * 3.157;

	$custom_styles .= '
		p.has-drop-cap:first-letter
		{
			font-size: ' . esc_html( $h0_size_mobile ) . 'px !important;
		}

		@media only screen and (min-width: 768px) {

			p.has-drop-cap:first-letter
			{
				font-size: ' . esc_html( $h0_size ) . 'px !important; 
			}
		}
	';
}

?>