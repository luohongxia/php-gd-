<?php 
$info = getimagesize("map.png");
$image = imagecreatefrompng("map.png");
$image_new = imagecreatetruecolor($info[0],$info[1]);       
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

?>