<?php get_header(); ?>

	<!-- DEFAULT WC = SHOP -->
	<!-- En esta página se muestran los productos de todas las categorias =>-->
	<section class="[ container ] section-products">
		<?php
	        $args = array(
	            'post_type' => 'product',
	            'posts_per_page' => -1
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