<?php include('main/config.php');
$get_sweeb_id = strip_tags($_GET["id"]);
$sweeb_title = strip_tags($_GET["t"]);
//info on sweeb







if ($get_sweeb_id == 0 && $sweeb_title == 'random') {
  $sql = "SELECT *  FROM sweebs WHERE status='active' ORDER BY rand() Limit 1";
} else {


  $sql = "SELECT *  FROM sweebs WHERE id='$get_sweeb_id' Limit 1";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  //echo $row['views'];
  $last_view = date('Y-m-d');
  $views=$row['views']+1;
  //echo $views;
  $sql_views = "UPDATE sweebs SET views=$views, last_view='$last_view' WHERE id='$get_sweeb_id'";
  $conn->query($sql_views);



  $sql = "SELECT *  FROM sweebs WHERE id='$get_sweeb_id' Limit 1";







}
$result = $conn->query($sql);

if ($result->num_rows == 0) {
  header("Location: https://sweeba.com/dash.php");
  die();
}
// output data of each row
while ($row = $result->fetch_assoc()) {
  $user_id_sweeb = $row['user_id'];
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
  }
  //dd($row['views']);die;
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
?>

  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="<?php echo $uncode_c; ?>">
    <meta name="author" content="Sweeba">
    <?php if ($sweeb_title != NULL) { ?>
      <meta property="og:title" content="<?php echo $sweeb_title; ?>" />
    <?php } else { ?>
      <meta property="og:title" content="Sweeba" />
    <?php } ?>
    <meta property="og:type" content="article" />

    <?php if ($met_img != NULL) { ?>
      <meta property="og:image" content="https://www.sweeba.com/grab_image.php?img=<?php echo $met_img; ?>" />
    <?php } else { ?>
      <meta property="og:image" content="https://www.sweeba.com/dist/img/sweeba.png" />
    <?php } ?>
    <meta property="og:url" content="https://www.sweeba.com/<?php echo $sweeb_id_from; ?>/<?php echo $sweeb_title; ?>" />
    <meta property="og:description" content="<?php echo $uncode_c; ?>" />


    <meta property="og:video" content="https://sweeba.com/view_sweeb.php" />

    <meta property="og:video:height" content="540" />
    <meta property="og:video:width" content="285" />
    <meta property="og:video:type" content="application/x-shockwave-flash" />

    <link rel="icon" href="../favicon.ico">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <?php /*<link href="style.css" rel="stylesheet" type="text/css"><?php */ ?>

    <div id="fb-root"></div>
    <title>Sweeba</title>

    <div id="fb-root"></div>
    <script>
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=136295639787694";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

    <style type="text/css">
      .wrap1 {
        max-width: 1028px;
        margin: 0 auto;
        margin-top: 60px;
      }

      .stButton * {
        box-sizing: content-box;
      }

      .yo {
        color: #000;
        padding-right: 10px;
      }

      .yo:hover {
        background: #00adee;
        padding: 5px;
        color: #fff;
        text-decoration: none;
      }

      .logo {
        display: block;
        width: auto;
        max-width: 100%;
        margin-top: -10px;
        margin-left: -10px;

      }

      .avatar {
        display: block;
        height: auto;
        max-width: 120%;
        margin-top: 10px;
      }

      .nav-marg {
        margin-left: 5%;
        margin-right: 5%;
      }

      .youtubevideo {
        width: 100%;
        height: 0;
        padding-bottom: 56.25%;
      }

      .btn btn-search {
        background-color: #ededed !important;
      }

      .glyphicon.glyphicon-fire {
        font-size: 25px;
      }

      .glyphicon {
        position: relative;
        top: 1px;
        display: inline-block;
        font-family: 'Glyphicons Halflings';
        font-style: normal;
        font-weight: 400;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
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
    </style>



    <nav class="navbar navbar-default navbar-fixed-top" style="font-family: 'Open Sans', sans-serif;">
      <div class="nav-marg">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="https://sweeba.com/dash.php"><img src="../dist/img/sweeba.png" class="logo hidden-xs"><img src="../images/IVynm2a.png" class="logo visible-xs"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

          <ul class="nav navbar-nav navbar-right">

            <?php if ($logged_in == 'yes') {   ?>

             


              <form method="post" action="tags.php" class="navbar-form navbar-left" role="search">
                <input type="text" class="form-control form_in" style="width:160px;" placeholder="Search Sweeba" name="tag"> <button type="submit" style="background-color:#ededed;" class="btn btn-search">Go</button>

              </form>
            <?php } ?>


            <ul class="nav navbar-nav navbar-right">

              <?php if ($logged_in == 'no') { ?>
                <ul class="nav navbar-nav navbar-right" style="font-family: 'Open Sans', sans-serif;">
                  <li><a href="../index.php"><img src="https://sweeba.com/dist/img/TQDIGBX.png" style="margin-top:-4px;"> Home</a></li>
                  <li><a href="../login.php"><img src="https://sweeba.com/dist/img/login.png" style="margin-top:-4px;"> Login</a></li>
                  <li><a href="../register.php"><img src="https://sweeba.com/dist/img/users81.png" style="margin-top:-4px;"> Register</a></li>
                </ul>
              <?php } else { ?>


                <li class="dropdown hidden-xs" style="height:50px;background:#eef0f2;">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="https://www.sweeba.com/grab_image.php?img=<?php echo $avatar; ?>" style="height:32px;width:32px;border-radius:3px;border-radius:100%;margin-top:-5px;"></a>

                  <ul class="dropdown-menu">
                    <li><a href="/dash.php"><img src="../images/TQDIGBX.png" style="margin-top:-4px;"> Dash</a></li>
                    <li class="random_1"><a href="random.php"><img src="/dist/img/random5.png" style="height:16px;width:16px;margin-top:-4px;"> Surf</a></li>
                    <li><a href="/<?php echo $username; ?>" style="text-decoration:none;"><img src="/grab_image.php?img=<?php echo $avatar; ?>" style="height:16px;width:16px;margin-top:-4px;"> Your Profile</a></li>
                    <li><a href="/sweeb.php"><img src="/dist/img/light.png" style="height:16px;width:16px;margin-top:-4px;"> New Sweeb</a></li>
                    <li><a href="/sweebs.php">
                        <font color="#5fb5f2">🔨</font> Manage Sweebs
                      </a></li>
                    <li><a href="stats_view.php">
                        <font color="#5fb5f2">📊</font> Sweeb Stats
                      </a></li>
                    <li><a href="/reset.php">
                        <font color="#5fb5f2">🔧</font> Update Account
                      </a></li>
                    <li><a href="/raffle.php"><img src="/dist/img/ticketssmall.png" style="height:16px;width:16px;margin-top:-4px;"> Winners</a></li>
                    <li><a href="/spin.php"><img src="/dist/img/wheel-icon.png" style="height:18px;width:18px;margin-top:-4px;"> Spin</a></li>
                    <li><a href="/leaderboard.php"><img src="https://sweeba.com/images/matches.png" width="16" height="16"> Leaderboard</a></li>
                    <li><a href="/upgrade.php"><img src="https://sweeba.com/images/upgrade-now.png" width="16" height="16"> Upgrade</a></li>
                    <li><a href="/purchase.php">
                        <font color="#5fb5f2">🛒</font> Buy Credits
                      </a></li>
                    <li><a href="/match.php"><img src="/images/sweeba-match.png" style="height:16px;width:16px;margin-top:-4px;"> Find Matches</a></li>
                    <li><a href="/matches.php">
                        <font color="#5fb5f2">🕯</font> Your Matches
                      </a></li>
                    <li><a href="/views.php"><img src="https://sweeba.com/images/views.png" width="16" height="16"> Profile Views</a></li>
                    <li><a href="/ring_history.php"><img src="https://sweeba.com/images/ring-diamond.png" width="16" height="16"> Ring History</a></li>
                    <li><a href="/notifications.php"><img src="/dist/img/notify.png" style="height:16px;width:16px;margin-top:0px;"> Notifications</a></li>
                    <li><a href="/my_followers.php"><img src="https://sweeba.com/dist/img/users6.png" width="16" height="16"> Followers</a></li>
                    <li><a href="/check_in.php"><img src="https://sweeba.com/dist/img/friends.png" width="16" height="16"> Check-in</a></li>
                    <li><a href="/message.php"><img src="/dist/img/email5.png" style="height:16px;width:16px;margin-top:-4px;"> Messages</a></li>
                    <li><a href="refs.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Refer Members</a></li>
                    <li><a href="support.php"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Support</a></li>
                    <?php if ($msg == 'yes') { ?>
                      <li><a href="/message.php"><img src="dist/img/email5.png" style="height:16px;width:16px;margin-top:-4px;"> New</a></li>
                      <li role="separator" class="divider"></li>

                    <?php } ?>
                    <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout</a></li>
                  </ul>
                </li>
            </ul>

          </ul>


          <ul class="nav navbar-nav navbar-right visible-xs" style="font-family: 'Open Sans', sans-serif;">
            <li><a href="/dash.php"><img src="../images/TQDIGBX.png" style="margin-top:-4px;"> Dash</a></li>
            <li class="random_1"><a href="/random.php"><img src="/dist/img/random5.png" style="height:16px;width:16px;margin-top:-4px;"> Surf</a></li>
            <li><a href="/<?php echo $username; ?>"><img src="/grab_image.php?img=<?php echo $avatar; ?>" width="16" height="16" style="height:16px;width:16px;margin-top:-4px;"> Your Profile</a></li>
            <li><a href="/sweeb.php"><img src="/dist/img/light.png" style="height:16px;width:16px;margin-top:-4px;"> New Sweeb</a></li>
            <li><a href="/sweebs.php">
                <font color="#5fb5f2">🔨</font> Manage Sweebs
              </a></li>
            <li><a href="/reset.php">
                <font color="#5fb5f2">🔧</font> Update Account
              </a></li>
            <li><a href="/spin.php"><img src="/dist/img/wheel-icon.png" style="height:16px;width:16px;margin-top:-4px;"> Spin</a></li>
            <li><a href="/leaderboard.php"><img src="https://sweeba.com/images/matches.png" width="16" height="16"> Leaderboard</a></li>
            <li><a href="/raffle.php"><img src="/dist/img/ticketssmall.png" style="height:16px;width:16px;margin-top:-4px;"> Winners</a></li>
            <li><a href="/upgrade.php"><img src="https://sweeba.com/images/upgrade-now.png" width="16" height="16"> Upgrade</a></li>
            <li><a href="/purchase.php">
                <font color="#5fb5f2">🛒</font> Buy Credits
              </a></li>
            <li><a href="/match.php"><img src="/images/sweeba-match.png" style="height:16px;width:16px;margin-top:-4px;"> Find Matches</a></li>
            <li><a href="/matches.php">
                <font color="#5fb5f2">🕯</font> Your Matches
              </a></li>
            <li><a href="/views.php"><img src="https://sweeba.com/images/views.png" width="16" height="16"> Profile Views</a></li>
            <li><a href="/ring_history.php"><img src="https://sweeba.com/images/ring-diamond.png" width="16" height="16"> Ring History</a></li>
            <li><a href="/notifications.php"><img src="/dist/img/notify.png" style="height:16px;width:16px;margin-top:0px;"> Notifications</a></li>
            <li><a href="/my_followers.php"><img src="https://sweeba.com/dist/img/users6.png" width="16" height="16"> Followers</a></li>
            <li><a href="/check_in.php"><img src="https://sweeba.com/dist/img/friends.png" width="16" height="16"> Check-in</a></li>
            <li><a href="/message.php"><img src="/dist/img/email5.png" style="height:16px;width:16px;margin-top:-4px;"> Messages</a></li>
            <li><a href="/trending.php">
                <font color="#5fb5f2">⦾</font> View Trending
              </a></li>
            <li><a href="/friends.php">
                <font color="#5fb5f2">🫂</font> Find Friends
              </a></li>
            <li><a href="refs.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Refer Members</a></li>
            <li><a href="support.php"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Support</a></li>
            <li><a href="/logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout</a></li>
            <?php if ($msg == 'yes') { ?>
              <li><a href="/message.php"><img src="dist/img/email5.png" style="height:16px;width:16px;margin-top:-4px;"> New</a></li>
              <li role="separator" class="divider"></li>
            <?php } ?>
          </ul>


          <ul class="nav navbar-nav navbar-right hidden-xs" style="font-family: 'Open Sans', sans-serif;">
            <?php if ($notifications >= 1) { ?>
              <li><a href="../notifications.php"> <img src="../dist/img/notify.png" style="height:16px;width:16px;margin-top:0px;"> <span style="color:#f44336;font-family: 'Open Sans', sans-serif;font-weight:bold;"><?php echo $notifications; ?></span></a></li>
            <?php } ?>
            <li class="random_4"><a href="https://sweeba.com/random.php"> <img src="/dist/img/random5.png" style="height:16px;width:16px;margin-top:-4px;"> Surf</a></li>
            <li><a href="../raffle.php"> <img src="../dist/img/ticketssmall.png" style="height:16px;width:16px;margin-top:-4px;"> Winners</a></li>
            <li><a href="../match.php"> <img src="../images/sweeba-match.png" style="height:16px;width:16px;margin-top:-4px;"> Match</a></li>
            <li><a href="https://sweeba.com/dash.php"><img src="../images/TQDIGBX.png" style="margin-top:-4px;">Dash</a></li>
            <li><a href="../sweeb.php"> <img src="../dist/img/light.png" style="height:16px;width:16px;margin-top:-4px;"> Sweeb</a></li>

            <?php if ($msg == 'yes') { ?>
              <li><a href="../message.php"> <img src="../dist/img/email5.png" style="height:16px;width:16px;margin-top:-4px;"> New</a></li>
            <?php } ?>
          </ul>
        <?php } ?>
        </div>
      </div>
    </nav>

    <div class="wrap" style="margin-top:120px;">

      <!-- Modal -->
      <script>
        /*function getVote(int) {
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("poll").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","/main/like_sweeb.php?id="+<?php echo $sweeb_id_from; ?>+"&vote="+int,true);
  xmlhttp.send();
}*/
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

          <div class="col-md-2 hidden-xs" style="padding:0px;">
            <div class="col-md-12" style="background:#fff;padding:0px;">
              <div style="padding:20px;">
                <p style="text-align:center;padding-top:10px;padding-bottom:10px;">
                  <img class="img" src="https://www.sweeba.com/grab_image.php?img=<?php echo $sweeb_avatar; ?>" style="min-height:1px;min-width:1px;height:120px;width:120px;border-radius:3px;border-radius:100%;">
                </p>

                <p style="text-align:center;color:#a9acb1;font-size:16px;"><?php echo $sweeb_username; ?></p>
                <center>
                  <p><a href="https://twitter.com/share" class="twitter-share-button" data-hashtags="Sweeba"></a>
                    <script>
                      ! function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0],
                          p = /^http:/.test(d.location) ? 'http' : 'https';
                        if (!d.getElementById(id)) {
                          js = d.createElement(s);
                          js.id = id;
                          js.src = p + '://platform.twitter.com/widgets.js';
                          fjs.parentNode.insertBefore(js, fjs);
                        }
                      }(document, 'script', 'twitter-wjs');
                    </script>
                  </p>
                  <p>
                  <div class="fb-share-button" data-href="https://www.sweeba.com/<?php echo $sweeb_id_from; ?>/<?php echo $sweeb_title; ?>" data-type="button_count">
                  </div>
                  </p>
                </center>
              </div>

              <div style="padding:5px;">
                <a href="/<?php echo $sweeb_username; ?>" class="btn btn-main btn-block" style="background:#5fb5f2;border:0px;color:#fff;">View Profile</a>
                <a href="/<?php echo $sweeb_username; ?>" class="btn btn-main btn-block" style="background:#5fb5f2;border:0px;color:#fff;">Follow Me</a>
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
            <?php if ($sweeb_title == 'new' && $user_id_sweeb == $user_id_sweeb) {
              echo '<div style="background:#2ecc71;padding:20px;text-align:center;color:#fff;margin-bottom:20px;">This is your new Sweeb! Share your new sweeb using the link below!<br>
https://www.sweeba.com/' . $sweeb_id_from . '/' . $slug_go . '</div>';
            } ?>
            <?php if ($sweeb_title == 'random' && $get_sweeb_id == 0) {
              echo '<div style="background:#2ecc71;padding:20px;color:#fff;margin-bottom:20px;">Click "next" button to view another random sweeb.<a href="random.php" style="margin-top:-6px;" class="pull-right btn btn-default">Next &raquo;</a></div>';
            } ?>
            <div style="background:#fff;">
              <div style="padding:20px;">



              <?php
              if (!isMobile()) {
                echo '<div style="padding:25px;padding-top:0px;padding-left:0px;padding-right:0px;"><h3 class="os" style="padding:0px;margin:0px;">';
                if ($title == NULL) {
                  echo $sweeb_username;
                } else {
                  echo $title;
                }
                echo '</h3>';
                echo '<p class="pull-right" style="font-weight:bold;border:2px solid #34495e;color:#34495e;padding:5px;margin-top:-28px;margin-left:5px;">' . $views . ' <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></p>';
                echo '<p class="pull-right" style="font-weight:bold;border:2px solid #2ecc71;color:#2ecc71;padding:5px;margin-top:-28px;margin-left:5px;">' . $comments_total . ' <span class="glyphicon glyphicon-comment" aria-hidden="true"></span></p>';
                echo '<p class="pull-right" style="font-weight:bold;border:2px solid #08afee;color:#08afee;padding:5px;margin-top:-28px;">' . time2str($datetime, 2) . '</p></div>';
              } else {
                echo '<div class="row" style="padding:0px;padding-top:20px;padding-bottom:20px;">
<div class="col-xs-6"><a href="/' . $sweeb_username . '" style="font-weight:bold;font-size:16px;color:#3e4851;margin-top:-20px;" class="pull-left">' . $sweeb_username . '</a></div>';

                echo '<div class="pull-right" style="font-weight:bold;background:#08afee;color:#fff;padding:5px;border-radius:3px;margin-top:-28px;margin-right:15px;">' . time2str($datetime, 2) . '</div></div>';
                echo '<p class="pull-right" style="font-weight:bold;border:2px solid #34495e;color:#34495e;padding:5px;margin-top:-18px;margin-left:5px;">' . $views . ' <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></p>';
                echo '<p class="pull-right" style="font-weight:bold;border:2px solid #2ecc71;color:#2ecc71;padding:5px;margin-top:-18px;margin-left:5px;">' . $comments_total . ' <span class="glyphicon glyphicon-comment" aria-hidden="true"></span></p>';
              }
              if ($image_str != NULL) {

                echo '<div style="text-align:center;width:100%;" border="0" frameborder="0" >';
                echo '<center><a href="' . $link . '" target="_blank" ><img src="https://www.sweeba.com/grab_image.php?img=' . $image_str . '"  border="0" frameborder="0" style="min-height:1px;min-width:1px;"max-width:100%;" width="320" ></a></center></div>';
              } elseif ($video_str != NULL) {
                echo '<div class="visible-xs" style="padding-top:20px;"></div>';
                echo '<div class="col-md-12" style="padding:0px;border:0px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;">
 <div class="youtubevideo">
    <iframe src="https://www.youtube.com/embed/' . $video_str . '?autoplay=0&showinfo=0&controls=1"  frameborder="0"  width="300" border="0" allowfullscreen></iframe>
</iframe></div><br>
    </div>';
              }
              echo '<h3 class="os visible-xs" style="padding:0px;margin:0px;">' . $row['title'] . '</h3><p style="padding:25px;color:#000;font-family: \'Open Sans\', sans-serif;word-wrap: break-word;font-size:16px;text-shadow:0px 1px 0px #fff;white-space: pre-line;" id="output">' . $content . '</p>';
              if (!empty($link)) {
                echo '<center><a href="' . $link . '" target="_blank" class="btn btn-success btn-block" style="width: 200px;"/>View Members Link</a></center>';
              }
            }
              ?>
              <?php if (isMobile()) { ?>
                <div class="row">
                  <div class="col-xs-12" style="padding:10px;">
                    <form method="post" id="form">
                      <div id="poll">

                        <div class="col-xs-6" style="padding-left:1px;padding:0px;">
                          <div class="up">
                            <button type="button" class="btn btn-link" name="vote" value="up" onclick="getVote(this.value)">
                              <span class="glyphicon glyphicon-fire" aria-hidden="true" style="height:25px;width:25px;margin-top:10px;color:#ff2500"></span>
                              <h4 style="color:#5b832b;font-weight:bold;padding:0px;margin:0px;" class="upCount"><?php echo $up_vote; ?></h4>
                            </button>
                          </div>
                        </div>

                        <div class="col-xs-6" style="padding:0px;">
                          <div class="down">
                            <button type="button" class="btn btn-link" name="vote" value="down" onclick="getVote(this.value)">
                              <span class="glyphicon glyphicon-fire" aria-hidden="true" style="height:25px;width:25px;margin-top:10px;color:#AEE1EC"></span>
                              <h4 style="color:#842d40;font-weight:bold;margin:0px;" class="downCount"><?php echo $down_vote; ?></h4>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>

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

                <style>
                  .text:nth-child(odd) {

                    background: #fff;
                    padding: 20px;
                  }

                  .text:nth-child(even) {
                    background: #eef0f2;
                    padding: 20px;
                  }
                </style>

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
                <form method="post" id="form">
                  <div id="poll">

                    <div class="col-md-6" style="padding-left:1px;padding:0px;">
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
                      </div>
                    </div>
                  <?php } ?>
                  </div>


              </div>
            </div>


            <style>
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
            </style>

            <?php
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
              if (empty($text)) {
                return 'n-a';
              }

              return $text;
            }

            function limit_text($text, $limit)
            {
              if (str_word_count($text, 0) > $limit) {
                $words = str_word_count($text, 2);
                $pos = array_keys($words);
                $text = substr($text, 0, $pos[$limit]) . '...';
              }
              return $text;
            }
            function time2str($ts)
            {
              if (!ctype_digit($ts))
                $ts = strtotime($ts);

              $diff = time() - $ts;
              if ($diff == 0)
                return 'now';
              elseif ($diff > 0) {
                $day_diff = floor($diff / 86400);
                if ($day_diff == 0) {
                  if ($diff < 60) return 'just now';
                  if ($diff < 120) return '1 minute ago';
                  if ($diff < 3600) return floor($diff / 60) . ' minutes ago';
                  if ($diff < 7200) return '1 hour ago';
                  if ($diff < 86400) return floor($diff / 3600) . ' hours ago';
                }
                if ($day_diff == 1) return 'Yesterday';
                if ($day_diff < 7) return $day_diff . ' days ago';
                if ($day_diff < 31) return ceil($day_diff / 7) . ' weeks ago';
                if ($day_diff < 60) return 'last month';
                return date('F Y', $ts);
              } else {
                $diff = abs($diff);
                $day_diff = floor($diff / 86400);
                if ($day_diff == 0) {
                  if ($diff < 120) return 'in a minute';
                  if ($diff < 3600) return 'in ' . floor($diff / 60) . ' minutes';
                  if ($diff < 7200) return 'in an hour';
                  if ($diff < 86400) return 'in ' . floor($diff / 3600) . ' hours';
                }
                if ($day_diff == 1) return 'Tomorrow';
                if ($day_diff < 4) return date('l', $ts);
                if ($day_diff < 7 + (7 - date('w'))) return 'next week';
                if (ceil($day_diff / 7) < 4) return 'in ' . ceil($day_diff / 7) . ' weeks';
                if (date('n', $ts) == date('n') + 1) return 'next month';
                return date('F Y', $ts);
              }
            }
            ?>

            <!-- Bootstrap core JavaScript
    ================================================== -->
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
            </script>
            </body>

  </html>