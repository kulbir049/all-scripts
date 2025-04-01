<?php
include_once('config.php');
//   _____  __          __  ______   ______   ____             
//  / ____| \ \        / / |  ____| |  ____| |  _ \      /\    
// | (___    \ \  /\  / /  | |__    | |__    | |_) |    /  \   
//  \___ \    \ \/  \/ /   |  __|   |  __|   |  _ <    / /\ \  
//  ____) |    \  /\  /    | |____  | |____  | |_) |  / ____ \ 
// |_____/      \/  \/     |______| |______| |____/  /_/    \_\
   


?>
<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
//get the q parameter from URL
$q= filter_var($_GET["q"]);

$result = $conn->query("SELECT COUNT(*) FROM `members` WHERE username = '$q'");
$row = $result->fetch_row();
$total_user = $row[0];


if ($total_user >= '1') {
echo '<span style="color:#EE1111;">Oh no! This name is in use. <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </span>';
} else {
echo '<span style="color:#12EE11;">'.$q.' Its Your Lucky Day! This name is available! <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> </span>';
}
$result->close();

?>
</body>
</html>