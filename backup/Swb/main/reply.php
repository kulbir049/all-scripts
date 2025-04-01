<?php
include_once('main/config.php');
include_once('main/cost.php');

// define variables and set to empty values
$comment ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$comment = test_input($_POST["message"]);
$comment_str = strlen($comment);
$date = date('Y-m-d H:i:s');


if($comment_str < '0'){
$Err = '<div class="alert alert-warning">Your content needs to be atleast 10 characters.</div>';
}elseif($logged_in == 'no'){
$Err = '<div class="alert alert-warning">Please log in or signup to comment.</div>';
}elseif ($comment == NULL){
$Err = '<div class="alert alert-warning">You have to write a comment!</div>';
}else{
// throw it into the db
//create session
$sql = "SELECT id, user_id, rec, action, viewed, date, message FROM messages WHERE id='$get_m_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
    $sender = $row['user_id'];
    $rec = $row['rec'];
    
    if($username != $sender){
    $sqls = "UPDATE members SET msg='yes' WHERE username='$sender'";
    $conn->query($sqls);
    }else{
    $sqls = "UPDATE members SET msg='yes' WHERE username='$rec'";
    $conn->query($sqls);
    }
 }}
 
    
    
$sql = "INSERT INTO replys (id, mes_id, username, message, date)
VALUES (NULL, '$get_m_id', '$username', '$comment', '$date')";

if ($conn->query($sql) === TRUE) {
 $Err = '<div class="alert alert-warning">Your message has been sent!</div>';
} else {
 $Err = '<div class="alert alert-warning">An error has occured please try again.</div>';
}

$conn->close();


//boom done
header("Refresh:0");
exit;

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