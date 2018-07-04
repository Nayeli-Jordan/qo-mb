<?php 
global $post;
$post_slug = $post->post_name;

get_header(); 
?>

	<section class="[ container ] relative z-index-1">
		<h3 class="text-center color-primary uppercase"><?php the_title(); ?></h3>
		<div class="margin-top-bottom-large">
			<?php the_content(); ?>
		</div>	    
		<div class="clearfix"></div>
	    <div class="shadow-products"></div>
	</section>

<?php get_footer(); ?>