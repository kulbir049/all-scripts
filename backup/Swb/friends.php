<?php include('main/config.php');
include('main/functions.php');

// if($logged_in == 'no'){
// header("Location: index.php");
// }
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

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

        .loader {
          display: inline-block;
          border: 4px solid #f3f3f3;
          border-top: 4px solid #3498db;
          border-radius: 50%;
          width: 20px;
          height: 20px;
          animation: spin 1s linear infinite;
        }

        @keyframes spin {
          0% {
            transform: rotate(0deg);
          }

          100% {
            transform: rotate(360deg);
          }
        }

        .error {
          color: red;
          font-size: 14px;
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
            <a href="trending.php" style="font-size:14px;font-weight:Bold;">Explore</a>
          </p>
        </div>
      </div>

      <div class="col-md-4 col-xs-4" style="padding:0px;">
        <div class="col-md-12 sweeb_b sweeb_r">
          <p style="text-align:center;padding-top:20px;">
            <a href="friends.php"><img src="dist/img/friends.png" style="padding-bottom:5px;"></a><br>
            <a href="friends.php" style="font-size:14px;font-weight:Bold;">Connect</a>
          </p>
        </div>
      </div>


      <div class="col-md-12" style="margin-left:-1px;padding:0px;">
        <script>
          // function showResult(str) {
          //   if (str.length == 0) {
          //     document.getElementById("livesearch").innerHTML = "";
          //     document.getElementById("livesearch").style.border = "0px";
          //     return;
          //   }
          //   if (window.XMLHttpRequest) {
          //     // code for IE7+, Firefox, Chrome, Opera, Safari
          //     xmlhttp = new XMLHttpRequest();
          //   } else { // code for IE6, IE5
          //     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          //   }
          //   xmlhttp.onreadystatechange = function() {
          //     if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          //       document.getElementById("livesearch").innerHTML = xmlhttp.responseText;
          //       document.getElementById("livesearch").style.border = "0px";
          //     }
          //   }
          //   xmlhttp.open("GET", "friends_find.php?q=" + str, true);
          //   xmlhttp.send();
          // }
          function showResult(str) {

            const livesearch = document.getElementById("livesearch");

            if (str.length == 0) {
              livesearch.innerHTML = "";
              livesearch.style.border = "0px";
              return;
            }

            // Show loader
            livesearch.innerHTML = "<div class='loader'>.</div>";
            livesearch.style.border = "1px solid #ccc"; // Add a border for the loader visibility

            let xmlhttp;

            if (window.XMLHttpRequest) {
              // code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp = new XMLHttpRequest();
            } else {
              // code for IE6, IE5
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function() {
              if (xmlhttp.readyState == 4) {
                if (xmlhttp.status == 200) {
                  // Replace loader with the response text
                  livesearch.innerHTML = xmlhttp.responseText;
                } else {
                  // Show error message if request fails
                  livesearch.innerHTML = "<div class='error'>Error loading data.</div>";
                }
                livesearch.style.border = "0px";
              }
            };

            xmlhttp.open("GET", "friends_find.php?q=" + encodeURIComponent(str), true);
            xmlhttp.send();
          }
        </script>

        <div class="col-md-12 box" style="width:100%;padding:0px;margin-bottom:10px;margin-left:-1px;">
          <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;font-family: 'Open Sans', sans-serif;">
            Find Friends!
          </div>
          <div style="padding:20px;color:#3e4851;text-align:center;font-size:16px;width:100%;">
            <p>To find new friends, enter their username in the field below <b> OR</B> refresh the page to see 50 new random members.</p><br>
            <form method="post">
              <input type="text" id="form_in_search" class="form-control form_in" onkeyup="showResult(this.value)" placeholder="Username">
            </form>
          </div>
        </div>

        <div id="livesearch">

          <?php
          $friends = '' . $friends . ',' . $user_id . '';
          //   $os = explode(",", $friends);
          //  //AND status = 'accepted'
          //   //$sql = "SELECT id, username, avatar FROM members ORDER BY rand() Limit 50";
          //   $sql="SELECT members.* FROM members
          //   WHERE id IN ( SELECT receiver_id FROM friend_requests
          //   WHERE sender_id = $user_id_sess
          //   UNION
          //   SELECT sender_id FROM friend_requests WHERE receiver_id = $user_id_sess) or id IN (".implode(',',$os).')";
          // Exploding the string of friends into an array
          $os = explode(",", $friends);

          // Sanitize the user ID to prevent SQL injection
          $user_id_sess = intval($user_id_sess);

          // Prepare the SQL query
          //   $sql = "
          //     SELECT members.*
          //     FROM members
          //     WHERE id IN (
          //         SELECT receiver_id
          //         FROM friend_requests
          //         WHERE sender_id = $user_id_sess
          //         UNION
          //         SELECT sender_id
          //         FROM friend_requests
          //         WHERE receiver_id = $user_id_sess
          //     )
          //     OR id IN (" . implode(',', array_map('intval', $os)) . ")
          // ";
          // $sql = "
          //     SELECT members.*,
          //           friend_requests.status
          //     FROM members
          //     LEFT JOIN friend_requests
          //         ON (members.id = friend_requests.receiver_id AND friend_requests.sender_id = $user_id_sess)
          //         OR (members.id = friend_requests.sender_id AND friend_requests.receiver_id = $user_id_sess)
          //     WHERE  members.id!=$user_id_sess AND (members.id IN (
          //         SELECT receiver_id
          //         FROM friend_requests
          //         WHERE sender_id = $user_id_sess
          //         UNION
          //         SELECT sender_id
          //         FROM friend_requests
          //         WHERE receiver_id = $user_id_sess
          //     )
          //     OR members.id IN (" . implode(',', array_map('intval', $os)) . "))
          //     GROUP BY members.id
          //     ORDER BY
          //         CASE
          //             WHEN friend_requests.status = 'pending' THEN 1
          //             WHEN friend_requests.status = 'accepted' THEN 2
          //             ELSE 3
          //         END,
          //         members.id ASC
          //  limit 20";
          $sql_friend_requests = "
                      SELECT fr.sender_id, fr.receiver_id, fr.status
                      FROM friend_requests fr
                      WHERE fr.sender_id = $user_id_sess
                      ORDER BY
                          CASE
                              WHEN fr.status = 'pending' THEN 1
                              WHEN fr.status = 'accepted' THEN 2
                              ELSE 3
                          END
                      LIMIT 20";





          // Debugging: Uncomment to view the generated SQL
          // echo $sql;

          //dd($sql_friend_requests);
          $result = $conn->query($sql_friend_requests);
          //dd($result->num_rows);

          if ($result->num_rows > 0) {
            // output data of each row
            while ($row_friends = $result->fetch_assoc()) {

              $sql = "
                      SELECT members.*
                      FROM members
                      WHERE id=" . $row_friends['receiver_id'];
              $result_m = $conn->query($sql);

              $row = $result_m->fetch_assoc();
              //dd($row);
              $username_search = $row['username'];
              $cur_user_id = $row['id'];
              echo '<div class="box" style="width:100%;padding:10px;margin-bottom:10px;margin-left:-1px;">';
              echo '<div class="col-md-2" style="padding:0px;"><a href="/' . $row['username'] . '"><img class="pull-left avatar" style="height:80px;width:80px;margin-top:-4px;margin-right:10px;"src="grab_image.php?img=' . $row['avatar'] . '"></a></div>';
              echo '<div class="col-md-10"><p style="font-weight:bold;font-size:16px;color:#3e4851;"><a href="/' . $row['username'] . '">' . $row['username'] . '</a></p>';
              if ($username == $username_search) {
              } elseif (!in_array($cur_user_id, $os)) {

                echo '<form method="post" action="/' . $row['username'] . '">';
                echo '<button type="submit" name="follow" class="btn btn-info pull-left" style="border:0px;background:#5fb5f2;margin-right:5px;margin-top:4px;">Follow ' . $row['username'] . ' <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span></button>
    </form>';
              } else {
                echo '<a href="/' . $row['username'] . '" class="btn btn-success pull-left" style="border:0px;background:#f26986;margin-right:5px;">Following ' . $row['username'] . '!</a>';
              }

              echo getFriendsButtonType($conn, $user_id_sess, $row['id']);
              echo '</div></div>';
            }
          }
          ?>

        </div>




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


  function sendFriendRequest(senderId, receiverId) {
    $.ajax({
      url: 'ajax_custom.php', // Your PHP file that processes the friend request
      method: 'POST',
      data: {
        action: 'send_request', // Action to send a friend request
        senderId: senderId,
        receiverId: receiverId
      },
      dataType: 'json',
      success: function(response) {
        alert(response.message);
        setTimeout(function() {
          var searchtext = $('#form_in_search').val();
          if (searchtext.length > 1) {
            showResult(searchtext);
          } else {
            location.reload();
          }
        }, 500);
        $('#responseMessage').html(response.message); // Show response message
      },
      error: function() {
        alert('Error while sending the request.');
        $('#responseMessage').html('Error while sending the request.');
      }
    });


  }

  function acceptFriendRequest(senderId, receiverId) {
    $.ajax({
      url: 'ajax_custom.php', // Your PHP file that processes the friend request
      method: 'POST',
      data: {
        action: 'accept_request', // Action to accept a friend request
        senderId: senderId,
        receiverId: receiverId
      },
      dataType: 'json',
      success: function(response) {
        alert(response.message);
        setTimeout(function() {
          var searchtext = $('#form_in_search').val();
          if (searchtext.length > 1) {
            showResult(searchtext);
          } else {
            location.reload();
          }
        }, 500);
        $('#responseMessage').html(response.message); // Show response message
        location.reload();
      },
      error: function() {
        alert('Error while accepting the request.');
        $('#responseMessage').html('Error while accepting the request.');
      }
    });


  }

  function cancelFriendRequest(senderId, receiverId) {
    $.ajax({
      url: 'ajax_custom.php', // Your PHP file that processes the friend request
      method: 'POST',
      data: {
        action: 'cancel_request', // Action to cancel a friend request
        senderId: senderId,
        receiverId: receiverId
      },
      dataType: 'json',
      success: function(response) {
        alert(response.message);
        setTimeout(function() {
          var searchtext = $('#form_in_search').val();
          if (searchtext.length > 1) {
            showResult(searchtext);
          } else {
            location.reload();
          }
        }, 500);
        $('#responseMessage').html(response.message); // Show response message
      },
      error: function() {
        alert('Error while canceling the request.');
        $('#responseMessage').html('Error while canceling the request.');
      }
    });


  }

  function unFriendRequest(senderId, receiverId) {
    $.ajax({
      url: 'ajax_custom.php', // Your PHP file that processes the friend request
      method: 'POST',
      data: {
        action: 'unFriend_request', // Action to cancel a friend request
        senderId: senderId,
        receiverId: receiverId
      },
      dataType: 'json',
      success: function(response) {
        alert(response.message);
        setTimeout(function() {
          var searchtext = $('#form_in_search').val();
          if (searchtext.length > 1) {
            showResult(searchtext);
          } else {
            location.reload();
          }
        }, 500);
        $('#responseMessage').html(response.message); // Show response message

      },
      error: function() {
        alert('Error while canceling the request.');
        $('#responseMessage').html('Error while canceling the request.');
      }
    });


  }

  function declineFriendRequest(senderId, receiverId) {
    $.ajax({
      url: 'ajax_custom.php', // Your PHP file that processes the friend request
      method: 'POST',
      data: {
        action: 'decline_request', // Action to decline a friend request
        senderId: senderId,
        receiverId: receiverId
      },
      dataType: 'json',
      success: function(response) {
        alert(response.message);
        setTimeout(function() {
          var searchtext = $('#form_in_search').val();
          if (searchtext.length > 1) {
            showResult(searchtext);
          } else {
            location.reload();
          }
        }, 500);
        $('#responseMessage').html(response.message); // Show response message
      },
      error: function() {
        alert('Error while declining the request.');
        $('#responseMessage').html('Error while declining the request.');
      }
    });

  }
</script>
<?php include('chat.php'); ?>


</body>

</html>