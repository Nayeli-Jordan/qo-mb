<?php


// TAXONOMIES ////////////////////////////////////////////////////////////////////////
add_action( 'init', 'custom_taxonomies_callback', 0 );
function custom_taxonomies_callback(){

	
	if( ! taxonomy_exists('ancho')){

		$labels = array(
			'name'              => 'Ancho img %',
			'singular_name'     => 'Ancho img %',
			'search_items'      => 'Buscar',
			'all_items'         => 'Todos',
			'edit_item'         => 'Editar Ancho',
			'update_item'       => 'Actualizar Ancho',
			'add_new_item'      => 'Nueva Ancho',
			'menu_name'         => 'Ancho img %'
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'ancho' ),
		);

		register_taxonomy( 'ancho', 'product', $args );
	}	

}