<?php 
	get_header();
	global $post;

	
	while ( have_posts() ) : the_post(); 
?>
	<section class="container">
		<div class="row">
			<div class="col s12 m6 offset-m3 col-product-single text-center relative">
				<div class="limit-block-product">
					<div class="bg-light-opacity"></div>
					<?php if ($days <= 20){ ?>
						<p class="bg-image bg-contain bg-new" style="background-image: url(<?php echo THEMEPATH; ?>images/nuevo.png);"><p>
					<?php } ?>
					<div class="bg-image bg-contain bg-product  [ wow tada ]" data-wow-duration="2s"  style="background-image: url(<?php the_post_thumbnail_url('large'); ?>);"></div>
					<h4 class="title-product"><?php the_title(); ?></h4>
				</div>

			</div>			
		</div>
	</section>
	<section class="container section-products-related ">
		<h3 class="color-primary text-center uppercase relative z-index-1">Piñatas Relacionadas</h3>
		<article class="flex">
			<?php 
				//Obtener id del producto actual
				global $product;
				$cur_product_id = $product->get_id();
				//echo $cur_product_id;
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
		            'post__not_in' => array( $cur_product_id ),
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

		            	<?php include (TEMPLATEPATH . '/template/products.php'); ?>	

		            <?php $i ++; endwhile;
		        } 
		        wp_reset_postdata();
		    ?><!--/.products-->			
		</article>

		<div class="clearfix"></div>
	    <div class="shadow-products"></div>
	</section>
	<div class="clearfix"></div>
<?php 
	endwhile; // end of the loop.
	get_footer(); 
?>
