<?php
include("include/database-connect.phtml");
include("include/include.phtml");


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
		 
     $name_family_sender=$name_family_sender."<p class=\"text-primary\">".$hand."".$myrf["karshenas_name"]." ".$myrf["karshenas_family"]."</p><p class=\"text-primary\">".$myrf["mobile"]."</p>".$vaziat_hozor."";
     
  }
  else
  {
  	 $name_family_sender="نامعلوم";
  }
  echo "<div class=\"row\"><div class=\"well well-sm\" style=\"margin:0 10px;height: 140px;\"><div class=\"col-md-2 pull-right\">کارشناس مربوطه: $name_family_sender</div><div class=\"col-md-2 pull-right\"><a target=\"_blank\" href=\"print_tarh.phtml?admin=$admin&seed=$seed&cod_tarh=$cod_tarh\" ><img border=\"0\" src=\"image/print.png\" width=\"19\" height=\"19\" alt=\"Print\" ></a><a style=\"text-decoration:none\" href=\"archieve.phtml?admin=$admin&seed=$seed&cod_tarh=$cod_tarh\" ><img border=\"0\" style=\"margin-right: 10px;\" src=\"image/archive.png\" alt=\"archive\" ></a></div></div>"
  
  ?>