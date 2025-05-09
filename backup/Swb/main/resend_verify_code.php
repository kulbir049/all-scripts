<?php
include_once('config.php');
require_once ("../swift/lib/swift_required.php");

if($_POST){

if(isset($_SESSION['resend_verify'])) {
if($_SESSION['resend_verify'] < time()) {
session_unset(); 
}}


//maybe add some login procedures and than execute the following line


$username_input =test_input($_POST['username']);
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
    

    
    if($username_input == NULL OR $email_input == NULL){
    echo 'Please fill out the form.';
    }elseif($verified_code == 'yes'){
    echo 'Your account is already verified.';
    }elseif($username_input != $username){
    echo 'Your email/username do not match.]';
    }elseif($email_input != $email){
    echo 'Your email/username do not match.';
    }elseif($_SESSION['resend_verify'] > time()) {
    echo 'You already requested a new confirmation email. If you did not receive be sure to check your spam folder or send in a support ticket. Please wait a few minutes before sending another confirmation code.';
    } else {

//create session
$_SESSION['resend_verify'] = time() + 400;


echo '<h1 style="text-align:center;">Success!</h1><p style="text-align:center;">Check your email for a new confirmation code!</p></span>';



// ------------------------------------------------------------------
// send email

//update pages
$sql = "UPDATE pages SET emails=emails+1 WHERE id='4'";
mysqli_query($conn, $sql);
//end update

$transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');


// Create the Mailer using your created Transport
$mailer = Swift_Mailer::newInstance($transport);

// Create a message
$message = Swift_Message::newInstance('Welcome To Sweeba!')
  ->setFrom(array('sweeb@sweeba.com' => 'Sweeba!'))
  ->setTo(array($email => $name))
  ->setBody('<h1 style="text-align:left;">Sweeba</h1><p>Welcome to Sweeba '.$name.', you are almost apart of the sweeba community! To confirm your account copy and paste the code below into the confirmation code box on sweeba or you can follow the link found below the verification code.<br><br>Confirmation Code: <b>'.$verified_code.'</b><br>Confirmation Link: <a href="http://sweeba.com/verify.php?c='.$verified_code.'">Verification Link</a>.</p>', 'text/html')
  ;

// Send the message
$result = $mailer->send($message);

$conn->close();
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