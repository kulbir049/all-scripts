<?php
include_once('main/config.php');
include("geoipcity.inc");
include("geoipregionvars.php");
include('main/cost.php');

//   _____  __          __  ______   ______   ____
//  / ____| \ \        / / |  ____| |  ____| |  _ \      /\
// | (___    \ \  /\  / /  | |__    | |__    | |_) |    /  \
//  \___ \    \ \/  \/ /   |  __|   |  __|   |  _ <    / /\ \
//  ____) |    \  /\  /    | |____  | |____  | |_) |  / ____ \
// |_____/      \/  \/     |______| |______| |____/  /_/    \_\



// define variables and set to empty values
$title = $image = $content = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $title = test_input($_POST["title"]);
    $title = mysqli_real_escape_string($conn, test_input($_POST["title"]));
    // $content_in = isset($_POST["content"]) ? test_input($_POST["content"]) : '';
    $content_in = mysqli_real_escape_string($conn, test_input($_POST["content"]));
    $content_str = strlen($content_in);
    $content = nl2br($content_in);
    $video_url = test_input($_POST["video"]);
    $link = mysqli_real_escape_string($conn, test_input($_POST['link'])) ?? '';

    $check_img = test_input($_POST["fileInput"]);

    //check for login --
    date_default_timezone_set('UTC');


    $date2 = new DateTime();
    $timestamp = $date2->getTimestamp();

    $tags = get_hashtags($content_in,);;
    $user_tag = get_users($content_in);

    if ($video_url == NULL) {
        $extArray = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF');
        // -------------------------------------- image filtering etc
        $img_g = '1';
        if (isset($_FILES['fileInput']) && $_FILES['fileInput']['size'] > 0) {
            $target_dir = "file/";
            $target_file = $target_dir . basename($_FILES["fileInput"]["name"]);
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image

            $check = getimagesize($_FILES["fileInput"]["tmp_name"]);
            if ($check == false) {
                $Err = '<div class="alert alert-warning">That is not an image.</div>';
                $img_g = 0;
            } elseif ($_FILES["fileInput"]["size"] > 3000000) {
                $Err = '<div class="alert alert-warning">Your Image Was To Large.</div>';
                $img_g = 0;
            } elseif (!in_array($imageFileType, $extArray)) {
                $Err = '<div class="alert alert-warning">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>';
                $img_g = 0;
            } elseif (move_uploaded_file($_FILES["fileInput"]["tmp_name"], "file/" . $timestamp . "." . $imageFileType)) {
                $file_name = $timestamp . "." . $imageFileType;
                // ---------------------------- end image filtering
            }
        } else {
            $Err = '<div class="alert alert-warning">Please upload an image in JPG, JPEG, PNG & GIF format.</div>';
            $img_g = 0;
        }
    }
    // end video check
    if ($video_url != NULL) {
        $file_name = NULL;
    } elseif ($file_name ?? '' != NULL) {
        $video_url = NULL;
    }


    $date3 = date('Y-m-d H:i:s');
    $timestamp1 = date('Y-m-d');
    if (isset($img_g) && $img_g == 0) {
        $Err = $Err;
    } elseif ($content == NULL) {
        $Err = '<div class="alert alert-warning">You have to write some content!</div>';
    } elseif ($content_str < '35') {
        $Err = '<div class="alert alert-warning">You need to have atleast 35 characters.</div>';
    } else {
        $Err = 'uploaded';
        $on_off_toggle = 'ON';
        // throw it into the db
        $sql = "INSERT INTO sweebs (id, user_id, username, date, title, image, content, status, up, down, views, tags, comments, video, timestamp, link,on_off_toggle)
VALUES (NULL, '$user_id', '$username', '$date3', '$title', '$file_name', '$content', 'active', '0', '0', '0', '$tags', 0, '$video_url', '$timestamp1', '$link','$on_off_toggle')";
        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;

            // check is first sweeb then give 10 free credit
            $sql = "SELECT * FROM sweebs WHERE user_id='$user_id'";
            $result = $conn->query($sql);
            if ($result->num_rows == 1) {
                $post_by_user = $user_id;
                $sweeba_id = 0;
                $is_free = 1;
                $credit_use = 0;
                $exposure_earn = 10;
                $created_at = date('Y-m-d H:i:s');
                $insert_logs = "INSERT INTO exposure (user_id, post_by_user, sweeba_id, exposure_earn, created_at,is_free,credit_use)
         VALUES ('$user_id', '$post_by_user', '$sweeba_id', '$exposure_earn','$created_at','$is_free','$credit_use')";
                $conn->query($insert_logs);
            }
            // check is first sweeb then give 10 free credit end here



            //throw into tag db
            $tags = array($tags);
            $boom = implode(", ", $tags);
            $boom = ltrim($boom, ',');

            $textToCount = explode(', ', $boom);
            $words = array_count_values($textToCount);
            foreach ($words as $word => $count1) {


                $sql = "SELECT * FROM tags WHERE tag='$word'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $sweeb_id = $row['sweeb_id'];
                        $new_sweeb_id = '' . $sweeb_id . ',' . $last_id . '';

                        $sql = "UPDATE tags SET uses=uses+1, sweeb_id='$new_sweeb_id' WHERE tag='$word'";
                        $conn->query($sql);
                    }
                } else {

                    $sq = "INSERT INTO tags (id, tag, uses, sweeb_id)
VALUES (NULL, '$word', '$count1', '$last_id')";
                    $conn->query($sq);
                }
            }
            // end


            //throw into tag db
            $user_tag = array($user_tag);
            $boom = implode(", ", $user_tag);
            $boom = ltrim($boom, ',');

            $textToCount = explode(', ', $boom);
            $words = array_count_values($textToCount);
            foreach ($words as $word => $count1) {


                $sql = "SELECT * FROM members WHERE username='$word'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $user_id_tag = $row['id'];


                        $sqlz = "INSERT INTO activity (id, user_id, action, created_date)
VALUES (NULL, '$user_id_tag', '<a href=\"https://www.sweeba.com/$username\">$username</a> mentioned you in a sweeb! <a href=\"https://www.sweeba.com/$last_id/view\">View Sweeb</a>', '$date')";
                        if ($conn->query($sqlz) === TRUE) {
                            $sqla = "UPDATE members SET notif=notif+1 WHERE id='$user_id_tag' Limit 1";
                            $conn->query($sqla);
                        } else {
                            echo "Error updating record: " . $conn->error;
                        }
                    }
                }
            }

            // end








            $sql = "UPDATE members SET sweebs=sweebs+1, last_sweeb = '$date', balance =balance+$earning_sweeb WHERE username='$username'";
            mysqli_query($conn, $sql);

            header("Location:/$last_id/new");
            die();

            $Err = '<div class="alert alert-success">Great Job</div>';
        }





        // end throwing process lol
    }
}


// little sanitize funtion
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = str_replace('<', '', $data);
    return $data;
}
//end sanitization

//grab tags
function get_hashtags($content_in, $str = 1)
{
    preg_match_all('/#(\w+)/', $content_in, $matches);
    $keywords = '';  // Initialize the variable
    $i = 0;

    if ($str) {
        foreach ($matches[1] as $match) {
            $count = count($matches[1]);
            $keywords .= "$match";
            $i++;
            if ($count > $i) $keywords .= ", ";
        }
    } else {
        foreach ($matches[1] as $match) {
            $keyword[] = $match;
        }
        $keywords = $keyword;
    }
    return $keywords;
}
// end grab tags



//grab tags
function get_users($content_in, $str = 1)
{
    preg_match_all('/@(\w+)/', $content_in, $matches);
    $keywords = '';  // Initialize the variable
    $i = 0;
    if ($str) {
        foreach ($matches[1] as $match) {
            $count = count($matches[1]);
            $keywords .= "$match";
            $i++;
            if ($count > $i) $keywords .= ", ";
        }
    } else {
        foreach ($matches[1] as $match) {
            $keyword[] = $match;
        }
        $keywords = $keyword;
    }
    return $keywords ?? '';
}
// end grab tags
