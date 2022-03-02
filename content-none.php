<div class="row">	
    <div class="large-10 large-centered columns">    
        <div id="content" class="site-content" role="main">
        
            <section class="error-404 not-found">
                <header class="page-header">
                    <div class="error-banner"></div>
                    <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'rebell' ); ?></h1>
                </header>

                <div class="page-content">                        
                    <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
                        <p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'rebell' ), array( 'a' => array( 'href' => array() ) ) ), admin_url( 'post-new.php' ) ); ?></p>                    
                    <?php elseif ( is_search() ) : ?>                    
                        <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'rebell' ); ?></p>
                        <?php get_search_form(); ?>                    
                    <?php else : ?>                    
                        <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'rebell' ); ?></p>
                        <?php get_search_form(); ?>                    
                    <?php endif; ?>

                </div>
            </section>
            
        </div>
    </div>                
</div>