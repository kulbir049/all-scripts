<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);


include('main/config.php');
include('ajax_custom.php');

$user_id = 14508;

$query_1 = "SELECT * 
      FROM members 
      WHERE id=" . $user_id;
    $result_1 = $conn->query($query_1);
    $userInfo_1 = $result_1->fetch_assoc();
    $user_followers = array_filter(explode(',', $userInfo_1['follows']));

    
    $not_in = $user_followers;
    $not_in[] = 14508;
    
    // Create a comma-separated string from the $not_in array
    $not_in_str = implode(",", $not_in);


    $q = "SELECT * 
    FROM members 
    WHERE id != " . $user_id . " AND id NOT IN ($not_in_str)";
    
    // You can now run your query with the $query variable

    

$r = $conn->query($q);

// Use mysqli_num_rows directly on the $result object
echo $r->num_rows;




    
    // Create the query with the NOT IN condition
    $query = "SELECT * 
    FROM members 
    WHERE id != " . $user_id . " AND id NOT IN ($not_in_str) 
    LIMIT 100";
    
    // You can now run your query with the $query variable

    

$result = $conn->query($query);

// Use mysqli_num_rows directly on the $result object
//echo $result->num_rows;
while ($userInfo = $result->fetch_assoc()) {
    
    $other_user_friends = array_filter(explode(',', $userInfo['friends']));
    $other_user_followers = array_filter(explode(',', $userInfo['follows']));
    if (!in_array(14508, $other_user_friends)) {
        $other_user_friends[] = 14508;
    }
    if (!in_array(14508, $other_user_followers)) {
        $other_user_followers[] = 14508;
    }
    $other_user_friends = implode(',', array_unique($other_user_friends));
    $other_user_followers = implode(',', array_unique($other_user_followers));
    //   $sql_1 = "UPDATE members SET friends='$other_user_friends',follows='$other_user_followers' WHERE id=".$userInfo['id'];
    //   $conn->query($sql_1);
    $query_1 = "SELECT * 
      FROM members 
      WHERE id=" . $user_id;
    $result_1 = $conn->query($query_1);
    $userInfo_1 = $result_1->fetch_assoc();

    $other_user_friends_1 = array_filter(explode(',', $userInfo_1['friends']));
    $other_user_followers_1 = array_filter(explode(',', $userInfo_1['follows']));
    $other_user_friends_1[] = $userInfo['id'];
    $other_user_followers_1[] = $userInfo['id'];
    if (!in_array($userInfo['id'], $other_user_friends_1)) {
        $other_user_friends_1[] = $userInfo['id'];
    }
    if (!in_array($userInfo['id'], $other_user_followers_1)) {
        $other_user_followers_1[] = $userInfo['id'];
    }
    $other_user_friends_1 = implode(',', array_unique($other_user_friends_1));
    $other_user_followers_1 = implode(',', array_unique($other_user_followers_1));

    $sql_1 = "UPDATE members SET friends='$other_user_friends_1',follows='$other_user_followers_1' WHERE id=14508";
    $conn->query($sql_1);




    // dd($other_user_friends,$other_user_followers,$other_user_friends_1,$other_user_followers_1);
}


// $sql = "UPDATE members SET friends='$friends_new' WHERE id='$user_id'";
//       $conn->query($sql);


// $created_at=date('Y-m-d H:i:s', strtotime($row['date']));


// $sql_login_history = "SELECT * FROM login_history WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)";
// $result_sql_login_history = $conn->query($sql_login_history);
// while($exposure_history_row = $result_sql_login_history->fetch_assoc()) {

//     $exposure_history = "SELECT * FROM `members` WHERE id=".$exposure_history_row['user_id']."";
// $result_view_sql = $conn->query($exposure_history);
// $userInfo = $result_view_sql->fetch_assoc();
// //dd($userInfo);

//     echo $userInfo['availbale_exposure_earn'];
//     echo "====".$userInfo['id'];
//     echo "<br/>";
//    // die;

// }

// die;
/*$exposure_history = "SELECT * FROM `members` WHERE `availbale_exposure_earn` < 0 ";
$result_view_sql = $conn->query($exposure_history);

if($result_view_sql->num_rows>3){
    while($exposure_history_row = $result_view_sql->fetch_assoc()) {
        echo $exposure_history_row['availbale_exposure_earn'];
        $availbale_exposure_earn=($exposure_history_row['availbale_exposure_earn'] * -1);
        echo "====".$availbale_exposure_earn;
        echo "====".$availbale_exposure_earn+1;
        echo "<br/>";
       // die;

        $user_id=$exposure_history_row['id'];
        $post_by_user=$exposure_history_row['id'];
        $sweeba_id=0;
        $is_free=1;
        $free_desc="fixed_nagetive_balance";
        $credit_use=0;
        $exposure_earn=$availbale_exposure_earn+10;
        $created_at=date('Y-m-d H:i:s',strtotime('2024-09-01'));
         $insert_logs = "INSERT INTO exposure (user_id, post_by_user, sweeba_id, exposure_earn, created_at,is_free,credit_use,free_desc) 
         VALUES ('$user_id', '$post_by_user', '$sweeba_id', '$exposure_earn','$created_at','$is_free','$credit_use','$free_desc')";
        // $conn->query($insert_logs);
     }
    }

die;

$created_month='2024-09';
//$exposure_history = "SELECT * FROM `exposure` GROUP BY`user_id` limit 100";
$exposure_history = "
    SELECT e.* 
    FROM exposure e
    INNER JOIN members m ON m.id = e.user_id
    WHERE m.availbale_exposure_earn < 0
    GROUP BY e.user_id 
    LIMIT 100
";


$exposure_history_result = $conn->query($exposure_history);
while($exposure_history_row = $exposure_history_result->fetch_assoc()) {

$sql = "SELECT SUM(`exposure_earn`) as total_exposure_earn FROM exposure 
WHERE DATE_FORMAT(created_at, '%Y-%m') = '" . $created_month . "' AND user_id=".$exposure_history_row['user_id'];
$result_view_sql = $conn->query($sql);
$exposure_earn=0;
$row_get_sweeb = $result_view_sql->fetch_assoc();
if(isset($row_get_sweeb['total_exposure_earn']) && $row_get_sweeb['total_exposure_earn']>0){
 $exposure_earn=$row_get_sweeb['total_exposure_earn'];
}
$sql = "SELECT SUM(`credit_use`) as total_used_exposure FROM exposure 
WHERE DATE_FORMAT(created_at, '%Y-%m') = '" . $created_month . "' AND post_by_user=".$exposure_history_row['user_id'];
$result_view_sql = $conn->query($sql);
$row_get_sweeb = $result_view_sql->fetch_assoc();
$total_used_exposure=0;
if(isset($row_get_sweeb['total_used_exposure']) && $row_get_sweeb['total_used_exposure']>0){
 $total_used_exposure=$row_get_sweeb['total_used_exposure'];
}


$availbale_exposure_earn=$exposure_earn-$total_used_exposure;
echo $availbale_exposure_earn.'==='.$exposure_earn.'===='.$total_used_exposure.'===='.$exposure_history_row['user_id'];
echo "<br/>";

$sql = "SELECT * FROM exposure_leader 
WHERE DATE_FORMAT(created_at, '%Y-%m') = '" . $created_month . "' AND user_id=".$exposure_history_row['user_id'];
$result_verify_sql = $conn->query($sql);
$result_verify = $result_verify_sql->fetch_assoc();
$created_at=$created_month.'-01';
// if($result_verify_sql->num_rows==0){
//     $user_id=$exposure_history_row['user_id'];
//     $insert_logs = "INSERT INTO exposure_leader (user_id,exposure_earn,used_exposure, created_at) 
//     VALUES ('$user_id','$exposure_earn','$total_used_exposure','$created_at')";
//    $conn->query($insert_logs);
// }else{
//     $sql = "UPDATE exposure_leader SET exposure_earn='$exposure_earn',used_exposure='$total_used_exposure' WHERE 
//     id=".$result_verify['id'];
//    $conn->query($sql);
// }
// $sql = "UPDATE members SET availbale_exposure_earn='$availbale_exposure_earn',
// exposure_earn='$exposure_earn',
// used_exposure='$total_used_exposure'
//  WHERE id=".$exposure_history_row['user_id'];
// $conn->query($sql);


}
*/






/*
$sql = "SELECT * FROM `activity` WHERE date>'2023-12-31' GROUP by user_id ORDER BY `date` DESC";

$result = $conn->query($sql);

if ($result) { 
    // Fetch and display the duplicate values
    while ($row = $result->fetch_assoc()) {
        $user_id= $row['user_id'];
        $created_at=date('Y-m-d H:i:s', strtotime($row['date']));


        $this_month=date('Y-m', strtotime($row['date']));
            $sql_login_history ="SELECT * FROM  login_history  where DATE_FORMAT(created_at, '%Y-%m') = '" . $this_month . "' AND user_id=".$user_id;
            $result_sql_login_history= $conn->query($sql_login_history);
            $result_sql_login= $result_sql_login_history->fetch_assoc();
            if($result_sql_login_history->num_rows==0){
                 $insert_logs = "INSERT INTO login_history (user_id, created_at) VALUES ('$user_id','$created_at')";
                $conn->query($insert_logs);
            }else{
                 $sql = "UPDATE login_history SET created_at='$created_at' WHERE id=".$result_sql_login['id'];
                $conn->query($sql);
            }

    }
} else {
    echo "Error executing query: " . $conn->error;
}*





 /*$sql = "SELECT sweeba_id
        FROM exposure
        GROUP BY sweeba_id
        HAVING COUNT(*) > 1";

$result = $conn->query($sql);

if ($result) {
    // Fetch and display the duplicate values
    while ($row = $result->fetch_assoc()) {
        $credit_useOn_sweeba= $row['sweeba_id'];
    //    if($credit_useOn_sweeba>0){
    //      echo $sql_delete = "DELETE FROM exposure WHERE `credit_useOn_sweeba` IS NULL AND sweeba_id = ".$credit_useOn_sweeba;
    //      echo "<br/>";
    //      $conn->query($sql_delete);
    //    }
         //echo "Error executing query: " . $conn->error;

    }
} else {
    echo "Error executing query: " . $conn->error;
}*/



/*$sql = "SELECT * FROM members WHERE username='Munnakhan00009'";
$result = $conn->query($sql);
$user_details = $result->fetch_assoc();
$user_id_sess=$user_details['id'];


//exposure 
$total_used_exposure=0;
 $sql = "SELECT * FROM exposure WHERE user_id='$user_id_sess' AND sweeba_id='$sweeb_id_from'";
$result = $conn->query($sql);
if ($user_id_sess>0) {
    $post_by_user=$user_id_sweeb;
    $sweeba_id=$sweeb_id_from;
    $exposure_earn=0.5;
    $created_at=date('Y-m-d H:i:s');
     $insert_logs = "INSERT INTO exposure (user_id, post_by_user, sweeba_id, exposure_earn, created_at) VALUES ('$user_id_sess', '$post_by_user', '$sweeba_id', '$exposure_earn','$created_at')";
     $conn->query($insert_logs);


}
 $sql = "SELECT * FROM exposure WHERE user_id='$user_id_sess'";
$result_view_sql = $conn->query($sql);
$row_view_exposure = $result_view_sql->num_rows;
$exposure_earn=0;
if($row_view_exposure>0){
    while($row_credit = $result_view_sql->fetch_assoc()) {
        $exposure_earn += $row_credit['exposure_earn'];
        }
}
$exposure_message='';

?>

<?php 
$availbale_exposure_earn=$exposure_earn-$total_used_exposure;

if($availbale_exposure_earn>0){

$exposure_history = "SELECT *  FROM exposure WHERE user_id = '$user_id_sess'";
$exposure_history_result = $conn->query($exposure_history);
$credit_useOn_sweeba=array();
while($exposure_history_row = $exposure_history_result->fetch_assoc()) {
    if($exposure_history_row['credit_useOn_sweeba']>0){
   $credit_useOn_sweeba[]=$exposure_history_row['credit_useOn_sweeba'];
    }
}
//print_r($credit_useOn_sweeba);
if(count($credit_useOn_sweeba)>0){
    $implode_ids=implode(',', $credit_useOn_sweeba);
 $get_two_sweeb = "SELECT *  FROM sweebs WHERE user_id = '$user_id_sess' and id NOT IN ($implode_ids) AND status='active' Limit 2";

}else{
$get_two_sweeb = "SELECT *  FROM sweebs WHERE user_id = '$user_id_sess' AND status='active' Limit 2";

}
$get_two_result = $conn->query($get_two_sweeb);
$last_sweeb=array();
while($roget_two = $get_two_result->fetch_assoc()) {
    //echo $roget_two['id'];
     $last_sweeb[]=$roget_two['id'];
}
// now update to exposure
//print_r($last_sweeb);

$limit_exposer=count($last_sweeb)*2;
   $exposure_history = "SELECT *  FROM exposure WHERE user_id = '$user_id_sess' and `credit_useOn_sweeba` IS NULL Limit ".$limit_exposer;
$exposure_history_result = $conn->query($exposure_history);
$loop_update=0;
//echo  $exposure_history_result->num_rows;
if($exposure_history_result->num_rows>3){
while($exposure_history_row = $exposure_history_result->fetch_assoc()) {
   // echo $exposure_history_row['id'];
    if($loop_update==0 || $loop_update==1){
     $sql_update_expo = "UPDATE exposure SET credit_useOn_sweeba='".$last_sweeb[0]."',is_free=1 WHERE id=".$exposure_history_row['id'];
     $conn->query($sql_update_expo);

    }
    if($loop_update==2 || $loop_update==3){
     $sql_update_expo = "UPDATE exposure SET credit_useOn_sweeba='".$last_sweeb[1]."',is_free=1 WHERE id=".$exposure_history_row['id'];
     $conn->query($sql_update_expo);

    }
    $loop_update++;
 }
}
}
$availbale_exposure_earn=$availbale_exposure_earn-(count($credit_useOn_sweeba)/2);
 $sql = "SELECT * FROM exposure WHERE post_by_user='$user_id_sess'";
$result = $conn->query($sql);
$Exposure_views_received=$result->num_rows;
echo $Exposure_views_received;
*/
?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
    // location.reload();
    setTimeout(function() {
        location.reload();
    }, 500);
</script>