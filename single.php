<?php get_header(); ?>
 
   <div id="container">
      <div id="content">
 
	  <?php swp_post_navigation_above(); ?>

	  <?php the_post(); ?>

	  <?php swp_post_begin(); ?>
	  <?php get_template_part( 'title', 'single' ); ?>
	  <?php get_template_part( 'post-utility', 'single' ); ?>
	  <?php get_template_part( 'post-content', 'single' ); ?>
	  <?php swp_post_end(); ?>
 
	  <?php swp_post_navigation_below(); ?>
 
	  <?php comments_template( '', true ); ?>

      </div><!-- #content -->
   </div><!-- #container -->
 
<?php get_sidebar(); ?>
<?php get_footer(); ?>