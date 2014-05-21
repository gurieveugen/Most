<?php
/**
 * Template name: Архив (Список)
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
		<li><a href="#" class="icon-list"></a></li>
		<li><a href="/archive-objects" class="icon-object-disabled"></a></li>	
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
			<ul class="media-repertuar">
			<?php
			while(have_posts())
			{
				the_post();				
				?>
				<li>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<span><?php echo $GLOBALS['gcevents']->get_short_string(200, strip_tags(get_the_content())); ?></span>
				</li>
				<?php
			}
			?>
			</ul><!-- END media-repertuar -->
			<?php
		}
		?>		
	
<?php
get_footer();