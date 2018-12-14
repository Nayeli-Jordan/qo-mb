<?php get_header(); ?>

	<section class="padding-top-xlarge">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<h3 class="text-center color-primary uppercase title-box-info-products"><?php the_title(); ?></h3>
			<div class="box-info-products">
				<div class="container-info-products">
					<div class="container">
						<table>
							<tr>
								<th><strong>Piñata</strong></th>
								<th><strong>$ Tienda</strong></th>
								<th><strong>$ FB</strong></th>
								<th><strong>Stock</strong></th>
								<th><strong>Apartadas</strong></th>
								<th><strong>Fabrica</strong></th>
							</tr>
							<?php
						        $args = array(
						            'post_type' => 'product',
						            'posts_per_page' => -1
						        );
						        $loop = new WP_Query( $args );
						        if ( $loop->have_posts() ) {
						        	global $product;						        	
						            while ( $loop->have_posts() ) : $loop->the_post();	
										$apartados = 0; /* Inicia apartados en 0 por cada producto */

										/* Obtener info del producto y guardarla en variables */
						            	$post_id        = get_the_ID();
										$product 		= wc_get_product( $post_id );
										$productName 	= get_the_title( $post_id );
										$price 			= $product->get_regular_price();
										if ($price != '') {
											$priceFb	= $price + 100;
										} else {
											$price 		= '-';
											$priceFb	= '-';
										}
										$stock			= $product->get_stock_quantity();


										/* Obtener número de apartados por el nombre del producto */
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
								            while ( $loopOrden->have_posts() ) : $loopOrden->the_post(); 
								            	$apartados ++;
								            endwhile;
								        } 
								        wp_reset_postdata();
								        if ($apartados === 0 ) { 
								        	$apartados = '-'; 
								        } else {
								        	$apartados = '<a href="' . SITEURL .'">' . $apartados . '</a>';
								        } ?>

										
										<tr>
											<td><?php echo $productName ?></td>
											<td><?php echo $price; ?></td>
											<td><?php echo $priceFb; ?></td>
											<td><?php echo $stock ?></td>
											<td><?php echo $apartados; ?></td>
											<td></td>
											<td></td>
										</tr>
						            <?php endwhile;
						        } 
						        wp_reset_postdata();
						    ?>
						</table>
					</div>
				</div>		
			</div>
		<?php endwhile; ?>
		<?php endif; ?>
	</section>

<?php get_footer(); ?>