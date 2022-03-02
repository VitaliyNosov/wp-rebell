<?php
	
	global $rebell_theme_options;
	
	$page_id = "";
	if ( is_single() || is_page() ) {
		$page_id = get_the_ID();
	} else if ( is_home() ) {
		$page_id = get_option('page_for_posts');		
	}

    $page_header_src = "";

    if (has_post_thumbnail()) $page_header_src = wp_get_attachment_url( get_post_thumbnail_id( $page_id ) );

    $page_title_option = "on";
	
	if (get_post_meta( $page_id, 'page_title_meta_box_check', true )) {
		$page_title_option = get_post_meta( $page_id, 'page_title_meta_box_check', true );
	}

    if (get_post_meta( $page_id, 'page_title_meta_box_check', true )) {
        $page_title_option = get_post_meta( $page_id, 'page_title_meta_box_check', true );
    } else {
        $page_title_option = "on";
    }
    
?>

<?php get_header(); ?>

    <div class="<?php echo ( (isset($page_title_option)) && ($page_title_option == "on") ) ? 'page-title-shown':'page-title-hidden';?>">
    	
        <div id="primary" class="content-area">
           
            <div id="content" class="site-content" role="main">
            
           		<header class="entry-header <?php if ($page_header_src != "") : ?>with_featured_img<?php endif; ?>" <?php if ($page_header_src != "") : ?>style="background-image:url(<?php echo esc_url($page_header_src); ?>)"<?php endif; ?>>
            
                    <div class="page_header_overlay"></div>
                    
                    <div class="row">
                        <div class="large-12 large-centered columns without-sidebar">
            
<?php
if(!is_page('36')) {
if ( function_exists('yoast_breadcrumb') ) {
  yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
}
}

?>
                            <?php if ( (isset($page_title_option)) && ($page_title_option == "on") ) : ?>                        
                            <h1 class="page-title on_some_pages"><?php the_title(); ?></h1>
                            <?php endif; ?>
                            
                            <?php if($post->post_excerpt) : ?>
                                    <div class="page-description"><?php the_excerpt(); ?></div>
                            <?php endif; ?>
                            
                        </div>
                    </div>
            
                </header><!-- .entry-header -->

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'content', 'page' ); ?>
                        
                    <?php   if (function_exists('is_cart') && is_cart()) : ?>
                    <?php else: ?>    
                    <div class="clearfix"></div>
                    <footer class="entry-meta">   
                    </footer><!-- .entry-meta -->
                    <?php endif; ?>

                    <?php
                        
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || '0' != get_comments_number() ) comments_template();
                        
                    ?>

                <?php endwhile; // end of the loop. ?>

            </div><!-- #content -->           
            
        </div><!-- #primary -->

    </div>
    
<?php get_footer(); ?>
