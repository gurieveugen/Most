<?php

class GCRepertuar{
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
		require_once 'languages/gcrepertuar_ru.php';
		// =========================================================
		// Get language
		// =========================================================
		$this->lang = $l;
		// =========================================================
		// Hooks and actions
		// =========================================================
		add_action('init', array($this, 'createPostTypeRepertuar'));	
		add_shortcode('repertuar', array($this, 'displayAllRepertuar'));
		add_image_size('repertuar-image', 280, 395, true);
	}

	/**
	 * Create GCRepertuar post type and his taxonomies
	 */
	public function createPostTypeRepertuar()
	{

		$post_labels = array(
			'name'               => $this->l('repertuar'),
			'singular_name'      => $this->l('spectacle'),
			'add_new'            => $this->l('add_new'),
			'add_new_item'       => $this->l('add_new_spectacle'),
			'edit_item'          => $this->l('edit_spectacle'),
			'new_item'           => $this->l('add_new_spectacle'),
			'all_items'          => $this->l('repertuar'),
			'view_item'          => $this->l('view_spectacle'),
			'search_items'       => $this->l('search_spectacle'),
			'not_found'          => $this->l('no_repertuar_found'),
			'not_found_in_trash' => $this->l('no_repertuar_found_in_trash'),
			'parent_item_colon'  => '',
			'menu_name'          => $this->l('repertuar'));

		$post_args = array(
			'labels'             => $post_labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'spectacle' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail'));

		register_post_type('spectacle', $post_args);
		register_taxonomy('spectacle_cat', array('spectacle'), $tax_args);
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
	 * Get repertuar objects
	 * @param  integer $count 
	 * @param  boolean $rand  
	 * @return array
	 */
	public function getMembers($count = -1, $rand = false)
	{
		if($rand) $order = 'rand';
		else $order = 'post_title';

		$args = array(
			'posts_per_page'   => $count,
			'offset'           => 0,
			'category'         => '',
			'orderby'          => $order,
			'order'            => 'DESC',
			'post_type'        => 'spectacle',
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
$GLOBALS['gcrepertuar'] = new GCRepertuar();