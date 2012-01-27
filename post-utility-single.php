<div class="post-utility">
   <?php printf( __( 'This entry was posted in %1$s%2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>. Follow any comments here with the <a href="%5$s" title="Comments RSS to %4$s" rel="alternate" type="application/rss+xml">RSS feed for this post</a>.', WP_THEME_NAME ),
   get_the_category_list(', '),
   get_the_tag_list( __( ' and tagged ', WP_THEME_NAME ), ', ', '' ),
   get_permalink(),
   the_title_attribute('echo=0'),
   comments_rss() ); ?>

 <?php swp_post_comments_and_trackbacks(); ?>
</div><!-- .post-utility -->