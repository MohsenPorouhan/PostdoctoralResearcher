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

	if($la=="en")
	{
		$uni="daneshkade_english_name";
	}
	else 
		$uni="daneshkade_name";
	$aColumns = array( 'tarh.cod_tarh','tarh_title_farsi','tarh_time','daneshkade_name','user_login.name','user_login.family');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "tarh.cod_tarh";
	
	/* DB table to use */
	$sTable = "tarh,karshenas_shora_tarh,user_login,daneshkade";
	
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
	$tarh_year=$_GET['tarh_year'];
	
	//$search = str_replace ( "&#1610;" ,"&#1740;", $search );
	//$search = str_replace ( "&#1610" ,"&#1740", $search );
	//$search=iconv('utf-8','windows-1256',($search));
	//$tarh_year=iconv('utf-8','windows-1256',($tarh_year)); 

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
	$cod_daneshkade_ozviat=$_GET["cod_daneshkade_ozviat"];
	if ( isset($cod_daneshkade_ozviat))
	{
		if($cod_daneshkade_ozviat!="-1")
			$cod_daneshkade_ozviat_sql="tarh.cod_daneshkade='$cod_daneshkade_ozviat'";
	else {
	 		$cod_daneshkade_ozviat_sql="1";
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
	$refered_shora="1";
	
	 	$daneshgah_cousion="and 1"	;
	 	if ( ! isset($tarh_year))
    $tarh_year = '-1';


	if(strcmp($tarh_year,'-1')!=0 )
	{
	    $year_caution="tarh.cod_tarh like '$tarh_year%'";
	}
	else
	   $year_caution="1";
	   
	if ( ! isset($cod_daneshkade1))
    		$cod_daneshkade1 = '-1';
	  if(strcmp($cod_daneshkade1,'-1')!=0 )
		{
			$daneshkade_caution="tarh.cod_daneshkade = '$cod_daneshkade1'";
		}
		else
		   $daneshkade_caution="1";
	if(strcmp($cod_daneshkade_ozviat,'0')==0){
		$sQuery = "
			SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
			FROM   tarh,vaziat_tarh,daneshkade,user_login
			WHERE    refered_shora='0' and  send_karshenas_shora='1' and tarh_type!='6' and   $year_caution  and  $daneshkade_caution  and vaziat_tarh.vaziat=tarh.vaziat_moaven  and confirm_moaven_tarh='1'   and tarh.version='-1'  and $refered_shora $daneshgah_cousion 
			and tarh.creator=user_login.email and tarh.cod_daneshkade=daneshkade.cod_daneshkade
			$sWhere
			
			$sOrder
			$sLimit
		";
	}
	else{
		$sQuery = "
			SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
			FROM   tarh,karshenas_shora_tarh,daneshkade,user_login
			WHERE    $year_caution   and  karshenas_shora_tarh.cod_karshenas='$cod_karshenas'  and tarh.cod_tarh=karshenas_shora_tarh.cod_tarh and $cod_daneshkade_ozviat_sql  and tarh.version='-1' and view_karshenas='1' $daneshgah_cousion 
			and tarh.creator=user_login.email and tarh.cod_daneshkade=daneshkade.cod_daneshkade
			$sWhere
			group by tarh.cod_tarh
			$sOrder
			$sLimit
		";
	}
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
	if(strcmp($cod_daneshkade_ozviat,'0')==0){
		$sQuery = "
				SELECT COUNT(".$sIndexColumn.")
				FROM   tarh,vaziat_tarh,daneshkade,user_login
				WHERE    refered_shora='0' and  send_karshenas_shora='1' and tarh_type!='6' and   $year_caution  and  $daneshkade_caution  and vaziat_tarh.vaziat=tarh.vaziat_moaven  and confirm_moaven_tarh='1'   and tarh.version='-1'  and $refered_shora $daneshgah_cousion 
				and tarh.creator=user_login.email and tarh.cod_daneshkade=daneshkade.cod_daneshkade
								
			";
	}
	else {
		$sQuery = "
				SELECT COUNT(".$sIndexColumn.")
				FROM   tarh,karshenas_shora_tarh,daneshkade,user_login
				WHERE    $year_caution   and  karshenas_shora_tarh.cod_karshenas='$cod_karshenas'  and tarh.cod_tarh=karshenas_shora_tarh.cod_tarh and $cod_daneshkade_ozviat_sql  and tarh.version='-1' and view_karshenas='1' $daneshgah_cousion 
			and tarh.creator=user_login.email and tarh.cod_daneshkade=daneshkade.cod_daneshkade
			
			";
	}
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
		
		$startdate = $aRow["tarh_time"];
		$startyear = substr($startdate,0,4);
		$startmon = substr($startdate,5,2);
		$startday = substr($startdate,8,2);
		$farsistartdate=hijricalender( $startyear , $startmon , $startday );
		$farsistartdate = enum2fnum($farsistartdate);
		$row["tarh_time"] = $farsistartdate;
		
		$row["cod_tarh"]=$aRow["cod_tarh"];
		
		$str=$aRow["tarh_title_farsi"];
		//$str = str_replace ( "&#1740;" ,"&#1610;", $str );
		//$str= iconv('windows-1256', 'utf-8', $str); 
		$row["tarh_title_farsi"] = $str;

		$str=$aRow["daneshkade_name"];
		//$str = str_replace ( "&#1740;" ,"&#1610;", $str );
		//$str= iconv('windows-1256', 'utf-8', $str); 
		$row["daneshkade_name"] = $str;
		
		$name=$aRow["name"];
		$family=$aRow["family"];
		$name_family=$name." ".$family;
		//$name_family = str_replace ( "&#1740;" ,"&#1610;", $name_family );
		//$name_family= iconv('windows-1256', 'utf-8', $name_family); 
		$row["name_family"] = $name_family;
		
		$cntr++;
		//$row["edit"]=$edit;
		$row["ss"]=null;
		$row['DT_RowId']=$aRow[$aColumns["0"]];;
		$output['aaData'][] = $row;
		
	}
	
	echo json_encode( $output );
?>