<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Code Verification</title>
    <link rel="stylesheet" href="stylep.css">
  </head>
  <body>
    <div class="center">
      <h1>Code Verification</h1>
      <form method="post" action="resetme.php" >
      <div class="txt_field">
        <input type="number" name="otp" required>
        <span></span>
        <label>Enter the code </label>
      </div>
        <input type="submit" value="Submit" name="check-reset-otp">
        <div class="signup_link">
          <a href="http://localhost/mini-project/">Go Back To Home Page</a>
        </div>
      </form>
    </div>

  </body>
</html>