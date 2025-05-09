<?php
include('main/config.php');

// Get report details from the form
$sweeb_id = $_GET['id'];

$sql = "INSERT INTO sweeb_reports (sweeb_id, user_id, status) 
        VALUES ('$sweeb_id', '$user_id_sess', 'pending')";
$result = $conn->query($sql);
$_SESSION['pause_sweeb']=0;
 header("Location: random.php"); // Redirect to random.php


$conn->close();
?>
