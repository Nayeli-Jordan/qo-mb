<?php 
	$today = date("Y-m-d"); 

	$custom_fields  	= get_post_custom();
	$post_id        	= get_the_ID();
	$fechaSolicitud     = get_post_meta( $post_id, 'orden_compra_fechaSolicitud', true );
	$entregaSolicitud   = get_post_meta( $post_id, 'orden_compra_entregaSolicitud', true );
	$persSolicitud   	= get_post_meta( $post_id, 'orden_compra_persSolicitud', true );
	$notasSolicitud   	= get_post_meta( $post_id, 'orden_compra_notasSolicitud', true );

	setlocale(LC_ALL,"es_ES");
?>
<div id="pedido-fabrica" class="modal modal-medium">
	<i class="icon-cancel modal-close"></i>
	<div class="modal-content">
		<p class="color-primary no-margin-top text-center">Detalles del pedido a fábrica</p>
		<div class="row text-center">
			<?php 
			if ($fechaSolicitud != ''): 
				$fechaSolicitudEsp	 = strftime("%d de %B del %Y", strtotime($fechaSolicitud));
				echo '<p class="col s12 m4"><span class="color-primary">Fecha de solicitud: </span><br>' . $fechaSolicitudEsp . '</p>';
			endif;
			if ($entregaSolicitud != ''): 
				$entregaSolicitudEsp = strftime("%d de %B del %Y", strtotime($entregaSolicitud));
				echo '<p class="col s12 m4"><span class="color-primary">Fecha de entrega: </span><br>' . $entregaSolicitudEsp . '</p>';
			endif;
			if ($persSolicitud != ''): 
				echo '<p class="col s12 m4"><span class="color-primary">¿Quién solicito?: </span><br>' . $persSolicitud . '</p>';
			endif;
			if ($notasSolicitud != ''): 
				echo '<p class="col s12"><span class="color-primary">Notas: </span><br>' . $notasSolicitud . '</p>';
			endif; ?>			
		</div>
		<form id="pedido-form" name="pedido-form" action=""  method="post" class="validation row" data-parsley-pedido>
			<div class="col s12 m6 input-field">
				<label for="orden_compra_fechaSolicitud">Fecha en la que se solicitó*:</label>
   				<input type="date" name="orden_compra_fechaSolicitud" id="orden_compra_fechaSolicitud" <?php if ($fechaSolicitud != '') { echo 'value="' . $fechaSolicitud . '"'; } ?> required  data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s12 m6 input-field">
				<label for="orden_compra_entregaSolicitud">Fecha de entrega acordada*:</label>
   				<input type="date" min="<?php echo $today; ?>" name="orden_compra_entregaSolicitud" id="orden_compra_entregaSolicitud" <?php if ($entregaSolicitud != '') { echo 'value="' . $entregaSolicitud . '"'; } ?> required  data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s12 input-field">
				<label for="orden_compra_persSolicitud">¿Quién solicito?:</label>
    			<input type="text" name="orden_compra_persSolicitud" id="orden_compra_persSolicitud" <?php if ($persSolicitud != '') { echo 'value="' . $persSolicitud . '"'; } ?> required  data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s12 input-field">
				<label for="orden_compra_notasSolicitud">Notas pedido:</label>
    			<textarea name="orden_compra_notasSolicitud" id="orden_compra_notasSolicitud"><?php if ($persSolicitud != '') { echo $notasSolicitud; } ?></textarea>
			</div>
			<div class="col s12 text-right">
				<input type="submit" id="mb_submitPedido" name="mb_submitPedido" class="btn" value="Guardar" />
				<input type="hidden" name="send_submitPedido" value="post" />
				<?php wp_nonce_field( 'pedido-form' ); ?>	
			</div>
		</form>
	</div>
</div>

<?php if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['send_submitPedido'] )):

	$pedidoFechaSolicitud		= $_POST['orden_compra_fechaSolicitud'];
	$pedidoPersSolicitud 		= $_POST['orden_compra_persSolicitud'];
	$pedidoEntregaSolicitud 	= $_POST['orden_compra_entregaSolicitud'];
	$pedidoNotasSolicitud 		= $_POST['orden_compra_notasSolicitud'];

	/* Actualizar post orden con datos de pedido a fábrica */

	$post = array(
		'ID'           => $post_id,
	);

	$orden_id = wp_update_post($post);

	update_post_meta($orden_id,'orden_compra_fechaSolicitud',$pedidoFechaSolicitud);
	update_post_meta($orden_id,'orden_compra_persSolicitud',$pedidoPersSolicitud);
	update_post_meta($orden_id,'orden_compra_entregaSolicitud',$pedidoEntregaSolicitud);
	update_post_meta($orden_id,'orden_orden_compra_notasSolicitud',$pedidoNotasSolicitud);

	/*setlocale(LC_ALL,"es_ES");
	$pedidoFechaEsp 	= strftime("%d de %B del %Y", strtotime($pedidoFecha));*/
/*
	$message 	 	 	= '<html style="font-family: Arial, sans-serif;"><body>';
	$message 			.= '<div style="text-align: center; margin-bottom: 20px;"><a style="color: #000; text-align: center; display: block;" href="' . SITEURL . '"><img style="display: inline-block; margin: auto;" src="http://mundobolita.com/wp-content/themes/mundo-bolita/images/identidad/logo-correo.png" alt="Logo Mundo Bolita"></a></div>';
	$message 	 		.= '<p style="margin-bottom: 20px;">Se a <span style="color: #de0d88;">registrado</span> una nueva pedido de pedido para una piñata con la siguiente información: <p/>';
	$message 			.= '<div style="margin-bottom: 30px;"><p><strong style="color: #de0d88;">Modelo: </strong>' . $pedidoModelo . '</p>';
	$message 			.= '<p><strong style="color: #de0d88;">Entrega: </strong>' . $pedidoFechaEsp . ' - ' . $pedidoHorario . ' | ' . $pedidoLugar . '</p>';
	$message 			.= '<p><strong style="color: #de0d88;">Cliente: </strong>' . $pedidoCliente . '</p>';
	$message 			.= '<p><strong style="color: #de0d88;">Pago: </strong>$' . $pedidoPago . ' liquida a contraentrega</p>';
	$message 			.= '<p><strong style="color: #de0d88;">Community Manager: </strong>' . $pedidoCommunity . '</p></div>';	
	$message 			.= '<pstyle="margin-top: 20px;"><strong style="color: #de0d88;">Origen: </strong>' . $pedidoOrigen . '</p></div>';
	$message 			.= '<p style="margin-bottom: 20px;">Esta es una alerta para recordarte que el día de mañana está programada la entrega de: <p/>';
	$message 	        .= '<div style="text-align: center; margin-bottom: 10px;"><p><small>Este email ha sido enviado desde el sistema de alertas de entregas de Mundo Bolita. </small></p></div>';
	$message 	        .= '</body></html>';

	wp_mail($to, $subject, $message);*/
endif; ?>