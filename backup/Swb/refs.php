<?php include('main/config.php');
include('main/functions.php');

// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();

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
</style>


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
    background: #3e4851;
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


<script>
  function myFunction() {
    // Get the text field
    var copyText = document.getElementById("myInput");

    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);


  }
</script>


<script>
  function myFunction3() {
    // Get the text field
    var copyText = document.getElementById("myInput3");

    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);


  }
</script>

<script>
  function myFunction4() {
    // Get the text field
    var copyText = document.getElementById("myInput4");

    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);


  }
</script>

<script>
  function myFunction5() {
    // Get the text field
    var copyText = document.getElementById("myInput5");

    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);


  }
</script>

<script>
  function myFunction6() {
    // Get the text field
    var copyText = document.getElementById("myInput6");

    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);


  }
</script>

<script>
  function myFunction7() {
    // Get the text field
    var copyText = document.getElementById("myInput7");

    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);


  }
</script>

<div class="box" style="width:100%;padding:0px;margin-bottom:10px;">
  <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;font-family: 'Open Sans', sans-serif;">
    Invite Your Friends To Sweeba & Earn
  </div>
  <div style="padding:20px;color:#3e4851;text-align:center;font-size:16px;width:100%;">
    <?php
    $quick_fix = str_replace(' ', '-', $username);
    ?>

    <div style="margin:20px;">
      <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> Earn <b>50 credits</b> for each & every referral.
      <br>
      <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> Free Members earn <b>25%</b> Recurring commissions.
      <br>
      <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> Free Members earn <b>5% credits</b> of their referrals surfing.
      <br>
      <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> Premium members earn <b>40%</b> Recurring commissions.
      <br>
      <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> Premium Members earn <b>10% credits</b> of their referrals surfing.
      <br><br>
      <font color="#6ab04c"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span></font> Earn free referrals from upgrades & purchases. You can <a href="/upgrade.php"> upgrade here</a>.
      <bR><br>
      <b>Referral stats can be seen at the bottom of this page once you have referred members.</b>

      <div>
        <center>

          <div class="clipboard">
            <h4>Your Referral Link</h4><!-- The text field -->
            <input type="text" value="https://www.sweeba.com/?ref=<?php echo $quick_fix; ?>" id="myInput">

            <!-- The button used to copy the text -->
            <button onclick="myFunction()" class="btn-success">Copy</button>
          </div>
        </center></b></font>
      </div>


      <div>
        <h4>468x60 Banner</h4>
        <img src="images/468.gif" width="300">
        <center>
          <div class="clipboard"><!-- The text field -->
            <input type="text" value="https://www.sweeba.com/images/468.gif" id="myInput3">
            <!-- The button used to copy the text -->
            <button onclick="myFunction3()" class="btn-success">Copy</button>
          </div>
        </center></b></font>
      </div>

      <div>
        <h4>728x90 Banner</h4>
        <img src="images/728.gif" width="350">
        <center>
          <div class="clipboard"><!-- The text field -->
            <input type="text" value="https://www.sweeba.com/images/728.gif" id="myInput4">
            <!-- The button used to copy the text -->
            <button onclick="myFunction4()" class="btn-success">Copy</button>
          </div>
        </center></b></font>
      </div>

      <div>
        <h4>336x280 Banner</h4>
        <img src="images/336.gif" width="336">
        <center>
          <div class="clipboard"><!-- The text field -->
            <input type="text" value="https://www.sweeba.com/images/336.gif" id="myInput5">
            <!-- The button used to copy the text -->
            <button onclick="myFunction5()" class="btn-success">Copy</button>
          </div>
        </center></b></font>
      </div>


      <div>
        <h4>250x250 Banner</h4>
        <img src="images/250.gif" width="250">
        <center>
          <div class="clipboard"><!-- The text field -->
            <input type="text" value="https://www.sweeba.com/images/250.gif" id="myInput6">
            <!-- The button used to copy the text -->
            <button onclick="myFunction6()" class="btn-success">Copy</button>
          </div>
        </center></b></font>
      </div>

      <div>
        <h4>120x600 Banner</h4>
        <img src="images/120.gif" width="120" height="600">
        <center>
          <div class="clipboard"><!-- The text field -->
            <input type="text" value="https://www.sweeba.com/images/120.gif" id="myInput7">
            <!-- The button used to copy the text -->
            <button onclick="myFunction7()" class="btn-success">Copy</button>
          </div>
        </center></b></font>
      </div>

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

      <h1>Message Your Referrals</h1>
      <p>Increase your earnings by messaging your referrals and encouraging them to upgrade and make purchases.
        <br>
        Below is a pre-made template that you can copy. Simply push the message button below and type in their username.
        <br><br>
        <!-- The text field -->
        <input type="text" value="Hello, welcome to the wonderful Sweeba community. Be sure to upgrade and purchase credits to increase your exposure and earnings!  Sweeba Rocks!" id="myInput8">

        <!-- The button used to copy the text -->
        <button onclick="myFunction8()">Copy Message</button>
        <br><Br>

        <a href="message.php" class="btn btn-main btn-block">Message Referrals</a>

    </div>

    <div class="table-responsive">
      <div style="width:100%;padding:14px;font-family: 'Open Sans', sans-serif;">

        <?php
        $sql = "SELECT id,username, ref, comes_from, created_date ,sweebs FROM members WHERE ref='$username' order by id desc";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        ?>
          <table class="table">
            <tr>
              <th>Username</th>
              <th>Amount</th>
              <th>Sweebs</th>
              <th>Profile</th>
              <th>Comes from</th>
              <th>Date</th>
            </tr>

            <?php
            // output data of each row
            while ($row = $result->fetch_assoc()) {
              $refer_amount = getPremimumMember($user_id_sess, $conn);
              // $refs = $row['comes_from'] ?? 'no reff';
            ?>
              <tr>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['refer_amount']; ?></td>
                <td><?php echo $row['sweebs']; ?></td>
                <td><a href="/<?php echo $row['username']; ?>">View</a></td>
                <td><?php echo $row['comes_from']; ?></td>
                <td><?php echo $row['created_date']; ?></td>
              </tr>
          <?php
            }
          } else {
            echo '<p style="text-align:center;">You currently do not have any referrals.</p>';
          }
          echo '</table>';
          ?>

      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <script src="/dist/js/bootstrap.min.js"></script>


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
  </body>

  </html>
  <?php
  function getPremimumMember($id, $conn)
  {
    //checking premium meber or not
    $date = date('Y-m-d');
    $ref_com = '0.00';
    $sql_premium = "SELECT * FROM subscription where user_id='" . $id . "' AND expire_date > '" . $date . "' AND status='Success'";
    $result_premium = $conn->query($sql_premium);
    if ($result_premium->num_rows > 0) {
      $ref_com = '0.00';
    } else {
      $ref_com = '0.00';
    }
    return $ref_com;
  }

  ?>