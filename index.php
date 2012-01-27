<?php get_header(); ?>

<div id="content" class="thirteen columns">

   <?php /* Top post navigation */ ?>
   <?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
      <div id="nav-above" class="navigation">
         <div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&laquo;</span> Older posts', WP_THEME_NAME )) ?></div>
         <div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&raquo;</span>', WP_THEME_NAME )) ?></div>
      </div><!-- #nav-above -->
   <?php } ?>
   <?php /* END Top post navigation */ ?>

   <?php /* Page content generation */ ?>
   <?php while ( have_posts() ) : the_post() ?>

   <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', WP_THEME_NAME ), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

	  <div class="entry-meta">
         <span class="meta-prep meta-prep-author"><?php _e('By ', WP_THEME_NAME); ?></span>
		 <span class="author vcard"><a class="url fn n" href="<?php echo get_author_link( false, $authordata->ID, $authordata->user_nicename ); ?>" title="<?php printf( __( 'View all posts by %s', WP_THEME_NAME ), $authordata->display_name ); ?>"><?php the_author(); ?></a></span>
		 <span class="meta-sep"> | </span>
         <span class="meta-prep meta-prep-entry-date"><?php _e('Published ', WP_THEME_NAME); ?></span>
		 <span class="entry-date"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr></span>
                        <?php edit_post_link( __( 'Edit', WP_THEME_NAME ), "<span class=\"meta-sep\">|</span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t" ) ?>
      </div><!-- .entry-meta -->

	  <div class="entry-content">
         <?php the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', WP_THEME_NAME ) ); ?>
         <?php wp_link_pages( 'before=<div class="page-link">' . __( 'Pages:', WP_THEME_NAME ) . '&after=</div>' ); ?>
      </div><!-- .entry-content -->

      <div class="entry-utility">
         <span class="cat-links">
            <span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( 'Posted in ', WP_THEME_NAME ); ?></span>
            <?php echo get_the_category_list(', '); ?>
         </span>
		 <span class="meta-sep"> | </span>
         <?php the_tags( '<span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links">' . __('Tagged ', WP_THEME_NAME ) . '</span>', ", ", "</span>\n\t\t\t\t\t\t<span class=\"meta-sep\">|</span>\n" ) ?>
         <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', WP_THEME_NAME ), __( '1 Comment', WP_THEME_NAME ), __( '% Comments', WP_THEME_NAME ) ) ?></span>
         <?php edit_post_link( __( 'Edit', 'your-theme' ), "<span class=\"meta-sep\">|</span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t\n" ) ?>
      </div><!-- #entry-utility -->

   </div><!-- #post-<?php the_ID(); ?> -->

   <?php endwhile; ?>
   <?php /* END Page content generation */ ?>

   <?php /* Bottom post navigation */ ?>
   <?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
      <div id="nav-below" class="navigation">
         <div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&laquo;</span> Older posts', WP_THEME_NAME )) ?></div>
	     <div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&raquo;</span>', WP_THEME_NAME )) ?></div>
	  </div><!-- #nav-below -->
   <?php } ?>
   <?php /* END Bottom post navigation */ ?>

</div><!-- content -->
<?php get_sidebar(); ?>

<?php get_footer(); ?>