<?php 

require_once 'swiftvendor/autoload.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.dreamhost.com', 465, 'ssl'))
  ->setUsername('mail@sweeba.com')
  ->setPassword('gitachi888@');
; 
 
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('Wonderful Subject'))
  ->setFrom(['mail@sweeba.com' => 'Sweeba'])
  ->setTo(['kulbir@yopmail.com' => 'A name'])
  ->setBody('Here is the message dreamhost')
  ;

// Send the message
 $result = $mailer->send($message);

echo "<br/>*************dremhost*****************<br/>";
print_r($result);
?>

