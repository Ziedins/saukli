<?php

 error_reporting( ~E_DEPRECATED & ~E_NOTICE );
 
 define('DBHOST', 'localhost:3306');
 define('DBUSER', 'root');
 define('DBPASS', 'snikers');
 define('DBNAME', 'slogans');
 
 $conn = mysql_connect(DBHOST,DBUSER,DBPASS);
 $dbcon = mysql_select_db(DBNAME);
 
 if ( !$conn ) {
  die("Connection failed : " . mysql_error());
 }
 
 if ( !$dbcon ) {
  die("Database Connection failed : " . mysql_error());
 }