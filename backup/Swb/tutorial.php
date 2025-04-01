<?php include('main/config.php');
// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();
include('main/header.php');
include('main/cost.php');

if ($tutorial == 'no') {
    $sql = "UPDATE members SET tutorial='yes' WHERE username='$username' Limit 1";
    mysqli_query($conn, $sql);
}

// little sanitize funtion
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
//end sanitization
?>
<style>
    .continue {
        border: 2px solid #3498db;
        text-align: center;
        color: #3498db;
        background: none;
        margin-top: 10px;
    }
</style>

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

<div class="wrap_small" style="margin-top:100px;padding:20px;">
    <div class="col-md-12" style="padding:0px;background:#fff;">
        <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;font-family: 'Open Sans', sans-serif;">
            Optional Information
        </div>

        <div style="padding:20px;">
            <h2 style="font-family: 'Open Sans', sans-serif;font-size:20px;text-align:center;">Welcome <?php echo $username; ?></h2>
            <p style="font-size:12px;">To help us personalize your sweeba account you can fill out the information below. It is completely optional. <br>
                <br>
            <form method="post" action="reset.php">
                <input type="hidden" name="tutorial" value="yes">
                <label>What city are you located in? (Optional)</label>
                <input type="text" class="form-control form_in" name="city">
                <br>
                <label>How old are you? (Optional)</label>
                <input type="number" class="form-control form_in" name="age" min="13" max="100">
                <br>
                <label>Gender? (Optional)</label>
                <select name="gender" class="form-control form_in">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <br>

                <label>What is your relationship status? (Optional)</label>
                <select name="relationship" class="form-control form_in">
                    <option value="single">Single</option>
                    <option value="relationship">In a Relationship</option>
                    <option value="complicated">Its Complicated</option>
                    <option value="none">Ill keep this information to myself.</option>
                </select>
                <br>
                <label>Occupation. (Optional)</label>
                <input type="text" class="form-control form_in" name="occupation">
                <br>
                <button type="submit" class="btn btn-block btn-main" name="update_prof">Continue To Sweeba &raquo;</button>
                <hr />
                <p style="font-size:12px;">
                    Your information is safe with us and we will never sell any information you provide on sweeba. Information you post on sweeba will be used to help find friends and enhance your experience on sweeba. All information is optional and will not prevent you from using sweeba.</p>
            </form>
        </div>
    </div>


</div>
</div>
</div>


<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="/dist/js/bootstrap.min.js"></script>
<script src="https://afarkas.github.io/webshim/js-webshim/minified/polyfiller.js"></script>





<script>
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