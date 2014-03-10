<?php
/**
 * Register new widget
 */
add_action('widgets_init', create_function('', 'register_widget( "BlockTruppa" );'));

class BlockTruppa extends WP_Widget {
	//                __  _                 
	//   ____  ____  / /_(_)___  ____  _____
	//  / __ \/ __ \/ __/ / __ \/ __ \/ ___/
	// / /_/ / /_/ / /_/ / /_/ / / / (__  ) 
	// \____/ .___/\__/_/\____/_/ /_/____/  
	//     /_/                              
	private $gctruppa;
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct() 
	{
		$widget_ops     = array('classname' => 'block-truppa', 'description' => 'Виджет отображает туппу театра' );
		$this->gctruppa = $GLOBALS['gctruppa'];
		parent::__construct('truppa', 'Труппа', $widget_ops);
	}

	function widget( $args, $instance ) 
	{
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );		

		echo $before_widget;
		if ($title) echo $before_title.$title.$after_title;	
		// =========================================================
		// Print truppa block
		// =========================================================
		echo '<section>';
		$truppa = $this->gctruppa->getMembers(9, true);
		foreach ($truppa as $key => $value) 
		{
		 	$img_src   = 'http://placehold.it/160x150/0092c3/fff';
 			if(has_post_thumbnail($value->ID))
 			{
 				$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($value->ID), 'member-image');
 				$img_src = $img_src[0];
 			}
 			$short_title = substr($value->post_title, 0, strpos($value->post_title, ' ') + 3).'.';
 			$members[] = '<a href="'.get_permalink($value->ID).'" title="'.$short_title.'"><img src="'.$img_src.'" alt="'.$value->post_title.'"></a>';
		} 			
		echo $this->gctruppa->displayRows($members, 3, 'col-md-4 col-lg-4 col-sm-4 col-xs-4');
		echo '</section>';
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