<?php


$date = date('Y-m-d H:i:s');
$os = explode(",", $friends);
//featured member
$sql = "SELECT * FROM members WHERE is_featured_member='1' AND is_expiary_date > CURDATE() AND id!='".$_SESSION["user_id"]."'";
$result = $conn->query($sql);

if ($result->num_rows >= 1) {
    while ($row = $result->fetch_assoc()) {
        $user_id_follow = $row['id'];
        $follows_user = $row['follows'];
        $follows_new = '' . $follows_user . ',' . $user_id . '';
        $follows_arr = explode(",", $follows_user);
        // Process the data for each selected member here
        if (!in_array($user_id_follow, $os)) {
            $friends_new = ''.$friends.','.$user_id_follow.'';
            $sql = "UPDATE members SET friends='$friends_new' WHERE id='$user_id'";
            $conn->query($sql);
            
            $sqls = "UPDATE members SET followers=followers+1, follows='$follows_new' WHERE id='$user_id_follow' Limit 1";
            $conn->query($sqls);
            $username1 =  getUserName($_SESSION['user_id'],$conn);
            $name_user =  $username1['username'];
            $sqlz = "INSERT INTO activity (id, user_id, action, created_date)
            VALUES (NULL, '$user_id_follow', '<a href=\"https://www.sweeba.com/$name_user\"> $name_user </a> has started following you!', '$date')";
            if ($conn->query($sqlz) === TRUE) {
            $sqla = "UPDATE members SET notif=notif+1 WHERE id='$user_id_follow' Limit 1";
            $conn->query($sqla);
            }
            }
    }
}

//same process for the premium member
$sql_sub = "SELECT * FROM  subscription WHERE status='Success' AND expire_date > CURDATE() AND user_id!='".$_SESSION["user_id"]."'";
$result_sub = $conn->query($sql_sub);

if ($result_sub->num_rows >= 1) {
    while ($row_sub = $result_sub->fetch_assoc()) {
        $data = getUserDetail($row_sub['user_id'],$conn);
        $user_id_follow = $data['id'];
        $follows_user = $data['follows'];
        $follows_new = '' . $follows_user . ',' . $user_id . '';
        $follows_arr = explode(",", $follows_user);
        // Process the data for each selected member here
        if (!in_array($user_id_follow, $os)) {
            $friends_new = ''.$friends.','.$user_id_follow.'';
            $sql = "UPDATE members SET friends='$friends_new' WHERE id='$user_id'";
            $conn->query($sql);
            
            $sqls = "UPDATE members SET followers=followers+1, follows='$follows_new' WHERE id='$user_id_follow' Limit 1";
            $conn->query($sqls);
            
            $username1 =  getUserName($_SESSION['user_id'],$conn);
            $name_user =  $username1['username'];
            $sqlz = "INSERT INTO activity (id, user_id, action, created_date)
            VALUES (NULL, '$user_id_follow', '<a href=\"https://www.sweeba.com/$name_user\">$name_user</a> has started following you!', '$date')";
            if ($conn->query($sqlz) === TRUE) {
            $sqla = "UPDATE members SET notif=notif+1 WHERE id='$user_id_follow' Limit 1";
            $conn->query($sqla);
            }
            }
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
       $data['id'] = $row['id'];
       $data['follows'] =  $row['follows'];
      }
    }
  return $data;
}
function getUserName($userId,$conn)
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
       $data['username'] = $row['username'];
      }
    }
  return $data;
}
?>