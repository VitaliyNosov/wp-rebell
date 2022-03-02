<?php

get_header();

global $rebell_theme_options;

$rebell_theme_options['layout_blog'] = isset($rebell_theme_options['layout_blog'])? $rebell_theme_options['layout_blog'] : 'layout-1';

switch ($rebell_theme_options['layout_blog'])
{        
    case "layout-1":
        include( get_parent_theme_file_path('index-layout-1.php') );
        break;
    case "layout-2":
        include( get_parent_theme_file_path('index-layout-2.php') );
        break;
    case "layout-3":
        include( get_parent_theme_file_path('index-layout-3.php') );
        break;
    default:
        include( get_parent_theme_file_path('index-layout-1.php') );
        break;
}

get_footer();