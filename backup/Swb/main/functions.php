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

function updateExposureErn_ForRandom($conn, $user_id_sess)
{

    $sql = "SELECT SUM(`exposure_earn`) as total_exposure_earn FROM exposure WHERE user_id='$user_id_sess'";
    $result_view_sql = $conn->query($sql);
    $exposure_earn = 0;
    $row_get_sweeb = $result_view_sql->fetch_assoc();
    if (isset($row_get_sweeb['total_exposure_earn']) && $row_get_sweeb['total_exposure_earn'] > 0) {
        $exposure_earn = $row_get_sweeb['total_exposure_earn'];
    }
    $sql = "SELECT SUM(`credit_use`) as total_used_exposure FROM exposure WHERE post_by_user='$user_id_sess'";
    $result_view_sql = $conn->query($sql);
    $row_get_sweeb = $result_view_sql->fetch_assoc();
    if (isset($row_get_sweeb['total_used_exposure']) && $row_get_sweeb['total_used_exposure'] > 0) {
        $total_used_exposure = $row_get_sweeb['total_used_exposure'];
    }



    $available_exposure_earn = $exposure_earn - $total_used_exposure;


    // Collect update query
    $updates[] = "UPDATE members 
    SET availbale_exposure_earn = '$available_exposure_earn', 
        exposure_earn = '$exposure_earn', 
        used_exposure = '$total_used_exposure' 
            WHERE id = $user_id_sess";


    // Execute all updates in batch
    if (!empty($updates)) {
        foreach ($updates as $update_sql) {
            $conn->query($update_sql);
        }
    }
}


function updateExposureErn($conn, $user_id = null, $filter_month = null)
{
    // Determine the month filter
    //// null function 
}

function updateExposureErnLeader($conn, $user_id = null, $filter_month = null)
{
    // Determine the month filter
    $created_month = !empty($filter_month) ? $filter_month : date('Y-m', strtotime('first day of last month'));
    $created_at = $created_month . '-01';

    // Build the base query for exposure history based on whether user_id is provided
    $exposure_history = "SELECT user_id, 
                                    SUM(exposure_earn) as total_exposure_earn,
                                    (SELECT SUM(credit_use) 
                                     FROM exposure 
                                     WHERE post_by_user = e.user_id 
                                       AND DATE_FORMAT(created_at, '%Y-%m') = '$created_month') as total_used_exposure
                             FROM exposure e 
                             WHERE 
                              added_by_admin=0 AND
                             DATE_FORMAT(created_at, '%Y-%m') = '$created_month' ";

    if (!empty($user_id)) {
        $exposure_history .= " AND user_id = $user_id ";
    }

    $exposure_history .= " GROUP BY user_id";
    $exposure_history_result = $conn->query($exposure_history);

    // Prepare queries for insert and update in bulk
    $insert_data = [];
    $update_data = [];
  // print_r($exposure_history);
    while ($exposure_history_row = $exposure_history_result->fetch_assoc()) {
        $user_id = $exposure_history_row['user_id'];
        $exposure_earn = $exposure_history_row['total_exposure_earn'];
        $total_used_exposure = $exposure_history_row['total_used_exposure'] ?? 0;
        //if($user_id==15829){
            
        //}

        // Check if record exists in `exposure_leader` for this user and month
        $check_leader_sql = "SELECT id FROM exposure_leader WHERE DATE_FORMAT(created_at, '%Y-%m') = '$created_month' AND user_id = $user_id";
        $result_verify_sql = $conn->query($check_leader_sql);
        $result_verify = $result_verify_sql->fetch_assoc();

        if ($result_verify_sql->num_rows == 0) {
            // Prepare data for insert
            $insert_data[] = "('$user_id', '$exposure_earn', '$total_used_exposure', '$created_at')";
        } else {
            // Prepare data for update
            $update_data[] = "UPDATE exposure_leader SET 
                                  exposure_earn = '$exposure_earn', 
                                  used_exposure = '$total_used_exposure' 
                                  WHERE id = " . $result_verify['id'];
        }
    }

    // Execute batch insert if there are new records to insert
    if (!empty($insert_data)) {
        $insert_query = "INSERT INTO exposure_leader (user_id, exposure_earn, used_exposure, created_at) 
                             VALUES " . implode(", ", $insert_data);
        $conn->query($insert_query);
    }

    // Execute batch update for existing records
    if (!empty($update_data)) {
        foreach ($update_data as $update_sql) {
            $conn->query($update_sql);
        }
    }
}


function checkSurfThreeDays($user_id_sess, $conn)
{
    if (isset($user_id_sess) && $user_id_sess > 0) {
        // Get today's date
        $today = new DateTime();

        // Get the last 3 days
        $lastThreeDays = [];
        for ($i = 2; $i >= 0; $i--) {
            $date = clone $today;
            $date->modify("-$i day");
            $lastThreeDays[] = $date->format('Y-m-d'); // Format date as YYYY-MM-DD
        }
        $today_date = $lastThreeDays[2];
        // Convert the last three days array into a comma-separated string
        $lastThreeDaysString = "'" . implode("', '", $lastThreeDays) . "'";

        // Define user_id

        // SQL query to get exposure records for the last 3 days
        $sql = "SELECT DATE(`created_at`) AS date_only, COUNT(*) AS surf_count
                        FROM `exposure`
                        WHERE `user_id` = '$user_id_sess'
                        AND DATE(`created_at`) IN ($lastThreeDaysString)
                        GROUP BY DATE(`created_at`)
                        ORDER BY `created_at` DESC
                    ";
        $result = $conn->query($sql);

        $sql_verify = "SELECT *
                        FROM `exposure`
                        WHERE `user_id` = '$user_id_sess'
                        AND is_free = 1
                        AND free_desc = 'on_surf_three_days'
                        AND DATE(`created_at`) = '$today_date'
                    ";

        $result_verify = $conn->query($sql_verify);

        // Check if the result has exactly 3 records (one for each day)

        if ($result->num_rows > 0 && $result_verify->num_rows == 0) {




            $exposure_earn = 10;
            $credit_use = 0;
            $is_free = 1;
            $free_desc = 'on_surf_three_days';

            $created_at = date('Y-m-d H:i:s');
            $insert_click_logs = "INSERT INTO exposure (user_id, post_by_user, sweeba_id, exposure_earn, created_at,credit_use,is_free,free_desc)
                 VALUES ('$user_id_sess', 0, 0, '$exposure_earn','$created_at','$credit_use','$is_free','$free_desc')";
            $conn->query($insert_click_logs);
            $_SESSION['on_surf_three_days'] = '<div style="background:#2ecc71;padding:20px;color:#fff;margin-bottom:6px;"><span class="glyphicon glyphicon-cloud" aria-hidden="true"></span> You earned 10 bonus credits for surfing 3 days in a row! </div>';
        }
    }
}

function getFriendsButtonType($conn, $senderId, $receiverId){

    
    $query = "SELECT * FROM friend_requests WHERE sender_id = ".$receiverId." AND receiver_id = ".$senderId;
    //$stmt = $pdo->prepare($query);
    $stmt = $conn->query($query);
    $confirmRequest = $stmt->fetch_assoc();
    if ($confirmRequest) {
        if($confirmRequest['status']=='accepted'){
            return  '<a href="javascript:void(0)" class="btn btn-info pull-right" style="border:0px;" onclick="unFriendRequest(' . $receiverId . ',' . $senderId. ')">Un-Friend</a>';  
        }else{
            return  '<a href="javascript:void(0)" class="btn btn-info pull-right" style="border:0px;" onclick="acceptFriendRequest(' . $receiverId . ',' . $senderId. ')">Confirm Request</a>';  

        }
      }


    $query = "SELECT * FROM friend_requests WHERE sender_id = ".$senderId." AND receiver_id = ".$receiverId;
    //$stmt = $pdo->prepare($query);
    $stmt = $conn->query($query);
    $existingRequest = $stmt->fetch_assoc();

    if ($existingRequest) {
        return  '<a href="javascript:void(0)" class="btn btn-info pull-right" style="border:0px;" onclick="cancelFriendRequest(' . $senderId . ',' . $receiverId. ')">Cancel Request</a>';  
      }else{
        return  '<a href="javascript:void(0)" class="btn btn-info pull-right" style="border:0px;" onclick="sendFriendRequest(' . $senderId . ',' . $receiverId. ')">Add Friend</a>';
    }

}


function sendNotification($conn,$to,$message){
    $date=date('Y-m-d H:i:s');
    $sqlz = "INSERT INTO activity (user_id, action, created_date)
    VALUES ('$to', '$message', '$date')";
    $conn->query($sqlz);
}