<?php 

/**
* Define paths to javascript, styles, theme and site.
**/
define( 'JSPATH', get_stylesheet_directory_uri() . '/js/' );
define( 'THEMEPATH', get_stylesheet_directory_uri() . '/' );
define( 'SITEURL', get_site_url() . '/' );


/*------------------------------------*\
	#SNIPPETS
\*------------------------------------*/
require_once( 'inc/pages.php' );
require_once( 'inc/post-types.php' );
require_once( 'inc/taxonomies.php' );

/*------------------------------------*\
	#GENERAL FUNCTIONS
\*------------------------------------*/

/**
* Enqueue frontend scripts and styles
**/
add_action( 'wp_enqueue_scripts', function(){
 
	wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.2.1.min.js', array(''), '2.1.1', true );	
    wp_enqueue_script( 'mb_parsley', JSPATH.'parsley.min.js', array(), '1.0', true );
	wp_enqueue_script( 'materialize_js', JSPATH.'bin/materialize.min.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'wow_js', JSPATH.'wow.min.js', array(), '', true );
	wp_enqueue_script( 'mb_functions', JSPATH.'functions.js', array('materialize_js'), '1.0', true );
 
	wp_localize_script( 'mb_functions', 'siteUrl', SITEURL );
	wp_localize_script( 'mb_functions', 'theme_path', THEMEPATH );
	
	// $is_home = is_front_page() ? "1" : "0";
	// wp_localize_script( 'mb_functions', 'isHome', $is_home );
 
});

/**
* Configuraciones WP
*/

// Agregar css y js al administrador
function load_custom_files_wp_admin() {
    wp_register_style( 'ae_wp_admin_css', THEMEPATH . '/admin/admin-style.css', false, '1.0.0' );
    wp_enqueue_style( 'ae_wp_admin_css' ); 
}
add_action( 'admin_enqueue_scripts', 'load_custom_files_wp_admin' );

//Habilitar thumbnail en post
add_theme_support( 'post-thumbnails' ); 

//Habilitar menú (aparece en personalizar)
add_action('after_setup_theme', 'add_top_menu');
function add_top_menu(){
	register_nav_menu('top_menu',__('Top menu'));
}

//Favicon en admin_print_scripts
add_action('admin_head', 'show_favicon');
function show_favicon() {
echo '<link href="' . THEMEPATH . '/favicon-mb/favicon-32x32.png" rel="icon" type="image/x-icon">';
}

/**
* Optimización
*/

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );


/**
* SEO y Analitics
**/

//Código Analitics
function add_google_analytics() {
    echo '<script src="https://www.google-analytics.com/ga.js" type="text/javascript"></script>';
    echo '<script type="text/javascript">';
    echo 'var pageTracker = _gat._getTracker("UA-122571030-1");';
    echo 'pageTracker._trackPageview();';
    echo '</script>';
}
add_action('wp_footer', 'add_google_analytics');

/* Aplaza el análisis de JavaScript para una carga más rápida */
if(!is_admin()) {
    // Move all JS from header to footer
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);
}


/**
* SUPPORT WOOCOMMERCE
*/
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

/**
* CUSTOM FUNCTIONS
*/

/*
** Orden de compra
*/
add_action( 'add_meta_boxes', 'orden_compra_custom_metabox' );
function orden_compra_custom_metabox(){
    add_meta_box( 'orden_compra_meta', 'Información orden', 'display_orden_compra_atributos', 'orden_compra', 'advanced', 'default');
}

function display_orden_compra_atributos( $orden_compra ){
    $fecha       	= esc_html( get_post_meta( $orden_compra->ID, 'orden_compra_fecha', true ) );
    $horario       	= esc_html( get_post_meta( $orden_compra->ID, 'orden_compra_horario', true ) );
    $horarioEnd    	= esc_html( get_post_meta( $orden_compra->ID, 'orden_compra_horarioEnd', true ) );
    $lugar       	= esc_html( get_post_meta( $orden_compra->ID, 'orden_compra_lugar', true ) );
    $lugarPers    	= esc_html( get_post_meta( $orden_compra->ID, 'orden_compra_lugarPers', true ) );
    $modelo       	= esc_html( get_post_meta( $orden_compra->ID, 'orden_compra_modelo', true ) );
    $cliente       	= esc_html( get_post_meta( $orden_compra->ID, 'orden_compra_cliente', true ) );
    $pago       	= esc_html( get_post_meta( $orden_compra->ID, 'orden_compra_pago', true ) );
    $community      = esc_html( get_post_meta( $orden_compra->ID, 'orden_compra_community', true ) );
    $origen         = esc_html( get_post_meta( $orden_compra->ID, 'orden_compra_origen', true ) );
?>
    <table class="mb-custom-fields">
        <tr>
            <th colspan="2" style="width: 50%">
                <label for="orden_compra_fecha">Fecha de entrega*:</label>
                <input type="date" name="orden_compra_fecha" id="orden_compra_fecha" value="<?php echo $fecha; ?>" required>
            </th>
            <th>
                <label for="orden_compra_horario">Horario de*:</label>
                <input type="text" name="orden_compra_horario" id="orden_compra_horario" value="<?php echo $horario; ?>" placeholder="9 am" required>
            </th>
            <th>
                <label for="orden_compra_horarioEnd">A*:</label>
                <input type="text" name="orden_compra_horarioEnd" id="orden_compra_horarioEnd" value="<?php echo $horarioEnd; ?>" placeholder="6 pm" required>
            </th>
        </tr>
        <tr>
        	<th colspan="2">
                <label for="orden_compra_lugar">Lugar de entrega*:</label>
                <select name="orden_compra_lugar" id="orden_compra_lugar" required>
                    <option value="" <?php selected($lugar, ''); ?>></option>
                    <option value="Cuautitlán Izcalli" <?php selected($lugar, 'Cuautitlán Izcalli'); ?>>Cuautitlán Izcalli</option>
                    <option value="Col. del Valle" <?php selected($lugar, 'Col. del Valle'); ?>>Col. de. Valle</option>
                    <option value="Otro" <?php selected($lugar, 'Otro'); ?>>Otro</option>
                </select>
            </th>
            <th colspan="2">
                <label for="orden_compra_lugarPers">Si es otro:</label>
                <input type="text" name="orden_compra_lugarPers" id="orden_compra_lugarPers" value="<?php echo $lugarPers; ?>">
            </th>
        </tr>
        <tr>
            <th colspan="2">
                <label for="orden_compra_modelo">Modelo*:</label>
                <select name="orden_compra_modelo" id="orden_compra_modelo" required>
                    <option value="" <?php selected($modelo, ''); ?>></option>
           			<?php
				        $args = array(
				            'post_type' => 'product',
				            'posts_per_page' => -1
				            );
				        $loop = new WP_Query( $args );
				        $i = 1;
				        if ( $loop->have_posts() ) {
				            while ( $loop->have_posts() ) : $loop->the_post();	            	 
				            	$post_id        = get_the_ID();
                           		$productName 	= get_the_title( $post_id );?>
								<option value="<?php echo $productName; ?>" <?php selected($modelo, $productName); ?>><?php echo $productName; ?></option>
				            <?php $i ++; endwhile;
				        } 
				        wp_reset_postdata();
				    ?>
                </select>
            </th>
            <th colspan="2">
                <label for="orden_compra_cliente">Cliente*:</label>
                <input type="text" name="orden_compra_cliente" id="orden_compra_cliente" value="<?php echo $cliente; ?>" required>
            </th>
        </tr>
        <tr>
            <th colspan="2">
                <label for="orden_compra_pago">Cantidad a pagar*:</label>
                <input type="number" name="orden_compra_pago" id="orden_compra_pago" value="<?php echo $pago; ?>" placeholder="460" required>
            </th>
            <th colspan="2">
                <label for="orden_compra_community">Community Manager*:</label>
                <input type="text" name="orden_compra_community" id="orden_compra_community" value="<?php echo $community; ?>" required>
            </th>
        </tr>
        <tr>
            <th colspan="4">
                <label for="orden_compra_origen">Origen de la piñata*:</label>
                <select name="orden_compra_origen" id="orden_compra_origen" required>
                    <option value="Stock de tienda">Stock de tienda</option>
                    <option value="Pedido a fabrica">Pedido a fabrica</option>
                </select>
            </th>
        </tr>
    </table>
<?php }

add_action( 'save_post', 'orden_compra_save_metas', 10, 2 );
function orden_compra_save_metas( $idorden_compra, $orden_compra ){
    if ( $orden_compra->post_type == 'orden_compra' ){
        if ( isset( $_POST['orden_compra_fecha'] ) ){
            update_post_meta( $idorden_compra, 'orden_compra_fecha', $_POST['orden_compra_fecha'] );
        }
        if ( isset( $_POST['orden_compra_horario'] ) ){
            update_post_meta( $idorden_compra, 'orden_compra_horario', $_POST['orden_compra_horario'] );
        }
        if ( isset( $_POST['orden_compra_horarioEnd'] ) ){
            update_post_meta( $idorden_compra, 'orden_compra_horarioEnd', $_POST['orden_compra_horarioEnd'] );
        }
        if ( isset( $_POST['orden_compra_lugar'] ) ){
            update_post_meta( $idorden_compra, 'orden_compra_lugar', $_POST['orden_compra_lugar'] );
        }
        if ( isset( $_POST['orden_compra_lugarPers'] ) ){
            update_post_meta( $idorden_compra, 'orden_compra_lugarPers', $_POST['orden_compra_lugarPers'] );
        }
        if ( isset( $_POST['orden_compra_modelo'] ) ){
            update_post_meta( $idorden_compra, 'orden_compra_modelo', $_POST['orden_compra_modelo'] );
        }
        if ( isset( $_POST['orden_compra_cliente'] ) ){
            update_post_meta( $idorden_compra, 'orden_compra_cliente', $_POST['orden_compra_cliente'] );
        }
        if ( isset( $_POST['orden_compra_pago'] ) ){
            update_post_meta( $idorden_compra, 'orden_compra_pago', $_POST['orden_compra_pago'] );
        }
        if ( isset( $_POST['orden_compra_community'] ) ){
            update_post_meta( $idorden_compra, 'orden_compra_community', $_POST['orden_compra_community'] );
        }
        if ( isset( $_POST['orden_compra_origen'] ) ){
            update_post_meta( $idorden_compra, 'orden_compra_origen', $_POST['orden_compra_origen'] );
        }
    }
}

/* Contabilizar apartados*/
function post_number_orden($postID){
    $getOrderedPostsOrden= new WP_Query('post_type=orden_compra&orderby=date&order=ASC&posts_per_page=-1');
    $count = 1;
    if($getOrderedPostsOrden->have_posts()) {
        while ($getOrderedPostsOrden->have_posts()) {
            $getOrderedPostsOrden->the_post();
            if ($postID != get_the_ID()){
                $count++;
            } else {
                $postNumberOrden= $count;
            }
        }
    }
    wp_reset_query();
    if ($postNumberOrden < 10) {
        $postNumberOrden = '00' . $postNumberOrden;
    } elseif ($postNumberOrden < 100) {
        $postNumberOrden = '0' . $postNumberOrden;
    }
    return $postNumberOrden;
}

/* Redirección Nuevo apartado */
/*add_action ('template_redirect', 'custom_redirect_apartado');
function custom_redirect_apartado() {
    if ( isset($_POST['submitApartado']) ) {
        wp_redirect(site_url('mb-stock/#apartado_creado'));
    }
}*/