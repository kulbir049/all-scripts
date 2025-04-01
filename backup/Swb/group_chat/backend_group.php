<?php
include('../main/config.php');
include('../main/functions.php');

checkLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // Create group

    if (isset($_POST['form_purpose']) && $_POST['form_purpose'] == 'create_group') {
        $groupName = $_POST['group_name'];
        $members = json_decode($_POST['members'], true); // Decode the JSON members list
        $createdBy = $user_id_sess; // Replace with your session user ID.

        $groupImage = '';

        if (!empty($_FILES['group_image']['name'])) {
            $targetDir = "files/";
            $fileName = time() . "_" . basename($_FILES['group_image']['name']);
            $targetFilePath = $targetDir . $fileName;

            // Ensure the directory exists
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            // Move uploaded file
            if (move_uploaded_file($_FILES['group_image']['tmp_name'], $targetFilePath)) {
                $groupImage = $fileName; // Store the filename to save in DB
            }
        }


        // Insert group
        $stmt = $conn->prepare("INSERT INTO `groups` (group_name, group_image,created_by) VALUES (?,?,?)");
        $stmt->bind_param('ssi', $groupName, $groupImage, $createdBy);
        $stmt->execute();
        $groupId = $stmt->insert_id;

        // add admin into group_members table
        $role = 'admin';
        $stmt_admin = $conn->prepare("INSERT INTO group_members (group_id, member_id, role) VALUES (?, ?, ?)");
        $stmt_admin->bind_param('iis', $groupId, $createdBy, $role);
        $stmt_admin->execute();

        $role = 'member';
        // Add group members
        $stmt = $conn->prepare("INSERT INTO group_members (group_id, member_id, role) VALUES (?, ?, ?)");
        foreach ($members as $memberId) {
            $stmt->bind_param('iis', $groupId, $memberId, $role);
            $stmt->execute();
        }

        echo json_encode(['status' => true]);
    }

    // Update group

    if (isset($_POST['form_purpose']) && $_POST['form_purpose'] == 'update_group') {

        $groupId = $_POST['group_id'];
        $groupName = $_POST['group_name'];

        $updateImage = false;
        $groupImage = '';


        // Check if a new image is uploaded
        if (!empty($_FILES['group_image']['name'])) {
            $targetDir = "files/";
            $fileName = time() . "_" . basename($_FILES['group_image']['name']);
            $targetFilePath = $targetDir . $fileName;

            // Ensure the directory exists
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            // Move uploaded file
            if (move_uploaded_file($_FILES['group_image']['tmp_name'], $targetFilePath)) {
                $groupImage = $fileName; // Save the file name for database
                $updateImage = true;
            } else {
                echo json_encode(['status' => false, 'error' => 'Failed to upload image']);
                exit;
            }
        }

        // Update the group details
        if ($updateImage) {
            $stmt = $conn->prepare("UPDATE `groups` SET group_name = ?, group_image = ? WHERE id = ?");
            $stmt->bind_param('ssi', $groupName, $groupImage, $groupId);
        } else {
            $stmt = $conn->prepare("UPDATE `groups` SET group_name = ? WHERE id = ?");
            $stmt->bind_param('si', $groupName, $groupId);
        }

        if ($stmt->execute()) {
            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false, 'error' => $stmt->error]);
        }
        exit;
    }

    // Fetch group messages

    if (isset($_POST['form_purpose']) && $_POST['form_purpose'] == 'fetch_group_messages') {

        $groupId = $_POST['groupId'];
        $currentUserId = $user_id_sess;

        $query = "
        SELECT
            gm.message,
            gm.sender_id,
            m.name AS sender_name
        FROM
            group_messages gm
        JOIN
            members m ON gm.sender_id = m.id
        WHERE
            gm.group_id = ?
        ORDER BY
            gm.sent_at ASC
    ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $groupId);
        $stmt->execute();
        $result = $stmt->get_result();

        $messages = [];
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }

        echo json_encode($messages);
        exit;
    }

    // send message in group
    if (isset($_POST['form_purpose']) && $_POST['form_purpose'] == 'send_group_message') {

        $senderId = $_POST['senderId'];
        $groupId = $_POST['groupId'];
        $message = $_POST['message'];

        // Start a transaction
        $conn->begin_transaction();

        try {
            // Insert the message into the group_messages table
            $query = "
        INSERT INTO group_messages (group_id, sender_id, message, sent_at)
        VALUES (?, ?, ?, NOW())
        ";
            $stmt = $conn->prepare($query);
            $stmt->bind_param(
                "iis",
                $groupId,
                $senderId,
                $message
            );

            if (!$stmt->execute()) {
                throw new Exception("Message insertion failed: " . $stmt->error);
            }



            //  Step 1: Increase unread count for existing members (if already in the table)
            $updateUnreadQuery = "
        UPDATE unread_messages
        SET unread_count = unread_count + 1
        WHERE group_id = ? AND member_id != ?
        ";
            $updateStmt = $conn->prepare($updateUnreadQuery);
            $updateStmt->bind_param("ii", $groupId, $senderId);
            $updateStmt->execute();

            // Step 2: Insert new records only if they don’t exist
            $insertUnreadQuery = "
        INSERT INTO unread_messages (group_id, member_id, unread_count)
        SELECT ?, gm.member_id, 1 FROM group_members gm
        WHERE gm.group_id = ?
        AND gm.member_id != ?
        AND NOT EXISTS (
            SELECT 1 FROM unread_messages um
            WHERE um.group_id = gm.group_id
            AND um.member_id = gm.member_id
        )
        ON DUPLICATE KEY UPDATE unread_count = unread_count + 1
        ";
            $insertStmt = $conn->prepare($insertUnreadQuery);
            $insertStmt->bind_param("iii", $groupId, $groupId, $senderId);
            $insertStmt->execute();

            // Commit the transaction
            $conn->commit();

            echo json_encode(["success" => true]);
        } catch (Exception $e) {
            // Rollback the transaction in case of an error
            $conn->rollback();
            echo json_encode(["success" => false, "error" => $e->getMessage()]);
        }

        exit;
    }





    // on send message update read unread message

    if (isset($_POST['form_purpose']) && $_POST['form_purpose'] == 'update_unread_count_for_group') {


        $groupId = $_POST['groupId'];


        // Start a transaction
        $conn->begin_transaction();

        try {

            // Update unread message count for current user
            $updateQuery = "
            UPDATE unread_messages
            SET unread_count = 0
            WHERE group_id = ? AND member_id = ?
        ";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("ii", $groupId, $user_id_sess);

            if (!$updateStmt->execute()) {
                throw new Exception("Failed to update unread count: " . $updateStmt->error);
            }

            // Commit the transaction
            $conn->commit();

            echo json_encode(["success" => true]);
        } catch (Exception $e) {
            // Rollback the transaction in case of an error
            $conn->rollback();
            echo json_encode(["success" => false, "error" => $e->getMessage()]);
        }

        exit;
    }

    if (isset($_POST['form_purpose']) && $_POST['form_purpose'] == 'fetch_group_members') {


        $groupId = $_POST['groupId'];


        $query = $conn->prepare("SELECT gm.member_id, m.username, gm.role
                         FROM group_members gm
                         JOIN members m ON gm.member_id = m.id
                         WHERE gm.group_id = ?");
        $query->bind_param('i', $groupId);
        $query->execute();
        $result = $query->get_result();

        $members = [];

        while ($row = $result->fetch_assoc()) {
            $members[] = $row;
        }

        echo json_encode($members);
    }

    if (isset($_POST['form_purpose']) && $_POST['form_purpose'] == 'remove_member') {


        $groupId = $_POST['groupId'];
        $memberId = $_POST['memberId'];

        // Initialize response
        $response = ['status' => 'error'];

        // Delete messages
        $stmt = $conn->prepare("DELETE FROM group_messages WHERE group_id = ? AND sender_id = ?");
        $stmt->bind_param('ii', $groupId, $memberId);
        $stmt->execute();

        if ($stmt->execute()) {

            // Delete group members
            $stmt = $conn->prepare("DELETE FROM group_members WHERE group_id = ? AND member_id = ?");
            $stmt->bind_param('ii', $groupId, $memberId);
            $stmt->execute();

            // Delete message count
            $stmt = $conn->prepare("DELETE FROM unread_messages WHERE group_id = ? AND member_id = ?");
            $stmt->bind_param('ii', $groupId, $memberId);
            $stmt->execute();

            if ($stmt->execute()) {

                $response['status'] = 'success';
            }
        }


        // Send JSON response
        echo json_encode($response);
        exit;
    }

    if (isset($_POST['form_purpose']) && $_POST['form_purpose'] == 'fetch_members_to_add_group') {


        $groupId = $_POST['groupId'];

        $query = "
                SELECT DISTINCT
                CASE
                        WHEN f.sender_id = $user_id_sess THEN f.receiver_id
                        ELSE f.sender_id
                    END AS member_id,
                    m.username AS username
                FROM friend_requests f
                INNER JOIN members m
                ON m.id = CASE
                            WHEN f.sender_id = $user_id_sess THEN f.receiver_id
                            ELSE f.sender_id
                        END
                WHERE (f.sender_id = $user_id_sess OR f.receiver_id = $user_id_sess)
                AND f.status = 'accepted'
                AND CASE
                        WHEN f.sender_id = $user_id_sess THEN f.receiver_id
                        ELSE f.sender_id
                    END NOT IN (
                        SELECT member_id FROM group_members WHERE group_id = $groupId
                    )
            ";

        $result = $conn->query($query);

        // Fetch the data
        $friends_not_in_group = [];
        while ($row = $result->fetch_assoc()) {
            $friends_not_in_group[] = $row;
        }

        echo json_encode($friends_not_in_group);
    }

    if (isset($_POST['form_purpose']) && $_POST['form_purpose'] == 'add_new_friends_into_group') {

        $groupId = $_POST['group_id'];
        $members = $_POST['members'];


        $role = 'member';
        // Add group members
        $stmt = $conn->prepare("INSERT INTO group_members (group_id, member_id, role) VALUES (?, ?, ?)");
        foreach ($members as $memberId) {
            $stmt->bind_param('iis', $groupId, $memberId, $role);
            $stmt->execute();
        }

        echo json_encode(['status' => true]);
    }

    if (isset($_POST['form_purpose']) && $_POST['form_purpose'] == 'delete_group') {


        $groupId = $_POST['groupId'];

        // Delete messages
        $stmt = $conn->prepare("DELETE FROM group_messages WHERE group_id = ?");
        $stmt->bind_param('i', $groupId);
        $stmt->execute();

        // Delete group members
        $stmt = $conn->prepare("DELETE FROM group_members WHERE group_id = ?");
        $stmt->bind_param('i', $groupId);
        $stmt->execute();

        // Delete group message count
        $stmt = $conn->prepare("DELETE FROM unread_messages WHERE group_id = ?");
        $stmt->bind_param('i', $groupId);
        $stmt->execute();

        // Delete group
        $stmt = $conn->prepare("DELETE FROM `groups` WHERE id = ?");
        $stmt->bind_param('i', $groupId);
        $stmt->execute();

        echo json_encode(['status' => 'success']);
    }
} else {
    echo json_encode(['status' => false]);
}
