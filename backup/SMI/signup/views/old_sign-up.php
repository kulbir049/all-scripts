<div class="row" style="margin: 0 0 0 0;">
   <div class="container">
      <h2 style="color: #000; margin-bottom: -30px; margin-top: 30px; font-size: 30px;">Member Sign Up</h2>
      <div id="MyNewTabs" class="tabs-container mytaabs">
         <p class="tabs">
            <a href="#Stab1" id="TabTitleS1">Membership</a>
            <a href="#Stab2" id="TabTitleS2">Profile Details</a>
            <a href="#Stab3" id="TabTitleS3" >Billing Details</a>
         </p>
		  <?php
					get_flashdata();
          //print_r($pricing_details);
					$form_attr = array('id' => 'signup-form','name'=>'signup_form', 'method' => 'post');
					echo form_open('signup/register', $form_attr);
					?>
         <ul class="tabs-content" style="border:none;">
            <li id="Stab1" class="tab-content">
               <div class="member">
                  <div class="memb">
                     <h2>STANDARD MEMBERSHIP :(FREE)</h2>
                  </div>
                  <p><i class="fas fa-circle"></i>&nbsp; "$<?php echo $pricing_details['price_standard'];?> one time registration fee."<br>
                     <i class="fas fa-circle"></i>&nbsp; School Music Library with no watermarks<br>
                     <i class="fas fa-circle"></i>&nbsp; Download the worlds greatest music<br>
                     <i class="fas fa-circle"></i>&nbsp; Repertoire Lists with music.<br>
                     <i class="fas fa-circle"></i>&nbsp; Listen to music through youtube<br>
                     <i class="fas fa-circle"></i>&nbsp; Biographical materials about composers and their music
                  </p>
               </div>
               <div class="member1" style=" height: 218px;">
                  <div class="memb2">
                     <h2>PREMIUM MEMBERSHIP :($<?php echo $pricing_details['price_premium'];?>/YEAR)</h2>
                     <p style="margin-top: -8px!important;">All the features of a Standard Membership plus:</p>
                  </div>
                  <p><i class="fas fa-circle"></i>&nbsp; No Watermarks on any music<br>
                     <i class="fas fa-circle"></i>&nbsp; Personal Library<br>
                     <i class="fas fa-circle"></i>&nbsp; Unlimited access to music in Library<br>
                     <i class="fas fa-circle"></i>&nbsp; Cloud storage of your music<br>
                     <i class="fas fa-circle"></i>&nbsp; Ability to Share music with others on a temporary basis<br>
                  </p>
               </div>
            </li>
            <li id="Stab2" class="tab-content">
               <div class="profiledetail" style="margin-top: 20px;">
                  <h2>PROFILE DETAILS <a href="#" id="icon"><i class="fas fa-chevron-down" style="float: right; margin-right: 29px;"></i></a></h2>
               </div>
			   
               <div class="panels">
                 
                     <div class="form-row">
                        <div class="form-group col-md-6">
							<?php
								$field_attr = array(
								'name' => 'plan_id',
								'type' => 'hidden',
								'class' => 'form-control',
								'id' => 'plan_id'
								
								);
								echo form_input($field_attr);
								
								$field_attr = array(
								'name' => 'plan_name',
								'type' => 'hidden',
								'class' => 'form-control',
								'id' => 'plan_name'
								
								);
								echo form_input($field_attr);
								
								$field_attr = array(
								'name' => 'days',
								'type' => 'hidden',
								'class' => 'form-control',
								'id' => 'days'
								);
								echo form_input($field_attr);
								
								$field_attr = array(
								'name' => 'standard',
								'type' => 'hidden',
								'id' => 'standard'
								);
								echo form_input($field_attr);
								$field_attr = array(
								'name' => 'premium',
								'type' => 'hidden',
								'id' => 'premium',
								);
								echo form_input($field_attr);
								$field_attr = array(
								'name' => 'role_id',
								'type' => 'hidden',
								'id' => 'role_id',
								);
								echo form_input($field_attr);
							?>
							
                          <label for="First Name">First Name</label>
                          <?php
                            $field_attr = array(
                              'name' => 'user_name',
                              'class' => 'form-control',
                              'placeholder' => 'Enter first name',
                              'id' => 'user_name',
                              'value' => set_value('user_name')
                              );
                              echo form_input($field_attr);
                              echo form_error('user_name', '<div class="register-error" id="user_name" style="color:red;">', '</div>');
                          ?>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="Last Name">Last Name</label>
                           <?php
                            $field_attr = array(
                              'name' => 'user_lname',
                              'class' => 'form-control',
                              'placeholder' => 'Enter Last name',
                              'id' => 'user_lname',
                              'value' => set_value('user_lname')
                              );
                              echo form_input($field_attr);
                              echo form_error('user_lname', '<div class="register-error" id="user_lname" style="color:red;">', '</div>');
                            ?>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="address">Address:</label>
                           <?php
                            $field_attr = array(
                              'name' => 'location',
                              'class' => 'form-control',
                              'placeholder' => 'Enter address',
                              'id' => 'location',
                              'value' => set_value('location')
                              );
                              echo form_input($field_attr);
                              echo form_error('location', '<div class="register-error" id="location" style="color:red;">', '</div>');
                            ?>
                           
                        </div>
                        <div class="form-group col-md-3">
                           <label for="inputEmail4">City</label>
                           <?php
                            $field_attr = array(
                              'name' => 'city',
                              'class'=>'form-control',
                              'placeholder' => 'City',
                              'id' => 'city',
                              'value' => set_value('city')
                              );
                            echo form_input($field_attr);
                          echo form_error('city', '<div class="register-error" id="city" style="color:red;">', '</div>');
                          ?>
                        </div>
                        <div class="form-group col-md-3">
                           <label for="country">Country</label>
                           <?php
                            $contries=getCountry();
                                $contries_opt = array();
                                $contries_opt = array('' => 'Country');

                                if (isset($contries) && !empty($contries) && is_array($contries)) {
                                    foreach ($contries as $country) {
                                  $contries_opt[$country['name']] = $country['name'];
                                    }
                                }

                                $attr = array('id' => 'country', 'class' => 'form-control');
                                echo form_dropdown('country',$contries_opt ,'Please select',$attr);
                                echo form_error('country', '<div class="register-error" id="country" style="color:red;">', '</div>');
                            ?>
                        </div>
                        <div class="form-group col-md-3">
                           <label for="state">State</label>
                           <?php          
                                $state = array();
                                $state = array('' => 'Enter State','Armed Forces - Europe' => 'Armed Forces - Europe','Alaska' => 'Alaska', 'Alabama' => 'Alabama','Armed Forces - Pacific' => 'Armed Forces - Pacific','Arkansas' => 'Arkansas','American Samoa' => 'American Samoa','Arizona' => 'Arizona','California' => 'California','Colorado' => 'Colorado','Connecticut' => 'Connecticut','Washington, DC' => 'Washington, DC','Delaware' => 'Delaware','Florida' => 'Florida','Georgia' => 'Georgia','Hawaii' => 'Hawaii','Idaho' => 'Idaho','Illinois' => 'Illinois','Indiana' => 'Indiana','Iowa' => 'Iowa','Kansas' => 'Kansas','Kentucky' => 'Kentucky','Louisiana' => 'Louisiana','Massachusetts' => 'Massachusetts','Maryland' => 'Maryland','Maine' => 'Maine','Marshall Islands' => 'Marshall Islands','Michigan' => 'Michigan','Minnesota' => 'Minnesota','Missouri' => 'Missouri','Northern Mariana Islands' => 'Northern Mariana Islands','Mississippi' => 'Mississippi','Montana' => 'Montana','North Carolina' => 'North Carolina','North Dakota' => 'North Dakota','Nebraska' => 'Nebraska','New Hampshire' => 'New Hampshire','New Jersey' => 'New Jersey','New Mexico' => 'New Mexico','Nevada' => 'Nevada','New York' => 'New York','Ohio' => 'Ohio','Oklahoma' => 'Oklahoma','Oregon' => 'Oregon','Pennsylvania' => 'Pennsylvania','Puerto Rico' => 'Puerto Rico','Palau' => 'Palau','Rhode Island' => 'Rhode Island','South Carolina' => 'South Carolina','South Dakota' => 'South Dakota','Tennessee' => 'Tennessee','Utah' => 'Utah','Virginia' => 'Virginia','Vermont' => 'Vermont','Washington' => 'Washington','Wisconsin' => 'Wisconsin','West Virginia' => 'West Virginia','Wyoming' => 'Wyoming');
                                $attr = array('id' => 'state', 'class' => 'form-control');
                                echo form_dropdown('state',$state ,'Select State',$attr);
                                echo form_error('state', '<div class="register-error" id="state" style="color:red;">', '</div>');
                            ?>
                        </div>
                        <div class="form-group col-md-3">
                           <label for="zipcode">Zip</label>
                           <?php
                               $field_attr = array(
                                'name' => 'zipcode',
                                'class'=>'form-control',
                                'placeholder' => 'Enter zip',
                                'id' => 'zipcode',
                                'value' => set_value('zipcode')
                               );
                            echo form_input($field_attr);
                            echo form_error('zipcode', '<div class="register-error" id="zipcode" style="color:red;">', '</div>');
                            ?>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="Mobile">Phone Number</label>
                           <?php
                              $field_attr = array(
                              'name' => 'mobile_no',
                              'class'=>'form-control',
                              'placeholder' => 'Enter Phone number',
                              'id' => 'mobile_no',
                              'value' => set_value('mobile_no')
                            );
                            echo form_input($field_attr);
                            echo form_error('mobile_no', '<div class="register-error" id="mobile_no" style="color:red;">', '</div>');
                            ?>
                           
                        </div>
                     </div>
               </div>
               <div class="profiledetail" style="margin-top: 20px;">
                  <h2>PREFERRED LANGUAGE <a href="#" id="icon2"><i class="fas fa-chevron-down" style="float: right; margin-right: 29px;"></i></a></h2>
               </div>
               <div class="panels2">
                     <div class="form-row">
                        <div class="form-group col-md-6">
                           <label for="language">Language</label>
                           <?php          
                                $language_opt = array();
                                $language_opt = array('' => 'Select Language','eng' => 'English','ger' => 'German', 'kor' => 'Korean','fre' => 'French');
                                $attr = array('id' => 'language', 'class' => 'form-control');
                                echo form_dropdown('language',$language_opt ,'Select Language',$attr);
                                echo form_error('language', '<div class="register-error" id="language" style="color:red;">', '</div>');
                                ?>
                        </div>
                     </div>
               </div>
               <div class="profiledetail" style="margin-top: 20px;">
                  <h2>ACCOUNT DETAILS <a href="#" id="icon3"><i class="fas fa-chevron-down" style="float: right; margin-right: 29px;"></i></a></h2>
               </div>
               <div class="panels3">
                     <div class="form-row">
                        <div class="form-group col-md-6">
                           <label for="Email">Email Address:</label>
                           <?php
                            $field_attr = array(
                              'name' => 'user_email',
                              'class'=>'form-control',
                              'placeholder' => 'Enter email address',
                              'id' => 'user_email',
                              'value' => set_value('user_email')
                            );
                            echo form_input($field_attr);
                            echo form_error('user_email', '<div class="register-error" id="user_email" style="color:red;">', '</div>');
                            ?>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="code">User Name:<span>(You may use your e-mail address as your user name.)</span> </label>
                           <?php
                            $field_attr = array(
                            'name' => 'user_login_id',
                            'class'=>'form-control',
                            'placeholder' => 'User Name',
                            'id' => 'user_login_id',
                            'maxlength' => 50,
                            'value' => set_value('user_login_id')
                            );
                            echo form_input($field_attr);
                            echo form_error('user_login_id', '<div class="register-error" id="user_login_id" style="color:red;">', '</div>');
                            ?>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="user_password">Password</label>
                           <?php
                            $field_attr = array(
                            'name' => 'user_password',
                            'type'=>'password',
                            'class'=>'form-control',
                            'placeholder' => 'Password',
                            'id' => 'user_password'
                            );
                          echo form_input($field_attr);
                          echo form_error('user_password', '<div class="register-error" id="user_password" style="color:red;">', '</div>');
                          ?>
                          
                        </div>
                        <div class="form-group col-md-6">
                           <label for="con_password">Re-Enter Password</label>
                           <?php
                            $field_attr = array(
                            'name' => 'con_password',
                            'type'=>'password',
                            'class'=>'form-control',
                            'placeholder' => 'Confirm Password',
                            'id' => 'con_password'
                            );
                          echo form_input($field_attr);
                          echo form_error('con_password', '<div class="register-error" id="con_password" style="color:red;">', '</div>');
                          ?>
                           
                        </div>
                        <div class="form-group col-md-6">
                           
						   <?php
							$field_attr = array(
							'name' => 'auto_renew',
							'type'=>'checkbox',
							'id' => 'terms',
							'checked' => 'checked'
							);
							echo form_checkbox('auto_renew','1','', $field_attr);
							echo form_error('auto_renew', '<div class="register-error" id="auto_renew" style="color:red;">', '</div>');
							?>
							<label class="checkbox" for="check_box">
                           Auto Renew
                           </label>
                        </div>
                     </div>
                     <p style="text-align: center; color: #000;">(Standard Account renewal <?php echo $pricing_details['price_standard'];?>, Premium account renewal $<?php echo $pricing_details['price_premium'];?>)</p>
                     <a href="<?php echo base_url(); ?>signup"><button type="button" class="btn btn-primary" style="background-color: #666666; border-color: #666666;">Cancel</button></a>
                     <button type="button" class="btn btn-primary mobilr prm" id="pship">Premium Membership</button>
                     <button type="button" class="btn btn-primary srm" id="stship" style="float: right; background-color: #666666; border-color: #666666;">Standard Membership</button>
               </div>
            </li>
            <li id="Stab3" class="tab-content" style="border:none;">
               <div class="profiledetail heipp">
                  <div class="report" id="bd">
                     <h6> BILLING DETAILS</h6>
                     <h6 class="leffts">Amount: $
							<?php
                            $field_attr = array(
                            'name' => 'price',
                            'id' => 'price',
                            'class' => 'priceback',
							'readonly' => 'readonly'
                            );
                            echo form_input($field_attr);
                            ?>
					 <!--<span style="color:#666666;">$19.95</span>-->
					 </h6>
                  </div>
                     
                     <div class="form-row">
                        
                        &nbsp;&nbsp;
                        
                     </div>
                     <a href="<?php echo base_url(); ?>signup"><button type="button" class="btn btn-primary" style="background-color: #666666; border-color: #666666; margin-top: 20PX;">Cancel</button></a>
                     <button type="submit" id="final_submit" class="btn btn-primary" style="float: right; background-color: #666666; border-color: #666666; margin-top: 20PX;">PAY WITH PAYPAL</button>
                  
               </div>
            </li>
         </ul>
		 <?php echo form_close(); ?>
      </div>
   </div>
</div>
<script src="jquery.minimalTabs.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
     var jk = 0;
     $("#stship").click(function()
     {
		$("#standard").val("standard");
		$("#role_id").val("2");
		$("#price").val("<?php echo $pricing_details['price_standard'];?>");
		$("#plan_id").val("1");
		$("#plan_name").val("Standard Membership");
		$("#days").val("free");
		$("form").submit(function(){
		//alert('Form is submitting....');
		var user_name = $('#user_name').val();
		var user_lname = $('#user_lname').val();
		var location = $('#location').val();
		var city = $('#city').val();
		var country = $('#country').val();
		var state = $('#state').val();
		var zipcode = $('#zipcode').val();
		var language = $('#language').val();
		var user_email = $('#user_email').val();
		var user_login_id = $('#user_login_id').val();
		var user_password = $('#user_password').val();
		var con_password = $('#con_password').val();
		
		
		
		//alert(user_name);
		if(user_name=="" || user_lname=="" || user_lname=="" || location=="" || city=="" || country=="" || zipcode=="" || language=="" || user_email=="" || user_login_id=="" || user_password=="" || con_password=="")
		{
			//alert("jk");
			return false;
			
		}
		else{
			
			var jk = $(this).data('clicked', true);
       
			if(jk.length==1) {
			$('#TabTitleS3').addClass('open');
			$('#Stab3').css('display', '');
			$('#Stab2').hide();
			$('#Stab1').hide();
			$('#TabTitleS1').removeClass('open');
			$('#TabTitleS2').removeClass('open');
			return false;
			} 	
		}
		
		})
		
		$("#stship").submit();
		
       
     });
	 //end of stship
     $("#pship").click(function()
     {
		///////
		$("#premium").val("premium");
		$("#role_id").val("3");
		$("#price").val("<?php echo $pricing_details['price_premium'];?>");
		$("#plan_id").val("2");
		$("#plan_name").val("Premium Membership");
		$("#days").val("365");
		
		$("form").submit(function(){
		//alert('Form is submitting....');
		var user_name = $('#user_name').val();
		var user_lname = $('#user_lname').val();
		var location = $('#location').val();
		var city = $('#city').val();
		var country = $('#country').val();
		var state = $('#state').val();
		var zipcode = $('#zipcode').val();
		var language = $('#language').val();
		var user_email = $('#user_email').val();
		var user_login_id = $('#user_login_id').val();
		var user_password = $('#user_password').val();
		var con_password = $('#con_password').val();
		//alert(user_name);
		if(user_name=="" || user_lname=="" || location=="" || city=="" || country=="" || state=="" || zipcode=="" || language=="" || user_email=="" || user_login_id=="" || user_password=="" || con_password=="")
		{
			return false;
			
		}
		else{
			
			var jk = $(this).data('clicked', true);
       
			if(jk.length==1) {
			$('#TabTitleS3').addClass('open');
			$('#Stab3').css('display', '');
			$('#Stab2').hide();
			$('#Stab1').hide();
			$('#TabTitleS1').removeClass('open');
			$('#TabTitleS2').removeClass('open');
			return false;
			} 	
		}
		
		})
		
		$("#pship").submit();
		///////
     });
		// no need to touch
     if(jk.length==1) {
       
     } else {
         $("#MyNewTabs").minimalTabs();
       $("#TabTitleS1").click();
   
       $("#MyOldTabs").minimalTabs();
       $("#TabTitle3").click();
     }
   });
   
</script>
    <script>
$(document).ready(function(){
  $("#icon").click(function(){
    $(".panels").toggle();
  });
 $("#icon2").click(function(){
    $(".panels2").toggle();
  });

 $("#icon3").click(function(){
    $(".panels3").toggle();
  });
});
</script>
