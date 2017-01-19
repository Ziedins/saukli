<?php
   ob_start();
   session_start();
   include('dbconnect.php');
   include('function.php');
   dbConnect();
   $data="SELECT * FROM slogans";
   $results = mysql_query($data);
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
                     <div  data-action="up"  class="rate-up rate" title="vote up"></div>
                     <div class="rating-score"><?php echo $row['rating'] ?></div>
                     <div  data-action="down"  class="rate-down rate" title="vote down"></div>
                  </div>
                  <div class="slogan-text">
                     <?php echo $row["slogan"]; ?>
                  </div>
                  <?php if( isset($_SESSION['adminOn']) ) {?>
                  <div class="blue-button">X</div>
                  <?php } ?>
               </div>
               <?php endwhile ?>
         </div>
         <?php if( isset($_SESSION['user']) ) {?>
         <div class="slogan-add">
         <?php if(isset($errTyp)){ ?><div class="alert alert-success" role="alert"> <?php echo $errTyp; ?> </div><?php } ?>
         <?php if(isset($errMSG)){ ?><div class="alert alert-danger" role="alert"> <?php echo $errMSG; ?> </div><?php } ?>
         <?php if(isset($nameError)){ ?><div class="alert alert-danger" role="alert"> <?php echo $nameError; ?> </div><?php } ?>
         <span class="slogan-add-title">Jauns sauklis:</span>
         <input type="text" name="slogan" placeholder="Your slogan, write an author if it's a quote" maxlength="200"><br>
         <button type="submit" onclick="" name="btn-post-slogan" class="post-slogan" ><b>Post</b></button>
         <a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a>
         </form>
         </div>
         <?php }?>
         <?php if( !isset($_SESSION['user']) ) {?>
         <div class="facebook-login">
            <div id="sign-up">
               <div class="white-head" id="register-head">
                  <h1 id="signup_header">Sign Up</h1>
                  <div class="blue-line" id="register-line"></div>
               </div>
               <form method="post" id="form-login" action="" autocomplete="off">
                  <div class="form-input" >
                     <span class="input-name">Name</span><span class="star">*</span>
                     <div class="active-image-user" id="register-name-img"></div>
                     <input type="text" name="name" class="form-control" placeholder="" maxlength="50"/>
                  </div>
                  <div class="form-input-below">
                     <span class="input-name">Email</span><span class="star">*</span>
                     <div class="active-image-mail" id="register-email-img"></div>
                     <input type="text" name="email" class="form-control" placeholder="" maxlength="40" " />
                  </div>
                  <div class="form-input-below">
                     <span class="input-name">Password</span><span class="star">*</span>
                     <div class="active-image-lock" id="register-pass-img"></div>
                     <input type="password" name="pass" class="form-control" placeholder="" maxlength="15" />
                  </div>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                  <button type="submit"  class="orange-button" name="btn-signup"><b>SIGN UP</b></button>
                  <button type="button" onclick="mobileLoginActive()" class="orange-button-mobile" ><b>LOGIN</b></button>
               </form>
            </div>
             <div id="login">
                     <div class="white-head" id="login-head">
                        <h1 id="login-header"> Login </h1>
                        <div class="blue-line" id="login-line"></div>
                     </div>
                     <form method="post" id="form-login" action="" autocomplete="off">
                        <div class="col-md-12">
               
                           <div class="form-input" id="login-form">
                              <span class="input-name">Email</span><span class="star">*</span>
                              <div class="active-image-mail" id="login-email-img"></div>
                              <input type="text" name="email" class="form-control" placeholder="" maxlength="40" />
                           </div>
                           <div class="form-input-below">
                              <span class="input-name">Password</span><span class="star">*</span>
                              <div class="active-image-lock" id="login-pass-img"></div>
                              <input type="password" name="pass" class="form-control" placeholder="" maxlength="15" />
                           </div>
                           <button id="orange-login-button" type="submit" class="orange-button" name="btn-login"><b>LOGIN</b></button>
                           <button type="button" onclick="mobileActive()" class="orange-button-mobile" ><b>Register</b></button>
                           <button type="" class="" id="forgot-button" name="">Forgot?</button>
                           
                        </div>
                     </form>
                  </div>
         </div>
          <?php }?>
      </div>
   </body>
</html>
<?php dbConnect(false); ?>
<?php ob_end_flush(); ?>