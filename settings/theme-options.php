<?php

class SettingsManager {

  private $default_settings_properties = array(
											   'id' => 'null_id',
											   'title' => '**NO TITLE**',
											   'desc' => '**NO DESCRIPTION**',
											   'std' => '',
											   'type' => 'text',
											   'section' => 'general',
											   'choices' => array(),
											   'class' => ''
											   );

  function __construct() {
	$this->settings = array();
	$this->sections = array();

	$this->options = get_option( 'swp_options' );
  }
	
  public function addSection( $sectionID, $sectionName ){
	$this->sections[ $sectionID ] = $sectionName;
  }
  public function registerSections(){
	foreach( $this->sections as $slug => $title ){
	  add_settings_section( $slug, $title, 'swp_display_section', 'swp_options' );
	}
  }
  public function addSetting( $settingID, $settingProperties ){
	
	$args = wp_parse_args( $settingProperties, $this->default_settings_properties );

	$field = array(
				   'type' => $args['type'],
				   'id' => $settingID,
				   'desc' => $args['desc'],
				   'title' => $args['title'],
				   'std' => $args['std'],
				   'choices' => $args['choices'],
				   'label_for' => $args['id'],
				   'class' => $args['class'],
				   'section' => $args['section']
				   );

	$this->settings[ $settingID ] = $field;
  }
  public function createSettings(){
	register_setting( 'swp_options', 'swp_options', 'swp_validate_settings' );
	foreach( $this->settings as $settingID => $field ){
	  add_settings_field( $settingID, $field['title'], 'swp_display_setting', 'swp_options', $field['section'], $field );
	}
  }
  public function get( $settingName ){
	if( isset( $this->options[ $settingName ] ) ){
	  return $this->options[ $settingName ];
	} else if( isset( $this->settings[ $settingName ] ) ){
	  return $this->settings[ $settingName ]['std'];
	} else {
	  return null;
	}
  }
}

$swp_settings = new SettingsManager();

add_action( 'admin_init', array( &$swp_settings, 'createSettings') );
add_action( 'admin_init', array( &$swp_settings, 'registerSections' ) );

$swp_settings->addSection( 'layout', 'Layout' );

$swp_settings->addSetting( 'sidebar_position', array('title' => 'Site Layout',
														"desc" => "Select a sidebar layout position",
														'section' => 'layout',
														"std"  => "right",
														"type" => "images",
														'class' => 'enum',
														"choices" => array(
																		   'left' => get_bloginfo( 'template_directory' ) . '/images/2cl.png',
																		   'right' => get_bloginfo( 'template_directory' ) . '/images/2cr.png'
																		   )
														));
$swp_settings->addSetting( 'main_width', array(
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
												  ));
$swp_settings->addSetting('primary_color', array(
													'title' => 'Primary Theme Color',
													'desc' => 'Set the primary theme color of the blog',
													'section' => 'layout',
													'std' => '5176de',
													'class' => 'rgb',
													'type' => 'text'
													));
$swp_settings->addSetting('secondary_color', array(
													  'title' => 'Secondary Theme Color',
													  'desc' => 'Set the secondary (highlight) color of the blog',
													  'section' => 'layout',
													  'std' => '3156be',
													  'class' => 'rgb',
													  'type' => 'text'
													  ));
$swp_settings->addSetting('link_color', array(
												 'title' => 'Link Color',
												 'desc' => 'Set the color for anchor links',
												 'section' => 'layout',
												 'std' => '2970A6',
												 'class' => 'rgb',
												 'type' => 'text'
												 ));

function swp_get_option( $opt ){
  global $swp_settings;
  return $swp_settings->get( $opt );
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
  global $swp_settings;

  extract( $args );
  //$options = get_option( 'swp_options' );
  $options = $swp_settings->options;

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