<script>
	function checkmas(str){
		//alert(str);
		//document.getElementsByName(str).value="no";
		document.getElementById(str).value="مورد ندارد";
		//alert("tes");

		}
</script>
<?
include("include/database-connect.phtml");
include("include/include.phtml");
header_forms($admin,$seed);
include("include/styles.phtml");


$year_date = date("Y") - 1921 ;
$today=str_replace("/","-",today());

 
echo "<br>";

function checkaddslashes($str){
    $str2 = str_replace("\'", "*****", $str);

    
        return $str2;
}
$query="select * from tarh where cod_tarh=\"$cod_tarh\" and version='-1' ";
  $result=mysql_query($query) or die("Error in updating data into tarh1");
  $my_row_fetched=mysql_fetch_array($result);
  $form_rezayatname=$my_row_fetched['form_rezayatname'];
 // echo $form_rezayatname;
  

if(strcmp($action,"sabt")==0)
  {
  		
	 	$query="update tarh set rezayatname_taype='$rezayatname_type' where cod_tarh='$cod_tarh' and version='-1'";
  	$tarh_result=mysql_query($query) or die("Error in selecting data into tarh");
  	
  }

if(strcmp($action,"add_rezayatname")==0)
  {
  	if(strlen(trim($a1)) > 0 && strlen(trim($a2)) > 0 && strlen(trim($a3)) > 0 && strlen(trim($a4)) > 0 && strlen(trim($a5)) > 0 && strlen(trim($a6)) > 0 )
  	{
  		   $i=0;    			
  	$value_form="a".$i."="."1";
      for($i=1;$i<11;$i++)
  	   {
	    $var= "a".$i;
	    
		  if(strlen(trim($value_form))<=0){
		    $value_form=$var."=".addslashes($$var);
		  }
		  else{
		    $value_form=$value_form.",".$var."=".addslashes($$var);
		  }
	     
	   $value_form=checkaddslashes($value_form);
  	   }
  	  $value_form=checkaddslashes($value_form);
  	$query="update tarh set form_rezayatname='$value_form' where cod_tarh='$cod_tarh' and version='-1'";
  	$tarh_result=mysql_query($query) or die("Error in selecting data into tarh");
  	message_show(".فرم رضايت نامه ثبت شد","green");
  	
  	 ?>
        <script language="javascript">
        window.location="<? echo "sabt_tarh_second.phtml?admin=$admin&seed=$seed&cod_tarh=$cod_tarh";  ?>";
        </script>
        <?
  	
  	}
  	 else
      $status="entry_error";  

      
    
  }
  
  $query="select * from tarh where cod_tarh=\"$cod_tarh\" and version='-1' ";
  $result=mysql_query($query) or die("Error in updating data into tarh1");
  $my_row_fetched=mysql_fetch_array($result);
  $form_rezayatname=$my_row_fetched['form_rezayatname'];
  $rezayatname_type=$my_row_fetched['rezayatname_taype'];
  
 //echo $form_rezayatname;

    echo "<form name=\"sabt_tarh1\" method=\"post\"  action=\"$PHP_SELF?action=sabt&admin=$admin&seed=$seed&cod_tarh=$cod_tarh\">"; ?>
 
  
  <table border='1' width='50%' cellspacing="0" cellpadding="0" bordercolor="white" bgcolor='#EEE7F8' dir='rtl'>
<tr>
<td colspan='8' align='center' class='tahoma1'><b>
آيا در پژوهش شما سوژه انساني فاقد "صلاحيت قانوني" يا "ظرفيت تصميم گيري" به عنوان مثال(کودک، ناتوان ذهني، بيمار سايکوتيک، بيمار با کاهش سطح هوشياري و ...) جهت اعلام رضايت معتبر وجود دارد؟</b>
</td>
</tr>
<?
  
 	$select="";
  echo "<tr><td class='tahoma1' align='right' width='20%'><input type='radio' name='rezayatname_type2' $select value='1'>•	بلي</td></tr>";
  
 	$select="";
  echo "<tr><td class='tahoma1' align='right' width='20%'><input type='radio' name='rezayatname_type2' $select value='2'>•	خير</td></tr>";

?>
 

</table>
  <table border='1' width='50%' cellspacing="0" cellpadding="0" bordercolor="white" bgcolor='#EEE7F8' dir='rtl'>
<tr>
<td colspan='8' align='center' class='tahoma1'><b>
با توجه به پاسخ شما به سوال فوق  چه کسي فرم رضايت نامه را تکميل مي نمايد؟</b>
</td>
</tr>
<?
 if($rezayatname_type=='1')
 	$select="checked=\"checked\"";
 	else 
 	$select="";
  echo "<tr><td class='tahoma1' align='right' width='20%'><input type='radio' name='rezayatname_type' $select value='1'>•	سوژه پژوهش</td></tr>";
  if($rezayatname_type=='2')
 	$select="checked=\"checked\"";
 	else 
 	$select="";
  echo "<tr><td class='tahoma1' align='right' width='20%'><input type='radio' name='rezayatname_type' $select value='2'>•	تصميم گيرنده جايگزين(ولي/وکيل قانوني/قيم و ...)</td></tr>";
if($rezayatname_type=='3')
 	$select="checked=\"checked\"";
 	else 
 	$select="";
  echo "<tr><td class='tahoma1' align='right' width='20%'><input type='radio' name='rezayatname_type' $select value='3'>•	هر دو</td></tr>";

?>
 
<tr>
<td colspan='8' align='center' class='tahoma1' >
<input type="submit" value="ثبت" name="B1" class="but-small">
</td>
</tr>
</table>
         <?
  echo "</form>";
  
  
  
  echo "<form name=\"sabt_tarh\" method=\"post\"  action=\"$PHP_SELF?action=add_rezayatname&admin=$admin&seed=$seed&cod_tarh=$cod_tarh\">"; 
         $b=$rezayatname_type;
  
             	if($b=="1" || $b=="3")
              			
              	{           	
?>
<table border="0" width="700" >
 <tr>
    
    <td width="700" class="tahoma1" align="right" dir='rtl' height="60px"><font color='red'><b>مجري محترم جهت تکميل صحيح فرم رضايت نامه لطفا به اطلاعات منتشر شده در جلو هر سوال که با آيکن <img border="0" src="image/kdeprint_printer_infos.png" width="20" height="20" alt="Information" >مشخص شده توجه کنيد </b></font></td>
  </tr>
  <tr>
  </tr>
  <?php   if (strcmp($status,"entry_error")==0 )
  {
    echo "<tr>";
    echo "<td align=\"center\" class=\"error-message\" width=\"25%\" class=\"tahoma1\" colspan=\"2\">مواردي که با ستاره مشخص شده اند را بطور کامل پر کنيد</td>";
    echo "</tr>";
  }
  ?>
</table>
<?php $i=check_field_value($form_rezayatname,"a1");
              	if($i=="-1")
              			$i="";	
              		

              			?>
              			
              			<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; pading_top:20px; ">
		 <tr>
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl' style="pading:20px 20px 10px;">مجري محترم<br>در تنظيم فرم رضايت آگاهانه پژوهش خود به نکات کلي ذيل توجه کنيد<br><br>1)فرم رضايت آگاهانه بايد منطبق با اطلاعات مربوط به پژوهش و به زبان غير تخصصي و قابل فهم براي سواد حدود پنجم ابتدايي تنظيم شود<br><br>2) شما در تنظيم فرم ميتوانيد براي مفهوم تر و روانتر شدن متن، جملات از پيش نوشته شده اين فرم را تغيير دهيد اما روال منطقي ارائه اطلاعات به همين ترتيبي است که در بند هاي اين فرم برايتان آورده شده است.<br><br>3) در خصوص تک تک بند ها به توضيحاتي که به صورت کامنت براي تنظيم بهتر آورده شده است توجه کنيد.<br><br></br>4) توصيه ميشود فرم را پس از تنظيم و قبل از ارسال ، به چند نفر ازمردم معمولي بدهيد تا مفهوم بودن محتواي آن را بررسي کنند و اصلاحات لازم براي بهبود متن را اعمال نماييد.</td>
		   </tr>
	    </table>
              			
<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style: solid; border-width: 1; pading:20px 20px 10px;">



 <tr>
 	
    <td width="400" align="right"><textarea   rows="7"  name="a1" id="a1" class="edit-user"  dir=RTL   ><? echo $i;  ?></textarea></td>
    <td width="300" class="tahoma1" align="right" dir='rtl'><span class="star-message">*</span>1.من مي دانم که اهداف اين پژوهش عبارتند از:<span   onmouseover="showToolTip(event,' عين عبارت هدف پروپوزال را کپي نکنيد بلکه با جملاتي که براي مردم قابل فهم باشد هدف را براي شرکت کنندگان توضيح دهيد');return false" onmouseout="hideToolTip()"><img border="0" src="image/kdeprint_printer_infos.png" width="20" height="20" alt="Information" ></span></td>
  </tr>
</table>
	 <table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; pading_top:20px; ">
		 <tr>
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl' style="pading:20px 20px 10px;">2.من مي دانم شرکت من در اين پژوهش کاملا داوطلبانه است و مجبور به شرکت در اين پژوهش نيستم<br>  به من اطمينان داده شد که اگر حاضر به شرکت در اين پژوهش نباشم، از مراقبت هاي معمول تشخيصي و درماني محروم نخواهم شد و رابطه درماني من بامرکز درماني و پرشک معالج دچار اشکال نشود</td>
		   </tr>
	    </table>

<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; pading_top:20px;">
		 <tr>
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl'>3.من مي دانم که حتي پس از موافقت با شرکت در پژوهش مي توانم هر وقت که بخواهم، پس از اطلاع به مجري، از پژوهش خارج شوم و خروج من از پژوهش باعث محروميت از دريافت خدمات درماني معمول براي من نخواهد شد.</td>
		   </tr>
		   
	    </table>
	    
	<?php $i=check_field_value($form_rezayatname,"a2");
              		if($i=="-1")
              			$i="";
              		
              ?>    
<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style: solid; border-width: 1; pading_top:20px;">
 <tr>
 	
    <td width="400" align="right"><textarea   rows="7"  name="a2" id="a2"  class="edit-user"  dir=RTL   ><? echo $i; ?></textarea></td>
    <td width="300" class="tahoma1" align="right" dir='rtl'><span class="star-message">*</span>4.نحوه ي همکاري اينجانب در اين پژوهش به اين صورت است:<span   onmouseover="showToolTip(event,'   در اين بخش بسته به پژوهش خود براي شرکت کنندگان به زبان ساده توضيح دهيد که:  چه مداخله اي بر روي آنها صورت ميگيرد \nچه اطلاعاتي از آنها ميپرسند\nچه اقدامات پاراکلينيکي بر روي آنها انجام ميشود\nچه نمونه اي و با چه حجمي و در چند نوبت از آنها ميگيريد\nهمکاري در اين پژوهش چه مدت طول ميکشد\nدر اين مدت چند نوبت مراجعه بايد داشته باشيد و به چه فواصلي\nهر نوبت مراجعه چقدر وقت آنها را ميگيرد\nدر فواصل مراجعه چه اقداماتي را بايد انجام دهيد\nچه اقداماتي را در پيگيري آنها انجام ميدهيد	\nاگر بطور رندوم در يکي از گروه هاي درماني قرار ميگيريد اين واقعيت به آنها ذکر شود\n اگر هزينه صرف وقت و رفت و آمد شرکت کنندگان را نيز جبران خواهيد کرد ');return false" onmouseout="hideToolTip()"><img border="0" src="image/kdeprint_printer_infos.png" width="20" height="20" alt="Information" ></span></td>
  </tr>
</table>
<?php $i=check_field_value($form_rezayatname,"a3");
              	if($i=="-1")
              			$i="";	
              		
              ?>
<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style: solid; border-width: 1; ">
 <tr>
 	
    <td width="400" align="right"><textarea   rows="7"  name="a3"  class="edit-user"  dir=RTL   ><? echo $i; ?></textarea></td>
    <td width="300" class="tahoma1" align="right" dir='rtl'><span class="star-message">*</span>5.منافع احتمالي شرکت اينجانب در اين پژوهش به شرح زير است:<span   onmouseover="showToolTip(event,'در اينجا ميتوانيد سود بالقوه اي که شرکت کنندگان ميتوانند از شرکت در اين پژوهش  ببرند بنويسيد. اين سود ميتواند شرح احتمال درمان يا تشخيص بهتر بيماريشان،دريافت خدمات سلامت رايگان و يا پرداخت مشوق مالي در ازاي جبران همکاريشان باشد. اگر پژوهش سود مستقيمي براي شرکت کننده ندارد دقيقا به آن اشاره کنيد و ميتوانيد اينکه شرکت آنها در پژوهش ميتواند به بهبود روشهاي تشخيصي و درماني کمک کند را ذکر کنيد.');return false" onmouseout="hideToolTip()"><img border="0" src="image/kdeprint_printer_infos.png" width="20" height="20" alt="Information" ></span></td>
  </tr>
</table>
	<?php $i=check_field_value($form_rezayatname,"a4");
              		
              		if($i=="-1")
              			$i="";
              ?>    
<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style: solid; border-width: 1; ">
 <tr>
 	
    <td width="400" align="right"><textarea   rows="7"  name="a4"  class="edit-user"  dir=RTL   ><? echo $i; ?></textarea></td>
    <td width="300" class="tahoma1" align="right" dir='rtl'><span class="star-message">*</span>6.آسيب ها و عوارض احتمالي شرکت در اين پژوهش به اين شرح است:<span   onmouseover="showToolTip(event,'منظور عوارض و ميزان احتمال بروز آنها در اين پژوهش  است');return false" onmouseout="hideToolTip()"><img border="0" src="image/kdeprint_printer_infos.png" width="20" height="20" alt="Information" ></span></td>
  </tr>
</table>
<?php $i=check_field_value($form_rezayatname,"a5");
              		if($i=="-1")
              			$i="";
              		
              ?>
<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style: solid; border-width: 1; ">
 <tr>
 
    <td width="400" align="right"><textarea   rows="7"  name="a5"  class="edit-user"  dir=RTL   ><? echo $i; ?></textarea></td>
    <td width="300" class="tahoma1" align="right" dir='rtl'><span class="star-message">*</span>7.در صورت عدم تمايل به شرکت در پژوهش خدمات معمول (درماني، تشخيصي و ...) براي من ارائه خواهد شد که منافع و عوارض آن به اين شرح است:<span   onmouseover="showToolTip(event,'براي آنکه شرکت کننده بتواند ارزيابي مناسبي از سود و زيان شرکت در پژوهش شما داشته باشد لازم است بتواند سود و زيان مداخلات معمول و مداخلات اين پژوهش را مقايسه کند. به عنوان مثال ميزان موفقيت و ميزان عوارض هر يک را مقايسه کند.');return false" onmouseout="hideToolTip()"><img border="0" src="image/kdeprint_printer_infos.png" width="20" height="20" alt="Information" ></span></td>
  </tr>
</table>

	<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; ">
		 <tr>
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl'>8.من مي دانم که دست اندرکاران اين پژوهش، کليه اطلاعات مربوط به من را نزد خود به صورت محرمانه نگه داشته و فقط اجازه دارند نتايج کلي و گروهي اين پژوهش را بدون ذکر نام و مشخصات اينجانب منتشر کنند.</td>
		   </tr>
		   
	    </table>
	    
	    <table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; ">
		 <tr>
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl'>9.مي دانم که کميته اخلاق در پژوهش با هدف نظارت بر رعايت حقوق اينجانب مي تواند به اطلاعات من دسترسي داشته باشيد</td>
		   </tr>
		   
	    </table>
	    
	    
	    <?php $i=check_field_value($form_rezayatname,"a6");
              		if($i=="-1")
              			$i="";
              		
              ?>
	    <table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style: solid; border-width: 1; ">
		 <tr>
		 
		    <td width="400" align="right"><textarea   rows="7"  name="a6"  class="edit-user"  dir=RTL   ><? echo $i; ?></textarea></td>
		    <td width="300" class="tahoma1" align="right" dir='rtl'><span class="star-message">*</span>10.من مي دانم که هيچ يک از هزينه هاي انجام اقدامات پژوهشي به شرح ذيل بر عهده من نخواهد بود.<span   onmouseover="showToolTip(event,'تمام اقدامات پژوهشي بايد براي بيمار رايگان باشد و بيمار بداند شامل چه مواردي هستند. در ذيل اين بند اقداماتي که در طي اين پژوهش براي بيمار رايگان انجام ميشود را فهرست کنيد.');return false" onmouseout="hideToolTip()"><img border="0" src="image/kdeprint_printer_infos.png" width="20" height="20" alt="Information" ></span></td>
		  </tr>
		</table>
		<?php $i=check_field_value($form_rezayatname,"a7");
		if($i=="-1")
              			$i="";
              		$j=check_field_value($form_rezayatname,"a8");
              		if($j=="-1")
              			$j="";
              		$f=check_field_value($form_rezayatname,"a9");
              		if($f=="-1")
              			$f="";
              		$g=check_field_value($form_rezayatname,"a10");
              		if($g=="-1")
              			$g="";
              		
              ?>
		<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style: solid; border-width: 1; ">
		 <tr>
		    
		    <td width="700" class="tahoma1" align="right" dir='rtl'>11.خانم / آقاي <input type="text" name="a7" size="35" class="edit-small-2" value="<? echo $i; ?>" dir=RTL   ></input> جهت پاسخگويي به اينجانب معرفي شد و به من گفته شد تا هر وقت مشکلي يا سوالي در رابطه با شرکت در پژوهش مذکور پيش آمد با ايشان در ميان بگذارم و راهنمايي بخواهم.<br>آدرس و شماره تلفن ثابت و همراه ايشان به شرح زير به من ارائه شد.:</br>
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
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl'>13.من مي دانم اگر اشکال يا اعتراضي نسبت به دست اندرکاران يا روند پژوهش دارم ميتوانم با کميته اخلاق در پژوهش دانشگاه علوم پزشکي تهران به آدرس : <b>تهران، تقاطع بلوار کشاورز و خيابان قدس، ساختمان ستاد مرکزي دانشگاه علوم پزشکي تهران، طبقه ششم، اتاق 605</b> تماس گرفته و مشکل خود را به صورت شفاهي يا کتبي مطرح نماييم.</td>
		   </tr>
		   
	    </table>
	    
	    <table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; ">
		 <tr>
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl'>14.اين فرم اطلاعات و رضايت آگاهانه در دو نسخه تهيه شده و پس از امضا يک نسخه در اختيار من و نسخه ديگر در اختيار مجري قرار خواهد گرفت.</td>
		   </tr>
		   
	    </table>
	    <table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; ">
		 <tr>
		    
		    <td width="700"  align="center" class="tahoma1" valign="top" dir='rtl'><input type="submit" name="submit" value="ثبت" class="but-small"></input></td>
		   </tr>
		   
	    </table>
	    <?php }
	    else if($b=="2"){
	    	?>
	    <table border="0" width="700" >
 <tr>
    
    <td width="700" class="tahoma1" align="right" dir='rtl' height="60px"><font color='red'><b>مجري محترم جهت تکميل صحيح فرم رضايت نامه لطفا به اطلاعات منتشر شده در جلو هر سوال که با آيکن <img border="0" src="image/kdeprint_printer_infos.png" width="20" height="20" alt="Information" >مشخص شده توجه کنيد </b></font></td>
  </tr>
  <tr>
  </tr>
  <?php   if (strcmp($status,"entry_error")==0 )
  {
    echo "<tr>";
    echo "<td align=\"center\" class=\"error-message\" width=\"25%\" class=\"tahoma1\" colspan=\"2\">مواردي که با ستاره مشخص شده اند را بطور کامل پر کنيد</td>";
    echo "</tr>";
  }
  ?>
</table>
<?php $i=check_field_value($form_rezayatname,"a1");
              	if($i=="-1")
              			$i="";	
              		

              			?>
              			
              			<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; pading_top:20px; ">
		 <tr>
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl' style="pading:20px 20px 10px;">مجري محترم<br>در تنظيم فرم رضايت آگاهانه پژوهش خود به نکات کلي ذيل توجه کنيد<br><br>1)فرم رضايت آگاهانه بايد منطبق با اطلاعات مربوط به پژوهش و به زبان غير تخصصي و قابل فهم براي سواد حدود پنجم ابتدايي تنظيم شود<br><br>2) شما در تنظيم فرم ميتوانيد براي مفهوم تر و روانتر شدن متن، جملات از پيش نوشته شده اين فرم را تغيير دهيد اما روال منطقي ارائه اطلاعات به همين ترتيبي است که در بند هاي اين فرم برايتان آورده شده است.<br><br>3) در خصوص تک تک بند ها به توضيحاتي که به صورت کامنت براي تنظيم بهتر آورده شده است توجه کنيد.<br><br></br>4) توصيه ميشود فرم را پس از تنظيم و قبل از ارسال ، به چند نفر ازمردم معمولي بدهيد تا مفهوم بودن محتواي آن را بررسي کنند و اصلاحات لازم براي بهبود متن را اعمال نماييد.</td>
		   </tr>
	    </table>
              			
<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style: solid; border-width: 1; pading:20px 20px 10px;">



 <tr>
 	
    <td width="400" align="right"><textarea   rows="7"  name="a1" id="a1" class="edit-user"  dir=RTL   ><? echo $i;  ?></textarea></td>
    <td width="300" class="tahoma1" align="right" dir='rtl'><span class="star-message">*</span>1.من به عنوان "ولي/وکيل قانوني/قيم" مي دانم که اهداف اين پژوهش عبارتند از:<span   onmouseover="showToolTip(event,' عين عبارت هدف پروپوزال را کپي نکنيد بلکه با جملاتي که براي مردم قابل فهم باشد هدف را براي شرکت کنندگان توضيح دهيد');return false" onmouseout="hideToolTip()"><img border="0" src="image/kdeprint_printer_infos.png" width="20" height="20" alt="Information" ></span></td>
  </tr>
</table>
	 <table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; pading_top:20px; ">
		 <tr>
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl' style="pading:20px 20px 10px;">2.من به عنوان "ولي/وکيل قانوني/قيم" مي دانم شرکت فرد "تحت قيموميت من"/"موکل من" در اين پژوهش کاملا داوطلبانه است و مجبور به شرکت در اين پژوهش نيست<br>  به من  به عنوان "ولي/وکيل قانوني/قيم" اطمينان داده شد که اگر فرد تحت "قيموميت من"/"موکل من" حاضر به شرکت در اين پژوهش نباشد، از مراقبت هاي معمول تشخيصي و درماني محروم نخواهد شد و رابطه درماني او با مرکز درماني و پرشک معالج دچار اشکال نشود</td>
		   </tr>
	    </table>

<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; pading_top:20px;">
		 <tr>
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl'>3.من  به عنوان "ولي/وکيل قانوني/قيم" مي دانم که حتي پس از موافقت با شرکت  فرد تحت "قيموميت من"/"موکل من" در پژوهش، مي توانم هر وقت که بخواهم، پس از اطلاع به مجري،او را از پژوهش خارج کنم و خروج او از پژوهش باعث محروميتش از دريافت خدمات درماني معمول نخواهد شد.</td>
		   </tr>
		   
	    </table>
	    
	<?php $i=check_field_value($form_rezayatname,"a2");
              		if($i=="-1")
              			$i="";
              		
              ?>    
<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style: solid; border-width: 1; pading_top:20px;">
 <tr>
 	
    <td width="400" align="right"><textarea   rows="7"  name="a2" id="a2"  class="edit-user"  dir=RTL   ><? echo $i; ?></textarea></td>
    <td width="300" class="tahoma1" align="right" dir='rtl'><span class="star-message">*</span>4.نحوه ي همکاري فرد تحت "قيموميت من"/"موکل من" در اين پژوهش به اين صورت است:<span   onmouseover="showToolTip(event,'   در اين بخش بسته به پژوهش خود براي شرکت کنندگان به زبان ساده توضيح دهيد که:  چه مداخله اي بر روي آنها صورت ميگيرد \nچه اطلاعاتي از آنها ميپرسند\nچه اقدامات پاراکلينيکي بر روي آنها انجام ميشود\nچه نمونه اي و با چه حجمي و در چند نوبت از آنها ميگيريد\nهمکاري در اين پژوهش چه مدت طول ميکشد\nدر اين مدت چند نوبت مراجعه بايد داشته باشيد و به چه فواصلي\nهر نوبت مراجعه چقدر وقت آنها را ميگيرد\nدر فواصل مراجعه چه اقداماتي را بايد انجام دهيد\nچه اقداماتي را در پيگيري آنها انجام ميدهيد	\nاگر بطور رندوم در يکي از گروه هاي درماني قرار ميگيريد اين واقعيت به آنها ذکر شود\n اگر هزينه صرف وقت و رفت و آمد شرکت کنندگان را نيز جبران خواهيد کرد ');return false" onmouseout="hideToolTip()"><img border="0" src="image/kdeprint_printer_infos.png" width="20" height="20" alt="Information" ></span></td>
  </tr>
</table>
<?php $i=check_field_value($form_rezayatname,"a3");
              	if($i=="-1")
              			$i="";	
              		
              ?>
<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style: solid; border-width: 1; ">
 <tr>
 	
    <td width="400" align="right"><textarea   rows="7"  name="a3"  class="edit-user"  dir=RTL   ><? echo $i; ?></textarea></td>
    <td width="300" class="tahoma1" align="right" dir='rtl'><span class="star-message">*</span>5.منافع احتمالي شرکت فرد تحت "قيموميت من"/"موکل من" در اين پژوهش به شرح زير است:<span   onmouseover="showToolTip(event,'در اينجا ميتوانيد سود بالقوه اي که شرکت کنندگان ميتوانند از شرکت در اين پژوهش  ببرند بنويسيد. اين سود ميتواند شرح احتمال درمان يا تشخيص بهتر بيماريشان،دريافت خدمات سلامت رايگان و يا پرداخت مشوق مالي در ازاي جبران همکاريشان باشد. اگر پژوهش سود مستقيمي براي شرکت کننده ندارد دقيقا به آن اشاره کنيد و ميتوانيد اينکه شرکت آنها در پژوهش ميتواند به بهبود روشهاي تشخيصي و درماني کمک کند را ذکر کنيد.');return false" onmouseout="hideToolTip()"><img border="0" src="image/kdeprint_printer_infos.png" width="20" height="20" alt="Information" ></span></td>
  </tr>
</table>
	<?php $i=check_field_value($form_rezayatname,"a4");
              		
              		if($i=="-1")
              			$i="";
              ?>    
<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style: solid; border-width: 1; ">
 <tr>
 	
    <td width="400" align="right"><textarea   rows="7"  name="a4"  class="edit-user"  dir=RTL   ><? echo $i; ?></textarea></td>
    <td width="300" class="tahoma1" align="right" dir='rtl'><span class="star-message">*</span>6.آسيب ها و عوارض احتمالي شرکت در اين پژوهش به اين شرح است:<span   onmouseover="showToolTip(event,'منظور عوارض و ميزان احتمال بروز آنها در اين پژوهش  است');return false" onmouseout="hideToolTip()"><img border="0" src="image/kdeprint_printer_infos.png" width="20" height="20" alt="Information" ></span></td>
  </tr>
</table>
<?php $i=check_field_value($form_rezayatname,"a5");
              		if($i=="-1")
              			$i="";
              		
              ?>
<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style: solid; border-width: 1; ">
 <tr>
 
    <td width="400" align="right"><textarea   rows="7"  name="a5"  class="edit-user"  dir=RTL   ><? echo $i; ?></textarea></td>
    <td width="300" class="tahoma1" align="right" dir='rtl'><span class="star-message">*</span>7.در صورت عدم تمايل به شرکت در پژوهش خدمات معمول (درماني، تشخيصي و ...) براي فرد تحت "قيموميت من"/"موکل من" ارائه خواهد شد که منافع و عوارض آن به اين شرح است:<span   onmouseover="showToolTip(event,'براي آنکه شرکت کننده بتواند ارزيابي مناسبي از سود و زيان شرکت در پژوهش شما داشته باشد لازم است بتواند سود و زيان مداخلات معمول و مداخلات اين پژوهش را مقايسه کند. به عنوان مثال ميزان موفقيت و ميزان عوارض هر يک را مقايسه کند.');return false" onmouseout="hideToolTip()"><img border="0" src="image/kdeprint_printer_infos.png" width="20" height="20" alt="Information" ></span></td>
  </tr>
</table>

	<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; ">
		 <tr>
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl'>8.من به عنوان "ولي/وکيل قانوني/قيم" مي دانم که دست اندرکاران اين پژوهش، کليه اطلاعات مربوط به فرد تحت "قيموميت من"/"موکل من" را نزد خود به صورت محرمانه نگه داشته و فقط اجازه دارند نتايج کلي و گروهي اين پژوهش را بدون ذکر نام و مشخصات منتشر کنند.</td>
		   </tr>
		   
	    </table>
	    
	    <table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; ">
		 <tr>
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl'>9. من به عنوان "ولي/وکيل قانوني/قيم" مي دانم که کميته اخلاق در پژوهش با هدف نظارت بر رعايت حقوق فرد تحت "قيموميت من"/"موکل من" مي تواند به اطلاعاتش دسترسي داشته باشد </td>
		   </tr>
		   
	    </table>
	    
	    
	    <?php $i=check_field_value($form_rezayatname,"a6");
              		if($i=="-1")
              			$i="";
              		
              ?>
	    <table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style: solid; border-width: 1; ">
		 <tr>
		 
		    <td width="400" align="right"><textarea   rows="7"  name="a6"  class="edit-user"  dir=RTL   ><? echo $i; ?></textarea></td>
		    <td width="300" class="tahoma1" align="right" dir='rtl'><span class="star-message">*</span>10.من به عنوان "ولي/وکيل قانوني/قيم" مي دانم که هيچ يک از هزينه هاي انجام اقدامات پژوهشي به شرح ذيل بر عهده فرد تحت "قيموميت من"/"موکل من" نخواهد بود.<span   onmouseover="showToolTip(event,'تمام اقدامات پژوهشي بايد براي بيمار رايگان باشد و بيمار بداند شامل چه مواردي هستند. در ذيل اين بند اقداماتي که در طي اين پژوهش براي بيمار رايگان انجام ميشود را فهرست کنيد.');return false" onmouseout="hideToolTip()"><img border="0" src="image/kdeprint_printer_infos.png" width="20" height="20" alt="Information" ></span></td>
		  </tr>
		</table>
		<?php $i=check_field_value($form_rezayatname,"a7");
		if($i=="-1")
              			$i="";
              		$j=check_field_value($form_rezayatname,"a8");
              		if($j=="-1")
              			$j="";
              		$f=check_field_value($form_rezayatname,"a9");
              		if($f=="-1")
              			$f="";
              		$g=check_field_value($form_rezayatname,"a10");
              		if($g=="-1")
              			$g="";
              		
              ?>
		<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style: solid; border-width: 1; ">
		 <tr>
		    
		    <td width="700" class="tahoma1" align="right" dir='rtl'>11.خانم / آقاي <input type="text" name="a7" size="35" class="edit-small-2" value="<? echo $i; ?>" dir=RTL   ></input> جهت پاسخگويي به اينجانب معرفي شد و به من گفته شد تا هر وقت مشکلي يا سوالي در رابطه با شرکت در پژوهش مذکور پيش آمد با ايشان در ميان بگذارم و راهنمايي بخواهم.<br>آدرس و شماره تلفن ثابت و همراه ايشان به شرح زير به من ارائه شد.:</br>
		    <br>آدرس:      <textarea   rows="2"  name="a8"  class="edit-user"  dir=RTL   ><? echo $j; ?></textarea></br>
		    <br>تلفن ثابت : <textarea   rows="2"  name="a9"  class="edit-user"  dir=RTL   ><? echo $f; ?></textarea></br>
		    <br>تلفن همراه: <textarea   rows="2"  name="a10"  class="edit-user"  dir=RTL   ><? echo $g; ?></textarea></br>
		    </td>
		  </tr>
		</table>
		
		<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; ">
		 <tr>
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl'>12.من به عنوان "ولي/وکيل قانوني/قيم" مي دانم که اگر در حين و بعد از انجام پژوهش هر مشکلي اعم از جسمي و روحي به علت شرکت در اين پژوهش براي فرد تحت "قيموميت من"/"موکل من" پيش آمد درمان عوارض آن و غرامت مربوطه بر عهده مجري خواهد بود.</td>
		   </tr>
		   
	    </table>
	    
		<table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; ">
		 <tr>
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl'>13.من به عنوان "ولي/وکيل قانوني/قيم" مي دانم اگر اشکال يا اعتراضي نسبت به دست اندرکاران يا روند پژوهش دارم ميتوانم با کميته اخلاق در پژوهش دانشگاه علوم پزشکي تهران به آدرس : <b>تهران، تقاطع بلوار کشاورز و خيابان قدس، ساختمان ستاد مرکزي دانشگاه علوم پزشکي تهران، طبقه ششم، اتاق 605</b> تماس گرفته و مشکل خود را به صورت شفاهي يا کتبي مطرح نماييم.</td>
		   </tr>
		   
	    </table>
	    
	    <table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; ">
		 <tr>
		    
		    <td width="700"  align=right class="tahoma1" valign="top" dir='rtl'>14.اين فرم اطلاعات و رضايت آگاهانه در دو نسخه تهيه شده و پس از امضا يک نسخه در اختيار من به عنوان ولي/وکيل قانوني/قيم و نسخه ديگر در اختيار مجري قرار خواهد گرفت.</td>
		   </tr>
		   
	    </table>
	    <table border="0" width="700" bgcolor="#EEE7F8"   cellspacing="0" cellpadding="2"  bordercolor="#333333" style="border-style:solid; border-width: 1; ">
		 <tr>
		    
		    <td width="700"  align="center" class="tahoma1" valign="top" dir='rtl'><input type="submit" name="submit" value="ثبت" class="but-small"></input></td>
		   </tr>
		   
	    </table>
              <?php 
	    }
	    ?>
	    
	    	    
	    	    
</form>


<?php 
  footer_forms($admin,$seed);
 ?>
