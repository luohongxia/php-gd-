<?php 
$im = imagecreatefrompng('u6.png');
$size = min(imagesx($im), imagesy($im));
$im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => $size, 'height' => $size]);
if ($im2 !== FALSE) {
	header('Content-type: image/png');
    imagepng($im2);
}

?>