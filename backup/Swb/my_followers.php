<?php include('main/config.php');
include('main/functions.php');

// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();

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
      <?php


      $os = explode(",", $friends);

      $follow_arr = explode(",", $followers_list);
      $follow_count = count($follow_arr);
      ?>
      <div class="col-md-6 col-xs-6" style="padding:0px;">
        <a href="sweeb.php" style="display:block;">
          <div class="col-md-12 sweeb_b sweeb_g">

            <p style="text-align:center;padding-top:20px;">
              <a href="my_followers.php?view=following"><img src="dist/img/users6.png" style="padding-bottom:5px;"></a><br>
              <a href="my_followers.php?view=following" style="font-size:14px;font-weight:Bold;">Following</a>
            </p>
          </div>
      </div></a>

      <div class="col-md-6 col-xs-6" style="padding:0px;">
        <div class="col-md-12 sweeb_b sweeb_bl">
          <p style="text-align:center;padding-top:20px;">
            <a href="my_followers.php?view=follow"><img src="dist/img/user7.png" style="padding-bottom:5px;"></a><br>
            <a href="my_followers.php?view=follow" style="font-size:14px;font-weight:Bold;">My Followers (<?php echo $follow_count; ?>)</a>
          </p>
        </div>
      </div>


      <div class="col-md-12" style="margin-left:-1px;padding:0px;">

        <?php
        $sort = strip_tags($_GET["view"]);
        if ($sort == 'following') {
          $sql = 'SELECT * FROM `members` WHERE `id` IN (' . implode(',', array_map('intval', $os)) . ')';
        } elseif ($sort == 'follow') {
          $sql = 'SELECT * FROM `members` WHERE `id` IN (' . implode(',', array_map('intval', $follow_arr)) . ')';
        } else {
          $sql = 'SELECT * FROM `members` WHERE `id` IN (' . implode(',', array_map('intval', $os)) . ')';
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // output data of each row
          while ($row = $result->fetch_assoc()) {
            $username_search = $row['username'];
            $cur_user_id = $row['id'];
            echo '<div class="box" style="width:100%;padding:10px;margin-bottom:10px;margin-left:-1px;">';
            echo '<div class="col-md-2" style="padding:0px;"><img class="pull-left avatar" style="height:80px;width:80px;margin-top:-4px;margin-right:10px;"src="grab_image.php?img=' . $row['avatar'] . '"></div>';
            echo '<div class="col-md-10"><p style="font-weight:bold;font-size:16px;color:#3e4851;">' . $row['username'] . '</p>';
            if ($username == $username_search) {
            } elseif (!in_array($cur_user_id, $os)) {

              echo '<form method="post" action="/' . $row['username'] . '">';
              echo '<button type="submit" name="follow" class="btn btn-info pull-left" style="border:0px;background:#5fb5f2;margin-right:5px;margin-top:4px;">Follow ' . $row['username'] . ' <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span></button>
    </form>';
            } else {
              echo '<a href="/' . $row['username'] . '" class="btn btn-success pull-left" style="border:0px;background:#f26986;margin-right:5px;">You Are Following ' . $row['username'] . '!</a>';
            }

            echo '<a href="/' . $row['username'] . '" class="btn btn-success pull-left" style="border:0px;background:#a2de5a;">View Profile</a>';
            echo '</div></div>';
          }
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script src="/dist/js/bootstrap.min.js"></script>


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