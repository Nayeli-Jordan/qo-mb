<?php get_header(); ?>

	<!-- En esta página se muestran los productos de cada categoría -->
	<?php 
		$terms = get_the_terms( get_the_ID(), 'product_cat' );
		foreach ($terms as $term) {
			echo '<h3 class="text-center color-primary uppercase container relative z-index-1 margin-bottom-large">'.$term->name.'</h3>';
		}
	 ?>
	<section class="[ container ] section-products">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php include (TEMPLATEPATH . '/template/products.php'); ?>	
		<?php endwhile; ?>

	    
		<div class="clearfix"></div>
	    <div class="shadow-products"></div>
	</section>	

<?php get_footer(); ?>