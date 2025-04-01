<?php include('main/config.php');
include('main/functions.php');
//include('main/message.php');
// if($logged_in == 'no'){
// header("Location: index.php");
// }
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

checkLogin();

$this_month=date('Y-m', strtotime('-1 month'));

// Include the database connection code here (from step 1)


$sql = "SELECT id,avatar,ref, COUNT(*) AS ref_count
        FROM members 
        WHERE ref != 'none' AND DATE_FORMAT(created_date, '%Y-%m') = '" . $this_month . "'
        GROUP BY ref ORDER BY ref_count DESC";
$result = $conn->query($sql);
//dd($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
     //dd($row);
     $sql_2 = "SELECT id,avatar FROM members 
        WHERE username='".$row['ref']."'";
      $result_2 = $conn->query($sql_2);
      $row_2 = $result_2->fetch_assoc();
        $top_ref['ref'] =$row['ref'];
        $top_ref['avatar'] =$row_2['avatar'];
        
        $top_ref['ref_count'] =$row['ref_count'];
        if($row['ref']!='sweeba'){
          $top_users_all[] =$top_ref;
        }

        
    }
}
//dd($top_users_all);
//dd(count($top_users),$top_users);
// $top_users_list='';
// foreach($top_users_all as $value){
//     $top_users_list .="'".$value."'".',';
// }
// $new_string = rtrim($top_users_list, ',');
// $sql_10 = "SELECT *
//         FROM members
//         WHERE username IN ($new_string)";
// $result_10 = $conn->query($sql_10);
// $top_users_10=array();
// if ($result_10->num_rows > 0) {
// while ($row_10 = $result_10->fetch_assoc()) {
//     $top_users[]=$row_10;

// }
// }
//dd($top_users_10,$sql_10,$new_string);

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
	width: 325px; height: 145px;
	
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

#rocket {
    position: relative;
    top: 0;
    transition: top ease 0.5s;
}
.col {

    margin-bottom: 1em;
}

.col h3 {
    margin-bottom: 1em;
}

.btn-main4 {
    border: 2px solid #5cb85c;
    width: 220px;
    color: #fff;
    background: #5cb85c;
    font-size: 14px;
    font-weight: Bold;
    border-radius: 3px;
}
</style>



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
                      
                                <h2 style="text-align:center">Top Referrers this Month</h2>
                               

                                <div class="columns">
                                <div class="cloud">
                                <ul class="price">
                                    <h3 align="center">1st Place</h3>
                                    <?php if(isset($top_users_all[0])){ ?>
                                    <li class="grey">

<a href="<?php echo SITE_URL.$top_users_all[0]["ref"]; ?>" style="text-decoration:none"><img class="pull-left avatar"  
src="grab_image.php?img=<?php echo $top_users_all[0]["avatar"]; ?>"><?php echo $top_users_all[0]["ref"]; ?></a>
                                    </li>
                                   
                                    <li><b>Total Ref</b> : <?php echo $top_users_all[0]['ref_count']; ?></li>

                                    <?php } else {  ?>
                                        <li class="grey"> NA </li><?php } ?>
                                    
                                    <br><Br>
                                    </ul>
                                    
                              </div>
                                </div>

                                <div class="columns">
                                <div class="cloud">
                               <ul class="price">
                                    <h3 align="center">2nd Place</h3>
                                    <?php if(isset($top_users_all[1])){ ?>
                                    <li class="grey">
<a href="<?php echo SITE_URL.$top_users_all[1]['ref']; ?>" style="text-decoration:none"><img class="pull-left avatar"  
src="grab_image.php?img=<?php echo $top_users_all[1]["avatar"]; ?>"><?php echo $top_users_all[1]['ref']; ?></a>
                                    </li>
                                   
                                    <li><b>Total Ref</b> : <?php echo $top_users_all[1]['ref_count']; ?></li>
                                    <?php } else {  ?>
                                        <li class="grey"> NA </li><?php } ?>
                                    <br><Br>
                                    </ul>
                                    
                                </div>
                                </div>

                                <div class="columns">
                                <div class="cloud">
                                <ul class="price">
                                     <h3 align="center">3d Place</h3>
                                     <?php if(isset($top_users_all[2])){ ?>
                                    <li class="grey">
<a href="<?php echo SITE_URL.$top_users_all[2]["ref"]; ?>" style="text-decoration:none"><img class="pull-left avatar"  
src="grab_image.php?img=<?php echo $top_users_all[2]["avatar"]; ?>"> <?php echo $top_users_all[2]["ref"]; ?></a>
                                    </li>
                                   
                                    <li><b>Total Ref</b> : <?php echo $top_users_all[2]['ref_count']; ?></li>
                                    <?php } else {  ?>
                                        <li class="grey"> NA </li><?php } ?>
                                    <br><Br>
                                    </ul>

                                    
                              </div>
                                </div>                  


                    </div>

                  </div>
                    </div>
                 
                   </div>
                </div>
                

                <br>
<center>

<a href="refs.php" class="btn btn-main4" style="margin-right:5px;margin-top:4px;font-size:14px;"> 
<b>Grab your Referral Tools</b></a>
</center>

           <h3>&nbsp;</h3>

                <div class="table-responsive" >
                
                
                            <div style="width:100%;padding:14px;font-family: 'Open Sans', sans-serif;">

                          
                            <table class="table">
                              <tr>
                              <th>Rank</th>
                              <th>Username</th>
                                
                                <th>Ref Count</th>
                              <?php
                                // output data of each row
                                foreach($top_users_all as $key => $row){
                                  
                                  // $refs = $row['comes_from'] ?? 'no reff';
                                  ?>
                                  <tr>
                                  <td><?php echo $key+1;?></td>
                                  <td><a href="<?php echo SITE_URL.$row["ref"]; ?>" style="text-decoration:none">
    <img class="pull-left" style="width:50px; float:left;border-radius: 100%;"  
    src="grab_image.php?img=<?php echo $row["avatar"]; ?>" width="50"> &nbsp; <?php echo $row["ref"]; ?></a></td>
                                  <td><?php echo $row['ref_count'];?></td>
                                  <td><a href="/<?php echo $row['ref'];?>">View</a></td>
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


   
   
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47181279-4', 'auto');
  ga('send', 'pageview');

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