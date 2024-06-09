<?php
include("include/database-connect.phtml");
include("include/include.phtml");
	//Connect to MySQL Server
//mysql_connect($dbhost, $dbuser, $dbpass);
	//Select Database
//mysql_select_db("") or die(mysql_error());
	// Retrieve data from Query String

	// Escape User Input to help prevent SQL Injection

	//build query
	//$family = str_replace ( "&#1740;" ,"&#1610;", $family );
				//$family= iconv('windows-1256', 'utf-8', $family); 
				
 if(strcmp($action,"list")==0)
{
	$aColumns = array();
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "cod_tarh";
	
	/* DB table to use */
	$sTable = "tarh";
	
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

	
	
	/*
	 * Filtering
	* NOTE this does not match the built-in DataTables filtering which does it
	* word by word on any field. It's possible to do here, but concerned about efficiency
	* on very large tables, and MySQL's regex functionality is very limited
	*/

	
	
	/*
	 * SQL queries
	* Get data to display
	*/
	$sQuery = "
	SELECT *
	FROM   $sTable
	WHERE cod_tarh='$cod_tarh' and version='-1'
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
			WHERE cod_tarh='$cod_tarh' and version='-1'
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
// 	while ( $aRow = mysql_fetch_array( $rResult ) )
// 	{
        $aRow = mysql_fetch_array( $rResult );
		$first_ostad=$aRow['first_ostad'];
		$second_ostad=$aRow['second_ostad'];
		$first_ostad_moshaver=$aRow['first_ostad_moshaver'];
		$second_ostad_moshaver=$aRow['second_ostad_moshaver'];
		$email=$aRow['creator'];
	
			// Special output formatting for 'version' column
		
		
			if(strcmp($first_ostad,"")!=0 )
			{
				$row = array();
				$qu="select * from user_login where email='$first_ostad'";
				$rsl=mysql_query($qu) or die("Error in selecting data from user_login21");
				$rf=mysql_fetch_array($rsl);
				$name1=$rf['name'];
				$family1=$rf['family'];
				
				$takhasos1=$rf['takhasos'];
				if($la=="en")
					$row["position1"]='Supervisor1';
				else 
					$row["position1"]='استاد راهنماي اول';
				$row["name"]=$name1;
				$row["family"]=$family1;
				$row["takhasos"]=$takhasos1;
				$delete="<a class=\"btn delete_btn\" data-toggle=\"modal\" href=\"#delete\" ><i class=\"fa fa-trash-o\" ></i></a>";
				//$row["edit"]=$edit;
				$row["delete"]=$delete;
				$output['aaData'][] = $row;
			}
			if(strcmp($second_ostad,"")!=0 )
			{
				$row = array();
				$qu="select * from user_login where email='$second_ostad'";
				$rsl=mysql_query($qu) or die("Error in selecting data from user_login21");
				$rf=mysql_fetch_array($rsl);
				$name1=$rf['name'];
				$family1=$rf['family'];
				$takhasos1=$rf['takhasos'];
				
				if($la=="en")
					$row["position1"]='Supervisor2';
				else
					$row["position1"]='استاد راهنماي دوم';
				$row["name"]=$name1;
				$row["family"]=$family1;
				$row["takhasos"]=$takhasos1;
				$delete="<a class=\"btn delete_btn\" data-toggle=\"modal\" href=\"#delete\" ><i class=\"fa fa-trash-o\" ></i></a>";
				//$row["edit"]=$edit;
				$row["delete"]=$delete;
				$output['aaData'][] = $row;
			}
			if(strcmp($first_ostad_moshaver,"")!=0 )
			{
				$row = array();
				$qu="select * from user_login where email='$first_ostad_moshaver'";
				$rsl=mysql_query($qu) or die("Error in selecting data from user_login21");
				$rf=mysql_fetch_array($rsl);
				$name1=$rf['name'];
				$family1=$rf['family'];
				$takhasos1=$rf['takhasos'];
			
				if($la=="en")
					$row["position1"]='Supervisor3';
				else 
					$row["position1"]='استاد مشاور اول';
				$row["name"]=$name1;
				$row["family"]=$family1;
				$row["takhasos"]=$takhasos1;
				$delete="<a class=\"btn delete_btn\" data-toggle=\"modal\" href=\"#delete\" ><i class=\"fa fa-trash-o\" ></i></a>";
				//$row["edit"]=$edit;
				$row["delete"]=$delete;
				$output['aaData'][] = $row;
			}
			if(strcmp($second_ostad_moshaver,"")!=0 )
			{
				$row = array();
				$qu="select * from user_login where email='$second_ostad_moshaver'";
				$rsl=mysql_query($qu) or die("Error in selecting data from user_login21");
				$rf=mysql_fetch_array($rsl);
				$name1=$rf['name'];
				$family1=$rf['family'];
				$takhasos1=$rf['takhasos'];
				if($la=="en")
					$row["position1"]='Supervisor4';
				else 
					$row["position1"]='استاد مشاور دوم';
				$row["name"]=$name1;
				$row["family"]=$family1;
				$row["takhasos"]=$takhasos1;
				$delete="<a class=\"btn delete_btn\" data-toggle=\"modal\" href=\"#delete\" ><i class=\"fa fa-trash-o\" ></i></a>";
				//$row["edit"]=$edit;
				$row["delete"]=$delete;
				$output['aaData'][] = $row;
			}
		
			
			
					
		    //$edit="<a class=\"edit_btn\" data-toggle=\"modal\" href=\"#basic\" ><img border=\"0\" src=\"image/button_edit.png\" alt=\"Edit\" ></a>";
			
			//$row["cod_zarib"]=null;
			$cntr++;
							//$row[]=$edit;
							//$row[]=$delete;
							//$row['DT_RowId']=$cntr;
						
							//echo $row[1];
// 	}
	
	echo json_encode( $output );
 }
if(strcmp($action,"search")==0)
{
				$family = mysql_real_escape_string($family);
				$family=$family;
		if(isset($name) )
			{
				$name=$name;
				$name_caution=" name like '%$name%' ";
			}
			else 
				$name_caution="";
				
			 if(isset($family) )
			{
				$family_caution=" family like '%$family%' ";
			}
			else 
				$family_caution="1";
				
			 if(isset($email) )
			{
				$email_caution=" email like '%$email%' ";
			}
			else 
				$email_caution="1";
				
			 if(isset($takhasos) )
			{
			//	$takhasos=iconv('utf-8', 'windows-1256', ($takhasos));
				$takhasos_caution=" takhasos like '%$takhasos%' ";
			}
			else 
				$takhasos_caution="1";
		
		  
		$query = "select * from user_login where $name_caution and $family_caution and $email_caution and $takhasos_caution and payan_name='0'";
		//echo $query;
		
		//if(isset($family))
		//	$query .= " AND family='$family'";
		//if(isset($email))
			//$query .= " AND email = '$email'";
		//if(isset($takhasos))
			//$query .= " AND takhasos = '$takhasos'";
			//Execute query
		$qry_result = mysql_query($query) or die(mysql_error());
		$row_num = mysql_num_rows($qry_result);
		//echo $row_num;
			//Build Result String
		if($la=="en")
		{
			$display_string = "<table class='table table-striped table-bordered table-hover' id='sample_2'>";
			$display_string .= "<thead>";
			$display_string .= "<tr>";
			$display_string .= "<th>First Name</th>";
			$display_string .= "<th>Last Name</th>";
			$display_string .= "<th>Email</th>";
			$display_string .= "<th>Expert</th>";
			$display_string .= "<th>Choose</th>";
		}
		else
		{
			$display_string = "<table class='table table-striped table-bordered table-hover' id='sample_2'>";
			$display_string .= "<thead>";
			$display_string .= "<tr>";
			$display_string .= "<th>نام</th>";
			$display_string .= "<th>نام خانوادگي</th>";
			$display_string .= "<th>ايميل</th>";
			$display_string .= "<th>تخصص</th>";
			$display_string .= "<th>انتخاب</th>";
		}
		$display_string .= "</tr>";
		$display_string .= "</thead>";
		// Insert a new row in the table for each person returned
		while($row = mysql_fetch_array($qry_result)){
			$display_string .= "<tr>";
			$display_string .= "<td>$row[name]</td>";
			$display_string .= "<td>$row[family]</td>";
			$display_string .= "<td>$row[email]</td>";
			$display_string .= "<td>$row[takhasos]</td>";
			$display_string .= "<td><input type='radio' name='ostad_name' value='$row[email]'</td>";
			$display_string .= "</tr>";
			
		}
		//echo "Query: " . $query . "<br />";
		//echo $row_num;
		$display_string .= "</table>";
		echo $display_string;
		//echo json_encode( $display_string );

}
if(strcmp($action,"sabt")==0)
{
	 if($ostad_type=='0'){
 	 $query1="update tarh set first_ostad='$ostad_name' where cod_tarh='$cod_tarh' ";}
	 else if($ostad_type=='1'){
	 $query1="update tarh set second_ostad='$ostad_name'  where cod_tarh='$cod_tarh' ";}
	 else if($ostad_type=='2'){
	 $query1="update tarh set first_ostad_moshaver='$ostad_name'  where cod_tarh='$cod_tarh' ";}
	 else if($ostad_type=='3'){
	 $query1="update tarh set second_ostad_moshaver='$ostad_name'  where cod_tarh='$cod_tarh' ";}
	 
	 $query="select * from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='15'";
	 
	 $result=mysql_query($query) or die("Error in selecting data from  mojri_tarh ");
	 if ( mysql_num_rows($result) <= 0 )
	 {
	 	$query="insert into tarh_exist_item set cod_tarh='$cod_tarh',item_id='15'";
	 	$result=mysql_query($query) or die("Error in selecting data from  mojri_tarh ");
	 	echo "exist";
	 }
	 
	$result=mysql_query($query1) or die("Error in selecting data from user_login1");
	//echo $ostad_type;
}
if (strcmp($action,"delete")==0)
{
//$position1=iconv('utf-8', 'windows-1256', ($position1));
if($position1=='استاد راهنماي اول' or $position1=='Supervisor1'){
	$query1="update tarh set first_ostad='' where cod_tarh='$cod_tarh'";}
	else if($position1=='استاد راهنماي دوم' or $position1=='Supervisor2'){
	 $query1="update tarh set second_ostad=''  where cod_tarh='$cod_tarh' ";}
	 else if($position1=='استاد مشاور اول' or $position1=='Supervisor3'){
	 	$query1="update tarh set first_ostad_moshaver=''  where cod_tarh='$cod_tarh' ";}
	 	else if($position1=='استاد مشاور دوم' or $position1=='Supervisor4'){
	 		$query1="update tarh set second_ostad_moshaver=''  where cod_tarh='$cod_tarh' ";}
	 		//echo $query1;
	 		$result=mysql_query($query1) or die("Error in  delete data from karshenas_elmi");

	 		$action="استاد مورد نظر حذف شد "." با کد ".$cod_tarh;
	 		set_log($action,$admin,date("Y-m-d, g:i a"));
	 		
	 		$query="select * from tarh where   cod_tarh=\"$cod_tarh\" and first_ostad='' and second_ostad='' and first_ostad_moshaver='' and second_ostad_moshaver=''";
	 		$result=mysql_query($query) or die("Error in selecting data from  mojri_tarh ");
	 		//echo $query;
	 		if ( mysql_num_rows($result))
	 		{
	 			$query="delete from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='15'";
	 			$result=mysql_query($query) or die("Error in selecting data from  mojri_tarh ");
	 			echo "notexist";
	 		}
}
?>