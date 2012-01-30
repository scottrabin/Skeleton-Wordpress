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


$num_comments = get_comments_number();
$is_link = comments_open() || pings_open() || ($num_comments > 0);
$comments_link = swp_generate_html(array(
										 'tagName' => $is_link ? 'a' : 'span',
										 'class' => 'icon' . ($is_link ? ' theme-color-hover' : ''),
										 'href' => get_comments_link(),
										 'contents' => 'd' . swp_generate_html( array('tagName' => 'span',
																				'class' => 'comments-num',
																				'contents' => $is_link ? ($num_comments > 0 ? $num_comments : '...') : 'X'
																				))
										 ));
?>
<span class="comments-link"><?php print $comments_link; ?></span>
</div><!-- .post-utility -->