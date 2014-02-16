<?php
get_header(); 
the_post();
$meta = get_post_meta($post->ID, 'gcevents', true);		
if($meta['cost'] == "") $cost = "";
else if(intval($meta['cost']) == 0) $cost = "Свободный вход!";
else $cost = $meta['cost'].' '.$meta['currency_symbol'].'  <a class="btn-ticket" href="'.$meta['website'].'"><i class="fa-rub fa-2x"></i><span>Купить билеты</span></a>';
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
					<?php the_post_thumbnail('ticket-image'); ?>
					<span class="cost"><?php echo $cost; ?></span>
				</div>
				<div class="col-md-9 col-lg-9"><?php the_content(); ?></div>
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