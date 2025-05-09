<style>
  /* Friends List */
  .friends-list {
    position: fixed;
    right: 0;
    top: 55px;
    width: 250px;
    height: 100vh;
    background-color: #f5f5f5;
    border-left: 1px solid #ddd;
    padding: 10px;
    overflow-y: auto;
  }

  .friends-list h3 {
    text-align: center;
    margin-top: 0px;
  }

  .friends-list ul {
    list-style: none;
    padding: 0;
  }

  .friends-list li {
    padding: 10px;
    margin: 5px 0;
    background: #5fb5f2;
    color: white;
    text-align: center;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
    height: 51px;
    display: flex;
  }

  .friends-list li span {
    margin-left: 10px;
    margin-top: 5px;
  }

  .friends-list li:hover {
    background: #5fb5f2;
  }

  /* Chat Box */
  .chat-box-container {
    position: fixed;
    bottom: 0;
    right: 260px;
    /* Adjust based on friends list width */
    display: flex;
    gap: 10px;
  }

  .chat-box {
    width: 300px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 5px 5px 0 0;
    overflow: hidden;
    display: flex;
    flex-direction: column;
  }

  .chat-box-header {
    background: #5fb5f2;
    color: white;
    padding: 10px;
    text-align: center;
    cursor: pointer;
  }

  .chat-box-header:hover {
    background: #5fb5f2;
  }

  .chat-box-messages {
    flex: 1;
    padding: 10px;
    overflow-y: auto;
    border-top: 1px solid #ddd;
    min-height: 250px;
    max-height: 251px;
  }

  .chat-box-input {
    display: flex;
    border-top: 1px solid #ddd;
  }

  .chat-box-input input {
    flex: 1;
    padding: 10px;
    border: none;
  }

  .chat-box-input button {
    padding: 10px;
    background: #5fb5f2;
    color: white;
    border: none;
    cursor: pointer;
  }

  .chat-box-input button:hover {
    background: #5fb5f2;
  }

  /* General style for messages */
  .chat-box-messages div {
    margin: 10px;
    padding: 10px;
    border-radius: 10px;
    max-width: 80%;
    word-wrap: break-word;
    display: block;
    /* Ensure they stack properly */
  }

  /* Sender message (on the right) */
  .chat-box-messages .sender-message {
    background-color: #5fb5f2;
    color: white;
    text-align: right;
    float: right;
    /* Align sender's messages to the right */
    clear: both;
    border-radius: 10px 10px 0 10px;
    margin-left: 10px;
    /* Small margin for separation */
    margin-right: 0;
    /* Remove margin from the right side */
  }

  /* Friend message (on the left) */
  .chat-box-messages .friend-message {
    background-color: #ddd;
    color: black;
    text-align: left;
    float: left;
    /* Align friend's messages to the left */
    clear: both;
    border-radius: 10px 10px 10px 0;
    margin-left: 0;
    margin-right: 10px;
    /* Small margin for separation */
  }
</style>
<div id="friends-list" class="friends-list">
  <?php
  include('group_chat/group_chat.php');
  ?>
  <h3>Friends Chat</h3>
  <ul>
    <!-- Dynamic list of friends -->
    <?php //OR members.id IN (" . implode(',', array_map('intval', $os)) . "))
    // $sql = "
    //         SELECT members.*
    //         FROM members
    //         WHERE id IN (
    //             SELECT receiver_id
    //             FROM friend_requests
    //             WHERE sender_id = $user_id_sess AND status = 'accepted'
    //             UNION
    //             SELECT sender_id
    //             FROM friend_requests
    //             WHERE receiver_id = $user_id_sess AND status = 'accepted'
    //         ) limit 20";
    $sql = "
                      SELECT *
                      FROM friend_requests
                      WHERE sender_id = $user_id_sess AND status = 'accepted'
                      LIMIT 20";


    // Debugging: Uncomment to view the generated SQL
    // echo $sql;die;

    //dd($sql);
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while ($row_f = $result->fetch_assoc()) {
        $sql = "
                      SELECT members.*
                      FROM members
                      WHERE id=" . $row_f['receiver_id'];
        $result_m = $conn->query($sql);

        $row = $result_m->fetch_assoc();
    ?>
        <li onclick="openChatBox('<?php echo $row['id']; ?>', '<?php echo $row['username']; ?>')">
          <img class="pull-left avatar" style="height:50px;width:50px;margin-top:-9px;" src="grab_image.php?img=<?php echo $row['avatar']; ?>">
          <span><?php echo $row['username']; ?></span>
        </li>
    <?php }
    }
    ?>
  </ul>
</div>

<div id="chat-box-container" class="chat-box-container">
  <!-- Chat boxes will be appended here dynamically -->
</div>
<script>
  console.log('user_id=<?php echo $_SESSION['user_id']; ?>');
  let activeChats = {};

  function openChatBox(friendId, friendName) {
    if (document.getElementById(`chat-box-${friendId}`)) return;

    const container = document.getElementById("chat-box-container");
    const chatBox = document.createElement("div");
    chatBox.id = `chat-box-${friendId}`;
    chatBox.className = "chat-box";

    chatBox.innerHTML = `
        <div class="chat-box-header" onclick="closeChatBox(${friendId})">
            Chat with ${friendName} <span style="float: right; cursor: pointer;">&times;</span>
        </div>
        <div class="chat-box-messages" id="messages-${friendId}">
            <!-- Messages will be loaded here -->
        </div>
        <div class="chat-box-input">
            <input type="text" id="input-${friendId}" placeholder="Type a message..." />
            <button onclick="sendMessage(${friendId}, '${friendName}')">Send</button>
        </div>
    `;
    container.appendChild(chatBox);
    activeChats[friendId] = setInterval(() => fetchMessages(friendId), 10000); // Poll every second
    fetchMessages(friendId); // Load messages immediately
  }

  function closeChatBox(friendId) {
    document.getElementById(`chat-box-${friendId}`).remove();
    clearInterval(activeChats[friendId]);
    delete activeChats[friendId];
  }

  function sendMessage(friendId, friendName) {
    const input = document.getElementById(`input-${friendId}`);
    const message = input.value.trim();
    var senderId = <?php echo $_SESSION['user_id']; ?>;
    var receiverId = friendId;
    if (message) {
      console.log('sendMessage=====' + receiverId + '===' + senderId + '===' + message);
      $.ajax({
        url: "ajax_custom.php",
        method: "POST",
        data: {
          action: 'send_message',
          senderId: senderId,
          receiverId: receiverId,
          message: message
        },
        success: function(response) {
          console.log(response)
          const data = JSON.parse(response);
          console.log(response.success);
          console.log(data.success);
          if (data.success) {
            input.value = "";
            fetchMessages(friendId); // Refresh messages immediately
          } else {
            alert("Failed to send message");
          }
        },
      });
    }
  }

  function fetchMessages(friendId) {
    var receiver_id = <?php echo $_SESSION['user_id']; ?>;
    console.log('fetchMessages=====' + receiver_id + '====' + friendId);

    $.ajax({
      url: "ajax_custom.php",
      method: "POST",
      data: {
        action: 'fetch_messages',
        senderId: friendId,
        receiverId: receiver_id
      },
      success: function(response) {
        const messages = JSON.parse(response);
        const messageContainer = document.getElementById(`messages-${friendId}`);
        messageContainer.innerHTML = ""; // Clear previous messages

        messages.forEach((msg) => {
          const msgDiv = document.createElement("div");

          // Determine if it's the sender's message or the friend's message
          if (msg.sender_id == <?php echo $_SESSION['user_id']; ?>) {
            msgDiv.classList.add('sender-message'); // Apply sender styles
            msgDiv.textContent = `You: ${msg.message}`;
          } else {
            msgDiv.classList.add('friend-message'); // Apply friend's message styles
            msgDiv.textContent = `${msg.message}`;
          }

          messageContainer.appendChild(msgDiv);
        });

        messageContainer.scrollTop = messageContainer.scrollHeight; // Scroll to the latest message
      },
    });
  }
</script>

<!-- Scripts Group Chat start-->
<script>
  const loggedInUserId = "<?php echo $user_id_sess ?>";
</script>
<script src="group_chat/group.js?v=<?php echo time(); ?>"></script>

<!-- Scripts Group Chat end-->