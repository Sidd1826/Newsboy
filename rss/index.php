<?php
session_start();
?>
<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <style>
    img {
      width: 0px;
      height: 0px;
    }

    body {
      font-size: small;
    }

    .company {
      text-decoration: none;
      background: #1644a8;
      padding-left: 30px;
      padding-top: 15px;
      font-size: 150%;
      color: white;
      font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
        "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
    }

    .imgsrc {
      padding-top: 15px;
      padding-left: 15px;
    }

    .title {
      padding-top: 10px;
      padding-bottom: 10px;
      padding-left: 20px;
      text-decoration: none;
      color: black;
    }

    .genre-title {
      padding-left: 30px;
    }

    .card:hover {
      box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;

    }

    body {
      font-family: Arial, Helvetica, sans-serif;
      background: black;
    }

    header {
      width: 100%;
      height: 60px;
      padding: 0 15px;
      background: #1644a8;
      display: flex;
      align-items: center;
      justify-content: right;
    }

    header nav {
      display: flex;
      align-items: center;
      position: relative;
    }

    header nav a,
    header nav span {
      color: white;
      text-decoration: none;
      font-size: 14px;
      z-index: 1;
      width: 80px;
      padding: 8px 0px;
      text-align: center;
      font-weight: bold;
      transition: left 0.3s ease 0s;
    }

    header nav span {
      position: absolute;
      top: 0;
      left: 0;
      background: #67568c;
      height: 100%;
      z-index: 0;
      border-radius: 8px;
    }

    header nav a:nth-of-type(1):hover~span {
      left: 0px;
    }

    header nav a:nth-of-type(2):hover~span {
      left: 80px;
    }

    header nav a:nth-of-type(3):hover~span {
      left: 160px;
    }

    header nav a:nth-of-type(4):hover~span {
      left: 240px;
    }

    header nav a:nth-of-type(5):hover~span {
      left: 320px;
    }

    .accordion {
      background-color: #eee;
      color: #444;
      cursor: pointer;
      padding: 18px;
      width: 100%;
      text-align: left;
      border: none;
      outline: none;
      font-size: 16px;
      transition: 0.4s;
    }

    .accordion:after {
      font-size: 10px;
      color: #777;
      float: right;
      margin-left: 5px;
    }


    .active,
    .accordion:hover {
      background-color: #ccc;
    }

    .panel {
      padding: 0 18px;
      background-color: rgb(223, 223, 223);

      overflow: hidden;
      max-height: 0;
      transition: max-height 0.2s ease-out;
    }

    .bgo {
      margin-right: 180px;
      margin-left: 180px;
      padding-top: 30px;
    }

    .maintitle {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      text-align: center;
      color: white;
      font-size: 160%;
      font-weight: normal;
      margin-right: 180px;
      margin-left: 180px;
      padding-top: 30px;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    #numpost {
      text-align: center;
    }

    .valueb {
      padding-left: 75%;
      background: #1644a8;
      padding-bottom: 20px;
    }

    .formend {
      padding-bottom: 85px;
      font-size: medium;
      font-weight: 600;
      margin-right: 50px;
      color: white;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin-top: 80px;
    }
  </style>
  <title>Reading rss feeds using PHP</title>
  <link href="style.css" type="text/css" rel="stylesheet">
</head>

<body>

  <div class="company">Newsboy</div>

  <header>
    <nav>
      <a href="#">RSS</a>
      <a href="http://localhost/mini-project/feed.php">Feed</a>
      <a href="http://localhost/mini-project/index.php">Explore</a>
      <?php
      if (isset($_POST['refresh'])) {
        #$number = $_POST['numpost'];
        $refresh = $_POST['refresh'];
        header("refresh: $refresh");
      } else {
        $refresh = 30;
      }
      $url = test_input($_GET['url']);
      $url = test_input($url);
      if (!filter_var($url, FILTER_VALIDATE_URL)) {
        header("Location:http://localhost/mini-project/");
      }
      if (!isset($_SESSION["Login"])) {
      ?>
        <a href="http://localhost/mini-project/login/index.php">Login</a>
        <a href="http://localhost/mini-project/signup/index.php">Sign Up</a>
      <?php
      } else {

      ?>
        <a href=""><?php echo $_SESSION["Login"]; ?></a>
        <a href="http://localhost/mini-project/logout.php">Logout</a>
      <?php
      }
      ?>
      <span></span>

    </nav>
    <form class="formend" style="float: right;" method="post" action="">
      <label for="">&ensp; | &ensp;&ensp; Number of Posts &ensp;</label>
      <!-- <input type="text" name="feedurl" placeholder=""> -->
      <select id="numpost" name="numpost" onchange="submit()">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
      </select>
      <label for="">&ensp; | &ensp;&ensp; Refresh Interval &ensp;</label>
      <select id="numpost" name="refresh" onchange="submit()">
        <option value="2">2</option>
        <option value="5">5</option>
        <option value="8">8</option>
        <option value="10">10</option>
      </select>
    </form>
  </header>


  <div class="content">


    <?php

    if (isset($_POST['numpost'])) {
      $number = $_POST['numpost'];
    } else {
      $number = 5;
    }
    if (isset($_POST['refresh'])) {
      #$number = $_POST['numpost'];
      $refresh = $_POST['refresh'];
      header("refresh: $refresh");
    } else {
      $refresh = 30;
    }

    #$url = "http://timesofindia.indiatimes.com/rssfeeds/1081479906.cms";
    function test_input($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }


    $invalidurl = false;
    if (@simplexml_load_file($url)) {
      $feeds = simplexml_load_file($url);
    } else {
      $invalidurl = true;
      echo "<h4>Invalid RSS feed URL.</h4>";
    }


    $i = 0;
    if (!empty($feeds)) {


      $site = $feeds->channel->title;
      $sitelink = $feeds->channel->link;

      echo "<h3 class=\"maintitle\">" . $site . "</h3>";
      #print_r($feeds);
      foreach ($feeds->channel->item as $item) {

        $title = $item->title;
        $link = $item->link;
        $description = $item->description;
        $postDate = $item->pubDate;
        $pubDate = date('D, d M Y', strtotime($postDate));


        if ($i >= $number) break;
    ?>


        <div class="bgo">
          <div class="accordion">
            <h6 style="font-size:120%;"><a class="feed_title" href="<?php echo $link; ?>"><?php echo $title; ?></a></h6>
            <span><?php echo $pubDate; ?></span>
            <div class="post-content">

              <?php echo implode(' ', array_slice(explode(' ', $description), 0, 20)) . "..."; ?>
              <a href="<?php echo $link; ?>">Read more</a>
            </div>
          </div>
        </div>

    <?php
        $i++;
      }
    } else {
      if (!$invalidurl) {
        echo "<h2>No item found</h2>";
      }
    }
    ?>
  </div>
  <br><br><br>

</body>

</html>