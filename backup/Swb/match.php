<?php include('main/config.php');
include('main/functions.php');
include('main/message.php');
// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();


$get_m_id = strip_tags($_GET["dlt"]);


$sql = "SELECT * FROM members WHERE avatar!='user.png' ORDER BY id desc";
        $result = $conn->query($sql);
          while($row = $result->fetch_assoc()) {
             $name= filter_var($row['avatar']);
            $check = 'file/'.$name.'';
            if (file_exists($check)) {
                
                //exist image into foder
                
            }else{
              $sql = "UPDATE members SET avatar='user.png' WHERE id=".$row['id'];
               $conn->query($sql);
            }

          }
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

if(isset($_GET["datamatch"])){
   $match=base64_decode($_GET["datamatch"]);
   $matchData=explode('-', $match);
   $logid=$matchData[0];
   $matchuser_id=$matchData[1];
   $status=$matchData[2];
     $sql = "SELECT * FROM `match` WHERE from_user_id ='$logid' and to_user_id='$matchuser_id'";
        $result = $conn->query($sql);
        if ($result->num_rows==0) {
          $user_details = getUserDetail($logid,$conn);
          $username =      $user_details['username'];
          $date=date('Y-m-d H:i:s');
            $sql = "INSERT INTO `match` (`from_user_id`, `to_user_id`, `status`, `created_at`) VALUES ('".$_SESSION['user_id']."', '".$matchuser_id."', '$status', '$date')";
          $conn->query($sql);

          $sqlz = "INSERT INTO activity (id, user_id, action, created_date) VALUES (NULL, '$matchuser_id', '<a href=\"https://www.sweeba.com/$username\"> $username </a> Likes you', '$date')";
          if ($conn->query($sqlz) === TRUE) {
            header("Location: ../dash.php");
          }
          //update owner
          $sqlt = "UPDATE members SET notif=notif+1 WHERE id='$matchuser_id' Limit 1";
          mysqli_query($conn, $sqlt);
        }
}
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
        <?php 
        $sql = "SELECT * FROM members WHERE id !='".$_SESSION['user_id']."' and avatar!='user.png' ORDER BY RAND() LIMIT 1";
        $result = $conn->query($sql);
        $check = false;       
        if ($result->num_rows > 0) {
            
            $check = true;        
        }
        if($check == true)
        {
          while($row = $result->fetch_assoc()) {?>
            <div class="col-md-12 col-xs-12 text-center">
      <img class="avatar" src="grab_image.php?img=<?php echo $row['avatar']; ?>" style="height:150px;width:150px;display:inline-block;">
            </div>
            <div class="col-md-12 col-xs-12 text-center"  style="margin:0px;padding-right:30px;">
                <a href="/<?=$row['username']?>" style="font-weight:bold;font-size:16px;color:#3e4851;"><?=$row['name']?></a>
            </div>
            <div class="col-md-12 col-xs-12 text-center" style="margin:0px;margin-bottom:5px;padding-right:30px;">
              <h2>Is this a match?</h2>
              <br>
              <a href="?datamatch=<?php echo base64_encode($user_id_sess.'-'.$row['id'].'-1');?>" class="btn btn-success" style="background-color: #5fb5f2;border-color: #5fb5f2;">Yes</a>  &nbsp; <a href="?datamatch=<?php echo base64_encode($user_id_sess.'-'.$row['id'].'-0');?>" class="btn btn-success" style="background-color: #000000;border-color: #000000;">No</a>
            </div>  
          <?php }}?>
          <center>
<p><a href="https://www.sweeba.com/matches.php" class="btn btn-success" style="border:0px;background:#FAA0A0;font-size:23px;"><img src="https://sweeba.com/images/matches.png" width="25" height="25">  <b> View your Matches </b></a></p>
</center>

      </div>
    </div>
</div>




</div>

</div>
<div class="col-md-3" style="padding:0px;">
</div>


</div>

</div></div>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
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