<?php
/**
 * Register new widget
 */
add_action('widgets_init', create_function('', 'register_widget( "BlockSocial" );'));

class BlockSocial extends WP_Widget {
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
		$widget_ops     = array('classname' => 'block-social', 'description' => 'Виджет отображает кнопки социальных сетей' );
		parent::__construct('social', 'Социальные сети', $widget_ops);
	}

	function widget( $args, $instance ) 
	{
		extract($args);
		$title     = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );		
		$twitter   = (!isset($instance['twitter']) || empty($instance['twitter'])) ? '' : '<a href="'.$instance['twitter'].'" class="btn-social color-twitter"><i class="fa-twitter"></i></a>';
		$rss       = (!isset($instance['rss']) || empty($instance['rss'])) ? '' : '<a href="'.$instance['rss'].'" class="btn-social color-rss"><i class="fa-rss"></i></a>';
		$facebook  = (!isset($instance['facebook']) || empty($instance['facebook'])) ? '' : '<a href="'.$instance['facebook'].'" class="btn-social color-facebook"><i class="fa-facebook"></i></a>';
		$youtube   = (!isset($instance['youtube']) || empty($instance['youtube'])) ? '' : '<a href="'.$instance['youtube'].'" class="btn-social color-youtube"><i class="fa-youtube"></i></a>';
		$google    = (!isset($instance['google']) || empty($instance['google'])) ? '' : '<a href="'.$instance['google'].'" class="btn-social color-google-plus"><i class="fa-google-plus"></i></a>';
		$pinterest = (!isset($instance['pinterest']) || empty($instance['pinterest'])) ? '' : '<a href="'.$instance['pinterest'].'" class="btn-social color-pinterest"><i class="fa-pinterest"></i></a>';
		$vk        = (!isset($instance['vk']) || empty($instance['vk'])) ? '' : '<a href="'.$instance['vk'].'" class="btn-social color-vk"><i class="fa-vk"></i></a>';

		echo $before_widget;
		if ($title) echo $before_title.$title.$after_title;	
		// =========================================================
		// Print social block
		// =========================================================
		echo $twitter.$rss.$facebook.$youtube.$google.$pinterest.$vk; 
		echo $after_widget;
	}

	function form($instance) 
	{		
		$title     = $instance['title'];	
		$twitter   = $instance['twitter'];
		$rss       = $instance['rss'];
		$facebook  = $instance['facebook'];
		$youtube   = $instance['youtube'];
		$google    = $instance['google'];
		$pinterest = $instance['pinterest'];
		$vk        = $instance['vk'];
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('twitter:'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" />
			</label>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('rss:'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php echo esc_attr($rss); ?>" />
			</label>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('facebook:'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" />
			</label>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e('youtube:'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php echo esc_attr($youtube); ?>" />
			</label>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('google'); ?>"><?php _e('google:'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('google'); ?>" name="<?php echo $this->get_field_name('google'); ?>" type="text" value="<?php echo esc_attr($google); ?>" />
			</label>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('pinterest'); ?>"><?php _e('pinterest:'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" name="<?php echo $this->get_field_name('pinterest'); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>" />
			</label>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('vk'); ?>"><?php _e('vk:'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('vk'); ?>" name="<?php echo $this->get_field_name('vk'); ?>" type="text" value="<?php echo esc_attr($vk); ?>" />
			</label>
		</p>		
		<?php
	}

	function update( $new_instance, $old_instance ) 
	{
		$instance              = $old_instance;		
		$instance['title']     = strip_tags($new_instance['title']);	
		$instance['twitter']   = strip_tags($new_instance['twitter']);
		$instance['rss']       = strip_tags($new_instance['rss']);
		$instance['facebook']  = strip_tags($new_instance['facebook']);
		$instance['youtube']   = strip_tags($new_instance['youtube']);
		$instance['google']    = strip_tags($new_instance['google']);
		$instance['pinterest'] = strip_tags($new_instance['pinterest']);
		$instance['vk']        = strip_tags($new_instance['vk']);
		return $instance;
	}

}