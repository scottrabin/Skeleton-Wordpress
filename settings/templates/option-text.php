<?php

$options[$id] = stripslashes($options[$id]);  
$options[$id] = esc_attr( $options[$id]);  
echo "<input class='regular-text$field_class' type='text' id='$id' name='swp_options[$id]' value='$options[$id]' />";  
echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";  
        
?>