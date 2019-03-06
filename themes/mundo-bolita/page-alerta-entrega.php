<?php get_header(); 

	/* Email Header */
    $subject 		 	 = "Entrega programada Mundo Bolita";

	$messageHeader 	 	 = '<html style="font-family: Arial, sans-serif;"><body>';
	$messageHeader 		.= '<div style="text-align: center; margin-bottom: 20px;"><a style="color: #000; text-align: center; display: block;" href="' . SITEURL . '"><img style="display: inline-block; margin: auto;" src="http://mundobolita.com/wp-content/themes/mundo-bolita/images/identidad/logo-correo.png" alt="Logo Mundo Bolita"></a></div>';
	$messageHeader 		.= '<p style="margin-bottom: 20px;">Esta es una alerta para recordarte que <span style="color: #008fcc;">el día de mañana</span> está programada la entrega de: </p>';

	$messageFooter		 = '<div style="text-align: center; margin-bottom: 10px;"><p><small>Este email ha sido enviado desde el sistema de alertas de entregas de Mundo Bolita. </small></p></div>';
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
				);
				$loopOrden = new WP_Query( $argsOrden );
				if ( $loopOrden->have_posts() ) {
					$today 		= date("Y-m-d");
					$ordenCompraEntrega 	= 0;
					$body		= '';
				    while ( $loopOrden->have_posts() ) : $loopOrden->the_post(); 
				    	$custom_fields  = get_post_custom();
						$post_id        = get_the_ID();
						$origen 		= get_post_meta( $post_id, 'orden_compra_origen', true );
						$cliente 		= get_post_meta( $post_id, 'orden_compra_cliente', true );
						$pago 			= get_post_meta( $post_id, 'orden_compra_pago', true );
						$metodoPago 	= get_post_meta( $post_id, 'orden_compra_metodoPago', true );
						$estatusPago 	= get_post_meta( $post_id, 'orden_compra_estatusPago', true );
						$notaPago 		= get_post_meta( $post_id, 'orden_compra_notaPago', true );
						$fecha 			= get_post_meta( $post_id, 'orden_compra_fecha', true );
						$lugar 			= get_post_meta( $post_id, 'orden_compra_lugar', true );
						$estatusEntrega = get_post_meta( $post_id, 'orden_compra_estatusEntrega', true );
						$entrega 		= get_post_meta( $post_id, 'orden_compra_entrega', true );
						$responsable 	= get_post_meta( $post_id, 'orden_compra_responsable', true );
						$fechaVenta 	= get_post_meta( $post_id, 'orden_compra_fechaVenta', true );
						$estatusVenta 	= get_post_meta( $post_id, 'orden_compra_estatusVenta', true );
						$observaciones 	= get_post_meta( $post_id, 'orden_compra_observaciones', true );

					    $fechaAlerta   	= date('Y-m-d', strtotime($fecha . '-1 day')); /* Activer alerta */
					    
					    setlocale(LC_ALL,"es_ES");
						$fecha 			= strftime("%d de %B del %Y", strtotime($fecha));

						$permalink 		= get_permalink();

					    if ($today === $fechaAlerta) {
							$body 			.= '<div style="margin-bottom: 30px;"><p><strong style="color: #de0d88;">Modelo: </strong>' . $compra_modelo . '</p>';
							$body 			.= '<p><strong style="color: #008fcc;">Origen: </strong>' . $compra_origen . '</p>';
							$body 			.= '<p><strong style="color: #008fcc;">Cliente: </strong>' . $compra_cliente . '</p></div>';
							$body 			.= '<p><strong style="color: #de0d88;">Venta: </strong>' . $compra_responsable . ' | ' . $compra_fechaVentaEsp . ' | ' . $compra_estatusVenta . ' | ' . $compra_observaciones . '</p>';
							$body 			.= '<p><strong style="color: #de0d88;">Pago: </strong>$' . $compra_pago . ' | ' . $compra_metodoPago . ' | ' . $compra_estatusPago . ' | ' . $compra_notaPago . '</p>';
							$body 			.= '<p><strong style="color: #de0d88;">Entrega: </strong>' . $compra_fechaEsp . ' | ' . $compra_lugar . ' | ' . $compra_estatusEntrega . ' | ' . $compra_entrega . '</p>';
							$body 	        .= '<div style="text-align: center; margin-bottom: 10px;"><p><small>Este email ha sido enviado desde el stock de Mundo Bolita. </small></p></div>';

				    		$ordenCompraEntrega ++;
					    }
				    endwhile;
					if ($ordenCompraEntrega != 0):
						$to = 'pruebas@altoempleo.com.mx';
				    	$message = $messageHeader . $body . $messageFooter;
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