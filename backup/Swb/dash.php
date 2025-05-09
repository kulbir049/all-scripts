<?php include('main/config.php');

include('main/functions.php');
checkLogin();
include('main/follow_premium_featured.php');
// if($logged_in == 'no'){
// header("Location: index.php");
// }

$sql = "SELECT * FROM exposure WHERE post_by_user='$user_id_sess'";
//$sql = "SELECT * FROM exposure";
$result = $conn->query($sql);
$Exposure_views_received = $result->num_rows;
$sql = "SELECT SUM(`exposure_earn`) as total_exposure_earn FROM exposure WHERE user_id='$user_id_sess'";
//$sql = "SELECT SUM(`exposure_earn`) as total_exposure_earn FROM exposure ";
$result_view_sql = $conn->query($sql);
$exposure_earn = 0;
$row_get_sweeb = $result_view_sql->fetch_assoc();
if (isset($row_get_sweeb['total_exposure_earn']) && $row_get_sweeb['total_exposure_earn'] > 0) {
  $exposure_earn = $row_get_sweeb['total_exposure_earn'];
}

function isMobile()
{
  return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

//$sql_last_login = "SELECT * FROM login_history WHERE user_id='$user_id_sess'";



?>
<?php
include('main/header.php');
?>

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

<style>
  body {

    font-family: 'Open Sans', sans-serif;
  }

  p {
    font-family: 'Open Sans', sans-serif;
  }

  .sweeb_b {
    color: #000;
    margin-bottom: 25px;
    height: 100px;
    position: relative;
    //display:block;
    font-weight: 700;
    font-size: 12px;
    letter-spacing: 2px;

    text-transform: uppercase;
    outline: 0;
    overflow: hidden;
    background: none;
    z-index: 1;
    cursor: pointer;
    transition: 0.08s ease-in;
    -o-transition: 0.08s ease-in;
    -ms-transition: 0.08s ease-in;
    -moz-transition: 0.08s ease-in;
    -webkit-transition: 0.08s ease-in;
  }

  .sweeb_b a {
    color: #fff;
  }

  .sweeb_g {
    background: #a2de5a;
  }

  .sweeb_bl {
    background: #5fb5f2;


  }

  .sweeb_r {
    background: #f26986;

  }

  .sweeb_g:hover,
  .sweeb_bl:hover,
  .sweeb_r:hover {
    color: whitesmoke;
  }

  .sweeb_g:before,
  .sweeb_bl:before,
  .sweeb_r:before {
    content: "";
    position: absolute;
    background: #5cb85c;
    bottom: 0;
    left: 0;
    right: 0;
    top: 100%;
    z-index: -1;
    -webkit-transition: top 0.09s ease-in;
  }

  .sweeb_g:hover:before,
  .sweeb_bl:hover:before,
  .sweeb_r:hover:before {
    top: 0;
  }

  .sweeb {
    background: #fff;
    padding: 20px;
  }


  .clipboard {
    border: 0;
    padding: 10px;
    border-radius: 0px;
    background-image: linear-gradient(135deg, #d9e4ed 44%, #ffc300 100%);
    cursor: pointer;
    color: #04048c;
    font-family: 'Karla', sans-serif;
    font-size: 13px;
    position: relative;
    top: 0;
    transition: all .2s ease;

    &:hover {
      top: 0px;
    }
  }

  p {
    font-weight: 300;
  }
  }


  .tooltip {
    position: relative;
    display: inline-block;
  }

  .tooltip .tooltiptext {
    visibility: hidden;
    width: 140px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px;
    position: absolute;
    z-index: 1;
    bottom: 150%;
    left: 50%;
    margin-left: -75px;
    opacity: 0;
    transition: opacity 0.3s;
  }

  .tooltip .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
  }

  .tooltip:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
  }

  .btn-success {
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
    border: none;
  }

  .preview {
    border-radius: 3px;
    padding: 5px;
    margin-top: 7px;
    margin-bottom: 10px;
    -webkit-box-shadow: 1px 0px 8px 1px rgba(95, 181, 242, 1);
    -moz-box-shadow: 1px 0px 8px 1px rgba(95, 181, 242, 1);
    box-shadow: 1px 0px 8px 1px rgba(95, 181, 242, 1);
  }


  /* The alert message box */
  .alert {
    padding: 10px;
    background-color: #2196F3;
    /* Red */
    color: white;
    margin-bottom: 15px;
  }

  /* The close button */
  .closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
  }

  /* When moving the mouse over the close button */
  .closebtn:hover {
    color: black;
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
  .btn-main8 {
    border: 2px solid #F88379;
    width: 100%;
    color: #Fff;
    background: #F88379;
    font-size: 14px;
    font-color: #fff;
    font-weight: Bold;
    border-radius: 3px;
  }
  .btn-main8:hover {
    border: 4px solid #fff;
    color: #fff;
    font-size: 14px;
    background: #5cb85c;
    font-weight: Bold;
    border-radius: 3px;
  }

  .btn-main4 {
                border: 2px solid #5cb85c;
                width: 100%;
                color: #fff;
                background: #5cb85c;
                font-size: 14px;
                font-weight: Bold;
                border-radius: 3px;
              }

              .btn-main4:hover {
                border: 4px solid #fff;
                color: #fff;
                font-size: 14px;
                background: #5fb5f2;
                font-weight: Bold;
                border-radius: 3px;
              }


              .btn-main3 {
                border: 2px solid #fff;
                width: 100%;
                color: #5fb5f2;
                background: #fff;
                font-size: 14px;
                font-color: #5fb5f2;
                font-weight: Bold;
                border-radius: 3px;
              }

              .btn-main3:hover {
                border: 4px solid #fff;
                color: #fff;
                font-size: 14px;
                background: #5fb5f2;
                font-weight: Bold;
                border-radius: 3px;
              }


              .glyphicon.glyphicon-globe {
                font-size: 16px;
              }

              .glyphicon.glyphicon-pencil {
                font-size: 16px;

              }

              .activity {
                padding: 22px;
                color: #8e9093;
                border-bottom: 1px solid #ebeef1;
              }

              .activity:nth-child(odd) {
                background: #fff;
              }

              .activity:nth-child(even) {
                background: #f6f8fa;
              }

</style>

<body>

  <div class="container" style="font-family: 'Open Sans', sans-serif;"></div>
  <div class="row">
    <?php


    if (isset($_SESSION['show_on_first_login']) && $_SESSION['show_on_first_login'] == 1) {
      echo  $_SESSION['show_on_first_login_message'];
      $_SESSION['show_on_first_login'] = 0;
    }
    ?>
    <?php include("main/side_bar.php"); ?>

    <div class="col-xs-12 col-md-6">

      <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <font color="#fff" size="5">⚑</font> <b>Free Credits:</b> 10 for 1st sweeb & 25 for profile completion.
        <font color="#fff" size="3"><b>NEW</b></font> Leaderboard Prizes for <b>1st - 25th</b>.
      </div>

      <div class="col-md-4 col-xs-4" style="padding:0px;">
        <a href="sweeb.php" style="display:block;">
          <div class="col-md-12 col-xs-12 sweeb_b sweeb_g">

            <p style="text-align:center;padding-top:20px;">
              <a href="sweeb.php"><img src="dist/img/nsweeb.png" style="padding-bottom:5px;"></a><br>
              <a href="sweeb.php" style="font-size:14px;font-weight:Bold;">Sweeb</a>
            </p>
          </div>
      </div></a>

      <div class="col-md-4 col-xs-4" style="padding:0px;">
        <div class="col-md-12 col-xs-12 sweeb_b sweeb_bl">
          <p style="text-align:center;padding-top:20px;">
            <a href="trending.php"><img src="dist/img/trending.png" style="padding-bottom:5px;"></a><br>
            <a href="trending.php" style="font-size:14px;font-weight:Bold;">Explore</a>
          </p>
        </div>
      </div>

      <div class="col-md-4 col-xs-4" style="padding:0px;">
        <div class="col-md-12 col-xs-12 sweeb_b sweeb_r">
          <p style="text-align:center;padding-top:20px;">
            <a href="friends.php"><img src="dist/img/friends.png" style="padding-bottom:5px;"></a><br>
            <a href="friends.php" style="font-size:14px;font-weight:Bold;">Connect</a>
          </p>

        </div>
      </div>

      <?php if (isMobile()) { ?>

        <div class="col-xs-12" style="padding:0px;">
          <div class="col-xs-12" style="background:#fff;padding:0px;margin-bottom:25px;">

            <center><a href="random.php" class="btn btn-success btn-block" style="font-size:18px;"><img src="dist/img/random5.png" style="height:16px;width:16px;margin-top:-4px;"> Start Surfing</a> </center>

            <p style="font-size:24px;font-weight:Bold;color:#333;text-align:Center;padding:20px;">Balance <span style="color:#a2de5a;">$<?php echo $balance; ?></span></p>
            <div class="col-xs-6" style="margin-bottom:20px;">
              <a href="withdraw.php" class="btn btn-main btn-block">Withdraw</a>
            </div>
            <div class="col-xs-6">
              <a href="faq.php" class="btn btn-main btn-block">Need Help?</a>

            </div>

          </div>

        <?php } ?>

        <p><div id="content"></p>

        </div>

        </div>

        <div class="col-md-3 hidden-xs" style="padding:0px;">
          <div class="col-md-12" style="background:#fff;padding:0px;margin-bottom:7px;">
            <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
             Quick Stats
            </div>

<p style="font-size:16px;font-weight:Bold;text-align:Center;padding-top:10px;"><span>Credits </span> <span class="glyphicon glyphicon-random" aria-hidden="true"></span> <span style="color:#5fb5f2;"><strong><?php echo $availbale_exposure_earn; ?></span></strong></p>

<p style="font-size:16px;font-weight:Bold;text-align:Center;"><span>Balance </span> <span class="glyphicon glyphicon-usd" aria-hidden="true"></span><span style="color:#5fb5f2;"><strong><?php echo $balance; ?></span></strong></p>
<p style="font-size:16px;font-weight:Bold;text-align:Center;"><span>Referrals </span> <span class="glyphicon glyphicon-user" aria-hidden="true"></span> <span style="color:#5fb5f2;"><strong><?php echo $result_reff_logs; ?></span></strong></p>
           
            <div class="col-md-6" style="margin-bottom:20px;">
              <a href="withdraw.php" class="btn btn-main btn-block">Withdraw</a>
            </div>
            <div class="col-md-6">
              <a href="faq.php" class="btn btn-main btn-block">Need Help?</a>

            </div>
          </div>

          <div class="col-md-12 hidden-xs" style="padding:0px;margin-bottom:15px;">

<a href="reset.php" class="btn btn-main4" style="margin-right:5px;margin-top:4px;font-size:14px;"><b>Complete Profile</b></a>

<a href="check_in.php" class="btn btn-main3" style="margin-right:5px;margin-top:4px;font-size:14px; "><b>Check in </b></a>

<a href="stats_view.php" class="btn btn-main8" style="margin-right:5px;margin-top:4px;font-size:14px; "><b>📊 Sweeb Stats </b></a>
</div>


          <div class="col-md-12 hidden-xs" style="background:#fff;padding:0px;margin-top:5px;margin-bottom:2px;">
            <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
              Notifications
            </div>
            
            <?php
            $sql = "SELECT id, user_id, action, created_date FROM activity WHERE user_id='$user_id' ORDER BY id DESC limit 10";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              // output data of each row
              while ($row = $result->fetch_assoc()) {
                echo '<div class="activity">' . $row['action'] . '</div>';
              }
            } else {
              echo "<br><center>No Notifications... Keep Sweebing!  </center><br>";
            }
            $conn->close();
            ?>

          </div>



          <div class="col-md-12 hidden-xs" style="padding:0px;margin-bottom:15px;">

            <a href="support.php" class="btn btn-main4" style="margin-right:5px;margin-top:4px;font-size:14px;">
              <b><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Support Ticket</b></a>

          </div>


          <?php include('main/ad_code.php'); ?>

        </div>
    </div>


    <footer>
      <center>
        <br><Br>

        <p>&copy; Sweeba.com <script>
            document.write(new Date().getFullYear())
          </script>
        </p>
      </center>
    </footer>
  </div> <!-- /container -->

  <?php include('footer.php'); ?>


  <script src="javascript.js"> </script>

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->


  <script>
    $(document).ready(function() {

      $('#content').scrollPagination({

        nop: 4, // The number of posts per scroll to be loaded
        offset: 0, // Initial offset, begins at 0 in this case
        error: '<center><b>You Made It To The Last Sweeb! </b></center>', // When the user reaches the end this is the message that is
        // displayed. You can change this if you want.
        delay: 500, // When you scroll down the posts will load after a delayed amount of time.
        // This is mainly for usability concerns. You can alter this as you see fit
        scroll: true // The main bit, if set to false posts will not load as the user scrolls. 
        // but will still load if the user clicks.

      });

    });
  </script>

</body>

</html>