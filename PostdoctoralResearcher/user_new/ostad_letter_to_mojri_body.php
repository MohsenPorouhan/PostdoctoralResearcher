<?
include("include/database-connect.phtml");
include("include/include.phtml");
//header_forms($admin,$seed);
//include("include/styles.phtml");
include("include/vars.inc.phtml");
//require("include/class.phpmailer.php");
//require("include/mailserver-statistics.phtml");
require("../email/send_email_smtp.php");
require_once('lib/nusoap.php');

if(isset($action)){
if(strcmp($action,"send_email")==0){
$query="select * from tarh where  tarh.cod_tarh=\"$cod_tarh\" ";
//echo $query;
$result = mysql_query($query) or die("Error in selecting data from tarh , mojri_tarh");
if(mysql_num_rows($result) <= 0 )
{
   // echo "<table border=\"0\"  height=\"100%\" width=\"400\"    cellspacing=\"0\" cellpadding=\"2\"  >";

    //echo "<tr>";
    echo ".چنين طرحي وجود ندارد";
   // echo "</tr>";
    
    //echo "</table>";
    // footer_forms($admin,$seed);
     exit();
    
}

$row_fetched=mysql_fetch_array($result);
$tarh_name=$row_fetched["tarh_title_farsi"];



if(  strlen(trim($cod_tarh))>0 && strlen(trim($letter_subject))>0)
{
	$mydate=date("Y-m-d");
	$to_letter=$row_fetched["creator"];
	$query="select * from modir_daneshkade where  modir_username = '$admin'";
	$result=mysql_query($query);
	$row_fetched=mysql_fetch_array($result);
	$cod_daneshkade=$row_fetched["cod_daneshkade"];
	$q="select max(id) as max_id from letter_to_mojri where cod_tarh='$cod_tarh'";
	$r=mysql_query($q);
	$rf=mysql_fetch_array($r);
	$max_l_no = $rf["max_id"]+1;
	$letter_no=$cod_tarh."-".$max_l_no; 
	$letter_body=str_replace("'","",$letter_body);
    $letter_body=str_replace("\"","",$letter_body);
    $letter_body=str_replace(";","",$letter_body);
    //$letter_body=iconv('utf-8', 'windows-1256', $letter_body);
	$letter_subject=str_replace("'","",$letter_subject);
    $letter_subject=str_replace("\"","",$letter_subject);
    $letter_subject=str_replace(";","",$letter_subject);
    //$letter_subject=iconv('utf-8', 'windows-1256', $letter_subject);
    $query="insert into letter_to_mojri set admin_confirm='1',from_letter='$admin',to_letter='$to_letter',cod_daneshkade='$cod_daneshkade',cod_tarh='$cod_tarh' , letter_no='$letter_no' , letter_subject='$letter_subject' , letter_body='$letter_body' , letter_date='$mydate'";    
     $result=mysql_query($query) or die("error in inserting data");
     echo "sent";
    $q="select * from user_login,tarh where tarh.creator=user_login.email and tarh.cod_tarh='$cod_tarh'";
    $res=mysql_query($q) or die("error");
    $rf=mysql_fetch_array($res);
    $mobile=$rf["mobile"];
    if(strlen($mobile)==11)
      send_sms($mobile,"be  tarh  $cod_tarh name ersal shode. lotfan dar mohit karbari khod name marboote ra molaheze konid\n research.tums.ac.ir");
     else
	 $status="mobile_error";   
    /*if(isset($version) && strcmp($version,'1')==0)
    {    	
	 
      record_duplicate('activities',$cod_tarh,'act_code','1');
      
	  record_duplicate('daneshjo_tarh',$cod_tarh,'','0');
	 
	  record_duplicate('eatebar_sazmanha',$cod_tarh,'id','1');
 	 record_duplicate('fhrest_vasayel_kharid',$cod_tarh,'cod_kharid','1');
 	  record_duplicate('hazine_azmayesh',$cod_tarh,'cod_azmayesh','1');
 	  record_duplicate('hazine_personnel',$cod_tarh,'cod_hazine','1');
 	  record_duplicate('hazine_safar',$cod_tarh,'cod_hazine_safar','1');
 	  record_duplicate('jadval_zarayeb',$cod_tarh,'cod_zarib','1');
 	  record_duplicate('mojri_tarh',$cod_tarh,'mojri_id','1');
 	  record_duplicate('ravesh_ejra',$cod_tarh,'ravesh_id','1');
 	  record_duplicate('sayer_hazine',$cod_tarh,'id','1');
 	  record_duplicate('tarh',$cod_tarh,'','0');
       $query="update tarh set finished='0',edit_request='0' where cod_tarh='$cod_tarh' and version='-1' ";
      $result=mysql_query($query) or die("error in inserting data");
     }*/
     $query="select * from user_login where email=\"$to_letter\"";
   $result=mysql_query($query);
   if(mysql_num_rows($result) > 0 )
   {
    $row_fetched=mysql_fetch_array($result);
    $username=$row_fetched["email"];
    $password=$row_fetched["password"];
    $email=$username;
    $name_e=$row_fetched["name_e"];
    $family_e=$row_fetched["family_e"];
    
    
    //$email_subject=iconv('windows-1256', 'utf-8', 'به آدرس.....يک ايميل ارسال شد');
    //$email_body=iconv('windows-1256', 'utf-8', 'لطفا محيط کاربري خود را در سيستم پژوهشيار بررسي نماييد....');
    $email_subject="به آدرس.....يک ايميل ارسال شد";
    $email_body="لطفا محيط کاربري خود را در سيستم پژوهشيار بررسي نماييد";
    $email="porouhan@gmail.com";
    send_email_smtp($email,$email_subject,$email_body,"","","");


//     $mail = new PHPMailer();
//     $emailbody="";
//     $emailbody=$emailbody."<br><b>Please Check your administration area in Pajoheshyar System<b><br><br>";
//     $emailbody=$emailbody."<br>You have a New Letter For this proposal<br>";
//     $emailbody=$emailbody."<b><br>$tarh_name<br></b>";
//     $emailbody=$emailbody."<br>For Using our system Please login with Below URL<br>";
//     $emailbody=$emailbody."Please login at: <a href=".$url_address."/login.phtml>Here</a>";
//     $emailbody=$emailbody."<center><font face=Arial size=2 color=green>This email has been sent by <a href=\"".$url_address."\">".$url_address."</a>";
//     $emailbody=$emailbody."<br>Powered by Rahpouyan Fanavar Sabz (Rahpouyanco.com).</font></center>";

//     $mail->IsSMTP();                                      // set mailer to use SMTP
//     $mail->SMTPAuth=$smtpauth;
//     $mail->Username=$email_username;
//     $mail->Password=$email_password;
// 	                                      // set mailer to use SMTP
// 	$mail->Host = $mailserver_host;  // specify main and backup server
//     $mailname=$familye." ".$name_e;
//     $mail->From = $email_from;
// 	$mail->FromName = $email_from_name;
//     $mail->AddAddress($email, $mailname);
//     $mail->IsHTML(true);                                  // set email format to HTML

//     $mail->Subject = "You have a New Letter in $url_address (Do not reply this email)";
//     $mail->Body    = $emailbody;
//     $mail->AltBody = "This is the body in plain text for non-HTML mail clients";
//     if(!$mail->Send())
//     {
//         $status="mail_err";
//     }
    
   }
	
    
  	
}
else
  $status="entry_error";

?><?
      if (strcmp($status,"mobile_error")==0)
  {
    echo "<tr>";
    echo "<td align=\"center\" class=\"error-message\" width=\"25%\" class=\"tahoma1\" colspan=\"2\">شماره تلفن همراه موجود در پروفايل مجري صحيح نيست</td>";
    echo "</tr>";
  }
     if (strcmp($status,"entry_error")==0)
  {
    echo "<tr>";
    echo "<td align=\"center\" class=\"error-message\" width=\"25%\" class=\"tahoma1\" colspan=\"2\">مواردي که با ستاره مشخص شده اند را بطور کامل پر کنيد</td>";
    echo "</tr>";
  }
  if (strcmp($status,"entry_error_1")==0)
  {
    echo "<tr>";
    echo "<td align=\"center\" class=\"error-message\" width=\"25%\" class=\"tahoma1\" colspan=\"2\">روي اين شورا کارشناس تعريف شده و قابل حذف نيست</td>";
    echo "</tr>";
  }
  if (strcmp($status,"duplicate_entry")==0)
  {
    echo "<tr>";
    echo "<td align=\"center\" class=\"error-message\" width=\"25%\" class=\"tahoma1\" colspan=\"2\">چنين موردي قبلا تعريف شده</td>";
    echo "</tr>";
  }
  
}


if(strcmp($action,"change_status")==0){
				$query="select * from tarh where cod_tarh='$cod_tarh' and version='-1'";
				$result=mysql_query($query) or die("Error in selecting data from rank");
				$row_fetched = mysql_fetch_array($result);
				$cod_daneshkade=$row_fetched['cod_daneshkade'];
				$tarh_title_farsi=$row_fetched["tarh_title_farsi"];
				$tarh_title_english=$row_fetched["tarh_title_english"];
				$cod_payanname=$cod_tarh;
				
				$query="select * from tarh where payannameh='0' and tarh_title_farsi='$tarh_title_farsi' and tarh_title_english='$tarh_title_english'";
				$result=mysql_query($query) or die("Error in selecting data from rank");
				$row_fetched2= mysql_fetch_array($result);
				
				$count=mysql_num_rows($result);
						if($count>0){
							echo "پايان نامه يکبار به طرح تبديل شده";
							exit();
						}
				
						$year_date = date("Y") - 1921 ;
						// if(strcmp($year_tarh,"0")!=0 && strcmp($rank_num,"0")!=0)
						//    $year_date=$year_tarh;
				
						$today=str_replace("/","-",today());
						$query_rank="select * from rank where '$today' >= start_date and '$today' <= end_date order by end_date desc";
				
						$result=mysql_query($query_rank) or die("Error in selecting data from rank");
				
						if(mysql_num_rows($result) > 0)
						{
							$row_fetched=mysql_fetch_array($result);
							 
							$rank=trim($row_fetched["rank"]);
							$year=trim($row_fetched["year"]);
							 
						}
						else
							$rank="0";
						 
						$query="select maxcode from maxcode ";
						//         $query="select max(right(cod_tarh,3) ) as max_cod from tarh ";
				
						$result=mysql_query($query) or die("Error in selecting data from tarh 145");
						// if(mysql_num_rows($result) > 0 )
						// {
						$row_fetched = mysql_fetch_array($result);
						$max_cod_tarh = $row_fetched["maxcode"]+1;
						//   }
						//  else
						//   $max_cod_tarh=1+3000;
						//$max_cod_tarh= str_pad($max_cod_tarh,4,0,STR_PAD_LEFT);
				
						$cod_daneshkade=str_pad($cod_daneshkade,2,0,STR_PAD_LEFT);
						$rank=str_pad($rank,2,0,STR_PAD_LEFT);
						 
						$cod_tarh_new=$year."-".$rank."-".$cod_daneshkade."-".$max_cod_tarh;
						$max_cod=$cod_tarh_new;
				
				
						$query="update maxcode set maxcode='$max_cod_tarh'";
						$result=mysql_query($query) or die("Error in selecting data from tarh 122");
				
						create_tarh_from_payanname('tarh',$cod_tarh,$cod_tarh_new,'0');
						 
						 
						 
						 
						 
						$query="update tarh set  payan_name='0',submission_center_status ='0',finished='1',creator='$admin',payannameh='0',is_tarh='1',tarh_time='".date("Y-m-d")."',payanname_cod='$cod_payanname' where cod_tarh='$cod_tarh_new' and version='-1' ";
				
						$result=mysql_query($query) or die("Error in updating tarh type in tarh");
						insert_position($cod_tarh,"2",$admin);
						echo "Go to ostad_payan_name";
						?>
				           <script language="javascript">
				          // window.location="<? //echo "ostad_payan_name".".phtml?admin=$admin&seed=$seed&cod_tarh=$cod_tarh&action=create_tarh";  ?>"//;
				           </script>
				           <?
				       
			}
}
?>