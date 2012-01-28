<div class="wrap">
   <?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', WP_THEME_NAME ) . "</h2>"; ?>

   <?php if( isset($_REQUEST['settings-updated']) && $_REQUEST['settings-updated'] !== false ) : ?>
   <div class="updated fade"><p><strong><?php _e( 'Options saved', WP_THEME_NAME ); ?></strong></p></div>
   <?php endif; ?>

   <form method="post" action="options.php">
   <?php settings_fields( 'swp_options' ); ?>
   <?php do_settings_sections( $_GET['page'] ); ?>

   <p class="submit"><input name="Submit" type="submit" class="button-primary" value="<?php _e( 'Save Changes', WP_THEME_NAME ); ?>" /></p>
   </form>
</div>