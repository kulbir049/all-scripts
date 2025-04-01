<?php 
include('main/add_member.php'); ?>
<?php

$get_ref = strip_tags($_GET["ref"]);
if($get_ref != NULL){
$_SESSION['ref']= $get_ref;
}else{
$ref = $_SESSION['ref'];
}


if(!isset($_SESSION['ref_url'])){
$ht_ref = 'None';
}else{
$ht_ref = $_SESSION['ref_url'];
}
?>
<?php include('main/header.php'); ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<style type="text/css">
    #g-recaptcha-response {
  display: block !important;
  position: absolute;
  margin: -78px 0 0 0 !important;
  width: 302px !important;
  height: 76px !important;
  z-index: -999999;
  opacity: 0;
}
</style>


<html>
<body>
<div class="wrap_small" style="margin-top:0px;padding:20px;">
<div class="col-md-12" style="padding:0px;background:#fff;">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;font-family: 'Open Sans', sans-serif;">
Welcome To Sweeba
</div>


<div style="padding:20px;">



<h2 class="c6"><FONT color="#5cb85c" >Sweeb. </font><FONT color="#00adee" >Earn.</font> <FONT color="#5cb85c">Surf.</font></h2>
<img src="images/girl-in-green.gif" align="right" width="125" alt="sweeba">

<div class="textbody"><b>Advertise your <img src="images/click-funnels.png" width="55" height="30"> links on Sweeba and start earning money!</font></b></p>
</div>


  <form method="post" class="example ws-validate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">


  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo '<div class="alert alert-warning">'.$Err.'</div>';
  }
  ?>
  

  <div class="form-group">

  <input type="text" class="form_in form-control" name="name" id="name" placeholder="Your full name." value="<?php echo $name; ?>">
  </div>

  <div class="form-group">
  <input type="email" class="form_in form-control" name="email" id="exampleInputEmail1" placeholder="Enter email" value="<?php echo $email; ?>">
  </div>


  <div class="form-group">
  <input type="password" class="form_in form-control" name="password" id="exampleInputPassword1" placeholder="Password">
  </div>

   <input type="text" class="form_in form-control" name="username" id="username" placeholder="Sweeba Name"onchange="showUser(this.value)" value="<?php echo $username; ?>">
  <div id="txtHint"></div>

  <br>
  <div class="checkbox">
  <label>
  <input type="checkbox" style="font-family: 'Open Sans', sans-serif;" required> I agree to the <a href="/tos.php">Terms of Service</a>
  </label>
  </div>
 <div class="g-recaptcha" data-sitekey="<?php echo recaptcha_key;?>"></div>
 <br>
  <button type="submit" class="btn btn-main btn-block">Get Your Sweeb On!</button>

  </form>

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



    
    <script>
   function onSubmit(token) {
     document.getElementById("demo-form").submit();
   }
 </script>

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
<script type="text/javascript">
    window.addEventListener('load', () => {
  const $recaptcha = document.querySelector('#g-recaptcha-response');
  if ($recaptcha) {
    $recaptcha.setAttribute('required', 'required');
  }
})
</script>

  </body>
</html>