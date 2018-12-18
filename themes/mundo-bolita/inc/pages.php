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

});