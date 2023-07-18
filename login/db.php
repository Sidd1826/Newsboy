
<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
session_start();
$uname=test_input($_POST['uname']);
$pass=test_input($_POST['pass']);
$db = mysqli_connect('localhost','root','','mini') or
die('Error connfecting to MySQL server.');
$sql = "SELECT FirstName,Username,Pass from minproject WHERE Username='$uname'";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);
if (mysqli_num_rows($result) > 0) {
$fname = $row["FirstName"];
$username = $row["Username"];
$password = $row["Pass"];
$verify = password_verify($pass, $password);
#print_r($verify);
if($verify==true){
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s');
$sql = "INSERT INTO successlogins (id,FirstName, Username, Email ,Pass, TimeOfLogin) VALUES ('','$fname','$username','','$password','$date')";
mysqli_query($db,$sql);
session_unset();
session_regenerate_id();
$_SESSION["Login"] = "$fname";
$_SESSION["Username"] = "$username";
#setcookie("Login", $fname , time() + 3600,"/mini-project/");
#setcookie("Username", $username , time() + 3600, "/mini-project/");
header("Location: http://localhost/mini-project/");
}
else {
  date_default_timezone_set('Asia/Kolkata');
  $date = date('Y-m-d H:i:s');
  $sql = "INSERT INTO failedlogins (id,FirstName, Username, Email ,Pass, TimeOfLogin) VALUES ('','','$uname','','$pass','$date')";
  mysqli_query($db,$sql);
  header("Location: http://localhost/mini-project/login/login.php");
}
}
else if (mysqli_num_rows($result) == 0) {
  date_default_timezone_set('Asia/Kolkata');
  $date = date('Y-m-d H:i:s');
  $sql = "INSERT INTO failedlogins (id,FirstName, Username, Email ,Pass, TimeOfLogin) VALUES ('','','$uname','','$pass','$date')";
  mysqli_query($db,$sql);
  header("Location: http://localhost/mini-project/login/login.php");
  }
?>