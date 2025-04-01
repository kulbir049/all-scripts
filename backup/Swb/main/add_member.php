<?php
include_once('main/config.php');
include("geoipcity.inc");
include("geoipregionvars.php");
//require_once ("./swift/lib/swift_required.php");
require_once './swift/swiftvendor/autoload.php';


if (!isset($_SESSION['ref'])) {
  $ref_mem = 'none';
} else {
  $ref_mem = $_SESSION['ref'];
}

if (!isset($_SESSION['ref_url'])) {
  $ht_ref = 'None';
} else {
  $ht_ref = $_SESSION['ref_url'];
}

// define variables and set to empty values
$name = $username = $email = $password = $ref = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $username = test_input($_POST["username"]);
  $username_str = strlen($username);
  //filter email
  $email = test_input($_POST["email"]);
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);

  $password_un = test_input($_POST["password"]);
  $password_str = strlen($password_un);
  $ref = test_input($_POST["referral"]);


  // hash the password
  $options = [
    'cost' => 12,
  ];
  $password = password_hash("$password_un", PASSWORD_BCRYPT, $options) . "\n";

  // end hash

  // get location

  $ip = $_SERVER['REMOTE_ADDR'];
  $gi = geoip_open("GeoLiteCity.dat", GEOIP_STANDARD);
  $record = geoip_record_by_addr($gi, $ip);
  $country_code = geoip_country_code_by_addr($gi, $ip);

  //end location


  //create verification code and insert into verified slot
  $verification_code = substr(str_shuffle(md5(time())), 0, 10);
  //end verify code



  // verify info is not being used already

  $result = $conn->query("SELECT COUNT(*) FROM `members` WHERE username = '$username'");
  $row = $result->fetch_row();
  $total_user = $row[0];
  $result->close();

  $result = $conn->query("SELECT COUNT(*) FROM `members` WHERE email = '$email'");
  $row = $result->fetch_row();
  $total_email = $row[0];
  $result->close();

  $result = $conn->query("SELECT COUNT(*) FROM `members` WHERE ip = '$ip'");
  $row = $result->fetch_row();
  $total_ip = $row[0];
  $result->close();

  // end verify info is not being used already


  // verify info is inputed

  if (empty($_POST["name"])) {
    $Err = "Hey, you forgot to enter your name.";
  } elseif (empty($_POST["email"])) {
    $Err = "Please enter your email.";
  } elseif (empty($_POST["password"])) {
    $Err = "You forgot to enter your password.";
  } elseif ($total_user >= '1') {
    $Err = "Oh no! Someone is using this sweeba name.";
  } elseif ($total_email >= '1') {
    $Err = "This email is currently in use.";
  } elseif ($total_ip >= '1') {
    $Err = "You already have a sweeba account.";
  } elseif (filter_var($ip, FILTER_VALIDATE_IP) === false) {
    $Err = "You are not using a valid ip address.";
  } elseif ($password_str < '6') {
    $Err = "Your password needs to be atleast 6 characters.";
  } elseif ($username_str < '4') {
    $Err = "Your username needs to be atleast 4 characters.";
  } else {
    // end input

    //get date D:
    $date = date("Y-m-d H:i:s");

    // throw it into the db

    $sql = "INSERT INTO members (id, username, name, email, ip, created_date, pin, password, token, verified, online, use_pin, ref, comes_from, type, location, city, age, relationship, occupation, gender, last_login, last_activity, status, friends, follows, tutorial, sweebs, sweeb_status, avatar, last_sweeb, bg, comments, balance, msg, prof_desc, withdraw, followers, notif, payment_type, payment_email)
VALUES (NULL, '$username', '$name', '$email', '$ipaddress', '$date', '', '$password', 'none', '$verification_code', 'no', 'no', '$ref_mem', '$ht_ref', '1', '$country_code', '', '', '', '', '', NULL, NULL, 'none', '16,18', '', 'no', '0', 'good', 'user.png', '0000-00-00 00:00:00', '', '0', '0.00', 'no', 'Sweeba is awesome!', '0.00', '0', '0', '', '')";

    if ($conn->query($sql) === TRUE) {
      $last_inserted_id = $conn->insert_id;
      if ($ref_mem != 'none') {
        $sq = "SELECT id, balance FROM members WHERE username='$ref_mem'";
        $resul = $conn->query($sq);

        if ($resul->num_rows > 0) {
          // output data of each row
          while ($ro = $resul->fetch_assoc()) {
            $balance_mem = $ro['balance'];
            //checking premium meber or not
            $date = date('Y-m-d');
            $sql_premium = "SELECT * FROM subscription where user_id='" . $ro['id'] . "' AND expire_date > '" . $date . "' AND status='Success'";
            $result_premium = $conn->query($sql_premium);
            if ($result_premium->num_rows > 0) {
              $ref_com  =  '0.00';
            } else {
              $ref_com  = '0.00';
            }

            $balance_updated = $balance_mem + $ref_com;
            $mem_r_id = $ro['id'];
            $add_com = "UPDATE members SET balance='$balance_updated' WHERE id='$mem_r_id' Limit 1";
            $date1 = date("Y-m-d H:i:s");
            $conn->query($add_com);
            $insert_logs = "INSERT INTO reff_logs (user_id, reff_to, amount, created_at) VALUES ('$mem_r_id', '$last_inserted_id', '$ref_com', '$date1')";
            if ($conn->query($insert_logs) === TRUE) {
              // echo "Record inserted into reff_logs successfully.";
            } else {
              echo "Error: " . $conn->error;
            }
          }

          $sqlz = "INSERT INTO activity (id, user_id, action, created_date)
VALUES (NULL, '$mem_r_id', '<a href=\"/$username\">$username</a> is now your referral!', '$date')";
          if ($conn->query($sqlz) === TRUE) {
             // give credit 50 on ref
             $exposure_earn = 50;
             $credit_use = 0;
             $is_free = 1;
             $free_desc = 'on_ref_credit';
 
             $created_at = date('Y-m-d H:i:s');
             $insert_click_logs = "INSERT INTO exposure (user_id, post_by_user, sweeba_id, exposure_earn, created_at,credit_use,is_free,free_desc)
                  VALUES ('$mem_r_id', 0, 0, '$exposure_earn','$created_at','$credit_use','$is_free','$free_desc')";
                  $conn->query($insert_click_logs);

                  $sqlz_2 = "INSERT INTO activity (id, user_id, action, created_date)
                  VALUES (NULL, '$mem_r_id', 'You\'ve earned 50 credits for a new referral', '$date')";
                  $conn->query($sqlz_2);
              

          }
        }
      }
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }


    // end throwing process lol


    // ------------------------------------------------------------------
    // send email


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
      ->setBody('<h1 style="text-align:left;">Sweeba</h1><p>Welcome to Sweeba ' . $name . ', you are almost apart of the sweeba community! To confirm your account copy and paste the code below into the confirmation code box on sweeba or you can follow the link found below the verification code.<br><br>Confirmation Code: <b>' . $verification_code . '</b><br>Confirmation Link: <a href="http://sweeba.com/verify.php?c=' . $verification_code . '">Verification Link</a>.</p>', 'text/html');

    // Send the message
    $result = $mailer->send($message);


    // end email
    // ------------------------------------------------------------------

    //update pages
    $sql = "UPDATE pages SET emails=emails+1 WHERE id='1'";
    mysqli_query($conn, $sql);
    $conn->close();
    //end update

    //redirect if all is good
    header("Location: verify.php");
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
