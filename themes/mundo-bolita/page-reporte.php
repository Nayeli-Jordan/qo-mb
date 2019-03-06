<?php get_header(); 
$today 		= date("Y-m-d"); 
$oneWeek  	= date('Y-m-d', strtotime($today . '- 7 days'));
$yesterday  = date('Y-m-d', strtotime($today . '- 1 days'));
setlocale(LC_ALL,"es_ES");
$oneWeek 	= strftime("%d de %B del %Y", strtotime($oneWeek));
$yesterday 	= strftime("%d de %B del %Y", strtotime($yesterday)); ?>
<section class="container container-large">
	<?php if (have_posts()) : while (have_posts()) : the_post(); 
		if ( current_user_can( 'administrator' ) ) { ?>
			<div class="text-right margin-bottom-small hide_to_print">
				<i id="print-page" class="icon-print btn hide_to_print"> Imprimir Reporte</i>
				<a href="<?php echo SITEURL; ?>inventario" class="btn margin-left-xsmall margin-bottom-xsmall modal-trigger">Inventario</a>
				<a href="<?php echo SITEURL; ?>mb-stock" class="btn margin-left-xsmall margin-bottom-xsmall modal-trigger">Stock completo</a>
			</div>
			<div class="margin-top-xlarge text-center">
				<p>Mundo Bolita<br>Reporte semanal: del <?php echo $oneWeek; ?> al <?php echo $yesterday; ?></p>				
			</div>

			<div class="box-info-products">
				<div class="container-info-products">
					<table class="table-reporte">
						<thead>
							<tr class="head-table">
								<th rowspan="2" class="width-10p"><strong>Fecha</strong></th>
								<th rowspan="2" class="width-18p"><strong>Piñata</strong></th>
								<th colspan="4" class="width-30p"><strong>Metodo de Pago</strong></th>
								<th rowspan="2" class="width-12p"><strong>Estatus pago</strong></th>
								<th rowspan="2" class="width-30p"><strong>Observaciones</strong></th>
							</tr>
							<tr class="head-table">
								<th>Pago efectivo</th>
								<th>Pago tarjeta</th>
								<th>Pago prestamo</th>
								<th>Pago tarjeta</th>
							</tr>							
						</thead>
						<tbody>
							<?php 
							$argsOrden = array(
							    'post_type' 		=> 'orden_compra',
							    'posts_per_page' 	=> -1,    
								'orderby' 			=> 'date',
								'order' 			=> 'ASC',
							);
							$loopOrden = new WP_Query( $argsOrden );
							if ( $loopOrden->have_posts() ) {
								$efectivo	= 0;
								$tarjeta	= 0;
								$prestamo	= 0;
								$otro		= 0;
							    while ( $loopOrden->have_posts() ) : $loopOrden->the_post();
						    		$custom_fields  = get_post_custom();
									$post_id        = get_the_ID();

									$modelo 		= get_post_meta( $post_id, 'orden_compra_modelo', true );
									$pago 			= get_post_meta( $post_id, 'orden_compra_pago', true );
									$metodoPago 	= get_post_meta( $post_id, 'orden_compra_metodoPago', true );
									$estatusPago 	= get_post_meta( $post_id, 'orden_compra_estatusPago', true );
									$notaPago 		= get_post_meta( $post_id, 'orden_compra_notaPago', true );
									$fecha 			= get_post_meta( $post_id, 'orden_compra_fecha', true );
									$fechaVenta 	= get_post_meta( $post_id, 'orden_compra_fechaVenta', true );
									$estatusVenta 	= get_post_meta( $post_id, 'orden_compra_estatusVenta', true );
									$observaciones 	= get_post_meta( $post_id, 'orden_compra_observaciones', true );

								    $fechaEsp		= date('d/m/Y', strtotime($fecha));
								    $fechaVentaEsp	= date('d/m/Y', strtotime($fechaVenta));

								    if ($estatusPago === 'estatus_noPagada') { 
										$estatusPago = 'No Pagada';
									} elseif ($estatusPago === 'estatus_enCamino') { 
										$estatusPago = 'En Camino';
									} elseif ($estatusPago === 'estatus_enTienda') { 
										$estatusPago = 'En Tienda';
									} elseif ($estatusPago === 'estatus_enCuenta') { 
										$estatusPago = 'En Cuenta';
									} elseif ($estatusPago === 'estatus_conSuperior') { 
										$estatusPago = 'Con Superior';
									}

								    $permalink 		= get_permalink(); ?> 

									<tr>
										<td><?php echo $fechaVentaEsp; ?></td>
										<td><?php echo $modelo; ?></td>
										<td><?php if ($metodoPago === 'Efectivo'): echo '$' . $pago; 
											$efectivo = $efectivo + $pago; endif ?></td>
										<td><?php if ($metodoPago === 'Tarjeta'): echo '$' . $pago;
											$tarjeta = $tarjeta + $pago; endif ?></td>
										<td><?php if ($metodoPago === 'Prestamo'): echo '$' . $pago;
											$prestamo = $prestamo + $pago; endif ?></td>
										<td><?php if ($metodoPago === 'Otro'): echo '$' . $pago;
											$otro = $otro + $pago; endif ?></td>
										<td><?php echo $estatusPago; ?></td>
										<td><?php echo $observaciones; ?></td>
									</tr>

							    <?php endwhile;
							} wp_reset_postdata(); 
							$totalVenta = $efectivo + $tarjeta + $prestamo + $otro; ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="2">Total</td>
								<td>$<?php echo $efectivo; ?></td>
								<td>$<?php echo $tarjeta; ?></td>
								<td>$<?php echo $prestamo; ?></td>
								<td>$<?php echo $otro; ?></td>
								<td>$<?php echo $totalVenta; ?></td>
							</tr>							
						</tfoot>
					</table>
				</div>
			</div>
		<?php }
	endwhile; endif; ?>
</section>
<?php get_footer(); ?>