<?
include("include/database-connect.phtml");
include("include/include.phtml");
include("include/vars.inc.phtml");

header_forms();
?>


<!-- BEGIN PAGE LEVEL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="../assets/plugins/select2/select2-rtl.css"/>
    <link id="select2-metronic" rel="stylesheet" type="text/css" href="../assets/plugins/select2/select2-metronic-rtl.css"/>
    
    <link id="DT_bootstrap" rel="stylesheet" href="../assets/plugins/data-tables/DT_bootstrap_rtl.css"/>

    <link href="../assets/advanced-datatable/extensions/TableTools/css/dataTables.colVis.css" rel="stylesheet" />
    <link href="../assets/advanced-datatable/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />
    <link href="../assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
<!-- END PAGE LEVEL STYLES -->
    
    <!--First of test with previous css  -->
    <!-- <link href="../assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" /> -->
      
    <!-- End of test with previous css -->
    <!-- END PAGE LEVEL STYLES -->
<?php
$menu_id="1";
$sub_menu_id="-1";
include("include/new_menu.php");
?>

 <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content"> 
                
                <!-- BEGIN PAGE HEADER-->
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                        <h4 id="page-title" class="page-title">
                            
                           
                        </h4>
                        <ul class="page-breadcrumb breadcrumb">

                            <li>
                                <i class="fa fa-home"></i>
                                <a id="navigator-home" href="home.php">
                                    خانه
                                </a>
                             
                            </li>
                            
                        </ul>
                        <!-- END PAGE TITLE & BREADCRUMB-->
                    </div>
                </div>
                <!-- END PAGE HEADER-->
                <!-- BEGIN PAGE CONTENT-->
                <div class="row">
                    <div class="col-md-12">
									<div class="col-md-6 col-sm-12">
										<div class="portlet box blue" style="margin-top:66px;">
											<div class="portlet-title">
												<div id="portlet_caption" class="caption">
													<i class="fa fa-reorder"></i>دسترسی سریع
												</div>
												<div class="tools">
													<a href="javascript:;" class="collapse">
													</a>
													
												</div>
											</div>
											<div class="portlet-body">
											<?php 
												$query="select * from tarh where creator='$admin' and version='-1' and is_tarh='1'";
												$result=mysql_query($query) or die("error in select");
												$your_tarh_count=mysql_num_rows($result);
											?>
												<a href="tarh_list.phtml" class="icon-btn">
													<i class="fa fa-tags"></i>
													<div id="quick1">
														 طرح های شما
													</div>
													<span class="badge badge-success">
														 <?php echo $your_tarh_count;?>
													</span>
												</a>
												<?php 
											if(isset($cod_karshenas))
                    						{
												$query="select * from karshenasan_tarh where cod_karshenas='$cod_karshenas' and karshenasi_type='1' and finished='0' group by cod_tarh";
												$result=mysql_query($query) or die("error in select");
												$karshenasi_tarh_count=mysql_num_rows($result);
											?>
												<a  href="tarh_list_davari.phtml?position=1" class="icon-btn">
													<i class="fa fa-comments-o"></i>
													<div id="quick2">
														 طرح های در دست داوری
													</div>
													<span class="badge badge-important">
														 <?php echo $karshenasi_tarh_count;?>
													</span>
												</a>
												<?php 
												$query="select * from karshenasan_tarh where cod_karshenas='$cod_karshenas' and karshenasi_type='1' and finished='1' and tarh_new='0' group by cod_tarh";
												$result=mysql_query($query) or die("error in select");
												$karshenasi_shode_tarh_count=mysql_num_rows($result);
											?>
												<a href="tarh_list_davari.phtml?position=2" class="icon-btn">
													<i class="fa fa-comments"></i>
													<div id="quick3">
														 طرح های داوری شده
													</div>
													<span class="badge badge-success">
														 <?php echo $karshenasi_shode_tarh_count;?>
													</span>
												</a>
												<?php 
												$query="select * from karshenasan_tarh where cod_karshenas='$cod_karshenas' and karshenasi_type='2' and finished='0' group by cod_tarh";
												$result=mysql_query($query) or die("error in select");
												$nezarat_tarh_count=mysql_num_rows($result);
											?>
												<a href="tarh_list_nezarat.phtml?position=1" class="icon-btn">
													<i class="fa fa-thumbs-o-up"></i>
													<div id="quick4">
														 طرح های در دست نظارت
													</div>
													<span class="badge badge-important">
														 <?php echo $nezarat_tarh_count;?>
													</span>
												</a>
												<?php 
												$query="select * from karshenasan_tarh where cod_karshenas='$cod_karshenas' and karshenasi_type='2' and finished='1' group by cod_tarh";
												$result=mysql_query($query) or die("error in select");
												$nezarat_shode_tarh_count=mysql_num_rows($result);
											?>
												<a href="tarh_list_nezarat.phtml?position=2" class="icon-btn">
													<i class="fa fa-thumbs-up"></i>
													<div id="quick5">
														 طرح های نظارت شده
													</div>
													<span class="badge badge-success">
														 <?php echo $nezarat_shode_tarh_count;?>
													</span>
												</a>
												<?php 
												$query="select * from tarh where (first_ostad='$admin' or first_ostad_moshaver='$admin' or second_ostad='$admin' or second_ostad_moshaver='$admin')  and payannameh='1' and version='-1'";
												$result=mysql_query($query) or die("error in select");
												$nezarat_shode_tarh_count=mysql_num_rows($result);
											?>
												<a href="ostad_payan_name.phtml?position=2" class="icon-btn">
													<i class="fa fa-thumbs-up"></i>
													<div id="quick6">
														پایان نامه های دانشجویان شما
													</div>
													<span class="badge badge-success">
														 <?php echo $nezarat_shode_tarh_count;?>
													</span>
												</a>
												<?php 
                    						}
												$query="select * from letter_to_mojri where to_letter='$admin' and admin_confirm='1'";
												$result=mysql_query($query) or die("error in select");
												$letter_count=mysql_num_rows($result);
												
											?>
												<a href="letter_list.phtml" class="icon-btn">
													<i class="fa fa-envelope"></i>
													<div id="quick7">
														 مکاتبات 
													</div>
													<span class="badge badge-info">
														 <?php echo $letter_count;?>
													</span>
												</a>
												<?php 
												$query="select mobile from user_login where email='$admin'";
												$result=mysql_query($query);
												$row_fetch=mysql_fetch_array($result);
												$mobile=$row_fetch["mobile"];
												$query="select * from magfa_sms where reciption_number='$mobile'";
												$result=mysql_query($query) or die("error in select");
												$sms_count=mysql_num_rows($result);
											?>
												<a href="sms_list.phtml" class="icon-btn">
													<i class="fa fa-mobile"></i>
													<div id="quick8">
														 پیامک ها
													</div>
													<span class="badge badge-info">
														 <?php echo $sms_count;?>
													</span>
												</a>
												<a href="#" class="icon-btn">
													<i class="fa fa-warning"></i>
													<div id="quick9">
														 رویدادها
													</div>
													<span class="badge badge-warning">
														 0
													</span>
												</a>
												
												
											</div>
										</div>
										<div class="portlet">
											<div class="portlet-title line">
												<div id="information" class="caption">
													<i class="fa fa-info"></i>اطلاع رسانی
												</div>
												<div class="tools">
													<a href="" class="collapse">
													</a>
												</div>
											</div>
											<?php 
												$query="select * from  informatics where mojrian='1' order by id desc";
												$result=mysql_query($query) or die("Error in selecting data from hazine safar");
											?>
											<div class="portlet-body" id="chats">
												
												<div class="scroller" style="height: 250px; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="1">
													<ul class="chats">
													<?php 
														while($row_fetched=mysql_fetch_array($result))
     													{
													?>
														<li class="in">
															<div class="message">
																<span class="arrow">
																</span>
																<span class="body">
																	 <?php echo $row_fetched["message"];?>
																</span>
																<span class="body">
																	<?php $id=$row_fetched["id"];
															        $dir_name="../informatics/".$id;
															       if ($dir = @opendir($dir_name))
															       {
															      
															
															      
															        $mydir = dir($dir_name);
															         
															        while($file = $mydir->read())
															        {
																      if( !(strcmp(trim($file),".")==0 || strcmp(trim($file),"..")==0  || strcmp(trim($file),"Thumbs.db")==0) )
																      {
															         
															            echo "<a target=\"_blank\" href=\"../informatics/$id/$file\"><b>".$file."</b></a>";
															         
																      }
															        }
															        closedir($dir);
															          
																    }
																    else
																      echo "بدون فایل همراه";
																      ?>
																</span>
															</div>
														</li>
														<?php 
     													}
														?>
													</ul>
												</div>
							
												
												
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div id="calendar" class="has-toolbar"></div>
									</div>
							</div>
					</div>
					<div class="row">
                    	<div class="col-md-12">
									<div class="col-md-12 col-sm-12">
										<!-- BEGIN PORTLET-->
										
										<!-- END PORTLET-->
									</div>
									
					</div>
				</div>
<!-- END PAGE CONTENT-->
		</div>
	</div>
<!-- END CONTENT -->

<script>
if(language=="en"){																										    
	debugger;
	document.getElementById("page-title").innerHTML="<i class='fa fa-envelope'></i> SMS list<?php echo "(".$mobile.")";?>";
	document.getElementById("navigator-home").textContent="Home";
	document.getElementById("portlet_caption").innerHTML="<i class='fa fa-reorder'></i></i>Quick access";
	document.getElementById("quick1").textContent="Your projects";
<?php
if(isset($cod_karshenas))
{
?>
		document.getElementById("quick6").textContent="Your theses";
<?php } ?>
	document.getElementById("quick7").textContent="Letters";
	document.getElementById("quick8").textContent="SMS";
	document.getElementById("quick9").textContent="Events";
	document.getElementById("information").innerHTML="<i class='fa fa-info'></i>information";
	document.getElementById("DT_bootstrap").href="../assets/plugins/data-tables/DT_bootstrap.css";
	document.getElementById("select2-metronic").href="../assets/plugins/select2/select2-metronic.css";
	}
</script>



<?php 
include("../include/primary_js.phtml");
?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="../assets/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" language="javascript" src="../assets/advanced-datatable/media2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/data-tables/DT_bootstrap.js"></script> 
	<script type="text/javascript" language="javascript" src="../assets/advanced-datatable/extensions/TableTools/js/dataTables.colVis.js"></script>
	<script type="text/javascript" language="javascript" src="../assets/advanced-datatable/extensions/TableTools/js/dataTables.tableTools.js"></script>
	<script src="../assets/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/bootstrap-toastr/toastr.min.js"></script>
    <script src="../assets/plugins/fullcalendar/fullcalendar/fullcalendar1.js"></script>
	<script src="../assets/plugins/fullcalendar/fullcalendar/jalali.js"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <!--<script src="../assets/scripts/core/app.js"></script>-->
    <!--<script src="../assets/scripts/custom/table-advanced.js"></script>-->
    <!-- END PAGE LEVEL SCRIPTS -->

    <script>

    $(document).ready(function() {
    	
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			start: '2014-01-01',
			end: '2014-12-29',
			defaultDate: '2014-09-12',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: {
				url: 'calendar_serverSide/get-events.php',
				error: function() {
					$('#script-warning').show();
				}
			},
			loading: function(bool) {
				$('#loading').toggle(bool);
			}
		});
		
	});
    </script>
	
<?php
footer_forms($admin,$seed);
?>

