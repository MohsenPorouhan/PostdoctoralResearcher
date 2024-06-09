<?
include("include/database-connect.phtml");
include("include/include.phtml");
header_forms($admin,$seed);
if(isset($action))
{
  if (strcmp($action,"finish")==0)
  {
	   	$comment_pishraft=str_replace("'"," ",$comment_pishraft);
	    $comment_pishraft=str_replace("\""," ",$comment_pishraft);
	    $comment_pishraft=str_replace(";"," ",$comment_pishraft);

        $nazer_submit_mali_comment=str_replace("'"," ",$nazer_submit_mali_comment);
	    $nazer_submit_mali_comment=str_replace("\""," ",$nazer_submit_mali_comment);
	    $nazer_submit_mali_comment=str_replace(";"," ",$nazer_submit_mali_comment);

        $nazer_hajm_nemone_comment=str_replace("'"," ",$nazer_hajm_nemone_comment);
	    $nazer_hajm_nemone_comment=str_replace("\""," ",$nazer_hajm_nemone_comment);
	    $nazer_hajm_nemone_comment=str_replace(";"," ",$nazer_hajm_nemone_comment);

	    $comment_ravesh_motalee=str_replace("'"," ",$comment_ravesh_motalee);
	    $comment_ravesh_motalee=str_replace("\""," ",$comment_ravesh_motalee);
	    $comment_ravesh_motalee=str_replace(";"," ",$comment_ravesh_motalee);

	    $admin_notes=str_replace("'"," ",$admin_notes);
	    $admin_notes=str_replace("\""," ",$admin_notes);
	    $admin_notes=str_replace(";"," ",$admin_notes);

	    $notes=str_replace("'"," ",$notes);
	    $notes=str_replace("\""," ",$notes);
	    $notes=str_replace(";"," ",$notes);
	 $mydate=date("Y-m-d");
	  //$notes = str_replace ( "&#1740;" ,"&#1610;", $notes );
	  //$notes = str_replace ( "&#1610;","&#1740;" , $notes );
	 //notes=iconv('utf-8','windows-1256',$notes);
	
    $query="insert into karshenasan_tarh_note set  tarh_new='0'  ,admin_notes='$admin_notes',form_pardakht ='$form_pardakht', comment_pishraft  ='$comment_pishraft', zamanbandi ='$zamanbandi', comment_ravesh_motalee ='$comment_ravesh_motalee', ravesh_motalee='$ravesh_motalee',nazer_form_pardakht='$form_pardakht',nazer_amval_masrafi='$nazer_amval_masrafi',nazer_submit_mali_comment='$nazer_submit_mali_comment',nazer_submit_mali='$nazer_submit_mali',nazer_hajm_nemone_comment='$nazer_hajm_nemone_comment',nazer_hajm_nemone='$nazer_hajm_nemone', marhale_report ='$gozaresh_nezarat', note_date='".date("Y-m-d")."',date_send='$mydate',comment_karshenas='$notes' , cod_tarh='$cod_tarh' , cod_karshenas='$cod_karshenas',version='-1',karshenasi_type='$karshenasi_type'  ";  
	 $result=mysql_query($query) or die ("Error in updating data into user login");

     $query="select * from group_karshenasan,group_karshenasan_tarh where group_karshenasan.cod_karshenas=group_karshenasan_tarh.cod_karshenas and  cod_tarh='$cod_tarh' and group_karshenasan.karshenas_type='1'";
      $result123=mysql_query($query) or die("Error 120000");
	  while($rf=mysql_fetch_array($result123))
	  {
		  $sms_box=$rf["sms_box"]; 
		  $startdate =$mydate;
	      $startyear = substr($startdate,0,4);
	      $startmon = substr($startdate,5,2);
	      $startday = substr($startdate,8,2);
	      $send_date=hijricalender( $startyear , $startmon , $startday ); 
		 
	      if($karshenasi_type=="1")
	      	$sms_text="nazare Davar dar morede tarh ba code $cod_tarh  dar tarikh   $send_date  ersal shod";
	      else if($karshenasi_type=="2")
	      	$sms_text="nazare Nazer dar morede tarh ba code $cod_tarh  dar tarikh   $send_date  ersal shod";
		  $query="insert into input_sms set sms_from='ADMIN' ,sms_to='$sms_box' , sms_text='$sms_text'";
		  $result=mysql_query($query) or die("Error 120000");
  	}
  }
}
