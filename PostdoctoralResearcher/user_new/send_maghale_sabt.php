<?php
include("include/database-connect.phtml");
include("include/include.phtml");
include("include/vars.inc.phtml");
if(isset($action))
{
	if (strcmp($action,"article_upload")==0)
	{

		$file_cnt=0;
		$dir_name="../maghale/".$maghale_file_id;
		if ($dir = @opendir($dir_name))
		{
			 
			$mydir = dir($dir_name);
			//while(($file = $mydir->read()) !== false)
			while($file = $mydir->read())
				if( !(strcmp(trim($file),".")==0 || strcmp(trim($file),"..")==0) )
					$file_cnt++;
				closedir($dir);
				 
		}

		if($file_cnt < 12)
		{
			$status_upload=upload_file("../maghale",$maghale_file_id,"");
			if(!strcmp($status_upload,"-5") == 0 and !strcmp($status_upload,"-2") == 0 )
			{
				// $status="upload_error";
				$action="ضميمه ثبت شد"."<br>".$cod_tarh;
				set_log($action,$admin,date("Y-m-d, g:i a"));
				$fupload_name=$_FILES["fupload"]["name"];
				$address="../maghale"."/".$maghale_file_id."/".$fupload_name;
				$query="update maghale set address_file='$address' where cod_tarh='$cod_tarh' and maghale_id='$maghale_file_id'";					
				echo $query; 
				$result=mysql_query($query) or die("Error in selecting data from tarh  11");
				echo "true";
			}
			else
				echo $status_upload;
		}
			 
    }
    
    if (strcmp($action,"delete_article_file")==0)
    {
    	delete_file("../maghale",$maghale_file_id,$delete_id);
    	$action="ضميمه حذف شد"."<br>".$maghale_file_id;
    	set_log($action,$admin,date("Y-m-d, g:i a"));
    	$fupload_name=$_FILES["fupload"]["name"];
    	$address="../maghale"."/".$maghale_file_id."/".$fupload_name;
    	$query="update maghale set address_file='NULL' where cod_tarh='$cod_tarh' and maghale_id='$maghale_file_id'";
    	//$query="update maghale set address_file='' where cod_tarh='$cod_tarh',maghle_id='$maghale_file_id'";
    	$result=mysql_query($query) or die("Error in selecting data from tarh  11");
    	echo "deleted";
    }
	
	if (strcmp($action,"add_tarh")==0)
	{

		if( (strlen(trim($maghale_title)) > 0)  && (strlen(trim($journal_name)) > 0)  &&   strlen(trim($issn_input)) > 0 && strlen(trim($year_publish_shamsi)) > 2 && strlen(trim($year_publish_milady)) > 2 &&   strcmp($indexing,"-1")!=0 &&   strcmp($maghale_type,"-1")!= 0)
		{
		
			$maghale_title=addslashes($maghale_title);
		
			 
			$query="select * from maghale where maghale_title =\"$maghale_title\" and creator=\"$admin\" and cod_tarh='$cod_tarh'";
			//  echo $query;
			$result=mysql_query($query) or die("Error in selecting data from tarh  12");
		
			if ( mysql_num_rows($result) <= 0 )
			{
				$query="insert into maghale  set  creator='$admin',cod_tarh='$cod_tarh',maghale_title='$maghale_title',journal_name='$journal_name',issn='$issn_input',outer_level='$outer_level',Affiliation='$affiliation',year_publish_shamsi='$year_publish_shamsi',year_publish_milady='$year_publish_milady',indexing='$indexing',maghale_type='$maghale_type',Acknowledgment='$Acknowledgment',journal_link='$journal_link',impact_factor='$impact_factor'";
				$result=mysql_query($query) or die("Error in selecting data from tarh  11");
				$query="select * from maghale where  maghale_title =\"$maghale_title\" and creator=\"$admin\" and cod_tarh='$cod_tarh'";
				$result=mysql_query($query) or die("Error in selecting data from tarh  11");
				$row_fetched=mysql_fetch_array($result);
				$maghale_id=$row_fetched["maghale_id"];
				?>
<!-- 		           <script language="javascript"> -->
		           window.location="<? echo "upload_maghale.phtml?admin=$admin&seed=$seed&cod_tarh=$cod_tarh&maghale_id=$maghale_id";  ?>";
<!-- 		           </script> -->
		           <?
		
		         }
		         else
		          $status="duplicate_entry";
		    }
		    else
		      $status="entry_error";
	}
	
	if (strcmp($action,"delete")==0)
	{
		$query="delete from maghale where maghale_id = \"$maghale_id\" and cod_tarh=\"$cod_tarh\" ";
    
	    $result=mysql_query($query) or die("Error in  delete data from karshenas_elmi");
	    $action="حذف مقاله طرح از طرح"."<br>".$cod_tarh;
        set_log($action,$admin,date("Y-m-d, g:i a"));
        
      delete_file("../maghale",$maghale_id,"");
    	 $action="ضميمه حذف شد"."<br>".$maghale_id;
           set_log($action,$admin,date("Y-m-d, g:i a"));
		 
		 
	}

	if (strcmp($action,"edit")==0)
	{
		if( (strlen(trim($maghale_title)) > 0)  && (strlen(trim($journal_name)) > 0)  &&   strlen(trim($issn_input)) > 0 && strlen(trim($year_publish_shamsi)) > 2 && strlen(trim($year_publish_milady)) > 2 &&   strcmp($indexing,"-1")!=0 &&   strcmp($maghale_type,"-1")!= 0)
		{
		
			$maghale_title=addslashes($maghale_title);
		
			$query="update  maghale  set  maghale_title='$maghale_title',journal_name='$journal_name',issn='$issn_input',outer_level='$outer_level',Affiliation='$affiliation',year_publish_shamsi='$year_publish_shamsi',year_publish_milady='$year_publish_milady',indexing='$indexing',maghale_type='$maghale_type',impact_factor='$impact_factor' where maghale_id='$maghale_id' and cod_tarh='$cod_tarh'";
			$result=mysql_query($query) or die("Error in selecting data from tarh  11");
		
				
			$maghale_title="";
			$journal_name="";
			$issn="";
			$outer_level="";
			$affiliation="";
			$year_publish_shamsi="";
			$year_publish_milady="";
			$indexing="";
			$maghale_type="";
		
		}
		else
			$status="entry_error";
	}
if(strcmp($action,"list")==0){
		
		$aColumns = array('maghale_title','journal_name','impact_factor','issn','outer_level', 'Affiliation','year_publish_shamsi','year_publish_milady','indexing','maghale_type','emtiaz','maghale_id');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "maghale_id";
	
	/* DB table to use */
	$sTable = "maghale";
	
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
		SELECT maghale_title,journal_name,impact_factor,issn,outer_level, Affiliation,year_publish_shamsi,year_publish_milady,indexing,maghale_type,emtiaz,maghale_id
		FROM   $sTable
		WHERE cod_tarh='$cod_tarh'
		$sWhere
		group by maghale_id
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
		WHERE maghale_id=maghale_id
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
		$outer_level=$aRow["outer_level"];
		if($la=="en")
		{
			if(strcmp($outer_level,"0")==0)
				$outer_level="First";
			else if(strcmp($outer_level,"1")==0)
				$outer_level="Answerable";
			else if(strcmp($outer_level,"2")==0)
				$outer_level="Both of Them";
			else if(strcmp($outer_level,"3")==0)
				$outer_level="Others";
		}else{
			if(strcmp($outer_level,"0")==0)
				$outer_level="اول";
			else if(strcmp($outer_level,"1")==0)
				$outer_level="مسئول";
			else if(strcmp($outer_level,"2")==0)
				$outer_level="هر دو";
			else if(strcmp($outer_level,"3")==0)
				$outer_level="ساير";
		}
		 
		$affiliation=$aRow["Affiliation"];
		if($la=="en")
		{
			if(strcmp($affiliation,"0")==0)
				$affiliation="Don`t Have";
			else if(strcmp($affiliation,"1")==0)
				$affiliation="Have";
		}else{
			if(strcmp($affiliation,"0")==0)
			$affiliation="ندارد";
			else if(strcmp($affiliation,"1")==0)
			$affiliation="دارد";
		}
		 
		$indexing=$aRow["indexing"];
		$q="select * from maghale_indexing where index_id='$indexing'";
		$re=mysql_query($q) or die("Error in selecting data from karshenas elmi");
		$my=mysql_fetch_array($re);
		$indexing=$my["indexing_desc"];
		
		$maghale_type=$aRow["maghale_type"];
		$q="select * from maghale_type where maghale_type_id='$maghale_type'";
		$re=mysql_query($q) or die("Error in selecting data from karshenas elmi");
		$my=mysql_fetch_array($re);
		$maghale_type=$my["maghale_type_desc"];
		
		$emtiaz = $aRow["emtiaz"];
		$maghale_id = $aRow["maghale_id"];
		
		$issn=$aRow["issn"];
		$q="select * from issn where issn_id='$issn'";
		$re=mysql_query($q) or die("Error in selecting data from karshenas elmi");
		$my=mysql_fetch_array($re);
		$p_issn=$my["p_issn"];
		
		$row = array();
		$row["maghale_id"]=$maghale_id;
		$row["maghale_title"]=$aRow["maghale_title"];
		$row["journal_name"]=$aRow["journal_name"];
		$row["impact_factor"]=$aRow["impact_factor"];
		$row["issn"]=$p_issn;
		
			// Special output formatting for 'version' column
			
// 				$hamkari=$aRow["mojri_or_hamkar"];
// 				if(strcmp(trim($hamkari),"0")==0)
// 					$hamkari="مجري";
// 				else if(strcmp(trim($hamkari),"1")==0)
// 					$hamkari="همکار";
// 				else
// 					$hamkari="مجري دوم";
				//$hamkari= iconv('windows-1256', 'utf-8', ($hamkari));
				$row["outer_level"]=$outer_level;
				$row["affiliation"]=$affiliation;
				$row["year_publish_shamsi"]=$aRow["year_publish_shamsi"];
				$row["year_publish_milady"]=$aRow["year_publish_milady"];
				$row["indexing"]=$indexing;
				$row["maghale_type"]=$maghale_type;
				$row["emtiaz"]=$emtiaz;
				if($la=="en")
					$row["article_file"]="<a class=\"btn article_file_btn\" id=\"article_file_buttun\" data-toggle=\"modal\" href=\"#article_file_modal\" >Article File</a>";
                else 
                	$row["article_file"]="<a class=\"btn article_file_btn\" id=\"article_file_buttun\" data-toggle=\"modal\" href=\"#article_file_modal\" >فايل مقاله</a>";
				$edit= "<a class=\"btn edit_btn\" id=\"edit_buttun\" data-toggle=\"modal\" href=\"#basic\" ><i class=\"fa fa-edit\" ></i></a>";
		        $delete= "<a class=\"btn delete_btn\" id=\"delete_buttun\" data-toggle=\"modal\" href=\"#delete\" ><i class=\"fa fa-trash-o\" ></i></a>";
				
			
			$row["edit"]=$edit;
			$row["delete"]=$delete;
			
		
		$cntr++;
		$row[]=$edit;
		$row[]=$delete;
		$row["ss"]=null;
		$row['DT_RowId']=$cntr;
		$output['aaData'][] = $row;
		//echo $row[1];
	}
	
	echo json_encode( $output );
		
	}
}

?>