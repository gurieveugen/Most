<?php 
get_header(); 
$gcevents = $GLOBALS['gcevents'];
$gctruppa = $GLOBALS['gctruppa'];
$upcoming_first_row  = $gcevents->gcevent_post->getUpcomingEvents(2);
$upcoming_second_row = $gcevents->gcevent_post->getUpcomingEvents(5, 2);

?>
	<section class="main-section">
		<?php 
		// =========================================================
		// Print first row
		// =========================================================
		echo '<div class="row row-firts tickets">';
		foreach ($upcoming_first_row as $key => $value) 
		{
			
			$img_src   = get_bloginfo('template_url').'/images/nophoto.jpg';
			if(has_post_thumbnail($key))
			{
				$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($key), 'row-first-image');
				$img_src = $img_src[0];
			}

			$date_time  = strtotime($value->meta['start_date']); 
			$day        = date('d', $date_time);
			$month      = $gcevents->getRusMonth(date('F', $date_time));
			$year       = date('Y', $date_time);

			?>
			<div class="col-md-6 col-lg-6">
				<img src="<?php echo $img_src; ?>" alt="<?php echo $value->post_title; ?>" class="img-responsive">
				<div class="additional-info">
					<div class="row">
						<div class="col-md-8 col-lg-8">
							<span class="title"><?php echo $value->post_title; ?></span>						
							<span class="date"><?php echo $day.' '.$month.' '.$year; ?>  // <?php echo sprintf('%02d', $value->meta['start_hour']).':'.sprintf('%02d', $value->meta['start_minute']); ?></span>
						</div>
						<div class="col-md-4 col-lg-4">
							<a href="<?php echo get_permalink($key); ?>" class="btn-ticket"><i class="fa-rub fa-2x"></i><span><?php echo $gcevents->l('buy_tickets'); ?></span></a>
						</div>
					</div>
				</div><!-- end additional-info -->
			</div>
			<?php	
		}
		echo '</div>';

		// =========================================================
		// Print second row
		// =========================================================
		echo '<div class="row row-second tickets">';
		foreach ($upcoming_second_row as $key => $value) 
		{
			
			$img_src   = get_bloginfo('template_url').'/images/nophoto.jpg';
			if(has_post_thumbnail($key))
			{
				$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($key), 'row-second-image');
				$img_src = $img_src[0];
			}

			$date_time  = strtotime($value->meta['start_date']); 
			$day        = date('d', $date_time);
			$month      = $gcevents->getRusMonth(date('F', $date_time));
			$year       = date('Y', $date_time);

			?>
			<div class="col-md-4 col-lg-4">
				<img src="<?php echo $img_src; ?>" alt="<?php echo $value->post_title; ?>" class="img-responsive">
				<div class="additional-info">
					<div class="row">
						<div class="col-md-8 col-lg-8">
							<span class="title"><?php echo $value->post_title; ?></span>
							<span class="date"><?php echo $day.' '.$month.' '.$year; ?> // <?php echo sprintf('%02d', $value->meta['start_hour']).':'.sprintf('%02d', $value->meta['start_minute']); ?></span>
						</div>
						<div class="col-md-4 col-lg-4">
							<a href="<?php echo get_permalink($key); ?>" class="btn-ticket"><i class="fa-rub fa-2x"></i><i class="fa-ticket fa-2x" style="background: transparent"></i></a>
						</div>
					</div>
				</div><!-- end additional-info -->
			</div>
			<?php
		}
		echo '</div>';	
		?>
		
		<div class="row blocks">
			<?php dynamic_sidebar('row-first'); ?>			
		</div> <!-- end blocks -->
		
<?php get_footer(); ?>