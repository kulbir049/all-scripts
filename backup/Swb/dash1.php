<?php include('main/config.php');
include('main/functions.php');
// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
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

<div class="col-xs-12 col-md-6">
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
<div class="col-md-12 col-xs-12 sweeb_b sweeb_g">

<p style="text-align:center;padding-top:20px;">
<a href="sweeb.php"><img src="dist/img/nsweeb.png" style="padding-bottom:5px;"></a><br>
<a href="sweeb.php" style="font-size:14px;font-weight:Bold;">New Sweeb</a>
</p>
</div></div></a>

<div class="col-md-4 col-xs-4" style="padding:0px;">
<div class="col-md-12 col-xs-12 sweeb_b sweeb_bl">
<p style="text-align:center;padding-top:20px;">
<a href="trending.php"><img src="dist/img/trending.png" style="padding-bottom:5px;"></a><br>
<a href="trending.php" style="font-size:14px;font-weight:Bold;">View Trending</a>
</p>
</div></div>

<div class="col-md-4 col-xs-4" style="padding:0px;">
<div class="col-md-12 col-xs-12 sweeb_b sweeb_r">
<p style="text-align:center;padding-top:20px;">
<a href="friends.php"><img src="dist/img/friends.png" style="padding-bottom:5px;"></a><br>
<a href="friends.php" style="font-size:14px;font-weight:Bold;">Find Friends</a>
</p>
</div>
</div>

<?php if(isMobile()){ ?>
<div class="col-xs-12" style="padding:0px;">
<div class="col-xs-12" style="background:#fff;padding:0px;margin-bottom:25px;">

<p style="font-size:24px;font-weight:Bold;color:#333;text-align:Center;padding:20px;">Balance <span style="color:#a2de5a;">$<?php echo $balance; ?></span></p>
<div class="col-xs-6" style="margin-bottom:20px;">
<a href="withdraw.php" class="btn btn-main btn-block">Withdraw</a>
</div>
<div class="col-xs-6">
<a href="faq.php" class="btn btn-main btn-block">Need Help?</a>
</div>
<br>
</div>
<?php } ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


<script src="javascript.js"> </script>

<div id="content">

</div>	



</div>
<div class="col-md-3 hidden-xs" style="padding:0px;">
<div class="col-md-12" style="background:#fff;padding:0px;margin-bottom:25px;">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
Sweeba Rewards
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

<div class="col-md-12 hidden-xs" style="padding:0px;">
<a href="check_in.php" class="btn btn-success btn-block" style="border:0px;background:#5fb5f2;margin-right:5px;margin-top:4px;font-size:14px;">Check in</a>
</div>

<?php include('main/ad_code.php'); ?>


<div class="col-md-12 hidden-xs" style="background:#fff;padding:0px;margin-top:25px;margin-bottom:25px;">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
Notifications
</div>
<style> 
.activity {
padding:20px;
color:#8e9093;
border-bottom:1px solid #ebeef1;
}

.activity:nth-child(odd) {
    background: #fff;
}

.activity:nth-child(even) {
    background: #f6f8fa;
}
</style>
<?php
$sql = "SELECT id, user_id, action, created_date FROM activity WHERE user_id='$user_id' ORDER BY id DESC limit 10";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<div class="activity">'.$row['action'].'</div>';
    }
} else {
    echo "0 results";
}
$conn->close();
?>

</div>

</div></div>


      <footer>
      <center>
<br>
 
<p>&copy; Sweeba.com 2023</p>
</center>
      </footer>
    </div> 
    <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>

$(document).ready(function() {

	$('#content').scrollPagination({

		nop     : 5, // The number of posts per scroll to be loaded
		offset  : 0, // Initial offset, begins at 0 in this case
		error   : 'You Made It To The Last Sweeb!', // When the user reaches the end this is the message that is
		                            // displayed. You can change this if you want.
		delay   : 500, // When you scroll down the posts will load after a delayed amount of time.
		               // This is mainly for usability concerns. You can alter this as you see fit
		scroll  : true // The main bit, if set to false posts will not load as the user scrolls. 
		               // but will still load if the user clicks.
		
	});
	
});

</script>
    
    
    <script src="/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/dist/js/ie10-viewport-bug-workaround.js"></script>

  </body>
</html>