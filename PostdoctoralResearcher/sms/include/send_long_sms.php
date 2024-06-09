<?

function send_long_sms($message_string,$recipientNumber_string,$subject,$sender_number)
{
	$query="select massage_id from magfa_sms order by  id desc";
	$result=mysql_query($query) or die("error in select magfa_sms");
	$row_fetch=mysql_fetch_array($result);
	$massage_id=$row_fetch["massage_id"];
	get_sms_status($massage_id);
	$today=date('Y-m-d');
	$startyear2 = substr($today,0,4);
	$startmon2 = substr($today,5,2);
	$startday2 = substr($today,8,2);
	$today_date=hijricalender( $startyear2 , $startmon2 , $startday2 );
	$today_date= str_replace("/","-",$today_date);
	
	$client = new WebServiceSms();
	if(strlen($sender_number)>1)
	{
	$client->sender_number=$sender_number;
	}
	$massage_id=$client->simpleEnqueueSample($message_string,$recipientNumber_string);
	if(strlen($massage_id)>2)
	{
		$query="insert into magfa_sms set  massage_id='$massage_id',date='$today_date',reciption_number='$recipientNumber_string',massage_text='$message_string',subject='$subject'";
		mysql_query($query) or die("error in insert magfa_sms");
	}
}

function send_group_long_sms($message_string,$recipientNumber_string,$subject)
{
	$today=date('Y-m-d');
	$startyear2 = substr($today,0,4);
	$startmon2 = substr($today,5,2);
	$startday2 = substr($today,8,2);
	$today_date=hijricalender( $startyear2 , $startmon2 , $startday2 );
	$today_date= str_replace("/","-",$today_date);
	$client = new WebServiceSms();
	$massage_id=array();
	$massage_id=$client->enqueueSample($message_string,$recipientNumber_string);
	//echo "sizeof: ".sizeof($recipientNumber_string);
	for($i=0;$i<sizeof($recipientNumber_string);$i++)
	{
		//echo "helo :". $recipientNumber_string[$i]->value." massage_id:".$massage_id[$i]."<br>";
		$recipientNumber_string=$recipientNumber_string[$i]->value;
		if(strlen($massage_id[$i])>2)
		{
			$query="insert into magfa_sms set  massage_id='$massage_id[$i]',date='$today_date',reciption_number='$recipientNumber_string',massage_text='$message_string',subject='$subject'";
			//echo $query;
			mysql_query($query) or die("error in insert magfa_sms");
		}
	}
}

function get_sms_status($massage_id)
{
	$client = new WebServiceSms();
	$status=$client->getMessageStatusSample($massage_id);
	$query="update magfa_sms set status='$status' where massage_id='$massage_id'";
	mysql_query($query) or die("errorin update magfa_sms");
}
?>