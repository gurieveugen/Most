<?php

class GCTruppa{
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
		require_once 'languages/gctruppa_ru.php';
		// =========================================================
		// Get language
		// =========================================================
		$this->lang = $l;
		// =========================================================
		// Hooks and actions
		// =========================================================
		add_action('init', array($this, 'createPostTypeTruppa'));	
		add_shortcode('truppa', array($this, 'displayAllTruppa'));
	}

	/**
	 * Create GCTruppa post type and his taxonomies
	 */
	public function createPostTypeTruppa()
	{

		$post_labels = array(
			'name'               => $this->l('members'),
			'singular_name'      => $this->l('member'),
			'add_new'            => $this->l('add_new'),
			'add_new_item'       => $this->l('add_new_member'),
			'edit_item'          => $this->l('edit_member'),
			'new_item'           => $this->l('add_new_member'),
			'all_items'          => $this->l('members'),
			'view_item'          => $this->l('view_member'),
			'search_items'       => $this->l('search_member'),
			'not_found'          => $this->l('no_members_found'),
			'not_found_in_trash' => $this->l('no_members_found_in_trash'),
			'parent_item_colon'  => '',
			'menu_name'          => $this->l('truppa'));

		$post_args = array(
			'labels'             => $post_labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'member' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'taxonomies'         => array('member_cat'),
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ));

		$tax_labels = array(
			'name'              => $this->l('member_categories'),
			'singular_name'     => $this->l('member_category'),
			'search_items'      => $this->l('search_member_categories'),
			'all_items'         => $this->l('all_member_categories'),
			'parent_item'       => $this->l('parent_member_category'),
			'parent_item_colon' => $this->l('parent_member_category'),
			'edit_item'         => $this->l('edit_member_category'),
			'update_item'       => $this->l('update_member_category'),
			'add_new_item'      => $this->l('add_new_member_category'),
			'new_item_name'     => $this->l('new_member_category_name'),
			'menu_name'         => $this->l('member_category'));

		$tax_args = array(
			'hierarchical'      => true,
			'labels'            => $tax_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'member_cat' ));

		register_post_type('member', $post_args);
		register_taxonomy('member_cat', array('member'), $tax_args);
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
	public function getMembers($count = -1, $rand = false)
	{
		if($rand) $order = 'rand';
		else $order = 'post_title';

		$args = array(
			'posts_per_page'   => $count,
			'offset'           => 0,
			'category'         => '',
			'orderby'          => $order,
			'order'            => 'ASC',
			'post_type'        => 'member',
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

	/**
	 * Display truppa Grid
	 * Short Code [truppa]
	 * @return string
	 */
	public function displayAllTruppa()
	{
		$truppa = $this->getMembers(-1, false);
		foreach ($truppa as $key => $value) 
		{
		 	$img_src   = 'http://placehold.it/300x300/0092c3/fff';
 			if(has_post_thumbnail($value->ID))
 			{
 				$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($value->ID), 'member-big-image');
 				$img_src = $img_src[0];
 			}
 			$members[] = '<a href="'.get_permalink($value->ID).'" title="'.$value->post_title.'"><img src="'.$img_src.'" alt="'.$value->post_title.'"></a>';
		} 		
		return $this->displayRows($members, 4, 'col-md-3 col-lg-3 col-sm-3 member');
	}
}

// =========================================================
// LAUNCH
// =========================================================
$GLOBALS['gctruppa'] = new GCTruppa();