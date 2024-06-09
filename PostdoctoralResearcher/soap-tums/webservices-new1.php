<?php
// Pull in the NuSOAP code



function ProcessSimpleType($input_parameter) {

  $subject=  $input_parameter['subject'] ;
$row_cnt=0;
for($i=0;$i<10;$i++)
{

$mmm=array(
   'out_string' =>"mohsen",
		 'out_string1' => "niazi",
 	     );

		 $ddd[$row_cnt]=$mmm; 
	 
	$row_cnt=$row_cnt+1;
	}
return $ddd;


 }

require_once('lib/nusoap.php');
require("include/class.phpmailer.php");
 
 
 
  
 $namespace = "http://peyvandco.com/soap";
// create a new soap server
$server = new soap_server();
// configure our WSDL
$server->configureWSDL("SimpleService");


$server->wsdl->addComplexType(
    'input_parameter',
    'complexType',
    'struct',
    'all',
    '',
    array(
         'subject' => array('name' => 'subject', 'type' => 'xsd:string'),
         'body' => array('name' => 'body', 'type' => 'xsd:string') 
     )
);


$server->wsdl->addComplexType(
    'output_parameter',
    'complexType',
    'struct',
    'all',
    '',
    array(
         'out_string' => array('name' => 'out_string', 'type' => 'xsd:string'),
         'out_string1' => array('name' => 'out_string1', 'type' => 'xsd:string')

     )
);



// set our namespace
$server->wsdl->schemaTargetNamespace = $namespace;
// register our WebMethod
$server->register(
                // method name:
                'ProcessSimpleType', 		 
                // parameter list:
    array('input_paraneter' => 'tns:input_parameter'),          // input parameters
    array('return' => 'tns:output_parameter'),    // output parameters
                // namespace:
                $namespace,
                // soapaction: (use default)
                false,
                // style: rpc or document
                'rpc',
                // use: encoded or literal
                'encoded',
                // description: documentation for the method
                'A simple Hello World web method');
                
// Get our posted data if the service is being consumed
// otherwise leave this data blank.                
$POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) 
                ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';

// pass our posted data (or nothing) to the soap service                    
$server->service($POST_DATA);                
exit();

?>