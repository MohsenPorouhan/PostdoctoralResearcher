<?php
include("include/database-connect.phtml");
include("include/include.phtml");


if(isset($action))
{
	if(strcmp($action,"send_email")==0)
	{
		$query="select * from letter_to_mojri where  id=\"$letterno\" ";
		
		$result = mysql_query($query) or die("Error in selecting data from tarh , mojri_tarh");
		
		if(mysql_num_rows($result) <= 0 )
		{
			echo "چنين طرحي وجود ندارد";
			exit();
		}
		$row_fetched=mysql_fetch_array($result);
		//$letter_subject=$row_fetched["letter_subject"];
		$source_letter=$row_fetched["letter_subject"];
		if(isset($action))
			if(strcmp($action,"send_email")==0)
				if( strlen(trim($letter_subject))>0)
				{
					$mydate=date("Y-m-d");
					$from_letter=$admin;
					$query="select * from letter_to_mojri where id=\"$letterno\"";
					$result=mysql_query($query) or die("Error in selecting data from letter_to_mojri");
					$row_fetched_letter=mysql_fetch_array($result);
					$to_letter=$row_fetched_letter["from_letter"];
					$cod_tarh=$row_fetched_letter["cod_tarh"];
					$cod_daneshkade=$row_fetched_letter["cod_daneshkade"];
		
					$q="select max(id) as max_id from letter_to_mojri where cod_tarh='$cod_tarh'";
					$r=mysql_query($q);
					$rf=mysql_fetch_array($r);
					$max_l_no = $rf["max_id"]+1;
					$letter_no=$cod_tarh."-".$max_l_no;
					//$letter_subject=iconv('utf-8','windows-1256',$letter_subject);
					//$letter_body=iconv('utf-8','windows-1256',$letter_body);
					$query="insert into letter_to_mojri set atf_to_letter='$letterno',from_letter='$from_letter',to_letter='$to_letter',cod_daneshkade='$cod_daneshkade',cod_tarh='$cod_tarh' , letter_no='$letter_no' , letter_subject='$letter_subject' , letter_body='$letter_body' , letter_date='$mydate'";
					//echo $query;
					$result=mysql_query($query) or die("error in inserting data");
					//message_show(".پاسخ به نامه مذکور ارسال شد","green");
					//footer_forms($admin,$seed);
					echo 'sent';
					exit();
					 
				}
			else
				$status="entry_error";
	}
	if(strcmp($action,"letter_list")==0)
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
	$aColumns = array('id','letter_no','letter_date','cod_tarh','letter_subject','from_letter','to_letter');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "cod_tarh";
	
	/* DB table to use */
	$sTable = "letter_to_mojri";
	
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
	$search=$search; 
	if ( $_GET['sSearch'] != "" )
	{
		$sWhere = "and (";
		
			$sWhere .= " letter_subject "." LIKE '%".mysql_real_escape_string( $search )."%' OR "." letter_no "." LIKE '%".mysql_real_escape_string( $search )."%' OR "." cod_tarh "." LIKE '%".mysql_real_escape_string( $search )."%' OR "."letter_body". " LIKE '%".mysql_real_escape_string( $search )."%'";
		
		
		$sWhere .= ')';
	}
	$letter_type=$_GET["letter_type"];
	if ( isset($letter_type))
	{
		if($letter_type=="-1")
			//$sWhere.="";
			$a=1;
		elseif(strcmp($letter_type,"0")==0){
			$sWhere .= "and (";
			$sWhere .= "visited='0' and to_letter='$admin' and admin_confirm='1'";
			$sWhere .= ')';
		}
		elseif(strcmp($letter_type,"1")==0){
			$sWhere .= "and (";
			$sWhere .= "visited='1'";
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
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns)).",visited
		FROM   $sTable
		WHERE (   (admin_confirm='1'  and  to_letter='$admin' )   or( from_letter='$admin') )
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
		WHERE   (admin_confirm='1'  and  to_letter='$admin' )   or from_letter='$admin' 
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
			if ( $aColumns[$i] == "letter_date" )
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
			$reply= "<a class=\"btn reply_btn\" data-toggle=\"modal\" href=\"#basic\" ><i class=\"fa fa-reply\" ></i></a>";
			$reply2= "<a class=\"btn reply_btn\" data-toggle=\"modal\" <span>---</span>";
		}
		$visited=$aRow["visited"];
		$from_letter=$aRow["from_letter"];
		$admin_confirm=$aRow["admin_confirm"];
		$cntr++;
		$row["edit"]=$reply;
		$row["details"]=null;
		$row['DT_RowId']=$aRow[$aColumns["0"]];
		if((strcmp($visited,"0")==0) && (strcmp($from_letter,$admin)!=0))
			$row["DT_RowClass"] = "bold";
		if(strcmp($from_letter,$admin)==0)
			$row["edit"] = $reply2;
		$output['aaData'][] = $row;
		
	}
	
	echo json_encode( $output );
}
}
?>