<?
include("include/database-connect.phtml");
include("include/include.phtml");
//echo $cod_tarh." ".$action." ".$name_var." ".$var_type;

if(isset($action))
{
  if (strcmp($action,"sabt")==0)
  {
    
     if(strlen(trim($name_dastgah)) > 0 &&  strlen(trim($company)) > 0 &&  strlen(trim($country)) > 0 &&  strlen(trim($count)) > 0 &&  strlen(trim($meghyas)) > 0 &&  strlen(trim($price)) > 0 && strcmp($usage_unusage,"-1")!=0)
     {
      $query="select * from fhrest_vasayel_kharid where  name_dastgah=\"$name_dastgah\" and cod_tarh=\"$cod_tarh\"  and version='-1'";
      $result=mysql_query($query) or die("Error in selecting data from  jadval zarayeb ");
      if ( mysql_num_rows($result) <= 0 )
      {


        $query  = "insert into fhrest_vasayel_kharid set name_dastgah=\"$name_dastgah\" , company=\"$company\",country=\"$country\",usage_unusage=\"$usage_unusage\",count=\"$count\",meghyas=\"$meghyas\",price=\"$price\",new_update='1',cod_tarh=\"$cod_tarh\" ";
        //echo $query;
        $result = mysql_query($query) or die("Error in inserting data into jadval zarayeb");
        
       $query="select * from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='9'";
       $result=mysql_query($query) or die("Error in selecting data from  jadval zarayeb ");
       if ( mysql_num_rows($result) <= 0 )
       {
      		$query="insert into tarh_exist_item set cod_tarh='$cod_tarh',item_id='9'";
       		$result=mysql_query($query) or die("Error in selecting data from  jadval zarayeb ");
       		echo "exist";
       }
       
        $action="ثبت فهرست وسايل"."<br>".$name."&nbsp;&nbsp;".$family;
        set_log($action,$admin,date("Y-d-m"));

      }
      else
       {
       	echo "123";
        $status="duplicate_entry";
       }
     }
  }
if (strcmp($action,"edit")==0)
  {

     if(strlen(trim($name_dastgah)) > 0 &&  strlen(trim($company)) > 0 &&  strlen(trim($country)) > 0 &&  strlen(trim($count)) > 0 &&  strlen(trim($meghyas)) > 0 &&  strlen(trim($price)) > 0 && strcmp($usage_unusage,"-1")!=0)
     {
      
       $query  = "update fhrest_vasayel_kharid set name_dastgah=\"$name_dastgah\" , company=\"$company\",country=\"$country\",usage_unusage=\"$usage_unusage\",count=\"$count\",meghyas=\"$meghyas\",price=\"$price\",new_update='1' where cod_kharid='$cod_kharid' ";
        $result = mysql_query($query) or die("Error in inserting data into jadval zarayeb");

       
        $action="ويرايش فهرست وسايل"."<br>".$name."&nbsp;&nbsp;".$family;
        set_log($action,$admin,date("Y-d-m"));

     
     }
  }
if (strcmp($action,"delete")==0)
  {

  
      
       $query  = "delete from  fhrest_vasayel_kharid  where cod_kharid='$cod_kharid' ";
        $result = mysql_query($query) or die("Error in inserting data into jadval zarayeb");
        
       $query="select * from fhrest_vasayel_kharid where   cod_tarh=\"$cod_tarh\"  and version='-1'";
	    $result=mysql_query($query) or die("Error in selecting data from  fhrest_vasayel_kharid ");
	    if ( mysql_num_rows($result) <= 0 )
	    {
	    	$query="delete from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='9'";
       		$result=mysql_query($query) or die("Error in selecting data from  jadval zarayeb ");
       		echo "notexist";
	    }
       
        $action="حذف از فهرست وسايل"."<br>".$name."&nbsp;&nbsp;".$family;
        set_log($action,$admin,date("Y-d-m"));

  }
if (strcmp($action,"fehrest_kharid_list")==0){
  $aColumns = array( 'name_dastgah','company','country','usage_unusage','count','meghyas','price');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "cod_kharid";
	
	/* DB table to use */
	$sTable = "fhrest_vasayel_kharid";
	
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
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns)).",cod_kharid
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
   if($la=="en")
	{
		$masrafi="expendable";
		$no_masrafi="nonexpendable";
		
	}
	else {
		$masrafi="مصرفي";
		$no_masrafi="غير مصرفي";
		
	}
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		$cod_kharid=$aRow["cod_kharid"];
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			//echo $aColumns[$i]["db"];
			//echo $aRow[ $aColumns[$i]["db"]];
			if ( $aColumns[$i] == "usage_unusage" )
			{
				/* Special output formatting for 'version' column */
				if($aRow["usage_unusage"]==0)
			         $usage_unusage=$masrafi;
			    else
				     $usage_unusage=$no_masrafi;
				$usage_unusage = str_replace ( "&#1740;" ,"&#1610;", $usage_unusage );
				//$usage_unusage= iconv('windows-1256', 'utf-8', $usage_unusage); 
				$row[$aColumns[$i]] = $usage_unusage;
				  
			}
			else if ( $aColumns[$i] != ' ' )
			{
				
				$str=$aRow[$aColumns[$i]];
				//$str = str_replace ( "&#1740;" ,"&#1610;", $str );
				//$str= iconv('windows-1256', 'utf-8', $str); 
				
				$row[$aColumns[$i]] = $str;
			}
			
			
		}
		$edit= "<a class=\"edit_buttun\" id=\"edit_buttun\" data-toggle=\"modal\" href=\"#basic\" ><i class=\"fa fa-edit\" ></i></a>";
		$delete= "<a class=\"delete_buttun\" id=\"delete_buttun\" data-toggle=\"modal\" href=\"#delete\" ><i class=\"fa fa-trash-o\" ></i></a>";
		
		$cntr++;
		$row["edit"]=$edit;
		$row["cod_kharid"]=$cod_kharid;
		$row["delete"]=$delete;
		
		$row['DT_RowId']=$cod_kharid;
		$output['aaData'][] = $row;
		
	}
	
	echo json_encode( $output );
}
}
     // name moteghayer va naghshe an baraye bare dovvom
     
