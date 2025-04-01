<?php
include_once('main/config.php');


//   _____  __          __  ______   ______   ____             
//  / ____| \ \        / / |  ____| |  ____| |  _ \      /\    
// | (___    \ \  /\  / /  | |__    | |__    | |_) |    /  \   
//  \___ \    \ \/  \/ /   |  __|   |  __|   |  _ <    / /\ \  
//  ____) |    \  /\  /    | |____  | |____  | |_) |  / ____ \ 
// |_____/      \/  \/     |______| |______| |____/  /_/    \_\
      

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    date_default_timezone_set('UTC');
  
    $user_id = $_POST['user_id'];
    $value = $_POST['value'];
    $date = date('Y-m-d H:i:s');
    $expired_at =  date('Y-m-d', strtotime($date. ' + 7 days'));
    $sql = "INSERT INTO spins (user_id,value,expired_at,created_at) VALUES ('$user_id', '$value','$expired_at','$date')";
    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    if($value == 3)
    {
        $days = 7;
        $expire_date = date('Y-m-d', strtotime($date. ' + 7 days')); 
        $sql_update = "UPDATE members SET is_featured_member='1', is_expiary_date='".$expire_date."' WHERE id='".$user_id."'";
        if ($conn->query($sql_update) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }


        $sqlz = "INSERT INTO activity (id, user_id, action, created_date)
        VALUES (NULL, '$user_id', 'Featured member activated on your account', '$date')";


        if ($conn->query($sqlz) === TRUE) {
              //update owner
            $sqlt = "UPDATE members SET notif=notif+1 WHERE id='$user_id' Limit 1";
            mysqli_query($conn, $sqlt);
        }
    }
    if($value == 2)
    {
        // Process the selected user ID here
       $purchase_date = date("Y-m-d");
       $amount = 7.99;

       $status ="Success";
       $paid_type ="Offline";
       $transactionID = 'spinnerAndWinner';
       $created_at = date('Y-m-d H:i:s');
       $days = 7;
       $expire_date = date('Y-m-d', strtotime($purchase_date. ' + 7 days')); 
       $insert = "INSERT INTO subscription (`user_id`,`purchase_date`,`expire_date`,`transaction_id`,`days`,`status`,`created_at`,`amount`,`payment_type`)
       VALUES ('$user_id', '$purchase_date', '$expire_date', '$transactionID', '$days', '$status', '$created_at','$amount','Offline')";
       $resultInsert= $conn->query($insert); 


        $sqlz = "INSERT INTO activity (id, user_id, action, created_date)
        VALUES (NULL, '$user_id', 'Free 7 days membership activated on your account', '$created_at')";
        if ($conn->query($sqlz) === TRUE) {
              //update owner
            $sqlt = "UPDATE members SET notif=notif+1 WHERE id='$user_id' Limit 1";
            mysqli_query($conn, $sqlt);
        }


    }
    if($value == 6)
    {
        $post_by_user = $user_id;

        $sweeba_id=0;
        $exposure_earn=10;
        $created_at=date('Y-m-d H:i:s');
         $insert_logs = "INSERT INTO exposure (user_id, post_by_user, sweeba_id, exposure_earn, created_at,credit_use) VALUES ('$user_id_sess', '$post_by_user', '$sweeba_id', '$exposure_earn','$created_at',0)";
         $conn->query($insert_logs);

    }

    $conn->close();
}
?>