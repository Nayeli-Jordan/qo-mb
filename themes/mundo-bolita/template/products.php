<?php 
	#DATE
	$now = time(); // or your date as well
	$your_date = strtotime($post->post_date);
	$datediff = $now - $your_date;
	$days = floor($datediff/(60*60*24));
?>

<div class="col-product text-center">
	<a href="<?php the_permalink(); ?>" title="Detalles de la piñata <?php the_title(); ?>">
		<span class="hide">Detalles Piñata <?php the_title(); ?></span>
		<div class="bg-light-opacity"></div>
		<?php if ($days <= 30){ ?>
			<p class="bg-image bg-contain bg-new" style="background-image: url(<?php echo THEMEPATH; ?>images/nuevo.png);"><p>
		<?php } ?>
		<div class="bg-image bg-contain bg-product [ wow tada ]" data-wow-duration="2s" style="background-image: url(<?php the_post_thumbnail_url('medium'); ?>);"></div>							
	</a>
	<a href="<?php the_permalink(); ?>">
		<h4 class="title-product waves-effect waves-light"><span class="hide">Piñata </span><?php the_title(); ?></h4>
	</a>
</div>	