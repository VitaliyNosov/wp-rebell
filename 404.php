<?php get_header(); ?>

	<div id="primary" class="content-area">

        <div class="row">	
            <div class="large-10 large-centered columns">    
                <div id="content" class="site-content" role="main">
                
                    <section class="error-404 not-found">
                        <header class="page-header">
                            <div class="error-banner1"></div>
                            <h1 class="page-title" style="text-transform: none; font-size: 34px;">Ошибка 404! <br>
							Страница не найдена.</h1>
                        </header><!-- .page-header -->
        
                        <div class="page-content">
                            
                            <p class="error-404-text">Неправильно набран адрес или такой страницы на сайте больше не существует.</p>
<?php echo do_shortcode( '[product_categories number="8" parent="0"]' ); ?>
                        <p class="error-404-text">Может вас заинтересуют наши новинки?</p> 
						<?php echo do_shortcode( '[recent_products per_page="8" columns="4"]' ); ?>

                        </div><!-- .page-content -->
                    </section><!-- .error-404 -->
                    
                </div><!-- #content -->
            </div><!-- .large-12 .columns -->                
        </div><!-- .row -->
             
    </div><!-- #primary -->

<?php get_footer(); ?>