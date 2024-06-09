<?php 
include("include/database-connect.phtml");
include("include/include.phtml");

 if (strcmp($step,"step1")==0)
 {
		  	$query="select * from send_article where cod_tarh='$cod_tarh'";
		  	$result=mysql_query($query) or die("Error");
		  	if(mysql_num_rows($result) <=0)
		  	{
		  	   $query="insert into send_article set noavari='$noavari',natayej_tarh_kharej_daneshgah='$natayej_tarh_kharej_daneshgah',tolid='$tolid',natayej_tarh_dar_modiriyat='$natayej_tarh_dar_modiriyat',cod_tarh='$cod_tarh',creator='$admin',creator='$version', date='".date("Y-m-d")."'";
		  	   $result=mysql_query($query) or die("Error"); 
		  	   echo "inserted_step1";
		  	}
		  	else
		  	{  	
		  	   $query="update send_article set noavari='$noavari',natayej_tarh_kharej_daneshgah='$natayej_tarh_kharej_daneshgah',tolid='$tolid',natayej_tarh_dar_modiriyat='$natayej_tarh_dar_modiriyat',cod_tarh='$cod_tarh',creator='$admin',version='$version', date='".date("Y-m-d")."'";
			   $result=mysql_query($query) or die("Error"); 
			   echo "updated_step1";
		  	}
 }
 if (strcmp($step,"step2")==0)
 {	  

 	if( (strlen(trim($maghale_title)) > 0)  && (strlen(trim($journal_name)) > 0)  &&   strlen(trim($issn)) > 0 && strlen(trim($year_publish_shamsi)) > 2 && strlen(trim($year_publish_milady)) > 2 &&   strcmp($indexing,"-1")!=0 &&   strcmp($maghale_type,"-1")!= 0)
 	{
 	
 		$maghale_title=addslashes($maghale_title);
 	
 		 
 		$query="select * from maghale where maghale_title =\"$maghale_title\" and creator=\"$admin\" and cod_tarh='$cod_tarh'";
 		//  echo $query;
 		$result=mysql_query($query) or die("Error in selecting data from tarh  12");
 	
 		if ( mysql_num_rows($result) <= 0 )
 		{
 			$query="insert into maghale  set  creator='$admin',cod_tarh='$cod_tarh',maghale_title='$maghale_title',journal_name='$journal_name',issn='$issn',outer_level='$outer_level',Affiliation='$affiliation',year_publish_shamsi='$year_publish_shamsi',year_publish_milady='$year_publish_milady',indexing='$indexing',maghale_type='$maghale_type'";
 			$result=mysql_query($query) or die("Error in selecting data from tarh  11");
 			$query="select * from maghale where  maghale_title =\"$maghale_title\" and creator=\"$admin\" and cod_tarh='$cod_tarh'";
 			$result=mysql_query($query) or die("Error in selecting data from tarh  11");
 			$row_fetched=mysql_fetch_array($result);
 			$maghale_id=$row_fetched["maghale_id"];
 			?>
 	           <script language="javascript">
 	           window.location="<? echo "upload_maghale.phtml?admin=$admin&seed=$seed&cod_tarh=$cod_tarh&maghale_id=$maghale_id";  ?>";
 	           </script>
 	           <?
 	
 	         }
 	         else
 	          $status="duplicate_entry";
 	    }
 	    else
 	      $status="entry_error";
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
      $query="update answer_mojri_gharardad set edit_able='0',maliat='3' where cod_tarh='$cod_tarh'";
	  $result=mysql_query($query) or die("Error");
	  
}

      
 if (strcmp($step,"gozareshat")==0)
{
      ?>
      <table class="table table-striped table-bordered table-hover">
															<thead>
																<th class="hidden">id</th>
																<th>رديف</th>
																<th>مرحله گزارش</th>
																<th>تاريخ گزارش</th>
																<th>توضيحات گزارش</th>
																<th>حذف</th>
															</thead>
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