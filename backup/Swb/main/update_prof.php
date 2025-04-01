<?php
include_once('main/config.php');
include_once('main/functions.php');

if (isset($_POST["update_prof"])){

$description = test_input($_POST["description"]);
$city = test_input($_POST["city"]);
$age = test_input($_POST["age"]);
$tutorial = test_input($_POST["tutorial"]);
$gender = test_input($_POST["gender"]);
$relationship = test_input($_POST["relationship"]);
$occupation = test_input($_POST["occupation"]);

if($description == NULL){
$description = $profile_description;
} 

$sql = "UPDATE members SET prof_desc='$description', city='$city', age='$age', relationship='$relationship', occupation='$occupation', gender='$gender' WHERE username='$username' Limit 1";
mysqli_query($conn, $sql);

//after all is good destroy sessions and redirect
if($tutorial != 'yes'){
header("Location: reset.php");
die();
}else{
header("Location: dash.php");
die();
}

}
if (isset($_POST["update_social_meida_link"])){
$social_media_title = $_POST["social_media_title"];
$social_media_link = $_POST["social_media_link"];
$social_links=array();
foreach ($social_media_title as $key => $value) {
	$social_links[]=array($value,$social_media_link[$key]);
}
	$social_links_json=json_encode($social_links);
	$sql = "UPDATE members SET social_links_json='$social_links_json' WHERE username='$username' Limit 1";
     mysqli_query($conn, $sql);
header("Location: reset.php");
die();
}

if (isset($_POST["update_payment"])){
$pay_type = test_input($_POST["payment_type"]);
$pay_email = test_input($_POST["payment_address"]);

if($pay_type != NULL AND $pay_email != NULL){
$sql = "UPDATE members SET payment_type='$pay_type', payment_email='$pay_email' WHERE username='$username' Limit 1";
mysqli_query($conn, $sql);

header("Location: reset.php");
die();

}}
?>