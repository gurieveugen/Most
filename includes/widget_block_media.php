<?php
/**
 * Register new widget
 */
add_action('widgets_init', create_function('', 'register_widget( "BlockMedia" );'));

class BlockMedia extends WP_Widget {
	//                __  _                 
	//   ____  ____  / /_(_)___  ____  _____
	//  / __ \/ __ \/ __/ / __ \/ __ \/ ___/
	// / /_/ / /_/ / /_/ / /_/ / / / (__  ) 
	// \____/ .___/\__/_/\____/_/ /_/____/  
	//     /_/                              
	private $gcevents;
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct() 
	{
		$widget_ops     = array('classname' => 'block-media', 'description' => 'Виджет отображает мультимедиа элементы' );
		$this->gcevents = $GLOBALS['gcevents'];
		parent::__construct('media', 'Мультимедиа', $widget_ops);
	}

	function widget( $args, $instance ) 
	{
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );		

		echo $before_widget;
		if ($title) echo $before_title.$title.$after_title;	
		// =========================================================
		// Print media block
		// =========================================================
		$args  = array(
			'posts_per_page'   => -1,
			'offset'           => 0,			
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'post_type'        => 'multimedia',
			'post_status'      => 'publish');
		$media = get_posts($args);			
		$count = 3;
		$i     = 0;
		if($media)
		{
			foreach ($media as $key => $value) 
			{	
				if(has_post_thumbnail($value->ID))
				{
					$img_src        = wp_get_attachment_image_src(get_post_thumbnail_id($value->ID), 'media-image');
					$img_src        = $img_src[0];
					$value->img_src = $img_src;
					$arr[]          = $value;
					if($i <= $count-1) $i++;
					else break;
				}
			}					
			if($arr && count($arr) > 2)
			{
				?>
				<section>
					<div class="row media-first">
						<div class="col-md-12 col-lg-12">
							<a href="<?php echo get_permalink($arr[0]->ID); ?>" class="media"><img src="<?php echo $arr[0]->img_src; ?>" alt="" class="img-responsive"></a>	
						</div>
					</div>
					<div class="row media-second">
						<div class="col-md-6 col-lg-6 col-sm-6">
							<a href="<?php echo get_permalink($arr[1]->ID); ?>" class="media"><img src="<?php echo $arr[1]->img_src; ?>" alt="" class="img-responsive"></a>
						</div>
						<div class="col-md-6 col-lg-6 col-sm-6">
							<a href="<?php echo get_permalink($arr[2]->ID); ?>" class="media"><img src="<?php echo $arr[2]->img_src; ?>" alt="" class="img-responsive"></a>
						</div>
					</div>
				</section>		
				<?php
			}
			else
			{
				echo 'Не достаточно медиа элементов!';
			}
		}
		echo $after_widget;
	}

	function form($instance) 
	{		
		$title = $instance['title'];		
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>		
		<?php
	}

	function update( $new_instance, $old_instance ) 
	{
		$instance          = $old_instance;		
		$instance['title'] = strip_tags($new_instance['title']);		
		return $instance;
	}

}