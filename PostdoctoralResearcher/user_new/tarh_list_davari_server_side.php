<?php

include("include/database-connect.phtml");
include("include/include.phtml");
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

	
	);*/
if(isset($action))
{
if(strcmp($action, "list")==0){
	if($la=="en")
	{
		$uni="daneshkade_english_name";
	}
	else 
		$uni="daneshkade_name";
	$aColumns = array( 'tarh.cod_tarh','tarh_title_farsi','tarh_time','send_comment','gozaresh_nezarat');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "tarh.cod_tarh";
	
	/* DB table to use */
	$sTable = "tarh,karshenasan_tarh";
	
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
	
	//$search = str_replace ( "&#1610;" ,"&#1740;", $search );
	//$search = str_replace ( "&#1610" ,"&#1740", $search );
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
	$position=$_GET["position"];
	if ( isset($position))
	{
		if($position=="-1")
			//$sWhere.="";
			$a=1;
		elseif(strcmp($position,"0")==0){
			$sWhere .= "and (";
			$sWhere .= "tarh_new='1'";
			$sWhere .= ')';
		}
	elseif(strcmp($position,"1")==0){
			$sWhere .= "and (";
			$sWhere .= "tarh_new='0' and karshenasan_tarh.finished='0'";
			$sWhere .= ')';
		}
	elseif(strcmp($position,"2")==0){
			$sWhere .= "and (";
			$sWhere .= "tarh_new='0' and karshenasan_tarh.finished='1'";
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
		WHERE    tarh.cod_tarh=karshenasan_tarh.cod_tarh and karshenasan_tarh.cod_karshenas = '$cod_karshenas'  and tarh.version='-1' and karshenasan_tarh.karshenasi_type='$karshenasi_type'
		$sWhere
		group by tarh.cod_tarh
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
		WHERE   tarh.cod_tarh=karshenasan_tarh.cod_tarh and karshenasan_tarh.cod_karshenas = '$cod_karshenas'  and tarh.version='-1' and karshenasan_tarh.karshenasi_type='$karshenasi_type'
		group by tarh.cod_tarh
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
			if ( $aColumns[$i] == "tarh_time" )
			{
				/* Special output formatting for 'version' column */
				  $startdate = $aRow[ $aColumns[$i]];
				  $startyear = substr($startdate,0,4);
				  $startmon = substr($startdate,5,2);
				  $startday = substr($startdate,8,2);
				  $farsistartdate=hijricalender( $startyear , $startmon , $startday );
				  $farsistartdate = enum2fnum($farsistartdate);
				  $row[$aColumns[$i]] = $farsistartdate;
			}
			else if ( $aColumns[$i] == 'tarh.cod_tarh' )
			{
				$str=$aRow["cod_tarh"];
				$row["cod_tarh"] = $str;
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
					
		}
				
		
		
		$cntr++;
		//$row["edit"]=$edit;
		$row["ss"]=null;
		$row['DT_RowId']=$aRow["cod_tarh"];;
		$output['aaData'][] = $row;
		
	}
	
	echo json_encode( $output );
}
}
?>