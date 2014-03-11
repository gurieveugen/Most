<?php

class GCTour{
	//                __  _                 
	//   ____  ____  / /_(_)___  ____  _____
	//  / __ \/ __ \/ __/ / __ \/ __ \/ ___/
	// / /_/ / /_/ / /_/ / /_/ / / / (__  ) 
	// \____/ .___/\__/_/\____/_/ /_/____/  
	//     /_/                              
	public $lang;
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct()
	{
		// =========================================================
		// Require once
		// =========================================================
		require_once 'languages/gctour_ru.php';
		// =========================================================
		// Get language
		// =========================================================
		$this->lang = $l;
		// =========================================================
		// Hooks and actions
		// =========================================================
		add_action('init', array($this, 'createPostTypeTour'));	
		add_shortcode('tour', array($this, 'displayAllTour'));
		add_image_size('tour-image', 395, 280, true);
	}

	/**
	 * Create GCTour post type and his taxonomies
	 */
	public function createPostTypeTour()
	{

		$post_labels = array(
			'name'               => $this->l('tour'),
			'singular_name'      => $this->l('trip'),
			'add_new'            => $this->l('add_new'),
			'add_new_item'       => $this->l('add_new_trip'),
			'edit_item'          => $this->l('edit_trip'),
			'new_item'           => $this->l('add_new_trip'),
			'all_items'          => $this->l('tour'),
			'view_item'          => $this->l('view_trip'),
			'search_items'       => $this->l('search_trip'),
			'not_found'          => $this->l('no_tour_found'),
			'not_found_in_trash' => $this->l('no_tour_found_in_trash'),
			'parent_item_colon'  => '',
			'menu_name'          => $this->l('tour'));

		$post_args = array(
			'labels'             => $post_labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'trip' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail'));

		register_post_type('trip', $post_args);
	}

	/**
	 * Get caption from language file
	 * @param  string  $key 
	 * @param  boolean $print 
	 * @return string
	 */
	public function l($key, $print = false)
	{
		$key = strtolower($key);
		if($this->lang)
		{
			if(isset($this->lang[$key])) 
			{
				if($print) echo $this->lang[$key];
				else return $this->lang[$key];
			}
		}
		return '';
	}

	/**
	 * Get tour objects
	 * @param  integer $count 
	 * @param  boolean $rand  
	 * @return array
	 */
	public function getItems($count = 8, $rand = false)
	{
		if($rand) $order = 'rand';
		else $order = 'post_date';

		$args = array(
			'posts_per_page'   => $count,
			'offset'           => 0,
			'category'         => '',
			'orderby'          => $order,
			'order'            => 'DESC',
			'post_type'        => 'trip',
			'post_status'      => 'publish',
			'suppress_filters' => true );
		return get_posts($args);
	}

	/**
	 * Display array in div table
	 * @param  array   $arr             
	 * @param  integer $columns_per_row 
	 * @param  string  $column_class    
	 * @return string                   
	 */
	public function displayRows($arr, $columns_per_row = 3, $column_class = '')
	{
		$out = '';
		for ($i=0; $i < count($arr); $i+=$columns_per_row) 
		{ 
			$out.= '<div class="row">';
			for ($x=0; $x < $columns_per_row; $x++) 
			{ 
				$out.= '<div class="'.$column_class.'">'.$arr[$i+$x].'</div>';
			}
			$out.= '</div>';
		}	
		return $out;
	}	
}

// =========================================================
// LAUNCH
// =========================================================
$GLOBALS['gctour'] = new GCTour();