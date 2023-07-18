<?php
session_start();
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
  $id = $_GET['id'];
  $id = test_input($id);
  $link = mysqli_connect("localhost", "root", "","mini");
  $sql = "SELECT Image FROM rss WHERE id=$id";
  $result = mysqli_query($link,$sql);
  $row = mysqli_fetch_assoc($result);
  mysqli_close($link);

  header("Content-type: image/jpeg");
  echo $row['Image'];
?>
