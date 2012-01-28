<?php

foreach( $choices as $value => $imgsrc ):

  print swp_generate_html(array(
								'tagName' => 'input',
								'type' => 'radio',
								'name' => "swp_options[${id}]",
								'id'   => esc_attr( "${id}_${value}" ),
								'value' => esc_attr( $value ),
								'checked' => ($options[$id] === $value ? 'checked' : false)
								));
/*
print swp_generate_html(array(
							  'tagName' => 'div',
							  'contents' => esc_html( $value )
							  ));
*/
print swp_generate_html(array(
							  'tagName' => 'img',
							  'src' => esc_url( $imgsrc ),
							  'class' => ($options[$id] === $value ? 'active' : '' ),
							  'alt' => $value,
							  'onclick' => sprintf("javascript:document.getElementById('%s').checked=true; jQuery(this).addClass('active').siblings().removeClass('active');",
												   esc_attr( "${id}_${value}" )
												   )
							  ));

endforeach;

?>