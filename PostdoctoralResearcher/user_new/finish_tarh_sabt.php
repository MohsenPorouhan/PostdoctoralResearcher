<?php
if(isset($action))
{
	if (strcmp($action,"finish")==0)
	{
		 
		$query="select * from tarh where cod_tarh='$cod_tarh' ";

		$result=mysql_query($query) or die("Error in selecting data from karshenas elmi ");

		if ( mysql_num_rows($result) >0  )
		{
			$row_fetched=mysql_fetch_array($result);
			$payannameh=$row_fetched["payannameh"];
			$first_ostad=$row_fetched["first_ostad"];
			//echo $first_ostad;
			if(strcmp($payannameh,'1')==0 && strcmp($first_ostad,'')==0){

				//message_show("خاتمه و ارسال پايان نامه مورد نظر بدليل عدم ثبت  <a href='ostad_rahnama.phtml?admin=$admin&seed=$seed&cod_tarh=$cod_tarh&tarh_select=$tarh_select&form_id=2'>استاد راهنما</a> انجام نشد.لطفا پس از وارد کردن استاد راهنما اقدام به خاتمه و ارسال کنيد.","red");
				echo "ostad_empty";
				exit();
			}
			else {
				$now_date=date("Y-m-d");
				$query="update tarh set  finished='1',first_letter='0',last_ver_date='$now_date' where cod_tarh='$cod_tarh' and version='-1'  ";
					
				$result=mysql_query($query) or die("Error in inserting data into karshenas elmi");
				$action="طرح خاتمه يافت"."<br>".$tarh_name;
				$query="delete from edit_field where cod_tarh='$cod_tarh'";
				//echo $query;
				$result=mysql_query($query) or die("Error 99");
	    
				set_log($action,$admin,date("Y-m-d, g:i a"));
				//message_show(".ويرايش خاتمه يافت","green");
				//echo 'ويرايش خاتمه يافت';
				echo "finish";
				exit();
				
			}
			 

		}

	}
}
?>