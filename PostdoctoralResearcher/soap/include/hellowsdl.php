<?php
require_once('include/database-connect.phtml');
// Pull in the NuSOAP code
require_once('lib/nusoap.php');
// Create the server instance
$server = new soap_server();
// Initialize WSDL support
$server->configureWSDL('search', 'urn:search');
// Register the method to expose
$server->register('search',                // method name
    array('name' => 'xsd:string'),        // input parameters
    array('return' => 'xsd:string'),      // output parameters
    'urn:search',                      // namespace
    'urn:search#search',                // soapaction
    'rpc',                                // style
    'encoded',                            // use
    'Says hello to the caller'            // documentation
);
// Define the method as a PHP function
function search($name) {
  $query = "select * from tarh where cod_tarh = '". $name."'";
 
      if ($result = mysql_query($query))
    else
	   {
	      $error = "mysql_error()";
        return $error."mohsen";
		 }
    $price = mysql_result($result, 0, 0);
    return $price;

      //  return 'Hello, ' . $name;
}
// Use the request to (try to) invoke the service
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>
