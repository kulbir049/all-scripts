<?php include('main/config.php');
include('main/functions.php');
include('main/message.php');
// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();


$get_m_id = strip_tags($_GET["dlt"]);




?>
<?php
include('main/header.php');
?>

<style>
body {

font-family: 'Open Sans', sans-serif;
}
p {
font-family: 'Open Sans', sans-serif;
}

</style>

  
<div class="container" style="font-family: 'Open Sans', sans-serif;">
<div class="row">

<div class="col-md-2 hidden-xs" style="padding:0px;">
</div>

<div class="col-md-6">
<style>
.sweeb_b {
color:#fff;
margin-bottom:25px;
height:100px;
  position: relative;
  //display:block;
  font-weight: 700;
  font-size: 12px;
  letter-spacing: 2px;
 
  text-transform: uppercase;
  outline: 0;
  overflow:hidden;
  background: none;
  z-index: 1;
  cursor: pointer;
  transition:         0.08s ease-in;
  -o-transition:      0.08s ease-in;
  -ms-transition:     0.08s ease-in;
  -moz-transition:    0.08s ease-in;
  -webkit-transition: 0.08s ease-in;
}
.sweeb_b a {
color:#fff;
}
.sweeb_g {
background:#a2de5a;
}

.sweeb_bl {
background:#5fb5f2;


}
.sweeb_r {
background:#f26986;

}


.sweeb_g:hover, .sweeb_bl:hover, .sweeb_r:hover {
  color: whitesmoke;
}

.sweeb_g:before, .sweeb_bl:before, .sweeb_r:before {
  content: "";
  position: absolute;
background:#5cb85c;
  bottom: 0;
  left: 0;
  right: 0;
  top: 100%;
  z-index: -1;
  -webkit-transition: top 0.09s ease-in;
}

.sweeb_g:hover:before, .sweeb_bl:hover:before, .sweeb_r:hover:before {
  top: 0;
}



.sweeb {
background:#fff;
padding:20px;
}
</style>

<?php 

?>



<div class="col-md-4 col-xs-4" style="padding:0px;">
<a href="sweeb.php" style="display:block;">
<div class="col-md-12 sweeb_b sweeb_g">

<p style="text-align:center;padding-top:20px;">
<a href="sweeb.php"><img src="dist/img/nsweeb.png" style="padding-bottom:5px;"></a><br>
<a href="sweeb.php" style="font-size:14px;font-weight:Bold;">Sweeb</a>
</p>
</div></div></a>

<div class="col-md-4 col-xs-4" style="padding:0px;">
<div class="col-md-12 sweeb_b sweeb_bl">
<p style="text-align:center;padding-top:20px;">
<a href="trending.php"><img src="dist/img/trending.png" style="padding-bottom:5px;"></a><br>
<a href="trending.php" style="font-size:14px;font-weight:Bold;">Explore</a>
</p>
</div></div>

<div class="col-md-4 col-xs-4" style="padding:0px;">
<div class="col-md-12 sweeb_b sweeb_r">
<p style="text-align:center;padding-top:20px;">
<a href="friends.php"><img src="dist/img/friends.png" style="padding-bottom:5px;"></a><br>
<a href="friends.php" style="font-size:14px;font-weight:Bold;">Connect</a>
</p>
</div>
</div>

<div class="col-md-12" style="margin-left: auto; margin-right: auto;">
   <div class="content">
      <div class="col-md-12 col-xs-12 box" style="padding:0px;">
<center>
<h1>Your Profile Views</h1>
</center>
        <?php 

$expire_date=date('Y-m-d');
        $sql_subscription = "SELECT * FROM subscription where user_id ='".$_SESSION['user_id']."' and expire_date>'".$expire_date."' and status='Success' order by id desc ";     
        $result_subscription = $conn->query($sql_subscription);
$subscription = $result_subscription->num_rows;
if($subscription==0){ ?>
<br>
<center>
Upgrade your profile to view who checked your profile. <a href="upgrade.php">Upgrade here</a> 
</center>
<br>
               <div class="col-md-12 col-xs-12 text-center" style="background:#eef0f2;">
                 
                   
              </div>
<?php }

        $sql = "SELECT * FROM view_profiles where to_user_id ='".$_SESSION['user_id']."'";     
        $result = $conn->query($sql);
        $check = false;       
        if ($result->num_rows > 0) {
            
            $check = true;        
        }
        if($check == true)
        {
          $i = 1;
          while($row = $result->fetch_assoc()) 
          {
            $userFromDetail = getUserDetail($row['from_user_id'],$conn);
            $userToDetail = getUserDetail($row['to_user_id'],$conn);
  
            $fromUserName          = $userFromDetail['name'];
            $fromUserAvatar        = $userFromDetail['avatar'];
            $fromUserNameUnique    = $userFromDetail['username'];
            $toUserName            = $userToDetail['username'];
            $toUserAvatar          = $userToDetail['avatar'];
          

          if($subscription>0){  ?>
                <div class="col-md-12 col-xs-12 text-center" style="background:#eef0f2;">
                <a href="https://www.sweeba.com/<?=$fromUserNameUnique?>"><img class="avatar" src="grab_image.php?img=<?php echo   $fromUserAvatar; ?>" style="height:50px;width:50px;display:inline-block;"> <?php echo  $fromUserName;?> </a> viewed Your profile.
                   
              </div> 
                <?php }else{ ?>
               <div class="col-md-12 col-xs-12 text-center" style="background:#eef0f2;">
                  <img class="avatar" src="grab_image.php?img=user.png" style="height:50px;width:50px;display:inline-block;"> Your profile viewed from  <?php echo $row['country']; ?>
                   
              </div> 
               <?php }
                ?>


          <?php $i++;}}else{?>
<div class="col-md-12 col-xs-12 text-center">
            <p>You currently no profile view <b>(0)</b>  </p>


</div>
          <?php } ?>
            
      </div>
    </div>
</div>




</div>

</div>
<div class="col-md-3" style="padding:0px;">
</div>


</div>

</div></div>
<?php
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
      }
    }
  return $data;
}

?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    
<script>
    function create_mssage_button(){
    jQuery("#collapseExample").show();
   
}
</script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7LHWPPZECB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7LHWPPZECB');
</script>

  </body>
</html>