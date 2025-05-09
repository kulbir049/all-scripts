<?php include('main/config.php');

include('main/add_sweeb.php');
// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();
?>

<!-- Modal -->
<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<!-- End Modal -- >
<?php include('main/header.php'); ?>
<style>
body {
font-family: 'Open Sans', sans-serif;
}
p {
font-family: 'Open Sans', sans-serif;
}

.preview {
border-radius:3px;
padding:10px;
-webkit-box-shadow: 0px 0px 8px 0px rgba(226, 226, 226, 0.75);
-moz-box-shadow:    0px 0px 8px 0px rgba(226, 226, 226, 0.75);
box-shadow:         0px 0px 8px 0px rgba(226, 226, 226, 0.75);
}

</style>


<div class="container" style="margin-top:100px;padding:0px;font-family: 'Open Sans', sans-serif;">
<div class="row">
  <div class="col-xs-12 col-md-6 col-md-offset-1" style="background:#fff;padding:0px;">
  <div style="width:100%;background:#f26986;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;margin-bottom:15px;">
Create A Sweeb
</div>

<div style="padding:20px;">
<span class="glyphicon glyphicon-flag" aria-hidden="true"></span> <b>TIP</b>   For best results; add a photo, title and link by using the buttons below.
</div>

<?php

$date1 = date("Y-m-d");

$result = $conn->query("SELECT COUNT(*) FROM `sweebs` WHERE timestamp='$date1' AND user_id = '$user_id' ");
$row = $result->fetch_row();
$total_sweeb_today = $row[0];
$result->close();

$left = 3 - $total_sweeb_today;
if ($amount > 3) {
    echo '<h2 style="text-align:center;">You Reached Your Limit!</h2><p style="text-align:center;">Come back tomorrow to post more sweebs!</p>';
} else {
?>

<div style="padding:20px;">
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo $Err;
    }
?>

<form method="post" enctype="multipart/form-data">


<div class="collapse image" id="image_s">
<p>Add an image to your sweeb! Images make sweebs fun!</p>
<div style="height:0px;overflow:hidden">
<input type="file" id="fileInput" name="fileInput" onchange="PreviewImg(this);"/>
</div>

<div class="padding:10px;">
<div class="input-group">
<input type="text" class="form-control form_in" name="fileInput" id="filename" placeholder="">
<span class="input-group-btn">
<button class="btn btn-primary" type="button" onclick="chooseFile();">Choose File  <span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span></button>
</span>
</div><!-- /input-group -->
</div><br></div>

<div id="video_s" style="display:none;">
    <p>Paste a youtube code below. To get the code copy the ending of the url. <b>Example;</b> The bolded part of the url is what goes in the field: https://www.youtube.com/watch?v=<b>nrMcdLTWP-A</b></p>
    <input type="text" class="form-control form_in" id="video_input" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                                                echo $_POST["video"];
                                                                            } ?>" name="video" placeholder="nrMcdLTWP-A" maxlength="50">
    <br>
</div>

<div class="collapse py-2" id="title">
    <input type="text" class="form-control form_in" id="title_input" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                                                echo $_POST["title"];
                                                                            } ?>" name="title" placeholder="Title Your Sweeb" maxlength="20">
    <br>
</div>

<div class="collapse" id="linkInput" style="padding: 10px 0px;">
    <input type="text" class="form-control form_in" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                                echo $_POST["link"];
                                                            } ?>" name="link" id="link_input" placeholder="Enter Link">
</div>

<textarea class="form-control form_in" id="input" name="content" placeholder="Lets post a sweeb! Be sure to add some tags #sweeba to increase the people that see your sweeb, but not too many tags. " rows="7">
<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo $_POST["content"];
    } ?>
</textarea>
<div id="count" class="pull-right" style="font-size:12px;"></div>
<br>





<button type="button" class="btn btn-main" id="image">Add Image <img src="dist/img/img_icon.png"></button>



<button type="button" class="btn btn-main" id="video">Add Video <img src="dist/img/video_icon.png"></button>

<button type="button" class="btn btn-main" data-toggle="collapse" href="#title" aria-expanded="false" aria-controls="title">Add Title <span class="glyphicon glyphicon-header" aria-hidden="true" style="color:#a2de5a;"></span></button>
<button type="button" class="btn btn-main" onclick="toggleInput()">Add Link <img src="images/website-link.png" width="20"></button>



</div>
<div style="background:#eef0f2;width:100%;padding:20px;border-top:1px solid:#d7dce1;">
    <button type="submit" class="btn btn-main" style="background:#fff;font-family: 'Open Sans', sans-serif;
">Post Your Sweeb <img src="dist/img/continue_icon.png"></button>
    <div class="visible-xs">
        <p style="font-family: 'Open Sans', sans-serif;font-size:14px;padding-top:8px;">You can post <?php echo $left; ?> more Sweebs Today.</p>
    </div>
    <div class="hidden-xs">
        <p class="pull-right" style="font-family: 'Open Sans', sans-serif;font-size:14px;margin-top:-31px;">You can post <?php echo $left; ?> more Sweebs Today.</p>
    </div>


</div>
</form>
<?php } ?>
</div>

</head>

<body>

    <div class="col-md-4 hidden-xs hidden-sm" style="background:#fff;padding:0px;margin-left:25px;">


        <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;">
            Preview
        </div>
        <div style="padding:10px;font-family: 'Open Sans', sans-serif;">
            <div class="preview">
                <p style="text-align:center;">
                    <img id="blah" src="dist/img/hold.png" alt="your image" style="min-height:1px;min-width:1px;max-height:200px;max-width:100%;border-radius:3px;margin-bottom:10px;" />
                <h3>
                    <div class="printchatbox" id="title_output"></div>
                </h3>
                <div style="font-family: 'Open Sans', sans-serif;word-break: break-all;" id="output"></div>
                </p>
            </div>


            <style>
                .badge {
                    background: #3498db;
                    margin: 3px;
                    padding: 5px;
                }
            </style>
            <h3 style="text-align:center;font-family: 'Open Sans', sans-serif;color:#5fb5f2;margin-bottom:20px;">Trending Topics to Sweeb about</h3>
            <?php
            $array = explode("|", file_get_contents('trending.txt'));
            foreach ($array as $value) {
                echo '<span class="badge">' . $value . '</span>';
            }
            ?>
            <br><br>
            <hr>
            <div class="col-md-6">
                <a href="check_in.php" class="btn btn-main btn-block">Check In</a>
            </div>
            <div class="col-md-6">
                <a href="check-in.php" class="btn btn-main btn-block">Back To Dash</a>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
    </div>









    <!-- END OF COLLAPSABLE INFORMATION -->
    </div>







    </div>
    </div>
    </div>



    <footer>
        <bR>
        <center>

            <br><Br>
            <p>&copy; Sweeba.com 2023</p>
        </center>
    </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script src="/dist/js/bootstrap.min.js"></script>
    <script src="https://afarkas.github.io/webshim/js-webshim/minified/polyfiller.js"></script>





    <style>
        .example input[type=submit] {
            width: 190px;
            text-align: center;
        }

        .example .ws-invalid label,
        .example .ws-invalid h3 {
            color: #e11;
        }

        .example .ws-invalid input {
            border-color: #e11;
        }

        .example .ws-success input {
            border-color: #1e1;
        }
    </style>

    <script>
        // link input toggle function
        function toggleInput() {
            var linkInput = document.getElementById('linkInput');
            linkInput.classList.toggle('collapse');
        }
    </script>

    <script>
        $(document).ready(function() {
            $("#video").click(function() {
                $("#video_s").show(500);
                $("#image_s").hide(500);
            });
            $("#image").click(function() {
                $("#video_s").hide(500);
                $("#image_s").show(500);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#input").keyup(function() {
                $("#count").text("Characters left: " + (5000 - $(this).val().length));
            });
        });


        //preview text
        $(document).ready(function() {
            $('#title_input').keyup(function() {
                $('#title_output').html($(this).val().replace(/(<([^>]+)>)/ig, ""));
            });
        });
        //for picture SWEEB


        //preview text
        $(document).ready(function() {
            $('#input').keyup(function() {
                $('#output').html($(this).val().replace(/(<([^>]+)>)/ig, "").replace(/\n/g, '<br/>'));
            });
        });



        //preview image
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }




        $("#fileInput").change(function() {
            readURL(this);
        });


        function chooseFile() {
            $("#fileInput").click();
        }

        // javascript

        document.getElementById('fileInput').onchange = uploadOnChange;

        function uploadOnChange() {
            var filename = this.value;
            var lastIndex = filename.lastIndexOf("\\");
            if (lastIndex >= 0) {
                filename = filename.substring(lastIndex + 1);
            }
            document.getElementById('filename').value = filename;
        }


        //END PICTURE SWEEB
    </script>

    <script>
        $("[data-collapse-group='myDivs']").click(function() {
            var $this = $(this);
            $("[data-collapse-group='myDivs']:not([data-target='" + $this.data("target") + "'])").each(function() {
                $($(this).data("target")).removeClass("in").addClass('collapse');
            });
        });




        (function() {
            webshims.setOptions('forms', {
                lazyCustomMessages: true,
                iVal: {
                    handleBubble: 'hide', // defaults: true. true (bubble and focus first invalid element) | false (no focus and no bubble) | 'hide' (no bubble, but focus first invalid element)
                    fx: 'slide', //defaults 'slide' or 'fade'
                    sel: '.ws-validate', // simple selector for the form element, setting this to false, will remove this feature
                    fieldWrapper: ':not(span, label, em, strong, b, i, mark, p)'
                }
            });
            webshims.polyfill('forms');
        })();
    </script>

    <script>
        function showUser(str) {
            if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "main/name_check.php?q=" + str, true);
                xmlhttp.send();
            }
        }
    </script>


</body>

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

</html>