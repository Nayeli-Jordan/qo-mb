<?php 
	$custom_fields  = get_post_custom();
	$post_id        = get_the_ID();

	$origen 		= get_post_meta( $post_id, 'orden_compra_origen', true );
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

    $fechaEsp		= date('d/m/Y', strtotime($fecha));
    $fechaVentaEsp	= date('d/m/Y', strtotime($fechaVenta));

    $permalink 		= get_permalink();
	
	if ($origen === 'Stock de tienda') {
		$origen = 'Tienda';
	} else {
		$origen = 'Fábrica';
	}

	$today = date("Y-m-d");
	if ($today >= $fecha ) {
		$fechaEsp = '<span class="color-red">' . $fechaEsp . '</span>';
	}

    $infoOrden  .= '<div class="row margin-bottom-xsmall infoOrden">';
		$infoOrden  .= '<div class="col s12 m4 uppercase origen_' . $origen . ' ' . $estatusVenta . '">
			<i class="instruction icon-work"><span>De fábrica</span></i>
			<i class="instruction icon-house"><span>De tienda</span></i> | ' . $fechaVentaEsp . ' | ' . $responsable . ' | 
			<i class="instruction icon-open"><span>Abierta</span></i>
			<i class="instruction icon-lock"><span>Cerrada</span></i>
			<i class="instruction icon-block"><span>Cancelada</span></i></div>';
		$infoOrden  .= '<div class="col s12 m2 uppercase metodoP_' . $metodoPago . ' ' . $estatusPago . '">$' . $pago . ' | 
    		<i class="instruction icon-money"><span>Efectivo</span></i>
			<i class="instruction icon-credit-card"><span>Tarjeta</span></i>
			<i class="instruction icon-handshake"><span>Préstamo</span></i>
			<i class="instruction icon-dollar"><span>Otro</span></i> | 
			<i class="instruction icon-cancel"><span>No pagada</span></i>
			<i class="instruction icon-truck"><span>Efectivo en camino</span></i>
			<i class="instruction icon-house"><span>Dinero en tienda</span></i>
			<i class="instruction icon-bank"><span>Dinero en cuenta</span></i>
			<i class="instruction icon-female"><span>Dinero con supervisor</span></i>
			</div>';
	    $infoOrden  .= '<div class="col s12 m5 uppercase ' . $estatusEntrega . '">' . $fechaEsp . ' | ' . $lugar . ' | 
    		<i class="instruction icon-work"><span>En producción, fábrica</span></i>
			<i class="instruction icon-house"><span>En tienda</span></i>
			<i class="instruction icon-location"><span>En punto de entrega</span></i>
			<i class="instruction icon-happy"><span>Entregada</span></i>
			</div>';
	    $infoOrden  .= '<div class="col s12 m1"><a href="' . $permalink . '" target="_blank"><i class="icon-eye"></i></a></div>';
    $infoOrden  .= '</div>';
?>