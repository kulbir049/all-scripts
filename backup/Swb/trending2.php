<?php include('main/config.php');
// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();
include('main/functions.php');

$sort = strip_tags($_GET["sort"]);

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
?>
<?php include('main/header.php'); ?>
    
<!--// SIDEBAR -->
<style>
.trend_button {
border:0px;color:#fff;
}
.trend_button:hover { 
background:#3e4851;
border:0px;

}

.orange {
background:#F44336;
}
.green {
background:#a2de5a;
}
.blue { 
background:#5fb5f2;
}
.red {
background:#f26986;
}
</style>
<div class="col-xs-12 col-md-2" style="padding:20px;">
  <div class="col-xs-12 col-md-12 box" style="padding:0px;border:0px;">

  <div style="width:100%;background:#3e4851;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;margin-bottom:10px;">
Trending Sweebs!
</div>
<div style="padding:10px;">

<a href="?sort=newest" class="btn btn-main btn-block trend_button orange">Newest</a>
<a href="?sort=daily" class="btn btn-main btn-block trend_button green">Daily</a>
<a href="?sort=weekly" class="btn btn-main btn-block trend_button blue">Weekly</a>
<a href="?sort=monthly" class="btn btn-main btn-block trend_button red">Monthly</a>


</div>
</div>

</div>

<!--// END SIDEBAR -->
<div class="container-fluid" style="padding:0px;" >
<div class="col-xs-12 col-md-10" style="margin:0px;">


<?php if(!isMobile()){ ?>
<div id="wrapper" style="padding:0px;">
<div id="columns" style="padding:0px;">

<?php } ?>


<br>
<?php
$timestamp1 = date('Y-m-d');

if($sort == 'newest'){
$sql = "SELECT * FROM `sweebs` WHERE status='active' ORDER BY id DESC Limit 50";
}elseif($sort == 'weekly'){
$sql = "SELECT * FROM `sweebs` WHERE `date` BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() AND status='active' ORDER BY up DESC, comments DESC, views DESC Limit 50";
}elseif($sort == 'monthly'){
$sql = "SELECT *  FROM sweebs WHERE MONTH(`date`) = MONTH(CURDATE()) AND status='active' ORDER BY up DESC, comments DESC, views DESC Limit 50";
}elseif($sort== 'daily'){
$sql = "SELECT *  FROM sweebs WHERE date = $timestamp1 AND status='active' ORDER BY views ASC Limit 50";

}else{
$sql = "SELECT * FROM `sweebs` WHERE status='active' ORDER BY id DESC Limit 50";
}
$result = $conn->query($sql);

if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
$user_id_sweeb = $row['user_id'];
$sweeb_id_cur = $row['id'];
$link = base64_encode($sweeb_id_cur);
    
    
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
    
    if(!isMobile()){

    echo '<div class="pin"><div style="padding:10px;padding-top:5px;">';
    if($image_str != NULL){
    echo '<div class="visible-xs" style="padding-top:20px;"></div>';
    echo '<div class="col-md-12 col-xs-12" style="padding:0px;border:1px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;"><img src="grab_image.php?img='.$row['image'].'" style="min-height:1px;min-width:1px;max-height:250px;max-width:100%;border-radius:3px;"></div>';
    }elseif($video_str != NULL){
    echo '<div class="visible-xs" style="padding-top:20px;"></div>';
    echo '<div class="col-md-12 col-xs-12" style="padding:0px;border:1px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;word-wrap: break-word;">
  
    <iframe width="225" height="195" src="https://www.youtube.com/embed/'.$video_str.'?autoplay=0&showinfo=0&controls=0"" frameborder="0" allowfullscreen></iframe>
    
    </div>';
    }
    echo '<h3 style="color:#5aa7de;font-size:18px;font-weight:Bold;">'.$row['title'].'</h3>';
    echo '<p style="font-family: \'Open Sans\', sans-serif;white-space: pre-line;word-wrap: break-word;" id="output">'.$content.'</p>';
    echo '</div><div style="width:100%;background:#eef0f2;height:auto;padding:10px;">';
    echo '<a href="/'.$row['id'].'/'.$slug_go.'" class="btn btn-main btn-block" style="background:#5fb5f2;border:0px;color:#fff;">Check It Out!</a>';
    echo '</div></div>';
    
    
    }else{
    //mobile 
    
    
    echo '<div class="col-md-12 col-xs-12 box" style="padding:0px;margin-left:-1px;">';
    echo '<div class="col-xs-12" style="margin:0px;margin-bottom:5px;padding:20px;padding-right:30px;">';
    echo '<a href="/'.$row['username'].'" style="font-weight:bold;font-size:16px;color:#3e4851;" class="pull-left">'.$row['username'].'</a>';
    echo '<p style="font-weight:bold;font-size:14px;color:#3e4851;" class="pull-right">'.time2str($datetime).'</p><br>';
    echo '<div class="visible-xs" style="padding-top:10px;"></div>';
    if($image_str != NULL){
    echo '<div class="visible-xs" style="padding-top:20px;"></div>';
    echo '<div class="col-md-12 col-xs-12" style="padding:0px;border:1px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;"><img src="grab_image.php?img='.$row['image'].'" style="min-height:1px;min-width:1px;max-height:250px;max-width:100%;border-radius:3px;"></div>';
    }elseif($video_str != NULL){
    echo '<div class="visible-xs" style="padding-top:20px;"></div>';
    echo '<div class="col-md-12 col-xs-12" style="padding:0px;border:1px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;word-wrap: break-word;">';

    echo '<iframe width="210" height="300" src="https://www.youtube.com/embed/'.$video_str.'?autoplay=0&showinfo=0&controls=0"" frameborder="0" allowfullscreen></iframe>
</iframe>';


   echo '</div>';
    }
    
    echo '<h3 style="color:#5aa7de;font-size:18px;font-weight:Bold;">'.$row['title'].'</h3>';
    echo '<p style="padding:0px;color:#000;font-family: \'Open Sans\', sans-serif;word-wrap:normal;white-space: wrap;" id="output">'.$content.'</p>';
    echo '<span style="font-weight:bold;color:#8094a5;font-size:14px;padding-right:14px;word-wrap:normal;">'.$row['up'].' <img src="images/jOiTl3b.png"></span>';
    echo '<span style="font-weight:bold;color:#8094a5;font-size:14px;padding-right:14px;word-wrap:normal;">'.$row['down'].' <img src="images/h45ZLRD.png"></span>';
    echo '<span style="font-weight:bold;color:#8094a5;font-size:14px;">'.$row['comments'].' <img src="images/dg7mOfT.png"></span>';
    echo '<a href="/'.$row['id'].'/'.$slug_go.'" class="btn btn-main pull-right">Check it out!</a>';
    echo '</div></div>';
    
    }}
} else {
    echo '</div><div style="background:#fff;padding:20px;color:#3e4851;text-align:center;font-size:16px;width:100%;">There are currently no trending sweebs! Go ahead and start a new trending sweeb! <a href="sweeb.php">Create A Sweeb!</a>';
    echo '<br></div><div style="background:#eef0f2;padding:20px;color:#fff;text-align:center;font-size:16px;width:100%;"><a href="dash.php" class="btn btn-main btn-block" style="background:#5fb5f2;border:0px;color:#fff;">Return To The Dashboard!</a></div>';
    
    
    
    
}
$conn->close();
?>
	

<Style>


#columns {
	-webkit-column-count: 3;
	-webkit-column-gap: 10px;
	-webkit-column-fill: auto;
	-moz-column-count: 3;
	-moz-column-gap: 10px;
	
	column-count: 3;
	column-gap: 15px;
	column-fill: auto;

}

.pin {  
        width:250px;
        border-radius:3px;
	display: inline-block;
	background: #FEFEFE;
	border: 2px solid #FAFAFA;
	box-shadow: 0 1px 2px rgba(34, 25, 25, 0.4);
	margin: 0 2px 15px;
	-webkit-column-break-inside: avoid;
	-moz-column-break-inside: avoid;
	column-break-inside: avoid;
	padding: 0px;
	padding-bottom: 0px;
	background: -webkit-linear-gradient(45deg, #FFF, #F9F9F9);
	opacity: 1;
	
	-webkit-transition: all .2s ease;
	-moz-transition: all .2s ease;
	-o-transition: all .2s ease;
	transition: all .2s ease;
}

.pin img {
	width: 100%;
	border-bottom: 1px solid #ccc;
	padding-bottom: 0px;
	margin-bottom: 5px;
}

.pin p {
	
	color: #333;
	margin: 0;

}




</style>
     
            
   
          </div>  
            
            
            
            
            
            
            
            
</section>
</div>

</div></div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/dist/js/ie10-viewport-bug-workaround.js"></script>

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