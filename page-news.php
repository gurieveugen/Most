<?php
/**
 * Template name: Новости
 */
get_header(); 
?>
<section class="main-section">	
	<ul class="media-header text-left news-header">					
		<li><a href="/news">Новости</a></li>		
	</ul>	
	<div class="page-wrap">
		<?php 
		$args = array(
			'posts_per_page'   => get_option('posts_per_page'),
			'offset'           => 0,			
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'post_type'        => 'post',
			'post_status'      => 'publish',
			'suppress_filters' => true );

		query_posts($args);
		if(have_posts())
		{
			while(have_posts())
			{
				the_post();
				$img = (has_post_thumbnail()) ? '<a href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_ID(), 'widget-thumb-image').'</a>' : '';
				?>
				<div class="row news news-mini">
					<div class="col-md-3 col-lg-3"><?php echo $img; ?></div>
					<div class="col-md-9 col-lg-9">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<span class="date"><?php echo get_the_date('d.m.Y'); ?></span>
						<?php echo $GLOBALS['gcevents']->get_short_string(200, strip_tags(get_the_content())); ?>
					</div>
				</div>
				<?php
			}
		}
		?>		
	</div>
<?php
get_footer();