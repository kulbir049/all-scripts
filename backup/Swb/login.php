<?php
include('main/login_member.php');



if(isset($_SESSION["user_id"]) && $_SESSION["user_id"]>0){
        
        echo '<script> window.location = "dash.php"; </script>';
        die;
    }

?>

  
<?php 
include('main/header.php');

?>

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
</style>
<div class="wrap_small" style="margin-top:70px;padding:20px;">
<div class="col-md-12" style="padding:0px;background:#fff;">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;font-family: 'Open Sans', sans-serif;">
Welcome Back
</div>

<div style="padding:20px;">
<h2 class="c6"><FONT color="#5cb85c" >Sweeb. </font><FONT color="#00adee" >Earn.</font> <FONT color="#5cb85c">Surf.</font></h2>
<div class="textbody">
<br>
</div>

<form method="post" class="example ws-validate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
echo '<div class="alert alert-warning">'.$Err.'</div>';
}
?>

  <div class="form-group">
  <input type="text" class="form_in form-control" name="username" id="name" placeholder="Your Username.">
  </div>

  <div class="form-group">
  <input type="password" class="form_in form-control" name="password" id="exampleInputEmail1" placeholder="Your password">
  </div>
  <div class="form-group">
  <input type="checkbox" class="form_in" name="auto_surfing" id="auto_surfing" value="yes">
  <lable for="auto_surfing">Automatically start surfing</lable>
  </div>
  <button type="submit" class="btn btn-main btn-block">Login To Sweeba!</button>
  <hr>
  
  <center>

<p>
<button type="button" name="verify" class="btn btn-main" style="background:#5fb5f2;border:0px;color:#fff;" data-toggle="modal" data-target="#myModal" >Forgot password?</button>

<a href="https://sweeba.com/verify.php" class="btn btn-main" style="background:#5fb5f2;border:0px;color:#fff;">Re-verify email</a>
</p>
</form>

</p>

 </center>
</div>
</div>
</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?php echo SITE_URL;?>/dist/js/bootstrap.min.js"></script>
     <script src="https://afarkas.github.io/webshim/js-webshim/minified/polyfiller.js"></script>
  

    <script>
    (function () {
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
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","main/name_check.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7LHWPPZECB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7LHWPPZECB');
</script>

<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<?php include('main/resend_login.php') ?>
</div>
  </body>
</html>