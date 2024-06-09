<?

include("include/database-connect.phtml");
include("include/include.phtml");
include("include/vars.inc.phtml");
header_forms($admin,$seed);
include("include/styles.phtml");
require("include/class.smtp.php");
require("include/class.phpmailer.php");
require("include/mailserver-statistics.phtml");
//require_once('lib/nusoap.php');
include ("../sms/include/WebServiceSms.php");
include ("../sms/send_long_sms.php");

// $cod_tarh="90-01-66-10001";
// $marhale="3";
// $email="l.s1988@yahoo.com";
// $mobile="09138105929";
// $i="2";
// $message_string="پژوهشيار:مجري محترم طرح شماره  $cod_tarh به اطلاع مي رساند $i ماه از زمان ارسال گزارش پيشرفت قابل قبول مرحله  $marhale طرح مذکور،گذشته است.در همين راستا يک ايميل به آدرس ايميل $email نيز براي شما ارسال شده است. همين آدرس ايميل نام کاربري شما براي ورود ميباشد. research.tums.ac.ir";
// $message_string=iconv("windows-1256", "UTF-8",$message_string);
// $subject="هشدار زمان ارسال گزارش";
// $massage_id=send_long_sms($message_string,$mobile,$subject);


// $mail = new PHPMailer();
// $emailbody="";
// $emailbody=$emailbody."<br><b>پژوهشيار: مجري محترم طرح شماره $cod_tarh با عنوان $tarh_name <b><br><br>";
// $emailbody=$emailbody."<br><b>به اطلاع مي رساند با توجه به مفاد قرارداد طرح مذکور، $i ماه از زمان ارسال گزارش پيشرفت مرحله $marhale گذشته است <b><br><br>";
// $emailbody=$emailbody."<br> در همين راستا چنانچه به هر علتي امکان ارسال گزارش پيشرفت وجود ندارد و يا در نهايت فقط قصد ارسال گزارش نهايي را داريد <br>";
// $emailbody=$emailbody."<br>و يا اينکه گزارش پيشرفت قابل قبولي ارسال کرده ايد ولي همچنان پيامک و ايميل اطلاع رساني را دريافت مي کنيد، <br><br>";
// $emailbody=$emailbody."<br>با انجام مکاتبه اي در پژوهشيار، مراتب را به اطلاع کارشناس طرح مذکور برسانيد تا اطلاع رساني براي ارسال گزارش پيشرفت اين مرحله را غير فعال نمايد. <br><br>";
// $emailbody=$emailbody."Please login at: <a href=".$url_address."/login/>Here</a>";
// $emailbody=$emailbody."<center><font face=Arial size=2 color=green>This email has been sent by <a href=\"".$url_address."\">".$url_address."</a>";
// $emailbody=$emailbody."<br>Powered by Peyvand Co. (Peyvandco.com).</font></center>";
// $emailbody=iconv("windows-1256", "UTF-8",$emailbody);

// $mail->IsSMTP();                                      // set mailer to use SMTP
// $mail->SMTPAuth=$smtpauth;
// $mail->Username=$email_username;
// $mail->Password=$email_password;
// $mail->WordWrap = 50;  // set word wrap to 50 characters

// $mail->AddReplyTo($email_from,$email_from_name);
// // set mailer to use SMTP
// $mail->host = $mailserver_host;  // specify main and backup server
// $mailname=$familye;
// $mail->From = $email_from;
// $mail->FromName = $email_from_name;
// $mail->AddAddress($email, $mailname);
// $mail->IsHTML(true);                                  // set email format to HTML

// $mail->Subject = "Check your box in $url_address (Do not reply this email)";
// $mail->Body    = $emailbody;
// $mail->AltBody = "This is the body in plain text for non-HTML mail clients";
// 				    if(!$mail->Send())
// 			    		{
// 					        $status="mail_err";
// 					    }

// exit();

// $client = new WebServiceSms();
// $message_string="تا پايان مهلت ارسال گزارش پيشرفت طرح با کدتا پايان مهلت ارسال گزارش پيشرفت طرح با کدتا پايان مهلت ارسال گزارش پيشرفت طرح با کدتا پايان مهلت ارسال گزارش پيشرفت طرح با کد";
// $message_string=iconv("windows-1256", "UTF-8",$message_string);
// $recipientNumber_string=array();
// $recipientNumber_string[0]="09132259500";
// $recipientNumber_string[1]="09394457244";
// $recipientNumbers=array();
// for($i=0;$i<2;$i++){
// 	if($i==0)
// 	$obj=new soapval('item1','string','09132259500') ;
// 	else
// 	$obj=new soapval('item1','string','009') ;
// 	// [FILL]
// 	$recipientNumbers[]=$obj;
// }
// $recipientNumbers = array(
//            new soapval('item1','string','09132259500'), // [FILL]
//            new soapval('item2','string','09394457244') // FILL
//            // you can add more items here ...
//        );
//$result=$client->enqueueSample($recipientNumbers);
//$status=$client->getMessageStatusSample(18776287218);
// $subject="هشدار زمان ارسال گزارش";
// $massage_id=send_group_long_sms($message_string,$recipientNumbers,$subject);
// //$status=get_sms_status($massage_id);

// echo "res: ".$result." status: ".$status;
// exit();
// $cod_tarh="90-01-66-10001";
// $i="2";
// $letter_body="(پژوهشيار)يادآوري: $i ماه از زمان ارسال گزارش پيشرفت (قابل قبول) طرح با کد $cod_tarh گذشته است";
// 				$letter_body=iconv("windows-1256", "UTF-8",$letter_body);
// 		 		send_sms("09121486737",$letter_body);
// 				send_sms("09132259500",$letter_body);
//$date=strtotime( "+1 month", strtotime( "1393-06-31" ) );
//echo $time = date("Y-m-d",$date);
//send_sms("09132259500","$iماه از زمان ارسال گزارش پيشرفت طرح با کد $cod_tarh گذشته است");

//exit();

//$letter_body="تا پايان مهلت ارسال گزارش پيشرفت طرح با کد $cod_tarh شما 7 روز باقي مانده است";
//$i=2;

//$letter_body="پژوهشيار: شما تا ساعت 24 امروز براي ارسال گزارش پيشرفت طرح با کد $cod_tarh فرصت داريد";
//$letter_body=arabic2utf($letter_body);
   	// $letter_body=iconv("windows-1256", "UTF-8",$letter_body);
//send_sms("09132259500","تا پايان مهلت ارسال گزارش پيشرفت طرح با کد $cod_tarh شما 7 روز باقي مانده است");
//send_sms("09138105929",$letter_body);
// exit();


$last_week=date('Y-m-d', strtotime("-1 week"));
//echo $today;
$startyear = substr($last_week,0,4);
$startmon = substr($last_week,5,2);
$startday = substr($last_week,8,2);
$last_week_date=hijricalender( $startyear , $startmon , $startday );
$last_week_date= str_replace("/","-",$last_week_date);
//echo $farsistartdate;

$today=date('Y-m-d');
$startyear2 = substr($today,0,4);
$startmon2 = substr($today,5,2);
$startday2 = substr($today,8,2);
$today_date=hijricalender( $startyear2 , $startmon2 , $startday2 );
$today_date= str_replace("/","-",$today_date);


$query="select * from tarh,gozaresh_gharardad  where tarh.finalized ='0'  and indoing='1' and tarh_type!='6'  and tarh.tarh_makhtoome ='0' and tarh.version='-1' and tarh.cod_tarh=gozaresh_gharardad.cod_tarh and (gozaresh_gharardad.marhale !='0' and gozaresh_gharardad.marhale !='100') group by tarh.cod_tarh order by tarh_time desc" ;

$result=mysql_query($query) or die("Error in selecting data from tarh2");
 //echo "<form name=\"sabt_tarh\" method=\"post\"  action=\"$PHP_SELF?admin=$admin&seed=$seed&cod_tarh=$cod_tarh\">";
 while($row_fetched=mysql_fetch_array($result))
 {
 	$cod_tarh=$row_fetched["cod_tarh"];
 	$tarh_name=$row_fetched["tarh_title_farsi"];
 	$creator=$row_fetched["creator"];
 	
 	
 	$date_gozaresh=$row_fetched["date_gozaresh"];
 	$marhale=$row_fetched["marhale"];
 	
 	$query="select * from marhale_report where cod_tarh='$cod_tarh' and (marhale='$marhale' or marhale='100')  and accept_gozaresh='1'";
 	$result2=mysql_query($query) or die("Error in selecting data from tarh2");
 	
 	//echo $date_gozaresh."=gozaresh<br>";
 	//echo $last_week_date."=last_week_date<br>";
 	if(mysql_num_rows($result2)<=0){
		 	if(strcmp($date_gozaresh,$last_week_date)==0)
		 	{
		 		$query22="select * from user_login where email='$creator'";
		 		//echo $cod_tarh;
		 		//echo "<br>".$date_gozaresh;
			 	$result22=mysql_query($query22) or die("Error in selecting data from tarh22");
			 	$rf22=mysql_fetch_array($result22);
			 	
			 	$mobile=$rf22["mobile"];
			 	$email=$rf22["email"];
		 		//echo $creator;
		 		
// 		 		$letter_body="پژوهشيار: تا پايان مهلت ارسال گزارش پيشرفت طرح با کد $cod_tarh شما 7 روز باقي مانده است";
// 				$letter_body=iconv("windows-1256", "UTF-8",$letter_body);
		 		//send_sms($mobile,$letter_body);
				$message_string="پژوهشيار:مجري محترم طرح شماره  $cod_tarh به اطلاع مي رساند تا پايان مهلت ارسال گزارش پيشرفت مرحله $marhale طرح مذکور، 7 روز باقي مانده است.در همين راستا يک ايميل به آدرس ايميل $email نيز براي شما ارسال شده است. همين آدرس ايميل نام کاربري شما براي ورود ميباشد. research.tums.ac.ir";
				//$message_string=iconv("windows-1256", "UTF-8",$message_string);
				$subject="هشدار زمان ارسال گزارش";
				$massage_id=send_long_sms($message_string,$mobile,$subject);
		 		
		 		$mail = new PHPMailer();
			    $emailbody="";
			    $emailbody=$emailbody."<br><b>پژوهشيار: مجري محترم طرح شماره $cod_tarh با عنوان $tarh_name <b><br><br>";
			    $emailbody=$emailbody."<br><b>به اطلاع مي رساند با توجه به مفاد قرارداد طرح مذکور، يک هفته تا زمان ارسال گزارش پيشرفت مرحله $marhale فرصت باقي مانده است <b><br><br>";
			    $emailbody=$emailbody."<br> در همين راستا چنانچه به هر علتي امکان ارسال گزارش پيشرفت وجود ندارد و يا در نهايت فقط قصد ارسال گزارش نهايي را داريد <br>";
			    $emailbody=$emailbody."<br>و يا اينکه گزارش پيشرفت قابل قبولي ارسال کرده ايد ولي همچنان پيامک و ايميل اطلاع رساني را دريافت مي کنيد، <br><br>";
			    $emailbody=$emailbody."<br>با انجام مکاتبه اي در پژوهشيار، مراتب را به اطلاع کارشناس طرح مذکور برسانيد تا اطلاع رساني براي ارسال گزارش پيشرفت اين مرحله را غير فعال نمايد. <br><br>";
				$emailbody=$emailbody."Please login at: <a href=".$url_address."/login/>Here</a>";
			    $emailbody=$emailbody."<center><font face=Arial size=2 color=green>This email has been sent by <a href=\"".$url_address."\">".$url_address."</a>";
			    $emailbody=$emailbody."<br>Powered by Peyvand Co. (Peyvandco.com).</font></center>";
				//$emailbody=iconv("windows-1256", "UTF-8",$emailbody);
			    $mail->IsSMTP();                                      // set mailer to use SMTP
			    $mail->SMTPAuth=$smtpauth;
			    $mail->Username=$email_username;
			    $mail->Password=$email_password;
			    $mail->WordWrap = 50;  // set word wrap to 50 characters 
			
			    $mail->AddReplyTo($email_from,$email_from_name);
				                                      // set mailer to use SMTP
				$mail->host = $mailserver_host;  // specify main and backup server
			    $mailname=$familye;
			    $mail->From = $email_from;
				$mail->FromName = $email_from_name;
			    $mail->AddAddress($creator, $mailname);
			    $mail->IsHTML(true);                                  // set email format to HTML
			
			    $mail->Subject = "Check your box in $url_address (Do not reply this email)";
			    $mail->Body    = $emailbody;
			    $mail->AltBody = "This is the body in plain text for non-HTML mail clients";
//			    if(!$mail->Send())
//			    {
//			        $status="mail_err";
//			    }
		 	}
		 	
		 	else if( strcmp($date_gozaresh,$today_date)==0 )
		 	{
		 		$query22="select * from user_login where email='$creator'";
		 		//echo $cod_tarh;
		 		//echo "<br>".$date_gozaresh;
			 	$result22=mysql_query($query22) or die("Error in selecting data from tarh22");
			 	$rf22=mysql_fetch_array($result22);
			 	
			 	$mobile=$rf22["mobile"];
			 	$email=$rf22["email"];
		 		//echo $creator;
		 		
// 		 		$letter_body="پژوهشيار: شما تا ساعت 24 امروز براي ارسال گزارش پيشرفت طرح با کد $cod_tarh فرصت داريد";
// 				$letter_body=iconv("windows-1256", "UTF-8",$letter_body);
		 		//send_sms($mobile,$letter_body);
		 		
			 	$message_string="پژوهشيار:مجري محترم طرح شماره  $cod_tarh به اطلاع مي رساند تا پايان مهلت ارسال گزارش پيشرفت مرحله $marhale طرح مذکور، تا ساعت 24 امروز فرصت داريد.در همين راستا يک ايميل به آدرس ايميل $email نيز براي شما ارسال شده است. همين آدرس ايميل نام کاربري شما براي ورود ميباشد. research.tums.ac.ir";
			 	//$message_string=iconv("windows-1256", "UTF-8",$message_string);
			 	$subject="هشدار زمان ارسال گزارش";
			 	$massage_id=send_long_sms($message_string,$mobile,$subject);
			 	
		 		
		 		$mail = new PHPMailer();
			    $emailbody="";
			    $emailbody=$emailbody."<br><b>پژوهشيار: مجري محترم طرح شماره $cod_tarh با عنوان $tarh_name <b><br><br>";
			    $emailbody=$emailbody."<br><b>به اطلاع مي رساند با توجه به مفاد قرارداد طرح مذکور، تا ساعت 24 امروز براي ارسال گزارش پيشرفت مرحله $marhale فرصت داريد <b><br><br>";
			    $emailbody=$emailbody."<br> در همين راستا چنانچه به هر علتي امکان ارسال گزارش پيشرفت وجود ندارد و يا در نهايت فقط قصد ارسال گزارش نهايي را داريد <br>";
			    $emailbody=$emailbody."<br>و يا اينکه گزارش پيشرفت قابل قبولي ارسال کرده ايد ولي همچنان پيامک و ايميل اطلاع رساني را دريافت مي کنيد، <br><br>";
			    $emailbody=$emailbody."<br>با انجام مکاتبه اي در پژوهشيار، مراتب را به اطلاع کارشناس طرح مذکور برسانيد تا اطلاع رساني براي ارسال گزارش پيشرفت اين مرحله را غير فعال نمايد. <br><br>";
				$emailbody=$emailbody."Please login at: <a href=".$url_address."/login/>Here</a>";
			    $emailbody=$emailbody."<center><font face=Arial size=2 color=green>This email has been sent by <a href=\"".$url_address."\">".$url_address."</a>";
			    $emailbody=$emailbody."<br>Powered by Peyvand Co. (Peyvandco.com).</font></center>";
			    $emailbody=iconv("windows-1256", "UTF-8",$emailbody);
			
			    $mail->IsSMTP();                                      // set mailer to use SMTP
			    $mail->SMTPAuth=$smtpauth;
			    $mail->Username=$email_username;
			    $mail->Password=$email_password;
			    $mail->WordWrap = 50;  // set word wrap to 50 characters 
			
			    $mail->AddReplyTo($email_from,$email_from_name);
				                                      // set mailer to use SMTP
				$mail->host = $mailserver_host;  // specify main and backup server
			    $mailname=$familye;
			    $mail->From = $email_from;
				$mail->FromName = $email_from_name;
			    $mail->AddAddress($creator, $mailname);
			    $mail->IsHTML(true);                                  // set email format to HTML
			
			    $mail->Subject = "Check your box in $url_address (Do not reply this email)";
			    $mail->Body    = $emailbody;
			    $mail->AltBody = "This is the body in plain text for non-HTML mail clients";
//			    if(!$mail->Send())
//			    {
//			        $status="mail_err";
//			    }
		 		
		 	}
		 	else if($today>$date_gozaresh){
		 		for($i=1;$i<12;$i++){
		 			//$next_month=date('Y-m-d', strtotime("+$i month"));
		 			$next_month=strtotime( "$i month", strtotime( $date_gozaresh ) );
		 			$next_month = date("Y-m-d",$next_month);
		 			if( strcmp($next_month,$today_date)==0 )
				 	{
				 		$query22="select * from user_login where email='$creator'";
				 		//echo $cod_tarh;
				 	//echo "<br>".$date_gozaresh;
					 	$result22=mysql_query($query22) or die("Error in selecting data from tarh22");
					 	$rf22=mysql_fetch_array($result22);
					 	
					 	$mobile=$rf22["mobile"];
					 	$email=$rf22["email"];
				 		//echo "<br>".$creator;
				 	//	echo "<br>".$i;
				 		
// 				 		$letter_body="(پژوهشيار)يادآوري: $i ماه از زمان ارسال گزارش پيشرفت (قابل قبول) طرح با کد $cod_tarh گذشته است";
// 				 		$letter_body=iconv("windows-1256", "UTF-8",$letter_body);
				 		
				 		//send_sms($mobile,$letter_body);
				 		
				 	$message_string="پژوهشيار:مجري محترم طرح شماره  $cod_tarh به اطلاع مي رساند $i ماه از زمان ارسال گزارش پيشرفت قابل قبول مرحله  $marhale طرح مذکور،گذشته است.در همين راستا يک ايميل به آدرس ايميل $email نيز براي شما ارسال شده است. همين آدرس ايميل نام کاربري شما براي ورود ميباشد. research.tums.ac.ir";
				 	//$message_string=iconv("windows-1256", "UTF-8",$message_string);
				 	$subject="هشدار زمان ارسال گزارش";
				 	$massage_id=send_long_sms($message_string,$mobile,$subject);
				 		
				 	$mail = new PHPMailer();
				    $emailbody="";
				    $emailbody=$emailbody."<br><b>پژوهشيار: مجري محترم طرح شماره $cod_tarh با عنوان $tarh_name <b><br><br>";
				    $emailbody=$emailbody."<br><b>به اطلاع مي رساند با توجه به مفاد قرارداد طرح مذکور، $i ماه از زمان ارسال گزارش پيشرفت مرحله $marhale گذشته است <b><br><br>";
				    $emailbody=$emailbody."<br> در همين راستا چنانچه به هر علتي امکان ارسال گزارش پيشرفت وجود ندارد و يا در نهايت فقط قصد ارسال گزارش نهايي را داريد <br>";
				    $emailbody=$emailbody."<br>و يا اينکه گزارش پيشرفت قابل قبولي ارسال کرده ايد ولي همچنان پيامک و ايميل اطلاع رساني را دريافت مي کنيد، <br><br>";
				    $emailbody=$emailbody."<br>با انجام مکاتبه اي در پژوهشيار، مراتب را به اطلاع کارشناس طرح مذکور برسانيد تا اطلاع رساني براي ارسال گزارش پيشرفت اين مرحله را غير فعال نمايد. <br><br>";
					$emailbody=$emailbody."Please login at: <a href=".$url_address."/login/>Here</a>";
				    $emailbody=$emailbody."<center><font face=Arial size=2 color=green>This email has been sent by <a href=\"".$url_address."\">".$url_address."</a>";
				    $emailbody=$emailbody."<br>Powered by Peyvand Co. (Peyvandco.com).</font></center>";
				    //$emailbody=iconv("windows-1256", "UTF-8",$emailbody);
				
				    $mail->IsSMTP();                                      // set mailer to use SMTP
				    $mail->SMTPAuth=$smtpauth;
				    $mail->Username=$email_username;
				    $mail->Password=$email_password;
				    $mail->WordWrap = 50;  // set word wrap to 50 characters 
				
				    $mail->AddReplyTo($email_from,$email_from_name);
					                                      // set mailer to use SMTP
					$mail->host = $mailserver_host;  // specify main and backup server
				    $mailname=$familye;
				    $mail->From = $email_from;
					$mail->FromName = $email_from_name;
				    $mail->AddAddress($creator, $mailname);
				    $mail->IsHTML(true);                                  // set email format to HTML
				
				    $mail->Subject = "Check your box in $url_address (Do not reply this email)";
				    $mail->Body    = $emailbody;
				    $mail->AltBody = "This is the body in plain text for non-HTML mail clients";
//				    if(!$mail->Send())
//				    {
//				        $status="mail_err";
//				    }
				 		
				 	}
		 			
		 			
		 		}
		 		
		 	}
 	}
 	
 	
 	//echo $date_gozaresh;
 }
 
 
 
 ?>
 
 
<? 

footer_forms($admin,$seed);


?>