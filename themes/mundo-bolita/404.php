<?php get_header(); ?>
	<section class="[ container ] relative z-index-1 margin-top-xbottom ">
		<div class="row">
			<div class="col s12 m6 offset-m3 l4 offset-l4 text-center">
				<h2 class="color-primary">Error!</h2>
				<p>Lo sentimos, la página que buscas no existe</p>

				<a href="<?php echo site_url(); ?>">
					<p>Ir al inicio</p>
					<div class="bg-image bg-contain bg-icon" style="background-image: url(<?php echo THEMEPATH; ?>images/icons-header/home1.png);"></div>
				</a>
			</div>
		</div>
	</section>
	<section class="container section-products-related ">
		<h3 class="color-primary text-center uppercase relative z-index-1">Nuestras Piñatas</h3>
		<article class="flex">
			<?php
		        $args = array(
		            'post_type' 		=> 'product',
		            'posts_per_page' 	=> 4,
		            'orderby'        	=> 'rand'
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
<?php get_footer(); ?>