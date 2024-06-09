<?php
$output_arrays = array(array());
$a=array();
$a["title"]="hi";
$a["start"]="2014\10\08";
$output_arrays[0]=$a;

// Send JSON to the client.
echo json_encode($output_arrays);
?>