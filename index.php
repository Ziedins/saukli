<?php
ob_start();
session_start();
include('dbconnect.php');
dbConnect();
$error = false;
if (isset($_POST['btn-post-slogan'])) {
 $slogan = trim($_POST['slogan']);  
  $slogan = htmlspecialchars($slogan);

  if (empty($slogan)) {
        $error     = true;
        $nameError = "Lūdzu ieraksti saukli";
    }
   if (!$error) {
        
        $query = "INSERT INTO slogans(slogan) VALUES('$slogan')";
        $res   = mysql_query($query);
        
        if ($res) {
            $errTyp = "success";
            $errMSG = "Succesful post";
            unset($slogan);
        }
        
    }
header('Location: index.php');
exit;
}
if (isset($_POST['btn-post-slogan'])) {

}

$data="SELECT * FROM slogans";
$results = mysql_query($data);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/script.js"></script>
<title>Saukļi</title>
</head>
<body>
  <h1>Saukļi.lv</h1>
  <div class="container">
    <div class="slogan-container">
     <form method="post"  autocomplete="off">
    <?php while ($row = mysql_fetch_array($results)) : ?>
    <div class="slogan" data-postid="<?php echo $row["idslogans"] ?>" data-score="<?php echo $row['rating'] ?>">
      <div class="review">
        <div  data-action="up"  class="rate-up rate" title="vote up">UP</div>
        <div class="rating-score"><?php echo $row['rating'] ?></div>
        <div  data-action="down"  class="rate-down rate" title="vote down">DOWN</div>
      </div>
      <div class="slogan-text">
        <?php echo $row["slogan"]; ?>
      </div>
    </div>
      <?php endwhile ?>
    </div>

    <div class="slogan-add">
       <?php if(isset($errTyp)){ ?><div class="alert alert-success" role="alert"> <?php echo $errTyp; ?> </div><?php } ?>
      <?php if(isset($errMSG)){ ?><div class="alert alert-danger" role="alert"> <?php echo $errMSG; ?> </div><?php } ?>
      <?php if(isset($nameError)){ ?><div class="alert alert-danger" role="alert"> <?php echo $nameError; ?> </div><?php } ?>
        <span class="slogan-add-title">Jauns sauklis:</span>
        <input type="text" name="slogan" placeholder="Your slogan, write an author if it's a quote" maxlength="200"><br>
        <button type="submit" onclick="" name="btn-post-slogan" class="post-slogan" ><b>Post</b></button>
      </form>
    </div>
    <div class="facebook-login">
    Facebook login: <br>
    Facebook pass: <br>
    </div>
  </div>
</body>
</html>
<?php dbConnect(false); ?>
<?php ob_end_flush(); ?>