<?php
/**
 * Template name: Репертуар (Объекты)
 */
get_header(); 

?>
<section class="main-section">	
	<ul class="media-header text-left news-header">					
		<li><a href="/repertuar-objects">Репертуар</a></li>	
		<li><a href="/repertuar" class="icon-list-disabled"></a></li>
		<li><a href="#" class="icon-object"></a></li>	
	</ul>	
	
		<?php 
		$args = array(
			'posts_per_page'   => 100,
			'offset'           => 0,			
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'post_type'        => 'spectacle',
			'post_status'      => 'publish',
			'suppress_filters' => true );

		query_posts($args);
		if(have_posts())
		{
			?>
			<div class="row repertuar-objects">
			<?php
			while(have_posts())
			{
				the_post();
				$default_image = '<img src="http://placehold.it/300x300/0092c3/fff" alt="'.get_the_title().'">';
				$img = (has_post_thumbnail()) ? '<a href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_ID(), 'repertuar-image').'</a>' : $default_image;
				?>
				<div class="col-md-3 col-lg-3 item">
					<?php echo $img; ?>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<span><?php echo $GLOBALS['gcevents']->get_short_string(200, strip_tags(get_the_content())); ?></span>
				</div>
				<?php
			}
			?>
			</div>
			<?php
		}
		?>		
	
<?php
get_footer();