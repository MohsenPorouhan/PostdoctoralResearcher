<?php
include("include/database-connect.phtml");
include("include/include.phtml");


$query="select * from modir_daneshkade where  modir_username = '$admin'";
$result=mysql_query($query);
$row_fetched=mysql_fetch_array($result);
$cod_daneshkade=$row_fetched["cod_daneshkade"];
//echo $query;
$query="select * from letter_to_mojri where  id='$id'";
//echo $query;

$result=mysql_query($query) or die("Error in selecting data from tarh");

 
 if(mysql_num_rows($result) > 0)
 {
   $row_fetched=mysql_fetch_array($result);
   $body_letter=$row_fetched["letter_body"];
   $from_letter=$row_fetched["from_letter"];
   $subject=$row_fetched["letter_subject"];
   if(strcmp($from_letter,$admin)!=0)
   {
     $query="update letter_to_mojri set visited='1' where id='$id'";
     $result=mysql_query($query) or die("Error in selecting data from letter_to_mojri");
     //echo $query;
   }
     
  }
  echo "<div class=\"row\"><div class=\"well well-sm\" style=\"margin:0 10px;height: 140px;\"><div class=\"col-md-12 pull-left\"><p>$body_letter</p></div></div></div>"
  
  ?>