<section>
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3312.444938571768!2d-117.57538778440193!3d33.87819303432857!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80dcc81353141eed%3A0x36983da3fc30474c!2sCorona%2C+CA+92878%2C+USA!5e0!3m2!1sen!2sin!4v1447057343275" width="100%" height="400" frameborder="0" style="border:0; display: block;" allowfullscreen=""></iframe>
	</section>
	<div class="breadcrumb-container">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb mb-0 custom px-0">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
					<li class="breadcrumb-item active">Contact</a></li>
			  	</ol>
			</div>
		</div>
	</div>
</div>
	<section class="main-contact-container">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
						<?php
						get_flashdata();
						$form_attr = array('id' => 'contact-page-form-id','name'=>'main-contact-form', 'method' => 'post');
						echo form_open('contact/contactEmail', $form_attr);
						?>
					  	<div class="form-group">
						  <?php
							$field_attr = array(
								'name' => 'fname',
								'class'=>'form-control rounded-0',
								'placeholder' => 'First Name',
								'id' => 'fname',
								'maxlength' => 50,
								'value' => set_value('fname')
							
							);
							echo form_input($field_attr);
							echo form_error('fname', '<div class="register-error" id="fname" style="color:red;">', '</div>');
							?>
					    </div>
					    <div class="form-row">
					    	<div class="form-group col-md-6">
							<?php
							$field_attr = array(
								'name' => 'mname',
								'class'=>'form-control rounded-0',
								'placeholder' => 'Middle Name',
								'id' => 'mname',
								'maxlength' => 50,
								'value' => set_value('mname')
								
							);
							echo form_input($field_attr);
							?>
						    </div>
						    <div class="form-group col-md-6">
						    <?php
							$field_attr = array(
								'name' => 'lname',
								'class'=>'form-control rounded-0',
								'placeholder' => 'Last Name',
								'id' => 'lname',
								'maxlength' => 50,
								'value' => set_value('lname')
								
							);
							echo form_input($field_attr);
							?>
						    </div>
						</div>

						<div class="form-row">
					    	<div class="form-group col-md-6">
								<?php
								$field_attr = array(
								'name' => 'mobile_no',
								'class'=>'form-control rounded-0',
								'placeholder' => 'Mobile',
								'id' => 'mobile_no',
								'maxlength' => 15,
								'value' => set_value('mobile_no')

								);
								echo form_input($field_attr);
								echo form_error('mobile_no', '<div class="register-error" id="mobile_no" style="color:red;">', '</div>');
								?>
						    </div>
						    <div class="form-group col-md-6">
							<?php
							$field_attr = array(
								'name' => 'email',
								'class'=>'form-control rounded-0',
								'placeholder' => 'Email',
								'id' => 'email',
								'value' => set_value('email')
								
							);
							echo form_input($field_attr);
							?>
						  
						    </div>
						</div>

						<div class="form-row">
					    	<div class="form-group col-md-6">
							<?php
							$field_attr = array(
								'name' => 'phone',
								'class'=>'form-control rounded-0',
								'placeholder' => 'Phone',
								'id' => 'phone',
								'value' => set_value('phone')
								
							);
							echo form_input($field_attr);
							?>
						    </div>
						    <div class="form-group col-md-6">
							<?php
							$field_attr = array(
								'name' => 'ext',
								'class'=>'form-control rounded-0',
								'placeholder' => 'Ext.',
								'id' => 'ext',
								'value' => set_value('ext')
								
							);
							echo form_input($field_attr);
							?>
						    </div>
						</div>

						<div class="form-group mb-0">
							<?php 
							$field_attr = array(
							'name'=> 'message',
							'class' => 'form-control rounded-0',
							'placeholder' => 'Message',
							'id' => 'message',
							'rows'        => '4',
							'cols'        => '3',
							'value' => set_value('message'),
							);
							echo form_textarea($field_attr);
							?>
					    </div>
						<div class="form-group d-sm-none">
						    <button type="submit" class="btn btn-danger custom-btn mt-3">Submit</button>
						</div>
					  <!-- <button type="submit" class="btn btn-danger custom-btn float-right">Sign in</button> -->
					<?php echo form_close(); ?>
				</div>

				<div class="col-sm-6 contact-bar d-flex justify-content-center">
					<div class="row text-center align-items-center">
						<?php echo $contacr_details['contact_address'];?>
					</div>
				</div>
				<div class="col-sm-12 d-none d-sm-block">
					<button type="submit" form="contact-page-form-id" class="btn btn-danger custom-btn mt-3">Submit</button>
				</div>
			</div>
		</div>
	</section>
