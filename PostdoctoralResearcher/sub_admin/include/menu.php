
<?
 $q1="select * from modir_daneshkade,daneshkade where modir_username='$admin' and daneshkade.cod_daneshkade=modir_daneshkade.cod_daneshkade";
  	    			$rslt=mysql_query($q1);
  	    			$rff=mysql_fetch_array($rslt);
  	    			$have_group=$rff["have_group"];
					$modir_type=$rff["modir_type"];
					
?>
 <table dir="rtl" width="100%" cellpadding="0" bgcolor="#accde0" cellspacing="0" height="100%" ID="Table1">
 
 
 
  <tr>
    <td class="clsTable1" colspan="2" bgcolor="#dfdfff">
  <table width="100%" height="100%" cellpadding="0" cellpadding="0" ID="Table5" >
  <tr>
    <td width="1"></td>
    <td valign=top class="clsTableIN">
        <div align='right' class="suckerdiv">
<ul id="suckertree1">
          <li> <a href="#" >طرحهاي تحقيقاتي</a>
            <ul>              
              <li  ><a href="<? echo "tarh_list_new.phtml?admin=$admin&seed=$seed";?>">طرحهاي جديد</a></li>
              <li  ><a href="<? echo "tarh_list_new_before_submit.phtml?admin=$admin&seed=$seed";?>">طرحهاي قبل از تصويب</a></li>

              <li ><a href="<? echo "tarh_list_new_after_submit.phtml?admin=$admin&seed=$seed";?>">طرحهاي بعد از تصويب</a></li>
			  
			  
              <li ><a href="<? echo "indoing.phtml?admin=$admin&seed=$seed";?>">طرحهاي در حال اجرا</a></li>
              <li ><a href="<? echo "finished.phtml?admin=$admin&seed=$seed";?>">طرح هاي پايان يافته</a></li>
              <li ><a href="<? echo "archieved.phtml?admin=$admin&seed=$seed";?>">طرحهاي بايگاني شده</a></li>
 
               <li ><a href="<? echo "tarh_list_send_moavenat.phtml?admin=$admin&seed=$seed";?>">طرحهاي ارسالي يه معاونت پژوهشي</a></li>

             
               <li ><a href="<? echo "referred_karshenasan.phtml?admin=$admin&seed=$seed";?>">طرحهاي ارجاعي از کارشناسان</a></li>
 
          </ul>
             
    
          </li>
          <?
		  if(strcmp($modir_type,'5')!=0)
		  {
		  ?>
          <li><a href="#" >طرحهاي گرانت و HSR </a>
            <ul>
               <li  ><a  href="<? echo "grant_hsr.phtml?admin=$admin&seed=$seed";?>">طرحهاي گرانت و HSR </a></li>
              <li  ><a href="<? echo "grant_hsr_finished.phtml?admin=$admin&seed=$seed";?>">گرانت و HSR خاتمه يافته</a></li>             
 
            </ul>
          </li>
          
          
            <li > <a   href=<? echo "\"old_tarhs.phtml?admin=$admin&seed=$seed\""; ?>>طرح هاي قديمي </a>         
          </li>
		  
		  <?
		  }
		  ?>
          <li><a href="#" > پيام کوتاه</a>
            <ul>
              <li ><a href="<? echo "send_sms.phtml?admin=$admin&seed=$seed";?>">ارسال پيام کوتاه</a></li>
                </ul>
          </li>
          
           <li > <a   href=<? echo "\"karshenasan_add.phtml?admin=$admin&seed=$seed\""; ?>>کارشناسان</a>         
          </li>
          <li > <a   href=<? echo "\"shora_notes.phtml?admin=$admin&seed=$seed\""; ?>>نظر اعضاي شورا در مورد طرح</a>         
          </li>
           <li > <a   href=<? echo "\"gozareshat.phtml?admin=$admin&seed=$seed\""; ?>>گزارشات جهت تاييد</a>         
          </li>
           <li > <a   href=<? echo "\"groups_daneshkade.phtml?admin=$admin&seed=$seed\""; ?>>گروهها</a>         
          </li> 
          
           <?
							  $query1="select * from letter_to_mojri where (to_letter='$admin'   and visited='0'  )   ";
 // echo $query1;
  						  $result1=mysql_query($query1) or die("error");
 						  if(mysql_num_rows($result1) > 0)
   							 $new_msg="<span class='tahoma0' ><font color='red'><u><img src='images/new.gif' border='0'></u> &nbsp;&nbsp;</font></span>";    
  						  else 
							 $new_msg="<span class='tahoma0'></span>"; 
						?>
		 <li > <a   href=<? echo "\"letter_to_mojri_list.phtml?admin=$admin&seed=$seed\""; ?>><?  echo $new_msg;?> دبيرخانه  </a>         
          </li>
         	 
        		  <li ><a href=<? echo "\"advanced_search_tarh.phtml?admin=$admin&seed=$seed\""; ?>> جستجوي طرح</a>
     
          
		   
		  <li><a href="#" >شوراي پژوهشي</a>
             <ul>
             <li ><a href="<? echo "add_shora_pajoheshi.phtml?admin=$admin&seed=$seed";?>">تعريف اعضاي شوراي پژوهشي</a></li>
              <li ><a href="<? echo "comments.phtml?admin=$admin&seed=$seed";?>">تعريف جلسه شوراي پژوهشي</a></li>
              <li ><a href="<? echo "jalase_shora_list.phtml?admin=$admin&seed=$seed";?>">جلسات شوراي پژوهشي </a></li>
              <li ><a href="<? echo "rotbe_tarh_select_year.phtml?admin=$admin&seed=$seed";?>">تعيين رتبه طرح در رنک</a></li>
             </ul>
          </li>
	  
         
        
           
          
     
        <li > <a href=<? echo "\"informatics.phtml?admin=$admin&seed=$seed\""; ?>>اطلاع رساني</a>
           </li> 
          
          
  
          		  <li ><a   href=<? echo "\"chg_pass.phtml?admin=$admin&seed=$seed\""; ?>>تغيير رمز عبور </a>
           </li> 
 	
   
 
	  <li ><a   href=<? echo "\"search_log.phtml?admin=$admin&seed=$seed\""; ?>>فعاليتها </a>
           </li> 
  <li ><a  target='_blank' href=<? echo "\"rahnema.doc\""; ?>>راهنما </a>
           </li> 
          <li ><a  href=<? echo "\"logout.phtml?admin=$admin&seed=$seed\""; ?>>خروج </a>
           </li> 
        </ul>
      </div></td>
    <td width="5"></td>
  </tr>
</table>
</td>
</tr>
 </table>