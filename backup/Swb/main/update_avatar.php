<?php
include_once('main/config.php');

if (isset($_POST["update_avatar"])){

$date = new DateTime();
$timestamp = $date->getTimestamp();

// -------------------------------------- image filtering etc
$img_g = '1';
if(isset($_FILES['fileInput']) && $_FILES['fileInput']['size'] < 0){
$Err = 'Please upload an image.';
}else{

$target_dir = "file/";
$target_file = $target_dir . basename($_FILES["fileInput"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

$check = getimagesize($_FILES["fileInput"]["tmp_name"]);
if($check == false) {
$Err = 'That is not an image.';
$img_g = 0;
}elseif ($_FILES["fileInput"]["size"] > 5000000) {
$Err = 'Your Image Was To Large.';
$img_g = 0;
}elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
$Err = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
$img_g = 0;

}elseif (move_uploaded_file($_FILES["fileInput"]["tmp_name"], "file/".$timestamp.".".$imageFileType)) {
$file_name = ''.$timestamp.'.'.$imageFileType.'';

// ---------------------------- end image filtering
}
$sql = "UPDATE members SET avatar='$file_name' WHERE username='$username' Limit 1";
mysqli_query($conn, $sql);


resizeMyImage('file/'.$file_name.'', 'file/'.$file_name.'', 150, 150);



$Err = 'Your Profile Was Updated!';
$conn->close();
header("Location: reset.php");
die();

}

}




if (isset($_POST["update_background"])){

$date = new DateTime();
$timestamp = $date->getTimestamp();

// -------------------------------------- image filtering etc
$img_g = '1';
if(isset($_FILES['filebInput']) && $_FILES['filebInput']['size'] < 0){
$Err = 'Please upload an image.';
}else{

$target_dir = "file/";
$target_file = $target_dir . basename($_FILES["filebInput"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

$check = getimagesize($_FILES["filebInput"]["tmp_name"]);
if($check == false) {
$Err = 'That is not an image.';
$img_g = 0;
}elseif ($_FILES["filebInput"]["size"] > 500000) {
$Err = 'Your Image Was To Large.';
$img_g = 0;
}elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
$Err = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
$img_g = 0;
}elseif (move_uploaded_file($_FILES["filebInput"]["tmp_name"], "file/".$timestamp.".".$imageFileType)) {
$file_name = $timestamp.".".$imageFileType;
// ---------------------------- end image filtering
}
$sql = "UPDATE members SET bg='$file_name' WHERE username='$username' Limit 1";
mysqli_query($conn, $sql);

$Err = 'Your Profile Was Updated!';
$conn->close();
header("Location: reset.php");
die();

}

}

 
function resizeMyImage($file, $destination, $w, $h) {
    //Get the original image dimensions + type
    list($source_width, $source_height, $source_type) = getimagesize($file);
 
    //Figure out if we need to create a new JPG, PNG or GIF
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if ($ext == "jpg" || $ext == "jpeg") {
        $source_gdim=imagecreatefromjpeg($file);
    } elseif ($ext == "png") {
        $source_gdim=imagecreatefrompng($file);
    } elseif ($ext == "gif") {
        $source_gdim=imagecreatefromgif($file);
    } else {
        //Invalid file type? Return.
        return;
    }
 
    //If a width is supplied, but height is false, then we need to resize by width instead of cropping
    if ($w && !$h) {
        $ratio = $w / $source_width;
        $temp_width = $w;
        $temp_height = $source_height * $ratio;
 
        $desired_gdim = imagecreatetruecolor($temp_width, $temp_height);
        imagecopyresampled(
            $desired_gdim,
            $source_gdim,
            0, 0,
            0, 0,
            $temp_width, $temp_height,
            $source_width, $source_height
        );
    } else {
        $source_aspect_ratio = $source_width / $source_height;
        $desired_aspect_ratio = $w / $h;
 
        if ($source_aspect_ratio > $desired_aspect_ratio) {
            /*
             * Triggered when source image is wider
             */
            $temp_height = $h;
            $temp_width = ( int ) ($h * $source_aspect_ratio);
        } else {
            /*
             * Triggered otherwise (i.e. source image is similar or taller)
             */
            $temp_width = $w;
            $temp_height = ( int ) ($w / $source_aspect_ratio);
        }
 
        /*
         * Resize the image into a temporary GD image
         */
 
        $temp_gdim = imagecreatetruecolor($temp_width, $temp_height);
        imagecopyresampled(
            $temp_gdim,
            $source_gdim,
            0, 0,
            0, 0,
            $temp_width, $temp_height,
            $source_width, $source_height
        );
 
        /*
         * Copy cropped region from temporary image into the desired GD image
         */
 
        $x0 = ($temp_width - $w) / 2;
        $y0 = ($temp_height - $h) / 2;
        $desired_gdim = imagecreatetruecolor($w, $h);
        imagecopy(
            $desired_gdim,
            $temp_gdim,
            0, 0,
            $x0, $y0,
            $w, $h
        );
    }
 
    /*
     * Render the image
     * Alternatively, you can save the image in file-system or database
     */
 
    if ($ext == "jpg" || $ext == "jpeg") {
        ImageJpeg($desired_gdim,$destination,100);
    } elseif ($ext == "png") {
        ImagePng($desired_gdim,$destination);
    } elseif ($ext == "gif") {
        ImageGif($desired_gdim,$destination);
    } else {
        return;
    }
 
    ImageDestroy ($desired_gdim);
}
 




