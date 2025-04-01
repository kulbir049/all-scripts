<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $password_new = test_input($_POST["password"]);
  $password_re = test_input($_POST["password_re"]);

  $password = test_input($_POST["password_cur"]);

  if($password_new == NULL || $password_re == NULL || $password == NULL){
  $Err = 'Please fill out all the fields.';
  }elseif($password_new != $password_re){
  $Err = 'Oh no your passwords do not match. Please re enter them and try again.';
   } elseif (!password_verify($password, $hash)) {
  $Err = 'Your current password does not match.';
  }else{
$Err = 'Great Job Your password has been updated!';

// hash the password
$options = [
    'cost' => 12,
];
$password = password_hash("$password_new", PASSWORD_BCRYPT, $options)."\n";


//update the password!
$sql = "UPDATE members SET password='$password' WHERE id='$user_id'";
mysqli_query($conn, $sql);
//end password

//after all is good destroy sessions and redirect
session_destroy(); 
header("Location: login.php");
die();

}}



// little sanitize funtion
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
//end sanitization