<?php
	global $root;
	$error = $_GET['error'];
?>

<div>
	<div class="row">
		<div class="col-lg-12">
			<h1>Forgotten Password</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<blockquote>
			  <p>
				Please insert your Username and email to recover your password
			  </p>				  
			</blockquote>
	</div>
</div>




<br>
    <!-- Start Main Body Wrap -->
    <div id="main-wrap">

		<!-- Start Box -->
		<div class="boxes-full">

			<div id="main-content-page" class="boxes-padding fullpadding">

				<!-- Start None Split Section -->
				<div class="splitnone">
				
             		<form method="post" name="form_update_profile" id="form_update_profile" class="form-horizontal" role="form" 
						action="<?=$root?>controllers/loginController.php?action=sendpassword">
							
						  <div class="form-group">
							<label for="nick" class="col-sm-2 control-label">Username</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="username_sp" id="username_sp" placeholder="username" value="" required>
							</div>
						  </div>
						  
						  <div class="form-group">
							<label for="nick" class="col-sm-2 control-label">E-mail</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" name="mail_sp" id="mail_sp" placeholder="mail" value="" required>
							</div>
						  </div>						  
						  

							<div class="form-group">
								<label for="nick" class="col-sm-2 control-label">&nbsp;</label>
								<div class="col-sm-10">
									<button type="submit" class="btn btn-default">Recover password</button>	
								</div>
							</div>


					
					<?php
						if (strlen($messageText) > 0){
					?>
						<tr>
							<td colspan="2" style="color:red;">
								<?php echo $messageText; ?>
							</td>
						</tr>

					<?php }?>

					</form>     				
	
				</div>
				<!-- End Portfolio Filter -->

			</div>
			<!-- End None Split Section -->

		</div>

		<span class="box-arrow"> </span>

	</div>
	<!-- End Box -->
