<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include('main/config.php');
include('main/functions.php');


checkLogin();

if (isset($_POST['create_a_ticket'])) {
    //dd($_POST);
    $type = $_POST['type'];
    $title = $_POST['title'];
    $reply_content = $_POST['description'];

    $created_at = date('Y-m-d H:i:s');
    if ($reply_content != '') {
        $sqlQuery = "INSERT INTO tickets (`user_id`,`type`,`title`,`description`,`created_at`) 
                        VALUES ('$user_id_sess','$type','$title','$reply_content','$created_at')";
        $result = $conn->query($sqlQuery);

        if ($result) {
            // Get the last insert ID
            $lastInsertId = $conn->insert_id;
            $sqlQuery = "INSERT INTO tickets_logs (ticket_id,notes_by_id,notes_by_name,notes,created_at) 
            VALUES ($lastInsertId,'$user_id_sess','$name','$reply_content','$created_at')";
            $result = $conn->query($sqlQuery);
            if ($result) {
                echo '<script>window.location.href="support.php"</script>';
            } else {
?>
                <script>
                    alert("something went wrong");
                    window.location.href = "support.php"
                </script>
<?php
            }
        }
    }
}

if(isset($_POST['reply_a_ticket'])){
    $reply_content = $_POST['description'];
    $t_id = $_POST['ticket_id'];
    
    $created_at=date('Y-m-d H:i:s');
    if($reply_content != ''){
       $sqlQuery = "INSERT INTO tickets_logs (ticket_id,notes_by_id,notes_by_name,notes,created_at,reply_by) 
       VALUES ($t_id,'$user_id_sess','$name','$reply_content','$created_at',0)";
       $result = $conn->query($sqlQuery);
       if($result){
        echo '<script>window.location.href="support.php"</script>';
       }else{
          ?>
             <script>alert("something went wrong");</script>
          <?php
       }
    }
 }


?>
<?php
include('main/header.php');
?>

<style>
    body {

        font-family: 'Open Sans', sans-serif;
    }

    p {
        font-family: 'Open Sans', sans-serif;
    }

    .accordion {
        background-color: #f1f1f1;
        border: none;
        padding: 10px;
        text-align: left;
        width: 100%;
        cursor: pointer;
        font-size: 20px;
        transition: 0.4s;
    }

    .accordion.active {
        background-color: #ccc;
    }

    .panel {
        padding: 10px;
        display: none;
        background-color: #f9f9f9;
    }

    .chat-history {
        max-height: 300px;
        overflow-y: auto;
        margin-bottom: 20px;
    }

    .chat-message {
        display: flex;
        margin-bottom: 10px;
    }

    .chat-message .avatar {
        width: 40px;
        height: 40px;
        background-color: #ddd;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        color: white;
        margin-right: 6px;
        margin-top: 1px;
    }

    .chat-message .message {
        max-width: 70%;
        background-color: #f1f1f1;
        padding: 10px;
        border-radius: 10px;
        position: relative;
    }

    .chat-message.user .message {
        background-color: #cce5ff;
        /* User's messages */
        align-self: flex-end;
    }

    .chat-message.other .message {
        background-color: #d4edda;
        /* Other's messages */
    }

    .timestamp {
        font-size: 10px;
        color: gray;
        text-align: right;
    }

    .chat-input {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .chat-input textarea {
        width: 80%;
        padding: 8px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
        resize: none;
    }

    .chat-input .send-button {
        width: 15%;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .chat-input .send-button:hover {
        background-color: #0056b3;
    }

    .toggle {
        float: right;
        font-size: 20px;
    }
</style>


<div class="container" style="font-family: 'Open Sans', sans-serif;">
    <div class="row">

       

        <div class="col-md-10">
            <style>
                .sweeb_b {
                    color: #fff;
                    margin-bottom: 25px;
                    height: 100px;
                    position: relative;
                    //display:block;
                    font-weight: 700;
                    font-size: 12px;
                    letter-spacing: 2px;

                    text-transform: uppercase;
                    outline: 0;
                    overflow: hidden;
                    background: none;
                    z-index: 1;
                    cursor: pointer;
                    transition: 0.08s ease-in;
                    -o-transition: 0.08s ease-in;
                    -ms-transition: 0.08s ease-in;
                    -moz-transition: 0.08s ease-in;
                    -webkit-transition: 0.08s ease-in;
                }

                .sweeb_b a {
                    color: #fff;
                }

                .sweeb_g {
                    background: #a2de5a;
                }

                .sweeb_bl {
                    background: #5fb5f2;


                }

                .sweeb_r {
                    background: #f26986;

                }


                .sweeb_g:hover,
                .sweeb_bl:hover,
                .sweeb_r:hover {
                    color: whitesmoke;
                }

                .sweeb_g:before,
                .sweeb_bl:before,
                .sweeb_r:before {
                    content: "";
                    position: absolute;
                    background: #5cb85c;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    top: 100%;
                    z-index: -1;
                    -webkit-transition: top 0.09s ease-in;
                }

                .sweeb_g:hover:before,
                .sweeb_bl:hover:before,
                .sweeb_r:hover:before {
                    top: 0;
                }



                .sweeb {
                    background: #fff;
                    padding: 20px;
                }
            </style>

           

            <div class="col-md-12" style="margin-left:-1px;padding:0px;">
                <script>
                    function myFunction8() {
                        // Get the text field
                        var copyText = document.getElementById("myInput8");

                        // Select the text field
                        copyText.select();
                        copyText.setSelectionRange(0, 99999); // For mobile devices

                        // Copy the text inside the text field
                        navigator.clipboard.writeText(copyText.value);

                        // Alert the copied text
                        alert("Copied the text: " + copyText.value);
                    }
                </script>

                <center>
                    <h1>Help and Support</h1>
                    <p>Below you can create a support ticket for any questions or concerns.</p>
                        <br>

                </center>

                <button class="btn btn-main btn-block" style="background:#fff;margin-bottom:10px;" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" onclick="create_mssage_button()">
                    Create A Ticket
                </button>

                <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    echo $Err;
                } ?>

                <div class="collapse" id="collapseExample">

                    <div class="box" style="width:100%;padding:0px;margin-bottom:10px;margin-left:-1px;">

                        <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;margin-bottom:15px;width:100%;border:0px;">
                            Create A Ticket
                        </div>
                        <div style="padding:20px;">


                            <form method="post">
                                <select name="type" class="form-control form_in" required>
                                    <option value="">Select Option</option>
                                    <option value="credit">Credits</option>
                                    <option value="balance">Balance</option>
                                    <option value="referral">Referrals</option>
                                    <option value="other">other</option>
                                </select><br>
                                <input type="text" name="title" placeholder="subject" class="form-control form_in" required /><br>
                                <textarea class="form-control form_in" name="description" style="border:1px solid #d3dce5;box-shadow:none;border-radius:0px;" rows="3" required></textarea>
                                <br>
                                <input type="submit" class="btn btn-main" style="background:#5fb5f2;border:0px;color:#fff;" name="create_a_ticket" value="Submit">
                            </form>




                        </div>
                    </div>
                </div>


                <?php
                $sql = "SELECT * FROM tickets WHERE user_id = '$user_id_sess' ORDER BY id DESC";
                $result = $conn->query($sql);


                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {

                        $sen_user_id = $row['user_id'];
                        // end 

                        //Grab avatar  
                        $sq = "SELECT avatar FROM members WHERE id ='$sen_user_id'";
                        $resul = $conn->query($sq);
                        if ($resul->num_rows > 0) {
                            // output data of each row
                            while ($ro = $resul->fetch_assoc()) {
                                $sen_avatar = $ro['avatar'];
                            }
                        }
                        //end avatar
                        $w_message = $row['title'];
                        $content = substr($row['description'], 0, 80) . '...';
                        $datetime = $row['created_at'];
                ?>

                        <button class="accordion">#<?php echo $row['id']; ?> <?php echo $w_message; ?> <span class="toggle">+</span></button>
                        <div class="panel">
                            <div class="chat-history">
                                <!-- Example chat messages -->
                                 <?php 
                                    $sql_2 = "SELECT * FROM tickets_logs WHERE ticket_id = ".$row['id']." ORDER BY id asc";
                                    $result_2 = $conn->query($sql_2);
                    
                    
                                    if ($result_2->num_rows > 0) {
                                        // output data of each row
                                        while ($row_2 = $result_2->fetch_assoc()) {
                                            $w_message = $row['title'];
                                            $datetime = $row['created_at'];
                                         if($row_2['reply_by']==0){ // by user   ?>
                                <div class="chat-message user">
                                    <div class="avatar"><img class="pull-left avatar" src="grab_image.php?img=<?php echo $sen_avatar;?>" /></div> <!-- Placeholder for User Avatar -->
                                    <div class="message">
                                        <span class="username"><?php echo $row_2['notes_by_name'];?></span>: <?php echo $row_2['notes'];?>
                                        <div class="timestamp"> <?php echo date('Y-m-d h:i A', strtotime($row_2['created_at']));?></div>
                                    </div>
                                </div>
                                <?php }else{ ?>
                                <div class="chat-message other">
                                    <div class="avatar">S</div> <!-- Placeholder for Other Participant Avatar -->
                                    <div class="message">
                                        <span class="username">Sweeba</span>: <?php echo $row_2['notes'];?>
                                        <div class="timestamp"><?php echo date('Y-m-d h:i A', strtotime($row_2['created_at']));?></div>
                                    </div>
                                </div>
                                <?php }
                                        }
                                    }
                                    ?>
                                <!-- Additional messages go here -->
                            </div>

                            <!-- Chat input area -->
                            <div class="chat-input">
                            <form method="post" style="width: 100%;">
                                <input type="hidden" name="ticket_id" class="form-control form_in" value="<?php echo $row['id']; ?>" /><br>
                                <textarea class="form-control form_in" name="description" style="border:1px solid #d3dce5;box-shadow:none;border-radius:0px;" rows="3" required></textarea>
                                <br>
                                <input type="submit" class="btn btn-main" style="background:#5fb5f2;border:0px;color:#fff;" name="reply_a_ticket" value="Reply">
                            </form>
                            </div>
                        </div>





                <?php
                    }
                }

                //$conn->close();

                ?>






            </div>

        </div>


    </div>
</div>



<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
    function create_mssage_button() {
        jQuery("#collapseExample").show();

    }
</script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7LHWPPZECB"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-7LHWPPZECB');
</script>
<script>
    // Select all accordion buttons
    var acc = document.getElementsByClassName("accordion");

    // Loop through each accordion button and add a click event listener
    for (var i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            // Toggle the panel
            this.classList.toggle("active");

            var panel = this.nextElementSibling;

            // If the panel is open, close it and change the button text to '+'
            if (panel.style.display === "block") {
                panel.style.display = "none";
                this.querySelector(".toggle").textContent = "+";
            } else {
                // If the panel is closed, open it and change the button text to '-'
                panel.style.display = "block";
                this.querySelector(".toggle").textContent = "-";
            }
        });
    }
</script>
</body>

</html>