<?php

 error_reporting( ~E_DEPRECATED & ~E_NOTICE );
 
 define('DBHOST', 'localhost:3306');
 define('DBUSER', 'root');
 define('DBPASS', 'snikers');
 define('DBNAME', 'slogans');
 
 $conn = mysql_connect(DBHOST,DBUSER,DBPASS);
 $dbcon = mysql_select_db(DBNAME);
 function dbConnect($close=true){
	global $link;

	if (!$close) {
		mysql_close($link);
		return true;
	}

	$link = mysql_connect(DBHOST, DBUSER, DBPASS) or die('Could not connect to MySQL DB ') . mysql_error();
	if (!mysql_select_db(DBNAME, $link))
		return false;
}
 if ( !$conn ) {
  die("Connection failed : " . mysql_error());
 }
 
 if ( !$dbcon ) {
  die("Database Connection failed : " . mysql_error());
 }