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
	$infoApartado	= '';
    while ( $loopOrden->have_posts() ) : $loopOrden->the_post(); 
    	$custom_fields  = get_post_custom();
		$post_id        = get_the_ID();
	    $cliente       	= get_post_meta( $post_id, 'orden_compra_cliente', true );
	    $origen       	= get_post_meta( $post_id, 'orden_compra_origen', true );
	    $fecha       	= get_post_meta( $post_id, 'orden_compra_fecha', true );
	    $fecha 			= date('d/m/Y', strtotime($fecha));

	    $permalink 		= get_permalink();

	    $infoApartado  .= '<div class="row margin-bottom-xsmall"><div class="col s12 m4">' . $cliente . '</div><div class="col s12 m3">' . $fecha . '</div><div class="col s12 m3">' . $origen . '</div><div class="col s12 m2"><a href="' . $permalink . '" target="_blank"><i class="icon-eye"></i></a></div></div>';
    	$apartados ++;
    endwhile;
} 
wp_reset_postdata();
if ($apartados === 0 ) { 
	$apartados = '-'; 
} else {
	$apartados = '<a href="#product_' . $post_id .'" class="modal-trigger">' . $apartados . '</a>';  ?>

	<div id="product_<?php echo $post_id; ?>" class="modal modal-sistema">
		<div class="modal-content">
			<i class="icon-cancel modal-close"></i>
			<p class="color-primary no-margin-top text-center">Apartados <?php echo $productName; ?></p>
			<div class="row no-margin-bottom hide-on-small-only">
				<div class="col s12 m4 uppercase">Cliente</div>
				<div class="col s12 m3 uppercase">Entrega</div>
				<div class="col s12 m3 uppercase">Origen</div>
			</div>
			<?php echo $infoApartado; ?>
		</div>
	</div>

<?php } ?>