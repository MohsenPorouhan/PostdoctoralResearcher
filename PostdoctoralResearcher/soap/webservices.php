<?php
// Pull in the NuSOAP code
 $namespace = "http://research.tums.ac.ir/kte";

require_once('lib/nusoap.php');
require_once('include/database-connect.phtml');// Create the server instance
$server = new soap_server();
// Initialize WSDL support
$server->configureWSDL('kte_search_tarh',$namespace );
 $server->wsdl->schemaTargetNamespace = $namespace;

// Register the data structures used by the service
$server->wsdl->addComplexType(
    'kte_input_parameter',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'reccount' => array('name' => 'reccount', 'type' => 'xsd:int'),
        'search_string' => array('name' => 'search_string', 'type' => 'xsd:string'),
		'username' => array('name' => 'username', 'type' => 'xsd:string'),
        'password' => array('name' => 'password', 'type' => 'xsd:string')
    )
);
$server->wsdl->addComplexType(
   'kte_output_parameter',
    'complexType',
    'struct',
    'all',
    '',   
     array(
         'project_id' => array('name' => 'project_id', 'type' => 'xsd:string'),
		 'dept' => array('name' => 'dept', 'type' => 'xsd:string'),
		 'title' => array('name' => 'title', 'type' => 'xsd:string'),
		 'title_fa' => array('name' => 'title_fa', 'type' => 'xsd:string'),
		 'language' => array('name' => 'language', 'type' => 'xsd:string'),
		 'projec_type' => array('name' => 'projec_type', 'type' => 'xsd:string'),
		 'projec_type_fa' => array('name' => 'projec_type_fa', 'type' => 'xsd:string'),
		 'keyword' => array('name' => 'keyword', 'type' => 'xsd:string'),
		 's_type' => array('name' => 's_type', 'type' => 'xsd:string'),
		 's_date_year' => array('name' => 's_date_year', 'type' => 'xsd:string'),
		 's_date_month' => array('name' => 's_date_month', 'type' => 'xsd:string'),
		 's_date_day' => array('name' => 's_date_day', 'type' => 'xsd:string'),
		 'first_name_fa' => array('name' => 'first_name_fa', 'type' => 'xsd:string'), //mojri name
		 'last_name_fa' => array('name' => 'last_name_fa', 'type' => 'xsd:string'), //mojri family
		 'suffix' => array('name' => 'suffix', 'type' => 'xsd:string'),  //gender
		 'suffix_fa' => array('name' => 'suffix_fa', 'type' => 'xsd:string'),  //gender
		 'email' => array('name' => 'email', 'type' => 'xsd:string'),  //email
         'code' => array('name' => 'code', 'type' => 'xsd:string'),  //melli			
		 'postal_code' => array('name' => 'postal_code', 'type' => 'xsd:string'),  //melli			
		 'specialty' => array('name' => 'specialty', 'type' => 'xsd:string'),  //takhasos			
		 'office_address_fa' => array('name' => 'office_address_fa', 'type' => 'xsd:string')  //melli			
	 
   
	)
);


 



// Register the method to expose
$server->register('kte_search_tarh',                    // method name
    array('kte_input_parameter' => 'tns:kte_input_parameter'),          // input parameters
    array('return' => 'tns:kte_output_parameter'),    // output parameters
    $namespace,                         // namespace
    false,                   // soapaction
    'rpc',                                    // style
    'encoded',                                // use
    'Search tarh from all of tarh in database. you must set count of tarhs'        // documentation
);

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);


// Define the method as a PHP function
function kte_search_tarh($input_parameter)
 {

$search_string=  $input_parameter['search_string'] ;
$username= $input_parameter['username'] ;
$password= $input_parameter['password'] ;
if(strcmp($username."swapadmin")!=0 || strcmp($password,"swap_pass96")!=0)
  return "ERROR IN USERNAME AND PASSWORD";

$title=iconv("utf-8","windows-1256",$rf["tarh_title_english"]);
$reccount=  $input_parameter['reccount'] ;
if($reccount > 0 && strlen($reccount) >0)
  $limit="limit 0,$reccount";
 else
   $limit="limit 0,2000";
 if(strlen($search_string) > 0)
    $inner_search=" ( cod_tarh='$search_string' or tarh_title_farsi like '%$search_string%')";
 else
     $inner_search=1;
 
$query="select   * from tarh,daneshkade,tarhtype,user_login where (tarh.finalized='1' or tarh.indoing='1' ) and tarh.creator=user_login.email and tarh.cod_daneshkade=daneshkade.cod_daneshkade and tarh.tarh_type=tarhtype.tarh_type and $inner_search    and version='-1' $limit";
//echo $query;
//$query="select   * from tarh where 1 limit 1,10";
$rs=mysql_query($query) or die("error");
if(mysql_num_rows($rs)<=0)
   return 0;
  $row_cnt=0; 
   $ppp=array();
   
while($rf=mysql_fetch_array($rs))
{
 
$title=iconv("windows-1256","utf-8",$rf["tarh_title_english"]);
$title_fa=iconv("windows-1256","utf-8",$rf["tarh_title_farsi"]);
  
 
 $projec_type_fa=iconv("windows-1256","utf-8",$rf["tarh_type_desc"]);
$abstract=iconv("windows-1256","utf-8",$rf["ahdaf"]);
$keyword=iconv("windows-1256","utf-8",$rf["kelidvajeh"]);
$first_name_fa=iconv("windows-1256","utf-8",$rf["name"]);
$last_name_fa=iconv("windows-1256","utf-8",$rf["family"]);
$specialty=iconv("windows-1256","utf-8",$rf["takhasos"]);
$office_address_fa=iconv("windows-1256","utf-8",$rf["work_addr"]);


$project_id=$rf["cod_tarh"];
//$dept=$rf["daneshkade_name"];
 $dept=iconv("windows-1256","utf-8",$rf["daneshkade_name"]);
 
$language='fa';
$projec_type=$rf["tarh_type_english_desc"];
 
 
 
$tarh_time=$rf["tarh_time"];

$startyear = substr($tarh_time,0,4);
  $startmon = substr($tarh_time,5,2);
  $startday = substr($tarh_time,8,2);
$s_date_year=$startyear ;
 $s_date_month=$startmon;
 $s_date_day=$startday ;
 
 $genger=$rf["gender"];
 if($gender=0)
 {
 $suffix="man";
 $suffix_fa=iconv("windows-1256","utf-8","مرد"); 
 }
 else
  {
 $suffix="women";
 $suffix_fa=iconv("windows-1256","utf-8","زن"); 
 }
 $email=$rf["email"]; 
 $s_type="g";
 $code=$rf["melli_code"];
 $postal_code="0";
$mmm=array(
         'project_id' =>$project_id,
		 'dept' => $dept,
		 'title' => $title,
		 'title_fa' => $title_fa,
		 'language' => $language,
		 'projec_type' => $projec_type,
		 'projec_type_fa' => $projec_type_fa,
		 'abstract' => $abstract,
		 'keyword' => $keyword,
		 's_type' => $s_type,
		 's_date_year' => $s_date_year,
		 's_date_month' => $s_date_month,
		 's_date_day' => $s_date_day,
		 'first_name_fa' => $first_name_fa, 
		 'last_name_fa' => $last_name_fa,  
		 'suffix' => $suffix,  
		 'suffix_fa' => $suffix_fa,   
		 'email' => $email,  
         'code' => $code, 
		 'postal_code' => $postal_code, 
		 'specialty' => $specialty,  
		 'office_address_fa' => $office_address_fa    		
	     );

		 $ddd[$row_cnt]=$mmm; 
	 
	$row_cnt=$row_cnt+1;
	}
return $ddd;
}
// Use the request to (try to) invoke the service

?>
 