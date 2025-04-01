<div class="col-md-2 hidden-xs" style="padding:0px;">
  <div class="col-md-12 box" style="padding:0px;">
<div style="padding:20px;">
<p style="text-align:center;padding-top:10px;padding-bottom:10px;">
<a href="/<?php echo $username; ?>"><img class="img" src="grab_image.php?img=<?php echo $avatar; ?>" style="min-height:1px;min-width:1px;height:80px;width:80px;border-radius:3px;border-radius:100%;"></a>
</p>

<p style="text-align:center;color:#a9acb1;font-size:19px;"><a href="/<?php echo $username; ?>"><?php echo $username; ?></a></p>

<style>
.side_bar_a {
background:#f6f8fa;color:#838990;text-align:center;padding:10px;border-top:1px solid #ebeef1;
}
.side_bar_a_w {
background:#fff;color:#838990;text-align:center;padding:10px;border-top:1px solid #ebeef1;
}
.side_bar_a:hover, .side_bar_a_w:hover {
text-decoration:none;
color:#3498db;
}
.side_bar_a:a {
text-decoration:none;
color:#3498db;
}

#rocket {
  position: relative;
  top: 0;
  transition: top ease 0.5s;
}
#rocket:hover {
  top: -10px;
}

.btn-main5 {
border:2px solid #d9e4ed;
width:100%;
color:#5fb5f2;
background:#d9e4ed;
font-size:14px;
font-weight:Bold;
border-radius:3px;
}
.btn-main5:hover {
border:2px solid #d9e4ed;
color:#fff;
font-size:21px;
background:#e4edd9;
font-weight:Bold;
border-radius:3px;

}

.button-53 {
  background-color: #5fb5f2;
  border: 0 solid #E5E7EB;
  box-sizing: border-box;
  color: #fff;
  display: flex;
  font-family: ui-sans-serif,system-ui,-apple-system,system-ui,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
  font-size: 24px;
  font-weight: 700;
  justify-content: center;
  line-height: 1.75rem;
  padding: .75rem 1.65rem;
  position: relative;
  text-align: center;
  text-decoration: none #000000 solid;
  text-decoration-thickness: auto;
  width: 100%;
  max-width: 460px;
  position: relative;
  cursor: pointer;
  transform: rotate(-2deg);
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-53:focus {
  outline: 0;
}

.button-53:after {
  content: '';
  position: absolute;
  border: 1px solid #000000;
  bottom: 4px;
  left: 4px;
  width: calc(100% - 1px);
  height: calc(100% - 1px);
}

.button-53:hover:after {
  bottom: 2px;
  left: 2px;
  text-decoration: none;
}

@media (min-width: 768px) {
  .button-53 {
    padding: .75rem 3rem;
    font-size: 1.25rem;
  }
}

a:link { 
  text-decoration: none; 

</style>

<div style="text-align:center;color:#fff;font-size:15px;font-weight:Bold;"><span style="background:#5fb5f2;border-radius:100%;padding:5px;">$<?php echo $balance; ?></span></div><br>

<p style="text-align:center;font-weight:bold;">
<a href="/my_followers.php" style="text-decoration:none"><span style="color:#6a727b;">Followers: </span> <span style="color:#5fb5f2;border-bottom:1px solid #5fb5f2;"><?php echo $followers; ?></span></a> 
</p>

</div>


<div style="padding:8;">
<a href="random.php" style="font-size:17px;color:#fff;"><button class="button-53" role="button"><font size="3">Start Surfing</font></button></a>
</div>


<a href="/<?php echo $username; ?>" style="text-decoration:none;"><div class="side_bar_a">View Profile</div></a>

<a href="purchase.php" style="text-decoration:none;"><div class="side_bar_a_w">Purchase Credits</div></a>
<a href="reset.php" style="text-decoration:none;"><div class="side_bar_a">Update Account</div></a>
<a href="upgrade.php" style="text-decoration:none;"><div class="side_bar_a_w">Upgrade Account</div></a>
<a href="sweebs.php" style="text-decoration:none;"><div class="side_bar_a">Manage Sweebs</div></a>
<a href="refs.php" style="text-decoration:none;"><div class="side_bar_a_w">Referrals</div></a>
<a href="my_followers.php" style="text-decoration:none;"><div class="side_bar_a">Followers</div></a>
<a href="message.php" style="text-decoration:none;"><div class="side_bar_a_w">Messages</div></a>
<a href="views.php" style="text-decoration:none;"><div class="side_bar_a">Profile Views</div></a>
<a href="match.php" style="text-decoration:none;"><div class="side_bar_a_w">Matches</div></a>

</div>

<?php
$friends = ''.$friends.','.$user_id.'';
$os = explode(",", $friends);

$sql = "SELECT id, username, avatar FROM members WHERE avatar != 'user.png' ORDER BY rand() Limit 8";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    $username_search = $row['username'];
    $cur_user_id = $row['id'];
    
    if(!in_array($cur_user_id, $os)){
    echo '<div class="box" style="width:100%;padding:5px;padding-top:10px;text-align:center;">';
    echo '<img class="avatar" style="height:80px;width:80px;margin-top:-4px;margin-left:50px;padding-bottom:5px;" src="grab_image.php?img='.$row['avatar'].'">';
    echo '<p style="font-weight:bold;font-size:14px;color:#3e4851;">'.$row['username'].'</p>';


    
    echo '<form method="post" action="/'.$row['username'].'"><div class="col-md-6" style="padding:2px;">';
    echo '<button type="submit" name="follow" class="btn btn-block btn-info" style="border:0px;background:#5fb5f2;margin-right:5px;margin-top:4px;font-size:12px;">Follow</span></button></form>';
    echo '</div>';
    
    echo '<div class="col-md-6" style="padding:2px;"><a href="/'.$row['username'].'" class="btn btn-block btn-success" style="border:0px;background:#a2de5a;font-size:12px;">View Profile</a></div>';
    echo '</div>';
    }

}}
?>

</div>