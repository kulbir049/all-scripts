<?php
include('main/config.php');

// Generate a random string for CAPTCHA
$randomString = substr(md5(rand()), 0, 3);

// Save the CAPTCHA string in the session for validation
$_SESSION['captcha_string'] = $randomString;

// Create an image with the CAPTCHA string
$font = 'fonts/captcha-font/BabyPlums-6Y0AD.ttf'; // Specify the path to a TTF font file
$image = imagecreate(120, 50);
$bgColor = imagecolorallocate($image, 255, 255, 255);
$textColor = imagecolorallocate($image, 0, 0, 0);
imagettftext($image, 20, 0, 10, 30, $textColor, $font, $randomString);

// Output the image
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
?>
