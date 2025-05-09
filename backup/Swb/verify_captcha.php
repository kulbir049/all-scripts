<?php
 include('main/config.php');

// Check if the entered code matches the stored CAPTCHA string
if ($_POST['captchaInput'] === $_SESSION['captcha_string']) {
    $_SESSION['captcha_verify']=true;
    $_SESSION['captcha_count']=0;
    echo "success";
} else {
    $_SESSION['captcha_verify']=false;
    echo "error";
}
?>
