<?php 
include('config.php');


$sql = "SELECT * FROM raffle WHERE status='active'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
 $entries = $row['entries'];
 $prize = $row['winning'];
 $total = $row['total'];
  $entry_array = explode(",", $entries);
  $winner = $entry_array[array_rand($entry_array, 1)];
  }
}



$sql = "UPDATE raffle SET winner='$winner', status='ended' WHERE status='active' Limit 1";

if ($conn->query($sql) === TRUE) {

$sqlmem = "UPDATE members SET balance =balance + $prize WHERE id='$winner' Limit 1";
$conn->query($sqlmem);

$sqlraf = "INSERT INTO raffle (id, entries, total, status, winner, winning, date)
VALUES (NULL, '', '0', 'active', '', '0.10', NULL)";
$conn->query($sqlraf);



} else {
    echo "Error updating record: " . $conn->error;
}

?>