<?php
//print_r($coupon);
//die('aaaa');
//$tempData = $this->session->userdata();
//$tempData = $userdatas;
//dd($membership); die();
if($tempData['role_id']=="2")
{
$item_name	= "Standard Membership";

}
else
{
$item_name	= "Premium Membership";
}


if(!empty($coupon)){
    $paypal_price=$membership['price'];
  //  die($paypal_price."co");
}else{
    $paypal_price=$membership['price'];
    //die($paypal_price."no co");
}
//die;
?>
<div class="row" style="margin: 0 0 0 0;">
 <div class="container">
 	<!--start paypal here-->
 	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="paypal" id="paypal">
    <!-- Prepopulate the PayPal checkout page with customer details, -->
    <input type="hidden" name="cmd" value="_xclick" />
	<input type="hidden" name="first_name" value="<?php echo $tempData["user_name"]; ?>">
    <input type="hidden" name="last_name" value="<?php echo $tempData["user_lname"]; ?>">
    <input type="hidden" name="email" value="<?php echo $tempData["user_email"]; ?>">
    <input type="hidden" name="address1" value="<?php echo $tempData["location"]; ?>">
    <input type="hidden" name="city" value="<?php echo $tempData["city"]; ?>">
    <input type="hidden" name="zip" value="<?php echo $tempData["zipcode"]; ?>">
    <input type="hidden" name="business" value="<?php echo PAYPAL_ACCOUNT;?>" />
    <input type="hidden" name="cbt" value="Sheet Music International" />
	<input type="hidden" name="paymentaction" value="sale" />
    <input type="hidden" name="currency_code" value="USD" />

    <!-- Allow the customer to enter the desired quantity -->
    <input type="hidden" name="quantity" value="1" />
    <input type="hidden" name="item_name" value="Registration " />
    <input type="hidden" name="item_number" value="1" />
    

    <!-- Custom value you want to send and process back in the IPN -->
    <input type="hidden" name="amount" value="<?php echo $paypal_price;?>" />
    <input type="hidden" name="return" value="https://<?php echo $_SERVER['SERVER_NAME']?>/signup/payment_success"/>
    <input type="hidden" name="cancel_return" value="https://<?php echo $_SERVER['SERVER_NAME']?>/signup/payment_cancel" />

    <!-- <input type="hidden" class="btn btn-primary donate viewdss" id="dataRefreshButton" /> -->
   <button type="submit" class="btn btn-primary donate viewdss" id="dataRefreshButton" style="display: none">Donate</button>
    
</form>
<?php
//die;
?>
 	<!--end paypal here-->
    
    

 <center><img src="<?php echo base_url(); ?>assets/image/ajax-loader_black.gif" width="100" height="100"></center>
    </div>
    </div>
    <script type="text/javascript">
    setTimeout(function(){ document.getElementById('dataRefreshButton').click(); }, 1000); // 5 seconds
</script>