<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
$digit = (!isset($HTTP_GET_VARS['digit'])) ? "scoreboard" : $HTTP_GET_VARS['digit'];
?>
<html>
<head>
<title>PNG Counter</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<table width="98%" border="0" cellspacing="0" cellpadding="2" align="center">
  <tr> 
    <td align="center" height="70"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="3"><u>PNG 
      Counter 1.0</u></font></b></td>
  </tr>
  <tr> 
    <td align="center" height="100"><img src="counter.php?page=demo&digit=<?php echo $digit; ?>" alt="Counter" border="0"></td>
  </tr>
  <tr> 
    <td align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#003366">&lt;img 
      src=&quot;counter.php?page=demo&amp;digit=<?php echo $digit; ?>&quot;&gt; </font></td>
  </tr>
  <tr> 
    <td valign="top" height="40"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Digits:</font></td>
  </tr>
  <tr> 
    <td valign="top"> <font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
      <?php
chdir("./digits");
$hnd = opendir(".");
while ($file = readdir($hnd)) {
    if(is_dir($file)) {
        if ($file != "." && $file != "..") { 
            $digit_list[] = $file;
        }
    }
}
closedir($hnd);
if ($digit_list) {
    sort($digit_list);
    $SELF = basename($HTTP_SERVER_VARS['PHP_SELF']);
    for($i=0;$i<sizeof($digit_list);$i++) {
        echo "<a href=\"$SELF?digit=$digit_list[$i]\">$digit_list[$i]</a> |\n";
    }
}   
?>
      </font> </td>
  </tr>
  <tr>
    <td align="center" height="60"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><a href="javascript:location.reload()">Reload</a></font></td>
  </tr>
  <tr>
    <td height="60"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">Digits 
      were taken from www.digitmania.com<br>
      PNG converted with Imagemagick -&gt; ftp.imagemagick.org</font></td>
  </tr>
</table>
</body>
</html>
