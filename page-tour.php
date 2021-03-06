<?php
/**
 * Template name: Гастроли (Список)
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
		<li><a href="#" class="icon-list"></a></li>
		<li><a href="/tour-objects" class="icon-object-disabled"></a></li>	
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
	<ul class="media-repertuar">
	<?php 
	$items = $GLOBALS['gctour']->getItems(8, false, $active_year);
	
	if($items)
	{
		foreach ($items as $key => $value) 
		{
			?>
			<li>
				<h3><a href="<?php the_permalink(); ?>"><?php echo $value->post_title; ?></a></h3>
				<span><?php echo $GLOBALS['gcevents']->get_short_string(200, strip_tags($value->post_content)); ?></span>
			</li>
			<?php	
		}		
	}
	?>		
	</ul><!-- END media-repertuar -->
	
<?php
get_footer();