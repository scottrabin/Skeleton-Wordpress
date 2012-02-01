<?php

$options[$id] = stripslashes($options[$id]);  
$options[$id] = esc_attr( $options[$id]);  
echo "<textarea class='regular-text$field_class' id='$id' name='swp_options[$id]'>{$options[$id]}</textarea>";  
echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";  
        
?>