<?php $today = date("Y-m-d"); ?>
<div id="nuevo-apartado" class="modal">
	<div class="modal-content">
		<p class="color-primary no-margin-top text-center">Registrar nuevo apartado</p>
		<form id="apartado-form" action=""  method="post" class="validation row" data-parsley-apartado>
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
                	<option value="Stock de tienda">Stock de tienda</option>
                	<option value="Pedido a fabrica">Pedido a fabrica</option>
                </select>
			</div>
			<div class="col s12 text-right">
				<input type="submit" name="submitApartado" class="btn" value="Enviar" />	
			</div>
		</form>
	</div>
</div>

<?php if(isset($_POST['submitApartado'])){
	/* Crear post orden_compra */
	$title 		= 'Apartado de ' . $_POST['orden_compra_modelo'] . 'FBMB';

	$post = array(
		'post_title'	=> wp_strip_all_tags($title),
		'post_status'	=> 'publish',
		'post_type' 	=> 'orden_compra'
	);

	$apartado_id = wp_insert_post($post);

	update_post_meta($apartado_id,'orden_compra_fecha',$_POST['orden_compra_fecha']);
	update_post_meta($apartado_id,'orden_compra_horario',$_POST['orden_compra_horario']);
	update_post_meta($apartado_id,'orden_compra_horarioEnd',$_POST['orden_compra_horarioEnd']);
	update_post_meta($apartado_id,'orden_compra_lugar',$_POST['orden_compra_lugar']);
	update_post_meta($apartado_id,'orden_compra_lugarPers',$_POST['orden_compra_lugarPers']);
	update_post_meta($apartado_id,'orden_compra_modelo',$_POST['orden_compra_modelo']);
	update_post_meta($apartado_id,'orden_compra_cliente',$_POST['orden_compra_cliente']);
	update_post_meta($apartado_id,'orden_compra_pago',$_POST['orden_compra_pago']);
	update_post_meta($apartado_id,'orden_compra_community',$_POST['orden_compra_community']);
	//wp_redirect(site_url('mb-stock/#apartado_creado'));
} ?>