<?php
// Pull in the NuSOAP code
require_once('lib/nusoap.php');
require("include/class.phpmailer.php");
  
   $namespace = "http://peyvandco.com/soap";

require("include/mailserver-statistics.phtml");
$server = new soap_server();
// Initialize WSDL support
$server->configureWSDL('soap_send_email', 'urn:soap_send_email');
// Register the data structures used by the service
$server->wsdl->addComplexType(
    'input_paraneter',
    'complexType',
    'struct',
    'all',
    '',
    array(
         'subject' => array('name' => 'subject', 'type' => 'xsd:string'),
         'body' => array('name' => 'body', 'type' => 'xsd:string'),
		'username' => array('name' => 'username', 'type' => 'xsd:string'),
        'to' => array('name' => 'to', 'type' => 'xsd:string'),
        'from_name' => array('name' => 'from_name', 'type' => 'xsd:string'),
        'from' => array('name' => 'from', 'type' => 'xsd:string'),
 
        'password' => array('name' => 'password', 'type' => 'xsd:string')
    )
);
$server->wsdl->addComplexType(
    'SweepstakesGreeting',
    'complexType',
    'struct',
    'all',
     '',
	  
     array(
         'return_type' => array('name' => 'return_type', 'type' => 'xsd:string')
      
	)
);
// Register the method to expose
$server->wsdl->schemaTargetNamespace = $namespace;

$server->register('send_email',                    // method name
    array('input_paraneter' => 'tns:input_paraneter'),          // input parameters
    array('return' => 'tns:SweepstakesGreeting'),    // output parameters
    'urn:soap_send_email',                         // namespace
    'urn:soap_send_email#send_email',                   // soapaction
    'rpc',                                    // style
    'encoded',                                // use
    'Greet a person entering the sweepstakes'        // documentation
);
// Define the method as a PHP function
function send_email($input_parameter)
 {
  $subject=  $input_parameter['subject'] ;
$body= $input_parameter['body'] ;
$to= $input_parameter['to'] ;
$username= $input_parameter['username'] ;
$password= $input_parameter['password'] ;
$subject= $input_parameter['subject'] ;
$from_name= $input_parameter['from_name'] ;
$from= $input_parameter['from'] ;


 
      $mail = new PHPMailer();
	$mail->SetLanguage( 'en', 'include/language/' );
    $emailbody=$body;
  
    $mail->IsSMTP(); 
                                         // set mailer to use SMTP
   // $mail->CharSet  = 'UTF-8'; 
    $mail->WordWrap = 50;  // set word wrap to 50 characters 

    $mail->AddReplyTo("pajoheshyar@peyvandco.com","Pajoheshyar");                                    
    $mail->SMTPAuth="true";
    $mail->Username=$username;
    $mail->Password=$password;
  
	$mail->Hostname = "localhost"; 
	$mail->Host = "localhost"; 
//	$mail->host = $mailserver_host; 
    $mailname=$to;
    $mail->From = $from;
	$mail->FromName =$from_name;
    $mail->AddAddress($to, $to);
    $mail->IsHTML(true);                                  // set email format to HTML

    $mail->Subject = $subject;
    $mail->Body    = $emailbody;
    $mail->AltBody = "This is the body in plain text for non-HTML mail clients";
    if(!$mail->Send())
    {
       // error in sending email
         
$mmm=array(
   'return_type' =>0
	 
	     );
    }
    else
    {
      $mmm=array(
       'return_type' =>1
	 
	     );
    }
  
 

		 $ddd[0]=$mmm; 
 
return $ddd;
}
// Use the request to (try to) invoke the service
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>
 