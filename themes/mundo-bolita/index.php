<?php get_header(); ?>
	<section class="container relative">
		<?php echo do_shortcode( '[products limit="8" columns="4" visibility="featured" ]' ); ?>
		<img class="responsive-img absolute bottom-15p right--10p width-25p z-index--1" src="<?php echo THEMEPATH; ?>images/boli-central.png" alt="Imagen luna">
		<img class="responsive-img absolute bottom-20p left-35p width-25p z-index--1" src="<?php echo THEMEPATH; ?>images/boli-central.png" alt="Imagen luna">
		<img class="responsive-img absolute bottom--10p left-5p width-25p z-index--1" src="<?php echo THEMEPATH; ?>images/boli-central.png" alt="Imagen luna">
	</section>	
<?php get_footer(); ?>