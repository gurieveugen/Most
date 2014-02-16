<?php
/**
 * Register new widget
 */
add_action('widgets_init', create_function('', 'register_widget( "BlockPromo" );'));
add_action('admin_print_scripts', 'my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');

function my_admin_scripts() 
{
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', TP.'/js/admin.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');
}
 
function my_admin_styles() 
{
	wp_enqueue_style('thickbox');
}


class BlockPromo extends WP_Widget {
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct() 
	{
		$widget_ops     = array('classname' => 'block-promo', 'description' => 'Виджет отображает промо баннеры' );		
		parent::__construct('promo', 'Промо-баннеры', $widget_ops);
	}

	function widget( $args, $instance ) 
	{
		extract($args);
		$title      = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );		
		$img_first  = (isset($instance['img_first'])) ? $instance['img_first'] : 'http://placehold.it/210x220/0092c3/fff';
		$url_first  = (isset($instance['url_first'])) ? $instance['url_first'] : '#';
		$img_second = (isset($instance['img_second'])) ? $instance['img_second'] : 'http://placehold.it/210x220/123443/fff';
		$url_second = (isset($instance['url_second'])) ? $instance['url_second'] : '#';

		echo $before_widget;
		if ($title) echo $before_title.$title.$after_title;	
		// =========================================================
		// Print promo block
		// =========================================================
		?>
		<div class="row">
			<div class="col-md-6 col-lg-6 col-sm-6"><a href="<?php echo $url_first; ?>"><img src="<?php echo $img_first; ?>" alt="<?php echo $img_first; ?>" class="img-responsive"></a></div>
			<div class="col-md-6 col-lg-6 col-sm-6"><a href="<?php echo $url_second; ?>"><img src="<?php echo $img_second; ?>" alt="<?php echo $img_second; ?>" class="img-responsive"></a></div>
		</div>
		<?php
		echo $after_widget;
	}

	function form($instance) 
	{		
		$title      = $instance['title'];		
		$img_first  = $instance['img_first'];
		$url_first  = $instance['url_first'];
		$img_second = $instance['img_second'];
		$url_second = $instance['url_second'];
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('img_first'); ?>"><?php _e('Изображение для первой половины:'); ?> 
				<div style="width: 60%; float: left;"><input class="widefat" id="<?php echo $this->get_field_id('img_first'); ?>" name="<?php echo $this->get_field_name('img_first'); ?>" type="text" value="<?php echo $img_first; ?>" /></div>
				<button type="button" onclick="setPhoto(this);" data-name="<?php echo $this->get_field_id('img_first'); ?>" class="button"><?php _e('Выбрать фото'); ?></button>
			</label>
		</p>	
		<p>
			<label for="<?php echo $this->get_field_id('url_first'); ?>"><?php _e('Ссылка для первой половины:'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('url_first'); ?>" name="<?php echo $this->get_field_name('url_first'); ?>" type="text" value="<?php echo esc_attr($url_first); ?>" />
			</label>
		</p>	
		<p>
			<label for="<?php echo $this->get_field_id('img_second'); ?>"><?php _e('Изображение для второй половины:'); ?> 
				<div style="width: 60%; float: left;"><input class="widefat" id="<?php echo $this->get_field_id('img_second'); ?>" name="<?php echo $this->get_field_name('img_second'); ?>" type="text" value="<?php echo $img_second; ?>" /></div>
				<button type="button" onclick="setPhoto(this);" data-name="<?php echo $this->get_field_id('img_second'); ?>" class="button"><?php _e('Выбрать фото'); ?></button>
			</label>
		</p>	
		<p>
			<label for="<?php echo $this->get_field_id('url_second'); ?>"><?php _e('Ссылка для второй половины:'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('url_second'); ?>" name="<?php echo $this->get_field_name('url_second'); ?>" type="text" value="<?php echo esc_attr($url_second); ?>" />
			</label>
		</p>	
		<?php
	}

	function update( $new_instance, $old_instance ) 
	{
		$instance               = $old_instance;		
		$instance['title']      = strip_tags($new_instance['title']);		
		$instance['img_first']  = $new_instance['img_first'];
		$instance['url_first']  = $new_instance['url_first'];
		$instance['url_second'] = $new_instance['url_second'];
		$instance['img_second'] = $new_instance['img_second'];
		return $instance;
	}

}