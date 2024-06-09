<?php
include("include/database-connect.phtml");
include("include/include.phtml");
header_forms($admin,$seed);
if( isset($action) && strcmp($action,"finish")==0)
{    
	echo "<br>".$notes."<br>";
     // $notes = str_replace ( "&#1610;","&#1740;" , $notes );
     // $notes = str_replace ( "ظث" ,"", $notes );
	 //$notes = str_replace ( "&#1740", "ي", $notes );
	  //$notes=iconv('utf-8','windows-1256',$notes);
	  //echo $notes;
      $notes=str_replace("'"," ",$notes);
	  $notes=str_replace("\""," ",$notes);
	  $notes=str_replace(";"," ",$notes);
	  //$notes = str_replace ( "&#1740;" ,"&#1610;", $notes );
	   
	  $mydate=date("Y-m-d");
	  $startyear = substr($mydate,0,4);
	  $startmon = substr($mydate,5,2);
	  $startday = substr($mydate,8,2);
	  $send_date=hijricalender( $startyear , $startmon , $startday );
      $query="insert into karshenas_shora_tarh_note set  notes= '$notes',note_date='$send_date',cod_tarh='$cod_tarh',cod_karshenas='$cod_karshenas_shora'";
 	 // echo $query;
      $result=mysql_query($query) or die ("Error in updating data into user login 1");
      $query="select * from group_karshenasan,group_karshenasan_tarh where group_karshenasan.cod_karshenas=group_karshenasan_tarh.cod_karshenas and  cod_tarh='$cod_tarh' and group_karshenasan.karshenas_type='1'";
      $result123=mysql_query($query) or die("Error 120000");
      while($rf=mysql_fetch_array($result123))
      {
      	$sms_box=$rf["sms_box"];
      	$startdate =$mydate;
      	$startyear = substr($startdate,0,4);
      	$startmon = substr($startdate,5,2);
      	$startday = substr($startdate,8,2);
      	$send_date=hijricalender( $startyear , $startmon , $startday );
      		
      	
      		$sms_text="nazare ozve shora dar morede tarh ba code $cod_tarh  dar tarikh   $send_date  ersal shod";
      
      	$query="insert into input_sms set sms_from='ADMIN' ,sms_to='$sms_box' , sms_text='$sms_text'";
      	$result=mysql_query($query) or die("Error 120000");
      }
      $action="ارسال نظريه کارشناس شورا طرح براي طرح با شماره ".$cod_tarh;
      set_log($action,$admin,date("Y-d-m"));

}
?>

