<?php
include_once('main/config.php');
include("geoipcity.inc");
include("geoipregionvars.php");


//   _____  __          __  ______   ______   ____             
//  / ____| \ \        / / |  ____| |  ____| |  _ \      /\    
// | (___    \ \  /\  / /  | |__    | |__    | |_) |    /  \   
//  \___ \    \ \/  \/ /   |  __|   |  __|   |  _ <    / /\ \  
//  ____) |    \  /\  /    | |____  | |____  | |_) |  / ____ \ 
// |_____/      \/  \/     |______| |______| |____/  /_/    \_\
                                                             
                                                             

// define variables and set to empty values
$username = $password ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $username = test_input($_POST["username"]);
  $password = test_input($_POST["password"]);
  $auto_surfing = test_input($_POST["auto_surfing"]);
  


//grab hashed password
$sql = "SELECT id, password, tutorial, verified, status FROM members WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
$verified = $row['verified'];
$user_id = $row['id'];
$status = $row['status'];
$tutorial = $row['tutorial'];
$hash = $row['password'];
$hash = substr( $hash, 0, 60 );
}}
// end grab



// get location
$ip = $_SERVER['REMOTE_ADDR']; 
$gi = geoip_open("GeoLiteCity.dat",GEOIP_STANDARD);
$record= geoip_record_by_addr($gi,$ip);
$country_code = geoip_country_code_by_addr($gi, $ip );
//end location



// verify info is inputed

  if (empty($_POST["username"])) {
  $Err = "Hey, you forgot to enter your name.";
  }elseif (empty($_POST["password"])) {
  $Err = "Please enter your email.";
  }elseif($status == 'ban'){
  $Err = 'Your Account Has Been Banned. Please contact info@sweeba.com.';
  }elseif (!password_verify($password, $hash)) {
  $Err = 'Invalid password or username.';
  }elseif($verified != 'yes'){
  $Err = 'Please verify your account. <a href="verify.php">Verify My Account &raquo;</a>';
  }else{
  
// end input
  
  
  
  
// create and update 

$token_code = substr(str_shuffle(md5(time())),0,10);
$sql = "UPDATE members SET last_login=NULL, online='yes', token='$token_code' WHERE username='$username'";
mysqli_query($conn, $sql);
$conn->close();
// end creating and updating

$_SESSION["token"] = $token_code;
$_SESSION["user_id"] = $user_id;

$token_hash = hash('sha1', $token_code);
$cookie_info = ''.$token_hash.':'.$user_id.'';
setcookie("remember", $cookie_info);

// end login

//redirect if all is good
if($tutorial == 'yes'){
 if($auto_surfing=='yes'){
  header("Location: random.php");

 }else{
  header("Location: upgrade.php");

 } 
die();
}else{
header("Location: tutorial.php");
die();
}

}//end check
}//end post




// little sanitize funtion
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
//end sanitization
?>