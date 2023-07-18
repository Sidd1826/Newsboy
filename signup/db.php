<?php
session_start();
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$fname=test_input($_POST['fname']);
$username=test_input($_POST['uname']);
$num=test_input($_POST['num']);
if (!filter_var($num, FILTER_VALIDATE_EMAIL)) {
    header("Location: http://localhost/mini-project/signup/signup.php");
}
$passw=test_input($_POST['pass']);
$pass = password_hash($passw, PASSWORD_DEFAULT);

$db = mysqli_connect('localhost','root','','mini') or
die('Error connecting to MySQL server.');
$sql = "SELECT Username,Email from minproject WHERE Username='$username' or Email='$pass'";
$result = mysqli_query($db,$sql);
print_r($result);
if (mysqli_num_rows($result) > 0) {
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO failedlogins (id,FirstName, Username, Email ,Pass, TimeOfLogin) VALUES ('','$fname','$username','$num','$passw','$date')";
    mysqli_query($db,$sql);
    header("Location: http://localhost/mini-project/signup/signup.php");
}
else {
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s');
$sql = "INSERT INTO successlogins (id,FirstName, Username, Email ,Pass, TimeOfLogin) VALUES ('','$fname','$username','$num','$pass','$date')";
mysqli_query($db,$sql);
$sql = "INSERT INTO minproject (id,FirstName, Username, Email ,Pass) VALUES ('','$fname','$username','$num','$pass')";
mysqli_query($db,$sql);
session_unset();
session_regenerate_id();
$_SESSION["Login"] = "$fname";
$_SESSION["Username"] = "$username";
#setcookie("Login", $fname , time() + 3600, "/mini-project/");
#setcookie("Username", $username , time() + 3600, "/mini-project/");
header("Location: http://localhost/mini-project/");}
?>