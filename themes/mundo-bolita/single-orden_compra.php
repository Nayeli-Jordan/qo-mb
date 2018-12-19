<?php 
	get_header();
	global $post;
	
	while ( have_posts() ) : the_post();
		$custom_fields  = get_post_custom();
		$post_id        = get_the_ID();
		$fecha       	= get_post_meta( $post_id, 'orden_compra_fecha', true );
		$horario       	= get_post_meta( $post_id, 'orden_compra_horario', true );
		$horarioEnd    	= get_post_meta( $post_id, 'orden_compra_horarioEnd', true );
		$lugar       	= get_post_meta( $post_id, 'orden_compra_lugar', true );
		$modelo       	= get_post_meta( $post_id, 'orden_compra_modelo', true );
		$cliente       	= get_post_meta( $post_id, 'orden_compra_cliente', true );
		$pago       	= get_post_meta( $post_id, 'orden_compra_pago', true );
		$community      = get_post_meta( $post_id, 'orden_compra_community', true );
		$origen      	= get_post_meta( $post_id, 'orden_compra_origen', true );
		$estatus      	= get_post_meta( $post_id, 'orden_compra_estatus', true );
		$fechaPublicada = get_the_date("Y-m-d");

		setlocale(LC_ALL,"es_ES");
		$fechaPublicada = strftime("%d de %B del %Y", strtotime($fechaPublicada));
		$fecha 			= strftime("%d de %B del %Y", strtotime($fecha));

		if ($horarioEnd != '') { 
			$horario 	= $horario . " a " . $horarioEnd; 
		}
		if ($lugar === 'Otro') { 
			$lugar 		= get_post_meta( $post_id, 'orden_compra_lugarPers', true ); 
		}


?>
	<section id="orden_compra" class="[ container container-large ] relative z-index-1">
		<div class="padding-top-bottom-large">
			<div class="page-orden">
				<div class="header-orden">
					<img src="<?php echo THEMEPATH; ?>images/identidad/mb.png">
				</div>
				<div class="body-orden">
					<table class="margin-bottom">
						<tr>
							<td class="width-70p"><strong>Fecha: </strong><?php echo $fechaPublicada; ?></td>
							<td><strong>Folio: </strong>FBMB<?php echo post_number_orden(get_the_ID()); ?></td>
						</tr>
					</table>
					<table>
						<tr>
							<td class="width-70p"><strong>Fecha de entrega: </strong><?php echo $fecha; ?></td>
							<td><strong>Horario: </strong><?php echo $horario; ?></td>
						</tr>
						<tr><td colspan="2"><strong>Lugar: </strong><?php echo $lugar; ?></td></tr>
						<tr><td colspan="2"><strong>Modelo: </strong><?php echo $modelo; ?></td></tr>
						<tr><td colspan="2"><strong>Cliente: </strong><?php echo $cliente; ?></td></tr>
						<tr><td colspan="2"><strong>Pago: </strong>$<?php echo $pago; ?> liquida a contraentrega</td></tr>
						<tr><td colspan="2"><strong>Community Manager: </strong><?php echo $community; ?></td></tr>
					</table>
					<div id="estatus-orden-single" class="infoOrden <?php echo $estatus; ?>">
						<i class="instruction icon-calendar enFabrica"><span>En fábrica</span></i>
						<i class="instruction icon-house enTienda"><span>En tienda</span></i>
						<i class="instruction icon-truck enCamino"><span>En camino a punto de entrega</span></i>
						<i class="instruction icon-clock enPuntoEntrega"><span>En punto de entrega</span></i>
						<i class="instruction icon-money efectivo"><span>Pagada, efectivo en camino</span></i>
						<i class="instruction icon-archive ventaCerrada"><span>Venta cerrada</span></i>
						<i class="instruction icon-trash ventaCancelada"><span>Venta cancelada</span></i>
					</div>
					<div id="origen-orden-single"><?php echo $origen; ?></div>				
				</div>
				<div class="bg-image bg-contain [ absolute left--5p top-30 ] width-30p padding-bottom-30p rotate-90" style="background-image: url(<?php echo THEMEPATH; ?>images/boli-central.png);"></div>
				<div class="bg-image bg-contain [ absolute right--30 bottom--30 ] width-40p padding-bottom-40p" style="background-image: url(<?php echo THEMEPATH; ?>images/boli-central.png);"></div>
				<div class="bg-image bg-contain [ absolute left-25p bottom--10p ] width-25p padding-bottom-25p  rotate-90" style="background-image: url(<?php echo THEMEPATH; ?>images/boli-central.png);"></div>

				<div class="bg-image bg-contain [ absolute right-40p top-25p ] width-15p padding-bottom-15p  rotate-90" style="background-image: url(<?php echo THEMEPATH; ?>images/boli-central.png);"></div>

			</div>
		</div>
		<div class="clearfix"></div>
		<div class="action-btn-single text-center">
			<a href="<?php echo SITEURL; ?>mb-stock" class="btn margin-right-small">Ver stock</a>
			<a href="#actualizado-orden" class="btn margin-right-small modal-trigger">Editar orden</a>
			<i id="print-page" class="icon-print btn"> Imprimir</i>
		</div>
	</section>
	<div class="clearfix"></div>
<?php 
	endwhile; // end of the loop.
	get_footer(); 
?>
