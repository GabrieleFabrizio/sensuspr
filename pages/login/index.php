<?php //TODO: Login - controlli javascript x form nel caso campi html5 obbligatori e email 
	global $root;
?>

<div>
	<div class="row">
		<div class="col-lg-12">
        				<?php if ($_SESSION['authorized']=="true"){ ?>
                    
				            <h2 class="text--center"><br/><br/></br/>User: <?=$_SESSION['user_username']?></h2>
										  
				<?php } ?>
		</div>
	</div>
</div>

<br/>
               	  
	<?php if ($_SESSION['authorized']=="true"){ ?>
		
		<?php /* foreach($login->Profile as $profile) {?>
									
		<div class="row">
        <br/><br/>
		<!-- form dati -->
		<form method="post" name="form_update_data" id="form_update_data" class="form-horizontal" role="form" action="<?=$root?>?page=login&step=index&operator=update">
		
		 <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4" align="right"> 
		 <br/><br/>
		 First name:<br/><br/><br/><br/>
		 Last Name:<br/><br/><br/>
		 Address:<br/><br/><br/><br/>
		 City:<br/><br/><br/><br/>
		 Country:<br/><br/><br/>
		 Telephone:<br/><br/><br/><br/>
         Newsletter: 
		  </div>
		 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6" align="left">
		 <br/><br/>
		 <?=$profile['firstname']?><br/><br/><br/><br/>
		 <?=$profile['lastname']?><br/><br/><br/>
		 <?=$profile['address']?><br/><br/><br/><br/>
		 <?=$profile['city']?><br/><br/><br/><br/>
		 <?=$profile['country']?><br/><br/><br/>
		 <?=$profile['telephone']?><br/><br/><br/><br/>
  	              
   	      <?php // controllo sottoscrizione newsletter
            if ($profile['newsletter']==1)
                {$chkch='checked="checked"';}
                else {$chkch="";} 
          ?>	 
		 <input type="checkbox" name="NEWSLETTER" value="yes" <?=$chkch?> /> (if checked you'll get our Newsletter)<br/><br/>
    			 
		 </div>
		 
		 <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12">
         <label for="firstname">New First Name</label>		 
		 <input type="text" class="form-control" name="FIRSTNAME"  placeholder="Firstname" value="<?=$profile['firstname']?>" maxlength="32" required>
         <label for="lastname">New Last Name</label>		 
		 <input type="text" class="form-control" name="LASTNAME"  placeholder="Lastname" value="<?=$profile['lastname']?>" maxlength="32" required>
		 <label for="address">New address</label>		 
		 <input type="text" class="form-control" name="ADDRESS"  placeholder="Your address" value="<?=$profile['address']?>" maxlength="50" required>
		 <label for="city">New city</label>		 
		 <input type="text" class="form-control" name="CITY"  placeholder="Your City" value="<?=$profile['city']?>" maxlength="32" required>
		 
		 	<?php					    
$countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
?>
		 <label for="country">New Country</label>		 
		 	<select  class="form-control" name="COUNTRY" id="COUNTRY">
                <option value="">Country</option>
                <option value="">--------</option>
                <?php foreach($countries as &$country) { ?>
                <option value="<?=$country?>" <?php if($profile['country']==$country) {?> selected <?php } ?>><?=$country?></option>
                <?php } ?>
            </select>
		 
		 
		 <label for="telephone">New telephone</label>		 
		 <input type="text" class="form-control" name="TELEPHONE"placeholder="Your Phone"  value="<?=$profile['telephone']?>" maxlength="32" required><br/>

        <br/>
		 <input type="submit" class="btn btn-primary" value="Update Data">
		 <br/><br/><br/>
         </div>
         
		</form>
		<br/><br/> 
		 </div>
		 <?php }?>
	
				        
		<!-- form Email -->
		
  
    <div class="row"><br/><br/></div>
    <div id="main-wrap">   	
    
    
    <div class="">
			<form method="post" name="form_update_email" id="form_update_email" class="form-horizontal" role="form" action="<?=$root?>controllers/changemailController.php?action=changemail">
    
				<div class="form-group">
					<label for="Email" class="col-lg-2 col-md-2 col-sm-2 control-label">Email</label>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
						<span class="form-label" >"<?=$profile['email']?>"
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<a class="btn btn-danger btn-xs" id="btnCambioEmail">Change Email</a></span>
					</div>
				</div>
				
				<div id="formCambioEmail" style="display:none;">
                    <input type="hidden" name="username" value="<?=$_SESSION['user_username']?>" />
                    <input type="hidden" name="oldmail" value="<?=$profile['email']?>" />

					<div class="form-group">
						<label for="newemail" class="col-sm-2 control-label">New mail</label>
						<div class="col-lg-8 col-md-8 col-sm-10">
							<input type="email" class="form-control" name="newemail" class="standardinput" placeholder="<?=$profile['email']?>" maxlength="100" required>
						</div>
					</div>					

                    <div class="form-group">
						<label for="confirmnewemail" class="col-sm-2 control-label">Confirm New mail</label>
						<div class="col-lg-8 col-md-8 col-sm-10">
							<input type="email" class="form-control" name="confirmnewemail" class="standardinput" maxlength="100" required>
						</div>
					</div>			

					<div class="form-group">
						<label class="col-sm-2 control-label">&nbsp;</label>
						<div class="col-sm-10">
							<input type="submit" class="btn btn-primary" value="Change Email">
						</div>
					</div>						
				
				</div>
				
    	        </form>	
    		</div>
    			
    	<!-- form Password -->				
    						
		<div class="">
			<form method="post" name="form_update_password" id="form_update_password" class="form-horizontal" role="form" action="<?=$root?>controllers/loginController.php?action=changepassword">
    
				<div class="form-group">
					<label for="password" class="col-lg-2 col-md-2 col-sm-2 control-label">Password</label>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
						<span class="form-label" >&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226; 
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<a class="btn btn-danger btn-xs" id="btnCambioPassword">Change Password</a></span>
					</div>
				</div>
				
				<div id="formCambioPassword">
					<input type="hidden" name="username" value="<?=$_SESSION['user_username']?>" />
				
					<div class="form-group">
						<label for="password" class="col-sm-2 control-label">Old password</label>
						<div class="col-lg-8 col-md-8 col-sm-10">
							<input type="password" class="form-control" name="password" class="standardinput" placeholder="Old password" maxlength="32" required>
						</div>
					</div>					
					<div class="form-group">
						<label for="newPassword1" class="col-sm-2 control-label">New password</label>
						<div class="col-lg-8 col-md-8 col-sm-10">
							<input type="password" class="form-control" name="newPassword1" class="standardinput" placeholder="New password" maxlength="32" required>
						</div>
					</div>	
					<div class="form-group">
						<label for="newPassword2" class="col-sm-2 control-label">Repeat password</label>
						<div class="col-lg-8 col-md-8 col-sm-10">
							<input type="password" class="form-control" name="newPassword2" class="standardinput" placeholder="Repeat password" maxlength="32" required>
						</div>
					</div>	
					<div class="form-group">
						<label class="col-sm-2 control-label">&nbsp;</label>
						<div class="col-sm-10">
							<input type="submit" class="btn btn-primary" value="Change password">
						</div>
					</div>						
				
				</div>
				
							</form>		  
						</div>  */?>
										
						<div class="text--center login__container__title">
							<a class="btn btn-warning login__container__form__btn" href="<?=$root?>controllers/loginController.php?action=logout">Logout</a>
						</div>
					
					
					
					
					<?php }else { /* se non loggato */?>

					
					<div class="login__container">
						<a href=<?=$root?>>
							<img src="<?=$root?>img/login-logo.png" alt="Sensus PR Team Login" class="img-fluid">
						</a>
						<h1 class="login__container__title">Team Login</h1>
						<div class="login__container__form">
							<form method="post" name="form_update_profile" id="form_update_profile" class="form-horizontal lc_formdim" role="form"	
							onsubmit="return validaLogin(this)" action="<?=$root?>controllers/loginController.php?action=login"> 
								<label for="nick" class="control-label">Username</label>
								<input type="text" class="form-control login__container__form__element" name="username" placeholder="Username" maxlength="50" required>
								<label for="nick" class="control-label">Password</label>
								<input type="password" class="form-control login__container__form__element" name="password" placeholder="Password" maxlength="32" required>
								<button type="submit" name="invia" id="invia" class="btn btn-mid login__container__form__btn pointer">Login</button>	
							</form>
                                 <?php /*
				                    <form method="post" class="form-horizontal" role="form" action="<?=$root?>index.php?page=login&step=pwdimenticata"> 
											<input class="btn btn-warning" type="submit" value="Forgot Password">
								</form>	
								*/?>
						</div>
					</div>

					
					<div class="row">
						<div class="d-none">
							<div class="form-group">
								<label for="nick" class="control-label">&nbsp;</label>
								<div class="col-sm-10 text-center">
									<div class="col-lg-6 col-xs-12 form-group">
										<form method="post" class="form-horizontal" role="form" action="<?=$root?>index.php?page=login&step=pwdimenticata"> 
											<input class="btn btn-warning" type="submit" value="Forgot Password">
										</form>	
									</div>
									<div class="form-group">
										<form method="post" class="form-horizontal" role="form" action="<?=$root?>index.php?page=registrazione">
											<input class="btn btn-success" type="submit" value="Registrati">
										</form>
									</div>	
								</div>	
							</div>						

						</div>
					</div>	
                    <br/>
                    <?php }?>
                    
                    </div>
                    <!-- End Portfolio Filter -->
                
                </div>
            	<!-- End None Split Section -->

            </div>
       
        </div>
        <!-- End Box -->
