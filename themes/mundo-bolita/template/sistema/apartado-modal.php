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
	    $fecha       	= get_post_meta( $post_id, 'orden_compra_fecha', true );
	    setlocale(LC_ALL,"es_ES");
	    $fecha 			= strftime("%d de %B del %Y", strtotime($fecha));

	    $permalink 		= get_permalink();

	    $infoApartado  .= '<div class="row margin-bottom-xsmall"><div class="col s12 m5">' . $cliente . '</div><div class="col s12 m5">' . $fecha . '</div><div class="col s12 m2"><a href="' . $permalink . '" target="_blank">Ver</a></div></div>';
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
			<p class="color-primary no-margin-top text-center">Apartados <?php echo $productName; ?></p>
			<div class="row no-margin-bottom hide-on-small-only">
				<div class="col s12 m5 uppercase">Cliente</div>
				<div class="col s12 m5 uppercase">Entrega</div>
			</div>
			<?php echo $infoApartado; ?>
		</div>
	</div>

<?php } ?>