<!DOCTYPE html>
<!-- Importante agregar el prefijo para cuando dice que og no se está usando -->
<html prefix="og: http://ogp.me/ns#">
	<head>
		<meta charset="utf-8">
		<title><?php bloginfo('name'); ?></title>
		<!-- Sets initial viewport load and disables zooming -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- SEO -->
		<meta name="keywords" content="">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<!-- Meta robots -->
		<meta name="robots" content="index, follow" />
		<meta name="googlebot" content="index, follow" />

		<!-- Favicon -->
		<link rel="icon" type="image/png" href="<?php echo THEMEPATH; ?>favicon/favicon-32x32.png" sizes="32x32" />
		<link rel="icon" type="image/png" href="<?php echo THEMEPATH; ?>favicon/favicon-16x16.png" sizes="16x16" />

		<!-- Facebook, Twitter metas -->
		<meta property="og:title" content="<?php bloginfo('name'); ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="<?php echo site_url(); ?>" />
		<meta property="og:image" content="<?php echo THEMEPATH; ?>images/share.png">
		<meta property="og:description" content="<?php bloginfo('description'); ?>" />
		<meta name="twitter:description" content="<?php bloginfo('description'); ?>" />
		<meta name="twitter:image" content="<?php echo THEMEPATH; ?>images/share.png" />
		<meta name="twitter:title" content="<?php bloginfo('name'); ?>" />
		<meta property="og:image:width" content="210" />
		<meta property="og:image:height" content="110" />
		<meta property="fb:app_id" content="" />
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:site" content="@" />

		<!-- Google+ -->
		<link rel="publisher" href="https://plus.google.com/+biscochito">

		<!-- Compatibility -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta http-equiv="cleartype" content="on">

		<!-- Google font(s) -->
		<!-- <link href="https://fonts.googleapis.com/css?family=Rancho|Open+Sans:400" rel="stylesheet"> -->

		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=PT+Sans:700i" rel="stylesheet">

		<!--Styles-->
		<link type="text/css" rel="stylesheet" href="<?php echo THEMEPATH; ?>css/animated.css">
		<link type="text/css" rel="stylesheet" href="<?php echo THEMEPATH; ?>stylesheets/materialize.css" media="screen,projection" />


		<!-- Canonical URL -->
		<link rel="canonical" href="<?php echo site_url(); ?>" />

		<!-- Sitemap Google Verify -->
		<!--  https://www.google.com/webmasters/verification/home?hl=en&authuser=0 -->
		<meta name="google-site-verification" content="" />

		<!-- Noscript -->
		<noscript>Tu navegador no soporta JavaScript!</noscript>
		<?php wp_head(); ?>
	</head>
	<body>
		<div class="bg-image relative" style="background-image: url(<?php echo THEMEPATH; ?>images/fondo.png)">
			<header class="js-header relative">		
				<h1 class="hide"><?php bloginfo('name'); ?></h1>
				<div class="bg-image bg-contain [ absolute left-15p bottom-30 ] width-20p padding-bottom-20p  rotate-90" style="background-image: url(<?php echo THEMEPATH; ?>images/boli-central.png);"></div>
				<div class="bg-image bg-contain [ absolute right-10p bottom--50 ] width-20p padding-bottom-20p  rotate-180" style="background-image: url(<?php echo THEMEPATH; ?>images/boli-central.png);"></div>
				<div class="bg-image bg-contain relative top-0 z-index-1 width-100p padding-bottom-49p" style="background-image: url(<?php echo THEMEPATH; ?>images/nube-blanca-large.png);"></div>
				<div class="bg-image bg-contain absolute top-0 width-100p padding-bottom-54p" style="background-image: url(<?php echo THEMEPATH; ?>images/nubes-azules.png);"></div>
				<div class="bg-image bg-contain absolute bottom--10p right--20 width-30p padding-bottom-30p" style="background-image: url(<?php echo THEMEPATH; ?>images/nube-blanca-small.png);"></div>
				<div class="absolute width-100p top-20p menu-content z-index-1">
					<div class="container">
						<div class="row">
							<div class="col s12 m3">
								<div class="nav-left">
									<a target="_blank" href="https://www.facebook.com/pg/MundoBolitaIzcalli/shop/?ref=page_internal">
										<div class="bg-image bg-contain bg-icon margin-right-xsmall" style="background-image: url(<?php echo THEMEPATH; ?>images/icons-header/facebook1.png);"></div>								
									</a>
									<a target="_blank" href="https://www.instagram.com/mundobolitaizcalli/">
										<div class="bg-image bg-contain bg-icon margin-right-xsmall" style="background-image: url(<?php echo THEMEPATH; ?>images/icons-header/instagram1.png);"></div>								
									</a>
									<a href="tel:+5558689360">
										<div class="bg-image bg-contain bg-icon margin-right-xsmall" style="background-image: url(<?php echo THEMEPATH; ?>images/icons-header/telefono1.png);"></div>								
									</a>	
									<a href="mailto:mundo.bolita@altoempleo.com.mx">
										<div class="bg-image bg-contain bg-icon" style="background-image: url(<?php echo THEMEPATH; ?>images/icons-header/correo1.png);"></div>							
									</a>
								</div>
								<div class="nav-right">
									<a href="<?php echo SITEURL ?>" class="hide-on-med-and-up">
										<div class="bg-image bg-contain bg-icon" style="background-image: url(<?php echo THEMEPATH; ?>images/icons-header/home1.png);"></div>
									</a>
									<a href="" class="hide-on-med-and-up">
										<div class="bg-image bg-contain bg-icon margin-left-xsmall" style="background-image: url(<?php echo THEMEPATH; ?>images/icons-header/otros1.png);"></div>
									</a>
									<a href="" class="hide-on-med-and-up">
										<div class="bg-image bg-contain bg-icon margin-left-xsmall" style="background-image: url(<?php echo THEMEPATH; ?>images/icons-header/pinata1.png);"></div>
									</a>									
								</div>
							</div>
							<div class="col s12 m6 text-center">
								<a href="<?php echo SITEURL ?>">	
									<div class="bg-image bg-contain bg-logo" style="background-image: url(<?php echo THEMEPATH; ?>images/identidad/logo.png);"></div>
								</a>									
							</div>
							<div class="col s4 m3 text-right hide-on-small-only">
								<a href="<?php echo SITEURL ?>">
									<div class="bg-image bg-contain bg-icon" style="background-image: url(<?php echo THEMEPATH; ?>images/icons-header/home1.png);"></div>
								</a>
								<a href="">
									<div class="bg-image bg-contain bg-icon margin-left-xsmall" style="background-image: url(<?php echo THEMEPATH; ?>images/icons-header/otros1.png);"></div>
								</a>
								<a href="">
									<div class="bg-image bg-contain bg-icon margin-left-xsmall" style="background-image: url(<?php echo THEMEPATH; ?>images/icons-header/pinata1.png);"></div>
								</a>							
							</div>					
						</div>					
					</div>
				</div>	
			</header>
			<div class="[ main-body ]">
				<div class="bg-image bg-contain bg-repeat relative" style="background-image: url(<?php echo THEMEPATH; ?>images/dulces-fondo.png)">
					<div class="bg-image bg-contain bg-repeat bg-absolute top--15p left-5p" style="background-image: url(<?php echo THEMEPATH; ?>images/lineas.png);"></div>
					<div class="bg-image bg-contain [ absolute top--60 left-50p ] margin-left--15p width-30p padding-bottom-30p rotate-180" style="background-image: url(<?php echo THEMEPATH; ?>images/boli-central.png);"></div>
					<section class="container text-center relative margin-bottom-50">
						
						<h2 class="uppercase color-primary">Catálogo</h2>
						<div class="row relative">
							<div class="col s12 m8 offset-m2 relative">
								<?php echo do_shortcode( '[aws_search_form]' ); ?>
								<div class="shadow-buscador"></div>
								<div class="content-icon-buscador">
									<div class="bg-image bg-contain bg-icon-buscador" style="background-image: url(<?php echo THEMEPATH; ?>images/lupa.png);"></div>
								</div>							
							</div>
						</div>					
						<ul class="mb-nav">
							<?php
								$menu_name = 'top_menu';

								if (( $locations = get_nav_menu_locations()) && isset( $locations[ $menu_name ])) {
									$menu = wp_get_nav_menu_object( $locations[ $menu_name ]);
									$menu_items = wp_get_nav_menu_items( $menu->term_id );
									$menu_list = '';
									foreach ( (array) $menu_items as $key => $menu_item) {
										$id 		= $menu_item->attr_title;
										$title 		= $menu_item->title;
										$url 		= $menu_item->url;
										$menu_list .='<li><a id="' . $id . '" href="' . $url . '" class="">' . $title . '</a></li>';
									}
								}
								echo $menu_list;
							?>						
						</ul>						
					</section>
					<div class="clearfix"></div>