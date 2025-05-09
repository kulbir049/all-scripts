<?php 
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
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


<html>
<body>
<div class="wrap_small" style="margin-top:0px;padding:20px;">
<div class="col-md-12" style="padding:0px;background:#fff;">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;font-family: 'Open Sans', sans-serif;">
Welcome To Sweeba
</div>
<div style="padding:20px;">
<h2 class="c6"><FONT color="#5cb85c" >Sweeb. </font><FONT color="#00adee" >Earn.</font> <FONT color="#5cb85c">Surf.</font></h2>
<div class="textbody"><b>Join members from around the world who are Sweebing.</font></b></p>
<br>
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

   <input type="text" class="form_in form-control" name="username" id="username" placeholder="Username **NO SPACES**" onchange="showUser(this.value)" value="<?php echo $username; ?>">
  <div id="txtHint"></div>

  <br>
  <div class="checkbox">
  <label>
  <input type="checkbox" style="font-family: 'Open Sans', sans-serif;" required> I agree to the <a href="/tos.php">Terms of Service</a>
  </label>
  </div>

  <button type="submit" class="btn btn-main btn-block" style="background:#5fb5f2;color:#fff;border:0px;">Get Your Sweeb On &raquo;</button>
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

</body>
</html>