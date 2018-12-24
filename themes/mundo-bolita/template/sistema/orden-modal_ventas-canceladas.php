<?php 
$argsOrdenCancelada = array(
    'post_type' => 'orden_compra',
    'posts_per_page' => -1,    
	'orderby' 			=> 'date',
	'order' 			=> 'ASC',
	'meta_query'	=> array( 		/* Mostrar ordenes Canceladas */
		'relation'		=> 'AND',
		array(
			'key'		=> 'orden_compra_modelo',
			'value'		=> $productName,
			'compare'	=> '='
		),
		array(
			'key'		=> 'orden_compra_estatus',
			'value'		=> 'estatus_ventaCancelada',
			'compare'	=> '='
		)
	)
);
$loopOrdenCancelada = new WP_Query( $argsOrdenCancelada );
if ( $loopOrdenCancelada->have_posts() ) {
	$infoOrdenCancelada	= '';
    while ( $loopOrdenCancelada->have_posts() ) : $loopOrdenCancelada->the_post(); 
    	$custom_fields  = get_post_custom();
		$post_id        = get_the_ID();
	    $cliente       	= get_post_meta( $post_id, 'orden_compra_cliente', true );
	    $lugar       	= get_post_meta( $post_id, 'orden_compra_lugar', true );
		$pago       	= get_post_meta( $post_id, 'orden_compra_pago', true );
		$estatus       	= get_post_meta( $post_id, 'orden_compra_estatus', true );
		$origen       	= get_post_meta( $post_id, 'orden_compra_origen', true );
		$estatus       	= get_post_meta( $post_id, 'orden_compra_estatus', true );
	    $fecha       	= get_post_meta( $post_id, 'orden_compra_fecha', true );
	    $fechaNew		= date('d/m/Y', strtotime($fecha));

	    $permalink 		= get_permalink();

		if ($lugar === 'Otro') { 
			$lugar 		= get_post_meta( $post_id, 'orden_compra_lugarPers', true ); 
		}

    	$ordenCompraCancelada ++;
    	if ($origen === 'Apartada de stock de tienda') {
    		$origen = 'Tienda';
    	} else {
    		$origen = 'Fábrica';
    	}

	    $infoOrdenCancelada  .= '<div class="row margin-bottom-xsmall infoOrden ' . $estatus . '">';
		    $infoOrdenCancelada  .= '<div class="col s12 m3"><span class="line-text-overflow inline-block">' . $cliente . '</span></div>';
		    $infoOrdenCancelada  .= '<div class="col s12 m4">' . $fechaNew . ' | ' . $lugar . '</div>';
		    $infoOrdenCancelada  .= '<div class="col s12 m2">$' . $pago . '.00</div>';
		    $infoOrdenCancelada  .= '<div class="col s12 m2">' . $origen . '</div>';
		    $infoOrdenCancelada  .= '<div class="col s12 m1"><a href="' . $permalink . '" target="_blank"><i class="icon-eye"></i></a></div>';
	    $infoOrdenCancelada  .= '</div>';
    endwhile;
} 
wp_reset_postdata();
if ($ordenCompraCancelada != 0 ) {  ?>

	<div id="product_<?php echo $product_slug; ?>_canceladas" class="modal modal-detalles-orden">
		<div class="modal-content">
			<i class="icon-cancel modal-close"></i>
			<p class="color-primary no-margin-top text-center">Ordenes Canceladas de <?php echo $productName; ?></p>
			<div class="row no-margin-bottom hide-on-small-only">
				<div class="col s12 m3 uppercase">Cliente</div>
				<div class="col s12 m4 uppercase">Entregaría</div>
				<div class="col s12 m2 uppercase">Pagaría</div>
				<div class="col s12 m2 uppercase">Origen</div>
			</div>
			<?php echo $infoOrdenCancelada; ?>
		</div>
	</div>

<?php } ?>