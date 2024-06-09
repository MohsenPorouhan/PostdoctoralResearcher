<?php
include("include/database-connect.phtml");
include("include/include.phtml");
 $admin_edit=0;
  $query="select * from tarh where cod_tarh='$cod_tarh'  and version='-1'";
  $result=mysql_query($query) or die("Error in selecting data from karshenas elmi ");
  $row_fetched=mysql_fetch_array($result);
  $tarh_name = $row_fetched["tarh_title_farsi"];
$finished=$row_fetched["finished"]; 
   $first_letter=$row_fetched["first_letter"];

if(strcmp($first_letter,'1')==0)
{
	$admin_edit=1;
}  
   
$query="select * from modir_daneshkade where    modir_username='$admin' and (modir_type='1' or modir_type='4')   ";
$result=mysql_query($query) or die("Error");
if(mysql_num_rows($result) >0)
{
	$admin_edit=1;
}




$query="select * from modir_daneshkade,tarh where   ( modir_username='$admin' and tarh.cod_daneshkade=modir_daneshkade.cod_daneshkade )";
$result=mysql_query($query) or die("Error");
if(mysql_num_rows($result) >0)
{
	$admin_edit=1;
}

 
 
 
  $query="select * from tarh where cod_tarh='$cod_tarh'  and version='-1'";
  $result=mysql_query($query) or die("Error in selecting data from karshenas elmi ");
  $row_fetched=mysql_fetch_array($result);
  $tarh_name = $row_fetched["tarh_title_farsi"];
$finished=$row_fetched["finished"];
 
if($admin_edit==0)
if(strcmp($finished,'0')==0)
{
 $query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='14'";
 $result=mysql_query($query) or die("Error");
 if(mysql_num_rows($result) <=0 )
  {
  	 
  	 message_show("اين قسمت از طرح در حالت قفل مي باشد","red");
     footer_forms($admin,$seed);
     
     exit();
  	 
  }	
}
else
{
	 message_show("اين قسمت از طرح در حالت قفل مي باشد","red");
     footer_forms($admin,$seed);
     
     exit();
	
}



if(isset($action))
{
  if (strcmp($action,"sabt")==0)
  {
  
  
  
	 $file_cnt=0;
     $dir_name="../attachments/".$cod_tarh;
     if ($dir = @opendir($dir_name))
     {
     
     $mydir = dir($dir_name);
     //while(($file = $mydir->read()) !== false)
     while($file = $mydir->read())
	   if( !(strcmp(trim($file),".")==0 || strcmp(trim($file),"..")==0) )
	    $file_cnt++;
      closedir($dir);
     
	 }

  
  
  
	 // -1    bad file size
	 // -2    bad extention
	 // -3    bad file size
	 // -4    can not upload
	 // -5    directory exists
	 // -6    file exists
	 // $ext  extion of uploaded file
	 // global $userfile,$userfile_name,$userfile_size,$userfile_type,$archive_type,$archive_dir,$WINDIR;
	 // 10  file uploaded
  
  
  
	 if($file_cnt < 12)
	 {
       $status_upload=upload_file("../attachments",$cod_tarh,"");
       if(!strcmp($status_upload,"-5") == 0 and !strcmp($status_upload,"-2") == 0 )
       {
	    // $status="upload_error";
	     $action="ضميمه ثبت شد"."<br>".$cod_tarh;
         set_log($action,$admin,date("Y-m-d, g:i a"));
         
              $query="select * from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='14'";
				
		       $result=mysql_query($query) or die("Error in selecting data from  mojri_tarh ");
		       if ( mysql_num_rows($result) <= 0 )
		       {
		      		$query="insert into tarh_exist_item set cod_tarh='$cod_tarh',item_id='14'";
		       		$result=mysql_query($query) or die("Error in selecting data from  mojri_tarh ");
		       		
		       }
		       echo "true";
       }
       else
       echo $status_upload;
      /* else if (strcmp($status_upload,"-5") == 0)
       {
       	echo "-5";
       }
       else if (strcmp($status_upload,"-2") == 0)
       {
       	echo "-2";
       }*/
	 }
	 else 
	 {
	 	echo "false";
	 }
     
  }
  
   if (strcmp($action,"delete")==0)
  {  
    delete_file("../attachments",$cod_tarh,$delete_id);
     $action="ضميمه حذف شد"."<br>".$cod_tarh;
           set_log($action,$admin,date("Y-m-d, g:i a"));
           $dir_name="../attachments/".$cod_tarh;
		if ($dir = @opendir($dir_name))
		{
			$mydir = dir($dir_name);
			
 		    if($mydir->read())
 		    {
 		    	echo "ضميمه حذف شد";
 		    }else 
 		    {
 		    	$query="delete from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='14'";
	       		$result=mysql_query($query) or die("Error in delete data from  hazine_personnel ");
	       		echo "123";
 		    }
		}
           
           
  }

if(strcmp($action,"select")==0)
{
/*
 * Script:    DataTables server-side script for PHP and MySQL
* Copyright: 2010 - Allan Jardine
* License:   GPL v2 or BSD (3-point)
*/

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
*/

/* Array of database columns which should be read and sent back to DataTables. Use a space where
 * you want to insert a non-database field (for example a counter or static image)
*/
//$aColumns = array('file');
//$aColumns = array("name", 'family', 'activity_type','persons','degree','majmoa_saat','per_hour','takhasos');

/* Indexed column (used for fast and accurate table cardinality) */
//$sIndexColumn = "file";

/* DB table to use */
//$sTable = "hazine_personnel";

/* Database connection information */



/*
 * Paging
*/
$sLimit = "";
if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
{
	$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
			mysql_real_escape_string( $_GET['iDisplayLength'] );
}


/*
 * Ordering
*/
if ( isset( $_GET['iSortCol_0'] ) )
{
	$sOrder = "ORDER BY  ";
	for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
	{
		if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
		{
			$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
		}
	}

	$sOrder = substr_replace( $sOrder, "", -2 );
	if ( $sOrder == "ORDER BY" )
	{
		$sOrder = "";
	}
}


/*
 * Filtering
* NOTE this does not match the built-in DataTables filtering which does it
* word by word on any field. It's possible to do here, but concerned about efficiency
* on very large tables, and MySQL's regex functionality is very limited
*/
$sWhere = "";
$search=$_GET['sSearch'];
$search= $search;
if ( $_GET['sSearch'] != "" )
{
	$sWhere = "and (";
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $search )."%' OR ";
	}
	$sWhere = substr_replace( $sWhere, "", -3 );
	$sWhere .= ')';
}
$search=$_GET[""];
/*	if ( isset($search))
 {
if($search=="-1")
	//$sWhere.="";
$a=1;
else{
$sWhere .= "and (";
		$sWhere .= "cod_hazine='$search'";
		$sWhere .= ')';
}
}*/
/* Individual column filtering */
for ( $i=0 ; $i<count($aColumns) ; $i++ )
{
	if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
	{
			
		$sWhere .= " AND ";
			
		$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
	}
}


/*
 * SQL queries
* Get data to display
*/
/*$sQuery="
	SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
	FROM   $sTable
	WHERE  cod_tarh='$cod_tarh' and version='-1'
	$sWhere
	$sOrder
	$sLimit
	";

$rResult=mysql_query($sQuery) or die(mysql_error());*/


/* Data set length after filtering */
 //$sQuery = "
 //SELECT FOUND_ROWS()
//	";
	//echo $sQuery;
//$rResultFilterTotal = mysql_query( $sQuery) or die(mysql_error());
//$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
//$iFilteredTotal = $aResultFilterTotal[0];

/* Total data set length */
//$sQuery = "
//SELECT COUNT(".$sIndexColumn.")
//FROM   $sTable
//WHERE  cod_tarh='$cod_tarh'  and version='-1'
//";
//echo $sQuery;
//$rResultTotal = mysql_query( $sQuery) or die(mysql_error());
//$aResultTotal = mysql_fetch_array($rResultTotal);
//$iTotal = $aResultTotal[0];


/*
* Output
*/
$output = array(
 "sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
 		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
 );
		$mycount=0;
		$dir_name="../attachments/".$cod_tarh;
		if ($dir = @opendir($dir_name))
		{
			$mydir = dir($dir_name);
 		    while ($file = $mydir->read())
 		    {
 		    	if( !(strcmp(trim($file),".")==0 || strcmp(trim($file),"..")==0 || strcmp(trim($file),"Thumbs.db")==0) )
 		    	{
 		$row = array();
 		$row["file"]="<a href=\"../attachments/$cod_tarh/$file\">".$file."</a>";
 		$row["delete_id"]=$file;
 		// Special output formatting for 'version' column
 			


 		//$edit="<a class=\"edit_btn\" data-toggle=\"modal\" href=\"#basic\" ><img border=\"0\" src=\"image/button_edit.png\" alt=\"Edit\" ></a>";
 		$delete= "<a class=\"btn delete_btn\" id=\"delete_buttun\" data-toggle=\"modal\" href=\"#delete\" ><i class=\"fa fa-trash-o\" ></i></a>";
 			
 		//	$row["ss"]=$edit;

 		$cntr++;
 		//$row["edit"]=$edit;
 		$row["delete"]=$delete;
 		$output['aaData'][] = $row;
 		//echo $row[1];
 		    	}
			}
		closedir($dir);
		}

echo json_encode( $output );
}
}
?>