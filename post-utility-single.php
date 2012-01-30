<div class="post-utility">
   <?php printf( __( 'This entry was posted in %1$s%2$s.', WP_THEME_NAME ),
   get_the_category_list(', '),
   get_the_tag_list( __( ' and tagged ', WP_THEME_NAME ), ', ', '' )
   ); ?>

 <?php swp_post_comments_and_trackbacks(); ?>
</div><!-- .post-utility -->