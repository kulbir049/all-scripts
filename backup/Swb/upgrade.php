<?php 
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include('main/config.php');
include('main/functions.php');
include('main/message.php');
// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();

//require_once('stripe-php/vendor/autoload.php');

$get_m_id = strip_tags($_GET["dlt"]);


/*// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
$stripe = new \Stripe\StripeClient(secret_key);
$stripeData=$stripe->checkout->sessions->create([
  'mode' => 'subscription',
  'success_url' => 'https://sweeba.com/paymentsuccess.php?session_id={CHECKOUT_SESSION_ID}',
  'cancel_url' =>  'https://sweeba.com/paymentcancel.php?session_id={CHECKOUT_SESSION_ID}',
  'line_items' => [
    [
      'price' => price_key,
      'quantity' => 1,
    ],
  ],
  'subscription_data' => [
    'trial_settings' => ['end_behavior' => ['missing_payment_method' => 'pause']],
    'trial_period_days' => 30,
  ],
  'client_reference_id' => $_SESSION['user_id']
]);*/
$date = date('Y-m-d');
$sql ="SELECT * FROM subscription where user_id='".$_SESSION['user_id']."' AND expire_date > '".$date."' AND status='Success'";
$result = $conn->query($sql);
?>
<?php
include('main/header-index.php');
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
body{ background-color: #d9e4ed;
}


.box {
    font-family: 'Open Sans', sans-serif;
    background: #d9e4ed;
    border: #d9e4ed;
 }  

font-family: 'Open Sans', sans-serif;
}
p {
font-family: 'Open Sans', sans-serif;
}
.BuyButton-ButtonTextContainer{background-color: #12aef8!important;}

.cloud {
	width: 320px; height: 215px;
	
	background: #f2f9fe;
	background: linear-gradient(top, #fff 5%, #d0deec 100%);
	background: -webkit-linear-gradient(top, #fff 5%, #d0deec 100%);
	background: -moz-linear-gradient(top, #fff 5%, #d0deec 100%);
	background: -ms-linear-gradient(top, #fff 5%, #d0deec 100%);
	background: -o-linear-gradient(top, #fff 5%, #d0deec 100%);
	
	border-radius: 100px;
	-webkit-border-radius: 100px;
	-moz-border-radius: 100px;
	
	position: relative;
	margin: 45px auto 20px;
}

.cloud:after, .cloud:before {
	content: '';
	position: absolute;
	background: #FFF;
	z-index: -1
}

.cloud:after {
	width: 100px; height: 100px;
	top: -30px; left: 50px;
	
	border-radius: 100px;
	-webkit-border-radius: 100px;
	-moz-border-radius: 100px;
}

.cloud:before {
	width: 180px; height: 180px;
	top: -50px; right: 50px;
	border-radius: 200px;
	-webkit-border-radius: 200px;
	-moz-border-radius: 200px;
}
</style>

  
<div class="container" style="font-family: 'Open Sans', sans-serif;">
<div class="row">

<div class="col-md-2 hidden-xs" style="padding:0px;">
</div>

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
background:#000;
padding:20px;
}

a:hover {
 text-decoration: none;
}
.btn-secondary {
    background-color: #fff;
    height: 30px;
    font-size: 14px;
    color:#fff;
    background: transparent;
    border-width: 2px;
    border-style: solid;
    border-color: #fff;
    border-image: initial;
    padding: 0.25em 2em;
}

.btn-secondary:hover {
      background-color:#5bc0de;
       color:#fff;
      transition: 2.7s;
  }

  .btn-success2 {
    color: #FFF;
    font-size: 17px;
    height: 45px;
    background-color: #000;

}


.btn-secondary2 {
    background-color: #5bc0de;
    height: 30px;
    font-size: 14px;
    color:#fff;
    border-width: 2px;
    border-style: solid;
    border-color: #fff;
    border-image: initial;
    padding: 0.25em 2em;
}

.btn-secondary2:hover {
      background-color:#fff;
       color:#5bc0de;
      transition: 2.7s;
  }




@import url("https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Source Sans Pro", sans-serif;
}
body {
  background-color: #d9e4ed;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
h1 {
  text-align: center;
  margin-top: 2rem;
}
p {
  text-align: center;
  margin-bottom: 4rem;
}
.pricing {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;

  .plan {
    background-color: #fff;
    padding: 2.5rem;
    margin: 12px;
    border-radius: 5px;
    text-align: center;
    transition: 0.3s;
    cursor: pointer;

    h2 {
      font-size: 22px;
      margin-bottom: 12px;
    }

    .price {
      margin-bottom: 1rem;
      font-size: 30px;
    }

     .price2 {
      margin-bottom: 1rem;
      font-size: 22px;
      decoration: strong;
    }

    ul.features {
      list-style-type: none;
      text-align: left;
      li {
        margin: 8px;
        
       
      }
    }

    button {
      border: none;
      width: 100%;
      padding: 12px 35px;
      margin-top: 1rem;
      background-color: #5fb5f2;
      color: #fff;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    
    }

    &.popular {
      border: 2px solid #6ab04c;
      position: relative;
      transform: scale(1.08);

      span2 {
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #6ab04c;
        color: #fff;
        padding: 4px 20px;
        font-size: 15px;
        border-radius: 5px;
      }
    }

    &:hover {
      box-shadow: 5px 7px 67px -28px rgba(0, 0, 0, 0.37);
    }
  }
}
</style>

<div class="col-md-12" style="margin-left: auto; margin-right: auto;">
   <div class="content">
      <div class="col-md-12 col-xs-12 box " style="padding:0px; text-align: center;">
       <?php if($result->num_rows > 0)
       {?>
      
           <div class="col-md-12 col-xs-12">
        
            <h1>You've Unlocked <font color="#5fb5f2"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></font> More</h1> 
        
             
      <font size="4">
 <center>
        <h3>Supporting Sweeba unlocks exclusive access, beta features and rewards...</h3>
        </center>        
        <br>
      <ul style="list-style-type: none" align="left"> 
<li><font color="#5fb5f2"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> Premium badge on profile.</li>
<li><font color="#5fb5f2"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> 500 exposure credits each month.</li>
<li><font color="#5fb5f2"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> </font> Earn 25% more exposure points.</li>
<li><font color="#5fb5f2"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> 20% discount on credit purchases.</li>
<li><font color="#5fb5f2"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> </font> 40% recurring commissions.</li>
<li><font color="#5fb5f2"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> See profiles that visited you.</li>
<li><font color="#5fb5f2"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> New members auto follow you.</li>                   
<li><font color="#5fb5f2"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> </font> Gift 3 rings a day. </li>
<li><font color="#5fb5f2"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> </font> See more of your matches.</li>
</font>   
</ul>         
<br>
</div>
<br>
     
<?php /*<br>  <?php */ ?>
<a href="dash.php" class="btn btn-secondary2"><strong>Continue to members area</strong></a>  
<Br><br>    

<?php  }else {?>
  
  
<center>


<h3> Get Double the credits </h3>

<p align="left"><h3> Upgrade and receive MORE exposure credits + <span class="glyphicon glyphicon-gift" aria-hidden="true"></span> bonus unassigned referrals </h3></p>
<div class="pricing">
      <div class="plan">
        <div class="price">$66/year</div>
        <ul class="features">
          <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> Unlimited Sweebs
          <Br>
          <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> Premium badge
          <Br>
          <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> <b>500 credits each month</b>
          <Br>
          <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> <b>+ 500 bonus credits</b>
          <Br>
          <font color="#6ab04c"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span></font> <b>25 unassigned referrals</b>
          <Br>
          <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> 4:3 surf ratio
         <Br> 
          <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> 40% recurring commissions.
         
          <Br>
          <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> 20% purchase discount
          <Br>
          <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> See profile visitors
          <Br>
          <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> See more matches
          <Br>
          <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> New members follow you
          <Br>
          <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> Gift 3 rings per day
       
        </ul>
<a href="https://buy.stripe.com/3cs6rHahg9vk8Wk9AA"  data-testid="hosted-buy-button-text"><button>Credit Card</button></a>
<br>    
<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=PET3GV7AYPYWN" data-testid="hosted-buy-button-text"><button>Paypal</button></a>
<br>
<a href="https://nowpayments.io/payment/?iid=5583530345" data-testid="hosted-buy-button-text"><button>Bitcoin</button></a>




      </div>
      

 <div class="plan popular">
        <span2>Most Popular</span2>
     <h2></h2>
        <div class="price2">30 Days Free</div>
        <ul class="features">
    
          <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> Unlimited Sweebs
          <Br>
          <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> Premium badge
           <Br>
          <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> <b>500 credits each month</b>
          <Br>
          <font color="#6ab04c"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span></font> <b>2 unassigned refs/mth.</b>
          <Br>
          <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> 4:3 surf ratio
          <Br>
          <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> 20% purchase discount
          <Br>
          <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> See profile visitors
          <Br>
          <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> See more matches
          <Br>
          <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> New members follow you
          <Br>
          <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> Gift 3 rings per day
        </ul>

<a href="https://buy.stripe.com/6oEbM10GGgXM5K89AB" data-testid="hosted-buy-button-text"><button>Start Trial</button></a>
<br>
<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LSTT9FR2QB4ML" data-testid="hosted-buy-button-text"><button>Paypal Trial</button></a>


      </div>
     
    </div>
<br>






<br><br>
<a href="dash.php" class="btn btn-secondary"><strong>Continue to members area</strong></a>
 
<Br><br> 
     


<?php  } ?>  







        
</div>
</div>
</div>
</div>
</div>
<div class="col-md-3" style="padding:0px;">
</div>
</div>

</div></div>
<?php
function getUserDetail($userId,$conn)
{
    $data = array();
    $sql = "SELECT * FROM  members WHERE id =".$userId."";
    $result = $conn->query($sql);
    $check = false;       
    if ($result->num_rows > 0) {
        
        $check = true;        
    }
    if($check == true)
    {
      while($row = $result->fetch_assoc()) {
       $data['name'] = $row['name'];
       $data['avatar'] =  $row['avatar'];
       $data['user_id'] = $row['id'];
       $data['username'] =  $row['username'];
      }
    }
  return $data;
}

?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
   
<script>
    function create_mssage_button(){
    jQuery("#collapseExample").show();
   
}
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7LHWPPZECB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7LHWPPZECB');
</script>

<script
    async
    src="https://js.stripe.com/v3/buy-button.js">
  </script>

</body>
</html>