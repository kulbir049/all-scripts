<style>
  .specialcode {
    background-color: #cccccc8f;
    border-radius: 3px;
    padding: 10px;
    border: 1px solid #ccc;
  }

  .specialcode:focus {
    box-shadow: none;
    background-color: #fff;
    outline: none;
  }

  #signup-form {
    background-color: #ffffff;
    margin: 100px auto;
    padding: 40px;
    width: 70%;
    min-width: 300px;
  }




  /* Mark input boxes that gets an error on validation: */
  input.invalid,
  select.invalid {
    background-color: #ffdddd;
  }

  /* Hide all steps by default: */
  .tab {
    display: none;
  }


  button.steps {
    background-color: #4CAF50;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 17px;
    font-family: Raleway;
    cursor: pointer;
  }

  button#prevBtn {
    background-color: #bbbbbb;
    color: #ffffff;
    padding: 10px 20px;
    font-size: 17px;
    cursor: pointer;
  }

  #prevBtn {
    background-color: #bbbbbb;
  }

  /* Make circles that indicate the steps of the form: */
  .step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
  }

  .step.active {
    opacity: 1;
  }

  /* Mark the steps that are finished and valid: */
  .step.finish {
    background-color: #4CAF50;
  }

  .member,
  .member1 {
    float: unset;
  }

  .select_plan {
    float: left;
    width: 20px;
    margin-top: 7px;
  }

  .panels,
  .panels2,
  .panels3,
  .profiledetail {
    width: 100%
  }

  #signup-form {
    display: block;
    margin: 0 auto;
    width: 80%;
  }

  .member p {
    font-size: 13px;
    color: #000;
    font-family: 'Roboto', sans-serif;
    margin-top: 20px;
  }

  .member ul,
  .member1 ul {
    color: black !important;
  }
</style>


<?php
$form_attr = array('id' => 'signup-form', 'name' => 'signup_form', 'method' => 'post');
echo form_open('signup/register', $form_attr);
// $data_gaurav_new_free=$this->db->get_where("member_ship",["id"=>1])->row();
// $data_gaurav_new_paid=$this->db->get_where("member_ship",["id"=>2])->row();
$data_gaurav_new_signup = $this->db->get_where("signup_data", ["id" => 1])->row();

?> <!-- One "tab" for each step in the form: -->
<div class="tab">
  <strong style="color: black;"><?= $data_gaurav_new_signup->top_bar_text ?></strong>
  <p class="tabs">Membership Plans</strong>:</p>
  <div class="row">
    <div class="member">
      <input type="hidden" name="role_id" id="role_id" value="" required="true">
      <div class="memb">
        <h2><input type="radio" name="select_plan" class="select_plan" value="2" required="true" style="display:none;">
          <input type="radio" name="select_plan" class="select_plan" id="memb1" value="3" required="true">
          <?php if (!empty($data_gaurav_new_signup)) {
            echo $data_gaurav_new_signup->standard_heading;
          } ?>
          <!--Standard Membership <?php /*if($data_gaurav_new_signup->standard_price<1){ */ ?>(Free)
                       <?php /*}else{ */ ?>
                        $<?php /*echo $data_gaurav_new_signup->standard_price;*/ ?>/year includes
                        --><?php /*} */ ?>
        </h2>


      </div>
      <?= $data_gaurav_new_signup->standard_text ?>
    </div>
    <div class="member1" style=" height: 350px;">
      <div class="memb2">
        <h2><input type="radio" name="select_plan" class="select_plan" value="3" id="memb2" required="true">
          <?php if (!empty($data_gaurav_new_signup)) {
            echo $data_gaurav_new_signup->premium_heading;
          } ?>
          <!--Premium Membership $<?php /*echo $data_gaurav_new_signup->premium_price;*/ ?>/year or-->
        </h2>


      </div>

      <div class="memb2">
        <h2><input type="radio" name="select_plan" class="select_plan" value="4" required="true">
          <?php if (!empty($data_gaurav_new_signup)) {
            echo $data_gaurav_new_signup->monthly_heading;
          } ?>
          <!--Premium Membership $<?php /*echo $data_gaurav_new_signup->monthly_price;*/ ?>/month -->
        </h2>

      </div>

      <?= $data_gaurav_new_signup->premium_text ?>
    </div>

    <!-- <div class="member1" style=" height: 320px;margin-top:5px;">
            <div class="memb2">
                <h2><input type="radio" name="select_plan" class="select_plan" value="4" required="true">
                    Monthly Membership $<?php /*echo $data_gaurav_new_signup->monthly_price;*/ ?>/Month includes</h2>

            </div>

        <?php /*= $data_gaurav_new_signup->monthly_text*/ ?>
        </div>-->

  </div>
</div>
<div class="tab">Profile Details:
  <div class="profiledetail" id="profiledetail" style="margin-top: 20px;">
    <h2>PROFILE DETAILS <a href="#" id="icon"><i class="fas fa-chevron-down" style="float: right; margin-right: 29px;"></i></a></h2>
  </div>


  <div class="panels3">
    <div class="form-row">
      <div class="form-group col-md-6">
        <input type="hidden" id="countryField" name="country" value="">
        <input type="hidden" id="stateField" name="state" value="">
        <input type="hidden" id="cityField" name="city" value="">
        <input type="hidden" id="postalField" name="zipcode" value="">
        <input type="hidden" id="special_code_id" name="special_code_id" value="">
        <label for="First Name">First Name</label>

        <?php
        $field_attr = array(
          'name' => 'user_name',
          'class' => 'form-control velidation_field',
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
          'class' => 'form-control velidation_field',
          'placeholder' => 'Enter Last name',
          'id' => 'user_lname',
          'value' => set_value('user_lname')
        );
        echo form_input($field_attr);
        echo form_error('user_lname', '<div class="register-error" id="user_lname" style="color:red;">', '</div>');
        ?>
      </div>



      <div class="form-group col-md-6">
        <label for="Mobile">Phone Number</label>
        <?php
        $field_attr = array(
          'name' => 'mobile_no',
          'class' => 'form-control',
          'placeholder' => 'Enter Phone number',
          'id' => 'mobile_no',
          'value' => set_value('mobile_no')
        );
        echo form_input($field_attr);
        echo form_error('mobile_no', '<div class="register-error" id="mobile_no" style="color:red;">', '</div>');
        ?>

      </div>

      <div class="form-group col-md-6">
        <label for="Email">Email Address:</label>
        <?php
        $field_attr = array(
          'name' => 'user_email',
          'class' => 'form-control velidation_field',
          'placeholder' => 'Enter email address',
          'id' => 'user_email',
          'value' => set_value('user_email')
        );
        echo form_input($field_attr);
        echo form_error('user_email', '<div class="register-error" id="user_email" style="color:red;">', '</div>');
        ?>
      </div>

      <div class="form-group col-md-6">
        <label for="language">Language</label>

        <?php
        $language_opt = array();
        $language_opt = array("" => 'Select Language', "af" => 'Afrikaans', "sq" => 'Albanian', "am" => 'Amharic', "ar" => 'Arabic', "hy" => 'Armenian', "az" => 'Azerbaijani', "eu" => 'Basque', "be" => 'Belarusian', "bn" => 'Bengali', "bs" => 'Bosnian', "bg" => 'Bulgarian', "ca" => 'Catalan', "ceb" => 'Cebuano', "ny" => 'Chichewa', "zh-CN" => 'Chinese (Simplified)', "zh-TW" => 'Chinese (Traditional)', "co" => 'Corsican', "hr" => 'Croatian', "cs" => 'Czech', "da" => 'Danish', "nl" => 'Dutch', "en" => 'English', "eo" => 'Esperanto', "et" => 'Estonian', "tl" => 'Filipino', "fi" => 'Finnish', "fr" => 'French', "fy" => 'Frisian', "gl" => 'Galician', "ka" => 'Georgian', "de" => 'German', "el" => 'Greek', "gu" => 'Gujarati', "ht" => 'Haitian Creole', "ha" => 'Hausa', "haw" => 'Hawaiian', "iw" => 'Hebrew', "hi" => 'Hindi', "hmn" => 'Hmong', "hu" => 'Hungarian', "is" => 'Icelandic', "ig" => 'Igbo', "id" => 'Indonesian', "ga" => 'Irish', "it" => 'Italian', "ja" => 'Japanese', "jw" => 'Javanese', "kn" => 'Kannada', "kk" => 'Kazakh', "km" => 'Khmer', "rw" => 'Kinyarwanda', "ko" => 'Korean', "ku" => 'Kurdish (Kurmanji)', "ky" => 'Kyrgyz', "lo" => 'Lao', "la" => 'Latin', "lv" => 'Latvian', "lt" => 'Lithuanian', "lb" => 'Luxembourgish', "mk" => 'Macedonian', "mg" => 'Malagasy', "ms" => 'Malay', "ml" => 'Malayalam', "mt" => 'Maltese', "mi" => 'Maori', "mr" => 'Marathi', "mn" => 'Mongolian', "my" => 'Myanmar (Burmese)', "ne" => 'Nepali', "no" => 'Norwegian', "or" => 'Odia (Oriya)', "ps" => 'Pashto', "fa" => 'Persian', "pl" => 'Polish', "pt" => 'Portuguese', "pa" => 'Punjabi', "ro" => 'Romanian', "ru" => 'Russian', "sm" => 'Samoan', "gd" => 'Scots Gaelic', "sr" => 'Serbian', "st" => 'Sesotho', "sn" => 'Shona', "sd" => 'Sindhi', "si" => 'Sinhala', "sk" => 'Slovak', "sl" => 'Slovenian', "so" => 'Somali', "es" => 'Spanish', "su" => 'Sundanese', "sw" => 'Swahili', "sv" => 'Swedish', "tg" => 'Tajik', "ta" => 'Tamil', "tt" => 'Tatar', "te" => 'Telugu', "th" => 'Thai', "tr" => 'Turkish', "tk" => 'Turkmen', "uk" => 'Ukrainian', "ur" => 'Urdu', "ug" => 'Uyghur', "uz" => 'Uzbek', "vi" => 'Vietnamese', "cy" => 'Welsh', "xh" => 'Xhosa', "yi" => 'Yiddish', "yo" => 'Yoruba', "zu" => 'Zulu');
        $attr = array('id' => 'language', 'class' => 'form-control velidation_field');
        echo form_dropdown('language', $language_opt, 'Select Language', $attr);
        echo form_error('language', '<div class="register-error" id="language" style="color:red;">', '</div>');
        ?>
      </div>
      <div class="form-group col-md-6">
        <label for="code">User Name:<span>(You may use your e-mail address as your user name.)</span> </label>
        <?php
        $field_attr = array(
          'name' => 'user_login_id',
          'class' => 'form-control velidation_field',
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
          'type' => 'password',
          'class' => 'form-control velidation_field',
          'placeholder' => 'Password',
          'id' => 'user_password'
        );
        echo form_input($field_attr);
        echo form_error('user_password', '<div class="register-error" id="user_password" style="color:red;">', '</div>');
        ?>
        <input type="checkbox" id="show_password_checkbox" onclick="show_password()" style="margin-top: 10px; top: 2px;"> <label for="show_password_checkbox" style="cursor: pointer;">Show Password</label>

      </div>
      <div class="form-group col-md-6">
        <label for="con_password">Re-Enter Password</label>
        <?php
        $field_attr = array(
          'name' => 'con_password',
          'type' => 'password',
          'class' => 'form-control velidation_field',
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
          'type' => 'checkbox',
          'id' => 'terms',
          'checked' => 'checked'

        );
        echo form_checkbox('auto_renew', '1', '', $field_attr);
        echo form_error('auto_renew', '<div class="register-error" id="auto_renew" style="color:red;">', '</div>');
        ?>
        <label class="checkbox" for="check_box">
          Auto Renew
        </label>
      </div>
    </div>
    <p style="text-align: center; color: #000;">(Standard Account renewal <?php echo $pricing_details['price_standard']; ?>, Premium account renewal $<?php echo $pricing_details['price_premium']; ?>)</p>
    <p style="text-align: right;
    width: 100%;color: black;">Amount: $<span id="pay_amount"></span>
      <?php
      $field_attr = array(
        'name' => 'price',
        'id' => 'price',
        'hidden' => 'price',
        'class' => 'priceback',
        'readonly' => 'readonly'
      );
      echo form_input($field_attr);
      ?>
      Pay with Paypal
    </p>

  </div>
</div>


<div style="overflow:auto;margin-top: 10px;">

  <div style="float:right;display: ruby;">

    <div class="coupon_code_enter" id="coupon_code_enter" style="color: black;display:block;">
      If you have a group code, enter it here.
      <input type="text" name="special_code" id="special_code" placeholder="Group Code" class="specialcode">

    </div>
    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
    <button type="button" id="nextBtn" class="steps" onclick="nextPrev(1)">Next</button>
  </div>
</div>
<!-- Circles which indicates the steps of the form: -->
<div style="text-align:center;margin-top:0px;">
  <span class="step"></span>
  <span class="step"></span>
</div>
<?= $data_gaurav_new_signup->footer_text ?>
</form>

<script>
  $(document).ready(function() {
    document.getElementById("special_code").addEventListener("input", function() {
      //  alert('hi');
      let couponCode = $(this).val().trim();
      if (couponCode.length > 0) { // Check if input is not empty
        // alert(couponCode)
        verifySpecialCode(couponCode, function(result) {
          console.log("result===" + result);
          if (result.success) {
            let membershipType = result.data.membership_plan; // Assuming API returns "standard" or "premium"

            if (membershipType == 3) {
              $("#memb1").prop("checked", true);
            } else if (membershipType == 4) {
              $("#memb2").prop("checked", true);
            }
            document.getElementById("special_code").classList.remove("invalid");
            document.getElementById("special_code").classList.add("valid");
          } else {
            $("#memb1").prop("checked", true);
            $("#memb2").prop("checked", true);
            document.getElementById("special_code").classList.remove("valid");
            document.getElementById("special_code").classList.add("invalid");
          }
        });


      }
      //  document.getElementById("memb2").checked = true;
      //  $("#memb2").prop("checked", true); // Set radio button checked
      $("#role_id").val($("#memb2").val()); // Set role_id value to radio button value
    });

    const cachedCountry = localStorage.getItem('cachedCountry');
    const cachedState = localStorage.getItem('cachedState');
    const cachedCity = localStorage.getItem('cachedCity');
    const cachedPostal = localStorage.getItem('cachedPostal');
    document.getElementById('countryField').value = cachedCountry;
    document.getElementById('stateField').value = cachedState;
    document.getElementById('cityField').value = cachedCity;
    document.getElementById('postalField').value = cachedPostal;
    var coupon_code_enter = document.getElementById("coupon_code_enter");

    $('input[type=radio][name=select_plan]').change(function() {
      $('#role_id').val(this.value);
      // alert('hi')
      if (this.value == 4) {

        coupon_code_enter.style.display = "none";
      } else {
        document.getElementById("special_code").value = "";
        coupon_code_enter.style.display = "block";

      }
    });

  });





  var currentTab = 0; // Current tab is set to be the first tab (0)
  showTab(currentTab); // Display the current tab

  function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
      document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
      document.getElementById("nextBtn").innerHTML = "Next";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
  }

  function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
      // ... the form gets submitted:
      document.getElementById("signup-form").submit();
      $('form').hide();

      return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
  }

  function validateForm() {
    // This function deals with validation of the form fields
    var select_plan = $('#role_id').val();
    var special_code = $('#special_code').val();
    if (select_plan != 2 && select_plan != 3 && select_plan != 4) {
      alert('Please select membership plan.');
      return false;
    }

    if (select_plan == 2) {


      var price = "<?php echo $pricing_details['price_standard']; ?>";
    }
    if (select_plan == 3) {


      var price = "<?php echo $pricing_details['price_premium']; ?>";
    }
    if (select_plan == 4) {


      var price = "<?php echo $pricing_details['monthly_price']; ?>";
    }



    $('#price').val(price);
    $('#pay_amount').text(price);
    var x, input, i, select, valid = true;
    x = document.getElementsByClassName("tab");
    //input = x[currentTab].getElementsByTagName("input");
    input = x[currentTab].getElementsByClassName("velidation_field");
    // select = x[currentTab].getElementsByTagName("select");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < input.length; i++) {

      // If a field is empty...
      if (input[i].value == "") {
        // add an "invalid" class to the field:
        input[i].className += " invalid";
        // and set the current valid status to false
        valid = false;
        $('html, body').animate({
          scrollTop: $("#profiledetail").offset().top
        }, 500);
      }
    }

    if (special_code) {
      console.log("if empty---" + special_code);
      verifySpecialCode(special_code, function(result) {
        console.log("result===" + result);
        if (result.success) {
          // $('#price').val(result.data.price);
          if (select_plan == 4) {
            $('#pay_amount').text(price);
          } else {
            $('#pay_amount').text(price - result.data.price);
          }

          $('#special_code_id').val(result.data.id);
          document.getElementById("special_code").classList.remove("invalid");
          document.getElementById("special_code").classList.add("valid");
          console.log("Code is valid:", result.message);
          // Perform actions for a valid code
        } else {
          document.getElementById("special_code").classList.remove("valid");
          document.getElementById("special_code").classList.add("invalid");
          console.log("Code is invalid:", result.message);
          // alert(result.message);

          $('#prevBtn').click();
        }
      });
    } else {
      document.getElementById("special_code").classList.remove("invalid");
      document.getElementById("special_code").classList.add("valid");
      console.log("empty---" + special_code);
    }

    // A loop that checks every input field in the current tab:
    // for (i = 0; i < select.length; i++) {
    //   // If a field is empty...
    //   if (select[i].value == "") {
    //     // add an "invalid" class to the field:
    //     select[i].className += " invalid";
    //     // and set the current valid status to false
    //     valid = false;
    //   }
    // }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
      document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
  }

  function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
      x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
  }


  function show_password() {
    var x = document.getElementById("user_password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
    var y = document.getElementById("con_password");
    if (y.type === "password") {
      y.type = "text";
    } else {
      y.type = "password";
    }
  }

  function verifySpecialCode(special_code, callback) {
    $.ajax({
      url: "<?php echo site_url(); ?>/signup/verify_code", // Replace with your controller/method
      type: "POST",
      data: {
        code: special_code
      },
      dataType: "json",
      success: function(response) {
        // Pass the response to the callback
        callback(response);
      },
      error: function(xhr, status, error) {
        console.error("AJAX Error:", error);
        // Pass an error object or message to the callback if needed
        callback({
          success: false,
          message: "An error occurred. Please try again."
        });
      }
    });
  }
</script>