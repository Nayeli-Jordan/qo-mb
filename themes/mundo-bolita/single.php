<?php 
	get_header();
	global $post;
	
	while ( have_posts() ) : the_post(); 
?>
	<section class="[ relative ][ bg-image ][ padding-top-bottom-large ]" style="background-image: url(<?php echo THEMEPATH ?>images/bg-initial.png);">

	</section>
<?php 
	endwhile; // end of the loop.
	get_footer(); 
?>
