<?
include("include/database-connect.phtml");
include("include/include.phtml");
header_forms($admin,$seed);
include("include/styles.phtml");
$year_date = date("Y") - 1921 ;
$today=str_replace("/","-",today());
echo "<br>";


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
	 	 /*if(strlen(trim($form_rezayatname))<=4){	 
	 	     $i=0;    			
  	$value_form="a".$i."="."1";
    }
	 	 else 
	 	   $value_form=$form_rezayatname;
	 	
	 	$query="update tarh set form_rezayatname='$value_form' where cod_tarh='$cod_tarh' and version='-1'";
  	$tarh_result=mysql_query($query) or die("Error in selecting data into tarh");
  	
  	*/
	 	
	    ?>
           <script language="javascript">
           window.location="<? echo "add_rezayatname.php?admin=$admin&seed=$seed&cod_tarh=$cod_tarh ";  ?>";
           </script>
           <?
	 }	
	 else
	 {	
	 	     $i=0;    			
  	$value_form="a".$i."="."0";
     $value_form=$value_form.","."a11="."\"".addslashes($var)."\"";
	 	
	 	$query="update tarh set form_rezayatname='$value_form' where cod_tarh='$cod_tarh' and version='-1'";
  	$tarh_result=mysql_query($query) or die("Error in selecting data into tarh");
  	
  	
	    ?>
           <script language="javascript">
           window.location="<? echo "sabt_tarh_second.phtml?admin=$admin&seed=$seed&cod_tarh=$cod_tarh ";  ?>";
           </script>
           <?
	 }	   	
	}
}              		


  echo "<form name=\"sabt_tarh\" method=\"post\"  action=\"$PHP_SELF?action=sabt&admin=$admin&seed=$seed&cod_tarh=$cod_tarh\">"; ?>
<table border='1' width='50%' cellspacing="0" cellpadding="0" bordercolor="white" bgcolor='#EEE7F8' dir='rtl'>
<tr>
<td colspan='8' align='center' class='tahoma1'><b>
آيا پژوهش شما نياز به تکميل فرم رضايت نامه دارد يا خير؟</b>
</td>
</tr>
<?
 
  echo "<tr><td class='tahoma1' align='right' width='20%'><input type='radio' name='a0' value='1'>بلي</td></tr>";
  echo "<tr><td class='tahoma1' align='right' width='20%'><input type='radio' name='a0' value='0'>خير</td></tr>";

?>
 
<tr>
<td colspan='8' align='center' class='tahoma1' >
<input type="submit" value="ثبت" name="B1" class="but-small">
</td>
</tr>
</table>
              			
 <?php 
  footer_forms($admin,$seed);
 ?>
