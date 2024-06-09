<?
include("include/include.phtml");
include("include/database-connect.phtml");
include("include/vars.inc.phtml");

$myq="select * from user_login where email='$admin'";
$res_user=mysql_query($myq) or die("Error");
$rf_user=mysql_fetch_array($res_user);
$payan_name =$rf_user["payan_name"] ;
  $query="select * from tarh where cod_tarh='$cod_tarh'  and version='-1'";
  $result=mysql_query($query) or die("Error in selecting data from karshenas elmi ");
  $row_fetched=mysql_fetch_array($result);
  $servicing = $row_fetched["servicing"];
  
function checkaddslashes($str){
    $str2 = str_replace("\'", "*****", $str);
    if(strpos($str2,"'")!== false)
        return str_replace('*****', "\'", addslashes($str2));
    else
        return $str;
}


if(isset($action) )
{
  if (strcmp($action,"edit_tarh")==0)
  {

    // echo $tarh_select;
    if(strlen(trim($tarh_name)) > 0 &&( strlen(trim($tarh_name_e)) > 0 || $servicing=="1") && (strlen(trim($kelid_vaje)) > 0  || $servicing=="1") &&   strlen(trim($zarorat)) > 0  && (strlen(trim($ahdaf)) > 0 || $servicing=="1")  &&  (strlen(trim($soalat)) > 0 || $servicing=="1") &&  strlen(trim($raveshejra)) > 0 && ($tarh_type!='-1' || $tarh_select==9 ) )
    {

        $kelid_vaje=checkaddslashes($kelid_vaje);
        //$kelid_vaje=str_replace("'","\'",$kelid_vaje);
	   // $kelid_vaje=str_replace("\"","\'",$kelid_vaje);
	    //$kelid_vaje=str_replace(";","\;",$kelid_vaje);
	    
		$line_tahgig=checkaddslashes($line_tahgig);
	    //$line_tahgig=str_replace("'","\'",$line_tahgig);
	   // $line_tahgig=str_replace("\"","\'",$line_tahgig);
	   // $line_tahgig=str_replace(";","\;",$line_tahgig);
	    
		$zarorat=checkaddslashes($zarorat);
	    //$zarorat=str_replace("'","\'",$zarorat);
	    //$zarorat=str_replace("\"","\'",$zarorat);
	    //$zarorat=str_replace(";","\;",$zarorat);
	    //
		$ahdaf=checkaddslashes($ahdaf);
	    //$ahdaf=str_replace("'","\'",$ahdaf);
	    //$ahdaf=str_replace("\"","\'",$ahdaf);
	    //$ahdaf=str_replace(";","\;",$ahdaf);
	    
		$soalat=checkaddslashes($soalat);
	    //$soalat=str_replace("'","\'",$soalat);
	   // $soalat=str_replace("\"","\'",$soalat);
	   // $soalat=str_replace(";","\;",$soalat);
	  
		$raveshejra=checkaddslashes($raveshejra);
	   //// $raveshejra=str_replace("'","\'",$raveshejra);
	   // $raveshejra=str_replace("\"","\'",$raveshejra);
	   // $raveshejra=str_replace(";","\;",$raveshejra);
         
		$tarh_name=checkaddslashes($tarh_name);
		     
       // $tarh_name=str_replace("'","\'",$tarh_name);
	   // $tarh_name=str_replace("\"","\'",$tarh_name);
	   // $tarh_name=str_replace(";","\;",$tarh_name);
	    
		$tarh_name_e=checkaddslashes($tarh_name_e);
		//$tarh_name_e=str_replace("'","\'",$tarh_name_e);
	   // $tarh_name_e=str_replace("\"","\'",$tarh_name_e);
	   // $tarh_name_e=str_replace(";","\;",$tarh_name_e);
	    
      
            
        $query="update tarh  set payan_name='$payan_name',payan_name_daraje_elmi='$payan_name_daraje_elmi',tarh_title_farsi='$tarh_name' ,tarh_title_english='$tarh_name_e',  kelidvajeh ='$kelid_vaje', line ='$line_tahgig', zarorat ='$zarorat', ahdaf ='$ahdaf', soalat ='$soalat', shive_ejra  ='$raveshejra', tarh_type ='$tarh_type' ,tarh_type_1='$tarh_type_1',tarh_type_2='$tarh_type_2',payan_name1='$payan_name1'  where cod_tarh='$cod_tarh'  and version='-1'"; 
        $result=mysql_query($query) or die($query);
        $action="ويرايش چکيده طرح با عنوان"."<br>".$tarh_name;
        set_log($action,$admin,date("Y-m-d, g:i a"));

         $query="update modir_daneshkade_tarh set cod_modir='$modir_payanname' where cod_tarh='$cod_tarh' and version='-1' ";
         $result=mysql_query($query) or die("Error in inserting data into tarh #1");
          ?>
         <script language="javascript">
           window.location="<? echo "tarh_body.phtml?admin=$admin&seed=$seed&cod_tarh=$cod_tarh";  ?>";
           </script>
           <?
    }
    else
      $status="entry_error";
  }

}


  $query="select * from tarh where cod_tarh='$cod_tarh'  and version='-1'";

  $result=mysql_query($query) or die("Error in selecting data from karshenas elmi ");
  $row_fetched=mysql_fetch_array($result);
  $tarh_name=$row_fetched["tarh_title_farsi"];
  $tarh_name_e=$row_fetched["tarh_title_english"];
  $tarh_type=$row_fetched["tarh_type"];
  $kelid_vaje=$row_fetched["kelidvajeh"];
  $kelid_vaje_e=$row_fetched["kelidvajeh_eng"];
  $line_tahgig=$row_fetched["line"];
  $line_tahgig_e=$row_fetched["line_en"];
  $zarorat=$row_fetched["zarorat"];
  $ahdaf=$row_fetched["ahdaf"];
  $soalat=$row_fetched["soalat"];
  $ahdaf=$row_fetched["ahdaf"];
  $raveshejra=$row_fetched["shive_ejra"];
  $cod_daneshkade=$row_fetched["cod_daneshkade"];
  $tarh_type_1_code = $row_fetched["tarh_type_1"];
  $tarh_type_2_code = $row_fetched["tarh_type_2"];
  $daneshkadeh_code_asli = $row_fetched["cod_daneshkade"];
  $group_code_asli = $row_fetched["cod_group"];
  $payan_name1 = $row_fetched["payan_name1"];
  $payan_name_daraje_elmi = $row_fetched["payan_name_daraje_elmi"];
  $first_ostad = $row_fetched["first_ostad"];
  $second_ostad = $row_fetched["second_ostad"];
  $third_ostad = $row_fetched["third_ostad"];
  $forth_ostad = $row_fetched["forth_ostad"];
  $finished=$row_fetched["finished"];
  $first_ostad_moshaver = $row_fetched["first_ostad_moshaver"];
   $second_ostad_moshaver = $row_fetched["second_ostad_moshaver"];
   $third_ostad_moshaver = $row_fetched["third_ostad_moshaver"];
  $forth_ostad_moshaver = $row_fetched["forth_ostad_moshaver"];
  $first_ostad_degree = $row_fetched["first_ostad_degree"];
  $servicing = $row_fetched["servicing"];
  
  $query="select * from modir_daneshkade_tarh where cod_tarh='$cod_tarh'";
 // echo $query;
  $result=mysql_query($query) or die("Error in selecting data from karshenas elmi ");
  $row_fetched=mysql_fetch_array($result);
  $cod_modir= $row_fetched["cod_modir"];
 //echo $cod_modir;
   $admin_edit=0;

   
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
 $query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='1'";
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