<?php get_header(); ?>
 
      <div id="content" class="<?php print swp_column_width('main'); ?> columns">
 
         <div id="post-0" class="post error404 not-found">
            <h1 class="entry-title"><?php _e( 'Not Found', WP_THEME_NAME ); ?></h1>
            <div class="entry-content">
               <p><?php _e( 'Apologies, but we were unable to find what you were looking for. Perhaps searching will help.', WP_THEME_NAME ); ?></p>
<?php get_search_form(); ?>
            </div><!-- .entry-content -->
         </div><!-- #post-0 -->
 
      </div><!-- #content -->
  
<?php get_sidebar(); ?>
<?php get_footer(); ?>