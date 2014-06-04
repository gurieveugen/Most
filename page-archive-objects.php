<?php
/**
 * Template name: Архив (Объекты)
 */
get_header(); 

?>
<section class="main-section">	
	<ul class="media-header text-left news-header">					
		<li>
			<div class="dropdown">
				<a data-toggle="dropdown" href="#">Архив <b class="caret"></b>
				<ul>
					<li><a href="/afisha-objects">Афиша</a></li>
				</ul>
			</div>			
		</li>	
		<li><a href="/archive-list" class="icon-list-disabled"></a></li>
		<li><a href="#" class="icon-object"></a></li>	
	</ul>	
	
		<?php 
		$args = array(
			'posts_per_page'   => 100,
			'offset'           => 0,			
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'post_type'        => 'archive',
			'post_status'      => 'publish',
			'suppress_filters' => true );

		query_posts($args);
		if(have_posts())
		{
			?>
			<div class="row repertuar-objects">
			<?php
			$items = array();
			while(have_posts())
			{
				the_post();
				$time          = get_post_meta(get_the_ID(), 'archive_time', true);
				$time_str      = $time != '' ? sprintf('<span class="time"> // %s</span>', $time) : '';
				$default_image = '<img src="http://placehold.it/280x395/0092c3/fff" alt="'.get_the_title().'">';
				$img = (has_post_thumbnail()) ? '<a href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_ID(), 'repertuar-image').'</a>' : $default_image;
				ob_start();
				?>
				<div class="col-md-3 col-lg-3 item">
					<?php echo $img; ?>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php echo $time_str; ?></h3>
					<span><?php echo $GLOBALS['gcevents']->get_short_string(200, strip_tags(get_the_content())); ?></span>
				</div>
				<?php
				$var = ob_get_contents();
				array_push($items, $var);
    			ob_end_clean();
			}
			printPerRow($items);
			?>
			</div>
			<?php
		}
		?>		
	
<?php
get_footer();