<?php
include('main/verification.php');
$c = filter_var($_GET["c"]);
?>



<?php 
include('main/header.php');

?>

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

<div class="wrap_small" style="margin-top:100px;">
    <div class="col-md-12" style="padding:10px;background:#fff;">
        <div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;font-family: 'Open Sans', sans-serif;">
            Verify Your Account!
        </div>
        <br>
        <center>
            Be sure to check your spam folder. If it's in your spam folder, mark as NOT spam.
            <img src="images/gmail2.png" width="20" border="0"> <b>Gmail Delivery issue resolved. </b>If you registered an account with gmail before, you can have your email verification re-sent to your Gmail below.
            <br>

        </center>
        <div style="padding:20px;">
            <form method="post" class="example ws-validate">

                <?php
                if (isset($_POST['verify'])) {
                    echo '<div class="alert alert-warning">' . $Err . '</div>';
                }
                ?>
                <div class="form-group">
                    <br>

                    <div class="form-group">
                        <input type="email" class="form-control form_in" name="email" id="exampleInputEmail1" placeholder="Enter email">
                    </div>


                    <div class="form-group">
                        <input type="text" class="form-control form_in" name="code" id="code" value="<?php echo $c; ?>" placeholder="Verification Code">
                    </div>
                    <br>


                    <button type="submit" name="verify" class="btn btn-main">Verify Your account!</button>
            </form>
            <button type="button" name="verify" class="btn btn-main" data-toggle="modal" data-target="#myModal">Resend My Verification Email &raquo;</button>
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


<?php /*
<!-- Modal -->
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <?php include('main/resend_verify.php') ?>
</div>
<!-- End Modal -- > 
    <?php */ ?>
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
    (function () {
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