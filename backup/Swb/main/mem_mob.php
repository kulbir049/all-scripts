<body>
  <style>
    .backdrop {
      background: url(grab_image.php?img=<?php echo $cur_bg_wall; ?>);
      height: 200px;
      margin-bottom: 40px;
      border-radius: 3px;

    }

    .circle {
      width: 15px;
      height: 15px;
      background-color: red;
      border-radius: 30px 30px 30px 23px;
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
      font-weight: bold;
    }

    btn-danger2 {
      color: #fff;
      background-color: #5cb85c;
      border-color: #4cae4c;
    }

    .pokeRingFlirt {
      color: #fff !important;
      background-color: #5cb85c !important;
      border-color: #4cae4c !important;
    }
  </style>
  <?php
  $sql_match = "SELECT m1.*
FROM `match` m1
JOIN `match` m2 ON m1.from_user_id ='" . $cur_user_id . "' AND m1.to_user_id ='" . $_SESSION['user_id'] . "' AND m1.status = 1
               AND m2.from_user_id = '" . $_SESSION['user_id'] . "' AND m2.to_user_id = '" . $cur_user_id . "' AND m2.status = 1";

  $run = $conn->query($sql_match);



  ?>
  <div class="container">
    <div class="col-xs-12" style="padding:20px;">
      <div class="box" style="width:100%;">
        <div class="col-xs-12">
          <?php if ($result_membership_count > 0) { ?>

            <a href="#" class="btn btn-main pull-right" style="background:#a2de5a;border:0px;color:#fff;margin-top:10px;"><span alt="👑">👑</span> Premium</a>
          <?php } ?>
          <?php if ($is_featured_member == 1) { ?>
            <button class="btn btn-success pull-right" style="background:#707044;border:0px;color:#fff;margin-top:10px;"> <img src="images/featured_member.png" width="20px" height="18px"> Featured</button>
          <?php } ?>
          <form method="post">
            <?php if ($username == $get_username) { ?>
              <a href="../reset.php" class="btn btn-main pull-right" style="background:#5fb5f2;border:0px;color:#fff;margin-top:10px;">Edit Profile</a>
            <?php } elseif (!in_array($cur_user_id, $os)) { ?>
              <button type="submit" name="follow" class="btn btn-success pull-right" style="margin-top:10px;">Follow <?php echo $get_username; ?> <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span></button>
            <?php } else { ?>
              <button type="submit" name="unfollow" class="btn btn-warning pull-right" style="margin-top:10px;">UnFollow <?php echo $get_username; ?> <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span></button>
            <?php } ?>
          </form>
          <div style="text-align:center;margin-top:130px;">
            <img src="grab_image.php?img=<?php echo $cur_user_avatar; ?>" style="height:100px;width:100px;" width="100" height="100">
          </div>
        </div>

        <h2 style="text-align:center;padding-top:30px;"><?php echo $get_username; ?></h2>
        <p><?php echo $cur_prof_desc; ?></p>
      </div>
    </div>

    <div class="col-xs-12" style="margin-top:20px;">
      <div class="col-xs-12 box">
        <h3 style="margin-top:0px;color:#858585;">@<?php echo $get_username; ?></h3>

        <div class="col-xs-4"><b style="color:#858585;">Sweebs</b>
          <h4><?php echo $sweeb_count; ?></h4>
        </div>
        <div class="col-xs-4" style="padding:0px;"><b style="color:#858585;">Followers</b>
          <h4><?php echo $cur_followers; ?></h4>
        </div>
        <div class="col-xs-4"><b style="color:#858585;">Following</b>
          <h4><?php echo $cur_friends_num; ?></h4>
        </div>


        <div class="col-md-12">
          <?php

          $title_1 = '';
          $title_2 = '';
          $title_3 = '';
          $link_1 = '';
          $link_2 = '';
          $link_3 = '';
          if (isset($social_links_json) && !empty($social_links_json)) {
            $social_links = json_decode($social_links_json);
            $title_1 = $social_links[0][0];
            $title_2 = $social_links[1][0];;
            $title_3 = $social_links[2][0];;
            $link_1 = $social_links[0][1];
            $link_2 = $social_links[1][1];
            $link_3 = $social_links[2][1];
          }

          ?>

          <b style="color:#858585;"><?php echo ucwords($get_username); ?> Links</b>

          <h4><a href="<?php echo $link_1; ?>"> <?php echo $title_1; ?></a></h4>
          <h4><a href="<?php echo $link_2; ?>"> <?php echo $title_2; ?></a></h4>
          <h4><a href="<?php echo $link_3; ?>"> <?php echo $title_3; ?></a></h4>
        </div>

        <div class="col-md-12"><b style="color:#858585;">Date Joined</b>
          <h4><?php echo $date_Joined; ?></h4>
        </div>


        <?php
        if (isset($_SESSION['user_id'])  && $_SESSION['user_id'] == $cur_user_id) { ?>
          <div class="col-md-12"><b style="color:#858585;">Relationship Status</b>
            <h4><?php echo ucfirst($cur_user_relationship); ?></h4>
          </div>
        <?php } else { ?>
          <?php if ($cur_user_relationship == 'single') { ?>
            <div class="col-md-12"><b style="color:#858585;">Relationship Status</b>
              <h4><?php echo ucfirst($cur_user_relationship); ?></h4>
            </div>
            <div class="col-md-12"><b style="color:#5cb85c;"><a href="dash.php" class="btn btn-success pokeRingFlirt">🖤 <b>Flirt with me</b></a></div>

          <?php  } else { ?>
            <div class="col-md-12"><b style="color:#858585;"><?php echo ucfirst($cur_user_relationship); ?></div>
            <div class="col-md-12"><b style="color:#858585;font-size:16px;"><a href="poke.php?poke_user=<?php echo $cur_user_id; ?>" class="btn btn-success pokeRingFlirt">☝️ <b>Poke me</b></a></div>
          <?php } ?>
        <?php } ?>
        <br>
        <?php if ($run->num_rows > 0) { ?>
          <div class="col-md-12" style="margin-top:5px;"><b style="color:#858585;"><a href="message.php" class="btn btn-success">Message</a></div>
        <?php } ?>
        <?php if ($_SESSION['user_id'] != $cur_user_id) {
          $ring = getRingCount($_SESSION['user_id'], $conn, $cur_user_id);
          echo $ring;
        } ?>
      </div>

    </div>
    <div class="col-xs-12" style="margin:0px;">

      <?php

      $sql = "SELECT *  FROM sweebs WHERE user_id='$cur_user_id' AND status='active' ORDER BY id DESC";
      $result = $conn->query($sql);
      while ($row = $result->fetch_assoc()) {
        $user_id_sweeb = $row['user_id'];
        $sweeb_id_cur = $row['id'];
        $image_str = $row['image'];
        $video_str = $row['video'];
        $content = $row['content'];
        $title = $row['title'];
        $datetime = strtotime($row['date']);
        $words1 = str_word_count($content);


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

        $link = base64_encode($sweeb_id_cur);

        $content = $row['content'];
        $image_str = $row['image'];

        $content = substr($content, 0, 50) . '...';


        echo '<div class="col-xs-12 box" style="padding:0px;margin-left:-1px;">';
        echo '<div class="col-xs-12" style="margin:0px;margin-bottom:5px;padding:20px;padding-right:30px;">';
        echo '<a href="/' . $row['username'] . '" style="font-weight:bold;font-size:16px;color:#3e4851;" class="pull-left">' . $row['username'] . '</a>';
        echo '<p style="font-weight:bold;font-size:14px;color:#3e4851;" class="pull-right">' . time2str($datetime) . '</p><br>';
        echo '<div class="visible-xs" style="padding-top:10px;"></div>';
        if ($image_str != NULL) {
          echo '<div class="visible-xs" style="padding-top:20px;"></div>';
          echo '<div class="col-md-12 col-xs-12" style="padding:0px;border:1px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;"><img src="grab_image.php?img=' . $row['image'] . '" width="280" style="min-height:1px;min-width:1px;max-height:250px;max-width:100%;border-radius:3px;"></div>';
        } elseif ($video_str != NULL) {
          echo '<div class="visible-xs" style="padding-top:20px;"></div>';
          echo '<div class="col-md-12 col-xs-12" style="padding:0px;border:1px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;">';

          echo '<iframe width="210" height="300" src="https://www.youtube.com/embed/' . $video_str . '?autoplay=0&showinfo=0&controls=0"" frameborder="0" allowfullscreen></iframe>
</iframe>';


          echo '</div>';
        }

        echo '<h3 style="color:#5aa7de;font-size:18px;font-weight:Bold;">' . $row['title'] . '</h3>';
        echo '<p style="word-break: break-all;color:#8a9cac;" id="output">' . $content . '</p>';
        echo '<span style="font-weight:bold;color:#8094a5;font-size:14px;padding-right:14px;">' . $row['up'] . ' <img src="images/jOiTl3b.png"></span>';
        echo '<span style="font-weight:bold;color:#8094a5;font-size:14px;padding-right:14px;">' . $row['down'] . ' <img src="images/h45ZLRD.png"></span>';
        echo '<span style="font-weight:bold;color:#8094a5;font-size:14px;">' . $row['comments'] . ' <img src="images/dg7mOfT.png"></span>';
        echo '<a href="/' . $row['id'] . '/' . $slug_go . '" class="btn btn-main pull-right">Check it out!</a>';
        echo '</div></div>';
      }
      //insert view profile user
      $sql_profile = "SELECT * FROM view_profiles WHERE from_user_id='" . $_SESSION['user_id'] . "' AND to_user_id ='" . $cur_user_id . "'";
      $result_profile = $conn->query($sql_profile);
      if ($result_profile->num_rows < 1 && $_SESSION['user_id'] > 0) {
        $user_details = getUserDetail($_SESSION['user_id'], $conn);
        $country = $user_details['country'];
        $date = date('Y-m-d');
        $insert_profile = "INSERT INTO view_profiles (`from_user_id`,`to_user_id`,`country`,`created_at`) VALUES('" . $_SESSION['user_id'] . "','$cur_user_id','$country','$date') ";
        $conn->query($insert_profile);
      }

      ?>

    </div>



  </div>
  </div>
  <?php
  function getUserDetail($userId, $conn)
  {
    $data = array();
    $sql = "SELECT * FROM  members WHERE id =" . $userId . "";
    $result = $conn->query($sql);
    $check = false;
    if ($result->num_rows > 0) {

      $check = true;
    }
    if ($check == true) {
      while ($row = $result->fetch_assoc()) {
        $data['name'] = $row['name'];
        $data['avatar'] =  $row['avatar'];
        $data['user_id'] = $row['id'];
        $data['username'] =  $row['username'];
        $data['country']  =  $row['location'];
      }
    }
    return $data;
  }

  function getRingCount($userId, $conn, $cur_user_id)
  {
    $data = array();
    $sql = "SELECT * FROM  subscription WHERE user_id =" . $userId . " AND status ='Success' ";
    $result = $conn->query($sql);

    $check = false;
    if ($result->num_rows > 0) {

      $check = true;
    }
    if ($check == true) {
      $today = date("Y-m-d"); // Get the current date in the format "YYYY-MM-DD"
      $startOfDay = $today . " 00:00:00";
      $endOfDay = $today . " 23:59:59";

      $sql = "SELECT COUNT(*) AS count FROM rings WHERE from_user_id = " . $userId . " AND created >= '" . $startOfDay . "' AND created <= '" . $endOfDay . "'";
      $result = $conn->query($sql);
      //  <div class="col-md-12" style="margin-top:5px;"><b style="color:#858585;"><a href="ring.php?ring_user='.$cur_user_id.'" class="btn btn-success" data-toggle="modal" data-target="#myModal">Ring Me <span class="circle">2</span></a></div>

      if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $count = $row['count'];
        if ($count  == 1) {
          $ring = '<div class="col-md-12" style="margin-top:5px;"><b style="color:#d9534f;"><a href="javascript:void(0)" class="btn btn-success pokeRingFlirt" style="border:0px;background:#d9534f;font-size:15px;" data-toggle="modal" data-target="#myModal">💍  <b>Send Ring (2)</b></a></div>';
        } elseif ($count  == 2) {
          $ring = '<div class="col-md-12" style="margin-top:5px;"><b style="color:#d9534f;"><a href="javascript:void(0)" class="btn btn-success pokeRingFlirt" style="border:0px;background:#d9534f;font-size:15px;" data-toggle="modal" data-target="#myModal">💍  <b>Send Ring (1)</b></a></div>';
        } elseif ($count  == 3) {
          $ring = '<div class="col-md-12" style="margin-top:5px;"><b style="color:#d9534f;"><a href="javascript:void(0)" class="btn btn-success pokeRingFlirt" style="border:0px;background:#d9534f;font-size:15px;">💍  <b>Send Ring (0)</b></a></div>';
        } else {
          $ring = '<div class="col-md-12" style="margin-top:5px;"><b style="color:#d9534f;"><a href="javascript:void(0)" class="btn btn-success pokeRingFlirt" style="border:0px;background:#d9534f;font-size:15px;" data-toggle="modal" data-target="#myModal">💍  <b>Send Ring (3)</b></a></div>';
        }
      } else {
        $ring = '<div class="col-md-12" style="margin-top:5px;"><b style="color:#d9534f;"><a href="javascript:void(0)" class="btn btn-success pokeRingFlirt" style="border:0px;background:#d9534f;font-size:15px;" data-toggle="modal" data-target="#myModal">💍  <b>Send Ring (3)</b></a></div>';
      }
    } else {
      $today = date("Y-m-d"); // Get the current date in the format "YYYY-MM-DD"
      $startOfDay = $today . " 00:00:00";
      $endOfDay = $today . " 23:59:59";

      $sql = "SELECT COUNT(*) AS count FROM rings WHERE from_user_id = " . $userId . " AND created >= '" . $startOfDay . "' AND created <= '" . $endOfDay . "'";
      $result = $conn->query($sql);
      if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $count = $row['count'];
        if ($count  == 1) {
          $ring = '<div class="col-md-12" style="margin-top:5px;"><b style="color:#d9534f;"><a href="javascript:void(0)" class="btn btn-success pokeRingFlirt" style="border:0px;background:#d9534f;font-size:15px;">💍  <b>Send Ring (0)</b></a></div>';
        } else {
          $ring = '<div class="col-md-12" style="margin-top:5px;"><b style="color:#d9534f;"><a href="javascript:void(0)" class="btn btn-success pokeRingFlirt" style="border:0px;background:#d9534f;font-size:15px;" data-toggle="modal" data-target="#myModal1">💍  <b>Send Ring (1)</b></a></div>';
        }
      } else {
        $ring = '<div class="col-md-12" style="margin-top:5px;"><b style="color:#d9534f;"><a href="javascript:void(0)" class="btn btn-success pokeRingFlirt" style="border:0px;background:#d9534f;font-size:15px;" data-toggle="modal" data-target="#myModal1">💍  <b>Send Ring (1)</b></a></div>';
      }
    }

    return $ring;
  }

  ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        </div>

        <!-- Modal Body with Radio Buttons and Images -->
        <form action="ring.php" method="post">
          <div class="modal-body">
            <label style="cursor: pointer;">
              <input type="radio" name="type" value="Diamond" required>
              <img src="images/ring-diamond.png" class="img-responsive" alt="Diamond" title="Diamond" width="100px" height="100px"><br />
              <p style="color: black;">Diamond</p>
            </label>

            <label style="cursor: pointer;">
              <input type="radio" name="type" value="Gold" required>
              <img src="images/ring-gold.jpeg" class="img-responsive" alt="Gold" title="Gold" width="100px" height="100px"><br />
              <p style="color: black;">Gold</p>
            </label>
            <input type="hidden" name="ring_user" value="<?= $cur_user_id ?>">
            <label style="cursor: pointer;">
              <input type="radio" name="type" value="Silver" required>
              <img src="images/ring-silver.png" class="img-responsive" alt="Silver" title="Silver" width="100px" height="100px"><br />
              <p style="color: black;"> Silver</p>
            </label>
            <label>
              <button type="submit" class="btn btn-success" style="position: absolute;bottom: 55px;">Send</button>
            </label>
          </div>
        </form>

        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-primary" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

  <div class="modal fade" id="myModal1">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        </div>

        <!-- Modal Body with Radio Buttons and Images -->
        <form action="ring.php" method="post">
          <div class="modal-body">
            <input type="hidden" name="ring_user" value="<?= $cur_user_id ?>">
            <label>
              <input type="radio" name="type" value="Silver" required>
              <img src="images/ring-silver.png" class="img-responsive" alt="Silver" title="Silver" width="100px" height="100px">
            </label>
            <label>
              <button type="submit" class="btn btn-success" style="position: absolute;bottom: 55px;">Send</button>
            </label>
          </div>
        </form>

        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-primary" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>