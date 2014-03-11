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
	
		
	
<?php
get_footer();