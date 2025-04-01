<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $get_username = strip_tags($_GET["id"]);
  //print_r($get_username);die;
  $date = date('Y-m-d H:i:s');
  $os = explode(",", $friends);

  $sql = "SELECT * FROM members WHERE username='$get_username'";
  $result = $conn->query($sql);
  if ($result->num_rows == 1) {
    while ($row = $result->fetch_assoc()) {
      $user_id_follow = $row['id'];
      $follows_user = $row['follows'];
      $follows_new = '' . $follows_user . ',' . $user_id . '';
      $follows_arr = explode(",", $follows_user);
    }
  } else {
    header('Location: /' . $get_username . '');
    die;
  }

  if (isset($_POST['follow'])) {
    if (!in_array($user_id_follow, $os)) {
      $friends_new = '' . $friends . ',' . $user_id_follow . '';
      $sql = "UPDATE members SET friends='$friends_new' WHERE id='$user_id'";
      $conn->query($sql);

      $sqls = "UPDATE members SET followers=followers+1, follows='$follows_new' WHERE id='$user_id_follow' Limit 1";
      $conn->query($sqls);

      $sqlz = "INSERT INTO activity (id, user_id, action, created_date)
VALUES (NULL, '$user_id_follow', '<a href=\"https://www.sweeba.com/$username\">$username</a> has Unfollow to you!', '$date')";
      if ($conn->query($sqlz) === TRUE) {
        $sqla = "UPDATE members SET notif=notif+1 WHERE id='$user_id_follow' Limit 1";
        $conn->query($sqla);
      }


      header('Location: /' . $get_username . '');
      die;
    }
  } elseif (isset($_POST['unfollow'])) {
    //if (in_array($user_id_follow, $os)) {


    $friends_new = str_replace(',' . $user_id_follow . '', '', '' . $friends . '');
    $follows_new = str_replace(',' . $user_id . '', '', '' . $follows_user . '');
    $sql = "UPDATE members SET friends='$friends_new' WHERE id='$user_id'";
    $conn->query($sql);

    $sqls = "UPDATE members SET followers=followers-1, follows='$follows_new' WHERE id='$user_id_follow' Limit 1";
    $conn->query($sqls);

    header('Location: /' . $get_username . '');
    die;
    //}


  }
}
// little sanitize funtion
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//end sanitization
