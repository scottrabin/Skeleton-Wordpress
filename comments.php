<?php if( comments_open() ): ?>
<a href="#respond" rel="nofollow" title="Leave a comment">Leave a comment</a> | 
   <?php endif; ?>

   <span><?php printf( _n( '%s response', '%s responses', get_comments_number() ), number_format_i18n( get_comments_number() ) ); ?></span>

 <?php if( comments_open() ): ?>
<a href="<?php print comments_rss(); ?>" class="icon align-right theme-color-hover" type="application/rss+xml" rel="alternate" title="Comments RSS for <?php the_title_attribute(); ?>">B</a>
   <?php endif; ?>

<?php if ( have_comments() ) : ?>
	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>

	<ol class="commentlist">
	<?php wp_list_comments('callback=swp_comment_template&avatar_size=48');?>
	</ol>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
	   <?php //<!-- If comments are open, but there are no comments. --> ?>

	 <?php else : // comments are closed ?>
	   <?php // <!-- If comments are closed. -->?>
		<p class="nocomments"><?php _e('Comments are closed.'); ?></p>

	<?php endif; ?>
<?php endif; ?>
<?php if ( comments_open() ) : ?>

<?php /* comment replies */ wp_enqueue_script( 'comment-reply' ); ?>
 <?php

$comment_form_options = array( 'comment_notes_before' => '',
							   'comment_notes_after' => '');


 comment_form( $comment_form_options );
 ?>

<?php endif; ?>