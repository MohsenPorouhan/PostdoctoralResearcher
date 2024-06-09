<?
include("include/database-connect.phtml");
include("include/include.phtml");


																											    $query="select * from issn where p_issn like '$search_val%' order by journal_title  ";
																											    $qresult=mysql_query($query) or die("Error in selecting data from daraje elmi");
																											    //$groupcount = mysql_num_rows($qresult);
																											    ?>
																											
																												
																											    <?
																											    while($row_fetched=mysql_fetch_array($qresult))
																											    {
																											  
																											         echo "<li> <a onclick=\"test();\" id=\"".$row_fetched["issn_id"]."\">".$row_fetched["p_issn"]."</a></li>";
																											    }
																											    ?>																        
																											
																											   