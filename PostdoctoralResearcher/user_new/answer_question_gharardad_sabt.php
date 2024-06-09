<?php 
include("include/database-connect.phtml");
include("include/include.phtml");

 if (strcmp($step,"step1")==0)
 {
		  	$query="select * from answer_mojri_gharardad where cod_tarh='$cod_tarh'";
		  	$result=mysql_query($query) or die("Error");
		  	if(mysql_num_rows($result) <=0)
		  	{
		  	   $query="insert into answer_mojri_gharardad set  mobile='$mobile',hesab='$hesab',bank_name='$bank_name', submit_date='".date("Y-m-d")."', unnazerin='$unnazerin',nazerin='$nazerin',payanname='$payanname',pish_pardakht='$pish_pardakht',cod_tarh='$cod_tarh',mojri_code='$mojri_name',heiat_elmi='$heiat_elmi',melli_cod='$melli_cod',shaba_cod='$shaba_cod'";
		  	   $result=mysql_query($query) or die("Error"); 
		  	}
		  	else
		  	{  	
		  	   $query="update answer_mojri_gharardad set    mobile='$mobile',hesab='$hesab',bank_name='$bank_name',unnazerin='$unnazerin',nazerin='$nazerin',payanname='$payanname',pish_pardakht='$pish_pardakht',mojri_code='$mojri_name',heiat_elmi='$heiat_elmi',melli_cod='$melli_cod',shaba_cod='$shaba_cod' where cod_tarh='$cod_tarh'";
			   $result=mysql_query($query) or die("Error"); 
		  	}
 }
 if (strcmp($step,"step2")==0)
 {	  
		  	   $query="update answer_mojri_gharardad set    start_time='$start_time',time_month='$time_month' where cod_tarh='$cod_tarh'";
			   $result=mysql_query($query) or die("Error"); 

			   
			   //// add marhale 0 and 100 to gozaresh_gharardad
			   $q="select * from gozaresh_gharardad where cod_tarh='$cod_tarh' and marhale='0'";
			  //echo $q;
			   $rslt=mysql_query($q) or die("Error");
			   if(mysql_num_rows($rslt) > 0)
			   {
			   	 $myrf=mysql_fetch_array($rslt);
			  	 $mablagh=$myrf["mablagh"];
			  	 $query00="select * from answer_mojri_gharardad where cod_tarh='$cod_tarh'"; 
			     $result00=mysql_query($query00) or die("Error10");
			     if(mysql_num_rows($result00)>0)
			     {
			 	      $row_fetched00=mysql_fetch_array($result00);
			     	  $start_time=$row_fetched00["start_time"]; 	 	 	 	
			     	  $time_month=$row_fetched00["time_month"];     	
			     }
			     $q="update gozaresh_gharardad set date_gozaresh='$start_time' where marhale='0' and cod_tarh='$cod_tarh'";
			//echo $q;
			     $result000=mysql_query($q) or die("Error10");
			   }
			  else
			  {
			  	 $query00="select * from answer_mojri_gharardad where cod_tarh='$cod_tarh'"; 
			      $result00=mysql_query($query00) or die("Error10");
			      if(mysql_num_rows($result00)>0)
			      {
			 	      $row_fetched00=mysql_fetch_array($result00);
			     	  $start_time=$row_fetched00["start_time"]; 	 	 	 	
			     	  $time_month=$row_fetched00["time_month"];     	
			      }
			   $q="insert into gozaresh_gharardad set mablagh='0' , cod_tarh='$cod_tarh' ,date_gozaresh='$start_time', marhale='0'";
			 // echo $q;
			    $result000=mysql_query($q) or die("Error10");
			     
			   $mablagh=0;
			  }
			
			
			   $q="select * from gozaresh_gharardad where cod_tarh='$cod_tarh' and marhale='100'";
			   $rslt=mysql_query($q) or die("Error");
			   if(mysql_num_rows($rslt) > 0)
			   {
			   	 $myrf=mysql_fetch_array($rslt);
			  	 $mablagh=$myrf["mablagh"];
			  	 
			  	 $query00="select * from answer_mojri_gharardad where cod_tarh='$cod_tarh'"; 
			     $result00=mysql_query($query00) or die("Error10");
			     if(mysql_num_rows($result00)>0)
			     {
			 	      $row_fetched00=mysql_fetch_array($result00);
			     	  $start_time=$row_fetched00["start_time"]; 	 	 	 	
			     	  $time_month=$row_fetched00["time_month"];     	
			     }
			    // echo $start_time;
			    if( $start_time > 0 && $time_month > 0 )
			    {
			     $year=substr($start_time,0,4);
			     $month=substr($start_time,5,2);
			     $day=substr($start_time,8,2);
			     $month_add=$time_month;
			     $month_tmp=$month;
			    // $start_time=$year."-".$month."-".$day;
			   
			   //---------------------------------------------------------------
			   /*  if($month!='12')
			       $month_add=$time_month+$month;
			     else
				     $month_add=$time_month; 
			    */
			    //---------------------------------------------------------------
				 if($month_add >=12 )
			     {
			       $year_add=(int)($month_add/12); 
				   $year=$year+$year_add;	 
				   $month=$month+($month_add-($year_add*12));	 	
			       //$month=$month_add-($year_add*12);     
			       //if($month==0)
			         //$month=$month_tmp;
			     }
			   else
			     $month=$month+$month_add;
			     
			     if($month > 12 )
			     {
			       $year_add=(int)($month/12); 
				   $year=$year+$year_add;
				   $month=$month-($year_add*12);
				 } 
				 
			     $year=str_pad($year,4,0,STR_PAD_LEFT);
			     $month=str_pad($month,2,0,STR_PAD_LEFT);
			     $day=str_pad($day,2,0,STR_PAD_LEFT);
			     $end_time=$year."-".$month."-".$day;
			    }
			  else
			    {
			      $end_time="تعريف نشده";   
			    }
			    /*  echo $start_time."<br>";
			    echo $month_add."<br>";
			     echo $year_add."<br>";
			     echo $year."<br>";
			     echo $month."<br>";
			     echo $time_month."<br>";
			     echo $end_time;
			    */
			    // echo $end_time;
			   //  echo $month_add."<br>";
			  //   echo $end_time."<br>";
			  //   echo $start_time."<br>";
			   //   echo $time_month."<br>";
			     
			     
			     
			     $q="update gozaresh_gharardad set date_gozaresh='$end_time' where marhale='100' and cod_tarh='$cod_tarh'";
			//echo $q;
			     $result000=mysql_query($q) or die("Error10");
			   }
			  else
			  {
			  	  $query00="select * from answer_mojri_gharardad where cod_tarh='$cod_tarh'"; 
			      $result00=mysql_query($query00) or die("Error10");
			      if(mysql_num_rows($result00)>0)
			      {
			 	      $row_fetched00=mysql_fetch_array($result00);
			     	  $start_time=$row_fetched00["start_time"]; 	 	 	 	
			     	  $time_month=$row_fetched00["time_month"];     	
			      }
			    if( $start_time > 0 && $time_month > 0 )
			    {
			     $year=substr($start_time,0,4);
			     $month=substr($start_time,5,2);
			     $day=substr($start_time,8,2);
			     $start_time=$year."-".$month."-".$day;
			     $month_add=$time_month+$month;
			     if($month_add >= 12 )
			     {
			       $year_add=(int)($month_add/12); 
				   $year=$year+$year_add;	 	 	
			       $month=$month_add-($year_add*12);     
			       if($month==0)
			         $month=12;
			     }
			   else
			     $month=$month_add;
			     $year=str_pad($year,4,0,STR_PAD_LEFT);
			     $month=str_pad($month,2,0,STR_PAD_LEFT);
			     $day=str_pad($day,2,0,STR_PAD_LEFT);
			     $end_time=$year."-".$month."-".$day;
			    }
			 else
			  {
			    $end_time="تعريف نشده";   
			  }
			   $q="insert into gozaresh_gharardad set mablagh='0' , cod_tarh='$cod_tarh' ,date_gozaresh='$end_time', marhale='100'";	
			//echo $q;
			   //$result000=mysql_query($q) or die("Error10");
			   
			   $mablagh=0;
			  }
 }
if (strcmp($step,"step3")==0)
{
      $query="insert into gozaresh_gharardad set  marhale=\"$marhale\",cod_tarh=\"$cod_tarh\",date_gozaresh='$date_gozaresh',percent_gozaresh='$percent_gozaresh'";
      mysql_query($query) or die ("Error in inserting data in tarh-type");
      $step="gozareshat";
}
if (strcmp($step,"delete_gozaresh")==0)
{
      $query="delete from gozaresh_gharardad where id='$gozaresh_id'";
      mysql_query($query) or die ("Error in inserting data in tarh-type");  
      $step="gozareshat";
}
if (strcmp($step,"step4")==0)
{
	$myq1="select * from group_karshenasan,group_karshenasan_tarh where group_karshenasan_tarh.cod_tarh='$cod_tarh' and group_karshenasan.cod_karshenas=group_karshenasan_tarh.cod_karshenas  and (group_karshenasan.karshenas_type='1' and group_karshenasan.creator='rahmani') order by id desc";
	
	$myres=mysql_query($myq1) or die("Error");
	$name_family_sender="";
	if(mysql_num_rows($myres) > 0)
	{
		$myrf=mysql_fetch_array($myres);
		$to_letter=$myrf["username"];
	}
      $query="update answer_mojri_gharardad set edit_able='0',maliat='3' where cod_tarh='$cod_tarh'";
	  $result=mysql_query($query) or die("Error");
	  
}

      
 if (strcmp($step,"gozareshat")==0)
{
      ?>
      <table class="table table-striped table-bordered table-hover">
      													<?php if ($la=="en"){ ?>
															<thead>
																<th class="hidden">id</th>
																<th id="th1_server_side">Number of row</th>
																<th id="th2_server_side">Step report</th>
																<th id="th3_server_side">Date report</th>
																<th id="th4_server_side">Descriptions report</th>
																<th id="th5_server_side">Delete</th>
															</thead>
															<?php }else{?>
															<thead>
																<th class="hidden">id</th>
																<th id="th1_server_side">رديف</th>
																<th id="th2_server_side">مرحله گزارش</th>
																<th id="th3_server_side">تاريخ گزارش</th>
																<th id="th4_server_side">توضيحات گزارش</th>
																<th id="th5_server_side">حذف</th>
															</thead>
															<?php } ?>
															<tbody>
															<?php 
															  $cnt=1;
															  $Query=mysql_query("select * from gozaresh_gharardad  where cod_tarh='$cod_tarh'  order by marhale asc") or die("Error in selecting tarh-type");
															  while($row_fetched=mysql_fetch_array($Query))
															  {
															  	 $id=$row_fetched["id"];
															  	  if(strlen($row_fetched["marhale"])<=0)
																   $marhale="&nbsp;";
																  else
																   $marhale=$row_fetched["marhale"];
																    if($la=="en"){
																		   if(strcmp($row_fetched["marhale"],'0')==0)
																		     $marhale="First";
																		  
																		   if(strcmp($row_fetched["marhale"],'100')==0)
																		     $marhale="Final";
																		     
																		     if($marhale==1)
																		       $marhale="First";
																		    
																			if($marhale==2)
																		       $marhale="Second";
																		    
																		    if($marhale==3)
																		       $marhale="Third";
																		
																		    if($marhale==4)
																		       $marhale="Fourth";
																			
																			if($marhale==5)
																		       $marhale="Fifth";
																			
																			 if($marhale==6)
																		       $marhale="Sixth"; 
																	}else{
																			if(strcmp($row_fetched["marhale"],'0')==0)
																				$marhale="اول";
																			
																			if(strcmp($row_fetched["marhale"],'100')==0)
																				$marhale="نهايي";
																				
																			if($marhale==1)
																				$marhale=" اول ";
																			
																			if($marhale==2)
																				$marhale=" دوم ";
																			
																			if($marhale==3)
																				$marhale=" سوم ";
																			
																			if($marhale==4)
																				$marhale=" چهارم ";
																				
																			if($marhale==5)
																				$marhale=" پنجم ";
																				
																			if($marhale==6)
																				$marhale=" ششم ";
																	}
															  	?>
															  
																<tr>
																	<td class="hidden"><?php echo $id;?></td>
																	<td><?php echo $cnt;?></td>
																	<td><?php echo $marhale;?></td>
																	<td><?php echo $row_fetched["date_gozaresh"];?></td>
																	<td><?php echo $row_fetched["percent_gozaresh"];?></td>
																	<td><?php echo "<a class=\"btn delete_buttun\" id=\"$id\" onclick=delete_element('$id') data-toggle=\"modal\" href=\"#delete\" ><i class=\"fa fa-trash-o\" ></i></a>";?></td>
																</tr>
																<?php
																$cnt++; 
															  }
																?>
																
															</tbody>
														</table>
														<?php 
}

?>
<script>
if(language=="en")
{
	document.getElementById("th1_server_side").innerText="Number of row";
	document.getElementById("th2_server_side").innerText="Step report";
	document.getElementById("th3_server_side").innerText="Date report";
	document.getElementById("th4_server_side").innerText="Descriptions report";
	document.getElementById("th5_server_side").innerText="Delete";
}
</script>