<?
include("include/database-connect.phtml");
include("include/include.phtml");
//echo $cod_tarh." ".$action." ".$name_var." ".$var_type;

if(isset($action))
{
  if (strcmp($action,"sabt")==0)
  {

     if(strlen(trim($name_var)) > 0 &&  strlen(trim($var_type)) > 0)
     {
      $query="select * from jadval_zarayeb where  name_var=\"$name_var\" and var_type=\"$var_type\" and cod_tarh=\"$cod_tarh\"  and version='-1'";
      $result=mysql_query($query) or die("Error in selecting data from  jadval zarayeb ");
      if ( mysql_num_rows($result) <= 0 )
      {


        $query  = "insert into jadval_zarayeb set name_var=\"$name_var\" , naghsh_var=\"$naghsh_var\",taarif_elmi_amali=\"$taarif_elmi_amali\",var_type=\"$var_type\",meghyas=\"$meghyas\",ravesh_andaze=\"$ravesh_andaze\",cod_tarh=\"$cod_tarh\" ";
        $result = mysql_query($query) or die("Error in inserting data into jadval zarayeb");

       $query="select * from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='5'";
       $result=mysql_query($query) or die("Error in selecting data from  jadval zarayeb ");
       if ( mysql_num_rows($result) <= 0 )
       {
      		$query="insert into tarh_exist_item set cod_tarh='$cod_tarh',item_id='5'";
       		$result=mysql_query($query) or die("Error in selecting data from  jadval zarayeb ");
       		echo "exist";
       }
        $action="ثبت جدول ضرائب"."<br>".$name."&nbsp;&nbsp;".$family;
        set_log($action,$admin,date("Y-d-m"));

      }
      else
       {
        $status="duplicate_entry";
       }
     }
  }
if (strcmp($action,"edit")==0)
  {

     if(strlen(trim($name_var)) > 0 &&  strlen(trim($var_type)) > 0)
     {
      
       $query  = "update   jadval_zarayeb set name_var=\"$name_var\" , naghsh_var=\"$naghsh_var\",taarif_elmi_amali=\"$taarif_elmi_amali\",var_type=\"$var_type\",meghyas=\"$meghyas\",ravesh_andaze=\"$ravesh_andaze\",new_update='1' where cod_zarib='$cod_zarib' and version='-1' ";
        $result = mysql_query($query) or die("Error in inserting data into jadval zarayeb");

       
        $action="ويرايش جدول ضرائب"."<br>".$name."&nbsp;&nbsp;".$family;
        set_log($action,$admin,date("Y-d-m"));

     
     }
  }
if (strcmp($action,"delete")==0)
  {

	  	
      
        $query  = "delete from  jadval_zarayeb  where cod_zarib='$cod_zarib' ";
        $result = mysql_query($query) or die("Error in inserting data into jadval zarayeb");
		
        $query="select * from jadval_zarayeb where   cod_tarh=\"$cod_tarh\"  and version='-1'";
	    $result=mysql_query($query) or die("Error in selecting data from  jadval zarayeb ");
	    if ( mysql_num_rows($result) <= 0 )
	    {
	    	$query="delete from tarh_exist_item where cod_tarh='$cod_tarh' and item_id='5'";
       		$result=mysql_query($query) or die("Error in selecting data from  jadval zarayeb ");
       		echo "notexist";
	    }
       
        $action="حذف از جدول ضرائب"."<br>".$name."&nbsp;&nbsp;".$family;
        set_log($action,$admin,date("Y-d-m"));

  }
  
}
     // name moteghayer va naghshe an baraye bare dovvom
     
