<?php

// define a theme name
define( 'WP_THEME_NAME', 'skeleton-wp' );
define( 'WP_THEME_NAME_NICE', 'Skeleton Wordpress' );
define( 'WP_THEME_PREFIX', 'swp_' );

// Make theme available for translation
// Translations can be filed in the /languages/ directory
load_theme_textdomain( WP_THEME_NAME, TEMPLATEPATH . '/languages' );
 
$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable($locale_file) )
    require_once($locale_file);
 
// Get the page number
function get_page_number() {
    if ( get_query_var('paged') ) {
        print ' | ' . __( 'Page ' , WP_THEME_NAME ) . get_query_var('paged');
    }
} // end get_page_number

/* Title */
function swp_print_title(){
  if ( is_single() ) { single_post_title(); }
  elseif ( is_home() || is_front_page() ) { bloginfo('name'); print ' | '; bloginfo('description'); get_page_number(); }
  elseif ( is_page() ) { single_post_title(''); }
  elseif ( is_search() ) { bloginfo('name'); print ' | Search results for ' . wp_specialchars($s); get_page_number(); }
  elseif ( is_404() ) { bloginfo('name'); print ' | Not Found'; }
  else { bloginfo('name'); wp_title('|'); get_page_number(); }
}

/* Just generate the link to a previous or next post */
function swp_get_next_post_link( $format='%link &raquo;', $link='%title', $in_same_cat = false, $excluded_categories='' ){
  return swp_get_adjacent_post_link( $format, $link, $in_same_cat, $excluded_categories, false );
}
function swp_get_previous_post_link( $format='&laquo; %link', $link='%title', $in_same_cat = false, $excluded_categories='' ){
  return swp_get_adjacent_post_link( $format, $link, $in_same_cat, $excluded_categories, true );
}
/* This should be built into Wordpress, and is being considered: http://core.trac.wordpress.org/ticket/17302 */
/* TODO: Revisit this when WP updates. */
/* Clone of wp-includes/link-template :: adjacent_post_link, with 'echo' replaced by 'return' */
function swp_get_adjacent_post_link( $format, $link, $in_same_cat = false, $excluded_categories = '', $previous = true ){
	if ( $previous && is_attachment() )
		$post = & get_post($GLOBALS['post']->post_parent);
	else
		$post = get_adjacent_post($in_same_cat, $excluded_categories, $previous);

	if ( !$post )
		return;

	$title = $post->post_title;

	if ( empty($post->post_title) )
		$title = $previous ? __('Previous Post') : __('Next Post');

	$title = apply_filters('the_title', $title, $post->ID);
	$date = mysql2date(get_option('date_format'), $post->post_date);
	$rel = $previous ? 'prev' : 'next';

	$string = '<a href="'.get_permalink($post).'" rel="'.$rel.'">';
	$link = str_replace('%title', $title, $link);
	$link = str_replace('%date', $date, $link);
	$link = $string . $link . '</a>';

	$format = str_replace('%link', $link, $format);

	$adjacent = $previous ? 'previous' : 'next';
	return apply_filters( "{$adjacent}_post_link", $format, $link );
}

/* Post Navigation */
function swp_post_navigation( $position ) {
  global $wp_query;
  $total_pages = $wp_query->max_num_pages; 

  $templateName = null;

  if( is_single() ){

	$previousPostLink = swp_get_previous_post_link( '%link', '<span class="meta-nav">&laquo;</span> %title' );
	$nextPostLink = swp_get_next_post_link( '%link', '%title <span class="meta-nav">&raquo;</span>' );
	
	$templateName = 'single';

  } elseif( $total_pages > 1 ){

	$previousPostLink = get_next_posts_link( __( '<span class="meta-nav">&laquo;</span> Older posts', WP_THEME_NAME ));
	$nextPostLink = get_previous_posts_link(__( 'Newer posts <span class="meta-nav">&raquo;</span>', WP_THEME_NAME ));

  }

  $templates = array();
  if( isset($templateName) )
	$templates[] = "post-nav-{$templateName}.php";

  $templates[] = 'post-nav.php';

  if( isset($previousPostLink) || isset($nextPostLink) ){
	do_action( "get_template_part_post-nav", 'post-nav', $templateName );

	include( locate_template( $templates ) );
  }
}

function swp_post_navigation_above(){ swp_post_navigation( 'above' ); }
function swp_post_navigation_below(){ swp_post_navigation( 'below' ); }
/* END Post Navigation */

/* Post Content Templating */
function swp_post_begin(){ ?><div id="post-<?php the_ID(); ?>" <?php post_class(); ?>> <?php }
function swp_post_end(){ ?> </div><!-- #post-<?php the_ID(); ?> --> <?php }

function swp_post_comments_and_trackbacks(){

  if( ( $post->comment_status == 'open' ) && ( $post->ping_status == 'open' ) ){
	// both coments and trackbacks are open
	printf( __( '<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a> or leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', WP_THEME_NAME ), get_trackback_url() );
  } elseif( ($post->comment_status != 'open') && ($post->ping_status == 'open') ){
	// no comments, trackbacks only
	printf( __( 'Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', WP_THEME_NAME ), get_trackback_url() );
  } elseif( ($post->comment_status == 'open') && ($post->ping_status != 'open') ){
	// comments only, no trackbacks
	_e( 'Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Post a comment">post a comment</a>.', WP_THEME_NAME );
  } elseif( ($post->comment_status != 'open') && ($post->ping_status != 'open') ){
	// no comments or trackbacks
	_e( 'Both comments and trackbacks are currently closed.', WP_THEME_NAME );
  }

}

function swp_column_width( $colname ){
  $mainWidth = swp_get_option( 'main_width' );
  $numNameMap = array(null,'one','two','three','four','five','six','seven','eight','nine','ten','eleven','twelve','thirteen','fourteen','fifteen','sixteen');
  if( $colname === 'main' )
	return $numNameMap[ $mainWidth ];
  else
	return $numNameMap[ 16 - $mainWidth ];
}

function swp_generate_html( $args ){
  $tagName = $args['tagName'];
  $contents = $args['contents'];
  $attrs = array();

  foreach( $args as $attribute => $value ){
	// skip over tagName and contents
	if( $attribute === 'tagName' || $attribute === 'contents' ){ continue; }

	// if checked && false, don't do anything
	if( $attribute === 'checked' && $value === false ){ continue; }
	if( $attribute === 'selected' && $value === false ){ continue; }

	$attrs[] = "${attribute}=\"${value}\"";
  }
  $attributes = implode(' ', $attrs);

  if( strlen($attributes) > 0 ){
	return "<${tagName} ${attributes}>${contents}</${tagName}>";
  } else {
	return "<${tagName}>${contents}</${tagName}>";
  }

}

/* Sidebar */
function theme_widgets_init() {
  // first area
  register_sidebar( array(
						  'name' => 'Primary Widget Area',
						  'id'   => 'primary_widget_area',
						  'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
						  'after_widget' => '</li>',
						  'before_title' => '<h3 class="widget-title">',
						  'after_title' => '</h3>'
						  )
					);

  // second area
  register_sidebar( array(
						  'name' => 'Secondary Widget Area',
						  'id'   => 'secondary_widget_area',
						  'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
						  'after_widget' => '</li>',
						  'before_title' => '<h3 class="widget-title">',
						  'after_title' => '</h3>'
						  )
					);
}
add_action( 'init', 'theme_widgets_init' );

/* Activate preset widgets */
$widgets_preset = array(
						'primary_widget_area' => array(
													   'search',
													   'pages',
													   'categories',
													   'archives'
													   ),
						'secondary_widget_area' => array(
														 'links',
														 'meta'
														 )
						);
if( isset( $_GET['activated'] ) ) {
  update_option( 'sidebars_widgets', $preset_widgets );
}

/* Determine if a sidebar contains widgets */
function is_sidebar_active( $index ) {
  global $wp_registered_sidebars;

  $widgetcolumns = wp_get_sidebars_widgets();

  if( $widgetcolumns[$index] ) return true;

  return false;
}

/** Native Menu Support **/
add_action( 'init', 'swp_register_menus' );
function swp_register_menus(){
  register_nav_menus( array(
							'main-menu' => __('Main Menu', WP_THEME_NAME)
							)
					  );
}
					 


require_once ( get_template_directory() . '/settings/theme-options.php' );
//require_once( get_template_directory() . '/my-theme-settings.php' );
?>