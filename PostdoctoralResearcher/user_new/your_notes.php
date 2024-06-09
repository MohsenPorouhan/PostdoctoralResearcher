<?
include("include/database-connect.phtml");
include("include/include.phtml");

if(strcmp($karshenasi_type,"1")==0)
{
      $query="select * from karshenasan_tarh_note where cod_tarh='$cod_tarh' and cod_karshenas='$cod_karshenas' and karshenasi_type='$karshenasi_type'";
      $result=mysql_query($query) or die("Error in selecting data from group_karshenasan_tarh");
      
      $query1="select * from karshenasan_tarh where cod_tarh='$cod_tarh' and cod_karshenas='$cod_karshenas' and karshenasi_type='$karshenasi_type'";
      $result1=mysql_query($query1) or die("Error in selecting data from group_karshenasan_tarh");
      
      if(mysql_num_rows($result) > 0 || mysql_num_rows($result1) > 1)
	  {
	  	?>
	  		<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="sample_1">
                                    <thead>
                                        <tr>
                                            <th>
                                                رديف
                                            </th>
                                            <th>
                                                 تاريخ نظر دهي
                                            </th>
                                            <th>
                                                نظر شما
                                            </th>
                                        </tr>
                                    </thead>
                                   <tbody>
                                   <?
                                   $cnt=0;
                                   while($row_fetched=mysql_fetch_array($result))
 								   {
 								      $note_date=$row_fetched["note_date"];
 								      $startdate =$note_date;
								      $startyear = substr($startdate,0,4);
								      $startmon = substr($startdate,5,2);
								      $startday = substr($startdate,8,2);
								      $send_date=hijricalender( $startyear , $startmon , $startday );
								      $comment_karshenas=$row_fetched["comment_karshenas"];
								      //$comment_karshenas= iconv('windows-1256', 'utf-8', $comment_karshenas);
 								   	  $cnt++;
 								   	?>
 								   	<tr>
                                            <th>
                                                <? echo $cnt;?>
                                            </th>
                                            <th>
                                                 <? echo $send_date;?>
                                            </th>
                                            <th>
                                                <? echo $comment_karshenas;?>
                                            </th>
                                        </tr>
 								  <?
								   }
	  							   while($row_fetched=mysql_fetch_array($result1))
 								   {
 								      $note_date=$row_fetched["note_date"];
 								      $startdate =$note_date;
								      $startyear = substr($startdate,0,4);
								      $startmon = substr($startdate,5,2);
								      $startday = substr($startdate,8,2);
								      $send_date=hijricalender( $startyear , $startmon , $startday );
								      $comment_karshenas=$row_fetched["comment_karshenas"];
								      //$comment_karshenas= iconv('windows-1256', 'utf-8', $comment_karshenas);
 								   	  
 								   	  if(strlen($comment_karshenas)>0)
 								   	  {
 								   	  	$cnt++;
	 								   	?>
	 								   	<tr>
	                                            <th>
	                                                <? echo $cnt;?>
	                                            </th>
	                                            <th>
	                                                 <? echo $send_date;?>
	                                            </th>
	                                            <th>
	                                                <? echo $comment_karshenas;?>
	                                            </th>
	                                        </tr>
	 								  <?
 								   	  }
								   }
                                   ?>
                                   </tbody>
                                </table>
                                </div>
	  	<?
	  }
	  else 
	  	echo "نظري وجود ندارد";
    
}
else if(strcmp($karshenasi_type,"2")==0)
{?>

		<!-- BEGIN FORM-->
		<form class="form-horizontal" role="form">
			<div class="form-body">
			<?php
			$query="select * from karshenasan_tarh_note where cod_tarh = '$cod_tarh' and cod_karshenas='$cod_karshenas' and karshenasi_type='2'";
			//echo $query;
			$result=mysql_query($query) or die("Error in selecting data from karshenasan_tarh_note");
			if(mysql_num_rows($result) > 0)
			{
				$row_fetched=mysql_fetch_array($result);
				
				$ravesh_motalee=$row_fetched["ravesh_motalee"];
				$comment_ravesh_motalee=$row_fetched["comment_ravesh_motalee"];
				$zamanbandi=$row_fetched["zamanbandi"];
				$comment_pishraft=$row_fetched["comment_pishraft"];
				$nazer_hajm_nemone=$row_fetched["nazer_hajm_nemone"];
				$nazer_hajm_nemone_comment=$row_fetched["nazer_hajm_nemone_comment"];
				$nazer_submit_mali=$row_fetched["nazer_submit_mali"];
				$nazer_submit_mali_comment=$row_fetched["nazer_submit_mali_comment"];
				$nazer_amval_masrafi=$row_fetched["nazer_amval_masrafi"];
				$form_pardakht=$row_fetched["form_pardakht"];
				$notes=$row_fetched["comment_karshenas"];
				$admin_notes=$row_fetched["admin_notes"];
			?>
				<h3 class="form-section"></h3>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-8 bold">انطباق روش مطالعه با پروپوزال:</label>
							<div class="col-md-4">
								<p class="form-control-static">
									 <?php 
									 
									 if($ravesh_motalee==0) 
							 			echo"بوده است";
									 else if($ravesh_motalee==1)
									 	echo"تا حدودي بوده است";
									 else if($ravesh_motalee==2)
									 	echo"نبوده است";
									 
									 ?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-8 bold">توضيحات:</label>
							<div class="col-md-4">
								<p class="form-control-static">
									 <?php 
									 //$comment_ravesh_motalee=iconv('windows-1256', 'utf-8', ($comment_ravesh_motalee));
									 echo $comment_ravesh_motalee;
									 ?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<!--/row-->
				<h3 class="form-section"></h3>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-8 bold">انطباق پيشرفت کار با جدول گانت:</label>
							<div class="col-md-4">
								<p class="form-control-static">
									 <?php 
									 
									 if($zamanbandi==0) 
							 			echo"بوده است";
									 else if($zamanbandi==1)
									 	echo"تا حدودي بوده است";
									 else if($zamanbandi==2)
									 	echo"نبوده است";
									 
									 ?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-8 bold">توضيحات:</label>
							<div class="col-md-4">
								<p class="form-control-static">
									 <?php echo $comment_pishraft; ?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<!--/row-->
				<h3 class="form-section"></h3>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-8 bold">آيا مجري به حجم نمونه رسيه است؟ </label>
							<div class="col-md-4">
								<p class="form-control-static">
									 <?php 
									 if($nazer_hajm_nemone==0) 
							 			echo"خير";
									 else if($nazer_hajm_nemone==1)
									 	echo"بلي";
									 ?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-8 bold">توضيحات:</label>
							<div class="col-md-4">
								<p class="form-control-static">
									 <?php echo $nazer_hajm_nemone_comment; ?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<!--/row-->
				<h3 class="form-section"></h3>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-8 bold">آيا گزارش از نظر مالي مورد تاييد است؟</label>
							<div class="col-md-4">
								<p class="form-control-static">
									 <?php 
									 if($nazer_submit_mali==0) 
							 			echo"خير";
									 else if($nazer_submit_mali==1)
									 	echo"بلي";
									 ?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-8 bold">توضيحات:</label>
							<div class="col-md-4">
								<p class="form-control-static">
									 <?php echo $nazer_submit_mali_comment; ?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<!--/row-->
				<h3 class="form-section"></h3>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-8 bold">آيا شرايط خاص در قرارداد مشابه اموال مصرفي اجرا شده است؟</label>
							<div class="col-md-4">
								<p class="form-control-static">
									 <?php 
									 
									 if($nazer_amval_masrafi==0) 
							 			echo"خير";
									 else if($nazer_amval_masrafi==1)
									 	echo"بلي";
									 else if($nazer_amval_masrafi==2)
									 	echo"شرط خاص نداشته است";
									 ?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<h3 class="form-section"></h3>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-8 bold">بر اساس بندهاي فوق اين گزارش:</label>
							<div class="col-md-4">
								<p class="form-control-static">
									 <?php 
									 if($form_pardakht==0) 
							 			echo"مورد تاييد است";
									 else if($form_pardakht==1)
									 	echo"با انحام اصلاحاتي در همين گزارش مورد تاييد است";
									 else if($form_pardakht==2)
									 	echo"مورد تاييد است ولي لازم است در گزارشات بعدي لحاظ شود";
									 else if($form_pardakht==3)
									 	echo"به دلايل زير مورد تاييد نمي باشد";
									 ?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<h3 class="form-section"></h3>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-8 bold">نظر شما در مورد اين مرحله از گزارش:</label>
							<div class="col-md-4">
								<p class="form-control-static">
									 <?php echo $notes; ?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<h3 class="form-section"></h3>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-8 bold">اطلاعاتي كه لازم است به مديريت امور پژوهش انتقال يابد:</label>
							<div class="col-md-4">
								<p class="form-control-static">
									 <?php echo $admin_notes; ?>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		<!-- END FORM-->

<?}
else
	echo "نظري وجود ندارد";
}?>
