        <!-- BEGIN SIDEBAR -->
        <?php
        $home_selected="";
        $tarh_selected="";
        $davari_nezarat_selected="";
        $ozve_shora_selected="";
        $maghalat_selected="";
        $cv_selected="";
        $home_selected_li_class="class='start'";
        $tarh_selected_li_class="";
        $davari_nezarat_selected_li_class="";
        $ozve_shora_selected_li_class="";
        $maghalat_selected_li_class="";
        $cv_selected_li_class="";
         switch ($menu_id)
		 {
		  case "1":
		    $home_selected="<span class='selected'></span>";
		    $home_selected_li_class="class='start active'";
		    break;
		  case "2":
		    $tarh_selected="<span class='selected'></span>";
		    $tarh_selected_li_class="class='active'";
		    break;
		  case "3":
		    $davari_nezarat_selected="<span class='selected'></span>";
		    $davari_nezarat_selected_li_class="class='active'";
		    break;
		  case "4":
		    $ozve_shora_selected="<span class='selected'></span>";
		    $ozve_shora_selected_li_class="class='active'";
		    break;
		  case "5":
		    $maghalat_selected="<span class='selected'></span>";
		    $maghalat_selected_li_class="class='active'";
		    break;
		  case "6":
		    $cv_selected="<span class='selected'></span>";
		    $cv_selected_li_class="class='active'";
		    break;
		  
		} 
		$send_tarh_selected_li_class="";
		$tarh_list_li_class="";
		$ostad_payanname_li_class="";
        switch ($sub_menu_id)
		  {
		  case "1":
		    $send_tarh_selected_li_class="class='active'";
		    break;
		  case "2":
		    $tarh_list_li_class="class='active'";
		    break;
		  case "3":
		    $ostad_payanname_li_class="class='active'";
		    break;
		  case "4":
		    $davari_li_class="class='active'";
		    break;
		  case "5":
		    $nezarat_li_class="class='active'";
		    break;
		  case "6":
		    $shora_li_class="class='active'";
		    break;
		}

        if(strcmp($la,"en")==0)
        {
	        if(isset($cod_karshenas))
	        {
	        	$query="select * from karshenasan_tarh where cod_karshenas='$cod_karshenas' and tarh_new='1' and karshenasi_type='1'";
	        	$result=mysql_query($query) or die("error");
	        	if(mysql_num_rows($result)>0)
	        	{
	        		$new_davari_item="<span class='badge badge-roundless badge-success'>NEW"." (".mysql_num_rows($result).")</span>";
	        	}
	        	$query="select * from karshenasan_tarh where cod_karshenas='$cod_karshenas' and tarh_new='1' and karshenasi_type='2'";
	        	$result=mysql_query($query) or die("error");
	        	if(mysql_num_rows($result)>0)
	        	{
	        		$new_nezarat_item="<span class='badge  badge-roundless badge-success'>NEW"." (".mysql_num_rows($result).")</span>";
	        	}
	        }
        ?>
                <div class="page-sidebar-wrapper">
            <div class="page-sidebar navbar-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->
                <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
                    <li class="sidebar-toggler-wrapper">
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                        <div class="sidebar-toggler hidden-phone">
                        </div>
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    </li>
                    <li class="sidebar-search-wrapper">
                        <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                        <form class="sidebar-search" action="extra_search.html" method="POST">
                            <div class="form-container">
                                <div class="input-box">
                                    <a href="javascript:;" class="remove">
                                    </a>
                                   <!--  <input type="text" placeholder="جستجو..." />
                                    <input type="button" class="submit" value=" " /> -->
                                </div>
                            </div>
                        </form>
                        <!-- END RESPONSIVE QUICK SEARCH FORM -->
                    </li>
                    <li <?php echo $home_selected_li_class;?>>
                        <a href="home.php">
                            <i class="fa fa-home"></i>
                            <span class="title">
                                Home
                            </span>
                           <?php echo $home_selected;?>
                        </a>

                    </li>
					<li <?php echo $tarh_selected_li_class;?>>
                        <a href="javascript:;">
                            <i class="fa fa-tags"></i>
                            <span class="title">
                                Research
                            </span>
                            <span class="arrow ">
                            </span>
                            <?php echo $tarh_list_selected;?>
                        </a>
                        <ul class="sub-menu">
                        <?php if(strcmp($daneshjoo,"1")!=0){?>
                            <li <?php echo $send_tarh_selected_li_class;?>>
                                <a href="send_tarh_select.phtml">
                                    Send New Researches

                                </a>
                            </li>
                            <li <?php echo $tarh_list_li_class;?>>
                                <a href="tarh_list.phtml">
                                    Your Reserches
                                </a>
                            </li>
                            <li <?php echo $ostad_payanname_li_class;?>>
                                <a href="ostad_payan_name.phtml">
                                    Thesis
                                </a>
                            </li>
                             <?php 
                        }
                        else {
                            ?>
                            <li <?php echo $send_tarh_selected_li_class;?>>
                                <a href="sabt_tarh.phtml">
                                    Send Thesis

                                </a>
                            </li>
                            <li <?php echo $tarh_list_li_class;?>>
                                <a href="payan_name_list.phtml">
                                    Your Thesis
                                </a>
                            </li>
                            <?php }?>
                        </ul>
                    </li>
                    <? 
                    if(isset($cod_karshenas))
                    {
                    ?>
                    <li <? echo $davari_nezarat_selected_li_class;?>>
                        <a href="javascript:;">
                            <i class="fa fa-comments"></i>
                            <span class="title">
                                Davari and Nezarat
                            </span>
                            <span class="arrow ">
                            </span>
                            <? echo $davari_nezarat_selected;?>
                        </a>
                        <ul class="sub-menu">
                            <li <?php echo $davari_li_class;?>>
                                <a href="tarh_list_davari.phtml">
                                    <?php echo $new_davari_item;?>
                                    طرح هاي داوري

                                </a>
                            </li>
                            <li <?php echo $nezarat_li_class;?>>
                                <a href="tarh_list_nezarat.phtml">
                                <?php echo $new_nezarat_item;?>
                                    طرح هاي نظارت
                                </a>
                            </li>
                        </ul>
                    </li>
                    <? 
                    }
                    
                    if(isset($cod_karshenas_shora))
                    {
                    ?>
                    <li <? echo $ozve_shora_selected_li_class;?>>
                        <a href="javascript:;">
                            <i class="fa fa-user-md"></i>
                            <span class="title">
                                Shora
                            </span>
                            <span class="arrow ">
                            </span>
                            <?php echo $ozve_shora_selected;?>
                        </a>
                        <ul class="sub-menu">
                            <li <?php echo $shora_li_class;?>>
                               <a href="tarh_list_shora.phtml">
                               
                                    طرح هاي شوراي پژوهشي

                                </a>
                            </li>
                        </ul>
                    </li>
                    <? }?>
					<!-- <li <?php echo $maghalat_selected_li_class;?>>
                        <a href="javascript:;">
                            <i class="fa fa-file-text-o"></i>
                            <span class="title">
                                Paper
                            </span>
                            <span class="arrow ">
                            </span>
                            <?php echo $maghalat_selected;?>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="pajooheshyar.html">
                                    ارسال مقاله جديد
                                </a>
                            </li>
                             <li>
                                <a href="pajooheshyar.html">
                                    مقالات ارسالي شما
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li <?php echo $cv_selected_li_class;?>>
                        <a href="javascript:;">
                            <i class="fa fa-book"></i>
                            <span class="title">
                                CV
                            </span>
                            <span class="arrow ">
                            </span>
                            <?php echo $cv_selected;?>
                        </a>
                        <ul class="sub-menu">
                        	<li>
                                <a href="pajooheshyar.html">
                                     Academic Background and Exprience
                                </a>
                            </li>
                         	<li>
                                <a href="pajooheshyar.html">
                                     Teaching Exprience
                                </a>
                            </li>
                            <li>
                                <a href="pajooheshyar.html">
                                      Books
                                </a>
                            </li>
                             <li>
                                <a href="pajooheshyar.html">
                                    Seminars/Workshops attended
                                </a>
                            </li>
                             <li>
                                <a href="pajooheshyar.html">
                                     Conferences attended
                                </a>
                            </li>
                             <li>
                                <a href="pajooheshyar.html">
                                    Awards obtained
                                </a>
                            </li>
                             <li>
                                <a href="pajooheshyar.html">
                                    innovations/inventions
                                </a>
                            </li>
                            <li>
                                <a href="pajooheshyar.html">
                                    Research Interests/Areas
                                </a>
                            </li>
                        </ul>
                    </li>-->
                </ul>
                <!-- END SIDEBAR MENU -->
            </div>
        </div>
        
        <?php }
        else 
        {
	       if(isset($cod_karshenas))
	        {
	        	$query="select cod_tarh from karshenasan_tarh where cod_karshenas='$cod_karshenas' and tarh_new='1' and karshenasi_type='1'";
	        	$result=mysql_query($query) or die("error");
	        	if(mysql_num_rows($result)>0)
	        	{
	        		$new_davari_item="<span class='badge badge-roundless badge-success'>جديد"." (".mysql_num_rows($result).")</span>";
	        	}
	        	$query="select cod_tarh from karshenasan_tarh where cod_karshenas='$cod_karshenas' and tarh_new='1' and karshenasi_type='2'";
	        	$result=mysql_query($query) or die("error");
	        	if(mysql_num_rows($result)>0)
	        	{
	        		$new_nezarat_item="<span class='badge  badge-roundless badge-success'>جديد"." (".mysql_num_rows($result).")</span>";
	        	}
	        }
        ?>
        <div class="page-sidebar-wrapper">
            <div class="page-sidebar navbar-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->
                <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
                    <li class="sidebar-toggler-wrapper">
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                        <div class="sidebar-toggler hidden-phone">
                        </div>
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    </li>
                    <li class="sidebar-search-wrapper">
                        <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                        <form class="sidebar-search" action="extra_search.html" method="POST">
                            <div class="form-container">
                                <div class="input-box">
                                    <a href="javascript:;" class="remove">
                                    </a>
                                   <!--  <input type="text" placeholder="جستجو..." />
                                    <input type="button" class="submit" value=" " /> -->
                                </div>
                            </div>
                        </form>
                        <!-- END RESPONSIVE QUICK SEARCH FORM -->
                    </li>
                    <li <?php echo $home_selected_li_class;?>>
                        <a href="home.php">
                            <i class="fa fa-home"></i>
                            <span class="title">
                                صفحه اصلي
                            </span>
                           <?php echo $home_selected;?>
                        </a>

                    </li>
					<li <?php echo $tarh_selected_li_class;?>>
                        <a href="javascript:;">
                            <i class="fa fa-tags"></i>
                            <span class="title">
                                طرح هاي تحقيقاتي
                            </span>
                            <span class="arrow ">
                            </span>
                            <?php echo $tarh_list_selected;?>
                        </a>
                        <ul class="sub-menu">
                        <?php if(strcmp($daneshjoo,"1")!=0){?>
                            <li <?php echo $send_tarh_selected_li_class;?>>
                                <a href="send_tarh_select.phtml">
                                    ارسال طرح جديد

                                </a>
                            </li>
                             <li <?php echo $tarh_list_li_class;?>>
                                <a href="tarh_list.phtml">
                                    طرح هاي ارسالي شما
                                </a>
                            </li>
                            <li <?php echo $ostad_payanname_li_class;?>>
                                <a href="ostad_payan_name.phtml">
                                    پايان نامه هاي دانشجويان شما
                                </a>
                            </li>
                            <?php 
                        }
                        else {
                            ?>
                            <li <?php echo $send_tarh_selected_li_class;?>>
                                <a href="sabt_tarh.phtml">
                                    ارسال پايان نامه

                                </a>
                            </li>
                            <li <?php echo $tarh_list_li_class;?>>
                                <a href="payan_name_list.phtml">
                                    پايان نامه شما
                                </a>
                            </li>
                            <?php }?>
                           
                        </ul>
                    </li>
                    <?                
                    if(isset($cod_karshenas))
                    {
                    ?>
                    <li <?php echo $davari_nezarat_selected_li_class;?>>
                        <a href="javascript:;">
                            <i class="fa fa-comments"></i>
                            <span class="title">
                                محيط داوري و نظارت
                            </span>
                            <span class="arrow ">
                            </span>
                            <?php echo $davari_nezarat_selected;?>
                        </a>
                        <ul class="sub-menu">
                            <li <?php echo $davari_li_class;?>>
                                <a href="tarh_list_davari.phtml">
                                   <?php echo $new_davari_item;?>
                                    طرح هاي داوري

                                </a>
                            </li>
                            <li <?php echo $nezarat_li_class;?>>
                                <a href="tarh_list_nezarat.phtml">
                                <?php echo $new_nezarat_item;?>
                                    طرح هاي نظارت
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?
                    }
                    if(isset($cod_karshenas_shora))
                    {
                    ?>
                    <li <?php echo $ozve_shora_selected_li_class;?>>
                        <a href="javascript:;">
                            <i class="fa fa-user-md"></i>
                            <span class="title">
                                محيط شوراي پژوهشي
                            </span>
                            <span class="arrow ">
                            </span>
                            <?php echo $ozve_shora_selected;?>
                        </a>
                        <ul class="sub-menu">
                            <li <?php echo $shora_li_class;?>>
                                <a href="tarh_list_shora.phtml">
                                
                                    طرح هاي شوراي پژوهشي

                                </a>
                            </li>
                        </ul>
                    </li>
                    <? }?>
					<!-- <li <?php echo $maghalat_selected_li_class;?>>
                        <a href="javascript:;">
                            <i class="fa fa-file-text-o"></i>
                            <span class="title">
                                مقالات
                            </span>
                            <span class="arrow ">
                            </span>
                            <?php echo $maghalat_selected;?>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="pajooheshyar.html">
                                    ارسال مقاله جديد
                                </a>
                            </li>
                             <li>
                                <a href="pajooheshyar.html">
                                    مقالات ارسالي شما
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li <?php echo $cv_selected_li_class;?>>
                        <a href="javascript:;">
                            <i class="fa fa-book"></i>
                            <span class="title">
                                سوابق کاري و تجربيات 
                            </span>
                            <span class="arrow ">
                            </span>
                            <?php echo $cv_selected;?>
                        </a>
                        <ul class="sub-menu">
                        	<li>
                                <a href="pajooheshyar.html">
                                    سوابق تحصيلي
                                </a>
                            </li>
                         	<li>
                                <a href="pajooheshyar.html">
                                    سوابق تدريس
                                </a>
                            </li>
                            <li>
                                <a href="pajooheshyar.html">
                                    کتاب ها
                                </a>
                            </li>
                             <li>
                                <a href="pajooheshyar.html">
                                    سمينارها
                                </a>
                            </li>
                             <li>
                                <a href="pajooheshyar.html">
                                    کنفرانس ها
                                </a>
                            </li>
                             <li>
                                <a href="pajooheshyar.html">
                                    جوايز
                                </a>
                            </li>
                             <li>
                                <a href="pajooheshyar.html">
                                    اختراعات
                                </a>
                            </li>
                            <li>
                                <a href="pajooheshyar.html">
                                    موضوعات پژوهشي مورد علاقه
                                </a>
                            </li>
                        </ul>
                    </li> -->
                </ul>
                <!-- END SIDEBAR MENU -->
            </div>
        </div>
        <?php }?>
        <!-- END SIDEBAR -->