<?php

// define a theme name
define( 'WP_THEME_NAME', 'skeleton-wp' );

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


?>