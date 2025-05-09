<?php include('main/config.php');
include('main/functions.php');
//get referrer
$ref_url = $_SERVER['HTTP_REFERER'];
$parse = parse_url($ref_url);
$ref_url_clean = $parse['host'];
$ref_url_clean = '' . $ref_url_clean . '';

$get_ref = strip_tags($_GET["ref"]);
if ($get_ref != NULL) {
  $_SESSION['ref'] = $get_ref;

  $sq_ref = "SELECT *  FROM members WHERE username = '$get_ref'";
  $resul_ref = $conn->query($sq_ref);
  while ($ro_ref = $resul_ref->fetch_assoc()) {
    $sweeb_avatar_ref = $ro_ref['avatar'];
    $sweeb_username_ref = $ro_ref['username'];
  }
}

// store session data
if (!isset($_SESSION['ref_url'])) {
  $_SESSION['ref_url'] = $ref_url;
}


$result = $conn->query("SELECT COUNT(*) FROM `sweebs`");
$row = $result->fetch_row();
$sweeb_count = $row[0];
$result->close();

$result = $conn->query("SELECT COUNT(*) FROM `members`");
$row = $result->fetch_row();
$total_user = $row[0];
$result->close();


//$sql = "SELECT * FROM exposure WHERE post_by_user='$user_id_sess'";
$sql = "SELECT * FROM exposure";
$result = $conn->query($sql);
$Exposure_views_received = $result->num_rows;
//$sql = "SELECT SUM(`exposure_earn`) as total_exposure_earn FROM exposure WHERE user_id='$user_id_sess'";
$sql = "SELECT SUM(`exposure_earn`) as total_exposure_earn FROM exposure ";
$result_view_sql = $conn->query($sql);
$exposure_earn = 0;
$row_get_sweeb = $result_view_sql->fetch_assoc();
if (isset($row_get_sweeb['total_exposure_earn']) && $row_get_sweeb['total_exposure_earn'] > 0) {
  $exposure_earn = $row_get_sweeb['total_exposure_earn'];
}

?>

<?php
include('main/header-index.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">

<head>

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

  <title>Sweeba</title>
  <meta>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="The Social network that Rewards you!">
  <meta name="author" content="Sweeba">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <link rel="apple-touch-icon" href="https://www.sweeba.com/dist/img/app2.png">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="robots" content="index, follow" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name='dmca-site-verification' content='WmI5TDhmelh5NXdBUTAwaktkVjhUdz090' />
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title>Sweeba</title>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="apple-touch-startup-image" href="https://www.sweeba.com/dist/img/app2.png">
  <link rel="icon" href="/favicon.ico">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <link href="<?php echo SITE_URL; ?>/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/magnific-popup.css" rel="stylesheet">
  <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "url": "https://www.sweeba.com",
      "logo": "https://www.sweeba.com/dist/img/sweebalogo.png"
    }
  </script>

  <style type="text/css">
    body {
      background: none;
      font-family: 'Open Sans', sans-serif;
    }

    html {
      background: url(dist/img/home-back5.png) repeat center center fixed;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }

    .wrap {
      max-width: 900px;

      margin-left: auto;
      margin-right: auto;
      opacity: 1;
    }

    #g-recaptcha-response {
      display: block !important;
      position: absolute;
      margin: -78px 0 0 0 !important;
      width: 302px !important;
      height: 70px !important;
      z-index: -999999;
      opacity: 10;
    }

    .wrap_big {
      max-width: 1500px;

      margin-left: auto;
      margin-right: auto;
      opacity: 1;
    }

    .btn-main {
      padding-top: 8px;
      padding-bottom: 8px;
      padding-left: 10px;
      padding-right: 10px;
      color: #fff;
      border: 2px solid #fff;
      border-radius: 5px;
      font-size: 12px;
      text-align: center;
      font-weight: bold;
      font-family: 'Open Sans', sans-serif;

    }

    input::-moz-placeholder {
      color: green;
    }

    .form_top {

      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      border-radius: 3px 3px 0px 0px;
      box-shadow: 0px;
      border: 0px;
      height: 50px; // Increase height as required
      margin-bottom: 30px;
      padding: 0 20px; // Now only left & right padding
    }

    .form_middle {
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      border-radius: 0px;
      box-shadow: 0px;
      border: 0px;
      height: 50px; // Increase height as required
      margin-bottom: 30px;
      padding: 0 20px; // Now only left & right padding
    }

    .form_bottom {
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      border-radius: 0px 0px 3px 3px;
      box-shadow: 0px;
      border: 0px;
      height: 50px; // Increase height as required
      margin-bottom: 30px;
      padding: 0 20px; // Now only left & right padding
    }

    .preview {
      border-radius: 3px;
      padding: 10px;
      -webkit-box-shadow: 0px 0px 8px 0px rgba(226, 226, 226, 0.75);
      -moz-box-shadow: 0px 0px 8px 0px rgba(226, 226, 226, 0.75);
      box-shadow: 0px 0px 8px 0px rgba(226, 226, 226, 0.75);
    }

    div.c12 {
      padding: 0px;
      padding-top: 100px
    }

    div.c11 {
      padding: 80px;
      padding-top: 0px;
      padding-right: 0px;
    }

    form.c10 {
      text-align: right;
    }

    form.c10 div,
    form.c10 div input {
      border-radius: 15px;
    }

    .c9 {
      background: #00adee;
      padding: 15px;
      color: #fff;
      text-align: center;
    }

    h2.c8 {
      color: #fff;
      font-weight: bold;
      font-size: 19px;
      letter-spacing: 1px;
      font-family: 'Open Sans', sans-serif;
    }

    p.c7 {
      color: #fff;
      line-height: 250%;
      color: #a5b4c4;
      font-size: 15px;
      font-family: 'Open Sans', sans-serif;
    }

    h2.c6 {
      color: #fff;
      font-weight: bold;
      font-size: 23px;
      letter-spacing: 1px;
      font-family: 'Montserrat,sans-serif', sans-serif;
    }

    div.c5 {
      padding: 0px;
      padding-top: 50px
    }

    p.c4 {
      text-align: right;
    }

    div.c3 {
      padding: 0px;
    }

    p.c2 {
      text-align: left;
    }

    img.c1 {
      width: 150px;
      height: auto;
      margin-left: 80px;
    }

    .sweeb_b {
      background: rgb(54, 25, 25);
      background: rgba(255, 255, 255, .1);
      border-radius: 3px;
      color: #fff;
      padding-top: 5px;

      overflow: hidden;
      margin-bottom: -25px;
      margin-top: 35px;
    }

    .sweeb_bottom {
      padding: 10px;
      padding-top: 8px;
      width: 100%;
      height: 40px;
      overflow: hidden;
      border-top: 1px solid rgba(255, 255, 255, .1);
      background: rgb(54, 25, 25);
      background: rgba(0, 173, 238, .1);
    }

    .img_border {
      border: 0px solid rgba(255, 255, 255, .2);
      border-radius: 3px;
    }

    .sweeb_bottom:hover {
      background: #00adee;
    }

    .sweeb_a {
      color: #fff;
      text-align: center;
      font-size: 16px;
    }

    .sweeb_a:hover {
      color: #fff;
      text-decoration: none;
    }

    .avatar {
      display: block;
      border-radius: 100%;
      margin-top: 10px;
      margin-left: 0px;
      margin-right: 10px;
      height: 45px;
      width: 45px;
    }

    .textbody {
      color: #ffffff;
      display: block;
      font-family: Montserrat, sans-serif;
      font-size: 21px;
      font-weight: 500;
      line-height: 120%;
      margin: 10px 0 30px;
      max-width: max-content;
    }

    .textbody2 {
      color: #ffffff;
      display: block;
      font-family: Montserrat, sans-serif;
      font-size: 20px;
      font-weight: 500;
      line-height: 120%;
      margin: 10px 0 30px;
      max-width: 200px
    }

    .textbody3 {
      color: #ffffff;
      display: block;
      font-family: Montserrat, sans-serif;
      font-size: 15px;
      font-weight: 200;
      line-height: 140%;

    }

    .logo {
      display: block;
      width: auto;
      max-width: 100%;
      margin-top: 3px;
      margin-left: -10px;

    }

    .nav-marg {
      margin-left: 5%;
      margin-right: 5%;
    }

    .btn-main8 {
      border: 2px solid #5fb5f2;
      width: 100%;
      padding: 15px;
      color: #fff;
      background: #5fb5f2;
      font-size: 14px;
      font-weight: Bold;
      border-radius: 3px;
    }

    .btn-main8:hover {
      border: 4px solid #fff;
      width: 100%;
      padding: 15px;
      color: #5fb5f2;
      font-size: 14px;
      background: #fff;
      font-weight: Bold;
      border-radius: 3px;
      transition: 2.7s;
    }

    h5 {
      text-align: center;
      background-color: #00adee;
    }

    .brighten img {
      -webkit-filter: brightness(50%);
      -webkit-transition: all 1s ease;
      -moz-transition: all 1s ease;
      -o-transition: all 1s ease;
      -ms-transition: all 1s ease;
      transition: all 1s ease;
    }

    .brighten img:hover {
      -webkit-filter: brightness(100%);
    }

    ul {
      list-style-type: none;

    }

    .white {
      background-color: #ffffff;
    }

    .grey {
      background-color: #fafafa;
    }

    .blue {
      background-color: #5fb5f2;
    }

    .cta-footer h2 {
      font-size: 32px;
      color: #fff;
      margin: 0;
    }

    .cta-footer h2 em {
      border-bottom: 3px solid #fff;
    }

    .cta-footer .btn {
      display: block;
      width: 100%;
      margin: 2.25em auto 0;
    }

    .site-footer h3 {
      font-size: 14px;
      font-weight: 700;
      letter-spacing: .2px;
      margin-top: 35;
      margin-left: -2;
      text-transform: uppercase;
    }

    .sub-form p:not(.form-terms) {
      margin-bottom: 24px;
    }

    .sub-form .form-control {
      border-color: #dadddf;
      color: #848e92;
      padding: 10px 16px 10px 40px;
    }

    .sub-form .form-control:focus {
      border-color: #31aff5;
      background-color: #fff;
    }

    #mc-form .input-group>i.fa-envelope {
      position: absolute;
      left: 16px;
      color: #b5bbbd;
      z-index: 10;
      top: 50%;
      -webkit-transform: translateY(-50%);
      transform: translateY(-50%);
    }

    .ie9 #mc-form .input-group>i.fa-envelope {
      top: 35%;
    }

    .sub-form input::-webkit-input-placeholder {
      color: #b5bbbd;
      font-weight: 400;
    }

    .sub-form input:-moz-placeholder {
      color: #b5bbbd;
      font-weight: 400;
    }

    .sub-form input::-moz-placeholder {
      color: #b5bbbd;
      font-weight: 400;
    }

    .sub-form input:-ms-input-placeholder {
      color: #b5bbbd;
      font-weight: 400;
    }

    .sub-form input,
    .sub-form button {
      height: 52px;
    }

    .sub-form button {
      padding: 0px 24px;
    }

    #mc-error i,
    #mc-success i {
      padding-right: .5em;
    }

    #mc-error,
    #mc-success {
      padding: .3em 0;
      color: #fff;
      display: none;
      font-weight: 400;
      margin-bottom: .75em;
      border-radius: 2px;
      text-align: center;
    }

    #mc-error {
      background: #f44336;
    }

    #mc-success {
      background: #2dbf5b;
    }

    .footer-col-spacing [class^="col-"]:not(:nth-last-child(1)) {
      margin-bottom: 2.25em;
    }

    .footer-nav a {
      color: #848e92;
    }

    .footer-nav li:not(:nth-last-child(0)) {
      margin-bottom: 7px;
      text-align: left;

    }

    .footer-col-spacing ul.footer-nav {
      padding-left: 0;
    }

    .footer-nav a:hover,
    .footer-nav a:focus,
    .terms-privacy a:hover,
    .terms-privacy a:focus {
      color: #30a7e9;
    }

    .site-footer .social li a {
      width: 42px;
      height: 42px;
      line-height: 42px;
      font-size: 24px;
    }

    .chat-btn.fixed,
    .sl-page .chat-btn {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: #31aff5 url(../img/chat-icon.svg) center center no-repeat;
      position: fixed;
      bottom: 120px;
      right: 30px;
      box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .2);
      transition: all 0.2s ease-in-out;
      z-index: 2;
    }

    .chat-btn.fixed {
      display: none;
    }

    .chat-btn:hover {
      -webkit-transform: scale(1.1);
      transform: scale(1.1);
    }

    .chat-btn.fixed {
      display: block;
    }

    .copyright-terms {
      padding: 2.25em 0;
    }

    .copyright-terms small,
    .terms-privacy a {
      font-size: 14px;
      color: #9da8ae;
    }

    .copyright-terms small {
      margin-bottom: 12px;
    }

    .copyright-terms small,
    .terms-privacy li {
      display: inline-block;
    }

    .terms-privacy li:not(:nth-last-child(1)) {
      margin-right: 21px;
    }

    .cta-footer .btn {
      display: block;
      color: #fff;
      width: 50%;
      margin: 2.25em auto 0px;
    }

    .btn-secondary {
      background-color: #fff;
      font-size: 18px;
      background: transparent;
      border-width: 2px;
      border-style: solid;
      border-color: #fff;
      border-image: initial;
      padding: 1.25em 2em;
    }

    .btn-secondary:hover {
      background-color: #000;
      transition: 2.7s;
    }

    blink {
      animation: blinker 0.6s linear infinite;
      color: #1c87c9;
    }

    @keyframes blinker {
      50% {
        opacity: 0;
      }
    }

    .blink-one {
      animation: blinker-one 1s linear infinite;
    }

    @keyframes blinker-one {
      0% {
        opacity: 0;
      }
    }

    .blink-two {
      animation: blinker-two 2.7s linear infinite;
    }

    @keyframes blinker-two {
      100% {
        opacity: 0;
      }
    }

    .underline {
      text-decoration: underline;
      color: white;
      size: 23px;
    }


    /* ==========================================================================
   6. Features
   ========================================================================== */

    .how-it-works .col-md-11,
    .video-intro,
    .features,
    .feature-list,
    .faq-list,
    .about-us-into,
    .app-download h2,
    .app-store-btn,
    .site-footer,
    .copyright-terms,
    .features-cta {
      text-align: center;
      background-color: white;
    }

    .section-header {
      margin-bottom: 3em;
      color: #000;
      text-transform: uppercase;
      background-color: white;
    }

    .section-header h2 {
      font-size: 30px;
      color: #000;
      margin-top: 0;
      background-color: white;
    }

    .section-header h3 {
      font-size: 20px;
      color: #5fb5f2;
      margin-bottom: 0;
      background-color: white;
    }

    .features .col-md-4 {
      overflow-y: hidden;
      background-color: white;

    }

    .features div[class="col-sm-4"] img,
    .feature-list img,
    .feature-cta-list img {
      width: 55px;
      height: 55px;
      background-color: white;

    }

    .features h4 {
      font-size: 16px;
      color: #5fb5f2;
      text-transform: uppercase;
      font-weight: 600;
      margin-top: 24px;
      letter-spacing: .5px;
      background-color: white;
    }

    .features .row-margin>.row,
    .features .row-margin>.row>[class^="col-"],
    .about-us-into .row>[class^="col-"] {
      margin-bottom: 1.5em;
      background-color: white;
    }

    .features .row-margin>.row:last-child,
    .features .row-margin>.row>[class^="col-"]:last-child,
    .feature-list [class^="col-"]:last-child,
    .pricing .row>div[class^="col-"]:last-child,
    .clients-list [class^="col-"]:nth-last-child(1),
    .product-statistics [class^="col-"]:last-child,
    .about-us-into .row>[class^="col-"]:last-child {
      margin-bottom: 0;
      background-color: white;
    }

    .features .col-md-7 .section-spacing {
      padding: 3em 0 4.5em;
      background-color: white;
    }


    .new-feature h2 {
      margin: 0 0 24px;
      font-size: 30px;
      background-color: white;
    }

    .new-feature h3 {
      font-size: 15px;
      text-transform: uppercase;
      font-weight: 600;
      letter-spacing: .5px;
      background-color: white;
    }

    .new-feature .col-md-7 p {
      font-size: 18px;
      background-color: white;
    }

    .new-feature-img {
      margin: 3em 0;
      background-color: white;
    }

    .feature-list [class^="col-"] {
      margin-bottom: 1.5em;
      background-color: white;
    }

    .new-feature-img {
      position: relative;
      a: hover img;

        {
        filter: drop-shadow(10px 10px 5px #888);
      }


    }
  </style>

</head>

<body>
  <div class="wrap hidden-xs">
    <div class="col-md-12 c5">
    </div>
  </div>
  </div>

  <nav class="navbar navbar-default navbar-fixed-top visible-xs" style="font-family: 'Open Sans', sans-serif;">
    <div class="nav-marg">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="https://sweeba.com"><img src="dist/img/ok.png" width="122" height="36" padding="5" class="logo visible-xs"></a>
      </div>

      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <ul class="nav navbar-nav navbar-right" style="font-family: 'Open Sans', sans-serif;">
            <li><a href="index.php"><img src="images/home.png" style="margin-top:-4px;"> Home</a></li>
            <li><a href="login.php"><img src="dist/img/login.png" style="margin-top:-4px;"> Sign In</a></li>
            <li><a href="register.php"><img src="dist/img/users81.png" style="margin-top:-4px;"> Register</a></li>
          </ul>
      </div>
    </div>
  </nav>

  <div class="wrap_big hidden-xs">
    <div class="col-md-12 col-xs-12 c12">
      <div class="hidden-xs">
        <div class="col-md-2" style="margin-top:-160px;margin-left:40px;">
          <p>
            <?php

            //$sql = "SELECT *  FROM sweebs WHERE MONTH(`date`) = MONTH(CURDATE()) AND status='active' AND image != '' ORDER by rand(), up DESC, comments DESC, views DESC LIMIT 1";
            $sql = "SELECT *  FROM sweebs WHERE  status='active' AND image != '' ORDER by rand(), up DESC, comments DESC, views DESC LIMIT 1";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

              while ($row = $result->fetch_assoc()) {
                $user_id_sweeb = $row['user_id'];
                $sweeb_id_cur = $row['id'];
                $link = base64_encode($sweeb_id_cur);

                $sq = "SELECT *  FROM members WHERE id = '$user_id_sweeb'";
                $resul = $conn->query($sq);
                while ($ro = $resul->fetch_assoc()) {
                  $sweeb_avatar = $ro['avatar'];
                  $sweeb_username = $ro['username'];
                }


                $title = $row['title'];
                $content = $row['content'];
                $image_str = $row['image'];
                $video_str = $row['video'];
                $datetime = strtotime($row['date']);
                $words1 = str_word_count($content);

                if ($title == NULL) {
                  if ($words1 <= '1') {
                    $content = substr($content, 0, 10);
                  }
                  $slug_go = limit_text($content, 5);
                  $slug_go = substr($content, 0, 20);
                  $slug_go = slugify($slug_go);
                } else {
                  $slug_go = slugify($title);
                }
                $content = substr($content, 0, 50) . '...';



                echo '<div class="sweeb_b">';
                echo '<div class="col-md-12"><img class="pull-left avatar" src="grab_image.php?img=' . $sweeb_avatar . '"><div style="margin-top:20px;font-size:16px;font-weight:bold;"> ' . $sweeb_username . '</div></div>';
                echo '<div class="col-md-12" style="padding:10px;">';

                if ($image_str != NULL) {
                  echo '';
                  echo '<div class="col-md-12 img_border" style="padding:0px;margin-bottom:10px;text-align:center;"><img src="grab_image.php?img=' . $row['image'] . '" style="min-height:1px;min-width:1px;max-height:100px;max-width:100%;border-radius:3px;"></div>';
                } elseif ($video_str != NULL) {

                  echo '<div class="col-md-12 col-xs-12" style="padding:0px;border:1px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;word-wrap: break-word;">
  
    <iframe width="225" height="195" src="https://www.youtube.com/embed/' . $video_str . '?autoplay=0&showinfo=0&controls=0"" frameborder="0" allowfullscreen></iframe>
    
    </div>';
                }
                echo '<h3 style="color:#5aa7de;font-size:18px;font-weight:Bold;">' . $row['title'] . '</h3>';
                echo '<p style="font-family: \'Open Sans\', sans-serif;white-space: pre-line;word-wrap: break-word;" id="output">' . $content . '</p>';
                echo '</div><div style="clear:both;"></div><a href="/' . $row['id'] . '/' . $slug_go . '" class="sweeb_a"><div class="sweeb_bottom">';
                echo 'Check It Out!';
                echo '</div></a></div>';
              }
            }

            //$conn->close();
            ?>
          </p>
          <br><br>
        </div>
      </div>

      <div class="col-md-4 col-xs-12 c3" style="margin-left:80px;margin-top:-130px;">
        <div class="textbody"><b>
            <img src="images/sweeba-com.gif" width="400" height="230" style="margin-top:-10px;" alt="traffic exchange"></a>
            <center>
              <h3>Create your <b>OWN</b> Digital Presence</h3>
  <br>
<span style="color:#fff;"> Members have earned <span style="color:#5fb5f2;"><strong><?php echo $exposure_earn; ?></span> </strong> credits.</span>
            </center>

        </div>
      </div>

      <div class="col-md-4 col-xs-12 c11" style="margin-top:-150px;"><?php if ($logged_in == 'yes') {
                                                                        echo '';
                                                                      } else { ?>

          <?php if ($get_ref != NULL) { ?><div class="alert alert-info"><img class="img" src="grab_image.php?img=<?php echo $sweeb_avatar_ref; ?>" style="min-height:1px;min-width:1px;height:50px;width:50px;border-radius:3px;border-radius:100%;"></a> You are being invited by <?php echo $get_ref; ?>.</div><?php } ?>


          <form method="post" action="register.php" class="c10">
            <div style="background-color: white;">

              <input type="text" name="username" class="form-control form_top" placeholder="Username **NO SPACES**" required> <input type="text" name="name" class="form-control form_middle" placeholder="Full Name" required> <input type="email" name="email" class="form-control form_middle" placeholder="Your Email" required> <input type="password" name="password" class="form-control form_bottom" placeholder="Your Password" required>
              <br>
              <div class="checkbox" style="margin-top: 0;
margin-bottom: 0px;
margin-right: 110px;">
                <label>
                  <input type="checkbox" style="font-family: 'Open Sans', sans-serif;" required> I agree to the <a href="/tos.php">Terms of Service</a>
                </label>
                <br><br>

              </div>
            </div>
            <br>
            <button type="submit" class="btn btn-main8"><strong> Register Free Now </button></strong>
          </form><?php } ?>
      </div>
    </div>
  </div>

  <div class="wrap visible-xs">
    <div class="col-xs-12 c12" style="margin-top:-100px;">
      <div class="col-xs-12 c3" style="padding:20px;">
      </div>
      <div class="col-xs-12 c11" style="padding:10px;">
        <center>
          <img src="images/sweeba-com.gif" width="320" height="210" style="margin-top:-45px;" alt="traffic exchange">

          <h3 style="color:#fff;font-size:18px;">Create your <b>OWN</b> Digital Presence.</h3>
      <br>
<span style="color:#fff;"> Members have earned <span style="color:#5fb5f2;"><strong><?php echo $exposure_earn; ?></span> </strong> credits.</span>
            </center>
        <Br>

        <?php if ($get_ref != NULL) { ?><div class="alert alert-info"><a href="/<?php echo $username; ?>"><img class="img" src="grab_image.php?img=<?php echo $sweeb_avatar_ref; ?>" style="min-height:1px;min-width:1px;height:50px;width:50px;border-radius:3px;border-radius:100%;"></a>
            <FONT color="#000"> Invited by <?php echo $get_ref; ?>.</font>
          </div><?php } ?>

        <form method="post" action="register.php" class="c10"><input type="text" name="username **NO SPACES**" class="form-control form_top" placeholder="Username"> <input type="text" name="name" class="form-control form_middle" placeholder="Your Full Name"> <input type="email" name="email" class="form-control form_middle" placeholder="Your Email"> <input type="password" name="password" class="form-control form_bottom" placeholder="Your Password"><br>

          <div class="checkbox">
            <center>
              <label>
                <input type="checkbox" style="font-family: 'Open Sans', sans-serif;" required>
                <font color="#fff">I agree to the Terms of Service</font>
              </label>
              <br><br>
          </div>

          <button type="submit" class="btn btn-main8"><strong>Start Earning Free</button></strong>
        </form>

      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript">
  </script>
  <script src="/dist/js/bootstrap.min.js" type="text/javascript"></script>


  <div class="container">
  </div>

  <?php  //dd('hello'); 
  ?>

  <!--features-->

  <section class="features text-center section-spacing" id="features">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row-margin">
            <header class="section-header">
              <br><br>
              <h2>Sweeba Cloud Surfing</h2>

            </header>
            <div class="row">
              <!--features 1-->
              <div class="col-sm-4"> <img class="icon2" src="images/feature-1.svg" alt="feature-1">
                <h4>Mobile Friendly</h4>
                <p>Earn credits on your desktop or mobile devices.</p>
              </div>
              <!--features 1 end-->
              <!--features 2-->
              <div class="col-sm-4"> <img class="icon2" src="images/feature-2.svg" alt="feature-2">
                <h4>Stand Out</h4>
                <p>Stand out amongst the crowd, go viral and fast-track your success.</p>
              </div>
              <!--features 2 end-->
              <!--features 3-->
              <div class="col-sm-4"> <img class="icon2" src="images/feature-cta-1.svg" alt="feature-3">
                <h4>Leaderboards</h4>
                <p>See results and get rewarded. </p>
              </div>
              <!--features 3 end-->
            </div>
            <div class="row">

              <!--features 4-->
              <div class="col-sm-4"> <img class="icon2" src="images/feature-4.svg" alt="feature-4">
                <h4>Surf the Cloud</h4>
                <p>Use our FAST Cloud surfing to earn REAL exposure. </p>
              </div>
              <!--features 4 end-->
              <!--features 5-->
              <div class="col-sm-4"> <img class="icon2" src="images/feature-5.svg" alt="feature-5">
                <h4>Affordable Upgrades</h4>
                <p>Upgrade and earn more money and exposure. </p>
              </div>
              <!--features 5 end-->
              <!--features 6-->
              <div class="col-sm-4"> <img class="icon2" src="images/feature-6.svg" alt="feature-6">
                <h4>Win Prizes</h4>
                <p>Win prizes & earn unassigned referrals. </p>
              </div>
              <!--features 6 end-->
            </div>
          </div>
        </div>
      </div>
    </div>
    <Br><Br>
  </section>

  <!--features end-->



  <!--CTA footer-->
  <div class="blue">
    <section class="cta-footer section-spacing text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <br><Br>
            <h2>Try our Premium membership <em>free</em></h2><a href="register.php" class="btn btn-secondary"><strong><span class="blink-two">Join Now</strong></span></a>

          </div>
        </div>
      </div>
      <br><Br>
    </section>
  </div>
  <!--CTA footer end-->


  <!--Site footer-->
  <div class="white">
    <Br><Br>
    <footer class="site-footer section-spacing">
      <div class="container">
        <div class="row footer-col-spacing">

          <div class="col-sm-3 col-md-3 col-xs-6">
            <ul class="footer-nav">
              <h3 align="left">LEARN MORE</h3>
              <li><a href="faq-guest.php">How it Works</a></li>
              <li><a href="purchase-guest.php">Pricing</a></li>
              <li><a href="upgrade-guest.php">Upgrade</a></li>
              <li><a href="188155/sweeba-update-1-1-9">Update v. 1.1.9</a></li>
            </ul>
          </div>
          <div class="col-sm-3 col-md-3 col-xs-6">
            <ul class="footer-nav">
              <h3 align="left">Quick Links</h3>
              <li><a href="sweeb.php">Sweeb</a></li>
              <li><a href="random.php">Earn Credits</a></li>
              <li><a href="leaderboard-guest.php">Leaderboard</a></li>
              <li><a href="refs.php">Affiliates</a></li>
            </ul>
          </div>
          <div class="col-sm-3 col-md-3 col-xs-6">
            <ul class="footer-nav">

              <h3 align="left">CONTACT US</h3>
              <li><a href="https://barrieads.ca" target="_blank"> Barrie, Ontario</a></li>
              <li> <a href="mailto:info@sweeba.com"> Email us</a>
              <li><a href="login.php">Login</a></li>
              <li><a href="register.php">Register</a></li>
            </ul>
          </div>

          <div class="col-sm-3 col-md-3 col-xs-6">
            <center>
              <h3>See What's Inside</h3>
              <iframe width="160" height="110" src="https://www.youtube.com/embed/aL4J_RiWJVI?autoplay=1&mute=1" title="Sweeba.com Tour" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>



              </b>
              <br>
              <small>
                <img src="images/chrome.png" title="For Best Expenrience use Chrome on Laptop" /> Use Chrome <b>/</b> laptop for the best UI experience and array of features.
              </small>
              <br>
            </center>
          </div>

          <!--Use clearfix after every 12 columns-->
          <div class="clearfix visible-sm-block"></div>

        </div>
      </div>
      <a href="" class="chat-btn" data-toggle="modal" data-target="#modal-contact-form"></a>
    </footer>

  </div>
  <!--Site footer end-->

  <!--Copyright terms-->
  <div class="grey">
    <footer class="copyright-terms">
      <center>
        <div class="container">
          <div class="row">
            <div class="col-sm-5 col-md-6">
              <center><small> &copy; <script>document.write(new Date().getFullYear())</script> Sweeba.com </small></center>
            </div>
            <div class="col-sm-7 col-md-6">

              <center>

                <ul class="terms-privacy">
                  <li><a href="tos.php">TOS</a></li>
                  <li><a href="privacy.php">Privacy</a></li>
                  <li><img src="images/sweeba-ssl.png" class="brighten" style="padding-top:0px;padding-bottom:0px; overflow:hidden;" title="SSL Certificate" alt="SSL-Certificate" width="25" /> </li>
                  <li><img src="images/cloudflare.png" class="brighten" style="padding-top:0px;padding-bottom:0px; overflow:hidden;" title="Cloudflare Protection" alt="Cloudflare Protection" width="25" /> </li>
                  <li>   <a href="//www.dmca.com/Protection/Status.aspx?ID=55879e8e-7779-489d-af83-22b80be5d432" title="DMCA.com Protection Status" class="dmca-badge"> <img src ="https://images.dmca.com/Badges/dmca_protected_sml_120l.png?ID=55879e8e-7779-489d-af83-22b80be5d432"  width="90" alt="DMCA.com Protection Status" /></a>  <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script>
                  </li>
                </ul>
              </center>

            </div>
          </div>
        </div>
      </center>
    </footer>
  </div>
  <!--Copyright terms end-->

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