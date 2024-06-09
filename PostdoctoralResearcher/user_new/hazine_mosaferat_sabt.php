<?
include("include/database-connect.phtml");
include("include/include.phtml");
//echo $cod_tarh." ".$action." ".$name_var." ".$var_type;

if(isset($action))
{
  if (strcmp($action,"sabt")==0)
  {

     if(strlen(trim($target)) > 0 &&  strlen(trim($dafe_safar)) > 0 &&  strlen(trim($vasile)) > 0  &&  strlen(trim($persons_cnt)) > 0  &&  strlen(trim($hazine)) > 0)
     {
      $query="select * from hazine_safar where  target=\"$target\" and dafe_safar=\"$dafe_safar\" and vasile=\"$vasile\" and persons_cnt=\"$persons_cnt\" and hazine=\"$hazine\" and cod_tarh=\"$cod_tarh\"  and version='-1'";
      $result=mysql_query($query) or die("Error in selecting data from  hazine safar ");
      if ( mysql_num_rows($result) <= 0 )
      {


        $query  = "insert into hazine_safar set target=\"$target\", dafe_safar=\"$dafe_safar\", vasile=\"$vasile\", persons_cnt=\"$persons_cnt\", hazine=\"$hazine\",cod_tarh=\"$cod_tarh\" ";
        //echo $query;
        $result = mysql_query($query) or die("Error in inserting data into hazine safar");

        $query="select * from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='10'";
       $result=mysql_query($query) or die("Error in selecting data from  tarh_exist_item ");
       if ( mysql_num_rows($result) <= 0 )
       {
      		$query="insert into tarh_exist_item set cod_tarh='$cod_tarh',item_id='10'";
       		$result=mysql_query($query) or die("Error in selecting data from  tarh_exist_item ");
       		echo "exist";
       }
       
        $action="ثبت هزينه مسافرت "."<br>".$name."&nbsp;&nbsp;".$family;
        set_log($action,$admin,date("Y-d-m"));

      }
      else
       {
        $status="duplicate_entry";
       }
     }
  }
if (strcmp($action,"edit")==0)
  {

     if(strlen(trim($target)) > 0 &&  strlen(trim($dafe_safar)) > 0 &&  strlen(trim($vasile)) > 0  &&  strlen(trim($persons_cnt)) > 0  &&  strlen(trim($hazine)) > 0)
     {
      
       $query  = "update   hazine_safar set target=\"$target\", dafe_safar=\"$dafe_safar\", vasile=\"$vasile\", persons_cnt=\"$persons_cnt\", hazine=\"$hazine\",new_update='1' where cod_hazine_safar='$cod_hazine_safar' ";
        $result = mysql_query($query) or die("Error in inserting data into hazine safar");

       
        $action="ويرايش هزينه مسافرت"."<br>".$name."&nbsp;&nbsp;".$family;
        set_log($action,$admin,date("Y-d-m"));

     
     }
  }
if (strcmp($action,"delete")==0)
  {

  
      
        $query  = "delete from  hazine_safar  where cod_hazine_safar='$cod_hazine_safar' ";
        $result = mysql_query($query) or die("Error in inserting data into hazine safar");

 		$query="select * from hazine_safar where   cod_tarh=\"$cod_tarh\"  and version='-1'";
	    $result=mysql_query($query) or die("Error in selecting data from  fhrest_vasayel_kharid ");
	    if ( mysql_num_rows($result) <= 0 )
	    {
	    	$query="delete from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='10'";
       		$result=mysql_query($query) or die("Error in selecting data from  jadval zarayeb ");
       		echo "notexist";
	    }
       
        $action="حذف از هزينه مسافرت"."<br>".$name."&nbsp;&nbsp;".$family;
        set_log($action,$admin,date("Y-d-m"));

  }
  



if (strcmp($action,"hazine_mosaferat_list")==0){
	
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
				
		$edit= "<a class=\"edit_buttun\" id=\"edit_buttun\" data-toggle=\"modal\" href=\"#basic\" ><i class=\"fa fa-edit\" ></i></a>";
		$delete= "<a class=\"delete_buttun\" id=\"delete_buttun\" data-toggle=\"modal\" href=\"#delete\" ><i class=\"fa fa-trash-o\" ></i></a>";
		
		$cntr++;
		$row["edit"]=$edit;
		$row["cod_hazine_safar"]=$cod_hazine_safar;
		$row["delete"]=$delete;
		
		$row['DT_RowId']=$cod_hazine_safar;
		$output['aaData'][] = $row;
		
	}
	$row = array();
	if($la=="en"){
	$row["target"]="Total";
	}else{
	$row["target"]="مجموع";
	}
	$row["dafe_safar"]="";
	$row["vasile"]="";
	$row["persons_cnt"]=number_format($mycount1);
	$row["hazine"]=number_format($mycount);
	$row["edit"]="";
	$row["cod_hazine_safar"]="";
	$row["delete"]="";
	$output['aaData'][] = $row;
	
	
	echo json_encode( $output );
  }     
}