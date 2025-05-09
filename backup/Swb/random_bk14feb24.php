<?php include('main/config.php');
$get_sweeb_id = strip_tags($_GET["id"]);
$sweeb_title = strip_tags($_GET["t"]);
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

checkLogin();

$os = explode(",", $friends);

// follow unfollow code start here

if(isset($_POST['follow'])){
  $todayDate=strtotime(date('Y-m-d'));
  $user_id_follow=$_POST['user_id_follow'];
  $user_name_follow=$_POST['user_name_follow'];
  if (!in_array($user_id_follow, $os)) {
  $friends_new = ''.$friends.','.$user_id_follow.'';
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
   $_SESSION['follow_unfollow_mesage']="You are now following <strong>".$user_name_follow."</strong>";
  
  
  }
  
  }elseif(isset($_POST['unfollow'])){
  //if (in_array($user_id_follow, $os)) {
  
    $user_id_follow=$_POST['user_id_follow'];
    $user_name_follow=$_POST['user_name_follow'];

  $friends_new = str_replace(','.$user_id_follow.'','',''.$friends.'');
  $follows_new = str_replace(','.$user_id_sess.'','',''.$follows_user.'');
  $sql = "UPDATE members SET friends='$friends_new' WHERE id='$user_id_sess'";
  $conn->query($sql);
  
  $sqls = "UPDATE members SET followers=followers-1, follows='$follows_new' WHERE id='$user_id_follow' Limit 1";
  $conn->query($sqls);
  
  $_SESSION['follow_unfollow_mesage']="You are now un-following <strong>".$user_name_follow."</strong>";

  
  
  }

// follow unfollow code start end






function slugify($text)
{ 
  // replace non letter or digits by -
  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
  // trim
  $text = trim($text, '-');
  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  // lowercase
  $text = strtolower($text);
  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);
  if (empty($text))
  {
    return 'n-a';
  }

  return $text;
}
function limit_text($text, $limit) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]) . '...';
       
      }
      return $text;
    }
function time2str($ts)
{
    if(!ctype_digit($ts)){
        $ts = strtotime($ts);
    }

    $diff = time() - $ts;
    if($diff == 0)
        return 'now';
    elseif($diff > 0)
    {
        $day_diff = floor($diff / 86400);
        if($day_diff == 0)
        {
            if($diff < 60) return 'just now';
            if($diff < 120) return '1 minute ago';
            if($diff < 3600) return floor($diff / 60) . ' minutes ago';
            if($diff < 7200) return '1 hour ago';
            if($diff < 86400) return floor($diff / 3600) . ' hours ago';
        }
        if($day_diff == 1) return 'Yesterday';
        if($day_diff < 7) return $day_diff . ' days ago';
        if($day_diff < 31) return ceil($day_diff / 7) . ' weeks ago';
        if($day_diff < 60) return 'last month';
        return date('F Y', $ts);
    }
    else
    {
        $diff = abs($diff);
        $day_diff = floor($diff / 86400);
        if($day_diff == 0)
        {
            if($diff < 120) return 'in a minute';
            if($diff < 3600) return 'in ' . floor($diff / 60) . ' minutes';
            if($diff < 7200) return 'in an hour';
            if($diff < 86400) return 'in ' . floor($diff / 3600) . ' hours';
        }
        if($day_diff == 1) return 'Tomorrow';
        if($day_diff < 4) return date('l', $ts);
        if($day_diff < 7 + (7 - date('w'))) return 'next week';
        if(ceil($day_diff / 7) < 4) return 'in ' . ceil($day_diff / 7) . ' weeks';
        if(date('n', $ts) == date('n') + 1) return 'next month';
        return date('F Y', $ts);
    }
}



$todayDate=strtotime(date('Y-m-d'));
// reffrel on 50 pages surf
if(!isset($_SESSION['todayReffle'][$todayDate])){
    $_SESSION['todayReffle'][$todayDate]=0;
}
$_SESSION['todayReffle'][$todayDate]=$_SESSION['todayReffle'][$todayDate]+1;
if($_SESSION['todayReffle'][$todayDate]>=50){
    $earn_ref='0.00';
    $sql = "SELECT * FROM members WHERE id='$user_id_sess'";
    $result = $conn->query($sql);
    $userCurrentBalanc=$result->fetch_assoc();
    $updateBalance=$userCurrentBalanc['balance']+$earn_ref;

    $sql = "UPDATE members SET balance='$updateBalance' WHERE id='$user_id_sess'";
   mysqli_query($conn, $sql);
    $_SESSION['todayReffle'][$todayDate]=0;
    
}





// $sql_rotation = "SELECT *  FROM exposure WHERE user_id!='$user_id_sess' AND `credit_useOn_sweeba` IS NOT NULL ORDER BY rand() Limit 1";
// $sql_rotation_result = $conn->query($sql_rotation);
// $row_get_sweeb = $sql_rotation_result->fetch_assoc();
//print_r($row_get_sweeb['id']);
//die;
//$sql = "SELECT *  FROM `exposure` WHERE `credit_useOn_sweeba` IS NOT NULL GROUP BY `credit_useOn_sweeba`;

$sql_rotation = "SELECT `credit_useOn_sweeba` FROM exposure WHERE user_id != '$user_id_sess' AND `credit_useOn_sweeba` IS NOT NULL GROUP BY `credit_useOn_sweeba`";
$sql_rotation_result = $conn->query($sql_rotation);

if ($sql_rotation_result) {
    $rows = $sql_rotation_result->fetch_all(MYSQLI_ASSOC);

    foreach ($rows as $row) {
        // Access the 'credit_useOn_sweeba' column for each row
        $credit_useOn_sweeba[]= $row['credit_useOn_sweeba'];
    }
} else {
    echo "Error executing query: " . $conn->error;
}
$userIdsString = implode(',', $credit_useOn_sweeba);
  $sql_rotation = "SELECT *  FROM exposure WHERE user_id!='$user_id_sess' AND `credit_useOn_sweeba` IN ($userIdsString) ORDER BY rand() Limit 1";
$sql_rotation_result = $conn->query($sql_rotation);
$row_get_sweeb = $sql_rotation_result->fetch_assoc();
//print_r($row_get_sweeb['credit_useOn_sweeba']);die;

  $sql = "SELECT *  FROM sweebs WHERE id=".$row_get_sweeb['credit_useOn_sweeba'];

//die;
$result = $conn->query($sql);
if (!$result) {
  echo "Error executing query: " . $conn->error;
}
if ($result->num_rows == 0) {
header("Location: random.php");
die();
} 

 // output data of each row
while($row = $result->fetch_assoc()) {
$user_id_sweeb = $row['user_id'];
$sweeb_id_from = $row['id'];
$image_str = $row['image'];
$met_img = $row['image'];
$sq = "SELECT *  FROM members WHERE id = '$user_id_sweeb'";
$resul = $conn->query($sq);
while($ro = $resul->fetch_assoc()) {
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
    $link=$row['link'];
    $uncode_c = $row['content'];
    $uncode_c = preg_replace("/<!--.*?-->/", "", $uncode_c);
    $uncode_c = strip_tags($uncode_c);
    
    $content = htmlspecialchars_decode($content, ENT_NOQUOTES);
    $words1 = str_word_count($content);

    $video_str = $row['video'];
    $title = $row['title'];
    
    if($title == NULL){
    if($words1 <= '1'){
    $content = substr($content, 0, 10);
    }
    $slug_go = limit_text($content,5);
    $slug_go = substr($content, 0, 20);
    $slug_go = slugify($slug_go);
    }else{
    $slug_go = slugify($title);
    }
    
    $comments_total = $row['comments'];
    
// no more info on sweeb
}


// check subscription query---->
$dateToday = date('Y-m-d');
$sql_membership ="SELECT * FROM subscription where user_id='".$user_id_sweeb."' AND expire_date > '".$dateToday."' AND status='Success'";
$result_membership = $conn->query($sql_membership);
$result_membership_count_kulbir=$result_membership->num_rows;

include('main/add_comment.php');

if($user_id != NULL){
$sql = "SELECT id, type FROM likes WHERE user_id='$user_id' AND sweeb_id='$sweeb_id_from'";
$result = $conn->query($sql);
if ($result->num_rows >= 1) {
// output data of each row
while($row = $result->fetch_assoc()) {
$vote_id = $row['id'];
$vote_type = $row['type'];
}
}else{
$gave_like = 'no';
}
}else{
$gave_like = 'no';
}

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
$last_view=date('Y-m-d');
$sql = "UPDATE sweebs SET views=views+1, last_view='$last_view' WHERE id='$sweeb_id_from'";
$conn->query($sql);
?>
<?php
include('main/header.php');

//exposure 
$total_used_exposure=0;
 $sql = "SELECT * FROM exposure WHERE user_id='$user_id_sess' AND sweeba_id='$sweeb_id_from'";
$result = $conn->query($sql);
if ($user_id_sess>0) {
    $post_by_user=$user_id_sweeb;
    $sweeba_id=$sweeb_id_from;
    if($result_membership_count>0){
      $exposure_earn=0.75;
      $exposure_earn_message=1.5;
    }else{
      $exposure_earn=0.5;
      $exposure_earn_message=1;

    }
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

<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link href="/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css">

  <div class="wrap" style="margin-top:0px;">

<?php if ((int) $exposure_earn == $exposure_earn) {
  $exposure_message= "You earned ".$exposure_earn_message." exposure credit.";
 ?>        
   <div style="background:#2ecc71;padding:10px;color:#fff;margin-bottom: 10px"><img src="dist/img/ticketssmall.png" style="height:20px;width:20px"> <?php echo $exposure_message; ?></div>
<?php } ?>

<?php 


//if($_SESSION['captcha_verify']==true){  // if captcha verified then insert data end here

$captcha_count=20;
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
while($exposure_history_row = $exposure_history_result->fetch_assoc()) {
   // echo $exposure_history_row['id'];
    if($loop_update==0 || $loop_update==1){
    $sql_update_expo = "UPDATE exposure SET credit_useOn_sweeba='".$last_sweeb[0]."' WHERE id=".$exposure_history_row['id'];
     $conn->query($sql_update_expo);

    }
    if($loop_update==2 || $loop_update==3){
    $sql_update_expo = "UPDATE exposure SET credit_useOn_sweeba='".$last_sweeb[1]."' WHERE id=".$exposure_history_row['id'];
     $conn->query($sql_update_expo);

    }
    $loop_update++;
 }
}
$availbale_exposure_earn=$availbale_exposure_earn-(count($credit_useOn_sweeba)/2);
 $sql = "SELECT * FROM exposure WHERE post_by_user='$user_id_sess'";
$result = $conn->query($sql);
$Exposure_views_received=$result->num_rows;

//They will receive this bonus after 25, 50, 75, 100, 125, 150, 175, etc etc start
     $sql = "SELECT * FROM members WHERE id='$user_id_sess'";
    $result = $conn->query($sql);
    $userdetails=$result->fetch_assoc();
    $_SESSION['countDown'][$todayDate]=$_SESSION['countDown'][$todayDate]+1;
    $_SESSION['captcha_count']=$_SESSION['captcha_count']+1;
    $countDown= $userdetails['next_exp_target']-$_SESSION['countDown'][$todayDate];
     if($countDown==0){
      $next_exp_target=$userdetails['next_exp_target'];
      $countDown= $next_exp_target;
      $sql = "UPDATE members SET next_exp_target='$next_exp_target' WHERE id='$user_id_sess'";
       mysqli_query($conn, $sql);
       $post_by_user = $user_id_sess;
        $sweeba_id=0;
        $exposure_earn_bonus=5;
        $created_at=date('Y-m-d H:i:s');
         $insert_logs = "INSERT INTO exposure (user_id, post_by_user, sweeba_id, exposure_earn, created_at) VALUES ('$user_id_sess', '$post_by_user', '$sweeba_id', '$exposure_earn_bonus','$created_at')";
         $conn->query($insert_logs);
         $_SESSION['countDown'][$todayDate]=0;

     }
      if($_SESSION['captcha_count']>$captcha_count){
                 $_SESSION['captcha_verify']=false;

      }

//} // if captcha verified then insert data end here


 if ($_SESSION['countDown'][$todayDate]==0) {
  $exposure_message= "You earned 5 exposure credits as a bonus!";
 ?>        
 <div style="background:#2ecc71;padding:10px;color:#fff;margin-bottom: 10px"><img src="dist/img/notify.png" style="height:16px;width:16px"> <?php echo $exposure_message; ?></div>
<?php } ?>


<?php if(isset($_SESSION['follow_unfollow_mesage'])){ ?>
  <div style="background:#2ecc71;padding:10px;color:#fff;margin-bottom: 10px"><img src="dist/img/notify.png" style="height:16px;width:16px"> <?php echo $_SESSION['follow_unfollow_mesage']; ?></div>
<?php 
unset($_SESSION['follow_unfollow_mesage']);
} 
?>


<?php 
$exposure_message_premium='';
//Premium members get 500 credits monthly
if(empty($exposure_message)){
  // Get the current month and year
  $dateToday=date('Y-m-d');
  $sql_membership ="SELECT * FROM subscription where user_id='".$user_id_sess."' AND expire_date > '".$dateToday."' AND status='Success'";
    $result_membership = $conn->query($sql_membership);
    $result_membership_count=$result_membership->num_rows;
    if($result_membership_count>0){
      $currentMonth = date('m');
      $currentYear = date('Y');
     $query = "SELECT * FROM exposure WHERE user_id=".$user_id_sess." AND exposure_earn='500' AND MONTH(created_at) = $currentMonth AND YEAR(created_at) = $currentYear";
     $verify_query = $conn->query($query);
      $verify_query_num=$verify_query->num_rows;
    if($verify_query_num==0){
      $post_by_user = $user_id_sess;
        $sweeba_id=0;
        $exposure_earn_bonus=500;
        $created_at=date('Y-m-d H:i:s');
         $insert_logs = "INSERT INTO exposure (user_id, post_by_user, sweeba_id, exposure_earn, created_at) VALUES ('$user_id_sess', '$post_by_user', '$sweeba_id', '$exposure_earn_bonus','$created_at')";
         $conn->query($insert_logs);
         $exposure_message_premium= "Congratulations!! Your 500 monthly exposure credits have been added as a premium member.";
        $exposure_earn=$exposure_earn_bonus+$exposure_earn;
    }


    }



}



if (!empty($exposure_message_premium)) {
 ?>        
    <div style="background:#2ecc71;padding:10px;color:#fff;margin-bottom: 10px"><img src="dist/img/notify.png" style="height:16px;width:16px"> <?php echo $exposure_message_premium; ?></div>
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


function getVote(int){
    $.ajax({
        url: "/main/like_sweeb.php?id="+<?php echo $sweeb_id_from; ?>+"&vote="+int,
        type: "GET",
        data: {} ,
        success: function (response) {
     // console.log(response);
         var obj = jQuery.parseJSON(response);
         if(obj.up>0){
           $('.upCount').text(obj.up);
         }
         if(obj.down>0){
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
 


<?php if(isMobile()){ ?>


<div class="col-md-3" style="padding:0px;">
<div class="col-md-12" style="padding:0px;">
<form method="post" id="form">
<div id="poll">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">Exposure History</div>
<center>
<p>
<span style="color:#838990;font-size:10px;">Next Reward in :  </span><span style="font-size:12px;color:#838990;"><b><?php echo $countDown;?> sweebs</span> </b>
<br>

<span style="color:#838990;font-size:10px;">Total exposure views :  </span><span style="font-size:12px;color:#838990;"><b><?php echo $row_view_exposure; ?></span> </b>
<br>
<span style="color:#838990;font-size:10px;">Available exposure credits : </span> <span style="font-size:12px;color:#838990;"><b><?php echo $availbale_exposure_earn;?>  </span></b>
<br>
<span style="color:#838990;font-size:10px;">Exposure views received : </span> <span style="font-size:12px;color:#838990;"><b><?php echo $Exposure_views_received;?>  </span></b>
<br>
<span style="color:#838990;font-size:10px;">Total earned : </span> <span style="font-size:12px;color:#838990;"><b><?php echo $exposure_earn;?> </b></span>
</p>
</center>


<?php } ?>


<div class="col-md-2 hidden-xs" style="padding:0px;">
<div class="col-md-12" style="background:#fff;padding:0px;">
<div style="padding:20px;">
<p style="text-align:center;padding-top:10px;padding-bottom: 0px;">
<img class="img" src="https://www.sweeba.com/grab_image.php?img=<?php echo $sweeb_avatar; ?>" style="min-height:1px;min-width:1px;height:75px;width:75px;border-radius:3px;border-radius:100%;">
</p>

<p style="text-align:center;color:#a9acb1;font-size:16px;"><center><h4> @<?php echo $sweeb_username; ?></H4></center></p>

</div>
<div style="padding:5px;">
<?php

  if($is_featured_member == 1  && (strtotime('now')<strtotime($is_expiary_date))){
      echo '	<button  class="btn btn-success`e2655rwqew2 `" style="background:#707044;border:0px;color:#fff;margin-top:10px;  width: 100%;
      margin-bottom: 5px;">  <img src="images/featured_member.png" width="20px" height="18px"> Featured Member</button> 
      ';
  }
  if($result_membership_count_kulbir > 0){
    echo '	<a href="https://sweeba.com/upgrade.php" class="btn btn-main" style="background:#a2de5a;border:0px;color:#fff;margin-top:10px;  width: 100%;
    margin-bottom: 5px;"> <img src="images/king_premium.png" width="20px" height="18px"> Premium</a>';
  }
?>
<a href="/<?php echo $sweeb_username; ?>" class="btn btn-main btn-block" style="background:#5fb5f2;border:0px;color:#fff;margin-bottom: 5px;">View Profile</a>
<!-- <a href="/<?php echo $sweeb_username; ?>" class="btn btn-main btn-block" style="background:#5fb5f2;border:0px;color:#fff;">Follow Me</a> -->
<form method="post">
<input type="hidden" name="user_id_follow" value="<?php echo $user_id_sweeb;?>"/>
<input type="hidden" name="user_name_follow" value="<?php echo $sweeb_username; ?>"/>
<?php if(!in_array($sweeb_id, $os)){ ?>
<button type="submit" name="follow" class="btn  btn-main btn-block" style="background:#5fb5f2;border:0px;color:#fff;">Follow me</button>
<?php }else{ ?>
<button type="submit" name="unfollow" class="btn  btn-main btn-block" style="background:#5fb5f2;border:0px;color:#fff;">UnFollow</button>
<?php } ?>
</form>

</div>

<div style="background:#fff;padding:20px;border-top:0px solid #ebeef1;">
<p style="text-align:center;">


<?php 

$title_1='';
$title_2='';
$title_3='';
$link_1='';
$link_2='';
$link_3='';
if(isset($social_links_json) && !empty($social_links_json)){
    $social_links=json_decode($social_links_json);
    $title_1=$social_links[0][0];
    $title_2=$social_links[1][0];;
    $title_3=$social_links[2][0];;
    $link_1=$social_links[0][1];
    $link_2=$social_links[1][1];
    $link_3=$social_links[2][1];


?>

<center>

<h4 style="font-weight: bold">My Links <img src="images/website-link.png" width="32"></h4>
<h4><a href="<?php echo $link_1; ?>" target="_blank"> <?php echo $title_1; ?></a></h4>
<h4><a href="<?php echo $link_2; ?>" target="_blank"> <?php echo $title_2; ?></a></h4>
<h4><a href="<?php echo $link_3; ?>" target="_blank"> <?php echo $title_3; ?></a></h4>
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
<div style="background:#2ecc71;padding:20px;color:#fff;margin-bottom:6px;" id="next-button" style="display:none">Click "next" to earn more.<a href="random.php" style="margin-top:-5px;" class="pull-right btn btn-default">Next &raquo;</a></div>
 





<div style="background:#fff;">
<div style="padding:10px;">
<?php
if(!isMobile()){
echo '<div style="padding:25px;padding-top:0px;padding-left:0px;padding-right:0px;"><h3 class="os" style="padding:0px;margin:0px;">';
if($title == NULL){
echo $sweeb_username;
}else{
   echo $title;
}
echo '</h3>';
echo '<p class="pull-right" style="font-weight:bold;border:2px solid #34495e;color:#34495e;padding:5px;margin-top:-28px;margin-left:5px;">'.$views.' <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></p>';
echo '<p class="pull-right" style="font-weight:bold;border:2px solid #2ecc71;color:#2ecc71;padding:5px;margin-top:-28px;margin-left:5px;">'.$comments_total.' <span class="glyphicon glyphicon-comment" aria-hidden="true"></span></p>';
echo '<p class="pull-right" style="font-weight:bold;border:2px solid #08afee;color:#08afee;padding:5px;margin-top:-28px;">'.time2str($datetime, 2).'</p></div>';
}else{
echo '<div class="row" style="padding:0px;padding-top:20px;padding-bottom:20px;">
<div class="col-xs-6"><a href="/'.$sweeb_username.'" style="font-weight:bold;font-size:16px;color:#3e4851;margin-top:-20px;" class="pull-left">'.$sweeb_username.'</a></div>';

echo '<div class="pull-right" style="font-weight:bold;background:#08afee;color:#fff;padding:5px;border-radius:3px;margin-top:-28px;margin-right:15px;">'.time2str($datetime, 2).'</div></div>';
echo '<p class="pull-right" style="font-weight:bold;border:2px solid #34495e;color:#34495e;padding:5px;margin-top:-18px;margin-left:5px;">'.$views.' <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></p>';
echo '<p class="pull-right" style="font-weight:bold;border:2px solid #2ecc71;color:#2ecc71;padding:5px;margin-top:-18px;margin-left:5px;">'.$comments_total.' <span class="glyphicon glyphicon-comment" aria-hidden="true"></span></p>';

}
    if($image_str != NULL){
    
echo '<div style="text-align:center;width:100%;">';
echo '<img src="https://www.sweeba.com/grab_image.php?img='.$image_str.'" style="min-height:1px;min-width:1px;max-width:100%;"></div>';
   }elseif($video_str != NULL){
    echo '<div class="visible-xs" style="padding-top:20px;"></div>';
    echo '<div class="col-md-12" style="padding:0px;border:1px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;">
 <div class="youtubevideo">
    <iframe src="https://www.youtube.com/embed/'.$video_str.'?autoplay=0&showinfo=0&controls=1"  frameborder="0"  border="0" allowfullscreen></iframe>
</iframe></div><br>
    </div>';
    }
echo '<h3 class="os visible-xs" style="padding:0px;margin:0px;">'.$row['title'].'</h3><p style="padding:25px;color:#000;font-family: \'Open Sans\', sans-serif;word-wrap: break-word;font-size:16px;text-shadow:0px 1px 0px #fff;" id="output">'.$content.'</p>';
if(!empty($link)){
 echo '<center><a href="'.$link.'" target="_blank" class="btn btn-success btn-block" style="width: 200px;"/>View Members Link</a></center>';
}

?>


<?php if(isMobile()){ ?>

<div class="row">
<div class="col-xs-12" style="padding:10px;">
<div id="poll">

<div class="col-xs-6" style="padding-left:1px;padding:0px;">
<div class="up">
<button type="button" class="btn btn-link" name="vote" value="up" onclick="getVote(this.value)">
<img src="../dist/img/tup.png" style="height:25px;width:25px;margin-top:10px;">
<h4 style="color:#5b832b;font-weight:bold;padding:0px;margin:0px;" class="upCount"><?php echo $up_vote; ?></h4>
</button>
</div></div>

<div class="col-xs-6" style="padding:0px;">
<div class="down">
 <button type="button" class="btn btn-link" name="vote" value="down" onclick="getVote(this.value)">
<img src="../dist/img/tdown.png" style="height:25px;width:25px;margin-top:10px;">
<h4 style="color:#842d40;font-weight:bold;margin:0px;" class="downCount"><?php echo $down_vote; ?></h4>
</button>
</div></div></div></div></div>
<?php } ?>

</div>
<div style="background:#eef0f2;">
<div style="padding:20px;">
<form method="post">
<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { echo $Err; } ?>
<input type="hidden" name="id_comment" value="<?php echo $sweeb_id_from; ?>">
<textarea class="form-control" name="comment" style="border:1px solid #d3dce5;box-shadow:none;border-radius:0px;" rows="3"></textarea>
<br>
<button type="submit" class="btn btn-main" style="background:#5fb5f2;border:0px;color:#fff;">Post</button>
</form>

</div>

<style>
.text:nth-child(odd)
{
    
    background:#fff;
    padding:20px;
}
.text:nth-child(even)
{ 
    background:#eef0f2;
    padding:20px;
}
</style>

<div class="col-md-12" style="padding:0px;margin-bottom:50px;">
<?php
$sql = "SELECT * FROM comments WHERE sweeb_id='$sweeb_id_from' ORDER BY id DESC";
$result = $conn->query($sql);
if ($result->num_rows >= 1) {
// output data of each row
while($row = $result->fetch_assoc()) {
$user_post_id = $row['user_id'];
$datetime = strtotime($row['date']);  
echo '<div class="text">';
echo '<p class="pull-left"><a href="/'.$row['username'].'"><b>'.$row['username'].'</b></a></p><p class="pull-right"><b>';
echo time2str($datetime, 2);
if($user_id == $user_post_id){
echo ' | <a href="/edit_comment.php?id='.$row['id'].'"> (Edit)</a>';
}
echo '</b></p><Br><hr />';
echo '<p style="font-family: \'Open Sans\', sans-serif;word-break: break-all;font-size:14px;">'.$row['comment'].'</p>';
echo '</div>';

}
}
?>

</div>
</div>
</div>

</div>





<?php if(!isMobile()){ ?>

<div class="col-md-3" style="padding:0px;">
<div class="col-md-12" style="padding:0px;">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">Exposure History</div>

<center>

<p><span style="color:#838990;font-size:14px;">Next Reward in :  </span><span style="font-size:20px;color:#838990;"><b><?php echo $countDown;?> sweebs</span> </b></p>
<p><span style="color:#838990;font-size:14px;">Total exposure views :  </span><span style="font-size:20px;color:#838990;"><b><?php echo $row_view_exposure; ?></span> </b></p>
<p><span style="color:#838990;font-size:14px;">Available exposure credits : </span> <span style="font-size:20px;color:#838990;"><b><?php echo $availbale_exposure_earn;?>  </span></b></p>
<p><span style="color:#838990;font-size:14px;">Exposure views received : </span> <span style="font-size:20px;color:#838990;"><b><?php echo $Exposure_views_received;?>  </span></b></p>
<p><span style="color:#838990;font-size:14px;">Total earned : </span> <span style="font-size:20px;color:#838990;"><b><?php echo $exposure_earn;?> </b></span></p> 
 </center>


<div id="poll">

<div class="col-md-6" style="padding-left:1px;padding:0px;">
<div class="up">
<button type="button" class="btn btn-link" name="vote" value="up" onclick="getVote(this.value)">
<img src="../dist/img/tup.png" style="height:25px;width:25px;margin-top:10px;">
<h4 style="color:#5b832b;font-weight:bold;padding:0px;margin:0px;"  class="upCount"><?php echo $up_vote; ?></h4>
</button>
</div>
</div>

<div class="col-md-6" style="padding:0px;">
<div class="down">
 <button type="button" class="btn btn-link" name="vote" value="down" onclick="getVote(this.value)">
<img src="../dist/img/tdown.png" style="height:25px;width:25px;margin-top:10px;">
<h4 style="color:#842d40;font-weight:bold;margin:0px;"  class="downCount"><?php echo $down_vote; ?></h4>
</button>

</div>
</div>

<?php } ?>


<H2 style="color:#fff;text-align:center;font-weight:Bold;font-size:36px;padding-top:4px;">How it works</h2>
<center>
<p>
<div class="btn btn-success">
<a href="purchase.php"> <font size="2" face="verdana" color="white"> Buy credits </font></a>
</div>

<div class="btn btn-success">
<a href="upgrade.php"> <font size="2" face="verdana" color="white"> Upgrade </font></a>
</div>
</p>
</center>
<div style="padding:10px;">

<img src="dist/img/random5.png" style="height:20px;width:20px;margin-top:-4px;"> Earn Exposure credits by surfing other members Sweebs.
<br>
<img src="dist/img/random5.png" style="height:20px;width:20px;margin-top:-4px;"> Credits earned are automatically applied to your last Sweeb so it is shown in rotation.
<br>
<img src="dist/img/random5.png" style="height:20px;width:20px;margin-top:-4px;"> Increase your Surf ratio by upgrading.
<br>
<img src="dist/img/random5.png" style="height:20px;width:20px;margin-top:-4px;"> Free memebers earn 1 credit per 2 sweebs viewed.
<br>
<img src="dist/img/random5.png" style="height:20px;width:20px;margin-top:-4px;"> Premium members earn 1.5 credits per 2 sweebs viewed.
</div>

    </div>
 

</div></div>


<style>

body {
    background:#d9e4ed;
    font-family: 'Open Sans', sans-serif;
}

h2 {
font-family: 'Open Sans', sans-serif;
font-size:32px;
}

.wrap {
max-width:1055px;
margin-left: auto;
margin-right: auto;
opacity:1;
}

.wrap_small {
max-width:450px;
margin-left: auto;
margin-right: auto;
opacity:1;
}

p {
font-family: 'Open Sans', sans-serif;
}

.wrap1 {
   max-width: 1100px;
    margin: 0 auto;
    margin-top:100px;
}

.btn-main {
border:2px solid #b6c0c9;
color:#b6c0c9;
background:none;
font-size:14px;
font-weight:Bold;
border-radius:0px;
}
.btn-main:hover {
border:2px solid #5fb5f2;
color:#5fb5f2;
font-size:14px;
font-weight:Bold;
border-radius:0px;
}
.avatar {
display:block;
width:95%;
border-radius:100%;
margin-top:10px;
margin-left:5px;
}
.form_in {
font-family: 'Open Sans', sans-serif;
border:1px solid #5fb5f2;
color:#3e4851;
box-shadow:none;
border-radius:0px;
}

.box-col {
font-family: 'Open Sans', sans-serif;
background:#fff;
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
  opacity:1;
  border:0px;


}
.navbar-default .navbar-brand {
  color: #ecf0f1;
}
.navbar-default .navbar-brand:hover, .navbar-default .navbar-brand:focus {
  color: #30cbd9;
}
.navbar-default .navbar-text {
  color: #868f98;
  font-family: 'Open Sans', sans-serif;
}
.navbar-default .navbar-nav > li > a {
  color: #868f98;
  font-size:14px;
  font-family: 'Open Sans', sans-serif;
}
.navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus {
  color: #30cbd9;
}
.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {
  color: #30cbd9;
  background-color: #ffffff;
}
.navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus {
  color: #30cbd9;
  background-color: #ffffff;
}
.navbar-default .navbar-toggle {
  border-color: #ffffff;
}
.navbar-default .navbar-toggle:hover, .navbar-default .navbar-toggle:focus {
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
  .navbar-default .navbar-nav .open .dropdown-menu > li > a {
    color: #ecf0f1;
  }
  .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
    color: #30cbd9;
  }
  .navbar-default .navbar-nav .open .dropdown-menu > .active > a, .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
    color: #30cbd9;
    background-color: #ffffff;
  }
}

.up {
background:#a4dc62;
height:85px;
text-align:center;
color:#5b832b;
font-weight:bold;
font-size:16px;
margin-bottom:15px;
  z-index: 1;
  cursor: pointer;
  transition:         0.08s ease-in;
  -o-transition:      0.08s ease-in;
  -ms-transition:     0.08s ease-in;
  -moz-transition:    0.08s ease-in;
  -webkit-transition: 0.08s ease-in;
}

.down {
background:#f06b87;
height:85px;
text-align:center;
color:#842d40;
font-weight:bold;
font-size:16px;
margin-bottom:15px;
}


.up:hover, .down:hover {
opacity:0.7;


  -webkit-transition: top 0.09s ease-in;
}

</style>
    






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
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7LHWPPZECB');
  $('#next-button').hide();
  // Wait for 8 seconds and then hide the element
    setTimeout(function() {
        $('#next-button').css('display','block');
    }, 8000); // 8000 milliseconds = 8 seconds
</script>


<?php if($_SESSION['captcha_count']>$captcha_count && $_SESSION['captcha_verify']==false){ ?>
<!-- Modal -->
<div id="recaptcha_model" class="modal fade" role="dialog"  aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Verify re-captcha</h4>
      </div>
      <div class="modal-body">
        <form id="captchaForm">
            <label for="captcha">Enter the letters (LOWER CASE):</label><br/>
            <img id="captchaImage" src="captcha.php" alt="CAPTCHA Image"> <i class="fa fa-refresh" aria-hidden="true" id="refreshCaptcha" style="cursor:pointer">Refresh</i><br/>
            <input type="text" id="captchaInput" name="captchaInput" placeholder="Enter verification code"><br/>
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
            data: { captchaInput: $("#captchaInput").val() },
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
</html>