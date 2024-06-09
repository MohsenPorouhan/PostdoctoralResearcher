<?php

 function random_string($len=5, $str='')  
 {	for($i=1; $i<=$len; $i++)        
 {       
 	 $ord=rand(48, 90);	 if((($ord >= 48) && ($ord <= 57)) || (($ord >= 65) && ($ord<= 90))) 	$str.=chr($ord);	
 	 
 	  else		
 	  $str.=random_string(1);	                                       	
 }	return $str;
 }
/* fornewbie.com
* create captcha image verification
* generate 5 digit random number 
*/
session_start();
$RandomStr =rand(10000, 99999); 	//Generate 5 digit random number

	
$_SESSION['key'] = $RandomStr;// carry the data through session

$letter1=substr($RandomStr,0,1);
$letter2=substr($RandomStr,1,1);
$letter3=substr($RandomStr,2,1);
$letter4=substr($RandomStr,3,1);
$letter5=substr($RandomStr,4,1);

$image=imagecreatefrompng("images/noise.png");

$angle1 = rand(-20, 20);
$angle2 = rand(-20, 20);
$angle3 = rand(-20, 20);
$angle4 = rand(-20, 20);
$angle5 = rand(-20, 20);

$font1 = "fonts/".rand(1, 5).".ttf";
$font2 = "fonts/".rand(1, 5).".ttf";
$font3 = "fonts/".rand(1, 5).".ttf";
$font4 = "fonts/".rand(1, 5).".ttf";
$font5 = "fonts/".rand(1, 5).".ttf";

$colors[0]=array(122,229,112);
$colors[1]=array(85,178,85);
$colors[2]=array(226,108,97);
$colors[3]=array(141,214,210);
$colors[4]=array(214,141,205);
$colors[5]=array(100,138,204);

$color1=rand(0, 5);
$color2=rand(0, 5);
$color3=rand(0, 5);
$color4=rand(0, 5);
$color5=rand(0, 5);

$textColor1 = imagecolorallocate ($image, $colors[$color1][0],$colors[$color1][1], $colors[$color1][2]);
$textColor2 = imagecolorallocate ($image, $colors[$color2][0],$colors[$color2][1], $colors[$color2][2]);
$textColor3 = imagecolorallocate ($image, $colors[$color3][0],$colors[$color3][1], $colors[$color3][2]);
$textColor4 = imagecolorallocate ($image, $colors[$color4][0],$colors[$color4][1], $colors[$color4][2]);
$textColor4 = imagecolorallocate ($image, $colors[$color5][0],$colors[$color5][1], $colors[$color5][2]);

$size = 20;

imagettftext($image, $size, $angle1, 10, $size+15, $textColor1, $font1, $letter1);
imagettftext($image, $size, $angle2, 35, $size+15, $textColor2, $font2, $letter2);
imagettftext($image, $size, $angle3, 60, $size+15, $textColor3, $font3, $letter3);
imagettftext($image, $size, $angle4, 85, $size+15, $textColor4, $font4, $letter4);
imagettftext($image, $size, $angle5, 110, $size+15, $textColor5, $font5, $letter5);
 
header('Content-type: image/jpeg');

imagejpeg($image);

imagedestroy($image); 
?>