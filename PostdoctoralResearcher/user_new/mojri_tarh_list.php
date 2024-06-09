

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
	$aColumns = array("mojri.mojri_code", 'name', 'family','mojri_or_hamkar');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "mojri.mojri_code";
	
	/* DB table to use */
	$sTable = "mojri , mojri_tarh";
	
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
	$search=$_GET[""];
	if ( isset($search))
	{
		if($search=="-1")
			//$sWhere.="";
			$a=1;
		else{
			$sWhere .= "and (";
			$sWhere .= "mojri_tarh.mojri_code='$search'";
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
		SELECT name,family,mojri.mojri_code,mojri_or_hamkar
		FROM   $sTable
		WHERE mojri.mojri_code = mojri_tarh.mojri_code and mojri_tarh.cod_tarh='$cod_tarh'  and mojri_tarh.version='-1'
		$sWhere
		group by mojri.mojri_code
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
		WHERE mojri.mojri_code = mojri_tarh.mojri_code and mojri_tarh.cod_tarh='$cod_tarh'  and mojri_tarh.version='-1' group by mojri.mojri_code
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
		$row["mojri_code"]=$aRow["mojri_code"];
		$row["name"]=$aRow["name"];
		$row["family"]=$aRow["family"];
		
			// Special output formatting for 'version' column
			
				$hamkari=$aRow["mojri_or_hamkar"];
				if(strcmp(trim($hamkari),"0")==0)
					$hamkari="مجري";
				else if(strcmp(trim($hamkari),"1")==0)
					$hamkari="همکار";
				else
					$hamkari="مجري دوم";
				//$hamkari= iconv('windows-1256', 'utf-8', ($hamkari));
				$row["mojri_or_hamkar"]=$hamkari;
		
			$edit="<a href=\"sabt_tarh_second.phtml?cod_tarh=".$aRow["cod_tarh"]." \"><img border=\"0\" src=\"image/button_edit.png\" alt=\"Edit\" ></a>";
			$row["edit"]=$edit;
			$row["ss"]=$edit;
		
		$cntr++;
		$row[]=$edit;
		$row[]=$edit;
		$row['DT_RowId']=$cntr;
		$output['aaData'][] = $row;
		//echo $row[1];
	}
	
	echo json_encode( $output );
?>