<?php
/* ----------------------------------------------*/
/*  PNG Counter 1.0 (PHP)                        */
/*  Copyright (c)2001 Chi Kien Uong              */
/*  URL: http://www.proxy2.de                    */
/* ----------------------------------------------*/

/* Use Database(mysql) or files to store counting */
/* execute this in your database space before using pngcounter
   CREATE TABLE counter (
   page varchar(30) NOT NULL default '',
   count bigint(20) NOT NULL default '0',
   PRIMARY KEY  (page),
   KEY fichero (page)
   ) TYPE=MyISAM;
*/
$CFG['db']       = false;    /* if false ignore 4 following fields */
$CFG['dbhost']   = "10.10.10.10:3306";   /* host:port */
$CFG['dbuser']   = "username";
$CFG['dbpasswd'] = "password";
$CFG['dbname']   = "database";

/* How many digits to show? */
$CFG['pad'] = 6;

/* Check HTTP_REFERER? */
$CFG['referer_check'] = false;
$VALID = array(
               "http://localhost",
               "http://www.fmartinro.f2s.com"
              );

/* Block reloading? */
$CFG['block_ip']     = false;
$CFG['lock_timeout'] = 30; // minutes

?>