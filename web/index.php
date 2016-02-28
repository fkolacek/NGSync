<?php

  $startTime = microtime(true); 

  require "inc/config.php";
  require "inc/Loader.class.php";

  Loader::init();

  function env($key, $default){
    global $CONFIG;
    return (isset($CONFIG[$key])? $CONFIG[$key] : $default);
  }

  if(isset($_GET['page']) && !empty($_GET['page'])){
    $page = str_replace("..", "", $_GET['page']);

    if(file_exists("pages/".$page.".php"))
      $page = $_GET['page'];
    else
      $page = "error";
  }
  else
    $page = "default";

  $page = "pages/".$page.".php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>NGSync</title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <link rel='shortcut icon' href='/favicon.ico' />
  <link rel="stylesheet" title="Default" href="css/style.css?" media="screen, projection, handheld" />
</head>

<body>
  <div id="wrapper">

    <div id="userinfo">
      <p class="t-r">Logged as: <span class="b">anonymous</span></p>
    </div>

    <div id="inner">
      <div id="header">
        <div id="logo">
          <h1>NGSync for <?php echo env("geo", "[version]"); ?></h1>
        </div>

        <div id="menu">
          <ul>
            <li><a href="#">Jobs</a></li>
            <li><a class="" href="#">Configuration</a></li>
            <li><a href="#">About</a></li>
          </ul>
        </div>

        <div class="c"></div>
      </div>
      <div id="content">
        <?php @include $page; ?>
      </div>
    </div>
    <div id="footer">
      <div id="footer-left" class="l">
        <p>NGSync v.<?php echo env("version", "[version]"); ?></p>
      </div>
      <div id="foter-right" class="r">
        <p>Created 2016 by fkolacek</p>
        <p>Time to serve: <?php echo number_format(microtime(true) - $startTime, 3); ?>s </p>
      </div>

      <div class="c"></div>
    </div>
  </div>
  <script type="text/javascript" src="js/jquery.js"></script>
</body>
</html>
