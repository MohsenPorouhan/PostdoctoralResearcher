<?php
require_once('libs/nusoap.php'); 
$wsdl="http://linux.mshome.net/webservice/server.php?wsdl";
$client=new soapclient($wsdl, 'wsdl');
$param=array('int1'=>'15.00', 'int2'=>'10'); 
echo $client->call('add', $param);
?>