<?php include('main/config.php'); 

//require_once ("swift/lib/swift_required.php");
require_once 'swift/swiftvendor/autoload.php';
// ------------------------------------------------------------------
// send email
//update pages

$transport = (new Swift_SmtpTransport('smtp.dreamhost.com', 465, 'ssl'))
  ->setUsername('mail@sweeba.com')
  ->setPassword('gitachi888@');
;


// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
//$message = Swift_Message::newInstance('Welcome To Sweeba!')
$message = (new Swift_Message('Welcome To Sweeba!'))
   ->setFrom(array('sweeb@sweeba.com' => 'Sweeba!'))
  ->setTo(array('mmaclothingtrends@gmail.com' => 'Jesse'))
  ->setBody('<h1 style="text-align:left;">Sweeba</h1><p>hi : <a href="https://sweeba.com/verify.php">Verification Link</a>.</p>', 'text/html');


// Send the message
$result = $mailer->send($message);

// end email
// ------------


?>