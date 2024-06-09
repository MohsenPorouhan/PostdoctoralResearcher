<?
include("include/database-connect.phtml");
include("include/include.phtml");
header_forms($admin,$seed);
include("include/styles.phtml");


$year_date = date("Y") - 1921 ;
$today=str_replace("/","-",today());

 
echo "<br>";

if(strcmp($action,"add_rezayatname")==0)
  {
  	
  $value_form="";
      for($i=1;$i<11;$i++)
  	   {
	    $var= "a".$i;
	    
		  if(strlen(trim($value_form))<=0)
		    $value_form=$var."="."\"".addslashes(str_replace(",","",$$var))."\"";
		  else
		    $value_form=$value_form.",".$var."="."\"".addslashes(str_replace(",","",$$var))."\"";
	     
	   
  	   }
  	
  	$query="update tarh set form_rezayatname='$value_form' where cod_tarh='$cod_tarh' and version='-1'";
  	$tarh_result=mysql_query($query) or die("Error in selecting data into tarh");
  	   
    
  }
  
  $query="select * from tarh where cod_tarh=\"$cod_tarh\" and version='-1' ";
  $result=mysql_query($query) or die("Error in updating data into tarh1");
  $my_row_fetched=mysql_fetch_array($result);
  $form_rezayatname=$my_row_fetched['form_rezayatname'];
 // echo $form_rezayatname;
 

echo "<form name=\"sabt_tarh\" method=\"post\"  action=\"$PHP_SELF?action=add_rezayatname&admin=$admin&seed=$seed&cod_tarh=$cod_tarh\">"; ?>

<?php $i=check_field_value($form_rezayatname,"a1");
              		
              		
              ?>
<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style: solid; border-width: 1; ">
 <tr>
    <td width="400" align="right"><textarea   rows="7"  name="a1"  class="edit-user"  dir=RTL   ><? echo $i; ?></textarea></td>
    <td width="300" class="tahoma1" align="right" dir='rtl'>1.من مي دانم که اهداف اين پژوهش عبارتند از:</td>
  </tr>
</table>
	 <table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; ">
		 <tr>
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl'>2.من مي دانم شرکت من در اين پژوهش کاملا داوطلبانه است و مجبور به شرکت در اين پژوهش نيستم<br>  به من اطمينان داده شد که اگر حاضر به شرکت در اين پژوهش نباشم، از مراقبت هاي معمول تشخيصي و درماني محروم نخواهم شد و رابطه درماني من بامرکز درماني و پرشک معالج دچار اشکال نشود</td>
		   </tr>
	    </table>

<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; ">
		 <tr>
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl'>3.من مي دانم که حتي پس از موافقت با شرکت در پژوهش مي توانم هر وقت که بخواهم، پس از اطلاع به مجري، از پژوهش خارج شوم و خروج من از پژوهش باعث محروميت از دريافت خدمات درماني معمول براي من نخواهد شد.</td>
		   </tr>
		   
	    </table>
	    
	<?php $i=check_field_value($form_rezayatname,"a2");
              		
              		
              ?>    
<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style: solid; border-width: 1; ">
 <tr>
    <td width="400" align="right"><textarea   rows="7"  name="a2"  class="edit-user"  dir=RTL   ><? echo $zarorat; ?></textarea></td>
    <td width="300" class="tahoma1" align="right" dir='rtl'>4.نحوه ي همکاري اينجانب در اين پژوهش به اين صورت است:</td>
  </tr>
</table>
<?php $i=check_field_value($form_rezayatname,"a3");
              		
              		
              ?>
<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style: solid; border-width: 1; ">
 <tr>
    <td width="400" align="right"><textarea   rows="7"  name="a3"  class="edit-user"  dir=RTL   ><? echo $zarorat; ?></textarea></td>
    <td width="300" class="tahoma1" align="right" dir='rtl'>5.منافع احتمالي شرکت اينجانب در اين مطالعه به شرح زير است:</td>
  </tr>
</table>
	<?php $i=check_field_value($form_rezayatname,"a4");
              		
              		
              ?>    
<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style: solid; border-width: 1; ">
 <tr>
    <td width="400" align="right"><textarea   rows="7"  name="a4"  class="edit-user"  dir=RTL   ><? echo $i; ?></textarea></td>
    <td width="300" class="tahoma1" align="right" dir='rtl'>6.آسيب ها و عوارض احتمالي شرکت در اين مطالعه به اين شرح است:</td>
  </tr>
</table>
<?php $i=check_field_value($form_rezayatname,"a5");
              		
              		
              ?>
<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style: solid; border-width: 1; ">
 <tr>
    <td width="400" align="right"><textarea   rows="7"  name="a5"  class="edit-user"  dir=RTL   ><? echo $i; ?></textarea></td>
    <td width="300" class="tahoma1" align="right" dir='rtl'>7.در صورت عدم تمايل به شرکت در مطالعه روش معمول درماني براي من ارائه خواهد شد که منافع و عوارض آن به اين شرح است:</td>
  </tr>
</table>

	<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; ">
		 <tr>
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl'>8.من مي دانم که دست اندرکاران اين پژوهش، کليه اطلاعات مربوط به من را نزد خود به صورت محرمانه نگه داشته و فقط اجازه دارند فقط نتايج کلي و گروهي اين پژوهش را بدون ذکر نام و مشخصات اينجانب منتشر کنند.</td>
		   </tr>
		   
	    </table>
	    
	    <table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; ">
		 <tr>
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl'>9.مي دانم که کميته اخلاق در پژوهش با هدف نظارت بر رعايت حقوق اينجانب مي تواند به اطلاعات من دسترسي داشته باشيد</td>
		   </tr>
		   
	    </table>
	    
	    <table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; ">
		 <tr>
		    
		   <td width="700"  align=right class="tahoma1" valign="top" dir='rtl'>9.مي دانم که کميته اخلاق در پژوهش با هدف نظارت بر رعايت حقوق اينجانب مي تواند به اطلاعات من دسترسي داشته باشيد</td>
		   </tr>
		   
	    </table>
	    <?php $i=check_field_value($form_rezayatname,"a7");
              		
              		
              ?>
	    <table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style: solid; border-width: 1; ">
		 <tr>
		    <td width="400" align="right"><textarea   rows="7"  name="a6"  class="edit-user"  dir=RTL   ><? echo $i; ?></textarea></td>
		    <td width="300" class="tahoma1" align="right" dir='rtl'>10.من مي دانم که هيچ يک از هزينه هاي انجام مداخلات پژوهشي به شرح ذيل بر عهده من نخواهد بود.</td>
		  </tr>
		</table>
		<?php $i=check_field_value($form_rezayatname,"a7");
              		$j=check_field_value($form_rezayatname,"a8");
              		$f=check_field_value($form_rezayatname,"a9");
              		$g=check_field_value($form_rezayatname,"a10");
              		
              ?>
		<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style: solid; border-width: 1; ">
		 <tr>
		    
		    <td width="700" class="tahoma1" align="right" dir='rtl'>11.خانم / آقاي <input type="text" name="a7" size="35" class="edit-small-2"  dir=RTL   ><? echo $i; ?></input> جهت پاسخگويي به اينجانب معرفي شد و به من گفته شد تا هر وقت مشکلي يا سوالي در رابطه با شرکت در پژوهش مذکور پيش آمد با ايشان در ميان بگذارم و راهنمايي بخواهم.<br>آدرس و شماره تلفن ثابت و همراه ايشان به شرح زير به من ارائه شد.:</br>
		    <br>آدرس:      <textarea   rows="2"  name="a8"  class="edit-user"  dir=RTL   ><? echo $j; ?></textarea></br>
		    <br>تلفن ثابت : <textarea   rows="2"  name="a9"  class="edit-user"  dir=RTL   ><? echo $f; ?></textarea></br>
		    <br>تلفن همراه: <textarea   rows="2"  name="a10"  class="edit-user"  dir=RTL   ><? echo $g; ?></textarea></br>
		    </td>
		  </tr>
		</table>
		
		<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; ">
		 <tr>
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl'>12.من مي دانم که اگر در حين و بعد از انجام پژوهش هر مشکلي اعم از جسمي و روحي به علت شرکت در اين پژوهش براي من پيش آمد درمان عوارض آن و غرامت مربوطه بر عهده مجري خواهد بود.</td>
		   </tr>
		   
	    </table>
	    
		<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; ">
		 <tr>
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl'>13.من مي دانم اگر اشکال يا اعتراضي نسبت به دست اندرکاران يا روند پژوهش دارم ميتوانم با کميته اخلاق در پژوهش دانشگاه علوم پزشکي تهران به آدرس : <b>تهران، تقاطع بلوار کشاورز و خيابان قدس، ساختمان ستاد مرکزي دانشگاه علوم پزشکي تهران، طبقه پنجم، اتاق 501</b> تماس گرفته و مشکل خود را به صورت شفاهي يا کتبي مطرح نماييم.</td>
		   </tr>
		   
	    </table>
	    
	    <table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; ">
		 <tr>
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl'>14.اين فرم اطلاعات و رضايت آگاهانه در دو نسخه تهيه شده و پس از امضا يک نسخه در اختيار من و نسخه ديگر در اختيار مجري قرار خواهد گرفت.</td>
		   </tr>
		   
	    </table>
	    
	    <table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; ">
		 <tr>
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl'><input type="submit" name="submit" value="ثبت" class="but-small"></input></td>
		   </tr>
		   
	    </table>
	    	    
	    	    
</form>


<?php 
  footer_forms($admin,$seed);
 ?>
