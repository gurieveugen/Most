<?php
get_header(); 
the_post();
$meta = get_post_meta($post->ID, 'gcevents', true);		
if($meta['cost'] == "") $cost = "";
else if(intval($meta['cost']) == 0) $cost = "Свободный вход!";
else $cost = '<strong>'.$meta['cost'].' '.$meta['currency_symbol'].'</strong>  <a class="btn-ticket btn-ticket-modal" href="#" data-id="'.$post->ID.'"><i class="fa-rub fa-2x"></i><span>Купить билеты</span></a>';
//$el = $post;
$el->meta['partners'] = get_post_meta($post->ID, 'gcevent_urls', true);
$el->ID = $post->ID;
echo $GLOBALS['gcevents']->gcevent_post->getModal($el);
echo $GLOBALS['gcevents']->gcevent_post->getBuyThere();

?>
<section class="main-section">
	<div class="page-wrap">
		<?php
		if(has_post_thumbnail())
		{
			echo '<h1 class="page-title">';
			the_title();
			echo '</h1>';
			?>
			<div class="row ticket">
				<div class="col-md-3 col-lg-3">
					<div class="img-100p">
						<?php the_post_thumbnail('ticket-image'); ?>	
					</div>
					<span class="cost"><?php echo $cost; ?></span>
				</div>
				<div class="col-md-9 col-lg-9 text-arial"><?php the_content(); ?></div>
			</div>
			<?php
		}
		else
		{
			the_content();
		}
		?>
	</div>
	<br>
	<div class="row gallery mt50">
		<?php 
		$images = getAllImagesFromPost(get_the_ID()); 
		if($images)
		{

			foreach ($images as $key => $el) 
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