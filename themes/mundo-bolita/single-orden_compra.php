<?php 
	get_header();
	global $post;
	
	while ( have_posts() ) : the_post();
		$custom_fields  = get_post_custom();
		$post_id        = get_the_ID();

		$origen 		= get_post_meta( $post_id, 'orden_compra_origen', true );
		$modelo 		= get_post_meta( $post_id, 'orden_compra_modelo', true );
		$cliente 		= get_post_meta( $post_id, 'orden_compra_cliente', true );
		$pago 			= get_post_meta( $post_id, 'orden_compra_pago', true );
		$metodoPago 	= get_post_meta( $post_id, 'orden_compra_metodoPago', true );
		$estatusPago 	= get_post_meta( $post_id, 'orden_compra_estatusPago', true );
		$notaPago 		= get_post_meta( $post_id, 'orden_compra_notaPago', true );
		$fecha 			= get_post_meta( $post_id, 'orden_compra_fecha', true );
		$lugar 			= get_post_meta( $post_id, 'orden_compra_lugar', true );
		$estatusEntrega = get_post_meta( $post_id, 'orden_compra_estatusEntrega', true );
		$entrega 		= get_post_meta( $post_id, 'orden_compra_entrega', true );
		$responsable 	= get_post_meta( $post_id, 'orden_compra_responsable', true );
		$fechaVenta 	= get_post_meta( $post_id, 'orden_compra_fechaVenta', true );
		$estatusVenta 	= get_post_meta( $post_id, 'orden_compra_estatusVenta', true );
		$observaciones 	= get_post_meta( $post_id, 'orden_compra_observaciones', true );

		setlocale(LC_ALL,"es_ES");
		$fecha 			= strftime("%d de %B del %Y", strtotime($fecha));
		$fechaVenta 	= strftime("%d de %B del %Y", strtotime($fechaVenta)); 

		if ($origen === 'Stock de tienda') {
    		$origen = 'Tienda';
    	} else {
    		$origen = 'Fabrica';
    	}

    	if ($entrega === '') { $entrega = 'Sin notas'; }
    	if ($notaPago === '') { $notaPago = 'Sin notas'; }
    	if ($observaciones === '') { $observaciones = 'Sin notas'; }

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

		if ($estatusEntrega === 'estatus_enProduccion') { 
			$estatusEntrega = 'En Producción';
		} elseif ($estatusEntrega === 'estatus_enTienda') { 
			$estatusEntrega = 'En Tienda';
		} elseif ($estatusEntrega === 'estatus_enPuntoEntrega') { 
			$estatusEntrega = 'En Punto de Entrega';
		} elseif ($estatusEntrega === 'estatus_entregada') { 
			$estatusEntrega = 'Entregada';
		} ?>

		<section id="orden_compra" class="[ container container-large ] relative z-index-1">
			<div class="padding-top-bottom-large">
				<div class="page-orden">
					<div class="header-orden">
						<img src="<?php echo THEMEPATH; ?>images/identidad/mb.png">
					</div>
					<div class="body-orden">
						<table class="margin-bottom">
							<tr>
								<td class="width-70p"><strong>Fecha: </strong><?php echo $fechaVenta; ?></td>
								<td><strong>Folio: </strong>FBMB<?php echo post_number_orden(get_the_ID()); ?></td>
							</tr>
						</table>
						<table>
							<tr><td class="width-70p"><strong>Fecha de entrega: </strong><?php echo $fecha; ?></td></tr>
							<tr><td><strong>Lugar: </strong><?php echo $lugar . ' <span class="hide_to_print">| ' . $estatusEntrega . ' | ' . $entrega . '</span>'; ?></td></tr>
							<tr><td><strong>Modelo: </strong><?php echo $modelo; ?></td></tr>
							<tr><td><strong>Cliente: </strong><?php echo $cliente; ?></td></tr>
							<tr><td><strong>Pago: </strong>$<?php echo $pago . ' <span class="hide_to_print">| ' . $metodoPago . ' | ' . $estatusPago . ' | ' . $notaPago . '</span>'; ?></td></tr>
							<tr class="hide_to_print"><td><br><strong>Responsable de venta: </strong><?php echo $responsable; ?></td></tr>
							<tr class="hide_to_print"><td><strong>Observaciones: </strong><?php echo $observaciones; ?></td></tr>
						</table>
						<div id="estatus-orden-single">
							<?php if ($estatusVenta === 'estatus_abierta') {
								echo "<i class='instruction icon-open'><span>Venta Abierta</span></i>";
							} elseif ($estatusVenta === 'estatus_cerrada') {
								echo "<i class='instruction icon-lock'><span>Venta Cerrada</span></i>";
							} else {
								echo "<i class='instruction icon-block'><span>Venta Cancelada</span></i>";
							} ?>
						</div>
						<div id="origen-orden-single">
							<?php
							if ($origen === 'Tienda') {
								echo "<i class='icon-house'></i> ";
							} else {
								echo "<i class='icon-work'></i> ";
							}
							echo 'Origen de ' . $origen; 
							if ($origen === 'Fabrica') {
								echo " <a href='#pedido-fabrica' class='modal-trigger'><i class='icon-pencil'></i></a>";
							}?>
						</div>				
					</div>
					<div class="bg-image bg-contain [ absolute left--5p top-30 ] width-30p padding-bottom-30p rotate-90" style="background-image: url(<?php echo THEMEPATH; ?>images/boli-central.png);"></div>
					<div class="bg-image bg-contain [ absolute right--30 bottom--30 ] width-40p padding-bottom-40p" style="background-image: url(<?php echo THEMEPATH; ?>images/boli-central.png);"></div>
					<div class="bg-image bg-contain [ absolute left-25p bottom--10p ] width-25p padding-bottom-25p  rotate-90" style="background-image: url(<?php echo THEMEPATH; ?>images/boli-central.png);"></div>
					<div class="bg-image bg-contain [ absolute right-10p top--20p ] width-20p padding-bottom-25p rotate-245" style="background-image: url(<?php echo THEMEPATH; ?>images/boli-central.png);"></div>
					<div class="bg-image bg-contain [ absolute right-40p top-25p ] width-15p padding-bottom-15p  rotate-90" style="background-image: url(<?php echo THEMEPATH; ?>images/boli-central.png);"></div>

				</div>
			</div>
			<div class="clearfix"></div>
			<div class="action-btn-single text-center">
				<?php if ( $estatusVenta != 'estatus_cerrada' && $estatusVenta != 'estatus_cancelada') : ?>
					<a href="#actualizado-orden" class="btn margin-right-small modal-trigger"><i class='icon-pencil fz-14'></i> Editar orden</a>
				<?php endif; ?>			
				<i id="print-page" class="icon-print btn"> Imprimir Orden</i>
			</div>
		</section>
		<div class="clearfix"></div>
<?php 
	endwhile; // end of the loop.
	get_footer(); 
?>
