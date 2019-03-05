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
			'key'		=> 'orden_compra_estatusVenta',
			'value'		=> 'estatus_cancelada',
			'compare'	=> '='
		)
	)
);
$loopOrdenCancelada = new WP_Query( $argsOrdenCancelada );
if ( $loopOrdenCancelada->have_posts() ) {
	$infoOrden	= '';
    while ( $loopOrdenCancelada->have_posts() ) : $loopOrdenCancelada->the_post(); 

    	$ordenCompraCancelada ++;
    	include (TEMPLATEPATH . '/template/sistema/infoOrden.php'); 

    endwhile;
} 
wp_reset_postdata();
if ($ordenCompraCancelada != 0 ) {  ?>

	<div id="product_<?php echo $product_slug; ?>_canceladas" class="modal modal-detalles-orden">
		<?php include (TEMPLATEPATH . '/template/sistema/infoOrdenHead.php'); ?>
	</div>

<?php } ?>