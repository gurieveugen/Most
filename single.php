<?php
get_header(); 
the_post();
?>
<section class="main-section">	
	<ul class="media-header text-left news-header">			
		<li class="arrow-back"><a href="/news"></a></li>		
		<li><a href="/news">Новости</a></li>		
	</ul>	
	<div class="page-wrap">
		
		<?php
		if(has_post_thumbnail())
		{			
			?>
			<div class="row news">
				<div class="col-md-3 col-lg-3"><?php the_post_thumbnail('widget-image'); ?></div>
				<div class="col-md-9 col-lg-9">
					<h3><?php the_title(); ?></h3>
					<span class="date"><?php the_date('d.m.Y'); ?></span>
					<?php the_content(); ?>
				</div>
			</div>
			<?php
		}
		else
		{
			the_content();
		}
		?>
	</div>
<?php
get_footer();