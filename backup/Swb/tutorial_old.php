<?php include('main/config.php');
// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();
include('main/header.php');
?>
<div class="wrap_small" style="margin-top:100px;padding:20px;">
<div class="col-md-12" style="padding:0px;background:#fff;">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;font-family: 'Open Sans', sans-serif;">
Sweeba Tips
</div>

<div style="padding:20px;">

<div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
    <span class="sr-only">60% Complete</span>
  </div>
</div>

<center>

<img src="dist/img/SweebaCups.PNG" width="250" border="0">
</center>
<br>
<strong>Welcome back to Sweeba!</strong> Start by posting your daily Sweebs and adding friends. Share your Sweebs on social sites such as Facebook and Twitter.
<br><Br>
<a href="dash.php" class="btn btn-default btn-block">Continue &raquo; </a>

<a href="faq.php" class="btn btn-default btn-block">View Sweeba FAQ &raquo; </a>
</div></div>


</div>
</div>
</div>



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
    
    
 <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47181279-4', 'auto');
  ga('send', 'pageview');

</script>   
  </body>
</html>