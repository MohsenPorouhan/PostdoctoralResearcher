<?php
//header('Content-type: image/jpeg');
include("include/database-connect.phtml");
include("include/include.phtml");
if(isset($action))
{
  if (strcmp($action,"finish")==0)
  {  
	$out_put=array();
   // if( strlen(trim($takhasos)) > 0    && strlen(trim($melli_code)) > 0    && strlen(trim($mobile)) > 0   && strlen(trim($name)) > 0 && strlen(trim($family)) > 0 && strlen(trim($hesab)) > 0  )
//	if( strlen(trim($melli_code)) > 0 && strlen(trim($mobile)) > 0 && strlen(trim($name)) > 0 &&strlen(trim($family)) > 0  )
  //  {
      $query="select * from user_login where  email=\"$admin\"";
     // echo $query;
      $result=mysql_query($query) or die("Error in selecting data from karshenas elmi ");
      
      if ( mysql_num_rows($result) > 0 )
      {
	    $rf=mysql_fetch_array($result);
		$hsb=$rf["hesab"];
		$bnm=$rf["bank_name"];
		 $action_more="";
		if(strcmp($hesab,$hsb)!=0)
		  $action_more="  تغيير در شماره حساب  ";
	   if(strcmp($bnm,$bank_name)!=0)
		  $action_more="  تغيير در نوح حساب  "." - ". $action_more;
       $daneshjo_no=str_replace(" ","", $daneshjo_no);
       $daneshjo_no=str_replace(",","", $daneshjo_no);	   
 	    $maghalat=addslashes($maghalat);
		//echo "aa".$payan_name."aa";
	   if(isset($payan_name) && strcmp($payan_name,"1")==0 )
		   $payan_name_text=" payan_name='1',daneshjo_no='$daneshjo_no', ";
		 else
		   $payan_name_text="   ";
		   
		   $fileName = $_FILES['userfile']['name'];
		$tmpName  = $_FILES['userfile']['tmp_name'];
		$fileSize = $_FILES['userfile']['size'];
		$fileType = $_FILES['userfile']['type'];
		
		$fp      = fopen($tmpName, 'r');
		$content = fread($fp, filesize($tmpName));
		$content = addslashes($content);
		fclose($fp);
		
		
		
		
	//header('Content-type: image/jpeg');
	//imagejpeg($dst_r,null,$jpeg_quality);
        $query = "update user_login  set  $payan_name_text  jobplace=\"$jobplace1\",cod_daneshkade=\"$jobplace1\",madrak=\"$madrak1\",mobile=\"$mobile1\",name=\"$name1\" , family=\"$family1\", shno = \"$shno1\",telno = \"$telno1\", fax =\"$fax1\", melli_code =\"$melli_code1\",  darajeelmi = \"$darajeelmi1\" , takhasos = \"$takhasos1\" ,  semat = \"$semat1\" , cod_bank=\"$cod_bank1\" , bank_name=\"$bank_name1\" , shoabe=\"$shoabe1\" , hesab=\"$hesab1\",sex=\"$sex1\",sheba_no=\"$sheba_no1\",picture='$content' where email='$admin'"; 
        //echo $query;
    // exit();
	  //        $query="update user_login set cod_melli='$cod_melli',name='$name' , family='$family', rade_elmi='$rade_elmi',  takhasos  = '$takhasos',  email  ='$email', shenasname='$shenasname' , sal_tavalod='$saltavalod' , fath_name='$nampedar',hesab='$hesab',bank_name='$bank_name',shoabe='$shoabe',cod_bank='$cod_bank' where email='$admin'";
        $result=mysql_query($query) or die("Error in inserting data into karshenas elmi");
        $action="تغيير در پروفايل -". $action_more;
        set_log($action,$admin,date("Y-m-d, g:i a"));
		//echo "sabt";
		
		?>
        <script language="javascript">
        window.location="<? echo "profile.phtml?admin=$admin&seed=$seed";  ?>";
        </script>
        <?
		
      }
      else
       $status="duplicate_entry";

    //}
    //else
     // $status="entry_error";
  }

}

      $query="select * from user_login where  email=\"$admin\"";
      $result=mysql_query($query) or die("Error in selecting data from karshenas elmi ");

      if ( mysql_num_rows($result) > 0 )
      {
		$row_fetched = mysql_fetch_array($result);
		$name=$row_fetched["name"];
		$family=$row_fetched["family"];
		$shno=$row_fetched["shno"];
		$birth_date=$row_fetched["birth_date"];
		$work_addr=$row_fetched["work_addr"];
		$home_addr=$row_fetched["home_addr"];
		$telno=$row_fetched["telno"];
		$fax=$row_fetched["fax"];
		$nampedar=$row_fetched["fath_name"];
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
		$sex=$row_fetched["sex"];
		$line=$row_fetched["line"];
		$cod_bank=$row_fetched["cod_bank"];
		$maghalat=$row_fetched["maghalat"];
		$mobile=$row_fetched["mobile"];
		$jobplace=$row_fetched["jobplace"];
        $madrak=trim($row_fetched["madrak"]);
		$payan_name=$row_fetched["payan_name"];
		$daneshjo_no=$row_fetched["daneshjo_no"];
		$sheba_no=$row_fetched["sheba_no"];
		$content=$row_fetched["picture"];
		
		
      }
      else
      {
      $madrak="";
        $jobplace="";
        $name="";
		$family="";
		$shno="";
		$line="";
		$birth_date="";
		$work_addr="";
		$home_addr="";
		$telno="";
		$fax="";
		$nampedar="";
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
		$sex="";
		$cod_bank="";
		$maghalat="";
		$mobile="";
		$payan_name=0;
		$daneshjo_no='';
		$sheba_no='';
		 
       }
       ?>