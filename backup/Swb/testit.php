<?php include('main/config.php');
include('main/functions.php');


// $sql = "SELECT * FROM `activity` WHERE `action` LIKE '%www.sweeba.com/ %'";
// $result = $conn->query($sql);
// echo $result->num_rows;
// echo "<br/>";

// if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//         $stringToFind = "www.sweeba.com/ ";
//         $replacementString = "www.sweeba.com/";
//         $newString = str_replace($stringToFind, $replacementString, $row['action']);
//         $sql = "UPDATE activity SET `action`='$newString' WHERE id=".$row['id'];
//             $conn->query($sql);
//         echo '<div class="activity" id="'.$row['id'].'">'.$row['action'].'</div>';
//         echo "<br/>";
//     }
// } else {
//     echo "0 results";
// }
// $conn->close();

?>