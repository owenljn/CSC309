<?php
function watermarkImage ($SourceFile, $WaterMarkText, $DestinationFile) {
   list($width, $height) = getimagesize($SourceFile);
   $image_p = imagecreatetruecolor($width, $height);
   $image = imagecreatefromjpeg($SourceFile);
   imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height);
   $black = imagecolorallocate($image_p, 255, 255, 255);
   $font = 'lib/arial.ttf';
   $font_size = 13;
   $font_angle=0;
   
    $box = @imageTTFBbox($font_size,$font_angle,$font,$WaterMarkText);
    $textwidth = abs($box[4] - $box[0]);
	$textheight = abs($box[5] - $box[1]);

	$xcord = ($width-120)-($textwidth/2)-2;
	$ycord = ($height-20)+($textheight/2);

  
   imagettftext($image_p, $font_size, 0, $xcord, $ycord, $black, $font, $WaterMarkText);
   if ($DestinationFile<>'') {
      imagejpeg ($image_p, $DestinationFile, 100);
   } else {
      header('Content-Type: image/jpeg');
      imagejpeg($image_p, null, 100);
   };
   imagedestroy($image);
   imagedestroy($image_p);
};

?>
<?php
//$SourceFile = 'lib/images.jpg';
//$DestinationFile = 'lib/images.jpg';
//$WaterMarkText = 'jaazib.com';
//watermarkImage ($SourceFile, $WaterMarkText, $DestinationFile);
?>