<?php get_header(); ?>
<section id="page-mb-stock" class="container container-large">
	<?php if (have_posts()) : while (have_posts()) : the_post(); 
		if ( current_user_can( 'administrator' ) ) { ?>
			<div class="text-right margin-bottom-small">
				<a href="<?php echo SITEURL; ?>inventario" class="btn margin-left-xsmall margin-bottom-xsmall modal-trigger">Inventario</a>
				<a href="<?php echo SITEURL; ?>reporte" class="btn margin-left-xsmall margin-bottom-xsmall modal-trigger">Reporte Semanal</a>
				<a id="btn-ordenCompra" href="#nuevo-orden" class="btn margin-left-xsmall margin-bottom-xsmall modal-trigger">Nueva orden de compra</a>
			</div>
			<div class="box-info-products">
				<div class="container-info-products">
					<div class="head-orden-fixed hide">
						<table class="table-stock">
							<tr>
								<th class="name-pinata" rowspan="2"><strong>Piñata</strong></th>
								<th colspan="2"><strong>Precio</strong></th>
								<th colspan="3"><strong>Ordenes de compra</strong></th>
								<th colspan="3"><strong>Ventas / Salidas</strong></th>
								<th colspan="2"><strong>Stock de Tienda</strong></th>
							</tr>
							<tr class="head-orden">
								<th><strong>Tienda</strong></th>
								<th><strong>Facebook</strong></th>
								<th><strong>Total</strong></th>
								<th><strong>De Tienda</strong></th>
								<th><strong>Pedidos Fábrica</strong></th>
								<th><strong>Canceladas</strong></th>
								<th><strong>Cerradas</strong></th>
								<th><strong>Cerradas Prestamos</strong></th>
								<th><strong>Total</strong></th>					
								<th><strong>Disponibles</strong></th>
							</tr>
						</table>					
					</div>
					<table>
						<tr class="head-orden-principal">
							<th rowspan="2"><strong>Piñata</strong></th>
							<th colspan="2"><strong>Precio</strong></th>
							<th colspan="3"><strong>Ordenes de compra abiertas</strong></th>
							<th colspan="3"><strong>Ventas / Salidas</strong></th>
							<th colspan="2"><strong>Stock de Tienda</strong></th>
						</tr>
						<tr class="head-orden">
							<th><strong>Tienda</strong></th>
							<th><strong>Facebook</strong></th>
							<th><strong>Total</strong></th>
							<th><strong>De Tienda</strong></th>
							<th><strong>Pedidos Fábrica</strong></th>
							<th><strong>Canceladas</strong></th>
							<th><strong>Cerradas</strong></th>
							<th><strong>Cerradas Prestamos</strong></th>
							<th><strong>Total</strong></th>					
							<th><strong>Disponibles</strong></th>
						</tr>

						<?php
					        $args = array(
					            'post_type' => 'product',
					            'posts_per_page' => -1, //-1
					            'orderby' => 'title',
					            'order' => 'ASC'
					        );
					        $loop = new WP_Query( $args );
					        if ( $loop->have_posts() ) {
					        	global $product;
					        	/* Obtener totales */
					        	$totalOrdenes		= 0;
					        	$totalApartadas		= 0;
					        	$totalPedidos		= 0;
					        	$totalCerradas		= 0;
					        	$totalCanceladas	= 0;
					        	$totalPrestamo		= 0;
					        	$totalStock			= 0;
					        	$totalDisponible	= 0;

					            while ( $loop->have_posts() ) : $loop->the_post();
					            	/* Inicia ordenes en 0 por cada producto */
									$ordenCompra 			= 0; 
									$ordenCompraTienda 	= 0;
									$ordenCompraFabrica 	= 0;
									$ordenCompraCerrada 	= 0;
									$ordenCompraCancelada 	= 0;
									$ordenPrestamo		 	= 0;

									$disponibles 			= 0;

									/* Obtener info del producto y guardarla en variables */
					            	$post_id        = get_the_ID();
					            	$product_slug	= $post->post_name;
									$product 		= wc_get_product( $post_id );
									$productName 	= get_the_title( $post_id );

									$price 			= $product->get_regular_price();
									$stock			= $product->get_stock_quantity();

									/* Obtener número de ordenes por el nombre del producto */
									include (TEMPLATEPATH . '/template/sistema/orden-modal.php');

									/* Obtener número de ordenes cerradas por el nombre del producto */
									include (TEMPLATEPATH . '/template/sistema/orden-modal_ventas-cerradas.php');
									/* Obtener número de ordenes canceladas por el nombre del producto */
									include (TEMPLATEPATH . '/template/sistema/orden-modal_ventas-canceladas.php');
									/* Obtener número de ordenes de prestamo por el nombre del producto */
									include (TEMPLATEPATH . '/template/sistema/orden-modal_prestamos.php');

									/* Obtener disponibilidad */
									$disponibles 		= $stock - $ordenCompraTienda;

									/* Sumar para totales */
						        	$totalOrdenes		= $totalOrdenes + $ordenCompra;
						        	$totalApartadas		= $totalApartadas + $ordenCompraTienda;
						        	$totalPedidos		= $totalPedidos + $ordenCompraFabrica;
						        	$totalCerradas		= $totalCerradas + $ordenCompraCerrada;
						        	$totalCanceladas	= $totalCanceladas + $ordenCompraCancelada;
						        	$totalPrestamo		= $totalPrestamo + $ordenPrestamo;
						        	$totalStock			= $totalStock + $stock;
						        	$totalDisponible	= $totalDisponible + $disponibles;
									
									/* Cambiar formato vacios y 0 */
									if ($ordenCompra === 0) 		{ 
										$ordenCompra = '<span class="color-disabled">-</span>';
									}
									if ($ordenCompraTienda === 0) { 
										$ordenCompraTienda = '<span class="color-disabled">-</span>';
									}
									if ($ordenCompraFabrica === 0) 	{ 
										$ordenCompraFabrica = '<span class="color-disabled">-</span>';
									}
									if ($ordenCompraCancelada === 0) 	{ 
										$ordenCompraCancelada = '<span class="color-disabled">-</span>';
									}
									if ($ordenCompraCerrada === 0) 	{ 
										$ordenCompraCerrada = '<span class="color-disabled">-</span>';
									}
									if ($ordenPrestamo === 0) 	{ 
										$ordenPrestamo = '<span class="color-disabled">-</span>';
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
										$ordenCompra 	= '<a href="#product_' . $product_slug .'" class="modal-trigger block underline-hover">' . $ordenCompra . '</a>';
									}
									if ($ordenCompraCancelada != 0) {
										$ordenCompraCancelada 	= '<a href="#product_' . $product_slug .'_canceladas" class="modal-trigger block underline-hover color-puple">' . $ordenCompraCancelada . '</a>';
									}
									if ($ordenCompraCerrada != 0) {
										$ordenCompraCerrada 	= '<a href="#product_' . $product_slug .'_cerradas" class="modal-trigger block underline-hover color-puple">' . $ordenCompraCerrada . '</a>';
									}
									if ($ordenPrestamo != 0) {
										$ordenPrestamo 	= '<a href="#product_' . $product_slug .'_prestamos" class="modal-trigger block underline-hover color-puple">' . $ordenPrestamo . '</a>';
									}
									if ($disponibles < 0) {
										$disponibles = $disponibles . '<i class="color-red absolute instruction icon-attention"><span>No hay stock suficiente</span></i>';
									} 

									$image = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID), 'medium' ); ?>
									<tr>
										<td><img class="img-pinata" src="<?php echo $image[0]; ?>"><?php echo $productName; ?></td>
										<td><?php echo $price; ?></td>
										<td><?php echo $priceFb; ?></td>
										<td><?php echo $ordenCompra; ?></td>
										<td><?php echo $ordenCompraTienda; ?></td>
										<td><?php echo $ordenCompraFabrica; ?></td>
										<td><?php echo $ordenCompraCancelada; ?></td>
										<td><?php echo $ordenCompraCerrada; ?></td>
										<td><?php echo $ordenPrestamo; ?></td>
										<td><?php echo $stock ?></td>
										<td><?php echo $disponibles; ?></td>
									</tr>
					            <?php endwhile;
					        } 
					        wp_reset_postdata();
					    ?>
					    <tr class="footer-orden">
					    	<td colspan="3">Total</td>
					    	<td><?php echo $totalOrdenes; ?></td>
					    	<td><?php echo $totalApartadas; ?></td>
					    	<td><?php echo $totalPedidos; ?></td>
					    	<td><?php echo $totalCanceladas; ?></td>
					    	<td><?php echo $totalCerradas; ?></td>
					    	<td><?php echo $totalPrestamo; ?></td>
					    	<td><?php echo $totalStock; ?></td>
					    	<td><?php echo $totalDisponible; ?></td>
					    </tr>
					</table>
				</div>		
			</div>		
		<?php } else {
			echo "<strong><a href='" . SITEURL . "wp-admin' class='color-purple block text-center'>Ingresa</a></strong>";
		} /* End if administrator */
	endwhile; endif; ?>
</section>
<?php get_footer(); ?>