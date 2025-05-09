<style>
    .con-tact{
        float: left;
        margin-left: 67px;
        position: relative;
        top: 12px;
                    
    }
</style>
     <div class="row" style="margin: 0 0 0 0;">

         <div class="container">
            <h2 style="color: #000; margin-bottom: -30px; margin-top: 30px; font-size: 30px;">Contact us</h2><br><br>
            <div class="row">
            
            <div class="col-md-4 col-xs-12">
                <div class="newsl2">
                    <i class="fas fa-envelope-open-text"></i><p style="float: 
                    right;"><b>Carl Reiter</b><br>
                     <span><a href="mailto:<?php echo _frontLogo()['site_email']; ?>" ><?php echo _frontLogo()['site_email']; ?></a></span></p>
                </div>
                <div class="newsl3" style="display:none;">
                    <i class="fas fa-phone-volume"></i><p style="float: 
                    right;"><b><?php echo _frontLogo()['site_tel']; ?></b><br>
                     </p>
                </div>

                <div class="newsl4">
                    <i class="fas fa-map-marker-alt"></i><?php echo _frontLogo()['address']; ?>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 "  style="display: none;">
                <div class="newsl">
                   <?php
                        $form_attr = array('id' => 'subscription','name'=>'subscription-form', 'method' => 'post');
                        echo form_open('contact/subscription', $form_attr);
                        ?>
                        <div class="form-group">
                       <button type="submit" class="btn btn-primary" style="float: left; background-color: #666666; border-color: #666666;">Subscribe</button>
                       <div class="form-group">
                       <?php
                            $field_attr = array(
                                'name' => 'email',
                                'class'=>'form-control',
                                'placeholder' => 'Email',
                                'id' => 'email',
                                'value' => set_value('email')
                                
                            );
                            echo form_input($field_attr);
                            echo form_error('email', '<div class="register-error" id="email" style="color:red;">', '</div>');
                                ?>
                        </div>
                     </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 " style="display: none;">
                <div class="contact">
                    <?php
                        get_flashdata();
                        $form_attr = array('id' => 'contact-page-form-id','name'=>'main-contact-form', 'method' => 'post');
                        echo form_open('contact/contacts', $form_attr);
                        ?>
                        <div class="form-group">
                       <?php
                            $field_attr = array(
                                'name' => 'fname',
                                'class'=>'form-control',
                                'placeholder' => 'First Name',
                                'id' => 'fname',
                                'maxlength' => 50,
                                'value' => set_value('fname')
                            
                            );
                            echo form_input($field_attr);
                            echo form_error('fname', '<div class="register-error" id="fname" style="color:red;">', '</div>');
                            ?>
                        </div>
                        <div class="form-group">
                       <?php
                            $field_attr = array(
                                'name' => 'email',
                                'class'=>'form-control',
                                'placeholder' => 'Email',
                                'id' => 'email',
                                'value' => set_value('email')
                                
                            );
                            echo form_input($field_attr);
                            ?>
                        </div>
                        <div class="form-group">
                        <?php 
                            $field_attr = array(
                            'name'=> 'message',
                            'class' => 'form-control',
                            'placeholder' => 'Tell us',
                            'id' => 'message',
                            'type'=>'text',
                            'rows'        => '2',
                            'cols'        => '1',
                            'value' => set_value('message'),
                            );
                            echo form_textarea($field_attr);
                            ?>
                            </div>
                       <!-- <input type="text"  name= "email" class="form-control" placeholder="Email"><br>
                       <textarea type="text" name= "message" class="form-control" placeholder="Tell us"></textarea><br> -->
                       <br>
                       <button type="submit" class="btn btn-primary" style="float: right; background-color: #666666; border-color: #666666;">Submit</button>
                     </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
            </div>
         </div>
     </div>
     <hr>
     