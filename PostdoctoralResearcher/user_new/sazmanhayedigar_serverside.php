<?
include("include/database-connect.phtml");
include("include/include.phtml");
//echo $cod_tarh." ".$action." ".$name_var." ".$var_type;

if(isset($action))
{
  if (strcmp($action,"sabt")==0)
  {

     if(strlen(trim($eatebare_sazmanha_organ)) > 0 &&  strlen(trim($eatebare_sazmanha_value)) > 0 &&  strlen(trim($eatebare_sazmanha_pardakht)) > 0 )
     {
      $query="select * from eatebar_sazmanha where  eatebare_sazmanha_organ=\"$eatebare_sazmanha_organ\" and eatebare_sazmanha_value=\"$eatebare_sazmanha_value\" and eatebare_sazmanha_pardakht=\"$eatebare_sazmanha_pardakht\"  and cod_tarh=\"$cod_tarh\"  and version='-1'";
      $result=mysql_query($query) or die("Error in selecting data from  eatebar sazmanha ");
      if ( mysql_num_rows($result) <= 0 )
      {


        $query  = "insert into eatebar_sazmanha set eatebare_sazmanha_organ=\"$eatebare_sazmanha_organ\", letter_number=\"$letter_number\", letter_date=\"$letter_date\",eatebare_sazmanha_value=\"$eatebare_sazmanha_value\",eatebare_sazmanha_pardakht=\"$eatebare_sazmanha_pardakht\",cod_tarh=\"$cod_tarh\" ";
        //echo $query;
        $result = mysql_query($query) or die("Error in inserting data into eatebar sazmanha");
       
       $query="select * from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='12'";
       $result=mysql_query($query) or die("Error in selecting data from tarh_exist_item");
       if ( mysql_num_rows($result) <= 0 )
       {
      		$query="insert into tarh_exist_item set cod_tarh='$cod_tarh',item_id='12'";
       		$result=mysql_query($query) or die("Error in selecting data from  tarh_exist_item ");
       		echo "exist";
       }
       
        $action="ثبت تامين اعتبار سازمان ها "."<br>".$name."&nbsp;&nbsp;".$family;
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

     if(strlen(trim($eatebare_sazmanha_organ)) > 0 &&  strlen(trim($eatebare_sazmanha_value)) > 0 &&  strlen(trim($eatebare_sazmanha_pardakht)) > 0 )
     {
      
        $query  = "update   eatebar_sazmanha set eatebare_sazmanha_organ=\"$eatebare_sazmanha_organ\", letter_number=\"$letter_number\", letter_date=\"$letter_date\",eatebare_sazmanha_value=\"$eatebare_sazmanha_value\",eatebare_sazmanha_pardakht=\"$eatebare_sazmanha_pardakht\",new_update='1' where id='$id' ";
        $result = mysql_query($query) or die("Error in inserting data into eatebar sazmanha");
       
        $action="ويرايش تامين اعتبار سازمان ها"."<br>".$name."&nbsp;&nbsp;".$family;
        set_log($action,$admin,date("Y-d-m"));

     
     }
  }
if (strcmp($action,"delete")==0)
  {

        $query  = "delete from  eatebar_sazmanha  where id='$id' ";
        $result = mysql_query($query) or die("Error in inserting data into eatebar_sazmanha");
   		
        $query="select * from eatebar_sazmanha where   cod_tarh=\"$cod_tarh\"  and version='-1'";
	    $result=mysql_query($query) or die("Error in selecting data from  eatebar_sazmanha ");
	    if ( mysql_num_rows($result) <= 0 )
	    {
	    	$query="delete from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='12'";
       		$result=mysql_query($query) or die("Error in selecting data from  tarh_exist_item ");
       		echo "notexist";
	    }
       
        $action="حذف از تامين اعتبار سازمان ها"."<br>".$name."&nbsp;&nbsp;".$family;
        set_log($action,$admin,date("Y-d-m"));

  }
  


  if (strcmp($action,"sazmanhayedigar_list")==0){

	$aColumns = array( 'eatebare_sazmanha_organ','letter_number','letter_date','eatebare_sazmanha_value','eatebare_sazmanha_pardakht');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "id";
	
	/* DB table to use */
	$sTable = "eatebar_sazmanha";
	
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
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns)).",id
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
		$id=$aRow["id"];
		
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			//echo $aColumns[$i]["db"];
			//echo $aRow[ $aColumns[$i]["db"]];
		if ( $aColumns[$i] == "eatebare_sazmanha_pardakht" )
			{
				/* Special output formatting for 'version' column */
				if($la=="en")
					{
						if($aRow["eatebare_sazmanha_pardakht"]==0)
					         $eatebare_sazmanha_pardakht="The budget will be received by the supervisor";
					    else
						     $eatebare_sazmanha_pardakht="The budget will be initially received by Tums and then will be given to the supervisor";
					}
				else{
						if($aRow["eatebare_sazmanha_pardakht"]==0)
					         $eatebare_sazmanha_pardakht="اعتبار توسط مجري دريافت مي شود";
					    else
						     $eatebare_sazmanha_pardakht="اعتبار به دانشگاه پرداخت ميشود تا از طريق قرارداد به مجري پرداخت شود";
				
					}
				
				//$eatebare_sazmanha_pardakht = str_replace ( "&#1740;" ,"&#1610;", $eatebare_sazmanha_pardakht );
				//$eatebare_sazmanha_pardakht= iconv('windows-1256', 'utf-8', $eatebare_sazmanha_pardakht); 
				$row[$aColumns[$i]] = $eatebare_sazmanha_pardakht;
				  
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
		$row["id"]=$id;
		$row["delete"]=$delete;
		
		$row['DT_RowId']=$id;
		$output['aaData'][] = $row;
		
	}
	
	//$output['aaData'][] = $row;
	
	
	echo json_encode( $output );     
	}
}