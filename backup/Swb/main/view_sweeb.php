<?php

//info on sweeb

$sql = "SELECT *  FROM sweebs WHERE id='$get_sweeb_id' Limit 1";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
header("Location: dash.php");
die();
}
    // output data of each row
while($row = $result->fetch_assoc()) {
$user_id_sweeb = $row['user_id'];
$image_str = $row['image'];
$met_img = $row['image'];
$sq = "SELECT *  FROM members WHERE id = '$user_id_sweeb'";
$resul = $conn->query($sq);
while($ro = $resul->fetch_assoc()) {
$sweeb_avatar = $ro['avatar'];
$sweeb_username = $ro['username'];
$sweeb_sweebs = $ro['sweebs'];
$sweeb_comments = $ro['comments'];
$sweeb_friends = $ro['friends'];
$sweeb_friends = explode(",", $sweeb_friends);
$sweeb_total_friends = count($sweeb_friends);
}
    $datetime = strtotime($row['date']);
    $up_vote = $row['up'];
    $down_vote = $row['down'];
    $content = $row['content'];
    $uncode_c = $row['content'];
    $uncode_c = preg_replace("/<!--.*?-->/", "", $uncode_c);
    $uncode_c = strip_tags($uncode_c);
    
    $content = htmlspecialchars_decode($content, ENT_NOQUOTES);
    $words1 = str_word_count($content);

    $video_str = $row['video'];
    $title = $row['title'];
    
    if($title == NULL){
    if($words1 <= '1'){
    $content = substr($content, 0, 10);
    }
    $slug_go = limit_text($content,5);
    $slug_go = substr($content, 0, 20);
    $slug_go = slugify($slug_go);
    }else{
    $slug_go = slugify($title);
    }
    
    $comments_total = $row['comments'];
    
// no more info on sweeb

include('main/add_comment.php');

if($user_id != NULL){
$sql = "SELECT id, type FROM likes WHERE user_id='$user_id' AND sweeb_id='$get_sweeb_id'";
$result = $conn->query($sql);
if ($result->num_rows >= 1) {
// output data of each row
while($row = $result->fetch_assoc()) {
$vote_id = $row['id'];
$vote_type = $row['type'];
}
}else{
$gave_like = 'no';
}
}else{
$gave_like = 'no';
}

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
?>