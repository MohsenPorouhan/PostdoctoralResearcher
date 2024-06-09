<?
include("include/database-connect.phtml");
include("include/include.phtml");
if (strcmp($action,"finish")==0)
  {
   
      $query="select * from tarh where cod_tarh='$cod_tarh' and version='-1'";

      $result=mysql_query($query) or die("Error in selecting data from karshenas elmi ");
      
      if ( mysql_num_rows($result) == 1)
      {
      	  if ( strlen(trim($archieve_reason)) > 0)
	      {
		
			$query="update tarh  set unlock_reason='$archieve_reason',edit_request=\"1\" where  cod_tarh='$cod_tarh' and version='-1'";
			//echo $query;
	        $result=mysql_query($query) or die("Error in inserting data into karshenas elmi");
	        $action="درخواسا ويزايش طرح"."<br>".$tarh_name;
	   
	        set_log($action,$admin,date("Y-m-d, g:i a"));
	      }		
      }
    
  }
  echo $cod_tarh;
  ?>