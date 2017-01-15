<?php
ob_start();
session_start();
require_once 'dbconnect.php';
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
$data="SELECT * FROM slogans ";
$results = mysql_query($data);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>Saukļi</title>
</head>
<body>
  <h1>Saukļi.lv</h1>
  <div class="container">
    <div class="slogan-container">
    <?php while ($row = mysql_fetch_array($results)) { ?>
    <form method="post"  autocomplete="off">
    <div class="slogan">
      <div class="review">
        <button type="submit" class="rate-up"></butoon>
        <span class="rating-score"></span>
        <button class="rate-down"></button>
      </div>
      <div class="slogan-text">
        <?php 
        echo $row["slogan"];
?>
      </div>
    </div>
      <?php    
} ?>
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
<?php ob_end_flush(); ?>