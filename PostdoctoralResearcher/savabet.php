<?php 
include("include/include.phtml");
include("include/database-connect.phtml");

$output = array(
				);
$query="select * from daneshkade where is_daneshkade='1' order by daneshkade_name";
$qresult=mysql_query($query) or die("Error in selecting data from daraje elmi");
while($row_fetched=mysql_fetch_array($qresult))
{
	
	$row = array();
	$row["value"]=$row_fetched["cod_daneshkade"];
	if($la=="en")
	{
		$row["key"]=$row_fetched["daneshkade_english_name"];
	}
	else {
		$row["key"]=$row_fetched["daneshkade_name"];	
	}
	$output['student_daneshkade'][] = $row;
	
}
$query="select * from daneshkade order by daneshkade_name";
$qresult=mysql_query($query) or die("Error in selecting data from daraje elmi");
while($row_fetched=mysql_fetch_array($qresult))
{
	$row = array();
	$row["value"]=$row_fetched["cod_daneshkade"];
	if($la=="en")
	{
		$row["key"]=$row_fetched["daneshkade_english_name"];
	}
	else {
		$row["key"]= $row_fetched["daneshkade_name"];	
	}
	$output['daneshkade'][] = $row;
	
}
$query="select * from darajeelmi";
$qresult=mysql_query($query) or die("Error in selecting data from daraje elmi");
while($row_fetched=mysql_fetch_array($qresult))
{
	$row = array();
	$row["value"]=$row_fetched["darajeelmi"];
	if($la=="en")
	{
		$row["key"]=$row_fetched["darajeelmi_english_desc"];
	}
	else {
		$row["key"]=$row_fetched["darajeelmi_desc"];	
	}
	$output['daraje_elmi'][] = $row;
	
}
echo json_encode( $output );

?>