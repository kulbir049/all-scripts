<?php
include_once('main/config.php');
include_once('main/functions.php');
// error_reporting(E_ALL);
// ini_set('display_errors', 1);


if (isset($_POST['on_off_toggle'])) {
    $on_off_toggle = $_POST['on_off_toggle'];
    $sql = "UPDATE members SET on_off_toggle='$on_off_toggle' WHERE id='$user_id_sess'";
    $conn->query($sql);
    return true;
}
if (isset($_POST['on_off_toggle_sweebs'])) {
    $on_off_toggle_sweebs = $_POST['on_off_toggle_sweebs'];
    $sweebs_id = $_POST['sweebs_id'];
    $sql = "UPDATE sweebs SET on_off_toggle='$on_off_toggle_sweebs' WHERE id='$sweebs_id'";
    $conn->query($sql);
    return true;
}


if (isset($_POST['next_sweeb_ajax'])) {
    $_SESSION['next_sweeb_ajax'] = $_SESSION['next_sweeb_ajax'] + $_POST['next_sweeb_ajax'];
    return true;
}

if (isset($_POST['view_members_link_credits'])) {
    $_SESSION['view_members_link_credits'] = $_POST['view_members_link_credits'];
    return true;
}
// Check if the friend search term is set
if (isset($_POST['friendsearch'])) {
    // Capture the search query
    $search = $_POST['friendsearch'];
    $search_count = strlen($search);
    if ($search_count > 0) {
        // Create a SQL query to search in the database for username, name, or email
        $sql = "SELECT * FROM members WHERE id!=" . $user_id_sess . " AND 
           (name LIKE '%$search%' OR username LIKE '%$search%' OR  email LIKE '%$search%') order by name asc";



        // Execute the query
        $result = $conn->query($sql);

        // Initialize an array to store the filtered users
        $filteredUsers = [];

        // Check if there are results and fetch them
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $filteredUsers[] = $row;
            }

            // Return the response as JSON
            echo json_encode([
                'status' => 'success',
                'data' => $filteredUsers
            ]);
        } else {
            echo json_encode([
                'status' => 'no_results',
                'data' => []
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'no_results',
            'data' => []
        ]);
    }
}

function sendFriendRequest($conn, $senderId, $receiverId)
{
    // Make sure the user is not sending a request to themselves
    if ($senderId == $receiverId) {
        return ['status' => 'error', 'message' => 'You cannot send a friend request to yourself.'];
    }

    // Check if a request already exists between the users
    $query = "SELECT * FROM friend_requests WHERE sender_id = " . $senderId . " AND receiver_id = " . $receiverId;
    //$stmt = $pdo->prepare($query);
    $stmt = $conn->query($query);
    $existingRequest = $stmt->fetch_assoc();

    if ($existingRequest) {
        return ['status' => 'error', 'message' => 'A request already exists between you and this user.'];
    }

    // Insert a new friend request into the database
    $query = "INSERT INTO friend_requests (sender_id, receiver_id, status) VALUES (" . $senderId . ", " . $receiverId . ", 'pending')";
    // $stmt = $pdo->prepare($query);
    $stmt = $conn->query($query);

    //$stmt->execute(['sender_id' => $senderId, 'receiver_id' => $receiverId]);
    $query_sender = "SELECT * FROM members WHERE id = " . intval($senderId);
    // Use intval() for added safety if senderId comes from user input.
    $stmt_sender = $conn->query($query_sender);
    $existingRequest_sender = $stmt_sender->fetch_assoc();

    $username = $existingRequest_sender['username'];
    $date = date('Y-m-d H:i:s'); // Correct hour format to 24-hour format.
    $text = '<a href="https://www.sweeba.com/' . htmlspecialchars($username) . '">' . htmlspecialchars($username) . '</a> has sent a friend request to you! <a href="friends.php" class="btn btn-info pull-right" style="border:0px;">View Request</a>'; // . getFriendsButtonType($conn, $senderId, $receiverId);

    // Escape $text to avoid breaking the SQL syntax
    $escaped_text = $conn->real_escape_string($text);
    sendNotification($conn, $receiverId, $escaped_text);

    return ['status' => 'success', 'message' => 'Friend request sent successfully.'];
}

function acceptFriendRequest($conn, $senderId, $receiverId)
{
    // Check if a pending request exists
    $query = "SELECT * FROM friend_requests WHERE sender_id = $senderId AND receiver_id = $receiverId AND status = 'pending'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        return ['status' => 'error', 'message' => 'No pending friend request found.'];
    }

    // Update the request status to accepted
    $query = "UPDATE friend_requests SET status = 'accepted' WHERE sender_id = $senderId AND receiver_id = $receiverId";
    mysqli_query($conn, $query);

    // Create a reciprocal friendship if desired (optional)
    $query = "INSERT INTO friend_requests (sender_id, receiver_id, status) VALUES ($receiverId, $senderId, 'accepted')";
    mysqli_query($conn, $query);

    return ['status' => 'success', 'message' => 'Friend request accepted.'];
}

function cancelFriendRequest($conn, $senderId, $receiverId)
{
    // Check if a pending request exists
    $query = "SELECT * FROM friend_requests WHERE sender_id = $senderId AND receiver_id = $receiverId AND status = 'pending'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        return ['status' => 'error', 'message' => 'No pending friend request found to cancel.'];
    }

    // Delete the pending request
    $query = "DELETE FROM friend_requests WHERE sender_id = $senderId AND receiver_id = $receiverId AND status = 'pending'";
    mysqli_query($conn, $query);

    return ['status' => 'success', 'message' => 'Friend request canceled.'];
}
function unFriendRequest($conn, $senderId, $receiverId)
{
    // Check if a pending request exists
    $query = "SELECT * FROM friend_requests WHERE sender_id = $senderId AND receiver_id = $receiverId";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        return ['status' => 'error', 'message' => 'No pending friend request found to cancel.'];
    }

    // Delete the pending request
    $query = "DELETE FROM friend_requests WHERE sender_id = $senderId AND receiver_id = $receiverId";
    mysqli_query($conn, $query);
    // Delete the pending request
    $query = "DELETE FROM friend_requests WHERE sender_id = $receiverId AND receiver_id = $senderId";
    mysqli_query($conn, $query);

    return ['status' => 'success', 'message' => 'Un-Friend Successfully.'];
}

function declineFriendRequest($conn, $senderId, $receiverId)
{
    // Check if a pending request exists
    $query = "SELECT * FROM friend_requests WHERE sender_id = $senderId AND receiver_id = $receiverId AND status = 'pending'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        return ['status' => 'error', 'message' => 'No pending friend request found to decline.'];
    }

    // Update the request status to declined
    $query = "UPDATE friend_requests SET status = 'declined' WHERE sender_id = $senderId AND receiver_id = $receiverId";
    mysqli_query($conn, $query);

    return ['status' => 'success', 'message' => 'Friend request declined.'];
}
function sendMessageFriend($conn, $sender_id, $receiver_id, $message)
{
    $timestamp = date('Y-m-d H:i:s');

    $sql = "INSERT INTO chat_history (sender_id, receiver_id, message, created_at) 
            VALUES ($sender_id, $receiver_id, '$message', '$timestamp')";

    if (mysqli_query($conn, $sql)) {


        $query_sender = "SELECT * FROM members WHERE id = " . intval($sender_id);
        $stmt_sender = $conn->query($query_sender);
        $existingRequest_sender = $stmt_sender->fetch_assoc();
    
        $username = $existingRequest_sender['username'];
        $date = date('Y-m-d H:i:s'); // Correct hour format to 24-hour format.
        $text = '<a href="https://www.sweeba.com/' . htmlspecialchars($username) . '">' . htmlspecialchars($username) . '</a> has sent a message to you! <a href="friends.php" class="btn btn-info pull-right" style="border:0px;">View Message</a>'; // . getFriendsButtonType($conn, $senderId, $receiverId);
    
        $escaped_text = $conn->real_escape_string($text);
        sendNotification($conn, $receiver_id, $escaped_text);

        return json_encode(["success" => true]);
    } else {
        return json_encode(["success" => false, "error" => mysqli_error($conn)]);
    }
}

function fetchMessageFriend($conn, $sender_id, $receiver_id)
{
    $sql = "SELECT * FROM chat_history 
            WHERE (sender_id = $sender_id AND receiver_id = $receiver_id) 
            OR (sender_id = $receiver_id AND receiver_id = $sender_id) 
            ORDER BY created_at ASC";

    $result = mysqli_query($conn, $sql);

    $messages = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $messages[] = $row;
        }
    }

    return $messages;
}


// Assuming you've established a connection to the database in $conn

if (isset($_POST['senderId']) && isset($_POST['receiverId'])) {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $senderId = $_POST['senderId'];
        $receiverId = $_POST['receiverId'];

        // Handle different actions
        switch ($action) {
            case 'send_request':
                $response = sendFriendRequest($conn, $senderId, $receiverId);
                break;
            case 'accept_request':
                $response = acceptFriendRequest($conn, $senderId, $receiverId);
                break;
            case 'cancel_request':
                $response = cancelFriendRequest($conn, $senderId, $receiverId);
                break;
            case 'decline_request':
                $response = declineFriendRequest($conn, $senderId, $receiverId);
                break;
            case 'unFriend_request':
                $response = unFriendRequest($conn, $senderId, $receiverId);
                break;
            case 'send_message':
                $message = $_POST['message'];
                $response = sendMessageFriend($conn, $senderId, $receiverId, $message);
                break;
            case 'fetch_messages':
                $response = fetchMessageFriend($conn, $senderId, $receiverId);
                break;
            default:
                $response = ['status' => 'error', 'message' => 'Invalid action'];
        }

        // Return the response as JSON
        if ($action == 'send_message') {
            echo $response;
        } else {
            echo json_encode($response);
        }
    }
}


if (isset($_GET['get_all_users_chat'])) {
    $sql = "SELECT * FROM members limit 1";
   //dd($sql);
    $result = mysqli_query($conn, $sql);

    $messages = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $messages[] = $row;
        }
    }

    echo json_encode($messages);
}


//   // Query to get all friends of the user
//   $query = "
// SELECT members.id, members.name, members.email 
// FROM members 
// WHERE id IN (
//     SELECT receiver_id 
//     FROM friend_requests 
//     WHERE sender_id = 14508 AND status = 'accepted'
//     UNION
//     SELECT sender_id 
//     FROM friend_requests 
//     WHERE receiver_id = 14508 AND status = 'accepted'
// )";