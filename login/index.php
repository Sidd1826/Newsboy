<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="center">
      <h1>Login</h1>
      <form method="post" action="db.php">
        <div class="txt_field">
            <input type="text" name="uname" required>
            <span></span>
            <label>Username</label>
          </div>
        <div class="txt_field">
          <input type="password" name="pass" required>
          <span></span>
          <label>Password</label>
        </div>
        <div class="pass"><a style="text-decoration: none;" href="http://localhost/mini-project/forgotpassword.php">Forgot Password?</a></div>
        <input type="submit" value="Login">
        <div class="signup_link">
          Not a member ? <a href="http://localhost/mini-project/signup/index.php">Sign-up</a>
        </div>
        <div class="signup_link">
          <a href="http://localhost/mini-project/">Go Back To Home Page</a>
        </div>
      </form>
    </div>

  </body>
</html>