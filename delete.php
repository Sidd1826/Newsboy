<?php
session_start();?>
<!DOCTYPE html>
<html>

<head>
  <title>Newsboy</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <style>
    body {
      color: white;
    }

    .btn {
      display: flex;
      align-items: center;
      background: none;
      border: 1px solid #bdbdbd;
      height: 48px;
      padding: 0 24px 0 16px;
      letter-spacing: 0.25px;
      border-radius: 24px;
      cursor: pointer;
    }

    .btn:focus {
      outline: none;
    }

    .btn .mdi {
      margin-right: 8px;
    }

    .btn-delete {
      font-size: 16px;
      color: #27ace6;
    }

    .btn-delete>.mdi-delete-empty {
      display: none;
    }

    .btn-delete:hover {
      background-color: #fff5f5;
      color: #050d80;

    }

    .btn-delete:hover>.mdi-delete-empty {
      display: block;
    }

    .btn-delete:hover>.mdi-delete {
      display: none;
    }

    .btn-delete:focus {
      box-shadow: 0 0 0 4px #fcc;
    }

    .card {
      box-shadow: 8px 4px 8px 4px rgba(0.2, 0.2, 0.2, 0.2);
      transition: 0.3s;
      border-radius: 5px;
      background-color: white;
      width: 170px;
    }

    .card:hover {
      height: 110%;
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
      background-color: black;
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

    .container {
      padding: 2px 16px;
    }

    .mybuttonoverlap {
      display: none;
      background-color: #4caf50;
      border: none;
      color: white;
      padding: 5px;
      text-align: center;
      text-decoration: none;

      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
      border-radius: 8px;
      margin-left: 35px;
    }

    .card:hover .mybuttonoverlap {
      display: block;
    }

    .bgo {
      margin-right: 180px;
      margin-left: 180px;

      padding-top: 30px;
    }

    a {
      text-decoration: none;
      color: inherit;
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
      content: "\02795";
      font-size: 10px;
      color: #777;
      float: right;
      margin-left: 5px;
    }

    .active:after {
      content: "\2796";
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
  </style>
</head>

<body>
  <div class="company">Newsboy</div>
  <header>
    <nav>
      <a href="feed.php">Feed</a>
      <a href="index.php">Explore</a>
      <?php
      if (!isset($_SESSION["Login"])) {
        header("Location: http://localhost/mini-project/index.php");
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
  </header>
  <span>
    <div class="bgo">
      <h2 style="color: white; width:50%; float:left;">Feed</h2>
      <a href="feed.php"><button class="btn btn-delete" style="float:right; margin-bottom:30px;">
                <span class="mdi mdi-delete mdi-24px"></span>
                <span class="mdi mdi-delete-empty mdi-24px"></span>
                <span>Go Back To Feed</span>
              </button></a>
      <br /><br />

      <div>
        <?php
        if (isset($_SESSION["Username"])) {
          $username = $_SESSION["Username"];
          $db = mysqli_connect('localhost', 'root', '', 'mini') or
            die('Error connecting to MySQL server.');
          /// Get user id
          $sql = "SELECT id from minproject WHERE Username='$username'";
          $result = mysqli_query($db, $sql);
          $row = mysqli_fetch_assoc($result);
          $a = $row['id'];
          /// get ids from output of all rss feeds only for the user id
          $db = mysqli_connect('localhost', 'root', '', 'mini');
          $sql = "SELECT `rssid` from mini.userfeed WHERE userid=$a";
          $result = mysqli_query($db, $sql);
          $b = mysqli_num_rows($result);
          $row = mysqli_fetch_all($result);
          // got id of the rss feeds he has subscribed into
          // connect these ids to the userfeed table
          for ($x = 0; $x < $b; $x++) {
            $c = $row[$x][0];
            $sql = "SELECT `Name` from mini.rss WHERE id=$c";
            $result = mysqli_query($db, $sql);
            $r = mysqli_fetch_all($result);
            #print_r($r);
            $d = $r[0][0];
            #print_r($d);

            #$e = file_get_contents("http://localhost/mini-project/genre.php?name=$d");
            #$f = file_get_contents("http://localhost/mini-project/genrename.php?name=$d");
            /////////////////////////////////////////////////////////////////////////////
            $db = mysqli_connect('localhost', 'root', '', 'mini') or
              die('Error connecting to MySQL server.');
            $sql = "SELECT * from links WHERE Name='$d'";
            $resultl = mysqli_query($db, $sql);
            $rowl = mysqli_fetch_assoc($resultl);
            $rsslinks = array();
            $rss = array();
            if (!empty($rowl["Business"])) {
              $rss = array("Business");
              $rsslinks = array($rowl["Business"]);
            }
            if (!empty($rowl["Education"])) {
              if (empty($rss)) {
                $rss = array("Education");
                $rsslinks = array($rowl["Education"]);
              } else {
                array_push($rss, "Education");
                array_push($rsslinks, $rowl["Education"]);
              }
            }
            if (!empty($rowl["Entertainment"])) {
              if (empty($rss)) {
                $rss = array("Entertainment");
                $rsslinks = array($rowl["Entertainment"]);
              } else {
                array_push($rss, "Entertainment");
                array_push($rsslinks, $rowl["Entertainment"]);
              }
            }
            if (!empty($rowl["Life & Style"])) {
              if (empty($rss)) {
                $rss = array("Life & Style");
                $rsslinks = array($rowl["Life & Style"]);
              } else {
                array_push($rss, "Life & Style");
                array_push($rsslinks, $rowl["Life & Style"]);
              }
            }
            if (!empty($rowl["Science"])) {
              if (empty($rss)) {
                $rss = array("Science");
                $rsslinks = array($rowl["Science"]);
              } else {
                array_push($rss, "Science");
                array_push($rsslinks, $rowl["Science"]);
              }
            }
            if (!empty($rowl["Sports"])) {
              if (empty($rss)) {
                $rss = array("Sports");
                $rsslinks = array($rowl["Sports"]);
              } else {
                array_push($rss, "Sports");
                array_push($rsslinks, $rowl["Sports"]);
              }
            }
            if (!empty($rowl["Technology"])) {
              if (empty($rss)) {
                $rss = array("Technology");
                $rsslinks = array($rowl["Technology"]);
              } else {
                array_push($rss, "Technology");
                array_push($rsslinks, $rowl["Technology"]);
              }
            }
            #print_r($rsslinks);
            #print_r($rss);
              $i = "remove.php?rss=$c";
        ?>
              <a href="<?php echo $i; ?>"><button class="accordion" style="background-color:#1b1f24; color:white;"><?php echo $d; ?></button></a>

        <?php
          }
        }

        ?>
      </div>
      <br /><br />
  </span>
  <script type="text/JavaScript" src="script.js"></script>
</body>

</html>