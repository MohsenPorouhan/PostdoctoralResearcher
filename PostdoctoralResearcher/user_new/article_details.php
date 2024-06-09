<?php
include("include/database-connect.phtml");
include("include/include.phtml");


	//echo "<div style=''>";	
?>
	<div id="attachments_tb" class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
					<?php if($la=="en"){ ?>
						<thead>
								<th class="hidden">id</th>
								<th>No</th>
								<th>File Name</th>
								<th>Delete</th>
						</thead>
					<?php }else{ ?>
						<thead>
								<th class="hidden">id</th>
								<th>رديف</th>
								<th>نام فايل</th>
								<th>حذف</th>
						</thead>
					<?php } ?>
					<tbody>
						
							<?php
							$number_of_row=1;
							$dir_name="../maghale/".$maghale_file_id;
							if ($dir = @opendir($dir_name))
								{
								//echo $dir_name;
										$mydir = dir($dir_name);
										//while(($file = $mydir->read()) !== false)
											while($file = $mydir->read())
											{
												if( !(strcmp(trim($file),".")==0 || strcmp(trim($file),"..")==0 || strcmp(trim($file),"Thumbs.db")==0) )
												{
							
												?>
						      <tr>
								      <td><?php echo $number_of_row; ?></td>
								      <td class="hidden"><?php echo $file;?></td>
								      <td><a target="_blank" href="../maghale/<?php echo $maghale_file_id; ?>/<?php echo $file; ?>"><?php echo $file; ?></a></td>
								    	    																	
								      <td><?php echo "<a class=\"btn delete_buttun_file\" id=\"$file\" onclick=delete_element('$file','$maghale_file_id') data-toggle=\"modal\" href=\"#delete_article_file\" ><i class=\"fa fa-trash-o\" ></i></a>";?></td>
						    	    																	
						      </tr>
						      <?php 
						      $number_of_row++;
						    }
						    	    																		
						    }
						   closedir($dir);
						   }
						   ?>
				    	    																
				  </tbody>
		  </table>
  </div>
	<?php 																	
	//echo "</div>";
  ?>