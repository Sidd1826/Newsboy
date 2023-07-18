<?php 
#setcookie("Username",  , time() - 10, "/mini-project/"); 
session_start();

date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s');
$username = $_SESSION['Username'];
$fname = $_SESSION['Login'];
$db = mysqli_connect('localhost','root','','mini') or
die('Error connecting to MySQL server.');
$sql = "INSERT INTO logouts (id,FirstName, Username, Email ,Pass, TimeOfLogin) VALUES ('','$fname','$username','','','$date')";
mysqli_query($db,$sql);
session_unset();
session_destroy();
session_start();
session_regenerate_id();
#$p = $_SESSION['Username']; 
#setcookie('Username', "$p", time() - 3600, "/mini-project/"); 
#$h = $_SESSION['Login']; 
#setcookie('Login', "$h", time() - 3600, "/mini-project/"); 
$d = $_COOKIE['RSS']; 
setcookie('RSS', "$d", time() - 3600, "/mini-project/"); 
header("Location:http://localhost/mini-project/");
?>