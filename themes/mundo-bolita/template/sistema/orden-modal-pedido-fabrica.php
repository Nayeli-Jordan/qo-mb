<?php 
	$today = date("Y-m-d"); 

	$custom_fields  	= get_post_custom();
	$post_id        	= get_the_ID();
	$modelo     		= get_post_meta( $post_id, 'orden_compra_modelo', true );
	$fechaSolicitud     = get_post_meta( $post_id, 'orden_compra_fechaSolicitud', true );
	$entregaSolicitud   = get_post_meta( $post_id, 'orden_compra_entregaSolicitud', true );
	$persSolicitud   	= get_post_meta( $post_id, 'orden_compra_persSolicitud', true );
	$estatusSolicitud   = get_post_meta( $post_id, 'orden_compra_estatusSolicitud', true );
	$notasSolicitud   	= get_post_meta( $post_id, 'orden_compra_notasSolicitud', true );

	setlocale(LC_ALL,"es_ES");
?>
<div id="pedido-fabrica" class="modal modal-medium">
	<i class="icon-cancel modal-close"></i>
	<div class="modal-content">
		<p class="color-primary no-margin-top text-center">Detalles del pedido a fábrica</p>
		<div class="row text-center">
			<?php 
			if ($fechaSolicitud === '' || $entregaSolicitud === '' || $persSolicitud === '' || $estatusSolicitud === '' || $notasSolicitud === ''): 
				echo '<p class="col s12"><span class="color-primary">Aún no hay información de pedido a fábrica.</span></p>';
			endif;
			if ($fechaSolicitud != ''): 
				$fechaSolicitudEsp	 = strftime("%d de %B del %Y", strtotime($fechaSolicitud));
				echo '<p class="col s12 m6"><span class="color-primary">Fecha de solicitud: </span><br>' . $fechaSolicitudEsp . '</p>';
			endif;
			if ($entregaSolicitud != ''): 
				$entregaSolicitudEsp = strftime("%d de %B del %Y", strtotime($entregaSolicitud));
				echo '<p class="col s12 m6"><span class="color-primary">Fecha de entrega: </span><br>' . $entregaSolicitudEsp . '</p>';
			endif;
			if ($persSolicitud != ''): 
				echo '<p class="col s12 m6"><span class="color-primary">¿Quién solicito?: </span><br>' . $persSolicitud . '</p>';
			endif;
			if ($estatusSolicitud != ''): 
				if ($estatusSolicitud === 'estatus_entregada') {
					$labelEstatusSolicitud = 'Ya se entregó';
				} elseif ($estatusSolicitud === 'estatus_enEspera') {
					$labelEstatusSolicitud = 'Esperando entrega';
				}
				echo '<p class="col s12 m6"><span class="color-primary">Estatus: </span><br>' . $labelEstatusSolicitud . '</p>';
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
   				<input type="date" name="orden_compra_entregaSolicitud" id="orden_compra_entregaSolicitud" <?php if ($entregaSolicitud != '') { echo 'value="' . $entregaSolicitud . '"'; } ?> required  data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s12 m6 input-field">
				<label for="orden_compra_persSolicitud">¿Quién solicito?:</label>
    			<input type="text" name="orden_compra_persSolicitud" id="orden_compra_persSolicitud" <?php if ($persSolicitud != '') { echo 'value="' . $persSolicitud . '"'; } ?> required  data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s12 m6 input-field">
				<label for="orden_compra_estatusSolicitud">Estatus*:</label>
				<select name="orden_compra_estatusSolicitud" id="orden_compra_estatusSolicitud" required  data-parsley-required-message="Campo obligatorio">
					<?php if ($estatusSolicitud != '') : ?>
    					<option value="<?php echo $estatusSolicitud; ?>" select="selected"><?php echo $labelEstatusSolicitud; ?></option>
    				<?php else: ?>
    					<option value=""></option>
    				<?php endif; ?>
    				<option value="estatus_enEspera">Esperando entrega</option>
                	<option value="estatus_entregada">Ya se entregó</option>
                </select>
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

	$pedidoModelo     			= get_post_meta( $post_id, 'orden_compra_modelo', true );
	$pedidoFechaSolicitud		= $_POST['orden_compra_fechaSolicitud'];
	$pedidoPersSolicitud 		= $_POST['orden_compra_persSolicitud'];
	$pedidoEntregaSolicitud 	= $_POST['orden_compra_entregaSolicitud'];
	$pedidoEstatusSolicitud 	= $_POST['orden_compra_estatusSolicitud'];
	$pedidoNotasSolicitud 		= $_POST['orden_compra_notasSolicitud'];

	/* Actualizar post orden con datos de pedido a fábrica */

	$post = array(
		'ID'           => $post_id,
	);

	$orden_id = wp_update_post($post);

	update_post_meta($orden_id,'orden_compra_fechaSolicitud',$pedidoFechaSolicitud);
	update_post_meta($orden_id,'orden_compra_persSolicitud',$pedidoPersSolicitud);
	update_post_meta($orden_id,'orden_compra_entregaSolicitud',$pedidoEntregaSolicitud);
	update_post_meta($orden_id,'orden_compra_estatusSolicitud',$pedidoEstatusSolicitud);
	update_post_meta($orden_id,'orden_orden_compra_notasSolicitud',$pedidoNotasSolicitud);

	setlocale(LC_ALL,"es_ES");
	$pedidoFechaSolicitudEsp 	= strftime("%d de %B del %Y", strtotime($pedidoFechaSolicitud));
	$pedidoEntregaSolicitudEsp 	= strftime("%d de %B del %Y", strtotime($pedidoEntregaSolicitud));

	$message 	 	 	= '<html style="font-family: Arial, sans-serif;"><body>';
	$message 			.= '<div style="text-align: center; margin-bottom: 20px;"><a style="color: #000; text-align: center; display: block;" href="' . SITEURL . '"><img style="display: inline-block; margin: auto;" src="http://mundobolita.com/wp-content/themes/mundo-bolita/images/identidad/logo-correo.png" alt="Logo Mundo Bolita"></a></div>';
	$message 	 		.= '<p style="margin-bottom: 20px;">Se ha <span style="color: #de0d88;">registrado</span> un pedido a fábrica para una piñata con la siguiente información: </p>';
	$message 			.= '<div style="margin-bottom: 30px;"><p><strong style="color: #de0d88;">Modelo: </strong>' . $pedidoModelo . '</p></div>';
	$message 			.= '<div style="margin-bottom: 30px;"><p><strong style="color: #008fcc;">Fecha en la que se solicitó: </strong>' . $pedidoFechaSolicitudEsp . '</p>';
	$message 			.= '<p><strong style="color: #008fcc;">Fecha de entrega acordada: </strong>' . $pedidoEntregaSolicitudEsp . '</p>';
	$message 			.= '<p><strong style="color: #008fcc;">¿Quién solicito?: </strong>' . $pedidoPersSolicitud . '</p></div>';	
	$message 			.= '<pstyle="margin-top: 20px;"><strong style="color: #008fcc;">Notas pedido: </strong>' . $pedidoNotasSolicitud . '</p></div>';
	$message 	        .= '<div style="text-align: center; margin-bottom: 10px;"><p><small>Este email ha sido enviado desde el sistema de alertas de pedidos de Mundo Bolita. </small></p></div>';
	$message 	        .= '</body></html>';

	if ($pedidoEstatusSolicitud === 'estatus_enEspera') {
		$to 				= "pruebas@altoempleo.com.mx"; /*to do - a quién le llegará */
		$subject 			= "Pedido a fábrica de " . $pedidoModelo;
		wp_mail($to, $subject, $message);
	}
endif; ?>