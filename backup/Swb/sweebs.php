<?php include('main/config.php');
// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();

$sweeb_id_dl = strip_tags($_GET["s"]);
if ($sweeb_id_dl != NULL) {
  $dlt_sweeb = 'yes';
  $sweeb_dlt_id = base64_decode($sweeb_id_dl);
  include('main/delete_sweeb.php');
} else {
  $dlt_sweeb = 'no';
}
?>

<?php include('main/header.php'); ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  @media (min-width: 360px) and (max-width: 740px) {
    .pin {
      width: 300px !important;
    }
  }

  
  .switch {
      position: relative;
      display: inline-block;
      width: 85px;
      height: 24px;
      cursor: pointer !important;
      margin: 0 !important;
      vertical-align: middle;
    }

    .switch input {
      display: none;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      border-radius: 34px;
      transition: 0.4s;
    }

    .slider:before {
      position: absolute;
      content: '';
      height: 24px;
      width: 24px;
      left: 4px;
      bottom: 0px;
      background-color: white;
      border-radius: 50%;
      transition: 0.4s;
    }

    input:checked+.slider {
      background-color: #5cb85c;
      /* Background color when toggled on */
    }

    input:checked+.slider:before {
      transform: translateX(55px);
    }

    .on-off-text {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      left: 30px;
      color: #555;
    }
</style>

<br>

<body>
  <div class="container" style="font-family: 'Open Sans', sans-serif;">
    <div class="row">

      <div class="container-fluid">
        <div class="col-xs-12 col-md-12" style="margin:0px;">
          <?php
          if ($dlt_sweeb == 'yes') {
          ?>

            <div class="col-md-12 box" style="padding:0px;">
              <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo $Err;
              } ?>
              <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;margin-bottom:15px;width:100%;border:0px;">
                Are You Sure You Want To Delete Your Sweeb?
              </div>
              <div style="padding:20px;">
                <p style="text-align:center;">You are about to delete your sweeb are you sure you want to delete it?</p>
                <form method="post">
                  <p style="text-align:center;">
                    <button type="submit" class="btn btn-main" style="border:3px solid #e74c3c;color:#e74c3c;">Yes Delete It</button>
                    - OR -
                    <a href="sweebs.php" class="btn btn-main">No Don't Delete it</a>
                  </p>
                </form>
              </div>
            </div>

          <?php
          } else {
          ?>

            <div id="wrapper">
              <div id="columns" style="display: initial;">
                <?php
                $friends = '' . $friends . ', ' . $user_id . '';
                $friends = explode(", ", $friends);
                $sql = "SELECT *  FROM sweebs WHERE user_id='$user_id' AND status='active' ORDER BY id DESC";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                  $user_id_sweeb = $row['user_id'];
                  $sweeb_id_cur = $row['id'];
                  $link = base64_encode($sweeb_id_cur);
                  $video_str = $row['video'];
                  $content = $row['content'];
                  $link_url = $row['link'];
                  $image_str = $row['image'];
                  $content = substr($content, 0, 50) . '...';
                ?>
                  <!-- Sweeb Pin HTML -->
                  <div class="pin">
                    <div style="padding:10px;">
                      <?php if ($image_str != NULL) { ?>
                        <div class="visible-xs" style="padding-top:20px;"></div>
                        <div class="col-md-12 col-xs-12" style="padding:0px;border:1px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;">
                          <img src="grab_image.php?img=<?php echo $row['image']; ?>" style="min-height:1px;min-width:1px;max-height:250px;max-width:100%;border-radius:3px;">
                        </div>
                      <?php } elseif ($video_str != NULL) { ?>
                        <div class="visible-xs" style="padding-top:20px;"></div>
                        <div class="col-md-12 col-xs-12" style="padding:0px;border:1px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;">
                          <iframe width="200" height="195" src="https://www.youtube.com/embed/<?php echo $video_str; ?>?autoplay=0&showinfo=0&controls=0" frameborder="0" allowfullscreen></iframe>
                        </div>
                      <?php } elseif ($image_str == NULL and $video_str == NULL) { ?>
                        <div class="visible-xs" style="padding-top:20px;"></div>
                        <div class="col-md-12 col-xs-12" style="padding:0px;border:1px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;">
                          <img src="grab_image.php?img=<?php echo $row['image']; ?>" style="min-height:1px;min-width:1px;max-height:250px;max-width:100%;border-radius:3px;">
                        </div>
                      <?php } ?>

                      <h3 style="font-family: 'Open Sans', sans-serif;"><?php echo $row['title']; ?></h3>
                      <p style="font-family: 'Open Sans', sans-serif;word-break: break-all;" id="output"><?php echo $content; ?></p>

                      <?php if (!empty($link_url)) { ?>
                        <a href="<?php echo $link_url; ?>" target="_blank">Post Link</a>
                      <?php } ?>
                    </div>
                    <div style="background:#f6f8fa;color:#838990;text-align:center;padding:10px;border-top:1px solid #ebeef1;">Views: <b><?php echo $row['views']; ?></b></div>
                    <div style="background:#fff;color:#838990;text-align:center;padding:10px;border-top:1px solid #ebeef1;">Up Votes: <b><?php echo $row['up']; ?></b></div>
                    <div style="background:#f6f8fa;color:#838990;text-align:center;padding:10px;border-top:1px solid #ebeef1;">Down Votes: <b><?php echo $row['down']; ?></b></div>
                    <div style="background:#fff;color:#838990;text-align:center;padding:10px;border-top:1px solid #ebeef1;">Comments: <b><?php echo $row['comments']; ?></b></div>
                    <div style="padding:10px;">
                    <a href="Javascript:void(0)" class="btn btn-main btn-block">
                        <p style="margin-top: 0px;display: inline-block;">
                          <span style="color:#838990;font-size:14px;"> Show Everywhere </span>
                          <label class="switch">
                            <input type="checkbox" class="on_off_toggle" <?php if ($row['on_off_toggle'] == 'ON') {
                                          echo 'checked';
                                        } ?> id="on_off_toggle" data-sweebs_id="<?php echo $row['id']; ?>">
                            <span class="slider round"></span>
                            <span class="on-off-text" id="on_off_toggle_<?php echo $row['id'];?>"><?php if ($row['on_off_toggle'] == 'ON') { echo 'ON'; }else{
                              echo 'OFF'; } ?></span>
                          </label>
                        </p>
                      </a>
                      <a href="/<?php echo $row['id']; ?>/new" class="btn btn-main btn-block">View Sweeb</a>
                      <a href="edit_sweeb.php?id=<?php echo $row['id']; ?>" class="btn btn-main btn-block">Edit Sweeb</a>
                      <a href="sweebs.php?s=<?php echo $link; ?>" class="btn btn-main btn-block">Delete This Sweeb <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                      

                    </div>
                  </div>

                <?php
                }
                ?>
              <?php
            }
              ?>
              </div>
            </div>
        </div>

        <Style>
          #columns {
            -webkit-column-count: 3;
            -webkit-column-gap: 10px;
            -webkit-column-fill: auto;
            -moz-column-count: 3;
            -moz-column-gap: 10px;
            column-count: 3;
            column-gap: 15px;
            column-fill: auto;
          }

          .pin {
            width: 250px;
            border-radius: 3px;
            display: inline-block;
            background: #fff;
            border: 1px solid #FAFAFA;
            box-shadow: 0 1px 2px rgba(34, 25, 25, 0.4);
            margin: 0 2px 15px;
            -webkit-column-break-inside: avoid;
            -moz-column-break-inside: avoid;
            column-break-inside: avoid;
            padding-bottom: 5px;
            background: -webkit-linear-gradient(45deg, #FFF, #F9F9F9);
            opacity: 1;
            -webkit-transition: all .2s ease;
            -moz-transition: all .2s ease;
            -o-transition: all .2s ease;
            transition: all .2s ease;
          }

          .pin img {
            width: 100%;
            border-bottom: 1px solid #ccc;
            padding-bottom: 0px;
            margin-bottom: 5px;
          }

          .pin p {
            color: #333;
            margin: 0;
          }
        </style>

        <footer>

        </footer>

      </div> <!-- /container -->

      <!-- Bootstrap core JavaScript -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
      <script>
    $(document).ready(function() {
      $('.on_off_toggle').change(function() {
        var isChecked = $(this).prop('checked');
        //alert(isChecked);
        var onOffText = isChecked ? 'ON' : 'OFF';
        var sweebs_id =$(this).data('sweebs_id');
       // alert(onOffText);
        $('#on_off_toggle_'+sweebs_id).text(onOffText);

        // Make an AJAX request to store toggle value in session
        $.ajax({
          type: "POST",
          url: "ajax_custom.php", // Create this file for server-side verification
          data: {
            on_off_toggle_sweebs: onOffText,
            sweebs_id:sweebs_id
          },
          success: function(response) {
            // null
          }
        });
      });
      // var on_off_toggle = $('#on_off_toggle').prop('checked');
      // var onOffText = on_off_toggle ? 'ON' : 'OFF';
      // $('.on-off-text').text(onOffText);
    });
    </script>
</body>

</html>