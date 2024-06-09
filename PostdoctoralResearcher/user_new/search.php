<?
include("include/database-connect.phtml");
include("include/include.phtml");
$term = trim($_GET['q']);
$query="select * from issn where p_issn like '$term%' order by journal_title  ";
$qresult=mysql_query($query) or die("Error in selecting data from daraje elmi");

$a_json = array();
$a_json_row = array();
while($row_fetched=mysql_fetch_array($qresult))
{
		$id=$row_fetched["issn_id"];
		$p_issn=		$row_fetched["p_issn"];																							  
  $a_json_row["value"] = $p_issn;
  $a_json_row["label"] = $p_issn;
  $a_json_row["id"] = $id;
  $a_json_row["journal_title"] = $row_fetched["journal_title"];
  $a_json_row["impact_factor"] = $row_fetched["impact_factor"];
  $a_json_row["top_index"] = $row_fetched["top_index"];
  
 array_push($a_json, $a_json_row);
}
$json = json_encode($a_json);
print $json;
																											    
?>