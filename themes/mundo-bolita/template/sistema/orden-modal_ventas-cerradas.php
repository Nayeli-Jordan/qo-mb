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
			'key'		=> 'orden_compra_estatusVenta',
			'value'		=> 'estatus_cerrada',
			'compare'	=> '='
		),
		array(
			'key'		=> 'orden_compra_metodoPago',
			'value'		=> 'Prestamo',
			'compare'	=> '!='
		)
	)
);
$loopOrdenCerrada = new WP_Query( $argsOrdenCerrada );
if ( $loopOrdenCerrada->have_posts() ) {
	$infoOrden	= '';
    while ( $loopOrdenCerrada->have_posts() ) : $loopOrdenCerrada->the_post(); 

    	$ordenCompraCerrada ++;
    	include (TEMPLATEPATH . '/template/sistema/infoOrden.php'); 

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
			<?php echo $infoOrden; ?>
		</div>
	</div>

<?php } ?>