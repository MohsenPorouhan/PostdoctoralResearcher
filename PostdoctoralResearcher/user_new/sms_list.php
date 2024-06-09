<?php
include("include/database-connect.phtml");
include("include/include.phtml");
//include ("../sms/include/nusoap/nusoap.php");
include ("../sms/include/WebServiceSms.php");

if(isset($action))
{
	if(strcmp($action,"sms_list")==0)
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
	/*$aColumns = array(
	
	array( 'db' => 'cod_tarh', 'dt' => 'cod_tarh' ),
	array( 'db' => 'tarh_title_farsi', 'dt' => 'tarh_title_farsi' ),
	array( 'db' => 'daneshkade_name', 'dt' => 'daneshkade_name' ),
	array( 'db' => 'tarh_time', 'dt' => 'tarh_time' )

	
	);*/  //,'visited'
		
	$aColumns = array('massage_id','id','date','massage_text','subject','status','reciption_number');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "massage_id";
	
	/* DB table to use */
	$sTable = "magfa_sms";
	
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
	//$search=iconv('utf-8','windows-1256',$_GET['sSearch']);
	$search=$search; 
	if ( $_GET['sSearch'] != "" )
	{
		$sWhere = "and (";
			$sWhere .= " massage_text "." LIKE '%".mysql_real_escape_string( $search )."%' OR "." subject "." LIKE '%".mysql_real_escape_string( $search )."%' OR "." status "." LIKE '%".mysql_real_escape_string( $search )."%' OR "."reciption_number". " LIKE '%".mysql_real_escape_string( $search )."%'";

		$sWhere .= ')';
	}
	$sms_type=$_GET["sms_type"];
	if ( isset($sms_type))
	{
		if($sms_type=="-1")
			//$sWhere.="";
			$a=1;
		elseif(strcmp($sms_type,"1")==0){
			$sWhere .= "and (";
			$sWhere .= "status='1' and reciption_number='$mobile'";
			$sWhere .= ')';
		}
		elseif(strcmp($sms_type,"2")==0){
			$sWhere .= "and (";
			$sWhere .= "status='2' and reciption_number='$mobile'";;
			$sWhere .= ')';
		}
		elseif(strcmp($sms_type,"3")==0){
			$sWhere .= "and (";
			$sWhere .= "status='3' and reciption_number='$mobile'";;
			$sWhere .= ')';
		}
		elseif(strcmp($sms_type,"4")==0){
			$sWhere .= "and (";
			$sWhere .= "status='4' and reciption_number='$mobile'";;
			$sWhere .= ')';
		}
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
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable
		WHERE reciption_number='$mobile'
		$sWhere
		$sOrder
		$sLimit
	";
	//echo $sQuery;
	//$q=$sQuery;
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
		WHERE reciption_number='$mobile' 
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
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			//echo $aColumns[$i]["db"];
			//echo $aRow[ $aColumns[$i]["db"]];
			if ( strcmp($aColumns[$i],"status")==0 )
			{
				if($la=="en"){
					/* Special output formatting for 'version' column */
					if($aRow["status"]=="1")
						$status="waiting";
					else if($aRow["status"]=="2")
						$status="delivered";
					else if($aRow["status"]=="3")
						$status="did not delivered";
					else if($aRow["status"]=="4")
						$status="error";
				}else{
					if($aRow["status"]=="1")
						$status="در حال انتظار";
					else if($aRow["status"]=="2")
						$status="رسيده به گوشي";
					else if($aRow["status"]=="3")
						$status="نرسيده به گوشي";
					else if($aRow["status"]=="4")
						$status="کد خطا";
				}
			
				//$status  = str_replace ( "&#1740;" ,"&#1610;", $status );
				//$status = iconv('windows-1256', 'utf-8', $status);
				$row[$aColumns[$i]] = $status;
			
			}
			else if ( strcmp($aColumns[$i],"subject")==0 )
			{
				/* General output */
				$str=$aRow[$aColumns[$i]];
				//$str = str_replace ( "&#1740;" ,"&#1610;", $str );
				//echo $str;
				//$str = str_replace ( "&#1740;" ,"&#1610;", $str );
				//$str= iconv('windows-1256', 'utf-8', $str);
				//$str = str_replace ( "&#1610;" ,"&#1740;", $str );
				//$str = str_replace ( "&#1740;" ,"&#1610;", $str );
				$row[$aColumns[$i]] = $str;
			}
			else if ( $aColumns[$i] != ' ' )
			{
				/* General output */
				$str=$aRow[$aColumns[$i]];
				//$str = str_replace ( "&#1740;" ,"&#1610;", $str );
				//echo $str;
				//$str = str_replace ( "&#1740;" ,"&#1610;", $str );
			    //$str= iconv('windows-1256', 'utf-8', $str); 
				//$str = str_replace ( "&#1610;" ,"&#1740;", $str );
 				//$str = str_replace ( "&#1740;" ,"&#1610;", $str );
				$row[$aColumns[$i]] = $str;
			}
			//$reply= "<a class=\"btn reply_btn\" data-toggle=\"modal\" href=\"#basic\" ><i class=\"fa fa-reply\" ></i></a>";
			//$reply2= "<a class=\"btn reply_btn\" data-toggle=\"modal\" <span>---</span>";
		}

		$row['number_of_rows']=$cntr+1;
		$cntr++;
		//$row["edit"]=null;
		//$row["details"]=null;
		$row['DT_RowId']=$aRow[$aColumns["0"]];
// 		if((strcmp($visited,"0")==0) && (strcmp($from_letter,$admin)!=0))
// 			$row["DT_RowClass"] = "bold";
// 		if(strcmp($from_letter,$admin)==0)
// 			$row["edit"] = $reply2;
		$output['aaData'][] = $row;
		
	}
	
	echo json_encode( $output );
}
}
?>