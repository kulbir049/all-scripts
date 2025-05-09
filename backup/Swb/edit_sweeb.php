<?php include('main/config.php');
include('main/functions.php');
// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();


$get_m_id = strip_tags($_GET["id"]);



if($get_m_id != NULL){
$sql = "SELECT id, user_id, content, image, title, video FROM sweebs WHERE id='$get_m_id' AND user_id='$user_id' Limit 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $content_sweeb = $row['content'];
      $link = $row['link'];
$content_sweeb = htmlspecialchars_decode($content_sweeb, ENT_NOQUOTES);
$image_sweeb = $row['image'];
$title_sweeb = $row['title'];
$video_sweeb = $row['video'];

}
}else{
header("Location: dash.php");
die();
}}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $title = test_input($_POST["title"]);
  $content_in = test_input($_POST["content"]);
  $link = test_input($_POST["link"]);
  $content_str = strlen($content_in);
  $content = nl2br($content_in);
  $video_url = test_input($_POST["video"]);


if ($content == NULL){
$Err = '<div class="alert alert-warning">You have to write some content!</div>';
}elseif($content_str < '35'){
$Err = '<div class="alert alert-warning">You need to have atleast 35 characters.</div>';
}else{


$sql = "UPDATE sweebs SET content='$content', title='$title',link='$link', video='$video_url' WHERE id='$get_m_id' AND user_id='$user_id'";

if ($conn->query($sql) === TRUE) {
header("Location: /".$get_m_id."/edit");
die();
} else {
    echo "Error updating record: " . $conn->error;
}
}
}


// little sanitize funtion
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//grab tags
function get_hashtags($content_in, $str = 1) {
    preg_match_all('/#(\w+)/',$content_in,$matches);
    $i = 0;
    if ($str) {
        foreach ($matches[1] as $match) {
            $count = count($matches[1]);
            $keywords .= "$match";
            $i++;
            if ($count > $i) $keywords .= ", ";
        }
    } else {
        foreach ($matches[1] as $match) {
            $keyword[] = $match;
        }
        $keywords = $keyword;
    }
    return $keywords;
}
// end grab tags


?>
<?php
include('main/header.php');
?>

<style>
body {

font-family: 'Open Sans', sans-serif;
}
p {
font-family: 'Open Sans', sans-serif;
}

</style>

  
<div class="container" style="font-family: 'Open Sans', sans-serif;">
<div class="row">

<?php include("main/side_bar.php"); ?>

<div class="col-md-6">
<style>
.sweeb_b {
color:#fff;
margin-bottom:25px;
height:100px;
  position: relative;
  //display:block;
  font-weight: 700;
  font-size: 12px;
  letter-spacing: 2px;
 
  text-transform: uppercase;
  outline: 0;
  overflow:hidden;
  background: none;
  z-index: 1;
  cursor: pointer;
  transition:         0.08s ease-in;
  -o-transition:      0.08s ease-in;
  -ms-transition:     0.08s ease-in;
  -moz-transition:    0.08s ease-in;
  -webkit-transition: 0.08s ease-in;
}
.sweeb_b a {
color:#fff;
}
.sweeb_g {
background:#a2de5a;
}

.sweeb_bl {
background:#5fb5f2;


}
.sweeb_r {
background:#f26986;

}


.sweeb_g:hover, .sweeb_bl:hover, .sweeb_r:hover {
  color: whitesmoke;
}

.sweeb_g:before, .sweeb_bl:before, .sweeb_r:before {
  content: "";
  position: absolute;
background:#3e4851;
  bottom: 0;
  left: 0;
  right: 0;
  top: 100%;
  z-index: -1;
  -webkit-transition: top 0.09s ease-in;
}

.sweeb_g:hover:before, .sweeb_bl:hover:before, .sweeb_r:hover:before {
  top: 0;
}




.sweeb {
background:#fff;
padding:20px;
}
</style>

<div class="col-md-4 col-xs-4" style="padding:0px;">
<a href="sweeb.php" style="display:block;">
<div class="col-md-12 sweeb_b sweeb_g">

<p style="text-align:center;padding-top:20px;">
<a href="sweeb.php"><img src="dist/img/nsweeb.png" style="padding-bottom:5px;"></a><br>
<a href="sweeb.php" style="font-size:14px;font-weight:Bold;">New Sweeb</a>
</p>
</div></div></a>

<div class="col-md-4 col-xs-4" style="padding:0px;">
<div class="col-md-12 sweeb_b sweeb_bl">
<p style="text-align:center;padding-top:20px;">
<a href="trending.php"><img src="dist/img/trending.png" style="padding-bottom:5px;"></a><br>
<a href="trending.php" style="font-size:14px;font-weight:Bold;">View Trending</a>
</p>
</div></div>

<div class="col-md-4 col-xs-4" style="padding:0px;">
<div class="col-md-12 sweeb_b sweeb_r">
<p style="text-align:center;padding-top:20px;">
<a href="friends.php"><img src="dist/img/friends.png" style="padding-bottom:5px;"></a><br>
<a href="friends.php" style="font-size:14px;font-weight:Bold;">Find Friends</a>
</p>
</div>
</div>

<div class="col-md-12" style="margin-left:-1px;padding:0px;">


<div class="box" style="width:100%;padding:0px;margin-bottom:10px;margin-left:-1px;">

  <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;margin-bottom:15px;width:100%;border:0px;">
Edit Your Sweeb
</div>
<div style="padding:20px;">


<form method="post">
<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { echo $Err; } ?>
<?php if($title_sweeb != ""){ ?>
<label>Title</label>
<input type="text" class="form_in form-control" name="title" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { echo $title; }else{ echo $title_sweeb; } ?>"><br>
<?php } ?>

<?php if($video_sweeb != ""){ ?>
<label>Video Code</label>
<input type="text" class="form_in form-control" name="video" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { echo $video; }else{ echo $video_sweeb; } ?>"><br>
<?php } ?>
<label>Post Link</label> <img src="images/website-link.png" width="25">
<input type="url" class="form_in form-control" name="link" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { echo $link; }else{ echo $link; } ?>"><br>

<label>Sweeb Content</label>
<textarea class="form-control form_in" name="content" style="border:1px solid #d3dce5;box-shadow:none;border-radius:0px;" rows="8"><?php if ($_SERVER["REQUEST_METHOD"] == "POST") { echo $content; }else{ echo $content_sweeb; } ?></textarea>
<br>
<button type="submit" class="btn btn-main" style="background:#5fb5f2;border:0px;color:#fff;">Edit</button>
</form>




</div></div>





</div>

</div>
<div class="col-md-3" style="padding:0px;">
<div class="col-md-12" style="background:#fff;padding:0px;margin-bottom:25px;">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
Balance
</div>
<p style="font-size:24px;font-weight:Bold;color:#a2de5a;text-align:Center;padding:20px;">$<?php echo $balance; ?></p>
<div class="col-md-6" style="margin-bottom:20px;">
<a href="withdraw.php" class="btn btn-main btn-block">Withdraw</a>
</div>
<div class="col-md-6">
<a href="faq.php" class="btn btn-main btn-block">Need Help?</a>
</div>
<br>
</div>

<?php include('main/ad_code.php'); ?>
</div>

</div></div>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script src="/dist/js/bootstrap.min.js"></script>
   

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