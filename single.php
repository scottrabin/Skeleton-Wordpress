<?php get_header(); ?>
 
      <div id="content" class="post-single <?php print swp_column_width('main'); ?> columns">
 
		 <?php /*swp_post_navigation_above();*/ ?>

	  <?php the_post(); ?>

	  <?php swp_post_begin(); ?>
	  <?php get_template_part( 'title', 'single' ); ?>
	  <?php get_template_part( 'post-utility', 'single' ); ?>
	  <?php get_template_part( 'post-content', 'single' ); ?>
	  <?php swp_post_end(); ?>
 
	  <?php swp_post_navigation_below(); ?>
 
	  <?php comments_template( '', true ); ?>

      </div><!-- #content -->
 
<?php get_sidebar(); ?>
<?php get_footer(); ?>