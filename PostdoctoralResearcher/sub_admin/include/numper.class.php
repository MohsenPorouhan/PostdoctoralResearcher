<?PHP

###################################################
## NumPer is an acronym for Number to Persian.
## Use this function under GNU/GPL terms.
## Copyright by Arash Moslehi (moslehi@gmail.com)
## Published by IWD (www.iwd.ir) , January 2006
##
## Example :
## $number = 999999999999;
## $numper = new NumPer;
## $numper->Number = $number;
## $numper->num2per($numper->Number);
###################################################

$digits = array(
0 => "صفر",
1 => "يک",
2 => "دو",
3 => "سه",
4 => "چهار",
5 => "پنج",
6 => "شش",
7 => "هفت",
8 => "هشت",
9 => "نه"
);

$deca = array(
10 => "ده",
11 => "يازده",
12 => "دوازده",
13 => "سيزده",
14 => "چهارده",
15 => "پانزده",
16 => "شانزده",
17 => "هفده",
18 => "هيجده",
19 => "نوزده",
20 => "بيست",
30 => "سي",
40 => "چهل",
50 => "پنجاه",
60 => "شصت",
70 => "هفتاد",
80 => "هشتاد",
90 => "نود"
);

$bigname = array(
1000000000 => "ميليارد",
1000000 => "ميليون",
1000 => "هزار"
);

######################################## Begining of class

class NumPer {
var $Number;
function num2per($number){
$input = $number;
global $bigname;
global $digits;
$big = array_keys($bigname);



######################################## Validation
 
//uncomment this if you want to validate by class.
//the input is an integer if you uncomment this lines.
/*
if (gettype($input) != "integer"){
settype($number,"Integer");
}
if ($number === 0 && $input !== 0){
echo "ورودي تابع بايستي عددي معتبر باشد.";
exit;
}
 */
####################################### Bigger than 999

foreach($big as $i){
$num = (int)($number / $i);
if ($num > 0){
$persian[] = $this -> threedigit($num);
$number = $number-($num*$i);
if ($number == 0){
echo " ".$bigname["$i"]; 
return;
 }
echo " ".$bigname["$i"]." و ";
}
}
return $this -> threedigit($number);
}

####################################### Smaller than 999

function threedigit($number){

####################################### Hecto

global $digits;
global $deca;

$hecto = (int)($number / 100);
if ($hecto > 0 ){
switch ($hecto){
case 2 : $persian[] = "دويست";
break;
case 3 : $persian[] = "سيصد";
break;
case 5 : $persian[] = "پانصد";
break;
default;
$persian[] = $digits["$hecto"] ."صد";
}
$number = $number-($hecto*100);
}

####################################### Deca

if ($number > 19){
$decan = (int)($number / 10);
if ($decan > 0 ){
$persian[] = $deca[$decan*10];
$number = $number-($decan*10);
}
}
elseif ($number <= 19 && $number > 9){
$persian[] = $deca["$number"];
$number = 0;
}

###################################### Single digit

$single = (int)$number;
if ($single > 0 ){
$persian[] = $digits["$single"];
}
echo implode(" و ",$persian);
}

###################################### End of class

}
?>