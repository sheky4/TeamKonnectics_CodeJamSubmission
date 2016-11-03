<?php
session_start();
header('Content-type: image/jpeg');

$text = $_SESSION['cval'];
$font_size = 30;

$image_width = 200;
$image_height = 40;

$image = imagecreate($image_width, $image_height);

imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0,0,0);


for($i=0; $i<30; $i++)
{
	$x1 = rand(1, 100);
	$y1 = rand(1, 100);
	$x2 = rand(1, 160);
	$y2 = rand(1, 160);
	imageline($image, $x1, $y1, $x2, $y2, $text_color);
}



imagettftext($image, $font_size, 0, 15, 30, $text_color, '../fonts/font.ttf', $text);

imagejpeg($image);
?>