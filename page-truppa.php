<?php
/**
 * Template Name: Труппа
 */
get_header(); 
the_post();
?>
<section class="main-section">

<?php
if(has_post_thumbnail())
{
	echo '<h1 class="page-title">';
	the_title();
	echo '</h1>';
	?>
	<div class="row ticket">
		<div class="col-md-3 col-lg-3"><?php the_post_thumbnail('ticket-image'); ?></div>
		<div class="col-md-9 col-lg-9"><?php the_content(); ?></div>
	</div>
	<?php
}
else
{
	the_content();
}
get_footer();