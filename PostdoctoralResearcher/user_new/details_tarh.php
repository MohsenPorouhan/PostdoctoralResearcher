<?php 
include("include/database-connect.phtml");
include("include/include.phtml");
include("include/vars.inc.phtml");
       
if(isset($action)){
	
////////////////////////////////////////////////////////////////////////////	
		if(strcmp($action,"archive")==0){
				       	?>	       	
						<input id="cod_tarh" name="cod_tarh" type="hidden" class="form-control" value="<?php echo $cod_tarh;?>">
				        <div class="form-body">
					    	<div class="alert alert-danger display-hide">
									<button class="close" data-close="alert"></button>
								    پر کردن فيلدهاي ستاره دار اجباري مي باشد.
							</div>
								<div class="row">
								<div class="col-md-9 col-md-push-1">
										<div class="form-group">
											<label class="control-label col-md-3">دليل آرشيو طرح</label>
											<div class="col-md-9">
													<textarea id="archieve_reason" name="archieve_reason" rows="7" cols="64"></textarea>
											</div>
										</div>
									</div>
								</div>
								
						</div>
						

		
		<?php 
		}
		

}
    ?>