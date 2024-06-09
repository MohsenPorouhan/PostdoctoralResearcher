<?
include("include/database-connect.phtml");
//include("include/include.phtml");
//$karshenasi_koll_1=mablagh_karshenasi($cod_tarh);

// $query="select * from karshenasan_tarh where cod_tarh=\"$cod_tarh\" and cod_karshenas=\"$cod_karshenas\"";
// $result=mysql_query($query) or die("Error in selecting data from karshenas_tarh");
// $row_fetched=mysql_fetch_array($result);
// $gozaresh_nezarat=$row_fetched["gozaresh_nezarat"];
//echo $gozaresh_nezarat;

// $query="select * from tarh where cod_tarh='$cod_tarh' and version='-1'";
// $result=mysql_query($query) or die("Error");
// $my_rf=mysql_fetch_array($result);
// $tarh_name=$my_rf["tarh_name"];
   
    ?>
			<p class="text-justify">
				" براي مشاهده گزارش نهايي هر طرح لازم است اين گزارش توسط ساب ادمين ( يعني مرکز يا دانشکده اي که اين طرح را براي مديريت امور پژوهش فرستاده) تاييد گردد. چنانچه ساب ادمين گزارش را تاييد نکرده باشد امکان مشاهده گزارش نهايي وجود ندارد. در اين موارد مراتب را به کارشناس طرح در حوزه مديريت امور پژوهش اطلاع دهيد."
			</p>
    <?
    
    
     $query="select * from gozaresh_gharardad where  cod_tarh='$cod_tarh' order by marhale asc";
     $result=mysql_query($query) or die("Error");
	 //echo $query;
     echo "<table class='table'>";
//      echo "<tr>";
//      	echo "<td> $tarh_name</td>";   
//      echo "</tr>";
     
     echo "<tr>";
	     echo "<td> مرحله </td>";
	     echo "<td> مشاهده </td>";
	     echo "<td> وضعيت پرداخت </td>";
     echo "</tr>";
     
     while($row_fetched=mysql_fetch_array($result))
     {
     $id=$row_fetched["id"];	
     $marhale=$row_fetched["marhale"];	
     $marhale_txt=$marhale;
     if(strcmp($marhale,"0")==0)
       $marhale_txt="1";
     if(strcmp($marhale,"100")==0)
       $marhale_txt="نهايي"; 
       
        $myq="select * from marhale_report where cod_tarh='$cod_tarh' and marhale='$marhale' ";
     $res=mysql_query($myq) or die("Error");
     $submit_subadmin=0;
	 if(mysql_num_rows($res) > 0)
     {
       $report_string="<b>"." مشاهده گزارش "."-"."  فايل گزارش ارسال شده  "."</b>";
       $rf1=mysql_fetch_array($res);
       $submit_subadmin=$rf1["submit_subadmin"];
	 }	   	     
     else
       $report_string="فايل گزارش ارسال نشده";

      $q="select * from tarh_indoing where cod_tarh='$cod_tarh' and marhale='$marhale' and submitted='1'";
      //echo $q;
     $rs=mysql_query($q) or die('Error');
     $submitted=0;
     if(mysql_num_rows($rs) > 0)
     {
       $rf=mysql_fetch_array($rs);
       $submitted=$rf["submitted"];
      // $id=$rf["id"];
      // echo $id;
       $marhale_pardakht="<b>".'پرداخت شده'."</b>";
     }
     else
	   $marhale_pardakht='پرداخت نشده';  
     echo "<tr>";
     //your_marhale_notes
     
//      echo "<td><a  href=\"nazerin_notes_list.phtml?admin=$admin&seed=$seed&cod_tarh=$cod_tarh&marhale_report=$marhale&marhale_cnt=$marhale_cnt\" ><img border=\"0\" src=\"image/view.gif\" alt=\"Your Notes\" ></a></td>";
//       if(strcmp($marhale,'0')==0)
//       {
//       	echo "<td>بر اساس روال معمول مرحله اول ،مرحله انعقاد قرارداد مي باشد و بر اين اساس گزارش تاييد شده است</td>";
//       }
//       else
//       {
// 	   if(!$submitted)
//        {
//        	if(strcmp($marhale,$gozaresh_nezarat)==0 || $gozaresh_nezarat=='-1'){
//          if(strcmp($marhale,'100')==0)
//            echo "<td><a target=\"_blank\" href=\"nazer_note_final.phtml?admin=$admin&seed=$seed&cod_tarh=$cod_tarh&marhale_report=$marhale&marhale_cnt=$marhale_cnt\" ><img border=\"0\" src=\"image/notes.gif\" alt=\"Your Notes\" ></a></td>";
//          else		    
// 		   echo "<td><a target=\"_blank\" href=\"nazer_notes.phtml?admin=$admin&seed=$seed&cod_tarh=$cod_tarh&marhale_report=$marhale&marhale_cnt=$marhale_cnt\" ><img border=\"0\" src=\"image/notes.gif\" alt=\"Your Notes\" ></a></td>";
//        }
//        else
//        {
//        		 echo "<td>----</td>";
       	
//        } 	
       		
//        }
//        else
//            echo "<td>داراي تاييديه</td>";
//       }
	 echo "<td>$marhale_txt</td>";
 
     
     if($submit_subadmin)
     { 
       if(strcmp($marhale,'100')==0)
	     echo "<td> <a onclick=report_view('$cod_tarh',$marhale);>$report_string</a> </td>";
	   else
         echo "<td> <a onclick=report_view('$cod_tarh',$marhale);>$report_string</a> </td>";
     }
     else
     {
       if(strcmp($marhale,'100')==0)
	     echo "<td>تاييديه ساب ادمين ندارد</td>";
	   else
          echo "<td><a onclick=report_view('$cod_tarh',$marhale);>$report_string</a> </td>";
	
     }
     
     if($submit_subadmin)
     {
     	if(strcmp($marhale,'100')==0)
     		echo "<td>$marhale_pardakht </td>";
     		else
     			echo "<td>$marhale_pardakht </td>";
     }
     else
     			{
     			if(strcmp($marhale,'100')==0)
     				echo "<td >تاييديه ساب ادمين ندارد</td>";
	  else
        echo "<td>$marhale_pardakht </td>";
     			}
	
     }
     echo "</tr>";
     echo "</table>";
?>

