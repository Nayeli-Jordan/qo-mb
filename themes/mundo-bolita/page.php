<?php get_header(); ?>

	<section class="[ container ] relative z-index-1">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<h3 class="text-center color-primary uppercase"><?php the_title(); ?></h3>
			<div class="margin-top-bottom-large">
				<?php the_content(); ?>
			</div>	
		<?php endwhile; ?>
		<?php endif; ?>
		    
		<div class="clearfix"></div>
	    <div class="shadow-products"></div>
	</section>

<?php get_footer(); ?>