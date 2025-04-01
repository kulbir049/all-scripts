<?php
include_once('main/config.php');
include_once('main/cost.php');



//   _____  __          __  ______   ______   ____             
//  / ____| \ \        / / |  ____| |  ____| |  _ \      /\    
// | (___    \ \  /\  / /  | |__    | |__    | |_) |    /  \   
//  \___ \    \ \/  \/ /   |  __|   |  __|   |  _ <    / /\ \  
//  ____) |    \  /\  /    | |____  | |____  | |_) |  / ____ \ 
// |_____/      \/  \/     |______| |______| |____/  /_/    \_\
                                                             
                                                             

// define variables and set to empty values
$comment ="";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comment"])) {

if(isset($_SESSION['comment_time'])) {
if($_SESSION['comment_time'] < time()) {
session_unset(); 
}}

$comment = test_input($_POST["comment"]);
$sweeb_id_pot = test_input($_POST["id_comment"]);

$comment_str = strlen($comment);
$date = date('Y-m-d H:i:s');

if($_SESSION['comment_time'] == time()) {
$Err = '<div class="alert alert-warning">Please wait 1 minute before posting another comment.</div>';
}elseif ($comment == NULL){
$Err = '<div class="alert alert-warning">You have to write a comment!</div>';
}elseif($comment_str < '25'){
$Err = '<div class="alert alert-warning">Your content needs to be atleast 25 characters.</div>';
}elseif($logged_in == 'no'){
$Err = '<div class="alert alert-warning">Please log in or signup to comment.</div>';
}else{
// throw it into the db
//create session
$_SESSION['comment_time'] = time() + 60;


$sql = "INSERT INTO comments (id, user_id, username, sweeb_id, date, comment)
VALUES (NULL, '$user_id', '$username', '$sweeb_id_pot', '$date', '$comment')";
if ($conn->query($sql) === TRUE) {
$Err = '<div class="alert alert-success">Great Job! Your comment has been posted!</div>';
}


if($user_id != $user_id_sweeb){
//update poster
$sql = "UPDATE members SET comments=comments+1, balance=balance+$earning_comment WHERE username='$username' Limit 1";
mysqli_query($conn, $sql);

//update owner
$sql = "UPDATE members SET balance=balance+$earning_own_comment, notif=notif+1 WHERE id='$user_id_sweeb' Limit 1";
mysqli_query($conn, $sql);

}//own user

$sql = "UPDATE sweebs SET comments=comments+1 WHERE id='$sweeb_id_pot' Limit 1";
mysqli_query($conn, $sql);


$sqlz = "INSERT INTO activity (id, user_id, action, created_date)
VALUES (NULL, '$user_id_sweeb', '$username posted a comment on your sweeb! <a href=\"https://www.sweeba.com/$get_sweeb_id/$sweeb_title\">View Comment</a>', '$date')";
if ($conn->query($sqlz) === TRUE) {
}

//boom done
header("Location: https://www.sweeba.com/$sweeb_id_pot/comment");
die;

// end throwing process lol
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