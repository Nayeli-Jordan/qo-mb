<?php 
	$today = date("Y-m-d"); 

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

	/* Obtener ID por nombre */
	$productId = get_page_by_title( $modelo, OBJECT, 'product' );
	$productId = $productId->ID;
	/* Obtener stock */
	$product 	= wc_get_product( $productId );
	$stock	 	= $product->get_stock_quantity();
	$newStock	= $stock - 1;

	if ($estatusVenta === 'estatus_abierta') { 
		$estatusVenta = 'Venta abierta';
	} elseif ($estatusVenta === 'estatus_cerrada') { 
		$estatusVenta = 'Venta cerrada';
	} elseif ($estatusVenta === 'estatus_cancelada') {
		$estatusVenta = 'Venta cancelada';
	}

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
	}
?>

<div id="actualizado-orden" class="modal modal-medium modal-large">
	<i class="icon-cancel modal-close"></i>
	<div class="modal-content">
		<p class="color-primary no-margin-top text-center">Actualizar orden de compra</p>
		<form id="orden_actualizada-form" name="orden_actualizada-form" action=""  method="post" class="validation row" data-parsley-orden_actualizada>		
			<div class="col s12 input-field margin-bottom">
				<label for="orden_compra_estatusVenta color-primary">Estatus Venta*:</label>
    			<select name="orden_compra_estatusVenta" id="orden_compra_estatusVenta" required  data-parsley-required-message="Campo obligatorio">
    				<option  value="<?php echo $estatusVenta; ?>" select="selected"><?php echo $estatusVenta; ?></option>
                    <option value="estatus_abierta">Venta abierta</option>
                    <option value="estatus_cerrada">Venta cerrada</option>
                    <option value="estatus_cancelada">Venta cancelada</option>
                </select>
				<p class="text-center color-primary">¡Estatus - Importante!</p>
				<p class="margin-bottom-large"><span class="color-primary">Venta cerrada: </span>Se restará definitivamente la piñata del stock de tienda.<br><span class="color-primary">Venta cancelada: </span>Se eliminará la orden de compra y la piñata volverá a registrarse como disponible.</p>
			</div>
			<div class="col s12 m6 l4 input-field">
				<label for="orden_compra_cliente">Cliente*:</label>
   				<input type="text" name="orden_compra_cliente" id="orden_compra_cliente"placeholder="De tienda / Nombre" value="<?php echo $cliente; ?>" required data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s12 m6 l4 input-field">
				<label for="orden_compra_responsable">Responsable venta*:</label>
    			<input type="text" name="orden_compra_responsable" id="orden_compra_responsable" value="<?php echo $responsable; ?>" required data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s12 m6 l4 input-field">
				<label for="orden_compra_fechaVenta">Fecha de venta*:</label>
    			<input type="date" name="orden_compra_fechaVenta" id="orden_compra_fechaVenta" value="<?php echo $fechaVenta; ?>" required data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s12 input-field">
				<label for="orden_compra_observaciones">Observaciones:</label>
    			<input type="text" name="orden_compra_observaciones" id="orden_compra_observaciones" value="<?php echo $observaciones; ?>">
			</div>	
			<div class="col s12 margin-top-xlarge"></div>
			<div class="col s12 m6 l4 input-field">
				<label for="orden_compra_pago">Cantidad a pagar*:</label>
    			<input type="number" min="0" name="orden_compra_pago" id="orden_compra_pago" placeholder="0" value="<?php echo $pago; ?>" required data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s12 m6 l4 input-field">
				<label for="orden_compra_metodoPago">Método de pago*:</label>
    			<select name="orden_compra_metodoPago" id="orden_compra_metodoPago" required  data-parsley-required-message="Campo obligatorio">
    				<option  value="<?php echo $metodoPago; ?>" select="selected"><?php echo $metodoPago; ?></option>
    				<option value="Efectivo">Efectivo</option>
    				<option value="Tarjeta">Tarjeta</option>
    				<option value="Prestamo">Préstamo</option>
    				<option value="Otro">Otro</option>
    			</select>
			</div>
			<div class="col s12 m6 l4 input-field">
				<label for="orden_compra_estatusPago color-primary">Estatus Pago*:</label>
    			<select name="orden_compra_estatusPago" id="orden_compra_estatusPago" required  data-parsley-required-message="Campo obligatorio">
    				<option  value="<?php echo $estatusPago; ?>" select="selected"><?php echo $estatusPago; ?></option>
                    <option value="estatus_noPagada">No pagada</option>
                    <option value="estatus_enCamino">Efectivo en camino</option>
                    <option value="estatus_enTienda">Dinero en tienda</option>
                    <option value="estatus_enCuenta">Dinero en cuenta</option>
                    <option value="estatus_conSupervisor">Dinero con supervisor</option>
                </select>
			</div>
			<div class="col s12 input-field">
				<label for="orden_compra_notaPago">Nota de pago:</label>
    			<input type="text" name="orden_compra_notaPago" id="orden_compra_notaPago" value="<?php echo $notaPago; ?>">
			</div>
			<div class="col s12 margin-top-xlarge"></div>
			<div class="col s12 m6 l4 input-field clearfix">
				<label for="orden_compra_fecha">Fecha de entrega*:</label>
   				<input type="date" min="<?php echo $today; ?>" name="orden_compra_fecha" id="orden_compra_fecha" value="<?php echo $fecha; ?>" required data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s12 m6 l4 input-field">
				<label for="orden_compra_lugar">Lugar de entrega*:</label>
                <select name="orden_compra_lugar" id="orden_compra_lugar" required  data-parsley-required-message="Campo obligatorio">                	
                	<option  value="<?php echo $lugar; ?>" select="selected"><?php echo $lugar; ?></option>
                    <option value="Sucursal Izcalli">Sucursal Izcalli</option>
                    <option value="Col. del Valle">Col. de. Valle</option>
                    <option value="Otro">Otro</option>
                </select>
			</div>
			<div class="col s12 m12 l4 input-field">
				<label for="orden_compra_estatusEntrega color-primary">Estatus Entrega*:</label>
    			<select name="orden_compra_estatusEntrega" id="orden_compra_estatusEntrega" required  data-parsley-required-message="Campo obligatorio">
    				<option  value="<?php echo $estatusEntrega; ?>" select="selected"><?php echo $estatusEntrega; ?></option>
                    <option value="estatus_enProduccion">En producción, fabrica</option>
                    <option value="estatus_enTienda">En tienda</option>
                    <option value="estatus_enPuntoEntrega">En punto de entrega</option>
                    <option value="estatus_entregada">Entregada</option>
                </select>
			</div>
			<div class="col s12 input-field">
				<label for="orden_compra_entrega">Detalles entrega:</label>
    			<input type="text" name="orden_compra_entrega" id="orden_compra_entrega" placeholder="Lugar, hora, etc." value="<?php echo $entrega; ?>">
			</div>
			<div class="col s12 text-right">
				<input type="submit" id="mb_submitOrdenActualizada" name="mb_submitOrdenActualizada" class="btn" value="Actualizar" />
				<input type="hidden" name="send_submitOrdenActualizada" value="post" />
				<?php wp_nonce_field( 'orden_actualizada-form' ); ?>	
			</div>
		</form>
	</div>
</div>

<?php if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['send_submitOrdenActualizada'] )):

    $compra_origen         = $_POST['orden_compra_origen'];
    $compra_modelo         = $_POST['orden_compra_modelo'];
    $compra_cliente        = $_POST['orden_compra_cliente'];
    $compra_pago           = $_POST['orden_compra_pago'];
    $compra_metodoPago     = $_POST['orden_compra_metodoPago'];
    $compra_estatusPago    = $_POST['orden_compra_estatusPago'];
    $compra_notaPago       = $_POST['orden_compra_notaPago'];
    $compra_fecha          = $_POST['orden_compra_fecha'];
    $compra_lugar          = $_POST['orden_compra_lugar'];
    $compra_estatusEntrega = $_POST['orden_compra_estatusEntrega'];
    $compra_entrega        = $_POST['orden_compra_entrega'];
    $compra_responsable    = $_POST['orden_compra_responsable'];
    $compra_fechaVenta     = $_POST['orden_compra_fechaVenta'];
    $compra_estatusVenta   = $_POST['orden_compra_estatusVenta'];
    $compra_observaciones  = $_POST['orden_compra_observaciones'];

	/* Crear post orden_compra */
	$post = array(
		'ID'           => $post_id,
	);

	$orden_id = wp_update_post($post);

	update_post_meta($orden_id,'orden_compra_origen',$compra_origen);
	update_post_meta($orden_id,'orden_compra_modelo',$compra_modelo);
	update_post_meta($orden_id,'orden_compra_cliente',$compra_cliente);
	update_post_meta($orden_id,'orden_compra_pago',$compra_pago);
	update_post_meta($orden_id,'orden_compra_metodoPago',$compra_metodoPago);
	update_post_meta($orden_id,'orden_compra_estatusPago',$compra_estatusPago);
	update_post_meta($orden_id,'orden_compra_notaPago',$compra_notaPago);
	update_post_meta($orden_id,'orden_compra_fecha',$compra_fecha);
	update_post_meta($orden_id,'orden_compra_lugar',$compra_lugar);
	update_post_meta($orden_id,'orden_compra_estatusEntrega',$compra_estatusEntrega);
	update_post_meta($orden_id,'orden_compra_entrega',$compra_entrega);
	update_post_meta($orden_id,'orden_compra_responsable',$compra_responsable);
	update_post_meta($orden_id,'orden_compra_fechaVenta',$compra_fechaVenta);
	update_post_meta($orden_id,'orden_compra_estatusVenta',$compra_estatusVenta);
	update_post_meta($orden_id,'orden_compra_observaciones',$compra_observaciones);

	if ( $compra_estatusVenta === 'estatus_cerrada' ) {
		update_post_meta($productId, '_stock', $newStock);
	}

	/* Enviar mail alertando sobre el estatus de la orden */

	/* Origen de fábrica - En tienda*/
	if ($compraOrigen === 'Pedido de fábrica' && $compraEstatus === 'estatus_enTienda') {
		$to 	= "pruebas@altoempleo.com.mx";
		$labelEstatus = 'En tienda';
	} elseif ($compraEstatus === 'estatus_entregada') { /* Estatus piñata entregada */
		$to 	= "pruebas@altoempleo.com.mx";
		$labelEstatus = 'Entregada y pagada';
	} elseif ($compraEstatus === 'estatus_efectivo') { /* Estatus efectivo en camino */
		$to 	= "pruebas@altoempleo.com.mx";
		$labelEstatus = 'Efectivo en camino';
	} elseif ($compraEstatus === 'estatus_ventaCerrada') { /* Estatus venta cerrada */
		$to 	= "pruebas@altoempleo.com.mx";
		$labelEstatus = 'Venta cerrada';
	} elseif ($compraEstatus === 'estatus_ventaCancelada') { /* Estatus venta cancelada */
		$to 	= "pruebas@altoempleo.com.mx";
		$labelEstatus = 'Venta cancelada';
	}

	$subject 			= "Actualización Orden de Compra - " . $labelEstatus;

	if ($labelEstatus === 'Venta cancelada') {
		$labelEstatus = '<span style="color: red;">Venta cancelada</span>';
	}

	setlocale(LC_ALL,"es_ES");
	$compraFechaEsp 	= strftime("%d de %B del %Y", strtotime($compraFecha));

	$message 	 	 	= '<html style="font-family: Arial, sans-serif;"><body>';
	$message 			.= '<div style="text-align: center; margin-bottom: 20px;"><a style="color: #000; text-align: center; display: block;" href="' . SITEURL . '"><img style="display: inline-block; margin: auto;" src="http://mundobolita.com/wp-content/themes/mundo-bolita/images/identidad/logo-correo.png" alt="Logo Mundo Bolita"></a></div>';
	$message 	 		.= '<p style="margin-bottom: 20px;">Se ha <span style="color: #008fcc;">actualizado</span> la información de la siguiente orden de compra: </p>';
	$message 			.= '<div style="margin-bottom: 30px;"><p><strong style="color: #de0d88;">Modelo: </strong>' . $compraModelo . '</p>';
	$message 			.= '<p><strong style="color: #de0d88;">Entrega: </strong>' . $compraFechaEsp . ' - ' . $compraHorario . ' | ' . $compraLugar . '</p>';
	$message 			.= '<p><strong style="color: #de0d88;">Cliente: </strong>' . $compraCliente . '</p>';
	$message 			.= '<p><strong style="color: #de0d88;">Pago: </strong>$' . $compraPago . ' liquida a contraentrega</p>';
	$message 			.= '<p><strong style="color: #de0d88;">Contacto inicial: </strong>' . $contactoInicial . '</p></div>';	
	$message 			.= '<p><strong style="color: #de0d88;">Contacto venta: </strong>' . $contactoVenta . '</p></div>';	
	$message 			.= '<p style="margin-top: 20px;"><strong style="color: #008fcc;">Origen: </strong>' . $compraOrigen . '</p>';
	$message 			.= '<p><strong style="color: #008fcc;">Estatus: ' . $labelEstatus . '</strong></p></div>';
	$message 	        .= '<div style="text-align: center; margin-bottom: 10px;"><p><small>Este email ha sido enviado desde el sistema de stock de Mundo Bolita. </small></p></div>';
	$message 	        .= '</body></html>';

	if (($compraOrigen === 'Pedido de fábrica' && $compraEstatus === 'estatus_enTienda') || $compraEstatus === 'estatus_entregada' || $compraEstatus === 'estatus_efectivo' || $compraEstatus === 'estatus_ventaCerrada' || $compraEstatus === 'estatus_ventaCancelada') {
		wp_mail($to, $subject, $message);
	}
endif; ?>