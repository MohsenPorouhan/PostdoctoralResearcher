<?php 
include("include/database-connect.phtml");
include("include/include.phtml");

 if (strcmp($step,"step1")==0)
 {
		if(strlen(trim($natayej))>0 && strlen(trim($ravesh_ejra)) > 0){
		     	$query="select * from  marhale_report where  marhale='100' and cod_tarh='$cod_tarh'";	 
			    //echo $query;
			   	$result=mysql_query($query) or die("Error");
			   	
// 			   	$ravesh_ejra=iconv('windows-1256', 'utf-8', ($ravesh_ejra));
// 			   	$natayej=iconv('windows-1256', 'utf-8', ($natayej));
// 			   	$natije_giri=iconv('windows-1256', 'utf-8', ($natije_giri));
// 			   	$pishnahadat=iconv('windows-1256', 'utf-8', ($pishnahadat));
// 			   	$sazmanha=iconv('windows-1256', 'utf-8', ($sazmanha));
			   	
			    if(mysql_num_rows($result) <= 0)
			    {
			     	
				     	
				      $sazmanha=str_replace("'"," ",$sazmanha);
				      $sazmanha=str_replace("\""," ",$sazmanha);
				      $sazmanha=str_replace(";"," ",$sazmanha);
				
			    	  $pishnahadat=str_replace("'"," ",$pishnahadat);
				      $pishnahadat=str_replace("\""," ",$pishnahadat);
				      $pishnahadat=str_replace(";"," ",$pishnahadat); 
				      
			    	  $natije_giri=str_replace("'"," ",$natije_giri);
				      $natije_giri=str_replace("\""," ",$natije_giri);
				      $natije_giri=str_replace(";"," ",$natije_giri);
				     
			    	  $natayej=str_replace("'"," ",$natayej);
				      $natayej=str_replace("\""," ",$natayej);
				      $natayej=str_replace(";"," ",$natayej);
				      
			    	  $ravesh_ejra=str_replace("'"," ",$ravesh_ejra);
				      $ravesh_ejra=str_replace("\""," ",$ravesh_ejra);
				      $ravesh_ejra=str_replace(";"," ",$ravesh_ejra);
			
			     	  $send_date=date("Y-m-d");
			     	  
			     	  
			     	  $query="select * from group_karshenasan,group_karshenasan_tarh where group_karshenasan.cod_karshenas=group_karshenasan_tarh.cod_karshenas and  cod_tarh='$cod_tarh' and group_karshenasan.karshenas_type='1'";
				      $result123=mysql_query($query) or die("Error 120000");
					 while($rf=mysql_fetch_array($result123)){
						  $sms_box=$rf["sms_box"];
						   $send_date=date("Y-m-d");
					
						  $startdate =$send_date;
					      $startyear = substr($startdate,0,4);
					      $startmon = substr($startdate,5,2);
					      $startday = substr($startdate,8,2);
					      $send_date=hijricalender( $startyear , $startmon , $startday ); 
					 	  $query="insert into input_sms set sms_from='ADMIN' ,sms_to='$sms_box' , sms_text='Gozaresh marboot be tarh $cod_tarh  dar tarikh   $send_date  ersal shod'";
					 
						  $result=mysql_query($query) or die("Error 120000");
					 	  
					 } 
			     	  
			     	  
			     	  
			     	  $query="insert into  marhale_report set sazmanha='$sazmanha' ,pishnahadat='$pishnahadat', natije_giri='$natije_giri',natayej='$natayej',ravesh_ejra='$ravesh_ejra', marhale='100',cod_tarh='$cod_tarh',send_date='$send_date'";
				   	 
				   	  $r_update=mysql_query($query) or die("Error");
				      echo"step1_insert";
		        
				}
				else
				{
				   
				   $send_date=date("Y-m-d");
		      	   $query="update  marhale_report set sazmanha='$sazmanha' ,pishnahadat='$pishnahadat', natije_giri='$natije_giri',natayej='$natayej',ravesh_ejra='$ravesh_ejra',send_date='$send_date' where    marhale='100' and cod_tarh='$cod_tarh'";
			   	// echo $query;
			   	   $r_update=mysql_query($query) or die("Error");
			   	   echo"step1_update";
		        	
				}
			
			  
	    }
     	else
     	{
     	  $status='entry_error';
     	  echo $status;
     	}
 }
 if (strcmp($step,"step2")==0)
 {	  
 	$query="select * from  marhale_report where  marhale='100' and cod_tarh='$cod_tarh'";
 	
 	$result=mysql_query($query) or die("Error");
 	 
 	if(mysql_num_rows($result) > 0)
 	{
 		$chekide_latin=str_replace("'"," ",$chekide_latin);
 		$chekide_latin=str_replace("\""," ",$chekide_latin);
 		$chekide_latin=str_replace(";"," ",$chekide_latin);
 	
 		$send_date=date("Y-m-d");
 		$query="update  marhale_report set chekide_latin='$chekide_latin' where marhale='100' and cod_tarh='$cod_tarh'";
 	
 		$r_update=mysql_query($query) or die("Error");
 		echo "step2_update";

    }
    else
    {
 	    $status='step_error';
 	    echo $status; 	
    }
 }
if (strcmp($step,"step3")==0)
{ 
	$query="select * from  marhale_report where  marhale='100' and cod_tarh='$cod_tarh'";
	 
	$result=mysql_query($query) or die("Error");
	 
	if(strlen(trim($kalame_1))> 0  )
	{
		if(mysql_num_rows($result) > 0)
		{
	
			$kalame_1=str_replace("'"," ",$kalame_1);
			$kalame_1=str_replace("\""," ",$kalame_1);
			$kalame_1=str_replace(";"," ",$kalame_1);
	
			$kalame_2=str_replace("'"," ",$kalame_2);
			$kalame_2=str_replace("\""," ",$kalame_2);
			$kalame_2=str_replace(";"," ",$kalame_2);
	
			$kalame_3=str_replace("'"," ",$kalame_3);
			$kalame_3=str_replace("\""," ",$kalame_3);
			$kalame_3=str_replace(";"," ",$kalame_3);
	
			$kalame_4=str_replace("'"," ",$kalame_4);
			$kalame_4=str_replace("\""," ",$kalame_4);
			$kalame_4=str_replace(";"," ",$kalame_4);
	
			$send_date=date("Y-m-d");
			$query="update  marhale_report set kalame_1='$kalame_1',kalame_2='$kalame_2',kalame_3='$kalame_3',kalame_4='$kalame_4' where marhale='100' and cod_tarh='$cod_tarh'";
	
			$r_update=mysql_query($query) or die("Error");
			echo "step3_update";
		 }
		    
	 }
	 else{
		 $status='entry_error';
		 echo $status;
	 }
	 	 
}
if (strcmp($step,"step4")==0){
$cod_tarh=$_GET["cod_tarh"];
	
	$query="select * from  marhale_report where  marhale='100' and cod_tarh='$cod_tarh'";
	//echo $query;
	$result=mysql_query($query) or die("Error");
	 
	if(mysql_num_rows($result) > 0 )
	{
		if (isset($_FILES['fupload'])){
				
		$file_cnt=0;
		$dir_name="../reports/".$cod_tarh;
		if ($dir = @opendir($dir_name))
		{
			 
			$mydir = dir($dir_name);
			//while(($file = $mydir->read()) !== false)
			while($file = $mydir->read())
				if( !(strcmp(trim($file),".")==0 || strcmp(trim($file),"..")==0) )
					$file_cnt++;
				closedir($dir);
				 
		}
	
	
		$send_date=date("Y-m-d");
		$fupload_name=$_FILES["fupload"]["name"];
		//echo $fupload_name;
		$fupload_name='final-'.$file_row.'-'.$send_date."-".$fupload_name;
	
		$status_upload=upload_file("../reports",$cod_tarh,"$fupload_name");
	
		$query="update marhale_report set  filename='$fupload_name' where marhale='100' and cod_tarh='$cod_tarh'";
		//echo $query;
		$r_update=mysql_query($query) or die("Error");
		if(!strcmp($status_upload,"10") == 0 ){
			$status="upload_error";
			echo $status;
		}
		else
		{
			//echo("فايل مربوطه ارسال شد" );
	        $step="attachment";       
	    } 
		  $query="select * from group_karshenasan,group_karshenasan_tarh where group_karshenasan.cod_karshenas=group_karshenasan_tarh.cod_karshenas and  cod_tarh='$cod_tarh' and group_karshenasan.karshenas_type='1'";
	      $result123=mysql_query($query) or die("Error 120000");
		 while($rf=mysql_fetch_array($result123)){
		  $sms_box=$rf["sms_box"];
		   $send_date=date("Y-m-d");
	
		  $startdate =$send_date;
	      $startyear = substr($startdate,0,4);
	      $startmon = substr($startdate,5,2);
	      $startday = substr($startdate,8,2);
	      $send_date=hijricalender( $startyear , $startmon , $startday ); 
	 	  $query="insert into input_sms set sms_from='ADMIN' ,sms_to='$sms_box' , sms_text='File Gozaresh marboot be tarh $cod_tarh  dar tarikh   $send_date  ersal shod'";
	 
		  $result=mysql_query($query) or die("Error 120000");
		  
		 } 
		 	  
		 	  
	} 
	else 
		echo"!isset(FILES['fupload'])";
	    }
	   else
	    {
		   $status='step_error';
		   echo $status;
		 }
		 
}
if (strcmp($step,"step5")==0)
{
     	$query="select * from  marhale_report where  marhale='100' and cod_tarh='$cod_tarh'";
		 	   	 
	   	$result=mysql_query($query) or die("Error");
	    
        
	    if(mysql_num_rows($result) > 0)
	    {
			
		  if(isset($yes_no))
		  {
			  $query="update marhale_report set yes_no='$yes_no' where marhale='100' and cod_tarh='$cod_tarh'";
	   	       
	   	       $r_update=mysql_query($query) or die("Error");
	   	       echo "updated"; 
		  }
	      
	    }
}
if (strcmp($step,"step6")==0)
{
$query="select * from  marhale_report where  marhale='100' and cod_tarh='$cod_tarh'";
		  	   	 
	   	$result=mysql_query($query) or die("Error");
	    
        $form_next_val="";
	    if(mysql_num_rows($result) > 0)
	    {
	     
		   
		   $value_form="";
           for($i=0;$i<=12;$i++)
  	       {
	         $var= "form6_".$i;
 	         if(isset($$var))
	         { 
	         	
		       if(strlen(trim($value_form))<=0)
		          $value_form=$var."="."\"".addslashes($$var)."\"";
		       else
		          $value_form=$value_form.",".$var."="."\"".addslashes($$var)."\"";
	     
	         }
			 $form_next_val="form6_8";
			 $form_next_val=$$form_next_val;
  	       }
		   $query="update marhale_report set  form_6='$value_form' where marhale='100' and cod_tarh='$cod_tarh'";
	   	        
	   	    $r_update=mysql_query($query) or die("Error"); 
	   	    
	   	    echo "updated";
	    }
}

if (strcmp($step,"step7")==0)
{
     	$query="select * from  marhale_report where  marhale='100' and cod_tarh='$cod_tarh'";
		  	   	 
	   	$result=mysql_query($query) or die("Error");
	    
        
	    if(mysql_num_rows($result) > 0)
	    {
 
		   $value_form="";
           for($i=0;$i<=7;$i++)
  	       {
	         $var= "form7_".$i;
 	         if(isset($$var))
	         {
		       if(strlen(trim($value_form))<=0)
		          $value_form=$var."="."\"".addslashes($$var)."\"";
		       else
		          $value_form=$value_form.",".$var."="."\"".addslashes($$var)."\"";
	     
	         }
  	       }
		   $query="update marhale_report set  form_7='$value_form' where marhale='100' and cod_tarh='$cod_tarh'";
	   	        
	   	    $r_update=mysql_query($query) or die("Error"); 
		    echo "updated";
		    
	    }
}
if(strcmp($action, add_hazineh)==0)
{
	if(strlen(trim(isset($hazine)))>0 && strlen(trim(isset($faaliat)))>0 && strlen(trim(isset($mablagh)))>0 )
	{
		$query  = "insert into marhale_report_final_hazine set hazine=\"$hazine\",faaliat=\"$faaliat\" , mablagh=\"$mablagh\" ,cod_tarh=\"$cod_tarh\"";
		$result = mysql_query($query) or die("Error in inserting data into jadval zarayeb");
		echo "inserted";
	}
	else
	{
		echo "entry_error";
	}
}

if (strcmp($step,"delete_file")==0)
  {
   	
  	$del_file="../reports/".$cod_tarh;
    //echo $delete_id;
	delete_file($del_file,"",$delete_id);
    
    //$query="delete  from marhale_report where id='$delete_id'";
  	//$result=mysql_query($query);
    $step="attachment";
  }

  if (strcmp($action,"delete_hazineh")==0)
  {
  
  	$query="delete from marhale_report_final_hazine where id = \"$delete_hazineh_id\" and cod_tarh=\"$cod_tarh\" ";

    $result=mysql_query($query) or die("Error in  delete data from hazine azmayesh");
    $action=" حدف هزينه هاي مربوط به گزارش نهايي ".$cod_tarh;
    set_log($action,$admin,date("Y-m-d, g:i a"));
  }     
 if (strcmp($step,"attachment")==0)
{
?>
  	<table class="table table-striped table-bordered table-hover">
  														<?php if($la=="en"){ ?>
															<thead>
																<th class="hidden">id</th>	
																<th>No</th>
																<th>File Name</th>
																<th>Delete</th>
															</thead>
														<?php }else{ ?>
															<thead>
																<th class="hidden">id</th>	
																<th>رديف</th>
																<th>نام فايل</th>
																<th>حذف</th>
															</thead>
														<?php } ?>
															<tbody>
																
																<?php 
																$query="select * from marhale_report where cod_tarh='$cod_tarh' and marhale='100'";
																 
																$result=mysql_query($query) or die("Error");
																	
																
																$mycount=0;
																$dir_name="../reports/".$cod_tarh;
																if ($dir = @opendir($dir_name))
																{
																$mydir = dir($dir_name);
																//while(($file = $mydir->read()) !== false)
																$number_of_row=1;
																while($file = $mydir->read())
																{
																	if( !(strcmp(trim($file),".")==0 || strcmp(trim($file),"..")==0 || strcmp(trim($file),"Thumbs.db")==0) && strcmp(substr($file,0,5),'final')==0 )
																	{
																		$myq="select * from tarh_indoing where cod_tarh='$cod_tarh' and marhale='100' and submitted='1'";
																		$res=mysql_query($myq) or die("Error");
																		if(mysql_num_rows($res)>0)
																			$level_submitted='1';
																		else
																			$level_submitted='0';
																?>
																	<tr>
																	<td><?php echo $number_of_row; ?></td>
																	<td class="hidden"><?php echo $file;?></td>
																	<td><a target="_blank" href="../reports/<?php echo $cod_tarh; ?>/<?php echo $file; ?>"><?php echo $file; ?></a></td>
																	<?php
																	if($level_submitted==0)
																	{
																		if($la=="en")
																			$not_be_able_to_delete="not be able to delete";
																		else 
																			$not_be_able_to_delete="غير قابل حذف";
																		?>
																	<td><?php echo "<a class=\"btn delete_buttun\" id=\"$file\" onclick=delete_element('$file') data-toggle=\"modal\" href=\"#delete\" ><i class=\"fa fa-trash-o\" ></i></a>";?></td>
																	<?php } else{  ?>
																	<td><?php echo $not_be_able_to_delete; ?></td>
																	<?php }	?>
																</tr>
																<?php 
																		$number_of_row++;
																		}
																		
																	 }
																	closedir($dir);
																}
																?>
																
															</tbody>
														</table>
<?php 
}
if(strcmp($action,"list")==0){
$aColumns = array( 'id','hazine','faaliat','mablagh','cod_tarh');

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "id";

/* DB table to use */
$sTable = "marhale_report_final_hazine";

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
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable
		WHERE  cod_tarh='$cod_tarh'
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
WHERE  cod_tarh='$cod_tarh'
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
 $my_summary =0;
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
			$mablagh_row=$aRow["mablagh"];
			$my_summary =$mablagh_row +$my_summary;
			$row = array();
				for ( $i=0 ; $i<count($aColumns) ; $i++ )
				{
		// 							if ( $aColumns[$i] != ' ' )
		// 							{
						if($aColumns[$i] == "mablagh")
						{
							$mablagh=number_format($aRow["mablagh"]);
							$aRow[$aColumns[$i]] = $mablagh;
						}
						$str=$aRow[$aColumns[$i]];
		
						$row[$aColumns[$i]] = $str;
		// 		}
					
					
				}
				$delete= "<a class=\"btn delete_buttun\" data-toggle=\"modal\" href=\"#delete_hazineh_modal\" ><i class=\"fa fa-trash-o\" ></i></a>";
		
				$cntr++;
				$row["delete"]=$delete;
		
				$output['aaData'][] = $row;

		}
		$row = array();
		$row["id"]=null;
		if($la=="en")
			$row["hazine"]="Sum";
		else
			$row["hazine"]="مجموع";
		$row["faaliat"]=null;
		$row["mablagh"]=number_format($my_summary);
		$row["delete"]=null;
		$row["cod_tarh"]=null;
		
		$output['aaData'][] = $row;
	echo json_encode( $output );
}
?>