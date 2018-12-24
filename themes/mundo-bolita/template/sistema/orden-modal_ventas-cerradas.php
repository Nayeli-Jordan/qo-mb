<?php 
$argsOrdenCerrada = array(
    'post_type' => 'orden_compra',
    'posts_per_page' => -1,    
	'orderby' 			=> 'date',
	'order' 			=> 'ASC',
	'meta_query'	=> array( 		/* Mostrar ordenes Cerradas */
		'relation'		=> 'AND',
		array(
			'key'		=> 'orden_compra_modelo',
			'value'		=> $productName,
			'compare'	=> '='
		),
		array(
			'key'		=> 'orden_compra_estatus',
			'value'		=> 'estatus_ventaCerrada',
			'compare'	=> '='
		)
	)
);
$loopOrdenCerrada = new WP_Query( $argsOrdenCerrada );
if ( $loopOrdenCerrada->have_posts() ) {
	$infoOrdenCerrada	= '';
    while ( $loopOrdenCerrada->have_posts() ) : $loopOrdenCerrada->the_post(); 
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

    	$ordenCompraCerrada ++;
    	if ($origen === 'Apartada de stock de tienda') {
    		$origen = 'Tienda';
    	} else {
    		$origen = 'Fábrica';
    	}

	    $infoOrdenCerrada  .= '<div class="row margin-bottom-xsmall infoOrden ' . $estatus . '">';
		    $infoOrdenCerrada  .= '<div class="col s12 m3"><span class="line-text-overflow inline-block">' . $cliente . '</span></div>';
		    $infoOrdenCerrada  .= '<div class="col s12 m4">' . $fechaNew . ' | ' . $lugar . '</div>';
		    $infoOrdenCerrada  .= '<div class="col s12 m2">$' . $pago . '.00</div>';
		    $infoOrdenCerrada  .= '<div class="col s12 m2">' . $origen . '</div>';
		    $infoOrdenCerrada  .= '<div class="col s12 m1"><a href="' . $permalink . '" target="_blank"><i class="icon-eye"></i></a></div>';
	    $infoOrdenCerrada  .= '</div>';
    endwhile;
} 
wp_reset_postdata();
if ($ordenCompraCerrada != 0 ) {  ?>

	<div id="product_<?php echo $product_slug; ?>_cerradas" class="modal modal-detalles-orden">
		<div class="modal-content">
			<i class="icon-cancel modal-close"></i>
			<p class="color-primary no-margin-top text-center">Ordenes Cerradas de <?php echo $productName; ?></p>
			<div class="row no-margin-bottom hide-on-small-only">
				<div class="col s12 m3 uppercase">Cliente</div>
				<div class="col s12 m4 uppercase">Entregado</div>
				<div class="col s12 m2 uppercase">Pago</div>
				<div class="col s12 m2 uppercase">Origen</div>
			</div>
			<?php echo $infoOrdenCerrada; ?>
		</div>
	</div>

<?php } ?>