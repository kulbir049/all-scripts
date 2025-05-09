<?php
include_once('main/config.php');
include_once('main/cost.php');

// define variables and set to empty values
$comment = "";
$usernames = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $comment = test_input($_POST["message"]);
  $comment_str = strlen($comment);
  $date = date('Y-m-d H:i:s');

  $usernames = test_input($_POST["username"]);

  $result = $conn->query("SELECT COUNT(*) FROM `members` WHERE username = '$usernames'");
  $row = $result->fetch_row();
  $total_user = $row[0];
  $result->close();

  if ($comment_str < '0') {
    $Err = '<div class="alert alert-warning">Your content needs to be atleast 10 characters.</div>';
  } elseif ($logged_in == 'no') {
    $Err = '<div class="alert alert-warning">Please log in or signup to comment.</div>';
  } elseif ($comment == NULL || $usernames == NULL) {
    $Err = '<div class="alert alert-warning">You have to write a comment!</div>';
  } elseif ($total_user == '0') {
    $Err = '<div class="alert alert-warning">This user does not exist.</div>';
  } else {
    // throw it into the db
    //create session

    $sql = "INSERT INTO messages (id, user_id, rec, action, viewed, date, message)
VALUES (NULL, '$username', '$usernames', 'yes', 'no', '$date', '$comment')";

    $sqls = "UPDATE members SET msg='yes' WHERE username='$usernames'";
    $conn->query($sqls);

    if ($conn->query($sql) === TRUE) {
      $Err = '<div class="alert alert-warning">Your message has been sent!</div>';
    } else {
      $Err = '<div class="alert alert-warning">An error has occured please try again.</div>';
    }

    $conn->close();


    //boom done
    header("Refresh:0");
    exit;

    // end throwing process lol
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



?>
<?php include('footer.php'); ?>