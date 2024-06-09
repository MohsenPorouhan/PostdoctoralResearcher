<?
include("include/database-connect.phtml");
include("include/include.phtml");

  

header_forms($admin,$seed);

?>
<style>
.rezayat_form2{
display:none;
}
</style>
<?php
include("include/new_menu.php");
?>
<style>
.
</style>
 <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content">
                <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">Modal title</h4>
                            </div>
                            <div class="modal-body">
                            <h3>مجري محترم</h3>
                            <p>در تنظيم فرم رضايت آگاهانه پژوهش خود به نکات کلي ذيل توجه کنيد</p>	
                            <p>1)فرم رضايت آگاهانه بايد منطبق با اطلاعات مربوط به پژوهش و به زبان غير تخصصي و قابل فهم براي سواد حدود پنجم ابتدايي تنظيم شود</p>
							<p>2) شما در تنظيم فرم ميتوانيد براي مفهوم تر و روانتر شدن متن، جملات از پيش نوشته شده اين فرم را تغيير دهيد اما روال منطقي ارائه اطلاعات به همين ترتيبي است که در بند هاي اين فرم برايتان آورده شده است.</p>
							<p>3) در خصوص تک تک بند ها به توضيحاتي که به صورت کامنت براي تنظيم بهتر آورده شده است توجه کنيد.</p>
							<p>4) توصيه ميشود فرم را پس از تنظيم و قبل از ارسال ، به چند نفر ازمردم معمولي بدهيد تا مفهوم بودن محتواي آن را بررسي کنند و اصلاحات لازم براي بهبود متن را اعمال نماييد.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn blue">Save changes</button>
                                <button type="button" class="btn default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                
                <!-- BEGIN PAGE HEADER-->
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                        <h3 class="page-title">
                            <small>جزئيات اين فرم / صفحه</small>
                            عنوان صفحه
                        </h3>
                        <ul class="page-breadcrumb breadcrumb">

                            <li>
                                <i class="fa fa-home"></i>
                                <a href="index.html">
                                    خانه
                                </a>
                                <i class="fa fa-angle-left"></i>
                            </li>
                            <li>
                                <a href="#">
                                    فرم ها
                                </a>
                                <i class="fa fa-angle-left"></i>
                            </li>
                            <li>
                                <a href="#">
                                    فرم پژوهشيار
                                </a>
                            </li>
                        </ul>
                        <!-- END PAGE TITLE & BREADCRUMB-->
                    </div>
                </div>
                <!-- END PAGE HEADER-->
               <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box grey">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-magic"></i>ويزارد
                                </div>
                                <div class="actions">
                                    <a href="#" class="btn green">
                                        قبلي
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                    <a href="#" class="btn green">
                                        <i class="fa fa-arrow-left"></i> بعدي
                                    </a>
                                </div>
                               
                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                
                                    <?php 
                                    $active_id="16";
                                    include("include/wizard.php");?>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                    
                                 <div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-reorder"></i>  فرم رضايت نامه
										</div>
										<div class="tools">
											<a href="javascript:;" class="collapse">
											</a>
											<a href="#portlet-config" data-toggle="modal" class="config">
											</a>
											<a href="javascript:;" class="reload">
											</a>
											<a href="javascript:;" class="remove">
											</a>
										</div>
									</div>
									<div class="portlet-body form">  
                                  <!-- BEGIN FORM-->
										
                                   
                                    
                                   <? echo "<form  method=\"post\" action=\"rezayatname_add.php?action=sabt&admin=$admin&seed=$seed&cod_tarh=$cod_tarh\" class=\"form-horizontal rezayat_form\">"; ?>
                                       
									
							              <div class="form-body">
	                                        <div class="form-group">
                                            <label class="col-md-5 control-label">آيا پژوهش شما نياز به تکميل فرم رضايت نامه دارد يا خير؟</label>
		                                           <div id="a0" class="radio-list">
		                                            <label class="radio-inline">
		                                                 <input type="radio" name="a0" value="1">بلي</label>
		                                             
														 <label class="radio-inline">
		                                                 <input type="radio" name="a0" value="0" >خير</label>                          	
		                                            </div>
                                            </div>
											</div>
											<div class="form-actions fluid">
												<div class="col-md-offset-3 col-md-9">
													<button id="rezayatname_btn" type="submit" class="btn blue">ذخيره</button>
													<button type="button" class="btn default">انصراف</button>
												</div>
											</div>
								   </form>
								   <form action="" method="post" class="form-horizontal rezayat_form2">
							         <div class="form-body">
							           <div class="form-group">
										<label class="col-md-12" style="text-align: right;">با توجه به پاسخ شما به سوال فوق چه کسي فرم رضايت نامه را تکميل مي نمايد؟</label>
										<div id="rezayatname_type" class="col-md-9 radio-list">
											<label>
											<input type="radio" name="rezayatname_type" value="1">سوژه پژوهش</label>
											<label>
											<input type="radio" name="rezayatname_type" value="2">تصميم گيرنده جايگزين(ولي/وکيل قانوني/قيم و ...)</label>
											<label>
											<input type="radio" name="rezayatname_type" value="3">هر دو</label>
										</div>
										</div>
										<div id="rezayatname_label" class="col-md-offset-0">
										<div class="row">
											<div class="col-md-6 ">
	                                            <label>1.من مي دانم که اهداف اين پژوهش عبارتند از:</label>
	                                            <textarea class="form-control" rows="3"></textarea>
	                                        </div>
	                                     </div>
	                                    <div class="row">
	                                        <div class="col-md-12">
	                                            <label>2.من مي دانم شرکت من در اين پژوهش کاملا داوطلبانه است و مجبور به شرکت در اين پژوهش نيستم
                                                       به من اطمينان داده شد که اگر حاضر به شرکت در اين پژوهش نباشم، از مراقبت هاي معمول تشخيصي و درماني محروم نخواهم شد و رابطه درماني من بامرکز درماني و پرشک معالج دچار اشکال نشود </label>
	                                        </div>
	                                    </div>
	                                     <div class="row">
	                                        <div class="col-md-12">
	                                            <label>3.من مي دانم که حتي پس از موافقت با شرکت در پژوهش مي توانم هر وقت که بخواهم، پس از اطلاع به مجري، از پژوهش خارج شوم و خروج من از پژوهش باعث محروميت از دريافت خدمات درماني معمول براي من نخواهد شد.</label>
	                                        </div>
	                                     </div>
	                                     <div class="row">
	                                        <div class="col-md-6">
	                                            <label>4.نحوه ي همکاري اينجانب در اين پژوهش به اين صورت است:</label>
	                                            <textarea class="form-control" rows="3"></textarea>
	                                        </div>
	                                      </div>
	                                       <div class="row">
	                                        <div class="col-md-6">
	                                            <label>5.منافع احتمالي شرکت اينجانب در اين پژوهش به شرح زير است:</label>
	                                            <textarea class="form-control" rows="3"></textarea>
	                                        </div>
	                                      </div>
	                                     <div class="row">
	                                        <div class="col-md-6">
	                                            <label>6.آسيب ها و عوارض احتمالي شرکت در اين پژوهش به اين شرح است:</label>
	                                            <textarea class="form-control" rows="3"></textarea>
	                                        </div>
	                                      </div>
	                                      <div class="row">
	                                        <div class="col-md-6">
	                                            <label>7.در صورت عدم تمايل به شرکت در پژوهش خدمات معمول (درماني، تشخيصي و ...) براي من ارائه خواهد شد که منافع و عوارض آن به اين شرح است:</label>
	                                            <textarea class="form-control" rows="3"></textarea>
	                                        </div>
	                                      </div>
	                                      <div class="row">
	                                        <div class="col-md-12">
	                                            <label>8.من مي دانم که دست اندرکاران اين پژوهش، کليه اطلاعات مربوط به من را نزد خود به صورت محرمانه نگه داشته و فقط اجازه دارند نتايج کلي و گروهي اين پژوهش را بدون ذکر نام و مشخصات اينجانب منتشر کنند.</label>
	                                        </div>
	                                      </div>
	                                       <div class="row">
	                                        <div class="col-md-12">
	                                            <label>9.مي دانم که کميته اخلاق در پژوهش با هدف نظارت بر رعايت حقوق اينجانب مي تواند به اطلاعات من دسترسي داشته باشيد</label>
	                                        </div>
	                                      </div>
	                                      <div class="row">
	                                        <div class="col-md-6">
	                                            <label>10.من مي دانم که هيچ يک از هزينه هاي انجام اقدامات پژوهشي به شرح ذيل بر عهده من نخواهد بود.</label>
	                                            <textarea class="form-control" rows="3"></textarea>
	                                        </div>
	                                      </div>
	                                      <div class="row">
	                                        <div class="col-md-6">
	                                            <label>آدرس و شماره تلفن ثابت و همراه ايشان به شرح زير به من ارائه شد.:</label>
	                                        </div>
	                                      </div>
	                                      <div class="row">
	                                        <div class="col-md-6">
	                                            <label>آدرس:</label>
	                                            <textarea class="form-control" rows="3"></textarea>
	                                        </div>
	                                      </div>
	                                      <div class="row">
	                                        <div class="col-md-6">
	                                            <label>تلفن ثابت :</label>
	                                            <textarea class="form-control" rows="3"></textarea>
	                                        </div>
	                                      </div>
	                                      <div class="row">
	                                        <div class="col-md-6">
	                                            <label>تلفن همراه:</label>
	                                            <textarea class="form-control" rows="3"></textarea>
	                                        </div>
	                                      </div>
	                                      <div class="row">
	                                        <div class="col-md-12">
	                                            <label>12.من مي دانم که اگر در حين و بعد از انجام پژوهش هر مشکلي اعم از جسمي و روحي به علت شرکت در اين پژوهش براي من پيش آمد درمان عوارض آن و غرامت مربوطه بر عهده مجري خواهد بود.</label>
	                                        </div>
	                                      </div>
	                                      <div class="row">
	                                        <div class="col-md-12">
	                                            <label>13.من مي دانم اگر اشکال يا اعتراضي نسبت به دست اندرکاران يا روند پژوهش دارم ميتوانم با کميته اخلاق در پژوهش دانشگاه علوم پزشکي تهران به آدرس : تهران، تقاطع بلوار کشاورز و خيابان قدس، ساختمان ستاد مرکزي دانشگاه علوم پزشکي تهران، طبقه ششم، اتاق 605 تماس گرفته و مشکل خود را به صورت شفاهي يا کتبي مطرح نماييم.</label>
	                                        </div>
	                                      </div>
	                                      <div class="row">
	                                        <div class="col-md-12">
	                                            <label>14.اين فرم اطلاعات و رضايت آگاهانه در دو نسخه تهيه شده و پس از امضا يک نسخه در اختيار من و نسخه ديگر در اختيار مجري قرار خواهد گرفت.</label>
	                                        </div>
	                                      </div>
	                                      </div>
	                                     </div>
											
											<div class="form-actions fluid">
												<div class="col-md-offset-3 col-md-9">
													<button type="submit" class="btn blue">ذخيره</button>
													<button type="button" class="btn default">انصراف</button>
												</div>
											</div>
								   </form>
										<!-- END FORM-->
								  </div>
								</div>
                                    </div>

                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>
                <!-- END PAGE CONTENT-->
</div>
</div>
<!-- END CONTENT -->



<?php 
include("../include/primary_js.phtml");
?>

<?php
footer_forms($admin,$seed);
?>
 <!--   <script src="assets/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>-->
 <!--   <script src="assets/scripts/custom/login-soft.js" type="text/javascript"></script>-->
  <script type="text/javascript">

  jQuery('.rezayat_form').submit(function (e) {
	    var postData = $(this).serializeArray();	
		var	formURL = $(this).attr("action");
	    var a0=$("#a0 input:checked").val();
		if(a0=="1"){
			  jQuery('.rezayat_form').hide();
		      jQuery('.rezayat_form2').show();
		      }
		if(a0=="0"){
			  //jQuery('.rezayat_form').show();
		      //jQuery('.rezayat_form2').hide();
		      window.location.href="<? echo "sabt_tarh_second.phtml?admin=$admin&seed=$seed&cod_tarh=$cod_tarh ";?>";
		      }
      $.ajax(
				{
					url : formURL,
					type: "POST",
					data : postData,
					success:function(data, textStatus, jqXHR) 
					{
						alert(data);
					},
					error: function(jqXHR, textStatus, errorThrown) 
					{
						alert("error");
					}
				});
      e.preventDefault();
  });


  $(document).ready(function(){
	  $("#rezayatname_label").css("visibility", "hidden");
	  $("#rezayatname_type input")
	  .change(function () {
		  var value = "";
		  $("#rezayatname_type input:checked").each(function () {
			  value=$(this).val();
			  switch (value) {
              case "1": $("#nothing").css("visibility", "visible").slideDown();
                  $("#p2").css("visibility", "hidden").fadeOut().slideUp();
                  break;
              case "2": $("#rezayatname_label").css("visibility", "visible").slideUp();
                  $("#p1").css("visibility", "hidden").slideUp();
                  break;
              case "3": $("#rezayatname_label").css("visibility", "visible").slideDown();
              $("#p1").css("visibility", "hidden").slideUp();
              break;
              default:

          }
          });
	     

	  });
});

  </script>
