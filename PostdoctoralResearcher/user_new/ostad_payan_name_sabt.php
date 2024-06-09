<?php
include("include/database-connect.phtml");
include("include/include.phtml");
if(isset($action))
{
if(strcmp($action,"select")==0)
{		
$aColumns = array('cod_tarh','tarh_title_farsi','daneshjo_no','fullname','maghtah','daneshkade','type_ostad','farsistartdate','accepttarh','payanname_akhlagh_status','name_family_sender');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "cod_tarh";
	 
	/* DB table to use */
	//user_login,darajeelmi,daneshkade,group_karshenasan,group_karshenasan_tarh
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
		{$sWhere .= 
			$sWhere .= " cod_tarh "." LIKE '%".mysql_real_escape_string( $search )."%'";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	$ostad_type=$_GET["ostad_type"];
	if ( isset($ostad_type))
	{
		if(strcmp($ostad_type,"-1")==0)
		{
			$ostad_taype1_caution="(first_ostad='$admin' or second_ostad='$admin' or third_ostad='$admin' or forth_ostad='$admin' or  first_ostad_moshaver='$admin' or second_ostad_moshaver='$admin' or third_ostad_moshaver='$admin' or forth_ostad_moshaver='$admin')";
			$sWhere .= "and (";
			$sWhere.=$ostad_taype1_caution;
			$sWhere .= ')';
		}
		elseif(strcmp($ostad_type,"0")==0){
			$ostad_taype1_caution="(first_ostad='$admin' or second_ostad='$admin' or third_ostad='$admin' or forth_ostad='$admin')";
			$sWhere .= "and (";
			$sWhere .= $ostad_taype1_caution;
			$sWhere .= ')';
		}
		elseif(strcmp($ostad_type,"1")==0){
			$ostad_taype1_caution="(first_ostad_moshaver='$admin' or second_ostad_moshaver='$admin' or third_ostad_moshaver='$admin' or forth_ostad_moshaver='$admin')";
			$sWhere .= "and (";
			$sWhere .= $ostad_taype1_caution;
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
	    SELECT *
	    
		FROM   $sTable
		WHERE archieved='0' and indoing='0' and  payannameh='1' and   is_tarh='0' and ready_gharardad='0'   and version=\"-1\" 
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
		WHERE archieved='0' and indoing='0' and  payannameh='1' and   is_tarh='0' and ready_gharardad='0'   and version=\"-1\" 
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
	$i=0;
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		  $cod_tarh=$aRow["cod_tarh"];
  
  $moshaver_amar=$aRow["moshaver_amar"];
  $moshaver_tarrah=$aRow["moshaver_tarrah"];
  $first_ostad=$aRow["first_ostad"];
   $first_ostad=strtolower($first_ostad);
    $admin=strtolower($admin);
  $first_ostad_flag='0';
  if(strcmp($first_ostad,"$admin")==0)
    $first_ostad_flag='1';
  
  $query="select karshenasan.*,karshenasan_tarh.*,karshenasan_tarh_note.comment_karshenas,karshenasan_tarh_note.note_date,karshenasan_tarh_note.id as main_note_id from karshenasan,karshenasan_tarh_note,karshenasan_tarh where karshenasan_tarh.karshenasi_type='1'  and karshenasan_tarh.finished='1' and karshenasan_tarh.cod_tarh=karshenasan_tarh_note.cod_tarh and karshenasan_tarh.cod_karshenas=karshenasan_tarh_note.cod_karshenas  and  karshenasan_tarh.cod_tarh='$cod_tarh' and karshenasan.cod_karshenas=karshenasan_tarh_note.cod_karshenas and mojri_view='1' order by karshenasan_tarh_note.id desc";
  
   $myq1="select * from group_karshenasan,group_karshenasan_tarh where group_karshenasan_tarh.cod_tarh='$cod_tarh' and group_karshenasan.cod_karshenas=group_karshenasan_tarh.cod_karshenas and group_karshenasan.karshenas_type='1'  and (group_karshenasan.username='rahmani' and group_karshenasan.creator='rahmani')";

 // $query="select karshenasan_tarh.*   from  karshenasan_tarh where karshenasan_tarh.karshenasi_type='1'  and karshenasan_tarh.finished='1'  and  karshenasan_tarh.cod_tarh='$cod_tarh' and mojri_view='1' ";
		  				  
 // echo $query;
  $result_karshenasan_notes=mysql_query($myq1) or die("Error in selecting data from group_karshenasan_tarh 2");
$result_karshenasan_notes_cnt=mysql_num_rows($result_karshenasan_notes);

   $tarh_select=$aRow["tarh_select"];
  $tarh_select_desc="";
  if(strcmp($tarh_select,'0')==0)
   $tarh_select_desc="طرح دانشجويي";
  if(strcmp($tarh_select,'1')==0)
   $tarh_select_desc="HSR";
  if(strcmp($tarh_select,'2')==0)
   $tarh_select_desc="طرح غير پايان نامه اي";
  if(strcmp($tarh_select,'3')==0)
   $tarh_select_desc="طرح پايان نامه اي";
   if(strcmp($tarh_select,'4')==0)
   $tarh_select_desc="فناوري اطلاعات";
  
  $submit_moshaver_amar=$aRow["submit_moshaver_amar"];
  $submit_moshaver_tarrah=$aRow["submit_moshaver_tarrah"];
  
  
  
  
  
  $in_doing=$aRow["indoing"];
  $ready_gharardad=$aRow["ready_gharardad"];
  $finalized=$aRow["finalized"];
  $confirm_daneshkade_title=$aRow["confirm_daneshkade_title"];
  $tarh_select=$aRow["tarh_select"];
  
   $cod_daneshkade=$aRow["cod_daneshkade"];
  $myq="select * from daneshkade where cod_daneshkade='$cod_daneshkade'";
  $myres=mysql_query($myq);
  $myrf=mysql_fetch_array($myres);
  if($la=="en")
  	$daneshkade=$myrf["daneshkade_english_name"];
  else 
  	$daneshkade=$myrf["daneshkade_name"];
 
  if( strcmp($aRow["ready_gharardad"],"1")==0 || strcmp($aRow["vaziat_moaven"],"12")==0 || strcmp($aRow["vaziat_moaven"],"13")==0 || strcmp($aRow["vaziat_moaven"],"14")==0)
       $editable=0;
    else
       $editable=1;
//  echo  $editable;
  $position_tarh_code=current_position($cod_tarh);
  $query1="select * from letter_to_mojri where (to_letter='$admin' and cod_tarh='$cod_tarh' and visited='0'and admin_confirm ='1' ) order by cod_tarh desc";
 // echo $query1;
  $result1=mysql_query($query1) or die("error");
  if(mysql_num_rows($result1) > 0)
    $new_msg="image/letter_new.gif";    
    else 
  $new_msg="image/letter.gif";  
   
  $editable=1;
  $vaziat_moaven = $aRow["vaziat_moaven"];
  $vaziat_daneshkade=$aRow["vaziat"];
  $mystatus_daneshkade="";
 
 //-------------------------------------------------------------------------------------- 
 	$payanname_akhlagh=$aRow["payanname_akhlagh"];
 	if($la=="en")
 	{
 		$investigating="investigating";
 		$ethical="didn`t accept ethic";
 		$ethical2="accepted ethic";
 	}
 	else{
 		$investigating="در دست بررسي";
 		$ethical="رد اخلاق";
 		$ethical2="تاييد اخلاق";
 	}
 	if(strcmp($payanname_akhlagh,"-1")==0){
 		$payanname_akhlagh_status=$investigating;
 	}
 elseif(strcmp($payanname_akhlagh,"0")==0){
 		$payanname_akhlagh_status=$ethical;
 	}
 	else 
 	{
 		$payanname_akhlagh_status=$ethical2;
 	}
 	
  //--------------------------------------------------------
  //echo $row_fetched["confirm_tarh"].":".$daneshkade_tarh_type.":".$mytarh_type;
  if($aRow["vaziat"]=="0")
    {
    if($aRow["confirm_tarh"]=="1")
  	   $mystatus_daneshkade="<br>"." دانشکده: "."در دست بررسي";
  	else   
       $mystatus_daneshkade="<br>"." دانشکده: "."نامعلوم";
  } 
  else
  {
  	$query="select * from vaziat_tarh where vaziat='$vaziat_daneshkade'";
    $result_tarhtype=mysql_query($query) or die("Error in selectiong data from tarhtype");
    $row_fetched_tarh=mysql_fetch_array($result_tarhtype);
    $mystatus_daneshkade="<br>"." دانشکده: ".$row_fetched_tarh["vaziat_desc"]."<br>";   
  }
  //--------------------------------------------------------------------------------------
  
   if($vaziat_moaven=="0")
   {
    if($aRow["confirm_moaven_tarh"]=="1")
  	   $mystatus_moavenat="<br>"." معاونت: "."در دست بررسي";
  	else   
       $mystatus_moavenat="<br>"." معاونت: "."نامعلوم";
   } 
  else
  {
  	$query="select * from vaziat_tarh where vaziat='$vaziat_moaven'";
    $result_tarhtype=mysql_query($query) or die("Error in selectiong data from tarhtype");
    $row_fetched_tarh=mysql_fetch_array($result_tarhtype);
    $mystatus_moavenat="<br>"." معاونت: ".$row_fetched_tarh["vaziat_desc"]."<br>";   
    
  }
  
  $mystatus=$mystatus_daneshkade."<br>".$mystatus_moavenat;
 //--------------------------------------------------------------------------------------

 
  $query="select * from vaziat_tarh where vaziat='$mytarh_type'";
  $result_tarhtype=mysql_query($query) or die("Error in selectiong data from tarhtype");
  $row_fetched_tarh=mysql_fetch_array($result_tarhtype);
 // $mystatus="<br>"." معاونت: ".$row_fetched_tarh["vaziat_desc"]."<br>".$mystatus;   
  
  $myq1="select * from group_karshenasan,group_karshenasan_tarh where group_karshenasan_tarh.finished='0' and group_karshenasan_tarh.cod_tarh='$cod_tarh' and group_karshenasan.cod_karshenas=group_karshenasan_tarh.cod_karshenas and   (group_karshenasan.username!='ar_shamshiri' and group_karshenasan.creator!='ar_shamshiri') order by group_karshenasan_tarh.id desc ";
 
  $myq1="select * from group_karshenasan,group_karshenasan_tarh where group_karshenasan_tarh.cod_tarh='$cod_tarh' and group_karshenasan.cod_karshenas=group_karshenasan_tarh.cod_karshenas  and (group_karshenasan.username='rahmani' or group_karshenasan.creator='rahmani') order by id desc";

  $myres=mysql_query($myq1) or die("Error");
  $name_family_sender="";
  if(mysql_num_rows($myres) > 0)
  {
     $myrf=mysql_fetch_array($myres);
      $vaziat_hozor=$myrf["vaziat_hozor"];
	  if(strcmp($vaziat_hozor,"1")==0)
	     $vaziat_hozor="حاضر";
	  if(strcmp($vaziat_hozor,"2")==0)
	     $vaziat_hozor="مرخصي ساعتي";
	  if(strcmp($vaziat_hozor,"3")==0)
	     $vaziat_hozor="مرخصي ";
		 
     $name_family_sender=$name_family_sender."<br>".$hand."&nbsp;".$myrf["karshenas_name"]."&nbsp;".$myrf["karshenas_family"]."&nbsp;<br>".$myrf["mobile"]."<br>".$vaziat_hozor."<br>";
     
  }
  else
  {
  	if($la=="en")
  	 $name_family_sender="Unknown";
  	else 
  	 $name_family_sender="نامعلوم";
  }
  
  
      $query="select * from tarh where cod_tarh='$cod_tarh' and version='-1'";
   $rs34=mysql_query($query) or die("error 6677");
   $rf54=mysql_fetch_array($rs34);
   $user_email=$rf54["creator"];
   $first_ostad =$rf54["first_ostad"];
   $second_ostad  =$rf54["second_ostad"];
   $third_ostad =$rf54["third_ostad"];
   $forth_ostad  =$rf54["forth_ostad"];
   $first_ostad_moshaver =$rf54["first_ostad_moshaver"];
   $second_ostad_moshaver =$rf54["second_ostad_moshaver"];
   $third_ostad_moshaver =$rf54["third_ostad_moshaver"];
   $forth_ostad_moshaver =$rf54["forth_ostad_moshaver"];

   $accepttarh   =$rf54["accepttarh"];
   $first_ostad=strtolower($first_ostad);
   $first_ostad_moshaver=strtolower($first_ostad_moshaver);
   
   $type_ostad="";
   //echo $first_ostad;
   if($la=="en")
   {
   	$first_professor="First professor";
   	$second_professor="Second professor";
   	$third_professor="Third professor";
   	$fourth_professor="Forth professor";
   	$consultant="consultant";
   }
   else {
   	$first_professor="استاد راهنماي اول";
   	$second_professor="استاد راهنماي دوم";
   	$third_professor="استاد راهنماي سوم";
   	$fourth_professor="استاد راهنماي چهارم";
   	$consultant="مشاور";
   }
   if(strcmp($first_ostad,"$admin")==0){
	   $type_ostad=$first_professor;
	   }
	     
 if(strcmp($second_ostad,"$admin")==0){
 	
	   $type_ostad=$second_professor;
	   }
 if(strcmp($third_ostad,"$admin")==0){
	   $type_ostad=$third_professor;
	   }
 if(strcmp($forth_ostad,"$admin")==0){
	   $type_ostad=$fourth_professor;
	   } 
	   if(strcmp($first_ostad_moshaver,"$admin")==0  || strcmp($second_ostad_moshaver,"$admin")==0 || strcmp($third_ostad_moshaver,"$admin")==0 ||  strcmp($forth_ostad_moshaver,"$admin")==0){
		   $type_ostad=$consultant;
		   }
   
    $querycodedane="select * from user_login,darajeelmi where  user_login.email='$user_email'";
   
     $resultcodedaneshjoo=mysql_query($querycodedane) or die("error querycodedane");
     $array_resultcodedaneshjoo=mysql_fetch_array($resultcodedaneshjoo);
   		$daneshjo_no=$array_resultcodedaneshjoo['daneshjo_no'];
		$name=$array_resultcodedaneshjoo['name'];
		$family=$array_resultcodedaneshjoo['family'];
		$fullname=$name.'&nbsp;'.$family;
		$madrak=$array_resultcodedaneshjoo['madrak'];
		if($la=="en"){
			$diploma="Diploma";
			$bachelor="Bachelor";
			$master="Master";
			$professional="Professional Doctoral";
			$phd="PHD";
			$expert="Expert";
			$post_expert="Post Expert";
			$mph="MPH";
		}
		else{
			$diploma="زير کارشناسي";
			$bachelor="کارشناسي";
			$master="کارشناسي ارشد";
			$professional="دکتراي حرفه اي";
			$phd="PHD";
			$expert="تخصص";
			$post_expert="فوق تخصص";
			$mph="MPH";
		}
		if($madrak==1){
			$maghtah=$diploma;
		}elseif($madrak==2){
			$maghtah=$bachelor;
		}elseif($madrak==3){
			$maghtah=$master;
		}elseif($madrak==4){
			$maghtah=$professional;
		}elseif($madrak==5){
			$maghtah=$phd;
		}elseif($madrak==6){
			$maghtah=$expert;
		}elseif($madrak==7){
			$maghtah=$post_expert;
		}elseif($madrak==8){
			$maghtah=$mph;
		}
   $query11="select * from user_login,darajeelmi where user_login.darajeelmi=darajeelmi.darajeelmi and user_login.email='$user_email'";
   
     $result11=mysql_query($query11) or die("error 6677");
     $rf45=mysql_fetch_array($result11);
 
  
  
  
  if(strcmp($position_tarh_code,'24')==0 && strcmp($rf45["need_moshavereh"],'1')==0)
  {
  	if(strcmp($submit_moshaver_amar,'0')==0)
	  $str_code="<br>"."تاييد مشاور آمار ندارد"."($moshaver_amar_name) <br> ";
	else
	  $str_code="<br>"."تاييد مشاور آمار دارد"."<br> ";   
	
   if(strcmp($submit_moshaver_tarrah,'0')==0)
	  $str_code=$str_code."<br>"."تاييد مشاور طراحي ندارد"."($moshaver_tarrah_name) <br> ";
	else
	  $str_code=$str_code."<br>"."تاييد مشاور طراحي دارد"." <br> ";     
  }  
  else
    $str_code=""; 
  
 
			  $mytarh_type = $aRow["status"];
			 
			  $startdate = $aRow["tarh_time"];
			  $startyear = substr($startdate,0,4);
			  $startmon = substr($startdate,5,2);
			  $startday = substr($startdate,8,2);
			  $farsistartdate=hijricalender( $startyear , $startmon , $startday );
			  $farsistartdate = enum2fnum($farsistartdate);
	

			  	if($la=="en")
			  		$tarh_title=$aRow["tarh_title_english"];
			  	else 
			  		$tarh_title=$aRow["tarh_title_farsi"];
			  
				$row["cod_tarh"]=$cod_tarh;
				$row["tarh_title_farsi"]=$tarh_title;
				$row["daneshjo_no"]=$daneshjo_no;
				$row["fullname"]=$fullname;
				$row["maghtah"]=$maghtah;
				$row["daneshkade"]=$daneshkade;
				$row["type_ostad"]=$type_ostad;
				$row["farsistartdate"]=$farsistartdate;
				//$row["date1"]=null;
				//$row["date2"]=null;
				//$row["date3"]=null;
				if(strcmp($first_ostad_flag,'1')==0)
					{
						if($la=="en")
						{
							$accepted="accepted";
							$accept="accept";
						}else 
						{
							$accepted="تاييد شده";
							$accept="تاييد";
						}
						if($accepttarh)
						   {
						   	$row["accepttarh"]=$accepted;
						   }
						   else
						   {
						   	$confirm= "<a class=\"confirm_btn\" style=\"text-decoration:none;\" data-toggle=\"modal\" href=\"#confirm\" >".$accept."</a>";
						   	$row["accepttarh"]=$confirm;
						   }
					}
					else
						$row["accepttarh"]="----";
					
			    $row["payanname_akhlagh_status"]=$payanname_akhlagh_status;
				
			    	/*if(strcmp($first_ostad_flag,'1')==0)
			    	 {
			    	 	$row["letter_to_mojri_body"]=null;
			    	 }
			        else
			    	    $row["letter_to_mojri_body"]="----";*/
			    
			    //$row["idea"]=null;
			    
			    /*if(strcmp($first_ostad_flag,'1')==0)
			    	$row["create_tarh"]=null;
			    else
			        $row["create_tarh"]="----";*/
			    	
				$row["name_family_sender"]=$name_family_sender;
				
				//$row["versions"]=null;
				//$row["print_tarh"]=null;
				
				$row["details"]=null;
				
                //$edit= "<a class=\"btn edit_btn\" id=\"edit_buttun\" data-toggle=\"modal\" href=\"#basic\" ><i class=\"fa fa-edit\" ></i></a>";
		        //$delete= "<a class=\"btn delete_btn\" id=\"delete_buttun\" data-toggle=\"modal\" href=\"#delete\" ><i class=\"fa fa-trash-o\" ></i></a>";
			
			$row["edit"]=$edit;
			//$row["delete"]=$delete;
			
		
		$cntr++;
		//$row[]=$edit;
		//$row[]=$delete;
		$row['DT_RowId']=$cntr;
		$output['aaData'][] = $row;
		//echo $row[1];
	}
	
	echo json_encode( $output );
}
if(strcmp($action,"sabt_tarh")==0)
{
	$q="update tarh set accepttarh='1' where cod_tarh='".$cod_tarh."' and version='-1'";
			$rss=mysql_query($q) or die("error");
			insert_position($cod_tarh,"32",$admin);
 		    echo "success";
}
}
?>