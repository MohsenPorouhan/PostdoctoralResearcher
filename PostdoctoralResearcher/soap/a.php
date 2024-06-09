<?php
// Pull in the NuSOAP code
require_once('lib/nusoap.php');
require_once('include/database-connect.phtml');// Create the server instance
$server = new soap_server();

 $query="select   * from tarh,daneshkade,tarhtype,user_login where tarh.creator=user_login.email and tarh.cod_daneshkade=daneshkade.cod_daneshkade and tarh.tarh_type=tarhtype.tarh_type  and version='-1' limit 1,14";
  
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
	echo "<pre>";
print_r ($ddd);
 	echo "</pre>";
 
  
?>
 