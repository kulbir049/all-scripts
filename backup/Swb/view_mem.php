<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include('main/config.php');

$get_username = strip_tags($_GET["id"]);

include('main/follow.php');

$os = explode(",", $friends);


$sql = "SELECT * FROM members WHERE username='$get_username'";
$result = $conn->query($sql);
if ($result->num_rows >= 1) {



  // output data of each row
  while ($row = $result->fetch_assoc()) {
    $cur_user_id = $row['id'];
    $dateToday = date('Y-m-d');
    $sql_membership = "SELECT * FROM subscription where user_id='" . $cur_user_id . "' AND expire_date > '" . $dateToday . "' AND status='Success'";
    $result_membership = $conn->query($sql_membership);
    $result_membership_count = $result_membership->num_rows;
    $social_links_json = $row['social_links_json'];
    $is_featured_member = $row['is_featured_member'];
    $is_expiary_date = strtotime($row['is_expiary_date']);



    $_SESSION["user_profile"] = $cur_user_id;



    $cur_friends = $row['friends'];
    $cur_followers = $row['followers'];
    $cur_bg_wall = $row['bg'];
    $cur_prof_desc = $row['prof_desc'];
    $cur_friends_arr = explode(",", $cur_friends);
    $cur_friends_num = count($cur_friends_arr); // output 2

    $cur_user_avatar = $row['avatar'];
    $cur_user_relationship = $row['relationship'];
    $sweeb_count = $row['sweebs'];
    $sweeb_count = $row['sweebs'];

    $Joined_date_time = $row['created_date'];
    $date = strtotime($Joined_date_time);
    $user_address = '';
    $user_address .= isset($row['city']) ? $row['city'] . ',' : '';
    $user_address .= isset($row['location']) ? $row['location'] : '';
    $date_Joined = date('d/m/y', $date);
  }
} else {
  header("Location: ../dash.php");
  die();
}
function isMobile()
{
  return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
?>
<!-- Modal -->


<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

<!-- End Modal -- >
<?php include('main/header.php'); ?>

<?php if (isMobile()) { ?>
<?php include('main/mem_mob.php'); ?>
<?php } else { ?>
<?php include('mem_desk.php'); ?>

<?php } ?>



   <Style>


#columns {
	-webkit-column-count: 1;
	-webkit-column-gap: 10px;
	-webkit-column-fill: auto;
	-moz-column-count: 1;
	-moz-column-gap: 10px;

	column-count: 1;
	column-gap: 15px;
	column-fill: auto;

}

.pin {
        width:300px;
        border-radius:0px;
	display: inline-block;
	background: #fff;
	border: 1px solid #e2e2e6;
	margin: 0 2px 15px;
	-webkit-column-break-inside: avoid;
	-moz-column-break-inside: avoid;
	column-break-inside: avoid;
	padding: 10px;
	padding-bottom: 5px;
	opacity: 1;

	-webkit-transition: all .2s ease;
	-moz-transition: all .2s ease;
	-o-transition: all .2s ease;
	transition: all .2s ease;
}

.pin img {
	max-width: 100%;
	border-bottom: 1px solid #ccc;
	padding-bottom: 0px;
	margin-bottom: 5px;
}

.pin p {

	color: #333;
	margin: 0;
}

.sweeb_b {
color:#fff;
margin-bottom:25px;
height:100px;
  position: relative;
  //display:block;
  font-weight: 700;
  font-size: 12px;
  letter-spacing: 2px;

  text-transform: uppercase;
  outline: 0;
  overflow:hidden;
  background: none;
  z-index: 1;
  cursor: pointer;
  transition:         0.08s ease-in;
  -o-transition:      0.08s ease-in;
  -ms-transition:     0.08s ease-in;
  -moz-transition:    0.08s ease-in;
  -webkit-transition: 0.08s ease-in;
}
.sweeb_b a {
color:#fff;
}
.sweeb_g {
background:#a2de5a;
}

.sweeb_bl {
background:#5fb5f2;


}
.sweeb_r {
background:#f26986;

}


.sweeb_g:hover, .sweeb_bl:hover, .sweeb_r:hover {
  color: whitesmoke;
}

.sweeb_g:before, .sweeb_bl:before, .sweeb_r:before {
  content: "";
  position: absolute;
background:#3e4851;
  bottom: 0;
  left: 0;
  right: 0;
  top: 100%;
  z-index: -1;
  -webkit-transition: top 0.09s ease-in;
}

.sweeb_g:hover:before, .sweeb_bl:hover:before, .sweeb_r:hover:before {
  top: 0;
}




.sweeb {
background:#fff;
padding:20px;
}

.overflow {
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}

</style>
<?php
function slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
  // trim
  $text = trim($text, '-');
  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  // lowercase
  $text = strtolower($text);
  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);
  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

function limit_text($text, $limit)
{
  if (str_word_count($text, 0) > $limit) {
    $words = str_word_count($text, 2);
    $pos = array_keys($words);
    $text = substr($text, 0, $pos[$limit]) . '...';
  }
  return $text;
}
function time2str($ts)
{
  if (!ctype_digit($ts))
    $ts = strtotime($ts);

  $diff = time() - $ts;
  if ($diff == 0)
    return 'now';
  elseif ($diff > 0) {
    $day_diff = floor($diff / 86400);
    if ($day_diff == 0) {
      if ($diff < 60) return 'just now';
      if ($diff < 120) return '1 minute ago';
      if ($diff < 3600) return floor($diff / 60) . ' minutes ago';
      if ($diff < 7200) return '1 hour ago';
      if ($diff < 86400) return floor($diff / 3600) . ' hours ago';
    }
    if ($day_diff == 1) return 'Yesterday';
    if ($day_diff < 7) return $day_diff . ' days ago';
    if ($day_diff < 31) return ceil($day_diff / 7) . ' weeks ago';
    if ($day_diff < 60) return 'last month';
    return date('F Y', $ts);
  } else {
    $diff = abs($diff);
    $day_diff = floor($diff / 86400);
    if ($day_diff == 0) {
      if ($diff < 120) return 'in a minute';
      if ($diff < 3600) return 'in ' . floor($diff / 60) . ' minutes';
      if ($diff < 7200) return 'in an hour';
      if ($diff < 86400) return 'in ' . floor($diff / 3600) . ' hours';
    }
    if ($day_diff == 1) return 'Tomorrow';
    if ($day_diff < 4) return date('l', $ts);
    if ($day_diff < 7 + (7 - date('w'))) return 'next week';
    if (ceil($day_diff / 7) < 4) return 'in ' . ceil($day_diff / 7) . ' weeks';
    if (date('n', $ts) == date('n') + 1) return 'next month';
    return date('F Y', $ts);
  }
}
?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

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