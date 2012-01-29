<div class="post-utility clearfix">
<?php

   $utilities = array();

$categories = get_the_category_list(', ');
if( strlen($categories) > 0 ){
  $utilities[] = swp_generate_html( array(
										  'tagName' => 'span',
										  'class' => 'cat-links',
										  'contents' => __( 'Posted in ', WP_THEME_NAME ) . $categories
										  ));
}

$tags = get_the_tags();
if( is_array($tags) && sizeof($tags) > 0 ){
  foreach($tags as $index => $tag ){
	$tags[$index] = sprintf( '<a href="%s">%s</a>', get_tag_link( $tag->term_id ), $tag->name );
  }
  $utilities[] = swp_generate_html( array(
										  'tagName' => 'span',
										  'class' => 'tag-links',
										  'contents' => __('Tagged ', WP_THEME_NAME ) . implode( ', ', $tags )
										  ));
}

print implode('<span class="meta-sep"> | </span>', $utilities);
?>
<span class="comments-link"><span class="icon">d</span><?php comments_popup_link( '...', '1', '%', 'comments-num', 'X' ); ?></span>
</div><!-- .post-utility -->