<?php

$sidebar_position = swp_get_option('sidebar_position');
$content_position = ( $sidebar_position === 'left' ? 'right' : 'left' );

?>

#content{ float: <?php print $content_position; ?>; }
#sidebar{ float: <?php print $sidebar_position; ?>; }