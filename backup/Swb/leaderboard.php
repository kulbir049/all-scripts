<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
 include('main/config.php');
include('main/functions.php');
checkLogin();
//include('main/message.php');
// if($logged_in == 'no'){
// header("Location: index.php");
// }

// updateExposureErn($conn,$user_id_sess);
//  updateExposureErnLeader($conn,$user_id_sess);
//  die;


$this_month=date('Y-m');

// Include the database connection code here (from step 1)

// SQL query to retrieve top surfers for the current month
// $sql = "SELECT m.*, COUNT(e.id) AS total_surfs
// FROM members m
// LEFT JOIN exposure e ON m.id = e.user_id
// WHERE MONTH(e.created_at) = MONTH(NOW()) AND YEAR(e.created_at) = YEAR(NOW())
// GROUP BY m.id
// ORDER BY total_surfs DESC
// LIMIT 3";
$sql = "SELECT m.*, e.exposure_earn as e_exposure_earn FROM exposure_leader e
JOIN members m ON m.id = e.user_id
WHERE e.user_id!=18 AND DATE_FORMAT(e.created_at, '%Y-%m') = '" . $this_month . "'
ORDER BY e.exposure_earn DESC
LIMIT 3";
$result = $conn->query($sql);
$top_users=array();
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
$top_users[]=$row;

}
}
// SQL query to retrieve top surfers for the current month
//  $sql_10 = "SELECT m.*, COUNT(e.id) AS total_surfs
//         FROM members m
//         LEFT JOIN exposure e ON m.id = e.user_id
//         WHERE MONTH(e.created_at) = MONTH(NOW()) AND YEAR(e.created_at) = YEAR(NOW())
//         GROUP BY m.id
//         ORDER BY total_surfs DESC
//         LIMIT 25";
$sql_10 = "SELECT m.*, e.exposure_earn as e_exposure_earn FROM exposure_leader e
JOIN members m ON m.id = e.user_id
WHERE e.user_id!=18 AND DATE_FORMAT(e.created_at, '%Y-%m') = '" . $this_month . "'
ORDER BY e.exposure_earn DESC
        LIMIT 25";
$result_10 = $conn->query($sql_10);
$top_users_10=array();
if ($result_10->num_rows > 0) {
while ($row_10 = $result_10->fetch_assoc()) {
    $top_users_10[]=$row_10;

}
}


include('main/header.php');
?>
   <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
  
   <style>
* {
  box-sizing: border-box;
}

.columns {
  float: left;
  width: 33.3%;
  padding: 8px;
}

.price {
  list-style-type: none;
  
  margin: 0;
  padding: 0;
  -webkit-transition: 0.3s;
  transition: 0.3s;
}
.price .header {
  background-color: #111;
  color: white;
  font-size: 25px;
}
.price li { 
  padding: 15px;
  text-align: center;
}
.price .grey { 
  font-size: 18px;
}
.button {
  background-color: #04AA6D;
  border: none;
  color: white;
  padding: 10px 25px;
  text-align: center;
  text-decoration: none;
  font-size: 18px;
}

@media only screen and (max-width: 600px) {
  .columns {
    width: 100%;
  }
}

.btn-success {
    color: #FFF;
    font-size: 17px;
    background-color: #5cb85c;
    border-color: #4cae4c;
}
.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
   } 
   .avatar{margin: 0 -40 0 90;float:left; width: 38px;}
   .btn-search {
    border: 1px solid #b6c0c9;
    color: #b6c0c9;
    background: none;
    font-size: 14px;
    font-weight: Bold;
    border-radius: 0px;
}
.cloud {
	width: 325px; height: 225px;
	
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

.cloud:after, .cloud:before {
	content: '';
	position: absolute;
	background: #FFF;
	z-index: -1
}

.cloud:after {
	width: 100px; height: 100px;
	top: -30px; left: 50px;
	
	border-radius: 100px;
	-webkit-border-radius: 100px;
	-moz-border-radius: 100px;
}

.cloud:before {
	width: 180px; height: 180px;
	top: -50px; right: 50px;
	border-radius: 200px;
	-webkit-border-radius: 200px;
	-moz-border-radius: 200px;
}

.col {

    margin-bottom: 1em;
}

.col h3 {
    margin-bottom: 1em;
}
</style>
<body>
<div class="col-md-12 col-xs-12" style="padding:0px;">
<div class="colorValue">  

</div>
</div>

<div class="col-md-12" style="margin-left: auto; margin-right: auto;">
<div class="content">
<h3 id="message" style="color:black;"></h3>
<div id="question"><h1></h1><Br>
</div>
<div id="chart">
                      
<div class="col-md-12 col-xs-12" style="padding:0px;">

<div class="colorValue">
<h2 style="text-align:center">Monthly Leaderboard</h2>

<p style="text-align:center">Prizes are added last day of each month at 12:00 UTC</p>
<div class="columns">
<div class="cloud">
<ul class="price">
<h3 align="center">1st Place</h3>
<li class="grey">
<a href="<?php echo SITE_URL.$top_users[0]["username"]; ?>" style="text-decoration:none"><img class="pull-left avatar"  src="grab_image.php?img=<?php echo $top_users[0]["avatar"]; ?>"><?php echo $top_users[0]["username"]; ?></a>
</li>
<li><font color="#6ab04c"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> <b>Prizes</b></font> 5 unassigned refs + <b>1000</b> Exposure credits + 30 days Featured member. </li>                               
<li><b>Credits Earned</b> : <font size="4"><?php echo $top_users[0]["e_exposure_earn"]; ?> </font></li>
<br><Br>
</ul>
</div>
</div>

<div class="columns">
<div class="cloud">
<ul class="price">
<h3 align="center">2nd Place</h3>
<li class="grey">
<a href="<?php echo SITE_URL.$top_users[1]["username"]; ?>" style="text-decoration:none"><img class="pull-left avatar"  src="grab_image.php?img=<?php echo $top_users[1]["avatar"]; ?>"><?php echo $top_users[1]["username"]; ?></a>
</li>
<li><font color="#6ab04c"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> <b>Prizes</b> </font> 4 unassigned refs + <b>750</b> Exposure credits + 30 days Featured member.</li>
<li><b>Credits Earned</b> : <font size="4"><?php echo $top_users[1]["e_exposure_earn"]; ?> </font></li>
<br><Br>
</ul>
                                    
</div>
</div>

<div class="columns">
<div class="cloud">
<ul class="price">
<h3 align="center">3d Place</h3>
<li class="grey">
<a href="<?php echo SITE_URL.$top_users[2]["username"]; ?>" style="text-decoration:none"><img class="pull-left avatar"  src="grab_image.php?img=<?php echo $top_users[2]["avatar"]; ?>"><?php echo $top_users[2]["username"]; ?></a>
</li>
<li><font color="#6ab04c"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> <b>Prizes</b></font> 3 unassigned refs + <b>500</b> Exposure credits + 30 days Featured member.</li>
<li><b>Credits Earned</b> : <font size="4"><?php echo $top_users[2]["e_exposure_earn"]; ?> </font></li>
<br><Br>
</ul>
</div>
</div>                  
</div>
</div>
</div>
</div>
</div>
                
<center>
<h3>Try Cracking the Top 25 &nbsp;</h3>
<font color="#6ab04c"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> </font>  Place <b>4th - 10th</b> 2 referrals + <b>250</b>  credits.</b>
<br>
<font color="#6ab04c"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> </font>  Place <b>10th - 25th</b> 1 referral + <b>100</b> credits.</b>
</center>

<div class="table-responsive" >
                
<div style="width:100%;padding:14px;font-family: 'Open Sans', sans-serif;">


<table class="table table-bordered table-striped table-custom">

<tr>

<th>Rank</th>
<th>Username</th>
<th>Credits Earned </th>
<th>Profile</th>
                              <?php
                                // output data of each row
                                foreach($top_users_10 as $key => $row){
                                  
                                  // $refs = $row['comes_from'] ?? 'no reff';
                                  ?>
                                  <tr>
                                  <td><strong><?php echo $key+1;?></strong></td>
                                  <td><img class="pull-left" style="width:50px; float:left;border-radius: 100%;"  src="grab_image.php?img=<?php echo $row["avatar"]; ?>" width="50"> <br> &nbsp; <a href="<?php echo SITE_URL.$row["username"]; ?>" style="text-decoration:none"> <?php echo $row["username"]; ?> </a></td>
                                
                                <td><?php echo $row['e_exposure_earn'];?></td>
                                  <td><a href="/<?php echo $row['username'];?>">View</a></td>
                                </tr>
                                <?php 
                                }
                            
                            echo '</table>';
                            ?>
                            
                        </div>
                      </div>  
            </div> <!-- chat div end here-->

</div>
</div>
</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>     

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