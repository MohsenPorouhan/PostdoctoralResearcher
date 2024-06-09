<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
// Pull in the NuSOAP code
require_once('lib/nusoap.php');
// Create the client instance
$client = new soapclient('http://research.tums.ac.ir/soap/webservices.php?wsdl', true);
// Check for an error
$err = $client->getError();
if ($err) {
    // Display the error
    echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
    // At this point, you know the call that follows will fail
}
// Call the SOAP method
$person = array('reccount' => '1000', 'search_string' => '', 'username' => 'swapadmin', 'password' => 'swap_pass96');
$result = $client->call('search_tarh', array('input_paraneter' => $person));
// Check for a fault
if ($client->fault) {
    echo '<h2>Fault</h2><pre>';
    print_r($result);
    echo '</pre>';
} else {
    // Check for errors
    $err = $client->getError();
    if ($err) {
        // Display the error
        echo '<h2>Error</h2><pre>' . $err . '</pre>';
    } else {
        // Display the result
        
	 
    }
}
// Display the request and response
 echo '  <h2>Request</h2>';
echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2>';
 echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
// Display the debug messages
 ?>
 