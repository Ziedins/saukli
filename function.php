<?php 
 ob_start();
   session_start();
   $error = false;
   if (isset($_POST['btn-signup'])) {
       
   
       $name = trim($_POST['name']);
       $name = strip_tags($name);
       $name = htmlspecialchars($name);
       
       $email = trim($_POST['email']);
       $email = strip_tags($email);
       $email = htmlspecialchars($email);
       
       $pass = trim($_POST['pass']);
       $pass = strip_tags($pass);
       $pass = htmlspecialchars($pass);
       
   
       if (empty($name)) {
           $error     = true;
           $nameError = "Please enter your full name.";
           echo $nameError;
       }
       
   
       if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           $error      = true;
           $emailError = "Please enter valid email address.";
           echo $emailError;
       } else {
     
           $query  = "SELECT userEmail FROM users WHERE userEmail='$email'";
           $result = mysql_query($query);
           $count  = mysql_num_rows($result);
           if ($count != 0) {
               $error      = true;
               $emailError = "Provided Email is already in use.";
               echo $emailError;
           }
       }
   
       if (empty($pass)) {
           $error     = true;
           $passError = "Please enter password.";
           echo $passError;
       } else if (strlen($pass) < 6) {
           $error     = true;
           $passError = "Password must have atleast 6 characters.";
           echo $passError;
       }
       
   
       $password = hash('sha256', $pass);
       
   
       if (!$error) {
           
           $query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
           $res   = mysql_query($query);
           
           if ($res) {
               $errTyp = "success";
               $errMSG = "Successfully registered, you may login now";
               unset($name);
               unset($email);
               unset($pass);
           }
           
       }
       
       
   }
   
   
   if (isset($_POST['btn-login'])) {
       
   
       $email = trim($_POST['email']);
       $email = strip_tags($email);
       $email = htmlspecialchars($email);
       
       $pass = trim($_POST['pass']);
       $pass = strip_tags($pass);
       $pass = htmlspecialchars($pass);

   
       if($email != 'admin'){
       if (empty($email)) {
           $error      = true;
           $emailError = "Please enter your email address.";
           echo $emailError;
       } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           $error      = true;
           $emailError = "Please enter valid email address.";
           echo  $emailError;
       }
       }
       if (empty($pass)) {
           $error     = true;
           $passError = "Please enter your password.";
           echo $passError;
       }
       
   
       if (!$error) {
           
           $password = hash('sha256', $pass); 
           
           $res   = mysql_query("SELECT userId, userName, userPass, userRole FROM users WHERE userEmail='$email'");
           $row   = mysql_fetch_array($res);
           $count = mysql_num_rows($res); 
           $admin = 'admin';
           if ($count == 1 && $row['userPass'] == $password && $row['userRole'] == $admin) {
               $_SESSION['user'] = $row['userId'];
               $_SESSION['adminOn'] = 1;
               echo ("Welcome, Admin");
           }
           elseif ($count == 1 && $row['userPass'] == $password) {
            $_SESSION['user'] = $row['userId'];
           }
            else {
                $errMSG = "Incorrect Credentials, Try again...";
                echo $errMSG;
           }
           
       }
       
   }
   if (isset($_POST['btn-post-slogan'])) {
    $slogan = trim($_POST['slogan']);  
     $slogan = htmlspecialchars($slogan);
   
     if (empty($slogan)) {
           $error     = true;
           $nameError = "Lūdzu ieraksti saukli";
           echo $nameError;
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
?>