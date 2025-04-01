<?php include('main/config.php');
include('main/functions.php');
include('main/withdraw.php');
// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();
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
</style>

<div class="col-md-4 col-xs-4" style="padding:0px;">
<a href="sweeb.php" style="display:block;">
<div class="col-md-12 sweeb_b sweeb_g">

<p style="text-align:center;padding-top:20px;">
<a href="sweeb.php"><img src="dist/img/nsweeb.png" style="padding-bottom:5px;"></a><br>
<a href="sweeb.php" style="font-size:14px;font-weight:Bold;">Sweeb</a>
</p>
</div></div></a>

<div class="col-md-4 col-xs-4" style="padding:0px;">
<div class="col-md-12 sweeb_b sweeb_bl">
<p style="text-align:center;padding-top:20px;">
<a href="trending.php"><img src="dist/img/trending.png" style="padding-bottom:5px;"></a><br>
<a href="trending.php" style="font-size:14px;font-weight:Bold;">Explore</a>
</p>
</div></div>

<div class="col-md-4 col-xs-4" style="padding:0px;">
<div class="col-md-12 sweeb_b sweeb_r">
<p style="text-align:center;padding-top:20px;">
<a href="friends.php"><img src="dist/img/friends.png" style="padding-bottom:5px;"></a><br>
<a href="friends.php" style="font-size:14px;font-weight:Bold;">Connect</a>
</p>
</div>
</div>

<div class="col-md-12" style="margin-left:-1px;padding:0px;">



<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { echo $Err; } ?>
<div class="box" style="width:100%;padding:0px;margin-bottom:10px;margin-left:-1px;">

  <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;margin-bottom:15px;width:100%;border:0px;">
Withdraw Your Earnings!
</div>
<div style="padding:20px;">
<?php 
if($payment_type == NULL){
echo '<p style="text-align:center;color:#8a9cac;">You need to update your payment information to request a payment. You can do this from the "Update Account" page.</p>';
}else{

$earn_amount = $threshold - $balance;
if($balance >= $threshold){ ?>

<form method="post">

<button type="submit" class="btn btn-block btn-main" style="background:#5fb5f2;border:0px;color:#fff;">Request Your Payment!</button>
</form>
<?php }else{ ?>

<p style="text-align:center;color:#8a9cac;">You still need to earn $<?php echo $earn_amount; ?> in order to request a payment.</p>
<?php } 

} ?>



</div></div>


<?php
$sql = "SELECT id, user_id, amount, date, status FROM payments WHERE user_id = '$user_id' ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
 
$datetime = $row['date'];
    echo '<div class="col-md-12 box" style="padding:20px;margin-left:-1px;height:100px;margin-bottom:10px;">';

   
    echo '<p style="font-weight:bold;font-size:16px;color:#3e4851;" class="pull-left">'.$username.'</p>';
    echo '<p style="font-weight:bold;font-size:14px;color:#3e4851;" class="pull-right">'.time2str($datetime).'</p><br><br>';
    echo '<p style="text-align:center;color:#8a9cac;">Your payment of $'.$row['amount'].' is currently <b>'.$row['status'].'</b></p>';
    echo '</div>';
    }
} 
$conn->close();

?>




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