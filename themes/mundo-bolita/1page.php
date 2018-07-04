<?php 
global $post;
$post_slug = $post->post_name;

get_header(); 
?>

	<!-- En esta página se muestran los productos de cada categoría -->
	<h3 class="text-center color-primary uppercase container relative z-index-1 margin-bottom-large"><?php the_title(); ?></h3>
	<?php 
$terms = get_the_terms( get_the_ID(), 'product_cat' );

foreach ($terms as $term) {

    echo '<h1 itemprop="name" class="product-title entry-title">'.$term->name.'</h1>';
}
	 ?>
	<section class="[ container ] section-products">
		<?php
	        $args = array(
	            'post_type' => 'product',
	            'posts_per_page' => -1,
	            'tax_query' => array(
	                    array(
	                        'taxonomy' => 'product_cat',
	                        'field'    => 'slug',
	                        'terms'    => $post_slug,
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