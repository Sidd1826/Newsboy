<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Change Password</title>
    <link rel="stylesheet" href="stylep.css">
  </head>
  <body>
    <div class="center">
      <h1>Change Password</h1>
      <form method="post" action="new-password.php" >
      <div class="txt_field">
        <input type="password" name="password" required>
        <span></span>
        <label>Enter your new Password </label>
      </div>
      <div class="txt_field">
        <input type="password" name="cpassword" required>
        <span></span>
        <label>Confirm new Password</label>
      </div>
        <input type="submit" value="Submit" name="change-password">
        <div class="signup_link">
          <a href="http://localhost/mini-project/">Go Back To Home Page</a>
        </div>
      </form>
    </div>

  </body>
</html>