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
	wp_enqueue_script( 'materialize_js', JSPATH.'bin/materialize.js', array('jquery'), '1.0', true );
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

/* Send mail by SMTP */
add_action( 'phpmailer_init', 'send_smtp_email' );
function send_smtp_email( $phpmailer ) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = SMTP_HOST;
    $phpmailer->SMTPAuth   = SMTP_AUTH;
    $phpmailer->Port       = SMTP_PORT;
    $phpmailer->SMTPSecure = SMTP_SECURE;
    $phpmailer->Username   = SMTP_USERNAME;
    $phpmailer->Password   = SMTP_PASSWORD;
    $phpmailer->From       = SMTP_FROM;
    $phpmailer->FromName   = SMTP_FROMNAME;

    $phpmailer->SMTPKeepAlive = true;
    $phpmailer->AddEmbeddedImage('logo-light.png', 'logo-header', 'logo-light.png');
}

/* $message wp_mail in html (not text/plain) */
function transforme_content_type(){
    return "text/html";
}
add_filter( 'wp_mail_content_type','transforme_content_type' );


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
    $estatus        = esc_html( get_post_meta( $orden_compra->ID, 'orden_compra_estatus', true ) );
    $origen         = esc_html( get_post_meta( $orden_compra->ID, 'orden_compra_origen', true ) );

    $fechaSolicitud     = esc_html( get_post_meta( $orden_compra->ID, 'orden_compra_fechaSolicitud', true ) );
    $entregaSolicitud   = esc_html( get_post_meta( $orden_compra->ID, 'orden_compra_entregaSolicitud', true ) );
    $persSolicitud      = esc_html( get_post_meta( $orden_compra->ID, 'orden_compra_persSolicitud', true ) );
    $estatusSolicitud      = esc_html( get_post_meta( $orden_compra->ID, 'orden_compra_estatusSolicitud', true ) );
    $notasSolicitud     = esc_html( get_post_meta( $orden_compra->ID, 'orden_compra_notasSolicitud', true ) );
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
                <label for="orden_compra_horarioEnd">A:</label>
                <input type="text" name="orden_compra_horarioEnd" id="orden_compra_horarioEnd" value="<?php echo $horarioEnd; ?>" placeholder="6 pm">
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
            <th colspan="2">
                <label for="orden_compra_origen">Origen de la piñata*:</label>
                <select name="orden_compra_origen" id="orden_compra_origen" required>
                    <option value="" <?php selected($origen, ''); ?>></option>
                    <option value="Apartada de stock de tienda" <?php selected($origen, 'Apartada de stock de tienda'); ?>>Apartada de stock de tienda</option>
                    <option value="Pedido de fábrica" <?php selected($origen, 'Pedido de fábrica'); ?>>Pedido de fábrica</option>
                </select>
            </th>
            <th colspan="2">
                <label for="orden_compra_estatus">Estatus orden de compra*:</label>
                <select name="orden_compra_estatus" id="orden_compra_estatus" required>
                    <option value="" <?php selected($estatus, ''); ?>></option>
                    <option value="estatus_enFabrica" <?php selected($estatus, 'estatus_enFabrica'); ?>>En fábrica</option>
                    <option value="estatus_enTienda" <?php selected($estatus, 'estatus_enTienda'); ?>>En tienda</option>
                    <option value="estatus_enCamino" <?php selected($estatus, 'estatus_enCamino'); ?>>En camino</option>
                    <option value="estatus_enPuntoEntrega" <?php selected($estatus, 'estatus_enPuntoEntrega'); ?>>En punto de entrega</option>
                    <option value="estatus_entregada" <?php selected($estatus, 'estatus_entregada'); ?>>Entregada y pagada</option>
                    <option value="estatus_efectivo" <?php selected($estatus, 'estatus_efectivo'); ?>>Efectivo en camino</option>
                    <option value="estatus_ventaCerrada" <?php selected($estatus, 'estatus_ventaCerrada'); ?>>Venta cerrada</option>
                    <option value="estatus_ventaCancelada" <?php selected($estatus, 'estatus_ventaCancelada'); ?>>Venta cancelada</option>
                </select>
            </th>
        </tr>
    </table>
    <table class="mb-custom-fields margin-top">
        <tr><td colspan="4"><strong>SI ES PEDIDO A FÁBRICA</strong></td></tr>
        <tr>
            <td colspan="2">
                <label for="orden_compra_fechaSolicitud">Fecha en la que se solicitó*:</label>
                <input type="date" name="orden_compra_fechaSolicitud" id="orden_compra_fechaSolicitud"  value="<?php echo $fechaSolicitud; ?>">
            </td>
            <td colspan="2">
                <label for="orden_compra_entregaSolicitud">Fecha de entrega acordada*:</label>
                <input type="date" min="<?php echo $today; ?>" name="orden_compra_entregaSolicitud" id="orden_compra_entregaSolicitud" value="<?php echo $entregaSolicitud; ?>">
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <label for="orden_compra_persSolicitud">¿Quién solicito?:</label>
                <input type="text" name="orden_compra_persSolicitud" id="orden_compra_persSolicitud" value="<?php echo $persSolicitud; ?>">
            </td>
            <td>
                <label for="orden_compra_estatusSolicitud">Estatus orden de compra*:</label>
                <select name="orden_compra_estatusSolicitud" id="orden_compra_estatusSolicitud" required>
                    <option value="" <?php selected($estatus, ''); ?>></option>
                    <option value="estatus_entregada" <?php selected($estatus, 'estatus_entregada'); ?>>Ya se entregó</option>
                    <option value="estatus_enEspera" <?php selected($estatus, 'estatus_enEspera'); ?>>Esperando entrega</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <label for="orden_compra_notasSolicitud">Notas pedido:</label>
                <textarea name="orden_compra_notasSolicitud" id="orden_compra_notasSolicitud" rows="3"><?php echo $notasSolicitud; ?></textarea>
            </td>
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
        if ( isset( $_POST['orden_compra_estatus'] ) ){
            update_post_meta( $idorden_compra, 'orden_compra_estatus', $_POST['orden_compra_estatus'] );
        }
        if ( isset( $_POST['orden_compra_origen'] ) ){
            update_post_meta( $idorden_compra, 'orden_compra_origen', $_POST['orden_compra_origen'] );
        }
        if ( isset( $_POST['orden_compra_fechaSolicitud'] ) ){
            update_post_meta( $idorden_compra, 'orden_compra_fechaSolicitud', $_POST['orden_compra_fechaSolicitud'] );
        }
        if ( isset( $_POST['orden_compra_entregaSolicitud'] ) ){
            update_post_meta( $idorden_compra, 'orden_compra_entregaSolicitud', $_POST['orden_compra_entregaSolicitud'] );
        }
        if ( isset( $_POST['orden_compra_persSolicitud'] ) ){
            update_post_meta( $idorden_compra, 'orden_compra_persSolicitud', $_POST['orden_compra_persSolicitud'] );
        }
        if ( isset( $_POST['orden_compra_estatusSolicitud'] ) ){
            update_post_meta( $idorden_compra, 'orden_compra_estatusSolicitud', $_POST['orden_compra_estatusSolicitud'] );
        }
        if ( isset( $_POST['orden_compra_notasSolicitud'] ) ){
            update_post_meta( $idorden_compra, 'orden_compra_notasSolicitud', $_POST['orden_compra_notasSolicitud'] );
        }
    }
}

/* Contabilizar ordenes*/
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

/* Redirección Nueva orden */
add_action ('template_redirect', 'redirect_ordenCompra');
function redirect_ordenCompra() {
    if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['send_submitOrden'] ) ) {
        wp_redirect('mb-stock/#orden_creada');
    }
}

/* Redirección Orden Actualizada */
add_action ('template_redirect', 'redirect_ordenCompraActualizada');
function redirect_ordenCompraActualizada() {
    if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['send_submitOrdenActualizada'] ) ) {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        wp_redirect($actual_link . '#orden_actualizada');
    }
}

/* Redirección Orden Actualizada */
add_action ('template_redirect', 'redirect_ordenPedidoFabrica');
function redirect_ordenPedidoFabrica() {
    if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['send_submitPedido'] ) ) {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        wp_redirect($actual_link . '#orden_pedidoFabrica');
    }
}

/*
** Columnas Orden compra
*/
add_filter( 'manage_orden_compra_posts_columns', 'set_custom_edit_orden_compra_columns' );
function set_custom_edit_orden_compra_columns($columns) {
    $columns['ae_entrega'] = __( 'Entrega', 'aempleo' );
    $columns['ae_estatus'] = __( 'Estatus', 'aempleo' );
    $columns['ae_pedido'] = __( 'Pedido a fábrica', 'aempleo' );
    $columns['ae_cliente'] = __( 'Cliente', 'aempleo' );

    return $columns;
}

add_action( 'manage_orden_compra_posts_custom_column' , 'custom_orden_compra_column', 10, 2 );
function custom_orden_compra_column( $column, $post_id ) {
    switch ( $column ) {
        case 'ae_entrega' :
            $fecha  = get_post_meta( $post_id, 'orden_compra_fecha', true );
            $lugar      = get_post_meta( $post_id, 'orden_compra_lugar', true );
            if ($fecha != "") {
                $fecha          = date('d/m/Y', strtotime($fecha));
            }
            if ($lugar === 'Otro') { 
                $lugar      = get_post_meta( $post_id, 'orden_compra_lugarPers', true ); 
            }
            if( $fecha != "" || $lugar != "")
                echo $fecha . '<br>' . $lugar;
            else
                echo "-";
            break;
        case 'ae_estatus' :
            $origen  = get_post_meta( $post_id, 'orden_compra_origen', true );
            $estatus  = get_post_meta( $post_id, 'orden_compra_estatus', true );
            if ($origen === 'Apartada de stock de tienda') {
                $origen = 'Tienda';
            } else {
                $origen = 'Fabrica';
            } 
            if ($estatus === 'estatus_enFabrica'):
                $labelEstatus = 'En fábrica';
            elseif ($estatus === 'estatus_enTienda'):
                $labelEstatus = 'En tienda';
            elseif ($estatus === 'estatus_enCamino'):
                $labelEstatus = 'En camino';
            elseif ($estatus === 'estatus_enPuntoEntrega'):
                $labelEstatus = 'En punto de entrega';
            elseif ($estatus === 'estatus_entregada'):
                $labelEstatus = 'Entregada y pagada';
            elseif ($estatus === 'estatus_efectivo'):
                $labelEstatus = 'Efectivo en camino';
            elseif ($estatus === 'estatus_ventaCerrada'):
                $labelEstatus = '<span style="color: #aaaaaa;">Venta cerrada</span>';
            elseif ($estatus === 'estatus_ventaCancelada'):
                $labelEstatus = 'Venta cancelada';
            endif;
            if( $origen != "" || $estatus != "" )
                echo $origen . '<br>' . $labelEstatus;
            else
                echo "-";
            break;
        case 'ae_pedido' :
            $fechaSolicitud    = get_post_meta( $post_id, 'orden_compra_fechaSolicitud', true );
            $entregaSolicitud  = get_post_meta( $post_id, 'orden_compra_entregaSolicitud', true );
            if ($fechaSolicitud != "" && $entregaSolicitud != "") {
                $fechaSolicitud    = date('d/m/Y', strtotime($fechaSolicitud));
                $entregaSolicitud  = date('d/m/Y', strtotime($entregaSolicitud));
            }
            if( $fechaSolicitud != "" && $entregaSolicitud != "" )
                echo 'Solicitud: ' . $fechaSolicitud . '<br>Entrega: ' . $entregaSolicitud;
            else
                echo "-";
            break;
        case 'ae_cliente' :
            $cliente    = get_post_meta( $post_id, 'orden_compra_cliente', true );
            $pago       = get_post_meta( $post_id, 'orden_compra_pago', true );
            if( $cliente != "" || $pago != "" )
                echo $cliente . '<br>$' . $pago;
            else
                echo "-";
            break;
    }
}