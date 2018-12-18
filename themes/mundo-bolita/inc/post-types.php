<?php

// CUSTOM POST TYPES /////////////////////////////////////////////////////////////////


add_action('init', function(){

	
	$labels = array(
		'name'          => 'Orden de compra',
		'singular_name' => 'Orden de compra',
		'add_new'       => 'Nueva Orden de compra',
		'add_new_item'  => 'Nueva Orden de compra',
		'edit_item'     => 'Editar Orden de compra',
		'new_item'      => 'Nueva Orden de compra',
		'all_items'     => 'Todo',
		'view_item'     => 'Ver Orden de compra',
		'search_items'  => 'Buscar Orden de compra',
		'not_found'     => 'No hay Orden de compra.',
		'menu_name'     => 'Orden de compra'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'orden_compra' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title' ),
		'menu_icon' 		 => 'dashicons-admin-users'
	);
	register_post_type( 'orden_compra', $args );
	

	$labels = array(
		'name'          => 'Pedido a fabrica',
		'singular_name' => 'Pedido a fabrica',
		'add_new'       => 'Nueva Pedido a fabrica',
		'add_new_item'  => 'Nueva Pedido a fabrica',
		'edit_item'     => 'Editar Pedido a fabrica',
		'new_item'      => 'Nueva Pedido a fabrica',
		'all_items'     => 'Todo',
		'view_item'     => 'Ver Pedido a fabrica',
		'search_items'  => 'Buscar Pedido a fabrica',
		'not_found'     => 'No hay Pedido a fabrica.',
		'menu_name'     => 'Pedido a fabrica'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'pedido_fabrica' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title' ),
		'menu_icon' 		 => 'dashicons-admin-users'
	);
	register_post_type( 'pedido_fabrica', $args );			

});