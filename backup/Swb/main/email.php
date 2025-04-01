<?php include('config.php'); 

require_once ("../swift/lib/swift_required.php");



$sql = "SELECT * FROM send_email WHERE sent='no' Limit 25";
$results = $conn->query($sql);

if ($results->num_rows > 0) {
    // output data of each row
    while($row = $results->fetch_assoc()) {
    $email_s = $row['email'];
    $username_s = $row['username'];
    

// ------------------------------------------------------------------
// send email
//update pages

$transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');

// Create a message
$mailer = Swift_Mailer::newInstance($transport);

// Create a message
$message = Swift_Message::newInstance('Sweeba')
  ->setFrom(array($site_email => 'Sweeba'))
  ->setTo(array($email_s => $username_s))
  ->setBody('
 <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
 <div style="height:60px;background:#14202c;text-align:center;padding-top:15px;"><img src="https://www.sweeba.com/dist/img/log_b.png" style="width:160px;height:45px;"></div>
  <div style="background:#d9e4ed;border:1px solid #ddd;border-top:0px;padding:50px;font-family: \'Open Sans\', sans-serif;">
  <div style="background:#fff;margin:0px auto;padding:20px;">
  <h2 style="text-align:center;color:#5fb5f2;text-align:center;">Sweeba!</h2>
  <p style="text-align:center;color:#5fb5f2;text-align:center;font-weight:Bold;">sweebs!</p><br>
  
  
  <br>
  <b style="color:#5fb5f2;text-align:left;">Sweeba Updates!</b>
  <p style="text-align:left;color:#003660;">sweeba!</p>
 <br>
  <b style="color:#5fb5f2;text-align:left;">sweeba!</b>
  <p style="text-align:left;color:#003660;">sweeb!</p>
  <br>
  <p style="text-align:center;color:#5fb5f2;text-align:center;font-weight:Bold;">sweeb!<br><br>
   <a href="https://www.sweeba.com/" style="background:#5fb5f2;padding:10px;color:#fff;text-decoration:none;border-radius:3px;">Visit sweeba &raquo;</a></p>
   </div></div></div>', 'text/html')
  ;

// Send the message
$result = $mailer->send($message);

// end email
// ------------



$sqls = "UPDATE send_email SET sent='yes' WHERE username='$username_s'";
$conn->query($sqls);

echo 'done';
}

}
?>