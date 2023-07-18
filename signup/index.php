<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sign-Up Form</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="center">
      <h1>Sign-Up</h1>
      <form method="post" action="db.php">
        <div class="txt_field">
            <input type="text" id ="fname" name  = "fname"  required>
            <span></span>
            <label>First Name</label>
        </div>
        <div class="txt_field">
            <input type="text" id ="uname" name  = "uname" required>
            <span></span>
            <label>Username</label>
          </div>
        <div class="txt_field">
          <input type="email" id ="num" name  = "num"  required>
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
          <input type="password" id ="pass" name  = "pass" required>
          <span></span>
          <label>Password</label>
        </div>
        <input type="submit" value="Register">
        <div class="signup_link">
          Are you a member? <a href="http://localhost/mini-project/login/index.php">Login</a>
        </div>
        <div class="signup_link">
          <a href="http://localhost/mini-project/">Go Back To Home Page</a>
        </div>
      </form>
    </div>

  </body>
</html>