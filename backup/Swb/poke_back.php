<?php
include_once('main/config.php');
checkLogin();

//   _____  __          __  ______   ______   ____             
//  / ____| \ \        / / |  ____| |  ____| |  _ \      /\   
// | (___    \ \  /\  / /  | |__    | |__    | |_) |    /  \   
//  \___ \    \ \/  \/ /   |  __|   |  __|   |  _ <    / /\ \  
//  ____) |    \  /\  /    | |____  | |____  | |_) |  / ____ \ 
// |_____/      \/  \/     |______| |______| |____/  /_/    \_\
                                                             
                                                             

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $id = $_GET['poke_back'];

date_default_timezone_set('UTC');
  
 $date = new DateTime();
 $timestamp = $date->getTimestamp();
 $sql = "SELECT * FROM poke WHERE id='$id'";
 $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        //get members details 
        $row = $result->fetch_assoc();
        
        $sql_members = "SELECT * FROM members WHERE id='".$row['to_user_id']."' ";
        $result_members = $conn->query($sql_members);

        $detail_member =   $result_members->fetch_assoc();
        $username = $detail_member['username'];

        //update poke status
        $sql_update = "UPDATE poke SET status='Accept' WHERE id='$id'";
        mysqli_query($conn, $sql_update);

        //update relationship both user

        updateRelationship($conn,$row['from_user_id'],$row['to_user_id']);

        $date = date('Y-m-d H:i:s');
        //send notification
        $sqlz = "INSERT INTO activity (id, user_id, action, created_date) VALUES (NULL, '".$row['from_user_id']."', '<a href=\"https://www.sweeba.com/$username\"> $username </a> poked back to you! <a href=\"https://www.sweeba.com/$username\">View Profile </a>', '$date')";
            if ($conn->query($sqlz) === TRUE) {
            //header("Location: ../dash.php");
          $url = 'https://www.sweeba.com/dash.php';
           redirectPage($url); 

        }
           //update owner
            $sqlt = "UPDATE members SET notif=notif+1 WHERE id='".$row['from_user_id']."' Limit 1";
            mysqli_query($conn, $sqlt);
        
    }

  
}
function  updateRelationship($conn,$form_user,$to_user)
{
   //update from user relationship status
   $sql_update_from_user = "UPDATE members SET relationship ='relationship' WHERE id='$form_user'";
   mysqli_query($conn, $sql_update_from_user);

   //update to user relationship status
   $sql_update_to_user = "UPDATE members SET relationship ='relationship' WHERE id='$to_user'";
   mysqli_query($conn, $sql_update_to_user);
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