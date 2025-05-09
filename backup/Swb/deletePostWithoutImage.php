<?php
// Start the session for members
session_start();

$servername = "mysql.sweeba.com";
$username = "sweeba";
$password = "hitachi888@";
$dbname = "sweebaco_site";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



$sql = "SELECT * FROM `sweebs` ORDER BY `id` DESC ";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    $image=$row['image'];
     $website=$_SERVER['DOCUMENT_ROOT'];
    $check = $website.'/file/'.$image;
    if (file_exists($check)) {
    }else{
        // echo $sql_2 = "DELETE FROM `sweebs` where id=".$row['id'];

        // $conn->query($sql_2);
    }
}
?>