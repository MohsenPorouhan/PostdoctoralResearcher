<?
include("include/database-connect.phtml");
include("include/include.phtml");
if(strcmp($marhale,'100')==0)
{
$query="select * from  marhale_report where  marhale='100' and cod_tarh='$cod_tarh'";
$result=mysql_query($query) or die("Error");
if(mysql_num_rows($result) > 0)
{
	$rf=mysql_fetch_array($result);
	$ravesh_ejra=$rf["ravesh_ejra"];
	$natayej=$rf["natayej"];
	$natije_giri=$rf["natije_giri"];
	$pishnahadat=$rf["pishnahadat"];
	$sazmanha=$rf["sazmanha"];
// 	$ravesh_ejra=iconv('utf-8', 'windows-1256', ($ravesh_ejra));
// 	$natayej=iconv('utf-8', 'windows-1256', ($natayej));
// 	$natije_giri=iconv('utf-8', 'windows-1256', ($natije_giri));
// 	$pishnahadat=iconv('utf-8', 'windows-1256', ($pishnahadat));
// 	$sazmanha=iconv('utf-8', 'windows-1256', ($sazmanha));
	$chekide_latin=$rf["chekide_latin"];
	$kalame_1=$rf["kalame_1"];
	$kalame_2=$rf["kalame_2"];
	$kalame_3=$rf["kalame_3"];
	$kalame_4=$rf["kalame_4"];
	$filename_last=$rf["file_name"];
	$yes_no=$rf["yes_no"];
	$form_6=$rf["form_6"];
	$form_7=$rf["form_7"];
}
else
{
	$natayej='';
	$natije_giri='';
	$pishnahadat='';
	$chekide_latin='';
	$kalame_1='';
	$kalame_2='';
	$kalame_3='';
	$kalame_4='';
	$sazmanha='';
	$filename_last="";
	$yes_no="-1";
	$form_6="";
	 
	$form_7="";

}
?>
<div class="panel-group accordion" id="accordion1">
								<div class="panel panel-default">	
									   <div class="panel-heading">
											<h4 class="panel-title">
											<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1_1">
												 چکيده
											</a>
											</h4>
							 			</div>		
										<div id="collapse_1_1" class="panel-collapse in">
											<div class="form-group">
												<label class="control-label col-md-12">روش اجرا</label>
												<div class="col-md-12">
													<p class="form-control-static text-justify">
														<? echo $ravesh_ejra; ?>
													</p>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-12">نتايج</label>
												<div class="col-md-12">
													<p class="form-control-static text-justify">
														<? echo $natayej; ?>
													</p>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-12">نتيجه گيري</label>
												<div class="col-md-12">
													<p class="form-control-static text-justify">
														<? echo $natije_giri; ?>
													</p>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-12">پيشنهادات</label>
												<div class="col-md-12">
													<p class="form-control-static text-justify">
														<? echo $pishnahadat; ?>
													</p>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-12">سازمانهاي استفاده كننده از نتايج</label>
												<div class="col-md-12">
													<p class="form-control-static text-justify">
														<? echo $sazmanha; ?>
													</p>
												</div>
											</div>
										</div>
								</div>
								<div class="panel panel-default">	
								    <div class="panel-heading">
										<h4 class="panel-title">
										<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1_2">
											 چکيده لاتين
										</a>
										</h4>
									</div>		
									<div id="collapse_1_2" class="panel-collapse collapse">
										<div class="form-group">
											<label class="control-label col-md-12">چکيده لاتين</label>
											<div class="col-md-12">
												<p dir="ltr" class="form-control-static text-justify">
													<? echo $chekide_latin; ?>
												</p>
											</div>
										</div>
									</div>
							    </div>
								<div class="panel panel-default">	
								    <div class="panel-heading">
										<h4 class="panel-title">
										<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1_3">
											 کلمات کليدي
										</a>
										</h4>
									</div>		
									<div id="collapse_1_3" class="panel-collapse collapse">
										<div class="form-group">
											<label class="control-label col-md-12">کلمه اول</label>
											<div class="col-md-12">
												<p class="form-control-static text-justify">
													<? echo $kalame_1; ?>
												</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-12">کلمه دوم</label>
											<div class="col-md-12">
												<p class="form-control-static text-justify">
													<? echo $kalame_2; ?>
												</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-12">کلمه سوم</label>
											<div class="col-md-12">
												<p class="form-control-static text-justify">
													<? echo $kalame_3; ?>
												</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-12">کلمه چهارم</label>
											<div class="col-md-12">
												<p class="form-control-static text-justify">
													<? echo $kalame_4; ?>
												</p>
											</div>
										</div>
									 </div>
								</div>
								<div class="panel panel-default">	
								    <div class="panel-heading">
										<h4 class="panel-title">
										<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1_4">
											 فايل ضميمه
										</a>
										</h4>
									</div>		
								<div id="collapse_1_4" class="panel-collapse collapse">
									<div id="view_attachments" class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
												<tr>
													<th class="hidden">id</th>	
													<th>رديف</th>
													<th>نام فايل</th>
												</tr>
												</thead>						
												<tbody>
													
													<?php 
													$query="select * from marhale_report where cod_tarh='$cod_tarh' and marhale='100'";
													 
													$result=mysql_query($query) or die("Error");
														
													
													$mycount=0;
													$dir_name="../reports/".$cod_tarh;
													if ($dir = @opendir($dir_name))
													{
													$mydir = dir($dir_name);
													//while(($file = $mydir->read()) !== false)
													$number_of_row=1;
													while($file = $mydir->read())
													{
														if( !(strcmp(trim($file),".")==0 || strcmp(trim($file),"..")==0 || strcmp(trim($file),"Thumbs.db")==0) && strcmp(substr($file,0,5),'final')==0 )
														{
															$myq="select * from tarh_indoing where cod_tarh='$cod_tarh' and marhale='100' and submitted='1'";
															$res=mysql_query($myq) or die("Error");
															if(mysql_num_rows($res)>0)
																$level_submitted='1';
															else
																$level_submitted='0';
													?>
														<tr>
														<td><?php echo $number_of_row; ?></td>
														<td class="hidden"><?php echo $file;?></td>
														<td><a target="_blank" href="../reports/<?php echo $cod_tarh; ?>/<?php echo $file; ?>"><?php echo $file; ?></a></td>
	
													</tr>
													<?php 
															$number_of_row++;
															}
															
														 }
														closedir($dir);
													}
													?>
													
												</tbody>
											</table>
										</div>
								    </div>
								</div>
								<div class="panel panel-default">	
								    <div class="panel-heading">
										<h4 class="panel-title">
										<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1_5">
											 طرح من واجد شرايط است
										</a>
										</h4>
									</div>		
								<div id="collapse_1_5" class="panel-collapse collapse">
									<div class="form-group">
										<label class="control-label col-md-12">طرح من واجد شرايط است؟</label>
										<div class="col-md-12">
											<p class="form-control-static text-justify">
												<?php 
												if(strcmp($yes_no,"0")==0)
													echo "بلي";
												else if(strcmp($yes_no,"1")==0)
												echo "خير";
												?>
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-default">	
							    <div class="panel-heading">
									<h4 class="panel-title">
									<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1_6">
										 مخاطبان طرح شما چه کساني هستند؟
									</a>
									</h4>
								</div>		
								<div id="collapse_1_6" class="panel-collapse collapse">
									<div class="form-group">
										<label class="control-label col-md-12"> بيماران و مردم</label>
										<div class="col-md-12">
											<p class="form-control-static text-justify" data-display="form6_1">
												<?
												 	 $i='';
													 $sl1="";
													 $i=check_field_value($form_6,"form6_1");
													 echo $i;
												?>
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-12">مخاطبان</label>
										<div class="col-md-12">
											<p class="form-control-static text-justify">
												<?
												 	 $i='';
													 $sl1="";
													 $i=check_field_value($form_6,"form6_9");
													 echo $i;
												?>
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-12"> مديران و سياست‌گذاران</label>
										<div class="col-md-12">
											<p class="form-control-static text-justify">
												<?
												 	 $i='';
													 $sl1="";
													 $i=check_field_value($form_6,"form6_3");
													 echo $i;
												?>
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-12">مخاطبان</label>
										<div class="col-md-12">
											<p class="form-control-static text-justify">
												<?
												 	 $i='';
													 $sl1="";
													 $i=check_field_value($form_6,"form6_10");
													 echo $i;
												?>
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-12">ارايه كنندگان خدمات بهداشتي و درماني شامل دندانپزشكان، پزشكان، داروسازان، پيراپزشكان، پرستاران، ماماها</label>
										<div class="col-md-12">
											<p class="form-control-static text-justify">
												<?
												 	 $i='';
													 $sl1="";
													 $i=check_field_value($form_6,"form6_5");
													 echo $i;
												?>
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-12">مخاطبان</label>
										<div class="col-md-12">
											<p class="form-control-static text-justify">
												<?
												 	 $i='';
													 $sl1="";
													 $i=check_field_value($form_6,"form6_11");
													 echo $i;
												?>
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-12"> ساير مخاطبين مانند مهندسين، كارشناسان و مديران خارج از نظام سلامت (مخاطب خود را دقيقا مشخص کنيد. مثلا "مهندسين صنايع غذايي کارخانجات توليدکننده فرآورده هاي کنسروي")</label>
										<div class="col-md-12">
											<p class="form-control-static text-justify">
												<?
												 	 $i='';
													 $sl1="";
													 $i=check_field_value($form_6,"form6_7");
													 echo $i;
												?>
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-12">مخاطبان</label>
										<div class="col-md-12">
											<p class="form-control-static text-justify">
												<?
												 	 $i='';
													 $sl1="";
													 $i=check_field_value($form_6,"form6_12");
													 echo $i;
												?>
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-12">آيا به غير از انتشار مقاله و يا ارائه نتايج طرح در كنگره ها و سمينارها، و قرار دادن پيام پژوهش در وب سايت راه ديگري براي انتقال نتايج طرح خود در نظر داريد؟</label>
										<div class="col-md-12">
											<p class="form-control-static text-justify" data-display="form6_8">
												<?php 
													$i='';
													$sl1="";
													$i=check_field_value($form_6,"form6_8");
													if(strcmp(trim($i),'"0"')==0)
														echo "بلي";
													if(strcmp(trim($i),'"1"')==0)
														echo "خير";
												?>
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-default">	
							    <div class="panel-heading">
									<h4 class="panel-title">
									<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1_7">
										 نحوه انتشار
									</a>
									</h4>
								</div>		
								<div id="collapse_1_7" class="panel-collapse collapse">
												
									<h5 class="bold">بيماران و مردم:</h5>
									<div class="form-group">
										<label class="control-label col-md-12">گروه مخاطبان</label>
										<div class="col-md-12">
											<p class="form-control-static text-justify">
												<?
												 	 $i='';
													 $sl1="";
												     $i=check_field_value($form_7,"form7_0"); 
												     echo $i; 
												?>
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-12">روش انتشار</label>
										<div class="col-md-12">
											<p class="form-control-static text-justify">
												<?
												 	 $i='';
													 $sl1="";
												     $i=check_field_value($form_7,"form7_1"); 
												     echo $i; 
												?>
											</p>
										</div>
									</div>
									<h5 class="bold">مديران و سياست‌گذاران:</h5>
									<div class="form-group">
										<label class="control-label col-md-12">گروه مخاطبان</label>
										<div class="col-md-12">
											<p class="form-control-static text-justify">
												<?
												 	 $i='';
													 $sl1="";
												     $i=check_field_value($form_7,"form7_2"); 
												     echo $i; 
												?>
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-12">روش انتشار</label>
										<div class="col-md-12">
											<p class="form-control-static text-justify">
												<?
												 	 $i='';
													 $sl1="";
												     $i=check_field_value($form_7,"form7_3"); 
												     echo $i; 
												?>
											</p>
										</div>
									</div>
									<h5 class="bold">ارايه كنندگان خدمات بهداشتي و درماني شامل دندانپزشكان، پزشكان، داروسازان، پيراپزشكان، پرستاران، ماماها:</h5>
									<div class="form-group">
										<label class="control-label col-md-12">گروه مخاطبان</label>
										<div class="col-md-12">
											<p class="form-control-static text-justify">
												<?
												 	 $i='';
													 $sl1="";
												     $i=check_field_value($form_7,"form7_4"); 
												     echo $i; 
												?>
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-12">روش انتشار</label>
										<div class="col-md-12">
											<p class="form-control-static text-justify">
												<?
												 	 $i='';
													 $sl1="";
												     $i=check_field_value($form_7,"form7_5"); 
												     echo $i; 
												?>
											</p>
										</div>
									</div>
									<h5 class="bold">ساير مخاطبين مانند مهندسين، كارشناسان و مديران خارج از نظام سلامت (مخاطب خود را دقيقا مشخص کنيد. مثلا "مهندسين صنايع غذايي کارخانجات توليدکننده فرآورده هاي کنسروي"):</h5>
									<div class="form-group">
										<label class="control-label col-md-12">گروه مخاطبان</label>
										<div class="col-md-12">
											<p class="form-control-static text-justify">
												<?
												 	 $i='';
													 $sl1="";
												     $i=check_field_value($form_7,"form7_6"); 
												     echo $i; 
												?>
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-12">روش انتشار</label>
										<div class="col-md-12">
											<p class="form-control-static text-justify">
												<?
												 	 $i='';
													 $sl1="";
												     $i=check_field_value($form_7,"form7_7"); 
												     echo $i; 
												?>
											</p>
										</div>
									</div>
									<h5 class="bold">هزينه هاي مربوطه:</h5>
									<div class="table-responsive">
										<?php 
										$query="select * from  marhale_report_final_hazine where cod_tarh=\"$cod_tarh\"   ";
										
										$result=mysql_query($query) or die("Error in selecting data from hazine personnel");
										if(mysql_num_rows($result) > 0)
										{
										?>
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>هزينه</th>
														<th>فعاليت</th>
														<th>مبلغ</th>
													</tr>
												</thead>
												<tbody>
											<?php
												$mycount=0;
												$my_summary =0;
												while($row_fetched=mysql_fetch_array($result))
												{
													
													echo "<tr>";
													$id=$row_fetched["id"];
													//       echo "<td align=\"center\" class=\"tahoma1\"><img src=\"image/button_drop.png\" border=0 alt=\"Delete\"></td>";
											
											
													$mablagh_row=$row_fetched["mablagh"];
													$my_summary =$mablagh_row +$my_summary;
													
													echo "<td>".$row_fetched["hazine"]."</td>";
													echo "<td>".$row_fetched["faaliat"]."</td>";
													echo "<td>".number_format($row_fetched["mablagh"])."</td>";
													echo "</tr>";
												}
												echo "</tbody>";
												echo "<tfoot>";
												echo "<tr>";
												echo "<td colspan='2'>مجموع</td>";
												echo "<td>".number_format($my_summary)."</td>";
												echo "</tr>";
										?>
												</tfoot>
											</table>
										<?php } ?>	
								     </div>
								</div>
							</div>		
					 </div>
<?
}
else if(strcmp($marhale,'100')!=0)
{
//  if(isset($action)  and strcmp($action,"report_get")==0)
//  {
//  	$query="update marhale_report set visited='1'  where cod_tarh='$cod_tarh' and marhale='$marhale'";
 	 
//  	$result=mysql_query($query) or die("Error");
//  }
 
   $query="select * from gozaresh_gharardad where cod_tarh='$cod_tarh' ";
   
  $result=mysql_query($query) or die("Error");
   $marhale_cnt=mysql_num_rows($result);
 //echo $marhale_cnt;
  $query="select * from marhale_report where cod_tarh='$cod_tarh' and marhale='$marhale'";
   
  $result=mysql_query($query) or die("Error");
  // $marhale_cnt=mysql_num_rows($result);
     $mycount=0;
    if(mysql_num_rows($result) > 0)
    {?>

      <table class="table table-striped table-bordered table-hover">
	      <thead>
		      <tr>
		      	  <th>توضيحات</th>
		      	  <th>تاريخ ارسال</th>
			      <th>نام فايل</th>  
		      </tr>
	      </thead>
	      <tbody>
				 <?php 
			     while($row_fetched=mysql_fetch_array($result))
			     {
			     	$id=$row_fetched["id"];
			     	$marhale=$row_fetched["marhale"];
			     	
				      echo "<tr>";
			         	 echo "<td>".$row_fetched["comments"]."</td>";
				         echo "<td>".$row_fetched["send_date"]."</td>";
				         echo "<td><a target=\"_blank\" href=\"../reports/$cod_tarh/".$row_fetched["filename"]."\">".$row_fetched["filename"]."</a></td>";
				      echo "</tr>";
			     }?>
     	  </tbody>
      </table>
	 <?php }
	 else 
	 {
	 	echo "<p class='text-center'>موردي يافت نشد</p>";
	 }
	 }
 ?>




