<?php get_header(); ?>
<section id="page-mb-stock" class="container container-large">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>			
		<div class="text-right margin-bottom-small">
			<a href="#nuevo-orden" class="btn margin-left-xsmall modal-trigger">Nuevo orden</a>
			<a href="#nuevo-fabrica" class="btn margin-left-xsmall modal-trigger">Nuevo pedido a fábrica</a>
		</div>
		<div class="box-info-products">
			<div class="container-info-products">
				<table>
					<tr>
						<th><strong>Piñata</strong></th>
						<th><strong>Precio Tienda</strong></th>
						<th><strong>Precio Facebook</strong></th>
						<th><strong>Ordenes de compra</strong></th>
						<th><strong>Apartadas de Tienda</strong></th>
						<th><strong>Pedidos Fábrica</strong></th>
						<th><strong>Stock Tienda</strong></th>						
						<th><strong>Disponibles</strong></th>
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
				            	/* Inicia ordenes en 0 por cada producto */
								$ordenCompra 			= 0; 
								$ordenCompraApartada 	= 0;
								$ordenCompraFabrica 	= 0;

								$disponibles 			= 0;

								/* Obtener info del producto y guardarla en variables */
				            	$post_id        = get_the_ID();
								$product 		= wc_get_product( $post_id );
								$productName 	= get_the_title( $post_id );

								$price 			= $product->get_regular_price();
								$stock			= $product->get_stock_quantity();

								/* Obtener número de ordenes por el nombre del producto */
								include (TEMPLATEPATH . '/template/sistema/orden-modal.php');

								/* Obtener disponibilidad */
								$disponibles = $stock - $ordenCompraApartada;
								
								/* Cambiar formato vacios y 0 */
								if ($ordenCompra === 0) 		{ 
									$ordenCompra = '<span class="color-disabled">-</span>';
								}
								if ($ordenCompraApartada === 0) { 
									$ordenCompraApartada = '<span class="color-disabled">-</span>';
								}
								if ($ordenCompraFabrica === 0) 	{ 
									$ordenCompraFabrica = '<span class="color-disabled">-</span>';
								}

								/* Cambiar formato valores */
								if ($price != '') {
									$priceFb	= $price + 100;
									$priceFb	= '$' . $priceFb;
									$price		= '$' . $price;
								} else {
									$price 		= '<span class="color-disabled">-</span>';
									$priceFb	= '<span class="color-disabled">-</span>';
								}
								if ($ordenCompra != 0) {
									$ordenCompra 	= '<a href="#product_' . $post_id .'" class="modal-trigger block underline-hover">' . $ordenCompra . '</a>';
								}
								if ($disponibles < 0) {
									$disponibles = $disponibles . '<i class="color-red absolute instruction icon-cancel"><span>No hay stock suficiente</span></i>';
								} ?>
								
								<tr>
									<td><?php echo $productName ?></td>
									<td><?php echo $price; ?></td>
									<td><?php echo $priceFb; ?></td>
									<td><?php echo $ordenCompra; ?></td>
									<td><?php echo $ordenCompraApartada; ?></td>
									<td><?php echo $ordenCompraFabrica; ?></td>
									<td><?php echo $stock ?></td>
									<td><?php echo $disponibles; ?></td>
								</tr>
				            <?php endwhile;
				        } 
				        wp_reset_postdata();
				    ?>
				</table>
			</div>		
		</div>
		<?php 
			/* Modal orden */
			include (TEMPLATEPATH . '/template/sistema/orden-modal-nuevo.php');
			/* Modal orden nuevo creado */
			include (TEMPLATEPATH . '/template/sistema/orden-modal-creado.php'); ?>
		
	<?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>