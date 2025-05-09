<?php include('main/config.php'); 
include('main/functions.php');
//get referrer

$ref_url = $_SERVER['HTTP_REFERER'];
$parse = parse_url($ref_url);
$ref_url_clean = $parse['host'];
$ref_url_clean = ''.$ref_url_clean.'';

$get_ref = strip_tags($_GET["ref"]);
if($get_ref != NULL){
$_SESSION['ref']= $get_ref;

$sq_ref = "SELECT *  FROM members WHERE username = '$get_ref'";
$resul_ref = $conn->query($sq_ref);
while($ro_ref = $resul_ref->fetch_assoc()) {
$sweeb_avatar_ref = $ro_ref['avatar'];
$sweeb_username_ref = $ro_ref['username'];
}
}

// store session data
if(!isset($_SESSION['ref_url'])){
$_SESSION['ref_url']= $ref_url;
}


$result = $conn->query("SELECT COUNT(*) FROM `sweebs`");
$row = $result->fetch_row();
$sweeb_count = $row[0];
$result->close();

$result = $conn->query("SELECT COUNT(*) FROM `members`");
$row = $result->fetch_row();
$total_user = $row[0];
$result->close();
  
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">
<head>
<title>Sweeba</title>
<meta>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="The Social network that Rewards you!">
<meta name="author" content="Sweeba">
<meta name="apple-mobile-web-app-capable" content="yes">
<link rel="apple-touch-icon" href="https://www.sweeba.com/dist/img/app2.png">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="robots" content="index, follow" />
<meta name="viewport" content="width=device-width, initial-scale=1"><!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7LHWPPZECB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7LHWPPZECB');
</script>


<title>Sweeba</title>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<link rel="apple-touch-startup-image" href="https://www.sweeba.com/dist/img/app2.png">
<link rel="icon" href="/favicon.ico">
<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link href="/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">

 <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "url": "https://www.sweeba.com",
      "logo": "https://www.sweeba.com/dist/img/sweebalogo.png"
    }
    </script>
 
<style type="text/css">
body {
background:none;
font-family: 'Open Sans', sans-serif;
}

html {
  background: url(dist/img/home-back5.png) repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  }
  .wrap {
max-width:900px;

margin-left: auto;
margin-right: auto;
opacity:1;
}
#g-recaptcha-response {
  display: block !important;
  position: absolute;
  margin: -78px 0 0 0 !important;
  width: 302px !important;
  height: 76px !important;
  z-index: -999999;
  opacity: 0;
}
  .wrap_big {
max-width:1500px;

margin-left: auto;
margin-right: auto;
opacity:1;
}
.btn-main {
padding-top:8px;
padding-bottom:8px;
padding-left:10px;
padding-right:10px;
color:#fff;
border:2px solid #fff;
border-radius:5px;
font-size:12px;
text-align:center;
font-weight:bold;
font-family: 'Open Sans', sans-serif;

}

.swing {
    animation: swing ease-in-out 1s infinite alternate;
    transform-origin: center -20px;
    box-shadow: 5px 5px 10px rgba(0,0,0,0.5);
}
/*.swing img {
    border: 5px solid #262626;
    display: block;
}*/

 
@keyframes swing {
    0% { transform: rotate(3deg); }
    100% { transform: rotate(-3deg); }
}

</style>

<style type="text/css">
input::-moz-placeholder {
  color: green;
}
.form_top {

   -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    border-radius:3px 3px 0px 0px;
    box-shadow:0px;
    border:0px;
    height: 50px; // Increase height as required
    margin-bottom: 30px;
    padding: 0 20px; // Now only left & right padding
}
.form_middle {
   -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    border-radius:0px;
    box-shadow:0px;
    border:0px;
    height: 50px; // Increase height as required
    margin-bottom: 30px;
    padding: 0 20px; // Now only left & right padding
}
.form_bottom {
   -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    border-radius:0px 0px 3px 3px;
    box-shadow:0px;
    border:0px;
    height: 50px; // Increase height as required
    margin-bottom: 30px;
    padding: 0 20px; // Now only left & right padding
}


</style>

<style type="text/css">
 div.c12 {padding: 0px; padding-top: 100px}
 div.c11 {padding:80px;padding-top:0px;padding-right:0px;}
 form.c10 {text-align:right;}
 form.c10 div,form.c10 div input{border-radius: 15px;}
 .c9 {background:#00adee;padding:15px;color:#fff;text-align:center;}
 h2.c8 {color:#fff;font-weight:bold;font-size:19px;letter-spacing: 1px;font-family: 'Open Sans', sans-serif;}
 p.c7 {color:#fff;line-height: 250%;color:#a5b4c4;font-size:15px;font-family: 'Open Sans', sans-serif;}
 h2.c6 {color:#fff;font-weight:bold;font-size:23px;letter-spacing: 1px;font-family: 'Montserrat,sans-serif', sans-serif;}
 div.c5 {padding: 0px; padding-top: 50px}
 p.c4 {text-align:right;}
 div.c3 {padding:0px;}
 p.c2 {text-align:left;}
 img.c1 {width:150px;height:auto;margin-left:80px;}
 
 .sweeb_b {
 background: rgb(54, 25, 25);
 background: rgba(255, 255, 255, .1);
 border-radius:3px;
 color:#fff;
 padding-top:5px;

 overflow:hidden;
 margin-bottom:10px;
 margin-top:50px;
 }
 
 .sweeb_bottom {
 padding:10px;
 padding-top:8px;
 width:100%;
 height:40px;
 overflow:hidden;
 border-top:1px solid rgba(255, 255, 255, .1);
 background: rgb(54, 25, 25);
 background: rgba(0, 173, 238, .1);
 }
 
 .img_border {
 border:0px solid rgba(255, 255, 255, .2);
 border-radius:3px;
 }
 
 .sweeb_bottom:hover {
 background:#00adee;
 }
 
 .sweeb_a {
 color:#fff;
 text-align:center;
 font-size:16px;
 }
 .sweeb_a:hover{
 color:#fff;
 text-decoration:none;
 }
 
 .avatar {
display:block;
border-radius:100%;
margin-top:10px;
margin-left:0px;
margin-right:10px;
height:45px;
width:45px;
}

.textbody {
    color: #ffffff;
    display: block;
    font-family: Montserrat,sans-serif;
    font-size: 25px;
    font-weight: 500;
    line-height: 120%;
    margin: 10px 0 30px;
    max-width: 200px 
}
.textbody2 {
    color: #ffffff;
    display: block;
    font-family: Montserrat,sans-serif;
    font-size: 20px;
    font-weight: 500;
    line-height: 120%;
    margin: 10px 0 30px;
    max-width: 200px 
}
</style>
</head>
<body> 




<div class="wrap hidden-xs">
<div class="col-md-12 c5">
<div class="col-md-6 col-xs-6 c3">
<p class="c2"><a href="https://sweeba.com"><img src="dist/img/log_b.png" class="c1" alt="logo"></a></p>
</div>
<div class="col-md-6 col-xs-6">
<p class="c4"><?php if($logged_in != 'yes'){ ?><a href="login.php" class="btn btn-main"><img src="dist/img/lock26.png" alt="login"> Sign In Earn Rewards</a><?php }else{ ?>
<a href="dash.php" class="btn btn-main"><img src="dist/img/lock26.png" alt="login"> Account</a><?php } ?></p>
</div>
</div>
</div>
</div>



<style>

.logo {
display: block;
width: auto;
max-width: 100%;
margin-top:3px;
margin-left:-10px;

}


.nav-marg {
margin-left:5%;
margin-right:5%;
}
</style>



    <nav class="navbar navbar-default navbar-fixed-top visible-xs" style="font-family: 'Open Sans', sans-serif;">
     <div class="nav-marg">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="https://sweeba.com"><img src="dist/img/ok.png"  width="122" height="36" padding="5" class="logo visible-xs"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
        
             <ul class="nav navbar-nav navbar-right" >
         
            <ul class="nav navbar-nav navbar-right" style="font-family: 'Open Sans', sans-serif;">
            <li><a href="index.php"><img src="images/home.png" style="margin-top:-4px;"> Home</a></li>
            <li><a href="login.php"><img src="dist/img/login.png" style="margin-top:-4px;"> Sign In</a></li>
            <li><a href="register.php"><img src="dist/img/users81.png" style="margin-top:-4px;"> Register</a></li>
           
            </ul>
  
        </div>
     </div>
    </nav>



<div class="wrap_big hidden-xs">
<div class="col-md-12 col-xs-12 c12">


<div class="hidden-xs">
<div class="col-md-2" style="margin-top:-245px;margin-left:-20px;">
<?php

//$sql = "SELECT *  FROM sweebs WHERE MONTH(`date`) = MONTH(CURDATE()) AND status='active' AND image != '' ORDER by rand(), up DESC, comments DESC, views DESC LIMIT 2";
$sql = "SELECT *  FROM sweebs WHERE  status='active' AND image != '' ORDER by rand(), up DESC, comments DESC, views DESC LIMIT 2";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
$user_id_sweeb = $row['user_id'];
$sweeb_id_cur = $row['id'];
$link = base64_encode($sweeb_id_cur);

$sq = "SELECT *  FROM members WHERE id = '$user_id_sweeb'";
$resul = $conn->query($sq);
while($ro = $resul->fetch_assoc()) {
$sweeb_avatar = $ro['avatar'];
$sweeb_username = $ro['username'];
}

    
    $title = $row['title'];
    $content = $row['content'];
    $image_str = $row['image'];
    $video_str = $row['video'];
    $datetime = strtotime($row['date']); 
    $words1 = str_word_count($content);

    if($title == NULL){
    if($words1 <= '1'){
    $content = substr($content, 0, 10);
    }
    $slug_go = limit_text($content,5);
    $slug_go = substr($content, 0, 20);
    $slug_go = slugify($slug_go);
    }else{
    $slug_go = slugify($title);
    }
    $content = substr($content, 0, 50) . '...';
    
   

    echo '<div class="sweeb_b">';
    echo '<div class="col-md-12"><img class="pull-left avatar" src="grab_image.php?img='.$sweeb_avatar.'"><div style="margin-top:20px;font-size:16px;font-weight:bold;"> '.$sweeb_username.'</div></div>';
    echo '<div class="col-md-12" style="padding:10px;">'; 
    
    if($image_str != NULL){ echo '';
    echo '<div class="col-md-12 img_border" style="padding:0px;margin-bottom:10px;text-align:center;"><img src="grab_image.php?img='.$row['image'].'" style="min-height:1px;min-width:1px;max-height:250px;max-width:100%;border-radius:3px;"></div>';
    }elseif($video_str != NULL){
 
    echo '<div class="col-md-12 col-xs-12" style="padding:0px;border:1px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;word-wrap: break-word;">
  
    <iframe width="225" height="195" src="https://www.youtube.com/embed/'.$video_str.'?autoplay=0&showinfo=0&controls=0"" frameborder="0" allowfullscreen></iframe>
    
    </div>';
    }
    echo '<h3 style="color:#5aa7de;font-size:18px;font-weight:Bold;">'.$row['title'].'</h3>';
    echo '<p style="font-family: \'Open Sans\', sans-serif;white-space: pre-line;word-wrap: break-word;" id="output">'.$content.'</p>';
    echo '</div><div style="clear:both;"></div><a href="/'.$row['id'].'/'.$slug_go.'" class="sweeb_a"><div class="sweeb_bottom">';
    echo 'Check It Out!';
    echo '</div></a></div>';
    
    
    }
}

//$conn->close();
?>

  <footer>
      <center>
<br><Br>
<p><a href="/tos.php"><u>Terms of Service</a></u> | <a href="/discalaimer.php"><u>Privacy Policy</a></u>  | <a href="https://BarrieAds.ca"><u>Barrie, Ontario</a></u> | <font style="color:#fff;font-size:15px;font-weight:Bold;">Copyright © 2016–2024</font>  | <a href="https://www.sweeba.com/187984/sweeba-update-1-1-3"><font style="color:#fff;font-size:15px;font-weight:Bold;"> Version 1.1.3 </font></a> 
</p>
<br><BR>
</center>
      </footer>
</div></div>


<div class="col-md-4 col-xs-12 c3" style="margin-left:80px;margin-top:-50px;">

<img src="images/girl-in-green.gif" align="right" width="200" alt="sweeba"></a>

<h2 class="c6"><FONT color="#5cb85c" >Sweeb. </font><FONT color="#00adee" >Earn.</font> <FONT color="#5cb85c">Surf.</font></h2>
<br>
<div class="textbody"><b>Join thousands of members from around the world who are Sweebing, earning money and exposure!</font></b></p><br>
</div>

</div>
<div class="col-md-4 col-xs-12 c11" style="margin-top:-50px;"><?php if($logged_in == 'yes'){ echo '<a class="btn btn-block c9" href="dash.php">Visit Your Account.</a>'; }else{ ?>

<div class="alert alert-info"><img class="img" src="/images/thailandflag.png" style="min-height:1px;min-width:1px;height:40px;width:40px;border-radius:0px;border-radius:100%;"></a>  Join <b>Thailand</b> members earning </div>

<form method="post" action="register.php" class="c10">
<div style="background-color: white;">

    <input type="text" name="username" class="form-control form_top" placeholder="Username" required> <input type="text" name="name" class="form-control form_middle" placeholder="Full Name" required> <input type="email" name="email" class="form-control form_middle" placeholder="Your Email" required> <input type="password" name="password" class="form-control form_bottom" placeholder="Your Password" required><br>
 

  <div class="checkbox" style="margin-top: 0;
margin-bottom: 0px;
margin-right: 110px;">
  <label>
  <input type="checkbox" style="font-family: 'Open Sans', sans-serif;" required> I agree to the <a href="/tos.php">Terms of Service</a>
  </label>
  <br><Br>
   <div class="g-recaptcha" data-sitekey="<?php echo recaptcha_key;?>" style="
margin-left: 16px;"></div>
<br>
  </div>
</div>

<br>
<button type="submit" class="btn btn-block c9"  ><strong>Start Earning Free</button></strong></form><?php } ?>

</div>
</div>
</div>







<div class="wrap visible-xs">
<div class="col-xs-12 c12" style="margin-top:-100px;">
<div class="col-xs-12 c3" style="padding:20px;">
</div>
<div class="col-xs-12 c11" style="padding:10px;">
<h2 class="c6"><FONT color="#5cb85c" >Sweeb. </font><FONT color="#00adee" >Earn.</font> <FONT color="#5cb85c">Surf.</font></h2>
<br>
<img src="images/girl-in-green.gif" align="right" width="150" alt="sweeba"></a>
<div class="textbody2"><b>Join thousands of members worldwide who are Sweebing, earning money and gaining exposure!</b></div>

<div class="alert alert-info"><img class="img" src="/images/thailandflag.png" style="min-height:1px;min-width:1px;height:40px;width:40px;border-radius:0px;border-radius:100%;"></a>  Join <b>Thailand</b> members earning on Sweeba</div>

<form method="post" action="register.php" class="c10"><input type="text" name="username" class="form-control form_top" placeholder="Username"> <input type="text" name="name" class="form-control form_middle" placeholder="Your Full Name"> <input type="email" name="email" class="form-control form_middle" placeholder="Your Email"> <input type="password" name="password" class="form-control form_bottom" placeholder="Your Password"><br>

<div class="checkbox" >
<center>
  <label>
  <input type="checkbox" style="font-family: 'Open Sans', sans-serif;" required> I agree to the <a href="/tos.php">Terms of Service</a>
  </label>
  <br><br>
   <div class="g-recaptcha" data-sitekey="<?php echo recaptcha_key;?>"></div>
   </center>

  <br>
  </div>

<button type="submit" class="btn btn-block c9" ><strong>Start Earning Free</button></strong></form>

<bR><br>
<footer>

<center>

<?php

//$sql = "SELECT *  FROM sweebs WHERE MONTH(`date`) = MONTH(CURDATE()) AND status='active' AND image != '' ORDER by rand(), up DESC, comments DESC, views DESC LIMIT 2";
 $sql = "SELECT *  FROM sweebs WHERE  status='active' AND image != '' ORDER by rand(), up DESC, comments DESC, views DESC LIMIT 2";

$result = $conn->query($sql);
if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
$user_id_sweeb = $row['user_id'];
$sweeb_id_cur = $row['id'];
$link = base64_encode($sweeb_id_cur);

$sq = "SELECT *  FROM members WHERE id = '$user_id_sweeb'";
$resul = $conn->query($sq);
while($ro = $resul->fetch_assoc()) {
$sweeb_avatar = $ro['avatar'];
$sweeb_username = $ro['username'];
}

    
    $title = $row['title'];
    $content = $row['content'];
    $image_str = $row['image'];
    $video_str = $row['video'];
    $datetime = strtotime($row['date']); 
    $words1 = str_word_count($content);

    if($title == NULL){
    if($words1 <= '1'){
    $content = substr($content, 0, 10);
    }
    $slug_go = limit_text($content,5);
    $slug_go = substr($content, 0, 20);
    $slug_go = slugify($slug_go);
    }else{
    $slug_go = slugify($title);
    }
    $content = substr($content, 0, 50) . '...';
    
   

    echo '<div class="sweeb_b">';
    echo '<div class="col-md-12"><img class="pull-left avatar" src="grab_image.php?img='.$sweeb_avatar.'"><div style="margin-top:20px;font-size:16px;font-weight:bold;"> '.$sweeb_username.'</div></div>';
    echo '<div class="col-md-12" style="padding:10px;">'; 
    
    if($image_str != NULL){ echo '';
    echo '<div class="col-md-12 img_border" style="padding:0px;margin-bottom:10px;text-align:center;"><img src="grab_image.php?img='.$row['image'].'" style="min-height:1px;min-width:1px;max-height:250px;max-width:100%;border-radius:3px;"></div>';
    }elseif($video_str != NULL){
 
    echo '<div class="col-md-12 col-xs-12" style="padding:0px;border:0px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;word-wrap: break-word;">
  
    <iframe width="225" height="195" src="https://www.youtube.com/embed/'.$video_str.'?autoplay=0&showinfo=0&controls=0"" frameborder="0" allowfullscreen></iframe>
    
    </div>';
    }
    echo '<h3 style="color:#5aa7de;font-size:18px;font-weight:Bold;">'.$row['title'].'</h3>';
    echo '<p style="font-family: \'Open Sans\', sans-serif;white-space: pre-line;word-wrap: break-word;" id="output">'.$content.'</p>';
    echo '</div><div style="clear:both;"></div><a href="/'.$row['id'].'/'.$slug_go.'" class="sweeb_a"><div class="sweeb_bottom">';
    echo 'Check It Out!';
    echo '</div></a></div>';
    
    
    }
}

$conn->close();
?>


<br><Br>
<center>
<p>
<a href="/tos.php"><u>Terms of Service</a></u> | <a href="/discalaimer.php"><u>Privacy Policy</a></u> | <a href="https://BarrieAds.ca"><u>Barrie, Ontario</a></u> | <font style="color:#fff;font-size:15px;font-weight:Bold;">Copyright © 2016–2024</font>  | 
<a href="https://www.sweeba.com/187984/sweeba-update-1-1-3"><font style="color:#fff;font-size:15px;font-weight:Bold;"> Version 1.1.3 </font></a> 
</p>
</center>

</footer>

</div>
</div>
</div>
  


<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript">
</script><script src="/dist/js/bootstrap.min.js" type="text/javascript"></script>
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