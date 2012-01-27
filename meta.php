<div class="post-meta">
   <span class="meta-prep meta-prep-author"><?php _e('By ', WP_THEME_NAME); ?></span>
   <span class="author vcard">
   <a class="url fn n" href="<?php echo get_author_link( false, $authordata->ID, $authordata->user_nicename ); ?>" title="<?php printf( __( 'View all posts by %s', WP_THEME_NAME ), $authordata->display_name ); ?>"><?php the_author(); ?></a>
   </span>
   <span class="meta-sep"> | </span>
   <span class="meta-prep meta-prep-entry-date"><?php _e('Published ', WP_THEME_NAME); ?></span>
   <span class="entry-date">
   <abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr>
   </span>
 <?php edit_post_link( __( 'Edit', WP_THEME_NAME ), "<span class=\"meta-sep\">|</span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t" ) ?>
</div><!-- .entry-meta -->