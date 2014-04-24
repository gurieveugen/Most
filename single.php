<?php
get_header(); 
the_post();
?>
<section class="main-section">	
	<ul class="media-header text-left news-header">			
		<li class="arrow-back" onclick="window.open('/news', '_self');"><a href="/news"></a></li>		
		<li><a href="/news">Новости</a></li>		
	</ul>	
	<div class="page-wrap">
		
		<?php
		if(has_post_thumbnail())
		{			
			?>
			<div class="row news">
				<div class="col-md-3 col-lg-3 img-100p"><?php the_post_thumbnail('widget-image'); ?></div>
				<div class="col-md-9 col-lg-9">
					<h3><?php the_title(); ?></h3>
					<span class="date"><?php the_date('d.m.Y'); ?></span>
					<?php the_content(); ?>
					<!-- AddThis Button BEGIN -->
					<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
					<a class="addthis_button_facebook"></a>
					<a class="addthis_button_vk"></a>
					<a class="addthis_button_twitter"></a>
					</div>
					<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
					<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5316dc2271b78736"></script>
					<!-- AddThis Button END -->
				</div>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="row news">				
				<div class="col-md-12 col-lg-12">
					<h3><?php the_title(); ?></h3>
					<span class="date"><?php the_date('d.m.Y'); ?></span>
					<?php the_content(); ?>
					<!-- AddThis Button BEGIN -->
					<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
					<a class="addthis_button_facebook"></a>
					<a class="addthis_button_vk"></a>
					<a class="addthis_button_twitter"></a>
					</div>
					<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
					<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5316dc2271b78736"></script>
					<!-- AddThis Button END -->
				</div>
			</div>
			<?php
		}
		?>
	</div>
	<div class="row gallery mt50">
		<?php 
		$images = getAllImagesFromPost(get_the_ID()); 
		if($images)
		{

			foreach ($images as $key => $value) 
			{
				?>
				<div class="col-md-3 col-lg-3"><a class="fancybox" rel="group" href="<?php echo $value['full']; ?>"><img src="<?php echo $value['small']; ?>" alt="" /></a></div>
				<?php
			}
		}
		?>
	</div>
<?php
get_footer();