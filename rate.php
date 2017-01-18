<?php 
include('dbconnect.php');
session_start();
dbConnect();
if ($_SERVER['HTTP_X_REQUESTED_WITH']) {
  if (isset($_POST['postid']) AND isset($_POST['action'])) {
    $postId = (int) mysql_real_escape_string($_POST['postid']);
    if (isset($_SESSION['vote'][$postId])) return;
    dbConnect();

    $query = mysql_query("
      SELECT rating
      from slogans
      WHERE idslogans = '{$postId}' 
      LIMIT 1" );

    if ($data = mysql_fetch_array($query)) {
      if ($_POST['action'] === 'up'){
        $vote = ++$data['rating'];
      } else {
        $vote = --$data['rating'];
      }
      mysql_query("
        UPDATE slogans
        SET rating = '{$vote}'
        WHERE idslogans = '{$postId}' ");
      $_SESSION['rating'][$postId] = true;
      dbConnect(false);
    }
  }
}
?>