<?php 
include("include/database-connect.phtml");
include("include/include.phtml");
if(strcmp($action,"sabt") ==0 )
{
 $title=trim($subject);
 $q="select max(myorder) from activities where cod_tarh='$cod_tarh'  and version='-1'";
 $r=mysql_query($q) or die("server Error 1");
 echo mysql_error();
 if (mysql_num_rows($r)>0)
  {
   while($l=mysql_fetch_array($r))
   	$myorder=$l["max(myorder)"];
  }
 else
  $myorder=0;
 $myorder++;

 $q="insert into activities (cod_tarh,activity,start_mon,start_week,end_mon,end_week,myorder) values ('$cod_tarh','$act_title','$start_mon',$start_week,'$end_mon',$end_week,$myorder)";
 
 $r=mysql_query($q) or die("server Error");

  $action="ثبت زمانبندي طرح با کد"."<br>".$cod_tarh;
   
 set_log($action,$admin,date("Y-m-d, g:i a"));

 $action="gant_chart_data";

$query="select * from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='6'";
       $result=mysql_query($query) or die("Error in selecting data from  jadval zarayeb ");
       if ( mysql_num_rows($result) <= 0 )
       {
       $query="insert into tarh_exist_item set cod_tarh='$cod_tarh',item_id='6'";
       $result=mysql_query($query) or die("Error in selecting data from  jadval zarayeb ");
       //echo "exist";
       }
}//end of action==1
if(strcmp($action,"delete") ==0 )
{
   	$query="delete from activities where act_code ='$act_code'";
	//echo $query;
	$result=mysql_query($query) or die("Error in deleting data from activities");
	
	$action="حذف زمانبندي طرح با کد"."<br>".$cod_tarh;
   
    set_log($action,$admin,date("Y-m-d, g:i a"));
	$action="gant_chart_data";
	
	$query="select * from activities where   cod_tarh=\"$cod_tarh\"  and version='-1'";
    $result=mysql_query($query) or die("Error in selecting data from  activities ");
    if ( mysql_num_rows($result) <= 0 )
    {
    $query="delete from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='6'";
       $result=mysql_query($query) or die("Error in selecting data from  activities ");
      // echo "notexist";
    } 
}
if(strcmp($action,"edit") ==0 )
{
 $q="update activities set activity='$act_title', start_mon='$start_mon', start_week='$start_week', end_mon='$end_mon', end_week='$end_week' where act_code='$act_code'";
 $r=mysql_query($q) or die("server error2");
 $action="ويرايش زمانبندي طرح با کد"."<br>".$cod_tarh;
   
 set_log($action,$admin,date("Y-m-d, g:i a"));
	$action="gant_chart_data";
 
}
if(strcmp($action,"gant_chart_data") ==0 )
{
		$output = array(
				);
			
		  	$cntr=0;
		$q="select * from activities where cod_tarh='$cod_tarh'  and version='-1'";
		 $r=mysql_query($q) or die("server error2");
		 while ($l=mysql_fetch_array($r))
		  {
		  	$row = array();
		  	$row2 = array();
		   $activity=$l["activity"];
		   $myorder=$l["myorder"];
		   $act_code=$l["act_code"];
		   $start_mon=$l["start_mon"];
		   $start_week=$l["start_week"];
		   $end_mon=$l["end_mon"];
		   $end_week=$l["end_week"];
		   $end_by_week=($end_mon*4)-(4-$end_week);
		   $row[]=$cntr;;
		   $start_date=($start_mon-1)*4+($start_week-1);
		   $end_date=($end_mon-1)*4+$end_week;
		    $row2[0]=$end_date;
		   $row2[1]=$start_date;
		  
		   $cntr++;
		   //$activity= iconv('windows-1256', 'utf-8', $activity);
		   $output['activity'][] = $activity;
		   $output['date'][] = $row2;
		  }
		 
		  echo json_encode( $output );
}

if(strcmp($action,"select_list") ==0 )
{
			$aColumns = array( 'activity','start_mon','start_week','end_mon','end_week');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "act_code";
	
	/* DB table to use */
	$sTable = "activities";
	
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
	//$search=iconv('utf-8','windows-1256',($search)); 
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
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns)).",act_code
		FROM   $sTable
		WHERE  cod_tarh='$cod_tarh' and version='-1' 
		$sWhere
		$sOrder
		$sLimit
	";
	//echo $sQuery;
	$rResult = mysql_query( $sQuery) or die(mysql_error());
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	//echo $sQuery; 
	$rResultFilterTotal = mysql_query( $sQuery) or die(mysql_error());
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
		WHERE  cod_tarh='$cod_tarh' and version='-1' 
	";
	//echo $sQuery;
	$rResultTotal = mysql_query( $sQuery) or die(mysql_error());
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	
	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	$cntr=0;
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		$act_code=$aRow["act_code"];
		$activity=$aRow["activity"];
		$start_mon=$aRow["start_mon"];
		$start_week=$aRow["start_week"];
		$end_mon=$aRow["end_mon"];
		$end_week=$aRow["end_week"];
		$row = array();
		
		$row["act_code"]=$act_code;
		$row["activity"]=$activity;
		$row["start_mon"]=$start_mon;
		$row["start_week"]=$start_week;
		$row["end_mon"]=$end_mon;
		$row["end_week"]=$end_week;
		$start_date=($start_mon-1)*4+($start_week-1);
		$end_date=($end_mon-1)*4+$end_week;
	    $total_time_week=$end_date - $start_date;
	    $total_mon=(int)($total_time_week/4);
	    $total_week=(int)($total_time_week-$total_mon*4);
        //echo  $end_mon." ".$end_week." ".$start_date." ".$end_date." ".$total_time_week." ".$total_mon." ".$total_week."<br>";
	    if($la=="en"){
				if (($total_mon!=0) && ($total_week!=0))
					
				   $mon_time= " $total_mon  Month and  $total_week Week";
			     else
			     {
				  if ($total_mon!=0)
				    $mon_time="$total_mon Month";
				  if ($total_week!=0)
				    $mon_time="$total_week Week";
				 }
	     }
	     else{
		     	if (($total_mon!=0) && ($total_week!=0))
		     			
		     		$mon_time= " $total_mon  ماه و  $total_week هفته";
		     	else
		     	{
		     		if ($total_mon!=0)
		     			$mon_time="$total_mon ماه";
		     		if ($total_week!=0)
		     			$mon_time="$total_week هفته";
		     	}		
	     }
		 
		 //$mon_time= iconv('windows-1256', 'utf-8', $mon_time);
		 $row["mon_time"]=$mon_time;
		$edit= "<a class=\"edit_buttun\" id=\"edit_buttun\" data-toggle=\"modal\" href=\"#basic\" ><i class=\"fa fa-edit\" ></i></a>";
		$delete= "<a class=\"delete_buttun\" id=\"delete_buttun\" data-toggle=\"modal\" href=\"#delete\" ><i class=\"fa fa-trash-o\" ></i></a>";
		
		$cntr++;
		$row["edit"]=$edit;
		
		$row["delete"]=$delete;
		
		$row['DT_RowId']=$cod_zarib;
		$output['aaData'][] = $row;
		
	}
	
	echo json_encode( $output );
	
}
?>