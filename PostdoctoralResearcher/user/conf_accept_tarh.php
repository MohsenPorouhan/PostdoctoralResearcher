<?
include("include/database-connect.phtml");
include("include/include.phtml");
include("include/vars.inc.phtml");

$sabttarh=$_GET['value'];
$cod_tarh=$_GET['codetarh'];
 $query="UPDATE tarh  SET accepttarh='".$sabttarh."' where cod_tarh='".$cod_tarh."'";

 $result=mysql_query($query) or die("Error in selecting");

if ($result)
{
		echo 'تاييد شد';
		
	}
  
?>