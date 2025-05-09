<?php
include_once('main/config.php');
//require_once ("./swift/lib/swift_required.php");
require_once './swift/swiftvendor/autoload.php';

//   _____  __          __  ______   ______   ____
//  / ____| \ \        / / |  ____| |  ____| |  _ \      /\
// | (___    \ \  /\  / /  | |__    | |__    | |_) |    /  \
//  \___ \    \ \/  \/ /   |  __|   |  __|   |  _ <    / /\ \
//  ____) |    \  /\  /    | |____  | |____  | |_) |  / ____ \
// |_____/      \/  \/     |______| |______| |____/  /_/    \_\




// define variables and set to empty values
$email = $code = "";

if (isset($_POST['verify'])) {

  //filter email
  $email = test_input($_POST["email"]);
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  //get verify code
  $code = test_input($_POST["code"]);

  //grab the members info based on email
  $sql = "SELECT id, email, name, username, verified FROM members WHERE email='$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $verified_code = $row['verified'];
      $user_id = $row['id'];
      $name = $row['name'];
      $username = $row['username'];
    }
  }


  //end the grab

  // verify info is inputed

  if (empty($_POST["email"])) {
    $Err = "Hey, you forgot to enter your name.";
  } elseif (empty($_POST["code"])) {
    $Err = "Please enter your email.";
  } elseif ($verified_code == 'yes') {
    $Err = "Your account has already been verified!";
  } elseif ($verified_code != $code) {
    $Err = "Your verification code is invalid.";
  } else {
    // end input

    // throw it into the db

    $sql = "UPDATE members SET verified='yes' WHERE id='$user_id'";
    mysqli_query($conn, $sql);

    // end throwing process lol

    //log the user in --

    //make a token
    $token_code = substr(str_shuffle(md5(time())), 0, 10);
    $sql = "UPDATE members SET token='$token_code' WHERE id='$user_id'";
    mysqli_query($conn, $sql);
    //end token

    $_SESSION["token"] = $token_code;
    $_SESSION["user_id"] = $user_id;
    // end login


    // ------------------------------------------------------------------
    // send email

    //update pages
    $sql = "UPDATE pages SET emails=emails+1 WHERE id='3'";
    mysqli_query($conn, $sql);
    $conn->close();
    //end update

    $transport = (new Swift_SmtpTransport('smtp.dreamhost.com', 465, 'ssl'))
      ->setUsername('mail@sweeba.com')
      ->setPassword('gitachi888@');;


    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

    // Create a message
    //$message = Swift_Message::newInstance('Welcome To Sweeba!')
    $message = (new Swift_Message('Welcome To Sweeba!'))
      ->setFrom(array('sweeb@sweeba.com' => 'Sweeba!'))
      ->setTo(array($email => $name))
      ->setBody('<h1 style="text-align:left;">Sweeba</h1><p>Awesome Job ' . $name . ', your account is now verified! You can now join in on the world of sweeba! If you are having trouble getting started we have many tutorials and helpful members to get you on your road to success. Be sure to check out the begginers tutorial right when you log in.<br><br>Your username: <b>' . $username . '</b></p>', 'text/html');

    // Send the message
    $result = $mailer->send($message);


    // end email
    // ------------------------------------------------------------------

    //redirect if all is good
    header("Location: tutorial.php");
    die();
  } //end check


} //end post


// little sanitize funtion
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
//end sanitization
