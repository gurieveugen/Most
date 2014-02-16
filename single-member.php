<?php
get_header(); 
the_post();
?>
<section class="main-section">
	<div class="row">
		<div class="col-md-3 col-lg-3">
			<div class="member-photo">
				<?php if(has_post_thumbnail()) the_post_thumbnail(); ?>
			</div>
		</div>
		<div class="col-md-9 col-lg-9">
			<h2 class="member-text"><?php the_title(); ?></h2>
			<?php
		 	the_content();
		 	?>
		</div>
	</div>
<?php
get_footer();