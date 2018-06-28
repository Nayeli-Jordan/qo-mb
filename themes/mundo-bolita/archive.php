<?php 
global $post;
$post_slug = $post->post_name;

get_header(); 

?>
	<section class="[ container ]">
		<p><?php echo $post_slug; ?></p>
	</section>
<?php get_footer(); ?>