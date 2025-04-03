<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo (isset($title) && !empty($title) ? $title : TITLE); ?></title>
        <!-- Bootstrap -->
        <link href="<?php echo base_url() . 'assets/css/bootstrap.min.css'; ?>" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo base_url() . 'assets/vendor/css/font-awesome/font-awesome.min.css' ?>" rel="stylesheet"> 
        <!-- NProgress -->
        <link href="<?php echo base_url() . 'assets/vendor/css/nprogress.css' ?>" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="<?php echo base_url() . 'assets/vendor/css/custom.min.css' ?>" rel="stylesheet"> 
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.12.0.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() . 'assets/js/jquery.validate.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/client-validation.js' ?>"></script>
        <style>
            .msg {
                font-size:11px;
                color:#666; 
                padding:10px;
            }
            #error {
                font-size:12px;
                height:20px;
            }
			.Otp-logo{ padding: 20px 0px 30px !important;} 
        </style>
    </head> 

    <body class="login"> 
        <div>
           <img src="<?php echo base_url(); ?>assets/uploads/img_5b8fc4ea89f34renewable-current-logo.png" class="center-block Otp-logo"> 
            <div class="login_wrapper">
               
                <div class="animate form login_form">
                    <section class="login_content"> 

                        
                        <h2>OTP Confirmation</h2>
                        <?php
                        $form_attr = array('id' => 'user_confirmations', 'method' => 'post');
                        echo form_open('signup/confirmation', $form_attr);
                        ?>
                        <div>
                            <?php
                            $field_attr = array(
                                'name' => 'id',
                                'type'=>'hidden',
                                'id' => 'id',
                                'value' => set_value('id',(isset($id) && !empty($id) ? $id : ''))
                            );

                            echo form_input($field_attr);
                            ?>
                            <?php
                            $field_attr = array(
                                'name' => 'contact_code',
                                'class' => 'form-control custom-input',
                                'placeholder' => 'Enter OTP Code',
                                'id' => 'contact_code',
                                'value' => set_value('contact_code')
                            );

                            echo form_input($field_attr);
                            ?>
                            <?php echo form_error('contact_code', '<div class="register-error" id="contact_code" style="color:red;">', '</div>'); ?>

                            <?php if (isset($error_type) && !empty($error_type) && $error_type == 'error') { ?>
                                <div class="register-error" id="contact_code" style="color:red;"><?php echo $msg; ?></div>
                            <?php } else if (isset($error_type) && !empty($error_type) && $error_type == 'success') { ?>
                                <div class="register-error" id="contact_code" style="color:green;"><?php echo $msg; ?></div>
                            <?php } ?>
                        </div>


                        <div style="margin-left:0px;">

                            <input type="submit" class="form-control new-custom-button" name="confirmation" value="Confirm">  <span id="error"></span>
                        </div>

                        <div class="clearfix"></div>
                        <?php echo form_close(); ?>
                        <div class="separator">
                            <div class="clearfix"></div>
                            <br>

                            <div>
                                <p>©2018 All Rights Reserved.</p>

                            </div>
                        </div>

                    </section>
                </div>
            </div>
        </div>
    </body>
</html>