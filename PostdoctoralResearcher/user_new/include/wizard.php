<?php 
      $query="select * from tarh where cod_tarh='$cod_tarh'  and version='-1'";
	  $result=mysql_query($query) or die("Error in selecting data from karshenas elmi ");
	  $row_fetched=mysql_fetch_array($result);
	  $tarh_name = $row_fetched["tarh_title_farsi"];
	  $finished=$row_fetched["finished"]; 
	  $first_letter=$row_fetched["first_letter"];
	  $payan_name=$row_fetched['payan_name'];
	  $creator=$row_fetched['creator'];
	  $servicing=$row_fetched["servicing"];
      if(strcmp($servicing,"1")==0){
    	$hazine_azmayesh_lable="هزينه استفاده از خدمات آزمايشگاهي و کارگاهي";
      }
      else
    	$hazine_azmayesh_lable="هزينه هاي آزمايشات وخدمات تخصصي";
     
  
	  if(mysql_num_rows($result) > 0 && strcmp($creator,$admin)!=0)
	  {
	  	?>
	  	<script language="javascript">
           
        	   window.location="<? echo "../login.phtml";  ?>";
        	   </script>
	  	<?
		exit();
	  }
		if(strcmp($first_letter,'1')==0)
		{
			$admin_edit=1;
		}  
	   
	$query="select * from modir_daneshkade where    modir_username='$admin' and (modir_type='1' or modir_type='4')   ";
	$result=mysql_query($query) or die("Error");
	if(mysql_num_rows($result) >0)
	{
		$admin_edit=1;
	}

	$query="select * from modir_daneshkade,tarh where   ( modir_username='$admin' and tarh.cod_daneshkade=modir_daneshkade.cod_daneshkade )";
	$result=mysql_query($query) or die("Error");
	if(mysql_num_rows($result) >0)
	{
		$admin_edit=1;
	}
	
	//////////////////////////////////////   ACTIVE LINK
	 switch ($active_id)
	  {
	  case "0":
	    $sabt_tarh_second_li_class="class='active'";
	    break;
	  case "1":
	    $checkile_li_class="class='active'";
	    break;
	  case "2":
	    $tarhbody_li_class="class='active'";
	    break;
	  case "3":
	   $mojrian_li_class="class='active'";
	    break;
	  case "4":
	    $ravesh_ejra_li_class="class='active'";
	    break;
	  case "5":
	    $jadval_zarayeb_li_class="class='active'";
	    break;
	  case "6":
	   $jadval_zmanbandi_li_class="class='active'";
	    break;
	   case "7":
	   $hazine_personnel_li_class="class='active'";
	    break;
	   case "8":
	   $hazine_azmayesh_li_class="class='active'";
	    break;
	   case "9":
	   $fehreste_vasayel_li_class="class='active'";
	    break;
	   case "10":
	   $hazine_mosaferat_li_class="class='active'";
	    break;
	    case "11":
	   $hazine_other_li_class="class='active'";
	    break;
	     case "12":
	   $etebar_sazmanha_li_class="class='active'";
	    break;
	     case "13":
	   $molahezat_akhlaghi_li_class="class='active'";
	    break;
	     case "14":
	   $zamaem_li_class="class='active'";
	    break;
	     case "15":
	   $ostad_rahnama_li_class="class='active'";
	    break;
	     case "16":
	   $rezayatname_li_class="class='active'";
	    break; 
	    case "17":
	   $finish_li_class="class='active'";
	    break;
	  default:
	   $edit_li_class="class='active'";
	}
	////////////////////////////////////// 
	
	
	////////////////////////////////////// disabled and enabled link
	if($admin_edit==0)
	if(strcmp($finished,'0')==0)
	{
	 $query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='1'";
	 $result=mysql_query($query) or die("Error");
	 if(mysql_num_rows($result) <=0 )
	  {
	  	$checkile_li_class="class='disabled'"; 
	  }
	  else
	  	$checkile_li_class="";
	  	
	 $query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='2'";
	 $result=mysql_query($query) or die("Error");
	 if(mysql_num_rows($result) <=0 )
	  {
	  	$tarhbody_li_class="class='disabled'"; 
	  }
	  else
	  	$tarhbody_li_class="";
	  	
	 $query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='3'";
	 $result=mysql_query($query) or die("Error");
	 if(mysql_num_rows($result) <=0 )
	  {
	  	$mojrian_li_class="class='disabled'"; 
	  }
	  else
	  	$mojrian_li_class="";
	 
	 $query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='4'";
	 $result=mysql_query($query) or die("Error");
	 if(mysql_num_rows($result) <=0 )
	  {
	  	$ravesh_ejra_li_class="class='disabled'"; 
	  }
	  else
	  	$ravesh_ejra_li_class="";
	  	
	 $query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='5'";
	 $result=mysql_query($query) or die("Error");
	 if(mysql_num_rows($result) <=0 )
	  {
	  	$jadval_zarayeb_li_class="class='btn disabled'"; 
	  }
	  else
	  	$jadval_zarayeb_li_class="";
	  	
	 $query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='6'";
	 $result=mysql_query($query) or die("Error");
	 if(mysql_num_rows($result) <=0 )
	  {
	  	$jadval_zmanbandi_li_class="class='disabled'"; 
	  }
	  else
	  	$jadval_zmanbandi_li_class="";
	  	
	 $query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='7'";
	 $result=mysql_query($query) or die("Error");
	 if(mysql_num_rows($result) <=0 )
	  {
	  	$hazine_personnel_li_class="class='disabled'"; 
	  }
	  else
	  	$hazine_personnel_li_class="";
	  	
	  	
	  $query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='8'";
	 $result=mysql_query($query) or die("Error");
	 if(mysql_num_rows($result) <=0 )
	  {
	  	$hazine_azmayesh_li_class="class='disabled'"; 
	  }
	  else
	  	$hazine_azmayesh_li_class="";
	  	
	 $query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='9'";
	 $result=mysql_query($query) or die("Error");
	 if(mysql_num_rows($result) <=0 )
	  {
	  	$fehreste_vasayel_li_class="class='disabled'"; 
	  }
	  else
	  	$fehreste_vasayel_li_class="";
	  	
	  $query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='10'";
	 $result=mysql_query($query) or die("Error");
	 if(mysql_num_rows($result) <=0 )
	  {
	  	$hazine_mosaferat_li_class="class='disabled'"; 
	  }
	  else
	  	$hazine_mosaferat_li_class="";
	  	
	  $query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='11'";
	 $result=mysql_query($query) or die("Error");
	 if(mysql_num_rows($result) <=0 )
	  {
	  	$hazine_other_li_class="class='disabled'"; 
	  }
	  else
	  	$hazine_other_li_class="";
	  	
	 $query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='12'";
	 $result=mysql_query($query) or die("Error");
	 if(mysql_num_rows($result) <=0 )
	  {
	  	$etebar_sazmanha_li_class="class='disabled'"; 
	  }
	  else
	  	$etebar_sazmanha_li_class="";
	  	
	  	
	 $query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='13'";
	 $result=mysql_query($query) or die("Error");
	 if(mysql_num_rows($result) <=0 )
	  {
	  	$molahezat_akhlaghi_li_class="class='disabled'"; 
	  }
	  else
	  	$molahezat_akhlaghi_li_class="";
	  	
	 $query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='14'";
	 $result=mysql_query($query) or die("Error");
	 if(mysql_num_rows($result) <=0 )
	  {
	  	$zamaem_li_class="class='disabled'"; 
	  }
	  else
	  	$zamaem_li_class="";
	  	
	 $query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='15'";
	 $result=mysql_query($query) or die("Error");
	 if(mysql_num_rows($result) <=0 )
	  {
	  	$ostad_rahnama_li_class="class='disabled'"; 
	  }
	  else
	  	$ostad_rahnama_li_class="";
	  	
	 $query="select * from edit_field where cod_tarh='$cod_tarh' and cod_edit_part='16'";
	 $result=mysql_query($query) or die("Error");
	 if(mysql_num_rows($result) <=0 )
	  {
	  	$rezayatname_li_class="class='disabled'"; 
	  }
	  else
	  	$rezayatname_li_class="";
	  	
	}
	else
	{
		$checkile_li_class="class='disabled'"; 
		$tarhbody_li_class="class='disabled'";
		$mojrian_li_class="class='disabled'";
		$ravesh_ejra_li_class="class='disabled'";
		$jadval_zarayeb_li_class="class='disabled'";
		$jadval_zmanbandi_li_class="class='disabled'";
		$hazine_personnel_li_class="class='disabled'";
		$hazine_azmayesh_li_class="class='disabled'";
		$fehreste_vasayel_li_class="class='disabled'";
		$hazine_other_li_class="class='disabled'";
		$hazine_mosaferat_li_class="class='disabled'";
		$etebar_sazmanha_li_class="class='disabled'";
		$molahezat_akhlaghi_li_class="class='disabled'";
		$zamaem_li_class="class='disabled'";
		$rezayatname_li_class="class='disabled'";
		$ostad_rahnama_li_class="class='disabled'";
		
	} 
	//////////////////////////////////////////////////////////  Fill or empty 
	
	$bayan_bold="class='fa fa-times '";
	$mojri_bold="class='fa fa-times '";
	$ejra_bold="class='fa fa-times '";
	$jadval_zarayeb_bold="class='fa fa-times '";
	$jadval_zamanbandi_bold="class='fa fa-times '";
	$hazine_personnel_bold="class='fa fa-times '";
	$hazine_azmayeh_bold="class='fa fa-times '";
	$fehrest_vasayel_kharid_bold="class='fa fa-times '";
	$hazine_mosaferat_bold="class='fa fa-times '";
	$hazineha_other_bold="class='fa fa-times '";
	$etebar_szmanha_bold="class='fa fa-times '";
	$zamaem_bold="class='fa fa-times '";
	$molahezat_akhlaghi_bold="class='fa fa-times '";
	$rezayatname_bold="class='fa fa-times '";
	$ostad_rahnama_bold="class='fa fa-times '";
	
	
	
	$query="select * from tarh_exist_item where cod_tarh='$cod_tarh'";
	$result=mysql_query($query);
	while($row_fetch=mysql_fetch_array($result))
	{
		$item_id=$row_fetch["item_id"];
		switch ($item_id){
			case "2":
				$bayan_bold="class='fa fa-check '";
				break;
			case "3":
				$mojri_bold="class='fa fa-check '";
				break;
			case "4":
				$ejra_bold="class='fa fa-check '";
				break;
			case "5":
				$jadval_zarayeb_bold="class='fa fa-check '";
				break;
			case "6":
				$jadval_zamanbandi_bold="class='fa fa-check '";
				break;
			case "7":
				$hazine_personnel_bold="class='fa fa-check '";
				break;
			case "8":
				$hazine_azmayeh_bold="class='fa fa-check '";
				break;
			case "9":
				$fehrest_vasayel_kharid_bold="class='fa fa-check '";
				break;
			case "10":
				$hazine_mosaferat_bold="class='fa fa-check '";
				break;
			case "11":
				$hazineha_other_bold="class='fa fa-check '";
				break;
			case "12":
				$etebar_szmanha_bold="class='fa fa-check '";
				break;
			case "13":
				$molahezat_akhlaghi_bold="class='fa fa-check '";
				break;
			case "14":
				$zamaem_bold="class='fa fa-check '";
				break;
			case "15":
				$ostad_rahnama_bold="class='fa fa-check '";
				break;
			case "16":
				$rezayatname_bold="class='fa fa-check '";
				break;
				
		}
	}
	

	//////////////////////////////////////////////////////////////
	

	                         
?>
                                   <?php if($la=="en"){?> 
                                    
                                    <div class="col-md-3 col-sm-12 col-xs-12 border-left">
                                        <ul class="nav nav-pills nav-stacked border-bottom" >
                                        <?php if(strlen($cod_tarh)> 1)
                                        {?>
                                        <li <?php echo $sabt_tarh_second_li_class;?>>
                                                <a href="sabt_tarh_second.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i class="fa fa-check "></i>
                                                    </span>
                                                    Edit Proposal
                                                </a>
                                            </li>
                                             <li <?php echo $checkile_li_class;?>>
                                                <a href="edit_chekide_tarh.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i class="fa fa-check "></i>
                                                    </span>
                                                    Edit Abstract
                                                </a>
                                            </li>
                                       <?php }
                                        else{
                                            ?>
                                            <li>
                                                <a href="sabt_tarh.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>">
                                                    <span class="pull-right green">
                                                        <i class="fa fa-check "></i>
                                                    </span>
                                                    Abstract
                                                </a>
                                            </li>
                                      <?php }
                                      if(strcmp(trim($servicing),'1')!=0)
                                        {
                                      ?>
                                            <li <?php echo $tarhbody_li_class;?>>
                                                <a href="tarh_body.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="tarh_body_i" <?php echo $bayan_bold; ?>></i>
                                                    </span>
                                                    Body
                                                </a>
                                            </li>
                                     <? } ?>
                                            <li <?php echo $mojrian_li_class;?>>
                                                <a href="mojri_tarh.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="mojri_tarh_i" <?php echo $mojri_bold; ?>></i>
                                                    </span>
                                                    Assistants
                                                </a>
                                            </li>
                                            <?php 
											    	 if(strcmp($payan_name,'0')!=0) { 	
												  ?>
                                            <li <?php echo $ostad_rahnama_li_class;?>>
                                                <a href="ostad_rahnama.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="ostad_rahnama_i" <?php echo $ostad_rahnama_bold; ?>></i>
                                                    </span>
                                                    Supervisor
                                                </a>
                                            </li>
                                            <?php }
                                            if(strcmp(trim($servicing),'1')!=0)
                                             {
                                            ?>
                                            <li <?php echo $ravesh_ejra_li_class;?>>
                                                <a href="ravesh_ejra.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="ravesh_ejra_i" <?php echo $ejra_bold; ?>></i>
                                                    </span>
                                                    Research method
                                                </a>
                                            </li>
                                            <li <?php echo $jadval_zarayeb_li_class;?>>
                                                <a <?php echo $jadval_zarayeb_li_class;?> href="jadval_zarayeb.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="jadval_zarayeb_i" <?php echo $jadval_zarayeb_bold; ?>></i>
                                                    </span>
                                                    Variables
                                                </a>
                                            </li>
                                          <? } ?>
                                            <li <?php echo $jadval_zmanbandi_li_class;?>>
                                                <a href="activities.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="activities_i" <?php echo $jadval_zamanbandi_bold; ?>></i>
                                                    </span>
                                                    Scheduling
                                                </a>
                                            </li>
                                            <li <?php echo $hazine_personnel_li_class;?>>
                                                <a href="hazine_personnel.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="hazine_personnel_i" <?php echo $hazine_personnel_bold; ?>></i>
                                                    </span>
                                                    Personnel costs
                                                </a>
                                            </li>
                                            <li <?php echo $hazine_azmayesh_li_class;?>>
                                                <a href="hazine_azmayesh.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="hazine_azmayesh_i" <?php echo $hazine_azmayeh_bold; ?>></i>
                                                    </span>
                                                    lab tests and services(specify)                                                                
                                                </a>
                                            </li>
                                            <li <?php echo $fehreste_vasayel_li_class;?>>
                                               <a href="fehrest_kharid.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="fehrest_kharid_i" <?php echo $fehrest_vasayel_kharid_bold; ?>></i>
                                                    </span>
                                                    Equipment and Instruments
                                                </a>
                                            </li>
                                            <li <?php echo $hazine_mosaferat_li_class;?>>
                                                <a href="hazine_mosaferat.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="hazine_mosaferat_i" <?php echo $hazine_mosaferat_bold; ?>></i>
                                                    </span>
                                                    Travel expenses
                                                </a>
                                            </li>
                                            <li  <?php echo $hazine_other_li_class;?>>
                                                <a href="hazineha_others.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="hazineha_others_i" <?php echo $hazineha_other_bold; ?>></i>
                                                    </span>
                                                    Other costs
                                                </a>
                                            </li>
                                            <li <?php echo $etebar_sazmanha_li_class;?>>                                            
                                                <a href="sazmanhayedigar.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="sazmanhayedigar_i" <?php echo $etebar_szmanha_bold; ?>></i>
                                                    </span>
                                                    Funding from other organizations
                                                </a>
                                            </li>
                                            <? if(strcmp(trim($servicing),'1')!=0)
                                              {
                                            ?>
                                            <li <?php echo $molahezat_akhlaghi_li_class;?>>                                          
                                                <a href="comitte_akhlagh.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="comitte_akhlagh_i" <?php echo $molahezat_akhlaghi_bold; ?>></i>
                                                    </span>
                                                    Safety Considerations 
                                                </a>
                                            </li>
                                            <li <?php echo $rezayatname_li_class;?>>                                            
                                                <a href="add_rezayatname.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="add_rezayatname_i" <?php echo $rezayatname_bold; ?>></i>
                                                    </span>
                                                    Consent Form
                                                </a>
                                            </li>
                                            <? }?>
                                            <li <?php echo $zamaem_li_class;?>>                                           
                                                <a href="upload_file.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>" class="">
                                                    <span class="pull-right green">
                                                        <i id="upload_file_i" <?php echo $zamaem_bold; ?>></i>
                                                    </span>
                                                    Enclosures
                                                </a>
                                            </li>
                                            <li  <?php echo $finish_li_class;?> >                                         
                                                <a href="finish_tarh.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>" class="">
                                                    <span class="pull-right green">
                                                        <i class="fa fa-times "></i>
                                                    </span>
                                                    Finished
                                                </a>
                                            </li>
                                                                                       
                                               
                                        </ul>
                                    </div>
                                    <?php }
                                    else 
                                    {
                                    ?>
                                    <div class="col-md-3 col-sm-12 col-xs-12 border-left">
                                        <ul class="nav nav-pills nav-stacked border-bottom" >
                                        <?php if(strlen($cod_tarh)> 1)
                                        {?>
                                        <li <?php echo $sabt_tarh_second_li_class;?>>
                                                <a href="sabt_tarh_second.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i class="fa fa-check "></i>
                                                    </span>
                                                    ويرايش طرح
                                                </a>
                                            </li>
                                             <li <?php echo $checkile_li_class;?>>
                                                <a href="edit_chekide_tarh.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i class="fa fa-check "></i>
                                                    </span>
                                                    ويرايش چکيده
                                                </a>
                                            </li>
                                       <?php }
                                        else{
                                            ?>
                                            <li>
                                                <a href="sabt_tarh.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>">
                                                    <span class="pull-right green">
                                                        <i class="fa fa-check "></i>
                                                    </span>
                                                    چکيده
                                                </a>
                                            </li>
                                      <?php }
                                      if(strcmp(trim($servicing),'1')!=0)
                                        {
                                      ?>
                                            <li <?php echo $tarhbody_li_class;?>>
                                                <a href="tarh_body.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="tarh_body_i" <?php echo $bayan_bold; ?>></i>
                                                    </span>
                                                    ثبت
                                                </a>
                                            </li>
                                     <? } ?>
                                            <li <?php echo $mojrian_li_class;?>>
                                                <a href="mojri_tarh.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="mojri_tarh_i" <?php echo $mojri_bold; ?>></i>
                                                    </span>
                                                    مجريان همکاران و دانشجويان
                                                </a>
                                            </li>
                                            <?php 
											    	 if(strcmp($payan_name,'0')!=0) { 	
												  ?>
                                            <li <?php echo $ostad_rahnama_li_class;?>>
                                                <a href="ostad_rahnama.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="ostad_rahnama_i" <?php echo $ostad_rahnama_bold; ?>></i>
                                                    </span>
                                                    استاد راهنما
                                                </a>
                                            </li>
                                            <?php }
                                            if(strcmp(trim($servicing),'1')!=0)
                                             {
                                            ?>
                                            <li <?php echo $ravesh_ejra_li_class;?>>
                                                <a href="ravesh_ejra.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="ravesh_ejra_i" <?php echo $ejra_bold; ?>></i>
                                                    </span>
                                                    روش اجراي مطالعه
                                                </a>
                                            </li>
                                            <li <?php echo $jadval_zarayeb_li_class;?>>
                                                <a <?php echo $jadval_zarayeb_li_class;?> href="jadval_zarayeb.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="jadval_zarayeb_i" <?php echo $jadval_zarayeb_bold; ?>></i>
                                                    </span>
                                                    جدول متغيرها
                                                </a>
                                            </li>
                                          <? } ?>
                                            <li <?php echo $jadval_zmanbandi_li_class;?>>
                                                <a href="activities.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="activities_i" <?php echo $jadval_zamanbandi_bold; ?>></i>
                                                    </span>
                                                    جدول زمانبندي مراحل اجرا
                                                </a>
                                            </li>
                                            <li <?php echo $hazine_personnel_li_class;?>>
                                                <a href="hazine_personnel.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="hazine_personnel_i" <?php echo $hazine_personnel_bold; ?>></i>
                                                    </span>
                                                    هزينه پرسنلي
                                                </a>
                                            </li>
                                            <li <?php echo $hazine_azmayesh_li_class;?>>
                                                <a href="hazine_azmayesh.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="hazine_azmayesh_i" <?php echo $hazine_azmayeh_bold; ?>></i>
                                                    </span>
                                                    هزينه آزمايشات و خدمات تخصصي
                                                </a>
                                            </li>
                                            <li <?php echo $fehreste_vasayel_li_class;?>>
                                               <a href="fehrest_kharid.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="fehrest_kharid_i" <?php echo $fehrest_vasayel_kharid_bold; ?>></i>
                                                    </span>
                                                    فهرست وسايل و مواد خريداري شده
                                                </a>
                                            </li>
                                            <li <?php echo $hazine_mosaferat_li_class;?>>
                                                <a href="hazine_mosaferat.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="hazine_mosaferat_i" <?php echo $hazine_mosaferat_bold; ?>></i>
                                                    </span>
                                                    هزينه مسافرت
                                                </a>
                                            </li>
                                            <li  <?php echo $hazine_other_li_class;?>>
                                                <a href="hazineha_others.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="hazineha_others_i" <?php echo $hazineha_other_bold; ?>></i>
                                                    </span>
                                                    هزينه هاي ديگر
                                                </a>
                                            </li>
                                            <li <?php echo $etebar_sazmanha_li_class;?>>                                            
                                                <a href="sazmanhayedigar.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="sazmanhayedigar_i" <?php echo $etebar_szmanha_bold; ?>></i>
                                                    </span>
                                                    تامين اعتبار از سازمانهاي ديگر
                                                </a>
                                            </li>
                                            <? if(strcmp(trim($servicing),'1')!=0)
                                              {
                                            ?>
                                            <li <?php echo $molahezat_akhlaghi_li_class;?>>                                          
                                                <a href="comitte_akhlagh.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="comitte_akhlagh_i" <?php echo $molahezat_akhlaghi_bold; ?>></i>
                                                    </span>
                                                    ملاحظات اخلاقي
                                                </a>
                                            </li>
                                            <li <?php echo $rezayatname_li_class;?>>                                            
                                                <a href="add_rezayatname.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="add_rezayatname_i" <?php echo $rezayatname_bold; ?>></i>
                                                    </span>
                                                    فرم رضايت نامه
                                                </a>
                                            </li>
                                            <? }?>
                                            <li <?php echo $zamaem_li_class;?>>                                           
                                                <a href="upload_file.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>" class="">
                                                    <span class="pull-right green">
                                                        <i id="upload_file_i" <?php echo $zamaem_bold; ?>></i>
                                                    </span>
                                                    ضمائم
                                                </a>
                                            </li>
                                            <li  <?php echo $finish_li_class;?> >                                         
                                                <a href="finish_tarh.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>" class="">
                                                    <span class="pull-right green">
                                                        <i class="fa fa-times "></i>
                                                    </span>
                                                    خاتمه و ارسال
                                                </a>
                                            </li>
                                                                                       
                                               
                                        </ul>
                                    </div>
                                    <?php }?>