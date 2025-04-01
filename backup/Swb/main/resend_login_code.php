<?php
include_once('config.php');
require_once ("../swift/lib/swift_required.php");

if($_POST){

if(isset($_SESSION['resend_login'])) {
if($_SESSION['resend_login'] < time()) {
session_unset(); 
}}


//maybe add some login procedures and than execute the following line


$email_input = test_input($_POST["email"]);
$email_input = filter_var($email_input, FILTER_SANITIZE_EMAIL);



//grab the members info based on email
  $sql = "SELECT id, email, name, username, verified FROM members WHERE email='$email_input'";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    $verified_code = $row['verified'];
    $user_id = $row['id'];
    $email = $row['email'];
    $name = $row['name'];
    $username = $row['username'];
    }}
    

    
    if($email_input == NULL){
    echo 'Please fill out the form.';
    }elseif($verified_code == 'no'){
    echo 'Please Verify Your Account First.';
    }elseif($_SESSION['resend_login'] > time()) {
    echo 'You already requested a new confirmation email. If you did not receive be sure to check your spam folder or send in a support ticket. Please wait a few minutes before sending another confirmation code.';
    } else {

//create session
$_SESSION['resend_login'] = time() + 400;



//verification shit
//create verification code and insert into verified slot
$new_password = substr(str_shuffle(md5(time())),0,8);
//end verify code

// hash the password
$options = [
    'cost' => 12,
];
$password = password_hash("$new_password", PASSWORD_BCRYPT, $options)."\n";
//End password

//update the password!
$sql = "UPDATE members SET password='$password' WHERE id='$user_id'";
mysqli_query($conn, $sql);
//end password

// end creating and updating



echo '<h1 style="text-align:center;">Success!</h1><p style="text-align:center;">Check your email for your account information!</p></span>';

// ------------------------------------------------------------------
// send email
//update pages
$sql = "UPDATE pages SET emails=emails+1 WHERE id='2'";
mysqli_query($conn, $sql);
$conn->close();
//end update

$transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');


// Create the Mailer using your created Transport
$mailer = Swift_Mailer::newInstance($transport);

// Create a message
$message = Swift_Message::newInstance('Your New Password.')
  ->setFrom(array('sweeb@sweeba.com' => 'Sweeba!'))
  ->setTo(array($email => $name))
  ->setBody('<h1 style="text-align:left;">Sweeba</h1><p>Hey '.$name.', below is your new password! <br><br>Password: <b>'.$new_password.'</b><br>Username: '.$username.'.</p>', 'text/html')
  ;

// Send the message
$result = $mailer->send($message);

// end email
// ------------------------------------------------------------------







}

    


}


// little sanitize funtion
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
//end sanitization


?>