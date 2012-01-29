<?php

function swp_get_sections(){
  return array(
			   'layout' => 'Layout'
			   );
}

function swp_get_options(){
  $imagepath = get_bloginfo( 'template_directory' ) . '/images/';

  return array(
			   'sidebar_position' => array(
										   'title' => 'Site Layout',
										   "desc" => "Select a sidebar layout position",
										   'section' => 'layout',
										   "std"  => "right",
										   "type" => "images",
										   'class' => 'enum',
										   "choices" => array(
															  'left' => $imagepath . '2cl.png',
															  'right' => $imagepath . '2cr.png'
															  )
										   ),
			   'main_width' => array(
									 'title' => 'Main Section Width',
									 'desc' => 'Set the width of the main section of the blog',
									 'section' => 'layout',
									 'std' => 13,
									 'type' => 'select',
									 'class' => 'range',
									 'range' => array( 1, 16 ),
									 'choices' => array(
														'One' => 1,
														'Two' => 2,
														'Three' => 3,
														'Four' => 4,
														'Five' => 5,
														'Six' => 6,
														'Seven' => 7,
														'Eight' => 8,
														'Nine' => 9,
														'Ten' => 10,
														'Eleven' => 11,
														'Twelve' => 12,
														'Thirteen' => 13,
														'Fourteen' => 14,
														'Fifteen' => 15,
														'Sixteen' => 16
														)
									 ),
			   'primary_color' => array(
										'title' => 'Primary Theme Color',
										'desc' => 'Set the primary theme color of the blog',
										'section' => 'layout',
										'std' => '5176de',
										'class' => 'rgb',
										'type' => 'text'
										),
			   'secondary_color' => array(
										  'title' => 'Secondary Theme Color',
										  'desc' => 'Set the secondary (highlight) color of the blog',
										  'section' => 'layout',
										  'std' => '3156be',
										  'class' => 'rgb',
										  'type' => 'text'
										  )
			   );
}

function swp_get_option( $opt ){
  $options = get_option( 'swp_options' );

  if( isset( $options[ $opt ] ) ){
	return $options[ $opt ];
  } else {
	$options = swp_get_options();
	return isset( $options[ $opt ][ 'std' ] ) ? $options[ $opt ][ 'std' ] : null;
  }
}

/**
 * Assist in creating/registering settings with Wordpress
 */
function swp_create_setting( $args = array() ){
  $defaults = array(
					'id' => 'null_id',
					'title' => '**NO TITLE**',
					'desc' => '**NO DESCRIPTION**',
					'std' => '',
					'type' => 'text',
					'section' => 'general',
					'choices' => array(),
					'class' => ''
					);

  extract( wp_parse_args( $args, $defaults ) );

  $field_params = array(
						'type' => $type,
						'id' => $id,
						'desc' => $desc,
						'std' => $std,
						'choices' => $choices,
						'label_for' => $id,
						'class' => $class
						);

  add_settings_field( $field_params[ 'id' ], $title, 'swp_display_setting', 'swp_options', $section, $field_params );
}

function swp_admin_init(){

  // Register all the settings for this theme
  // do we need to initialize everything to default values?

  $initialize = false;
  if( $initialize )
	$defaults = array();

  register_setting( 'swp_options', 'swp_options', 'swp_validate_settings' );
  $options = swp_get_options();

  // register the sections
  $sections = swp_get_sections();
  foreach( $sections as $slug => $title ){
	add_settings_section( $slug, $title, 'swp_display_section', 'swp_options' );
  }

  // register the settings
  $settings = swp_get_options();
  foreach( $settings as $id => $setting ){
	$setting['id'] = $id;
	swp_create_setting( $setting );
  }

  if( $initialize )	{
	print 'initializing';
	//update_option( 'swp_options', $defaults );
  }
	
  // register settings here
  wp_enqueue_style( 'admin-style', get_bloginfo('template_directory') . '/settings/css/option.css' );
}
function swp_admin_menu(){
  // add theme pages here
  add_theme_page(
				 __( 'Theme Options', WP_THEME_NAME ),
				 __( 'Theme Options', WP_THEME_NAME ),
				 'manage_options',
				 'swp_options',
				 'swp_display_page'
				 );
}
add_action( 'admin_init', 'swp_admin_init' );
add_action( 'admin_menu', 'swp_admin_menu' );

function swp_validate_settings( $input ){
  $valid_input = array();

  $options = swp_get_options();

  foreach($options as $section => $optionList){
	foreach($optionList as $option){

	  // if there's nothing coming in, ignore
	  if( empty( $input[ $option['id'] ] ) ){ continue; }

	  $opt_id = $option['id'];
	  $input_value = $input[ $opt_id ];

	  // error variables
	  $error_type = null;
	  $error_message = null;

	  switch( $option['class'] ){
	  case 'range':
		$valid_input[ $opt_id ] = intval( $input_value );
		if( $valid_input[ $opt_id ] < $option['range'][0] ||
			$valid_input[ $opt_id ] > $option['range'][1]
			){

		  $error_type = 'range_error';
		  $error_message = "Expected a number between {$option['range'][0]} and {$option['range'][1]}";

		}
		break;
	  case 'enum':
		$valid_input[ $opt_id ] = $input[ $opt_id ];

		if( ! in_array( $valid_input[ $opt_id ], array_keys( $option['choices'] ) ) ){

		  $error_type = 'enum_error';
		  $error_message = sprintf("Expected a value in (%s)", implode( ', ', array_keys( $option['choices'] ) ) );
		}
		break;
	  }

	  if( $error_type !== null && $error_message !== null ){
		add_settings_error(
						   $opt_id,
						   WP_THEME_PREFIX . $error_type,
						   __( $error_message, WP_THEME_NAME ),
						   'error' );
	  }
	}
  }

  return $valid_input;
}

function swp_display_page(){
  include( dirname(__FILE__) . '/templates/option.php' );
}
function swp_display_section( $args = array() ){
}
function swp_display_setting( $args = array() ){
  extract( $args );
  $options = get_option( 'swp_options' );

  if( empty( $options[$id] ) )
	$options[$id] = ( $type === 'checkbox' ? 0 : $std );

  $field_class = '';
  if( $class != '' )
	$field_class = " class=\"${class}\"";

  $template = dirname( __FILE__ ) . "/templates/option-${type}.php";
  if( file_exists( $template ) ){
	print "<section class=\"section-{$type}\">";
	include( $template );
	print "</section>";
  }
}

// initialize settings if necessary
if( ! get_option( 'swp_options' ) ){
  //print 'INITIALIZE!';
}

