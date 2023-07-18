
<?php
session_start();
if(!isset($_SESSION['Login']) || !isset($_SESSION['Username'])) {
  header("Location:http://localhost/mini-project/");
}
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$id = $_GET['id'];
$id = test_input($id);
if (filter_var($id, FILTER_VALIDATE_INT) !== false) {
  $username = $_SESSION["Username"];
  $db = mysqli_connect('localhost', 'root', '', 'mini') or
    die('Error connecting to MySQL server.');
  $sql = "SELECT id from minproject WHERE Username='$username'";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_assoc($result);
  $a = $row['id'];
  $sql = "SELECT id from rss WHERE id='$id'";
  $result = mysqli_query($db, $sql);
  if ($a != 0 && mysqli_num_rows($result) > 0) {
    $sql = "INSERT INTO userfeed (userid,rssid) VALUES ('$a','$id')";
    mysqli_query($db, $sql);
    $a = rand(1, 100000);
    #$_SESSION["RSS"] = $a;
    setcookie("RSS", $a, time() + 1, "/mini-project/");
    header("Location:http://localhost/mini-project/");
  } else if (mysqli_num_rows($result) == 0) {
    header("Location:http://localhost/mini-project/");
  }
} else {
  header("Location:http://localhost/mini-project/");
}
?>
