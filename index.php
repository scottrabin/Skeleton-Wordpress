<?php get_header(); ?>

<div id="content" class="<?php print swp_column_width('main'); ?> columns">

   <?php swp_post_navigation_above(); ?>

   <?php /* Page content generation */ ?>
   <?php while ( have_posts() ) : the_post() ?>

   <?php swp_post_begin(); ?>

   <?php get_template_part( 'title' ); ?>
   <?php get_template_part( 'meta' ); ?>
   <?php get_template_part( 'post-content' ); ?>
   <?php get_template_part( 'post-utility' ); ?>

   <?php swp_post_end(); ?>
   <?php endwhile; ?>
   <?php /* END Page content generation */ ?>

   <?php swp_post_navigation_below(); ?>

</div><!-- #content -->
<?php get_sidebar(); ?>

<?php get_footer(); ?>