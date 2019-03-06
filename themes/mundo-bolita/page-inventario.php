<?php get_header(); 
$today 		= date("Y-m-d"); 
setlocale(LC_ALL,"es_ES");
$todayEsp 	= strftime("%d de %B del %Y", strtotime($today));
?>
<section id="page-mb-stock" class="container container-large">
	<?php if (have_posts()) : while (have_posts()) : the_post(); 
		if ( current_user_can( 'administrator' ) ) { ?>
			<div class="text-right margin-bottom-small hide_to_print">
				<a href="<?php echo SITEURL; ?>mb-stock" class="btn margin-left-xsmall margin-bottom-xsmall modal-trigger hide_to_print">Stock completo</a>
				<i id="print-page" class="icon-print btn"> Imprimir Inventario</i>
			</div>
			<p><?php echo $todayEsp; ?></p>
			<div class="box-info-products">
				<div class="container-info-products">
					<div class="head-orden-fixed hide">
						<table>
							<tr>
								<th class="name-pinata" rowspan="2"><strong>Piñata</strong></th>
								<th rowspan="2"><strong>Precio</strong></th>
								<th colspan="2"><strong>Stock de Tienda</strong></th>
							</tr>
							<tr class="head-orden">
								<th><strong>Total</strong></th>					
								<th><strong>Disponibles</strong></th>
							</tr>
						</table>					
					</div>
					<table>
						<tr class="head-orden-principal">
							<th rowspan="2"><strong>Piñata</strong></th>
								<th rowspan="2"><strong>Precio</strong></th>
							<th colspan="2"><strong>Stock de Tienda</strong></th>
						</tr>
						<tr class="head-orden">
							<th><strong>Total</strong></th>					
							<th><strong>Disponibles</strong></th>
						</tr>

						<?php
					        $args = array(
					            'post_type' => 'product',
					            'posts_per_page' => 3, //-1
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

									$image = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID), 'medium' ); ?>
									<tr>
										<td><img class="img-pinata" src="<?php echo $image[0]; ?>"><?php echo $productName; ?></td>
										<td><?php echo $price; ?></td>
										<td><?php echo $stock ?></td>
										<td><?php echo $disponibles; ?></td>
									</tr>
					            <?php endwhile;
					        } 
					        wp_reset_postdata();
					    ?>
					    <tr class="footer-orden">
					    	<td>Total</td>
					    	<td>-</td>
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