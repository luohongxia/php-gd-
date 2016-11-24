<?php 
/**
将一张图片画到一个背景透明的定位图标上
先创建一个画布，将背景图画上去
然后将头像画上去
**/

/*
getimagesize : get the size of image

imagecreatefrompng: create a new image from file or url

imagecolortransparent

imagecolorallocatealpha :  allocate color to image with alpha
*/





//背景图片处理
$info = getimagesize("map.png");
$image = imagecreatefrompng("map.png");
$image_new = imagecreatetruecolor(300,300);       
if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
  $trnprt_indx = imagecolortransparent($image);   
  if ($trnprt_indx >= 0 ) {   
     $trnprt_color    = imagecolorsforindex($image, $trnprt_indx);   
     $trnprt_indx    = imagecolorallocate($image_new, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);   
     imagefill($image_new, 0, 0, $trnprt_indx);   
     imagecolortransparent($image_new, $trnprt_indx);
  }
  elseif ($info[2] == IMAGETYPE_PNG) {
     imagealphablending($image_new, false);   
     $color = imagecolorallocatealpha($image_new, 0, 0, 0, 127);   
     imagefill($image_new, 0, 0, $color);   
     imagesavealpha($image_new, true);
   }
}
imagecopy($image_new,$image,0,0,0,0,$info[0],$info[1]);


//头像处理
$dst="yf.jpg";
$info = getimagesize($dst);
if($info[2] == IMAGETYPE_PNG){
  $stamp = imagecreatefrompng($dst);
}else if($info[2] == IMAGETYPE_JPEG){
  $stamp = imagecreatefromjpeg($dst);
}else if($info[2] == IMAGETYPE_GIF) {
  $stamp = imagecreatefromgif($dst);
}
$w0=imagesx($stamp);
$h0=imagesy($stamp);
if($w0 > $h0){
  $w0=$h0;
}else{
  $h0=$w0;
}
$w=80;
$h=80;
$src = imagecreatetruecolor($w, $h);
//将图片缩小到宽80,高80
imagecopyresized($src, $stamp, 0, 0, 0, 0, $w, $h, $w0, $h0);

$marge_right = 61;
$marge_bottom =42;
$sx = $w;
$sy = $h;

imagealphablending($image_new,true);  

//取出一个圆形的面积，将圆形内的像素画到画布上
$transparent = imagecolorallocatealpha($image_new, 0, 0, 0, 127);   //透明背景
$r=$w/2;  
for($x=0;$x<$w;$x++)  
    for($y=0;$y<$h;$y++){  
        $c = imagecolorat($src,$x,$y);  
        $_x = $x - $w/2;  
        $_y = $y - $h/2;  
        if((($_x*$_x) + ($_y*$_y)) < ($r*$r)){  
            imagesetpixel($image_new,$x+$marge_right,$y+$marge_bottom,$c);   //将像素画到画布上
        }  
    }  
imagesavealpha($image_new, true);  //设置标记以在保存PNG图像时保存完整的Alpha通道信息（与单色透明度相对）



//输出图片
header('Content-type: image/png');
imagepng($image_new);
imagedestroy($image_new);
imagedestroy($newpic);





?>