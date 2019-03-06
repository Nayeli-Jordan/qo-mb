<?php get_header(); 
$today 		= date("Y-m-d"); 
setlocale(LC_ALL,"es_ES");
$todayEsp 	= strftime("%d de %B del %Y", strtotime($today));
?>
<section class="container container-large">
	<?php if (have_posts()) : while (have_posts()) : the_post(); 
		if ( current_user_can( 'administrator' ) ) { ?>
			<div class="text-right margin-bottom-small hide_to_print">
				<i id="print-page" class="icon-print btn margin-bottom-xsmall"> Imprimir Inventario</i>
				<a href="<?php echo SITEURL; ?>reporte" class="btn margin-left-xsmall margin-bottom-xsmall modal-trigger">Reporte Semanal</a>
				<a href="<?php echo SITEURL; ?>mb-stock" class="btn margin-left-xsmall margin-bottom-xsmall modal-trigger">Stock completo</a>
			</div>
			<div class="margin-top-xlarge text-center">
				<p>Mundo Bolita<br>Inventario al <?php echo $todayEsp; ?></p>
			</div>
			<div class="box-info-products">
				<div class="container-info-products">
					<table class="table-inventario">
						<thead>
							<tr class="head-orden-principal">
								<th rowspan="2" class="width-30p"><strong>Piñata</strong></th>
								<th rowspan="2" class="width-30p"><strong>Precio</strong></th>
								<th colspan="2" class="width-40p"><strong>Stock de Tienda</strong></th>
							</tr>
							<tr class="head-orden">
								<th class="width-20p"><strong>Total</strong></th>					
								<th class="width-20p"><strong>Disponibles</strong></th>
							</tr>							
						</thead>
						<tbody>
						<?php
					        $args = array(
					            'post_type' => 'product',
					            'posts_per_page' => -1,
					            'orderby' => 'title',
					            'order' => 'ASC'
					        );
					        $loop = new WP_Query( $args );
					        if ( $loop->have_posts() ) {
					        	global $product;
					        	/* Obtener totales */    	
					        	$totalApartadas		= 0;
					        	$totalStock			= 0;				        	
					        	$totalDisponible	= 0;

					            while ( $loop->have_posts() ) : $loop->the_post();
					            	/* Inicia ordenes en 0 por cada producto */
									$ordenCompraTienda 	= 0;
									$disponibles 		= 0;

									/* Obtener info del producto y guardarla en variables */
					            	$post_id        = get_the_ID();
					            	$product_slug	= $post->post_name;
									$product 		= wc_get_product( $post_id );
									$productName 	= get_the_title( $post_id );

									$price 			= $product->get_regular_price();
									$stock			= $product->get_stock_quantity();

									/* Obtener disponibilidad */
									$disponibles 		= $stock - $ordenCompraTienda;

									/* Sumar para totales */
						        	$totalApartadas		= $totalApartadas + $ordenCompraTienda;
						        	$totalStock			= $totalStock + $stock;
						        	$totalDisponible	= $totalDisponible + $disponibles;

									/* Cambiar formato valores */
									if ($price != '') {
										$price		= '$' . $price;
									} else {
										$price 		= '<span class="color-disabled">-</span>';
									}
									if ($disponibles < 0) {
										$disponibles = $disponibles . '<i class="color-red absolute instruction icon-attention"><span>No hay stock suficiente</span></i>';
									} 

									$image = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID), 'medium' ); 

									if ($stock != 0 || $stock != '') { ?>
										<tr>
											<td><img class="img-pinata" src="<?php echo $image[0]; ?>"><?php echo $productName; ?></td>
											<td><?php echo $price; ?></td>
											<td><?php echo $stock ?></td>
											<td><?php echo $disponibles; ?></td>
										</tr>										
									<?php }
					            endwhile;
					        } 
					        wp_reset_postdata();
					    ?>							
						</tbody>
						<tfoot>
						    <tr class="footer-orden">
						    	<td colspan="2">Total</td>
						    	<td><?php echo $totalStock; ?></td>
						    	<td><?php echo $totalDisponible; ?></td>
						    </tr>							
						</tfoot>
					</table>
				</div>		
			</div>		
		<?php } else {
			echo "<strong><a href='" . SITEURL . "wp-admin' class='color-purple block text-center'>Ingresa</a></strong>";
		} /* End if administrator */
	endwhile; endif; ?>
</section>
<?php get_footer(); ?>