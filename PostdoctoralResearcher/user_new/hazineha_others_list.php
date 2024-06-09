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
$servicing=$row_fetched["servicing"];

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
		$query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='11'";
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

	if (strcmp($action,"edit_mojri_sabt")==0)
	{
		$query  = "update  sayer_hazine set hazine_taksir = \"$hazine_taksir\" ,sayer_hazine=\"$sayer_hazine\",maliat='$maliat',nezarat='$nezarat',balasari='$balasari',new_update='1' where id='$id_delete' and cod_tarh=\"$cod_tarh\" ";
		 
		$result = mysql_query($query) or die("Error in inserting data into hamkaran_tarh 002");

	}
	if (strcmp($action,"add_hazine_sayer")==0)
	{
		$query  = "select * from sayer_hazine where cod_tarh=\"$cod_tarh\"  and version='-1'";
		$result = mysql_query($query) or die("Error in inserting data into  sayer hazineha");

		//if( mysql_num_rows($result) <= 0 )
		// {
		$query  = "insert into sayer_hazine set hazine_taksir=\"$hazine_taksir\",sayer_hazine=\"$sayer_hazine\",cod_tarh=\"$cod_tarh\",maliat='$maliat',nezarat='$nezarat',balasari='$balasari'";
		$result = mysql_query($query) or die("Error in inserting data into  sayer hazineha");
		
		$query="select * from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='11'";
	       $result=mysql_query($query) or die("Error in selecting data from  hazine_personnel ");
	       if ( mysql_num_rows($result) <= 0 )
	       {
	      		$query="insert into tarh_exist_item set cod_tarh='$cod_tarh',item_id='11'";
	       		$result=mysql_query($query) or die("Error in selecting data from  hazine_personnel ");
	       		echo "exist";
	       }
		//    }
		//   else
		//   {
		//     $query  = "update sayer_hazine set hazine_taksir=\"$hazine_taksir\",sayer_hazine=\"$sayer_hazine\" where cod_tarh=\"$cod_tarh\"";
		//    $result = mysql_query($query) or die("Error in inserting data into  update  sayer  hazine");
		//  }
		$action = "ثبت ساير هزينه ها  براي طرح با کد"."<br>".$cod_tarh;
		set_log($action,$admin,date("Y-m-d, g:i a"));
		//message_show(".ساير هزينه ها ثبت شد","green");

		 
	}
	if (strcmp($action,"delete_hazine")==0)
	{
		$query="delete from sayer_hazine where id = \"$id_delete\"  and version='-1'";

		$result=mysql_query($query) or die("Error in  delete data from daneshjo ");
		
		$query="select * from sayer_hazine where   cod_tarh=\"$cod_tarh\"  and version='-1'";
		    $result=mysql_query($query) or die("Error in selecting data from  hazine_personnel ");
		    if ( mysql_num_rows($result) <= 0 )
		    {
		    	$query="delete from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='11'";
	       		$result=mysql_query($query) or die("Error in delete data from  hazine_personnel ");
	       		echo "notexist";
		    }
	}

	if (strcmp($action,"select")==0)
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
	$aColumns = array('maliat','nezarat','balasari',"hazine_taksir", 'sayer_hazine', 'id');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "id";
	
	/* DB table to use */
	$sTable = "sayer_hazine";
	
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
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $search )."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	$search=$_GET[""];
	if ( isset($search))
	/*{
		if($search=="-1")
			//$sWhere.="";
			$a=1;
		else{
			$sWhere .= "and (";
			$sWhere .= "mojr.mojri_code='$search'";
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
	$sQuery = "
		SELECT hazine_taksir, sayer_hazine, id,maliat,nezarat,balasari  
		FROM   $sTable
		WHERE cod_tarh='$cod_tarh' and version='-1'
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
		WHERE cod_tarh=\"$cod_tarh\"  and version='-1'
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
		$row["maliat"]=$aRow["maliat"];
		$row["nezarat"]=$aRow["nezarat"];
		$row["balasari"]=$aRow["balasari"];

		$row["hazine_taksir"]=$aRow["hazine_taksir"];
		$row["sayer_hazine"]=$aRow["sayer_hazine"];
		$row["id_delete"]=$aRow["id"];
		
			$edit="<a class=\"btn edit_btn\" data-toggle=\"modal\" href=\"#basic\" ><i class=\"fa fa-edit\" ></i></a>";
			$delete= "<a class=\"btn delete_btn\"  data-toggle=\"modal\" href=\"#delete\" ><i class=\"fa fa-trash-o\" ></i></a>";
			$row["edit"]=$edit;
			$row["delete"]=$delete;
			
		
		$cntr++;
		$row[]=$edit;
		$row[]=$delete;
		$row['DT_RowId']=$cntr;
		$output['aaData'][] = $row;
		//echo $row[1];
	}
	
	echo json_encode( $output );
	}
}
?>