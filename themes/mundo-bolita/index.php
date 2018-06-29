<?php get_header(); ?>
	<section class="container relative">
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

	            	<?php 
						#DATE
						$now = time(); // or your date as well
						$your_date = strtotime($post->post_date);
						$datediff = $now - $your_date;
						$days = floor($datediff/(60*60*24));
	            	?>

	            	<div class="col-product text-center">
						<!-- <a href="<?php the_permalink(); ?>"> -->
							<div class="bg-ligh-opacity"></div>
							<?php if ($days <= 20){ ?>
								<p class="bg-image bg-contain bg-new" style="background-image: url(<?php echo THEMEPATH; ?>images/nuevo.png);"><p>
							<?php } ?>
							<div class="bg-image bg-contain bg-product" style="background-image: url(<?php the_post_thumbnail_url('medium'); ?>);"></div>							
						<!-- </a> -->
						<!-- <a href="<?php the_permalink(); ?>"> -->
            				<h4 class="title-product"><?php the_title(); ?></h4>
            			<!-- </a> -->
            		</div>
					

	            <?php $i ++; endwhile;
	        } 
	        wp_reset_postdata();
	    ?><!--/.products-->

	    <div class="clearfix"></div>
		<img class="responsive-img absolute bottom-15p right--10p width-25p z-index--1" src="<?php echo THEMEPATH; ?>images/boli-central.png" alt="Imagen luna">
		<img class="responsive-img absolute bottom-20p left-35p width-25p z-index--1" src="<?php echo THEMEPATH; ?>images/boli-central.png" alt="Imagen luna">
		<img class="responsive-img absolute bottom--10p left-5p width-25p z-index--1" src="<?php echo THEMEPATH; ?>images/boli-central.png" alt="Imagen luna">
	</section>	
<?php get_footer(); ?>