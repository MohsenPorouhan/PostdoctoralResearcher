                                   <table dir="rtl" width="100%" cellpadding="0" bgcolor="#dfdfff" cellspacing="0" height="100%" ID="Table1">
 
 
 
  <tr>
    <td class="clsTable1" colspan="2" bgcolor="#dfdfff">
  <table width="100%" height="100%" cellpadding="0" cellpadding="0" ID="Table5" >
  <tr>
    
    <td valign=top class="clsTableIN" bgcolor="#dfdfff">
   <div align='right' class="suckerdiv">
<ul id="suckertree1">
 
                          
   <?php 
        
   if($admin=="admin_karshenasan"){?>
		<ul>
          <li ><a href="<? echo "karshenasan_add.phtml?admin=$admin&seed=$seed";?>" >کارشناسان</a>	             
          </li>
           <li ><a href="<? echo "mojrian.phtml?admin=$admin&seed=$seed";?>" >مجريان</a></li>	   
           <li ><a href="<? echo "karshenasan_edgham.phtml?admin=$admin&seed=$seed";?>" >ادغام کارشناسان و ناظرين</a>	             
          </li>
          <li ><a href="<? echo "report_complex.phtml?admin=$admin&seed=$seed";?>" >جستجوي طرح</a>	             
          </li>
                      
          
            </ul>
	<?php }
	else if($admin=="admin_shora"){?>
		<ul>
                <li ><a href="<? echo "add_shora.phtml?admin=$admin&seed=$seed";?>" >اعضاء شورا</a>	             
          </li>
          <li ><a href="<? echo "mojrian.phtml?admin=$admin&seed=$seed";?>" >مجريان</a>	             
          </li>
            </ul>
	<?php }
	else{
   $query="select * from modir_daneshkade where modir_username='$admin'";
   		 $result=mysql_query($query) or die("Error in selecting data from modir daneshkade");
		 $row_fetched=mysql_fetch_array($result);
		 $dastresi=$row_fetched["dastresi"];
		 $modir_type=$row_fetched["modir_type"];
		 $accept_gharardad=$row_fetched["accept_gharardad"];
		 //echo $dastresi;
		 
		 ?>
            <?php $i=check_field_value($dastresi,"a1");
            if($i=="on"){
            ?>   
           <li ><a href="#" >طرحهاي تحقيقاتي</a>	          
            <ul>
               <li ><a href="<? echo "tarh_list_new.phtml?admin=$admin&seed=$seed";?>">طرحهاي جديد</a></li>
               <li ><a href="<? echo "tarh_list_new_before_submit.phtml?admin=$admin&seed=$seed";?>">طرحهاي قبل از تصويب</a></li>
               <li ><a href="<? echo "tarh_list_new_after_submit.phtml?admin=$admin&seed=$seed";?>">طرحهاي بعد از تصويب</a></li>
               <li ><a href="<? echo "new_gharardad.phtml?admin=$admin&seed=$seed";?>">طرحهاي آماده به قرارداد </a></li>
               <li ><a href="<? echo "in_doing.phtml?admin=$admin&seed=$seed";?>">طرحهاي در حال اجرا</a></li>
               <li ><a href="<? echo "in_doing_daneshkade.phtml?admin=$admin&seed=$seed";?>">طرحهاي در حال اجراي مراکز مستقل</a></li>
               <li ><a href="<? echo "finished.phtml?admin=$admin&seed=$seed";?>">طرح هاي پايان يافته</a></li>
               <li ><a href="<? echo "finish_pointed_tarh_list.phtml?admin=$admin&seed=$seed";?>">طرح هاي پايان يافته با تعهدات</a></li>
               <li ><a href="<? echo "baygani_shode.phtml?admin=$admin&seed=$seed";?>">طرحهاي بايگاني شده </a></li>
               <li ><a href="<? echo "archive_reason_list.phtml?admin=$admin&seed=$seed";?>">سوابق آشيو طرح</a></li>
               <li ><a href="<? echo "rejected.phtml?admin=$admin&seed=$seed";?>">طرح هاي رد شده</a></li>
               <li ><a href="<? echo "tarh_list_makhtoome.phtml?admin=$admin&seed=$seed";?>">طرح هاي مختومه</a></li>

            </ul>
          </li>
          <?php }
          $i=check_field_value($dastresi,"a2");
          if($i=="on"){
          ?>
          <li ><a href="#" >طرحهاي تحقيقاتي HSR </a>	          
            <ul>
               <li ><a href="<? echo "hsr_tarh_list_new.phtml?admin=$admin&seed=$seed";?>"> طرحهاي جديد HSR</a></li>
               <li ><a href="<? echo "hsr_tarh_list_new_before_submit.phtml?admin=$admin&seed=$seed";?>"> طرحهاي قبل از تصويب HSR</a></li>
               <li ><a href="<? echo "hsr_tarh_list_new_after_submit.phtml?admin=$admin&seed=$seed";?>"> طرحهاي بعد از تصويب HSR</a></li>
               <li ><a href="<? echo "hsr_new_gharardad.phtml?admin=$admin&seed=$seed";?>">طرحهاي آماده به قرارداد </a></li>
               <li ><a href="<? echo "hsr_in_doing.phtml?admin=$admin&seed=$seed";?>">طرحهاي در حال اجرا</a></li>
               <li ><a href="<? echo "hsr_finished.phtml?admin=$admin&seed=$seed";?>">طرح هاي خاتمه يافته</a></li>
               <li ><a href="<? echo "hsr_baygani_shode.phtml?admin=$admin&seed=$seed";?>">طرحهاي بايگاني شده </a></li>
               <li ><a href="<? echo "hsr_tarh_list_makhtoome.phtml?admin=$admin&seed=$seed";?>">طرحهاي HSR مختومه </a></li>
               
            </ul>
          </li>
         
          <?php } if($accept_gharardad=="on"){?>
            <li ><a href="#" >تاييد قراردادها</a>	          
            <ul>
          		<li ><a href="<? echo "tarh_list_confirm_gharardad.phtml?admin=$admin&seed=$seed";?>">تاييد طرح هاي آماده به قرارداد</a></li>
          		<li ><a href="<? echo "tarh_list_confirm_gharardad2.phtml?admin=$admin&seed=$seed";?>">  طرح هاي آماده به قرارداد تاييد شده</a></li>
          	</ul>
          	</li>
          	
          	<li ><a href="#" >تاييد دستور پرداخت</a>	          
            <ul>
          		<li ><a href="<? echo "dastoor_pardakht_list.phtml?admin=$admin&seed=$seed";?>">تاييد دستور پرداخت</a></li>
          		<li ><a href="<? echo "dastoor_pardakht_confirmed.phtml?admin=$admin&seed=$seed";?>">  دستور پرداخت هاي تاييد شده</a></li>
          	</ul>
          	</li>
          	
          
          <li ><a href="<? echo "control_gharardad_tarh_list.phtml?admin=$admin&seed=$seed";?>" > بازبيني براي ارسال به آماده به قرارداد</a>	             
           <li ><a href="<? echo "control_gharardad_report_select.phtml?admin=$admin&seed=$seed";?>" > گزارشات آماده به قرارداد </a>
          </li>
          
          <li ><a href="#" >تعيين ناظر</a>	          
            <ul>
          <li ><a href="<? echo "taein_nazer_request.phtml?admin=$admin&seed=$seed";?>" > درخواست هاي تعيين/تغيير ناظر </a>
          </li>
           <li ><a href="<? echo "taein_nazer_confirm.phtml?admin=$admin&seed=$seed";?>" > طرح هاي تعيين ناظر شده </a>
          </li>
          </ul>
          	</li>
          <?php }
          $i=check_field_value($dastresi,"a3");
          if($i=="on"){
          ?>
          <li ><a href="#" >مراکز مستقل</a>	          
            <ul>
               <li ><a href="<? echo "sent_daneshgah_confirm.phtml?admin=$admin&seed=$seed";?>">گردش کاري مراکز مستقل در دانشگاه</a></li>
               <li ><a href="<? echo "new_gharardad_mostaghel.phtml?admin=$admin&seed=$seed";?>">طرح هاي آماده به قرارداد</a></li>
               <li ><a href="<? echo "in_doing_mostaghel.phtml?admin=$admin&seed=$seed";?>">طرح هاي در حال اجرا</a></li>
               
            </ul>
          </li>
          <?php }
          $i=check_field_value($dastresi,"a4");
          if($i=="on"){
          ?>
          <li ><a href="#" >بررسي اخلاقي پايان نامه ها</a>	          
            <ul>
            <li ><a href="<? echo "payanname_list_new.phtml?admin=$admin&seed=$seed";?>"> پايان نامه ها ي جديد</a></li>
               <li ><a href="<? echo "payanname_list_new_before_akhlagh.phtml?admin=$admin&seed=$seed";?>">بررسي اخلاق پايان نامه ها</a></li>
               <li ><a href="<? echo "payanname_list_new_after_akhlagh.phtml?admin=$admin&seed=$seed";?>">پايان نامه هاي بررسي اخلاقي شده</a></li>
               <li ><a href="<? echo "karshenasan_note_list.phtml?admin=$admin&seed=$seed";?>">نظر داوران در مورد پايان نامه ها</a></li>
               <li ><a href="<? echo "group_karshenasan_note_list.php?admin=$admin&seed=$seed";?>">نظر گروه کارشناسان در مورد پايان نامه ها</a></li>      
            </ul>
          </li>
          <?php }
          $i=check_field_value($dastresi,"a5");
          if($i=="on"){
          ?>
          <li ><a href="<? echo "old_tarhs.phtml?admin=$admin&seed=$seed";?>" >طرح هاي قديمي</a>	             
          </li>
          <li ><a href="<? echo "tarh_list_iran.phtml?admin=$admin&seed=$seed";?>" >طرح هاي دانشگاه ايران</a>	             
          </li>
          <li ><a href="<? echo "tarh_list_tehran.phtml?admin=$admin&seed=$seed";?>" >طرح هاي دانشگاه تهران</a>	             
          </li>
          <?php }
          $i=check_field_value($dastresi,"a6");
          if($i=="on"){
          ?>
          <li ><a href="#" >پيام کوتاه</a>	          
            <ul>
               <li ><a href="<? echo "send_sms.phtml?admin=$admin&seed=$seed";?>">ارسال پيام کوتاه</a></li>
               <li ><a href="<? echo "subadmin_sms_list.phtml?admin=$admin&seed=$seed";?>">ليست پيام کوتاه هاي ساب ادمين ها</a></li>
               <li ><a href="<? echo "list_received_sms.phtml?admin=$admin&seed=$seed";?>">ليست پيام هاي کوتاه  به سيستم</a></li>
               <li ><a href="<? echo "send_mojrian_sms.phtml?admin=$admin&seed=$seed";?>">ارسال پيام کوتاه به مجريان</a></li>        
            </ul>
          </li>
          <?php }
          $i=check_field_value($dastresi,"a7");
          if($i=="on"){
          ?>
          <li ><a href="<? echo "gozareshat_old.phtml?admin=$admin&seed=$seed";?>" >گزارشات نهايي تاييد نشده</a>	             
          </li>
          <?php }
          $i=check_field_value($dastresi,"a8");
          if($i=="on"){
          ?>
           <li ><a href="<? echo "karshenasan_add.phtml?admin=$admin&seed=$seed";?>" >کارشناسان و ناظرين</a>	             
          </li>
          <?php }
          ?>
           <li ><a href="<? echo "karshenasan_edgham.phtml?admin=$admin&seed=$seed";?>" >ادغام کارشناسان و ناظرين</a>	             
          </li>
          <?
          $i=check_field_value($dastresi,"a9");
          if($i=="on"){
          ?>
           <li ><a href="#" >شوراي پژوهشي</a>	          
            <ul>
               <li ><a href="<? echo "taarif_shora.phtml?admin=$admin&seed=$seed";?>">تعريف شوراي پژوهشي</a></li>
               <li ><a href="<? echo "jalase_shora.phtml?admin=$admin&seed=$seed";?>">تعريف جلسه شوراي پژوهشي</a></li>
               <li ><a href="<? echo "jalase_shora.phtml?admin=$admin&seed=$seed";?>">تعريف جلسه شوراي اخلاق</a></li>
               <li ><a href="<? echo "jalase_shora_list.phtml?admin=$admin&seed=$seed";?>">جلسات شوراي پژوهشي مراکز</a></li>
               <li ><a href="<? echo "jalase_shora_moavenat_list.phtml?admin=$admin&seed=$seed";?>">جلسات شوراي دانشگاه</a></li>        
            </ul>
          </li>
          <?php }
          $i=check_field_value($dastresi,"a10");
          if($i=="on"){
          ?>
          <li ><a href="<? echo "doers.phtml?admin=$admin&seed=$seed";?>" >مجريان</a>	             
          </li>
          <?php }
          $i=check_field_value($dastresi,"a11");
          if($i=="on"){
          ?>
          <li ><a href="#" >ثوابت سيستم</a>	          
            <ul>
               <li ><a href="<? echo "main-content.phtml?admin=$admin&seed=$seed";?>">متن ارسال طرح به دانشگاه</a></li>
               <li ><a href="<? echo "tarh-type.phtml?admin=$admin&seed=$seed";?>">نوع طرح</a></li>
               <li ><a href="<? echo "tarh-type-1.phtml?admin=$admin&seed=$seed";?>">نوع مطالعه</a></li>
               <li ><a href="<? echo "tarh-type-2.phtml?admin=$admin&seed=$seed";?>">نوع طرح 1</a></li>
               <li ><a href="<? echo "daraje-elmi.phtml?admin=$admin&seed=$seed";?>">درجه علمي</a></li> 
               <li ><a href="<? echo "maghta_payan_name.phtml?admin=$admin&seed=$seed";?>">مقطع پايان نامه</a></li>
               <li ><a href="<? echo "control_gharardad_karshenas.phtml?admin=$admin&seed=$seed";?>"> تعريف کارشناس کنترل قرارداد</a></li>
               <li ><a href="<? echo "karshenas_type.phtml?admin=$admin&seed=$seed";?>">تعريف نوع کارشناس</a></li>
               <li ><a href="<? echo "add_daneshkade.phtml?admin=$admin&seed=$seed";?>">تعريف دانشکده / مرکز</a></li>
               <li ><a href="<? echo "vaziat-tarh.phtml?admin=$admin&seed=$seed";?>">وضعيت طرح </a></li>
               <li ><a href="<? echo "hesab_type.phtml?admin=$admin&seed=$seed";?>">نوع حساب بانکي</a></li>
               <li ><a href="<? echo "main-content.phtml?admin=$admin&seed=$seed";?>">محتواي صفحه اصلي</a></li> 
               <li ><a href="<? echo "ranking.phtml?admin=$admin&seed=$seed";?>">Ranking</a></li>
               <li ><a href="<? echo "news.phtml?admin=$admin&seed=$seed";?>">اخبار</a></li>
               <li ><a href="<? echo "sooratjalase.phtml?admin=$admin&seed=$seed";?>">توضيحات صورتجلسه</a></li>
               <li ><a href="<? echo "file_type.phtml?admin=$admin&seed=$seed";?>">تعريف نوع فايل</a></li>
               <li ><a href="<? echo "maghale_type.phtml?admin=$admin&seed=$seed";?>">تعريف نوع مقاله</a></li>
               <li ><a href="<? echo "maghale_index_type.phtml?admin=$admin&seed=$seed";?>">تعريف نوع ايندکس مقاله</a></li>
               <li ><a href="<? echo "issn.phtml?admin=$admin&seed=$seed";?>">issn</a></li>
                   
            </ul>
          </li>
          <?php }
          $i=check_field_value($dastresi,"a12");
          $confirm_letter=check_field_value($dastresi,"a37");
          if($i=="on"){
          ?>
          <li ><a href="#" >دبيرخانه</a>	          
            <ul>
             <? if($confirm_letter=="on"){?>
               <li ><a href="<? echo "letter_to_mojri_list.phtml?admin=$admin&seed=$seed";?>">دبير خانه</a></li>
               <li ><a href="<? echo "confirm_letters.phtml?admin=$admin&seed=$seed";?>">نامه كارشناسان جهت تاييد</a></li>
                <li ><a href="<? echo "returned_letter.phtml?admin=$admin&seed=$seed";?>">نامه هاي ارجاعي</a></li>
                <li ><a href="<? echo "karshenas_letter_number.phtml?admin=$admin&seed=$seed";?>">تعداد مکاتبات کارشناس</a></li>
              <? } ?>
               <li ><a href="<? echo "your_letter_list.phtml?admin=$admin&seed=$seed";?>">نامه هاي ارسالي شما</a></li>
               <li ><a href="<? echo "new_letter.phtml?admin=$admin&seed=$seed";?>">نامه هاي جديد شما</a></li>
               <li ><a href="<? echo "returned_letter.phtml?admin=$admin&seed=$seed";?>">نامه هاي ارجاعي شما</a></li>
                       
            </ul>
          </li>
          <?php }
          $i=check_field_value($dastresi,"a13");
          if($i=="on"){
          ?>
          <li ><a href="#" >گزارشات</a>	          
            <ul>
          
               <li ><a href="<? echo "report_dynamic.phtml?admin=$admin&seed=$seed";?>">گزارش ترکيبي</a></li>
               <li ><a href="<? echo "report.phtml?admin=$admin&seed=$seed";?>">گزارش انتقال دانش</a></li>
            	<li ><a href="<? echo "all_tarh.phtml?admin=$admin&seed=$seed";?>">ليست تمام طرح ها</a></li>
               <li ><a href="<? echo "group_by_center.phtml?admin=$admin&seed=$seed";?>">تعداد طرح بر اساس نام مرکز</a></li>
               <li ><a href="<? echo "akhlaghi.phtml?admin=$admin&seed=$seed";?>">گزارش اخلاقي طرح ها</a></li>
               <li ><a href="<? echo "group_karshenasan_activity.phtml?admin=$admin&seed=$seed";?>">فعاليت کارشناسان ستادي به تفکيک</a></li>
               <li ><a href="<? echo "group_karshenasan_activity1.phtml?admin=$admin&seed=$seed";?>">گزارش فعاليت کارشناسان ستادي شماره 1</a></li>
               <li ><a href="<? echo "budje_group_by_center.phtml?admin=$admin&seed=$seed";?>">جمع بودجه طرحها به تفکيک مرکز</a></li>
               <li ><a href="<? echo "user_delivery_report.phtml?admin=$admin&seed=$seed";?>">گزارش مالي طرح بر اساس گزارشات</a></li>
               <li ><a href="<? echo "budje_item_tarh.phtml?admin=$admin&seed=$seed";?>">جمع بودجه طرحها به تفکيک موارد طرح</a></li>
               <li ><a href="<? echo "budje_selective.phtml?admin=$admin&seed=$seed";?>">گزارش مالي به صورت انتخابي</a></li>
               <li ><a href="<? echo "grant_report.phtml?admin=$admin&seed=$seed";?>">گزارش گرانتها</a></li>
               <li ><a href="<? echo "initial_report.phtml?admin=$admin&seed=$seed";?>">گزارش مالي</a></li> 
               <li ><a href="<? echo "search_field.phtml?admin=$admin&seed=$seed";?>">گزارش بر اساس فيلدهاي طرح</a></li>
               <li ><a href="<? echo "search_by_center.phtml?admin=$admin&seed=$seed";?>">گزارش تعهدات و پرداختي ها</a></li>
               <li ><a href="<? echo "report_yearly.phtml?admin=$admin&seed=$seed";?>">گزارش پرداخت بصورت ساليانه</a></li>
               <li ><a href="<? echo "report_rank_yearly.phtml?admin=$admin&seed=$seed";?>">گزارش طرح هاي در حال اجرا و خاتمه يافته</a></li>
               <li ><a href="<? echo "report_tarh_indoing_hazine.phtml?admin=$admin&seed=$seed";?>">گزارش طرح هاي در حال اجرا با هزينه مواد بالاي 10 ميليون</a></li> 
                <li ><a href="<? echo "report_davaran_comment_naserbakht.phtml?admin=$admin&seed=$seed";?>">داوري-ناصربخت</a></li>
                 <li ><a href="<? echo "report_davaran_comment_gooran.phtml?admin=$admin&seed=$seed";?>">داوري- گوران</a></li>
                 <li ><a href="<? echo "jalase_shora_report.phtml?admin=$admin&seed=$seed";?>">گزارش جلسات شوراي پژوهشي مرکز</a></li>       
            </ul>
          </li>
          <?php }
          $i=check_field_value($dastresi,"a14");
          if($i=="on"){
          ?>
          <li ><a href="<? echo "send_excel.phtml?admin=$admin&seed=$seed";?>" >ارسال فايل</a>	             
          </li>
          <?php }
          $i=check_field_value($dastresi,"a15");
          if($i=="on"){
          ?>
          
          <li ><a href="<? echo "gant_correction.phtml?admin=$admin&seed=$seed";?>" >تصحيح در جدول گانت</a>	             
          </li>
          <?php }
          $i=check_field_value($dastresi,"a16");
          if($i=="on"){
          ?>
          
          <li ><a href="<? echo "correction.phtml?admin=$admin&seed=$seed";?>" >تصحيح در نرم افزار</a>	             
          </li>
          <?php }
          ?>
          <?
						 $query="select * from message_to_admin where (message_to='admin' ) and readed='0' ";
 
 						 $result11=mysql_query($query) or die("error in selecting data from letter_to_mojri");
                         if(mysql_num_rows($result11) > 0)
                           $aa="<sup><font	color=red>New Message</font></sup>";
                         else
						   $aa="";  
						?>
						
		  <li ><a href="<? echo "report_complex.phtml?admin=$admin&seed=$seed";?>" >جستجوي طرح</a>	             
          </li>
          <?php 
          $i=check_field_value($dastresi,"a17");
          if($i=="on"){
          ?>
           <li ><a href="<? echo "file_sharing.phtml?admin=$admin&seed=$seed";?>" >ارسال فايل به همکاران</a>	             
          </li>
			<?php }
          $i=check_field_value($dastresi,"a18");
          if($i=="on"){
          ?>
			 <li ><a href="<? echo "karshenasan_messages.phtml?admin=$admin&seed=$seed";?>" ><? echo $aa; ?> پيام کارشناسان</a>	             
          </li>	
          <?php }
          $i=check_field_value($dastresi,"a19");
          if($i=="on"){
          ?>
           <li ><a href="<? echo "informatics.phtml?admin=$admin&seed=$seed";?>" >اطلاع رساني</a>	             
          </li>
          <?}
						 //$query="select * from modir_daneshkade where modir_username='$admin'";
						 
						// $result=mysql_query($query) or die("Error in selecting data from modir daneshkade");
						// $row_fetched=mysql_fetch_array($result);
						 
						 $i=check_field_value($dastresi,"a19");
						 $j=check_field_value($dastresi,"a21");
						 if(strcmp($modir_type,'4')!=0)
						 {
						?>
          
          
          <li ><a href="<? echo "add_assistant.phtml?admin=$admin&seed=$seed";?>" >تعريف معاون</a>	             
          </li>		
			<?
						 }
						 else if($j=="on")
						 {
						?>
			<li ><a href="#" >مديريت کاربران</a>	          
            <ul>
               <li ><a href="<? echo "add_modir_karshenasan.phtml?admin=$admin&seed=$seed";?>">تعريف مدير گروه کارشناسي</a></li>
               <li ><a href="<? echo "add_user.phtml?admin=$admin&seed=$seed";?>">تعريف ناظر</a></li>
               <li ><a href="<? echo "add_user.phtml?admin=$admin&seed=$seed";?>">تعريف مدير بخش مالي</a></li>
               <li ><a href="<? echo "add_user.phtml?admin=$admin&seed=$seed";?>">تعريف مدير بخش اخلاق</a></li>
                       
            </ul>
          </li>
          <?
						 }
						?>
						
		  <li ><a href="<? echo "chg_pass.phtml?admin=$admin&seed=$seed";?>" >تغيير رمز عبور</a>	             
          </li>
          <?php 
          $i=check_field_value($dastresi,"a22");
          if($i=="on"){
          ?>
          <li ><a href="<? echo "change_cod_tarh.phtml?admin=$admin&seed=$seed";?>" >تغيير کد طرح</a>	             
          </li>
          <?php
          } 
          $i=check_field_value($dastresi,"a23");
          if($i=="on"){
          ?>
          <li ><a href="<? echo "change_mojri_tarh.phtml?admin=$admin&seed=$seed";?>" >تغيير نام مجري طرح</a>	             
          </li>
          <?php }
          ?>
          <li ><a href="<? echo "user_activities.phtml?admin=$admin&seed=$seed";?>" >فعاليتها</a>	             
          </li>
          <li ><a href="<? echo "gozaresh90.phtml?admin=$admin&seed=$seed";?>" >گزارش92</a>	             
          </li>
          
          <li ><a href="<? echo "logout.phtml?admin=$admin&seed=$seed";?>" >خروج</a>	             
          </li>
				<?php }?>	
        </ul>
      </div></td>
    <td width="5"></td>
  </tr>
     
</table>
</td>
</tr>
  </table>
  