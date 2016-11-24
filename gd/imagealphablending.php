<?php 
$size = 300;
$image=imagecreatetruecolor($size, $size);

// 用白色背景加黑色边框画个方框
$back = imagecolorallocate($image, 255, 255, 255);   ///填充颜色

//imagecolorallocatealpha() 的行为和 imagecolorallocate() 相同，但多了一个额外的透明度参数 alpha，其值从 0 到 127。0 表示完全不透明，127 表示完全透明。

$border = imagecolorallocate($image, 0,0,0);
imagefilledrectangle($image, 0, 0, $size - 1, $size - 1, $back);
//imagefilledrectangle — 画一矩形并填充

imagerectangle($image, 0, 0, $size - 1, $size - 1, $border);
//imagerectangle — 画一个矩形



$yellow_x = 100;
$yellow_y = 75;
$red_x    = 120;
$red_y    = 165;
$blue_x   = 187;
$blue_y   = 125;
$radius   = 150;

// 用 alpha 值分配一些颜色
$yellow = imagecolorallocatealpha($image, 255, 255, 0, 75);
//imagefilledellipse — 画一椭圆并填充


$red    = imagecolorallocatealpha($image, 255, 0, 0, 75);
$blue   = imagecolorallocatealpha($image, 0, 0, 255, 75);

// 画三个交迭的圆
imagefilledellipse($image, $yellow_x, $yellow_y, $radius, $radius, $yellow);
imagefilledellipse($image, $red_x, $red_y, $radius, $radius, $red);
imagefilledellipse($image, $blue_x, $blue_y, $radius, $radius, $blue);

// 不要忘记输出正确的 header！
header('Content-type: image/png');

// 最后输出结果
imagepng($image);
imagedestroy($image);

?>