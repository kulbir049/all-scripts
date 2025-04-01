<?php include('main/config.php');

// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();

include('main/header.php');
?>

<style>
body {

font-family: 'Open Sans', sans-serif;
}
p {
font-family: 'Open Sans', sans-serif;
}
.btn-main4 {
                border: 2px solid #5cb85c;
                width: 100%;
                color: #fff;
                background: #5cb85c;
                font-size: 14px;
                font-weight: Bold;
                border-radius: 3px;
              }

              .btn-main4:hover {
                border: 4px solid #fff;
                color: #fff;
                font-size: 14px;
                background: #5fb5f2;
                font-weight: Bold;
                border-radius: 3px;
              }
</style>

  
<div class="container" style="font-family: 'Open Sans', sans-serif;">
<div class="row">

<?php include("main/side_bar.php"); ?>

<div class="col-md-6">
<style>
.sweeb_b {
color:#000;
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

.c9 {background:#00adee;padding:15px;color:#fff;text-align:center;}
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

<div class="box" style="width:100%;padding:10px;margin-bottom:0px;margin-left:-1px;">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;margin-bottom:1px;width:100%;border:0px;">Getting Started on Sweeba
</div>

<div style="padding:20px; ">
<h3>Step <img src="images/step1.png" width="50" border="0"></h3>
<font size="3">
<center>
<a href="images/complete-profile.png"><img src="images/complete-profile.png" align="right" height="200" border="0" ></a>
</center>

The first step on Sweeba is to complete your profile and post a Sweeb. A Sweeb is much like a Tweet or Instagram post. 

<br><Br>
In order for your credits to be used you need to add atleast 1 Sweeb. You will receive 10 free credits upon creating your first Sweeb and 25 credits for completing your profile.<br>
<br>

<div class="col-md-6" style="margin-bottom:20px;">
<a href="sweeb.php" class="btn btn-main btn-block">Post Sweeb</a>
</div>
<div class="col-md-6">
<a href="reset.php" class="btn btn-main btn-block">Complete Profile</a>
</div>

</div>
<div style="padding:20px;">

<br>
<h3>Step <img src="images/step2.png" width="50" border="0"></h3>
<center>
<a href="images/surf-preview.png"><img src="images/surf-preview.png" width="290"  border="0" ></a>
</center>
<br>
Start surfing other members Sweebs on the "Surf" area of the website. Free members have a 2:1 surf ratio. This means that every 2 sweebs you view you earn 1 credit. Premium members have a 4:3 surf ratio so they earn 0.75 credits every Sweeb they view.
<br><bR>
The whole idea behind Sweeba is that you earn credits by browsing other members Sweebs/links. In return, your credits are used to show your Sweebs/links to other members.

<h3> What are the benefits of upgrading?</h3>
Upgraded members earn more credits while surfing, higher commissions from referrals, monthly credits, premium badges, more followers and much much more. Premium members also get access to beta features.

<h3>Step <img src="images/step3.png" width="50" border="0"></h3>
Earn money by referring members to Sweeba. You can find your referral tools below. Free members earn 25% and Premium members earn 40% on recurring upgrades and purchases.
<br><br>
<a href="refs.php" class="btn btn-main btn-block"><?php echo $username; ?>'s Referral tools</a>
<br>
<h3> What is the minimum payout threshold?</h3>
The minimum amount for payout is $5.

<br><Br>

<h3>Step <img src="images/step4.png" width="50" border="0"></h3>
Interact on Sweeba to gain more exposure within our system algorithm. Follow, Share, Like, Gift and Comment on other Sweeba members content. Remember... Have fun doing it!
</font>
<br><br>
<h3>Usefull Tip </h3>
You can spin our prize wheel each day for a chance to win credits, discounts and upgrades. 
<br><Br>
<a href="spin.php"><img src="dist/img/wheel-icon.png" style="height:64px;width:64px;margin-top:-4px;">Spin Now</a>
<br>


<br><br>
<h3>Navigation Tip </h3>
Click on your avatar "top right" to toggle a navigation menu.
<br><Br>
<b>Before</b>
<br>
<img src="images/menu-closed.png" >
<br><br>
<b>After</b>
<br>
<img src="images/menu-open.png" >


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
<div class="col-md-12 hidden-xs" style="padding:0px;margin-bottom:15px;">

            <a href="support.php" class="btn btn-main4" style="margin-right:5px;margin-top:4px;font-size:14px;">
              <b><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Support Ticket</b></a>

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