<?php 
include("include/database-connect.phtml");
include("include/include.phtml");

function checkaddslashes($str){
	$str2 = str_replace("\'", "*****", $str);
	if(strpos($str2,"'")!== false)
		return str_replace('*****', "\'", addslashes($str2));
	else
		return $str;
}

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
$form_rezayatname=$row_fetched["form_rezayatname"];
if($admin_edit==0)
	if(strcmp($finished,'0')==0)
	{
		$query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='16'";
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



if(isset($action))
{
	if(strcmp($action,'sabt')==0)
	{
	 if(strcmp($a0,'1')==0)
	 {
		 	$value_form="a0=1";
		 	
		 	$query="update tarh set form_rezayatname='$value_form' where cod_tarh='$cod_tarh' and version='-1'";
		 	$tarh_result=mysql_query($query) or die("Error in selecting data into tarh");
		 	echo 1;
	 	
	 }	
	 else
	 {	
	 	    $i=0;    			
		  	$value_form="a0=0";
			$query="update tarh set form_rezayatname='$value_form' where cod_tarh='$cod_tarh' and version='-1'";
		  	$tarh_result=mysql_query($query) or die("Error in selecting data into tarh");
		  	
  			echo 0;
	    
	 }	   	
	}
	
	
	
	
	
	
	$query="select * from tarh where cod_tarh=\"$cod_tarh\" and version='-1' ";
	$result=mysql_query($query) or die("Error in updating data into tarh1");
	$my_row_fetched=mysql_fetch_array($result);
	$form_rezayatname=$my_row_fetched['form_rezayatname'];
	
	
	//if(strcmp($action,"sabt2")==0)
	//{
	
	//$query="update tarh set rezayatname_taype='$rezayatname_type' where cod_tarh='$cod_tarh' and version='-1'";
	//$tarh_result=mysql_query($query) or die("Error in selecting data into tarh");
		 
	//}
	
	if(strcmp($action,"add_rezayatname")==0)
	{
		
		$query="update tarh set rezayatname_taype='$rezayatname_type' where cod_tarh='$cod_tarh' and version='-1'";
		$tarh_result=mysql_query($query) or die("Error in selecting data into tarh");
		
		
		if(strlen(trim($a1)) > 0 && strlen(trim($a2)) > 0 && strlen(trim($a3)) > 0 && strlen(trim($a4)) > 0 && strlen(trim($a5)) > 0 && strlen(trim($a6)) > 0 )
		{
			
			$value_form="a0=1";
			for($i=1;$i<11;$i++)
			{
				$var= "a".$i;
					 
				if(strlen(trim($value_form))<=0)
				{
					$value_form=$var."=".addslashes($$var);
				}
				else{
					$value_form=$value_form.",".$var."=".addslashes($$var);
				}
		
				$value_form=checkaddslashes($value_form);
			}
			$value_form=checkaddslashes($value_form);
			$query="update tarh set form_rezayatname='$value_form' where cod_tarh='$cod_tarh' and version='-1'";
			$tarh_result=mysql_query($query) or die("Error in selecting data into rezayatname");
			
		   $query="select * from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='16'";
	       $result=mysql_query($query) or die("Error in selecting data from  rezayatname ");
	       if ( mysql_num_rows($result) <= 0 )
	       {
	      		$query="insert into tarh_exist_item set cod_tarh='$cod_tarh',item_id='16'";
	       		$result=mysql_query($query) or die("Error in selecting data from  rezayatname ");
	       		echo "exist";
	       }
		    //echo ".فرم رضايت نامه ثبت شد";
		    header("Location: upload_file.phtml?cod_tarh=$cod_tarh");
			
	  	
	  	}
	  	 else
	      $status="entry_error";  
	
	      
	    
	  }
} 
?>