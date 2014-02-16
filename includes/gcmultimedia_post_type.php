<?php

class GCMultimedia{
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
		require_once 'languages/gcmultimedia_ru.php';
		// =========================================================
		// Get language
		// =========================================================
		$this->lang = $l;
		// =========================================================
		// Hooks and actions
		// =========================================================
		add_action('init', array($this, 'createPostTypeMultimedia'));		
	}

	/**
	 * Create GCMultimedia post type and his taxonomies
	 */
	public function createPostTypeMultimedia()
	{

		$post_labels = array(
			'name'               => $this->l('multimedia'),
			'singular_name'      => $this->l('multimedia'),
			'add_new'            => $this->l('add_new'),
			'add_new_item'       => $this->l('add_new_multimedia'),
			'edit_item'          => $this->l('edit_multimedia'),
			'new_item'           => $this->l('add_new_multimedia'),
			'all_items'          => $this->l('multimedia'),
			'view_item'          => $this->l('view_multimedia'),
			'search_items'       => $this->l('search_multimedia'),
			'not_found'          => $this->l('no_multimedia_found'),
			'not_found_in_trash' => $this->l('no_multimedia_found_in_trash'),
			'parent_item_colon'  => '',
			'menu_name'          => $this->l('multimedia'));

		$post_args = array(
			'labels'             => $post_labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'multimedia' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'taxonomies'         => array('multimedia_cat'),
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ));

		$tax_labels = array(
			'name'              => $this->l('multimedia_categories'),
			'singular_name'     => $this->l('multimedia_category'),
			'search_items'      => $this->l('search_multimedia_categories'),
			'all_items'         => $this->l('all_multimedia_categories'),
			'parent_item'       => $this->l('parent_multimedia_category'),
			'parent_item_colon' => $this->l('parent_multimedia_category'),
			'edit_item'         => $this->l('edit_multimedia_category'),
			'update_item'       => $this->l('update_multimedia_category'),
			'add_new_item'      => $this->l('add_new_multimedia_category'),
			'new_item_name'     => $this->l('new_multimedia_category_name'),
			'menu_name'         => $this->l('multimedia_category'));

		$tax_args = array(
			'hierarchical'      => true,
			'labels'            => $tax_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'multimedia_cat' ));

		register_post_type('multimedia', $post_args);
		register_taxonomy('multimedia_cat', array('multimedia'), $tax_args);
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
	 * Get members objects
	 * @param  integer $count 
	 * @param  boolean $rand  
	 * @return array
	 */
	public function getMedia($count = -1, $rand = false, $term = '')
	{
		if($rand) $order = 'rand';
		else $order = 'post_title';

		$args = array(
			'posts_per_page'   => $count,
			'offset'           => 0,
			'category'         => '',
			'orderby'          => $order,
			'order'            => 'DESC',
			'post_type'        => 'multimedia',
			'post_status'      => 'publish',
			'multimedia_cat'   => $term,
			'suppress_filters' => true );
		return get_posts($args);
	}
}

// =========================================================
// LAUNCH
// =========================================================
$GLOBALS['gcmultimedia'] = new GCMultimedia();