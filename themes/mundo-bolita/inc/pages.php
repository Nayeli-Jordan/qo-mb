<?php


// CUSTOM PAGES //////////////////////////////////////////////////////////////////////

add_action('init', function(){

	// STOCK MUNDO BOLITA
	if( ! get_page_by_path('mb-stock') ){
		$page = array(
			'post_author' => 1,
			'post_status' => 'publish',
			'post_title'  => 'Stock',
			'post_name'   => 'mb-stock',
			'post_type'   => 'page'
		);
		wp_insert_post( $page, true );
	}
	// Inventario al día
	if( ! get_page_by_path('inventario') ){
		$page = array(
			'post_author' => 1,
			'post_status' => 'publish',
			'post_title'  => 'Inventario',
			'post_name'   => 'inventario',
			'post_type'   => 'page'
		);
		wp_insert_post( $page, true );
	}
	// Reporte semanal
	if( ! get_page_by_path('reporte') ){
		$page = array(
			'post_author' => 1,
			'post_status' => 'publish',
			'post_title'  => 'Reporte Semanal',
			'post_name'   => 'reporte',
			'post_type'   => 'page'
		);
		wp_insert_post( $page, true );
	}

	// Alerta entrega próxima 
	if( ! get_page_by_path('alerta-entrega') ){
		$page = array(
			'post_author' => 1,
			'post_status' => 'publish',
			'post_title'  => 'Alerta entrega',
			'post_name'   => 'alerta-entrega',
			'post_type'   => 'page'
		);
		wp_insert_post( $page, true );
	}

	// Alerta entrega pedido próxima 
	if( ! get_page_by_path('alerta-pedido') ){
		$page = array(
			'post_author' => 1,
			'post_status' => 'publish',
			'post_title'  => 'Alerta pedido',
			'post_name'   => 'alerta-pedido',
			'post_type'   => 'page'
		);
		wp_insert_post( $page, true );
	}

});