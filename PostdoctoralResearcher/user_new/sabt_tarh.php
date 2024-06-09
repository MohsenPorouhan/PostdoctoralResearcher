<?
include("include/include.phtml");
include("include/database-connect.phtml");
include("include/vars.inc.phtml");

if(isset($action))
{
  if (strcmp($action,"add_tarh")==0)
  {
   // echo $tarh_name."goog";
    if( ( strlen(trim($tarh_name_e)) > 0 || $tarh_select=="10") && (strlen(trim($tarh_name)) > 0 || $tarh_select=="10")  && (strlen(trim($kelid_vaje)) > 0 || $tarh_select=="10")  &&   strlen(trim($zarorat)) > 0  && (strlen(trim($ahdaf)) > 0 || $tarh_select=="10") &&  (strlen(trim($soalat)) > 0 || $tarh_select=="10") &&  strlen(trim($raveshejra)) > 0 && ($tarh_type!='-1' || $tarh_select=="9" ) && $cod_daneshkade!='-1'  )
    {
		//echo "salam";
		$tarh_name=addslashes($tarh_name);
		     
       // $tarh_name=str_replace("'","\'",$tarh_name);
	   // $tarh_name=str_replace("\"","\'",$tarh_name);
	   // $tarh_name=str_replace(";","\;",$tarh_name);
	    
		$tarh_name_e=addslashes($tarh_name_e);
		//$tarh_name_e=str_replace("'","\'",$tarh_name_e);
	   // $tarh_name_e=str_replace("\"","\'",$tarh_name_e);
	   // $tarh_name_e=str_replace(";","\;",$tarh_name_e);
	    
      $query="select * from tarh where ( tarh_title_farsi =\"$tarh_name\" or (tarh_title_english=\"$tarh_name_e\" and servicing='0') ) and creator=\"$admin\" ";
	//  echo $query;
      $result=mysql_query($query) or die("Error in selecting data from tarh  11");

      if ( mysql_num_rows($result) <= 0 )
      {
      
        
          $year_date = date("Y") - 1921 ;
         // if(strcmp($year_tarh,"0")!=0 && strcmp($rank_num,"0")!=0)
	    //    $year_date=$year_tarh;
	   
	      $today=str_replace("/","-",today());
          $query_rank="select * from rank where '$today' >= start_date and '$today' <= end_date order by end_date desc";
          
		  $result=mysql_query($query_rank) or die("Error in selecting data from rank");

		  if(mysql_num_rows($result) > 0)
		  {
             $row_fetched=mysql_fetch_array($result);
             
             $rank=trim($row_fetched["rank"]);
			 $year=trim($row_fetched["year"]); 
             
		  }
		  else
		   $rank="0";
        
		// if(strcmp($rank_num,"0")!=0 && strcmp($year_tarh,"0")!=0  )
	     //  $rank=$rank_num;
	    
    	 $query="select maxcode from maxcode ";
//         $query="select max(right(cod_tarh,3) ) as max_cod from tarh ";

  	     $result=mysql_query($query) or die("Error in selecting data from tarh 145");
        // if(mysql_num_rows($result) > 0 )
        // {
          $row_fetched = mysql_fetch_array($result);
          $max_cod_tarh = $row_fetched["maxcode"]+1;
	  //   }
	    //  else
	    //   $max_cod_tarh=1+3000;   
	   //$max_cod_tarh= str_pad($max_cod_tarh,4,0,STR_PAD_LEFT);

          $cod_daneshkade=str_pad($cod_daneshkade,2,0,STR_PAD_LEFT);
          $rank=str_pad($rank,2,0,STR_PAD_LEFT);
       
          $cod_tarh=$year."-".$rank."-".$cod_daneshkade."-".$max_cod_tarh;
          $max_cod=$cod_tarh;
          
          $query="select * from tarh where cod_tarh='$cod_tarh_new'";
		  $res=mysql_query($query) or die("error");
		 
		  	   
                
    	  if(  (isset($payan_name) && strcmp($payan_name,"1")==0 && !strlen(trim($daneshjo_no)) >0 ) )
          {
			   message_show(".شماره دانشجويي را در پروفايل خود ثبت بفرماييد","red");
               footer_forms($admin,$seed);
				exit();
		  }
        if(  (isset($payan_name) && strcmp($payan_name,"1")==0 &&  strlen(trim($daneshjo_no)) >0 ) )
          {
			  $q="select * from tarh where cod_tarh='$daneshjo_no' and version='-1' and archieved='0'";
			  $rs_daneshjo=mysql_query($q) or die("ERROR ");
			  if(mysql_num_rows($rs_daneshjo)>0)
			  {
				   message_show(".پايان نامه شما قبلا ثبت شده","red");
               
				exit();
			  }
			  $max_cod=$daneshjo_no;
		  }
		  else
		  {
			   $query="update maxcode set maxcode='$max_cod_tarh'";
          $result=mysql_query($query) or die("Error in selecting data from tarh 122");

		  }
       //----------------------  Set Cod_tarh
        $kelid_vaje=addslashes($kelid_vaje);
        //$kelid_vaje=str_replace("'","\'",$kelid_vaje);
	   // $kelid_vaje=str_replace("\"","\'",$kelid_vaje);
	    //$kelid_vaje=str_replace(";","\;",$kelid_vaje);
	    
		$line_tahgig=addslashes($line_tahgig);
	    //$line_tahgig=str_replace("'","\'",$line_tahgig);
	   // $line_tahgig=str_replace("\"","\'",$line_tahgig);
	   // $line_tahgig=str_replace(";","\;",$line_tahgig);
	    
		//$zarorat=addslashes($zarorat);
	    //$zarorat=str_replace("'","\'",$zarorat);
	    //$zarorat=str_replace("\"","\'",$zarorat);
	    //$zarorat=str_replace(";","\;",$zarorat);
	    //
		//$ahdaf=addslashes($ahdaf);
	    //$ahdaf=str_replace("'","\'",$ahdaf);
	    //$ahdaf=str_replace("\"","\'",$ahdaf);
	    //$ahdaf=str_replace(";","\;",$ahdaf);
	    
		//$soalat=addslashes($soalat);
	    //$soalat=str_replace("'","\'",$soalat);
	   // $soalat=str_replace("\"","\'",$soalat);
	   // $soalat=str_replace(";","\;",$soalat);
	  
	//	$raveshejra=addslashes($raveshejra);
	   //// $raveshejra=str_replace("'","\'",$raveshejra);
	   // $raveshejra=str_replace("\"","\'",$raveshejra);
	   // $raveshejra=str_replace(";","\;",$raveshejra);
         
		
		  
		if(strcmp($tarh_type,'6')==0 || strcmp($tarh_type_2,'3')==0 || strcmp($tarh_type_2,'4')==0 || strcmp($tarh_type_2,'8')==0 || strcmp($tarh_type_2,'9')==0  || strcmp($tarh_type_2,'11')==0  || strcmp($tarh_type_2,'12')==0 )
		{
		   $send_moavenat="send_moavenat='1',";
		}
		else
		      $send_moavenat="";
            
			
		    if(strcmp($payan_name,'1')==0){
				$payannameh=",payannameh=1,is_tarh=0,";
			}
			else
			   $payannameh=",payannameh=0,is_tarh=1,";
			   
		if($tarh_select=="10"){
			$servicing="1";
		}
		else{
			$servicing="0";
		}
	//echo $cod_daneshkade;		
	
		$ahdaf=mysql_real_escape_string($ahdaf); 
		$zarorat=mysql_real_escape_string($zarorat);
		$soalat=mysql_real_escape_string($soalat);
		$raveshejra=mysql_real_escape_string($raveshejra);
$query="insert into tarh  set    $send_moavenat first_ostad_degree='$first_ostad_degree', payan_name='$payan_name',first_ostad_moshaver='$first_ostad_moshaver',forth_ostad_moshaver='$forth_ostad_moshaver' ,third_ostad_moshaver='$third_ostad_moshaver' ,second_ostad_moshaver='$second_ostad_moshaver'  ,first_ostad='$first_ostad',second_ostad='$second_ostad',third_ostad='$third_ostad',forth_ostad='$forth_ostad',payan_name_daraje_elmi='$payan_name_daraje_elmi' $payannameh cod_group='$cod_group',cod_daneshkade='$cod_daneshkade',second_cod_daneshkade='$second_cod_daneshkade',tarh_title_farsi='$tarh_name' ,tarh_title_english=\"$tarh_name_e\",  kelidvajeh ='$kelid_vaje',  line ='$line_tahgig', zarorat ='$zarorat', ahdaf ='$ahdaf', soalat ='$soalat', shive_ejra  ='$raveshejra', tarh_type ='$tarh_type' , creator='$admin', cod_tarh='$max_cod', tarh_time='".date("Y-m-d")."',vaziat=\"0\" , tarh_type_1='$tarh_type_1', tarh_type_2='$tarh_type_2' , confirm_tarh ='0',payan_name1='$payan_name1',servicing='$servicing'";
echo $query;
if(strcmp($payan_name,'1')==0){
	 insert_position($max_cod,"31",$admin);
}
else
 insert_position($max_cod,"1",$admin);
	      $result=mysql_query($query) or die("Error in inserting data into tarh #1");
          $action="ثبت چکيده طرح با عنوان"."<br>".$tarh_name;
           set_log($action,$admin,date("Y-m-d, g:i a"));
           if(strcmp($payan_name,'1')==0 && strlen($modir_payanname)>0){
           $query="insert into modir_daneshkade_tarh set cod_tarh='$max_cod',cod_modir='$modir_payanname'";
           $result=mysql_query($query) or die("Error in inserting data into tarh #1");
           }
          ?>
          <script>
          window.location.href="<?php echo "tarh_body.phtml?cod_tarh=$max_cod";?>";
          </script>
          <?php
          

         }
         else
          echo "duplicate_entry";
    }
    else  
      echo "entry_error";
   
  }

}





$tarh_name="";
$tarh_name_e="";
$tarh_type="";
$kelid_vaje="";
$kelid_vaje_e="";
$line_tahgig="";
$line_tahgig_e="";
$zarorat="";
$ahdaf="";
$soalat="";
$ahdaf="";
$raveshejra="";




?>