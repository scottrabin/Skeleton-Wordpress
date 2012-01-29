<div class="post-utility">
   <span class="cat-links">
   <span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( 'Posted in ', WP_THEME_NAME ); ?></span>
 <?php echo get_the_category_list(', '); ?>
   </span>
   <span class="meta-sep"> | </span>
   <?php the_tags( '<span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links">' . __('Tagged ', WP_THEME_NAME ) . '</span>', ", ", "</span>\n\t\t\t\t\t\t<span class=\"meta-sep\">|</span>\n" ) ?>
   <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', WP_THEME_NAME ), __( '1 Comment', WP_THEME_NAME ), __( '% Comments', WP_THEME_NAME ) ) ?></span>
</div><!-- .post-utility -->