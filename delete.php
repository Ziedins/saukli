<?php 
include('dbconnect.php');
session_start();
dbConnect();
//Define the query
$id=$_GET['id'];
$query = "DELETE FROM contacts WHERE idslogans='$id' LIMIT 1";

//sends the query to delete the entry
mysql_query ($query);
?>