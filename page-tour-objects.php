<?php
/**
 * Template name: Гастроли (Объекты)
 */
get_header(); 
?>
<section class="main-section">	
	<ul class="media-header text-left news-header">					
		<li>
			<div class="dropdown">
				<a data-toggle="dropdown" href="#">Гастроли <b class="caret"></b>
				<ul>
					<li><a href="/repertuar">Репертуар</a></li>
				</ul>
			</div>			
		</li>	
		<li><a href="/tour" class="icon-list-disabled"></a></li>
		<li><a href="#" class="icon-object"></a></li>	
		<?php
		$active_year = isset($_GET['y']) ? intval($_GET['y']) : date('Y');
		$first       = true;
		for ($i=0; $i < 7; $i++) 
		{ 
			$y = intval(date('Y'));
			if($first)
			{
				$first       = false;
				$first_class = 'first-year'; 
			}
			else
			{
				$first_class = 'year';
			}
			?>
			<li class="<?php echo $first_class; ?> <?php echo active($active_year == ($y-$i)); ?>"><a href="?y=<?php echo ($y-$i); ?>"><?php echo ($y-$i); ?></a></li>
			<?php
		}
		?>
	</ul>	
	<div class="row tour-objects">
	<?php 
	$items = $GLOBALS['gctour']->getItems(8, false, $active_year);
	
	if($items)
	{
		foreach ($items as $key => $value) 
		{
			$default_image = '<img src="http://placehold.it/280x200/0092c3/fff" alt="'.$value->post_title.'">';
			$img = (has_post_thumbnail($value->ID)) ? '<a href="'.get_permalink($value->ID).'">'.get_the_post_thumbnail($value->ID, 'tour-image').'</a>' : $default_image;
			?>
			<div class="col-md-3 col-lg-3 item">
				<a href="<?php echo get_permalink($value->ID); ?>"><?php echo $img; ?></a>				
				<span><?php echo $GLOBALS['gctour']->getRusMonth(date('m', strtotime($value->post_date))); ?>: <?php echo $GLOBALS['gcevents']->get_short_string(200, strip_tags($value->post_content)); ?></span>
			</div>
			<?php	
		}		
	}
	?>		
	</div>
	
<?php
get_footer();