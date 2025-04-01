<?php
include_once('main/config.php');
include_once('main/cost.php');

// define variables and set to empty values

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$total_earn = $balance + $withdraw;
$date = date('Y-m-d H:i:s');

$sql = "INSERT INTO payments (id, user_id, amount, status, date)
VALUES (NULL, '$user_id', '$balance', 'pending', '$date')";

$sqls = "UPDATE members SET withdraw='$total_earn', balance='0.00' WHERE id='$user_id' Limit 1";
$conn->query($sqls);

if ($conn->query($sql) === TRUE) {
 $Err = '<div class="alert alert-success">Your payment is awaiting approval!</div>';
} else {
 $Err = '<div class="alert alert-warning">An error has occured please try again.</div>';
}

$conn->close();


//boom done
header("Refresh:0");
exit;

// end throwing process lol
}


// little sanitize funtion
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
//end sanitization



?>