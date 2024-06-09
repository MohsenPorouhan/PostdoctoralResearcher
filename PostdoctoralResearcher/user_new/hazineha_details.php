<?php
include("include/database-connect.phtml");
include("include/include.phtml");

		 $query="select * from tarh where cod_tarh='$cod_tarh'  and version='-1' "; 
		 $result=mysql_query($query) or die("Error in selecting data from karshenas elmi ");
		 $row_fetched=mysql_fetch_array($result);
		 $tarh_name = $row_fetched["tarh_title_farsi"];
	     $servicing = $row_fetched["servicing"];

		 $personnel_sum=0;
		 $query="select * from  hazine_personnel where cod_tarh=\"$cod_tarh\"  and version='-1'";
		 $result=mysql_query($query) or die("Error in selecting data from hazine personnel");
		 if(mysql_num_rows($result) > 0)
		 {
		 	while($row_fetched=mysql_fetch_array($result))
			{
				 $my_summary = $row_fetched["per_hour"]*$row_fetched["majmoa_saat"];
       			 $personnel_sum=$personnel_sum+$my_summary;	     	
			}
		 	
		 }
		$lab_sum=0;
		$query="select * from  hazine_azmayesh where cod_tarh=\"$cod_tarh\"  and version='-1' order by mozoa_azmayesh ";
		$result=mysql_query($query) or die("Error in selecting data from hazine personnel");
   		if(mysql_num_rows($result) > 0)
   		{
   			while($row_fetched=mysql_fetch_array($result))
			{
				$my_summary = $row_fetched["azmayesh_cnt"]*$row_fetched["hazine_har_bar"];
       			$lab_sum=$lab_sum+$my_summary;
			}
   		}
   		$vasile_sum=0;
        $mycount1=0;
   		$query="select * from  fhrest_vasayel_kharid where cod_tarh=\"$cod_tarh\"  and version='-1'";
		$result=mysql_query($query) or die("Error in selecting data from hazine personnel");
   		if(mysql_num_rows($result) > 0)
   		{
			while($row_fetched=mysql_fetch_array($result))
			{
				$mycount1=$mycount1+$row_fetched["count"];
       			$vasile_sum=$vasile_sum+$row_fetched["price"]*$row_fetched["count"];
			}
   		}
   		$trip_sum=0;
		$mycount1=0;
   		$query="select * from  hazine_safar where cod_tarh=\"$cod_tarh\"  and version='-1'";
		$result=mysql_query($query) or die("Error in selecting data from hazine personnel");
   		if(mysql_num_rows($result) > 0)
   		{
   			while($row_fetched=mysql_fetch_array($result))
			{
				$trip_sum=$trip_sum+$row_fetched["hazine"];
				$mycount1=$mycount1+$row_fetched["persons_cnt"];
			}
   		}
   		$sum_sayer=0;
		$mycount1=0;
   		$query="select * from  sayer_hazine where cod_tarh=\"$cod_tarh\"  and version='-1'";
		$result=mysql_query($query) or die("Error in selecting data from hazine personnel");
   		if(mysql_num_rows($result) > 0)
   		{
   			while($row_fetched=mysql_fetch_array($result))
			{
	   			$sayer_hazine  = $row_fetched["sayer_hazine"];
	    		$hazine_taksir = $row_fetched["hazine_taksir"];
	    		$maliat = $row_fetched["maliat"];
	    		$nezarat = $row_fetched["nezarat"];
	    		$balasari = $row_fetched["balasari"];
	    		$sum_sayer=$sum_sayer+$sayer_hazine+$hazine_taksir+$maliat+$nezarat+$balasari;
			}
   		}
   		$eatebare_sazmanha_pardakht_add=0;
   		$query="select * from  eatebar_sazmanha where cod_tarh='$cod_tarh'  and version='-1'";
   		$result=mysql_query($query) or die("Error in selecting data from karshenas elmi1212");
   		if(mysql_num_rows($result) > 0)
   		{
			while($row_fetched=mysql_fetch_array($result))
			{
					$eatebare_sazmanha_value = $row_fetched["eatebare_sazmanha_value"]; 
					$eatebare_sazmanha_pardakht_add=$eatebare_sazmanha_value+$eatebare_sazmanha_pardakht_add;
			}
   		}	
?>
<div class="panel-group accordion" id="accordion1">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
			<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1_1">
			جمع هزينه ها
			</a>
			</h4>
		</div>
		<div id="collapse_1_1" class="panel-collapse in">
		<table class="table table-bordered table-striped" >
                    <tbody>
                        <tr>
                            <td><b>(مجموع(ريال<b></b></b></td>
                            <td><b>هزينه<b></b></b></td>
                        </tr>
                        <tr>
                            <td><?php echo number_format($personnel_sum);?></td>
                            <td>جمع هزينه پرسنلي</td>
                        </tr>
                        <tr>
                            <td><?php echo number_format($lab_sum);?></td>
                            <td>جمع هزينه هاي آزمايشات وخدمات تخصصي</td>
                        </tr>
                        <tr>
                            <td><?php echo number_format($vasile_sum);?></td>
                            <td>جمع هزِينه هاي وسايل</td>
                        </tr>
                        <tr>
                            <td><?php echo number_format($trip_sum);?></td>
                            <td>جمع هزينه هاي مسافرت</td>
                        </tr>
                        
                        <tr>
                            <td><?php echo number_format($sum_sayer);?></td>
                            <td>جمع ساير هزينه ها</td>
                        </tr>
                        <tr>
                            <td><?php echo number_format($eatebare_sazmanha_pardakht_add);?></td>
                            <td>اعتبار از سازمانهاي ديگر</td>
                        </tr>
                        <?php $sum_of_all = $sum_sayer+$vasile_sum+$trip_sum+$lab_sum+$personnel_sum;?>
                        <tr>
                            <td><b><?php echo number_format($sum_of_all);?></b></td>
                            <td><b>جمع کل</b></td>
                        </tr>
                    </tbody>
        </table>
        </div>
   </div>
   <div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
			<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1_2">
			هزينه پرسنلي
			</a>
			</h4>
		</div>
		<div id="collapse_1_2" class="panel-collapse collapse">
		<?php 
		$query="select * from  hazine_personnel where cod_tarh=\"$cod_tarh\"  and version='-1'";
		$result=mysql_query($query) or die("Error in selecting data from hazine personnel");
		?>
		<table class="table table-bordered table-striped" >
                    <thead>
                        <tr>
                            <th>جمع</th>
                            <th>حق الزحمه در ساعت</th>
                            <th>مجموع ساعت هر فرد</th>
                            <th>درجه تحصيلي</th>
                            <th>تعداد افراد</th>
                            <th>نوع فعاليت</th>
                            <th>نام مجري / همکار / ديگر افراي</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                     $personnel_sum=0;
				     while($row_fetched=mysql_fetch_array($result))
				     {
				       echo "<tr>";
				       
				       $mojri_code=$row_fetched["mojri_code"];
				       $query1="select distinct user_login.* from user_login  where user_login.email='$mojri_code'";
				       $result1=mysql_query($query1) or die("Error");
				       $mojri_name_family="*";
				       
				       if(mysql_num_rows($result1)>0)		   
					   {
					   	
					   	$myrf=mysql_fetch_array($result1);
					   	$mojri_name_family=$myrf["name"]."&nbsp;".$myrf["family"];
					   	
					   }
					
				       $query2="select distinct mojri.* from  mojri  where mojri.mojri_code= '$mojri_code'";
				       $result2=mysql_query($query2) or die("Error in selecting data from mojri_tarh");
				       
				       if(mysql_num_rows($result2)>0)		   
					   {
					   	
					   	$myrf=mysql_fetch_array($result2);
					   	$mojri_name_family=$myrf["name"]."&nbsp;".$myrf["family"];
					   	
					   }
					   $my_summary = $row_fetched["per_hour"]*$row_fetched["majmoa_saat"];
       				   $personnel_sum=$personnel_sum+$my_summary;
       				    
       				   $query="select * from darajeelmi where darajeelmi = '".$row_fetched["degree"]."'";
				       $qresult=mysql_query($query) or die("Error in selecting data from daraje elmi");
				       if(mysql_num_rows($qresult) > 0 )
				       {
				         $row_degree = mysql_fetch_array($qresult);
				         $degree_result = $row_degree["darajeelmi_desc"];
				       }
				       else
				         $degree_result = "ثبت نشده";
                    ?>
					 <tr>
                            <td><?php echo number_format($my_summary);?></td>
                            <td><?php echo number_format($row_fetched["per_hour"]);?></td>
                            <td><?php echo number_format($row_fetched["majmoa_saat"]);?></td>
                            <td><?php echo $degree_result;?></td>
                            <td><?php echo number_format($row_fetched["persons"]);?></td>
                            <td><?php echo $row_fetched["activity_type"];?></td>
                            <td><?php echo $mojri_name_family;?></td>
                        </tr>
                       
                        <?php }?>
                         <tr>
                            <td><?php echo number_format($personnel_sum);?></td>
                            <td>مجموع</td>
                        </tr>
                    </tbody>
                </table>
        </div>
      </div>
      <div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
			<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1_3">
			هزينه آزمايشات و خدمات تخصصي
			</a>
			</h4>
		</div>
		<div id="collapse_1_3" class="panel-collapse collapse">
		<?php 
		$query="select * from  hazine_azmayesh where cod_tarh=\"$cod_tarh\"  and version='-1' order by mozoa_azmayesh ";
		$result=mysql_query($query) or die("Error in selecting data from hazine personnel");
				?>
		<table class="table table-bordered table-striped" >
                    <thead>
                       <tr>
                            <th>جمع</th>
                            <th>هزينه هر دفعه</th>
                            <th>تعداد كل دفعات</th>
                            <th>مركز سرويس دهنده</th>
                            <th>نوع آزمايش يا خدمات تخصصي</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                     $lab_sum=0;
				     while($row_fetched=mysql_fetch_array($result))
				     {
				        $my_summary = $row_fetched["azmayesh_cnt"]*$row_fetched["hazine_har_bar"];
       					$lab_sum=$lab_sum+$my_summary;
       					if (strcmp($row_fetched["azmayesh_center"],'1')==0)
				        	$mahall_azmayesh="خصوصي";
				       if (strcmp($row_fetched["azmayesh_center"],'2')==0)
				        	$mahall_azmayesh="داخل دانشگاه";
					   if (strcmp($row_fetched["azmayesh_center"],'3')==0)
				        	$mahall_azmayesh="دولتي خارج دانشگاه"; 
                    ?>
					 <tr>
                            <td><?php echo number_format($my_summary);?></td>
                            <td><?php echo number_format($row_fetched["hazine_har_bar"]);?></td>
                            <td><?php echo number_format($row_fetched["azmayesh_cnt"]);?></td>
                            <td><?php echo $mahall_azmayesh;?></td>
                            <td><?php echo $row_fetched["mozoa_azmayesh"];?></td>
                        </tr>

              <?php }?>
                        <tr>
                            <td><?php echo number_format($lab_sum);?></td>
                            <td>مجموع</td>
                        </tr>
                    </tbody>
                </table>
        </div>
      </div>
      <div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
			<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1_4">
			هزينه وسايل خريداري شده
			</a>
			</h4>
		</div>
		<div id="collapse_1_4" class="panel-collapse collapse">
		<?php 
		$query="select * from  fhrest_vasayel_kharid where cod_tarh=\"$cod_tarh\"  and version='-1'";
		$result=mysql_query($query) or die("Error in selecting data from hazine personnel");
		?>
		<table class="table table-bordered table-striped" >
                    <thead>
                       <tr>
                            <th>قيمت کل</th>
                            <th>قيمت واحد</th>
                            <th>واحد</th>
                            <th>تعداد يا مقدار</th>
                            <th>مصرفي يا غير مصرفي</th>
                            <th>كد دستگاه</th>
                            <th>شرکت سازنده</th>
                            <th>نام دستگاه يا ماده</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $vasile_sum=0;
                    $mycount1=0;
				    while($row_fetched=mysql_fetch_array($result))
				    {
				    	 	$mycount1=$mycount1+$row_fetched["count"];
       						$vasile_sum=$vasile_sum+$row_fetched["price"]*$row_fetched["count"];
       						if( $row_fetched["usage_unusage"] == "0" )
						        $using_unusage= "مصرفي";
						    else
						          $using_unusage= "غير مصرفي"; 
                    ?>
					 <tr>
                            <td><?php echo number_format($row_fetched["price"]*$row_fetched["count"]);?></td>
                            <td><?php echo number_format($row_fetched["price"]);?></td>
                            <td><?php echo $row_fetched["meghyas"];?></td>
                            <td><?php echo number_format($row_fetched["count"]);?></td>
                            <td><?php echo $using_unusage;?></td>
                            <td><?php echo $row_fetched["country"];?></td>
                            <td><?php echo $row_fetched["company"];?></td>
                            <td><?php echo $row_fetched["name_dastgah"];?></td>
                        </tr>
                       
                     <?php 
				    }?>
				     <tr>
                            <td><?php echo number_format($vasile_sum);?></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><?php echo number_format($mycount1);?></td>
                            <td>مجموع</td>
                        </tr>
                    </tbody>
                </table>
        </div>
      </div>
      <div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
			<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1_5">
			هزينه مسافرت
			</a>
			</h4>
		</div>
		<div id="collapse_1_5" class="panel-collapse collapse">
		<?php 
		$query="select * from  hazine_safar where cod_tarh=\"$cod_tarh\"  and version='-1'";
		$result=mysql_query($query) or die("Error in selecting data from hazine personnel");
		?>
		<table class="table table-bordered table-striped" >
                    <thead>
                       <tr>
                            <th>هزينه  به ريال</th>
                            <th>تعداد افراد</th>
                            <th>نوع وسيله</th>
                            <th>دفعات مسافرت</th>
                            <th>مقصد</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                     $trip_sum=0;
				     $mycount1=0;
				     while($row_fetched=mysql_fetch_array($result))
				     {
				       $trip_sum=$trip_sum+$row_fetched["hazine"];
				       $mycount1=$mycount1+$row_fetched["persons_cnt"];
                    ?>
					 	<tr>
                            <td><?php echo number_format($row_fetched["hazine"]);?></td>
                            <td><?php echo number_format($row_fetched["persons_cnt"]);?></td>
                            <td><?php echo $row_fetched["vasile"];?></td>
                            <td><?php echo number_format($row_fetched["dafe_safar"]);?></td>
                            <td><?php echo $row_fetched["target"];?></td>
                        </tr>
                        
                     <?php 
				    }?>
				    	<tr>
                            <td><?php echo number_format($trip_sum);?></td>

                            <td><?php echo number_format($mycount1);?></td>
                            <td>مجموع</td>
                        </tr>
                    </tbody>
                </table>
        </div>
      </div>
      <div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
			<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1_6">
			ساير هزينه ها
			</a>
			</h4>
		</div>
		<div id="collapse_1_6" class="panel-collapse collapse">
		<?php 
		$query="select * from  sayer_hazine where cod_tarh=\"$cod_tarh\"  and version='-1'";
		$result=mysql_query($query) or die("Error in selecting data from hazine personnel");
		?>
		<table class="table table-bordered table-striped" >
                    <thead>
                       <tr>
                       <? if(strcmp($servicing,"1")==0){?>
                       		<th>بالاسري دانشگاه</th>
                            <th>حق نظارت</th>
                            <th>ماليات</th>
                        <? }else{ ?>
                            <th>ساير هزينه ها</th>
                            <th>هزينه تکثير اوراق</th>
                        <? }?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                     $sum_sayer=0;
				     $mycount1=0;
				     while($row_fetched=mysql_fetch_array($result))
				     {
				       $sayer_hazine  = $row_fetched["sayer_hazine"];
    				   $hazine_taksir = $row_fetched["hazine_taksir"];
    				   $maliat = $row_fetched["maliat"];
    				   $nezarat = $row_fetched["nezarat"];
    				   $balasari = $row_fetched["balasari"];
    				   $sum_sayer=$sum_sayer+$sayer_hazine+$hazine_taksir+$maliat+$nezarat+$balasari;
                    ?>
                    <? if(strcmp($servicing,"1")==0){?>
                     <tr>
	                            <td><?php echo number_format($balasari);?></td>
	                            <td><?php echo number_format($nezarat);?></td>
	                            <td><?php echo number_format($maliat);?></td>
	                     </tr>
	                      <? }else{ ?>
						 <tr>
	                            <td><?php echo number_format($sayer_hazine);?></td>
	                            <td><?php echo number_format($hazine_taksir);?></td>
	                     </tr>
	                      <? }?>
                        
                     <?php 
				    }?>
				    <tr>
                            <td><?php echo number_format($sum_sayer);?></td>
                            <td>مجموع</td>
                             <? if(strcmp($servicing,"1")==0){?>
                            <td>&nbsp;</td>
                            <? }?>
                        </tr>
                    </tbody>
                </table>

        </div>
      </div>
            <div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
			<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1_7">
			تامين اعتبار از ساير سازمان ها
			</a>
			</h4>
		</div>
		<div id="collapse_1_7" class="panel-collapse collapse">
		<?php 
		$query="select * from  eatebar_sazmanha where cod_tarh='$cod_tarh'  and version='-1'";
   		$result=mysql_query($query) or die("Error in selecting data from karshenas elmi1212");
				?>
		<table class="table table-bordered table-striped" >
                    <thead>
                        <tr>
                            <th>نحوه پرداخت</th>
                            <th>تاريخ نامه</th>
                            <th>شماره نامه ابلاغ اعتبار</th>
                            <th>مبلغ</th>
                            <th>نام موسسه</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $eatebare_sazmanha_pardakht_add=0;
					   while($row_fetched=mysql_fetch_array($result))
						 {
						    $mojri_code = $row_fetched["mojri_code"];
						   	$eatebare_sazmanha_value = $row_fetched["eatebare_sazmanha_value"]; 
						   	$eatebare_sazmanha_pardakht = $row_fetched["eatebare_sazmanha_pardakht"];
						   	$eatebare_sazmanha_fax = $row_fetched["eatebare_sazmanha_fax"];
						   	$eatebare_sazmanha_telno= $row_fetched["eatebare_sazmanha_telno"];
						   	$eatebare_sazmanha_organ = $row_fetched["eatebare_sazmanha_organ"];
						    $eatebare_sazmanha_address = $row_fetched["eatebare_sazmanha_address"];
						    $letter_number = $row_fetched["letter_number"];
						    $letter_date = $row_fetched["letter_date"];
						    $eatebare_sazmanha_pardakht_add=$eatebare_sazmanha_value+$eatebare_sazmanha_pardakht_add;
						    $id_pardakht= $row_fetched["id"];
						  
						  	if(strcmp($eatebare_sazmanha_pardakht,'0')==0)
						        $eatebare_sazmanha="اعتبار توسط مجري دريافت مي شود ";
						    if(strcmp($eatebare_sazmanha_pardakht,'1')==0)
						        $eatebare_sazmanha=" اعتبار به دانشگاه پرداخت ميشود تا از طريق قرارداد به مجري پرداخت شود ";
                    ?>
                        <tr>
                            <td><?php echo $eatebare_sazmanha;?></td>
                            <td><?php echo $letter_date;?></td>
                            <td><?php echo $letter_number;?></td>
                            <td><?php echo $eatebare_sazmanha_value;?></td>
                            <td><?php echo $eatebare_sazmanha_organ;?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
           </div>
      </div>
</div>
        

