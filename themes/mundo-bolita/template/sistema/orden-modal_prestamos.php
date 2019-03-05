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
			'key'		=> 'orden_compra_metodoPago',
			'value'		=> 'Prestamo',
			'compare'	=> '='
		)
	)
);
$loopOrdenPrestamo = new WP_Query( $argsOrdenCerrada );
if ( $loopOrdenPrestamo->have_posts() ) {
	$infoOrden	= '';
    while ( $loopOrdenPrestamo->have_posts() ) : $loopOrdenPrestamo->the_post(); 

    	$ordenPrestamo ++;
    	include (TEMPLATEPATH . '/template/sistema/infoOrden.php'); 

    endwhile;
} 
wp_reset_postdata();
if ($ordenPrestamo != 0 ) {  ?>

	<div id="product_<?php echo $product_slug; ?>_prestamos" class="modal modal-detalles-orden">
		<?php include (TEMPLATEPATH . '/template/sistema/infoOrdenHead.php'); ?>
	</div>

<?php } ?>