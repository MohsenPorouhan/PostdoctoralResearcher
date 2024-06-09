<?php
include("include/database-connect.phtml");
include("include/include.phtml");
include("include/vars.inc.phtml");

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

$query="select * from tarh where cod_tarh='$cod_tarh'  and version='-1'";
$result=mysql_query($query) or die("Error in selecting data from karshenas elmi ");
$row_fetched=mysql_fetch_array($result);
$tarh_name = $row_fetched["tarh_title_farsi"];
$finished=$row_fetched["finished"];

//echo $admin_edit;

if($admin_edit==0)
	if(strcmp($finished,'0')==0)
	{
		$query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='4'";
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

if(isset($action) )
{
	if (strcmp($action,"add_tarh")==0)
	{
		$query = "select * from ravesh_ejra where cod_tarh = \"$cod_tarh\"  and version='-1'";
		$result=mysql_query($query) or die ("Error in selecting data from ravesh_ejra");
		if(mysql_num_rows($result) > 0 )
		{
			$row_fetched=mysql_fetch_array($result);
			$ravesh_ejra1 = $row_fetched["ravesh_ejra"];
			$moshakhasat_abzar1 = $row_fetched["moshakhasat_abzar"];
			$ravesh_mohasebe1 = $row_fetched["ravesh_mohasebe"];
			$molahezat_akhlaghi1 = $row_fetched["molahezat_akhlaghi"];
			$mahdoudiat_ejra1 = $row_fetched["mahdoudiat_ejra"];
			$fehrest_manabea1 = $row_fetched["new_update_fehrest_manabea"];

			if(strcasecmp($ravesh_ejra1,$ravesh_ejra)!=0)
				$new_update_ravesh_ejra='1';
			else
				$new_update_ravesh_ejra='0';

			if(strcasecmp($moshakhasat_abzar1,$moshakhasat_abzar)!=0)
				$new_update_moshakhasat_abzar='1';
			else
				$new_update_moshakhasat_abzar='0';

			if(strcasecmp($ravesh_mohasebe1,$ravesh_mohasebe)!=0)
				$new_update_ravesh_mohasebe='1';
			else
				$new_update_ravesh_mohasebe='0';

			if(strcasecmp($molahezat_akhlaghi1,$molahezat_akhlaghi)!=0)
				$new_update_molahezat_akhlaghi='1';
			else
				$new_update_molahezat_akhlaghi='0';

			if(strcasecmp($mahdoudiat_ejra1,$mahdoudiat_ejra)!=0)
				$new_update_mahdoudiat_ejra='1';
			else
				$new_update_mahdoudiat_ejra='0';


			$ravesh_ejra=str_replace("'","\'",$ravesh_ejra);
			$ravesh_ejra=str_replace("\"","\'",$ravesh_ejra);
			$ravesh_ejra=str_replace(";","\;",$ravesh_ejra);

			$moshakhasat_abzar=str_replace("'","\'",$moshakhasat_abzar);
			$moshakhasat_abzar=str_replace("\"","\'",$moshakhasat_abzar);
			$moshakhasat_abzar=str_replace(";","\;",$moshakhasat_abzar);

			$ravesh_mohasebe=str_replace("'","\'",$ravesh_mohasebe);
			$ravesh_mohasebe=str_replace("\"","\'",$ravesh_mohasebe);
			$ravesh_mohasebe=str_replace(";","\;",$ravesh_mohasebe);

			$molahezat_akhlaghi=str_replace("'","\'",$molahezat_akhlaghi);
			$molahezat_akhlaghi=str_replace("\"","\'",$molahezat_akhlaghi);
			$molahezat_akhlaghi=str_replace(";","\;",$molahezat_akhlaghi);

			$mahdoudiat_ejra=str_replace("'","\'",$mahdoudiat_ejra);
			$mahdoudiat_ejra=str_replace("\"","\'",$mahdoudiat_ejra);
			$mahdoudiat_ejra=str_replace(";","\;",$mahdoudiat_ejra);
			$query="update ravesh_ejra  set ravesh_ejra=\"$ravesh_ejra\",moshakhasat_abzar=\"$moshakhasat_abzar\", ravesh_mohasebe=\"$ravesh_mohasebe\" ,molahezat_akhlaghi =\"$molahezat_akhlaghi\",mahdoudiat_ejra=\"$mahdoudiat_ejra\",new_update_ravesh_ejra=$new_update_ravesh_ejra,new_update_moshakhasat_abzar=$new_update_moshakhasat_abzar,new_update_ravesh_mohasebe='$new_update_ravesh_mohasebe',new_update_molahezat_akhlaghi='$new_update_molahezat_akhlaghi',new_update_mahdoudiat_ejra='$new_update_mahdoudiat_ejra' where creator  =\"$admin\" and cod_tarh=\"$cod_tarh\"  and version='-1'";
			//echo $query;
			$result=mysql_query($query) or die("Error in updating data into ravesh_ejra");
		          $query2="select * from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='4'";
	       $result2=mysql_query($query2) or die("Error in selecting data from  ravesh ejra ");
	       if ( mysql_num_rows($result2) <= 0 )
	       {
	      		$query3="insert into tarh_exist_item set cod_tarh='$cod_tarh',item_id='4'";
	       		$result3=mysql_query($query3) or die("Error in selecting data from  ravesh ejra  ");
	       		
	       }
			$action="ويرايش روش اجرا با عنوان"."<br>".$tarh_name;
			set_log($action,$admin,date("Y-m-d, g:i a"));
			?>
			<script>
			window.location.href="<? echo "jadval_zarayeb.phtml?cod_tarh=$cod_tarh";?>";
			</script>
			<?


			//echo "success";
		}
		else
		{
			$ravesh_ejra=str_replace("'","\'",$ravesh_ejra);
  	        $ravesh_ejra=str_replace("\"","\'",$ravesh_ejra);
	        $ravesh_ejra=str_replace(";","\;",$ravesh_ejra);
	  
	        $moshakhasat_abzar=str_replace("'","\'",$moshakhasat_abzar);
	        $moshakhasat_abzar=str_replace("\"","\'",$moshakhasat_abzar);
	        $moshakhasat_abzar=str_replace(";","\;",$moshakhasat_abzar);
	
	        $ravesh_mohasebe=str_replace("'","\'",$ravesh_mohasebe);
	        $ravesh_mohasebe=str_replace("\"","\'",$ravesh_mohasebe);
	        $ravesh_mohasebe=str_replace(";","\;",$ravesh_mohasebe);
	  
	        $molahezat_akhlaghi=str_replace("'","\'",$molahezat_akhlaghi);
	        $molahezat_akhlaghi=str_replace("\"","\'",$molahezat_akhlaghi);
	        $molahezat_akhlaghi=str_replace(";","\;",$molahezat_akhlaghi);
	  
	        $mahdoudiat_ejra=str_replace("'","\'",$mahdoudiat_ejra);
	        $mahdoudiat_ejra=str_replace("\"","\'",$mahdoudiat_ejra);
	        $mahdoudiat_ejra=str_replace(";","\;",$mahdoudiat_ejra);
	
		  $query="insert into ravesh_ejra  set ravesh_ejra=\"$ravesh_ejra\",moshakhasat_abzar=\"$moshakhasat_abzar\", ravesh_mohasebe=\"$ravesh_mohasebe\" ,molahezat_akhlaghi =\"$molahezat_akhlaghi\",mahdoudiat_ejra=\"$mahdoudiat_ejra\" , creator  =\"$admin\" , cod_tarh=\"$cod_tarh\",version='-1'";
          $result=mysql_query($query) or die("Error in inserting data into tarh");
          
          $query2="select * from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='4'";
	       $result2=mysql_query($query2) or die("Error in selecting data from  ravesh ejra ");
	       if ( mysql_num_rows($result2) <= 0 )
	       {
	      		$query3="insert into tarh_exist_item set cod_tarh='$cod_tarh',item_id='4'";
	       		$result3=mysql_query($query3) or die("Error in selecting data from  ravesh ejra  ");
	       		
	       }
		   // echo ".فرم رضايت نامه ثبت شد";
          
          $action="اضافه کردن روش اجرا با عنوان"."<br>".$tarh_name;
          set_log($action,$admin,date("Y-m-d, g:i a"));

          ?>
			<script>
			window.location.href="<? echo "jadval_zarayeb.phtml?cod_tarh=$cod_tarh";?>";
			</script>
			<?
        // echo "success";
		}
  }
 }

?>
