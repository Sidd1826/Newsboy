<?php 
session_start();
session_destroy();
session_start();
session_regenerate_id();?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="stylep.css">
  </head>
  <body>
    <div class="center">
      <h1>Forgot Password??</h1>
      <form method="post" action="forgot.php" >
        <div class="txt_field">
          <input type="text" name="email" required>
          <span></span>
          <label>Enter your Email</label>
      </div>
      <div class="txt_field">
        <input type="text" name="Username" required>
        <span></span>
        <label>Enter your username</label>
      </div>
        
        <input type="submit" value="Submit">
        <div class="signup_link">
          <a href="http://localhost/mini-project/">Go Back To Home Page</a>
        </div>


        
      </form>
    </div>

  </body>
</html>