<script language="javascript">
           
        	   window.location="<? echo "../login.phtml";  ?>";
        	   </script>

<?php 
    /*  $query="select * from tarh where cod_tarh='$cod_tarh'  and version='-1'";
	  $result=mysql_query($query) or die("Error in selecting data from karshenas elmi ");
	  $row_fetched=mysql_fetch_array($result);
	  $tarh_name = $row_fetched["tarh_title_farsi"];
	  $finished=$row_fetched["finished"]; 
	  $first_letter=$row_fetched["first_letter"];
	  $payan_name=$row_fetched['payan_name'];
	  $creator=$row_fetched['creator'];
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
	*/
	//////////////////////////////////////   ACTIVE LINK
	 switch ($active_id)
	  {

	  case "1":
	    $step_1_li_class="class='active'";
	    break;
	  case "2":
	    $step_2_li_class="class='active'";
	    break;
	  case "3":
	   $step_3_li_class="class='active'";
	    break;
	  case "4":
	    $step_4_li_class="class='active'";
	    break;
	  case "5":
	    $step_5_li_class="class='active'";
	    break;
	  case "6":
	   $step_6_li_class="class='active'";
	    break;
	   case "7":
	   $step_7_li_class="class='active'";
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
	  	$jadval_zarayeb_li_class="class='disabled'"; 
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

		
	} 
	//////////////////////////////////////////////////////////  Fill or empty 
	
	$bayan_bold="class='fa fa-times '";
	$mojri_bold="class='fa fa-times '";
	$ejra_bold="class='fa fa-times '";
	$jadval_zarayeb_bold="class='fa fa-times '";
	$jadval_zamanbandi_bold="class='fa fa-times '";
	$hazine_personnel_bold="class='fa fa-times '";
	$hazine_azmayeh_bold="class='fa fa-times '";

	
	
	
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
		
				
		}
	}
	

	//////////////////////////////////////////////////////////////
	

	                         
?>
                                    
                                    
                                    <div class="col-md-3 col-sm-12 col-xs-12 border-left">
                                        <ul class="nav nav-pills nav-stacked border-bottom" >
                                        
                                            <li <?php echo $step_1_li_class;?>>
                                                <a href="sabt_tarh_second.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i class="fa fa-check "></i>
                                                    </span>
                                                    مرحله اول
                                                </a>
                                            </li>
                                             <li <?php echo $step_2_li_class;?>>
                                                <a href="edit_chekide_tarh.phtml">
                                                    <span class="pull-right green">
                                                        <i class="fa fa-check "></i>
                                                    </span>
                                                    مرحله دوم
                                                </a>
                                            </li>
                                       
                                            <li <?php echo $step_3_li_class;?>>
                                                <a href="sabt_tarh.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>">
                                                    <span class="pull-right green">
                                                        <i class="fa fa-check "></i>
                                                    </span>
                                                    مرحله سوم
                                                </a>
                                            </li>
                                      
                                            <li <?php echo $step_4_li_class;?>>
                                                <a href="tarh_body.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="tarh_body_i" <?php echo $bayan_bold; ?>></i>
                                                    </span>
                                                    مرحله چهارم
                                                </a>
                                            </li>
                                            <li <?php echo $step_5_li_class;?>>
                                                <a href="mojri_tarh.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="mojri_tarh_i" <?php echo $mojri_bold; ?>></i>
                                                    </span>
                                                    مرحله پنجم
                                                </a>
                                            </li>
                                          
                                            <li <?php echo $step_6_li_class;?>>
                                                <a href="ostad_rahnama.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="ostad_rahnama_i" <?php echo $ostad_rahnama_bold; ?>></i>
                                                    </span>
                                                    مرحله ششم
                                                </a>
                                            </li>
                                          
                                            <li <?php echo $step_7_li_class;?>>
                                                <a href="ravesh_ejra.phtml?admin=<?php echo $admin;?>&seed=<?php echo $seed;?>&cod_tarh=<?php echo $cod_tarh;?>">
                                                    <span class="pull-right green">
                                                        <i id="ravesh_ejra_i" <?php echo $ejra_bold; ?>></i>
                                                    </span>
                                                    مرحله هفتم
                                                </a>
                                            </li>                                                 
                                               
                                        </ul>
                                    </div>