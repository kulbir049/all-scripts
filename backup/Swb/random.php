<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
include('main/config.php');
include('main/functions.php');

$get_sweeb_id = strip_tags($_GET["id"]);
$sweeb_title = strip_tags($_GET["t"]);


checkLogin();
updateExposureErn_ForRandom($conn, $user_id_sess);
checkSurfThreeDays($user_id_sess, $conn);

$os = explode(",", $friends);
$next_sweeb_ajax = 0;
$view_members_link_credits = 0;

if (isset($_SESSION['next_sweeb_ajax'])) {
  $next_sweeb_ajax = $_SESSION['next_sweeb_ajax'] - $_SESSION['next_sweeb'];
  $_SESSION['next_sweeb'] = $_SESSION['next_sweeb_ajax'];
} else {
  $_SESSION['next_sweeb'] = 0;
}
// follow unfollow code start here

if (isset($_POST['follow'])) {
  $todayDate = strtotime(date('Y-m-d'));
  $user_id_follow = $_POST['user_id_follow'];
  $user_name_follow = $_POST['user_name_follow'];
  if (!in_array($user_id_follow, $os)) {
    $friends_new = '' . $friends . ',' . $user_id_follow . '';
    $sql = "UPDATE members SET friends='$friends_new' WHERE id='$user_id_sess'";
    $conn->query($sql);

    $sqls = "UPDATE members SET followers=followers+1, follows='$follows_new' WHERE id='$user_id_follow' Limit 1";
    $conn->query($sqls);

    $sqlz = "INSERT INTO activity (id, user_id, action, created_date)
  VALUES (NULL, '$user_id_follow', '<a href=\"https://www.sweeba.com/$username\">$username</a> has Unfollow to you!', '$todayDate')";
    if ($conn->query($sqlz) === TRUE) {
      $sqla = "UPDATE members SET notif=notif+1 WHERE id='$user_id_follow' Limit 1";
      $conn->query($sqla);
    }
    $_SESSION['follow_unfollow_mesage'] = "You are now following <strong>" . $user_name_follow . "</strong>";
  }
} elseif (isset($_POST['unfollow'])) {
  //if (in_array($user_id_follow, $os)) {

  $user_id_follow = $_POST['user_id_follow'];
  $user_name_follow = $_POST['user_name_follow'];

  $friends_new = str_replace(',' . $user_id_follow . '', '', '' . $friends . '');
  $follows_new = str_replace(',' . $user_id_sess . '', '', '' . $follows_user . '');
  $sql = "UPDATE members SET friends='$friends_new' WHERE id='$user_id_sess'";
  $conn->query($sql);

  $sqls = "UPDATE members SET followers=followers-1, follows='$follows_new' WHERE id='$user_id_follow' Limit 1";
  $conn->query($sqls);

  $_SESSION['follow_unfollow_mesage'] = "You are now un-following <strong>" . $user_name_follow . "</strong>";
}

// follow unfollow code start end








$todayDate = strtotime(date('Y-m-d'));
// reffrel on 50 pages surf
if (!isset($_SESSION['todayReffle'][$todayDate])) {
  $_SESSION['todayReffle'][$todayDate] = 0;
}
$_SESSION['todayReffle'][$todayDate] = $_SESSION['todayReffle'][$todayDate] + 1;
if ($_SESSION['todayReffle'][$todayDate] >= 50) {
  $earn_ref = '0.00';
  $sql = "SELECT * FROM members WHERE id='$user_id_sess'";
  $result = $conn->query($sql);
  $userCurrentBalanc = $result->fetch_assoc();
  $updateBalance = $userCurrentBalanc['balance'] + $earn_ref;

  $sql = "UPDATE members SET balance='$updateBalance' WHERE id='$user_id_sess'";
  mysqli_query($conn, $sql);
  $_SESSION['todayReffle'][$todayDate] = 0;
}





// $sql_rotation = "SELECT `credit_useOn_sweeba` FROM exposure WHERE user_id != '$user_id_sess' AND `credit_useOn_sweeba` IS NOT NULL GROUP BY `credit_useOn_sweeba`";

/*$sql_rotation = "SELECT `credit_useOn_sweeba` FROM exposure e
JOIN members m ON m.id = e.user_id
WHERE m.availbale_exposure_earn >0 AND e.user_id != '$user_id_sess' AND e.`credit_useOn_sweeba` IS NOT NULL
GROUP BY e.`credit_useOn_sweeba`";

$sql_rotation_result = $conn->query($sql_rotation);

if ($sql_rotation_result) {
  $rows = $sql_rotation_result->fetch_all(MYSQLI_ASSOC);

  foreach ($rows as $row) {
    // Access the 'credit_useOn_sweeba' column for each row
    $credit_useOn_sweeba[] = $row['credit_useOn_sweeba'];
  }
} else {
  echo "Error executing query: " . $conn->error;
}*/
$sql_rotation = "SELECT DISTINCT e.`credit_useOn_sweeba` 
                 FROM exposure e
                 JOIN members m ON m.id = e.user_id
                 WHERE m.availbale_exposure_earn > 0 
                   AND e.user_id != '$user_id_sess'
                   AND e.`credit_useOn_sweeba` IS NOT NULL";

$sql_rotation_result = $conn->query($sql_rotation);

if ($sql_rotation_result) {
  //$credit_useOn_sweeba = $sql_rotation_result->fetch_all(MYSQLI_ASSOC);  // Fetch all distinct rows directly
  $rows = $sql_rotation_result->fetch_all(MYSQLI_ASSOC);  // Fetch all rows at once
  $credit_useOn_sweeba = array_column($rows, 'credit_useOn_sweeba');
} else {
  echo "Error executing query: " . $conn->error;
}

$sql_reported = "SELECT sweeb_id FROM sweeb_reports WHERE user_id = $user_id_sess";
$result_reported = $conn->query($sql_reported);
$sweeb_ids_reported = [];
// Fetch the sweeb_ids and store them in the array
while ($row_reported = $result_reported->fetch_assoc()) {
  $sweeb_ids_reported[] = $row_reported['sweeb_id'];
}

// Now $credit_useOn_sweeba contains the distinct values
$credit_useOn_sweeba = array_diff($credit_useOn_sweeba, $sweeb_ids_reported);

$userIdsString = implode(',', $credit_useOn_sweeba);
//dd($userIdsString,$credit_useOn_sweeba);
//$sql_rotation = "SELECT *  FROM exposure WHERE is_post_delete=0 AND user_id!='$user_id_sess' AND `credit_useOn_sweeba` IN ($userIdsString) ORDER BY rand() Limit 1";
$sql_rotation = "
    SELECT e.* 
    FROM exposure e
    INNER JOIN members m ON m.id = e.user_id
    WHERE e.is_post_delete = 0 
      AND e.user_id != '$user_id_sess'
      AND e.credit_useOn_sweeba IN ($userIdsString)
      AND m.availbale_exposure_earn > 0
    ORDER BY RAND() 
    LIMIT 1
";

$sql_rotation_result = $conn->query($sql_rotation);
$row_get_sweeb = $sql_rotation_result->fetch_assoc();
//print_r($row_get_sweeb['credit_useOn_sweeba']);die;
//echo $on_off_toggle;die;
if ($on_off_toggle == 'OFF') {
  // echo "hekk";die;
  if (!isset($_SESSION['pause_sweeb']) || $_SESSION['pause_sweeb'] == 0) {
    $_SESSION['pause_sweeb'] = $row_get_sweeb['credit_useOn_sweeba'];
  }
  $row_get_sweeb['credit_useOn_sweeba'] = $_SESSION['pause_sweeb'];
} else {
  $_SESSION['pause_sweeb'] = $row_get_sweeb['credit_useOn_sweeba'];
}
//echo $row_get_sweeb['credit_useOn_sweeba'];die;
$sql = "SELECT *  FROM sweebs WHERE id=" . $row_get_sweeb['credit_useOn_sweeba'];

//die;
$result = $conn->query($sql);
if (!$result) {
  echo "Error executing query: " . $conn->error;
}
if ($result->num_rows == 0) {
  $_SESSION['pause_sweeb'] = 0;
  $sql_update_expo_delete = "UPDATE exposure SET is_post_delete=1 WHERE credit_useOn_sweeba=" . $row_get_sweeb['credit_useOn_sweeba'];
  $conn->query($sql_update_expo_delete);
  header("Location: random.php");
  die();
}


// output data of each row
while ($row = $result->fetch_assoc()) {
  $user_id_sweeb = $row['user_id'];
  updateExposureErn_ForRandom($conn, $user_id_sweeb);

  $sweeb_id_from = $row['id'];
  $image_str = $row['image'];
  $met_img = $row['image'];
  $sq = "SELECT *  FROM members WHERE id = '$user_id_sweeb'";
  $resul = $conn->query($sq);
  while ($ro = $resul->fetch_assoc()) {
    $sweeb_avatar = $ro['avatar'];
    $sweeb_username = $ro['username'];
    $sweeb_sweebs = $ro['sweebs'];
    $sweeb_comments = $ro['comments'];
    $sweeb_friends = $ro['friends'];
    $sweeb_friends = explode(",", $sweeb_friends);
    $sweeb_total_friends = count($sweeb_friends);
    $social_links_json = $ro['social_links_json'];
    $is_featured_member = $ro['is_featured_member'];
    $is_expiary_date = $ro['is_expiary_date'];
    $sweeb_id = $ro['id'];
  }




  $datetime = strtotime($row['date']);
  $up_vote = $row['up'];
  $down_vote = $row['down'];
  $views = $row['views'];
  $content = $row['content'];
  $link = $row['link'];
  $uncode_c = $row['content'];
  $uncode_c = preg_replace("/<!--.*?-->/", "", $uncode_c);
  $uncode_c = strip_tags($uncode_c);

  $content = htmlspecialchars_decode($content, ENT_NOQUOTES);
  $words1 = str_word_count($content);

  $video_str = $row['video'];
  $title = $row['title'];

  if ($title == NULL) {
    if ($words1 <= '1') {
      $content = substr($content, 0, 10);
    }
    $slug_go = limit_text($content, 5);
    $slug_go = substr($content, 0, 20);
    $slug_go = slugify($slug_go);
  } else {
    $slug_go = slugify($title);
  }

  $comments_total = $row['comments'];

  // no more info on sweeb
}


// check subscription query---->
$dateToday = date('Y-m-d');
$sql_membership = "SELECT * FROM subscription where user_id='" . $user_id_sweeb . "' AND expire_date > '" . $dateToday . "' AND status='Success'";
$result_membership = $conn->query($sql_membership);
$result_membership_count_kulbir = $result_membership->num_rows;

include('main/add_comment.php');

if ($user_id != NULL) {
  $sql = "SELECT id, type FROM likes WHERE user_id='$user_id' AND sweeb_id='$sweeb_id_from'";
  $result = $conn->query($sql);
  if ($result->num_rows >= 1) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $vote_id = $row['id'];
      $vote_type = $row['type'];
    }
  } else {
    $gave_like = 'no';
  }
} else {
  $gave_like = 'no';
}

function isMobile()
{
  return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
$last_view = date('Y-m-d');
$sql = "UPDATE sweebs SET views=views+1, last_view='$last_view' WHERE id='$sweeb_id_from'";
$conn->query($sql);
?>
<?php
include('main/header.php');

//exposure
$total_used_exposure = 0;
$sql = "SELECT * FROM exposure WHERE user_id='$user_id_sess' AND sweeba_id='$sweeb_id_from'";
$result = $conn->query($sql);
if ($user_id_sess > 0) {
  $post_by_user = $user_id_sweeb;
  $sweeba_id = $sweeb_id_from;
  if ($result_membership_count > 0) {
    $exposure_earn = 0.75;
    $exposure_earn_message = 1.5;
  } else {
    $exposure_earn = 0.5;
    $exposure_earn_message = 1;
  }
  if ($on_off_toggle == 'ON' && $next_sweeb_ajax == 1) {
    $created_at = date('Y-m-d H:i:s');
    $insert_logs = "INSERT INTO exposure (user_id, post_by_user, sweeba_id, exposure_earn, created_at) VALUES ('$user_id_sess', '$post_by_user', '$sweeba_id', '$exposure_earn','$created_at')";
    $conn->query($insert_logs);
  }

  // 0.50 credits for clicking green button start here
  if (isset($_SESSION['view_members_link_credits'])) {
    $exposure_earn = 0.5;
    $exposure_earn_message = 1;
    $credit_use = 0;
    $is_free = 1;
    $free_desc = 'view_members_link_credits';

    $created_at = date('Y-m-d H:i:s');
    $insert_click_logs = "INSERT INTO exposure (user_id, post_by_user, sweeba_id, exposure_earn, created_at,credit_use,is_free,free_desc)
     VALUES ('$user_id_sess', 0, 0, '$exposure_earn','$created_at','$credit_use','$is_free','$free_desc')";

    $conn->query($insert_click_logs);
    unset($_SESSION['view_members_link_credits']);
    // echo $insert_click_logs, $_SESSION['view_members_link_credits'];
    // exit;
  }

  // 0.50 credits for clicking green button end here
}
$sql = "SELECT SUM(`exposure_earn`) as total_exposure_earn FROM exposure WHERE user_id='$user_id_sess'";
$result_view_sql = $conn->query($sql);
$exposure_earn = 0;
$row_get_sweeb = $result_view_sql->fetch_assoc();
if (isset($row_get_sweeb['total_exposure_earn']) && $row_get_sweeb['total_exposure_earn'] > 0) {
  $exposure_earn = $row_get_sweeb['total_exposure_earn'];
}
$sql = "SELECT SUM(`credit_use`) as total_used_exposure FROM exposure WHERE post_by_user='$user_id_sess'";
$result_view_sql = $conn->query($sql);
$row_get_sweeb = $result_view_sql->fetch_assoc();
if (isset($row_get_sweeb['total_used_exposure']) && $row_get_sweeb['total_used_exposure'] > 0) {
  $total_used_exposure = $row_get_sweeb['total_used_exposure'];
}
$row_view_exposure = 0;
$sql = "SELECT SUM(`credit_use`) as total_used_exposure FROM exposure WHERE user_id='$user_id_sess'";
$row_view_exposure_sql = $conn->query($sql);
$result_view_exposure_sql = $row_view_exposure_sql->fetch_assoc();
if (isset($result_view_exposure_sql['total_used_exposure']) && $result_view_exposure_sql['total_used_exposure'] > 0) {
  $row_view_exposure = $result_view_exposure_sql['total_used_exposure'];
}
$exposure_message = '';

?>

<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link href="/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css">

<div class="wrap" style="margin-top:0px;">

  <?php if (((int) $exposure_earn == $exposure_earn) && $next_sweeb_ajax == 1) {
    $exposure_message = "You earned " . $exposure_earn_message . " exposure credit.";
  ?>
    <div style="background:#2ecc71;padding:10px;color:#fff;margin-bottom: 10px"> <span class="glyphicon glyphicon-flag" aria-hidden="true"></span> <?php echo $exposure_message; ?></div>
  <?php }
  if (isset($_SESSION['on_surf_three_days'])) {
    echo $_SESSION['on_surf_three_days'];
    unset($_SESSION['on_surf_three_days']);
  }

  ?>

  <?php


  //if($_SESSION['captcha_verify']==true){  // if captcha verified then insert data end here

  $captcha_count = 20;
  $availbale_exposure_earn = $exposure_earn - $total_used_exposure;
  //echo $availbale_exposure_earn.'==='.$exposure_earn.'===='.$total_used_exposure;
  $sql = "UPDATE members SET availbale_exposure_earn='$availbale_exposure_earn',
exposure_earn='$exposure_earn',
used_exposure='$total_used_exposure'
 WHERE id='$user_id_sess'";
  $conn->query($sql);


  if ($availbale_exposure_earn > 0) {
    $exposure_history = "SELECT *  FROM exposure WHERE user_id = '$user_id_sess'";

    $exposure_history_result = $conn->query($exposure_history);
    $credit_useOn_sweeba = array();
    while ($exposure_history_row = $exposure_history_result->fetch_assoc()) {
      if ($exposure_history_row['credit_useOn_sweeba'] > 0) {
        $credit_useOn_sweeba[] = $exposure_history_row['credit_useOn_sweeba'];
      }
    }
    //print_r($credit_useOn_sweeba);
    if (count($credit_useOn_sweeba) > 0) {
      $implode_ids = implode(',', $credit_useOn_sweeba);
      $get_two_sweeb = "SELECT *  FROM sweebs WHERE user_id = '$user_id_sess' and id NOT IN ($implode_ids) AND status='active' Limit 2";
    } else {
      $get_two_sweeb = "SELECT *  FROM sweebs WHERE user_id = '$user_id_sess' AND status='active' Limit 2";
    }
    $get_two_result = $conn->query($get_two_sweeb);
    $last_sweeb = array();
    while ($roget_two = $get_two_result->fetch_assoc()) {
      //echo $roget_two['id'];
      $last_sweeb[] = $roget_two['id'];
    }
    // now update to exposure
    //print_r($last_sweeb);

    $limit_exposer = count($last_sweeb) * 2;
    $exposure_history = "SELECT *  FROM exposure WHERE user_id = '$user_id_sess' and `credit_useOn_sweeba` IS NULL Limit " . $limit_exposer;
    $exposure_history_result = $conn->query($exposure_history);
    $loop_update = 0;
    while ($exposure_history_row = $exposure_history_result->fetch_assoc()) {
      // echo $exposure_history_row['id'];
      $today_date = date('Y-m-d');
      if ($loop_update == 0 || $loop_update == 1) {
        $sql_update_expo = "UPDATE exposure SET credit_useOn_sweeba='" . $last_sweeb[0] . "', credit_use_date='" . $today_date . "'
    WHERE sweeba_id>0 AND id=" . $exposure_history_row['id'];
        $conn->query($sql_update_expo);
      }
      if ($loop_update == 2 || $loop_update == 3) {
        $sql_update_expo = "UPDATE exposure SET credit_useOn_sweeba='" . $last_sweeb[1] . "', credit_use_date='" . $today_date . "'
    WHERE  sweeba_id>0 AND id=" . $exposure_history_row['id'];
        $conn->query($sql_update_expo);
      }
      $loop_update++;
    }
  }
  //$availbale_exposure_earn=$availbale_exposure_earn-(count($credit_useOn_sweeba)/2);
  $sql = "SELECT * FROM exposure WHERE post_by_user='$user_id_sess'";
  $result = $conn->query($sql);
  $Exposure_views_received = $result->num_rows;

  //They will receive this bonus after 25, 50, 75, 100, 125, 150, 175, etc etc start
  $sql = "SELECT * FROM members WHERE id='$user_id_sess'";
  $result = $conn->query($sql);
  $userdetails = $result->fetch_assoc();
  if ($on_off_toggle == 'ON' && $next_sweeb_ajax == 1) {
    $_SESSION['countDown'][$todayDate] = $_SESSION['countDown'][$todayDate] + 1;
  } else {
    $_SESSION['countDown'][$todayDate] = $_SESSION['countDown'][$todayDate];
  }
  $_SESSION['captcha_count'] = $_SESSION['captcha_count'] + 1;
  $countDown = $userdetails['next_exp_target'] - $_SESSION['countDown'][$todayDate];
  if ($countDown == 0) {
    $next_exp_target = $userdetails['next_exp_target'];
    $countDown = $next_exp_target;
    $sql = "UPDATE members SET next_exp_target='$next_exp_target' WHERE id='$user_id_sess'";
    mysqli_query($conn, $sql);
    $post_by_user = $user_id_sess;
    $sweeba_id = 0;
    $exposure_earn_bonus = 5;
    $created_at = date('Y-m-d H:i:s');
    if ($on_off_toggle == 'ON' && $next_sweeb_ajax == 1) {
      $insert_logs = "INSERT INTO exposure (user_id, post_by_user, sweeba_id, exposure_earn, created_at, credit_use) VALUES ('$user_id_sess', '$post_by_user', '$sweeba_id', '$exposure_earn_bonus','$created_at',0)";
      $conn->query($insert_logs);
      $_SESSION['countDown'][$todayDate] = 0;
    }
  }
  if ($_SESSION['captcha_count'] > $captcha_count) {
    $_SESSION['captcha_verify'] = false;
  }

  //} // if captcha verified then insert data end here


  if ($_SESSION['countDown'][$todayDate] == 0 && $on_off_toggle == 'ON' && $next_sweeb_ajax == 1) {
    $exposure_message = "You earned 5 exposure credits as a bonus!";
  ?>
    <div style="background:#2ecc71;padding:10px;color:#fff;margin-bottom: 10px"><img src="images/bolt.png" width="20" height="20" /> <?php echo $exposure_message; ?></div>
  <?php } ?>


  <?php if (isset($_SESSION['follow_unfollow_mesage'])) { ?>
    <div style="background:#2ecc71;padding:10px;color:#fff;margin-bottom: 10px"><span class="glyphicon glyphicon-volume-up" aria-hidden="true"></span> <?php echo $_SESSION['follow_unfollow_mesage']; ?></div>
  <?php
    unset($_SESSION['follow_unfollow_mesage']);
  }
  ?>

  <style>
    .text:nth-child(odd) {

      background: #fff;
      padding: 20px;
    }

    .text:nth-child(even) {
      background: #eef0f2;
      padding: 20px;
    }

    .glyphicon.glyphicon-cloud {
      font-size: 15px;

    }

    .glyphicon.glyphicon-volume-up {
      font-size: 15px;

    }

    .glyphicon.glyphicon-ok {
      font-size: 15px;

    }

    .glyphicon.glyphicon-flag {
      font-size: 15px;

    }

    .glyphicon.glyphicon-eye-open {
      font-size: 15px;

    }

    .glyphicon.glyphicon-fire {
      font-size: 25px;
    }

    body {
      background: #d9e4ed;
      font-family: 'Open Sans', sans-serif;
    }

    h2 {
      font-family: 'Open Sans', sans-serif;
      font-size: 32px;
    }

    .wrap {
      max-width: 1055px;
      margin-left: auto;
      margin-right: auto;
      opacity: 1;
    }

    .wrap_small {
      max-width: 450px;
      margin-left: auto;
      margin-right: auto;
      opacity: 1;
    }

    p {
      font-family: 'Open Sans', sans-serif;
    }

    .wrap1 {
      max-width: 1100px;
      margin: 0 auto;
      margin-top: 100px;
    }

    .btn-main {
      border: 2px solid #b6c0c9;
      color: #b6c0c9;
      background: none;
      font-size: 14px;
      font-weight: Bold;
      border-radius: 0px;
    }

    .btn-main:hover {
      border: 2px solid #5fb5f2;
      color: #5fb5f2;
      font-size: 14px;
      font-weight: Bold;
      border-radius: 0px;
    }


    .btn-main2 {
      border: 2px solid #fff;
      color: #fff;
      background: #fff;
      font-size: 14px;
      font-weight: Bold;
      border-radius: 3px;
    }

    .btn-main2:hover {
      border: 2px solid #fff;
      color: #fff;
      font-size: 14px;
      font-weight: Bold;
      border-radius: 3px;
    }


    .avatar {
      display: block;
      width: 95%;
      border-radius: 100%;
      margin-top: 10px;
      margin-left: 5px;
    }

    .form_in {
      font-family: 'Open Sans', sans-serif;
      border: 1px solid #5fb5f2;
      color: #3e4851;
      box-shadow: none;
      border-radius: 0px;
    }

    .box-col {
      font-family: 'Open Sans', sans-serif;
      background: #fff;
    }


    .box {
      font-family: 'Open Sans', sans-serif;

      display: inline-block;
      background: #fff;
      border: 1px solid #eee;
      margin: 0 2px 15px;
      padding: 10px;
      padding-bottom: 5px;
      opacity: 1;

      -webkit-transition: all .2s ease;
      -moz-transition: all .2s ease;
      -o-transition: all .2s ease;
      transition: all .2s ease;
    }

    .navbar-default {
      background-color: #fff;
      font-family: 'Open Sans', sans-serif;
      opacity: 1;
      border: 0px;


    }

    .navbar-default .navbar-brand {
      color: #ecf0f1;
    }

    .navbar-default .navbar-brand:hover,
    .navbar-default .navbar-brand:focus {
      color: #30cbd9;
    }

    .navbar-default .navbar-text {
      color: #868f98;
      font-family: 'Open Sans', sans-serif;
    }

    .navbar-default .navbar-nav>li>a {
      color: #868f98;
      font-size: 14px;
      font-family: 'Open Sans', sans-serif;
    }

    .navbar-default .navbar-nav>li>a:hover,
    .navbar-default .navbar-nav>li>a:focus {
      color: #30cbd9;
    }

    .navbar-default .navbar-nav>.active>a,
    .navbar-default .navbar-nav>.active>a:hover,
    .navbar-default .navbar-nav>.active>a:focus {
      color: #30cbd9;
      background-color: #ffffff;
    }

    .navbar-default .navbar-nav>.open>a,
    .navbar-default .navbar-nav>.open>a:hover,
    .navbar-default .navbar-nav>.open>a:focus {
      color: #30cbd9;
      background-color: #ffffff;
    }

    .navbar-default .navbar-toggle {
      border-color: #ffffff;
    }

    .navbar-default .navbar-toggle:hover,
    .navbar-default .navbar-toggle:focus {
      background-color: #ffffff;
    }

    .navbar-default .navbar-toggle .icon-bar {
      background-color: #ecf0f1;
    }

    .navbar-default .navbar-collapse,
    .navbar-default .navbar-form {
      border-color: #ecf0f1;
    }

    .navbar-default .navbar-link {
      color: #ecf0f1;
    }

    .navbar-default .navbar-link:hover {
      color: #30cbd9;
    }

    @media (max-width: 767px) {
      .navbar-default .navbar-nav .open .dropdown-menu>li>a {
        color: #ecf0f1;
      }

      .navbar-default .navbar-nav .open .dropdown-menu>li>a:hover,
      .navbar-default .navbar-nav .open .dropdown-menu>li>a:focus {
        color: #30cbd9;
      }

      .navbar-default .navbar-nav .open .dropdown-menu>.active>a,
      .navbar-default .navbar-nav .open .dropdown-menu>.active>a:hover,
      .navbar-default .navbar-nav .open .dropdown-menu>.active>a:focus {
        color: #30cbd9;
        background-color: #ffffff;
      }
    }

    .up {
      background: #ffae19;
      height: 85px;
      text-align: center;
      color: #5b832b;
      font-weight: bold;
      font-size: 16px;
      margin-bottom: 15px;
      z-index: 1;
      cursor: pointer;
      transition: 0.08s ease-in;
      -o-transition: 0.08s ease-in;
      -ms-transition: 0.08s ease-in;
      -moz-transition: 0.08s ease-in;
      -webkit-transition: 0.08s ease-in;
    }

    .down {
      background: #5fb5f2;
      height: 85px;
      text-align: center;
      color: #842d40;
      font-weight: bold;
      font-size: 16px;
      margin-bottom: 15px;
    }

    .up:hover,
    .down:hover {
      opacity: 0.7;


      -webkit-transition: top 0.09s ease-in;
    }


    .switch {
      position: relative;
      display: inline-block;
      width: 85px;
      height: 25px;
      cursor: pointer !important;
      vertical-align: middle;
    }

    .switch input {
      display: none;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      border-radius: 34px;
      transition: 0.4s;
    }

    .slider:before {
      position: absolute;
      content: '';
      height: 24px;
      width: 24px;
      left: 4px;
      bottom: 0px;
      background-color: white;
      border-radius: 50%;
      transition: 0.4s;
    }

    input:checked+.slider {
      background-color: #5cb85c;
      /* Background color when toggled on */
    }

    input:checked+.slider:before {
      transform: translateX(52px);
    }

    .on-off-text {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      left: 30px;
      color: #555;
    }

    .preview {
      border-radius: 5px;
      padding: 0px;
      -webkit-box-shadow: 0px 0px 8px 0px rgba(226, 226, 226, 0.75);
      -moz-box-shadow: 0px 0px 8px 0px rgba(226, 226, 226, 0.75);
      box-shadow: 0px 0px 8px 0px rgba(226, 226, 226, 0.75);
    }

    #smallLinkButton:hover,
    active,
    visited {

      text-decoration: none;
    }




    .cloud {
      width: 320px;
      height: 215px;

      background: #f2f9fe;
      background: linear-gradient(top, #fff 5%, #d0deec 100%);
      background: -webkit-linear-gradient(top, #fff 5%, #d0deec 100%);
      background: -moz-linear-gradient(top, #fff 5%, #d0deec 100%);
      background: -ms-linear-gradient(top, #fff 5%, #d0deec 100%);
      background: -o-linear-gradient(top, #fff 5%, #d0deec 100%);

      border-radius: 100px;
      -webkit-border-radius: 100px;
      -moz-border-radius: 100px;

      position: relative;
      margin: 45px auto 20px;
    }

    .cloud:after,
    .cloud:before {
      content: '';
      position: absolute;
      background: #FFF;
      z-index: -1
    }

    .cloud:after {
      width: 100px;
      height: 100px;
      top: -30px;
      left: 50px;

      border-radius: 100px;
      -webkit-border-radius: 100px;
      -moz-border-radius: 100px;
    }

    .cloud:before {
      width: 180px;
      height: 180px;
      top: -50px;
      right: 50px;
      border-radius: 200px;
      -webkit-border-radius: 200px;
      -moz-border-radius: 200px;
    }

    img {
      max-inline-size: 90%;
      block-size: auto;
    }

    .overflow {
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
    }

    .youtubevideo {
      position: relative;
      padding-bottom: 56.25%;
      padding-top: 30px;
      height: 0;
      overflow: hidden;
    }

    .youtubevideo iframe,
    .video-container object,
    .video-container embed {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }

    .center {
      display: block;
    }



    .slider2 {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      border-radius: 34px;
      transition: 0.4s;
    }

    .slider2:before {
      position: absolute;
      content: '';
      height: 15px;
      width: 12px;
      left: 4px;
      bottom: 5px;
      background-color: white;
      border-radius: 50%;
      transition: 0.4s;
    }

    input:checked+.slider2 {
      background-color: #5cb85c;
      /* Background color when toggled on */
    }

    input:checked+.slider2:before {
      transform: translateX(52px);
    }

    .on-off-text {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      left: 30px;
      color: #555;
    }
  </style>

  <?php
  $exposure_message_premium = '';
  //Premium members get 500 credits monthly
  if (empty($exposure_message)) {
    // Get the current month and year
    $dateToday = date('Y-m-d');
    $sql_membership = "SELECT * FROM subscription where user_id='" . $user_id_sess . "' AND expire_date > '" . $dateToday . "' AND status='Success' AND payment_type='Online'";
    $result_membership = $conn->query($sql_membership);
    $result_membership_count = $result_membership->num_rows;
    if ($result_membership_count > 0) {
      $currentMonth = date('m');
      $currentYear = date('Y');
      $query = "SELECT * FROM exposure WHERE user_id=" . $user_id_sess . " AND exposure_earn='500' AND MONTH(created_at) = $currentMonth AND YEAR(created_at) = $currentYear";
      $verify_query = $conn->query($query);
      $verify_query_num = $verify_query->num_rows;
      if ($verify_query_num == 0) {
        $post_by_user = $user_id_sess;
        $sweeba_id = 0;
        $exposure_earn_bonus = 500;
        $created_at = date('Y-m-d H:i:s');
        if ($on_off_toggle == 'ON' && $next_sweeb_ajax == 1) {
          $insert_logs = "INSERT INTO exposure (user_id, post_by_user, sweeba_id, exposure_earn, created_at,credit_use) VALUES ('$user_id_sess', '$post_by_user', '$sweeba_id', '$exposure_earn_bonus','$created_at',0)";
          $conn->query($insert_logs);
          $exposure_message_premium = "Congratulations!! Your 500 monthly exposure credits have been added as a premium member.";
          $exposure_earn = $exposure_earn_bonus + $exposure_earn;
        }
      }
    }
  }



  if (!empty($exposure_message_premium)) {
  ?>
    <div style="background:#2ecc71;padding:10px;color:#fff;margin-bottom: 10px"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span> <?php echo $exposure_message_premium; ?></div>
  <?php } ?>


  <!-- Modal -->
  <script>
    // function getVote(int) {
    //   if (window.XMLHttpRequest) {
    //     // code for IE7+, Firefox, Chrome, Opera, Safari
    //     xmlhttp=new XMLHttpRequest();
    //   } else {  // code for IE6, IE5
    //     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    //   }
    //   xmlhttp.onreadystatechange=function() {
    //     if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    //       document.getElementById("poll").innerHTML=xmlhttp.responseText;
    //     }
    //   }
    //   xmlhttp.open("GET","/main/like_sweeb.php?id="+<?php echo $sweeb_id_from; ?>+"&vote="+int,true);
    //   xmlhttp.send();
    // }


    function getVote(int) {
      $.ajax({
        url: "/main/like_sweeb.php?id=" + <?php echo $sweeb_id_from; ?> + "&vote=" + int,
        type: "GET",
        data: {},
        success: function(response) {
          // console.log(response);
          var obj = jQuery.parseJSON(response);
          if (obj.up > 0) {
            $('.upCount').text(obj.up);
          }
          if (obj.down > 0) {
            $('.downCount').text(obj.down);
          }
          // You will get response from your PHP page (what you echo or print)
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
      });
    }
  </script>

  <!-- End Modal -->


  <div class="container" style="font-family: 'Open Sans', sans-serif;">
    <div class="row">


      <?php if (isMobile()) { ?>

        <div class="col-md-3" style="padding:0px;">
          <div class="col-md-12" style="padding:0px;">
            <form method="post" id="form">
              <div id="poll">

              </div>
          </div>
        </div>

      <?php } ?>


      <div class="col-md-2 hidden-xs" style="padding:0px;">
        <div class="col-md-12" style="background:#fff;padding:0px;">
          <div style="padding:20px;">
            <p style="text-align:center;padding-top:10px;padding-bottom: 0px;">
              <img class="img" src="https://www.sweeba.com/grab_image.php?img=<?php echo $sweeb_avatar; ?>" style="min-height:1px;min-width:1px;height:75px;width:75px;border-radius:3px;border-radius:100%;">
            </p>

            <p style="text-align:center;color:#a9acb1;font-size:16px;">
              <center>
                <h4> @<?php echo $sweeb_username; ?></H4>
              </center>
            </p>

          </div>
          <div style="padding:5px;">
            <?php

            if ($is_featured_member == 1  && (strtotime('now') < strtotime($is_expiary_date))) {
              echo '	<button  class="btn btn-success`e2655rwqew2 `" style="background:#707044;border:0px;color:#fff;margin-top:10px;  width: 100%;
      margin-bottom: 5px;">  <img src="images/featured_member.png" width="20px" height="18px"> Featured Member</button>
      ';
            }
            if ($result_membership_count_kulbir > 0) {
              echo '	<a href="https://sweeba.com/upgrade.php" class="btn btn-main" style="background:#a2de5a;border:0px;color:#fff;margin-top:10px;  width: 100%;
    margin-bottom: 5px;"> <img src="images/king_premium.png" width="20px" height="18px" style="margin-top:-4px;"> Premium</a>';
            }
            ?>
            <a href="/<?php echo $sweeb_username; ?>" class="btn btn-main btn-block" style="background:#5fb5f2;border:0px;color:#fff;margin-bottom: 5px;">View Profile</a>
            <!-- <a href="/<?php echo $sweeb_username; ?>" class="btn btn-main btn-block" style="background:#5fb5f2;border:0px;color:#fff;">Follow Me</a> -->
            <form method="post">
              <input type="hidden" name="user_id_follow" value="<?php echo $user_id_sweeb; ?>" />
              <input type="hidden" name="user_name_follow" value="<?php echo $sweeb_username; ?>" />
              <?php if (!in_array($sweeb_id, $os)) { ?>
                <button type="submit" name="follow" class="btn  btn-main btn-block" style="background:#5fb5f2;border:0px;color:#fff;">Follow me</button>
              <?php } else { ?>
                <button type="submit" name="unfollow" class="btn  btn-main btn-block" style="background:#5fb5f2;border:0px;color:#fff;">UnFollow</button>
              <?php } ?>
            </form>

          </div>

          <div style="background:#fff;padding:10px;border-top:0px solid #ebeef1;">
            <p style="text-align:center;">
              <?php

              $title_1 = '';
              $title_2 = '';
              $title_3 = '';
              $link_1 = '';
              $link_2 = '';
              $link_3 = '';
              if (isset($social_links_json) && !empty($social_links_json)) {
                $social_links = json_decode($social_links_json);
                $title_1 = $social_links[0][0];
                $title_2 = $social_links[1][0];;
                $title_3 = $social_links[2][0];;
                $link_1 = $social_links[0][1];
                $link_2 = $social_links[1][1];
                $link_3 = $social_links[2][1];


              ?>

                <center>
                  <h4 style="font-weight: bold">My Links <img src="images/website-link.png" width="32"></h4>
                  <h4 class="overflow"><a href="<?php echo $link_1; ?>" target="_blank"> <?php echo $title_1; ?></a></h4>
                  <h4 class="overflow"><a href="<?php echo $link_2; ?>" target="_blank"> <?php echo $title_2; ?></a></h4>
                  <h4 class="overflow"><a href="<?php echo $link_3; ?>" target="_blank"> <?php echo $title_3; ?></a></h4>
                </center>
              <?php } ?>
          </div>

          <div style="background:#f6f8fa;padding:20px;border-top:1px solid #ebeef1;">
            <p style="text-align:center;">
              <span style="font-size:20px;color:#838990;"><?php echo $sweeb_sweebs; ?></span><br>
              <span style="color:#838990;font-size:12px;">Total Sweebs</span>
            </p>
          </div>
          <div style="background:#fff;padding:20px;border-top:1px solid #ebeef1;">
            <p style="text-align:center;">
              <span style="font-size:20px;color:#838990;"><?php echo $sweeb_comments; ?></span><br>
              <span style="color:#838990;font-size:12px;">Comments Posted</span>
            </p>
          </div>
          <div style="background:#f6f8fa;padding:20px;border-top:1px solid #ebeef1;border-bottom:1px solid #ebeef1;">
            <p style="text-align:center;">
              <span style="font-size:20px;color:#838990;"><?php echo $sweeb_total_friends; ?></span><br>
              <span style="color:#838990;font-size:12px;">Following</span>
            </p>
          </div>

        </div>
      </div>


      <div class="col-md-6">
        <div style="background:#2ecc71;padding:20px;color:#fff;margin-bottom:6px;" id="next-button" style="display:none"><span class="glyphicon glyphicon-cloud" aria-hidden="true"></span> Click "next" to earn more.
          <a href="javascript:void(0)" style="margin-top:-5px;" class="pull-right btn btn-default">Next &raquo;</a>
        </div>



        <div style="background:#fff;">
          <div style="padding:10px;">

            <?php
            if (!isMobile()) {
            ?>
              <div style="padding:25px;padding-top:0px;padding-left:0px;padding-right:0px;">
                <h3 class="os" style="padding:0px;margin:0px;">
                  <?php if ($title == NULL) {
                    echo $sweeb_username;
                  } else {
                    echo $title;
                  }
                  ?>
                </h3>
                <p class="pull-right" style="font-weight:bold;border:2px solid #34495e;color:#34495e;padding:5px;margin-top:-28px;margin-left:5px;"><?php echo $views; ?> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></p>
                <p class="pull-right" style="font-weight:bold;border:2px solid #2ecc71;color:#2ecc71;padding:5px;margin-top:-28px;margin-left:5px;"><?php echo $comments_total; ?> <span class="glyphicon glyphicon-comment" aria-hidden="true"></span></p>
                <p class="pull-right" style="font-weight:bold;border:2px solid #08afee;color:#08afee;padding:5px;margin-top:-28px;"> <?php echo  time2str($datetime, 2); ?></p>
              </div>
            <?php } else { ?>
              <div class="row" style="padding:0px;padding-top:20px;padding-bottom:20px;">
                <div class="col-xs-6"><a href="/' . $sweeb_username . '" style="font-weight:bold;font-size:16px;color:#3e4851;margin-top:-20px;" class="pull-left"><?php echo $sweeb_username; ?></a></div>

                <div class="pull-right" style="font-weight:bold;background:#08afee;color:#fff;padding:5px;border-radius:3px;margin-top:-28px;margin-right:15px;"><?php echo time2str($datetime, 2); ?></div>
              </div>
              <p class="pull-right" style="font-weight:bold;border:2px solid #34495e;color:#34495e;padding:5px;margin-top:-18px;margin-left:5px;"><?php echo $views; ?> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></p>
              <p class="pull-right" style="font-weight:bold;border:2px solid #2ecc71;color:#2ecc71;padding:5px;margin-top:-18px;margin-left:5px;"><?php echo $comments_total; ?> <span class="glyphicon glyphicon-comment" aria-hidden="true"></span></p>
            <?php }

            if ($image_str != NULL) {
            ?>
              <div style="text-align:center;width:100%;">
                <a onclick="return View_Members_Link_Credits();" href="<?php echo $link; ?>" target="_blank" /><img src="https://www.sweeba.com/grab_image.php?img=<?php echo $image_str; ?>" style="min-height:1px;min-width:1px;max-width:90%;"> </a>
              </div>
            <?php } elseif ($video_str != NULL) { ?>
              <div class="visible-xs" style="padding-top:20px;"></div>
              <div class="col-md-12" style="padding:0px;border:0px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;">
                <br>
                <div class="youtubevideo">
                  <center>
                    <iframe src="https://www.youtube.com/embed/<?php echo $video_str; ?>?autoplay=0&showinfo=0&controls=1" width="300" frameborder="0" border="0" allowfullscreen></iframe>
                  </center>
                  </iframe>
                </div>
              </div>
            <?php } ?>
            <h3 class="os visible-xs" style="padding:0px;margin:0px;"><?php echo $row['title']; ?></h3>
            <p style="padding:25px;color:#000;font-family: \'Open Sans\', sans-serif;word-wrap: break-word;font-size:16px;text-shadow:0px 1px 0px #fff;" id="output"><?php echo $content; ?></p>
            <?php if (!empty($link)) { ?>
              <center><a onclick="return View_Members_Link_Credits();" href="<?php echo $link; ?>" target="_blank" class="btn btn-success btn-block" style="width: 200px;" /><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View Link Earn 0.5</a></center>
            <?php  }

            ?>
        <br><br>
            <p class="pull-right" style="font-weight:bold;border:2px solid #2ecc71;color:#2ecc71;padding:5px;margin-top:-25px;margin-left:5px;">
              <a href="report.php?id=<?php echo $sweeb_id_from; ?>" /> Report<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span></a>
            </p>


            <?php if (isMobile()) { ?>

              <div class="row">
                <div class="col-xs-12" style="padding:10px;">
                  <div id="poll">

                    <div class="col-xs-6" style="padding-left:1px;padding:0px;">
                      <div class="up">
                        <button type="button" class="btn btn-link" name="vote" value="up" onclick="getVote(this.value)">
                          <img src="../dist/img/tup.png" style="height:25px;width:25px;margin-top:10px;">
                          <h4 style="color:#5b832b;font-weight:bold;padding:0px;margin:0px;" class="upCount"><?php echo $up_vote; ?></h4>
                        </button>
                      </div>
                    </div>

                    <div class="col-xs-6" style="padding:0px;">
                      <div class="down">
                        <button type="button" class="btn btn-link" name="vote" value="down" onclick="getVote(this.value)">
                          <img src="../dist/img/tdown.png" style="height:25px;width:25px;margin-top:10px;">
                          <h4 style="color:#842d40;font-weight:bold;margin:0px;" class="downCount"><?php echo $down_vote; ?></h4>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>








              <center>

                <div class="col-md-12" style="background:#fff;padding:0px;margin-top:5px;margin-bottom:10px;">
                  <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
                    Members Rank
                  </div>
                  <h4><?php echo $sweeb_username; ?>'s Rank</h4>

                  <?php
                  $legend_image = 'legend.png';
                  $no_of_view_text = '';
                  if ($views > 10000) {
                    $legend_image = 'crown.png';
                    $no_of_view_text = '10,000 + Sweeb Views';
                  } else if ($views > 5000) {
                    $legend_image = 'owl.png';
                    $no_of_view_text = '5,000 + Sweeb views';
                  } else if ($views > 2000) {
                    $legend_image = 'whale.png';
                    $no_of_view_text = '2,000 + Sweeb views';
                  } else if ($views > 1000) {
                    $legend_image = 'star.png';
                    $no_of_view_text = '1,000 + Sweeb views';
                  } else if ($views > 500) {
                    $legend_image = 'doll.png';
                    $no_of_view_text = '500 + Sweeb views';
                  } else if ($views > 100) {
                    $legend_image = 'fish.png';
                    $no_of_view_text = '100 + Sweeb views';
                  } else if ($views > 0 and $views < 99) {
                    $legend_image = 'mushroom.png';
                    $no_of_view_text = '0 to 99 Sweeb views';
                  }
                  ?>
                  <!-- <img src="images/legend.png" > -->
                  <img src="images/<?= $legend_image ?>" width="30"> <b><?= $no_of_view_text ?></b>
                  <br>

                  <div class="col-md-12" style="background:#fff;padding:0px;margin-top:5px;margin-bottom:10px;">
                    <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
                      Leaderboards
                    </div>
                    <p>
                      <img src="dist/img/random5.png" style="height:16px;width:16px;margin-top:-4px;"><a href="leaderboard.php"><span style="color:#5CB85C;font-size:14px;"> Leaderboard</a></span>
                      <font size="4" color="#5CB85C;">⍰</font> <a href="faq.php"><span style="color:#5CB85C;font-size:14px;">How does it Work?</a></span>
                      <br>
                      <font size="3" color="#5CB85C;">🏆</font><a href="leaders.php"><span style="color:#5CB85C;font-size:14px;">Monthly Referral Leaders</a></span>
                      <font size="3" color="#5CB85C;">📊</font><a href="stats_view.php"><span style="color:#5CB85C;font-size:14px;">Stats</a></span>
                    </p>
                  </div>
              </center>
          </div>




          <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">Exposure History</div>
          <center>
            <br>
            <p>
              <span style="color:#838990;font-size:12px;"> Auto-Assign </span>
              <label class="switch">
                <input type="checkbox" <?php if ($on_off_toggle == 'ON') {
                                          echo 'checked';
                                        } ?> id="on_off_toggle">
                <span class="slider2 round"></span>
                <span class="on-off-text">OFF</span>
              </label>
              <br>

              <span style="color:#838990;font-size:10px;">Next Reward : </span><span style="font-size:12px;color:#838990;"><b><?php echo $countDown; ?> sweebs</span> </b>
              <br>

              <span style="color:#838990;font-size:10px;">Available credits : </span> <span style="font-size:12px;color:#838990;"><b><?php echo $availbale_exposure_earn; ?> </span></b>
              <br>
              <span style="color:#838990;font-size:10px;">Views received : </span> <span style="font-size:12px;color:#838990;"><b><?php echo $Exposure_views_received; ?> </span></b>
              <br>
              <span style="color:#838990;font-size:10px;">Total earned : </span> <span style="font-size:12px;color:#838990;"><b><?php echo $exposure_earn; ?> </b></span>
            </p>
            <br>
          </center>


        <?php } ?>


        </div>
        <div style="background:#eef0f2;">
          <div style="padding:20px;">
            <form method="post">
              <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo $Err;
              } ?>
              <input type="hidden" name="id_comment" value="<?php echo $sweeb_id_from; ?>">
              <textarea class="form-control" name="comment" style="border:1px solid #d3dce5;box-shadow:none;border-radius:0px;" rows="3"></textarea>
              <br>
              <button type="submit" class="btn btn-main" style="background:#5fb5f2;border:0px;color:#fff;">Post</button>
            </form>
          </div>


          <div class="col-md-12" style="padding:0px;margin-bottom:50px;">
            <?php
            $sql = "SELECT * FROM comments WHERE sweeb_id='$sweeb_id_from' ORDER BY id DESC";
            $result = $conn->query($sql);
            if ($result->num_rows >= 1) {
              // output data of each row
              while ($row = $result->fetch_assoc()) {
                $user_post_id = $row['user_id'];
                $datetime = strtotime($row['date']);
                echo '<div class="text">';
                echo '<p class="pull-left"><a href="/' . $row['username'] . '"><b>' . $row['username'] . '</b></a></p><p class="pull-right"><b>';
                echo time2str($datetime, 2);
                if ($user_id == $user_post_id) {
                  echo ' | <a href="/edit_comment.php?id=' . $row['id'] . '"> (Edit)</a>';
                }
                echo '</b></p><Br><hr />';
                echo '<p style="font-family: \'Open Sans\', sans-serif;word-break: break-all;font-size:14px;">' . $row['comment'] . '</p>';
                echo '</div>';
              }
            }
            ?>

          </div>
        </div>
      </div>
    </div>

    <?php if (!isMobile()) { ?>

      <div class="col-md-3" style="padding:0px;">
        <div class="col-md-12" style="padding:0px;">
          <center>
            <div class="cloud">
              <p style="margin-top: 0px;display: inline-block;">
                <span style="color:#838990;font-size:14px;"> Auto-Assign </span>
                <label class="switch">
                  <input type="checkbox" <?php if ($on_off_toggle == 'ON') {
                                            echo 'checked';
                                          } ?> id="on_off_toggle">
                  <span class="slider round"></span>
                  <span class="on-off-text">OFF</span>
                </label>
              </p>
              <p><span style="color:#838990;font-size:14px;">Next Reward : </span><span style="font-size:16px;color:#838990;"><b><?php echo $countDown; ?> sweebs</span></b></p>
              <p><span style="color:#838990;font-size:14px;">Available credits : </span> <span style="font-size:16px;color:#838990;"><b><?php echo $availbale_exposure_earn; ?> </span></b></p>
              <p><span style="color:#838990;font-size:14px;">Views received : </span> <span style="font-size:16px;color:#838990;"><b><?php echo $Exposure_views_received; ?> </span></b></p>
              <p><span style="color:#838990;font-size:14px;">Total earned : </span> <span style="font-size:16px;color:#838990;"><b><?php echo $exposure_earn; ?> </b></span></p>
              <p>
              <div class="btn btn-success">
                <a id="smallLinkButton" href="purchase.php">
                  <font size="2" face="verdana" color="white"> Buy credits </font>
                </a>
              </div>

              <div class="btn btn-success">
                <a id="smallLinkButton" href="upgrade.php">
                  <font size="2" face="verdana" color="white"> Upgrade </font>
                </a>
              </div>
              </p>
            </div>
          </center>

          <div id="poll">
            <div class="col-md-6" style="padding-left:1px;padding:0px; ">
              <div class="up">
                <button type="button" class="btn btn-link" name="vote" value="up" onclick="getVote(this.value)">
                  <img src="../dist/img/tup.png" style="height:25px;width:25px;margin-top:10px;">
                  <h4 style="color:#5b832b;font-weight:bold;padding:0px;margin:0px;" class="upCount"><?php echo $up_vote; ?></h4>
                </button>
              </div>
            </div>

            <div class="col-md-6" style="padding:0px;">
              <div class="down">
                <button type="button" class="btn btn-link" name="vote" value="down" onclick="getVote(this.value)">
                  <img src="../dist/img/tdown.png" style="height:25px;width:25px;margin-top:10px;">
                  <h4 style="color:#842d40;font-weight:bold;margin:0px;" class="downCount"><?php echo $down_vote; ?></h4>
                </button>
              </div>
            </div>
          </div>

          <center>

            <div class="col-md-12 hidden-xs" style="background:#fff;padding:0px;margin-top:5px;margin-bottom:10px;">
              <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
                Leaderboards
              </div>
              <p>
                <img src="dist/img/random5.png" style="height:16px;width:16px;margin-top:-4px;"><a href="leaderboard.php"><span style="color:#5CB85C;font-size:14px;"> Leaderboard</a></span>
                <font size="4" color="#5CB85C;">⍰</font> <a href="faq.php"><span style="color:#5CB85C;font-size:14px;">How does it Work?</a></span>
                <br>
                <font size="3" color="#5CB85C;">🏆</font><a href="leaders.php"><span style="color:#5CB85C;font-size:14px;">Referral Leaders</a></span>

                <font size="3" color="#5CB85C;">📊</font><a href="stats_view.php"><span style="color:#5CB85C;font-size:14px;">Stats</a></span>

              </p>

            </div>

            <div class="col-md-12 hidden-xs" style="background:#fff;padding:0px;margin-top:5px;margin-bottom:10px;">
              <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
                Members Rank
              </div>
              <h4><?php echo $sweeb_username; ?>'s Rank</h4>

              <?php
              $legend_image = 'legend.png';
              $no_of_view_text = '';
              if ($views > 10000) {
                $legend_image = 'crown.png';
                $no_of_view_text = '10,000 + Sweeb Views';
              } else if ($views > 5000) {
                $legend_image = 'owl.png';
                $no_of_view_text = '5,000 + Sweeb views';
              } else if ($views > 2000) {
                $legend_image = 'whale.png';
                $no_of_view_text = '2,000 + Sweeb views';
              } else if ($views > 1000) {
                $legend_image = 'star.png';
                $no_of_view_text = '1,000 + Sweeb views';
              } else if ($views > 500) {
                $legend_image = 'doll.png';
                $no_of_view_text = '500 + Sweeb views';
              } else if ($views > 100) {
                $legend_image = 'fish.png';
                $no_of_view_text = '100 + Sweeb views';
              } else if ($views > 0 and $views < 99) {
                $legend_image = 'mushroom.png';
                $no_of_view_text = '0 to 99 Sweeb views';
              }
              ?>
              <!-- <img src="images/legend.png" > -->
              <img src="images/<?= $legend_image ?>" width="30"> <b><?= $no_of_view_text ?></b>
              <br><br>
          </center>
          <br><br>
        </div>
      </div>


    <?php } ?>

  </div>

  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="/dist/js/bootstrap.min.js"></script>
  <?php /*
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js">
</script>
<?php */ ?>


  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-7LHWPPZECB"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-7LHWPPZECB');
    $('#next-button').hide();
    // Wait for 8 seconds and then hide the element
    setTimeout(function() {
      $('#next-button').css('display', 'block');
    }, 8000); // 8000 milliseconds = 8 seconds
  </script>
  <script>
    $(document).ready(function() {
      $('.switch input').change(function() {
        var isChecked = $(this).prop('checked');
        var onOffText = isChecked ? 'ON' : 'OFF';
        $('.on-off-text').text(onOffText);

        // Make an AJAX request to store toggle value in session
        $.ajax({
          type: "POST",
          url: "ajax_custom.php", // Create this file for server-side verification
          data: {
            on_off_toggle: onOffText
          },
          success: function(response) {
            // null
          }
        });
      });
      var on_off_toggle = $('#on_off_toggle').prop('checked');
      var onOffText = on_off_toggle ? 'ON' : 'OFF';
      $('.on-off-text').text(onOffText);


      $('#next-button').click(function() {
        var next_sweeb_ajax = 1;
        // Make an AJAX request to store toggle value in session
        $.ajax({
          type: "POST",
          url: "ajax_custom.php", // Create this file for server-side verification
          data: {
            next_sweeb_ajax: next_sweeb_ajax
          },
          success: function(response) {
            location.reload();
          }
        });
      });



    });

    // Disable scroll restoration
    if ('scrollRestoration' in history) {
      history.scrollRestoration = 'manual';
    }

    function View_Members_Link_Credits() {
      var view_members_link_credits = 1;
      $.ajax({
        method: 'POST',
        url: 'ajax_custom.php',
        data: {
          view_members_link_credits: view_members_link_credits
        },
        success: function(response) {
          location.reload();
        }
      });
    }
  </script>


  <?php if ($_SESSION['captcha_count'] > $captcha_count && $_SESSION['captcha_verify'] == false) { ?>
    <!-- Modal -->
    <div id="recaptcha_model" class="modal fade" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Verify re-captcha</h4>
          </div>
          <div class="modal-body">
            <form id="captchaForm">
              <label for="captcha">Enter the letters (LOWER CASE):</label><br />
              <img id="captchaImage" src="captcha.php" alt="CAPTCHA Image"> <i class="fa fa-refresh" aria-hidden="true" id="refreshCaptcha" style="cursor:pointer">Refresh</i><br />
              <input type="text" id="captchaInput" name="captchaInput" placeholder="Enter verification code"><br />
              <Br>
              <button type="submit" class="btn btn-success">Submit</button>
            </form>
          </div>

        </div>

      </div>
    </div>


    <script>
      $(document).ready(function() {
        $('#recaptcha_model').modal('show');
        // Refresh the CAPTCHA image
        $("#refreshCaptcha").click(function() {
          // Add a timestamp or a random parameter to the URL to prevent caching
          var timestamp = new Date().getTime();
          $("#captchaImage").attr("src", "captcha.php?" + timestamp);
        });

        // Validate the CAPTCHA on form submission
        $("#captchaForm").submit(function(event) {
          event.preventDefault();

          // Make an AJAX request to validate the entered code
          $.ajax({
            type: "POST",
            url: "verify_captcha.php", // Create this file for server-side verification
            data: {
              captchaInput: $("#captchaInput").val()
            },
            success: function(response) {
              if (response === "success") {
                alert("CAPTCHA verification successful!");
                location.reload();
              } else {
                alert("CAPTCHA verification failed. Please try again.");
              }
            }
          });
        });
      });
    </script>
  <?php } ?>
  </body>

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-7LHWPPZECB"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-7LHWPPZECB');
  </script>

  </html>