<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Example in purchase.php
$webhookPayload = json_decode(file_get_contents('php://input'), true);

// Log the entire payload to a file
$time=strtotime('now');
file_put_contents('webhook/webhook_'.$time.'.log', json_encode($webhookPayload, JSON_PRETTY_PRINT) . PHP_EOL, FILE_APPEND);

// Now, you can use $webhookPayload to extract specific information
// For example, accessing the payment_intent or checkout_session ID:
$paymentIntentId = $webhookPayload['data']['object']['payment_intent'];
$checkoutSessionId = $webhookPayload['data']['object']['id'];

// ... rest of your webhook handling code ...


?>