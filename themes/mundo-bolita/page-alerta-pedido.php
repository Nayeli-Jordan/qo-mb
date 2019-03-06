<?php get_header(); 

	/* Email Header */
    $subject 		 	 = "Pedido a fábrica Mundo Bolita";

	$messageHeader 	 	 = '<html style="font-family: Arial, sans-serif;"><body>';
	$messageHeader 		.= '<div style="text-align: center; margin-bottom: 20px;"><a style="color: #000; text-align: center; display: block;" href="' . SITEURL . '"><img style="display: inline-block; margin: auto;" src="http://mundobolita.com/wp-content/themes/mundo-bolita/images/identidad/logo-correo.png" alt="Logo Mundo Bolita"></a></div>';
	$messageHeader 		.= '<p style="margin-bottom: 20px;">Esta es una alerta para recordarte que programaste para <span style="color: #008fcc;">el día de mañana</span> la entrega de la siguiente piñata desde fábrica: </p>';

	$messageFooter		 = '<div style="text-align: center; margin-bottom: 10px;"><p><small>Este email ha sido enviado desde el sistema de alertas de pedidos de Mundo Bolita. </small></p></div>';
	$messageFooter		.= '</body></html>';
?>
	<section class="[ container ] relative z-index-1">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<h3 class="text-center color-primary uppercase"><?php the_title(); ?></h3>
			<div class="margin-top-bottom-large">
			<?php 
				$argsOrden = array(
				    'post_type' => 'orden_compra',
				    'posts_per_page' => -1,
					'meta_query'	=> array( 		
						'relation'		=> 'AND',
						array(		/* Mostrar ordenes de fábrica */
							'key'		=> 'orden_compra_origen',
							'value'		=> 'Pedido de fábrica',
							'compare'	=> '='
						),
						array(		/* Que aún no se hayan entregado */
							'key'		=> 'orden_compra_estatusSolicitud',
							'value'		=> 'estatus_enEspera',
							'compare'	=> '='
						)
					)
				);
				$loopOrden = new WP_Query( $argsOrden );
				if ( $loopOrden->have_posts() ) {
					$today 					= date("Y-m-d");
					$ordenPedidoFabrica 	= 0;
					$body					= '';
				    while ( $loopOrden->have_posts() ) : $loopOrden->the_post(); 
				    	$custom_fields  	= get_post_custom();
						$post_id        	= get_the_ID();
						$modelo       		= get_post_meta( $post_id, 'orden_compra_modelo', true );
						$fechaSolicitud		= get_post_meta( $post_id, 'orden_compra_fechaSolicitud', true );
						$entregaSolicitud	= get_post_meta( $post_id, 'orden_compra_entregaSolicitud', true );
						$persSolicitud		= get_post_meta( $post_id, 'orden_compra_persSolicitud', true );
						$notasSolicitud		= get_post_meta( $post_id, 'orden_compra_notasSolicitud', true );

					    $fechaAlerta   	= date('Y-m-d', strtotime($entregaSolicitud . '-1 day')); /* Active alert 1 day before */
					    
					    setlocale(LC_ALL,"es_ES");
						$fechaSolicitud 	= strftime("%d de %B del %Y", strtotime($fechaSolicitud));
						$entregaSolicitud 	= strftime("%d de %B del %Y", strtotime($entregaSolicitud));

						$permalink 		= get_permalink();

					    if ($today === $fechaAlerta) {
					    	$body		.= '<div style="margin-bottom: 30px;"><p><strong style="color: #de0d88;">Modelo: </strong>' . $modelo . '</p>';
					    	$body		.= '<p><strong style="color: #de0d88;">Fecha en la que se solicitó: </strong>' . $fechaSolicitud . '</p>';
					    	$body		.= '<p><strong style="color: #de0d88;">Fecha de entrega acordada: </strong>' . $entregaSolicitud . '</p>';
					    	$body		.= '<p><strong style="color: #de0d88;">¿Quién solicito?: </strong>' . $persSolicitud . '</p>';
					    	$body		.= '<p><strong style="color: #de0d88;">Notas pedido: </strong>' . $notasSolicitud . '</p>';
					    	$body		.= '<p><a href="' . $permalink . '" style="color: #008fcc;">Ver Orden de pago</a></p></div>';

				    		$ordenPedidoFabrica ++;
					    }
				    endwhile;
					if ($ordenPedidoFabrica != 0):
						$to 		= 'pruebas@altoempleo.com.mx'; /*to do - cambiar mail*/
				    	$message 	= $messageHeader . $body . $messageFooter;
						echo $message;

					    wp_mail($to, $subject, $message);
					endif;
				} 
				wp_reset_postdata(); ?>
			</div>

		<?php endwhile; endif; ?>		    
		<div class="clearfix"></div>
		<div class="text-center"><a href="<?php echo SITEURL; ?>mb-stock" class="btn">Ver stock</a></div>
	</section>
<?php get_footer(); ?>