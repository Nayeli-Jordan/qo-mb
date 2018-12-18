<?php 
$argsOrden = array(
    'post_type' => 'orden_compra',
    'posts_per_page' => -1,
	'meta_query'	=> array(
		array(
			'key'		=> 'orden_compra_modelo',
			'value'		=> $productName,
			'compare'	=> '='
		)
	)
);
$loopOrden = new WP_Query( $argsOrden );
if ( $loopOrden->have_posts() ) {
	$infoOrden	= '';
    while ( $loopOrden->have_posts() ) : $loopOrden->the_post(); 
    	$custom_fields  = get_post_custom();
		$post_id        = get_the_ID();
	    $cliente       	= get_post_meta( $post_id, 'orden_compra_cliente', true );
	    $lugar       	= get_post_meta( $post_id, 'orden_compra_lugar', true );
		$pago       	= get_post_meta( $post_id, 'orden_compra_pago', true );
		$estatus       	= get_post_meta( $post_id, 'orden_compra_estatus', true );
		$origen       	= get_post_meta( $post_id, 'orden_compra_origen', true );
	    $fecha       	= get_post_meta( $post_id, 'orden_compra_fecha', true );
	    $fecha 			= date('d/m/Y', strtotime($fecha));

	    $permalink 		= get_permalink();

		if ($lugar === 'Otro') { 
			$lugar 		= get_post_meta( $post_id, 'orden_compra_lugarPers', true ); 
		}

	    $infoOrden  .= '<div class="row margin-bottom-xsmall">';
		    $infoOrden  .= '<div class="col s12 m1 uppercase"><i class="instruction icon-money"><span>En fabrica</span></i></div>';
		    $infoOrden  .= '<div class="col s12 m3">' . $cliente . '</div>';
		    $infoOrden  .= '<div class="col s12 m4">' . $fecha . ' | ' . $lugar . '</div>';
		    $infoOrden  .= '<div class="col s12 m3">$' . $pago . '.00</div>';
		    $infoOrden  .= '<div class="col s12 m1"><a href="' . $permalink . '" target="_blank"><i class="icon-eye"></i></a></div>';
	    $infoOrden  .= '</div>';

    	$ordenCompra ++;
    endwhile;
} 
wp_reset_postdata();
if ($ordenCompra === 0 ) { 
	$ordenCompra = '-'; 
} else {
	$ordenCompraNumber 	= $ordenCompra;
	$ordenCompra 			= '<a href="#product_' . $post_id .'" class="modal-trigger block underline-hover">' . $ordenCompra . '</a>';  ?>

	<div id="product_<?php echo $post_id; ?>" class="modal modal-sistema">
		<div class="modal-content">
			<i class="icon-cancel modal-close"></i>
			<p class="color-primary no-margin-top text-center">Ordenes de <?php echo $productName; ?></p>
			<div class="row no-margin-bottom hide-on-small-only">
				<div class="col s12 m1 uppercase">
					<i class="instruction status-money"><span>En fábrica</span></i>
					<i class="instruction status-house hide"><span>En tienda</span></i>
					<i class="instruction status-truck hide"><span>En camino a punto de entrega</span></i>
					<i class="instruction status-money hide"><span>En punto de entrega</span></i>
					<i class="instruction status-money hide"><span>Pagada, efectivo en camino</span></i>
					<i class="instruction status-archive hide"><span>Venta cerrada</span></i>
				</div>
				<div class="col s12 m3 uppercase">Cliente</div>
				<div class="col s12 m4 uppercase">Entrega</div>
				<div class="col s12 m3 uppercase">A pagar</div>
			</div>
			<?php echo $infoOrden; ?>
		</div>
	</div>

<?php } ?>