<?php 
	get_header();
	global $post;

	
	while ( have_posts() ) : the_post(); 
?>
	<section class="[ container ] relative z-index-1">
		<h3 class="text-center color-primary uppercase"><?php the_title(); ?></h3>
		<div class="margin-top-bottom-large">
			<?php the_content(); ?>
		</div>	

		<div class="clearfix"></div>
	    <div class="shadow-products"></div>
	</section>
	<div class="clearfix"></div>
<?php 
	endwhile; // end of the loop.
	get_footer(); 
?>
