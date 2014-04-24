<?php
get_header(); 
the_post();

$img = (has_post_thumbnail()) ? get_the_post_thumbnail(get_the_ID(), 'ticket-image') : '<img src="http://placehold.it/280x400/0092c3/fff" alt="'.get_the_title().'">';
?>
<section class="main-section">
	<div class="page-wrap">
		<h1><?php the_title(); ?></h1>
		<div class="row ticket">
			<div class="col-md-3 col-lg-3 img-100p">
				<?php echo $img; ?>
			</div>
			<div class="col-md-9 col-lg-9"><?php the_content(); ?></div>
		</div>		
	</div>
<?php
get_footer();