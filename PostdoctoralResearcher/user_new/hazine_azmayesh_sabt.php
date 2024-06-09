<?
include("include/database-connect.phtml");
include("include/include.phtml");
//echo $cod_tarh." ".$action." ".$name_var." ".$var_type;

if(isset($action))
{
  if (strcmp($action,"sabt")==0)
  {

     if(strlen(trim($mozoa_azmayesh)) > 0 &&  strlen(trim($azmayesh_center)) > 0 &&  strlen(trim($azmayesh_cnt)) > 0  &&  strlen(trim($hazine_har_bar)) > 0)
     {
      $query="select * from hazine_azmayesh where  mozoa_azmayesh=\"$mozoa_azmayesh\" and azmayesh_center=\"$azmayesh_center\" and azmayesh_cnt=\"$azmayesh_cnt\" and hazine_har_bar=\"$hazine_har_bar\" and cod_tarh=\"$cod_tarh\"  and version='-1'";
      $result=mysql_query($query) or die("Error in selecting data from  jadval zarayeb ");
      if ( mysql_num_rows($result) <= 0 )
      {


        $query  = "insert into hazine_azmayesh set mozoa_azmayesh=\"$mozoa_azmayesh\" , azmayesh_center=\"$azmayesh_center\",azmayesh_cnt=\"$azmayesh_cnt\",hazine_har_bar=\"$hazine_har_bar\",cod_tarh=\"$cod_tarh\" ";
       // echo $query;
        $result = mysql_query($query) or die("Error in inserting data into jadval zarayeb");
       
       $query="select * from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='8'";
       $result=mysql_query($query) or die("Error in selecting data from  tarh_exist_item ");
       if ( mysql_num_rows($result) <= 0 )
       {
      		$query="insert into tarh_exist_item set cod_tarh='$cod_tarh',item_id='8'";
       		$result=mysql_query($query) or die("Error in selecting data from  tarh_exist_item ");
       		echo "exist";
       }
       
        $action="ثبت هزينه آزمايش "."<br>".$name."&nbsp;&nbsp;".$family;
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

     if(strlen(trim($mozoa_azmayesh)) > 0 &&  strlen(trim($azmayesh_center)) > 0 &&  strlen(trim($azmayesh_cnt)) > 0  &&  strlen(trim($hazine_har_bar)) > 0)
     {
      
       $query  = "update   hazine_azmayesh set mozoa_azmayesh=\"$mozoa_azmayesh\" , azmayesh_center=\"$azmayesh_center\",azmayesh_cnt=\"$azmayesh_cnt\",hazine_har_bar=\"$hazine_har_bar\",new_update='1' where cod_azmayesh='$cod_azmayesh' ";
        $result = mysql_query($query) or die("Error in inserting data into hazine azmayesh");

       
        $action="ويرايش هزينه آزمايش"."<br>".$name."&nbsp;&nbsp;".$family;
        set_log($action,$admin,date("Y-d-m"));

     
     }
  }
if (strcmp($action,"delete")==0)
  {

  
      
        $query  = "delete from  hazine_azmayesh  where cod_azmayesh='$cod_azmayesh' ";
        $result = mysql_query($query) or die("Error in inserting data into hazine azmayesh");
  		
        $query="select * from hazine_azmayesh where   cod_tarh=\"$cod_tarh\"  and version='-1'";
	    $result=mysql_query($query) or die("Error in selecting data from  hazine azmayesh ");
	    if ( mysql_num_rows($result) <= 0 )
	    {
	    	$query="delete from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='8'";
       		$result=mysql_query($query) or die("Error in selecting data from  tarh_exist_item ");
       		echo "notexist";
	    }
       
        $action="حذف از هزينه آزمايش"."<br>".$name."&nbsp;&nbsp;".$family;
        set_log($action,$admin,date("Y-d-m"));

  }
  

     // name moteghayer va naghshe an baraye bare dovvom

if (strcmp($action,"hazine_azmayesh_list")==0){
	
	$aColumns = array( 'mozoa_azmayesh','azmayesh_center','azmayesh_cnt','hazine_har_bar');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "cod_azmayesh";
	
	/* DB table to use */
	$sTable = "hazine_azmayesh";
	
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
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns)).",cod_azmayesh
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
		$khosusi="private";
		$in_uni="in_university";
		$out_uni="out_university";
	}
	else {
		$khosusi="خصوصي";
		$in_uni="داخل دانشگاه";
		$out_uni="دولتي خارج دانشگاه";
	}
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		$cod_azmayesh=$aRow["cod_azmayesh"];
		
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			//echo $aColumns[$i]["db"];
			//echo $aRow[ $aColumns[$i]["db"]];
			
			 if($aColumns[$i] == "azmayesh_center")
			{
				if($aRow["azmayesh_center"]==1)
					$azmayesh_center=$khosusi;
				else if($aRow["azmayesh_center"]==2)
					$azmayesh_center=$in_uni;
				else if($aRow["azmayesh_center"]==3)
					$azmayesh_center=$out_uni;
					
				$azmayesh_center = str_replace ( "&#1740;" ,"&#1610;", $azmayesh_center );
				//$azmayesh_center= iconv('windows-1256', 'utf-8', $azmayesh_center); 
				$row[$aColumns[$i]] = $azmayesh_center;
			}
			else if ( $aColumns[$i] != ' ' )
			{
				
				$str=$aRow[$aColumns[$i]];
				//$str = str_replace ( "&#1740;" ,"&#1610;", $str );
				//$str= iconv('windows-1256', 'utf-8', $str); 
				
				$row[$aColumns[$i]] = $str;
			}
			
			
		}
		$mozoa_azmayesh=$aRow["mozoa_azmayesh"];
		$azmayesh_cnt= $aRow["azmayesh_cnt"];
		$hazine_har_bar=$aRow["hazine_har_bar"];
		$my_summary = $aRow["azmayesh_cnt"]*$aRow["hazine_har_bar"];
        $mycount=$mycount+$my_summary;
		$row = array();
		$row["mozoa_azmayesh"]=$mozoa_azmayesh;
		$row["azmayesh_center"]= $azmayesh_center;
		$row["azmayesh_cnt"]=$azmayesh_cnt;
		$row["hazine_har_bar"]=$hazine_har_bar;
		$row["my_summary"]=$my_summary;
		
		$edit= "<a class=\"edit_buttun\" id=\"edit_buttun\" data-toggle=\"modal\" href=\"#basic\" ><i class=\"fa fa-edit\" ></i></a>";
		$delete= "<a class=\"delete_buttun\" id=\"delete_buttun\" data-toggle=\"modal\" href=\"#delete\" ><i class=\"fa fa-trash-o\" ></i></a>";
		
		$cntr++;
		$row["edit"]=$edit;
		$row["cod_azmayesh"]=$cod_azmayesh;
		$row["delete"]=$delete;
		
		$row['DT_RowId']=$cod_azmayesh;
		$output['aaData'][] = $row;
		
	}
	$row = array();
	if($la=="en")
	{
	$row["mozoa_azmayesh"]="Total";
	}else{
	$row["mozoa_azmayesh"]=iconv"مجموع";
	}
	$row["azmayesh_center"]="";
	$row["azmayesh_cnt"]="";
	$row["hazine_har_bar"]="";
	$row["my_summary"]=number_format($mycount);
	$row["edit"]="";
	$row["cod_azmayesh"]="";
	$row["delete"]="";
	$output['aaData'][] = $row;
	
	
	echo json_encode( $output );
}
}