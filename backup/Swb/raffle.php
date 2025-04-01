<?php include('main/config.php');

// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();


$date1 = date("Y-m-d");

$result = $conn->query("SELECT COUNT(*) FROM `sweebs` WHERE timestamp='$date1' AND user_id = '$user_id' ");
$row = $result->fetch_row();
$total_sweeb_today = $row[0];
$result->close();
if($total_sweeb_today < 2){
$enter = 'no';
}else{
$enter = 'yes';




$sql = "SELECT * FROM raffle WHERE status='active'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
 $entries = $row['entries'];
 $prize = $row['winning'];
 $total = $row['total'];
  $entry_array = explode(",", $entries);
  }
} else {
    echo "0 results";
}



}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
if($entries == NULL){
$new_entries = $user_id;
}else{
$new_entries = ''.$entries.','.$user_id.'';
}
$sql = "UPDATE raffle SET entries='$new_entries', total=total+1 WHERE status='active' Limit 1";
mysqli_query($conn, $sql);
header("Location: raffle.php");
die();
}





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
background:#5cb85c;
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

hr {
  color: #5fb5f2;
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

<div class="col-md-12" style="margin-left:-1px;padding:0px;">

<div class="box" style="width:100%;padding:0px;margin-bottom:10px;margin-left:-1px;">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;margin-bottom:15px;width:100%;border:0px;">
Sweeba Monthly Winners ➡
</div>


<div style="padding:20px;">

<p style="text-align:center;"><img src="dist/img/tickets-for-the-show.png"></p>
<h3 style="text-align:center;">Win credits, upgrades and referrals</h3>

<h3>Step <img src="images/step1.png" width="50" border="0"></h3>
<font size="3">
<p>The first step on Sweeba is to complete your profile and post a Sweeb. In order to be entered into the monthly contest all you need to so is SURF. </p>
<center>
<a href="images/surf-preview.png"><img src="images/surf-preview.png" width="290"  padding="5px" border="0" ></a>
</center>
<Br>
<div class="col-md-6" style="margin-bottom:20px;">
<a href="random.php" class="btn btn-main btn-block">Surf Sweeba</a>
</div>
<div class="col-md-6">
<a href="leaderboard.php" class="btn btn-main btn-block">Leaderboard</a>
</div>

</div>
<div style="padding:20px;">

<br>
<h3>Step <img src="images/step2.png" width="50" border="0"></h3>
You can check your rankings on our leaderboard which is updated in real-time. See if you can crack the top 10. The contest each month ends midnight server time (UTC). 
<br><br>
<h3>Usefull Tip </h3>
You can spin our prize wheel each day for a chance to win credits, discounts and upgrades. 
<br><Br>
<a href="spin.php"><img src="dist/img/wheel-icon.png" style="height:64px;width:64px;margin-top:-4px;">Spin Now</a>
<br>
<?php if($enter == 'no'){ ?>

<?php }else{ 
echo '<p style="text-align:center;font-size:20px;">Prize: $'.$prize.' | Entries: '.$total.'</p>';
    if (!in_array($user_id, $entry_array))
    {
?>
<form method="post">
<p style="text-align:center;"><button type="submit" name="enter" class="btn btn-main">Enter Raffle!</button></p>
</form>
<?php }else{
echo '<p style="text-align:center;">Good Luck! You are now entered into the raffle.</p>';
}
} ?>
<hr>

</div></div>
</div>

</div>


<div class="col-md-3" style="padding:0px;">
<div class="col-md-12" style="background:#fff;padding:0px;margin-bottom:25px;">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
This Month's Winners
</div>

<center>
<h5>Coming April 30, 12:00 AM UTC</h5>
</center>
</div>


<div class="col-md-12" style="background:#fff;padding:0px;margin-bottom:25px;">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
Referral Leaders
</div>
<br>
<center>
<a href="leaders.php" class="btn btn-main" width="250">Monthly Referral Leaders</a>
</center>
<br>

</div>





<div class="col-md-12" style="background:#fff;padding:0px;margin-bottom:25px;">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
March 2025 Winners
</div>
<p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>333333</b><span class="pull-right"><font size="2">5 unassigned refs + 1000 Exposure credits + 30 days Featured member. </font></span></p>
<hr>
 <p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>Sharon613</b><span class="pull-right"><font size="2">4 unassigned refs + 750 Exposure credits + 30 days Featured member. </font></span></p>
<hr>
<p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>farzam0022</b><span class="pull-right"><font size="2">3 unassigned refs + 500 Exposure credits + 30 days Featured member. </font></span> </p>
<br>
<p style="padding:10px;font-size:20px;"><b>Winners 4-25</b>
<br>
<font size="2">
tk-gal@ukr.net, Javicos, joc23, balkanskim, salmanrajabi, turboxtraffic, ahanamhrao, esselte974, harsharao, jami217, meenasehar, earlyadopter, ivspb, sthiagom, mikeh2025thedude, jredishere, tiggitoggi, onlinemdshop3031, Rajabihassan, MIK007, mynam686, kish
</font>
</p>

</div>









<div class="col-md-12" style="background:#fff;padding:0px;margin-bottom:25px;">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
February 2025 Winners
</div>
<p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>farzam0022</b><span class="pull-right"><font size="2">5 unassigned refs + 1000 Exposure credits + 30 days Featured member. </font></span></p>
<hr>
 <p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>Rich4D</b><span class="pull-right"><font size="2">4 unassigned refs + 750 Exposure credits + 30 days Featured member. </font></span></p>
<hr>
<p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>333333</b><span class="pull-right"><font size="2">3 unassigned refs + 500 Exposure credits + 30 days Featured member. </font></span> </p>
<br>
<p style="padding:10px;font-size:20px;"><b>Winners 4-25</b>
<br>
<font size="2">sharon613, balkanskim, joc23, tk-gal@ukr.net, AirLiurik, turboxtraffic, Javicos, harsharao, ahanamhrao, Zakizia, jami217, ivspb, earlyadopter, DolphinmanCarl2025, Kasia242, esselte974, rogermoney2024, bruno399494903, MIsmail59, philex, meenasehar, tiggitoggi
</font>
</p>

</div>



<div class="col-md-12" style="background:#fff;padding:0px;margin-bottom:25px;">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
January 2025 Winners
</div>
<p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>333333</b><span class="pull-right"><font size="2">5 unassigned refs + 1000 Exposure credits + 30 days Featured member. </font></span></p>
<hr>
 <p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>farzam0022</b><span class="pull-right"><font size="2">4 unassigned refs + 750 Exposure credits + 30 days Featured member. </font></span></p>
<hr>
<p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>sharon613</b><span class="pull-right"><font size="2">3 unassigned refs + 500 Exposure credits + 30 days Featured member. </font></span> </p>
<br>
<p style="padding:10px;font-size:20px;"><b>Winners 4-25</b>
<br>
<font size="2">Rich4D, biernik12, balkanskim, AirLiurik, tk-gal@ukr.net, joc23, lamg, Javicos, DORE0XCR7, Zakizia, jami217, lucabre03, corneliu, Sumit68, rogermoney2024, earlyadopter, mermontero, sthiagom, ivspb, kish, DolphinmanCarl2025, ahanamhrao	

</font>
</p>

</div>









<div class="col-md-12" style="background:#fff;padding:0px;margin-bottom:25px;">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
December 2024 Winners
</div>
<p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>farzam0022</b><span class="pull-right"><font size="2">5 unassigned refs + 1000 Exposure credits + 30 days Featured member. </font></span></p>
<hr>
 <p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>sharon613</b><span class="pull-right"><font size="2">4 unassigned refs + 750 Exposure credits + 30 days Featured member. </font></span></p>
<hr>
<p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>Rich4D</b><span class="pull-right"><font size="2">3 unassigned refs + 500 Exposure credits + 30 days Featured member. </font></span> </p>
<br>
<p style="padding:10px;font-size:20px;"><b>Winners 4-25</b>
<br>
<font size="2">harsharao, ahanamhrao,tk-gal@ukr.net, ptcsheriff, joc23, Javicos, benjoo, earlyadopter, DORE0XCR7, rogermoney2024, jami217, giltotom, filipsimply, panos, balkanskim, Sumit68, mermontero, lamg, lucabre03, Linkon07, mynam686, didoko

</font>
</p>

</div>


<div class="col-md-12" style="background:#fff;padding:0px;margin-bottom:25px;">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
November 2024 Winners
</div>
<p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>qafhsa9</b><span class="pull-right"><font size="2">5 unassigned refs + 1000 Exposure credits + 30 days Featured member. </font></span></p>
<hr>
 <p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>sharon613</b><span class="pull-right"><font size="2">4 unassigned refs + 750 Exposure credits + 30 days Featured member. </font></span></p>
<hr>
<p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>benjoo</b><span class="pull-right"><font size="2">3 unassigned refs + 500 Exposure credits + 30 days Featured member. </font></span> </p>
<br>
<p style="padding:10px;font-size:20px;"><b>Winners 4-25</b>
<br>
<font size="2">
 Mharding74, guille12, harsharao, mermontero, tk-gal@ukr.net, joc23, esolution2025, Zakizia, dduncan, earlyadopter, Javicos, DORE0XCR7, ahanamhrao, filipsimply, mahimughal, lucabre03, rogermoney2024, esselte974, cmanfredini@free.fr, exitoso70, meenasehar
</font>
</p>

</div>




<div class="col-md-12" style="background:#fff;padding:0px;margin-bottom:25px;">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
October 2024 Winners
</div>
<p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>sharon613</b><span class="pull-right"><font size="2">5 unassigned refs + 1000 Exposure credits + 30 days Featured member. </font></span></p>
<hr>
 <p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>qafhsa9</b><span class="pull-right"><font size="2">4 unassigned refs + 750 Exposure credits + 30 days Featured member. </font></span></p>
<hr>
<p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>abedalnasser</b><span class="pull-right"><font size="2">3 unassigned refs + 500 Exposure credits + 30 days Featured member. </font></span> </p>
<br>
<p style="padding:10px;font-size:20px;"><b>Winners 4-25</b>
<br>
<font size="2">
Joc23, abedalnasser, earlyadopter, ahanamhrao, DORE0XCR7, meenasehar, tk-gal@ukr.net, ETYYYVXX900, esselte974, dduncan
bebras2016, nazor2, nasso77, kvbrd, mermontero, sthiagom, meanst585, marieelena52, bereadme, RajatExquisitehunk,Javed123, barrie
</font>
</p>

</div>



<div class="col-md-12" style="background:#fff;padding:0px;margin-bottom:25px;">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
September 2024 Winners
</div>
<p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>sharon613</b><span class="pull-right"><font size="2">5 unassigned refs + 350 Exposure credits + 30 days Featured member. </font></span></p>
<hr>
 <p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>abedalnasser</b><span class="pull-right"><font size="2">4 unassigned refs + 200 Exposure credits + 30 days Featured member. </font></span></p>
<hr>
<p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>nazor2</b><span class="pull-right"><font size="2">3 unassigned refs + 150 Exposure credits + 30 days Featured member. </font></span> </p>
<br>

</div>




<div class="col-md-12" style="background:#fff;padding:0px;margin-bottom:25px;">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
August 2024 Winners
</div>
<p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>abedalnasser</b><span class="pull-right"><font size="2">5 unassigned refs + 350 Exposure credits + 30 days Featured member. </font></span></p>
<hr>
 <p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>sharon613</b><span class="pull-right"><font size="2">4 unassigned refs + 200 Exposure credits + 30 days Featured member. </font></span></p>
<hr>
<p style="padding:10px;font-size:20px;border-bottom:1px dashed #ddd;"><b>qafhsa9</b><span class="pull-right"><font size="2">3 unassigned refs + 150 Exposure credits + 30 days Featured member. </font></span> </p>
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