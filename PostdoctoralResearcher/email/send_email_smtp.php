<?php
include("include/class.phpmailer.php");
//include("include/mailserver-statistics.phtml");



function send_email_smtp($email,$subject,$body,$extra1,$extra2,$extra3)
{
	include("include/mailserver-statistics.phtml");
	
	
	$mail = new PHPMailer();
	$mail->AddEmbeddedImage('logo.png', 'logoimg', 'logo.png');
	$emailbody="<table border='1' style='direction:rtl;'>"; 
	
	$emailbody=$emailbody."<thead>";
	$emailbody=$emailbody."<tr><td colspan='2' style='background-color:#0F4E74;'><img src=\"cid:logoimg\" /></td></tr>";
	$emailbody=$emailbody."<tr>";
	$emailbody=$emailbody."<th></th>";
	$emailbody=$emailbody."</tr>";
	$emailbody=$emailbody."</thead>";
	
	$emailbody=$emailbody."<tbody>";
	$emailbody=$emailbody."<tr>";
	$emailbody=$emailbody."<td colspan='2'>لطفا به اين ايميل پاسخ ندهيد</td>";
	$emailbody=$emailbody."</tr>";
	$emailbody=$emailbody."<tr>";
	$emailbody=$emailbody."<th scope='row'>عنوان پيام</th><td>$subject</td>";
	$emailbody=$emailbody."</tr>";
	$emailbody=$emailbody."<tr>";
	$emailbody=$emailbody."<th scope='row'>متن پيام</th><td>$body</td>";
	$emailbody=$emailbody."</tr>";
	$emailbody=$emailbody."<tr>";
	$emailbody=$emailbody."<th scope='row'>تار نما</th><td>$url_address</td>";
	$emailbody=$emailbody."</tr>";
	$emailbody=$emailbody."<tr>";
	$emailbody=$emailbody."<th scope='row'>تاريخ ارسال</th><td>$url_address</td>";
	$emailbody=$emailbody."</tr>";
	$emailbody=$emailbody."</tbody>";
	
	$emailbody=$emailbody."</table>";
	//$emailbody=iconv('windows-1256', 'utf-8',$emailbody);
	$mail->IsSMTP();                                      // set mailer to use SMTP
	$mail->SMTPAuth=$smtpauth;
	$mail->Username=$email_username;
	$mail->Password=$email_password;
	// set mailer to use SMTP
	$mail->Host = $mailserver_host;  // specify main and backup server
	$mailname="a"." "."b";
	$mail->From = $email_from;
	$mail->FromName = $email_from_name;
	$mail->AddAddress($email, $mailname);
	$mail->IsHTML(true);                                  // set email format to HTML
	
	$mail->Subject = $subject;
	$mail->Body    = $emailbody;
	$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
	if(!$mail->Send())
	{
		$status="mail_err";
	}
	else 
	{
		$status="success";
	}
	return $status;
}

?>