<?php
$conn = new mysqli("localhost", "root", "", "product_crud");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
