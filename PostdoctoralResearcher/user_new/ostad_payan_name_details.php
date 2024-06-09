<?php
include("include/database-connect.phtml");
include("include/include.phtml");
if($la=="en"){
	$letter_title="Letters";
	$convert_tarh_title="Convert Thesis to Tarh";
	$versions_title="Versions of Tarh";
	$print_title="Print";
}else{
	$letter_title="نامه ها";
	$convert_tarh_title="تبديل پايان نامه به طرح";
	$versions_title="ويرايش هاي طرح";
	$print_title="پرينت";
}
echo "<div style=''>";
$letter= "<a style=\"margin-left:2em;\" onclick=\"letter_to_mojri_body('$cod_tarh');\" ><i title=\"$letter_title\" class=\"fa fa-envelope\" ></i></a>";
echo $letter;

$change= "<a style=\"margin-left:2em;\" onclick=\"create_tarh('$cod_tarh');\" ><i title=\"$convert_tarh_title\" class=\"fa fa-exchange\" ></i></a>";
echo $change;

$versions= "<a style=\"margin-left:2em;\" onclick=\"versions('$cod_tarh');\" ><i title=\"$versions_title\" class=\"fa fa-edit\" ></i></a>";
echo $versions;

$print= "<a target=\"_blank\" href=\"print_tarh.phtml?cod_tarh=$cod_tarh\" style=\"margin-left:2em;\"><i title=\"$print_title\" class=\"glyphicon glyphicon-print\" ></i></a>";
echo $print;

echo "</div>";
?> 
 