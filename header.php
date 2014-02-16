<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>	
	<!--[if lt IE 9]><script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script><![endif]-->
	<?php wp_head(); ?>
	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="<?php echo TP; ?>/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox -->
	<link rel="stylesheet" href="<?php echo TP; ?>/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
	<script type="text/javascript" src="<?php echo TP; ?>/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

	<!-- Optionally add helpers - button, thumbnail and/or media -->
	<link rel="stylesheet" href="<?php echo TP; ?>/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
	<script type="text/javascript" src="<?php echo TP; ?>/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<script type="text/javascript" src="<?php echo TP; ?>/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

	<link rel="stylesheet" href="<?php echo TP; ?>/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
	<script type="text/javascript" src="<?php echo TP; ?>/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
</head>
<body <?php body_class(); ?>>
	<header class="main-header">
		<?php 
		$gcviewWalker = new GCViewWalker();
		wp_nav_menu(array('theme_location' => 'main', 'container' => '', 'walker' => $gcviewWalker)); 
		?>
	</header>