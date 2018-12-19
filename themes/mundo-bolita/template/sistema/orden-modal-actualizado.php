<?php 
	$today = date("Y-m-d"); 

	$custom_fields  = get_post_custom();
	$post_id        = get_the_ID();
	$fecha       	= get_post_meta( $post_id, 'orden_compra_fecha', true );
	$horario       	= get_post_meta( $post_id, 'orden_compra_horario', true );
	$horarioEnd    	= get_post_meta( $post_id, 'orden_compra_horarioEnd', true );
	$lugar       	= get_post_meta( $post_id, 'orden_compra_lugar', true );
	$lugarPers     	= get_post_meta( $post_id, 'orden_compra_lugarPers', true );
	$modelo       	= get_post_meta( $post_id, 'orden_compra_modelo', true );
	$cliente       	= get_post_meta( $post_id, 'orden_compra_cliente', true );
	$pago       	= get_post_meta( $post_id, 'orden_compra_pago', true );
	$community      = get_post_meta( $post_id, 'orden_compra_community', true );
	$origen      	= get_post_meta( $post_id, 'orden_compra_origen', true );
	$estatus      	= get_post_meta( $post_id, 'orden_compra_estatus', true );

	if ($estatus === 'estatus_enFabrica'):
		$labelEstatus = 'En fábrica';
	elseif ($estatus === 'estatus_enTienda'):
		$labelEstatus = 'En tienda';
	elseif ($estatus === 'estatus_enCamino'):
		$labelEstatus = 'En camino a punto de entrega';
	elseif ($estatus === 'estatus_enPuntoEntrega'):
		$labelEstatus = 'En punto de entrega';
	elseif ($estatus === 'estatus_efectivo'):
		$labelEstatus = 'Pagada, efectivo en camino';
	elseif ($estatus === 'estatus_ventaCerrada'):
		$labelEstatus = 'Venta cerrada';
	elseif ($estatus === 'estatus_ventaCancelada'):
		$labelEstatus = 'Venta cancelada';
	endif; ?>

<div id="actualizado-orden" class="modal">
	<i class="icon-cancel modal-close"></i>
	<div class="modal-content">
		<p class="color-primary no-margin-top text-center">Actualizar orden de compra</p>
		<form id="orden_actualizada-form" name="orden_actualizada-form" action=""  method="post" class="validation row" data-parsley-orden_actualizada>
			<div class="col s12 m6 input-field">
				<label for="orden_compra_fecha">Fecha de entrega*:</label>
   				<input type="date" min="<?php echo $today; ?>" name="orden_compra_fecha" id="orden_compra_fecha" value="<?php echo $fecha; ?>" required  data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s6 m3 input-field">
				<label for="orden_compra_horario">Horario de*:</label>
    			<input type="text" name="orden_compra_horario" id="orden_compra_horario" placeholder="9 am" value="<?php echo $horario; ?>" required  data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s6 m3 input-field">
				<label for="orden_compra_horarioEnd">A*:</label>
    			<input type="text" name="orden_compra_horarioEnd" id="orden_compra_horarioEnd" placeholder="6 pm" value="<?php echo $horarioEnd; ?>" required  data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s12 m6 input-field clearfix actual-select">
				<label for="orden_compra_lugar">Lugar de entrega*:</label>
                <select name="orden_compra_lugar" id="orden_compra_lugar" value="<?php echo $lugar; ?>" required  data-parsley-required-message="Campo obligatorio">                	
                	<option value="<?php echo $lugar; ?>" select="selected"><?php echo $lugar; ?></option>
                    <option value="Cuautitlán Izcalli">Cuautitlán Izcalli</option>
                    <option value="Col. del Valle">Col. de. Valle</option>
                    <option value="Otro">Otro</option>
                </select>
			</div>
			<div class="col s12 m6 input-field">
				<label for="orden_compra_lugarPers">Si es otro:</label>
    			<input type="text" name="orden_compra_lugarPers" id="orden_compra_lugarPers" value="<?php echo $lugarPers; ?>" placeholder="Lugar">
			</div>
			<div class="col s12 input-field">
				<label for="orden_compra_cliente">Cliente*:</label>
   				<input type="text" name="orden_compra_cliente" id="orden_compra_cliente" value="<?php echo $cliente; ?>" required  data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s12 m6 input-field clearfix">
				<label for="orden_compra_pago">Cantidad a pagar*:</label>
    			<input type="number" name="orden_compra_pago" id="orden_compra_pago" placeholder="460" value="<?php echo $pago; ?>" required  data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s12 m6 input-field">
				<label for="orden_compra_community">Community Manager*:</label>
    			<input type="text" name="orden_compra_community" id="orden_compra_community" value="<?php echo $community; ?>" required  data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s12 m6 input-field margin-top actual-select">
				<label for="orden_compra_origen">Origen de la piñata*:</label>
    			<select name="orden_compra_origen" id="orden_compra_origen" required  data-parsley-required-message="Campo obligatorio">
    				<option  value="<?php echo $origen; ?>" select="selected"><?php echo $origen; ?></option>
                	<option value="Apartada de stock de tienda">Apartada de stock de tienda</option>
                	<option value="Pedido de fábrica">Pedido de fábrica</option>
                </select>
			</div>
			<div class="col s12 m6 input-field margin-top actual-select">
				<label for="orden_compra_estatus color-primary">Estatus de orden*:</label>
    			<select name="orden_compra_estatus" id="orden_compra_estatus" required  data-parsley-required-message="Campo obligatorio">
    				<option value="<?php echo $estatus; ?>" select="selected"><?php echo $labelEstatus; ?></option>
                    <option value="estatus_enFabrica" <?php selected($estatus, 'estatus_enFabrica'); ?>>En fábrica</option>
                    <option value="estatus_enTienda" <?php selected($estatus, 'estatus_enTienda'); ?>>En tienda</option>
                    <option value="estatus_enCamino" <?php selected($estatus, 'estatus_enCamino'); ?>>En camino a punto de entrega</option>
                    <option value="estatus_enPuntoEntrega" <?php selected($estatus, 'estatus_enPuntoEntrega'); ?>>En punto de entrega</option>
                    <option value="estatus_efectivo" <?php selected($estatus, 'estatus_efectivo'); ?>>Pagada, efectivo en camino</option>
                    <option value="estatus_ventaCerrada" <?php selected($estatus, 'estatus_ventaCerrada'); ?>>Venta cerrada</option>
                    <option value="estatus_ventaCancelada" <?php selected($estatus, 'estatus_ventaCancelada'); ?>>Venta cancelada</option>
                </select>
			</div>
			<div class="col s12 text-right">
				<input type="submit" id="mb_submitOrdenActualizada" name="mb_submitOrdenActualizada" class="btn" value="Enviar" />
				<input type="hidden" name="send_submitOrdenActualizada" value="post" />
				<?php wp_nonce_field( 'orden_actualizada-form' ); ?>	
			</div>
		</form>
	</div>
</div>

<?php if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['send_submitOrdenActualizada'] )):

	$compraFecha 		= $_POST['orden_compra_fecha'];
	$compraHorario 		= $_POST['orden_compra_horario'];
	$compraHorarioEnd 	= $_POST['orden_compra_horarioEnd'];
	$compraLugar 		= $_POST['orden_compra_lugar'];
	$compraLugarPers 	= $_POST['orden_compra_lugarPers'];
	$compraCliente 		= $_POST['orden_compra_cliente'];
	$compraPago 		= $_POST['orden_compra_pago'];
	$compraCommunity 	= $_POST['orden_compra_community'];
	$compraOrigen 	 	= $_POST['orden_compra_origen'];
	$compraEstatus 	 	= $_POST['orden_compra_estatus'];

	/* Crear post orden_compra */
	$post = array(
		'ID'           => $post_id,
	);

	$orden_id = wp_update_post($post);

	update_post_meta($orden_id,'orden_compra_fecha',$compraFecha);
	update_post_meta($orden_id,'orden_compra_horario',$compraHorario);
	update_post_meta($orden_id,'orden_compra_horarioEnd',$compraHorarioEnd);
	update_post_meta($orden_id,'orden_compra_lugar',$compraLugar);
	update_post_meta($orden_id,'orden_compra_lugarPers',$compraLugarPers);
	update_post_meta($orden_id,'orden_compra_cliente',$compraCliente);
	update_post_meta($orden_id,'orden_compra_pago',$compraPago);
	update_post_meta($orden_id,'orden_compra_community',$compraCommunity);
	update_post_meta($orden_id,'orden_compra_origen',$compraOrigen);
	update_post_meta($orden_id,'orden_compra_estatus',$compraEstatus);

	/* Enviar mail alertando sobre orden */
/*	$to 				= "pruebas@altoempleo.com.mx";
	$subject 			= "Nuevo Registro de Orden Mundo Bolita";

	if ($compraHorarioEnd != '') { 
		$compraHorario 	= $compraHorario . " a " . $compraHorarioEnd; 
	}
	if ($compraLugar === 'Otro') { 
		$compraLugar 		= $compraLugar . " - " . $compraLugarPers; 
	}

	setlocale(LC_ALL,"es_ES");
	$compraFechaEsp 	= strftime("%d de %B del %Y", strtotime($compraFecha));

	$message 	 	 	= '<html style="font-family: Arial, sans-serif;"><body>';
	$message 			.= '<div style="text-align: center; margin-bottom: 20px;"><a style="color: #000; text-align: center; display: block;" href="' . SITEURL . '"><img style="display: inline-block; margin: auto;" src="http://mundobolita.com/wp-content/themes/mundo-bolita/images/identidad/logo-correo.png" alt="Logo Mundo Bolita"></a></div>';
	$message 	 		.= '<p style="margin-bottom: 20px;">Se a <span style="color: #de0d88;">registrado</span> una nueva orden de compra para una piñata con la siguiente información: <p/>';
	$message 			.= '<div style="margin-bottom: 30px;"><p><strong style="color: #de0d88;">Modelo: </strong>' . $compraModelo . '</p>';
	$message 			.= '<p><strong style="color: #de0d88;">Entrega: </strong>' . $compraFechaEsp . ' - ' . $compraHorario . ' | ' . $compraLugar . '</p>';
	$message 			.= '<p><strong style="color: #de0d88;">Cliente: </strong>' . $compraCliente . '</p>';
	$message 			.= '<p><strong style="color: #de0d88;">Pago: </strong>$' . $compraPago . ' liquida a contraentrega</p>';
	$message 			.= '<p><strong style="color: #de0d88;">Community Manager: </strong>' . $compraCommunity . '</p></div>';	
	$message 			.= '<pstyle="margin-top: 20px;"><strong style="color: #de0d88;">Origen: </strong>' . $compraOrigen . '</p></div>';
	$message 			.= '<p style="margin-bottom: 20px;">Esta es una alerta para recordarte que el día de mañana está programada la entrega de: <p/>';
	$message 	        .= '<div style="text-align: center; margin-bottom: 10px;"><p><small>Este email ha sido enviado desde el sistema de alertas de entregas de Mundo Bolita. </small></p></div>';
	$message 	        .= '</body></html>';

	wp_mail($to, $subject, $message);*/
endif; ?>