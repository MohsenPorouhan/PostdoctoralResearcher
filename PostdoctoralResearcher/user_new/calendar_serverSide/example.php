

<?php
header('Content-Type: application/json');
$linklist=array();
$link=array();

for($i=1;$i<10;$i++){ 
 $link["tutorial"]="$i*2";
 $link["url"]= "$i*3";
 array_push($linklist,$link);
}
//print_R($linklist);
echo json_encode($linklist);
?>
