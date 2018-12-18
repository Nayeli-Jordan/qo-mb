<?php get_header(); ?>
<section id="page-mb-stock" class="padding-bottom-xlarge container container-large">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>			
		<div class="text-right margin-bottom-small">
			<a href="#nuevo-apartado" class="btn margin-left-xsmall modal-trigger">Nuevo apartado</a>
			<a href="#nuevo-fabrica" class="btn margin-left-xsmall modal-trigger">Nuevo fabrica</a>
		</div>
		<div class="box-info-products">
			<div class="container-info-products">
				<table>
					<tr>
						<th><strong>Piñata</strong></th>
						<th><strong>Precio Tienda</strong></th>
						<th><strong>Precio Facebook</strong></th>
						<th><strong>Stock</strong></th>
						<th><strong>Apartadas</strong></th>
						<th><strong>Fabrica</strong></th>
					</tr>
					<?php
				        $args = array(
				            'post_type' => 'product',
				            'posts_per_page' => -1
				        );
				        $loop = new WP_Query( $args );
				        if ( $loop->have_posts() ) {
				        	global $product;						        	
				            while ( $loop->have_posts() ) : $loop->the_post();	
								$apartados = 0; /* Inicia apartados en 0 por cada producto */

								/* Obtener info del producto y guardarla en variables */
				            	$post_id        = get_the_ID();
								$product 		= wc_get_product( $post_id );
								$productName 	= get_the_title( $post_id );
								$price 			= $product->get_regular_price();
								if ($price != '') {
									$priceFb	= $price + 100;
									$priceFb	= '$' . $priceFb;
									$price		= '$' . $price;
								} else {
									$price 		= '-';
									$priceFb	= '-';
								}
								$stock			= $product->get_stock_quantity();


								/* Obtener número de apartados por el nombre del producto */
								include (TEMPLATEPATH . '/template/sistema/apartado-modal.php'); ?>
								
								<tr>
									<td><?php echo $productName ?></td>
									<td><?php echo $price; ?></td>
									<td><?php echo $priceFb; ?></td>
									<td><?php echo $stock ?></td>
									<td><?php echo $apartados; ?></td>
									<td></td>
									<td></td>
								</tr>
				            <?php endwhile;
				        } 
				        wp_reset_postdata();
				    ?>
				</table>
			</div>		
		</div>
		<?php 
			/* Modal apartado */
			include (TEMPLATEPATH . '/template/sistema/apartado-modal-nuevo.php');
			/* Modal apartado nuevo creado */
			include (TEMPLATEPATH . '/template/sistema/apartado-modal-creado.php'); ?>
		
	<?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>