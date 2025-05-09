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
                                                             
                                                             

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $content = test_input($_POST["content"]);
 

  //check for login --
date_default_timezone_set('UTC');
  
  
$date = new DateTime();
$timestamp = $date->getTimestamp();


$date = date('Y-m-d H:i:s');
$timestamp1 = date('Y-m-d');
if ($content == NULL){
$Err = '<div class="alert alert-warning">You have to enter a location!</div>';
}else{
$sql = "INSERT INTO sweebs (id, user_id, username, date, title, image, content, status, up, down, views, tags, comments, video, timestamp)
VALUES (NULL, '$user_id', '$username', '$date', '', '', '$content', 'check_in', '0', '0', '0', '', '0', '', '$timestamp1')";
$conn->query($sql);
}
// end


}


// little sanitize funtion
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = str_replace('<', '', $data);
  return $data;
}
//end sanitization


?>