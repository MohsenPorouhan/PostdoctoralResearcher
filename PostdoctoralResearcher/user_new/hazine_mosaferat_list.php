

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
	$aColumns = array( 'target','dafe_safar','vasile','persons_cnt','hazine');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "cod_hazine_safar";
	
	/* DB table to use */
	$sTable = "hazine_safar";
	
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
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns)).",cod_hazine_safar
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
		$cod_hazine_safar=$aRow["cod_hazine_safar"];
		
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			//echo $aColumns[$i]["db"];
			//echo $aRow[ $aColumns[$i]["db"]];
			  if ( $aColumns[$i] != ' ' )
			{
				
				$str=$aRow[$aColumns[$i]];
				//$str = str_replace ( "&#1740;" ,"&#1610;", $str );
				//$str= iconv('windows-1256', 'utf-8', $str); 
				
				$row[$aColumns[$i]] = $str;
			}
			
			
		}
		$target=$aRow["target"];
		$dafe_safar= $aRow["dafe_safar"];
		$vasile=$aRow["vasile"];
		$persons_cnt=$aRow["persons_cnt"];
		$hazine=$aRow["hazine"];
		$mycount=$mycount+$hazine;
		$mycount1=$mycount1+$persons_cnt;
		$row = array();
		$row["target"]=$target;
		$row["dafe_safar"]= $dafe_safar;
		$row["vasile"]=$vasile;
		$row["persons_cnt"]=$persons_cnt;
		$row["hazine"]=$hazine;
				
		$edit= "<a class=\"edit_btn\" data-toggle=\"modal\" href=\"#basic\" ><img border=\"0\" src=\"image/button_edit.png\" alt=\"Edit\" ></a>";
		$delete= "<a class=\"delete_btn\" data-toggle=\"modal\" href=\"#delete\" ><img border=\"0\" src=\"image/button_drop.png\" alt=\"Edit\" ></a>";
		
		$cntr++;
		$row["edit"]=$edit;
		$row["cod_hazine_safar"]=$cod_hazine_safar;
		$row["delete"]=$delete;
		
		$row['DT_RowId']=$cod_hazine_safar;
		$output['aaData'][] = $row;
		
	}
	$row = array();
	$row["target"]="مجموع";
	$row["dafe_safar"]="";
	$row["vasile"]="";
	$row["persons_cnt"]=number_format($mycount1);
	$row["hazine"]=number_format($mycount);
	$row["edit"]="";
	$row["cod_hazine_safar"]="";
	$row["delete"]="";
	$output['aaData'][] = $row;
	
	
	echo json_encode( $output );
?>