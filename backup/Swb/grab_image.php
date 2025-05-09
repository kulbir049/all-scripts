<?php
$name= filter_var($_GET["img"]);
 $website=$_SERVER['DOCUMENT_ROOT'];
$check = $website.'/file/'.$name;
if (file_exists($check) && !empty($name)) {
    $mimes = array
    (
        'jpg' => 'image/jpg',
        'jpeg' => 'image/jpg',
        'gif' => 'image/gif',
        'png' => 'image/png'
    ); 

    $ext = strtolower(end(explode('.', $name)));

    $file = 'file/'.$name;
    header('content-type: '. $mimes[$ext]);
    header('content-disposition: inline; filename="'.$name.'";');
    readfile($file);
}else{

$name='default_no_image.jpg';
    $file = 'images/'.$name;
$type = 'image/jpeg';
header('Content-Type:'.$type);
header('Content-Length: ' . filesize($file));
readfile($file);
//exit();
}

// little sanitize funtion
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
//end sanitization
?>
