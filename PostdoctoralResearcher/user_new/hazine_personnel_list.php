

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
	$aColumns = array('hazine_personnel', 'activity_type','persons','degree','majmoa_saat','per_hour','takhasos');
	//$aColumns = array("name", 'family', 'activity_type','persons','degree','majmoa_saat','per_hour','takhasos');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "cod_hazine";
	
	/* DB table to use */
	$sTable = "hazine_personnel";
	
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
	$sQuery="
	SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns)).",cod_hazine,cod_tarh,name_persons,version,mojri_code,new_update
		FROM   $sTable
		WHERE  cod_tarh='$cod_tarh' and version='-1' 
		$sWhere
		$sOrder
		$sLimit
			";
	
	$rResult=mysql_query($sQuery) or die(mysql_error());

	
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
		WHERE  cod_tarh='$cod_tarh'  and version='-1'
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
		$daraje_mojri="";
		$mojri_name_family="*";
		$takhasos=$aRow["takhasos"];
		$mojri_code=$aRow["mojri_code"];
		
		if(strcmp($mojri_code,'-1')!=0 && strcmp($mojri_code,'-2')!=0)
		{
			$query1="select distinct user_login.* from user_login  where user_login.email='$mojri_code'";
			$result1=mysql_query($query1) or die("Error");
		
			if(mysql_num_rows($result1)>0)
			{
			  
				$myrf=mysql_fetch_array($result1);
				$mojri_name_family=$myrf["name"]."&nbsp;".$myrf["family"];
				//$mojri_name_family= iconv('windows-1256', 'utf-8', ($mojri_name_family));
				$darajeelmi=$myrf["darajeelmi"];
				$takhasos=$myrf["takhasos"];
				 
				$daraje_query_result=mysql_query("select * from darajeelmi where darajeelmi='$darajeelmi'");
		
				if(mysql_num_rows($daraje_query_result)>0)
				{
					$daraje_rf=mysql_fetch_array($daraje_query_result);
					///$mojri_name_family=$mojri_name_family."-".$daraje_rf["darajeelmi_desc"];
					$daraje_mojri=$daraje_rf["darajeelmi_desc"];
					// echo $darajeelmi."a".$daraje_mojri;
				}
			  
			}
		
			$query2="select distinct mojri.* from  mojri  where mojri.mojri_code= '$mojri_code'";
			$result2=mysql_query($query2) or die("Error in selecting data from mojri_tarh");
			// if(strlen($daraje_mojri)<=0)
			if(mysql_num_rows($result2)>0)
			{
			  
				$myrf=mysql_fetch_array($result2);
				$mojri_name_family=$myrf["name"]." ".$myrf["family"];
				$mojri_name_family= $mojri_name_family;
				$darajeelmi=$myrf["darajeelmi"];
				$daraje_query_result=mysql_query("select * from darajeelmi where darajeelmi='$darajeelmi'");
		
				if(mysql_num_rows($daraje_query_result)>0)
				{
					$daraje_rf=mysql_fetch_array($daraje_query_result);
					///$mojri_name_family=$mojri_name_family."-".$daraje_rf["darajeelmi_desc"];
					$daraje_mojri=$daraje_rf["darajeelmi_desc"];
					$takhasos=$daraje_rf["takhasos"];
					//echo $darajeelmi."a".$daraje_mojri;
				}
			  
			}
		}
		//echo "<tr>";
		$cod_hazine=$aRow["cod_hazine"];
		//       echo "<td align=\"center\" class=\"tahoma1\"><img src=\"image/button_drop.png\" border=0 alt=\"Delete\"></td>";
		//echo "<td ><p align=\"center\"><a href=\"#\" onclick='window.open(\"hazf_item_tarh.phtml?mainwindow=hazine_personnel.phtml&admin=$admin&seed=$seed&action=delete_hazine&cod_tarh=".$cod_tarh."&delete_id=".$row_fetched["cod_hazine"]."\",\"popupwindow\",\"toolbar=no,status=no,scrollbars=no,width=250,height=120,left=((screen.width-250) / 2),top=((screen.height - 120) / 2),resizable=no\")'><img border=\"0\" src=\"image/button_drop.png\" width=\"11\" height=\"13\" alt=\"Delete\" ></a></td>";
	    //echo "<td ><p align=\"center\"><a href=\"edit_hazine_personnel.phtml?admin=$admin&seed=$seed&cod_tarh=$cod_tarh&cod_hazine=$cod_hazine\" ><img border=\"0\" src=\"image/button_edit.png\" width=\"11\" height=\"13\" alt=\"Edit\" ></a></td>";
				$a=$aRow["per_hour"];
				$b=$aRow["majmoa_saat"];
				$c=$aRow["persons"];
		if(strcmp($mojri_code,'-1')!=0 && strcmp($mojri_code,'-2')!=0)
		$my_summary = $a*$b;
		else
		$my_summary = $a*$b;
		$mycount=$mycount+$my_summary;
		//echo "<td width=\"5%\"  align=\"center\" class=\"tahoma1\">".number_format($my_summary)."</td>";
       // echo "<td align=\"center\"  class=\"tahoma1\" >".number_format($row_fetched["per_hour"])."</td>";
       // echo "<td align=\"center\"  class=\"tahoma1\" >".number_format($row_fetched["majmoa_saat"])."</td>";
    
      //  echo "b".$daraje_mojri;
		      if(strcmp($mojri_code,'-1')==0 || strcmp($mojri_code,'-2')==0)
		{
		$query="select * from darajeelmi where darajeelmi = '".$aRow["degree"]."'";
			// echo $query;
         $qresult=mysql_query($query) or die("Error in selecting data from daraje elmi");
			if(mysql_num_rows($qresult) > 0 )
		         {
		         $row_degree = mysql_fetch_array($qresult);
		$degree_result = $row_degree["darajeelmi_desc"];
		$daraje_mojri=$degree_result;
		 
		//echo "a".$daraje_mojri;
		}
		else
			$degree_result = "ثبت نشده";
					 
			// $daraje_mojri=$degree_result;
			 
		}
		//echo "<td align=\"center\"  class=\"tahoma1\">".$takhasos."</td>";
		//echo "<td align=\"center\"  class=\"tahoma1\">".$daraje_mojri."</td>";
		if(strcmp($mojri_code,'-1')!=0 && strcmp($mojri_code,'-2')!=0)
		$persons=1;
        else
          $persons=  number_format($aRow["persons"]);
    
       //echo "<td align=\"center\"  class=\"tahoma1\">".$persons."</td>";
       //echo "<td align=\"center\"  class=\"tahoma1\">".$row_fetched["activity_type"]."</td>";
	   //echo "<td align=\"center\"  class=\"tahoma1\">".$mojri_name_family."</td>";
      // echo "</tr>";
    
		
		
		$row = array();
		$row["mojri_name_family"]=$mojri_name_family;
		$row["activity_type"]= $aRow["activity_type"];
		$row["persons"]=$persons;
		$row["daraje_mojri"]=$daraje_mojri);
		$row["takhasos"]=$takhasos;
		$row["majmoa_saat"]=$aRow["majmoa_saat"];
		$row["per_hour"]=$aRow["per_hour"];
		$row["my_summary"]=$my_summary;
					// Special output formatting for 'version' column
			
				
		
			$edit="<a class=\"edit_btn\" data-toggle=\"modal\" href=\"#basic\" ><img border=\"0\" src=\"image/button_edit.png\" alt=\"Edit\" ></a>";
			$delete= "<a class=\"delete_btn\" data-toggle=\"modal\" href=\"#delete\" ><img border=\"0\" src=\"image/button_drop.png\" alt=\"Delete\" ></a>";
			
		//	$row["ss"]=$edit;
		
		$cntr++;
		$row["edit"]=$edit;
		$row["cod_hazine"]=$cod_hazine;
		$row["delete"]=$delete;
		$row["mojri_code"]=$mojri_code;
		$row['DT_RowId']=$cod_hazine;
		$output['aaData'][] = $row;
		//echo $row[1];
	}
	$row = array();
	$row["mojri_name_family"]="مجموع";
	$row["activity_type"]="";
	$row["persons"]="";
	$row["daraje_mojri"]="";
	$row["takhasos"]="";
	$row["majmoa_saat"]="";
	$row["per_hour"]="";
	$row["my_summary"]=number_format($mycount);
	$row["edit"]="";
	$row["cod_hazine"]="";
	$row["delete"]="";
	$row["mojri_code"]="";
	$output['aaData'][] = $row;
	
	echo json_encode( $output );
?>