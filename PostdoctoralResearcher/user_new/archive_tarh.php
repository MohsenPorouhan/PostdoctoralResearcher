<?
include("include/database-connect.phtml");
include("include/include.phtml");





if(isset($action))
{
  if (strcmp($action,"finish")==0)
  {
   
      $query="select * from tarh where cod_tarh='$cod_tarh' ";
 
      $result=mysql_query($query) or die("Error in selecting data from karshenas elmi 1");
      
      if ( mysql_num_rows($result) >0  )
      { // echo "salaaaaaaaam";
      	if(strcmp($unarch,"1")==0)
    	 $query="update tarh set  archieved =0 where cod_tarh='$cod_tarh' and version='-1' ";
    	else 
    	  $query="update tarh set  archieved =1, archieve_reason ='$archieve_reason' where cod_tarh='$cod_tarh' and version='-1' ";  
         
		$result=mysql_query($query) or die("Error in inserting data into karshenas elmi");
        if(strcmp($unarch,"0")==0)
        {        
		  insert_position($cod_tarh,"21",$admin);
        }
		 else
		 { 
		 $myq="select * from tarh_position where cod_tarh='$cod_tarh' order by id desc";
		 $res=mysql_query($myq) or die("Error");
		 if(mysql_num_rows($res) > 1)
		 {
		 	$crnt=mysql_fetch_array($res);
		 	$crnt=mysql_fetch_array($res);
		 	$prev_pos=$crnt["position"];
		 	
		  }	
		    insert_position($cod_tarh,"$prev_pos",$admin);
		 } 
		 if(strcmp($unarch,"0")==0)	
            $action="آرشيو طرح"."<br>".$tarh_name;
         else
		    $action="خروج از آرشيو طرح"."<br>".$tarh_name;   
       // savelog("$admin","any","Remove tarh $cod_tarh from archieved list");
      set_log($action,$admin,date("Y-m-d, g:i a"));
      }
    
  }
}
echo $cod_tarh; 

?>


