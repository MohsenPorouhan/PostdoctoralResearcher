<?
include("include/database-connect.phtml");
include("include/include.phtml");
global $HTTP_GET_VARS,$HTTP_POST_VARS;
while(list($key, $value) = each($HTTP_GET_VARS))
$$key = $value;

while(list($key, $value) = each($HTTP_POST_VARS))
$$key = $value;


 if(!isset($admin))
  $admin="";
 if(!isset($seed))
  $seed="";
 if(isset($admin) && isset($seed))
 {
  $type = checksession($admin,$seed);
  
  if( $type == 1 )
    updatesession($username,$rand);
  else
  {
   header ("Refresh: 0; url=index.phtml");
   exit();
  }
 }
 
include("include/styles.phtml");
include("include/vars.inc.phtml");

header_forms($admin,$seed);
 
echo "<META http-equiv=content-type content=text/html;charset=utf-8>";
//header_forms($admin,$seed);
echo "<br>";


if( isset($action) )
 if ( strlen(trim($notes)) > 0 )
 {
   $query="select * from group_karshenasan where username='$admin'";
   $result=mysql_query($query) or die ("Error in selecting data");
   $row_fetched=mysql_fetch_array($result);
   $karshenas_id=$row_fetched["cod_karshenas"];

   $notes=str_replace("'","",$notes);
   $notes=str_replace("\"","",$notes);
   $notes=str_replace(";","",$notes);
	 
   $query="select max(version) as maxver from karshenasan_tarh where cod_tarh='$cod_tarh'";

   $result=mysql_query($query) or die("Error in selecting data from 1");

   $rf1=mysql_fetch_array($result);
   $maxver=$rf1["maxver"];
   if($maxver=='-1')
      $maxver='1';
   else
      $maxver=$maxver+1;
      
      
     $query="update group_karshenasan_tarh set note_date='".date("Y-m-d")."',comment_karshenas='$notes',version='$maxver' where   cod_karshenas='$karshenas_id' and  cod_tarh='$cod_tarh'   ";
    
	 $result=mysql_query($query) or die ("Error in updating data into user login 1");
   
    // $query="update group_karshenasan_tarh set   gant='$gant',variables='$variables',note_submitted='1',chekide='$chekide',sabt='$sabt',mojrian='$mojrian',daneshjoyan='$daneshjoyan',raveshejra='$raveshejra',hazineha='$hazineha',akhlaghi='$akhlaghi',zamaem='$zamaem',comment_karshenas='$notes' , refered='$refered' where cod_tarh='$cod_tarh' and cod_karshenas='$karshenas_id'  ";

      $query="insert into group_karshenasan_tarh_note set tarh_new='0'  , note_date='".date("Y-m-d")."',version='-1', gant='$gant',variables='$variables',note_submitted='1',chekide='$chekide',sabt='$sabt',mojrian='$mojrian',daneshjoyan='$daneshjoyan',raveshejra='$raveshejra',hazineha='$hazineha',akhlaghi='$akhlaghi',zamaem='$zamaem',comment_karshenas='$notes' , cod_tarh='$cod_tarh' , cod_karshenas='$karshenas_id'  ";  
 
   $result=mysql_query($query) or die ("Error in updating data into user login 2");
   
 //  message_show(".نظريه شما ارسال شد","green");
  
  // $action="تغيير کلمه عبور";
  // set_log($action,$admin,date("Y-d-m"));

   
 }
 else
   $status="entry_error";




    $notes="";
    $chekide='0';
  	$sabt='0';
  	$mojrian='0';
  	$daneshjoyan='0';
  	$raveshejra='0';
  	$hazineha='0';
  	$akhlaghi='0';
  	$zamaem='0';
  	$gant='0';
  	$variables='0';
 


?>
  
<script language="javascript" src="js/farsi.js"></script>
<?
$query="select * from tarh where cod_tarh='$cod_tarh' and version='-1'";

$result1=mysql_query($query) or die("Error in selecting data from tarh");
$row_fetched1=mysql_fetch_array($result1);
$comment_karshenas_shora=$row_fetched1["comment_karshenas_shora"];
$dastoor_shora=$row_fetched1["dastoor_shora"];

?>
<br>
<center>
<TABLE cellSpacing=0  width="490" cellPadding=2 border=0 bordercolor="#333333" style="border-style: solid; border-width: 1; ">

  <TR>

      <TD dir="rtl" align=center  class="tahoma1"  height=19  dir="rtl">
      <?
	   echo ""."عنوان طرح  : ".$row_fetched1["tarh_title_farsi"];
      ?>
      </TD>
  </TR>

</table>
</center>
  
<?

if ( ! isset($current))
    $current = 1;

if( ! isset($startw))
    $startw = 0;

if ( !isset($endw))
    $endw = 0;
    
    if(isset($showall))
    if($showall==1)
    {
      $RecPerPage=1000;
      $current=1;
    }

    if(isset($name_e))
{
  $myname_search = "\"%".trim($name_e)."%\"";
}

if(isset($name_e))
{
	$query="select * from group_karshenasan,group_karshenasan_tarh,tarh where tarh.is_tarh='0' and payanname_akhlagh='-1' and  confirm_payan_name='1' and tarh.cod_tarh=group_karshenasan_tarh.cod_tarh and group_karshenasan.cod_karshenas=group_karshenasan_tarh.cod_karshenas and CHAR_LENGTH(group_karshenasan_tarh.comment_karshenas) > 0 and (tarh.cod_tarh like $myname_search) group by group_karshenasan_tarh.id order by note_date desc";
}
else
	$query="select * from group_karshenasan,group_karshenasan_tarh,tarh where tarh.is_tarh='0' and payanname_akhlagh='-1' and  confirm_payan_name='1' and tarh.cod_tarh=group_karshenasan_tarh.cod_tarh and group_karshenasan.cod_karshenas=group_karshenasan_tarh.cod_karshenas and CHAR_LENGTH(group_karshenasan_tarh.comment_karshenas) > 0 group by group_karshenasan_tarh.id order by note_date desc";
	$result=mysql_query($query) or die("Error in selecting data from group_karshenasan_tarh1");

 //$result=mysql_query($query) or die("Error in selecting data from tarh 1");
	$reccount = mysql_num_rows($result);

if(isset($name_e))
{
	$query="select * from group_karshenasan,group_karshenasan_tarh,tarh where tarh.is_tarh='0' and payanname_akhlagh='-1' and  confirm_payan_name='1' and tarh.cod_tarh=group_karshenasan_tarh.cod_tarh and group_karshenasan.cod_karshenas=group_karshenasan_tarh.cod_karshenas and CHAR_LENGTH(group_karshenasan_tarh.comment_karshenas) > 0 and (tarh.cod_tarh like $myname_search) group by group_karshenasan_tarh.id order by note_date desc"." limit ".($current-1)*$RecPerPage.",".$RecPerPage ;
}
else
	$query="select * from group_karshenasan,group_karshenasan_tarh,tarh where tarh.is_tarh='0' and payanname_akhlagh='-1' and  confirm_payan_name='1' and tarh.cod_tarh=group_karshenasan_tarh.cod_tarh and group_karshenasan.cod_karshenas=group_karshenasan_tarh.cod_karshenas and CHAR_LENGTH(group_karshenasan_tarh.comment_karshenas) > 0 group by group_karshenasan_tarh.id order by note_date desc"." limit ".($current-1)*$RecPerPage.",".$RecPerPage ;
	$result=mysql_query($query) or die("Error in selecting data from group_karshenasan_tarh2");

//echo $query;
$color=$list_color_1;						  
echo "<form name=\"sabt_tarh\" method=\"post\"  action=\"$PHP_SELF?admin=$admin&seed=$seed&cod_tarh=$cod_tarh\">";
if(mysql_num_rows($result) > 0 )
{
	
 pubshowpages("group_karshenasan_note_list.php",$current,$PageCountShows,$reccount,$startw,$endw,$RecPerPage,$admin,$seed,$myascdescpub,"90%",$title_color);
?>

<table border="0" width="90%" cellpadding="1" cellspacing="1">
 <tr>
  <td align="right" colspan="8" >
 <input type="submit" name="submit" value="جستجو" class="but-small">
 <input type="text" name="name_e" size="20" class="edit-small-2"  dir=RTL   >
 </td>
 </tr>
 <tr>
    
    <td width="100%" colspan="8" bgcolor=<? echo "$title_color"; ?>>
      <p align="center" class="tahoma1"><font color="black">نظر مدير گروه کارشناسي و کارشناسان آن</font></td>
    
  </tr>
  <tr>
    <td width="10%" bgcolor=<? echo "$title_color"; ?>>
      <p align="center" class="tahoma1"><font color="black">نظر کارشناس</font></td>
    <td width="20%" bgcolor=<? echo "$title_color"; ?>>
      <p align="center" class="tahoma1"><font color="black">نوع کارشناس</font></td>
      
    <td width="20%" bgcolor=<? echo "$title_color"; ?>>
      <p align="center" class="tahoma1"><font color="black">تاريخ نظر</font></td>
	<td width="20%" bgcolor=<? echo "$title_color"; ?>>
      <p align="center" class="tahoma1"><font color="black">نام خانوادگي</font></td>
   <td width="20%" bgcolor=<? echo "$title_color"; ?>>
      <p align="center" class="tahoma1"><font color="black">نام </font></td>
     
        <td width="20%" bgcolor=<? echo "$title_color"; ?>>
      <p align="center" class="tahoma1"><font color="black">کد کارشناس </font></td>
	 <td width="20%" bgcolor=<? echo "$title_color"; ?>>
      <p align="center" class="tahoma1"><font color="black">کد پايان نامه </font></td>
	      
        <td width="20%" bgcolor=<? echo "$title_color"; ?>>
      <p align="center" class="tahoma1"><font color="black">رديف </font></td>  
    
  </tr>
  <?


 $color=$list_color_1;

 $color=$list_color_1;
 $table = array();
 $table[0] = "بدون اشکال";
 $table[1] = "عدم وجود اطلاعات";
 $table[2] = "بايد اصلاح شود";
 $table[3] = "ناقص";
$row_cntr=1;
 while($row_fetched=mysql_fetch_array($result))
 {
  $cod_tarh=$row_fetched["cod_tarh"];
  echo "<tr>";
//  echo "<td width=\"3%\" bgcolor=$color align=\"center\" class=\"tahoma1\"><img border=\"0\" src=\"image/e-mail.gif\" width=\"10\" height=\"10\" alt=\"E-mail\" ></td>";
  if(strcmp($color,$list_color_1)==0)
   $color=$list_color_2;
  else
   $color=$list_color_1;
   
 $editable=1;
  $note_submitted=$row_fetched["note_submitted"];
   $string="";
// if(strcmp($note_submitted,"1")==0)
 //{
 	$cnt=$row_fetched["chekide"];
 	$string=$string."  چکيده : ".$table[$cnt];
 	$cnt=$row_fetched["sabt"];
 	$string=$string."<br>"." ثبت : ".$table[$cnt];
 	$cnt=$row_fetched["mojrian"];
 	$string=$string."<br>"." مجريان : ".$table[$cnt];
 	$cnt=$row_fetched["daneshjoyan"];
 	$string=$string."<br>"." دانشجويان : ".$table[$cnt];
 	$cnt=$row_fetched["raveshejra"];
 	$string=$string."<br>"." روش اجرا : ".$table[$cnt];
 	$cnt=$row_fetched["hazineha"];
 	$string=$string."<br>"."  هزينه ها : ".$table[$cnt];
 	$cnt=$row_fetched["akhlaghi"];
 	$string=$string."<br>"." ملاحظات اخلاقي : ".$table[$cnt];
 	$cnt=$row_fetched["gant"];
 	$string=$string."<br>"." جدول زمانبندي : ".$table[$cnt];
 	$cnt=$row_fetched["variables"];
 	$string=$string."<br>"." جدول متغيرها : ".$table[$cnt];
 	$cnt=$row_fetched["zamaem"];
 	$string=$string."<br>"." ضمائم : ".$table[$cnt];
// }
 //else
 //  $string="نظر ايشان ثبت نشده";
 
 
  //if(strcmp($note_submitted,"1")==0) 
    $comment_note=$row_fetched["comment_karshenas"];
   // echo $comment_note;
 // else
 // 	$comment_note="نظر ايشان ثبت نشده"; 

   
  $username=$row_fetched["username"];
  $myq="select * from group_karshenasan where username='$username'";
  $myres=mysql_query($myq) or die("Error in selecting data from group_karshenasan");
  $myrow_fetched=mysql_fetch_array($myres);
  if(strcmp($myrow_fetched["karshenas_type"],"0")==0)
    $karshenas_type="کارشناس گروه کارشناسي";
    
    $cod_11=$row_fetched["cod_karshenas"];
  $qq="select * from group_karshenasan_tarh where cod_karshenas='$cod_11' and cod_tarh='$cod_tarh' and send_to_karshenas_date<> ''";
 
  $rss=mysql_query($qq) or die("error");
  if(mysql_num_rows($rss) > 0)
  {
    $rf1=mysql_fetch_array($rss);
    $send_date=$rf1["note_date"];
    $startyear = substr($send_date,0,4);
  $startmon = substr($send_date,5,2);
  $startday = substr($send_date,8,2);
  $send_date=hijricalender( $startyear , $startmon , $startday );
    
  }
  else
    $send_date="---";  
    
///  echo "<td width=\"50%\" bgcolor=$color align=\"center\" class=\"tahoma1\" dir=\"ltr\">".$string."</td>";
  echo "<td width=\"10%\" bgcolor=$color align=\"center\" class=\"tahoma1\" dir=\"rtl\">".$row_fetched["comment_karshenas"]."</td>";
  echo "<td width=\"20%\" bgcolor=$color align=\"right\" class=\"tahoma1\" dir=\"rtl\">".$karshenas_type."</td>";  
  echo "<td width=\"10%\" bgcolor=$color align=\"center\" class=\"tahoma1\">".$send_date."</td>";
  echo "<td width=\"10%\" bgcolor=$color align=\"center\" class=\"tahoma1\">".$row_fetched["karshenas_family"]."</td>";
  echo "<td width=\"20%\" bgcolor=$color align=\"center\" class=\"tahoma1\">".$row_fetched["karshenas_name"]."</td>";
  echo "<td width=\"20%\" bgcolor=$color align=\"center\" class=\"tahoma1\">".$row_fetched["cod_karshenas"]."</td>";
  echo "<td width=\"20%\" bgcolor=$color align=\"center\" class=\"tahoma1\">".$row_fetched["cod_tarh"]."</td>";
  echo "<td width=\"20%\" bgcolor=$color align=\"center\" class=\"tahoma1\">".$row_cntr."</td>";
  $row_cntr++;
  
echo "</tr>";
 }
echo "</table>";
}
else // if reccount of tarh  < =0
{
 //message_show(".نظر ي وجود ندارد","red");
}
//echo "</form>";


?> 
</body>
<br>
<?
echo "</form>";
footer_forms($admin,$seed);
?>

  