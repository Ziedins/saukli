<?php 
include('dbconnect.php');
session_start();
dbConnect();
echo " dadad";
if ($_SERVER['HTTP_X_REQUESTED_WITH']) {
  if (isset($_POST['postid']) AND isset($_POST['action'])) {
    $postId = (int) mysql_real_escape_string($_POST['postid']);
    # check if already voted, if found voted then return
    if (isset($_SESSION['vote'][$postId])) return;
    # connect mysql db
    dbConnect();

    # query into db table to know current voting score 
    $query = mysql_query("
      SELECT rating
      from slogans
      WHERE idslogans = '{$postId}' 
      LIMIT 1" );

    # increase or dicrease voting score
    if ($data = mysql_fetch_array($query)) {
      if ($_POST['action'] === 'up'){
        $vote = ++$data['rating'];
      } else {
        $vote = --$data['rating'];
      }
      # update new voting score
      mysql_query("
        UPDATE slogans
        SET rating = '{$vote}'
        WHERE idslogans = '{$postId}' ");

      # set session with post id as true
      $_SESSION['rating'][$postId] = true;
      # close db connection
      dbConnect(false);
    }
  }
}
?>