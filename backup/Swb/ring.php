<?php
include_once('main/config.php');


//   _____  __          __  ______   ______   ____             
//  / ____| \ \        / / |  ____| |  ____| |  _ \      /\    
// | (___    \ \  /\  / /  | |__    | |__    | |_) |    /  \   
//  \___ \    \ \/  \/ /   |  __|   |  __|   |  _ <    / /\ \  
//  ____) |    \  /\  /    | |____  | |____  | |_) |  / ____ \ 
// |_____/      \/  \/     |______| |______| |____/  /_/    \_\
                                                             
                                                             

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //check for login --
date_default_timezone_set('UTC');
  
  $to_user_id = $_POST['ring_user'];
  $type = $_POST['type'];
  $date = new DateTime();
  $timestamp = $date->getTimestamp();
  $user_id = $_SESSION['user_id'];
  $get_send_user_profile = getUserDetail($to_user_id,$conn);
   $username = $username;

$date = date('Y-m-d H:i:s');
$sql = " INSERT INTO rings (id,from_user_id,to_user_id,type,status,created) VALUES (NULL,'$user_id','$to_user_id','$type','Send','$date') ";
$conn->query($sql);
$last_id = $conn->insert_id;

$sqlz = "INSERT INTO activity (id, user_id, action, created_date)
VALUES (NULL, '$to_user_id', '<a href=\"https://www.sweeba.com/$username\"> $username </a> has sent you a ring! <a href=\"https://www.sweeba.com/ring_history.php\">View Ring History</a>', '$date')";
if ($conn->query($sqlz) === TRUE) {
   $sqlt = "UPDATE members SET notif=notif+1 WHERE id='$to_user_id' Limit 1";
   mysqli_query($conn, $sqlt);
   $username = $get_send_user_profile['username'];
   $url = 'https://www.sweeba.com/'.$username;
   header("Location: $url");
}



}
function getUserDetail($userId,$conn)
{
    $data = array();
    $sql = "SELECT * FROM  members WHERE id =".$userId."";
    $result = $conn->query($sql);
    $check = false;       
    if ($result->num_rows > 0) {
        
        $check = true;        
    }
    if($check == true)
    {
      while($row = $result->fetch_assoc()) {
       $data['name'] = $row['name'];
       $data['avatar'] =  $row['avatar'];
       $data['user_id'] = $row['id'];
       $data['username'] =  $row['username'];
	     $data['country']  =  $row['location'];
      }
    }
    return $data;
}     




?>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7LHWPPZECB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7LHWPPZECB');
</script>