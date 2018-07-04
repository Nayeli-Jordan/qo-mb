<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

?>
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
<?php

get_footer( 'shop' );
