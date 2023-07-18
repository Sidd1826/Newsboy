<?php 
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <title>Newsboy</title>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    .card {
      box-shadow: 8px 4px 8px 4px rgba(0.2, 0.2, 0.2, 0.2);
      transition: 0.3s;
      border-radius: 5px;
      background-color: white;
      width: 170px;
    }


    .company {
      text-decoration: none;
      background: #1644a8;
      padding-left: 30px;
      padding-top: 15px;
      font-size: 150%;
      color: white;
      font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
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

    .bg {
      margin-right: 180px;
      margin-left: 180px;

      padding-top: 30px;

      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(10px, 150px));
      gap: 5rem;
    }
  </style>
</head>

<body>

  <div class="company">Newsboy</div>
  <header>

    <nav>
      <a href="index.php">Explore</a>

      <?php
      if (!isset($_SESSION["Login"])) {
      ?>
        <a href="http://localhost/mini-project/login/index.php">Login</a>
        <a href="http://localhost/mini-project/signup/index.php">Sign Up</a>
      <?php
      } else {

      ?>
        <a href="feed.php">Feed</a>
        <a href=""><?php echo $_SESSION["Login"]; ?></a>
        <a href="http://localhost/mini-project/logout.php">Logout</a>
      <?php
      }
      ?>
      <span></span>
    </nav>
  </header>
  <span>
    <div class="bg">
      <h2 style="color:white;">News</h2>
    </div>
    <div class="bg">
      <?php
      $db = mysqli_connect('localhost', 'root', '', 'mini');
      $sql = "SELECT `id`,`Name`,`Category` from mini.rss";
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_all($result);
      $i = 1;
      $b = "News";
      foreach ($row as $item) {
        $a = "http://localhost/mini-project/image.php?id=$i";
        $c = "http://localhost/mini-project/add.php?id=$i";

        /// The cookie RSS is formed on when you add an rss to feed and the checkbox appears to reflect it
        // This 'if' checks if user is logged in and have they just added the rss to feed
        if (isset($_COOKIE["RSS"]) && isset($_SESSION["Username"])) {
          /*$username = $_SESSION["Username"];
          $sql = "SELECT id from minproject WHERE Username='$username'";
          $result = mysqli_query($db, $sql);
          $row = mysqli_fetch_assoc($result);
          $ab = $row['id'];
          $sqlq = "SELECT * from userfeed WHERE rssid='$i' and userid='$ab'";
          $resultq = mysqli_query($db, $sqlq);
          print_r($resultq);
          if (mysqli_num_rows($resultq) ==  0) {*/
            echo '<script type="text/javascript">
          swal("Job Done !", "We have added the source to your rss feed !", "success"); </script>';
          #}

        }
        if ($b != $item[2]) {
          ?>
      </div>
      <div class="bg">
        <h2 style="color:white;"><?php echo $item[2]; ?></h2>
      </div>
      <div class="bg">
    <?php
          }
        /// setup for resultq 
        if(isset($_SESSION["Username"])){
        $username = $_SESSION["Username"];
        $sqlab = "SELECT id from minproject WHERE Username='$username'";
        $resultab = mysqli_query($db, $sqlab);
        $rowab = mysqli_fetch_assoc($resultab);
        $ab = $rowab['id'];
        $sqlq = "SELECT * from userfeed WHERE rssid='$i' and userid='$ab'";
        $resultq = mysqli_query($db, $sqlq);
        /// user has the rss in its feed, resultq gives us capability to check that
        /// if the user has not added the rss 
        /// we dont provide if statement which checks if the rss is present in feed thus , it doesnt print on screen
        
        if (mysqli_num_rows($resultq) == 0) {

      ?>
          <span><a style="text-decoration:none;" href="<?php echo $c; ?>">
              <div class="card">
                <img class="imgsrc" src="<?php echo $a; ?>" width="150" alt="" />
                <h4 class="title"><?= $item[1] ?></h4>
              </div>
            </a></span>
        <?php
        // User is not logged in 
        } }
        else if (!isset($_SESSION["Username"])) {
        ?>
          <span><a style="text-decoration:none;" href="<?php echo $c; ?>">
              <div class="card">
                <img class="imgsrc" src="<?php echo $a; ?>" width="150" alt="" />
                <h4 class="title"><?= $item[1] ?></h4>
              </div>
            </a></span>
        <?php
        }
        #print_r($item[2]);
        #print_r($b);
        $b = $item[2];
        $i = $i + 1;
      }

  ?>


    </div>

    <br><br>
  </span>
</body>

</html>