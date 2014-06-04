<?php
define('TP', get_bloginfo('template_url'));

// =========================================================
// REQUIRE ONCE
// =========================================================
require_once 'includes/gctruppa_post_type.php';
require_once 'includes/gcmultimedia_post_type.php';
require_once 'includes/gcrepertuar_post_type.php';
require_once 'includes/gctour_post_type.php';
require_once 'includes/widget_block_news.php';
require_once 'includes/widget_block_media.php';
require_once 'includes/widget_block_truppa.php';
require_once 'includes/widget_block_promo.php';
require_once 'includes/widget_block_social.php';
require_once 'includes/post_type_factory.php';
require_once 'includes/lorem_posts.php';

// =========================================================
// Add styles
// =========================================================
if(!is_admin())
{
	wp_enqueue_style('main-style', TP.'/style.css', false, false);
	wp_enqueue_style('reset', TP.'/css/bootstrap.min.css');	
	wp_enqueue_script('MOST',TP.'/js/most.js', array('jquery'));
	wp_enqueue_script('Bootstrap',TP.'/js/bootstrap.min.js', array('MOST'));
	
}

// =========================================================
// Add menus
// =========================================================
register_nav_menus(array('main'   => __('Главное меню ( находиться слева )', 'most')));

// =========================================================
// Add sidebars
// =========================================================
register_sidebar(array(
	'id' => 'row-first', 
	'name' => 'Первая строчка', 
	'description' => 'Отображаеться на главной странице. Сразу под билетами.',
	'before_widget' => '<div id="%1$s" class="col-md-4 col-lg-4 %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>'));

register_sidebar(array(
	'id' => 'row-second', 
	'name' => 'Вторая строчка', 
	'description' => 'Отображаеться на главной странице. Сразу под билетами.',
	'before_widget' => '<div id="%1$s" class="col-md-4 col-lg-4 %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>'));

register_sidebar(array(
	'id' => 'row-third', 
	'name' => 'Третья строчка', 
	'description' => 'Отображаеться на главной странице. Сразу под билетами.',
	'before_widget' => '<div id="%1$s" class="col-md-4 col-lg-4 %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>'));
 
// =========================================================
// Add some image size's
// =========================================================
add_image_size('media-image', 580, 320, true);
add_image_size('member-image', 160, 150, true);
add_image_size('member-big-image', 400, 400, true);
add_image_size('widget-image', 210, 220, true);
add_image_size('widget-thumb-image', 150, 100, true);
add_image_size('row-first-image', 870, 508, true);
add_image_size('row-second-image', 580, 310, true);
add_image_size('ticket-image', 280, 400, true);
add_image_size('gallery-image', 310, 210, true);
add_filter( 'image_size_names_choose', 'namespace_image_size_names_choose' );
//add_filter( 'posts_where' , 'customWhere' );


// =========================================================
// АФИША
// =========================================================
$GLOBALS['afisha'] = new PostTypeFactory('afisha', array('label' => 'Афиша', 'icon_code' => 'f0e7'));
$GLOBALS['afisha']->addMetaBox('Time', array('Time' => 'text'));
$GLOBALS['afisha']->meta_box_context = 'side';
// =========================================================
// АРХИВ
// =========================================================
$GLOBALS['archive'] = new PostTypeFactory('archive', array('label' => 'Архив', 'icon_code' => 'f187'));
$GLOBALS['archive']->addMetaBox('Time', array('Time' => 'text'));
$GLOBALS['archive']->meta_box_context = 'side';
// =========================================================
// События
// =========================================================
$GLOBALS['pt_gcevent'] = new PostTypeFactory('gcevent', array('label' => 'Билеты'));
$GLOBALS['pt_gcevent']->addMetaBox('Partners', array('urls' => array('table', array('image source', 'url'))));
// =========================================================
// GENERATE TEST POSTS
// =========================================================
// $lorem_posts = new LoremPosts();
// $lorem_posts->generatePosts(10, 'archive');
// $lorem_posts->generatePosts(10, 'afisha');



function customWhere($where)
{
	if(is_admin()) return $where;
	if(strpos($where, "wp_posts.post_type = 'afisha'") !== false)
	{
		$where .= " AND post_date >= '".date('Y-m-d"')."'";
	}
	
	return $where;
}

function namespace_image_size_names_choose( $image_sizes ) 
{
	$image_sizes['widget-image'] = __('Размер изображения специально для промо виджета');
	return $image_sizes;
}


/**
 * Get all images from post
 */
function getAllImagesFromPost($id, $size = 'gallery-image')
{
	$thumb_id = -666;
	$args     = array(
	  'post_type'   => 'attachment',
	  'numberposts' => -1,
	  'post_status' => null,
	  'post_parent' => $id
	);

	if(has_post_thumbnail($id)) $thumb_id = get_post_thumbnail_id($id);

	$attachments = get_posts( $args );
	if ( $attachments )
	{
		foreach ( $attachments as $attachment )
		{
			if($attachment->ID != $thumb_id)
			{
				$tmp      = wp_get_attachment_image_src($attachment->ID, $size);
				$tmp_full = wp_get_attachment_image_src($attachment->ID, 'full');

				if($tmp[0])
				{
					$images[] = array('small' => $tmp[0], 'full' => $tmp_full[0]);
				}  	
			}
		}
	}
	return $images;
}

function active($bool = true)
{
	if($bool) return 'active';
	return '';
}

function printPerRow($items, $columns = 3)
{
	for ($i=0; $i < count($items); $i+=$columns) 
	{ 
		echo '<div class="row">';
		for ($j=0; $j < $columns; $j++) 
		{ 
			if(isset($items[$i+$j])) echo $items[$i+$j];
		}
		echo '</div>';
	}
}


?>
