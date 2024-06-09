 <?php
 
 //require("include/class.phpmailer.php"); 

require("include/mailserver-statistics.phtml");
 require_once('lib/nusoap.php');

function send_email($subject,$body,$username,$to,$from_name,$from,$password)
{

// Pull in the NuSOAP code
//require_once('lib/nusoap.php');

 
 
 
      $mail = new PHPMailer();
	$mail->SetLanguage( 'en', 'include/language/' );
    $emailbody=$body;
  
    $mail->IsSMTP(); 
                                         // set mailer to use SMTP
    $mail->CharSet  = 'UTF-8'; 
    $mail->WordWrap = 50;  // set word wrap to 50 characters 

    $mail->AddReplyTo("pajoheshyar@peyvandco.com","Pajoheshyar"); 

    
    //$mail->SMTPSecure = "SSL";	
    $mail->Username="pajoheshyar@peyvandco.com";
    $mail->Password="mohsen4590t";
    $mail->Port = 25;
	$mail->SMTPAuth="true";
	//$mail->SMTPDebug  = 2; 
	$mail->Hostname = "mail.peyvandco.com"; 
	$mail->Host = "mail.peyvandco.com"; 
    $mailname=$to;
	$mailname="mohsen.niazi@gmail.com";
    //$mail->From = $from;
	$mail->From = "pajoheshyar@peyvandco.com";
	$mail->FromName ="pajoheshyar@peyvandco.com";
    $mail->AddAddress($to, $to);
	//$mail->AddAddress("mohsen.niazi@gmail.com", "mohsen.niazi@gmail.com");
    $mail->IsHTML(true);                                  // set email format to HTML

    $mail->Subject = $subject;
	//$mail->Subject = "subject of email";
    $mail->Body    = $emailbody;
	//$mail->Body    = "Body of email";
    $mail->AltBody = "This is the body in plain text for non-HTML mail clients";
    
	//echo $mail->Send();
	if(!$mail->Send())
    {
       // error in sending email
	    echo "<br><br><br><br>خطا در ارسال ايميل <br><br><br><br>";
	    
	   
         
$mmm=array(
   'return_type' =>0
	 
	     );
	     return 0;
    }
    else
    {
      $mmm=array(
       'return_type' =>1
	 
	     );
	     return 1;
    }
  
 

		 $ddd[0]=$mmm; 
 
//return $ddd[0];
 // Use the request to (try to) invoke the service

 
} 
  ?>
 