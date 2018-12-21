<?php $today = date("Y-m-d"); ?>
<div id="modificar-estatus" class="modal modal-small">
	<i class="icon-cancel modal-close"></i>
	<div class="modal-content">
		<p class="color-primary no-margin-top text-center">Modificar estatus de Orden de compra</p>
		<form id="estatus-form" action=""  method="post" class="validation row" data-parsley-estatus>
			<div class="col s12 input-field margin-top">
				<label for="orden_compra_estatus">Estatus de la piñata*:</label>
    			<select name="orden_compra_estatus" id="orden_compra_estatus" required  data-parsley-required-message="Campo obligatorio">
                    <option value="estatus_enFabrica">En fábrica</option>
                    <option value="estatus_enTienda">En tienda</option>
                    <option value="estatus_enCamino">En camino</option>
                    <option value="estatus_enPuntoEntrega">En punto de entrega</option>
                    <option value="estatus_efectivo">Pagada, efectivo en camino</option>
                    <option value="estatus_ventaCerrada">Venta cerrada</option>
                    <option value="estatus_ventaCancelada">Venta cancelada</option>
                </select>
			</div>
			<div class="col s12 text-right">
				<input type="submit" name="submitEstatus" class="btn" value="Enviar" />	
			</div>
		</form>
	</div>
</div>

<?php if(isset($_POST['submitEstatus'])){

	$compraestatus 		= $_POST['orden_compra_estatus'];

	/* Actualizar estatus en post orden_compra */
	update_post_meta($orden_id,'orden_compra_estatus',$compraEstatus);

	/* Enviar mail alertando sobre orden */
	/*$to 				= "pruebas@altoempleo.com.mx";
	$subject 			= "Estatus de Orden de compra modificado";

	$message 	 	 	= '<html style="font-family: Arial, sans-serif;"><body>';
	$message 			.= '<div style="text-align: center; margin-bottom: 20px;"><a style="color: #000; text-align: center; display: block;" href="' . SITEURL . '"><img style="display: inline-block; margin: auto;" src="http://mundobolita.com/wp-content/themes/mundo-bolita/images/identidad/logo-correo.png" alt="Logo Mundo Bolita"></a></div>';
	$message 	 		.= '<p style="margin-bottom: 20px;">Se a <span style="color: #de0d88;">registrado</span> una nueva orden de compra para una piñata con la siguiente información: <p/>';
	$message 			.= '<div style="margin-bottom: 30px;"><p><strong style="color: #de0d88;">Modelo: </strong>' . $compraModelo . '</p>';
	$message 			.= '<p><strong style="color: #de0d88;">Entrega: </strong>' . $compraFechaEsp . ' - ' . $compraHorario . ' | ' . $compraLugar . '</p>';
	$message 			.= '<p><strong style="color: #de0d88;">Cliente: </strong>' . $compraCliente . '</p>';
	$message 			.= '<p><strong style="color: #de0d88;">Pago: </strong>$' . $compraPago . ' liquida a contraentrega</p>';
	$message 			.= '<p><strong style="color: #de0d88;">Community Manager: </strong>' . $compraCommunity . '</p></div>';
	$message 			.= '<p style="margin-bottom: 20px;">Esta es una alerta para recordarte que el día de mañana está programada la entrega de: <p/>';
	$message 	        .= '<div style="text-align: center; margin-bottom: 10px;"><p><small>Este email ha sido enviado desde el sistema de alertas de entregas de Mundo Bolita. </small></p></div>';
	$message 	        .= '</body></html>';

	wp_mail($to, $subject, $message);*/
	//wp_redirect(site_url('mb-stock/#orden_creado'));
} ?>