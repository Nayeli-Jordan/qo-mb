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
			'key'		=> 'orden_compra_estatusVenta',
			'value'		=> 'estatus_cerrada',
			'compare'	=> '!='
		),
		array(
			'key'		=> 'orden_compra_estatusVenta',
			'value'		=> 'estatus_cancelada',
			'compare'	=> '!='
		)
	)
);
$loopOrden = new WP_Query( $argsOrden );
if ( $loopOrden->have_posts() ) {
	$infoOrden	= '';
    while ( $loopOrden->have_posts() ) : $loopOrden->the_post(); 

		$ordenCompra ++;

    	include (TEMPLATEPATH . '/template/sistema/infoOrden.php');

		if ($origen === 'Tienda') {
			$ordenCompraTienda ++;
		} else {
			$ordenCompraFabrica ++;
		}

    endwhile;
} 
wp_reset_postdata();
if ($ordenCompra != 0 ) {  ?>

	<div id="product_<?php echo $product_slug; ?>" class="modal modal-detalles-orden">
		<div class="modal-content">
			<i class="icon-cancel modal-close"></i>
			<p class="color-primary no-margin-top text-center">Ordenes de <?php echo $productName; ?></p>
			<div class="row no-margin-bottom hide-on-small-only">
				<div class="col s12 m4 uppercase">Venta</div>
				<div class="col s12 m2 uppercase">Pago</div>
				<div class="col s12 m5 uppercase">Entrega</div>
			</div>
			<?php echo $infoOrden; ?>
		</div>
	</div>

<?php } ?>