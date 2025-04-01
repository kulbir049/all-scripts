<?php include('main/config.php');
// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();

include('main/reset_password.php');
include('main/update_avatar.php');
include('main/update_prof.php');
include('main/delete_account.php');
include('main/header.php');

$on_off_toggle = 'ON';
$on_off_toggle_link = '';
?>

<div class="container">
    <div class="row">
        <?php include('main/side_bar.php'); ?>

        <div class="col-md-6">

            <div class="col-md-12 box" style="padding:0px;">

                <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;margin-bottom:15px;width:100%;border:0px;">
                    Payment Information
                </div>
                <div style="padding:20px;">

                    <form method="post" enctype="multipart/form-data">
                        <label>Payment Method</label>
                        <select class="form-control form_in" name="payment_type">
                            <?php if ($payment_type != NULL) { ?>
                                <option value="<?php echo $payment_type; ?>"><?php echo $payment_type; ?> (Current)</option>
                            <?php } ?>
                            <option value="Stripe">Stripe </option>
                            <option value="E-Transfer">E-transfer</option>
                            <option value="Cheque">Cheque</option>
                        </select>
                        <br>
                        <label>Payment Address</label>
                        <input type="email" class="form-control form_in" name="payment_address" value="<?php echo $payment_email; ?>">
                        <br>
                        <button type="submit" name="update_payment" class="btn btn-main">Update Payment Information</button>
                </div>


            </div>

            <div class="col-md-12 box" style="padding:0px;">

                <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;margin-bottom:15px;width:100%;border:0px;">
                    Update Your Profile
                </div>
                <div style="padding:20px;">
                    <form method="post" class="example ws-validate" style="padding:20px;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                        <label>What city are you located in? (Optional)</label>
                        <input type="text" class="form-control form_in" name="city" value="<?php echo $city; ?>">
                        <br>
                        <label>How old are you? (Optional)</label>
                        <input type="number" class="form-control form_in" name="age" min="13" max="100" value="<?php echo $age; ?>">
                        <br>
                        <label>Gender? (Optional)</label>
                        <select name="gender" class="form-control form_in">
                            <?php
                            if ($gender != NULL) {
                                echo '<option value="' . $gender . '">' . $gender . '</option>';
                            }
                            ?>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                            <option value="none">Ill keep this information to myself.</option>
                        </select>
                        <br>
                        <label>What is your relationship status? (Optional)</label>
                        <select name="relationship" class="form-control form_in">
                            <?php
                            if ($relationship != NULL) {
                                echo '<option value="' . $relationship . '">' . $relationship . '</option>';
                            }
                            ?>
                            <option value="single">Single</option>
                            <option value="relationship">In a Relationship</option>
                            <option value="complicated">Its Complicated</option>
                        </select>
                        <br>
                        <label>Occupation. (Optional)</label>
                        <input type="text" class="form-control form_in" name="occupation" value="<?php echo $occupation; ?>">
                        <br>

                        <label>Profile Description: (This will be showed on your profile.)</label>
                        <textarea class="form-control form_in" name="description" rows="3"><?php echo $profile_description; ?></textarea><br>
                        <button type="submit" name="update_prof" class="btn btn-main">Update</button>
                    </form>

                </div>
            </div>



            <div class="col-md-12 box" style="padding:0px;">

                <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;margin-bottom:15px;width:100%;border:0px;">
                    Update Your Profile Picture
                </div>
                <div style="padding:20px;">
                    <p>Your Image needs to be 130px by 130px.</p>
                    <br>
                    <form method="post" enctype="multipart/form-data">
                        <div style="height:0px;overflow:hidden">
                            <input type="file" id="fileInput" name="fileInput" onchange="PreviewImg(this);" />
                        </div>

                        <div class="padding:10px;">
                            <div class="input-group">
                                <input type="text" class="form-control form_in" name="fileInput" id="filename" placeholder="">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button" onclick="chooseFile();">Choose File <span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span></button>
                                </span>
                            </div><!-- /input-group -->
                        </div><br>
                        <button type="submit" name="update_avatar" class="btn btn-main">Update</button>
                    </form>

                </div>
            </div>


            <div class="col-md-12 box" style="padding:0px;">

                <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;margin-bottom:15px;width:100%;border:0px;">
                    Update Your Profile Background Picture
                </div>
                <div style="padding:20px;">
                    <p>Your image needs to be 600px wide and 200px high.</p>
                    <br>
                    <form method="post" enctype="multipart/form-data">
                        <div style="height:0px;overflow:hidden">
                            <input type="file" id="filebInput" name="filebInput" onchange="PreviewbImg(this);" />
                        </div>

                        <div class="padding:10px;">
                            <div class="input-group">
                                <input type="text" class="form-control form_in" name="filebInput" id="filebname" placeholder="">
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="button" onclick="choosebFile();">Choose File <span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span></button>
                                </span>
                            </div><!-- /input-group -->
                        </div><br>
                        <button type="submit" name="update_background" class="btn btn-main">Update</button>
                    </form>

                </div>
            </div>
            <div class="col-md-12 box" style="padding:0px;">

                <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;margin-bottom:15px;width:100%;border:0px;">
                    Add Links to your Profile & Sweebs
                </div>
                <div style="padding:20px;">
                    <p>Add your websites and social media links. These links appear on your profile and other areas within the site. <b>Soon you will be able to show them within an Iframe within the surf.</b></p>
                    <br>
                    <form method="post" enctype="multipart/form-data">

                        <?php

                        $title_1 = '';
                        $title_2 = '';
                        $title_3 = '';
                        $link_1 = '';
                        $link_2 = '';
                        $link_3 = '';
                        if (isset($social_links_json) && !empty($social_links_json)) {
                            $social_links = json_decode($social_links_json);
                            $title_1 = $social_links[0][0];
                            $title_2 = $social_links[1][0];;
                            $title_3 = $social_links[2][0];;
                            $link_1 = $social_links[0][1];
                            $link_2 = $social_links[1][1];
                            $link_3 = $social_links[2][1];
                        }

                        ?>

                        <div class="padding:10px;">
                            <p> Link 1 <img src="images/website-link.png" width="32"></p>
                            <div class="input-group" style="display: flex;">

                                <input type="text" class="form-control form_in" name="social_media_title[]" id="social_media_title" placeholder="title" value="<?php echo $title_1; ?>">
                                <input type="url" class="form-control form_in" name="social_media_link[]" id="social_media_link" placeholder="link" value="<?php echo $link_1; ?>">
                            </div>
                            <p> Link 2 <img src="images/website-link.png" width="32"></p>
                            <div class="input-group" style="display: flex;">



                                <input type="text" class="form-control form_in" name="social_media_title[]" id="social_media_title" placeholder="title" value="<?php echo $title_2; ?>">
                                <input type="url" class="form-control form_in" name="social_media_link[]" id="social_media_link" placeholder="link" value="<?php echo $link_2; ?>">
                            </div>
                            <p> Link 3 <img src="images/website-link.png" width="32"></p>
                            <div class="input-group" style="display: flex;">


                                <input type="text" class="form-control form_in" name="social_media_title[]" id="social_media_title" placeholder="title" value="<?php echo $title_3; ?>">
                                <input type="url" class="form-control form_in" name="social_media_link[]" id="social_media_link" placeholder="link" value="<?php echo $link_3; ?>">

                            </div><!-- /input-group -->
                        </div><br>
                        <button type="submit" name="update_social_meida_link" class="btn btn-main">Update</button>
                    </form>
                    <p style="margin-top: 0px;display: inline-block;">
                        <span style="color:#838990;font-size:14px;"> Show Sweebs ? </span>
                        <label class="switch">
                            <input type="checkbox" <?php if ($on_off_toggle == 'ON') {
                                                        echo 'checked';
                                                    } ?> id="on_off_toggle">
                            <span class="slider round"></span>
                            <span class="on-off-text">OFF</span>
                        </label>
                    </p>
                    <br>

                    <p style="margin-top: 0px;display: inline-block;">
                        <span style="color:#838990;font-size:14px;">Show Links ? </span>
                        <label class="switch_link">
                            <input type="checkbox" <?php if ($on_off_toggle_link == 'ON') {
                                                        echo 'checked';
                                                    } ?> id="on_off_toggle_link">
                            <span class="slider round"></span>
                            <span class="on-off-text-link">OFF</span>
                        </label>
                    </p>

                </div>
            </div>




            <div class="col-md-12 box" style="padding:0px;">

                <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;margin-bottom:15px;width:100%;border:0px;">
                    Change Your Password
                </div>
                <div style="padding:20px;">
                    <p>Need to change your password? Just enter your new passwords below! It is as easy as that. After your password is successfuly changed you will be prompted to login again.</p>
                    <form method="post" class="example ws-validate" style="padding:20px;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">


                        <div class="row">

                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                echo '<div class="alert alert-warning">' . $Err . '</div>';
                            }
                            ?>

                            <br>

                            <div class="form-group">
                                <input type="password" class="form-control form_in" name="password_cur" id="password" placeholder="Your Current password">
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control form_in" name="password" id="password" placeholder="Your New password">
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control form_in" name="password_re" id="password2" placeholder="ReEnter Your New password">
                            </div>



                            <button type="submit" class="btn btn-main">Reset Your Password!</button>

                    </form>


                </div>
            </div>
            <!-- delete account start -->
            <div class="col-md-12 box" style="padding:0px;">


                <div style="padding:20px;">
                    <p>Are you sure you want to delete your account? This action is irreversible.</p>
                    <form method="post" id="deleteAccountForm" class="example ws-validate" style="padding:20px;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">


                        <div class="row">
                            <input type="hidden" name="delete_account">
                            <button type="button" class="btn btn-main" onclick="confirmDeletion()">Yes, Delete My Account<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        </div>
                    </form>


                </div>
            </div>
            <!-- delete account end -->
        </div>
    </div>

    <?php
    $points_t = '16.79';

    if ($avatar == 'user.png') {
        $avatar_message = '<div class="update_info"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Avatar.</div>';
        $avatar_points = '0';
    } else {
        $avatar_message = '<div class="update_info"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true" style="color:#a2de5a;"></span> Avatar</div>';
        $avatar_points = $points_t;
    }

    if ($gender == NULL) {
        $gender_message = '<div class="update_info"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Gender.</div>';
        $gender_points = '0';
    } else {
        $gender_message = '<div class="update_info"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true" style="color:#a2de5a;"></span> Gender</div>';
        $gender_points = $points_t;
    }

    if ($age == NULL) {
        $age_message = '<div class="update_info"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Age</div>';
        $age_points = '0';
    } else {
        $age_message = '<div class="update_info"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true" style="color:#a2de5a;"></span> Age</div>';
        $age_points = $points_t;
    }

    if ($occupation == NULL) {
        $occupation_message = '<div class="update_info"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Occupation</div>';
        $occupation_points = '0';
    } else {
        $occupation_message = '<div class="update_info"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true" style="color:#a2de5a;"></span> Occupation</div>';
        $occupation_points = $points_t;
    }

    if ($city == NULL) {
        $city_message = '<div class="update_info"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> City</div>';
        $city_points = '0';
    } else {
        $city_message = '<div class="update_info"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true" style="color:#a2de5a;"></span> City</div>';
        $city_points = $points_t;
    }

    if ($bg_wall == NULL) {
        $bg_message = '<div class="update_info"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Profile Background</div>';
        $bg_points = '0';
    } else {
        $bg_message = '<div class="update_info"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true" style="color:#a2de5a;"></span> Profile Background</div>';
        $bg_points = $points_t;
    }

    $complete_points = $avatar_points + $age_points + $occupation_points + $city_points + $bg_points + $gender_points;
    if ($complete_points > 100) {
        $complete_points = 100;
        $user_id = $user_id_sess;
        $post_by_user = $user_id_sess;
        $sweeba_id = 0;
        $is_free = 1;
        $free_desc = 'Profile_Completed';
        $credit_use = 0;
        $exposure_earn = 25;
        $created_at = date('Y-m-d H:i:s');

        $sql = "SELECT * FROM exposure
        WHERE free_desc = 'Profile_Completed' AND user_id=" . $user_id;
        $result_verify_sql = $conn->query($sql);
        $result_verify = $result_verify_sql->fetch_assoc();
        if ($result_verify_sql->num_rows == 0) {


            $insert_logs = "INSERT INTO exposure (user_id, post_by_user, sweeba_id, exposure_earn, created_at,is_free,credit_use,free_desc)
         VALUES ('$user_id', '$post_by_user', '$sweeba_id', '$exposure_earn','$created_at','$is_free','$credit_use','$free_desc')";
            $conn->query($insert_logs);

            $exposure_message = "You earned 25 exposure credit on complete profile 100%.";
    ?>
            <div style="background: #2ecc71;
  padding: 6px;
  color: #fff;
  margin-bottom: 10px;
  position: absolute;
  width: 100%;
  z-index: 99999999;"><img src="dist/img/ticketssmall.png" style="height:20px;width:20px"> <?php echo $exposure_message; ?></div>
            <br><br>
    <?php }
    }
    ?>
    <style>
        .progress {
            background: #f6f8fa;
            border: 0px solid rgba(82, 59, 59, 1);
            border-radius: 0px;
            height: 30px;
        }

        .progress-bar-custom {
            background: #a2de5a;
        }

        .update_info {
            background: #f6f8fa;
            margin-bottom: 5px;
            border-radius: 3px;
            padding: 5px;
            text-align: center;
        }
    </style>

    <!-- ----------Member Ship Start------------ -->
    <div class="col-md-3 hidden-xs" style="padding:0px;">
        <div class="col-md-12" style="background:#fff;padding:0px;margin-bottom:25px;">
            <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
                Membership Type
            </div>

            <?php
            $MembershipType = 'Free Member';
            $isUpgrade = true;
            if ($result_membership_count > 0) {
                $MembershipType = 'Premium Member';
                $isUpgrade = false;
            }
            if ($is_featured_member == 1 && (strtotime('now') < $is_expiary_date)) {
                $MembershipType = 'Featured Member';
                $isUpgrade = false;
            }
            ?>

            <div class="update_info">
                <?= $MembershipType; ?>
            </div>
            <?php if ($isUpgrade) { ?>
                <div class="update_info">
                    <a href="https://sweeba.com/upgrade.php" class="btn btn-main">Upgrade</a>
                </div>
            <?php } ?>
        </div>


    </div>
    <!-- -----------Member Ship End--------- -->

    <div class="col-md-3 hidden-xs" style="padding:0px;">
        <div class="col-md-12" style="background:#fff;padding:0px;margin-bottom:25px;">
            <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
                Profile Completion
            </div>

            <div style="padding:10px;">

                <div class="progress">
                    <b>
                        <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="<?php echo $complete_points; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $complete_points; ?>%;">
                    </b>
                    <span class="" style="width: 100%;
  padding-top: 7;
  display: block;
  color:black;
  margin: 0;
  z-index: 99999999999;"><?php echo $complete_points; ?>%</span>

                </div>
            </div>


            <?php
            if ($complete_points <= 99) {
                echo '<p style="font-weight:bold;font-size:14px;color:#565656;"><img src="images/10-free-credits.png" height="25" style="padding-bottom:0px;padding-left: 20px;"> Complete for 25 FREE credits.</p>';
            }
            ?>

            <?php
            if ($complete_points >= 100) {
                echo '<div class="update_info">Profile Completed <span class="glyphicon glyphicon-ok-circle" aria-hidden="true" style="color:#a2de5a;"></span></div>';
            } else {
                echo $city_message;
                echo $age_message;
                echo $gender_message;
                echo $occupation_message;
                echo $avatar_message;
                echo $bg_message;
            }
            ?>


        </div>



    </div>
</div>

</div>


</div> <!-- /container -->


<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="/dist/js/bootstrap.min.js"></script>
<script src="https://afarkas.github.io/webshim/js-webshim/minified/polyfiller.js"></script>





<style>
    .example input[type=submit] {
        width: 190px;
        text-align: center;
    }

    .example .ws-invalid label,
    .example .ws-invalid h3 {
        color: #e11;
    }

    .example .ws-invalid input {
        border-color: #e11;
    }

    .example .ws-success input {
        border-color: #1e1;
    }

    /* show sweeb or link css start here */

    .switch {
        position: relative;
        display: inline-block;
        width: 85px;
        height: 25px;
        cursor: pointer !important;
        vertical-align: middle;
    }

    .switch input {
        display: none;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        border-radius: 34px;
        transition: 0.4s;
    }

    .slider:before {
        position: absolute;
        content: '';
        height: 24px;
        width: 24px;
        left: 4px;
        bottom: 0px;
        background-color: white;
        border-radius: 50%;
        transition: 0.4s;
    }

    input:checked+.slider {
        background-color: #5cb85c;
        /* Background color when toggled on */
    }

    input:checked+.slider:before {
        transform: translateX(52px);
    }

    .on-off-text {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        left: 30px;
        color: #555;
    }

    /* show sweeb or link css end here */

    /* show sweeb or link css start here for link*/

    .switch_link {
        position: relative;
        display: inline-block;
        width: 85px;
        height: 25px;
        cursor: pointer !important;
        vertical-align: middle;
    }

    .switch_link input {
        display: none;
    }


    .on-off-text-link {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        left: 30px;
        color: #555;
    }


    /* show sweeb or link css end here */
</style>
<script>
    (function() {
        webshims.setOptions('forms', {
            lazyCustomMessages: true,
            iVal: {
                handleBubble: 'hide', // defaults: true. true (bubble and focus first invalid element) | false (no focus and no bubble) | 'hide' (no bubble, but focus first invalid element)
                fx: 'slide', //defaults 'slide' or 'fade'
                sel: '.ws-validate', // simple selector for the form element, setting this to false, will remove this feature
                fieldWrapper: ':not(span, label, em, strong, b, i, mark, p)'
            }
        });
        webshims.polyfill('forms');
    })();
</script>

<script>
    $("#fileInput").change(function() {
        readURL(this);
    });


    function chooseFile() {
        $("#fileInput").click();
    }

    document.getElementById('fileInput').onchange = uploadOnChange;

    function uploadOnChange() {
        var filename = this.value;
        var lastIndex = filename.lastIndexOf("\\");
        if (lastIndex >= 0) {
            filename = filename.substring(lastIndex + 1);
        }
        document.getElementById('filename').value = filename;
    }
</script>


<script>
    $("#filebInput").change(function() {
        readURL(this);
    });


    function choosebFile() {
        $("#filebInput").click();
    }

    document.getElementById('filebInput').onchange = uploadOnChange;

    function uploadOnChange() {
        var filename = this.value;
        var lastIndex = filename.lastIndexOf("\\");
        if (lastIndex >= 0) {
            filename = filename.substring(lastIndex + 1);
        }
        document.getElementById('filebname').value = filename;
    }
</script>

<!-- show sweeb or link js start here -->
<script>
    $(document).ready(function() {
        $('.switch input').change(function() {
            var isChecked = $(this).prop('checked');
            var onOffText = isChecked ? 'ON' : 'OFF';
            $('.on-off-text').text(onOffText);

            // Make an AJAX request to store toggle value in session
            $.ajax({
                type: "POST",
                url: "", // Create this file for server-side verification
                data: {
                    on_off_toggle: onOffText
                },
                success: function(response) {
                    // null
                }
            });
        });
        var on_off_toggle = $('#on_off_toggle').prop('checked');
        var onOffText = on_off_toggle ? 'ON' : 'OFF';

        $('.on-off-text').text(onOffText);




    });
</script>
<script>
    $(document).ready(function() {


        // for link start here

        $('.switch_link input').change(function() {
            var isChecked = $(this).prop('checked');
            var onOffTextLink = isChecked ? 'ON' : 'OFF';
            $('.on-off-text-link').text(onOffTextLink);

            // Make an AJAX request to store toggle value in session
            $.ajax({
                type: "POST",
                url: "", // Create this file for server-side verification
                data: {
                    on_off_toggle: onOffTextLink
                },
                success: function(response) {
                    // null
                }
            });
        });
        var on_off_toggle_link = $('#on_off_toggle_link').prop('checked');
        var onOffTextLink = on_off_toggle_link ? 'ON' : 'OFF';

        $('.on-off-text-link').text(onOffTextLink);

    });
</script>
<!-- show sweeb or link js end here -->

<script>
    function confirmDeletion() {
        // Show confirmation dialog
        if (confirm("Are you sure you want to delete your account? This action is irreversible.")) {
            // Submit the form if user confirms
            document.getElementById('deleteAccountForm').submit();
        } else {
            return false;
        }
    }
</script>

</body>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7LHWPPZECB"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-7LHWPPZECB');
</script>

</html>