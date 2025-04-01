<?php include('main/config.php');
// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();
include('main/functions.php');

$sort = strip_tags($_GET["sort"]);
$sortbytag = strip_tags($_GET["sortbytag"]);

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}




?>
<?php include('main/header.php'); ?>
    
<!--// SIDEBAR -->
<style>
.trend_button {
border:0px;color:#fff;
height:50px;
padding-top:14px;
}
.trend_button:hover { 
background:#3e4851;
border:0px;

}
.featured_user{
   width: 120px;
  height: 120px;
}
#columns p{white-space: unset!important;}
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

.badge { background:#3498db; margin:3px; padding:5px;}
.circular-frame {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto; /* Center the frame */
            position: relative;
        }

        /* Style for circular images */
        .circular-image {
            position: absolute;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            transform: translate(-50%, -50%);
        }

        /* Position each circular image */
        .circular-image:nth-child(1) {
            top: 10%;
            left: 50%;
        }

        .circular-image:nth-child(2) {
            top: 30%;
            left: 80%;
        }

        .circular-image:nth-child(3) {
            top: 60%;
            left: 80%;
        }

        .circular-image:nth-child(4) {
            top: 90%;
            left: 50%;
        }

        .circular-image:nth-child(5) {
            top: 60%;
            left: 20%;
        }

        .circular-image:nth-child(6) {
            top: 30%;
            left: 20%;
        }

        /* Style for images */
        .circular-image img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Maintain aspect ratio and cover entire circle */
        }
      .usersThumb img.avatar {
            width: 80px;
            height: 80px;
            text-align: center;
            margin: 0 auto;
        }
       .usersThumb p {
            font-size: 12px;
            display: flex;
            justify-content: center;
        }
</style>

<div class="col-xs-12 col-md-12" style="padding:0px;padding-bottom:30px;">
   <h3 style="text-align:center;font-family: 'Open Sans', sans-serif;color:#5fb5f2;margin-bottom:20px;">Trending tags, members & Sweebs. </h3>
    <center>
<?php


$sqlTags = "SELECT * FROM `tags` WHERE uses>50 ORDER BY RAND() Limit 16";

$resultTags = $conn->query($sqlTags);


if ($resultTags->num_rows > 0) {

while($rowtags = $resultTags->fetch_assoc()) {


$sql_delete = "SELECT * FROM sweebs WHERE tags LIKE '%".$rowtags['tag']."%' AND status='active' ORDER BY views DESC Limit 50";

$resultdelete = $conn->query($sql_delete);
if ($resultdelete->num_rows == 0) {
  $sql_delete_1 = "DELETE FROM `tags` WHERE id=".$rowtags['id'];

   $resultdelete_1 = $conn->query($sql_delete_1);  
}



    $tagSlug=$rowtags['id'];
    echo '<a href="?sortbytag='.$tagSlug.'"><span class="badge" style="padding: 10px 10px;margin: 1px;">'.$rowtags['tag'].'</span></a>';
}
}
?>
</center>
</div>

<div class="row1 featured_member1 usersThumb">



<?php

 $is_expiary_date=date('Y-m-d');
 $sqlTags = "SELECT * FROM `members` WHERE is_featured_member=1 and is_expiary_date>='".$is_expiary_date."'  ORDER BY RAND() Limit 6";

$resultTags = $conn->query($sqlTags);


if ($resultTags->num_rows > 0) {

while($rowtags = $resultTags->fetch_assoc()) {

     
     ?>
        <div class="col-md-2 col-xs-4" style="text-align: center;">
            <a href="/<?php echo $rowtags['username'];?>" style="font-weight:bold;font-size:16px;color:#3e4851; ">
       <img src="grab_image.php?img=<?php echo $rowtags['avatar'];?>" alt="Image 1" class="avatar">
        <p>
        <img src="images/featured_member.png" width="20px" height="18px">
          <?php echo $rowtags['username'];?>
           </p>
         </a>
        </div>
    <?php 
    }
    } ?>
</div>





<div class="col-xs-12 col-md-12" style="padding:0px;padding-bottom:30px;">
<!-- <div class="col-md-3">
<a href="?sort=newest" class="btn btn-main btn-block trend_button orange">Newest Sweebs</a>
</div> -->
<div class="col-md-4">
<a href="?sort=daily" class="btn btn-main btn-block trend_button green">Trending Today</a>
</div><div class="col-md-4">
<a href="?sort=weekly" class="btn btn-main btn-block trend_button blue">Weekly Trending</a>
</div><div class="col-md-4">
<a href="?sort=monthly" class="btn btn-main btn-block trend_button red">Monthly Trending</a>
</div>

</div>

<!--// END SIDEBAR -->
<div class="container-fluid">
<div class="col-xs-12 col-md-12" style="margin:0px;padding:0px;">


<?php if(!isMobile()){ ?>
<div id="wrapper">
<div id="columns" style="display: initial;">

<?php } ?>


<br>
<?php
$timestamp1 = date('Y-m-d');
if($sort == 'newest'){
$sql = "SELECT * FROM `sweebs` WHERE status='active' ORDER BY id DESC Limit 50";
}elseif($sort == 'weekly'){
$week = date('Y-m-d', strtotime('-7 days'));
$sql = "SELECT * FROM `sweebs` WHERE last_view BETWEEN '$week' AND  '$timestamp1' AND status='active' ORDER BY views DESC Limit 50";
}elseif($sort == 'monthly'){
$month = date('Y-m-d', strtotime('-30 days'));
$sql = "SELECT * FROM `sweebs` WHERE last_view BETWEEN '$month' AND  '$timestamp1' AND status='active' ORDER BY views DESC Limit 50";
}elseif($sort== 'daily'){
$sql = "SELECT * FROM sweebs WHERE last_view='$timestamp1' AND status='active' ORDER BY views DESC Limit 50";

}elseif($sortbytag>0){
$sqltag = "SELECT * FROM tags WHERE id='$sortbytag'";
$resulttagsName = $conn->query($sqltag);
$tagsData=$resulttagsName->fetch_assoc();
$sql = "SELECT * FROM sweebs WHERE tags LIKE '%".$tagsData['tag']."%' AND status='active' ORDER BY views DESC Limit 50";

}else{
$sql = "SELECT * FROM `sweebs` WHERE status='active' ORDER BY views DESC Limit 50";
}
$result = $conn->query($sql);

if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
$user_id_sweeb = $row['user_id'];
$sweeb_id_cur = $row['id'];
$link = base64_encode($sweeb_id_cur);
    
    
    $title = $row['title'];
    $content = strip_tags($row['content']);
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
    
    if(!isMobile()){ ?>

     <div class="pin"><div style="padding:10px;padding-top:5px;">
  <?php   if($image_str != NULL){ ?>
    <div class="visible-xs" style="padding-top:20px;"></div>
    <div class="col-md-12 col-xs-12" style="padding:0px;border:1px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;"><img src="grab_image.php?img=<?php echo $row['image'];?>" style="min-height:1px;min-width:1px;max-height:250px;max-width:100%;border-radius:3px;"></div>
   <?php  }elseif($video_str != NULL){ ?>
    <div class="visible-xs" style="padding-top:20px;"></div>
    <div class="col-md-12 col-xs-12" style="padding:0px;border:1px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;word-wrap: break-word;">
  
    <iframe width="225" height="195" src="https://www.youtube.com/embed/<?php echo $video_str;?>?autoplay=0&showinfo=0&controls=0" frameborder="0" allowfullscreen></iframe>
    
    </div>
   <?php  }else{ ?>
          <div class="col-md-12 col-xs-12" style="padding:0px;border:1px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;"><img src="grab_image.php?img=default_no_image.jpg" style="min-height:1px;min-width:1px;max-height:250px;max-width:100%;border-radius:3px;"></div>

   <?php } ?>

    <h3 style="color:#5aa7de;font-size:18px;font-weight:Bold;"> <?php  echo $row['title'];?> </h3>
    <p style="font-family: \'Open Sans\', sans-serif;white-space: pre-line;word-wrap: break-word;" id="output"><?php echo $content;?></p>
     
    </div><div style="width:100%;background:#eef0f2;height:auto;padding:10px;">
    <a href="/<?php echo $row['id'].'/'.$slug_go;?>" class="btn btn-main btn-block" style="background:#5fb5f2;border:0px;color:#fff;">View Sweeb</a>
     </div></div>
    
    
    <?php }else{ //mobile ?>
     
    
    
    <div class="col-md-12 col-xs-12 box" style="padding:0px;margin-left:-1px;">
    <div class="col-xs-12" style="margin:0px;margin-bottom:5px;padding:20px;padding-right:30px;">
    <a href="/<?php echo $row['username'];?>" style="font-weight:bold;font-size:16px;color:#3e4851;" class="pull-left"><?php echo $row['username']; ?></a>
     <p style="font-weight:bold;font-size:14px;color:#3e4851;" class="pull-right"><?php echo time2str($datetime); ?></p><br>
     <div class="visible-xs" style="padding-top:10px;"></div>
    <?php if($image_str != NULL){ ?>
    <div class="visible-xs" style="padding-top:20px;"></div>
     <div class="col-md-12 col-xs-12" style="padding:0px;border:1px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;"><img src="grab_image.php?img=<?php echo $row['image'];?>" width="300" style="min-height:1px;min-width:1px;max-height:250px;max-width:100%;border-radius:3px;"></div>
    <?php }elseif($video_str != NULL){ ?>
     <div class="visible-xs" style="padding-top:20px;"></div>
     <div class="col-md-12 col-xs-12" style="padding:0px;border:1px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;word-wrap: break-word;">

     <iframe width="210" height="300" src="https://www.youtube.com/embed/<?php echo $video_str;?>?autoplay=0&showinfo=0&controls=0" frameborder="0" allowfullscreen></iframe>
 


  </div>
   <?php  } ?>
    
     <h3 style="color:#5aa7de;font-size:18px;font-weight:Bold;"><?php echo $row['title'];?></h3>
     <p style="padding:0px;color:#000;font-family: \'Open Sans\', sans-serif;word-wrap:normal;white-space: wrap;" id="output"><?php echo $content; ?></p>
     <span style="font-weight:bold;color:#8094a5;font-size:14px;padding-right:14px;word-wrap:normal;"><?php echo $row['up'];?> <img src="images/jOiTl3b.png"></span>
     <span style="font-weight:bold;color:#8094a5;font-size:14px;padding-right:14px;word-wrap:normal;"><?php echo $row['down'];?> <img src="images/h45ZLRD.png"></span>
    <span style="font-weight:bold;color:#8094a5;font-size:14px;"><?php echo $row['comments'];?> <img src="images/dg7mOfT.png"></span>
     <a href="/<?php echo $row['id'].'/'.$slug_go; ?>" class="btn btn-main pull-right">Check it out!</a>
     </div></div>
    
   <?php  }}
} else { ?>
    </div><div style="background:#fff;padding:20px;color:#3e4851;text-align:center;font-size:16px;width:100%;">There are currently no trending sweebs! Go ahead and start a new trending sweeb! <a href="sweeb.php">Create A Sweeb!</a>
     <br></div><div style="background:#eef0f2;padding:20px;color:#fff;text-align:center;font-size:16px;width:100%;"><a href="dash.php" class="btn btn-main btn-block" style="background:#5fb5f2;border:0px;color:#fff;">Return To The Dashboard!</a></div>
    
    </div>
    
    
<?php }
$conn->close();
?>
	

<Style>


#columns {
	-webkit-column-count: 4;
	-webkit-column-gap: 10px;
	-webkit-column-fill: auto;
	-moz-column-count: 4;
	-moz-column-gap: 10px;
	
	column-count: 4;
	column-gap: 15px;
	column-fill: auto;

}

.pin img{ 
    max-height: 250px!important;
    min-height: 249px!important;
} 
.pin {   
        width:248px;
        border-radius:3px;
	display: inline-block;
	background: #FEFEFE;
	border: 2px solid #FAFAFA;
	box-shadow: 0 1px 2px rgba(34, 25, 25, 0.4);
	margin: 0 2px 10px;
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