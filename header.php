<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php
        if ( is_single() ) { single_post_title(); }
        elseif ( is_home() || is_front_page() ) { bloginfo('name'); print ' | '; bloginfo('description'); get_page_number(); }
        elseif ( is_page() ) { single_post_title(''); }
        elseif ( is_search() ) { bloginfo('name'); print ' | Search results for ' . wp_specialchars($s); get_page_number(); }
        elseif ( is_404() ) { bloginfo('name'); print ' | Not Found'; }
        else { bloginfo('name'); wp_title('|'); get_page_number(); }
    ?></title>
	<meta name="description" content="">
	<meta name="author" content="">
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/stylesheets/base.css">
	<link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/stylesheets/skeleton.css">
	<link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/stylesheets/layout.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/apple-touch-icon-114x114.png">

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
      <div id="header">
         <div id="masthead">
 
            <div id="branding">
		       <div id="blog-title">
		          <span><a href="<?php bloginfo( 'url' ); ?>/" title="<?php bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
               </div>
		<?php if ( is_home() || is_front_page() ) { ?>
			   <h1 id="blog-description"><?php bloginfo( 'description' ); ?></h1>
		<?php } else { ?>
		       <div id="blog-description"><?php bloginfo( 'description' ); ?></div>
		<?php } ?>

            </div><!-- #branding -->
 
            <div id="access">
			   <div class="skip-link"><a href="#content" title="<?php _e( 'Skip to content', 'your-theme' ) ?>"><?php _e( 'Skip to content', 'your-theme' ) ?></a></div>
               <?php wp_page_menu( 'sort_column=menu_order' ); ?>
            </div><!-- #access -->
 
         </div><!-- #masthead -->
      </div><!-- #header -->