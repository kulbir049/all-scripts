<?php
include_once('main/config.php');

//   _____  __          __  ______   ______   ____             
//  / ____| \ \        / / |  ____| |  ____| |  _ \      /\    
// | (___    \ \  /\  / /  | |__    | |__    | |_) |    /  \   
//  \___ \    \ \/  \/ /   |  __|   |  __|   |  _ <    / /\ \  
//  ____) |    \  /\  /    | |____  | |____  | |_) |  / ____ \ 
// |_____/      \/  \/     |______| |______| |____/  /_/    \_\
                                                             
                                                             

// define variables and set to empty values

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$sql = "SELECT * FROM sweebs WHERE id='$sweeb_dlt_id' AND user_id='$user_id' AND status='active'";
$result = $conn->query($sql);
$sweeb_count = $result->num_rows;
$result->close();


if($sweeb_dlt_id == NULL OR $user_id == NULL){
$Err = '<div class="alert alert-warning">An Error Occured, please try again later.</div>';
}elseif($sweeb_count == 0){
$Err = '<div class="alert alert-warning">An Error Occured, please try again later.</div>';
}else{
$Err = '<div class="alert alert-success">Your Sweeb Was Deleted!</div>';
$sql = "UPDATE sweebs set status='deleted' WHERE id='$sweeb_dlt_id' AND user_id='$user_id' Limit 1";
mysqli_query($conn, $sql);
$sql = "UPDATE members set sweebs=sweebs - 1 WHERE id='$user_id' Limit 1";
mysqli_query($conn, $sql);
$conn->close();

header("Location: sweebs.php");
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
?>