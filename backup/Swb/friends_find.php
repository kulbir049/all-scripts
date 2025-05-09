<?php 
// error_reporting(E_ALL); // Report all errors, warnings, and notices
// ini_set('display_errors', 1); // Display errors on the screen

include('main/config.php');
include('main/functions.php');
// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();

$search = strip_tags($_GET["q"]);
$search_count = strlen($search);

if ($search_count < '2') {
    echo '<div class="box" style="width:100%;padding:10px;margin-bottom:10px;margin-left:-1px;">';
    echo '<p style="text-align:center;">Please type atleast 3 characters.</p></div>';
} else {

    $friends = '' . $friends . ',' . $user_id . '';
    $os = explode(",", $friends);

    //$sql = "SELECT id, username, avatar FROM members WHERE username LIKE '%$search%'";
    $sql = "SELECT * FROM members WHERE id!=".$user_id_sess." AND 
           (name LIKE '%$search%' OR username LIKE '%$search%' OR  email LIKE '%$search%') order by name asc";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $username_search = $row['username'];
            $cur_user_id = $row['id'];
            $senderId = (int) $user_id_sess;
            $receiverId = (int) $cur_user_id;
            $query_F = "SELECT * FROM friend_requests WHERE (sender_id = $senderId AND receiver_id = $receiverId) 
            OR (sender_id = $receiverId AND receiver_id = $senderId)";
            $stmt = $conn->query($query_F);
           // $existingRequest = $stmt->fetch_assoc();

            echo '<div class="box" style="width:100%;padding:10px;margin-bottom:10px;margin-left:-1px;">';
            echo '<div class="col-md-2" style="padding:0px;"><a href="/' . $row['username'] . '"><img class="pull-left avatar" style="height:80px;width:80px;margin-top:-4px;margin-right:10px;"src="grab_image.php?img=' . $row['avatar'] . '"></a></div>';
            echo '<div class="col-md-10"><p style="font-weight:bold;font-size:16px;color:#3e4851;"> <a href="/' . $row['username'] . '">' . $row['username'] . '</a></p>';

            if ($username == $username_search) {
            } elseif (!in_array($cur_user_id, $os)) {

                echo '<form method="post" action="/' . $row['username'] . '">';
                echo '<button type="submit" name="follow" class="btn btn-info pull-left" style="border:0px;background:#5fb5f2;margin-right:5px;margin-top:4px;">Follow ' . $row['username'] . ' <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span></button>
    </form>';
            } else {
                echo '<a href="/' . $row['username'] . '" class="btn btn-success pull-left" style="border:0px;background:#f26986;margin-right:5px;">You Are Following ' . $row['username'] . '!</a>';
            }

            //if($stmt->num_rows==0){
               echo getFriendsButtonType($conn, $senderId, $receiverId);
            //}
            echo '</div>
            </div>';
        }
    } else {
        echo '<div class="box" style="width:100%;padding:10px;margin-bottom:10px;margin-left:-1px;">';
        echo '<p style="text-align:center;">We could not find the member you are looking for.</p></div>';
    }
}

$conn->close();
