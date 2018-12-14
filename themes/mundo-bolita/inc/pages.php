<?php


// CUSTOM PAGES //////////////////////////////////////////////////////////////////////

add_action('init', function(){

	// 
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


});