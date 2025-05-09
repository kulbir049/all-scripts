<?php

include('main/config.php');
$array=array();
$sql = "SELECT * FROM members where status='none'";
$result = $conn->query($sql);
// while($user_details = $result->fetch_assoc()){
//    $string=$user_details['username'];
//    $string_array=explode('@',$string);
//    $string=$string_array[0];
//    $cleanString = preg_replace("/[^a-zA-Z0-9 ]/", "", $string);
  
//    $arrey[]=$cleanString;

//     $update_1 = "UPDATE comments SET username='".$cleanString."' WHERE username='".$user_details['username']."'";
//       $conn->query($update_1);
   

//      $update_2 = "UPDATE messages SET user_id='".$cleanString."' WHERE user_id='".$user_details['username']."'";
//        $conn->query($update_2);

//        $update_3 = "UPDATE replys SET username='".$cleanString."' WHERE username='".$user_details['username']."'";
//          $conn->query($update_3);

//          $update_4 = "UPDATE sweebs SET username='".$cleanString."' WHERE username='".$user_details['username']."'";
//            $conn->query($update_4);


//            echo $user_details['id'];
//            echo '=====';
//            echo $cleanString;
//            echo '=====';
//            echo $string;
//            echo "<br/>";

// }


?>