<?php 

include('main/config.php');
include('main/functions.php');
include('main/message.php');
// if($logged_in == 'no'){
// header("Location: index.php");
// die();
// }

require_once('stripe-php/vendor/autoload.php');
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
$stripe = new \Stripe\StripeClient(secret_key);
//$stripe = new \Stripe\StripeClient('sk_test_51HyZs0Ew7uti2KFsKglF1sKgfqPMJ79WOFA3FX5Opxzs0SJgec03rDEZULOHxBkjGkGq3DYaDTT0ejW1Iu0ovODq00sYBNZQSr');
if(!empty($_GET['session_id'])){
      $session = $stripe->checkout->sessions->retrieve($_GET['session_id']);
      // Fetch transaction data from the database if already exists 
    $sqlQ = "SELECT * FROM subscription WHERE stripe_checkout_session_id ='".$_GET['session_id']."'"; 
    $result = $conn->query($sqlQ);
    if($result->num_rows > 0){ 
            // Transaction details 
            $transData = $result->fetch_assoc(); 
            $payment_id = $transData['id']; 
            $transactionID = $transData['transaction_id']; 
            $paidAmount = $transData['amount']; 
            $payment_status = $transData['status'];         
            $status = 'Failed'; 
            $statusMsg = 'Your Payment has been Failed!'; 
            $paidCurrency = 'INR'; 
    }
    else
    {
         //print_r($session->client_reference_id);
        $purchase_date = date("Y-m-d");
        $days = 30;
        $expire_date = date('Y-m-d', strtotime($purchase_date. ' + 30 days')); 
        $amount = 7.99;
        $stripe_checkout_session_id = $_GET['session_id'];
        $status = "Failed";
        $created_at =  date("Y-m-d H:i:s");
        $user_id = $session->client_reference_id;
        $session_id = $_GET['session_id'];
          // Fetch the Checkout Session to display the JSON result on the success page 
          try { 
            $checkout_session = $stripe->checkout->sessions->retrieve($session_id); 
        } catch(Exception $e) {  
            $api_error = $e->getMessage();  
        }
        if(empty($api_error) && $checkout_session){ 
          // Get customer details 

          // // Retrieve the details of a PaymentIntent 
          // try { 
          //     $paymentIntent = $stripe->paymentIntents->retrieve($checkout_session->payment_intent); 
          // } catch (\Stripe\Exception\ApiErrorException $e) { 
          //     $api_error = $e->getMessage(); 
          // } 
           
          if(empty($api_error)){ 
              // Check whether the payment was successful 
              if($checkout_session->payment_status == 'unpaid'){ 
                  // Transaction details  
                  $transactionID = $checkout_session->subscription; 
                  $paidAmount = 7.99; 
                  $paidCurrency = 'INR'; 
                  $payment_status = 'Failed'; 
                   
                  // // Customer info 
                  // $customer_name = $customer_email = ''; 
                  // if(!empty($customer_details)){ 
                  //     $customer_name = !empty($customer_details->name)?$customer_details->name:''; 
                  //     $customer_email = !empty($customer_details->email)?$customer_details->email:''; 
                  // } 
                   
                  // Check if any transaction data is exists already with the same TXN ID 
                  $sqlQ = "SELECT id FROM subscription WHERE transaction_id = '".$transactionID."'"; 
                  $result = $conn->query($sqlQ);
                  $prevRow = $result->fetch_assoc(); 
                   
                  if(!empty($prevRow)){ 
                      $payment_id = $prevRow['id']; 
                  }else{ 
                      // Insert transaction data into the database 
                      $insert = "INSERT INTO subscription (`user_id`,`purchase_date`,`expire_date`,`transaction_id`,`days`,`status`,`created_at`,`amount`,`stripe_checkout_session_id`)
                      VALUES ('$user_id', '$purchase_date', '$expire_date', '$transactionID', '$days', '$status', '$created_at','$amount','$stripe_checkout_session_id')";
                      $resultInsert= $conn->query($insert); 
                       
                      if($resultInsert){ 
                          $payment_id = $conn->insert_id; 
                      } 
                  }                 
                  $status = 'Failed'; 
                  $statusMsg = 'Transaction has been failed !'; 
              }else{ 
                  $statusMsg = "Transaction has been failed!"; 
              } 
          }else{ 
              $statusMsg = "Unable to fetch the transaction details! $api_error";  
          } 
      }else{ 
          $statusMsg = "Invalid Transaction! $api_error";  
      } 
        
        
    }
}
else{
  $statusMsg = "Invalid Request!"; 
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

<div class="col-md-12" style="margin-left: auto; margin-right: auto;">
   <div class="content">
      <div class="col-md-12 col-xs-12 box " style="padding:0px; text-align: center;">
       
      <?php if(!empty($payment_id)){ ?>
        <h1 class="<?php echo $status; ?>" style="color:red;"><?php echo $statusMsg; ?></h1>  
        <h4>Payment Information</h4>
        <p><b>Reference Number:</b> <?php echo $payment_id; ?></p>
        <p><b>UnPaid Amount:</b> <?php echo $paidAmount.' '.$paidCurrency; ?></p>
        <p><b>Payment Status:</b> <?php echo $payment_status; ?></p>
      
        <!-- <h4>Customer Information</h4>
        <p><b>Name:</b> <?php echo $customer_name; ?></p>
        <p><b>Email:</b> <?php echo $customer_email; ?></p> -->
    <?php }else{ ?>
        <h1 class="error">Your Payment have been failed!</h1>
        <p class="error"><?php echo $statusMsg; ?></p>
<?php } ?>
            
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

  </body>
</html>