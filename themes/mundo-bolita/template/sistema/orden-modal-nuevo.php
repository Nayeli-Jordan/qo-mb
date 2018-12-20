<?php $today = date("Y-m-d"); ?>
<div id="nuevo-orden" class="modal modal-medium modal-large">
	<i class="icon-cancel modal-close"></i>
	<div class="modal-content">
		<p class="color-primary no-margin-top text-center">Registrar nueva orden de compra</p>
		<form id="orden-form" name="orden-form" action=""  method="post" class="validation row" data-parsley-orden>
			<div class="col s12 m6 input-field">
				<label for="orden_compra_fecha">Fecha de entrega*:</label>
   				<input type="date" min="<?php echo $today; ?>" name="orden_compra_fecha" id="orden_compra_fecha" required  data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s6 m3 input-field">
				<label for="orden_compra_horario">Horario de*:</label>
    			<input type="text" name="orden_compra_horario" id="orden_compra_horario" placeholder="9 am" required  data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s6 m3 input-field">
				<label for="orden_compra_horarioEnd">A*:</label>
    			<input type="text" name="orden_compra_horarioEnd" id="orden_compra_horarioEnd" placeholder="6 pm" required  data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s12 m6 input-field clearfix">
				<label for="orden_compra_lugar">Lugar de entrega*:</label>
                <select name="orden_compra_lugar" id="orden_compra_lugar" required  data-parsley-required-message="Campo obligatorio">                	
                	<option value=""></option>
                    <option value="Cuautitlán Izcalli">Cuautitlán Izcalli</option>
                    <option value="Col. del Valle">Col. de. Valle</option>
                    <option value="Otro">Otro</option>
                </select>
			</div>
			<div class="col s12 m6 input-field">
				<label for="orden_compra_lugarPers">Si es otro:</label>
    			<input type="text" name="orden_compra_lugarPers" id="orden_compra_lugarPers" placeholder="Lugar">
			</div>
			<div class="col s12 m6 input-field clearfix">
				<label for="orden_compra_modelo">Modelo*:</label>
                <select name="orden_compra_modelo" id="orden_compra_modelo" required  data-parsley-required-message="Campo obligatorio">
                	<option value=""></option>
           			<?php
				        $args = array(
				            'post_type' => 'product',
				            'posts_per_page' => -1
				            );
				        $loop = new WP_Query( $args );
				        $i = 1;
				        if ( $loop->have_posts() ) {
				            while ( $loop->have_posts() ) : $loop->the_post();	            	 
				            	$post_id        = get_the_ID();
                           		$productName 	= get_the_title( $post_id );?>
								<option value="<?php echo $productName; ?>"><?php echo $productName; ?></option>
				            <?php $i ++; endwhile;
				        } 
				        wp_reset_postdata();
				    ?>
                </select>
			</div>
			<div class="col s12 m6 input-field">
				<label for="orden_compra_cliente">Cliente*:</label>
   				<input type="text" name="orden_compra_cliente" id="orden_compra_cliente" required  data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s12 m6 input-field clearfix">
				<label for="orden_compra_pago">Cantidad a pagar*:</label>
    			<input type="number" name="orden_compra_pago" id="orden_compra_pago" placeholder="460" required  data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s12 m6 input-field">
				<label for="orden_compra_community">Community Manager*:</label>
    			<input type="text" name="orden_compra_community" id="orden_compra_community" required  data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s12 input-field margin-top">
				<label for="orden_compra_origen">Origen de la piñata*:</label>
    			<select name="orden_compra_origen" id="orden_compra_origen" required  data-parsley-required-message="Campo obligatorio">
    				<option value=""></option>
                	<option value="Apartada de stock de tienda">Apartada de stock de tienda</option>
                	<option value="Pedido de fábrica">Pedido de fábrica</option>
                </select>
			</div>
			<div class="col s12 text-right">
				<input type="submit" id="mb_submitOrden" name="mb_submitOrden" class="btn" value="Guardar" />
				<input type="hidden" name="send_submitOrden" value="post" />
				<?php wp_nonce_field( 'orden-form' ); ?>	
			</div>
		</form>
	</div>
</div>

<?php if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['send_submitOrden'] )):

	$compraFecha 		= $_POST['orden_compra_fecha'];
	$compraHorario 		= $_POST['orden_compra_horario'];
	$compraHorarioEnd 	= $_POST['orden_compra_horarioEnd'];
	$compraLugar 		= $_POST['orden_compra_lugar'];
	$compraLugarPers 	= $_POST['orden_compra_lugarPers'];
	$compraModelo 		= $_POST['orden_compra_modelo'];
	$compraCliente 		= $_POST['orden_compra_cliente'];
	$compraPago 		= $_POST['orden_compra_pago'];
	$compraCommunity 	= $_POST['orden_compra_community'];
	$compraOrigen 	 	= $_POST['orden_compra_origen'];

	/* Crear post orden_compra */
	$title 		= 'Orden de compra - ' . $compraModelo;

	$post = array(
		'post_title'	=> wp_strip_all_tags($title),
		'post_status'	=> 'publish',
		'post_type' 	=> 'orden_compra'
	);

	$orden_id = wp_insert_post($post);

	update_post_meta($orden_id,'orden_compra_fecha',$compraFecha);
	update_post_meta($orden_id,'orden_compra_horario',$compraHorario);
	update_post_meta($orden_id,'orden_compra_horarioEnd',$compraHorarioEnd);
	update_post_meta($orden_id,'orden_compra_lugar',$compraLugar);
	update_post_meta($orden_id,'orden_compra_modelo',$compraModelo);
	update_post_meta($orden_id,'orden_compra_cliente',$compraCliente);
	update_post_meta($orden_id,'orden_compra_pago',$compraPago);
	update_post_meta($orden_id,'orden_compra_community',$compraCommunity);
	update_post_meta($orden_id,'orden_compra_origen',$compraOrigen);
	if ($compraLugar === 'Otro') { 
		update_post_meta($orden_id,'orden_compra_lugarPers',$compraLugarPers);
	}
	if ($compraOrigen === 'Apartada de stock de tienda') { 
		update_post_meta($orden_id,'orden_compra_estatus','estatus_enTienda');
	} else {
		update_post_meta($orden_id,'orden_compra_estatus','estatus_enFabrica');
	}

	/* Enviar mail alertando sobre orden */
	$to 				= "pruebas@altoempleo.com.mx";
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

	wp_mail($to, $subject, $message);
endif; ?>