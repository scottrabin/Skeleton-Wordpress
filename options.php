<?php

$imagepath = get_bloginfo('template_directory') . '/images/';

/* Theme Options */

$options = array(
				 array( "name" => __("Site Layout"),
						"desc" => __("Select a sidebar layout position"),
						"id"   => "sidebar_position",
						"std"  => "right",
						"type" => "images",
						"options" => array(
										   'left' => $imagepath . '2cl.png',
										   'right' => $imagepath . '2cr.png'
										   )
						)
				 );

function swp_process_options(){
  global $options;

  return $options;
}

function swp_add_admin() {

    global $options;

    if ( $_GET['page'] == basename(__FILE__) ) {

        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=theme-options.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=theme-options.php&reset=true");
            die;

        } else if ( 'reset_widgets' == $_REQUEST['action'] ) {
            $null = null;
            update_option('sidebars_widgets',$null);
            header("Location: themes.php?page=theme-options.php&reset=true");
            die;
        }
    }

    add_theme_page(WP_THEME_NAME_NICE." Options", WP_THEME_NAME_NICE . " Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');

}

function mytheme_admin() {

    global $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.WP_THEME_NAME_NICE.' '.__('settings saved.','thematic').'</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.WP_THEME_NAME_NICE.' '.__('settings reset.','thematic').'</strong></p></div>';
    if ( $_REQUEST['reset_widgets'] ) echo '<div id="message" class="updated fade"><p><strong>'.WP_THEME_NAME_NICE.' '.__('widgets reset.','thematic').'</strong></p></div>';

	require_once( dirname( __FILE__ ) . '/admin/templates/admin.php' );
}

add_action( 'admin_menu', 'swp_add_admin' );

?>