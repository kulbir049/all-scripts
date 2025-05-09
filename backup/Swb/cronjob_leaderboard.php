<?php 

// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include('main/config.php');

include('main/functions.php');

updateExposureErn($conn);
updateExposureErnLeader($conn);

?>