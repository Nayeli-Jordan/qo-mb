<?php 
$argsOrden = array(
    'post_type' => 'orden_compra',
    'posts_per_page' => -1,    
	'orderby' 			=> 'date',
	'order' 			=> 'ASC',
	'meta_query'	=> array( 		/* No mostrar ordenes Cerradas o Canceladas */
		'relation'		=> 'AND',
		array(
			'key'		=> 'orden_compra_modelo',
			'value'		=> $productName,
			'compare'	=> '='
		),
		array(
			'key'		=> 'orden_compra_estatus',
			'value'		=> 'estatus_ventaCerrada',
			'compare'	=> '!='
		),
		array(
			'key'		=> 'orden_compra_estatus',
			'value'		=> 'estatus_ventaCancelada',
			'compare'	=> '!='
		)
	)
);
$loopOrden = new WP_Query( $argsOrden );
if ( $loopOrden->have_posts() ) {
	$infoOrden	= '';
    while ( $loopOrden->have_posts() ) : $loopOrden->the_post(); 
    	$custom_fields  = get_post_custom();
		$post_id        = get_the_ID();
		//$post_slug		=$post->post_name;
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

    	$ordenCompra ++;
    	if ($origen === 'Apartada de stock de tienda') {
    		$ordenCompraApartada ++;
    		$origen = 'Tienda';
    	} else {
    		$ordenCompraFabrica ++;
    		$origen = 'Fábrica';
    	}

    	$today = date("Y-m-d");
    	if ($today >= $fecha ) {
    		$fechaNew = '<span class="color-red">' . $fechaNew . '</span>';
    	}		

	    $infoOrden  .= '<div class="row margin-bottom-xsmall infoOrden ' . $estatus . '">';
		    $infoOrden  .= '<div class="col s12 m1 uppercase">
		    		<i class="instruction icon-work enFabrica"><span>En fábrica</span></i>
					<i class="instruction icon-house enTienda"><span>En tienda</span></i>
					<i class="instruction icon-truck enCamino"><span>En camino</span></i>
					<i class="instruction icon-location enPuntoEntrega"><span>En punto de entrega</span></i>
					<i class="instruction icon-happy entregada"><span>Entregada y pagada</span></i>
					<i class="instruction icon-money efectivo"><span>Efectivo en camino</span></i>
					<i class="instruction icon-archive ventaCerrada"><span>Venta cerrada</span></i>
					<i class="instruction icon-trash ventaCancelada"><span>Venta cancelada</span></i>
					</div>';
		    $infoOrden  .= '<div class="col s12 m2"><span class="line-text-overflow inline-block">' . $cliente . '</span></div>';
		    $infoOrden  .= '<div class="col s12 m4">' . $fechaNew . ' | ' . $lugar . '</div>';
		    $infoOrden  .= '<div class="col s12 m2">$' . $pago . '.00</div>';
		    $infoOrden  .= '<div class="col s12 m2">' . $origen . '</div>';
		    $infoOrden  .= '<div class="col s12 m1"><a href="' . $permalink . '" target="_blank"><i class="icon-eye"></i></a></div>';
	    $infoOrden  .= '</div>';

    endwhile;
} 
wp_reset_postdata();
if ($ordenCompra != 0 ) {  ?>

	<div id="product_<?php echo $product_slug; ?>" class="modal modal-detalles-orden">
		<div class="modal-content">
			<i class="icon-cancel modal-close"></i>
			<p class="color-primary no-margin-top text-center">Ordenes de <?php echo $productName; ?></p>
			<div class="row no-margin-bottom hide-on-small-only">
				<div class="col s12 m1 uppercase">
					<i class="instruction status-money"><span>En fábrica</span></i>
					<i class="instruction status-house hide"><span>En tienda</span></i>
					<i class="instruction status-truck hide"><span>En camino</span></i>
					<i class="instruction status-money hide"><span>En punto de entrega</span></i>
					<i class="instruction status-entregada hide"><span>Entregada y pagada</span></i>
					<i class="instruction status-money hide"><span>Efectivo en camino</span></i>
					<i class="instruction status-archive hide"><span>Venta cerrada</span></i>
				</div>
				<div class="col s12 m2 uppercase">Cliente</div>
				<div class="col s12 m4 uppercase">Entrega</div>
				<div class="col s12 m2 uppercase">A pagar</div>
				<div class="col s12 m2 uppercase">Origen</div>
			</div>
			<?php echo $infoOrden; ?>
		</div>
	</div>

<?php } ?>