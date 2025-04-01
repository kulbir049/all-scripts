<?php include('main/config.php');

include('main/add_check.php');
// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();
?>

<!-- Modal -->
<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<!-- End Modal -- >
<?php include('main/header.php'); ?>
<style>
body {
font-family: 'Open Sans', sans-serif;
}
p {
font-family: 'Open Sans', sans-serif;
}

.preview {
border-radius:3px;
padding:10px;
-webkit-box-shadow: 0px 0px 8px 0px rgba(226, 226, 226, 0.75);
-moz-box-shadow:    0px 0px 8px 0px rgba(226, 226, 226, 0.75);
box-shadow:         0px 0px 8px 0px rgba(226, 226, 226, 0.75);
}
</style>


<div class="container" style="margin-top:100px;padding:0px;font-family: 'Open Sans', sans-serif;">
<div class="row">
  <div class="col-xs-12 col-md-6 col-md-offset-1" style="background:#fff;padding:0px;">
  <div style="width:100%;background:#f26986;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;margin-bottom:15px;">
Check In
</div>


<div style="padding:20px;">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
echo $Err;
}
?>

<form method="post" enctype="multipart/form-data">


<p>Your Location:</label>
<input type="text" class="form-control form_in" id="input" name="content" placeholder="Location">

<div id="count" class="pull-right" style="font-size:12px;"></div>
<br>




</div>
<div style="background:#eef0f2;width:100%;padding:20px;border-top:1px solid:#d7dce1;">
<button type="submit" class="btn btn-main" style="background:#fff;font-family: 'Open Sans', sans-serif;
">Check In <img src="dist/img/continue_icon.png"></button>




</div>
</form>

</div>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7LHWPPZECB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7LHWPPZECB');
</script>
</head>
<body>

<div class="col-md-4 hidden-xs hidden-sm" style="background:#fff;padding:0px;margin-left:25px;">


<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
Why Check In?
</div>
<div style="padding:10px;font-family: 'Open Sans', sans-serif;">
<div class="preview">
Checking in to a location will let your friends and followers know what you are up to!
</div>


</div>
    </div>
    </div>
    
    
    
    
    
    


  
    <!-- END OF COLLAPSABLE INFORMATION -->
</div>







</div>
</div>
</div>



      <footer>
<bR>
<center>

<br><Br>
<p>&copy; Sweeba.com 2024</p>
</center>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

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
$(document).ready(function(){
    $("#video").click(function(){
        $("#video_s").show(500);
        $("#image_s").hide(500);
    });
        $("#image").click(function(){
        $("#video_s").hide(500);
        $("#image_s").show(500);
    });
});
</script>

<script>
$(document).ready(function() {
$("#input").keyup(function(){
  $("#count").text("Characters left: " + (5000 - $(this).val().length));
});
});


//preview text
$(document).ready(function() {
$('#title_input').keyup(function() {
$('#title_output').html($(this).val().replace(/(<([^>]+)>)/ig,"")); 
});
});
//for picture SWEEB


//preview text
$(document).ready(function() {
$('#input').keyup(function() {
$('#output').html($(this).val().replace(/(<([^>]+)>)/ig,"").replace(/\n/g,'<br/>')); 
});
});



//preview image
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    
    
    
    $("#fileInput").change(function(){
        readURL(this);
    });


   function chooseFile() {
      $("#fileInput").click();
   }
   
// javascript

document.getElementById('fileInput').onchange = uploadOnChange;
    
function uploadOnChange() {
    var filename = this.value;
    var lastIndex = filename.lastIndexOf("\\");
    if (lastIndex >= 0) {
        filename = filename.substring(lastIndex + 1);
    }
    document.getElementById('filename').value = filename;
}
   
   
//END PICTURE SWEEB
   
   
</script>

 <script>
    
$("[data-collapse-group='myDivs']").click(function () {
    var $this = $(this);
    $("[data-collapse-group='myDivs']:not([data-target='" + $this.data("target") + "'])").each(function () {
        $($(this).data("target")).removeClass("in").addClass('collapse');
    });
});

    
    
    
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