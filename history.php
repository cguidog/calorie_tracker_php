<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
    $( "#datepicker" ).on( "change", function() {
      $( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
    });
  } );
  </script>
</head>
<body>
<header>
    <nav class="nav-wrapper">
            <div></div>
                <div>
                <?php
            if (isset($_SESSION['userId'])) {
                echo '<a href="index.php"><h1>Calorie Tracker</h1></a>
                <ul class="menu-list">
                <li class="menu-list-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
                <li class="menu-list-item"><a href="newitem.php"><i class="fas fa-plus"></i></a></li>
                <li class="menu-list-item"><a href="history.php"><i class="fas fa-history"></i></a></li>
            </ul>
        <form class="nav-login" action="includes/logout.inc.php" method="POST">
        <button type="submit" name="logout-submit"><i class="fas fa-sign-out-alt"></i></button>
    </form>';
            } else {
                echo '<form action="includes/login.inc.php" method="POST">
                <input type="text" name="mailuid" placeholder="Username/e-mail">
                <input type="password" name="pwd" placeholder="Password">
                <button type="submit" name="login-submit">Login</button>
            </form>
            <a href="signup.php">Signup</a>';
            }
        ?>
                </div>
            </div>
        </nav>
</header>
 



<section class="main-container">
            <form action="includes/history.inc.php" method="POST" class="history-form">
                <input type="text" id="datepicker" name="date" autocomplete="off">
                <button type="submit" name="date-submit">Search</button>
            </form>
</section>

<?php
    require 'footer.php';
?>