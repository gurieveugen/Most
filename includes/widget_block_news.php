<?php
/**
 * Register new widget
 */
add_action('widgets_init', create_function('', 'register_widget( "BlockNews" );'));

class BlockNews extends WP_Widget {
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
		$widget_ops = array('classname' => 'block-news', 'description' => 'Виджет отображает последние новости' );
		parent::__construct('news', 'Новости театра', $widget_ops);
		$this->gcevents = $GLOBALS['gcevents'];
	}

	function widget( $args, $instance ) 
	{
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$count = intval($instance['count']);

		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;	

		// =========================================================
		// Print news block
		// =========================================================
		$args = array(
			'posts_per_page'   => $count,
			'offset'           => 0,			
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'post_type'        => 'post',
			'post_status'      => 'publish');

		$news       = get_posts($args);
		$news_items = '<section>';		
		foreach ($news as $key => $value) 
		{
			$date_time  = strtotime($value->post_date); 
			$day        = date('d', $date_time);
			$month      = $this->gcevents->getRusMonth(date('F', $date_time));
			$year       = date('Y', $date_time);
			$news_items.= '<article>';
			$news_items.= '<span class="date">'.$day.' '.$month.' '.$year.'</span>';
			$news_items.= '<a href="'.get_permalink($value->ID).'">'.$value->post_title.'</a>';
			$news_items.= '<span class="description">'.$this->gcevents->get_short_string(70, strip_tags($value->post_content)).'</span>';
			$news_items.= '</article>';
		}	
		echo $news_items.'<span class="all-news-link"><a href="/news">Все новости >></a></span></section>'; 	
		echo $after_widget;
	}

	function form($instance) 
	{		
		$title = $instance['title'];
		$count = $instance['count'];
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Количество записей:'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo intval($count); ?>" />
			</label>
		</p>
	<?php
	}

	function update( $new_instance, $old_instance ) 
	{
		$instance          = $old_instance;		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = intval($new_instance['count']);
		return $instance;
	}

}