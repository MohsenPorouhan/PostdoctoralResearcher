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
	$aColumns = array( 'cod_tarh','tarh_title_farsi',"$uni",'tarh_time');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "cod_tarh";
	
	/* DB table to use */
	$sTable = "tarh,daneshkade";
	
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
			$sWhere .= "archieved='0' and tarh_makhtoome='0' and indoing='0' and ready_gharardad='0' and new_gharardad_daneshkade='0' and daneshkade_indoing='0' and finalized ='0' ";
			$sWhere .= ')';
		}
	elseif(strcmp($position,"1")==0){
			$sWhere .= "and (";
			$sWhere .= "archieved='0' and tarh_makhtoome='0' and indoing='0' and daneshkade_indoing='0' and (ready_gharardad='1' or new_gharardad_daneshkade='1') and finalized ='0' ";
			$sWhere .= ')';
		}
	elseif(strcmp($position,"2")==0){
			$sWhere .= "and (";
			$sWhere .= "archieved='0' and tarh_makhtoome='0' and (indoing='1' or daneshkade_indoing='1' ) and  finalized ='0' ";
			$sWhere .= ')';
		}
	elseif(strcmp($position,"3")==0){
			$sWhere .= "and (";
			$sWhere .= "archieved='0' and tarh_makhtoome='0' and  finalized ='1'  and finish_pointed!='1'";
			$sWhere .= ')';
		}
	elseif(strcmp($position,"4")==0){
			$sWhere .= "and (";
			$sWhere .= "archieved='0' and tarh_makhtoome='0' and  finalized ='1' and finish_pointed='1'";
			$sWhere .= ')';
		}
	elseif(strcmp($position,"5")==0){
			$sWhere .= "and (";
			$sWhere .= "archieved='1' and tarh_makhtoome='0'";
			$sWhere .= ')';
		}
	elseif(strcmp($position,"6")==0){
			$sWhere .= "and (";
			$sWhere .= " archieved='0' and tarh_makhtoome='1'";
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
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns)).",ready_gharardad,new_gharardad_daneshkade,indoing,daneshkade_indoing,finalized,archieved,finished,edit_request,tarh_makhtoome,finish_pointed
		FROM   $sTable
		WHERE    payannameh='0' and   is_tarh='1'  and tarh.creator = '$admin'  and version='-1' and tarh.cod_daneshkade=daneshkade.cod_daneshkade 
		$sWhere
		group by cod_tarh
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
		WHERE   payannameh='0' and   is_tarh='1'  and tarh.creator = '$admin'  and version='-1' and tarh.cod_daneshkade=daneshkade.cod_daneshkade
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
			else if ( $aColumns[$i] == $uni )
			{
				$str=$aRow[$aColumns[$i]];
				//$str = str_replace ( "&#1740;" ,"&#1610;", $str );
				//$str= iconv('windows-1256', 'utf-8', $str); 
				$row["daneshkade_name"] = $str;
				
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
		if( strcmp($aRow["ready_gharardad"],"1")==0 || strcmp($aRow["new_gharardad_daneshkade"],"1")==0 || strcmp($aRow["indoing"],"1")==0 || strcmp($aRow["daneshkade_indoing"],"1")==0 || strcmp($aRow["finalized"],"1")==0 || strcmp($aRow["archieved"],"1")==0 || strcmp($aRow["finished"],"1")==0)
		{
       		if(strcmp($aRow["edit_request"],"1")==0 )
       		{
       			if($la=="en")
       			{
       				$edit_txt="It Already Has Edit Request";
       			}
       			else
       			{ 
       				$edit_txt="درخواست ويرايش دارد";
       			}
       			$edit= "<a  class=\"\" id=\"\"><i  class=\"fa  fa-unlock\" title='$edit_txt' ></i></a>";
       		}
       		else
       		{ 
				$edit= "<a class=\"btn uncolck_buttun\" id=\"uncolck_buttun\" data-toggle=\"modal\" href=\"#basic\" ><i class=\"fa  fa-lock\" ></i></a>";
			}
		}
		else
			$edit="<a class=\"btn\" href=\"sabt_tarh_second.phtml?admin=$admin&seed=$seed&cod_tarh=".$aRow["cod_tarh"]." \"><i class=\"fa fa-edit\" ></i></a>";
		
		//$edit= iconv('windows-1256', 'utf-8', $edit); 
		$ready_gharardad=$aRow["ready_gharardad"];
		$new_gharardad_daneshkade=$aRow["new_gharardad_daneshkade"];
		$indoing=$aRow["indoing"];
		$daneshkade_indoing=$aRow["daneshkade_indoing"];
		$archieved=$aRow["archieved"];
		$finalized=$aRow["finalized"];
		$finish_pointed=$aRow["finish_pointed"];
		$tarh_makhtoome=$aRow["tarh_makhtoome"];
		if($la=="en")
		{
			$archive_txt="Archived";
			$processing_txt="In Process";
			$finalized_txt="Finished";	
			$indoing_txt="In Doing";
			$indoing_uni_txt="In Doing At Faculty";
			$ready_contract_txt="Ready To Contract";
			$ready_contract_uni_txt="Ready To Contract At Faculty";
			$finish_pointed_txt="Finished With Point";
			$tarh_makhtoome_txt="Ended";
		}
		else
		{
			$archive_txt="بايگاني شده";
			$processing_txt="در حال کارشناسي";
			$finalized_txt="پايان يافته";
			$indoing_txt="در حال اجرا";	
			$indoing_uni_txt="در حال اجرا در سطح پژوهشکده";
			$ready_contract_txt="آماده به قرارداد";
			$ready_contract_uni_txt="آماده به قرارداد در سطح پژوهشکده";
			$finish_pointed_txt="پايان يافته با کسب امتياز";
			$tarh_makhtoome_txt="مختومه";
		}
		
		if(strcmp($archieved,"1")==0)
			$position=$archive_txt;
		elseif(strcmp($tarh_makhtoome,"1")==0)
			$position=$tarh_makhtoome_txt;
		elseif(strcmp($finish_pointed,"1")==0)
			$position=$finish_pointed_txt;
		elseif(strcmp($finalized,"1")==0)
			$position=$finalized_txt;
		elseif(strcmp($indoing,"1")==0)
			$position=$indoing_txt;
		elseif(strcmp($daneshkade_indoing,"1")==0)
			$position=$indoing_uni_txt;
		elseif(strcmp($ready_gharardad,"1")==0)
			$position=$ready_contract_txt;
		elseif(strcmp($new_gharardad_daneshkade,"1")==0)
			$position=$ready_contract_uni_txt;
		else
			$position=$processing_txt;
			
		//$position= iconv('windows-1256', 'utf-8', $position); 
		$row["position"]=$position;
		$cntr++;
		$row["edit"]=$edit;
		$row["ss"]=null;
		$row['DT_RowId']=$aRow[$aColumns["0"]];;
		$output['aaData'][] = $row;
		
	}
	
	echo json_encode( $output );
?>