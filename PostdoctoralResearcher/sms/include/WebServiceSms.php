<?php

/**
 * Class : WebServiceSample
 * each method of this class describes a sample usage of a WebService request
 * note : this class uses "nusoap" library inorder to send requests via webservice,
 *          you can download the latest version of this library from : "http://sourceforge.net/projects/nusoap/" 
 * before start, please set the prerequisites correctly (such as USERNAME,PASSWORD, & DOMAIN )
 */

class WebServiceSms{

    // your username (fill it with your username)
    private  $USERNAME = "olomPezeshki";

    // your password (fill it with your password)
    private  $PASSWORD = "medicalu_01";

    // your domain (fill it with your domain - usually: "magfa")
    private  $DOMAIN = "magfa";

    // base webservice url
    private  $BASE_WEBSERVICE_URL = "http://webservice.magfa.com/services/urn:SOAPSmsQueue?wsdl";

    private $client; // nusoap client object

    private  $ERROR_MAX_VALUE = 1000;
    private $errors;
    public $sender_number="30007912";




    /**
     * method : constructor
     * the constructor method of the class
     * @return void
     */
    public function __construct(){
        include_once('sms/include/errors.php');
        $this->errors = $errors;
        require_once('sms/include/nusoap/nusoap.php'); // including the nosoap library
        $this->client = new nusoap_client($this->BASE_WEBSERVICE_URL); // creating an instance of nusoap client object
        // set the character set to utf-8 (inorder to prevent corrupting persian messages sending via webservice )
        $this->client->soap_defencoding = 'UTF-8';
        $this->client->decode_utf8 = false;
        $this->client->setCredentials($this->USERNAME,$this->PASSWORD,"basic"); // authentication
    }




    /**
     * method : simpleEnqueueSample
     * this method provides a sample usage of "enqueue" service in the simplest format (one receiver)
     * @return void
     */
    public function simpleEnqueueSample($message_string,$recipientNumber_string){
        $method = "enqueue"; // name of the service
        $message = $message_string; // [FILL] your message to send
        $senderNumber = $this->sender_number; // "30007912" [FILL] sender number; which is your 3000xxx number
        $recipientNumber = $recipientNumber_string; // [FILL] recipient number; the mobile number which will receive the message (e.g 0912XXXXXXX)
        // creating the parameter array
        $params = array(
            'domain'=>$this->DOMAIN,
            'messageBodies'=>array($message),
            'recipientNumbers'=>array($recipientNumber),
            'senderNumbers'=>array($senderNumber)
        );
        // sending the request via webservice
        $response = $this->call($method,$params);

        $result = $response[0];
        // compare the response with the ERROR_MAX_VALUE
        if ($result <= $this->ERROR_MAX_VALUE) {
            echo "An error occured <br> ";
            echo "Error Code : $result ; Error Title : " . $this->errors[$result]['title'] . ' {' . $this->errors[$result]['desc'] . '}';
        } else {
            //echo "Message has been successfully sent ; MessageId : $result";
            return $result;
        }

    }





    /**
     * method : enqueueSample
     * this method provides a sample usage of "enqueue" service
     * @see simpleEnqueueSample()
     * @return void
     */
    public function enqueueSample($message,$recipientNumbers){
        $method = "enqueue"; // name of the service
       // [FILL] your message to send
        $senderNumber = "30007912"; // [FILL] sender number; which is your 3000xxx number
        // [FILL] recipient number; here we have multiple recipients (2)
       

        // creating the parameter array
        $params = array(
            'domain'=>$this->DOMAIN,
            'messageBodies'=>array($message),
            'recipientNumbers'=>$recipientNumbers,
            'senderNumbers'=>array($senderNumber)
        );

        // sending the request via webservice
        $response = $this->call($method,$params);

        foreach($response as $result){
            // compare the response with the ERROR_MAX_VALUE
            if ($result <= $this->ERROR_MAX_VALUE) {
                echo "An error occured <br> ";
                echo "Error Code : $result ; Error Title : " . $this->errors[$result]['title'] . ' {' . $this->errors[$result]['desc'] . '}';
            } else {
                echo "Message has been successfully sent ; MessageId : $result";
            }
            echo "<br>";
        }
        return $response;

    }





    /**
     * method : getAllMessagesSample
     * this method provides a sample usage of "getAllMessages" service
     * @return void
     */
    public function getAllMessagesSample(){
        $method = "getAllMessages"; // name of the service
        $numberOfMessasges = 10; // [FILL] number of the messages to fetch

        // creating the parameter array
        $params = array(
            'domain'=>$this->DOMAIN,
            'numberOfMessages'=>$numberOfMessasges
        );

        // sending the request via webservice
        $response = $this->call($method,$params);

        if(count($response) == 0){
            echo "nothing returned ";
        } else{
            // display the incoming message(s)
            foreach($response as $result){
                echo "Message : ".var_dump($result);
                echo "<br>";
            }
        }
    }


    


    /**
     * method : getAllMessagesWithNumberSample
     * this method provides a sample usage of "getAllMessagesWithNumber" service
     * @return void
     */
    public function getAllMessagesWithNumberSample(){
        $method = "getAllMessagesWithNumber"; // name of the service
        $numberOfMessages = 10; // [FILL] number of the messages to fetch
        $destinationNumber = "983000XXX"; // [FILL] the 983000xxx number

        // creating the parameter array
        $params = array(
            'domain'=>$this->DOMAIN,
            'numberOfMessages'=>$numberOfMessages,
            'destNumber'=>$destinationNumber
        );

        // sending the request via webservice
        $response = $this->call($method,$params);

        if(count($response) == 0){
            echo "nothing returned ";
        } else{
            // display the incoming message(s)
            foreach($response as $result){
                echo "Message : ".var_dump($result);
                echo "<br>";
            }
        }
    }




    
    
    /**
     * method : getCreditSample
     * this method provides a sample usage of "getCredit" service
     * @return void
     */
    public function getCreditSample(){
        $method = "getCredit"; // name of the service

        // creating the parameter array
        $params = array(
            'domain'=>$this->DOMAIN
        );

        // sending the request via webservice
        $response = $this->call($method,$params);

        // display the result
        echo 'Your Credit : '.$response;
    }




    

    /**
     * method : getMessageIdSample
     * this method provides a sample usage of "getMessageId" service
     * @return void
     */
    public function getMessageIdSample(){
        $method = "getMessageId"; // name of the service
        $checkingMessageId = 17; // [FILL] your checkingMessageId

        // creating the parameter array
        $params = array(
            'domain'=>$this->DOMAIN,
            'checkingMessageId'=>new soapval('arg1','long',$checkingMessageId)
        );

        // sending the request via webservice
        $result = $this->call($method,$params);

        // compare the response with the ERROR_MAX_VALUE
        if ($result <= $this->ERROR_MAX_VALUE) {
            echo "An error occured <br> ";
            echo "Error Code : $result ; Error Title : " . $this->errors[$result]['title'] . ' {' . $this->errors[$result]['desc'] . '}';
        } else {
            echo " MessageId : $result";
        }
    }



    /**
     * method : getMessageStatusSample
     * this method provides a sample usage of "getMessageStatus" service
     * @return void
     */
    public function getMessageStatusSample($messageId){
        $method = 'getMessageStatus'; // name of the service
          // [FILL] your messageId
		echo "massage_id: ".$messageId;
        // creating the parameter array
        $params = array(
            'messageId'=>new soapval('arg0','long',$messageId)
        );

        //sending request via webservice
        $result = $this->call($method,$params);

        // checking the response
        if ($result == -1) {
            echo "An error occured <br> ";
            echo "Error Code : $result ; Error Title : " . $this->errors[$result]['title'] . ' {' . $this->errors[$result]['desc'] . '}';
        } else {
            echo " Message Status : $result";
           return $result;
        }
        


    }




    

    /**
     * method : getMessageStatusesSample
     * this method provides a sample usage of "getMessageStatuses" service
     * @return void
     */
    public function getMessageStatusesSample($massage_id_array){
        $method = 'getMessageStatuses'; // name of the service
        // [FILL] an array of messageIds to check
    $messageIds = array(	
        );
        echo sizeof($massage_id_array);
        for($j=0;$j<sizeof($massage_id_array);$j++)
        {
        	$a=new soapval("$j",'long',718570968); // [FILL] your messageID here
        	array_push($messageIds,$a);
        //  [FILL] your messageID here
        }

        // creating the parameter array
        $params = array(
            'messagesId'=>$messageIds
        );

        // sending the request via webservice
        $response = $this->call($method,$params);

        // checking the response
        foreach($response as $result){
            if ($result == -1) {
                echo "An error occured <br> ";
                echo "Error Code : $result ; Error Title : " . $this->errors[$result]['title'] . ' {' . $this->errors[$result]['desc'] . '}';
            } else {
                echo " Message Status : $result";
            }
            echo "<br>";
        }


    }





    /**
     * method : getRealMessageStatuses
     * this method provides a sample usage of "getRealMessageStatuses" service
     * @return void
     */
    public function getRealMessageStatusesSample($massage_id_array){
        $method = 'getRealMessageStatuses'; // name of the service
        // [FILL] an array of messageIds to check
        $messageIds = array(	
        );
        echo sizeof($massage_id_array);
        for($j=0;$j<sizeof($massage_id_array);$j++)
        {
        	$a=new soapval("$j",'long',718570968); // [FILL] your messageID here
        	array_push($messageIds,$a);
        //  [FILL] your messageID here
        }
        // creating the parameter array
        $params = array(
            'arg0'=>$messageIds
        );
        print_r($messageIds);
        // sending the request via webservice
        $response = $this->call($method,$params);

        // checking the response
        foreach($response as $result){
            if ($result == -1) {
                echo "An error occured <br> ";
                echo "Error Code : $result ; Error Title : " . $this->errors[$result]['title'] . ' {' . $this->errors[$result]['desc'] . '}';
            } else {
                echo " Message Status : $result";
                return $result;
            }
            echo "<br>";
        }


    }





    /**
     * method : call
     * this method calls the 'call' method of the nusoap's client object
     * @access private
     * @param  String $method    service name
     * @param  Array $params     webservice parameters in the form of an array
     * @return mixed             result
     */
    private function call($method,$params){
        $result = $this->client->call($method,$params);
        if($this->client->fault || ((bool)$this->client->getError()) ){
            echo '<br>';
            echo "nusoap error: ".$this->client->getError();
            echo '<br>';
        }
        //var_dump($result); echo "<br>";
        return $result;

    }


}

?>
