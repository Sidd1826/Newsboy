<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="@sweetalert2/themes/dark/dark.css" />
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <meta charset="utf-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
  <?php echo '<script type="text/javascript">
          swal("Incorrect Credentials !!", "Retry Login with Accurate Credentials.", "warning"); </script>';?>
    
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
<?php

 ?>