<?php get_header(); ?>
	<section class="container relative featured-products">
		<?php //echo do_shortcode( '[products limit="8" columns="4" visibility="featured" ]' ); ?>
		
	    <?php
	        $args = array(
	            'post_type' => 'product',
	            'posts_per_page' => 8,
	            'tax_query' => array(
	                    array(
	                        'taxonomy' => 'product_visibility',
	                        'field'    => 'name',
	                        'terms'    => 'featured',
	                    ),	                    
	                ),
	            );
	        $loop = new WP_Query( $args );
	        $i = 1;
	        if ( $loop->have_posts() ) {
	            while ( $loop->have_posts() ) : $loop->the_post(); ?>

	            	<?php include (TEMPLATEPATH . '/template/products.php'); ?>	
					
	            <?php $i ++; endwhile;
	        } 
	        wp_reset_postdata();
	    ?><!--/.products-->
	    
		<div class="clearfix"></div>
	    <div class="shadow-products"></div>
	</section>	
<?php get_footer(); ?>