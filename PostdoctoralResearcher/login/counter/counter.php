<?php
/* ----------------------------------------------*/
/*  PNG Counter 1.0 (PHP)                        */
/*  Copyright (c)2001 Chi Kien Uong              */
/*  URL: http://www.proxy2.de                    */
/* ----------------------------------------------*/

class png_counter {
    
    var $counter;
    var $size;
    var $digit_path;
    var $config;
    
    function png_counter() {
        global $CFG;
        $this->config = $CFG;
    }
    
    function get_digit_size() {
        if (file_exists("$this->digit_path/1.png")) {
            $digit_size = getimagesize("$this->digit_path/1.png");
            if ($digit_size[2] != "3") {
                return false;
            } else {
                $this->size[0] = $digit_size[0];
                $this->size[1] = $digit_size[1];
                return $this->size;
            }
        } else {
            return false;
        }
    }

    function check_referer() {
        global $VALID;
        $is_valid = false;
        $referer = getenv("HTTP_REFERER");
        if (empty($referer)) {
            return false;
        } else {
            for ($i=0;$i<sizeof($VALID);$i++) {
                if (eregi("$VALID[$i]",$referer)) {
                    $is_valid = true;
                    break;
                }
            }
            return $is_valid;
        }
    }

    function is_valid_visit() {
        global $HTTP_COOKIE_VARS;
        if (isset($HTTP_COOKIE_VARS['counter_png'])) {
            return false;
        } else {
            $expire = time()+$this->config['lock_timeout']*60;
            setcookie("counter_png", "1", $expire, "/");
            return true;
        }
    }
    
    /*
     * function read_counter_db($page) added by
     * Félix MARTIN RODRIGUEZ <felix_martin-rdguez@hp.com>
     *
     */

    function read_counter_db($page) {
        $update = false;
	    /* if the db does not exist error and close */
        $link=mysql_connect($this->config['dbhost'],$this->config['dbuser'],$this->config['dbpasswd']);
        if (! $link) {
            header("Location: error.png");
            exit;
        }

        mysql_select_db($this->config['dbname'],$link);
        $sql = "SELECT page,count FROM counter WHERE page = '$page'";
        $result=mysql_query($sql,$link);
        if (! $result) {
            header("Location: error.png");
            mysql_close($link);
            exit;
        }
 
        if ( $row=mysql_fetch_row($result) ) {
            $this->counter = $row[1];   
        } else {
            /* if page entry does not exist create record    page(txt) count(int) */
            $this->counter = 1;
            $sql = "INSERT INTO counter (page,count) VALUES ('$page',$this->counter)";
            $result=mysql_query($sql,$link);
            if (! $result) { 
                header("Location: error.png");
                mysql_close($link);
                exit;
            }
        }
       
        $update = false; 
        /* increment only if needed  */
        if ($this->config['block_ip']) {
            if ($this->is_valid_visit()) {
                $this->counter++;
                $update = true;
            }
        } else {
           $this->counter++;
           $update = true;
        }
        /* update only if we have incremented */
        if ( $update ) {    
            $sql = "UPDATE counter SET count=$this->counter WHERE page = '$page'";
            $result=mysql_query($sql,$link);
            if (! $result){
                header("Location: error.png");
                mysql_close($link);
                exit;
            }
            mysql_close($link);
        }
    }

    function read_counter_file($page) {
        $update = false;
        if (!file_exists("./pages/$page.txt")) {
            $count_dat = fopen("./pages/$page.txt","w+");            
            $this->counter = 1;
            fwrite($count_dat,$this->counter);
            fclose($count_dat);
        } else {
            $fp = fopen("./pages/$page.txt", "r+");
            flock($fp, 2);
            $this->counter = fgets($fp, 4096);
            flock($fp, 3);
            fclose($fp);
            $update = false; 
            if ($this->config['block_ip']) {
                if ($this->is_valid_visit()) {
                    $this->counter++;
                    $update = true;
                }
            } else {
                $this->counter++;
                $update = true;
            }
            if ($update) {    
                $fp = fopen("./pages/$page.txt", "r+");
                flock($fp, 2);
                rewind($fp);
                fwrite($fp, $this->counter);
                flock($fp, 3);
                fclose($fp);
            }
        }
        return $this->counter;
    }

    function create_png($page,$digit) {
        if ($this->config['referer_check']) {
            if (!$this->check_referer()) { 
               header("Location: error.png");
               exit;
           }
        }
        $this->digit_path = "./digits/".$digit;
        if ($this->get_digit_size()) {
            if ($this->config['db']) {    
                $this->read_counter_db($page);
            } else {
                $this->read_counter_file($page);
            }
            $position = 0;
            $this->counter = sprintf("%0"."".$this->config['pad'].""."d",$this->counter);
            $counter_length = strlen($this->counter);
            $total_size = $this->size[0]*$counter_length;            
            $dest_img = ImageCreate($total_size, $this->size[1]);
            for ($i=0;$i<$counter_length;$i++) {                
               $digit = substr("$this->counter",$i,1);
               eval("\$pic".$i."=ImageCreateFromPNG(\"".$this->digit_path."/".$digit.".png\");");
               eval("ImageCopy(\$dest_img,\$pic".$i.",".$position.",0,0,0,".$this->size[0].",".$this->size[1].");");
               $position += $this->size[0];
            }
            ImagePNG($dest_img);
         } else {
            header("Location: error.png");
         }
     }       
}

include ("./config.inc.php");
$page = (!isset($HTTP_GET_VARS['page'])) ? "count" : $HTTP_GET_VARS['page'];
$digit = (!isset($HTTP_GET_VARS['digit'])) ? "scoreboard" : $HTTP_GET_VARS['digit'];

$counter = new png_counter();
$counter->create_png($page,$digit);

?>
