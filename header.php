<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <title><?php swp_print_title(); ?></title>
	<meta name="description" content="">
	<meta name="author" content="">
    <!--[if lt IE 9]>
       <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/base.css">
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/skeleton.css">
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/layout.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />
   <style type="text/css"><?php

   $sidebar_position = swp_get_option('sidebar_position');
$content_position = ( $sidebar_position === 'left' ? 'right' : 'left' );?>

#content{ float: <?php print $content_position; ?>; }
#sidebar{ float: <?php print $sidebar_position; ?>; }
.primary-bg{ background-color: #<?php print swp_get_option('primary_color'); ?>; }
.secondary-bg { background-color: #<?php print swp_get_option('secondary_color'); ?>; }
.primary-color{ color: #<?php print swp_get_option('primary_color'); ?>; }
.secondary-color{ color: #<?php print swp_get_option('secondary_color'); ?>; }
body .theme-color-hover{ color: #<?php print swp_get_option('primary_color'); ?>; }
body .theme-color-hover:hover{ color: #<?php print swp_get_option('secondary_color'); ?>}
.primary-border{ border-color: #<?php print swp_get_option('primary_color'); ?>; }
.secondary-border{ border-color: #<?php print swp_get_option('secondary_color'); ?>; }
a, a:visited { color: #<?php print swp_get_option('link_color'); ?>; }
a:hover, a:focus { color: #222; }

   </style>
   <!--[if lt IE 9]>
      <script src="<?php bloginfo('template_directory'); ?>/javascripts/respond.min.js"></script>
   <![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico">
	<link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon-114x114.png">

    <?php if ( is_singular() && get_option( 'thread-comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
    <?php wp_head(); ?>

    <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php printf( __( '%s latest posts', WP_THEME_NAME ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
    <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'skeleton-wp' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
</head>
<body>

	<!-- Primary Page Layout
	================================================== -->

   <div id="wrap" class="container">
      <header class="shadow primary-border">
         <div id="masthead">
 
            <div id="branding">
		       <h1 id="blog-title">
		          <a href="<?php bloginfo( 'url' ); ?>/" title="<?php bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
               </h1>
		<?php if ( is_home() || is_front_page() ) { ?>
			   <h2 id="blog-description"><?php bloginfo( 'description' ); ?></h2>
		<?php } else { ?>
		       <div id="blog-description"><?php bloginfo( 'description' ); ?></div>
		<?php } ?>

            </div><!-- #branding -->
 
            <div id="access">
			   <div class="skip-link screenreader"><a href="#content" title="<?php _e( 'Skip to content', WP_THEME_NAME ) ?>"><?php _e( 'Skip to content', WP_THEME_NAME ) ?></a></div>
			   <a id="show-menu" class="mobile icon icon-list-dark" href="?sitemap">²</a>
			   <a id="show-search" class="mobile icon icon-zoom-dark" href="search">L</a>
				  <?php /*wp_page_menu( 'sort_column=menu_order' );*/ ?>
				  <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'container_id' => 'main-menu', 'walker' => new SWP_Walker() ) ); ?>
				  <div class="mobile"><?php get_search_form(); ?></div>
            </div><!-- #access -->
 
         </div><!-- #masthead -->
      </header><!-- header -->