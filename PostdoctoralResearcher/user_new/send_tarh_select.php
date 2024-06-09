<?
//include("include/database-connect.phtml");
//include("include/include.phtml");

if(isset($action))
{
	if(strcmp($action,'sabt')==0)
	{
	 if(strcmp($tarh_select,'6')!=0)
	 {	
	 	if(strcmp($tarh_select,'10')==0){
	    ?>
           <script language="javascript">
           var answer = confirm ("?آيااطمينان داريد طرح شما خدماتي است و کل اعتبار آن از خارج از دانشگاه تامين ميشود");
           if (answer)
        	   window.location="<? echo "sabt_tarh.phtml?admin=$admin&seed=$seed&tarh_select=$tarh_select";  ?>";
           else
        	   window.location="<? echo "send_tarh_select.phtml?admin=$admin&seed=$seed";  ?>";
           
           </script>
           <?
	 	}
	 	else{
	 	?>
	 	<script language="javascript">
           
        	   window.location="<? echo "sabt_tarh.phtml?admin=$admin&seed=$seed&tarh_select=$tarh_select";  ?>";
           
           </script>
	 	<?
	 	}
	 }	
	 else
	 {	
	    ?>
           <script language="javascript">
           window.location="<? echo "hsr_confirm.phtml?admin=$admin&seed=$seed&tarh_select=$tarh_select ";  ?>";
           </script>
           <?
	 }	   	
	}
}