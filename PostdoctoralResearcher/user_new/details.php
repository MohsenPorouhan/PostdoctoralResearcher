<?php
include("include/database-connect.phtml");
include("include/include.phtml");
if($la=="en"){
	$name_family_sender_label="Unknown";
	$Relevant_expert="Relevant expert";
	$print_title="Print";
	$modir_payanname_name_label="Thesis manager";
	$answer_question_contract="Answer to question contract";
	$send_report_step="Send report step";
	$send_final_report="Send final report";
	$article_resulted="Article Resulted From This Project";
	$project_resulted="Project Resulted";
	$min_score="Minimum score";
	$total_points_earned="Total points earned";
}else{
	$name_family_sender_label="نامعلوم";
	$Relevant_expert="کارشناس مربوطه";
	$print_title="چاپ";
	$modir_payanname_name_label="مدیر پایان نامه";
	$answer_question_contract="پاسخ به سوالات قرارداد";
	$send_report_step="ارسال گزارش مرحله";
	$send_final_report="ارسال گزارش نهایی";
	$article_resulted="مقالات منتج از اين طرح";
	$project_resulted="نتايج طرح";
	$min_score="حداقل امتیاز";
	$total_points_earned="مجموع امتیاز کسب شده";
}
$query="select * from tarh where cod_tarh='$cod_tarh' and version='-1'";
	$rs=mysql_query($query) or die("error in selecting data from tarh");
	$rf=mysql_fetch_array($rs);
	$indoing=$rf["indoing"];
	$daneshkade_indoing=$rf["daneshkade_indoing"];
	$ready_gharardad=$rf["ready_gharardad"];
	$new_gharardad_daneshkade=$rf["new_gharardad_daneshkade"];
	$archieved=$rf["archieved"];
	$finalized=$rf["finalized"];
	$finish_pointed=$rf["finish_pointed"];
	$mablagh_aghd_gharardad = $rf["mablagh_aghd_gharardad"];
	
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
		 
     $name_family_sender=$myrf["karshenas_name"]." ".$myrf["karshenas_family"]." ".$myrf["mobile"];
     
  }
  else
  {
  	 $name_family_sender=$name_family_sender_label;
  }
  
  if(strcmp($semat,"mojri")==0)
  {
  	if($la=="en"){
		if(strcmp($archieved,"1")==0)
			$archive_title="Exit from Archive";
		else if(strcmp($archieved,"1")!=0)
			$archive_title="Peroject Archive";
  	}else{
  		if(strcmp($archieved,"1")==0)
  			$archive_title="خروج از آرشيو";
  		else if(strcmp($archieved,"1")!=0)
  			$archive_title=" آرشيو طرح";
  	}
		
		
	echo "<div style=''>";
	if(strcmp($type,"payan_name")!=0)
	echo "<a style=\"margin-left:2em;\">".$Relevant_expert.":".$name_family_sender."</a>";	
  $archive= "<a style=\"margin-left:2em;\" onclick=\"archive('$cod_tarh','$archieved');\" ><i title=\"$archive_title\"class=\"fa fa-archive\"></i></a>";
  echo $archive;

    $print= "<a style=\"margin-left:2em;\" target=\"_blank\" href=\"print_tarh.phtml?cod_tarh=$cod_tarh\" ><i title=\"$print_title\" class=\"fa fa-print\"></i></a>";
    echo $print;
    
    if(strcmp($type,"payan_name")==0)
    {
    	$query_modir="select * from modir_daneshkade,modir_daneshkade_tarh where modir_daneshkade.cod_modir=modir_daneshkade_tarh.cod_modir and modir_daneshkade_tarh.cod_tarh='$cod_tarh'";
    	$result_modir=mysql_query($query_modir) or die("Error in selectiong data from tarhtype");
    	if(mysql_num_rows($result_modir) > 0 ){
    		$row_fetched_modir=mysql_fetch_array($result_modir);
    		$modir_payanname_name=$row_fetched_modir["modir_payanname_name"];
    		$email_view_able=$row_fetched_modir["email_view_able"];
    		$phone_view_able=$row_fetched_modir["phone_view_able"];
    		$mobile_view_able=$row_fetched_modir["mobile_view_able"];
    		if($email_view_able=="1"){
    			$modir_payanname_name=$modir_payanname_name."<br>".$row_fetched_modir["modir_email"];
    		}
    		if($phone_view_able=="1"){
    			$modir_payanname_name=$modir_payanname_name."<br>".$row_fetched_modir["modir_tel"];
    		}
    		if($mobile_view_able=="1"){
    			$modir_payanname_name=$modir_payanname_name."<br>".$row_fetched_modir["modir_mobile"];
    		}
    	}
    	echo "<a style=\"margin-left:2em;\">".$modir_payanname_name_label.":". $modir_payanname_name."</a>";
    }
    $edit_able="1";
	$query="select * from answer_mojri_gharardad where cod_tarh='$cod_tarh'";
  	$result=mysql_query($query) or die("Error");
	if(mysql_num_rows($result) > 0 ){
		$row_fetched=mysql_fetch_array($result);
		$edit_able=$row_fetched["edit_able"];
 	}
 	if(($new_gharardad_daneshkade=="1" || $ready_gharardad=="1") && $edit_able=='1' && $indoing!="1" && $daneshkade_indoing!='1' && $finalized!="1"){
 		echo "	<a style=\"margin-left:2em;\" href=\"answer_question_gharardad.phtml?cod_tarh=$cod_tarh\">$answer_question_contract</a>";
 	}

	
	if(($indoing=='1' || $daneshkade_indoing=="1") && $finalized!="1")
	{
		$query2="select * from gozaresh_gharardad where cod_tarh='$cod_tarh'";
		$rs2=mysql_query($query2) or die("error in selecting data from tarh");
		while($row_fetched=mysql_fetch_array($rs2))
	 	{
	 		$marhale=$row_fetched["marhale"];
	 		//echo $marhale;
			if($marhale!='100' && $marhale !='0')
			{
			echo "	<a style=\"margin-left:2em;\" href=\"send_marhale_report.phtml?action=select&cod_tarh=$cod_tarh&marhale=$marhale\">$send_report_step $marhale </a>";
			}
		}
		echo "	<a style=\"margin-left:2em;\" href=\"final_report.phtml?cod_tarh=$cod_tarh\">$send_final_report</a>";
	}
	if($finalized=="1")
	{
			$query2="select * from maghale where cod_tarh='$cod_tarh'";
		 // echo $query2;	
		    $result2=mysql_query($query2) or die("Error in selectiong data from tarhtype");
		    $sum_emtiaz=0;
		   while( $row_fetched2=mysql_fetch_array($result2))
		   {
		   		$emtiaz= $row_fetched2["emtiaz"];
		   	//	echo $emtiaz;
		   		$sum_emtiaz=$sum_emtiaz+$emtiaz;
		   }
		   
		  $emtiaz1=($mablagh_aghd_gharardad/10000000)*2.5;
		  $int_emtiaz=(int)$emtiaz1;
		  $real_emtiaz=$emtiaz1-$int_emtiaz;
		  if($real_emtiaz > .75)
		  $int_emtiaz++;
		   
		echo "	<a style=\"margin-left:2em;\" href=\"results_of_tarh.phtml?cod_tarh=$cod_tarh\">$project_resulted</a>";
		echo "	<a style=\"margin-left:2em;\" href=\"send_maghale.phtml?cod_tarh=$cod_tarh\">$article_resulted</a>";
		echo "  <a style=\"margin-left:2em;\" href=\"#\">". $min_score .":". $int_emtiaz ."</a>";
		echo "  <a style=\"margin-left:2em;\" href=\"#\">".$total_points_earned .":". $sum_emtiaz ."</a>";
		
	}
	//echo "<a class=\"btn edit_buttun\" id=\"edit_buttun\" data-toggle=\"modal\" href=\"#basic\" ><i class=\"fa fa-edit\" ></i></a>";
	echo "</div>";
  }
  else if(strcmp($semat,"davar")==0)
  {
  		$query="select * from karshenasan_tarh where cod_tarh='$cod_tarh' and cod_karshenas='$cod_karshenas'";
  		$rs=mysql_query($query) or die("error in selecting data from tarh");
		$rf=mysql_fetch_array($rs);
		$tarh_new=$rf["tarh_new"];
		$finished=$rf["finished"];
		//$tarh_new=$rf["tarh_new"];
  		
  		echo "<div style=''>";	
		echo "<a style=\"margin-left:2em;\">کارشناس مربوطه: $name_family_sender</a>";
		$print= "<a style=\"margin-left:2em;\" target=\"_blank\" href=\"print_tarh.phtml?cod_tarh=$cod_tarh\" ><i title=\"چاپ\" class=\"fa fa-print\"></i></a>";
    	echo $print;
    	$letter= "<a style=\"margin-left:2em;\" onclick=\"view_letters('$cod_tarh');\" ><i title=\"نامه ها\" class=\"fa fa-envelope\" ></i></a>";
		echo $letter;
		$versions= "<a style=\"margin-left:2em;\" onclick=\"view_versions('$cod_tarh');\" ><i title=\"ويرايش هاي طرح\" class=\"fa fa-edit\" ></i></a>";
		echo $versions;
		
		if(strcmp($tarh_new,"1")==0)
		{
    		$confirm= "<a style=\"margin-left:2em;\" onclick=\"confirm_tarh('$cod_tarh');\" ><i title=\"تاييد دريافت\" class=\"fa fa-check-square\" ></i></a>";
			echo $confirm;
		}
		else if(strcmp($tarh_new,"0")==0 && strcmp($finished,"0")==0)
		{
			$query="select * from karshenasan_tarh_note where cod_tarh = '$cod_tarh' and cod_karshenas='$cod_karshenas' and karshenasi_type='2' and marhale_report='$gozaresh_nezarat'";
			$result=mysql_query($query) or die("Error in selecting data from karshenasan_tarh_note");
			$row_fetched=mysql_fetch_array($result);
			$marhale_report=$row_fetched["marhale_report"];
			if($marhale_report==$gozaresh_nezarat){
			$sent_comment="sent_comment";
		    $send_coment= "<a style=\"margin-left:2em;\" onclick=\"send_comment('$cod_tarh','$gozaresh_nezarat','$sent_comment');\" ><i title=\"ارسال نظر\" class=\"fa fa-pencil\" ></i></a>";
		    echo $send_coment;
			}
			else{
			$send_coment= "<a style=\"margin-left:2em;\" onclick=\"send_comment('$cod_tarh','$gozaresh_nezarat');\" ><i title=\"ارسال نظر\" class=\"fa fa-pencil\" ></i></a>";
			echo $send_coment;
			}
			$your_comment= "<a style=\"margin-left:2em;\" onclick=\"your_note('$cod_tarh');\" ><i title=\"نظرات شما\" class=\"fa fa-comment\" ></i></a>";
			echo $your_comment;
			if(strcmp($karshenasi_type,"2")==0){
			$reports= "<a style=\"margin-left:2em;\" onclick=\"show_reports('$cod_tarh');\" ><i title=\"مشاهده گزارشات\" class=\"fa fa-bar-chart-o\" ></i></a>";
			echo $reports;
			}
			$finished= "<a style=\"margin-left:2em;\" onclick=\"finished_karshenasi('$cod_tarh');\" ><i title=\"اتمام کار کارشناسي\" class=\"fa fa-reply\" ></i></a>";
			echo $finished;
			
			
		}
		else 
		{
			$your_comment= "<a style=\"margin-left:2em;\" onclick=\"your_note('$cod_tarh');\" ><i title=\"نظرات شما\" class=\"fa fa-comment\" ></i></a>";
			echo $your_comment;	
			$back_karshenasi= "<a style=\"margin-left:2em;\" onclick=\"return_karshenasi('$cod_tarh');\" ><i title=\"بازگشت به در حال کارشناسي\" class=\"fa fa-share\" ></i></a>";
			echo $back_karshenasi;
		}
		echo "</div>";
		
		
  }
   else if(strcmp($semat,"shora")==0)
  {
  		
  		echo "<div style=''>";	
		echo "<a style=\"margin-left:2em;\">کارشناس مربوطه: $name_family_sender</a>";
		$print= "<a style=\"margin-left:2em;\" target=\"_blank\" href=\"print_tarh.phtml?cod_tarh=$cod_tarh\" ><i title=\"چاپ\" class=\"fa fa-print\"></i></a>";
    	echo $print;
    	$letter= "<a style=\"margin-left:2em;\" onclick=\"view_letters('$cod_tarh');\" ><i title=\"نامه ها\" class=\"fa fa-envelope\" ></i></a>";
		echo $letter;
		$versions= "<a style=\"margin-left:2em;\" onclick=\"view_versions('$cod_tarh');\" ><i title=\"ويرايش هاي طرح\" class=\"fa fa-edit\" ></i></a>";
		echo $versions;
		
		$hazineha= "<a style=\"margin-left:2em;\" onclick=\"hazineha('$cod_tarh');\" ><i title=\"هزينه هاي طرح\" class=\"fa fa-dollar\" ></i></a>";
		echo $hazineha;
		
		$send_coment= "<a style=\"margin-left:2em;\" onclick=\"send_comment('$cod_tarh','$gozaresh_nezarat');\" ><i title=\"ارسال نظر\" class=\"fa fa-pencil\" ></i></a>";
		echo $send_coment;
		
		$your_comment= "<a style=\"margin-left:2em;\" onclick=\"karshenasan_notes('$cod_tarh');\" ><i title=\"نظرات کارشناسان\" class=\"fa fa-comments\" ></i></a>";
		echo $your_comment;
		
		echo "</div>";
		
		
  }
  ?>