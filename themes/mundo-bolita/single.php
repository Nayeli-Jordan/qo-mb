<?php 
	get_header();
	global $post;

	
	while ( have_posts() ) : the_post(); 
?>
	<section class="container">
		<div class="row">
			<div class="col s12 m4 offset-m4 col-product-single text-center relative">
				<div class="limit-block-product">
					<div class="bg-ligh-opacity"></div>
					<?php if ($days <= 20){ ?>
						<p class="bg-image bg-contain bg-new" style="background-image: url(<?php echo THEMEPATH; ?>images/nuevo.png);"><p>
					<?php } ?>
					<div class="bg-image bg-contain bg-product" style="background-image: url(<?php the_post_thumbnail_url('medium'); ?>);"></div>
					<h4 class="title-product"><?php the_title(); ?></h4>
				</div>

			</div>			
		</div>
	</section>
	<section class="container section-products-related">
		<?php 
			//Obtener id del producto actual
			//global $product;
			//$id = $product->get_id();
			//echo $id;
			//$slug = $product->get_slug();
			//echo $slug;

			$term =  get_the_terms( $post->ID, 'product_cat' );
			foreach ($term as $t) {
			   $relatedCategory = $t->slug;
			}
		?>
		<?php
	        $args = array(
	            'post_type' 		=> 'product',
	            'posts_per_page' 	=> 4,
	            'orderby'        	=> 'rand',
	            'tax_query' => array(
	            		//'relation' => 'AND',
	                    array(
	                        'taxonomy' => 'product_cat',
	                        'field'    => 'slug',
	                        'terms'    => $relatedCategory,
	                    ),
	                    //array(
	                        //'post_type' => 'product',
	                        //'field'    => 'id',
	                        //'terms'    => $id,
	                        //'operator' => 'NOT IN',
	                    //),	                    
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
	</section>
	<div class="clearfix"></div>
<?php 
	endwhile; // end of the loop.
	get_footer(); 
?>
