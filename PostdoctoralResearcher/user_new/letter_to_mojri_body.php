<?php 
include("include/database-connect.phtml");
include("include/include.phtml");
include("include/vars.inc.phtml");

function add_hazineha($cod_tarh , $version,$la)
{
	$query="select * from  hazine_personnel where cod_tarh=\"$cod_tarh\"  and version='$version' order by activity_type ";

	$result=mysql_query($query) or die("Error in selecting data from hazine personnel");
	if(mysql_num_rows($result) > 0)
	{
		$mycount=0;
		while($row_fetched=mysql_fetch_array($result))
		{
			$my_summary = $row_fetched["per_hour"]*$row_fetched["majmoa_saat"];
			$mycount=$mycount+$my_summary;
			$query="select * from darajeelmi where darajeelmi = '".$row_fetched["degree"]."'";
			$qresult=mysql_query($query) or die("Error in selecting data from daraje elmi");
			if(mysql_num_rows($qresult) > 0 )
			{
				$row_degree = mysql_fetch_array($qresult);
				$degree_result = $row_degree["darajeelmi_desc"];
			}
			else
				$degree_result = "ثبت نشده";
		}
		$personnel_sum=$mycount;
	}

	 
	 
	 
	$query="select * from  hazine_azmayesh where cod_tarh=\"$cod_tarh\"  and version='$version' order by mozoa_azmayesh ";

	$result=mysql_query($query) or die("Error in selecting data from hazine personnel");
	if(mysql_num_rows($result) > 0)
	{

		$mycount=0;
		while($row_fetched=mysql_fetch_array($result))
		{
			$my_summary = $row_fetched["azmayesh_cnt"]*$row_fetched["hazine_har_bar"];
			$mycount=$mycount+$my_summary;
		}
		$lab_sum=$mycount;
	}

	$query="select * from  fhrest_vasayel_kharid where cod_tarh=\"$cod_tarh\"  and version='$version' order by name_dastgah";

	$result=mysql_query($query) or die("Error in selecting data from fehrest kharid 2");
	if(mysql_num_rows($result) > 0)
	{

		$mycount=0;
		$mycount1=0;

		while($row_fetched=mysql_fetch_array($result))
		{
			//  $mycount=$mycount+$row_fetched["count"];
			// $mycount1=$mycount1+$row_fetched["price"];
			$mycount1=$mycount1+$row_fetched["price"]*$row_fetched["count"];
		}
		//$vasile_sum=$mycount*$mycount1;
		$vasile_sum=$mycount1;

	}
	$query="select * from  hazine_safar where cod_tarh=\"$cod_tarh\"  and version='$version' order by target";

	$result=mysql_query($query) or die("Error in selecting data from hazine safar");
	if(mysql_num_rows($result) > 0)
	{

		$mycount=0;
		$mycount1=0;
		while($row_fetched=mysql_fetch_array($result))
		{
			$mycount=$mycount+$row_fetched["hazine"];
			$mycount1=$mycount1+$row_fetched["persons_cnt"];
		}
		$trip_sum = $mycount;
	}
	$query = "select * from sayer_hazine where cod_tarh='$cod_tarh'  and version='$version'";
	$result = mysql_query($query) or die("Error in selecting data from sayer_hazine ");

	$hazine_taksir=0;
	$hazine_digar=0;
	if(mysql_num_rows($result) > 0 )
	{

		while($hazine_row_fetched = mysql_fetch_array($result))
		{
			$hazine_taksir = $hazine_taksir+$hazine_row_fetched["hazine_taksir"];
			$hazine_digar = $hazine_digar+$hazine_row_fetched["sayer_hazine"];
		}
	}
	$sum_sayer=$hazine_digar+$hazine_taksir;
	$sum_of_all = $sum_sayer+$vasile_sum+$trip_sum+$lab_sum+$personnel_sum;
	if($la=="en"){
		$cost_tbl_head="Cost";
		$total_tbl_head="Total";
		$personnel_sum_tbl_th="Total Personnel compensation";
		$lab_sum_tbl_th="Total lab test and services";
		$trip_sum_tbl_th="Total travel expenses";
		$vasile_sum_tbl_th="Total Equipment/Materials";
		$sum_sayer_tbl_th="Total others cost";
		$Budget_from_other_organizations_tbl_th="Budget from other organizations";
		$sum_of_all_tbl_th="Sum of all";
	}else{
		$cost_tbl_head="هزينه";
		$total_tbl_head="(مجموع(ريال";
		$personnel_sum_tbl_th="جمع هزينه پرسنلي";
		$lab_sum_tbl_th="جمع هزينه هاي آزمايشات وخدمات تخصصي";
		$trip_sum_tbl_th="جمع هزينه هاي مسافرت";
		$vasile_sum_tbl_th="جمع هزِينه هاي وسايل";
		$sum_sayer_tbl_th="جمع ساير هزينه ها";
		$Budget_from_other_organizations_tbl_th="اعتبار از سازمانهاي ديگر";
		$sum_of_all_tbl_th="جمع کل";
	}
	echo "<table>";
	echo "<thead>";
	echo "<tr>";
	echo "<th scope='col'>$cost_tbl_head</th>";
	echo "<th scope='col'>$total_tbl_head</th>";
	echo "</tr>";
	echo "</thead>";
	echo "</tbody>";
	echo "<tr>";
	echo "<th scope='row'>$personnel_sum_tbl_th</th>";
	echo "<td>".number_format($personnel_sum)."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<th scope='row'>$lab_sum_tbl_th</th>";
	echo "<td>".number_format($lab_sum)."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<th scope='row'>$trip_sum_tbl_th</th>";
	echo "<td>".number_format($trip_sum)."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<th scope='row'>$vasile_sum_tbl_th</th>";
	echo "<td>".number_format($vasile_sum)."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<th scope='row'>$sum_sayer_tbl_th</th>";
	echo "<td>".number_format($sum_sayer)."</td>";
	echo "</tr>";

	echo "<tr>";
	echo "<th scope='row'>$Budget_from_other_organizations_tbl_th</th>";
	echo "<td>".number_format($eatebare_sazmanha_pardakht_add)."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<th scope='row'>$sum_of_all_tbl_th</th>";
	$sum_of_all = $sum_sayer+$vasile_sum+$trip_sum+$lab_sum+$personnel_sum;
	echo "<td>".number_format($sum_of_all)."</td>";
	echo "</tr>";
	echo "</tbody>";
	echo "</table>";
}
       
if(isset($action)){
	
////////////////////////////////////////////////////////////////////////////	
		if(strcmp($action,"send_letter")==0){
			if($la=="en"){
				$alert_danger="You have some form errors. Please check below.";
				$subject_lbl="Subject";
				$text_letter_lbl="Text";
				$date_tbl_head="Date";
				$form_tbl_head="From";
				$to_tbl_head="To";
				$number_tbl_head="Number";
				$subject_tbl_head="Subject";
				$text_tbl_head="Text";
				$letter_type_tbl_head="Type";
				
			}else{
				$alert_danger="پر کردن فيلدهاي ستاره دار اجباري مي باشد.";
				$subject_lbl="عنوان";
				$text_letter_lbl="متن نامه";
				$date_tbl_head="تاريخ";
				$form_tbl_head="ارسال کننده";
				$to_tbl_head="دريافت کننده";
				$number_tbl_head="شماره";
				$subject_tbl_head="عنوان نامه";
				$text_tbl_head="متن نامه";
				$letter_type_tbl_head="نوع نامه";
			}
				       	?>	      	
						<input id="cod_tarh" name="cod_tarh" type="hidden" class="form-control" value="<?php echo $cod_tarh;?>">
				        <div class="form-body">
					    	<div class="alert alert-danger display-hide">
									<button class="close" data-close="alert"></button>
								    <?php echo $alert_danger; ?>
							</div>
							<div class="row">
								<div class="col-md-9 col-md-push-1">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo $subject_lbl; ?>
										<span class="required">
											 *
										</span>
										</label>
										<div class="col-md-9">
											<div class="input-icon right">
												<i class="fa"></i>
												<input id="letter_subject" name="letter_subject" type="text" class="form-control" placeholder="">
											</div>
										</div>
									</div>
								</div>
								<!--/span-->
									
								</div>
								<!--/row-->
								<div class="row">
								<div class="col-md-9 col-md-push-1">
										<div class="form-group">
											<label class="control-label col-md-3"><?php echo $text_letter_lbl; ?></label>
											<div class="col-md-9">
													<textarea id="letter_body" name="letter_body" rows="7" cols="64"></textarea>
											</div>
										</div>
									</div>
								</div>
								
						</div>
						<?php 	
						$query="select * from letter_to_mojri where cod_tarh='$cod_tarh' order by id desc";
						
						$result=mysql_query($query) or die("error in selecting data from letter_to_mojri");
						if(mysql_num_rows($result) > 0)
						{
											?>	
											<table border="1">
													<thead>
														<tr>
															<th scope="col"><?php echo $date_tbl_head;?></th>
															<th scope="col"><?php echo $form_tbl_head;?></th>
															<th scope="col"><?php echo $to_tbl_head;?></th>
														    <th scope="col"><?php echo $number_tbl_head;?></th>
														    <th scope="col"><?php echo $subject_tbl_head;?></th>
														    <th scope="col"><?php echo $text_tbl_head;?></th>
														    <th scope="col"><?php echo $letter_type_tbl_head;?></th>
														</tr>
													</thead>
													<tbody>
											<?php 
											while($row_fetched=mysql_fetch_array($result))
											{
														$id=$row_fetched["id"];
														?>
															
														 <tr>
														 <?php
														 
														 $atf_to=$row_fetched["atf_to_letter"];
														 if(strlen(trim($atf_to)) > 0)
														 {
															if($la=="en")
																$letter_type="Researcher`s answer";
															else
																$letter_type="پاسخ مجري";
															$letter_type=$letter_type;
														 }
														 else
														 {
															if($la=="en")
																$letter_type="Letter to researcher";
															else
																$letter_type="نامه به مجري";
														 	$letter_type=$letter_type;
														 }
													
														 $letter_body=$row_fetched["letter_body"];
														 $letter_subject=$row_fetched["letter_subject"];
														
														 echo "<td>".$row_fetched["letter_date"]."</td>";
														 echo "<td>".$row_fetched["from_letter"]."</td>";
														 echo "<td>".$row_fetched["to_letter"]."</td>";
														 echo "<td>".$row_fetched["letter_no"]."</td>";
														 echo "<td>".$letter_subject."</td>";
														 echo "<td>".$letter_body."</td>";
														 echo "<td>".$letter_type."</td>";
											    	     echo"</tr>";
										   }
						 }
											?>
				       </tbody>	
				       </table>
		
		<?php 
		}
////////////////////////////////////////////////////////////////////////////
		if(strcmp($action, "view_letters")==0)
		{?>
			 <?php 
			 if($la=="en"){
			 	$alert_danger="You have some form errors. Please check below.";
			 	$subject_lbl="Subject";
			 	$text_letter_lbl="Text";
			 	$date_tbl_head="Date";
			 	$form_tbl_head="From";
			 	$to_tbl_head="To";
			 	$number_tbl_head="Number";
			 	$subject_tbl_head="Subject";
			 	$text_tbl_head="Text";
			 	$letter_type_tbl_head="Type";
			 
			 }else{
			 	$alert_danger="پر کردن فيلدهاي ستاره دار اجباري مي باشد.";
			 	$subject_lbl="عنوان";
			 	$text_letter_lbl="متن نامه";
			 	$date_tbl_head="تاريخ";
			 	$form_tbl_head="ارسال کننده";
			 	$to_tbl_head="دريافت کننده";
			 	$number_tbl_head="شماره";
			 	$subject_tbl_head="عنوان نامه";
			 	$text_tbl_head="متن نامه";
			 	$letter_type_tbl_head="نوع نامه";
			 }
				$query="select * from letter_to_mojri where cod_tarh='$cod_tarh' order by id desc";
				
				$result=mysql_query($query) or die("error in selecting data from letter_to_mojri");
				if(mysql_num_rows($result) > 0)
				{
				?>
				<div class="table-responsive">	
					<table class="table-striped table-bordered">
							<thead>
								<tr>
									<th scope="col"><?php echo $date_tbl_head;?></th>
									<th scope="col"><?php echo $form_tbl_head;?></th>
									<th scope="col"><?php echo $to_tbl_head;?></th>
								    <th scope="col"><?php echo $number_tbl_head;?></th>
								    <th scope="col"><?php echo $subject_tbl_head;?></th>
								    <th scope="col"><?php echo $text_tbl_head;?></th>
								    <th scope="col"><?php echo $letter_type_tbl_head;?></th>
								</tr>
							</thead>
							<tbody>
					<?php 
					while($row_fetched=mysql_fetch_array($result))
					{
								$id=$row_fetched["id"];
								?>
									
								 <tr>
								 <?php
												$atf_to=$row_fetched["atf_to_letter"];
												if(strlen(trim($atf_to)) > 0)
												 {
													if($la=="en")
														$letter_type="Researcher`s answer";
													else
														$letter_type="پاسخ مجري";
													$letter_type=$letter_type;
												 }
												 else
												 {
													if($la=="en")
														$letter_type="Letter to researcher";
													else
														$letter_type="نامه به مجري";
												 	$letter_type=$letter_type;
												 }
												  
											
												 $letter_body=$row_fetched["letter_body"];
												 $letter_subject=$row_fetched["letter_subject"];
												
												 echo "<td>".$row_fetched["letter_date"]."</td>";
												 echo "<td>".$row_fetched["from_letter"]."</td>";
												 echo "<td>".$row_fetched["to_letter"]."</td>";
												 echo "<td>".$row_fetched["letter_no"]."</td>";
												 echo "<td>".$letter_subject."</td>";
												 echo "<td>".$letter_body."</td>";
												 echo "<td>".$letter_type."</td>";
									    	     echo"</tr>";
								   		}
				 					}
									?>
				        </tbody>	
				        </table>
			        </div>
		<?php }
////////////////////////////////////////////////////////////////////////////		
		else if(strcmp($action,"change_status")==0){
		           ?>
			       <input id="cod_tarh" name="cod_tarh" type="hidden" class="form-control" value="<?php echo $cod_tarh;?>">
			       <div class="form-body">
						 <div class="form-horizontal">
								<div class="form-group">
									<p class="help-block">
									<?php if($la=="en"){ ?>
										The research of the thesis is created if you confirm.
								   <?php } else{ ?>
								  	    در اين حالت يک طرح از روي پايان نامه براي شما ايجاد مي گردد
								   <?php } ?>
								    </p>
							    </div>
						 </div>
			       </div>
		           <?php
		}
		
////////////////////////////////////////////////////////////////////////////		
		else if(strcmp($action,"versions")==0){
			$query="select * from tarh where cod_tarh='$cod_tarh'  order by  version desc  ";
			$result=mysql_query($query) or die("Error in selecting data from tarh2");
			if(mysql_num_rows($result) > 0 )
			{ 
				if($la=="en"){
					$version_tbl_head="Version";
					$code_tarh_tbl_head="Code";
					$subject_tbl_head="Subject";
					$First_researcher_tbl_head="First researcher";
					$fculty_tbl_head="Faculty";
					$sum_cost_tbl_head="Sum";
					$print_tbl_head="Print";
				}else{
					$version_tbl_head="ويراست طرح";
					$code_tarh_tbl_head="کد طرح";
					$subject_tbl_head="عنوان فارسي";
					$First_researcher_tbl_head="مجري اول";
					$fculty_tbl_head="دانشکده /مرکز";
					$sum_cost_tbl_head="جمع هزينه ها";
					$print_tbl_head="پرينت";
				}
			?>
			<table border="1">
				<thead>
					  <tr>
						  <th scope="col"><?php echo $version_tbl_head; ?></th>
						  <th scope="col"><?php echo $code_tarh_tbl_head; ?></th>
						  <th scope="col"><?php echo $subject_tbl_head; ?></th>
						  <th scope="col"><?php echo $First_researcher_tbl_head; ?></th>
						  <th scope="col"><?php echo $fculty_tbl_head; ?></th>  
					      <th scope="col"><?php echo $sum_cost_tbl_head; ?></th> 
					      <th scope="col"><?php echo $print_tbl_head; ?></th>   
					  </tr>
				</thead>
			<?php
			while($row_fetched=mysql_fetch_array($result))
			{
				$cod_tarh=$row_fetched["cod_tarh"];
				$cod_daneshkade=$row_fetched["cod_daneshkade"];
				$myq="select * from daneshkade where cod_daneshkade='$cod_daneshkade'";
				$myres=mysql_query($myq);
				$myrf=mysql_fetch_array($myres);
				if($la=="en")
					$daneshkade=$myrf["daneshkade_english_name"];
				else 
					$daneshkade=$myrf["daneshkade_name"];

				echo "<tbody>";
				echo "<tr>";
			
				$editable=1;
				$mytarh_type = $row_fetched["vaziat"];
				if($row_fetched["vaziat"]=="0")
				{
					if($row_fetched["confirm_tarh"]=="1")
						$mystatus="در دست بررسي";
					else
						$mystatus="نامعلوم";
				}
				else
				{
					$query="select * from vaziat_tarh where vaziat='$mytarh_type'";
					$result_tarhtype=mysql_query($query) or die("Error in selectiong data from tarhtype");
					$row_fetched_tarh=mysql_fetch_array($result_tarhtype);
					$mystatus=$row_fetched_tarh["vaziat_desc"];
					if($row_fetched_tarh["view_or_no"]=="1")
						$editable=0;
					else
						$editable=1;
				}
			
			
			
			
				$startdate = $row_fetched["tarh_time"];
				$startyear = substr($startdate,0,4);
				$startmon = substr($startdate,5,2);
				$startday = substr($startdate,8,2);
				$farsistartdate=hijricalender( $startyear , $startmon , $startday );
				$farsistartdate = enum2fnum($farsistartdate);
				//$myquery_mojri = "SELECT  * FROM tarh, mojri_tarh, mojri WHERE mojri_tarh.cod_tarh = tarh.cod_tarh AND mojri.mojri_code=mojri_tarh.mojri_code and tarh.cod_tarh = '$cod_tarh'  ORDER  BY mojri.mojri_code";
				$myquery_mojri = "SELECT  * FROM tarh, user_login WHERE tarh.creator = user_login.email AND tarh.cod_tarh = '$cod_tarh'";
				$myresult_mojri = mysql_query( $myquery_mojri ) or die("Error in selecting data from First mojri");
				$mojri_tag="1";
				if(mysql_num_rows($myresult_mojri) > 0 )
				{
					$First_mojri = mysql_fetch_array( $myresult_mojri );
					$First_mojri_name = $First_mojri["name"]."&nbsp;".$First_mojri["family"];
				}
				else
				{
					$mojri_tag="0";
					$First_mojri_name = "اطلاعات موجود نيست";
				}
				$version=$row_fetched["version"];
				//echo "<td   bgcolor=$color align=\"center\" class=\"tahoma1\">".$mystatus."</td>";
				//$hazine_in_version=add_hazineha($cod_tarh , $version);
				$thisver=$row_fetched["version"];
				if(strcmp($thisver,"-1")==0){
					if($la=="en")
						$thisver="Current version";
					else 
						$thisver="ويراست جاري";
					}
				echo "<td>$thisver</td>";
				
				$cod_tarh=$row_fetched["cod_tarh"];
				$version=$row_fetched["version"];
				echo "<td>$cod_tarh</td>";
				
				echo "<td>".$row_fetched["tarh_title_farsi"]."</td>";
				
				if(mysql_num_rows($myresult_mojri) > 0 )
					echo "<td>$First_mojri_name</td>";
					else
				echo "<td>$First_mojri_name</td>";
					
			    echo "<td>$daneshkade</td>";
				
			    echo "<td>";
			    $sum_sayer=$hazine_digar+$hazine_taksir;
			    if($la=="en")
			    	$la="en";
			    else
			    	$la="fa";
			    echo add_hazineha($cod_tarh , $version,$la);
			    echo "</td>";
			    if($la=="en")
			    	$print="Print";
			    else 
			    	$print="پرینت";
			    echo "<td><a target=\"_blank\" href=\"print_tarh.phtml?cod_tarh=$cod_tarh&version=$version\"><i title=\"$print\" class=\"glyphicon glyphicon-print\" ></i></a></td>";
		  		echo "</tr>";
		  		echo "</tbody>";
			}
			echo "</table>";
		}
		else 
		{
			echo".طرح ارسال شده  جديدي يافت نشد";
		}
   }
}
    ?>