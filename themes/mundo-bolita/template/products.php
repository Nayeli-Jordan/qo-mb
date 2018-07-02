<?php 
	#DATE
	$now = time(); // or your date as well
	$your_date = strtotime($post->post_date);
	$datediff = $now - $your_date;
	$days = floor($datediff/(60*60*24));
?>

<div class="col-product text-center">
	<!-- <a href="<?php the_permalink(); ?>"> -->
		<div class="bg-ligh-opacity"></div>
		<?php if ($days <= 20){ ?>
			<p class="bg-image bg-contain bg-new" style="background-image: url(<?php echo THEMEPATH; ?>images/nuevo.png);"><p>
		<?php } ?>
		<div class="bg-image bg-contain bg-product" style="background-image: url(<?php the_post_thumbnail_url('medium'); ?>);"></div>							
	<!-- </a> -->
	<!-- <a href="<?php the_permalink(); ?>"> -->
		<h4 class="title-product"><?php the_title(); ?></h4>
	<!-- </a> -->
</div>	