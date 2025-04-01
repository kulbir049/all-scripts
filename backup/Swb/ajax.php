<?php
include_once('main/config.php');
include('main/functions.php');

$offset = is_numeric($_POST['offset']) ? $_POST['offset'] : die();
$postnumbers = is_numeric($_POST['number']) ? $_POST['number'] : die();

$sql_reported = "SELECT sweeb_id FROM sweeb_reports WHERE user_id = $user_id_sess";
$result_reported = $conn->query($sql_reported);
$sweeb_ids_reported = [];
// Fetch the sweeb_ids and store them in the array
while ($row_reported = $result_reported->fetch_assoc()) {
    $sweeb_ids_reported[] = $row_reported['sweeb_id'];
}
$userIdsString = implode(',', $sweeb_ids_reported);


$friends = '' . $friends . ',' . $user_id . '';
$friends = explode(",", $friends);
if(count($sweeb_ids_reported)>0){
    $sql = "SELECT *  FROM sweebs WHERE id NOT IN (".$userIdsString.") AND status!='deleted' AND user_id IN (" . implode(",", array_map("intval", $friends)) . ") ORDER BY id DESC LIMIT " . $postnumbers . " OFFSET " . $offset . "";
}else{
    $sql = "SELECT *  FROM sweebs WHERE status!='deleted' AND user_id IN (" . implode(",", array_map("intval", $friends)) . ") ORDER BY id DESC LIMIT " . $postnumbers . " OFFSET " . $offset . "";
}
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $user_id_sweeb = $row['user_id'];

        $sq = "SELECT *  FROM members WHERE id = '$user_id_sweeb'";
        $resul = $conn->query($sq);
        while ($ro = $resul->fetch_assoc()) {
            $sweeb_avatar = $ro['avatar'];
        }

        $title = $row['title'];
        $content = $row['content'];
        $content = htmlspecialchars_decode($content, ENT_NOQUOTES);
        $image_str = $row['image'];
        $video_str = $row['video'];
        $datetime = strtotime($row['date']);
        $words1 = str_word_count($content);
        $status = $row['status'];
        $check_in = $row['content'];
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
        $content = substr($content, 0, 80) . '...';


        if ($status == 'check_in' && ($username == $row['username'])) {
            echo '<div class="col-md-12 col-xs-12 box" style="padding:0px;margin-left:-1px;">';
            echo '<div class="col-md-2 col-xs-2" style="padding:10px;">';
            echo '<img class="pull-left avatar" src="grab_image.php?img=' . $sweeb_avatar . '">';
            echo '</div>';
            echo '<div style="margin-top:38px;color:#8a9cac;font-size:20px;"><b>' . $username . '</b> checked into <b>' . $check_in . '</b>.</div>';
            echo '</div>';
        } elseif ($status == 'active') {
            echo '<div class="col-md-12 col-xs-12 box" style="padding:0px;margin-left:-1px;">';
            echo '<div class="col-md-2 col-xs-2" style="padding:10px;">';
            echo '<img class="pull-left avatar" src="grab_image.php?img=' . $sweeb_avatar . '">';
            echo '</div>';
            echo '<div class="col-md-10 col-xs-10" style="margin:0px;margin-bottom:5px;padding:20px;padding-right:30px;">';
            echo '<a href="/' . $row['username'] . '" style="font-weight:bold;font-size:16px;color:#3e4851;" class="pull-left">' . $row['username'] . '</a>';
            echo '<p style="font-weight:bold;font-size:14px;color:#3e4851;" class="pull-right">' . time2str($datetime) . '</p><br>';
            echo '<div class="visible-xs" style="padding-top:10px;"></div>';




            if ($image_str != NULL) {
                echo '<div class="visible-xs" style="padding-top:20px;"></div>';
                echo '<div class="col-md-12 col-xs-12" style="padding:0px;border:0px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;"> <img src="grab_image.php?img=' . $row['image'] . '" border="0" frameborder="0" style="min-height:1px;min-width:1px;max-height:250px;max-width:100%;border-radius:3px;"></div>';
            } elseif ($video_str != NULL) {
                echo '<div class="visible-xs" style="padding-top:20px;"></div>';
                echo '<div class="col-md-12 col-xs-12" style="padding:0px;border:0px solid #eee;border-radius:3px;margin-bottom:10px;text-align:center;">';
                if (isMobile()) {

                    echo '<iframe src="https://www.youtube.com/embed/' . $video_str . '?autoplay=0&showinfo=0&controls=0""  border="0" frameborder="0" allowfullscreen></iframe>
</iframe>';
                } else {
                    // Do something for only desktop users

                    echo '<iframe width="380" height="300" src="https://www.youtube.com/embed/' . $video_str . '?autoplay=0&showinfo=0&controls=0"" frameborder="0" allowfullscreen></iframe>
</iframe>';
                }

                echo '</div>';
            }

            echo '<h3 style="color:#5aa7de;font-size:18px;font-weight:Bold;">' . $row['title'] . '</h3>';
            echo '<p style="word-wrap: break-word; break-all;color:#8a9cac;" id="output">' . $content . '</p>';
            echo '<span style="font-weight:bold;color:#8094a5;font-size:14px;padding-right:14px;">' . $row['up'] . ' <img src="images/jOiTl3b.png"></span>';
            echo '<span style="font-weight:bold;color:#8094a5;font-size:14px;padding-right:14px;">' . $row['down'] . ' <img src="images/h45ZLRD.png"></span>';
            echo '<span style="font-weight:bold;color:#8094a5;font-size:14px;">' . $row['comments'] . ' <img src="images/dg7mOfT.png"></span>';
            echo '<br><br><a href="/' . $row['id'] . '/' . $slug_go . '" class="btn btn-main pull-right">Check it out!</a>';
            echo '<a href="report.php?id='.$row['id'].'" class="btn btn-main pull-right">Reporit<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></a>';
            echo '</div></div>';
        }
    }
} else {
    echo '';
}

function isMobile()
{
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
?>

<style>
    .youtubevideo {
        position: relative;
        padding-bottom: 56.25%;
        padding-top: 30px;
        height: 0;
        overflow: hidden;
    }

    .youtubevideo iframe,
    .video-container object,
    .video-container embed {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>

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