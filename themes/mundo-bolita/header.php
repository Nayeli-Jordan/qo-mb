<!DOCTYPE html>
<!-- Importante agregar el prefijo para cuando dice que og no se está usando -->
<html lang="es-ES" prefix="og: http://ogp.me/ns#" >
	<head>
		<meta charset="utf-8">
		<title><?php bloginfo('name'); ?></title>
		<!-- Sets initial viewport load and disables zooming -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- SEO -->
		<meta name="keywords" content="Mundo bolita, piñatas creativas, piñatas para fiestas, piñatas temáticas">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<!-- Meta robots -->
		<meta name="robots" content="index, follow" />
		<meta name="googlebot" content="index, follow" />

		<!-- Favicon -->
		<link rel="icon" type="image/png" href="<?php echo THEMEPATH; ?>favicon/favicon-32x32.png" sizes="32x32" />
		<link rel="icon" type="image/png" href="<?php echo THEMEPATH; ?>favicon/favicon-16x16.png" sizes="16x16" />

		<!-- Facebook, Twitter metas -->
		
		<meta property="og:type" content="website" />

		<?php if (is_product()): ?>
			<meta property="og:title" content="<?php the_title(); ?>" />
			<meta property="og:url" content="<?php the_permalink(); ?>" />
			<meta property="og:image" content="<?php the_post_thumbnail_url('large'); ?>">
			<meta property="og:description" content="<?php bloginfo('description'); ?>" />

			<meta name="twitter:description" content="<?php bloginfo('description'); ?>" />
			<meta name="twitter:image" content="<?php the_post_thumbnail_url('large'); ?>" />
			<meta name="twitter:title" content="<?php the_title(); ?>" />		
		<?php else: ?>
			<meta property="og:title" content="<?php bloginfo('name'); ?>" />
			<meta property="og:url" content="<?php echo site_url(); ?>" />
			<meta property="og:image" content="<?php echo THEMEPATH; ?>images/share.png">
			<meta property="og:description" content="<?php bloginfo('description'); ?>" />

			<meta name="twitter:description" content="<?php bloginfo('description'); ?>" />
			<meta name="twitter:image" content="<?php echo THEMEPATH; ?>images/share.png" />
			<meta name="twitter:title" content="<?php bloginfo('name'); ?>" />			
		<?php endif ?>

		<meta property="og:image:width" content="210" />
		<meta property="og:image:height" content="110" />
		<meta property="fb:app_id" content="915324798639301" />
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:site" content="@" />

		<!-- Google+ -->
		<link rel="publisher" href="https://plus.google.com/+mundo-bolita">

		<!-- Compatibility -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta http-equiv="cleartype" content="on">

		<!-- Google font(s) -->
		<!-- <link href="https://fonts.googleapis.com/css?family=Rancho|Open+Sans:400" rel="stylesheet"> -->

		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=PT+Sans:700i" rel="stylesheet">

		<!--Styles-->
		<link type="text/css" rel="stylesheet" href="<?php echo THEMEPATH; ?>css/animated.min.css">
		<link type="text/css" rel="stylesheet" href="<?php echo THEMEPATH; ?>stylesheets/materialize.min.css" media="screen,projection" />


		<!-- Canonical URL -->
		<link rel="canonical" href="<?php echo site_url(); ?>" />

		<!-- Sitemap Google Verify -->
		<meta name="google-site-verification" content="0qnM0EtNZCkc23KATkqf-pYcnopQpaJ6RVAZwPt23Xo" />

		<!-- Noscript -->
		<noscript>Tu navegador no soporta JavaScript!</noscript>
		<?php wp_head(); ?>

		<!-- Facebook Pixel Code -->
		<script>
		  !function(f,b,e,v,n,t,s)
		  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		  n.queue=[];t=b.createElement(e);t.async=!0;
		  t.src=v;s=b.getElementsByTagName(e)[0];
		  s.parentNode.insertBefore(t,s)}(window, document,'script',
		  'https://connect.facebook.net/en_US/fbevents.js');
		  fbq('init', '363408134185229');
		  fbq('track', 'PageView');

		  fbq('track', 'Search');
		  fbq('track', 'ViewContent');
		  fbq('track', 'Lead');

		</script>
		<noscript><img height="1" width="1" style="display:none"
		  src="https://www.facebook.com/tr?id=363408134185229&ev=PageView&noscript=1"
		/></noscript>
		<!-- End Facebook Pixel Code -->

	</head>
	<?php flush(); ?>
	<body>
		<div class="bg-image relative" style="background-image: url(<?php echo THEMEPATH; ?>images/fondo.png)">
			<header class="js-header relative">		
				<h1 class="hide"><?php bloginfo('name'); ?></h1>
				<div class="bg-image bg-contain [ absolute left-15p bottom-30 ] width-20p padding-bottom-20p  rotate-90  [ wow flash ]" data-wow-delay="0.1s"  data-wow-duration="4s" data-wow-iteration="10" style="background-image: url(<?php echo THEMEPATH; ?>images/boli-central.png);"></div>
				<div class="bg-image bg-contain [ absolute right-10p bottom--50 ] width-20p padding-bottom-20p  rotate-180 [ wow flash ]" data-wow-delay="0.3s"   data-wow-duration="4s" data-wow-iteration="10" style="background-image: url(<?php echo THEMEPATH; ?>images/boli-central.png);"></div>
				<div class="bg-image bg-contain relative top-0 z-index-1 width-100p padding-bottom-49p [ wow fadeIn ]" data-wow-delay="0.1s" style="background-image: url(<?php echo THEMEPATH; ?>images/nube-blanca-large.png);"></div>
				<div class="bg-image bg-contain absolute top-0 width-100p padding-bottom-54p  [ wow bounceInDown ]"  data-wow-delay="0.5s" style="background-image: url(<?php echo THEMEPATH; ?>images/nubes-azules.png);"></div>
				<div class="bg-image bg-contain absolute bottom--10p right--20 width-30p padding-bottom-30p z-index-1  [ wow fadeInRight ]" data-wow-delay="0.9s" style="background-image: url(<?php echo THEMEPATH; ?>images/nube-blanca-small.png);"></div>
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
									<a href="" id="link-mail">
										<div class="bg-image bg-contain bg-icon" style="background-image: url(<?php echo THEMEPATH; ?>images/icons-header/correo1.png);"></div>							
									</a>
								</div>
								<div class="nav-right">
									<a href="<?php echo SITEURL ?>" class="hide-on-med-and-up">
										<div class="bg-image bg-contain bg-icon" style="background-image: url(<?php echo THEMEPATH; ?>images/icons-header/home1.png);"></div>
									</a>
									<!--<a href="#" data-target="slide-out" class="sidenav-trigger hide-on-med-and-up">
										<div class="bg-image bg-contain bg-icon margin-left-xsmall" style="background-image: url(<?php echo THEMEPATH; ?>images/icons-header/otros1.png);"></div>
									</a>-->
									<a id="caracteristicas" class="item-scroll hide-on-med-and-up">
										<div class="bg-image bg-contain bg-icon margin-left-xsmall" style="background-image: url(<?php echo THEMEPATH; ?>images/icons-header/pinata1.png);"></div>
									</a>									
								</div>
							</div>
							<div class="col s12 m6 text-center">
								<a href="<?php echo SITEURL ?>">	
									<div class="bg-image bg-contain bg-logo [ wow tada ]" style="background-image: url(<?php echo THEMEPATH; ?>images/identidad/logo.png);"></div>
								</a>									
							</div>
							<div class="col s4 m3 text-right hide-on-small-only">
								<a href="<?php echo SITEURL ?>">
									<div class="bg-image bg-contain bg-icon" style="background-image: url(<?php echo THEMEPATH; ?>images/icons-header/home1.png);"></div>
								</a>
								<!--<a href="#" data-target="slide-out" class="sidenav-trigger">
									<div class="bg-image bg-contain bg-icon margin-left-xsmall" style="background-image: url(<?php echo THEMEPATH; ?>images/icons-header/otros1.png);"></div>
								</a>-->
								<a id="caracteristicas" class="item-scroll">
									<div class="bg-image bg-contain bg-icon margin-left-xsmall" style="background-image: url(<?php echo THEMEPATH; ?>images/icons-header/pinata1.png);"></div>
								</a>							
							</div>					
						</div>					
					</div>
				</div>	
			</header>
			<div class="[ main-body ]">
				<!--<ul id="slide-out" class="sidenav" itemscope>
					<li itemprop="actionOption"><a href="#" class="sidenav-close text-right color-primary">x</a></li>
					<li itemprop="actionOption"><a href="">ejemplo</a></li>
					<li itemprop="actionOption"><a href="">ejemplo</a></li>
					<li itemprop="actionOption"><a href="">ejemplo</a></li>
					<li itemprop="actionOption"><a href="">ejemplo</a></li>
				</ul>-->

				<div class="bg-image bg-contain bg-repeat relative" style="background-image: url(<?php echo THEMEPATH; ?>images/dulces-fondo.png)">
					<div class="bg-image bg-contain bg-repeat bg-absolute top--15p left-5p [ wow fadeIn ]" data-wow-delay="0.5s" data-wow-duration="3s" style="background-image: url(<?php echo THEMEPATH; ?>images/lineas.png);"></div>
					<div class="bg-image bg-contain [ absolute top--60 left-50p ] margin-left--15p width-30p padding-bottom-30p rotate-180  [ wow flash ]"  data-wow-delay="0.5s"   data-wow-duration="2s" data-wow-iteration="20" style="background-image: url(<?php echo THEMEPATH; ?>images/boli-central.png);"></div>
					<section class="container text-center relative z-index-1 margin-bottom-50 [ wow fadeInDown ]" data-wow-duration="1s">
						
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
						<div class="mb-nav" itemscope>
							<?php
								$menu_name = 'top_menu';

								if (( $locations = get_nav_menu_locations()) && isset( $locations[ $menu_name ])) {
									$menu = wp_get_nav_menu_object( $locations[ $menu_name ]);
									$menu_items = wp_get_nav_menu_items( $menu->term_id );
									$menu_list = '';
									foreach ( (array) $menu_items as $key => $menu_item) {

										$url 				= $menu_item->url;
										$title 				= $menu_item->title;
										$class 				= esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $menu_item->classes ), $menu_item) ) );

										//$menu_item_parent	= $menu_item->menu_item_parent;		id del padre
										//$id 				= $menu_item->ID;
										//$attr_title 		= $menu_item->attr_title;
										//$description		= $menu_item->description;
										//$xfn 				= $menu_item->xfn;
										//$type 			= $menu_item->type;		taxonomy, page...
										//$type_label		= $menu_item->type_label;		página, categoría...

										$menu_list .='<a href="' . $url . ' " itemprop="actionOption" class="' . $class .'">' . $title . '</a>';
									}
								}
								echo $menu_list;
							?>						
						</div>						
					</section>
					<div class="clearfix"></div>