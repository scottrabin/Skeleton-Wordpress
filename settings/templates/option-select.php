<?php

$opts = array();
foreach( $choices as $label => $value ){
  $opts[] = swp_generate_html( array(
									 'tagName' => 'option',
									 'value' => $value,
									 'contents' => $label,
									 'selected' => ($options[$id] === $value ? 'selected' : false )
									 ));
}

print swp_generate_html( array(
							   'tagName' => 'select',
							   'name' => "swp_options[${id}]",
							   'contents' => implode('', $opts)
							   ));

?>
