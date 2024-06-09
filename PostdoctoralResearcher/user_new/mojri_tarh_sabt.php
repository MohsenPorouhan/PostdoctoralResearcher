<?php
include("include/database-connect.phtml");
include("include/include.phtml");
include("include/vars.inc.phtml");

$query="select * from tarh where cod_tarh='$cod_tarh'  and version='-1'";
$result=mysql_query($query) or die("Error in selecting data from karshenas elmi ");
$row_fetched=mysql_fetch_array($result);
$tarh_name = $row_fetched["tarh_title_farsi"];
$finished=$row_fetched["finished"];
$first_letter=$row_fetched["first_letter"];

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


if($admin_edit==0)
	if(strcmp($finished,'0')==0)
	{
		$query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='3'";
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
	if (strcmp($action,"add_mojri")==0)
	{
		if(strlen(trim($name)) > 0  && strlen(trim($family)) > 0 &&  strlen(trim($email)) > 0  &&  strstr($email, '@'))
		{
			 
			//$query="select * from mojri where  name = \"$name\" and family=\"$family\" ";
			// $result=mysql_query($query) or die("Error in selecting data from  mojri list ");
			if ( 1 )
			{
				$query = "select * from mojri";
				$result = mysql_query($query) or die("Error in Selecting data from mojri");
				if ( mysql_num_rows($result) > 0 )
				{
					$query = "select max(mojri_code) as max_mojri from mojri";
					$result = mysql_query($query) or die("Error in Selecting data from mojri");
					$row_fetched = mysql_fetch_array($result);
					$maxnum = intval($row_fetched["max_mojri"]);
					$maxnum = $maxnum +1;
				}
				else
					$maxnum=1;
				
				$query  = "insert into mojri set  madrak='$madrak',mobile='$mobile',name=\"$name\" , family=\"$family\", shno = \"$shno\",  birth_date  = \"$birth_date\", work_addr = \"$work_addr\", home_addr = \"$home_addr\", telno = \"$telno\", fax =\"$fax\", melli_code =\"$cod_melli\", email =\"$email\", darajeelmi = '$darajeelmi' , takhasos = \"$takhasos\" ,  semat = \"$semat\", univ_madrak = \"$univ_madrak\" ,country_univ = \"$country_univ\" , mojri_code = \"$maxnum\" , cod_bank=\"$cod_bank\" , bank_name=\"$bank_name\" , shoabe=\"$shoabe\" , hesab=\"$hesab\",sex=\"$sex\"";
                
				$result = mysql_query($query) or die("Error in inserting data into mojri list#1");
				 
				$query = "insert into mojri_tarh set mojri_or_hamkar=\"$mojri_or_hamkar\",mojri_code = \"$maxnum\" , cod_tarh=\"$cod_tarh\" ";

				$result = mysql_query($query) or die("Error in inserting data into mojri_tarh#2");
				
				$query="select * from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='3'";
				
		       $result=mysql_query($query) or die("Error in selecting data from  mojri_tarh ");
		       if ( mysql_num_rows($result) <= 0 )
		       {
		      		$query="insert into tarh_exist_item set cod_tarh='$cod_tarh',item_id='3'";
		       		$result=mysql_query($query) or die("Error in selecting data from  mojri_tarh ");
		       		echo "exist";
		       }
       
				$action="اضافه کردن مجري طرح با نام "."<br>".$name."&nbsp;&nbsp;".$family;
				set_log($action,$admin,date("Y-m-d, g:i a"));
				//message_show("مشخصات مجري /همکار مورد نظر ثبت شد","green");
				$status="add_mojri";
				$action="";
		  $mojri_or_hamkar="";
		  $name="";
		  $family="";
		  $shno="";
		  $birth_date="";
		  $work_addr="";
		  $home_addr="";
		  $telno_home="";
		  $fax="";
		  $melli_code="";
		  $email="";
		  $darajeelmi="";
		  $takhasos="";
		  $semat="";
		  $univ_madrak="";
		  $country_univ="";
		  $hesab="";
		  $bank_name="";
		  $shoabe="";
		  $cod_bank="";
		  $sex="";
		  $telno_work="";
		  $telno="";
		   
			}


			/*
			 else
			{
			 
			$row_fetched = mysql_fetch_array($result);
			$mojri_code = $row_fetched["mojri_code"];
			$query  = "select * from  mojri_tarh where mojri_code = \"$mojri_code\" and cod_tarh=\"$cod_tarh\"  and version='-1'";
			$result = mysql_query($query) or die("Error in selection data from mojri_tarh");
			if(mysql_num_rows($result) <= 0)
			{
			$query  = "insert into mojri_tarh set  mojri_or_hamkar=\"$mojri_or_hamkar\",mojri_code = \"$mojri_code\" , cod_tarh=\"$cod_tarh\" ";
			//echo $query;
			$result = mysql_query($query) or die("Error in inserting data into mojri_tarh");
			$action="اضافه کردن مجري طرح با نام "."<br>".$name."&nbsp;&nbsp;".$family;
			set_log($action,$admin,date("Y-m-d, g:i a"));
			$status="add_mojri";
			$action="";
			$mojri_or_hamkar="";
			$name="";
			$family="";
			$shno="";
			$birth_date="";
			$work_addr="";
			$home_addr="";
			$telno_home="";
			$fax="";
			$melli_code="";
			$email="";
			$darajeelmi="";
			$takhasos="";
			$semat="";
			$univ_madrak="";
			$country_univ="";
			$hesab="";
			$bank_name="";
			$shoabe="";
			$cod_bank="";
			$sex="";
			$telno_work="";
			$telno="";
			}
			}
			*/
			$mojri_or_hamkar="";
			$name="";
			$family="";
			$shno="";
			$birth_date="";
			$work_addr="";
			$home_addr="";
			$telno_home="";
			$fax="";
			$melli_code="";
			$email="";
			$darajeelmi="";
			$takhasos="";
			$semat="";
			$univ_madrak="";
			$country_univ="";
			$hesab="";
			$bank_name="";
			$shoabe="";
			$cod_bank="";
			$sex="";
			$telno_work="";
			$telno="";
			 
		}
		else
			$status="entry_error";
	}
	if (strcmp($action,"delete_mojri")==0)
	{
		$query="delete from mojri_tarh where mojri_code = \"$mojri_code\" and cod_tarh=\"$cod_tarh\"  and version='-1'";

		$result=mysql_query($query) or die("Error in  delete data from karshenas_elmi");
		
	    $query="select * from mojri_tarh where   cod_tarh=\"$cod_tarh\"  and version='-1'";
	    $result=mysql_query($query) or die("Error in selecting data from  mojri_tarh ");
	    if ( mysql_num_rows($result) <= 0 )
	    {
	    	$query="delete from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='3'";
       		$result=mysql_query($query) or die("Error in selecting data from  mojri_tarh ");
       		echo "notexist";
	    }
		$action="حذف مجري طرح از طرح"."<br>".$cod_tarh;
		set_log($action,$admin,date("Y-m-d, g:i a"));
		 
		 
	}


/*	if (strcmp($action,"edit_mojri")==0)
	{
		$query="select * from mojri_tarh , mojri where  mojri.mojri_code='$mojri_code' and mojri_tarh.mojri_code=mojri.mojri_code and mojri_tarh.cod_tarh='$cod_tarh'  and mojri_tarh.version='-1'";
		 
		$result=mysql_query($query) or die("Error in selecting data from mojri");
		if(mysql_num_rows($result) > 0)
		{
			$row_fetched=mysql_fetch_array($result);
			$name=$row_fetched["name"];
			$family=$row_fetched["family"];
			$shno=$row_fetched["shno"];
			$birth_date=$row_fetched["birth_date"];
			$work_addr=$row_fetched["work_addr"];
			$home_addr=$row_fetched["home_addr"];
			$telno_home=$row_fetched["telno_home"];
			$fax=$row_fetched["fax"];
			$melli_code=$row_fetched["melli_code"];
			$email=$row_fetched["email"];
			$darajeelmi=$row_fetched["darajeelmi"];
			$takhasos=$row_fetched["takhasos"];
			$semat=$row_fetched["semat"];
			$univ_madrak=$row_fetched["univ_madrak"];
			$country_univ=$row_fetched["country_univ"];
			$hesab=$row_fetched["hesab"];
			$bank_name=$row_fetched["bank_name"];
			$shoabe=$row_fetched["shoabe"];
			$cod_bank=$row_fetched["cod_bank"];
			$sex=$row_fetched["sex"];
			$telno_work=$row_fetched["telno_work"];
			$telno=$row_fetched["telno"];
			$mojri_or_hamkar=$row_fetched["mojri_or_hamkar"];
			$mobile=$row_fetched["mobile"];
		}
		else
		{
			$mojri_or_hamkar="";
			$name="";
			$family="";
			$shno="";
			$birth_date="";
			$work_addr="";
			$home_addr="";
			$telno_home="";
			$fax="";
			$melli_code="";
			$email="";
			$darajeelmi="";
			$takhasos="";
			$semat="";
			$univ_madrak="";
			$country_univ="";
			$hesab="";
			$bank_name="";
			$shoabe="";
			$cod_bank="";
			$sex="";
			$telno_work="";
			$telno="";
		}
		 
	}*/


	if (strcmp($action,"edit_mojri_sabt")==0)
	{

		if(strlen(trim($name)) > 0  && strlen(trim($family)) > 0 &&  strlen(trim($email)) > 0  &&  strstr($email, '@') )
		{
			

				$query  = "update mojri set   madrak='$madrak',mobile='$mobile',sex=\"$sex\", name=\"$name\" , family=\"$family\", shno = \"$shno\",  birth_date  = \"$birth_date\", work_addr = \"$work_addr\", home_addr = \"$home_addr\", telno = \"$telno\", fax =\"$fax\", melli_code =\"$cod_melli\", email =\"$email\", darajeelmi = '$darajeelmi' , takhasos = \"$takhasos\" ,  semat = \"$semat\", univ_madrak = \"$univ_madrak\" ,country_univ = \"$country_univ\" ,  cod_bank=\"$cod_bank\" , bank_name=\"$bank_name\" , shoabe=\"$shoabe\" , hesab=\"$hesab\",sex=\"$sex\" where mojri_code = \"$mojri_code\" ";
				echo $query;
				$result = mysql_query($query) or die("Error in inserting data into mojri list#1");
				$query = "update mojri_tarh set mojri_or_hamkar=\"$mojri_or_hamkar\" where mojri_code = \"$mojri_code\" and cod_tarh=\"$cod_tarh\" and version='-1'";
				$result = mysql_query($query) or die("Error in inserting data into mojri_tarh#2");
				$action="ويرايش مجري طرح با عنوان"."<br>".$name."&nbsp;&nbsp;".$family;
				set_log($action,$admin,date("Y-m-d, g:i a"));
				$status="add_mojri";
			
		}
		else
			$status="entry_error";
	}
	
	if(strcmp($action,"mojri_tarh_list")==0){
		
		$aColumns = array("mojri.mojri_code", 'name', 'family','mojri_or_hamkar','darajeelmi','takhasos','email','mobile');
	
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
		SELECT mojri.mojri_code,name,family,mojri_or_hamkar,darajeelmi,takhasos,email,mobile
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
		$query_daraje_elmi = "select * from darajeelmi where darajeelmi = \"".$aRow["darajeelmi"]."\"";
		$daraje_result = mysql_query($query_daraje_elmi) or die ("Error in selecting data from darajeelmi");
		if($la=="en"){
				if(mysql_num_rows($daraje_result) > 0)
				{
					$daraje_row_fetched=mysql_fetch_array($daraje_result);
					$daraje_elmi = $daraje_row_fetched["darajeelmi_english_desc"];
				}
				
				else
					$daraje_elmi = "";
		}else{
				if(mysql_num_rows($daraje_result) > 0)
				{
					$daraje_row_fetched=mysql_fetch_array($daraje_result);
					$daraje_elmi = $daraje_row_fetched["darajeelmi_desc"];
				}
				
				else
					$daraje_elmi = "";	
		}
		$row = array();
		$row["mojri_code"]=$aRow["mojri_code"];
		$row["name"]=$aRow["name"];
		$row["family"]=$aRow["family"];
		
			// Special output formatting for 'version' column
			
				$hamkari=$aRow["mojri_or_hamkar"];
				if($la=="en")
				{
					if(strcmp(trim($hamkari),"0")==0)
						$hamkari="Administrator";
					else if(strcmp(trim($hamkari),"1")==0)
						$hamkari="Assistance";
					else
						$hamkari="Second Administrator";
				}
				else 
				{
					if(strcmp(trim($hamkari),"0")==0)
						$hamkari="مجري";
					else if(strcmp(trim($hamkari),"1")==0)
						$hamkari="همکار";
					else
						$hamkari="مجري دوم";
				}
				//$hamkari= iconv('windows-1256', 'utf-8', ($hamkari));
				$row["mojri_or_hamkar"]=$hamkari;
				$row["darajeelmi"]=$daraje_elmi;
				$row["takhasos"]=$aRow["takhasos"];
				$row["email"]=$aRow["email"];
				$row["mobile"]=$aRow["mobile"];
                $edit= "<a class=\"btn edit_btn\" id=\"edit_buttun\" data-toggle=\"modal\" href=\"#basic\" ><i class=\"fa fa-edit\" ></i></a>";
		        $delete= "<a class=\"btn delete_btn\" id=\"delete_buttun\" data-toggle=\"modal\" href=\"#delete\" ><i class=\"fa fa-trash-o\" ></i></a>";
				
			
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