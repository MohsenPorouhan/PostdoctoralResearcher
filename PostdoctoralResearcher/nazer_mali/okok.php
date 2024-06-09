<?
include("include/database-connect.phtml");
 
  $query="select * from tarh  where tarh.  indoing='1'  and  finalized='0' ";
  $rs=mysql_query($query) or die("error 1");
  while($rf=mysql_fetch_array($rs))
  {
    $cod_tarh=$rf["cod_tarh"];
	$q="insert into tarh_position  set cod_tarh='$cod_tarh' , position='10',creator='admin'";
	$rss=mysql_query($q) or die("error 3");
  }