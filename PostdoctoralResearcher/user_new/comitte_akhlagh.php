<?php
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

if($admin_edit==0)
	if(strcmp($finished,'0')==0)
	{
		$query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='13'";
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
	if (strcmp($action,"sabt")==0)
	{
		$status="";
		//  $status_upload=upload_file("../rezayatname",$cod_tarh,"rezayatname.doc");
		// if(!strcmp($status_upload,"10") != 0 )
		/*$status="upload_error";
		if(strcmp(trim($status),"upload_error")==0)
			$rezayatname_filename="";
		else
			$rezayatname_filename="rezayatname.doc";*/
		
		$moshkelat_akhlaghi=mysql_real_escape_string($moshkelat_akhlaghi);
		$halle_moshkelat_akhlaghi=mysql_real_escape_string($halle_moshkelat_akhlaghi);
		
		$query  = "update tarh set moshkelat_akhlaghi =\"$moshkelat_akhlaghi\", halle_moshkelat_akhlaghi = \"$halle_moshkelat_akhlaghi\",rezayatname=$rezayatname,rezayatname_filename=\"$rezayatname_filename\" where cod_tarh=\"$cod_tarh\"  and version='-1'";
		//echo $query;
		$result = mysql_query($query) or die("Error in inserting data into hamkaran_tarh 002");
		
		$query="select * from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='13'";
	       $result=mysql_query($query) or die("Error in selecting data from  rezayatname ");
	       if ( mysql_num_rows($result) <= 0 )
	       {
	      		$query="insert into tarh_exist_item set cod_tarh='$cod_tarh',item_id='13'";
	       		$result=mysql_query($query) or die("Error in selecting data from  rezayatname ");
	       		//echo "exist";
	       }
	       
		$action=" ثبت فرم کميته اخلاقي با کد ".$cod_tarh;
		set_log($action,$admin,date("Y-m-d, g:i a"));
		//message_show(".فرم ملاحظات اخلاقي با موفقيت ثبت شد ","green");
			?>
		  <script language="javascript">
          window.location="<? echo "add_rezayatname.phtml?admin=$admin&seed=$seed&cod_tarh=$cod_tarh";  ?>";
          </script>
	<?php 
		}
}

?>