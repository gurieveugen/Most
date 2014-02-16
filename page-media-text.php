<?php
/**
 * Template name: Мультимедиа (текст)
 */
get_header(); 
the_post();

$media['audio'] = $GLOBALS['gcmultimedia']->getMedia(20, false, 'audio');
$media['video'] = $GLOBALS['gcmultimedia']->getMedia(5, false, 'video');
$media['text']  = $GLOBALS['gcmultimedia']->getMedia(20, false, 'text');
?>
<section class="main-section">	
	<div class="row">
		<div class="col-md-6 col-lg-6">
			<ul class="media-header">
				<li><a href="/media">Аудио</a></li>
				<li><span class="separator">//</span></li>
				<li><span>Тексты</span></li>				
			</ul>	
			<ul class="media-content">
				<?php
				foreach ($media['text'] as $key => $value) 
				{
					?>
					<li><a href="<?php echo get_permalink($value->ID);?>"><?php echo $value->post_title; ?></a></li>
					<?php
				}
				?>
			</ul>
		</div>
		<div class="col-md-6 col-lg-6">
			<?php
			foreach ($media['video'] as $key => $value) 
			{

				if(has_post_thumbnail($value->ID))
				{
					echo '<a href="'.get_permalink($value->ID).'">'.get_the_post_thumbnail($value->ID, 'full').'</a>';
				}	
			}
			?>
		</div>
	</div>
<?php
get_footer();