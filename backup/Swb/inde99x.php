<?php include('main/config.php'); 
include('main/functions.php');
//get referrer

$ref_url = $_SERVER['HTTP_REFERER'];
$parse = parse_url($ref_url);
$ref_url_clean = $parse['host'];
$ref_url_clean = ''.$ref_url_clean.'';

$get_ref = strip_tags($_GET["ref"]);
$get_ref = str_replace('-', ' ', $get_ref);
if($get_ref != NULL){
$_SESSION['ref']= $get_ref;
echo $_SESSION['ref'];
}

// store session data
if(!isset($_SESSION['ref_url'])){
$_SESSION['ref_url']= $ref_url;
}

function isMobile() {
return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

$result = $conn->query("SELECT COUNT(*) FROM `sweebs`");
$row = $result->fetch_row();
$sweeb_count = $row[0];
$result->close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1"><!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Sweeba</title>
<meta name="description" content="The social network that Pays you">
<meta name="author" content="Sweeba">
<meta name="apple-mobile-web-app-capable" content="yes">
<link rel="apple-touch-icon" href="http://www.sweeba.com/dist/img/app2.png">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<link rel="apple-touch-startup-image" href="http://www.sweeba.com/dist/img/app2.png">
<link rel="icon" href="/favicon.ico">
<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link href="/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="/dist/css/index.css" rel="stylesheet" type="text/css">
<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "url": "https://www.sweeba.com",
      "logo": "https://www.sweeba.com/dist/img/sweebalogo.png"
    }
</script>
<style type="text/css">
.bg_main {
  height:200px;
  background:url(https://www.sweeba.com/dist/img/home-back.png) no-repeat center center fixed; 
  background-color:#363f48;
  background-size: 100%;
  background-repeat: no-repeat;
  background-position: center-top; 
  margin-bottom:50px;
  }
</style>
</head>
<body> 




<div class="bg_main">

<div style="padding-top:60px;">
<p style="text-align:center;"><img src="dist/img/log_b.png" class="c1" alt="logo"></p>
<h2 class="c6">Join the Sweeba movement today</h2>
</div>

<div class="pull-right" style="margin-top:-120px;padding-right:30px;"><?php if(!isMobile()){ ?><?php if($logged_in != 'yes'){ ?>
<a href="register.php" class="btn btn-main">Register</a>
<a href="login.php" class="btn btn-main"><img src="dist/img/lock26.png" alt="login"> Login</a><?php }else{ ?>
<a href="dash.php" class="btn btn-main"><img src="dist/img/lock26.png" alt="login"> Account</a><?php } ?><?php } ?></div>
</div>


<?php if(isMobile()){ ?><?php if($logged_in != 'yes'){ ?>
<div style="margin-top:-60px;">
<div class="col-xs-6" style="padding:0px;"><a href="register.php" class="btn btn-block btn-main" style="background:#5fb5f2;border:0px;color:#fff;border-radius:0px;">Register</a></div>
<div class="col-xs-6" style="padding:0px;"><a href="login.php" class="btn btn-block btn-main" style="background:#a2de5a;border:0px;color:#fff;border-radius:0px;">Login</a></div>
<?php }else{ ?>
<a href="dash.php" class="btn btn-block btn-main" style="background:#5fb5f2;border:0px;color:#fff;border-radius:0px;"><img src="dist/img/lock26.png" alt="login"> Account</a>
</div>
<?php } } ?>

<div class="wrap">
<?php if(!isMobile()){ ?>
<div id="wrapper">
<div id="columns">



<?php
}

$sql = "SELECT *  FROM sweebs WHERE status='active' AND image != '' ORDER by rand(), up DESC, comments DESC, views DESC LIMIT 25";

$result = $conn->query($sql);
if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
$user_id_sweeb = $row['user_id'];
$sweeb_id_cur = $row['id'];
$link = base64_encode($sweeb_id_cur);
    
    
    $title = $row['title'];
    $title = htmlspecialchars_decode($title, ENT_NOQUOTES);
    $content = $row['content'];
    $content = htmlspecialchars_decode($content, ENT_NOQUOTES);
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
    $content = substr($content, 0, 200) . '...';
    
    if(!isMobile()){

    echo '<div class="pin"><div style="padding:10px;padding-top:5px;">';
    if($image_str != NULL){
    echo '<div class="visible-xs" style="padding-top:20px;"></div>';
    echo '<div class="col-md-12 col-xs-12" style="padding:0px;border:1px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;"><img src="grab_image.php?img='.$row['image'].'" style="min-height:1px;min-width:1px;max-height:250px;max-width:100%;border-radius:3px;" alt="'.$row['username'].' sweeb image"></div>';
    }
    echo '<h3 style="color:#5aa7de;font-size:18px;font-weight:Bold;">'.$row['title'].'</h3>';
    echo '<p style="font-family: \'Open Sans\', sans-serif;white-space: pre-line;word-wrap: break-word;" class="output">'.$content.'</p>';
    echo '</div><div style="width:100%;background:#eef0f2;height:auto;padding:10px;">';
    echo '<a href="/'.$row['id'].'/'.$slug_go.'" class="btn btn-main btn-block" style="background:#5fb5f2;border:0px;color:#fff;">Check It Out!</a>';
    echo '</div></div>';
    
    
    }else{
    //mobile 

    echo '<div class="col-xs-12" style="padding:10px;margin-left:-1px;">';
    echo '<div class="col-xs-12 box" style="margin:0px;margin-bottom:5px;"><div style="padding:10px;">';
    echo '<a href="/'.$row['username'].'" style="font-weight:bold;font-size:16px;color:#3e4851;" class="pull-left">'.$row['username'].'</a>';
    echo '<p style="font-weight:bold;font-size:14px;color:#3e4851;" class="pull-right">'.time2str($datetime).'</p><br>';
    echo '<div class="visible-xs" style="padding-top:10px;"></div>';
    if($image_str != NULL){
    echo '<div class="visible-xs" style="padding-top:20px;"></div>';
    echo '<div class="col-md-12 col-xs-12" style="padding:0px;border:1px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;"><img src="grab_image.php?img='.$row['image'].'" style="min-height:1px;min-width:1px;max-height:250px;max-width:100%;border-radius:3px;"></div>';
    }
    
    echo '<h3 style="color:#5aa7de;font-size:18px;font-weight:Bold;">'.$row['title'].'</h3>';
    echo '<p style="padding:0px;color:#000;font-family: \'Open Sans\', sans-serif;white-space:wrap;word-wrap: break-word;" class="output">'.$content.'</p>';
    echo '</div><div style="width:100%;background:#eef0f2;height:auto;padding:10px;">';
    echo '<a href="/'.$row['id'].'/'.$slug_go.'" class="btn btn-main btn-block" style="background:#5fb5f2;border:0px;color:#fff;">Check It Out!</a>';
    echo '</div></div></div>';
    
    }}
}

$conn->close();
?>


</div>
</div></div>

<footer>
<div style="clear:both;"></div>
<div style="background:#f6f8fa;width:100%;margin-top:50px;padding:15px;"><div class="wrap">
<div class="pull-right">
 <a class="btn btn-main" href="/disclaimer.php" style="background:#5fb5f2;border:0px;color:#fff;border-radius:0px;">Disclaimer</a> 
  <a class="btn btn-main" href="/privacy.php" style="background:#5fb5f2;border:0px;color:#fff;border-radius:0px;">Privacy</a> 
 <a class="btn btn-main" href="/tos.php" style="background:#5fb5f2;border:0px;color:#fff;border-radius:0px;">TOS</a> 
 </div><div style="clear:both;"></div>
 </div></div>
</footer>



<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript">
</script><script src="/dist/js/bootstrap.min.js" type="text/javascript">
</script><!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/dist/js/ie10-viewport-bug-workaround.js" type="text/javascript">
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