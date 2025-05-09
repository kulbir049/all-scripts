<?php include('main/config.php');
include('main/functions.php');
include('main/message.php');
// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();


$get_m_id = strip_tags($_GET["dlt"]);

//deleted message
if ($get_m_id != NULL) {
  $sql = "SELECT id, user_id, rec, action, viewed, date, message FROM messages WHERE rec ='$username' OR user_id = '$username' AND id = '$get_m_id' ORDER BY id DESC";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $rec = $row['rec'];
      $sqls = "UPDATE members SET msg='no' WHERE username='$rec'";
      $conn->query($sqls);

      $sq = "UPDATE messages SET action='deleted' WHERE id= '$get_m_id'";

      if ($conn->query($sq) === TRUE) {
        header("Location: message.php");
        die();
      }
    }
  } else {
    header("Location: message.php");
    die();
  }
}
//end delete

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

    <?php include("main/side_bar.php"); ?>

    <div class="col-md-6">
      <style>
        .sweeb_b {
          color: #fff;
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
      </style>

      <div class="col-md-4 col-xs-4" style="padding:0px;">
        <a href="sweeb.php" style="display:block;">
          <div class="col-md-12 sweeb_b sweeb_g">

            <p style="text-align:center;padding-top:20px;">
              <a href="sweeb.php"><img src="dist/img/nsweeb.png" style="padding-bottom:5px;"></a><br>
              <a href="sweeb.php" style="font-size:14px;font-weight:Bold;">New Sweeb</a>
            </p>
          </div>
      </div></a>

      <div class="col-md-4 col-xs-4" style="padding:0px;">
        <div class="col-md-12 sweeb_b sweeb_bl">
          <p style="text-align:center;padding-top:20px;">
            <a href="trending.php"><img src="dist/img/trending.png" style="padding-bottom:5px;"></a><br>
            <a href="trending.php" style="font-size:14px;font-weight:Bold;">View Trending</a>
          </p>
        </div>
      </div>

      <div class="col-md-4 col-xs-4" style="padding:0px;">
        <div class="col-md-12 sweeb_b sweeb_r">
          <p style="text-align:center;padding-top:20px;">
            <a href="friends.php"><img src="dist/img/friends.png" style="padding-bottom:5px;"></a><br>
            <a href="friends.php" style="font-size:14px;font-weight:Bold;">Find Friends</a>
          </p>
        </div>
      </div>

      <div class="col-md-12" style="margin-left:-1px;padding:0px;">
        <script>
          function myFunction8() {
            // Get the text field
            var copyText = document.getElementById("myInput8");

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);

            // Alert the copied text
            alert("Copied the text: " + copyText.value);
          }
        </script>

        <center>
          <h1>Message Members</h1>

          <p>Increase your earnings by messaging your referrals and encouraging them to upgrade and make purchases. Below is a pre-made template that you can copy. Simply push the message button below and type in their username.
            <br><br>
            <!-- The text field -->
            <input type="text" value="Hello, welcome to the wonderful Sweeba community. Be sure to upgrade and purchase credits to increase your exposure and earnings!  Sweeba Rocks!" id="myInput8">

            <!-- The button used to copy the text -->
            <button onclick="myFunction8()">Copy Message</button>
            <br>
        </center>

        <button class="btn btn-main btn-block" style="background:#fff;margin-bottom:10px;" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" onclick="create_mssage_button()">
          Create A Message
        </button>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
          echo $Err;
        } ?>

        <div class="collapse" id="collapseExample">

          <div class="box" style="width:100%;padding:0px;margin-bottom:10px;margin-left:-1px;">

            <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;margin-bottom:15px;width:100%;border:0px;">
              Create A Message
            </div>
            <div style="padding:20px;">


              <form method="post">
                <input type="text" name="username" placeholder="username" class="form-control form_in" /><br>
                <textarea class="form-control form_in" name="message" style="border:1px solid #d3dce5;box-shadow:none;border-radius:0px;" rows="3"></textarea>
                <br>
                <button type="submit" class="btn btn-main" style="background:#5fb5f2;border:0px;color:#fff;">Post</button>
              </form>




            </div>
          </div>
        </div>


        <?php
        $sql = "SELECT id, user_id, rec, action, viewed, date, message FROM messages WHERE rec ='$username' OR user_id = '$username' AND viewed = 'no' AND action= 'yes' ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // output data of each row
          while ($row = $result->fetch_assoc()) {

            $sen_user_id = $row['user_id'];
            $action_mess = $row['action'];

            //if deleted
            if ($action_mess != 'deleted') {
              // end 

              //Grab avatar  
              $sq = "SELECT avatar FROM members WHERE username ='$sen_user_id'";
              $resul = $conn->query($sq);
              if ($resul->num_rows > 0) {
                // output data of each row
                while ($ro = $resul->fetch_assoc()) {
                  $sen_avatar = $ro['avatar'];
                }
              }
              //end avatar
              $w_message = $row['message'];
              $content = substr($w_message, 0, 80) . '...';
              $read = $row['read'];
              $datetime = $row['date'];
              echo '<div class="col-md-12 box" style="padding:0px;margin-left:-1px;height:140px;margin-bottom:70px;">';
              echo '<div class="col-md-2 col-xs-2" style="padding:10px;">';
              echo '<img class="pull-left avatar" src="grab_image.php?img=' . $sen_avatar . '">';
              echo '</div>';

              echo '<div class="col-md-10" style="margin:0px;margin-bottom:5px;padding:20px;padding-right:30px;">';
              echo '<p style="font-weight:bold;font-size:16px;color:#3e4851;" class="pull-left">' . $sen_user_id . '</p>';
              echo '<p style="font-weight:bold;font-size:14px;color:#3e4851;" class="pull-right">' . time2str($datetime) . '</p><br><br>';
              echo '<p style="word-break: break-all;color:#8a9cac;" id="output">' . $content . '</p>';
              echo '</div><div style="background:#eef0f2;width:100%;height:50px;padding:20px;padding-top:10px;margin-top:135px;border-top:1px solid:#d7dce1;">';
              echo '<a href="?dlt=' . $row['id'] . '" class="btn btn-main pull-right" style="background:#f26986;border:0px;color:#fff;">Delete</button>';
              echo '<a href="v_message.php?id=' . $row['id'] . '" class="btn btn-main pull-right" style="background:#5fb5f2;border:0px;color:#fff;">View Message</a>&nbsp;&nbsp;</div>
    </div>';
            }
          }
        } else {
          $mes_1 = 0;
        }
        //$conn->close();

        ?>


        <?php
        $sql = "SELECT id, user_id, rec, action, viewed, date, message FROM messages WHERE rec ='$username' OR user_id = '$username' AND viewed = 'yes' ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // output data of each row
          while ($row = $result->fetch_assoc()) {
            $action_mess = $row['action'];

            //if deleted
            if ($action_mess != 'deleted') {
              // end 

              $sen_user_id = $row['user_id'];
              //Grab avatar  
              $sq = "SELECT avatar FROM members WHERE username ='$sen_user_id'";
              $resul = $conn->query($sq);
              if ($resul->num_rows > 0) {
                // output data of each row
                while ($ro = $resul->fetch_assoc()) {
                  $sen_avatar = $ro['avatar'];
                }
              }
              //end avatar
              $w_message = $row['message'];
              $content = substr($w_message, 0, 80) . '...';
              $read = $row['read'];
              $datetime = $row['date'];
              echo '<div class="col-md-12 box" style="padding:0px;margin-left:-1px;height:140px;margin-bottom:70px;">';
              echo '<div class="col-md-2 col-xs-2" style="padding:10px;">';
              echo '<img class="pull-left avatar" src="grab_image.php?img=' . $sen_avatar . '">';
              echo '</div>';

              echo '<div class="col-md-10" style="margin:0px;margin-bottom:5px;padding:20px;padding-right:30px;">';
              echo '<p style="font-weight:bold;font-size:16px;color:#3e4851;" class="pull-left">' . $sen_user_id . '</p>';
              echo '<p style="font-weight:bold;font-size:14px;color:#3e4851;" class="pull-right">' . time2str($datetime) . '</p><br><br>';
              echo '<p style="word-break: break-all;color:#8a9cac;" id="output">' . $content . '</p>';
              echo '</div><div style="background:#eef0f2;width:100%;height:50px;padding:20px;padding-top:10px;margin-top:135px;border-top:1px solid:#d7dce1;">';
              echo '<a href="?dlt=' . $row['id'] . '" class="btn btn-main pull-right" style="background:#f26986;border:0px;color:#fff;">Delete</button>';
              echo '<a href="v_message.php?id=' . $row['id'] . '" class="btn btn-main pull-right" style="background:#5fb5f2;border:0px;color:#fff;">View Message</a>&nbsp;&nbsp;</div>
    </div>';
            }
          }
        } else {
          $mes_2 = 0;
        }
        //$conn->close();

        if ($mes_1 == '0' and $mes_2 == '0') {
          echo '<div style="background:#fff;padding:20px;color:#3e4851;text-align:center;font-size:16px;width:100%;">There are currently no messages!';
          echo '<br></div><div style="background:#eef0f2;padding:20px;color:#fff;text-align:center;font-size:16px;width:100%;"><a href="dash.php" class="btn btn-main btn-block" style="background:#5fb5f2;border:0px;color:#fff;">Return To The Dashboard!</a></div>';
        }
        ?>



      </div>

    </div>
    <div class="col-md-3" style="padding:0px;">
      <div class="col-md-12" style="background:#fff;padding:0px;margin-bottom:25px;">
        <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
          Balance
        </div>
        <p style="font-size:24px;font-weight:Bold;color:#a2de5a;text-align:Center;padding:20px;">$<?php echo $balance; ?></p>
        <div class="col-md-6" style="margin-bottom:20px;">
          <a href="withdraw.php" class="btn btn-main btn-block">Withdraw</a>
        </div>
        <div class="col-md-6">
          <a href="faq.php" class="btn btn-main btn-block">Need Help?</a>
        </div>
        <br>
      </div>

      <?php include('main/ad_code.php'); ?>
    </div>

  </div>
</div>



<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
  function create_mssage_button() {
    jQuery("#collapseExample").show();

  }
</script>
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

</body>

</html>