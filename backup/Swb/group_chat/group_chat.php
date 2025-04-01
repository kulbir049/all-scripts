<style>
    /* group listing style start */



    /* Create Group Button */
    #create-group-btn {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        font-weight: bold;
        cursor: pointer;
        border: none;
        border-radius: 5px;
        background-color: #5fb5f2;
        color: #fff;
        transition: background-color 0.3s ease;
    }

    #create-group-btn:hover {
        background-color: #0056b3;
    }

    /* Group List */


    .group-item {
        display: flex;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #ddd;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }


    /* Avatar */
    .avatar {
        height: 40px;
        width: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #007bff;
        margin: inherit
    }

    /* Group Details */
    .group-details {
        display: flex;
        justify-content: space-between;
        width: 100%;
        align-items: center;
    }


    /* Message Count */
    .message-count {
        background-color: #dc3545;
        color: #fff;
        padding: 5px 10px;
        font-size: 0.875rem;
        font-weight: bold;
        border-radius: 15px;
        min-width: 30px;
        text-align: center;
        margin-left: auto;
    }

    /* group lisitn style end */
    /* group chat craete modal start */

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        animation: fadeIn 0.3s ease;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* group chat craete modal end */

    /* group chat message box start */

    .chat-box-messages div {

        max-width: 100%;

    }

    /* group chat message box end */

    .close-modal {
        float: right;
        cursor: pointer;
    }

    /* ....Remove button on group detaisl page start..... */


    /* Styling for the list items */
    .group-member-item {
        display: flex;
        justify-content: space-between;
        /* Align content to the edges */
        align-items: center;
        /* Vertically center align the items */
        padding: 8px 0;
        border-bottom: 1px solid #eee;
    }

    .group-members-list {
        list-style: none;
        padding: 0;
        margin-bottom: 20px;
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        background-color: #f9f9f9;
    }

    /* Styling for the remove button */
    .group-members-list .remove-member-btn {
        background-color: red;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 5px 10px;
        cursor: pointer;
        font-size: 14px;
    }

    .group-members-list .remove-member-btn:hover {
        background-color: #bd2130;
    }

    /* Disabled button styling */
    .group-members-list .disabled-btn {
        background-color: #ccc;
        color: #666;
        cursor: not-allowed;
    }

    /* .....Remove button on group detaisl page end....... */

    /* Friends List Start*/
    .friends-list-modal {
        list-style: none;
        padding: 0;
        margin: 15px 0;
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
    }

    .friend-item {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }

    .friend-label {
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    .friend-checkbox {
        margin-right: 10px;
    }

    /* Friends List Start*/

    /* Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
<script>
    $("#closeUpdateGroupModal").on("click", function() {
        $("#group-details-modal-update").fadeOut();
    });

    function closeGroupAddMemberModal() {
        $("#group-add-member-modal").fadeOut();
    }

    function closeGroupChatModal() {
        $("#group-chat-modal").fadeOut();
    }
</script>
<div id="group-chat">
    <button id="create-group-btn" class="btn btn-main">Create Group</button>
    <ul id="group-list" class="group-list">
        <!-- Dynamically populated group list -->
        <?php
        $query = "SELECT
            g.id AS group_id,
            g.group_name AS group_name,
            g.group_image,
            CASE
                WHEN g.created_by = " . $user_id_sess . " THEN 'admin'
                ELSE 'member'
            END AS role
        FROM
            `groups` g
        LEFT JOIN
            `group_members` gm ON g.id = gm.group_id
        WHERE
            g.created_by = " . $user_id_sess . " OR gm.member_id = " . $user_id_sess . "
        GROUP BY
            g.id;";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row_group = $result->fetch_assoc()) {

                // Create a new prepared statement for unread messages
                $stmt = $conn->prepare("SELECT um.unread_count FROM unread_messages um WHERE um.group_id = ? AND um.member_id = ?");
                $stmt->bind_param('ii', $row_group['group_id'], $user_id_sess);
                $stmt->execute();
                $unread_result = $stmt->get_result(); // Use a new variable
                $result_unread_messages = $unread_result->fetch_assoc();
                if (!$result_unread_messages) {
                    $result_unread_messages['unread_count'] = 0;
                }
                $stmt->close(); // Close the prepared statement

        ?>
                <li class="group-item" onclick="openGroupChat('<?php echo $row_group['group_id']; ?>','<?php echo $row_group['group_name']; ?>','<?php echo $user_id_sess; ?>','<?php echo $row_group['role']; ?>')">
                    <img class="avatar" src="group_chat/group_image.php?img=<?php echo $row_group['group_image']; ?>" alt="Group Image">
                    <div class="group-details">
                        <span class="group-name"><?php echo $row_group['group_name']; ?></span>
                        <?php if ($result_unread_messages['unread_count'] > 0) { ?>
                            <span id="group-message-count-<?php echo $row_group['group_id']; ?>" class="message-count">
                                <?php echo $result_unread_messages['unread_count']; ?>
                            </span>
                        <?php } ?>
                    </div>
                </li>
        <?php
            }
        }
        ?>
    </ul>
</div>

<!-- Group Chat Modal start-->
<div id="group-chat-modal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-modal" onclick="closeGroupChatModal()">&times;</span>
        <h3>Create Group</h3>
        <form id="create-group-form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="group-name">Group Name</label>
                <input type="text" id="group-name" name="group_name" class="form-control" placeholder="Enter Group Name">
            </div>

            <div class="form-group">
                <label for="group-image">Group Image</label>
                <input type="file" id="group-image-create" name="group_image" class="form-control" accept="image/*">
            </div>
            <h4>Select Friends:</h4>
            <ul id="friends-list-modal" class="friends-list-modal">
                <?php
                $friends = $conn->query("SELECT * FROM friend_requests WHERE sender_id = $user_id_sess AND status = 'accepted' LIMIT 20");
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
                    END
            ";
                $friends = $conn->query($query);
                if ($friends->num_rows > 0) {
                    while ($friend = $friends->fetch_assoc()) {
                ?>
                        <li class="friend-item">
                            <label class="friend-label">
                                <input type="checkbox" class="friend-checkbox" value="<?php echo $friend['member_id']; ?>">
                                <span><?php echo $friend['username']; ?></span>
                            </label>
                        </li>
                <?php }
                } ?>
            </ul>
            <button id="save-group" class="btn btn-main">Save Group</button>
        </form>
    </div>
</div>
<!-- Group Chat Modal end-->

<!-- Group details modal start -->

<div id="group-details-modal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-modal" onclick="closeGroupDetailsModal()">&times;</span>
        <h3 id="group-name-title">Group Details</h3>
        <ul id="group-members-list" class="group-members-list">
            <!-- Group members dynamically loaded -->
        </ul>
        <div class="modal-actions" style="display: none;">
            <button id="update-group-btn" class="btn btn-main" onclick="openUpdateGroupModal()">Update</button>
            <button id="add-member-btn" class="btn btn-secondary" onclick="openAddMemberModal()">Add Members</button>
            <button id="delete-group-btn" class="btn btn-danger" onclick="deleteGroup()">Delete Group</button>
        </div>
    </div>
</div>

<!-- Group details modal end -->

<!-- Update Group  modal start -->

<div id="group-details-modal-update" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-modal" id="closeUpdateGroupModal">&times;</span>
        <h3 id="group-name-title-update">Update Group</h3>
        <form id="update-group-form" enctype="multipart/form-data">
            <input type="hidden" id="group-id-update" name="group_id">
            <div class="form-group">
                <label for="group-name-update">Group Name</label>
                <input type="text" class="form-control" id="group-name-update" name="group_name" placeholder="Enter Group Name">
            </div>
            <div class="form-group">
                <label for="group-image-update">Group Image</label>
                <input type="file" class="form-control" id="group-image-update" name="group_image">
            </div>
            <button id="update-group-btn-save" class="btn btn-main">Save</button>
        </form>
    </div>
</div>

<!-- Update Group modal end -->

<!-- Add members in group modal start -->

<div id="group-add-member-modal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-modal" onclick="closeGroupAddMemberModal()">&times;</span>
        <h3 id="group-name-title-add-member">Add Member</h3>
        <form id="add-member-group-form">

            <h4>Select Friends:</h4>
            <ul id="group-add-members-list" class="friends-list-modal">
                <!-- Add Group members dynamically loaded -->
            </ul>
            <button id="add-member-btn-save" class="btn btn-main">Add Members</button>
        </form>
    </div>
</div>

<!--Add members in group modal end -->