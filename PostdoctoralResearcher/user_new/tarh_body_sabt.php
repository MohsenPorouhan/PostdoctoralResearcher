<?
include("include/database-connect.phtml");
include("include/include.phtml");
if(isset($action))
{
 if (strcmp($action,"add_tarh")==0)
 {  
 // if( strlen(trim($bayan_masale)) > 0 && strlen(trim($zarorat_ejra)) > 0 && strlen(trim($ahdaf)) > 0 && strlen(trim($soalat)) > 0)
  // {
      $query="select * from tarh where cod_tarh='$cod_tarh'  and version='-1' ";
	  $result=mysql_query($query) or die("Error in selecting data from karshenas elmi ");   
      
      if ( mysql_num_rows($result) == 1 )
      { 
			  $row_fetched=mysql_fetch_array($result);
			  if($la=="en")
			  {
			  	$tarh_name = $row_fetched["tarh_title_english"];
			  }
			  else
			  	$tarh_name = $row_fetched["tarh_title_farsi"];
	  		
		
	/*		$fehrest_manabea=str_replace("'","\'",$fehrest_manabea);
	    $fehrest_manabea=str_replace("\"","\'",$fehrest_manabea);
	    $fehrest_manabea=str_replace(";","\;",$fehrest_manabea);

	$farziatt=str_replace("'","\'",$farziatt);
	    $farziatt=str_replace("\"","\'",$farziatt);
	    $farziatt=str_replace(";","\;",$farziatt);

	$soalat_pajoheshi=str_replace("'","\'",$soalat_pajoheshi);
	    $soalat_pajoheshi=str_replace("\"","\'",$soalat_pajoheshi);
	    $soalat_pajoheshi=str_replace(";","\;",$soalat_pajoheshi);
	
	$hadaf_karbordi=str_replace("'","\'",$hadaf_karbordi);
	    $hadaf_karbordi=str_replace("\"","\'",$hadaf_karbordi);
	    $hadaf_karbordi=str_replace(";","\;",$hadaf_karbordi);
	
	$hadaf_jozii=str_replace("'","\'",$hadaf_jozii);
	    $hadaf_jozii=str_replace("\"","\'",$hadaf_jozii);
	    $hadaf_jozii=str_replace(";","\;",$hadaf_jozii);

	$hadaf_kolli=str_replace("'","\'",$hadaf_kolli);
	    $hadaf_kolli=str_replace("\"","\'",$hadaf_kolli);
	    $hadaf_kolli=str_replace(";","\;",$hadaf_kolli);

	$taarif_vajeh=str_replace("'","\'",$taarif_vajeh);
	    $taarif_vajeh=str_replace("\"","\'",$taarif_vajeh);
	    $taarif_vajeh=str_replace(";","\;",$taarif_vajeh);

	$hadaf_faree=str_replace("'","\'",$hadaf_faree);
	    $hadaf_faree=str_replace("\"","\'",$hadaf_faree);
	    $hadaf_faree=str_replace(";","\;",$hadaf_faree);
	    
			$bayan_masale=str_replace("'","\'",$bayan_masale);
	    $bayan_masale=str_replace("\"","\'",$bayan_masale);
	    $bayan_masale=str_replace(";","\;",$bayan_masale);
	 
		$zarorat_ejra=str_replace("'","\'",$zarorat_ejra);
	    $zarorat_ejra=str_replace("\"","\'",$zarorat_ejra);
	    $zarorat_ejra=str_replace(";","\;",$zarorat_ejra);
	 
	     $ahdaf=str_replace("'","\'",$ahdaf);
	    $ahdaf=str_replace("\"","\'",$ahdaf);
	    $ahdaf=str_replace(";","\;",$ahdaf);
	    
	       $soalat=str_replace("'","\'",$soalat);
	    $soalat=str_replace("\"","\'",$soalat);
	    $soalat=str_replace(";","\;",$soalat);
	    */
		$ahdaf1=mysql_real_escape_string($ahdaf1);
		$soalat1=mysql_real_escape_string($soalat1);
		$zarorat_ejra1=mysql_real_escape_string($zarorat_ejra1);
		$bayan_masale1=mysql_real_escape_string($bayan_masale1);
		$hadaf_faree1=mysql_real_escape_string($hadaf_faree1);
		$fehrest_manabea1=mysql_real_escape_string($fehrest_manabea1);
		$taarif_vajeh1=mysql_real_escape_string($taarif_vajeh1);
		$query="update tarh  set ahdaf=\"$ahdaf1\",soalat=\"$soalat1\",zarorat_ejra=\"$zarorat_ejra1\",bayan_masale=\"$bayan_masale1\" ,hadaf_faree =\"$hadaf_faree1\", taarif_vajeh='$taarif_vajeh1', hadaf_kolli='$hadaf_kolli1', hadaf_jozii='$hadaf_jozii1', hadaf_karbordi='$hadaf_karbordi1', soalat_pajoheshi='$soalat_pajoheshi1', farziatt='$farziatt1', fehrest_manabea = '$fehrest_manabea1' where cod_tarh='$cod_tarh'  and version='-1'";
	   // echo $query;
        $result=mysql_query($query) or die(mysql_error());
        
       $query="select * from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='2'";
       $result=mysql_query($query) or die("Error in selecting data from  jadval zarayeb ");
       if ( mysql_num_rows($result) <= 0 )
       {
      		$query="insert into tarh_exist_item set cod_tarh='$cod_tarh',item_id='2'";
       		$result=mysql_query($query) or die("Error in selecting data from  jadval zarayeb ");
       		
       }
        $action="ثبت / ويرايش طرح"."<br>".$tarh_name;
   
        set_log($action,$admin,date("Y-m-d, g:i a"));
		
          ?>
        <script language="javascript">
        window.location="<? echo "mojri_tarh.phtml?cod_tarh=$cod_tarh";  ?>";
        </script>
        <?
      }
 //   }
    }
   // else
      //$status="entry_error";
  }
  

   

?>