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
		<?php include (TEMPLATEPATH . '/template/sistema/infoOrdenHead.php'); ?>
	</div>

<?php } ?>