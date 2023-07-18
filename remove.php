<?php
session_start();
$rssid = $_GET["rss"];
$username = $_SESSION["Username"];
$db = mysqli_connect('localhost', 'root', '', 'mini') or die('Error connecting to MySQL server.');
$sql = "SELECT id from minproject WHERE Username='$username'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$a = $row['id'];
$sql = "DELETE FROM `userfeed` WHERE rssid=$rssid and userid=$a";
$result = mysqli_query($db, $sql);
header("Location:http://localhost/mini-project/delete.php");
?>
