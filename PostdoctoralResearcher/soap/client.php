<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
// Pull in the NuSOAP code
 $namespace = "http://research.tums.ac.ir/kte";

require_once('lib/nusoap.php');
// Create the client instance
//$client = new soapclient('http://research.tums.ac.ir/kte/webservices.php?wsdl', true);
$client = new nusoap_client('http://research.tums.ac.ir/kte/webservices.php?wsdl' , false);


// Check for an error
$err = $client->getError();
if ($err) {
    // Display the error
    echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
    // At this point, you know the call that follows will fail
}
// Call the SOAP method
$person = array('reccount' => '5', 'search_string' => '', 'username' => 'swapadmin', 'password' => 'swap_pass96');
$result = $client->call('kte_search_tarh', array('kte_input_parameter' => $person));
// Check for a fault
if ($client->fault) {
    echo '<h2>Fault 1</h2><pre>';
    print_r($result);
    echo $client->getError();
    echo '</pre>';
} else {
    // Check for errors
    $err = $client->getError();
    if ($err) {
        // Display the error
        echo '<h2>Error</h2><pre>' . $err . '</pre>';
    } else {
        // Display the result
        print_r($result);
        
    }
}
// Display the request and response
 echo '  <h2>Request</h2>';
echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2>';
 echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
  
 //print_r($result);
// Display the debug messages
 ?>
 