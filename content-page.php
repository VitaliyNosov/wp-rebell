<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="row">
		<div class="large-12 columns">
            
        <div class="entry-content">
            <?php the_content( wp_kses( __( 'Continue Reading <span class="meta-nav">&rarr;</span>', 'rebell' ), array( 'span' => array( 'class' => array() ) ) ) ); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'rebell' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
        </div><!-- .entry-content -->

		</div><!-- .columns -->
    </div><!-- .row -->
    
</div><!-- #post -->