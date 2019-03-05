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
		<div class="modal-content">
			<i class="icon-cancel modal-close"></i>
			<p class="color-primary no-margin-top text-center">Ordenes Canceladas de <?php echo $productName; ?></p>
			<div class="row no-margin-bottom hide-on-small-only">
				<div class="col s12 m3 uppercase">Cliente</div>
				<div class="col s12 m4 uppercase">Entregaría</div>
				<div class="col s12 m2 uppercase">Pagaría</div>
				<div class="col s12 m2 uppercase">Origen</div>
			</div>
			<?php echo $infoOrden; ?>
		</div>
	</div>

<?php } ?>