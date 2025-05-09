<?php include('main/config.php');
      include('main/functions.php');
      $data_list['days'] = array();

      // Assuming $conn is your MySQL connection and $user_id_sess contains the user ID
      $sql = "SELECT DATE(created_at) AS date, SUM(exposure_earn) AS total_exposure_earn, 'user' AS source
                      FROM exposure
                      WHERE added_by_admin=0 AND user_id = $user_id_sess 
                      AND created_at >= CURDATE() - INTERVAL 7 DAY
                      GROUP BY DATE(created_at)

                      UNION ALL

                      SELECT DATE(created_at) AS date, SUM(exposure_earn) AS total_exposure_earn, 'post_by_user' AS source
                      FROM exposure
                      WHERE added_by_admin=0 AND post_by_user = $user_id_sess
                      AND created_at >= CURDATE() - INTERVAL 7 DAY
                      GROUP BY DATE(created_at)

                      ORDER BY date ASC;"; // Ensure results are ordered by date
      
      $result = $conn->query($sql);
      
      $i = 0;
      while ($exposure_history_row = $result->fetch_assoc()) {
          // Check if the date already exists in the data
          $date = $exposure_history_row['date'];
          
          // If the date is already present, combine the data
          if (!isset($data_list['days'][$date])) {
              $data_list['days'][$date] = [
                  'date' => $date,
                  'sweebs_visited' => 0,
                  'sweeb_views' => 0
              ];
          }
          
          // Combine the exposure earn based on source (user or post_by_user)
          if ($exposure_history_row['source'] === 'user') {
              $data_list['days'][$date]['sweebs_visited'] += $exposure_history_row['total_exposure_earn'];
          } elseif ($exposure_history_row['source'] === 'post_by_user') {
              $data_list['days'][$date]['sweeb_views'] += $exposure_history_row['total_exposure_earn'];
          }
      
          $i++;
      }
      
      // Optionally, if you want to re-index the array (optional step)
      $data_list['days'] = array_values($data_list['days']);


// echo '{
//   "days": [
//     {
//       "date": "2024-11-19",
//       "sweebs_visited": 100,
//       "sweeb_views": 150
//     },
//     {
//       "date": "2024-11-20",
//       "sweebs_visited": 120,
//       "sweeb_views": 170
//     }
//   ]
// }';
// echo "<br/>";

echo json_encode($data_list);
?>