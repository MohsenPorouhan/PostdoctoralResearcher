<?
include("include/database-connect.phtml");
include("include/include.phtml");

           
      $query1="select * from karshenas_shora_tarh where cod_tarh='$cod_tarh' ";
      $result1=mysql_query($query1) or die("Error in selecting data from group_karshenasan_tarh");
      
      $query="select * from karshenas_shora_tarh_note where cod_tarh='$cod_tarh' ";
      $result=mysql_query($query) or die("Error in selecting data from group_karshenasan_tarh");
      
      
      if(mysql_num_rows($result1) > 1 || mysql_num_rows($result) > 0)
	  {
	  	?>
	  		<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="sample_1">
                                    <thead>
                                        <tr>
                                            <th>
                                                رديف
                                            </th>
                                            <th>
                                                کد کارشناس
                                            </th>
                                            <th>
                                                 تاريخ نظر دهي
                                            </th>
                                            <th>
                                                نظر شما
                                            </th>
                                        </tr>
                                    </thead>
                                   <tbody>
                                   <?
                                   $cnt=0;
                                   while($row_fetched=mysql_fetch_array($result1))
 								   {
 								      $note_date=$row_fetched["note_date"]; 								      
								      $comment_karshenas=$row_fetched["notes"];
								      $cod_karshenas=$row_fetched["cod_karshenas"];
								      // $comment_karshenas = str_replace ( "&#1740;" ,"&#1610;", $comment_karshenas );
								      //$comment_karshenas= iconv('utf-8', 'windows-1256', $comment_karshenas);
 								   	  
 								   	  if(strlen($comment_karshenas)>1)
 								   	  {
 								   	  	$cnt++;
	 								  ?>
	 								   	<tr>
	                                            <th>
	                                                <? echo $cnt;?>
	                                            </th>
	                                            <th>
	                                                 <? echo $cod_karshenas;?>
	                                            </th>
	                                            <th>
	                                                 <? echo $note_date;?>
	                                            </th>
	                                            <th>
	                                                <? echo $comment_karshenas;?>
	                                            </th>
	                                        </tr>
	 								  <?
 								   	  }
								   }
	  							  ?>
	  							  <?
                                  
                                   while($row_fetched=mysql_fetch_array($result))
 								   {
 								      $note_date=$row_fetched["note_date"]; 								      
								      $comment_karshenas=$row_fetched["notes"];
								      $cod_karshenas=$row_fetched["cod_karshenas"];
								      //$comment_karshenas = str_replace ( "&#1740;" ,"&#1610;", $comment_karshenas );
								      //$comment_karshenas= iconv('utf-8', 'windows-1256', $comment_karshenas);
 								   	  
 								   	 
 								   	  	$cnt++;
	 								  ?>
	 								   	<tr>
	                                            <th>
	                                                <? echo $cnt;?>
	                                            </th>
	                                            <th>
	                                                 <? echo $cod_karshenas;?>
	                                            </th>
	                                            <th>
	                                                 <? echo $note_date;?>
	                                            </th>
	                                            <th>
	                                                <? echo $comment_karshenas;?>
	                                            </th>
	                                        </tr>
	 								  <?
 								   	  
								   }
	  							  ?>
                                   </tbody>
                                </table>
                                </div>
	  	<?
	  }
	 
    

	
  

?>
