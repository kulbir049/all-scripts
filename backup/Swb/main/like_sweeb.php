<?php
include_once('config.php');


$vote = test_input($_GET['vote']);
$id = test_input($_GET['id']);
$date = date('Y-m-d H:i:s');
$Err = 0;

//Check if votes are correct
if ($vote == 'up') {
  $vote = 'up';
} elseif ($vote == 'down') {
  $vote = 'down';
} else {
  $vote = Null;
}
//end check

//check if anything is null
if ($id == NULL or $vote == NULL) {
  $Err = 1;
} elseif ($vote == NULL) {
  $Err = 1;
}
//END Check

//check if sweeb exists and grab votes
$sql = "SELECT up, down, user_id FROM sweebs WHERE id='$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while ($ro = $result->fetch_assoc()) {
    $sweeb_id_up = $ro['up'];
    $sweeb_id_down = $ro['down'];
    $user_id_owner = $ro['user_id'];
  }
} else {
  $Err = 1;
}

//End it


if ($Err == 1) {
  echo '<div class="alert alert-error">An error has occurred.</div>';
} elseif ($user_id == NULL) {
  echo '<div class="alert alert-error"><a href="https://www.sweeba.com/register.php">Signup</a> or <a href="https://www.sweeba.com/login.php">Login</a> to join in on the fun!</div>';
} else {

  //the votes
  $sql = "SELECT id, type FROM likes WHERE user_id='$user_id' AND sweeb_id='$id'";
  $result = $conn->query($sql);
  if ($result->num_rows >= 1) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $vote_id = $row['id'];
      $vote_type = $row['type'];
    }

    if ($vote_type == $vote) {
      echo '<div class="alert alert-error">You Have Already voted.</div>';
    } elseif ($vote_type != $vote) {

      $sql = "UPDATE likes SET type='$vote' WHERE id='$vote_id'";




      if ($conn->query($sql) === TRUE) {

        if ($vote == 'up') {
          $vote_text_1 = 'like';
          $sweeb_up = intval($sweeb_id_up) + 1;
          $sweeb_down = intval($sweeb_id_down) - 1;
          //if up vote
          $sql = "UPDATE sweebs SET up='$sweeb_up', down='$sweeb_down' WHERE id='$id' Limit 1";
          $conn->query($sql);

          $result_array = array('up' => $sweeb_up, 'down' => $sweeb_down);
          echo json_encode($result_array);
          // echo '
          // <div class="col-md-6 col-xs-6" style="padding-left:1px;padding:0px;">
          // <div class="up">
          // <button type="button" class="btn btn-link" name="vote" value="up" onclick="getVote(this.value)">
          // <img src="../dist/img/tup.png" style="height:25px;width:25px;margin-top:10px;">
          // <h4 style="color:#5b832b;font-weight:bold;padding:0px;margin:0px;">'.$sweeb_up.'</h4>
          // </button>
          // </div></div>

          // <div class="col-md-6 col-xs-6" style="padding:0px;">
          // <div class="down">
          //  <button type="button" class="btn btn-link" name="vote" value="down" onclick="getVote(this.value)">
          // <img src="../dist/img/tdown.png" style="height:25px;width:25px;margin-top:10px;">
          // <h4 style="color:#842d40;font-weight:bold;margin:0px;">'.$sweeb_down.'</h4>
          // </div></div>';



        } else {

          //if changed to down
          $vote_text_1 = 'dislike';
          $sweeb_up = intval($sweeb_id_up) - 1;
          $sweeb_down = intval($sweeb_id_down) + 1;
          $sql = "UPDATE sweebs SET up='$sweeb_up', down='$sweeb_down' WHERE id='$id' Limit 1";
          $conn->query($sql);

          $result_array = array('up' => $sweeb_up, 'down' => $sweeb_down);
          echo json_encode($result_array);
          // echo '
          // <div class="col-md-6 col-xs-6" style="padding-left:1px;padding:0px;">
          // <div class="up">
          // <button type="button" class="btn btn-link" name="vote" value="up" onclick="getVote(this.value)">
          // <img src="../dist/img/tup.png" style="height:25px;width:25px;margin-top:10px;">
          // <h4 style="color:#5b832b;font-weight:bold;padding:0px;margin:0px;">'.$sweeb_up.'</h4>
          // </button>
          // </div></div>

          // <div class="col-md-6 col-xs-6" style="padding:0px;">
          // <div class="down">
          //  <button type="button" class="btn btn-link" name="vote" value="down" onclick="getVote(this.value)">
          // <img src="../dist/img/tdown.png" style="height:25px;width:25px;margin-top:10px;">
          // <h4 style="color:#842d40;font-weight:bold;margin:0px;">'.$sweeb_down.'</h4>
          // </div></div>';

          //end down

        }

        if ($conn->query($sql) === TRUE) {

          $sqlz_1 = "INSERT INTO activity (id, user_id, action, created_date)
VALUES (NULL, '$user_id_owner', '$username $vote_text_1 on your sweeb! <a href=\"https://www.sweeba.com/$id/view\">View Sweeb</a>', '$date')";
          $conn->query($sqlz_1);

          //update owner
          $sqlt_1 = "UPDATE members SET notif=notif+1 WHERE id='$user_id_owner' Limit 1";
          mysqli_query($conn, $sqlt_1);
        }
      } else {
        echo "Error updating record: " . $conn->error;
      } //else

    } //else if vote is changing

  } else {

    //if new vote
    if ($vote == 'up') {

      //if up vote
      $vote_text = 'like';
      $sweeb_up = $sweeb_id_up + 1;
      $sweeb_down = $sweeb_id_down;
      // echo '
      // <div class="col-md-6 col-xs-6" style="padding-left:1px;padding:0px;">
      // <div class="up">
      // <button type="button" class="btn btn-link" name="vote" value="up" onclick="getVote(this.value)">
      // <img src="../dist/img/tup.png" style="height:25px;width:25px;margin-top:10px;">
      // <h4 style="color:#5b832b;font-weight:bold;padding:0px;margin:0px;">'.$sweeb_up.'</h4>
      // </button>
      // </div></div>

      // <div class="col-md-6 col-xs-6" style="padding:0px;">
      // <div class="down">
      //  <button type="button" class="btn btn-link" name="vote" value="down" onclick="getVote(this.value)">
      // <img src="../dist/img/tdown.png" style="height:25px;width:25px;margin-top:10px;">
      // <h4 style="color:#842d40;font-weight:bold;margin:0px;">'.$sweeb_down.'</h4>
      // </div></div>';
      $sql = "UPDATE sweebs SET up=up+1 WHERE id='$id' Limit 1";
      $conn->query($sql);

      $result_array = array('up' => $sweeb_up, 'down' => $sweeb_down);
      echo json_encode($result_array);
      //end up vote

    } else {

      //if changed to down
      $vote_text = 'dislike';
      $sweeb_up = $sweeb_id_up;
      $sweeb_down = $sweeb_id_down + 1;
      // echo '
      // <div class="col-md-6 col-xs-6" style="padding-left:1px;padding:0px;">
      // <div class="up">
      // <button type="button" class="btn btn-link" name="vote" value="up" onclick="getVote(this.value)">
      // <img src="../dist/img/tup.png" style="height:25px;width:25px;margin-top:10px;">
      // <h4 style="color:#5b832b;font-weight:bold;padding:0px;margin:0px;">'.$sweeb_up.'</h4>
      // </button>
      // </div></div>

      // <div class="col-md-6 col-xs-6" style="padding:0px;">
      // <div class="down">
      //  <button type="button" class="btn btn-link" name="vote" value="down" onclick="getVote(this.value)">
      // <img src="../dist/img/tdown.png" style="height:25px;width:25px;margin-top:10px;">
      // <h4 style="color:#842d40;font-weight:bold;margin:0px;">'.$sweeb_down.'</h4>
      // </div></div>';
      $sql = "UPDATE sweebs SET down=down+1 WHERE id='$id' Limit 1";
      $conn->query($sql);

      $result_array = array('up' => $sweeb_up, 'down' => $sweeb_down);
      echo json_encode($result_array);
      //end down

    }

    // $sql = "INSERT INTO likes (id, user_id, sweeb_id, type, date)
    // VALUES (NULL, '$user_id', '$id', '$vote', NULL)";
    $sql = "INSERT INTO likes (id, user_id, sweeb_id, type, date)
VALUES (NULL, '$user_id', '$id', '$vote', '$date')";

    if ($conn->query($sql) === TRUE) {

      $sqlz = "INSERT INTO activity (id, user_id, action, created_date)
VALUES (NULL, '$user_id_owner', '$username $vote_text on your sweeb! <a href=\"https://www.sweeba.com/$id/view\">View Sweeb</a>', '$date')";
      $conn->query($sqlz);

      //update owner
      $sqlt = "UPDATE members SET notif=notif+1 WHERE id='$user_id_owner' Limit 1";
      mysqli_query($conn, $sqlt);
    }
  }
}

// little sanitize funtion
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//end sanitization
