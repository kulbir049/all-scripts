$(document).ready(function () {
  // Open modal
  $("#create-group-btn").on("click", function () {
    $("#group-chat-modal").fadeIn();
  });

  // Close modal
  $(".close").on("click", function () {
    $("#group-chat-modal").fadeOut();
  });

  // Save group
  $("#save-group").on("click", function () {
    const groupName = $("#group-name").val();

    const selectedFriends = [];
    $("#friends-list-modal input:checked").each(function () {
      selectedFriends.push($(this).val());
    });
    // alert(selectedFriends);
    const groupImage = $("#group-image-create")[0].files[0]; // Get the selected file

    if (groupName && selectedFriends.length > 0) {
      const formData = new FormData();
      formData.append("group_name", groupName);
      formData.append("members", JSON.stringify(selectedFriends)); // Send array as JSON
      formData.append("form_purpose", "create_group");

      if (groupImage) {
        formData.append("group_image", groupImage); // Attach image file
      }

      $.ajax({
        url: "group_chat/backend_group.php",
        method: "POST",
        data: formData,
        processData: false, // Don't process the data
        contentType: false, // Let the browser set the content type
        success: function (response) {
          console.log(response);
          alert("Group created successfully!");
          // $("#group-chat-modal").fadeOut();
          location.reload();
        },
        error: function () {
          alert("Error creating group. Please try again.");
        },
      });
    } else {
      alert("Please enter a group name and select at least one friend.");
    }
  });

  // Update group
  $("#update-group-btn-save").on("click", function () {
    const groupName = $("#group-name-update").val();
    const groupId = $("#group-id-update").val();
    const groupImage = $("#group-image-update")[0].files[0]; // Get the image file

    // alert(selectedFriends);
    if (groupName) {
      const formData = new FormData();
      formData.append("group_id", groupId);
      formData.append("group_name", groupName);
      formData.append("form_purpose", "update_group");

      if (groupImage) {
        formData.append("group_image", groupImage); // Attach image file if available
      }

      $.ajax({
        url: "group_chat/backend_group.php",
        method: "POST",
        data: formData,
        processData: false, // Prevent jQuery from processing data
        contentType: false, // Let the browser set the content type
        success: function (response) {
          console.log(response);
          const result = JSON.parse(response);
          if (result.status) {
            alert("Group updated successfully!");
            $("#group-update-modal").fadeOut();
            location.reload();
          } else {
            alert("Failed to update group. " + result.error);
          }
        },
        error: function () {
          alert("Error update group. Please try again.");
        },
      });
    } else {
      alert("Please enter a group name.");
    }
  });
});

// Open group chat

function openGroupChat(groupId, groupName, user_id_sess, role) {
  if (document.getElementById(`chat-box-${groupId}`)) return;

  const container = document.getElementById("chat-box-container");
  const chatBox = document.createElement("div");
  chatBox.id = `chat-box-${groupId}`;
  chatBox.className = "chat-box";

  chatBox.innerHTML = `
        <div class="chat-box-header">
            ${groupName}&nbsp;
            <span style="float: right; cursor: pointer;" onclick="closeGroupChatBox(${groupId})">&times;</span>
            ${`<button style="background:#1e435d" onclick="openGroupDetails(${groupId}, '${groupName}','${role}')">Group Details</button>`}
        </div>
        <div class="chat-box-messages" id="messages-${groupId}">
            <!-- Messages will be loaded here -->
        </div>
        <div class="chat-box-input">
            <input type="text" id="input-${groupId}" placeholder="Type a message..." />
            <button onclick="sendMessageInGroup(${groupId}, '${user_id_sess}')">Send</button>
        </div>
    `;
  container.appendChild(chatBox);
  updateGroupMessagesUnreadCount(groupId);
  activeChats[groupId] = setInterval(() => fetchGroupMessages(groupId), 10000); // Poll every second
  fetchGroupMessages(groupId); // Load messages immediately
}

function closeGroupChatBox(groupId) {
  document.getElementById(`chat-box-${groupId}`).remove();
  clearInterval(activeChats[groupId]);
  delete activeChats[groupId];
}

function fetchGroupMessages(groupId) {
  // Retrieve the current user's ID safely from PHP

  console.log(
    `Fetching messages for Group ID: ${groupId}, User ID: ${loggedInUserId}`
  );

  $.ajax({
    url: "group_chat/backend_group.php", // Backend endpoint
    method: "POST",
    data: {
      form_purpose: "fetch_group_messages", // Define action for group messages
      groupId: groupId, // Pass the group ID
    },
    success: function (response) {
      try {
        // Parse the response
        const messages = JSON.parse(response);

        // Get the message container for the group
        const messageContainer = document.getElementById(`messages-${groupId}`);
        if (!messageContainer) {
          console.error(`Message container not found for Group ID: ${groupId}`);
          return;
        }

        messageContainer.innerHTML = ""; // Clear previous messages

        // Loop through and display messages
        messages.forEach((msg) => {
          const msgDiv = document.createElement("div");

          // Check if the current user sent the message
          if (msg.sender_id == loggedInUserId) {
            msgDiv.classList.add("sender-message"); // Apply sender-specific styles
            msgDiv.textContent = `You: ${msg.message}`;
          } else {
            msgDiv.classList.add("group-member-message"); // Style for group members
            msgDiv.textContent = `${msg.sender_name}: ${msg.message}`;
          }

          messageContainer.appendChild(msgDiv);
        });

        // Scroll to the latest message
        messageContainer.scrollTop = messageContainer.scrollHeight;
      } catch (error) {
        // console.error("Error parsing group messages:", error, response);
      }
    },
    error: function (xhr, status, error) {
      console.error("Request failed:", error);
    },
  });
}

function sendMessageInGroup(groupId) {
  const input = document.getElementById(`input-${groupId}`);
  const message = input.value.trim();

  // Safely retrieve the sender ID from a global variable or data attribute
  const senderId = loggedInUserId; // Assume loggedInUserId is globally set

  if (!message) {
    alert("Message cannot be empty.");
    return;
  }

  console.log(
    `Sending message to Group ID: ${groupId}, Sender ID: ${senderId}, Message: ${message}`
  );

  // AJAX request to send the message
  $.ajax({
    url: "group_chat/backend_group.php",
    method: "POST",
    data: {
      form_purpose: "send_group_message", // Specific action for group messages
      senderId: senderId,
      groupId: groupId, // Use group ID instead of receiver ID
      message: message,
    },
    success: function (response) {
      try {
        const data = JSON.parse(response);

        if (data.success) {
          input.value = ""; // Clear the input field on success
          fetchGroupMessages(groupId); // Refresh group messages immediately
        } else {
          alert("Failed to send message. Please try again.");
        }
      } catch (error) {
        console.error("Error parsing response:", error);
        alert("An unexpected error occurred.");
      }
    },
    error: function (xhr, status, error) {
      console.error("AJAX request failed:", error);
      alert("Failed to send message due to a network issue. Please try again.");
    },
  });
}

function updateGroupMessagesUnreadCount(groupId) {
  $.ajax({
    url: "group_chat/backend_group.php",
    method: "POST",
    data: {
      groupId: groupId,
      form_purpose: "update_unread_count_for_group",
    },
    success: function (response) {
      console.log(response);
    },
  });
}

function openGroupDetails(groupId, groupName, role) {
  $("#group-name-title").text(`Group: ${groupName}`);
  $("#group-members-list").empty();

  // hide the group chat box start
  closeGroupChatBox(groupId);
  // hide the group chat box end

  $.ajax({
    url: "group_chat/backend_group.php",
    type: "POST",
    data: {
      groupId: groupId,
      form_purpose: "fetch_group_members",
    },
    success: function (response) {
      const members = JSON.parse(response);
      members.forEach((member) => {
        let removeButton = ""; // Default: No button for members
        if (role === "admin") {
          if (member.role === "member") {
            // Show remove button for members (Admins can remove them)
            removeButton = `<button class="remove-member-btn" onclick="removeMemberFromGroup(${groupId}, '${member.member_id}')">Remove</button>`;
          } else if (
            member.role === "admin" &&
            member.member_id !== loggedInUserId
          ) {
            // Show disabled button for other admins (but not for the logged-in admin)
            // removeButton = `<button class="remove-member-btn disabled-btn" disabled>Remove</button>`;
          }
        }
        $("#group-members-list").append(`
            <li class="group-member-item">
               ${member.username} (${member.role}) ${removeButton}
            </li>
          `);
      });
    },
  });

  if (role === "admin") {
    // Show action buttons only for admin
    $(".modal-actions").show();

    // Add groupId and groupName to buttons as data attributes
    $("#update-group-btn")
      .attr("data-group-id", groupId)
      .attr("data-group-name", groupName);

    $("#add-member-btn")
      .attr("data-group-id", groupId)
      .attr("data-group-name", groupName);

    $("#delete-group-btn")
      .attr("data-group-id", groupId)
      .attr("data-group-name", groupName);
  } else {
    // Hide action buttons for non-admins
    $(".modal-actions").hide();
  }

  $("#group-details-modal").fadeIn();
}

function closeGroupDetailsModal() {
  $("#group-details-modal").fadeOut();
}

function openUpdateGroupModal() {
  const groupId = $("#update-group-btn").data("group-id");
  const groupName = $("#update-group-btn").data("group-name");

  $("#group-name-title-update").text(`Update Group: ${groupName}`);
  $("#group-name-update").val(groupName);
  $("#group-id-update").val(groupId);

  $("#group-details-modal-update").fadeIn();
}

// function closeUpdateGroupModal() {
//   $("#group-details-modal-update").fadeOut();
// }

function openAddMemberModal() {
  const groupId = $("#add-member-btn").data("group-id");
  const groupName = $("#add-member-btn").data("group-name");

  $("#group-name-title-add-member").text(`Add Member: ${groupName}`);
  $("#group-add-members-list").empty();

  console.log(`Adding members to group: ID=${groupId}, Name=${groupName}`);
  // Add your logic to open the add member modal here

  $.ajax({
    url: "group_chat/backend_group.php",
    type: "POST",
    data: {
      groupId: groupId,
      form_purpose: "fetch_members_to_add_group",
    },
    success: function (response) {
      const members = JSON.parse(response);
      members.forEach((member) => {
        $("#group-add-members-list").append(`
            <li class="friend-item">
              <label class="friend-label">
                <input type="checkbox" class="friend-checkbox" value="${member.member_id}">
                <span>${member.username}</span>
              </label>
            </li>
          `);
      });
    },
  });

  $("#group-add-member-modal").fadeIn();
}

// function closeGroupAddMemberModal () {
//   $("#group-add-member-modal").fadeOut();
// }

// Add member in group
$("#add-member-btn-save").on("click", function () {
  const groupId = $("#add-member-btn").data("group-id");
  const addSelectedFriends = [];
  $("#group-add-members-list input:checked").each(function () {
    addSelectedFriends.push($(this).val());
  });
  // alert(addSelectedFriends);
  // alert(groupId);
  if (addSelectedFriends.length > 0) {
    $.ajax({
      url: "group_chat/backend_group.php",
      method: "POST",
      data: {
        group_id: groupId,
        members: addSelectedFriends,
        form_purpose: "add_new_friends_into_group",
      },
      success: function (response) {
        console.log(response);
        alert("Member added successfully!");
        location.reload();
      },
      error: function () {
        alert("Error add member. Please try again.");
      },
    });
  } else {
    alert("Please select at least one friend.");
  }
});

function deleteGroup() {
  const groupId = $("#delete-group-btn").data("group-id");
  const groupName = $("#delete-group-btn").data("group-name");

  if (confirm(`Are you sure you want to delete the group "${groupName}"?`)) {
    $.ajax({
      url: "group_chat/backend_group.php",
      type: "POST",
      data: {
        groupId: groupId,
        form_purpose: "delete_group",
      },
      success: function (response) {
        const result = JSON.parse(response);
        if (result.status === "success") {
          alert(`Group "${groupName}" deleted successfully.`);
          $("#group-details-modal").fadeOut();
          // Optionally refresh the group list here
          location.reload();
        } else {
          alert(`Failed to delete group: ${result.error}`);
        }
      },
    });
  }
}

function removeMemberFromGroup(groupId, memberId) {
  // Show a confirmation alert
  const isConfirmed = confirm("Are you sure you want to remove this member?");

  if (!isConfirmed) {
    // If the user clicks "No", stop the function
    return false;
  }

  // Proceed with the AJAX request if confirmed
  $.ajax({
    url: "group_chat/backend_group.php", // Adjust the URL as per your setup
    method: "POST",
    data: {
      form_purpose: "remove_member", // Ensure this matches the server-side check
      groupId: groupId,
      memberId: memberId,
    },
    success: function (response) {
      try {
        const result = JSON.parse(response);

        if (result.status === "success") {
          alert("Member removed successfully!");
          // Optionally refresh the members list or update the UI dynamically
          $(
            `#group-members-list li:has(button[onclick*="'${memberId}'"])`
          ).remove();
        } else {
          alert("Failed to remove member. Please try again.");
        }
      } catch (error) {
        console.error("Failed to parse JSON response:", error, response);
        alert("An unexpected error occurred. Please try again.");
      }
    },
    error: function () {
      alert("An error occurred. Please try again.");
    },
  });
}
