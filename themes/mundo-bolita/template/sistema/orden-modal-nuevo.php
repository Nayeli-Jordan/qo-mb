<?php $today = date("Y-m-d"); ?>
<div id="nuevo-orden" class="modal modal-medium">
	<i class="icon-cancel modal-close"></i>
	<div class="modal-content">
		<p class="color-primary no-margin-top text-center">Registrar nueva orden de compra</p>
		<form id="orden-form" name="orden-form" action=""  method="post" class="validation row" data-parsley-orden>
			<div class="col s12 m6 l4 input-field">
				<label for="orden_compra_origen">Origen de la piñata*:</label>
    			<select name="orden_compra_origen" id="orden_compra_origen" required  data-parsley-required-message="Campo obligatorio">
    				<option value=""></option>
                	<option value="Stock de tienda">Stock de tienda</option>
                	<option value="Pedido de fábrica">Pedido de fábrica</option>
                </select>
			</div>
			<div class="col s12 m6 l4 input-field">
				<label for="orden_compra_modelo">Modelo*:</label>
				<div class="content_orden_compra_modeloTienda">
	                <select name="orden_compra_modeloTienda" id="orden_compra_modeloTienda">
	                	<option value=""></option>
	           			<?php
					        $args = array(
					            'post_type' => 'product',
					            'posts_per_page' => -1,
								'meta_query'	=> array(
									array(
										'key' => '_stock',
							            'value' => 1,
							            'compare' => '>=',
									)
								)
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
				<div class="content_orden_compra_modeloFabrica hide">
	                <select name="orden_compra_modeloFabrica" id="orden_compra_modeloFabrica" class="hide">
	                	<option value=""></option>
	           			<?php
					        $args = array(
					            'post_type' => 'product',
					            'posts_per_page' => -1,
					            'orderby' => 'title',
					            'order' => 'ASC'
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
			</div>
			<div class="col s12 m6 l4 input-field">
				<label for="orden_compra_cliente">Cliente*:</label>
   				<input type="text" name="orden_compra_cliente" id="orden_compra_cliente"placeholder="De tienda / Nombre" required data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s12 margin-top-35"></div>
			<div class="col s12 m6 l4 input-field">
				<label for="orden_compra_responsable">Responsable venta*:</label>
    			<input type="text" name="orden_compra_responsable" id="orden_compra_responsable" required  data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s12 m6 l4 input-field">
				<label for="orden_compra_fechaVenta">Fecha de venta*:</label>
    			<input type="date" name="orden_compra_fechaVenta" id="orden_compra_fechaVenta" required  data-parsley-required-message="Campo obligatorio">
			</div>		
			<div class="col s12 m6 l4 input-field">
				<label for="orden_compra_estatusVenta color-primary">Estatus Venta*:</label>
    			<select name="orden_compra_estatusVenta" id="orden_compra_estatusVenta" required  data-parsley-required-message="Campo obligatorio">
    				<option value=""></option>
                    <option value="estatus_abierta">Venta abierta</option>
                    <option value="estatus_cerrada">Venta cerrada</option>
                    <option value="estatus_cancelada">Venta cancelada</option>
                </select>
			</div>
			<div class="col s12 input-field">
				<label for="orden_compra_observaciones">Observaciones:</label>
    			<input type="text" name="orden_compra_observaciones" id="orden_compra_observaciones">
			</div>	
			<div class="col s12 margin-top-35"></div>
			<div class="col s12 m6 l4 input-field">
				<label for="orden_compra_pago">Cantidad a pagar*:</label>
    			<input type="number" min="0" name="orden_compra_pago" id="orden_compra_pago" placeholder="0" required  data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s12 m6 l4 input-field">
				<label for="orden_compra_metodoPago">Método de pago*:</label>
    			<select name="orden_compra_metodoPago" id="orden_compra_metodoPago" required  data-parsley-required-message="Campo obligatorio">
    				<option value=""></option>
    				<option value="Efectivo">Efectivo</option>
    				<option value="Tarjeta">Tarjeta</option>
    				<option value="Prestamo">Préstamo</option>
    				<option value="Otro">Otro</option>
    			</select>
			</div>
			<div class="col s12 m6 l4 input-field">
				<label for="orden_compra_estatusPago color-primary">Estatus Pago*:</label>
    			<select name="orden_compra_estatusPago" id="orden_compra_estatusPago" required  data-parsley-required-message="Campo obligatorio">
    				<option value=""></option>
                    <option value="estatus_noPagada">No pagada</option>
                    <option value="estatus_enCamino">Efectivo en camino</option>
                    <option value="estatus_enTienda">Dinero en tienda</option>
                    <option value="estatus_enCuenta">Dinero en cuenta</option>
                    <option value="estatus_conSupervisor">Dinero con supervisor</option>
                </select>
			</div>
			<div class="col s12 input-field">
				<label for="orden_compra_notaPago">Nota de pago:</label>
    			<input type="text" name="orden_compra_notaPago" id="orden_compra_notaPago">
			</div>
			<div class="col s12 margin-top-35"></div>
			<div class="col s12 m6 l4 input-field clearfix">
				<label for="orden_compra_fecha">Fecha de entrega*:</label>
   				<input type="date" min="<?php echo $today; ?>" name="orden_compra_fecha" id="orden_compra_fecha" required  data-parsley-required-message="Campo obligatorio">
			</div>
			<div class="col s12 m6 l4 input-field">
				<label for="orden_compra_lugar">Lugar de entrega*:</label>
                <select name="orden_compra_lugar" id="orden_compra_lugar" required  data-parsley-required-message="Campo obligatorio">                	
                	<option value=""></option>
                    <option value="Sucursal Izcalli">Sucursal Izcalli</option>
                    <option value="Col. del Valle">Col. de. Valle</option>
                    <option value="Otro">Otro</option>
                </select>
			</div>
			<div class="col s12 m12 l4 input-field">
				<label for="orden_compra_estatusEntrega color-primary">Estatus Entrega*:</label>
    			<select name="orden_compra_estatusEntrega" id="orden_compra_estatusEntrega" required  data-parsley-required-message="Campo obligatorio">
    				<option value=""></option>
                    <option value="estatus_enProduccion">En producción, fábrica</option>
                    <option value="estatus_enTienda">En tienda</option>
                    <option value="estatus_enPuntoEntrega">En punto de entrega</option>
                    <option value="estatus_entregada">Entregada</option>
                </select>
			</div>
			<div class="col s12 input-field">
				<label for="orden_compra_entrega">Detalles entrega:</label>
    			<input type="text" name="orden_compra_entrega" id="orden_compra_entrega" placeholder="Lugar, hora, etc.">
			</div>
			<div class="col s12 text-right margin-top">
				<input type="submit" id="mb_submitOrden" name="mb_submitOrden" class="btn" value="Guardar" />
				<input type="hidden" name="send_submitOrden" value="post" />
				<?php wp_nonce_field( 'orden-form' ); ?>	
			</div>
		</form>
	</div>
</div>

<?php if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['send_submitOrden'] )):

    $compra_origen         = $_POST['orden_compra_origen'];
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

	if ($compra_origen === 'Stock de tienda') { 
		$compra_modelo 		= $_POST['orden_compra_modeloTienda'];
	} else {
		$compra_modelo 		= $_POST['orden_compra_modeloFabrica'];
	}

	/* Crear post orden_compra */
	$title 		= 'Orden de compra - ' . $compra_modelo;

	$post = array(
		'post_title'	=> wp_strip_all_tags($title),
		'post_status'	=> 'publish',
		'post_type' 	=> 'orden_compra'
	);

	$orden_id = wp_insert_post($post);

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

	/* Enviar mail alertando sobre orden */
	$to 				= "pruebas@altoempleo.com.mx";
	$subject 			= "Orden de compra " . $compra_modelo;

	setlocale(LC_ALL,"es_ES");
	$compra_fechaEsp 		= strftime("%d de %B del %Y", strtotime($compra_fecha));
	$compra_fechaVentaEsp 	= strftime("%d de %B del %Y", strtotime($compra_fechaVenta));

	if ($compra_estatusVenta === 'estatus_abierta') { 
		$compra_estatusVenta = 'Abierta';
	} elseif ($compra_estatusVenta === 'estatus_cerrada') { 
		$compra_estatusVenta = 'Cerrada';
	} elseif ($compra_estatusVenta === 'estatus_cancelada') { /* to do - no necesario cancelar en orden nueva, borrar?*/
		$compra_estatusVenta = 'Cancelada';
	}

	if ($compra_estatusPago === 'estatus_noPagada') { 
		$compra_estatusPago = 'No Pagada';
	} elseif ($compra_estatusPago === 'estatus_enCamino') { 
		$compra_estatusPago = 'En Camino';
	} elseif ($compra_estatusPago === 'estatus_enTienda') { 
		$compra_estatusPago = 'En Tienda';
	} elseif ($compra_estatusPago === 'estatus_enCuenta') { 
		$compra_estatusPago = 'En Cuenta';
	} elseif ($compra_estatusPago === 'estatus_conSuperior') { 
		$compra_estatusPago = 'Con Superior';
	}

	if ($compra_estatusEntrega === 'estatus_enProduccion') { 
		$compra_estatusEntrega = 'En Producción';
	} elseif ($compra_estatusEntrega === 'estatus_enTienda') { 
		$compra_estatusEntrega = 'En Tienda';
	} elseif ($compra_estatusEntrega === 'estatus_enPuntoEntrega') { 
		$compra_estatusEntrega = 'En Punto de Entrega';
	} elseif ($compra_estatusEntrega === 'estatus_entregada') { 
		$compra_estatusEntrega = 'Entregada';
	}

	$message 	 	 	= '<html style="font-family: Arial, sans-serif;"><body>';
	$message 			.= '<div style="text-align: center; margin-bottom: 20px;"><a style="color: #000; text-align: center; display: block;" href="' . SITEURL . '"><img style="display: inline-block; margin: auto;" src="http://mundobolita.com/wp-content/themes/mundo-bolita/images/identidad/logo-correo.png" alt="Logo Mundo Bolita"></a></div>';
	$message 	 		.= '<p style="margin-bottom: 20px;"><span style="color: #008fcc;">Nueva orden de compra</span> para una piñata con la siguiente información: </p>';
	$message 			.= '<div style="margin-bottom: 30px;"><p><strong style="color: #de0d88;">Modelo: </strong>' . $compra_modelo . '</p>';
	$message 			.= '<p><strong style="color: #008fcc;">Origen: </strong>' . $compra_origen . '</p>';
	$message 			.= '<p><strong style="color: #008fcc;">Cliente: </strong>' . $compra_cliente . '</p></div>';
	$message 			.= '<p><strong style="color: #de0d88;">Venta: </strong>' . $compra_responsable . ' | ' . $compra_fechaVentaEsp . ' | ' . $compra_estatusVenta . ' | ' . $compra_observaciones . '</p>';
	$message 			.= '<p><strong style="color: #de0d88;">Pago: </strong>$' . $compra_pago . ' | ' . $compra_metodoPago . ' | ' . $compra_estatusPago . ' | ' . $compra_notaPago . '</p>';
	$message 			.= '<p><strong style="color: #de0d88;">Entrega: </strong>' . $compra_fechaEsp . ' | ' . $compra_lugar . ' | ' . $compra_estatusEntrega . ' | ' . $compra_entrega . '</p>';
	$message 	        .= '<div style="text-align: center; margin-bottom: 10px;"><p><small>Este email ha sido enviado desde el stock de Mundo Bolita. </small></p></div>';
	$message 	        .= '</body></html>';

	wp_mail($to, $subject, $message);
endif; ?>