<?php
session_start();
header('Content-Type: application/json');
include("../include/database-connect.phtml");
//--------------------------------------------------------------------------------------------------
// This script reads event data from a JSON file and outputs those events which are within the range
// supplied by the "start" and "end" GET parameters.
//
// An optional "timezone" GET parameter will force all ISO8601 date stings to a given timezone.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------

// Require our Event class and datetime utilities
include("utils.php");

// Short-circuit if the client did not give us a date range.
if (!isset($_GET['start']) || !isset($_GET['end'])) {
	die("Please provide a date range.");
}

// Parse the start/end parameters.
// These are assumed to be ISO8601 strings with no time nor timezone, like "2013-12-29".
// Since no timezone will be present, they will parsed as UTC.
//echo date("Y-m-d",$_GET['start']);
$range_start = parseDateTime(date("Y-m-d",$_GET['start']));
//echo $range_start."<br>";
//echo $_GET['end'];
$range_end = parseDateTime(date("Y-m-d",$_GET['end']));
//echo "hi";
// Parse the timezone parameter if it is present.
$timezone = null;
if (isset($_GET['timezone'])) {
	$timezone = new DateTimeZone($_GET['timezone']);
}

// Read and parse our events JSON file into an array of event data arrays.

//$json = file_get_contents(dirname(__FILE__) . '/../json/events.json');
//$json=include("example.php");
$linklist=array();

 $admin=$_SESSION["admin"];

 $query="select date_gozaresh,gozaresh_gharardad.cod_tarh from gozaresh_gharardad,tarh where tarh.cod_tarh=gozaresh_gharardad.cod_tarh and tarh.creator='$admin' and tarh.version='-1'";
// echo $query;
 $result=mysql_query($query) or die("server error2");
 while ($row_fetch=mysql_fetch_array($result))
 {
 	$link=array();
 	$cod_tarh=$row_fetch["cod_tarh"];
 	$date_gozaresh=$row_fetch["date_gozaresh"];
 	$startyear = substr($date_gozaresh,0,4);
    $startmon = substr($date_gozaresh,5,2);
    $startday = substr($date_gozaresh,8,2);
    
    $g_date=array();
   
    $g_date=jalali_to_gregorian($startyear,$startmon,$startday);
    
    $start_date=$g_date[0]."-".$g_date[1]."-".$g_date[2];
    
    if($la=="en")
    	$message="Send of time reports. research: ";
    else 
    	$message="زمان ارسال گزارش طرح";
    
    $str=$message.$cod_tarh;
    //$str= iconv('windows-1256', 'utf-8', $str);
    $link["title"]=$str;
	$link["start"]= $start_date;
	$link["url"]= "send_report.phtml?cod_tarh=$cod_tarh";
	array_push($linklist,$link);
	
 }
	
 $query="select * from karshenasan,karshenasan_tarh where karshenas_email='$admin' and karshenasan.cod_karshenas=karshenasan_tarh.cod_karshenas group by cod_tarh";
 $result=mysql_query($query) or die("server error2");
 while ($row_fetch=mysql_fetch_array($result))
 {
 	
 	$cod_tarh=$row_fetch["cod_tarh"];
 	$cod_karshenas=$row_fetch["cod_karshenas"];
 	$date_gozaresh=$row_fetch["send_to_karshenas_date"];
 	//$date_gozaresh=date('Y-m-d', strtotime($date_gozaresh. ' + 1 day'));
 	$q="select * from karshenasan_tarh_note where cod_karshenas='$cod_karshenas' and cod_tarh='$cod_tarh'";
 	$re=mysql_query($q) or die("server error2");
 	if(mysql_num_rows($re)<=0 && strlen($date_gozaresh)>0){
 		$link=array();
	 	
 		if($la=="en")
 			$message="The completion of judgment time. research: ";
 		else
 			$message="زمان ارسال طرح به محيط داوري ";
 		
	 	$str="زمان ارسال طرح با کد ".$cod_tarh."به محيط داوري";
	    //$str= iconv('windows-1256', 'utf-8', $str);
	    $link["title"]=$str;
		$link["start"]= $date_gozaresh;
		$link["url"]= "";
		$link["backgroundColor"]= "red";
		array_push($linklist,$link);
 	}
 	
 }
//echo "hi";

//print_R($linklist);
$json= json_encode($linklist);
//echo "print: ".$json;
/*$json=[
  {
    "title": "All Day Event",
    "start": "2014-09-01"
  },
  {
    "title": "Long Event",
    "start": "2014-09-07",
    "end": "2014-09-10"
  },
  {
    "id": "999",
    "title": "Repeating Event",
    "start": "2014-09-09T16:00:00-05:00"
  },
  {
    "id": "999",
    "title": "Repeating Event",
    "start": "2014-09-16T16:00:00-05:00"
  },
  {
    "title": "Conference",
    "start": "2014-09-11",
    "end": "2014-09-13"
  },
  {
    "title": "Meeting",
    "start": "2014-09-12T10:30:00-05:00",
    "end": "2014-09-12T12:30:00-05:00"
  },
  {
    "title": "Lunch",
    "start": "2014-09-12T12:00:00-05:00"
  },
  {
    "title": "Meeting",
    "start": "2014-09-12T14:30:00-05:00"
  },
  {
    "title": "Happy Hour",
    "start": "2014-09-12T17:30:00-05:00"
  },
  {
    "title": "Dinner",
    "start": "2014-09-12T20:00:00"
  },
  {
    "title": "Birthday Party",
    "start": "2014-09-13T07:00:00-05:00"
  },
  {
    "title": "Click for Google",
    "url": "http://google.com/",
    "start": "2014-09-28"
  }
];
echo $json;*/
$input_arrays = json_decode($json, true);
//echo "input :".$input_arrays;
// Accumulate an output array of event data arrays.
$output_arrays = array();
foreach ($input_arrays as $array) {

	// Convert the input array into a useful Event object
	$event = new Event($array, $timezone);
//echo "hi";
	// If the event is in-bounds, add it to the output
	//if ($event->isWithinDayRange($range_start, $range_end)) {
		$output_arrays[] = $event->toArray();
	//}
}
//print_R($output_arrays);
// Send JSON to the client.
echo json_encode($output_arrays);