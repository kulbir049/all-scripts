<body>
  <div class="container" style="font-family: 'Open Sans', sans-serif;">
    <div class="row">
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

        .overflow {
          overflow: hidden;
          white-space: nowrap;
          text-overflow: ellipsis;
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
        <div class="row">

          <div class="col-md-11">

            <div class="col-md-8">
              <div class="col-md-12" style="padding:20px;">
                <div class="box" style="width:100%;">
                  <div class="col-md-12 backdrop">
                    <?php if (isset($_SESSION['user_id'])) { ?>
                      <a href="#" class="btn btn-main pull-left" style="background:#a2de5a;border:0px;color:#fff;margin-top:10px;"> <img src="images/king_premium.png" width="20px" height="18px" style="margin-top:-4px;"> Add Friend</a>
                      <?php } ?>


                    <?php if ($result_membership_count > 0) { ?>

                      <a href="https://sweeba.com/upgrade.php" class="btn btn-main pull-right" style="background:#a2de5a;border:0px;color:#fff;margin-top:10px;"> <img src="images/king_premium.png" width="20px" height="18px" style="margin-top:-4px;"> Premium</a>
                    <?php } ?>

                    <?php if ($is_featured_member == 1 && (strtotime('now') < $is_expiary_date)) { ?>
                      <button class="btn btn-success pull-right" style="background:#707044;border:0px;color:#fff;margin-top:10px;"> <img src="images/featured_member.png" width="20px" height="18px"> Featured Member</button>
                    <?php } ?>

                    <form method="post">
                      <?php if ($username == $get_username) {
                        if ($cur_user_id == $_SESSION['user_id']) { ?>
                          <a href="../reset.php" class="btn btn-main pull-right" style="background:#5fb5f2;border:0px;color:#fff;margin-top:10px;">Edit Your Profile</a>
                        <?php }
                      } elseif (!in_array($cur_user_id, $os)) { ?>
                        <button type="submit" name="follow" class="btn btn-success pull-right" style="margin-top:10px;">Follow <?php echo $get_username; ?> <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span></button>
                      <?php } else { ?>
                        <button type="submit" name="unfollow" class="btn btn-warning pull-right" style="margin-top:10px;">UnFollow <?php echo $get_username; ?> <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span></button>
                      <?php } ?>
                    </form>
                    <div style="text-align:center;margin-top:130px;">
                      <img src="grab_image.php?img=<?php echo $cur_user_avatar; ?>" style="height:100px;width:100px;">
                    </div>
                  </div>
                  <h2 style="text-align:center;padding-top:30px;"><?php echo $get_username; ?></h2>
                  <p><?php echo $cur_prof_desc; ?></p>
                </div>
              </div>

              <div class="col-md-12" style="margin:0px;">

                <div id="wrapper">
                  <div id="columns">

                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


                    <script src="profile.js?v=<?php echo time(); ?>"> </script>

                    <div id="content">


                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4" style="margin-top:20px;">
              <div class="col-md-12 box">
                <h3 style="margin-top:0px;color:#858585;">@<?php echo $get_username; ?></h3>

                <div class="col-md-12"><b style="color:#858585;">Sweebs</b>
                  <h4><?php echo $sweeb_count; ?></h4>
                </div>
                <div class="col-md-12"><b style="color:#858585;">Followers</b>
                  <h4><?php echo $cur_followers; ?></h4>
                </div>
                <div class="col-md-12"><b style="color:#858585;">Following</b>
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

                  <b style="color:#858585;"> <?php echo ucwords($get_username); ?>'s Links <img src="images/website-link.png" width="28"></b>

                  <h4 class="overflow"><a href="<?php echo $link_1; ?>" target="_blank"> <?php echo $title_1; ?></a></h4>
                  <h4 class="overflow"><a href="<?php echo $link_2; ?>" target="_blank"> <?php echo $title_2; ?></a></h4>
                  <h4 class="overflow"><a href="<?php echo $link_3; ?>" target="_blank"> <?php echo $title_3; ?></a></h4>
                </div>
                <div class="col-md-12"><b style="color:#858585;">Address</b>
                  <h4><?php echo $user_address; ?></h4>
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
                    <div class="col-md-12"><b style="color:#5cb85c;"><a href="dash.php" class="btn btn-success pokeRingFlirt">👉 <b>Flirt with me</b></a></div>

                  <?php  } else { ?>
                    <div class="col-md-12"><b style="color:#858585;">Relationship Status</b><b style="color:#858585;">
                        <h4><?php echo ucfirst($cur_user_relationship); ?></h4>
                    </div>
                    <div class="col-md-12"><b style="color:#858585;font-size:16px;"><a href="poke.php?poke_user=<?php echo $cur_user_id; ?>" class="btn btn-success pokeRingFlirt">☝️ <b>Poke me</b></a></div>
                  <?php } ?>
                <?php } ?>
                <br>
                <?php if ($run->num_rows > 0) { ?>
                  <div class="col-md-12" style="margin-top:5px;"><b style="color:#858585;font-size:16px;"><a href="message.php" class="btn btn-success"><b>Message Me</b></a></div>
                <?php } ?>
                <?php if ($_SESSION['user_id'] != $cur_user_id) {
                  $ring = getRingCount($_SESSION['user_id'], $conn, $cur_user_id);
                  echo $ring;
                } ?>





              </div>





              <?php include('main/ad_code2.php');

              //insert view profile user
              $sql_profile = "SELECT * FROM view_profiles WHERE from_user_id='" . $_SESSION['user_id'] . "' AND to_user_id ='" . $cur_user_id . "'";
              // $result_profile = $conn->query($sql_profile);
              // if ($result_profile->num_rows < 1 && $_SESSION['user_id']>0) {
              if ($_SESSION['user_id'] != $cur_user_id) {
                $user_details = getUserDetail($_SESSION['user_id'], $conn);
                $username = $user_details['username'];
                $country = $user_details['country'];
                $date = date('Y-m-d');
                $insert_profile = "INSERT INTO view_profiles (`from_user_id`,`to_user_id`,`country`,`created_at`) VALUES('" . $_SESSION['user_id'] . "','$cur_user_id','$country','$date') ";
                $conn->query($insert_profile);

                $sqlz = "INSERT INTO activity (id, user_id, action, created_date) VALUES (NULL, '$cur_user_id', '<a href=\"https://www.sweeba.com/$username\"> $username </a>  viewed Your profile.', '$date')";
                if ($conn->query($sqlz) === TRUE) {
                  header("Location: ../dash.php");
                }
                //update owner
                $sqlt = "UPDATE members SET notif=notif+1 WHERE id='$cur_user_id' Limit 1";
                mysqli_query($conn, $sqlt);
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
        <script>
          // $(document).ready(function() {

          //   $('#content').scrollPagination({

          //     nop: 5, // The number of posts per scroll to be loaded
          //     offset: 0, // Initial offset, begins at 0 in this case
          //     error: 'You Made It To The Last Sweeb!', // When the user reaches the end this is the message that is
          //     // displayed. You can change this if you want.
          //     delay: 500, // When you scroll down the posts will load after a delayed amount of time.
          //     // This is mainly for usability concerns. You can alter this as you see fit
          //     scroll: true // The main bit, if set to false posts will not load as the user scrolls.
          //     // but will still load if the user clicks.

          //   });

          // });
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